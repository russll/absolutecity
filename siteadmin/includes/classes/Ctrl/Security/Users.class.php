<?php

class Ctrl_Security_Users extends Ctrl_Base
{

    /**
     * Base User Model pointer
     *
     * @var pointer
     */
    public $mUser;
    public $mProfile;
    /** User Vars */
    private $mSystemUid;
    private $mSystemLogin;
    private $mSystemStatus;
    private $mSystemModules;
    private $mUinfo;
    private $mIsAdmin = 0;
    private $mRc4;
    private $mUi;
    /** User friends array */
    public $mUserFriends;
    /** User blocked friends array */
    public $mUserFriendsBlock;
    /** User family array */
    public $mUserFamily;
    /** some constants */
    private $mLangs;
    private $mRelations;
    private $mRelStatuses;
    private $mIm;
    private $mInterests;
    private $mEstatuses;
    private $privacyArr;


    public function __construct(&$glObj)
    {
        parent :: __construct($glObj);

        include_once 'Model/Security/Rc4.class.php';
        $this->mRc4 = new Model_Security_Rc4();
        $this->mRc4->setKey('idfdnjewrjerjewrjbk');

        include_once 'Model/Security/Users.class.php';
        $this->mUser = new Model_Security_Users($this->mDb, $this->mRc4);

        include_once 'Model/Profile/Profile.class.php';
        $this->mProfile = new Model_Base_Profile($this->mDb);

        $this->privacyArr = array('Friends only', 'Friends of friends', 'Friends and followers', 'Everyone');
    }

    public function __set($varName, $value)
    {
        if (property_exists($this, $varName))
        {
            $this->$varName = $value;
        }
        return true;
    }

    public function &__get($name)
    {
        if (isset($this->$name))
        {
            return $this->$name;
        } else
        {
            $r = 0;
            return $r;
        }
    }

    public function _getObj()
    {
        return $this->mUser;
    }

    /** Some constants for user profile */
    public function _InitConst()
    {

        $this->mLangs = array(1 => 'English', 2 => 'Spanish', 3 => 'Russian', 4 => 'Czech');
        $this->mRelations = array(1 => 'Mother', 2 => 'Father', 3 => 'Sister', 4 => 'Brother', 5 => 'Cousin', 6 => 'Uncle', 7 => 'Aunt', 8 => 'Grand Mother', 9 => 'Grand Father', 10 => 'Other Relative', 11 => 'Spouse', 12 => 'Son', 13 => 'Daughter');
        $this->mRelStatuses = array(1 => 'Single', 2 => 'Married', 3 => 'Divorced', 4 => 'Separated', 5 => 'Widowed');
        $this->mIm = array(1 => 'ICQ', 2 => 'AOL', 3 => 'Jabber', 4 => 'Skype');
        $this->mInterests = array(
            1 => 'My testimony',
            2 => 'My favorite scripture',
            3 => 'Activities',
            4 => 'Interests',
            5 => 'Favorite music',
            6 => 'Favorite TV shows',
            7 => 'Favorite Books',
            8 => 'Favorite quotations',
            9 => 'About me'
        );
        $this->mEstatuses = array(1 => 'Employed', 2 => 'Unemployed');
    }

    public function CheckAuth()
    {

        $check_auth = $this->mUser->CheckLogin(CURRENT_SCP, 1);
        $_SESSION['check_auth'] = $check_auth;

        if ($check_auth >= 2)
        {
            /**
             * Пользователь не авторизован
             */
            if (isset($_POST['system_login']))
            {
                $this->mSmarty->assign('check_auth', $check_auth);
            }
        }
        else
        {
            /**
             * Пользователь авторизован
             */
            $this->mSystemUid = $_SESSION['system_uid'];
            $this->mSystemLogin = $_SESSION['system_login'];
            $this->mSystemStatus = $_SESSION['system_status'];
            $this->mSystemModules = $_SESSION['system_modules'];

            $this->mSmarty->assign('system_login', $this->mSystemLogin);
            $this->mSmarty->assign('system_status', $this->mSystemStatus);
            $this->mSmarty->assign('system_modules', $this->mSystemModules);

            // current user info
            $ci = $this->mUser->GetCurInfo();

            if (!empty($ci) && $ci['uid'] == $this->mSystemUid)
            {
                $this->mUinfo = $ci;
            }
            else
            {
                $this->mUinfo = & $this->mUser->Get($this->mSystemUid);
            }

            if (empty($this->mUinfo))
            {
                /**
                 * Понятия не имею как это может получится - но на всякий лучше закрыть
                 */
                $this->mUser->Logout();
                exit();
            }


            //Define statuses
            if (1 == $this->mUinfo['gender'])
            {
                $upr_list = array(0 => 'No', 1 => 'Aaronic Priesthood', 2 => 'Aaronic Priesthood ( Young Men)', /* 3 => 'Priesthood Holders', */
                    4 => 'Melchizedek Priesthood', 7 => 'High Priest');
            }
            else
            {
                $upr_list = array(0 => 'No', 11 => 'Relief Society', 12 => 'Young Women');
            }

            if (isset($upr_list[$this->mUinfo['priesthood']]))
            {
                $this->mUinfo['priesthood_txt'] = $upr_list[$this->mUinfo['priesthood']];
            }
            else
            {
                $this->mUinfo['priesthood'] = 0;
                $this->mUinfo['priesthood_txt'] = 'No';
            }

            $this->mSmarty->assign_by_ref('UserInfo', $this->mUinfo);

            if (!defined('UID'))
            {
                define('UID', $this->mUinfo['uid']);
                define('UI_LOGIN', $this->mUinfo['email']);
            }

            /** get user friends */
            if (!empty($this->moCache))
            {
                $this->mUserFriends = $this->moCache->get('user_' . UID . '_friends');
                if (empty($this->mUserFriends))
                {
                    require_once 'Model/Base/Friends.class.php';
                    $moFriends = new Model_Base_Friends($this->mDb);
                    $moFriends->SetBlockFrom();
                    $this->mUserFriends = $moFriends->GetUserFriends(UID, 0, 0, array(0, 1, 2), 0, '', 0, -1, 0, 0, -1, 1);
                    $this->moCache->set('user_' . UID . '_friends', serialize($this->mUserFriends));
                }
                else
                {
                    $this->mUserFriends = unserialize($this->mUserFriends);
                }

                /** get user blocked friends */
                $this->mUserFriendsBlock = $this->moCache->get('user_' . UID . '_friends_block');
                if (empty($this->mUserFriendsBlock))
                {
                    require_once 'Model/Base/Friends.class.php';
                    $moFriends = new Model_Base_Friends($this->mDb);
                    $moFriends->SetBlockFrom();
                    $this->mUserFriendsBlock = $moFriends->GetUserFriends(UID, 0, 0, array(3), 0, '', 0, -1, 0, 0, -1, 1);
                    $this->moCache->set('user_' . UID . '_friends_block', serialize($this->mUserFriendsBlock));
                }
                else
                {
                    $this->mUserFriendsBlock = unserialize($this->mUserFriendsBlock);
                }
            }
            else
            {

                //no cache object
                //friends
                require_once 'Model/Base/Friends.class.php';
                $moFriends = new Model_Base_Friends($this->mDb);
                $moFriends->SetBlockFrom();
                $this->mUserFriends = $moFriends->GetUserFriends(UID, 0, 0, array(0, 1, 2), 0, '', 0, -1, 0, 0, -1, 1);

                //friends blocked
                $moFriends = new Model_Base_Friends($this->mDb);
                $this->mUserFriendsBlock = $moFriends->GetUserFriends(UID, 0, 0, array(), 0, '', 0, -1, 0, 0, -1, 1);
            }


            /**
             * Check showing profile
             */
            $loginx = strip_tags(_v('loginx', ''));
            $uid = _v('uid', 0);

            if (!empty($loginx))
            {
                $uid = $this->mUser->GetByLogin($loginx);
            }

            if (!empty($uid) && defined('UID') && UID != $uid)
            {
                $this->mUi = $this->mUser->Get($uid);
                if (empty($this->mUi))
                {
                    //uid - ID exist - but not found
                    uni_redirect(PATH_ROOT . 'id' . UID);
                }
            }
            else
            {
                $this->mUi = $this->mUinfo;
            }

            if (empty($this->mUi) && !empty($this->mUinfo))
            {
                $this->mUi = $this->mUinfo;
            }

            if (!empty($this->mUi))
            {
                if (!defined('UID_OTHER'))
                {
                    define('UID_OTHER', $this->mUi['uid']);
                    define('UI_LOGIN_OTHER', $this->mUi['email']);
                    define('IS_USER', (defined('UID') && UID == UID_OTHER) ? true : false);
                    $this->mSmarty->assign('IS_USER', IS_USER);
                }

                //get family
                if (!empty($this->moCache))
                {
                    /** get user family */
                    $this->mUserFamily = $this->moCache->get('user_' . UID_OTHER . '_family');
                    $this->moCache->delete('user_' . UID . '_family');
                    if (empty($this->mUserFamily))
                    {
                        require_once 'Model/Profile/Profile.class.php';
                        $moProfile = new Model_Base_Profile($this->mlObj['gDb']);
                        $this->mUserFamily = $moProfile->GetFamilyList(UID_OTHER, 1, 1);
                        $this->moCache->set('user_' . UID_OTHER . '_family', serialize($this->mUserFamily));
                    }
                    else
                    {
                        $this->mUserFamily = unserialize($this->mUserFamily);
                    }
                }
                else
                {
                    //family
                    require_once 'Model/Profile/Profile.class.php';
                    $moProfile = new Model_Base_Profile($this->mlObj['gDb']);
                    $this->mUserFamily = $moProfile->GetFamilyList(UID_OTHER, 1, 1);
                }
                //deb($this->mUserFamily);

                /**
                 * User rights
                 */
                if (IS_USER)
                {
                    $ar_rel['im_suscr_fr'] = 1;
                    $ar_rel['im_friend'] = 1;
                    $ar_rel['im_fam'] = 1;
                    $ar_rel['im_blocked'] = 0;


                    $global['news'] = 1;
                    $global['basic'] = 1;
                    $global['contact'] = 1;
                    $global['personal'] = 1;
                    $global['edu_work'] = 1;
                    $global['photos'] = 1;
                    $global['videos'] = 1;
                    $global['notes'] = 1;
                    $this->mUi['global'] = $global;
                }
                else
                {
                    $ar_rel = $this->_initRelations();
                }
                $this->mUi = array_merge($this->mUi, $ar_rel);


                if (1 == $this->mUi['gender'])
                {
                    $userpr_list = array(0 => 'No', 1 => 'Aaronic Priesthood', 2 => 'Aaronic Priesthood (Young Men)', /* 3 => 'Priesthood Holders', */
                        4 => 'Melchizedek Priesthood', 7 => 'High Priest');
                }
                else
                {
                    $userpr_list = array(0 => 'No', 11 => 'Relief Society', 12 => 'Young Women');
                }

                if (isset($upr_list[$this->mUi['priesthood']]))
                {
                    $this->mUi['priesthood_txt'] = $upr_list[$this->mUinfo['priesthood']];
                }
                else
                {
                    $this->mUi['priesthood'] = 0;
                    $this->mUi['priesthood_txt'] = 'No';
                }

                $this->mSmarty->assign_by_ref('ui', $this->mUi);
            }
            
            if (!defined('UID_OTHER') && defined('UID'))
            {
                $this->mUi = $this->mUinfo;
                define('UID_OTHER', UID);
            }
        }
    }

    public function LogOut()
    {
        if (!empty($_REQUEST['logout']))
        {
            $this->mUser->Logout();
            if ($this->mIsAdmin)
            {
                uni_redirect(PATH_ROOT_ADM);
            } else
            {
                uni_redirect(PATH_ROOT);
            }
        }
    }

    public function AuthForm()
    {
        $this->mSmarty->display('enter.html');
    }

    public function CheckRights($mod)
    {
        $t = 1;
        if (2 == $this->mUinfo['status'])
        {
            $t = 0;
        } elseif (1 == $this->mUinfo['status'])
        {
            $modules = $this->mUinfo['modules'];
            if (empty($modules) || empty($modules[$mod]))
            {
                $t = 0;
            }
        }
        return true;
    }


    /**
     * Output Methods for frontend
     */
    public function Index()
    {
        $act = '';
        if ($this->mIsAdmin)
        {
            uni_redirect(PATH_ROOT_ADM);
        }
        uni_redirect(PATH_ROOT);
    }

    /**
     * Show profile for current user
     */
    public function Profile()
    {
        if (!$this->mSystemLogin)
        {
             uni_redirect('/');
        }

        uni_redirect(PATH_ROOT . 'id' . $this->mUinfo['uid']);
    }

    public function Settings()
    {
        if (empty($this->mSystemLogin))
        {
            uni_redirect('/');
        }

        if (!IS_USER && !$this->moUser->mUi['global']['basic'])
            $this->mSmarty->assign('basic_denied', true);

        if (!IS_USER && !$this->moUser->mUi['global']['contact'])
            $this->mSmarty->assign('contact_denied', true);

        if (!IS_USER && !$this->moUser->mUi['global']['edu_work'])
            $this->mSmarty->assign('edu_denied', true);

        if (!IS_USER && !$this->moUser->mUi['global']['personal'])
            $this->mSmarty->assign('pinfo_denied', true);

        $this->_InitConst();
        $this->mSmarty->assign_by_ref('spoken_langs', $this->mLangs);
        $this->mSmarty->assign_by_ref('relations', $this->mRelations);
        $this->mSmarty->assign_by_ref('rel_statuses', $this->mRelStatuses);
        $this->mSmarty->assign_by_ref('ims', $this->mIm);
        $this->mSmarty->assign_by_ref('interests', $this->mInterests);
        $this->mSmarty->assign_by_ref('estatuses', $this->mEstatuses);

        $this->mUi['langs'] = $this->mProfile->GetLangList($this->mUi['uid']);
        $this->mUi['fam'] = $this->mProfile->GetFamilyList($this->mUi['uid']);
        $this->mUi['im'] = $this->mProfile->GetImList($this->mUi['uid']);
        $this->mUi['mission'] = $this->mProfile->GetMissionList($this->mUi['uid']);
        if ($this->mUi['ward_id'])
        {
            $this->mUi['class'] = $this->mProfile->GetSchoolClassList($this->mUi['uid'], $this->mUi['ward_id']);
        }
        $this->mUi['calling'] = $this->mProfile->GetCallingList($this->mUi['uid']);
        $this->mUi['interests'] = $this->mProfile->GetInterestList($this->mUi['uid']);

        $this->mUi['university'] = $this->mProfile->GetUniversityList($this->mUi['uid']);
        $this->mUi['hschool'] = $this->mProfile->GetHSchoolList($this->mUi['uid']);

        $this->mUi['job'] = $this->mProfile->GetJobList($this->mUi['uid']);

        //-- get tags list
        $ctags = $this->moUser->mUser->GetTags(UID_OTHER);
        $this->mSmarty->assign_by_ref('ctags', $ctags);
        $this->mSmarty->assign_by_ref('cnt_ctags', count($ctags) /* $this->moUser->mUser->GetCntTags(UID_OTHER) */);
        $this->mSmarty->assign_by_ref('ctags_fav', $this->moUser->mUser->GetOneTag(-1, UID, 2));

        if (1 == $this->mUi['gender'])
            $phl = array(0 => 'No', 1 => 'Aaronic Priesthood', 2 => 'Aaronic Priesthood (Young Men)', /* 3 => 'Priesthood Holders', */
                4 => 'Melchizedek Priesthood', 7 => 'High Priest');
        else
            $phl = array(0 => 'No', 11 => 'Relief Society', 12 => 'Young Women');
        $this->mSmarty->assign_by_ref('phl', $phl);

        $this->mSmarty->assign_by_ref('countries', $GLOBALS['cntrs']);


        $this->mSmarty->assign('ed_basic', isset($_REQUEST['ed_basic']) ? 1 : 0);
        $this->mSmarty->assign('ed_contact', isset($_REQUEST['ed_contact']) ? 1 : 0);
        $this->mSmarty->assign('ed_inerest', isset($_REQUEST['ed_inerest']) ? 1 : 0);
        $this->mSmarty->assign('ed_work', isset($_REQUEST['ed_work']) ? 1 : 0);
        $this->mSmarty->assign('ed_mission', isset($_REQUEST['ed_mission']) ? 1 : 0);
        $this->mSmarty->assign('_content', $this->mSmarty->Fetch('mods/users/_settings.html'));
    }

