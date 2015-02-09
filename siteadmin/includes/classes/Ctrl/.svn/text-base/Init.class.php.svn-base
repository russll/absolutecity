<?php

class Ctrl_Init extends Ctrl_Base
{

    public function __construct($glObj, $what = 0)
    {
        parent :: __construct($glObj);
        switch ($what)
        {
            case 'admin':
                $this->InitAdmin($glObj);
                break;
            case 'index':
                $this->InitIndex($glObj);
                break;
        }
    }

    /** constructor */
    public function InitAdmin(&$glObj)
    {
        /** Smarty Init Vars */
        load_gz_compress($this->mSmarty);
        $this->mSmarty->assign('siteAdr', PATH_ROOT . 'siteadmin/');

        /** Init Controls */
        include_once 'Ctrl/Security/Modules.class.php';
        include_once 'Ctrl/Security/Dispath.class.php';


        $moDispath = new Ctrl_Security_Dispath();
        $moModules = new Ctrl_Security_Modules($glObj);

        $this -> moUser -> mIsAdmin = 1;
        /** Start Current Controller */
        $moDispath->Start($glObj);

        /** Prepare data for all pages */
        $moModules->PrepList();

        /** Display Base Template */
        $this->mSmarty->display('index.html');
    }

    /** InitAdmin */
    public function InitIndex(&$glObj)
    {
        //load global config file 
        $this -> mSmarty -> config_load('global.conf');
        $this->mSmarty->assign('siteAdr', PATH_ROOT);
        $this->mSmarty->assign('siteUrl', 'http://' . DOMEN . '/');

        /** Init Controls */
        include_once 'Ctrl/Security/Dispath.class.php';
        $moDispath = new Ctrl_Security_Dispath();

        $ajaxInit = _v('ajaxinit');
        if (defined('UID'))
        {
            if (!$ajaxInit)
            {
                $this->_initCurInfo(); //set an additional Current Info
            } else
            {
                $this->_initCurInfoAjax(); //set an additional Current Info For Ajax Scripts
            }
        }


        if (!defined('UID') && $ajaxInit && !isset($_POST['email']) && !isset($_POST['system_login']))
        {
            echo '<b>Please reload page</b>';
            exit();
        }


        /** Start Current Controller */
        $moDispath->Start($glObj);

        /** Show current */
        if (!defined('UID'))
        {
            $this->mSmarty->display('index.html');
        } else
        {
            //init smiles
            require_once 'Model/Profile/Smile.class.php';
            $mUSmile = new Model_Profile_Smile();
            $this->mSmarty->assign_by_ref('sname',$mUSmile->smile_name);
            $this->mSmarty->assign_by_ref('snamecode',$mUSmile->smile_name_code);

            //init badge
            $this->mSmarty->assign_by_ref('badge_array',$mUSmile->badge_pic);
            
            $this->mSmarty->assign('gCnt', $GLOBALS['gCnt']);
            $this->mSmarty->assign('gTime', get_mt_time() - $GLOBALS['gtime']);
            $this->mSmarty->display('main.html');
        }
    }

