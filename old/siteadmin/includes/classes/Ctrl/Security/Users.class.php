<?php
class Ctrl_Security_Users  extends Ctrl_Base
{
    /**
     * Base User Model pointer
     *
     * @var pointer
     */
    public $mUser;

    public $mProfile;

    /** User Vars */
    private $mSystemLogin;
    private $mSystemStatus;
    private $mSystemModules;
    private $mUinfo;
    private $mIsAdmin = 0;
    private $mRc4;

    private $mUi;

    /** some constants */
    private $mLangs;
    private $mRelations;
    private $mRelStatuses;
    private $mIm;
    private $mInterests;
    private $mEstatuses;

    public function __construct( &$glObj )
    {
        parent :: __construct( $glObj );

        include_once 'Model/Security/Rc4.class.php';
        $this -> mRc4  = new Model_Security_Rc4();
        $this -> mRc4  -> setKey( 'idfdnjewrjerjewrjbk' );

        include_once 'Model/Security/Users.class.php';
        $this -> mUser = new Model_Security_Users( $this -> mDb, $this -> mRc4 );

    }/** Init */


    public function __set($varName, $value)
    {
        if (property_exists($this, $varName))
        {
            $this->$varName = $value;
        }
        return true;
    }/** __set */


    public function &__get( $name )
    {
        if ( isset($this -> $name) )
        {
            return  $this -> $name;
        }
        else
        {
            $r = 0;
            return $r;
        }
    }/** __get */

    public function _getObj()
    {
        return $this -> mUser;
    }


    /** Some constants for user profile */
    public function _InitConst()
    {

        $this -> mLangs        = array(1 => 'English', 2 => 'Spanish', 3 => 'Russian', 4 => 'Czech');
        $this -> mRelations    = array(1 => 'Mother', 2 => 'Father', 3 => 'Sister', 4 => 'Brother', 5 => 'Cosine', 6 => 'Uncle', 7 => 'Aunt', 8 => 'Grand Mother', 9 => 'Grand Father', 10 => 'Other Relative');
        $this ->  mRelStatuses = array( 1 => 'Single', 2 => 'Married', 3 => 'Divorced', 4 => 'Separated', 5 => 'Widowed');
        $this -> mIm = array(1 => 'ICQ', 2 => 'AOL', 3 => 'Jabber', 4 => 'Skype');
        $this -> mInterests = array(
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
        $this -> mEstatuses = array(1 => 'Employed', 2 => 'Dismissed');

    }/** _InitConst */


    public function CheckAuth()
    {
       
        $check_auth = $this -> mUser -> CheckLogin( CURRENT_SCP, 1 );
        $_SESSION['check_auth'] = $check_auth;
        /**
         if (1==$check_auth)
         {
         uni_redirect( PATH_ROOT . 'base/cabinet/');
         }
         else
         */

    
        if ($check_auth >= 2)
        {
            if (isset($_POST['system_login']))
            {
                $this -> mSmarty -> assign('check_auth', $check_auth);
            }
        }
        else
        {
            $this -> mSystemLogin   = $_SESSION['system_login'];
            $this -> mSystemStatus  = $_SESSION['system_status'];
            $this -> mSystemModules = $_SESSION['system_modules'];

            $this -> mSmarty -> assign('system_login'  , $this -> mSystemLogin);
            $this -> mSmarty -> assign('system_status' , $this -> mSystemStatus);
            $this -> mSmarty -> assign('system_modules', $this -> mSystemModules);
            $this -> mUinfo  =& $this -> mUser -> Get( $this -> mUser -> GetByEmail($this -> mSystemLogin) );
            $this -> mSmarty -> assign_by_ref( 'UserInfo', $this -> mUinfo );
            if (!defined('UID'))
            {
                define('UID', $this -> mUinfo['uid']);
                define('UI_LOGIN', $this -> mUinfo['email']);
            }
        }

        $loginx = strip_tags(_v('loginx', ''));
        $uid = _v('uid', 0);
        if (!empty($loginx))
        {
            $uid = $this -> mUser -> GetByLogin($loginx);
        }

        if (!empty($uid))
        {
            $this -> mUi = $this -> mUser -> Get( $uid );
        }


        if (empty($this -> mUi) && !empty($this -> mUinfo))
        {
            $this -> mUi = $this -> mUinfo;
        }

        if (!empty($this -> mUi))
        {
            if (!defined('UID_OTHER'))
            {
                define('UID_OTHER', $this -> mUi['uid']);
                define('UI_LOGIN_OTHER', $this -> mUi['email']);
                define('IS_USER', (defined('UID') && UID == UID_OTHER) ? true : false);
                $this -> mSmarty -> assign('IS_USER', IS_USER);
            }
            
        	if (defined('UID'))
            {
	            $ar_rel = $this -> _initRelations();
	            $this -> mUi = array_merge( $this -> mUi, $ar_rel );
            }
 
            $this -> mSmarty -> assign_by_ref('ui', $this -> mUi);

        }
    }/** CheckAuth */


    public function LogOut()
    {
        if (!empty($_REQUEST['logout']))
        {
            $this -> mUser -> Logout();
            if ($this -> mIsAdmin)
            {
                uni_redirect( PATH_ROOT_ADM );
            }
            else
            {
                uni_redirect( PATH_ROOT );
            }
        }
    }/** LogOut */


    public function AuthForm()
    {
        $this -> mSmarty -> display('enter.html');
    }/** AuthForm */


    public function CheckRights( $mod )
    {
        $t = 1;
        if (2 == $this -> mUinfo['status'])
        {
            $t = 0;
        }
        elseif (1 == $this -> mUinfo['status'])
        {
            $modules = 	$this -> mUinfo['modules'];
            if (empty($modules) || empty($modules[$mod]))
            {
                $t = 0;
            }
        }
        return true;
    }/** CheckRights */


    /************************************************
     Output Methods for frontend
     ************************************************/

    public function Index()
    {
        $act = '';
        if ($this -> mIsAdmin)
        {
            uni_redirect( PATH_ROOT_ADM );
        }

        if (!$this -> mSystemLogin)
        {
            /** user registration */
            $this -> Reg();

        }
        else
        {
            /* else show my profile */
            $this -> Profile();
        }
    }/** Index */


    /**
     * Show profile for current user
     */
    public function Profile()
    {
        if (!$this -> mSystemLogin)
        {
            uni_redirect( PATH_ROOT );
        }

        /** Show User Profile */
        $act = _v('act', '');



        $this -> mSmarty -> assign('DOMEN', DOMEN);
        $this -> mSmarty -> assign('_content', $this -> mSmarty -> Fetch('mods/users/_profile.html') );
    }/** Profile */


    public function Settings()
    {
        if (empty($this -> mSystemLogin))
        {
            uni_redirect('/');
        }

        $this -> _InitConst();
        $this -> mSmarty -> assign_by_ref('spoken_langs', $this -> mLangs);
        $this -> mSmarty -> assign_by_ref('relations', $this -> mRelations);
        $this -> mSmarty -> assign_by_ref('rel_statuses', $this -> mRelStatuses);
        $this -> mSmarty -> assign_by_ref('ims', $this -> mIm );
        $this -> mSmarty -> assign_by_ref('interests', $this -> mInterests );
        $this -> mSmarty -> assign_by_ref('estatuses', $this -> mEstatuses);

        $this -> mUi['langs'] = $this -> mProfile -> GetLangList($this -> mUi['uid']);
        $this -> mUi['fam']   = $this -> mProfile -> GetFamilyList($this -> mUinfo['uid']);
        $this -> mUi['im']   = $this -> mProfile -> GetImList($this -> mUi['uid']);
        $this -> mUi['mission'] = $this -> mProfile -> GetMissionList($this -> mUi['uid']);
        $this -> mUi['calling'] = $this -> mProfile -> GetCallingList($this -> mUi['uid']);
        $this -> mUi['interests'] = $this -> mProfile -> GetInterestList($this -> mUi['uid']);

        $this -> mUi['university'] = $this -> mProfile -> GetUniversityList($this -> mUinfo['uid']);
        $this -> mUi['hschool']    = $this -> mProfile -> GetHSchoolList($this -> mUinfo['uid']);
        $this -> mUi['job']        = $this -> mProfile -> GetJobList($this -> mUinfo['uid']);


        $this -> mSmarty -> assign_by_ref('countries', $GLOBALS['cntrs']);
        $this -> mSmarty -> assign('_content', $this -> mSmarty -> Fetch('mods/users/_settings.html'));
    }/** Settings */


    public function Login()
    {
        if ($this -> mIsAdmin)
        {
            uni_redirect( PATH_ROOT_ADM );
        }

        if ($this -> mSystemLogin)
        {
            $this -> Index();
        }
        else
        {
            $code = _v('code', '');

            if ($code)
            {
                $ui = $this -> mUser -> ApproveByCode($code);
                if (!empty($ui) && $ui && is_array($ui))
                {
                    /** autologin */
                    $_POST['system_login'] = $ui['email'];
                    $_POST['system_pass']  = $ui['pass'];
                    $this -> CheckAuth();

                    /** show first steps */
                    uni_redirect(PATH_ROOT . 'profile');
                }
                else
                {
                    $this -> mSmarty -> assign('_content', $this -> mSmarty -> Fetch('mods/users/_error_code.html') );
                }
            }
            uni_redirect( PATH_ROOT );
        }

    }/** login */


    /**
     * Show approved form
     * @return bool true
     */
    public function Approved()
    {
        if (!empty($_SESSION['approve_email']))
        {
            $this -> mSmarty -> assign('approve_email', $_SESSION['approve_email']);
        }

        $this -> mSmarty -> assign('_content', $this -> mSmarty -> Fetch('mods/users/_reg_approved.html') );
    }/** Approved */



    public function Forgot()
    {
        if ($this -> mIsAdmin)
        {
            uni_redirect( PATH_ROOT_ADM );
        }

        if ($this -> mSystemLogin)
        {
            uni_redirect( PATH_ROOT );
        }

        if (!empty($_REQUEST['code']) || !empty($_SESSION['restore_pass']))
        {
            if (!empty($_SESSION['restore_pass']))
            {
                $r = $this -> mUser -> Get( $_SESSION['restore_pass'] );
            }
            else
            {
                $r = $this -> mUser -> GetRestoreCode($_REQUEST['code']);
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
                        $this -> mUser -> UpdatePassword( $r['uid'], $fm['pass'] );
                        $_POST['system_login'] = $r['email'];
                        $_POST['system_pass']  = $fm['pass'];
                        $this -> CheckAuth();
                        uni_redirect( PATH_ROOT . 'security/users/profile' );
                    }
                    $this -> mSmarty -> assign('errs', 1);
                }

                $this -> mSmarty -> assign_by_ref('ui', $r);
                $this -> mSmarty -> assign_by_ref('_content', $this -> mSmarty -> Fetch('mods/users/_change_password.html'));
                return;
            }
        }