    public function Login()
    {
        if ($this->mIsAdmin)
        {
            uni_redirect(PATH_ROOT_ADM);
        }

        if ($this->mSystemLogin)
        {
            $this->Index();
        } else
        {
            $code = _v('code', '');

            if ($code)
            {
                $ui = $this->mUser->ApproveByCode($code);

                if (!empty($ui) && $ui && is_array($ui))
                {
                    /** add some information after approve */
                    //1. Follow 1-st user (uid = 1)
                    if ($ui['uid'] != 1)
                    {
                        $this->mUser->EditSubscr($ui['uid'], 1, 1);
                    }

                    /** autologin */
                    $_POST['system_login'] = $ui['email'];
                    $_POST['system_pass'] = $ui['pass'];
                    $this->CheckAuth();

                    /** show first steps */
                    uni_redirect(PATH_ROOT . 'profile');
                } else
                {
                    $this->mSmarty->assign('_content', $this->mSmarty->Fetch('mods/users/_error_code.html'));
                }
            }
            uni_redirect(PATH_ROOT);
        }
    }

    /**
     * Show approved form
     * @return bool true
     */
    public function Approved()
    {
        if (!empty($_SESSION['approve_email']))
        {
            $this->mSmarty->assign('approve_email', $_SESSION['approve_email']);
        }

        $this->mSmarty->assign('_content', $this->mSmarty->Fetch('mods/users/_reg_approved.html'));
    }

    public function Forgot()
    {
        if ($this->mIsAdmin)
        {
            uni_redirect(PATH_ROOT_ADM);
        }

        if ($this->mSystemLogin)
        {
            uni_redirect(PATH_ROOT);
        }

        if (!empty($_REQUEST['code']) || !empty($_SESSION['restore_pass']))
        {
            if (!empty($_SESSION['restore_pass']))
            {
                $r = $this->mUser->Get($_SESSION['restore_pass']);
            } else
            {
                $r = $this->mUser->GetRestoreCode($_REQUEST['code']);
                $_SESSION['restore_pass'] = $r['uid'];
            }

            if (!empty($r))
            {
                /** show change password form */
                if (!empty($_POST['fm']))
                {
                    $fm = $_POST['fm'];
                    if (!empty($fm['pass']) && !empty($fm['pass2']) && $fm['pass'] == $fm['pass2'])
                    {
                        $this->mUser->UpdatePassword($r['uid'], $fm['pass']);
                        unset($_SESSION['restore_pass']);
                        $this->mUser->Logout();
                        $_POST['system_login'] = $r['email'];
                        $_POST['system_pass'] = $fm['pass'];
                        $this->CheckAuth();
                        uni_redirect(PATH_ROOT . 'id' . $r['uid']);
                    }
                    $this->mSmarty->assign('errs', 1);
                }

                $this->mSmarty->assign_by_ref('ui', $r);
                $this->mSmarty->assign_by_ref('_content', $this->mSmarty->Fetch('mods/users/_change_password.html'));
                return;
            }
        }

        if (isset($_POST['UserInfo']) && 0 < count($_POST['UserInfo']))
        {
            $forgoterr = array();

            if (!isset($_POST['UserInfo']['email']) || !verify_email($_POST['UserInfo']['email']))
            {
                $forgoterr[] = 2;
            }

            if (0 == count($forgoterr))
            {
                $u = $this->mUser->Get($this->mUser->GetByEmail($_POST['UserInfo']['email']));

                if (!isset($u['email']) || $u['email'] != trim($_POST['UserInfo']['email']))
                {
                    $forgoterr[] = 3;
                } else
                {
                    $code = $this->mUser->RestorePassword($u['email']);

                    $this->mSmarty->assign('code', $code);
                    $this->mSmarty->assign('email', $u['email']);
                    $this->mSmarty->assign('login', $u['public_name']);

                    $this->mSmarty->assign('SUPPORT_SITENAME', SUPPORT_SITENAME);

                    /** Send mail */
                    $this->mSmarty->assign('DOMEN', DOMEN);
                    include 'Ctrl/Mail/Phpmailer_v5.1/class.phpmailer.php';
                    $gMail = new PHPMailer();
                    $gMail->From = 'not_reply@' . DOMEN;
                    $gMail->FromName = 'inZion.com';
                    $gMail->AddAddress($_POST['UserInfo']['email'], '');
                    $gMail->WordWrap = 50;
                    $gMail->IsHTML(true);

                    $gMail->Subject = 'inZion.com password restore';
                    $gMail->Body = $this->mSmarty->fetch('mails/newpass.html');
                    $_SESSION['forgot_email'] = $_POST['UserInfo']['email'];
                    if (!$gMail->Send())
                    {
                        $errs[] = $gMail->ErrorInfo;
                    }
                    uni_redirect(PATH_ROOT . "security/users/forgot?send=ok", 1);
                }
            }

            $this->mSmarty->assign_by_ref('forgoterr', $forgoterr);
            $this->mSmarty->assign_by_ref('UserInfo', $_POST['UserInfo']);
        }

        if (isset($_REQUEST['send']) && 'ok' == $_REQUEST['send'])
        {
            if (!empty($_SESSION['forgot_email']))
            {
                $this->mSmarty->assign_by_ref('email', $_SESSION['forgot_email']);
                unset($_SESSION['forgot_email']);
            }
            $this->mSmarty->assign('send', 1);
        }
        $this->mSmarty->assign('no_reg_bl', 1);
        $this->mSmarty->assign_by_ref('_content', $this->mSmarty->Fetch('mods/users/_forgot.html'));
    }

    /**
     * Update user profile
     */
    public function Change()
    {
        if (empty($this->mSystemLogin))
        {
            uni_redirect(PATH_ROOT . 'security/users/reg');
        }

        $uid = $this->mUinfo['uid'];

        if (!empty($_REQUEST['delphoto']))
        {
            $this->mUser->DelPhoto($uid);
            uni_redirect(PATH_ROOT . 'security/users/change');
        }


        if (!empty($_POST['fm']))
        {
            $fm = $_POST['fm'];
            $adi = array(
                'about_me' => !empty($fm['about_me']) ? strip_tags($fm['about_me']) : '',
                'send_comments' => !empty($fm['send_comments']) ? 1 : 0,
                'send_updates' => !empty($fm['send_updates']) ? 1 : 0
            );

            $this->mUser->UpdValues($uid, $adi);
            uni_redirect(PATH_ROOT);
        }

        $this->mSmarty->assign('_content', $this->mSmarty->Fetch('mods/users/_change.html'));
        define('IS_CABINET', 1);
    }

    public function Unsubscr()
    {
        if ($this->mIsAdmin)
        {
            uni_redirect(PATH_ROOT_ADM);
        }

        $code = _v('code', '');

        $change = 0;
        if ($code)
        {
            $change = $this->mUser->UpdSubscrByCode($code);
        }
        $this->mSmarty->assign('change', 1);
        $this->mSmarty->assign('_content', $this->mSmarty->Fetch('mods/users/_unsubscr.html'));
    }

    /**
     * Initialization of relations
     *
     * @return array of relations
     */
    public function _initRelations($uid = '')
    {
        $ar_rel = array();

        require_once 'Model/Base/Friends.class.php';
        $moFriends = new Model_Base_Friends($this->mDb);

        if (UID_OTHER || UID)
        {
            $ar_rel['im_fam'] = !empty($this->mUserFamily[UID_OTHER]) ? 1 : 0; //Family we are (1) or Not (0)
        } else
        {
            $ar_rel['im_fam'] = 0;
        }


        $user_id = $uid ? $uid : UID_OTHER;

        //-- get friends status
        //$fr_i = $moFriends->GetFriend(UID, $user_id);
        if (!empty($this->mUserFriends[$user_id]))
        {
            //deb($this -> mUserFriends);
            if (1 == $this->mUserFriends[$user_id]['active'])
            {
                $ar_rel['im_friend'] = 1; //im friend
            }
            else
            {
                $ar_rel['im_friend'] = 2; //im waiting for confirmation of friend's status
            }

        }
        else
        {
            $ar_rel['im_friend'] = empty($this->mUserFriendsBlock[$user_id]) ? 0 : 3; //im not a friend == 0 OR blockrf == 3
        }

        //-- get subscribtion status
        $ar_rel['im_suscr_fr'] = ((!IS_USER) ? $this->mUser->ChckSubscr(UID, UID_OTHER) : 0) /* || ($ar_rel['im_friend'] == 1) */
        ;

        $ar_rel['im_suscr_jr'] = ((!IS_USER) ? $this->mUser->ChckSubscrJrnl(UID, UID_OTHER) : 0) /* || ($ar_rel['im_friend'] == 1) */
        ;

        $ar_rel['im_blocked'] = ($moFriends->GetFrActive($user_id, (defined('UID') ? UID : 0)) == 3 ? 1 : 0);

        //-- get Mission Info if it necassery
        $module = _v('type');
        $mission_id = (int) _v('id');
        if ('mission' == $module && !empty($mission_id))
        {
            include_once 'Model/Base/Mission.class.php';
            $moMission = new Model_Base_Mission($this->mlObj['gDb']);
            $mission_id = (int) _v('id');

            //-- get Mission subscribition status
            $ar_rel['im_suscr_fr'] = $moMission->ChckSubscr(UID, $mission_id) || ($ar_rel['im_friend'] == 1);
        }

        $common = $moFriends->GetUserFriendsCount($user_id, array(), 0, '', UID);

        $global = array();

        $target = & $this->mUi;

        $global['news'] = !IS_USER ? $this->calcRel($target['privacy_news'], $ar_rel, $common) : 1;
        $global['basic'] = !IS_USER ? $this->calcRel($target['privacy_basic'], $ar_rel, $common) : 1;
        $global['contact'] = !IS_USER ? $this->calcRel($target['privacy_contact'], $ar_rel, $common) : 1;
        $global['personal'] = !IS_USER ? $this->calcRel($target['privacy_pinfo'], $ar_rel, $common) : 1;
        $global['edu_work'] = !IS_USER ? $this->calcRel($target['privacy_edu_work'], $ar_rel, $common) : 1;
        $global['photos'] = !IS_USER ? $this->calcRel($target['privacy_photo'], $ar_rel, $common) : 1;
        $global['videos'] = !IS_USER ? $this->calcRel($target['privacy_video'], $ar_rel, $common) : 1;
        $global['notes'] = !IS_USER ? $this->calcRel($target['privacy_notes'], $ar_rel, $common) : 1;

        /* 	$global['photos'] = 0;
          $global['videos'] = 0;
          $global['news'] = 0; */

        $target['global'] = $global;

        return $ar_rel;
    }

    public function calcRel($k, $ar, $mfriends = 0)
    {
      if (isset($_POST['system_login']))
      {
        uni_redirect(PATH_ROOT);
      }

        if ($k == 3)
            return true;
        # everyone

        if ($k == 2 && ($ar['im_suscr_fr'] || $ar['im_friend'] == 1))
            return true;
        #friends & followers

        if ($k == 1 && ($mfriends > 0 || $ar['im_friend'] == 1))
            return true;
        #friends && friends of friends

        if ($k == 0 && $ar['im_friend'] == 1)
            return true;
        # friend

        return 0;
    }

    /**
     * Проверяем, является ли некий пользователь другом данного
     * @param  $user_id
     * @return array
     */
    public function CheckFriendStatus($user_id)
    {
        if (empty($this->mSystemLogin))
        {
            uni_redirect('/');
        }

        if (!empty($this->mUserFriends[$user_id]))
        {
            if (1 == $this->mUserFriends[$user_id]['active'])
                $ar_rel['im_friend'] = 1; //im friend
            else
                $ar_rel['im_friend'] = 2; //im waiting for confirmation of friend's status

        }
        else
        {
            $ar_rel['im_friend'] = empty($this->mUserFriendsBlock[$user_id]) ? 0 : 3; //im not a friend == 0 OR blockrf == 3
        }
        return $ar_rel;
    }

    // wtf ?
    public function UplAvatar()
    {
        if (empty($this->mSystemLogin))
        {
            uni_redirect('/');
        }

        $ai = _v('AI');
        if (isset($ai['p_img']))
        {
            $wpar = array('image', 'fpath');
            $wval = array(base_chk($ai['p_img']), GetPostfix(UID));
            if (!$this->moUser->mUser->EditInfo(UID, $wpar, $wval))
            {
                echo 'not_success';
            } else
            {
                $a_img = '/' . DIR_NAME_IMAGE . 'users/' . $wval[1] . '/[fld]' . $wval[0]; // a/a_, s/s_
                echo $a_img;
            }
        }
        exit();
    }

    /* UplAvatar */