    public function _initCurInfo()
    {

        $glType = _v('type'); //type of the Module
        
        //-- get friends list
        require_once 'Model/Base/Friends.class.php';
        $mocFriends = new Model_Base_Friends($this->mDb);

        $cnt_show_cfr = 12;
        $this->mSmarty->assign('cnt_show_cfr', $cnt_show_cfr);

        if (IS_USER)
        {
            /** active friends */
            $cfriends = array();
            $myfriends = array();
            $ii = 0;
            foreach ($this->moUser->mUserFriends as $k => &$v)
            {
                if (1 == $v['active'] && 1 == $v['factive'])
                {
                    if ($ii < $cnt_show_cfr)
                    {
                        $cfriends[] = & $v;
                    }
                    $myfriends[] = & $v;
                    $ii++;
                }
            }
            
            $this->mSmarty->assign('cfriends', $cfriends);
            $this->mSmarty->assign('cnt_cfriends', $ii);

            /** invites count */
            $this->mSmarty->assign('cnt_myfrinvites', $mocFriends->GetCntUserInvites(UID));
        }
        else
        {
            $mfriends = $mocFriends->GetUserFriends(UID_OTHER, 0, 0, array(1), 0, '', UID);
            $cnt_mfriends = $mocFriends->GetUserFriendsCount(UID_OTHER, array(1), 0, '', UID);

            $cfriends = $mocFriends->GetUserFriends(UID_OTHER, 0, $cnt_show_cfr, array(1));
            $cnt_cfriends = $mocFriends->GetUserFriendsCount(UID_OTHER, array(1));
           
            $this->mSmarty->assign('mfriends', $mfriends);
            $this->mSmarty->assign('cnt_mfriends', $cnt_mfriends);

            $this->mSmarty->assign('cfriends', $cfriends);
            $this->mSmarty->assign('cnt_cfriends', $cnt_cfriends);
        }

        /** get 3 last photos */
        if ('profile' == $glType || 'mission' == $glType || 'wards' == $glType)
        {
            include_once 'Model/Base/Albums.class.php';
            $this->mAlbums = new Model_Base_Albums($this->mlObj['gDb']);

            switch ($glType)
            {
                case 'mission':
                    $vflt = ' a.name = \'Mission\'';
                    break;

                case 'wards':
                    $vflt = ' a.name = \'Ward\'';
                    break;

                default:
                    $vflt = '-1';
            }
            $lphotos = $this->mAlbums->GetUAlbums(UID_OTHER, ('profile' == $glType ? 1 : 2), 0, 3, -1, array(), $vflt, 1);

            $this->mSmarty->assign_by_ref('lphotos', $lphotos);
        }


        /** get 2 last videos */
        if ('profile' == $glType || 'mission' == $glType || 'wards' == $glType)
        {
            include_once 'Model/Base/Valbums.class.php';
            $this->mValbums = new Model_Base_Valbums($this->mlObj['gDb']);

            switch ($glType)
            {
                case 'mission':
                    $vflt = ' a.name = \'Mission\'';
                    break;

                case 'wards':
                    $vflt = ' a.name = \'Ward\'';
                    break;

                default:
                    $vflt = '-1';
            }
            $lvideos = $this->mValbums->GetUValbums(UID_OTHER, ('profile' == $glType ? 1 : 2), 0, 2, -1, $vflt, 1);
            $this->mSmarty->assign_by_ref('lvideos', $lvideos);
        }

        //-- get subscribers list (current user's subscribers...)
        if ('Profile' == $glType)
        {
            $csubscr = $this->moUser->mUser->GetSubscr(-1, UID_OTHER, ' RAND()', 4);
            $cnt_csubscr = $this->moUser->mUser->GetCntSubscr(UID_OTHER);

            $this->mSmarty->assign('csubscr', $csubscr);
            $this->mSmarty->assign('cnt_csubscr', $cnt_csubscr);
        }

        //-- get friends & subscr
        if ('profile' == $glType)
        {
            $myfrsubscr = array_merge(!empty($myfriends) ? $myfriends : array(), !empty($mysubscr) ? $mysubscr : array());
            if ($myfrsubscr)
            {
                $pr_repval = array();
                foreach ($myfrsubscr as $k => $r)
                {
                    if (!in_array($r['uid'], $pr_repval))
                    {
                        $pr_repval[] = $r['uid'];
                    } else
                    {
                        unset($myfrsubscr[$k]);
                    }
                }
            }
            $this->mSmarty->assign('myfrsubscr', $myfrsubscr);
        }

        //-- get subscribition list (I'm subscriber to...)
        if ('Profile' == $glType)
        {
            $csubscribition = $this->moUser->mUser->GetSubscr(UID_OTHER, -1, ' RAND()', 4);
            $cnt_csubscribition = $this->moUser->mUser->GetCntSubscr(-1, UID_OTHER);

            $this->mSmarty->assign('csubscribition', $csubscribition);
            $this->mSmarty->assign('cnt_csubscribition', $cnt_csubscribition);
        }

        if ('Journal' == $glType)
        {
            $jsubscribition = $this->moUser->mUser->GetJrnlSubscr(UID_OTHER, -1, ' RAND()', 3);
            $cnt_jsubscribition = $this->moUser->mUser->GetCntJrnlSubscr(-1, UID_OTHER);

            $this->mSmarty->assign('jsubscr', $jsubscribition);
            $this->mSmarty->assign('cnt_jsubscr', $cnt_jsubscribition);
        }

        if ('Profile' == $glType || 'Journal' == $glType || 'Wards' == $glType)
        {
            $tmpclasses = $this->moUser->mProfile->GetSchoolClassList(UID, $this->moUser-> mUinfo['ward_id']/*$this->moUser->mProfile->GetWardId(UID)*/);

            $uclasses_index = array();
            $uclasses = array();
            if (count($tmpclasses) > 0)
            {
                foreach ($tmpclasses as $key => $val)
                {
                    if (!isset($uclasses_index[$val['class_id']]))
                    {
                        $uclasses_index[$val['class_id']] = $val['title'];
                        $uclasses[] = $val;
                    }
                }
            }


            $this->mSmarty->assign('uclasses_index', $uclasses_index);
            $this->mSmarty->assign('uclasses', $uclasses);
            $this->mSmarty->assign('cnt_uclasses', count($uclasses));
        }

        if ('Wards' == $glType)
        {
            $this->mSmarty->assign('prhs', array(
                /*3 => 'priesthood holders',*/
                2 => 'young man',
                12 => 'young woman',
                1 => 'aaronic priesthood',
                4 => 'melchizedek priesthood',
                7 => 'high priest'));
        }

        //-- get Ward/Stake info
        /*
        include_once 'Model/Base/Ward.class.php';
        $this->moWard = new Model_Base_Ward($this->mlObj['gDb']);

        $cwi = $this->moWard->GetUList(UID_OTHER);
        $this->mSmarty->assign_by_ref('cwi', $cwi[0]);
        */

        //-- get Notify
        $moNotify = $this->mlObj['notify'];

        $ar_notify_mini = $moNotify->GetUNotify(-1, UID, -1, -1, 0, 3, -1, 0);
        $ar_cnt_notify_mini = $moNotify->GetCntUNotify(-1, UID, -1, -1, 0, 3, -1, 0);
        $notify_pages = ceil($ar_cnt_notify_mini / 3);

        if (10 < $notify_pages)
        {
            $notify_pages = 10;
        }
        $this->mSmarty->assign_by_ref('notify_pages', $notify_pages);
        $this->mSmarty->assign_by_ref('ar_notify_mini', $ar_notify_mini);
        $this->mSmarty->assign_by_ref('ar_cnt_notify_mini', $ar_cnt_notify_mini);

        //-- get inbox info
        require_once 'Model/Base/Inbox.class.php';
        $this->moInbox = new Model_Base_Inbox($this->mlObj['gDb']);

        $ar_new_mes = $this->moInbox->GetNewMes(UID);
        $cnt_inbox_mes = 0;
        foreach ($ar_new_mes as $k => $r)
        {
            $cnt_inbox_mes += $r;
        }
        $this->mSmarty->assign_by_ref('cnt_inbox_mes', $cnt_inbox_mes);

        //-- get Scripture of the Day
        $what = array('uid', 'first_name', 'last_name', 'scripture', 'scripture_dt');
        $scripture_of_day = $this->moUser->mUser->GetListByFilt($what, array(), array(), 2, 1, 'RAND()', 0, 1, 'scripture <> \'\'');
        $this->mSmarty->assign_by_ref('scripture_of_day', $scripture_of_day);

        //-- get  Access to private info in left column
        if (UID != UID_OTHER && !$this -> moUser -> mUi['global']['basic'])
        {
            //access to basic information (for block in left panel)
            $this->mSmarty->assign('basic_denied', true);
        }

        //check deleted -show ONLY profile page
        if ($this -> moUser -> mUi['is_deleted'])
        {
            $type = _v('type', '');
            $mod  = _v('mod', '');
            $what  = _v('what', '');

            if (empty($type) || $type != 'Profile' || empty($mod) || $mod != 'Wall' || empty($what) || $what != 'Getedit')
            {
                uni_redirect( PATH_ROOT . 'id'.$this -> moUser -> mUi['uid']);
            }
        }
    }


