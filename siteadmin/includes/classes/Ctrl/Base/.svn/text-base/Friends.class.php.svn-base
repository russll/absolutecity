<?php
/**
 * Friend's Base controller
 *
 * @package    5dev Wall
 * @version    1.0
 * @since      31.03.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */
class Ctrl_Base_Friends extends Ctrl_Base
{
    private $moFriends;
    private $mFid;
    private $mCurFid;

    private $mFriendsOnPage = 10;

    //** Constructor of the Friends class
    public function __construct( &$glObj)
    {
        parent :: __construct( $glObj );

        if (!defined('UID'))
            uni_redirect( PATH_ROOT . '');

        require_once 'Model/Base/Friends.class.php';
        $this -> moFriends = new Model_Base_Friends( $this -> mDb );

        // Check input
        $this -> mFid = (int)_v('fid');
        $this -> mSmarty -> assign('fid', $this -> mFid);

        $this -> mCurFid = (int)_v('cur_fid', FOLDER_FRIENDS);
        $this -> mSmarty -> assign('cur_fid', $this -> mCurFid);

        $this -> mSmarty -> assign( 'm_page', 'friends_list' );
    }/** constructor */



    /**
     * Get list of friends
     */
    public function GetList( )
    {
        $ar_friends = array();
        $ar_invites = array();
        $ar         = array();
        $filter = (string)_v('filt');
        $mutual = (int)_v('mutual');

        $wh = _v('wh', '');
        $this -> mSmarty -> assign('wh', $wh);
        if ($wh=='invites' && IS_USER)
        {
            /** Show full invites list */
            $this -> mSmarty -> assign_by_ref('ar_invites', $this -> moFriends -> GetUserInvites( UID ));
            $this -> mSmarty -> assign('it_invites', 1);

            /** friends for right menu */
            $this -> mSmarty -> assign_by_ref('ar_friends', $this -> moFriends -> GetUserFriends(UID, 0, 5, array(1), 0, '', 0, 0, 0, ($this -> mCurFid > 999 ? $this -> mCurFid : 0)));
            $this -> mSmarty -> assign('cnt_ar_friends', $this -> moFriends -> GetUserFriendsCount(UID, array(1), 0, ''));

            $this -> mSmarty -> assign_by_ref('_content', $this -> mSmarty -> Fetch('mods/friends/_list.html'));
        }
        else
        {
            if (IS_USER)
            {
                //5 invites for right menu
                $this -> mSmarty -> assign_by_ref('ar_invites', $this -> moFriends -> GetUserInvites( UID, 0, 5 ));
                $this -> mSmarty -> assign('cnt_invites', $this -> moFriends -> GetCntUserInvites(UID));

                //folders
                switch ($this -> mCurFid)
                {
                    case FOLDER_ALL:
                        $ar  =array(1,2,3);
                        break;
                    case FOLDER_FRIENDS:
                        $ar  =array(1);
                        break;
                    case FOLDER_FAVOURITES:
                        $ar  =array(2);
                        break;
                    case FOLDER_BLOCKED:
                        $ar  =array(3);
                        break;
                    default :
                        $ar  =array(1,2,3);
                        break;
                }
            }
            else
            {
                $ar = array(1);
            }
            if(!$mutual)
            {
                $cnt_ar_friends = $this -> moFriends -> GetUserFriendsCount(UID_OTHER, $ar, 0, $filter);
            }
            else
            {
                $cnt_ar_friends = $this -> moFriends -> GetUserFriendsCount(UID_OTHER, $ar, 0, $filter, UID);
            }

            include_once 'View/Acc/Pagging.php';
            $pcnt = $this -> mFriendsOnPage;
            $page = _v('page', 1);
            $mpage   =   new Pagging($pcnt, $cnt_ar_friends, $page, '');
            $range   =& $mpage -> GetRange( );
            if(!$mutual)
            {
                $ar_friends = $this -> moFriends -> GetUserFriends(UID_OTHER, $range[0], $pcnt, $ar, 0, $filter, 0, 0, 0, ($this -> mCurFid > 999 ? $this -> mCurFid : 0));
                
                // Count common friends
                $imax = count($ar_friends);
                foreach($ar_friends as &$fr)
                {
                    $fr['mutual'] = $this -> moFriends -> GetUserFriendsCount( $fr['uid'], array(1,2,3), 0, '', (defined('UID') ? UID : 0) );
                }
            }
            else
            {
                $ar_friends = $this -> moFriends -> GetUserFriends(UID_OTHER, $range[0], $pcnt, $ar, 0, $filter, UID, 0, 0, ($this -> mCurFid > 999 ? $this -> mCurFid : 0));
            }
           
            $this -> mSmarty -> assign('pagging',  $mpage   -> Make($this -> mSmarty, '', 'oFriends.FriendPage'));

            $this -> mSmarty -> assign('filt', $filter);

            $this -> mSmarty -> assign_by_ref('ar_friends', $ar_friends);
            $this -> mSmarty -> assign_by_ref('cnt_ar_friends', $cnt_ar_friends);
            $this -> mSmarty -> assign('mutual', $mutual);

            $this -> mSmarty -> assign_by_ref('_content', $this -> mSmarty -> Fetch('mods/friends/_list.html'));

            if (_v('pcnt') && _v('rcnt'))
            {
                $this -> mSmarty -> display('mods/friends/_friends_list.html');
                exit();
            }
        }
    }/** GetList */