    /**
     * Check of the uploadinf user's Avatar
     *
     * @return uploaded file
     */
    public function ChkUplAvatar()
    {
        $errs = array();

        if (!UID)
            die('no pasaran!');


        if (!empty($_FILES['Filedata']['tmp_name']))
        {
            if (!is_uploaded_file($_FILES['Filedata']['tmp_name']))
                $errs[] = $this->mSmarty->get_config_vars('file_err1'); //'File is already uploaded';
            else
            {
                if (10240000 < $_FILES['Filedata']['size'] || 1 > $_FILES['Filedata']['size'])
                    $errs[] = $this->mSmarty->get_config_vars('file_err2'); //'File has an incorrect size';
                else
                {
                    $fpath = DIR_WS_IMAGE . 'users/';
                    $fpath_tmp = DIR_WS_IMAGE . 'users/_temp/';
                    $ext = get_img_ext($_FILES['Filedata']['tmp_name']);

                    if (false === $ext)
                        $errs[] = $this->mSmarty->get_config_vars('file_err3'); //'Incorrect extension';
                    else
                    {
                        $tempFile = $_FILES['Filedata']['tmp_name'];
                        $targetPath = $fpath . GetPostfix(UID) . '/';

                        if (!file_exists($targetPath))
                        {
                            mkdir($targetPath, 0777);
                            chmod($targetPath, 0777);
                        }
                        if (!file_exists($targetPath . 'n/'))
                        {
                            mkdir($targetPath . 'n/', 0777);
                            chmod($targetPath, 0777);
                        }
                        if (!file_exists($targetPath . 'a/'))
                        {
                            mkdir($targetPath . 'a/', 0777);
                            chmod($targetPath, 0777);
                        }
                        if (!file_exists($targetPath . 's/'))
                        {
                            mkdir($targetPath . 's/', 0777);
                            chmod($targetPath, 0777);
                        }
                        //file_put_contents('1.txt', $targetPath.'a/a_'.$targetFile);
                        //$aid = (int) $_POST['aid'];
                        // WTF??			//$crand = (int) $_POST['crand'];
                        $crand = mktime() . rand(100, 999);
                        $targetFile = UID . '_ava_' . $crand . '_' . Txt2Charset($_FILES['Filedata']['name']);

                        i_crop_copy(658, 439, $_FILES['Filedata']['tmp_name'], $targetPath . 'n/n_' . $targetFile, 2);
                        $src = $targetPath . 'n/n_' . $targetFile;
                        i_crop_copy(156, 156, $src, $targetPath . 'a/a_' . $targetFile, 1);
                        i_crop_copy(68, 68, $src, $targetPath . 's/s_' . $targetFile, 1);

                        $wpar = array('image', 'fpath');
                        $wval = array(base_chk($targetFile), GetPostfix(UID));

                        if (!$this->moUser->mUser->EditInfo(UID, $wpar, $wval))
                        {
                            echo 'not_success';
                        } else
                        {
                            $a_img = '/' . DIR_NAME_IMAGE . 'users/' . $wval[1] . '/[fld]' . $wval[0]; // a/a_, s/s_

                            include_once 'Ctrl/Ajax/Json.php';
                            $mJson = new Services_JSON();
                            echo $mJson->encode(array($a_img));
                            exit();
                        }

                        //return true;
                    }
                }
            }
        }

        die();
    }


    public function GetSubscr()
    {
        if (empty($this->mSystemLogin))
        {
            uni_redirect('/');
        }

        //-- get Subscribers list
        $pcnt = 10;
        $page = _v('page', 1);
        include_once 'View/Acc/Pagging.php';


        $cnt_ar_subscr = $this->moUser->mUser->GetCntSubscr(UID_OTHER);
        $mpage = new Pagging($pcnt, $cnt_ar_subscr, $page, '');
        $range = $mpage -> GetRange();
        $ar_subscr = $this->moUser->mUser->GetSubscr(-1, UID_OTHER, -1, $pcnt, -1, $range[0]);
        $this -> mSmarty -> assign('pagging',  $mpage   -> Make($this -> mSmarty, '', 'oUsers.SubscrPage'));
                
        $this->mSmarty->assign('ar_subscr', $ar_subscr);
        $this->mSmarty->assign('cnt_ar_subscr', $cnt_ar_subscr);

        //-- get Subscribition list
        $ar_subscribition = $this->moUser->mUser->GetSubscr(UID_OTHER, -1 /* , ' RAND()', 4 */);
        $cnt_ar_subscribition = $this->moUser->mUser->GetCntSubscr(-1, UID_OTHER);

        $this->mSmarty->assign('ar_subscribition', $ar_subscribition);
        $this->mSmarty->assign('cnt_ar_subscribition', $cnt_ar_subscribition);
        $this->mSmarty->assign('m_page', 'subscr_list');
        $this->mSmarty->assign_by_ref('_content', $this->mSmarty->Fetch('mods/friends/_subscr_list.html'));
    }

    /**
     * Получение списка подписчиков и тех, на кого подписка (зависит от param)
     * @return void
     */
    public function GetSubscrListAjax()
    {
        if (empty($this->mSystemLogin))
        {
            uni_redirect('/');
        }

        $param = _v('param', 0);
        $page  = (int)_v('page', 1);
        $pcnt  = 10;
        include_once 'View/Acc/Pagging.php';

        switch ($param)
        {
            case 1:
                /**
                 * список на кого подписался пользователь
                 */

                break;

            default:
                /**
                 * Подписчики данного пользователя
                 */
                $cnt_ar_subscr = $this->moUser->mUser->GetCntSubscr(UID_OTHER);
                $mpage = new Pagging($pcnt, $cnt_ar_subscr, $page, '');
                $range = $mpage -> GetRange();
                $ar_subscr = $this->moUser->mUser->GetSubscr(-1, UID_OTHER, -1, $pcnt, -1, $range[0]);

                $this->mSmarty->assign('ar_subscr', $ar_subscr);
                $res['data'] = $this->mSmarty->Fetch('mods/friends/_subscr_list_ajax.html');
                $res['q']    = 'ok';
                $res['pagging'] = $mpage   -> Make($this -> mSmarty, '', 'oUsers.SubscrPage');
                echo Ar2Json($res);
                exit();
                break;
        }
    }


    public function DoSubscrAjax()
    {
        if (empty($this->mSystemLogin))
        {
            uni_redirect('/');
        }

        $act = (int) _v('act');
        if (!IS_USER)
        {
            echo $this->mUser->EditSubscr(UID, UID_OTHER);
        } else
        {
            echo 'not_success';
        }
        exit();
    }

    /* DoSubscrAjax */

    public function ChangeAppearAjax()
    {
        if (empty($this->mSystemLogin))
        {
            uni_redirect('/');
        }

        $offline = (int) _v('offline');
        $this->mUser->ChangeAppear(UID, $offline);
        exit();
    }

    /* ChangeAppearAjax */

    public function EditScriptureAjax()
    {
        if (empty($this->mSystemLogin))
        {
            uni_redirect('/');
        }

        $scr = base_chk(_v('scr'));
        if (IS_USER && $scr)
        {
            $this->mUser->EditScripture(UID, $scr);
            echo $scr;
        }
        else
            echo 'not_success';
        exit();
    }

    /* EditScriptureAjax */

    public function GetTags()
    {
        if (empty($this->mSystemLogin))
        {
            uni_redirect('/');
        }

        $ar_tags = $this->moUser->mUser->GetTags(UID_OTHER);

        $cnt_ar_tags = $this->moUser->mUser->GetCntTags(UID_OTHER);

        $fav_i = $this->moUser->mUser->GetOneTag(-1, UID_OTHER, 2);

        $this->mSmarty->assign('ar_tags', $ar_tags);
        $this->mSmarty->assign('cnt_ar_tags', $cnt_ar_tags);

        $this->mSmarty->assign('ttype', 'tags_list');
        $this->mSmarty->assign('m_page', 'tags_list');
        $this->mSmarty->assign_by_ref('_content', $this->mSmarty->Fetch('mods/profile/_tags_list.html'));
    }

    /* GetTags */


    /* Get List of User's tags */

    public function GetTagListAjax()
    {
        if (empty($this->mSystemLogin))
        {
            uni_redirect('/');
        }

        $q = trim(_v('q', ''));
        if (defined('UID') && '' != $q)
        {
            $ar_tags = $this->moUser->mUser->SearchTags(UID, $q);

            $i_max = count($ar_tags);
            for ($i = 0; $i < $i_max; $i++)
            {
                if ('my church talks' == $ar_tags[$i]['name'])
                {
                    $my_talk = 1;
                }
                echo "\n" . $ar_tags[$i]['name'];
            }

            if (strpos(" my church talks", $q) > 0 && empty($my_talk))
            {
                echo "my church talks";
            }
        }
        n_exit();
    }

    /* Get List of User's tags */


    /*
     * Edit Tags
     *
     * @param - act: 1 - insert; 2 - delete;
     */

    public function EditTagsAjax()
    {
        if (empty($this->mSystemLogin))
        {
            uni_redirect('/');
        }

        $act = (int) _v('act');
        $id = (int) _v('tid');
        $mid = (int) _v('mid', 0);
        $name = base_chk(_v('name'));
        $wtype = _v('wtype', 0);

        $return = array('status' => 'fail', 'ans' => array());

        if (empty($id))
        {
            $id = -1;
        }

        if (!empty($act) || (1 == $act && empty($name)))
        {
            $lid = $this->mUser->EditTags($act, UID, $name, $id);
            if ($lid > 0)
            {
                /** add tag message */
                if ($lid && $mid)
                {
                    $ret = $this->mUser->AddTagsMesg($lid, $mid, UID, 1, $wtype);
                    if ($ret)
                    {

                        $j_ctags = $this->mUser->GetTags(UID_OTHER, -1, MAX_MSG_TAGS);
                        $i_max = count($j_ctags);
                        for ($i = 0; $i < $i_max; $i++)
                        {
                            if ($j_ctags[$i]['name'] == 'my church talks')
                            {
                                $tmp = $j_ctags[$i];
                                unset($j_ctags[$i]);
                                $j_ctags = array_merge(array($tmp), $j_ctags);
                                break;
                            }
                        }

                        $this->mSmarty->assign('ctags_fav', $this->mUser->GetOneTag(-1, UID, 2));
                        $this->mSmarty->assign('j_ctags', $j_ctags);

                        $tpl = $this->mSmarty->fetch('mods/adtmpl/_tags_leftcolumn.html');

                        $return['status'] = 'success';
                        $return['ans'] = array('id' => $lid, 'name' => $name, 'tags_list' => $tpl);
                    }
                }
            }
        } elseif ($act == 2 && $lid == -33)
        {
            //delete message after delete tag
            $ret = $this->mUser->DeleteTagsMesg($lid, $mid, UID, 1, $wtype);
        }


        include_once 'Ctrl/Ajax/Json.php';
        $mJson = new Services_JSON();
        echo $mJson->encode($return);
        n_exit();
    }

    /* EditTagsAjax */

    /**
     * Delete one tag with all messages links
     */
    public function DeleteTagAjax()
    {
        if (empty($this->mSystemLogin))
        {
            uni_redirect('/');
        }

        $tid = _v('tid', 0);
        if ($tid)
        {
            if ($this->mUser->DeleteTag($tid, UID))
            {

            } else
            {
                echo 'not_success';
            }
        }
        n_exit();
    }

    public function GetTagsMes()
    {
        if (empty($this->mSystemLogin))
        {
            uni_redirect('/');
        }

        $tid = (int) _v('tid');
        if ($tid)
        {
            $ar_tags_mes = $this->moUser->mUser->GetTagsMes(UID_OTHER, $tid);

            //$cnt_ar_tags_mes = $this->moUser->mUser->GetCntTagsMes(UID_OTHER, $tid);
            $cnt_ar_tags_mes = count($ar_tags_mes);

            if ($ar_tags_mes)
            {
                require_once 'Ctrl/Profile/Wall.class.php';
                $moWall = new Ctrl_Profile_Wall($this->mlObj);

                if (UID_OTHER != UID)
                {
                    $w_filts = $moWall->_initFilts();
                    $w_sfilts = $moWall->_initSFilts();
                } else
                {
                    $w_filts = array();
                    $w_sfilts = array();
                }


                require_once 'Ctrl/Journal/Wall.class.php';
                $moJournal = new Ctrl_Journal_Wall($this->mlObj);
                if (UID_OTHER != UID)
                {
                    $j_filts = $moJournal->_initFilts();
                    $j_sfilts = $moJournal->_initSFilts();
                } else
                {
                    $j_filts = array();
                    $j_sfilts = array();
                }

                define('ONLY_INIT_WARD', 1);
                require_once 'Ctrl/Wards/Wall.class.php';
                $moWWall = new Ctrl_Wards_Wall($this->mlObj);

                if (UID_OTHER != UID)
                {
                    if (!empty($this->moUser->mUi['ward_id']))
                    {
                        //инициализируем будто пользователь смотрит вард другого пользователя
                        $moWWall->_initWard($this->moUser->mUi['ward_id']);
                    }
                    $wd_filts = $moWWall->_initFilts();
                } else
                {
                    $wd_filts = array();
                }

                require_once 'Model/Mission/Wall.class.php';
                $moMWall = new Model_Mission_Wall($this->mlObj['gDb']);


                $res = array('wall' => array(), 'journal' => array(), 'mission' => array(), 'wards' => array());

                foreach ($ar_tags_mes as $k => $r)
                {
                    switch ($r['wtype'])
                    {
                        case 0:
                            $r['mes'] = $moWall->moWall->GetOne($r['mid'], $w_filts, UID_OTHER, !IS_USER ? $w_sfilts['priesthold'] : -1, !IS_USER ? $w_sfilts['classes'] : -1);
                            if (!empty($r['mes']))
                            {
                                /** get link title */
                                if (3 == $r['mes']['mtype'] && $r['mes']['l_url'])
                                {
                                    $l = $moWWall->moWall->GetUrlTitle($r['mes']['l_url']);
                                    if (!empty($l))
                                    {
                                        $r['mes']['l_url_label'] = trim($l);
                                    } else
                                    {
                                        $r['mes']['l_url_label'] = GetSiteTitle($r['mes']['l_url']);
                                        $moWWall->moWall->EditUrlTitle($r['mes']['l_url'], $r['mes']['l_url_label'] . ' ');
                                    }
                                }

                                /** get answers */
                                $r['mes']['answers'] = $moWall->moWall->GetAnswList($r['mid']);
                                $res['wall'][] = $r;
                            }
                            break;

                        case 5:
                            $r['mes'] = $moJournal->moWall->GetOne($r['mid'], $j_filts, UID_OTHER, !IS_USER ? $j_sfilts['priesthold'] : -1, !IS_USER ? $j_sfilts['classes'] : -1);
                            if (!empty($r['mes']))
                            {
                                /** get link title */
                                if (3 == $r['mes']['mtype'] && $r['mes']['l_url'])
                                {
                                    $l = $moWWall->moWall->GetUrlTitle($r['mes']['l_url']);
                                    if (!empty($l))
                                    {
                                        $r['mes']['l_url_label'] = trim($l);
                                    } else
                                    {
                                        $r['mes']['l_url_label'] = GetSiteTitle($r['mes']['l_url']);
                                        $moWWall->moWall->EditUrlTitle($r['mes']['l_url'], $r['mes']['l_url_label'] . ' ');
                                    }
                                }

                                /** get answers */
                                $r['mes']['answers'] = $moJournal->moWall->GetAnswList($r['mid']);
                                $res['journal'][] = $r;
                            }
                            break;

                        case 2:
                            $r['mes'] = $moMWall->GetOne($r['mid'], array(), UID_OTHER);

                            if (!empty($r['mes']))
                            {
                                /** get link title */
                                if (3 == $r['mes']['mtype'] && $r['mes']['l_url'])
                                {
                                    $l = $moWWall->moWall->GetUrlTitle($r['mes']['l_url']);
                                    if (!empty($l))
                                    {
                                        $r['mes']['l_url_label'] = trim($l);
                                    } else
                                    {
                                        $r['mes']['l_url_label'] = GetSiteTitle($r['mes']['l_url']);
                                        $moWWall->moWall->EditUrlTitle($r['mes']['l_url'], $r['mes']['l_url_label'] . ' ');
                                    }
                                }

                                /** get answers */
                                $r['mes']['answers'] = $moMWall->GetAnswList($r['mid']);

                                $res['mission'][] = $r;
                            }
                            break;

                        case 3:
                            $r['mes'] = $moWWall->moWall->GetOne($r['mid'], UID_OTHER, $wd_filts);
                            if (!empty($r['mes']))
                            {
                                /** get link title */
                                if (3 == $r['mes']['mtype'] && $r['mes']['l_url'])
                                {
                                    $l = $moWWall->moWall->GetUrlTitle($r['mes']['l_url']);
                                    if (!empty($l))
                                    {
                                        $r['mes']['l_url_label'] = trim($l);
                                    } else
                                    {
                                        $r['mes']['l_url_label'] = GetSiteTitle($r['mes']['l_url']);
                                        $moWWall->moWall->EditUrlTitle($r['mes']['l_url'], $r['mes']['l_url_label'] . ' ');
                                    }
                                }

                                /** get answers */
                                $r['mes']['answers'] = $moWWall->moWall->GetAnswList($r['mid']);
                                $res['wards'][] = $r;
                            }
                            break;
                    }
                }

                if (empty($res['wall']) && empty($res['journal']) && empty($res['mission']) && empty($res['wards']))
                {
                    $res = '';
                }

                $this->mSmarty->assign('ar_tags_msg', $res);
            }

            //-- get tags list
            $ctags = $this->moUser->mUser->GetTags(UID_OTHER);
            $cnt_ctags = $this->moUser->mUser->GetCntTags(UID_OTHER);
            $this->mSmarty->assign_by_ref('ctags', $ctags);
            $this->mSmarty->assign_by_ref('cnt_ctags', $cnt_ctags);

            $this->mSmarty->assign_by_ref('ctags_fav', $this->moUser->mUser->GetOneTag(-1, UID, 2));

            $ti = $this->moUser->mUser->GetOneTag($tid);
            $this->mSmarty->assign('ti', $ti);
            $this->mSmarty->assign('ttype', 'tags_mes_list');
            $this->mSmarty->assign('m_page', 'tags_mes');

            $this->mSmarty->assign_by_ref('_content', $this->mSmarty->Fetch('mods/profile/_tags_list.html'));
        }
        else
            uni_redirect(PATH_ROOT . 'id' . UID);
    }