        if (isset($_POST['UserInfo']) && 0 < count($_POST['UserInfo']))
        {
            $forgoterr = array();

            if( !isset($_POST['UserInfo']['email']) || !verify_email($_POST['UserInfo']['email']) )
            {
                $forgoterr[] = 2;
            }

            if (0 == count($forgoterr))
            {
                $u = $this -> mUser -> Get(  $this -> mUser -> GetByEmail($_POST['UserInfo']['email']) );

                if (!isset($u['email']) || $u['email'] != trim($_POST['UserInfo']['email']))
                {
                    $forgoterr[] = 3;
                }
                else
                {
                    $code = $this -> mUser -> RestorePassword($u['email']);

                    $this -> mSmarty -> assign('code', $code);
                    $this -> mSmarty -> assign('email',   $u['email']);
                    $this -> mSmarty -> assign('login',   $u['public_name']);

                    $this -> mSmarty -> assign('SUPPORT_SITENAME', SUPPORT_SITENAME);

                    /** Send mail */
                    $this -> mSmarty -> assign('DOMEN', DOMEN);
                    include 'Ctrl/Mail/PhpMailer/class.phpmailer.php';
                    $gMail = new PHPMailer();
                    $gMail  -> From     = 'not_reply@'.DOMEN;
                    $gMail  -> FromName = 'InZion.com';
                    $gMail  -> AddAddress($_POST['UserInfo']['email'], '');
                    $gMail  -> WordWrap = 50;
                    $gMail  -> IsHTML(true);

                    $gMail->Subject  =  'InZion.com password restore';
                    $gMail->Body     =  $this -> mSmarty -> fetch('mails/newpass.html');
                    $_SESSION['forgot_email'] = $_POST['UserInfo']['email'];
                    if(!$gMail->Send())
                    {
                        $errs[] = $gMail -> ErrorInfo;
                    }
                    uni_redirect(PATH_ROOT."security/users/forgot?send=ok", 1);
                }
            }

            $this -> mSmarty -> assign_by_ref('forgoterr', $forgoterr);
            $this -> mSmarty -> assign_by_ref('UserInfo',$_POST['UserInfo']);
        }