    public function GetListAjax()
    {
        $ar    = array();
        $ar_fr = array();
        $show_list = (string)_v('show_list');
        $fr_id     = (int)_v('fr_id');
        $filter    = (string)_v('filter');
        $target    = (string)_v('target');
        $spec_filt = (string)_v('spec_filt');
        $page      = (int)_v('page', 1);

        if ($show_list)
        {
            $show_list = base_chk2(_v('show_list'));
        }
        switch ($show_list)
        {
            case 'all':
                $ar  = array(1);
                break;
            case 'common':
                $ar  = array(1);
                break;
            case 'blocked':
                 $ar  = array(2, 3);
                 break;
            default:
                $ar  =array(1);
                break;
        }

        switch($spec_filt)
        {
            case 'last_add':
                $order = 'f.pdate DESC';
                break;
            default:
                $order = 'u.first_name ASC';
                break;
        }
  
        if ('common' == $show_list)
        {
            $ar_fr = $this -> moFriends -> GetUserFriends( $fr_id, $this -> mFriendsOnPage * ($page - 1), $this -> mFriendsOnPage, $ar, 0, $filter, defined('UID') ? UID : 0 );
            $cnt_ar_fr = $this -> moFriends -> GetUserFriendsCount( $fr_id, $ar, 0, '', UID );
        }
        elseif('online' == $spec_filt)
        {
            $ar_fr = $this -> moFriends -> GetFrOnline( $fr_id, $ar, -1, -1, $order );
            $cnt_ar_fr = count($ar_fr);
        }
        elseif('my classes' == $spec_filt)
        {
            $ar_fr = $this -> moFriends -> GetFrClassmate($fr_id, $ar, -1, -1, $order);
            $cnt_ar_fr = count($ar_fr);
        }
        else
        {
            $tm = 0;
            if ('last_add'==$spec_filt)
            {
                $tm = strtotime('now - 7days');
            }

            $ar_fr = $this -> moFriends -> GetUserFriends( $fr_id, $this -> mFriendsOnPage * ($page - 1), $this -> mFriendsOnPage, $ar, $tm, $filter, 0, $order, (defined('UID') ? UID : 0), 0,  -1/*, $spec_filt*/ );
            $cnt_ar_fr = $this -> moFriends -> GetUserFriendsCount( $fr_id, $ar );
        }
        
        if(0 < $cnt_ar_fr)
        {
            // Count common friends
            $imax = count($ar_fr);
            foreach($ar_fr as &$fr)
            {
                $fr['mutual'] = $this -> moFriends -> GetUserFriendsCount( $fr['uid'], array(1,2,3), 0, '', (defined('UID') ? UID : 0) );
            }

            include_once 'View/Acc/Pagging.php';
            $mpage   =   new Pagging($this -> mFriendsOnPage, $cnt_ar_fr, $page, '');
            $pagging = $mpage -> Make($this -> mSmarty, '', 'oFriends.GetListAjax', $fr_id . "','" . $show_list . "','" . $filter . "','" . $target . "','" . $spec_filt);
            $is_user = (UID == $fr_id) ? 1 : 0;
            $this -> mSmarty -> assign('IS_USER', $is_user);
            $this -> mSmarty -> assign('pagging', $pagging);
            $this -> mSmarty -> assign('ar_friends', $ar_fr);
            $this -> mSmarty -> assign('cnt_ar_friends', $cnt_ar_fr);
            $this -> mSmarty -> assign('profile_owner', $cnt_ar_fr);

            if($target == 'contactsList')
            {
                $this -> mSmarty -> display('mods/friends/_profile_contacts_list.html');
            }
        }
        $this -> mSmarty -> display('mods/friends/_list.html');
        n_exit();
    }