    /* GetTags */

    public function EditFavoriteAjax()
    {
        if (empty($this->mSystemLogin))
        {
            uni_redirect('/');
        }

        $act = (int) _v('act', 0);
        $tid = (int) _v('tid', 0);
        $mid = (int) _v('mid', 0);
        $mpath = (int) _v('mpath', 0);
        $wtype = (int) _v('wtype', 0);
        //echo '----'.$tid.'----';
        if (empty($id))
        {
            $id = -1;
        }

        if (!empty($act))
        {
            $lid = $this->mUser->EditFavorite($act, $tid, $mid, UID, $mpath, $wtype, $id);
            if (1 == $act && $lid)
            {
                echo $lid;
            } elseif (1 == $act && !$lid)
            {
                echo 'not_success';
            }
        } else
        {
            echo 'not_success';
        }
        exit();
    }

    /* EditFavoriteAjax */

    public function DelTagFromMesgAjax()
    {
        if (defined('UID'))
        {
            $tid = _v('tid', 0);
            $mid = _v('mid', 0);

            if ($tid && $mid)
            {
                if ($this->mUser->DelTagFromMesg($tid, $mid, UID))
                {
                    echo '';
                    exit();
                }
            }
        }
        echo 'not_success';
        exit();
    }

    public function GetMiniNotifyAjax()
    {
        if (defined('UID'))
        {
            $first = (int) _v('first');
            $last = (int) _v('last');

            if (!$first && !$last)
            {
                $first = $last = 1;
            }
            $moNotify = $this->mlObj['notify'];

            $ar_notify_mini = $moNotify->GetUNotify(-1, UID, -1, -1, $first, $last, -1, 0);
            $ar_cnt_notify_mini = $moNotify->GetCntUNotify(-1, UID, -1, -1, $first, $last, -1, 0);

            $this->mSmarty->assign_by_ref('ar_notify_mini', $ar_notify_mini);
            $this->mSmarty->assign_by_ref('ar_cnt_notify_mini', $ar_cnt_notify_mini);
            $this->mSmarty->Display('mods/users/_notify_mini.html');
        }
        else
            echo 'not_success';
        exit();
    }

    /* GetMiniNotifyAjax */

    public function Ajaxreg()
    {
        //$login  = strip_tags(_v('login', ''));
        $pass = _v('pass', '');
        $fname = strip_tags(_v('fname', ''));
        $lname = strip_tags(_v('lname', ''));
        $email = _v('email', '');
        $gender = _v('gender', 0);

        $bday = _v('bday', 0);
        $bmonth = _v('bmonth', 0);
        $byear = _v('byear', 0);

        $lower13 = false;
        $stopdate = strtotime('-13 years');
        if (mktime(1, 1, 1, $bmonth, $bday, $byear) >= $stopdate)
            $lower13 = true;

        $res = array();
        $res['errs'] = array();
        /*
          if (!$login)
          {
          $res['errs'][] = 'Please specify login';
          }
          elseif (!preg_match('/^[0-9a-z_-]+$/i', $login))
          {
          $res['errs'][] = 'Name can contain letters (a-z), numbers (0-9), an underscore "_" or a dash "-"';
          }
          elseif ($this -> mUser -> CheckLoginName($login))
          {
          $res['errs'][] = 'User with selected login already exist';
          }
         */

        if (((in_array($bmonth, array(4, 6, 9, 11))) && ($bday > 30)) || (($bmonth == 2) && ($bday > (($byear % 4 == 0) ? 29 : 28))))
        {
            $res['errs'][] = $this->mSmarty->get_config_vars('reg_err1'); //'Please choose correct date';
        }


        if (empty($email))
        {
            $res['errs'][] = $this->mSmarty->get_config_vars('reg_err2'); //'Please specify email';
        } elseif (!verify_email($email) || 64 < strlen($email))
        {
            $res['errs'][] = $this->mSmarty->get_config_vars('reg_err3'); //'Please enter a valid email address';
        } elseif ($this->mUser->CheckEmail($email))
        {
            $res['errs'][] = $this->mSmarty->get_config_vars('reg_err4'); //'Member with this email address already exists';
        } elseif ($lower13)
        {
            $res['errs'][] = $this->mSmarty->get_config_vars('reg_err5'); //'You must be at least 13 years old to register';
        }

        //$pa = array('password', '123456', '12345678', 'test', 'qwerty', 'zxcvbn', 'asdfgh');
        if (empty($pass))
        {
            $res['errs'][] = $this->mSmarty->get_config_vars('reg_err6'); //'Please enter password';
        } elseif (strlen($pass) < 5 /* || in_array($pass, $pa) */)
        {
            $res['errs'][] = $this->mSmarty->get_config_vars('reg_err7'); //'Minimum password length is 6 characters';
        }


        if (!empty($res['errs']))
        {
            $q = 'err';
        } else
        {

            $login = $email;
            $fm = array('login' => $login, 'pass' => $pass, 'first_name' => $fname, 'last_name' => $lname,
                'email' => $email, 'gender' => $gender, 'status' => 2, 'modules' => '', 'dob' => $byear . '-' . $bmonth . '-' . $bday, 'last_show' => mktime());

            $uid = $this->mUser->Add($fm);

            $_POST['system_login'] = $login;
            $_POST['system_pass'] = $pass;
            $this->CheckAuth();

            /**
             * Send email about registration && wait
             */
            /*
              //TODO: это убираем временно
              $code = $this->mUser->GetRegistrationCode($uid);
              $this->mSmarty->assign('code', $code);
              // Send email
              $this->mSmarty->assign('SUPPORT_SITENAME', SUPPORT_SITENAME);
              $this->mSmarty->assign('DOMEN', DOMEN);

              include 'Ctrl/Mail/Phpmailer_v5.1/class.phpmailer.php';
              $gMail = new PHPMailer();
              $gMail->From = 'verify@' . DOMEN;
              $gMail->FromName = 'inZion.com';
              $gMail->AddAddress($fm['email'], '');
              $gMail->WordWrap = 50;
              $gMail->IsHTML(true);

              $this->mSmarty->assign('fm', $fm);
              $gMail->Subject = $this -> mSmarty -> get_config_vars('reg_subj'); //'inZion Verification';
              $gMail->Body = $this->mSmarty->fetch('mails/approved.html');
              $gMail->Send();
             */

            //TODO: Временно добавляем фоловинг ID=1
            if ($uid != 1)
            {
                $this->mUser->EditSubscr($uid, 1, 1);
                /**
                 * Плюс добавляем отправку сообщения
                 **/
                require_once 'Model/Profile/Wall.class.php';
                $moWall = new Model_Profile_Wall($this->mDb);

                //при смене текста не забыть о таком-же блоке ниже 
                $mesg = 'Welcome ' . strip_tags($fname) . '! If you have questions about the site or its many features, check out our <a href="/base/index/faq">FAQ</a>. Invite your friends, family and ward members to join. To interact with members from your Ward or Stake through our Ward Feed, select your Ward/Stake in the Church Related Info section of My Info. You will be notified when members from your Ward or stake join the site!';
                $moWall->SendPrivateMessage(1, $uid, $mesg);
            }

            $_SESSION['approve_email'] = $fm['email'];
            $q = 'ok';
        }

        header("Content-type: text/plain");
        $res['q'] = $q;

        include_once 'Ctrl/Ajax/Json.php';
        $mJson = new Services_JSON();
        echo $mJson->encode($res);
        exit();
    }

    public function Ajaxlogin()
    {
        if (empty($this->mSystemLogin))
        {
            $q = 'err';
        } else
        {
            $q = 'ok';
        }

        header("Content-type: text/plain");
        $res['resu'] = !empty($_SESSION['check_auth']) ? $_SESSION['check_auth'] : 0;
        $res['q'] = $q;

        include_once 'Ctrl/Ajax/Json.php';
        $mJson = new Services_JSON();
        echo $mJson->encode($res);
        exit();
    }

    /**
     * Ajax FaceBook login
     * @return void
     */
    public function FbAuth()
    {
        $res = array('q' => 'err');

        if (!empty($_SERVER['HTTP_REFERER'])
            /*    && 1 == strpos($_SERVER['HTTP_REFERER'], 'http://' . DOMEN) */
        )
        {

            $id = _v('id', 0);
            $email = _v('email', '');
            if ($id)
            {
                $ui = $this->mUser->GetByFbId($id);

                if (empty($ui) && !empty($email))
                {
                    /**
                     * email существует - но аккаунт не привязан
                     */
                    $ui = $this->mUser->GetByEmailFull($email);
                    if (!empty($ui))
                    {
                        //привязываем email
                        $this->mUser->UpdValues($ui['uid'], array('fb_id' => $id));
                    }
                }

                if (!empty($ui))
                {
                    //login
                    $pass = $ui['pass'];
                    $pass = hex2bin($pass);
                    $this->mRc4->decrypt($pass);

                    $_POST['system_login'] = $ui['email'];
                    $_POST['system_pass'] = $pass;
                    $this->CheckAuth();
                    $res['q'] = 'ok';
                    $res['id'] = $ui['uid'];
                }
                else
                {
                    //create account
                    if (empty($email) || !verify_email($email))
                    {
                        $email = $id . '@inzion.com';
                    }
                    $first_name = strip_tags(_v('fname', ''));
                    $last_name = strip_tags(_v('lname', ''));

                    $gender = _v('gender', '');
                    $gender = ($gender == 'female' || $gender == 'женский') ? 2 : 1;
                    $birthday = _v('birthday', '');

                    if (!empty($birthday))
                    {
                        $bd = explode('/', $birthday);
                        if (count($bd) == 3)
                        {
                            $dob = '';
                            $dob .= (!empty($bd[2]) && is_numeric($bd[2]) && $bd[2] >= date("Y") - 99 && $bd[2] <= date("Y")) ? $bd[2] : '0000';
                            $dob .= (!empty($bd[1]) && is_numeric($bd[1]) && $bd[1] >= 1 && $bd[1] <= 12) ? '-' . $bd[1] : '-' . '00';
                            $dob .= (!empty($bd[0]) && is_numeric($bd[0]) && $bd[0] >= 1 && $bd[0] <= 31) ? '-' . $bd[0] : '-' . '00';
                        }
                    }

                    if (empty($dob))
                    {
                        $dob = '0000-00-00';
                    }

                    $pass = md5($email);
                    $fm = array(
                        'login' => $email,
                        'pass' => $pass,
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'email' => $email,
                        'gender' => $gender,
                        'status' => 2,
                        'modules' => '',
                        'dob' => $dob);

                    $uid = $this->mUser->Add($fm);

                    //send first message
                    //при смене текста не забыть о таком-же блоке выше
                    $mesg = 'Welcome ' . strip_tags($first_name) . '! If you have questions about the site or its many features, check out our <a href="/base/index/faq">FAQ</a>. Invite your friends, family and ward members to join. To interact with members from your Ward or Stake through our Ward Feed, select your Ward/Stake in the Church Related Info section of My Info. You will be notified when members from your Ward or stake join the site!';
                    $moWall->SendPrivateMessage(1, $uid, $mesg);

                    $_POST['system_login'] = $email;
                    $_POST['system_pass'] = $pass;
                    $this->CheckAuth();

                    $res['q'] = 'ok';
                    $res['id'] = $uid;
                }
            }
        }

        include_once 'Ctrl/Ajax/Json.php';
        $mJson = new Services_JSON();
        echo $mJson->encode($res);
        exit();
    }