        if (isset($_REQUEST['send']) && 'ok' == $_REQUEST['send'])
        {
            if (!empty($_SESSION['forgot_email']))
            {
                $this -> mSmarty -> assign_by_ref('email', $_SESSION['forgot_email']);
                unset($_SESSION['forgot_email']);
            }
            $this -> mSmarty -> assign('send', 1);
        }
        $this -> mSmarty -> assign('no_reg_bl', 1);
        $this -> mSmarty -> assign_by_ref('_content', $this -> mSmarty -> Fetch('mods/users/_forgot.html'));
    }/** Restore password */


    /**
     * Update user profile
     */
    public function Change( )
    {
        if (empty($this -> mSystemLogin))
        {
            uni_redirect( PATH_ROOT . 'security/users/reg');
        }

        $uid = $this -> mUinfo['uid'];

        if (!empty($_REQUEST['delphoto']))
        {
            $this -> mUser -> DelPhoto( $uid );
            uni_redirect( PATH_ROOT . 'security/users/change'  );
        }


        if (!empty($_POST['fm']))
        {
            $fm  = $_POST['fm'];
            $adi = array(
                    'about_me' => !empty($fm['about_me']) ? strip_tags($fm['about_me']) : '',
                    'send_comments' => !empty($fm['send_comments']) ? 1 : 0,
                    'send_updates' => !empty($fm['send_updates']) ? 1 : 0
            );

            $this -> mUser -> UpdValues( $uid, $adi );
            uni_redirect( PATH_ROOT );
        }

        $this -> mSmarty -> assign('_content', $this -> mSmarty -> Fetch('mods/users/_change.html') );
        define('IS_CABINET', 1);
    }/** Change */



    public function Unsubscr()
    {
        if ($this -> mIsAdmin)
        {
            uni_redirect( PATH_ROOT_ADM );
        }

        $code   = _v('code', '');

        $change = 0;
        if ($code)
        {
            $change = $this -> mUser -> UpdSubscrByCode($code);
        }
        $this -> mSmarty -> assign('change', 1);
        $this -> mSmarty -> assign('_content', $this -> mSmarty -> Fetch('mods/users/_unsubscr.html') );
    }/** Unsubscr */

    /**
     * Initialization of relations
     * 
     * @return array of relations 
     */
	public function _initRelations( $uid = '' ) { 
		$ar_rel = array();
		
		require_once 'Model/Base/Friends.class.php';
        $moFriends = new Model_Base_Friends( $this -> mlObj );
		
		$ar_rel['im_suscr_fr'] = 1;	//Subscriber or Friend I am (1) or Not (0)
		$ar_rel['im_fam']      = 1;	//Family we are (1) or Not (0)
		
		$uid ? $user_id = $uid : $user_id = UID_OTHER;
		
		$fr_i = $moFriends -> GetFriend( UID, $user_id );
		if ($fr_i)
		{
			if (1 == $fr_i['active'])
				$ar_rel['im_friend'] = 1;	//im friend
			else
				$ar_rel['im_friend'] = 2;	//im waiting for confirmation of friend's status
		}
		else
			$ar_rel['im_friend'] = 0;	//im not a friend		
		return $ar_rel;
	}/* _initRelations */

    public function Ajaxreg()
    {

        //$login  = strip_tags(_v('login', ''));
        $pass   = _v('pass', '');
        $fname  = strip_tags(_v('fname', ''));
        $lname  = strip_tags(_v('lname', ''));
        $email  = _v('email', '');

        $res     = array();
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

        if (empty($email))
        {
            $res['errs'][] = 'Please specify email';
        }
        elseif (!verify_email($email) || 64 < strlen($email))
        {
            $res['errs'][] = 'Error email';
        }
        elseif ($this -> mUser -> CheckEmail($email))
        {
            $res['errs'][] = 'User with selected email already exist';
        }

        //$pa = array('password', '123456', '12345678', 'test', 'qwerty', 'zxcvbn', 'asdfgh');
        if (empty($pass))
        {
            $res['errs'][] = 'Please specify password';
        }
        elseif (strlen($pass) < 5/* || in_array($pass, $pa)*/)
        {
            $res['errs'][] = 'Password less then 5 symbols';
        }

        if (!empty($res['errs']) )
        {
            $q = 'err';
        }
        else
        {
            $login = $email;
            $fm = array('login' => $login, 'pass' => $pass, 'first_name' => $fname, 'last_name' => $lname, 'email' => $email, 'status' => 2, 'modules' => '');
            $uid = $this -> mUser -> Add( $fm );

            /**
             * Send email about registration && wait
             */
            $code = $this -> mUser -> GetRegistrationCode($uid);
            $this -> mSmarty -> assign('code', $code);
            /** Send email */
            $this -> mSmarty -> assign('SUPPORT_SITENAME', SUPPORT_SITENAME);
            $this -> mSmarty -> assign('DOMEN', DOMEN);

            /** Send mail */
            include 'Ctrl/Mail/PhpMailer/class.phpmailer.php';
            $gMail = new PHPMailer();
            $gMail  -> From     = 'verify@inzion.com';
            $gMail  -> FromName = 'InZion.com';
            $gMail  -> AddAddress($fm['email'], '');
            $gMail  -> WordWrap = 50;
            $gMail  -> IsHTML(true);

            $this -> mSmarty -> assign('fm', $fm);
            $gMail  -> Subject  =  'InZion Verification';
            $gMail  -> Body     =  $this -> mSmarty -> fetch('mails/approved.html');
            $gMail  -> Send();

            $_SESSION['approve_email'] = $fm['email'];
            $q = 'ok';
        }

        header("Content-type: text/plain");
        $res['q'] = $q;

        include_once 'Ctrl/Ajax/Json.php';
        $mJson = new Services_JSON();
        echo $mJson -> encode( $res );
        exit();
    }/** Ajaxreg */


    public function Ajaxlogin()
    {
        if (empty($this -> mSystemLogin))
        {
            $q = 'err';
        }
        else
        {
            $q = 'ok';
        }

        header("Content-type: text/plain");
        $res['resu'] = !empty($_SESSION['check_auth']) ? $_SESSION['check_auth'] : 0;
        $res['q'] = $q;

        include_once 'Ctrl/Ajax/Json.php';
        $mJson = new Services_JSON();
        echo $mJson -> encode( $res );
        exit();
    }/** Ajaxlogin */


    public function AjaxSettings()
    {
        if (empty($this -> mSystemLogin))
        {
            exit();
        }

        $act = _v('act', '');
        $res = array();
        $q   = 'ok';

        /** Init some info for basic */
        $this -> _InitConst();

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
                $this -> mSmarty -> assign_by_ref('mm', $mm);
                $this -> mSmarty -> assign_by_ref('dd', $dd);
                $this -> mSmarty -> assign_by_ref('yy', $yy);

                $this -> mSmarty -> assign_by_ref('relations', $this -> mRelations);
                $this -> mSmarty -> assign_by_ref('rel_statuses', $this -> mRelStatuses);
                $this -> mSmarty -> assign_by_ref('spoken_langs', $this -> mLangs);

                $pa = array( 'gender', 'was_born' , 'live_in',  'no_dob', 'rel_status');
                foreach ($pa as &$v)
                {
                    $fm[$v] = $this -> mUinfo[$v];
                }
                $fm['byear']  = substr($this -> mUinfo['dob'], 0, 4);
                $fm['bmonth'] = substr($this -> mUinfo['dob'], 5, 2);
                $fm['bday']   = substr($this -> mUinfo['dob'], 8, 2);

                $fam = $this -> mProfile -> GetFamilyList($this -> mUinfo['uid']);

                foreach ($fam as &$v)
                {
                    $fm['relation'][]      = $v['rel_status'];
                    $fm['relation_name'][] = $v['name'];
                }

                $fm['spoken_lang'] = $this -> mProfile -> GetLangList($this -> mUinfo['uid']);


                /** prepare spoken langs array */
                $lng_cnt = !empty($fm['spoken_lang']) ? count($fm['spoken_lang']) : 1;
                for ($i=0; $i < $lng_cnt; $i++)
                {
                    $spoken_lang[] = $i;
                }
                $this -> mSmarty -> assign('spoken_lang', $spoken_lang);


                /** prepare raltion array */
                $rel_cnt = !empty($fm['relation']) ? count($fm['relation']) : 1;
                $relation = array();
                for ($i=0; $i < $rel_cnt; $i++)
                {
                    $relation[] = $i;
                }
                $this -> mSmarty -> assign('relation', $relation);



                $this -> mSmarty -> assign_by_ref('fm', $fm);

                $res['form'] = $this -> mSmarty -> Fetch('mods/users/ajax/_edit_basic.html');
                break;

            /** save basic information */
            case 'basic_save':
                if (!empty($_POST['fm']))
                {
                    $fm = $_POST['fm'];

                    $gender = _va($fm, 'gender', 0);
                    $gender = ($gender < 1 || $gender > 2) ? 0 : $gender;

                    $dob = '';
                    $dob .= (!empty($fm['byear']) && is_numeric($fm['byear']) && $fm['byear']>= date("Y")-99 &&  $fm['byear']<= date("Y")) ? $fm['byear'] : '0000';
                    $dob .= (!empty($fm['bmonth']) && is_numeric($fm['bmonth']) && $fm['bmonth']>= 1 &&  $fm['bmonth']<=12) ? '-'.$fm['bmonth'] : '-'.'00';
                    $dob .= (!empty($fm['bday']) && is_numeric($fm['bday']) && $fm['bday']>= 1 &&  $fm['bday']<=31) ? '-'.$fm['bday'] : '-'.'00';

                    $no_dob = _va($fm, 'no_dob', 0);
                    $no_dob = 1 != $no_dob ? 0 : 1;

                    $was_born = strip_tags(_va($fm, 'was_born', ''));
                    $live_in  = strip_tags(_va($fm, 'live_in', ''));

                    $rel_status = _va($fm, 'rel_status', 0);
                    $rel_status = isset($this -> mRelStatuses[$rel_status]) ? $rel_status : 0;

                    $this -> mProfile -> ClearFamily($this -> mUinfo['uid']);
                    $this -> mProfile -> ClearLang($this -> mUinfo['uid']);

                    if (!empty($fm['spoken_lang']))
                    {
                        foreach ($fm['spoken_lang'] as &$v)
                        {
                            if (!empty($v) && isset($this -> mLangs[$v]))
                            {
                                $this -> mProfile -> EditLang($this -> mUinfo['uid'], $v);
                            }
                        }
                    }

                    if (!empty($fm['relation']) && !empty($fm['relation_name']))
                    {
                        foreach ($fm['relation'] as $k => &$v)
                        {
                            if ($v && isset($this -> mRelations[$v]) && !empty($fm['relation_name'][$k]))
                            {
                                $fm['relation_name'][$k] = trim(strip_tags($fm['relation_name'][$k]));
                                if ($fm['relation_name'][$k])
                                {
                                    $this -> mProfile -> EditFamily( $this -> mUinfo['uid'], $v, $fm['relation_name'][$k] );
                                }
                            }
                        }
                    }

                    $ar = array(
                            'gender'   => $gender,
                            'dob'      => $dob,
                            'was_born' => $was_born,
                            'live_in'  => $live_in,
                            'no_dob'   => $no_dob,
                            'rel_status' => $rel_status
                    );
                    $this -> mUser -> UpdValues($this -> mUinfo['uid'], $ar);

                    /** return result form */
                    $this -> mUi = $this ->  moUser -> mUser -> Get($this -> mUinfo['uid']);
                    $this -> mUi['langs'] = $this -> mProfile -> GetLangList($this -> mUi['uid']);
                    $this -> mUi['fam']   = $this -> mProfile -> GetFamilyList($this -> mUinfo['uid']);

                    $this -> mSmarty -> assign_by_ref('spoken_langs', $this -> mLangs);
                    $this -> mSmarty -> assign_by_ref('relations', $this -> mRelations);
                    $this -> mSmarty -> assign_by_ref('rel_statuses', $this -> mRelStatuses);

                    $res['form'] = $this -> mSmarty -> Fetch('mods/users/ajax/_show_basic.html');

                    header("Content-type: text/plain");
                    echo $res['form'];
                    exit();
                }

                break;

            /** cancel basic edit */
            case 'basic_cancel':

            /** return result form */
                $this -> mUi['langs'] = $this -> mProfile -> GetLangList($this -> mUi['uid']);
                $this -> mUi['fam']   = $this -> mProfile -> GetFamilyList($this -> mUinfo['uid']);

                $this -> mSmarty -> assign_by_ref('spoken_langs', $this -> mLangs);
                $this -> mSmarty -> assign_by_ref('relations', $this -> mRelations);
                $this -> mSmarty -> assign_by_ref('rel_statuses', $this -> mRelStatuses);

                $res['form'] = $this -> mSmarty -> Fetch('mods/users/ajax/_show_basic.html');
                break;


            /** get contacts settings form */
            case 'contacts':
                $fm = array();

                $pa = array( 'first_name', 'last_name' , 'email',  'mob_phone', 'land_phone', 'address', 'city', 'zip', 'country');
                foreach ($pa as &$v)
                {
                    $fm[$v] = $this -> mUinfo[$v];
                }
                $fm_im = $this -> mProfile -> GetImList($this -> mUinfo['uid']);

                foreach ($fm_im as &$v)
                {
                    $fm['im_type'][] = $v['im_type'];
                    $fm['im_name'][] = $v['im_name'];
                }

                /** prepare IM array */
                $im_cnt = !empty($fm['im_type']) ? count($fm['im_type']) : 1;
                $im = array();
                for ($i=0; $i < $im_cnt; $i++)
                {
                    $im[] = $i;
                }
                $this -> mSmarty -> assign('im', $im);



                $this -> mSmarty -> assign_by_ref('fm', $fm);
                $this -> mSmarty -> assign_by_ref('ims', $this -> mIm );
                $this -> mSmarty -> assign_by_ref('countries', $GLOBALS['cntrs']);
                $res['form'] = $this -> mSmarty -> Fetch('mods/users/ajax/_edit_contacts.html');
                break;

            /** contacts save info */
            case 'contacts_save':

                if (!empty($_POST['fm']))
                {
                    $fm = $_POST['fm'];

                    $was_born = strip_tags(_va($fm, 'was_born', ''));
                    $live_in  = strip_tags(_va($fm, 'live_in', ''));


                    $ar = array(
                            'mob_phone' => strip_tags(_va($fm, 'mob_phone', '')),
                            'land_phone' => strip_tags(_va($fm, 'land_phone', '')),
                            'address' => strip_tags(_va($fm, 'address', '')),
                            'city' => strip_tags(_va($fm, 'city', '')),
                            'zip' => strip_tags(_va($fm, 'zip', '')),
                            'country' => strip_tags(_va($fm, 'country', ''))
                    );

                    if (!empty($fm['edit_name']))
                    {
                        $first_name = trim( strip_tags(_va($fm, 'first_name', '')) );
                        $last_name  = trim( strip_tags(_va($fm, 'last_name', '')) );
                        if ($first_name && $last_name)
                        {
                            $ar['first_name'] = $first_name;
                            $ar['last_name']  = $last_name;
                        }
                    }

                    if (!empty($fm['edit_email']))
                    {
                        $email = trim( strip_tags(_va($fm, 'email', '')) );
                        if (verify_email($email))
                        {
                            if ( !$this -> mUser -> CheckEmail($email) )
                            {
                                $ar['email'] = $email;
                                $ar['public_name'] = $email;
                            }
                        }
                        else
                        {
                            $fm['edit_email'] = 0;
                        }
                    }

                    /** Edit IM list */
                    $this -> mProfile -> ClearIm($this -> mUinfo['uid']);

                    if (!empty($fm['im_name']) && !empty($fm['im_type']))
                    {
                        foreach ($fm['im_type'] as $k => &$v)
                        {
                            if ($v && isset($this -> mIm[$v]) && !empty($fm['im_name'][$k]))
                            {
                                $fm['im_name'][$k] = trim(strip_tags($fm['im_name'][$k]));
                                if ($fm['im_name'][$k])
                                {
                                    $this -> mProfile -> EditIm( $this -> mUinfo['uid'], $v, $fm['im_name'][$k] );
                                }
                            }
                        }
                    }

                    /** Update values */
                    $this -> mUser -> UpdValues($this -> mUinfo['uid'], $ar);

                    if (!empty($fm['edit_email']))
                    {
                        $pass = $this -> mUinfo['pass'];
                        $pass = hex2bin($pass);
                        $this -> mRc4 -> decrypt($pass);

                        $_POST['system_login'] = $email;
                        $_POST['system_pass']  = $pass;
                        $this -> mUser -> Logout();
                        $this -> CheckAuth();
                    }
                }

                $this -> mUi = $this ->  moUser -> mUser -> Get($this -> mUinfo['uid']);
                $this -> mSmarty -> assign_by_ref('ims', $this -> mIm );
                $this -> mUi['im'] = $this -> mProfile -> GetImList($this -> mUi['uid']);
                $this -> mSmarty -> assign_by_ref('countries', $GLOBALS['cntrs']);
                $res['form'] = $this -> mSmarty -> Fetch('mods/users/ajax/_show_contacts.html');

                header("Content-type: text/plain");
                echo $res['form'];
                exit();
                break;

            /** contacts cancel */
            case 'contacts_cancel':
                $this -> mSmarty -> assign_by_ref('ims', $this -> mIm );
                $this -> mSmarty -> assign_by_ref('countries', $GLOBALS['cntrs']);
                $this -> mUi['im'] = $this -> mProfile -> GetImList($this -> mUi['uid']);
                $res['form'] = $this -> mSmarty -> Fetch('mods/users/ajax/_show_contacts.html');
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
                $this -> mSmarty -> assign_by_ref('mm', $mm);
                $this -> mSmarty -> assign_by_ref('dd', $dd);
                $this -> mSmarty -> assign_by_ref('yy', $yy);

                $fm = array();
                $pa = array( 'ward', 'stake', 'ward_id', 'stake_id');
                foreach ($pa as &$v)
                {
                    $fm[$v] = $this -> mUinfo[$v];
                }

                if (!empty($this -> mUinfo['baptism_date']) && '0000-00-00' != $this -> mUinfo['baptism_date'])
                {
                    $fm['byear']  = substr($this -> mUinfo['baptism_date'], 0, 4);
                    $fm['bmonth'] = substr($this -> mUinfo['baptism_date'], 5, 2);
                    $fm['bday']   = substr($this -> mUinfo['baptism_date'], 8, 2);
                }

                $fm_mission = $this -> mProfile -> GetMissionList($this -> mUinfo['uid']);
                foreach ($fm_mission as &$v)
                {
                    $fm['mission_location'][] = $v['location'];

                    $fm['fyear'][]  = substr($v['fdate'], 0, 4);
                    $fm['fmonth'][] = substr($v['fdate'], 5, 2);
                    $fm['fday'][]   = substr($v['fdate'], 8, 2);
                    $fm['tyear'][]  = substr($v['tdate'], 0, 4);
                    $fm['tmonth'][] = substr($v['tdate'], 5, 2);
                    $fm['tday'][]   = substr($v['tdate'], 8, 2);
                }

                $fm_calling = $this -> mProfile -> GetCallingList($this -> mUinfo['uid']);
                foreach ($fm_calling as &$v)
                {
                    $fm['calling'][] = $v['calling'];
                    $fm['calling_comment'][] = $v['comment'];
                }

                // prepare calling array
                $mission_cnt = !empty($fm['mission_location']) ? count($fm['mission_location']) : 1;
                $mission = array();
                for ($i=0; $i < $mission_cnt; $i++)
                {
                    $mission[] = $i;
                }
                $this -> mSmarty -> assign('mission', $mission);

                // prepare Calling array
                $calling_cnt = !empty($fm['calling']) ? count($fm['calling']) : 1;
                $calling = array();
                for ($i=0; $i < $calling_cnt; $i++)
                {
                    $calling[] = $i;
                }
                $this -> mSmarty -> assign('calling', $calling);


                $this -> mSmarty -> assign_by_ref('fm', $fm);
                //$this -> mSmarty -> assign_by_ref('ims', $this -> mIm );;
                $res['form'] = $this -> mSmarty -> Fetch('mods/users/ajax/_edit_church.html');
                break;

            /** save church info */
            case 'church_save':
                if (!empty($_POST['fm']))
                {
                    $fm = $_POST['fm'];

                    $bd  = (!empty($fm['byear']) && is_numeric($fm['byear']) && $fm['byear']>= date("Y")-99 &&  $fm['byear']<= date("Y")) ? $fm['byear'] : '0000';
                    $bd .= (!empty($fm['bmonth']) && is_numeric($fm['bmonth']) && $fm['bmonth']>= 1 &&  $fm['bmonth']<=12) ? '-'.$fm['bmonth'] : '-'.'00';
                    $bd .= (!empty($fm['bday']) && is_numeric($fm['bday']) && $fm['bday']>= 1 &&  $fm['bday']<=31) ? '-'.$fm['bday'] : '-'.'00';

                    $ward   = strip_tags(_va($fm, 'ward', ''));
                    $ward_id = _va($fm, 'ward_id', 0);
                    $stake = strip_tags(_va($fm, 'stake', ''));
                    $stake_id = _va($fm, 'stake_id', 0);

                    include_once 'Model/Base/Ward.class.php';
                    $gWard = new Model_Base_Ward($this -> mDb);

                    if ($ward_id)
                    {
                        $v = $gWard -> Get($ward_id);
       
                        if (empty($v))
                        {
                            $ward_id  = 0;
                        }
                        else
                        {
                            $wc = $v['title'].', '.$v['city'].($v['region'] ? ', '.$v['region'] : '').', '.$v['country'];
                            if (ToLower($wc) != ToLower($ward))
                            {
                                $ward_id = 0;
                            }
                        }
                    }

                    if ($stake_id)
                    {
                        $v = $gWard -> Get($stake_id);
                        if (empty($v))
                        {
                            $stake_id  = 0;
                        }
                        else
                        {
                            $wc = $v['title'].', '.$v['city'].($v['region'] ? ', '.$v['region'] : '').', '.$v['country'];
                            if (ToLower($wc) != ToLower($stake))
                            {
                                $stake_id = 0;
                            }
                        }
                    }

                    

                    $ar = array(
                            'baptism_date' => $bd,
                            'ward' => $ward,
                            'ward_id' => $ward_id,
                            'stake' => $stake,
                            'stake_id' => $stake_id
                    );

                    /** Update values */
                    $this -> mUser -> UpdValues($this -> mUinfo['uid'], $ar);


                    /** Edit Mission list */
                    $this -> mProfile -> ClearMission($this -> mUinfo['uid']);

                    if (!empty($fm['mission_location']))
                    {
                        foreach ($fm['mission_location'] as $k => &$v)
                        {
                            $v = trim(strip_tags($v));
                            $mission_id = 0;
                            
                            /** check mission city */ 
                            $cc = explode(', ', $v);
                            if (3==count($cc))
                            {
                                $cc = $this -> mlObj['geo'] -> CheckCity(trim($cc[0]), trim($cc[2]), trim($cc[1]));
                            }
                            elseif (2==count($cc))
                            {
                                $cc = $this -> mlObj['geo'] -> CheckCity(trim($cc[0]), trim($cc[1]));
                            }
                            elseif (1==count($cc))
                            {
                                $cc = $this -> mlObj['geo'] -> CheckCity($cc[0]);
                            } 
                            
                            if (!empty($cc))
                            {
                            
                                include_once 'Model/Base/Mission.class.php';
                                $gMission = new Model_Base_Mission($this -> mDb);
                                $mission_id = $gMission -> GetMissionByLocation( $cc[0]['name'], !empty($cc[0]['country_name']) ? $cc[0]['country_name'] : '', !empty($cc[0]['region_name']) ? $cc[0]['region_name'] : '' );
                                if (empty($mission_id))
                                {
                                    /** create new mission */
                                    $wt = $cc[0]['name'].(!empty($cc[0]['region_name']) ? ', '.$cc[0]['region_name'] : '').', '.$cc[0]['country_name'];
                                    $gMission  -> Edit($wt, $cc[0]['name'], $cc[0]['country_name'], !empty($cc[0]['region_name']) ? $cc[0]['region_name'] : '');
                                    
                                } 
                            } 
                             
                            $df  = (!empty($fm['fyear'][$k]) && is_numeric($fm['fyear'][$k]) && $fm['fyear'][$k]>= date("Y")-99 &&  $fm['fyear'][$k]<= date("Y")) ? $fm['fyear'][$k] : '0000';
                            $df .= (!empty($fm['fmonth'][$k]) && is_numeric($fm['fmonth'][$k]) && $fm['fmonth'][$k]>= 1 &&  $fm['fmonth'][$k]<=12) ? '-'.$fm['fmonth'][$k] : '-'.'00';
                            $df .= (!empty($fm['fday'][$k]) && is_numeric($fm['fday'][$k]) && $fm['fday'][$k]>= 1 &&  $fm['fday'][$k]<=31) ? '-'.$fm['fday'][$k] : '-'.'00';

                            $dt  = (!empty($fm['tyear'][$k]) && is_numeric($fm['tyear'][$k]) && $fm['tyear'][$k]>= date("Y")-99 &&  $fm['tyear'][$k]<= date("Y")) ? $fm['tyear'][$k] : '0000';
                            $dt .= (!empty($fm['tmonth'][$k]) && is_numeric($fm['tmonth'][$k]) && $fm['tmonth'][$k]>= 1 &&  $fm['tmonth'][$k]<=12) ? '-'.$fm['tmonth'][$k] : '-'.'00';
                            $dt .= (!empty($fm['tday'][$k]) && is_numeric($fm['tday'][$k]) && $fm['tday'][$k]>= 1 &&  $fm['tday'][$k]<=31) ? '-'.$fm['tday'][$k] : '-'.'00';

                            if ($v && $df != '0000-00-00' && $dt != '0000-00-00')
                            {
                                $this -> mProfile -> EditMission( $this -> mUinfo['uid'], $df, $dt, $v, $mission_id );
                            }
                        }
                    }


                    /** Edit Calling list */
                    $this -> mProfile -> ClearCalling($this -> mUinfo['uid']);

                    if (!empty($fm['calling']))
                    {
                        foreach ($fm['calling'] as $k => &$v)
                        {
                            $v = trim(strip_tags($v));
                            if ($v)
                            {
                                $vc = !empty($fm['calling_comment'][$k]) ? trim(strip_tags($fm['calling_comment'][$k])) : '';
                                $this -> mProfile -> EditCalling( $this -> mUinfo['uid'], $v, $vc );
                            }
                        }
                    }



                    if (!empty($fm['edit_email']))
                    {
                        $pass = $this -> mUinfo['pass'];
                        $pass = hex2bin($pass);
                        $this -> mRc4 -> decrypt($pass);

                        $_POST['system_login'] = $email;
                        $_POST['system_pass']  = $pass;
                        $this -> mUser -> Logout();
                        $this -> CheckAuth();
                    }
                }

                $this -> mUi = $this ->  moUser -> mUser -> Get($this -> mUinfo['uid']);
                $this -> mUi['mission'] = $this -> mProfile -> GetMissionList($this -> mUi['uid']);
                $this -> mUi['calling'] = $this -> mProfile -> GetCallingList($this -> mUi['uid']);
                $res['form'] = $this -> mSmarty -> Fetch('mods/users/ajax/_show_church.html');

                header("Content-type: text/plain");
                echo $res['form'];
                exit();
                break;

            /** cancel edit church info */
            case 'church_cancel':

                $this -> mUi = $this ->  moUser -> mUser -> Get($this -> mUinfo['uid']);
                $this -> mUi['mission'] = $this -> mProfile -> GetMissionList($this -> mUi['uid']);
                $this -> mUi['calling'] = $this -> mProfile -> GetCallingList($this -> mUi['uid']);
                $res['form'] = $this -> mSmarty -> Fetch('mods/users/ajax/_show_church.html');
                break;


            /** get interest edit form */
            case 'interest':
                $fm = array();

                /** get list */
                $il = $this -> mProfile -> GetInterestList($this -> mUinfo['uid']);
                $fm['interests_list'] = array();
                $fm['interests'] = array();
                $fm['interests_story'] = array();
                foreach ($il as $v)
                {
                    if ($v['num'])
                    {
                        $fm['interests_list'][$v['num']] = $v;
                    }
                    else
                    {
                        $fm['interests'][] = $v['title'];
                        $fm['interests_story'][] = $v['story'];
                    }
                }
                unset($il);

                $interests_cnt = !empty($fm['interests']) ? count($fm['interests']) : 1;
                $interests = array();
                for ($i=0; $i < $interests_cnt; $i++)
                {
                    $interests[] = $i;
                }

                $this -> mSmarty -> assign('interests', $interests);

                $this -> mSmarty -> assign_by_ref('interests_list', $this -> mInterests);
                $this -> mSmarty -> assign_by_ref('fm', $fm);
                $res['form'] = $this -> mSmarty -> Fetch('mods/users/ajax/_edit_interest.html');
                break;

            /** save interest info */
            case 'interest_save':

                if (!empty($_POST['fm']))
                {
                    $fm = $_POST['fm'];
                    $this -> mProfile -> ClearInterest($this -> mUinfo['uid']);
                    if (!empty($fm['interests_list']))
                    {
                        foreach($fm['interests_list'] as $k => &$v)
                        {
                            $v = trim( strip_tags($v) );
                            if (!empty($this -> mInterests[$k]) && $v)
                            {
                                $this -> mProfile ->  EditInterest($this -> mUinfo['uid'], $k, $this -> mInterests[$k], $v);
                            }
                        }
                    }

                    if (!empty($fm['interests']) && !empty($fm['interests_story']))
                    {
                        foreach($fm['interests'] as $k => &$v)
                        {
                            $v  = trim( strip_tags($v) );
                            $v2 = !empty($fm['interests_story'][$k]) ? trim( strip_tags($fm['interests_story'][$k]) ) : '';
                            if ($v && $v2)
                            {
                                $this -> mProfile ->  EditInterest($this -> mUinfo['uid'], 0, $v, $v2);
                            }
                        }
                    }

                }
                //$this -> mUi = $this ->  moUser -> mUser -> Get($this -> mUinfo['uid']);
                $this -> mUi['interests'] = $this -> mProfile -> GetInterestList($this -> mUinfo['uid']);
                $res['form'] = $this -> mSmarty -> Fetch('mods/users/ajax/_show_interest.html');

                header("Content-type: text/plain");
                echo $res['form'];
                exit();
                break;

            /** cancel edit interest info */
            case 'interest_cancel':

            //$this -> mUi = $this ->  moUser -> mUser -> Get($this -> mUinfo['uid']);
                $this -> mUi['interests'] = $this -> mProfile -> GetInterestList($this -> mUinfo['uid']);
                $res['form'] = $this -> mSmarty -> Fetch('mods/users/ajax/_show_interest.html');
                break;


            /** get education edit form */
            case 'edu':
                $fm = array();


                $ul = $this -> mProfile -> GetUniversityList($this -> mUinfo['uid']);
                $fm['universities'] = array();
                $fm['cyear'] = array();
                $fm['major'] = array();
                $fm['minor'] = array();
                foreach ($ul as $v)
                {
                    $fm['university'][] = $v['university'];
                    $fm['cyear'][] = $v['cyear'];
                    $fm['major'][] = $v['major'];
                    $fm['minor'][] = $v['minor'];
                }
                unset($ul);


                $ul = $this -> mProfile -> GetHSchoolList($this -> mUinfo['uid']);
                $fm['hschool'] = array();
                $fm['hyear'] = array();
                foreach ($ul as $v)
                {
                    $fm['hschool'][] = $v['hschool'];
                    $fm['hyear'][]   = $v['hyear'];
                }
                unset($ul);


                $ul = $this -> mProfile -> GetJobList($this -> mUinfo['uid']);
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
                    $fm['estatus'][]  = $v['estatus'];
                    $fm['pos'][]      = $v['pos'];
                    $fm['descr'][]    = $v['descr'];
                    $fm['city'][]     = $v['city'];
                    $fm['fmonth'][]   = $v['fmonth'];
                    $fm['fyear'][]    = $v['fyear'];
                    $fm['present'][]  = $v['present'];
                    $fm['tmonth'][]   = $v['tmonth'];
                    $fm['tyear'][]    = $v['tyear'];
                }
                unset($ul);


                $universities_cnt = !empty($fm['university']) ? count($fm['university']) : 1;
                $universities = array();
                for ($i=0; $i < $universities_cnt; $i++)
                {
                    $universities[] = $i;
                }
                $this -> mSmarty -> assign_by_ref('universities', $universities);

                $hschools_cnt = !empty($fm['hschool']) ? count($fm['hschool']) : 1;
                $hschools = array();
                for ($i=0; $i < $hschools_cnt; $i++)
                {
                    $hschools[] = $i;
                }
                $this -> mSmarty -> assign_by_ref('hschools', $hschools);


                $jobs_cnt = !empty($fm['employer']) ? count($fm['employer']) : 1;
                $jobs = array();
                for ($i=0; $i < $jobs_cnt; $i++)
                {
                    $jobs[] = $i;
                }
                $this -> mSmarty -> assign_by_ref('jobs', $jobs);

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
                $this -> mSmarty -> assign_by_ref('mm', $mm);
                $this -> mSmarty -> assign_by_ref('yy', $yy);

                $this -> mSmarty -> assign_by_ref('estatuses', $this -> mEstatuses);
                $this -> mSmarty -> assign_by_ref('fm', $fm);
                $res['form'] = $this -> mSmarty -> Fetch('mods/users/ajax/_edit_edu.html');
                break;

            /** save education info */
            case 'edu_save':

                if (!empty($_POST['fm']))
                {
                    $fm = $_POST['fm'];
                    $this -> mProfile -> ClearUniversity($this -> mUinfo['uid']);
                    if (!empty($fm['university']))
                    {
                        foreach($fm['university'] as $k => &$v)
                        {
                            $v = trim( strip_tags($v) );
                            if ($v)
                            {
                                $cyear = (!empty($fm['cyear'][$k]) && is_numeric($fm['cyear'][$k])) ? $fm['cyear'][$k] : 0;
                                $major = isset($fm['major'][$k]) ? trim( strip_tags($fm['major'][$k]) ) :  '';
                                $minor = isset($fm['minor'][$k]) ? trim( strip_tags($fm['minor'][$k]) ) :  '';

                                $this -> mProfile ->  EditUniversity($this -> mUinfo['uid'],$v, $cyear, $major, $minor);
                            }
                        }
                    }


                    $this -> mProfile -> ClearHSchool($this -> mUinfo['uid']);
                    if (!empty($fm['hschool']))
                    {
                        foreach($fm['hschool'] as $k => &$v)
                        {
                            $v = trim( strip_tags($v) );
                            if ($v)
                            {
                                $hyear = (!empty($fm['hyear'][$k]) && is_numeric($fm['hyear'][$k])) ? $fm['hyear'][$k] : 0;
                                $this -> mProfile -> EditHSchool($this -> mUinfo['uid'], $v, $hyear);
                            }
                        }
                    }


                    $this -> mProfile -> ClearJob($this -> mUinfo['uid']);
                    if (!empty($fm['pos']))
                    {
                        foreach($fm['pos'] as $k => &$v)
                        {
                            $v = trim( strip_tags($v) );
                            $estatus  = ( isset($fm['estatus'][$k]) && !empty($this -> mEstatuses[$fm['estatus'][$k]])) ? $fm['estatus'][$k] : 1;
                            $employer = !empty($fm['employer'][$k]) ? trim( strip_tags($fm['employer'][$k]) ) : '';
                            $descr    = !empty($fm['descr'][$k]) ? trim( strip_tags($fm['descr'][$k]) ) : '';
                            $city     = !empty($fm['city'][$k]) ? trim( strip_tags($fm['city'][$k]) ) : '';
                            $fmonth   = !empty($fm['fmonth'][$k]) ? 1 * trim( strip_tags($fm['fmonth'][$k]) ) : 0;
                            $fyear    = !empty($fm['fyear'][$k]) ? 1 * trim( strip_tags($fm['fyear'][$k]) ) : 0;
                            $present  = !empty($fm['present'][$k]) ? 1 : 0;
                            $tmonth   = !empty($fm['tmonth'][$k]) ? 1 * trim( strip_tags($fm['tmonth'][$k]) ) : 0;
                            $tyear    = !empty($fm['tyear'][$k]) ? 1 * trim( strip_tags($fm['tyear'][$k]) ) : 0;

                            if (!empty($present))
                            {
                                $tmonth = 0;
                                $tyear  = 0;
                            }

                            if ($v)
                            {
                                $this -> mProfile ->  EditJob($this -> mUinfo['uid'],
                                        $estatus, $employer, $v, $descr, $city, $fmonth, $fyear, $present, $tmonth, $tyear
                                );
                            }
                        }
                    }

                }

                $this -> mSmarty -> assign_by_ref('estatuses', $this -> mEstatuses);

                $this -> mUi = $this ->  moUser -> mUser -> Get($this -> mUinfo['uid']);
                $this -> mUi['university'] = $this -> mProfile -> GetUniversityList($this -> mUinfo['uid']);
                $this -> mUi['hschool']    = $this -> mProfile -> GetHSchoolList($this -> mUinfo['uid']);
                $this -> mUi['job']        = $this -> mProfile -> GetJobList($this -> mUinfo['uid']);

                $res['form'] = $this -> mSmarty -> Fetch('mods/users/ajax/_show_edu.html');

                header("Content-type: text/plain");
                echo $res['form'];
                exit();
                break;

            /** cancel edit education info */
            case 'edu_cancel':
            
                $this -> mSmarty -> assign_by_ref('estatuses', $this -> mEstatuses);
                $this -> mUi = $this ->  moUser -> mUser -> Get($this -> mUinfo['uid']);

                $this -> mUi['university'] = $this -> mProfile -> GetUniversityList($this -> mUinfo['uid']);
                $this -> mUi['hschool']    = $this -> mProfile -> GetHSchoolList($this -> mUinfo['uid']);
                $this -> mUi['job']        = $this -> mProfile -> GetJobList($this -> mUinfo['uid']);

                $res['form'] = $this -> mSmarty -> Fetch('mods/users/ajax/_show_edu.html');
                break;


            /** get church talks edit form */
            case 'talk':
                $fm = array();

                $this -> mSmarty -> assign_by_ref('fm', $fm);

                $res['form'] = $this -> mSmarty -> Fetch('mods/users/ajax/_edit_talk.html');
                break;

            /** save church talk info */
            case 'talk_save':


                $this -> mUi = $this ->  moUser -> mUser -> Get($this -> mUinfo['uid']);
                $res['form'] = $this -> mSmarty -> Fetch('mods/users/ajax/_show_talk.html');

                header("Content-type: text/plain");
                echo $res['form'];
                exit();
                break;

            /** cancel edit church talk info */
            case 'talk_cancel':

                $this -> mUi = $this ->  moUser -> mUser -> Get($this -> mUinfo['uid']);
                $res['form'] = $this -> mSmarty -> Fetch('mods/users/ajax/_show_talk.html');
                break;
        }
        header("Content-type: text/plain");
        $res['q'] = $q;

        include_once 'Ctrl/Ajax/Json.php';
        $mJson = new Services_JSON();
        echo $mJson -> encode( $res );
        exit();
    }/** AjaxSettings */


    public function AjaxCities()
    {   
        $q = ToLower( mysql_escape_string(strip_tags(_vg('q'))) );
        if (0 < strpos($q, ','))
        {
            $q = substr($q, 0, strpos($q, ','));
        }
        if (1 < strlen($q))
        {
            $res = $this -> mlObj['geo'] -> SearchCity($q);
            foreach ($res as $k => &$v)
            {
                echo $k.'|'.$v['name'].(!empty($v['sd_name']) ? ', '.$v['sd_name'] : '').', '.@$GLOBALS['cntrs'][$v['iso2_cntr']]."\n";
            }
        }

        n_exit();
    }/** AjaxCities */

}/** Ctrl_Users */
?>