    /**
     * Get list of friends (for ajax update)
     */
    public function GetListAjaxMain()
    {
        $param = (string)_v('param');
        $pcnt = $this -> mFriendsOnPage;
        $page = _v('page', 1);

        if (IS_USER)
        {
            switch ($this -> mCurFid)
            {
                case FOLDER_ALL:
                    $ar  =array(1,2,3);
                    break;
                case FOLDER_FRIENDS:
                    $ar  =array(1);
                    break;
                case FOLDER_FAVOURITES:
                    $ar  =array(2);
                    break;
                case FOLDER_BLOCKED:
                    $ar  =array(3);
                    break;
                default :
                    $ar  =array(1,2,3);
                    break;
            }
        }
        else
            $ar = array(1);

        $filter = '';

        

        $ar_friends = $this -> moFriends -> GetUserFriends(UID_OTHER, ($page - 1) * $pcnt, $pcnt, $ar, 0, $filter, 0, 0, 0, ($this -> mCurFid > 999 ? $this -> mCurFid : 0));
        $cnt_ar_friends = $this -> moFriends -> GetUserFriendsCount(UID_OTHER, $ar, 0, $filter);


        $this -> mSmarty -> assign_by_ref('ar_friends', $ar_friends);
        //$this -> mSmarty -> assign_by_ref('cnt_ar_friends', $cnt_ar_friends);

        include_once 'View/Acc/Pagging.php';
        $mpage   =   new Pagging($pcnt, $cnt_ar_friends, $page, '');
        $res['pagging'] = $mpage   -> Make($this -> mSmarty, '', 'oFriends.FriendPage');

        $res['q'] = 'ok';
        $res['data'] = $this -> mSmarty -> Fetch('mods/friends/_friends_list_main_ajax.html');
        echo Ar2Json($res);
        exit();
    }/** GetListAjaxMain */


    public function Edit()
    {
        $action = base_chk(_v('action'));
        $active = (int)_v('active');
        $fr_id  = (int)_v('fr_id');
        
        if (UID != $fr_id)
        {
            $fr_ex = $this -> moUser -> mUser -> Get( $fr_id );
            if ($action && $fr_ex)
            {
                if ('add' == $action)
                {
                    $mes = base_chk(_v('mes'));
                    $inv_res = $this -> moFriends -> AddFriend( UID, $fr_id, $mes, 0 );

                    /** Clear cache */
                    $this -> moCache -> delete('user_'.UID.'_friends');
                    $this -> moCache -> delete('user_'.UID.'_friends_block');
                    $this -> moCache -> delete('user_'.$fr_id.'_friends');
                    

                    //--send a notification
                    $ntype = 50;
                    $n_ad_info = $mes ? $mes : '';
                    
                    if (1 == $fr_ex['notify_news'])
                    {
                        $s_notify = $this -> mlObj['notify'] -> UpdUNotify( $ntype, 1, $n_ad_info, '', '', UID, $fr_id);
                    }

                    uni_redirect( '#' );
                }
                elseif ('del' == $action)
                {
                    $this -> moFriends -> DelFriend( UID, $fr_id );

                    /** Clear cache */
                    $this -> moCache -> delete('user_'.UID.'_friends');
                    $this -> moCache -> delete('user_'.UID.'_friends_block');
                    $this -> moCache -> delete('user_'.$fr_id.'_friends');

                    /** delete old notifications */
                    $this -> mlObj['notify'] -> DelNotify(UID, $fr_id, -1, 50);

                    //--send a notification
                    $ntype = 51;
                    if (1 == $fr_ex['notify_news'])
                    {
                        //notify about delete
                        //$s_notify = $this -> mlObj['notify'] -> UpdUNotify( $ntype, 1, '', '', '', UID, $fr_id);
                    }

                    $http_referer = explode('/', $_SERVER['HTTP_REFERER']);
                    if(!empty($http_referer) && $http_referer[count($http_referer) - 1] == 'friends')
                    {
                        uni_redirect( $_SERVER['HTTP_REFERER'] );
                    }

                    uni_redirect( PATH_ROOT . '' );
                }
                elseif (('edit' == $action) && in_array($active, array(0,1,2,3)))
                {
                    $this -> moFriends -> UpdInvite( UID, $fr_id, $active );
                    n_exit();
                }
                elseif ('delMass' == $action)
                {
                    $ids = _v('ids');
                    if (!is_array($ids))
                        $ids = array($ids);

                    $cnt = count($ids);
                    for ($i = 0; $i < $cnt; $i++)
                    {
                        $ids[$i] = (int)$ids[$i];
                        $this -> moFriends -> DelFriend( UID, $ids[$i] );
                    }
                    uni_redirect( PATH_ROOT.'friends'.UID.'/fid='.$this -> mCurFid );
                }
            }
        }
        uni_redirect(PATH_ROOT.'id'.UID_OTHER);
    }