    public function AjaxSettings()
    {
        if (empty($this->mSystemLogin))
        {
            exit();
        }

        $act = _v('act', '');
        $res = array();
        $q = 'ok';
        $weekly = _v('week','');
        /** Init some info for basic */
        $this->_InitConst();
        /** do some action */
        switch ($act)
        {
            /** get basic settings form */
            case 'basic':
                $dd = array();
                for ($i = 1; $i <= 31; $i++)
                {
                    $dd[] = $i;
                }
                $mm = array(1 => 'Jan',
                    2 => 'Feb',
                    3 => 'Mar',
                    4 => 'Apr',
                    5 => 'May',
                    6 => 'Jun',
                    7 => 'Jul',
                    8 => 'Aug',
                    9 => 'Sep',
                    10 => 'Oct',
                    11 => 'Nov',
                    12 => 'Dec');
                $yy = array();
                for ($i = date("Y"); $i >= date("Y") - 99; $i--)
                {
                    $yy[] = $i;
                }
                $this->mSmarty->assign_by_ref('mm', $mm);
                $this->mSmarty->assign_by_ref('dd', $dd);
                $this->mSmarty->assign_by_ref('yy', $yy);

                $this->mSmarty->assign_by_ref('relations', $this->mRelations);
                $this->mSmarty->assign_by_ref('rel_statuses', $this->mRelStatuses);
                //$this->mSmarty->assign_by_ref('spoken_langs', $this -> mUinfo['langs']);
                $this->mSmarty->assign_by_ref('ulangs', $this->mUinfo['langs']);

                $pa = array('gender', 'was_born', 'live_in', 'no_dob', 'rel_status');
                foreach ($pa as &$v)
                {
                    $fm[$v] = $this->mUinfo[$v];
                }
                $fm['byear'] = substr($this->mUinfo['dob'], 0, 4);
                $fm['bmonth'] = substr($this->mUinfo['dob'], 5, 2);
                $fm['bday'] = substr($this->mUinfo['dob'], 8, 2);

                $fam = $this->mProfile->GetFamilyList($this->mUinfo['uid']);

                foreach ($fam as &$v)
                {
                    $fm['relation'][] = $v['rel_status'];
                    $fm['relation_name'][] = $v['name'];
                    $fm['relation_id'][] = $v['wuid'];
                }

                $fm['spoken_lang'] = $this->mProfile->GetLangList($this->mUinfo['uid']);


                /** prepare spoken langs array */
                $lng_cnt = !empty($fm['spoken_lang']) ? count($fm['spoken_lang']) : 1;
                for ($i = 0; $i < $lng_cnt; $i++)
                {
                    $spoken_lang[] = $i;
                }
                $this->mSmarty->assign('spoken_lang', $spoken_lang);


                /** prepare raltion array */
                $rel_cnt = !empty($fm['relation']) ? count($fm['relation']) : 1;
                $relation = array();
                for ($i = 0; $i < $rel_cnt; $i++)
                {
                    $relation[] = $i;
                }
                $this->mSmarty->assign('relation', $relation);


                $this->mSmarty->assign_by_ref('fm', $fm);

                $res['form'] = $this->mSmarty->Fetch('mods/users/ajax/_edit_basic.html');
                break;

            /** save basic information */
            case 'basic_save':
                if (!empty($_POST['fm']))
                {
                    $fm = $_POST['fm'];

                    $gender = _va($fm, 'gender', 0);
                    $gender = ($gender < 1 || $gender > 2) ? 0 : $gender;

                    $dob = '';
                    $dob .= (!empty($fm['byear']) && is_numeric($fm['byear']) && $fm['byear'] >= date("Y") - 99 && $fm['byear'] <= date("Y")) ? $fm['byear'] : '0000';
                    $dob .= (!empty($fm['bmonth']) && is_numeric($fm['bmonth']) && $fm['bmonth'] >= 1 && $fm['bmonth'] <= 12) ? '-' . $fm['bmonth'] : '-' . '00';
                    $dob .= (!empty($fm['bday']) && is_numeric($fm['bday']) && $fm['bday'] >= 1 && $fm['bday'] <= 31) ? '-' . $fm['bday'] : '-' . '00';

                    $no_dob = _va($fm, 'no_dob', 0);
                    $no_dob = 1 != $no_dob ? 0 : 1;

                    $dob_a = explode('-', $dob);
                    if (
                        $dob_a[0] != '0000' && $dob_a[1] != '00' && $dob_a[2] != '00'
                        && mktime(0, 0, 0, $dob_a[1], $dob_a[2], $dob_a[0]) >= mktime(0, 0, 0, date("m"), date("d"), date("Y") - 13)
                    )
                    {
                        echo 'error_dob';
                        exit();
                    }


                    $was_born = strip_tags(_va($fm, 'was_born', ''));
                    $live_in = strip_tags(_va($fm, 'live_in', ''));

                    $rel_status = _va($fm, 'rel_status', 0);
                    $rel_status = isset($this->mRelStatuses[$rel_status]) ? $rel_status : 0;

                    $this->mProfile->ClearFamily($this->mUinfo['uid']);
                    $this->mProfile->ClearLang($this->mUinfo['uid']);

                    $slang = !empty($fm['spoken_lang']) ? $fm['spoken_lang'] : '';
                    $slang = preg_replace('|^[^a-z0-9_-]+$|i', '', $slang);

                    if (!empty($fm['relation']) && !empty($fm['relation_name']) && !empty($fm['relation_id']))
                    {
                        foreach ($fm['relation'] as $k => &$v)
                        {
                            if ($v && isset($this->mRelations[$v]) && !empty($fm['relation_name'][$k]))
                            {
                                $fm['relation_name'][$k] = trim(strip_tags($fm['relation_name'][$k]));
                                if ($fm['relation_name'][$k] && $fm['relation_id'][$k])
                                {
                                    $this->mProfile->EditFamily($this->mUinfo['uid'], $v, $fm['relation_name'][$k], $fm['relation_id'][$k]);
                                }
                            }
                        }
                        //clear family cache
                        $this->moCache->delete('user_' . UID . '_family');
                    }

                    $ar = array(
                        'gender' => $gender,
                        'dob' => $dob,
                        'was_born' => $was_born,
                        'live_in' => $live_in,
                        'no_dob' => $no_dob,
                        'rel_status' => $rel_status,
                        'langs' => $slang
                    );
                    $this->mUser->UpdValues($this->mUinfo['uid'], $ar);

                    /** return result form */
                    $this->mUi = $this->moUser->mUser->Get($this->mUinfo['uid']);
                    $this->mUi['langs'] = $this->mProfile->GetLangList($this->mUi['uid']);
                    $this->mUi['fam'] = $this->mProfile->GetFamilyList($this->mUinfo['uid']);

                    $this->mSmarty->assign_by_ref('spoken_langs', $this->mLangs);
                    $this->mSmarty->assign_by_ref('relations', $this->mRelations);
                    $this->mSmarty->assign_by_ref('rel_statuses', $this->mRelStatuses);

                    $res['form'] = $this->mSmarty->Fetch('mods/users/ajax/_show_basic.html');

                    header("Content-type: text/plain");
                    echo $res['form'];
                    exit();
                }

                break;

            /** cancel basic edit */
            case 'basic_cancel':

                /** return result form */
                $this->mUi['langs'] = $this->mProfile->GetLangList($this->mUi['uid']);
                $this->mUi['fam'] = $this->mProfile->GetFamilyList($this->mUinfo['uid']);

                $this->mSmarty->assign_by_ref('spoken_langs', $this->mLangs);
                $this->mSmarty->assign_by_ref('relations', $this->mRelations);
                $this->mSmarty->assign_by_ref('rel_statuses', $this->mRelStatuses);

                $res['form'] = $this->mSmarty->Fetch('mods/users/ajax/_show_basic.html');
                break;


            /** get contacts settings form */
            case 'contacts':
                $fm = array();

                $pa = array('first_name', 'last_name', 'email', 'mob_phone', 'land_phone', 'address', 'city', 'zip', 'country', 'state');
                foreach ($pa as &$v)
                {
                    $fm[$v] = $this->mUinfo[$v];
                }
                $fm_im = $this->mProfile->GetImList($this->mUinfo['uid']);

                foreach ($fm_im as &$v)
                {
                    $fm['im_type'][] = $v['im_type'];
                    $fm['im_name'][] = $v['im_name'];
                }

                /** prepare IM array */
                $im_cnt = !empty($fm['im_type']) ? count($fm['im_type']) : 1;
                $im = array();
                for ($i = 0; $i < $im_cnt; $i++)
                {
                    $im[] = $i;
                }
                $this->mSmarty->assign('im', $im);


                $this->mSmarty->assign_by_ref('fm', $fm);
                $this->mSmarty->assign_by_ref('ims', $this->mIm);
                $this->mSmarty->assign_by_ref('countries', $GLOBALS['cntrs']);
                $res['form'] = $this->mSmarty->Fetch('mods/users/ajax/_edit_contacts.html');
                break;

            /** contacts save info */
            case 'contacts_save':

                if (!empty($_POST['fm']))
                {
                    $fm = $_POST['fm'];

                    $was_born = strip_tags(_va($fm, 'was_born', ''));
                    $live_in = strip_tags(_va($fm, 'live_in', ''));


                    $ar = array(
                        'mob_phone' => strip_tags(_va($fm, 'mob_phone', '')),
                        'land_phone' => strip_tags(_va($fm, 'land_phone', '')),
                        'address' => strip_tags(_va($fm, 'address', '')),
                        'city' => strip_tags(_va($fm, 'city', '')),
                        'state' => strip_tags(_va($fm, 'state', '')),
                        'zip' => strip_tags(_va($fm, 'zip', '')),
                        'country' => strip_tags(_va($fm, 'country', ''))
                    );

                    if (!empty($fm['edit_name']))
                    {
                        $first_name = trim(strip_tags(_va($fm, 'first_name', '')));
                        $last_name = trim(strip_tags(_va($fm, 'last_name', '')));
                        if ($first_name && $last_name)
                        {
                            $ar['first_name'] = $first_name;
                            $ar['last_name'] = $last_name;
                        }
                    }

                    if (!empty($fm['edit_email']))
                    {
                        $email = trim(strip_tags(_va($fm, 'email', '')));
                        if (verify_email($email))
                        {
                            if (!$this->mUser->CheckEmail($email))
                            {
                                $ar['email'] = $email;
                                $ar['public_name'] = $email;
                            }
                        } else
                        {
                            $fm['edit_email'] = 0;
                        }
                    }

                    /** Edit IM list */
                    $this->mProfile->ClearIm($this->mUinfo['uid']);

                    if (!empty($fm['im_name']) && !empty($fm['im_type']))
                    {
                        foreach ($fm['im_type'] as $k => &$v)
                        {
                            if ($v && isset($this->mIm[$v]) && !empty($fm['im_name'][$k]))
                            {
                                $fm['im_name'][$k] = trim(strip_tags($fm['im_name'][$k]));
                                if ($fm['im_name'][$k])
                                {
                                    $this->mProfile->EditIm($this->mUinfo['uid'], $v, $fm['im_name'][$k]);
                                }
                            }
                        }
                    }

                    /** Update values */
                    $this->mUser->UpdValues($this->mUinfo['uid'], $ar);

                    if (!empty($fm['edit_email']))
                    {
                        $pass = $this->mUinfo['pass'];
                        $pass = hex2bin($pass);
                        $this->mRc4->decrypt($pass);

                        $_POST['system_login'] = $email;
                        $_POST['system_pass'] = $pass;
                        $this->mUser->Logout();
                        $this->CheckAuth();
                    }
                }

                $this->mUi = $this->moUser->mUser->Get($this->mUinfo['uid']);
                $this->mSmarty->assign_by_ref('ims', $this->mIm);
                $this->mUi['im'] = $this->mProfile->GetImList($this->mUi['uid']);
                $this->mSmarty->assign_by_ref('countries', $GLOBALS['cntrs']);
                $res['form'] = $this->mSmarty->Fetch('mods/users/ajax/_show_contacts.html');

                header("Content-type: text/plain");
                echo $res['form'];
                exit();
                break;

            /** contacts cancel */
            case 'contacts_cancel':
                $this->mSmarty->assign_by_ref('ims', $this->mIm);
                $this->mSmarty->assign_by_ref('countries', $GLOBALS['cntrs']);
                $this->mUi['im'] = $this->mProfile->GetImList($this->mUi['uid']);
                $res['form'] = $this->mSmarty->Fetch('mods/users/ajax/_show_contacts.html');
                break;

            /** delete class */
            case 'class_delete':
                $ucid = _v('ucid', 0);
                if ($ucid)
                {
                    $this->mProfile->DelUserSchoolClass($ucid, $this->mUi['uid']);
                    echo 'ok';
                } else
                {
                    echo 'not_success';
                }
                exit;
                break;

            /** delete mission */
            case 'mission_delete':
                $umid = _v('umid', 0);
                if ($umid)
                {
                    $this->mProfile->DelMission($this->mUi['uid'], $umid);
                    echo 'ok';
                } else
                {
                    echo 'not_success';
                }
                exit;
                break;

            /** get church edit form */
            case 'church':
                $dd = array();
                for ($i = 1; $i <= 31; $i++)
                {
                    $dd[] = $i;
                }
                $mm = array(1 => 'Jan',
                    2 => 'Feb',
                    3 => 'Mar',
                    4 => 'Apr',
                    5 => 'May',
                    6 => 'Jun',
                    7 => 'Jul',
                    8 => 'Aug',
                    9 => 'Sep',
                    10 => 'Oct',
                    11 => 'Nov',
                    12 => 'Dec');
                $yy = array();
                for ($i = date("Y"); $i >= date("Y") - 99; $i--)
                {
                    $yy[] = $i;
                }
                $this->mSmarty->assign_by_ref('mm', $mm);
                $this->mSmarty->assign_by_ref('dd', $dd);
                $this->mSmarty->assign_by_ref('yy', $yy);

                $fm = array();
                $pa = array('ward', 'stake', 'ward_id', 'stake_id');
                foreach ($pa as &$v)
                {
                    $fm[$v] = $this->mUinfo[$v];
                }

                if (!empty($this->mUinfo['baptism_date']) && '0000-00-00' != $this->mUinfo['baptism_date'])
                {
                    $fm['byear'] = substr($this->mUinfo['baptism_date'], 0, 4);
                    $fm['bmonth'] = substr($this->mUinfo['baptism_date'], 5, 2);
                    $fm['bday'] = substr($this->mUinfo['baptism_date'], 8, 2);
                }

                $fm_mission = $this->mProfile->GetMissionList($this->mUinfo['uid']);
                foreach ($fm_mission as &$v)
                {
                    $fm['mission_location'][] = $v['location'];
                    $fm['user_mission_id'][] = $v['id'];

                    $fm['fyear'][] = substr($v['fdate'], 0, 4);
                    $fm['fmonth'][] = substr($v['fdate'], 5, 2);
                    $fm['fday'][] = substr($v['fdate'], 8, 2);
                    $fm['tyear'][] = substr($v['tdate'], 0, 4);
                    $fm['tmonth'][] = substr($v['tdate'], 5, 2);
                    $fm['tday'][] = substr($v['tdate'], 8, 2);
                }

                $fm_class = $this->mProfile->GetSchoolClassList($this->mUinfo['uid'], $this->mUinfo['ward_id']);
                foreach ($fm_class as &$v)
                {
                    $fm['class_title'][] = $v['title'];
                    $fm['user_class_id'][] = $v['id'];
                }

                $fm_calling = $this->mProfile->GetCallingList($this->mUinfo['uid']);

                foreach ($fm_calling as &$v)
                {
                    $fm['calling'][] = $v['calling'];
                    $fm['calling_comment'][] = $v['comment'];
                }

                // prepare calling array
                $mission_cnt = !empty($fm['mission_location']) ? count($fm['mission_location']) : 1;
                $mission = array();
                for ($i = 0; $i < $mission_cnt; $i++)
                {
                    $mission[] = $i;
                }
                $this->mSmarty->assign('mission', $mission);

                // prepare calling array

                $class_cnt = !empty($fm['class_title']) ? count($fm['class_title']) : 1;
                $class = array();
                for ($i = 0; $i < $class_cnt; $i++)
                {
                    $class[] = $i;
                }
                $this->mSmarty->assign('class', $class);

                // prepare Calling array
                $calling_cnt = !empty($fm['calling']) ? count($fm['calling']) : 1;
                $calling = array();
                for ($i = 0; $i < $calling_cnt; $i++)
                {
                    $calling[] = $i;
                }
                $this->mSmarty->assign('calling', $calling);

                //-- set a priesthood info
                if (1 == $this->mUinfo['gender'])
                    $fm['priesthood_list'] = array(0 => 'No', 1 => 'Aaronic Priesthood', 2 => 'Aaronic Priesthood (Young Men)', /* 3 => 'Priesthood Holders', */
                        4 => 'Melchizedek Priesthood', 7 => 'High Priest');
                else
                    $fm['priesthood_list'] = array(0 => 'No', 11 => 'Relief Society', 12 => 'Young Women');

                if ($this->mUinfo['priesthood'])
                {
                    $fm['priesthood'] = $this->mUinfo['priesthood'];
                }


                $this->mSmarty->assign_by_ref('fm', $fm);

                //$this -> mSmarty -> assign_by_ref('ims', $this -> mIm );
                $res['form'] = $this->mSmarty->Fetch('mods/users/ajax/_edit_church.html');
                break;

            /*choose ward*/
            case 'ward':
                $fm = array();
                $pa = array('ward', 'stake', 'ward_id', 'stake_id');
                foreach ($pa as &$v)
                {
                    $fm[$v] = $this->mUinfo[$v];
                }
                $ar['last_show'] = mktime();
                $this->mUser->UpdValues($this->mUinfo['uid'], $ar);

                $this->mSmarty->assign_by_ref('fm', $fm);
                $res['form'] = $this->mSmarty->Fetch('mods/users/ajax/_edit_ward.html');
                break;

                /** save church info */
            case 'church_save':
                if (!empty($_POST['fm']))
                {
                    $fm = $_POST['fm'];


                    $bd = (!empty($fm['byear']) && is_numeric($fm['byear']) && $fm['byear'] >= date("Y") - 99 && $fm['byear'] <= date("Y")) ? $fm['byear'] : '0000';
                    $bd .= (!empty($fm['bmonth']) && is_numeric($fm['bmonth']) && $fm['bmonth'] >= 1 && $fm['bmonth'] <= 12) ? '-' . $fm['bmonth'] : '-' . '00';
                    $bd .= (!empty($fm['bday']) && is_numeric($fm['bday']) && $fm['bday'] >= 1 && $fm['bday'] <= 31) ? '-' . $fm['bday'] : '-' . '00';

                    $ward = strip_tags(_va($fm, 'ward', ''));
                    $ward_id = _va($fm, 'ward_id', 0);

                    $priesthood = _va($fm, 'priesthood', 0);

                    include_once 'Model/Base/Ward.class.php';
                    $gWard = new Model_Base_Ward($this->mDb);

                    $ar = array(
                        'baptism_date' => $bd,
                        'priesthood' => $priesthood
                    );

                    if ($ward_id)
                    {
                        $ward = $gWard->Get($ward_id);
                        if (!empty($ward) && $ward['id_parent'] > 0)
                        {

                            $stake = $gWard->Get($ward['id_parent']);

                            if (!empty($stake))
                            {
                                $stake_full = $stake['title'] . ', ' . $stake['city'] . ($stake['region'] ? ', ' . $stake['region'] : '') . ', ' . $stake['country'];
                                $ward_full = $ward['title'] . ', ' . $ward['city'] . ($ward['region'] ? ', ' . $ward['region'] : '') . ', ' . $ward['country'];
                                $ar['stake'] = $stake_full;
                                $ar['ward'] = $ward_full;
                                $ar['stake_id'] = $ward['id_parent'];
                                $ar['ward_id'] = $ward_id;
                            }
                        }
                    } else
                    {
                        $ward_id = $stake_id = 0;
                        $ward = '';
                        $stake = '';
                    }


                    /** Update values */
                    $this->mUser->UpdValues($this->mUinfo['uid'], $ar);

                    /** Edit Mission list */
                    if (!empty($fm['class_title']))
                    {
                        foreach ($fm['class_title'] as $k => &$v)
                        {
                            $v = trim(strip_tags($v));
                            $ucid = !empty($fm['user_class_id'][$k]) ? (int) $fm['user_class_id'][$k] : 0;
                            $wid = (int) $fm['ward_id'];

                            if ($v && $wid)
                            {
                                $class_id = $this->mProfile->GetSchoolClassByName($v, $wid);

                                if (!$class_id)
                                {
                                    $class_id = $this->mProfile->EditSchoolClass($v, $wid);
                                }

                                if ($class_id && 1 == $this->mProfile->EditUserSchoolClass($class_id, $ucid, UID))
                                {
                                    //notification
                                    //$this -> mlObj['notify'] -> AddENentry(UID, 0, 6, array('mid' => $mission_id));
                                }
                            }
                        }
                    }

                    if (!empty($fm['mission_location']))
                    {
                        foreach ($fm['mission_location'] as $k => &$v)
                        {
                            $v = trim(strip_tags($v));

                            $umid = !empty($fm['user_mission_id'][$k]) ? (int) $fm['user_mission_id'][$k] : 0;
                            /** check mission city */
                            $cc = explode(', ', $v);

                            if (3 == count($cc))
                            {
                                $cc = $this->mlObj['geo']->CheckCity(trim($cc[0]), trim($cc[2]), trim($cc[1]));
                            } elseif (2 == count($cc))
                            {
                                $cc = $this->mlObj['geo']->CheckCity(trim($cc[0]), trim($cc[1]));
                            } elseif (4 == count($cc) || 1 == count($cc))
                            {
                                $cc = $this->mlObj['geo']->CheckCity(trim($cc[0]));
                            }

                            include_once 'Model/Base/Mission.class.php';
                            $gMission = new Model_Base_Mission($this->mDb);
                            $mission_id = 0;
                            if (!empty($cc) && $v)
                            {
                                if (empty($mission_id))
                                {
                                    $mission_id = $gMission->GetMissionByLocation($cc[0]['name'], !empty($cc[0]['country_name']) ? $cc[0]['country_name'] : '', !empty($cc[0]['region_name']) ? $cc[0]['region_name'] : '');
                                }

                                if (empty($mission_id))
                                {
                                    /** create new mission */
                                    $wt = $cc[0]['name']; // . (!empty($cc[0]['region_name']) ? ', ' . $cc[0]['region_name'] : '') . ', ' . $cc[0]['country_name'];
                                    $mission_id = $gMission->Edit($wt, $cc[0]['name'], $cc[0]['country_name'], !empty($cc[0]['region_name']) ? $cc[0]['region_name'] : '');
                                }
                            } elseif ($v)
                            {
                                $mission_id = $gMission->GetMissionByTitle($v);
                                if (empty($mission_id))
                                {
                                    $mission_id = $gMission->Edit($v, '', '', '');
                                }
                            }


                            if (!empty($fm['fday'][$k]) && (int) $fm['fday'][$k] >= 1 && (int) $fm['fday'][$k] <= 31 &&
                                    !empty($fm['fmonth'][$k]) && (int) $fm['fmonth'][$k] >= 1 && (int) $fm['fmonth'][$k] <= 12 &&
                                    !empty($fm['fyear'][$k]) && (int) $fm['fyear'][$k] >= ((int) date("Y") - 99) && (int) $fm['fyear'][$k] <= (int) date("Y"))
                                $df = $fm['fyear'][$k] . '-' . $fm['fmonth'][$k] . '-' . $fm['fday'][$k];
                            else
                                $df = '0000-00-00';

                            if (!empty($fm['tday'][$k]) && (int) $fm['tday'][$k] >= 1 && (int) $fm['tday'][$k] <= 31 &&
                                    !empty($fm['tmonth'][$k]) && (int) $fm['tmonth'][$k] >= 1 && (int) $fm['tmonth'][$k] <= 12 &&
                                    !empty($fm['tyear'][$k]) && (int) $fm['tyear'][$k] >= ((int) date("Y") - 99) && (int) $fm['tyear'][$k] <= (int) date("Y"))
                                $dt = $fm['tyear'][$k] . '-' . $fm['tmonth'][$k] . '-' . $fm['tday'][$k];
                            else
                                $dt = '0000-00-00';


                            if ($v && !empty($cc)) // && $df != '0000-00-00' && $dt != '0000-00-00'
                            {
                                if (1 == $this->mProfile->EditMission(UID, $df, $dt, $v, $mission_id, $umid) && $mission_id)
                                {
                                    //notification
                                    $this->mlObj['notify']->AddENentry(UID, 0, 6, array('mid' => $mission_id));
                                }
                            } elseif ($v)
                            {
                                if (1 == $this->mProfile->EditMission(UID, $df, $dt, $v, $mission_id, $umid) && $mission_id)
                                {
                                    //notification
                                    $this->mlObj['notify']->AddENentry(UID, 0, 6, array('mid' => $mission_id));
                                }
                            }
                        }
                    }
                    /** Edit Calling list */
                    $this->mProfile->ClearCalling($this->mUinfo['uid']);

                    if (!empty($fm['calling']))
                    {
                        foreach ($fm['calling'] as $k => &$v)
                        {
                            $v = trim(strip_tags($v));
                            if ($v)
                            {
                                $vc = !empty($fm['calling_comment'][$k]) ? trim(strip_tags($fm['calling_comment'][$k])) : '';
                                $this->mProfile->EditCalling($this->mUinfo['uid'], $v, $vc);
                            }
                        }
                    }

                    if (!empty($fm['edit_email']))
                    {
                        $pass = $this->mUinfo['pass'];
                        $pass = hex2bin($pass);
                        $this->mRc4->decrypt($pass);

                        $_POST['system_login'] = $email;
                        $_POST['system_pass'] = $pass;
                        $this->mUser->Logout();
                        $this->CheckAuth();
                    }
                }

                $this->mUi = $this->moUser->mUser->Get($this->mUinfo['uid']);
                $this->mUi['mission'] = $this->mProfile->GetMissionList($this->mUi['uid']);
                $this->mUi['calling'] = $this->mProfile->GetCallingList($this->mUi['uid']);

                if (1 == $this->mUi['gender'])
                    $phl = array(0 => 'No', 1 => 'Aaronic Priesthood', 2 => 'Aaronic Priesthood (Young Men)', /* 3 => 'Priesthood Holders', */
                        4 => 'Melchizedek Priesthood', 7 => 'High Priest');
                else
                    $phl = array(0 => 'No', 11 => 'Relief Society', 12 => 'Young Women');
                $this->mSmarty->assign_by_ref('phl', $phl);

                if (!empty($weekly))
                    $res['form'] = 'Your information was succefully saved.';
                else
                    $res['form'] = $this->mSmarty->Fetch('mods/users/ajax/_show_church.html');

                header("Content-type: text/plain");
                echo $res['form'];
                exit();
                break;

            /** cancel edit church info */
            case 'church_cancel':

                $this->mUi = $this->moUser->mUser->Get($this->mUinfo['uid']);
                $this->mUi['mission'] = $this->mProfile->GetMissionList($this->mUi['uid']);
                $this->mUi['calling'] = $this->mProfile->GetCallingList($this->mUi['uid']);
                $res['form'] = $this->mSmarty->Fetch('mods/users/ajax/_show_church.html');
                break;


            /** get interest edit form */
            case 'interest':
                $fm = array();

                /** get list */
                $il = $this->mProfile->GetInterestList($this->mUinfo['uid']);
                $fm['interests_list'] = array();
                $fm['interests'] = array();
                $fm['interests_story'] = array();
                foreach ($il as $v)
                {
                    if ($v['num'])
                    {
                        $fm['interests_list'][$v['num']] = $v;
                    } else
                    {
                        $fm['interests'][] = $v['title'];
                        $fm['interests_story'][] = $v['story'];
                    }
                }
                unset($il);

                $interests_cnt = !empty($fm['interests']) ? count($fm['interests']) : 1;
                $interests = array();
                for ($i = 0; $i < $interests_cnt; $i++)
                {
                    $interests[] = $i;
                }

                $this->mSmarty->assign('interests', $interests);

                $this->mSmarty->assign_by_ref('interests_list', $this->mInterests);
                $this->mSmarty->assign_by_ref('fm', $fm);
                $res['form'] = $this->mSmarty->Fetch('mods/users/ajax/_edit_interest.html');
                break;

            /** save interest info */
            case 'interest_save':

                if (!empty($_POST['fm']))
                {
                    $fm = $_POST['fm'];
                    $this->mProfile->ClearInterest($this->mUinfo['uid']);
                    if (!empty($fm['interests_list']))
                    {
                        foreach ($fm['interests_list'] as $k => &$v)
                        {
                            $v = trim(strip_tags($v));
                            if (!empty($this->mInterests[$k]) && $v)
                            {
                                $this->mProfile->EditInterest($this->mUinfo['uid'], $k, $this->mInterests[$k], $v);
                            }
                        }
                    }

                    if (!empty($fm['interests']) && !empty($fm['interests_story']))
                    {
                        foreach ($fm['interests'] as $k => &$v)
                        {
                            $v = trim(strip_tags($v));
                            $v2 = !empty($fm['interests_story'][$k]) ? trim(strip_tags($fm['interests_story'][$k])) : '';
                            if ($v && $v2)
                            {
                                $this->mProfile->EditInterest($this->mUinfo['uid'], 0, $v, $v2);
                            }
                        }
                    }
                }
                //$this -> mUi = $this ->  moUser -> mUser -> Get($this -> mUinfo['uid']);
                $this->mUi['interests'] = $this->mProfile->GetInterestList($this->mUinfo['uid']);
                $res['form'] = $this->mSmarty->Fetch('mods/users/ajax/_show_interest.html');

                header("Content-type: text/plain");
                echo $res['form'];
                exit();
                break;

            /** cancel edit interest info */
            case 'interest_cancel':
                $this->mUi['interests'] = $this->mProfile->GetInterestList($this->mUinfo['uid']);
                $res['form'] = $this->mSmarty->Fetch('mods/users/ajax/_show_interest.html');
                break;


            /** get education edit form */
            case 'edu':
                $fm = array();
                $ul = $this->mProfile->GetUniversityList($this->mUinfo['uid']);
                $fm['universities'] = array();
                $fm['cyear'] = array();
                $fm['cyear2'] = array();
                $fm['major'] = array();
                $fm['minor'] = array();
                foreach ($ul as $v)
                {
                    $fm['university'][] = $v['university'];
                    $fm['cyear'][] = $v['cyear'];
                    $fm['cyear2'][] = $v['cyear2'];
                    $fm['major'][] = $v['major'];
                    $fm['minor'][] = $v['minor'];
                }
                unset($ul);


                $ul = $this->mProfile->GetHSchoolList($this->mUinfo['uid']);
                $fm['hschool'] = array();
                $fm['hyear'] = array();
                $fm['hyear2'] = array();
                foreach ($ul as $v)
                {
                    $fm['hschool'][] = $v['hschool'];
                    $fm['hyear'][] = $v['hyear'];
                    $fm['hyear2'][] = $v['hyear2'];
                }
                unset($ul);


                $ul = $this->mProfile->GetJobList($this->mUinfo['uid']);
                $fm['employer'] = array();
                $fm['estatus'] = array();
                $fm['pos'] = array();
                $fm['descr'] = array();
                $fm['city'] = array();
                $fm['fmonth'] = array();
                $fm['fyear'] = array();
                $fm['present'] = array();
                $fm['tmonth'] = array();
                $fm['tyear'] = array();
                foreach ($ul as $v)
                {
                    $fm['employer'][] = $v['employer'];
                    $fm['estatus'][] = $v['estatus'];
                    $fm['pos'][] = $v['pos'];
                    $fm['descr'][] = $v['descr'];
                    $fm['city'][] = $v['city'];
                    $fm['fmonth'][] = $v['fmonth'];
                    $fm['fyear'][] = $v['fyear'];
                    $fm['present'][] = $v['present'];
                    $fm['tmonth'][] = $v['tmonth'];
                    $fm['tyear'][] = $v['tyear'];
                }
                unset($ul);


                $universities_cnt = !empty($fm['university']) ? count($fm['university']) : 1;
                $universities = array();
                for ($i = 0; $i < $universities_cnt; $i++)
                {
                    $universities[] = $i;
                }
                $this->mSmarty->assign_by_ref('universities', $universities);

                $hschools_cnt = !empty($fm['hschool']) ? count($fm['hschool']) : 1;
                $hschools = array();
                for ($i = 0; $i < $hschools_cnt; $i++)
                {
                    $hschools[] = $i;
                }
                $this->mSmarty->assign_by_ref('hschools', $hschools);


                $jobs_cnt = !empty($fm['employer']) ? count($fm['employer']) : 1;
                $jobs = array();
                for ($i = 0; $i < $jobs_cnt; $i++)
                {
                    $jobs[] = $i;
                }
                $this->mSmarty->assign_by_ref('jobs', $jobs);

                $mm = array(1 => 'Jan',
                    2 => 'Feb',
                    3 => 'Mar',
                    4 => 'Apr',
                    5 => 'May',
                    6 => 'Jun',
                    7 => 'Jul',
                    8 => 'Aug',
                    9 => 'Sep',
                    10 => 'Oct',
                    11 => 'Nov',
                    12 => 'Dec');
                $yy = array();
                for ($i = date("Y"); $i >= date("Y") - 99; $i--)
                {
                    $yy[] = $i;
                }
                $this->mSmarty->assign_by_ref('mm', $mm);
                $this->mSmarty->assign_by_ref('yy', $yy);

                $this->mSmarty->assign_by_ref('estatuses', $this->mEstatuses);
                $this->mSmarty->assign_by_ref('fm', $fm);
                $res['form'] = $this->mSmarty->Fetch('mods/users/ajax/_edit_edu.html');
                break;

            /** save education info */
            case 'edu_save':

                if (!empty($_POST['fm']))
                {
                    $fm = $_POST['fm'];
                    $this->mProfile->ClearUniversity($this->mUinfo['uid']);
                    if (!empty($fm['university']))
                    {
                        foreach ($fm['university'] as $k => &$v)
                        {
                            $v = trim(strip_tags($v));
                            if ($v)
                            {
                                $cyear = (!empty($fm['cyear'][$k]) && is_numeric($fm['cyear'][$k])) ? $fm['cyear'][$k] : 0;
                                $cyear2 = (!empty($fm['cyear2'][$k]) && is_numeric($fm['cyear2'][$k])) ? $fm['cyear2'][$k] : 0;
                                $major = isset($fm['major'][$k]) ? trim(strip_tags($fm['major'][$k])) : '';
                                $minor = isset($fm['minor'][$k]) ? trim(strip_tags($fm['minor'][$k])) : '';

                                if ($cyear2 <= $cyear)
                                    $cyear2 = 0;

                                $this->mProfile->EditUniversity($this->mUinfo['uid'], $v, $cyear, $cyear2, $major, $minor);
                            }
                        }
                    }


                    $this->mProfile->ClearHSchool($this->mUinfo['uid']);
                    if (!empty($fm['hschool']))
                    {
                        foreach ($fm['hschool'] as $k => &$v)
                        {
                            $v = trim(strip_tags($v));
                            if ($v)
                            {
                                $hyear = (!empty($fm['hyear'][$k]) && is_numeric($fm['hyear'][$k])) ? $fm['hyear'][$k] : 0;
                                $hyear2 = (!empty($fm['hyear2'][$k]) && is_numeric($fm['hyear2'][$k])) ? $fm['hyear2'][$k] : 0;
                                if ($hyear2 <= $hyear)
                                    $hyear2 = 0;
                                $this->mProfile->EditHSchool($this->mUinfo['uid'], $v, $hyear, $hyear2);
                            }
                        }
                    }


                    $this->mProfile->ClearJob($this->mUinfo['uid']);
                    if (!empty($fm['pos']))
                    {
                        foreach ($fm['pos'] as $k => &$v)
                        {
                            $v = trim(strip_tags($v));
                            $estatus = (isset($fm['estatus'][$k]) && !empty($this->mEstatuses[$fm['estatus'][$k]])) ? $fm['estatus'][$k] : 1;
                            $employer = !empty($fm['employer'][$k]) ? trim(strip_tags($fm['employer'][$k])) : '';
                            $descr = !empty($fm['descr'][$k]) ? trim(strip_tags($fm['descr'][$k])) : '';
                            $city = !empty($fm['city'][$k]) ? trim(strip_tags($fm['city'][$k])) : '';
                            $fmonth = !empty($fm['fmonth'][$k]) ? 1 * trim(strip_tags($fm['fmonth'][$k])) : 0;
                            $fyear = !empty($fm['fyear'][$k]) ? 1 * trim(strip_tags($fm['fyear'][$k])) : 0;
                            $present = !empty($fm['present'][$k]) ? 1 : 0;
                            $tmonth = !empty($fm['tmonth'][$k]) ? 1 * trim(strip_tags($fm['tmonth'][$k])) : 0;
                            $tyear = !empty($fm['tyear'][$k]) ? 1 * trim(strip_tags($fm['tyear'][$k])) : 0;

                            if (!empty($present))
                            {
                                $tmonth = 0;
                                $tyear = 0;
                            }

                            if ($v)
                            {
                                $this->mProfile->EditJob($this->mUinfo['uid'],
                                    $estatus, $employer, $v, $descr, $city, $fmonth, $fyear, $present, $tmonth, $tyear
                                );
                            }
                        }
                    }
                }

                $this->mSmarty->assign_by_ref('estatuses', $this->mEstatuses);

                $this->mUi = $this->moUser->mUser->Get($this->mUinfo['uid']);
                $this->mUi['university'] = $this->mProfile->GetUniversityList($this->mUinfo['uid']);
                $this->mUi['hschool'] = $this->mProfile->GetHSchoolList($this->mUinfo['uid']);
                $this->mUi['job'] = $this->mProfile->GetJobList($this->mUinfo['uid']);

                $res['form'] = $this->mSmarty->Fetch('mods/users/ajax/_show_edu.html');

                header("Content-type: text/plain");
                echo $res['form'];
                exit();
                break;

            /** cancel edit education info */
            case 'edu_cancel':

                $this->mSmarty->assign_by_ref('estatuses', $this->mEstatuses);
                $this->mUi = $this->moUser->mUser->Get($this->mUinfo['uid']);

                $this->mUi['university'] = $this->mProfile->GetUniversityList($this->mUinfo['uid']);
                $this->mUi['hschool'] = $this->mProfile->GetHSchoolList($this->mUinfo['uid']);
                $this->mUi['job'] = $this->mProfile->GetJobList($this->mUinfo['uid']);

                $res['form'] = $this->mSmarty->Fetch('mods/users/ajax/_show_edu.html');
                break;


            /** get church talks edit form */
            case 'talk':
                $fm = array();

                $this->mSmarty->assign_by_ref('fm', $fm);

                $res['form'] = $this->mSmarty->Fetch('mods/users/ajax/_edit_talk.html');
                break;

            /** save church talk info */
            case 'talk_save':


                $this->mUi = $this->moUser->mUser->Get($this->mUinfo['uid']);
                $res['form'] = $this->mSmarty->Fetch('mods/users/ajax/_show_talk.html');

                header("Content-type: text/plain");
                echo $res['form'];
                exit();
                break;

            /** cancel edit church talk info */
            case 'talk_cancel':

                $this->mUi = $this->moUser->mUser->Get($this->mUinfo['uid']);
                $res['form'] = $this->mSmarty->Fetch('mods/users/ajax/_show_talk.html');
                break;
        }
        header("Content-type: text/plain");
        $res['q'] = $q;

        include_once 'Ctrl/Ajax/Json.php';
        $mJson = new Services_JSON();
        echo $mJson->encode($res);
        exit();
    }