    public function _initCurInfoAjax()
    {
        $glType = _v('type'); //type of the Module
        //-- get friends list
        require_once 'Model/Base/Friends.class.php';
        $mocFriends = new Model_Base_Friends($this->mDb);

        $cnt_show_cfr = 12;
        $this->mSmarty->assign('cnt_show_cfr', $cnt_show_cfr);
        $this->mSmarty->assign('prhs', array(/*3 => 'priesthood holders',*/
            2 => 'young man',
            12 => 'young woman',
            1 => 'aaronic priesthood',
            4 => 'melchizedek priesthood',
            7 => 'high priest'));

        if (IS_USER)
        {
            /** active friends */
            $cfriends = array();
            $ii = 0;
            foreach ($this->moUser->mUserFriends as $k => &$v)
            {
                if (1 == $v['active'])
                {
                    if ($ii < $cnt_show_cfr)
                    {
                        $cfriends[] = & $v;
                    }
                    $ii++;
                }
            }
            $this->mSmarty->assign('cfriends', $cfriends);
            $this->mSmarty->assign('cnt_cfriends', $ii);

            /** invites count */
            $this->mSmarty->assign('cnt_myfrinvites', $mocFriends->GetCntUserInvites(UID));
        } else
        {
            $mfriends = $mocFriends->GetUserFriends(UID_OTHER, 0, 0, array(1), 0, '', UID);
            $cnt_mfriends = $mocFriends->GetUserFriendsCount(UID_OTHER, array(1), 0, '', UID);

            $cfriends = $mocFriends->GetUserFriends(UID_OTHER, 0, 0, array(1));
            $cnt_cfriends = $mocFriends->GetUserFriendsCount(UID_OTHER, array(1));

            $this->mSmarty->assign('mfriends', $mfriends);
            $this->mSmarty->assign('cnt_mfriends', $cnt_mfriends);

            $this->mSmarty->assign('cfriends', $cfriends);
            $this->mSmarty->assign('cnt_cfriends', $cnt_cfriends);
        }
    }

}

?>