    public function EditFriendsFoldersAjax()
    {
        $action = (string)_v('action');
        $tbl_fr_id = (int)_v('tbl_fr_id');
        $fid = (int)_v('fid');

        if($tbl_fr_id && $fid && $action)
        {
            switch($action)
            {
                case 'add':
                    $this -> moFriends -> AddFriendToFolder($tbl_fr_id, $fid);
                    break;
                case 'del':
                    $this -> moFriends -> DelFriendFromFolder($tbl_fr_id, $fid);
                    break;
            }
        }

        n_exit();
    }


    public function GetFrAjax()
    {
        $fr_id = _v('fr_id', 0);
        if ($fr_id)
        {
            $ar_friend = $this -> moUser -> mUser -> Get($fr_id);
            $na = array('uid', 'first_name', 'last_name', 'image', 'fpath');
            foreach ($na as $v)
            {
                $af[$v] = $ar_friend[$v];
            }
            $ar_friend = $af;
        }

        if (!empty($ar_friend))
            echo Ar2Json($ar_friend);

        n_exit();
    }/** GetFrAjax */


    public function FrListByNameAjax()
    {
        $q = _v('q');
        if ($q)
        {
            $fr = $this -> moFriends -> GetUserFriends( UID, 0, 0, array(1), 0, $q );
        }
        if (!empty($fr))
        {
            foreach ($fr as $k => $r)
            {
                echo $r['uid'].'|'.$r['first_name'].' '.$r['last_name']."\n";
            }
        }
        n_exit();
    }/* FrListByNameAjax */


    public function InviteActAjax()
    {
        $fr_id  = (int)_v('fr_id');
        $action = (int)_v('action');

        $fr_ex = $this -> moUser -> mUser -> Get( $fr_id );

        if (!empty($fr_ex))
        {
            $in_ex = $this -> moFriends -> CheckInvite(UID, $fr_id);
            if ($in_ex && $action)
            {
                if (in_array($action, array(1,2,3)))
                {
                    if (1 == $action)	//accept

                    {
                        $this -> moFriends -> UpdInvite( UID, $fr_id, 1  );
                        $ntype = 60;
                    }
                    elseif (2 == $action)	//delete
                    {
                        $this -> moFriends -> DelFriend( UID, $fr_id );
                        $ntype = 61;
                    }
                    elseif (3 == $action)	//ignore
                    {
                        $this -> moFriends -> UpdInvite( UID, $fr_id, 3 );
                        $ntype = 62;
                    }

                    //-- notifications
                    $this -> mlObj['notify'] -> DelNotify( $fr_id, UID, -1, 50 );
                    if ( 1 == $fr_ex['notify_news'] && $action == 1 )
                    {
                        //send only after accept
                        $s_notify = $this -> mlObj['notify'] -> UpdUNotify( $ntype, 1, '', '', '', UID, $fr_id);
                       // $this -> mlObj['notify'] -> AddENentry(UID, $fr_id, 1,);
                    }

                    if (1==$action || 2==$action)
                    {
                        //echo $this -> GetListAjaxMain();
                    }

                }
                else
                    echo 'not_success';
            }
            else
                echo 'not_success';
        }
        else
            echo 'not_success';
        n_exit();
    }/* InviteActAjax */


    public function EditFrActive()
    {
        $active = (int)_v('active');
        $fr_id = (int)_v('fr_id');

        if ($fr_id)
        {
            $this -> moFriends -> EditFrActive( UID, $fr_id, $active );
            
            $this -> moCache -> delete('user_'.UID.'_friends');
            $this -> moCache -> delete('user_'.UID.'_friends_block');
            $this -> moCache -> delete('user_'.$fr_id.'_friends');
            
            echo json_encode( array('res' => $active, 'fr_id' => $fr_id));
            
        }
        else
        {
            echo json_encode( array('res' => 'not_success'));
        }
        exit();
    }/* EditFrActive */