    /** AjaxSettings */
    public function Options()
    {
        if (empty($this->mSystemLogin))
        {
            uni_redirect('/');
        }

        //-- get tags list
        $ctags = $this->moUser->mUser->GetTags(UID_OTHER);
        $this->mSmarty->assign_by_ref('ctags', $ctags);
        $this->mSmarty->assign_by_ref('cnt_ctags', count($ctags) /* $this->moUser->mUser->GetCntTags(UID_OTHER) */);
        $this->mSmarty->assign_by_ref('ctags_fav', $this->moUser->mUser->GetOneTag(-1, UID, 2));


        $this->mSmarty->assign_by_ref('privacyArr', $this->privacyArr);
        $this->mSmarty->assign_by_ref('uinfo', $this->mUinfo);
        $this->mSmarty->assign('_content', $this->mSmarty->Fetch('mods/users/_options.html'));
    }

    public function AjaxOptions()
    {
        if (empty($this->mSystemLogin))
        {
            exit();
        }

        $act = _v('act', '');
        $res = array();
        $q = 'ok';
        $content = '';
        $errorMsg = '';
        $upd = array();

        /** Init some info for basic */
        //$this -> _InitConst();

        /** do some action */
        switch ($act)
        {
            case 'edit_name':
                $firstName = _v('first_name', '');
                $midName = _v('mid_name', '');
                $lastName = _v('last_name', '');
                $upd = array('first_name' => $firstName, 'mid_name' => $midName, 'last_name' => $lastName);
                $this->mUser->UpdValues($this->mUinfo['uid'], $upd);
                break;
            case 'edit_question':
                $sec_question = _v('sec_question', '');
                $sec_answer = _v('sec_answer', '');
                $upd = array('sec_question' => $sec_question, 'sec_answer' => $sec_answer);
                break;
            case 'edit_notify':
                $notify = _v('notify', '');
                $upd = array();
                $arrPrivacy = array('email', 'news', 'ward', 'photo', 'video', 'events');
                foreach ($arrPrivacy as $id)
                {
                    if ($id == 'email')
                    {
                        $notify[$id] = trim(strip_tags($notify[$id]));
                        if (verify_email($notify[$id]))
                        {
                            $upd['notify_' . $id] = isset($notify[$id]) ? $notify[$id] : '';
                        }
                    } else
                    {
                        $upd['notify_' . $id] = isset($notify[$id]) ? 1 : 0;
                    }
                }
                break;
            case 'edit_privacy':
                $privacy = _v('privacy', '');
                $upd = array();
                $arrPrivacy = array('news', 'basic', 'contact', 'pinfo', 'edu_work', 'photo', 'video', 'notes');
                foreach ($arrPrivacy as $id)
                {
                    $upd['privacy_' . $id] = isset($privacy[$id]) ? $privacy[$id] : 0;
                }
                break;
            case 'edit_email':
                $email = _v('email', '');
                $edit_mail = 1;
                $ar = array();

                if (!empty($email))
                {
                    $email = trim(strip_tags($email));
                    if (verify_email($email))
                    {
                        if (!$this->mUser->CheckEmail($email))
                        {
                            $ar['email'] = $email;
                            $ar['public_name'] = $email;
                        }
                    } else
                    {
                        $edit_mail = 0;
                    }
                }
                /** Update values */
                if (!empty($ar))
                {
                    $this->mUser->UpdValues($this->mUinfo['uid'], $ar);

                    $pass = $this->mUinfo['pass'];
                    $pass = hex2bin($pass);
                    $this->mRc4->decrypt($pass);

                    $_POST['system_login'] = $email;
                    $_POST['system_pass'] = $pass;
                    $this->mUser->Logout();
                    $this->CheckAuth();

                    $content = "ok";
                }
                break;
            case 'edit_pass':
                $pass = _v('pass', '');
                $passAgain = _v('pass_again', '');

                if ($pass != '' && $pass == $passAgain)
                {
                    $this->mUser->UpdatePassword($this->mUinfo['uid'], $pass);

                    $_POST['system_login'] = $this->mUinfo['email'];
                    $_POST['system_pass'] = $pass;
                    $this->mUser->Logout();
                    $this->CheckAuth();

                    $content = "ok";
                }
                break;
            case 'edit_delete':
                $this->mUser->Del($this->mUinfo['uid']);
                $this->mUser->Logout();
                $this->CheckAuth();

                $content = "ok";
                break;
        }

        if (!empty($upd) || ($act == 'edit_email' && $content == 'ok'))
        {
            if ($act != 'edit_email')
                $this->mUser->UpdValues($this->mUinfo['uid'], $upd);

            $this->mUinfo = & $this->mUser->Get($this->mUser->GetByEmail($this->mSystemLogin));
            $this->mSmarty->assign_by_ref('privacyArr', $this->privacyArr);
            $this->mSmarty->assign_by_ref('uinfo', $this->mUinfo);
            $content = $this->mSmarty->fetch('mods/users/ajax/_options_' . str_replace('edit_', 'show_', $act) . '.html');
        }

        header("Content-type: text/plain");
        $res['msg'] = $errorMsg;
        $res['q'] = $q;

        if ($errorMsg == '' && $content != '')
        {
            echo $content;
        } else
        {
            include_once 'Ctrl/Ajax/Json.php';
            $mJson = new Services_JSON();
            echo $mJson->encode($res);
        }
        exit();
    }

    public function AjaxCities()
    {
        if (empty($this->mSystemLogin))
        {
            uni_redirect('/');
        }

        $q = ToLower(mysql_escape_string(strip_tags(_v('q'))));
        if (0 < strpos($q, ','))
        {
            $q = substr($q, 0, strpos($q, ','));
        }
        if (1 < strlen($q))
        {
            $res = $this->mlObj['geo']->SearchCity($q);
            foreach ($res as $k => &$v)
            {
                echo $k . '|' . $v['name'] . (!empty($v['sd_name']) ? ', ' . $v['sd_name'] : '') . ', ' . @$GLOBALS['cntrs'][$v['iso2_cntr']] . "\n";
            }
        }

        n_exit();
    }

    public function AjaxClasses()
    {
        if (empty($this->mSystemLogin))
        {
            exit();
        }

        $q = ToLower(mysql_escape_string(strip_tags(_v('q'))));
        $ward_id = (int) _v('ward_id');
        if (0 < strpos($q, ','))
        {
            $q = substr($q, 0, strpos($q, ','));
        }
        if (1 < strlen($q) && $ward_id)
        {
            $res = $this->mProfile->SearchSchoolClass($q, $ward_id);
            foreach ($res as $k => &$v)
            {
                echo $v['title'] . "\n";
            }
        }

        n_exit();
    }