    public function InviteFriendsAjax()
    {
        $fr_id = _v('fr_id', 0);
        $res   = array('q' => 'err');
        
        if ($fr_id && $fr_id != UID)
        {
            $fr_ex = $this -> moUser -> mUser -> Get($fr_id);
            $ui    = $this -> moUser -> mUser -> Get(UID);

            if (!empty($fr_ex))
            {  
                $mesg  = base_chk(_v('mesg', ''));
                $friend_status  = $this -> moFriends -> AddFriend( UID, $fr_id, $mesg, 0 );

                /** Clear cache */
                $this -> moCache -> delete('user_'.UID.'_friends');
                $this -> moCache -> delete('user_'.UID.'_friends_block');
                $this -> moCache -> delete('user_'.$fr_id.'_friends');

                //--send a notification
                if($fr_ex['email'])
                {   
                    $this -> mlObj['notify'] -> AddENentry(UID, $fr_id, 1, array('msg' => $mesg));
                }
                
                if (!empty($fr_ex['notify_news']) && 1 == $fr_ex['notify_news'])
                {
                    $ntype = 50;
                    $s_notify = $this -> mlObj['notify'] -> UpdUNotify( $ntype, 1, $mesg, '', '', UID, $fr_id);
                }

                /**
                 * Убираем нотификацию о приглашении в друзья (с кнопками)
                 */
                if (2==$friend_status)
                {
                    $ntype = 50;
                    $this -> mlObj['notify'] -> DelNotifyFull(UID, $fr_id, 1, $ntype); 
                }

                /**
                 * return
                 */
                $res['fr_id'] = $fr_id;
                $res['q']   = 'ok';
                $res['res'] = 1==$friend_status ? 'invite' : 'friend';
            }
        }

        header("Content-type: text/plain");
        include_once 'Ctrl/Ajax/Json.php';
        $mJson = new Services_JSON();
        echo $mJson->encode($res);

        exit();
    }/** InviteFriendsAjax */


    public function ChngFrList()
    {
        $sb = (int)_v('sb');
        if ($sb)
        {
            $ar_fr = array();
            switch ($sb)
            {
                case 0:
                    $ar_fr = $this -> moFriends -> GetUserFriends( UID, 0, 0, array(1), strtotime('now - 7days') );
                    $cnt_ar_fr = $this -> moFriends -> GetUserFriendsCount( UID, array(), strtotime('now - 7days') );
                    break;
                case 1:
                    $ar_fr = $this -> moFriends -> GetUserFriends( UID, 0, 0, array(1), 0, '', 0, 'u.first_name, u.last_name' );
                    $cnt_ar_fr = $this -> moFriends -> GetUserFriendsCount( UID );
                    break;
                case 2:
                    $ar_fr = $this -> moFriends -> GetUserFriends( UID, 0, 0, array(2) );
                    $cnt_ar_fr = $this -> moFriends -> GetUserFriendsCount( UID, array(2) );
                    break;
                case 3:
                    $ar_fr = $this -> moFriends -> GetFrOnline( UID, array(1) );
                    $cnt_ar_fr = count($ar_fr);
                    break;
            }
        } else
            echo 'not_success';
        exit();
    } 


    //<Folders>
    public function UpdateFolder()
    {
        //print_r($_REQUEST);
        $rename = strip_tags(_v('rename', ''), ' ');
        $pass   = _v('pass', '');

        if ($rename)
        {
            $this -> moFriends -> AddUpdateFolder($this -> mFid, $rename, $pass);
        }

        if (_v('jx', ''))
            $this -> _GlobalRedirect();
        n_exit();
    }

    public function DeleteFolder()
    {
        if ($this -> mFid)
            $this -> moFriends -> DeleteFolder($this -> mFid);

        if (_v('jx'))
            $this -> _GlobalRedirect();
    }

    public function CheckFolderPass()
    {
        $res  = 0;
        $pass = _v('pass');

        if ($this -> mFid && $pass)
        {
            $res = $this -> moFriends -> CheckFolderPass($this -> mFid, $pass);
        }

        echo $res;
        n_exit();
    }
    public function GetFoldersList()
    {
        $folders =& $this -> moFriends -> GetFolders();

        $this -> mSmarty -> assign_by_ref('folders', $folders);

        $this -> mSmarty -> display('mods/friends/_folders_list.html');

        n_exit();
    }
    //</Folders>

    public function Index()  //** Index of Friends

    {
        if(IS_USER)
        {
            if (0 >= $this -> mCurFid || !$this -> moFriends -> CheckFolderExists($this -> mCurFid, UID))
            {
                page404();
            }
            $this -> GetList();
        }
        else
        {
            uni_redirect( PATH_ROOT);
        }
    }/** IndexFriends */




}/** Ctrl_Base_Friends */
?>