    public function AjaxAddWard()
    {
        if (empty($this->mSystemLogin))
        {
            exit();
        }

        $wt = htmlspecialchars(trim(strip_tags(_v('wt'))));
        $wl = htmlspecialchars(trim(strip_tags(_v('wl'))));
        
        $ans = array('status' => '', 'inf' => array());
        $errs = array();

        $sid = _v('sid', 0);
        $wid = _v('wid', 0);
        $stake_val = trim(strip_tags(_v('stake_val', '')));
        $stake_str = explode(', ', $stake_val);

        if (count($stake_str) >1)
        { 
          //stake autocomplete, ward autocomplete or empty
          if (!$wid && ($wl=='Your ward\'s location'||!$wl))
          {
            $wl = trim(substr_replace($stake_val, '', 0, strlen($stake_str[0])+1));
          }
          elseif (!$wid)
          {
              $ans['status'] = 'err';
              $ans['answer'] = $this->mSmarty->get_config_vars('uward_err6'); //'Please, choose the ward location. Use autocomplete values only.';

              $this->mSmarty -> assign('siteroot', 'http://' . DOMEN . '/');
              $this->mSmarty -> assign('location', $wl);
              $this->mSmarty -> assign('title', $wt);
              $this->mSmarty -> assign('stake_val', $stake_str[0]);
              $this->mSmarty -> assign('uid', UID);

              include 'Ctrl/Mail/Phpmailer_v5.1/class.phpmailer.php';
              $gMail = new PHPMailer();
              $gMail->From = 'not_reply@' . DOMEN;
              $gMail->FromName = 'inZion.com';
              $gMail->AddAddress(ADMIN_EMAIL, '');
              $gMail->WordWrap = 50;
              $gMail->IsHTML(true);

              $gMail->Subject = 'Problem with Ward location in Database.';
              $gMail->Body = $this->mSmarty->fetch('mails/notice_admin.html');
              if (!$gMail->Send())
              {
                 $errs[] = $gMail->ErrorInfo;
              }
          }
          $stake_val = $stake_str[0];
        }
        else
        {
            if (!$wid)
            {
                //no autocomplete at ward location field
                 $ans['status'] = 'err';
                 $ans['answer'] = $this->mSmarty->get_config_vars('uward_err6'); //'Please, choose the ward location. Use autocomplete values only.';

                 $this->mSmarty -> assign('siteroot', 'http://' . DOMEN . '/');
                 $this->mSmarty -> assign('location', $wl);
                 $this->mSmarty -> assign('title', $wt);
                 $this->mSmarty -> assign('stake_val', $stake_str[0]);
                 $this->mSmarty -> assign('uid', UID);

                 include 'Ctrl/Mail/Phpmailer_v5.1/class.phpmailer.php';
                 $gMail = new PHPMailer();
                 $gMail->From = 'not_reply@' . DOMEN;
                 $gMail->FromName = 'inZion.com';
                 $gMail->AddAddress(ADMIN_EMAIL, '');
                 $gMail->WordWrap = 50;
                 $gMail->IsHTML(true);

                 $gMail->Subject = 'Problem with Ward location in Database.';
                 $gMail->Body = $this->mSmarty->fetch('mails/notice_admin.html');
                 if (!$gMail->Send())
                 {
                    $errs[] = $gMail->ErrorInfo;
                 }
            }
        }

        if ($wid || (!$wid && $sid))
        {   //ward autocomplete
            $cc = explode(', ', $wl);
            if (empty($cc))
            {
                $ans['status'] = 'err';
                $ans['answer'] = $this->mSmarty->get_config_vars('uward_err3'); //'Ward location is not found in database. Please, choose autocomplete values.';
                //$ans['answer'] = $this->mSmarty->get_config_vars('uward_err2'); //'Ward location is not found in database. Please, choose autocomplete values.';
            }

            if (3 == count($cc))
            {
                $loc_cc = $this->mlObj['geo']->CheckCity(trim($cc[0]), trim($cc[2]), trim($cc[1]));
                if (empty($loc_cc))
                    {
                        $loc_cc[0]['name'] = $cc[0];
                        $loc_cc[0]['region_name'] = $cc[1];
                        $loc_cc[0]['country_name'] = $cc[2];
                    }
            } elseif (2 == count($cc))
            {
                $loc_cc = $this->mlObj['geo']->CheckCity(trim($cc[0]), trim($cc[1]));
                    if (empty($loc_cc))
                    {
                        $loc_cc[0]['name'] = $cc[0];
                        $loc_cc[0]['region_name'] = $cc[1];
                    }

            } elseif (1 == count($cc))
            {
                $loc_cc = $this->mlObj['geo']->CheckCity($cc[0]);
                    if (empty($loc_cc))
                    {
                        $loc_cc[0]['name'] = $cc[0];
                    }
            }

            if (empty($loc_cc))
            {
                //$ans['status'] = 'err';
                //$ans['answer'] = $this->mSmarty->get_config_vars('uward_err3'); //'Ward location is not found in database. Please, choose autocomplete values.';
                //$ans['answer'] = $this->mSmarty->get_config_vars('uward_err2'); //'Ward location is not found in database. Please, choose autocomplete values.';
            } elseif (1 < count($loc_cc))
            {
                $ans['status'] = 'err';
                $ans['answer'] = $this->mSmarty->get_config_vars('uward_err4'); //'Found more than one city';
            }
        }

        require_once 'Model/Base/Ward.class.php';
        $mWard = new Model_Base_Ward($this->mlObj['gDb']);

        if (!$sid)
        {
            if ($wid)
            {
                $sid = $mWard->Edit($stake_val, 1, 0, !empty($loc_cc[0]['name']) ? $loc_cc[0]['name'] : $cc, !empty($loc_cc[0]['country_name']) ? $loc_cc[0]['country_name'] : '',
                    !empty($loc_cc[0]['region_name']) ? $loc_cc[0]['region_name'] : '',
                    0, '', 0);
            }
        }

        if ($ans['status'] != 'err')
        {
            $wid = $mWard->Edit($wt, 2, $sid, !empty($loc_cc[0]['name']) ? $loc_cc[0]['name'] : '', !empty($loc_cc[0]['country_name']) ? $loc_cc[0]['country_name'] : '',
                !empty($loc_cc[0]['region_name']) ? $loc_cc[0]['region_name'] : '',
                0, '', 0);

            $ans['status'] = 'success';
            $ans['inf'] = array('wid' => $wid, 'sid' => $sid);
            $ans['location'] = $wl;
        }

        include_once 'Ctrl/Ajax/Json.php';
        $mJson = new Services_JSON();
        header('Content-type: application/json');
        echo $mJson->encode(array($ans));
        exit();

        //die('success');
    }

    public function AjaxLangs()
    {
        if (empty($this->mSystemLogin))
        {
            uni_redirect('/');
        }

        $q = ToLower(mysql_escape_string(strip_tags(_v('q'))));
        $lang = _v('stake', '');
        if (0 < strpos($q, ','))
        {
            $q = trim(substr($q, strpos($q, ',') + 1, strlen($q)));
        }

        if (1 < strlen($q))
        {
            include_once 'Model/Base/Langs.class.php';
            $this->mLangs = new Model_Base_Langs($this->mDb);

            $res = $this->mLangs->SearchLang($q);
            foreach ($res as $k => &$v)
            {
                echo $v . "\n";
            }
        }
        n_exit();
    }

    public function Report()
    {
        if (empty($this->mSystemLogin))
        {
            die('You are not authorized');
        }

        include_once 'Model/Base/Reports.class.php';
        $mRep = new Model_Base_Reports($this->mlObj['gDb']);

        $uid = $this->mUinfo['uid'];
        $uid_to = _v('uid', 0);

        $user = $this->mUser->Get($uid_to);

        if ($uid && !empty($user))
        {
            $mesg = strip_tags(_v('subj', ''));
            $mRep->Report($uid, $uid_to, $_SERVER['HTTP_REFERER'], $mesg);
            die('reported');
        } else if (empty($user))
        {
            die('User is not found');
        }
        else
        {
            die('');
        }
    }

    
    public function Invite()
    {
        if (empty($this->mSystemLogin))
        {
            die('You are not authorized');
        }
        $res = array('q' => 'ok');
//        $name  = strip_tags( _v('name', '') );

        $emails = _v('email', '');
        $emails_list = explode(',',$emails);

        $descr = strip_tags(_v('descr', ''));
        $res['q'] = 'ok';

/*        if (empty($name))
        {
            $res['err'] = 1;
            $res['q'] = 'err';
        }
        elseif (empty($email) || !verify_email($email))
*/
        if (empty($emails_list))
        {
            $res['err'] = 2;
            $res['q'] = 'err';
        }
        else
        {
            $approved = 0;
            $moNotify = $this->mlObj['notify'];
            $dontsend = $moNotify->GetListEmailUnsubscribe();

            for($i=0; $i<count($emails_list);$i++)
            {
              $emails_list[$i] = trim($emails_list[$i]);
              if (verify_email($emails_list[$i]))
              {
                  if (in_array($emails_list[$i], $dontsend))
                  {
                       $res['err'] = 5;//email_block
                       $res['q'] = 'err';
                  }
                  else
                  {
/*                    $uid = $this -> mUser ->GetByEmail($email);
                      if (!empty($uid))
                      {
                        $res['err'] = 3;//email exist
                        $res['q'] = 'err';
                      }
                      else
                      {
                        $inv = 0;//$this -> mUser ->  CheckUserInvite($email);
                        if (!empty($inv))
                        {
                            $res['err'] = 4;//invite exist
                            $res['q'] = 'err';
                        }
                        else
                        {
*/                           
                             /**
                             * Invite
                             */
                            $this -> mUser ->InviteUser($this -> mUinfo['uid'],'', $emails_list[$i], $descr);
                            
                            /**
                             * Send email
                             */
                             if ($approved ==0)
                             {
                                include 'Ctrl/Mail/Phpmailer_v5.1/class.phpmailer.php';
                                $gMail = new PHPMailer();
                                $approved = 1;
                             }
                            $this->mSmarty->assign('DOMEN', DOMEN);
                            $gMail->From = $this -> mUinfo['email'];
                            $gMail->FromName = $this -> mUinfo['first_name'].' '.$this -> mUinfo['last_name'];
                            $gMail->AddAddress($emails_list[$i]);
                            //$gMail->AddAddress($emails_list[$i], $name);
                            $gMail->WordWrap = 50;
                            $gMail->IsHTML(true);

                            //$this -> mSmarty -> assign('name', $name);
                            $this -> mSmarty -> assign('email', $emails_list[$i]);
                            $this -> mSmarty -> assign('descr', $descr);

                            $gMail->Subject = $this -> mUinfo['first_name'].' '.$this -> mUinfo['last_name'].' invites you to be their friend on inZion.com  LDS Social Network!';
                            $gMail->Body = $this->mSmarty->fetch('mails/invite.html');

                            if (!$gMail->Send())
                            {
                                $errs[] = $gMail->ErrorInfo;
                            }
                          
                        //}
                    //}
                }
              }
           }
            if (!$approved)
            {
                if (empty($res['err']))
                {
                 $res['err'] = 6;
                 $res['q'] = 'err';
                }
            }
         }
        include_once 'Ctrl/Ajax/Json.php';
        $mJson = new Services_JSON();
        echo $mJson->encode($res);
        exit();
    }


    public function Indexadmin()
    {
        if (!defined('IT_ADMIN'))
        {
            exit();
        }
        //deb($_SESSION);
        $page = _v('page', 1);
        $pcnt = 25;
        $str = strip_tags(_v('str', ''));
        $ip_str = strip_tags(_v('ipstr', ''));
        $this->mSmarty->assign('str', $str);
        $this->mSmarty->assign('ip_str', $ip_str);
        if ($ip_str)
            $rcnt = $this->mUser->GetListCnt(-1, -1, '', '', '', '',$ip_str);
        else $rcnt = $this->mUser->GetListCnt(-1, -1, '', '', '',$str);

        include_once 'View/Acc/Pagging.php';
        if ($ip_str)
            $mpage = new Pagging($pcnt, $rcnt, $page, PATH_ROOT_ADM . 'security/users/indexadmin' . ($ip_str ? '?ipstr=' . $ip_str : ''));
        else $mpage = new Pagging($pcnt, $rcnt, $page, PATH_ROOT_ADM . 'security/users/indexadmin' . ($str ? '?str=' . $str : ''));
        $range = $mpage->GetRange();
        if ($ip_str)
            $this->mSmarty->assign_by_ref('pl', $this->mUser->GetList(-1, '', $range[0], $pcnt, -1, '', '', '','', $ip_str));
        else $this->mSmarty->assign_by_ref('pl', $this->mUser->GetList(-1, '', $range[0], $pcnt, -1, '', '', '', $str));

        $this->mSmarty->assign('pagging', $mpage->Make($this->mSmarty));
        $this->mSmarty->assign('_content', $this->mSmarty->Fetch('mods/Security/Users.html'));
    }

    /**
     * Delete user in admin panel
     */
    public function Del()
    {
        if (empty($this->mSystemLogin))
        {
            uni_redirect('/');
        }

        $uid = _v('uid', 0);

        if (!defined('IT_ADMIN') || 1 == $uid)
        {
            exit();
        }

        if ($uid)
        {
            $this->mUser->Del($uid);
        }
        uni_redirect(PATH_ROOT_ADM . 'security/users/indexadmin');
    }

    public function Block()
    {
        if (empty($this->mSystemLogin))
        {
            uni_redirect('/');
        }

        $uid = _v('uid', 0);

        if (!defined('IT_ADMIN') || 1 == $uid)
        {
            exit();
        }

        if ($uid)
        {
            $this->mUser->BlockIP($uid);
        }
        uni_redirect(PATH_ROOT_ADM . 'security/users/indexadmin');
    }

    public function LoginAs()
    {
        $uid = _v('uid', 0);

        if (!defined('IT_ADMIN') || 1 == $uid)
        {
            exit();
        }
        $ui = $this->mUser->Get($uid);
        if (!empty($ui))
        {
            /** autologin */
            $this->mUser->Logout();

            $ui['pass'] = hex2bin($ui['pass']);
            $this->mRc4->decrypt($ui['pass']);
            $_POST['system_login'] = $ui['email'];
            $_POST['system_pass'] = $ui['pass'];
            $this->CheckAuth();
            uni_redirect(PATH_ROOT);
        }
    }

    public function Unsubscribe()
    {
        if (empty($this->mSystemLogin))
        {
            uni_redirect('/');
        }

        if (!empty($_POST['fm']))
        {
            $fm  = $_POST['fm'];
            $errs = array();
            if (empty($fm['email']))
            {
                $errs[] = 'Please enter email';
            }
            elseif (!verify_email($fm['email']))
            {
                 $errs[] = 'Please enter correct email';
            }

            if (empty($errs))
            {
                $res = $this -> mUser ->  AddEmailBlock($fm['email'], !empty($this -> moUser -> mUinfo['uid']) ? $this -> moUser -> mUinfo['uid'] : 0);
                uni_redirect( PATH_ROOT . 'security/users/Unsubscribe?res='.($res ? '1' : '2') );
            }
            $this -> mSmarty -> assign_by_ref('errs', $errs);
        }
        $this -> mSmarty -> assign('send', _v('res', 0) );
        $this->mSmarty->assign('_content', $this->mSmarty->Fetch('mods/users/_unsubscribe.html'));
    }
}
?>