<?php

/**
 * Wall controller
 *
 * @package    5dev Wall
 * @version    1.0
 * @since      1.03.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */
class Ctrl_Profile_Wall extends Ctrl_Base
{

    //system params
    public  $moWall;
    private $filts;
    private $sfilts;
    private $fpath;
    private $fpath_tmp;
    //handle params
    private $cnt_p_upl; //count of the uploading photos

    private $wtype; // type of this wall

    private $badge_pic;// the list of badge pictures
    private $status_array;//smile status array of name=>variations
    private $first_visit;
    /**
     * Constructor
     *
     * @param $glObj
     * @return void
     */
    public function __construct(&$glObj)
    {

        parent :: __construct($glObj);

        if (!defined('UID'))
            uni_redirect(PATH_ROOT . '');

        require_once 'Model/Base/Friends.class.php';
        $this->moFriends = new Model_Base_Friends($glObj['gDb']);
        $this->filts = $this->_initFilts();  //get table Filters
        $this->sfilts = $this -> _initSFilts(); //get table sub Filters
        $this->_initSmileStatus($this->status_array);//get smile_status array
        $this->_initBadgeList($this->badge_pic);//the list of the badges

        require_once 'Model/Profile/Wall.class.php';
        $this->moWall = new Model_Profile_Wall($glObj['gDb']);

        include_once 'Model/Profile/Profile.class.php';
        $this->moProfile = new Model_Base_Profile($glObj['gDb']);

        $this->mSmarty->assign('m_page', 'wall');
        $this->fpath = DIR_WS_IMAGE . 'wall/';
        $this->fpath_tmp = DIR_WS_IMAGE . 'wall/_temp/';

        $this -> wtype = $this -> moWall -> GetWtype();
        if (UID == UID_OTHER)
        {
            if ( $this -> moUser -> mUi['ward_id'] == 0 )
            {
                if ((mktime() - $this -> moUser -> mUi['last_show'])<7*24*3600)
                     $this -> mSmarty -> assign('show_ward', 0);
                else $this -> mSmarty -> assign('show_ward', 1);
            }
        }
        #global privacy
        if ($this -> moUser -> mUi['is_deleted'])
        {
            $this->mSmarty->assign('_content', '<center><h3>This user was deleted</h3></center>');
            $this->mSmarty->assign('no_access', true);
            $this -> mSmarty -> assign('gCnt', $GLOBALS['gCnt']);
            $this -> mSmarty -> assign('gTime', get_mt_time() - $GLOBALS['gtime']);
            $this -> mSmarty -> display('main.html');
            die();
        }
        elseif (!IS_USER && !$this -> moUser -> mUi['global']['news'])
        {
            $this->mSmarty->assign('_content', '<center><h3>This section is set to private</h3></center>');
            $this->mSmarty->assign('no_access', true);
            $this -> mSmarty -> assign('gCnt', $GLOBALS['gCnt']);
            $this -> mSmarty -> assign('gTime', get_mt_time() - $GLOBALS['gtime']);
            $this -> mSmarty -> display('main.html');
            die();
        }
    }


    //---- System Methods

    /**
     * Initialization of privacy
     *  ar_filts:
     * 			1 - friends & subscribers (1 - yes, 0 - not)
     * 			2 - friend (1 - yes, 0 - not)
     * 			3 - only family (1 - yes, 0 - not)
     * 			4 - one (some person)
     * 			5 - private (only me)
     *
     * @return filters array (ptype => uvid)
     */
    public function _initFilts()
    {
        $u_other = $this->moUser->mUi;
//deb($u_other['im_fam']);
        $ar_filts = array(
                          0 => UID,
                          1 => (int)($u_other['im_suscr_fr'] || 1==$u_other['im_friend']) ,
                          2 => 1==$u_other['im_friend'] ? 1 : 0,
                          3 => $u_other['im_fam'],
                          4 => UID,
                          5 => UID,
                          100 => $this->moUser->mUinfo['ward_id']/*$this->moUser->mProfile->GetWardId(UID)*/,
                          101 => $this->moUser->mUinfo['stake_id']/*$this->moUser->mProfile->GetStakeId(UID)*/); // 4 => UID ?????
        return $ar_filts;
    }


    public function _initSFilts()
    {
        $classes = $this -> moUser -> mProfile -> GetSchoolClassList(UID, $this->moUser->mUinfo['ward_id']/*$this->moUser->mProfile->GetWardId(UID)*/);
        $ar_sfilts = array('priesthold' => $this->moUser->mUinfo['priesthood'], 'classes' => $classes);
        return $ar_sfilts;
    }

    public function _initSmileStatus(&$status_array = array())
    {
        $status_array['happy']=array('happy about this','is happy about this','are happy about this');
        $status_array['laugh']=array('laughing at this','is laughing at this','are laughing at this');
        $status_array['wink']=array('winking at this','is winking at this','are winking at this');
        $status_array['bless']=array('sending my blessings','sent you blessings','sent you blessings');
        $status_array['love']=array('loving this','is loving this','are loving this');
        $status_array['shock']=array('shocked by this','is shocked by this','are shocked by this');
        $status_array['sad']=array('sad about this','is sad about this','are sad about this');
    }

    public function _initBadgeList(&$badge_pic = array())
    {
        $badge_pic = array("Angel","Book","BYU","CTR","Inzion","LDS","RM","Temple","UofU","UVU");
    }
   
    //---- Main Methods
    //--Get & Edit Wall Info
    public function GetEdit()
    {
   /* $_REQUEST =         Array
    (
    'type' => 'Profile',
    'mod' => 'Wall',
    'uid' => '2519',
    'what' => 'Getedit',
    'WI' => Array
        (
            'story'=> '',
        ),

    'SI' => Array
        (
            'privacy' => 5,
            'sub_privacy_module' => 0,
            'sub_privacy_module_val' => 0,
            'sub_privacy_class' => 0
        ));
    *
    * 
    */
//deb($_REQUEST);
        $errs = array();
        $wi = array(); //Wall info (story, ev_title, l_url & etc.)
        $si = array(); //System info (privacy, is_answ, mes_id, answ_id & etc.)

        $wi = _v('WI');
        $si = _v('SI');
        //deb($si);
        if (isset($wi['ev_img']) && $wi['ev_img'] == '')
        {
            $wi['ev_img'] = 'none';
        }

        if (!empty($wi))
        {//edit Wall info

            /* Set the necessery to complete fields
              $mtype - 1 - message, 2 - event, 3 - link, 4 - photo, 5 - video */
            $n_data = array(); //necessary data array
            isset($wi['mtype']) ? $mtype = (int) $wi['mtype'] : $mtype = 0;
            if (!empty($mtype))  //if additional attaches exists - do check & mes are not checked, else - mes checking
            {
                switch ($mtype)
                {
                    //badge
                   /* case 1:
                        $n_data = array('story','sub_mtype','b_img_name');
                        break;*/
                    case 2:
                        $n_data = array('ev_title', 'ev_where', 'ev_dt', 'ev_img', 'ev_descr');
                        break;
                    case 3:
                        $n_data = array('l_url');
                        break;
                    case 4:
                        if (!isset($wi['p_img']))
                        {
                            $n_data = array('p_url'); //if uploading photo from URL
                        }
                        else
                        {
                            $n_data = array('p_img'); //if uploading photo from PC
                        }
                        break;
                    case 5:
                        if (!isset($wi['v_file']))
                        {
                            $n_data = array('v_code'); //if uploading video from Code
                        }
                        else
                        {
                            $n_data = array('v_file'); //if uploading video from PC
                        }
                        break;
                    default:
                        $errs[] = 'Incorrect flag has been detected - "' . $mtype . '"';
                        break;
                }
            }
            else
            {
                if (isset($wi['sub_mtype']))
                {
                  $n_data = array('story','sub_mtype','b_img_name');
                }
                else $n_data = array('story');
            }

            $ex_cols = $this->moWall->GetCols(); //data's columns in DB
            if (!empty($n_data))
            {

                foreach ($wi as $k => $r)
                {
                    if (empty($k) || empty($r))
                        continue;

                    if ('p_img' != $k && 'v_file' != $k && !in_array($k, $ex_cols))
                    {//additional check by existing fields in DB
                        unset($wi[$k]);
                    }
                    else
                    {
                        if (in_array($k, $n_data) && empty($r))
                        {//check filling all the necessary fields
                            $errs[] = 'Required field - "' . $k . '" - has been left blank or incomplete';
                        }

                        if (3 == $mtype && 'l_url' == $k)
                        {//check link
                            $wi_k[] = base_chk($k);
                            if (chk_link($wi['l_url']))
                            {
                                $wi_r[] = chk_link($wi['l_url']);
                            }
                            else
                            {
                                $errs[] = 'Incorrect data has been detected - "' . $wi['l_url'] . '"';
                            }
                        }
                        elseif (4 == $mtype && 'p_img' == $k)
                        {//check photo
                            $cnt_wi_pimg = isset($wi['p_img']) ? count($wi['p_img']) : 0;
                            $this->cnt_p_upl = $cnt_wi_pimg;
                            $l_el = !count($wi_k) ? 0 : count($wi_k) - 1;

                            //get ID of the current system_album
                            require_once 'Model/Base/Albums.class.php';
                            $moAlbums = new Model_Base_Albums($this->mlObj['gDb']);
                            $ualb_sys = $moAlbums->GetUAlbums(UID, 2);
                            foreach ($ualb_sys as $k => $r)
                            {
                                if ('Wall' == $r['name'])
                                {
                                    $swall_id = $r['aid'];
                                    break;
                                }
                            }

                            for ($i = 1; $i <= $cnt_wi_pimg; $i++)
                            {
                                $cur_el = $l_el + $i;
                                $wi_k[$cur_el] = 'p_img_' . $i;
                                if (is_array($wi['p_img']))
                                {
                                    $wi_r[$cur_el] = $wi['p_img'][$i - 1];
                                }
                                else
                                {
                                    $wi_r[$cur_el] = $wi['p_img'];
                                }
                                $tfolder = $this->fpath_tmp; //temp folder
                                $folder = $this->fpath . GetPostfix(UID) . '/'; //necessary folder
                                if (!file_exists($folder)) //create temp subdirectory
                                {
                                    mkdir($folder, 0777);
                                    chmod($folder, 0777);
                                }
                                if (!file_exists($folder . 'n/'))
                                {
                                    mkdir($folder . 'n/', 0777);
                                    chmod($folder, 0777);
                                }
                                if (!file_exists($folder . 'a/'))
                                {
                                    mkdir($folder . 'a/', 0777);
                                    chmod($folder, 0777);
                                }
                                if (!file_exists($folder . 'm/'))
                                {
                                    mkdir($folder . 'm/', 0777);
                                    chmod($folder, 0777);
                                }
                                if (!file_exists($folder . 's/'))
                                {
                                    mkdir($folder . 's/', 0777);
                                    chmod($folder, 0777);
                                }



                                if (file_exists($tfolder . $wi_r[$cur_el]))
                                {//copy files int the necessary folder
                                    if (copy($tfolder . $wi_r[$cur_el], $folder . $wi_r[$cur_el]) &&
                                            copy($tfolder . 'n/n_' . $wi_r[$cur_el], $folder . 'n/n_' . $wi_r[$cur_el]) &&
                                            copy($tfolder . 'm/m_' . $wi_r[$cur_el], $folder . 'm/m_' . $wi_r[$cur_el]) &&
                                            copy($tfolder . 's/s_' . $wi_r[$cur_el], $folder . 's/s_' . $wi_r[$cur_el]) &&
                                            copy($tfolder . 'a/a_' . $wi_r[$cur_el], $folder . 'a/a_' . $wi_r[$cur_el])) //after copying do unlink
                                    {
                                        unlink($tfolder . 'n/n_' . $wi_r[$cur_el]);
                                        unlink($tfolder . 'a/a_' . $wi_r[$cur_el]);
                                        unlink($tfolder . 'm/m_' . $wi_r[$cur_el]);
                                        unlink($tfolder . 's/s_' . $wi_r[$cur_el]);
                                        unlink($tfolder . $wi_r[$cur_el]);
                                    }
                                    else
                                        $errs[] = 'Some files could not be copyed';
                                }
                                else
                                    $errs[] = 'Required file does not exist in the temporary directory';

                                //put info about photo into the Albums & table of this wall
                                if (empty($errs))
                                {
                                    if (isset($swall_id))
                                    {
                                        $wpar = array('aid', 'img', 'descr', 'fpath',);
                                        $wval = array($swall_id, $wi_r[$cur_el], '', GetPostfix(UID));
                                        if ($wi_r[$cur_el + 10] = $moAlbums->UpdImg($wpar, $wval))
                                        {
                                            $wi_k[$cur_el + 10] = 'p_img_' . $i . '_id';
                                        }
                                    }
                                }
                            }

                            $wi_k = array_merge(array('p_path', 'p_img_aid'), $wi_k); //add path to photo data in DB
                            $wi_r = array_merge(array(GetPostfix(UID), $swall_id), $wi_r);
                        }
                        elseif (4 == $mtype && 'p_url' == $k)
                        {//check photo
                            $l_el = !count($wi_k) ? 0 : count($wi_k) - 1;

                            //get ID of the current system_album
                            require_once 'Model/Base/Albums.class.php';
                            $moAlbums = new Model_Base_Albums($this->mlObj['gDb']);
                            $ualb_sys = $moAlbums->GetUAlbums(UID, 2);
                            foreach ($ualb_sys as $k => $r)
                            {
                                if ('Wall' == $r['name'])
                                {
                                    $swall_id = $r['aid'];
                                    break;
                                }
                            }

                            $cur_el = $l_el + 1;
                            $wi_k[$cur_el] = 'p_url';
                            $wi_r[$cur_el] = $wi['p_url'];

                            //put info about photo into the Albums & table of this wall
                            if (isset($swall_id))
                            {
                                $wpar = array('aid', 'img', 'descr', 'fpath',);
                                $wval = array($swall_id, $wi_r[$cur_el], '', 'link');

                                if ($wi_r[$cur_el + 10] = $moAlbums->UpdImg($wpar, $wval))
                                {
                                    $wi_k[$cur_el + 10] = 'p_img_1_id';
                                }
                            }

                            $wi_k = array_merge(array('p_img_aid'), $wi_k); //add path to photo data in DB
                            $wi_r = array_merge(array($swall_id), $wi_r);
                        }
                        elseif (5 == $mtype) //check video code
                        {
                            
                            if ('v_code' == $k)
                            {
                                $e_code = chk_embed_code($r);
                                
                                $wi_k[] = base_chk($k);
                                $wi_r[] = $e_code;
  
                                //get ID of the current system_album
                                require_once 'Model/Base/Valbums.class.php';

                                $moVAlbums = new Model_Base_Valbums($this->mlObj['gDb']);
                                $ualb_sys = $moVAlbums->GetUValbums(UID_OTHER, 2);

                                foreach ($ualb_sys as $k => $r)
                                {
                                    if ('Wall' == $r['name'])
                                    {
                                        $svwall_id = $r['vaid'];
                                        break;
                                    }
                                }

                                
                                //put info about video into the Albums & table of this wall
                                if (empty($errs))
                                {
                                    //deb($j = array($svwall_id, $wi_r, $wi_k));

                                    if (isset($svwall_id))
                                    {
                                        //add video to album
                                        $wpar = array('vaid', 'video', 'descr');
                                        $wval = array($svwall_id, $e_code, '');
                                        $wi_k[10] = 'v_code_id';
                                        $wi_r[10] = $moVAlbums->UpdVideo($wpar, $wval);
                                        
                                    }
                                }
                            }
                            else if ('v_file' == $k)
                            {
                                $cnt_wi_vfile = isset($wi['v_file']) ? count($wi['v_file']) : 0;
                                $l_el = !count($wi_k) ? 0 : count($wi_k) - 1;

                                for ($i = 1; $i <= $cnt_wi_vfile; $i++)
                                {
                                    $cur_el = $l_el + $i;
                                    $wi_k[$cur_el] = 'v_file_' . $i;
                                    if (is_array($wi['v_file']))
                                    {
                                        $wi_r[$cur_el] = $wi['v_file'][$i - 1];
                                    }
                                    else
                                    {
                                        $wi_r[$cur_el] = $wi['v_file'];
                                    }
                                    //$wi_r[$cur_el] = $wi['v_file'][$i-1] ? is_array($wi['v_file']) : $wi_r[$cur_el] = $wi['v_file'];
                                }
                            }
                            else
                            {
                                $wi_k[] = base_chk($k);
                                $wi_r[] = base_chk5($r, 8192);
                            }
                        }
                        else //check other elements
                        {
                            $wi_k[] = base_chk($k);

                            if ($k == 'ev_title')
                            {
                                $wi_r[] = base_chk5($r, 80);
                            }
                            elseif ($k == 'ev_where')
                            {
                                $wi_r[] = base_chk5($r, 80);
                            }
                            elseif ($k == 'ev_dt')
                            {
                                $wi_r[] = date('Y-m-d H:i:s', strtotime($r));
                            }
                            else
                            {
                                $wi_r[] = base_chk5($r, 8192);
                            }
                        }
                    }
                }
              }
         
            if (empty($errs) && !empty($wi_k) && !empty($wi_r))
            {
                $tfolder = $this->fpath_tmp; //temp folder
                $folder  = $this->fpath . GetPostfix(UID) . '/'; //necessary folder

                if ($mtype == 2 && !empty($wi['ev_img']) && file_exists($tfolder . 't/' . $wi['ev_img']))
                {
                    if (!file_exists($folder))
                    {
                        mkdir($folder, 0777);
                        chmod($folder, 0777);
                    }

                    if (!file_exists($folder . 't/'))
                    {
                        mkdir($folder . 't/', 0777);
                        chmod($folder, 0777);
                    }

                    if (copy($tfolder . 't/' . $wi['ev_img'], $folder . 't/' . $wi['ev_img'])) //after copying do unlink
                    {
                        unlink($tfolder . 't/' . $wi['ev_img']);
                    }
                }


                $wi_k    = array_merge(array('wuid', 'uid'), $wi_k); //add UID_OTHER & UID data in DB
                $mes_id  = isset($si['mes_id']) ? (int) $si['mes_id'] : 0;
                $privacy = isset($si['privacy']) ? (int) $si['privacy'] : 0;  //set privacy

                //send to current user
                $wi_r_c = array_merge(array(UID_OTHER, UID), $wi_r);

                /*
                deb($_REQUEST);
                echo '<pre>'.print_r($wi_k).'</pre>';
                deb($wi_r_c);
                */
                

                $id = $this -> moWall->Edit($mes_id, $wi_k, $wi_r_c);

                //-- check subprivacy
                $c_id =  ($id) ? $id : $mes_id;

                $sub_privacy = isset($si['sub_privacy']) ? (int) $si['sub_privacy'] : '';
                if (isset($si['sub_privacy_module']) && isset($si['sub_privacy_module_val']))
                {
                    $sub_privacy_module = $si['sub_privacy_module'];
                    $sub_privacy_module_val = (int) $si['sub_privacy_module_val'];
                }
                else
                {
                    $sub_privacy_module = '';
                    $sub_privacy_module_val = '';
                }
                
                
                $sub_privacy_class =  (isset($si['sub_privacy_class'])) ? $si['sub_privacy_class'] : 0;

                if ($sub_privacy_module)
                {
                    if ('priesthood' == $sub_privacy_module && $sub_privacy_module_val == 5 && $sub_privacy_class)
                    {
                        $uclist = $this->moUser->mUser->GetUsersByClass($sub_privacy_class);
                        $ulist_str = '';
                        if (count($uclist) > 0)
                        {
                            foreach ($uclist as $key => $val)
                            {
                                $ulist_str .= ( $key != 0 ? ', ' : '') . $val['uid'];
                            }
                            $pr_filt = 'u.uid IN (' . $ulist_str . ')';
                        }
                    }
                    elseif ('not_uid' != $sub_privacy_module)
                    {
                        $pr_filt = $sub_privacy_module . ' = ' . $sub_privacy_module_val;
                    }
                    else
                    {
                        $pr_filt = 'u.uid <> ' . $sub_privacy_module_val;
                    }
                }
                else
                {
                    $pr_filt = -1;
                }


                //deb($g = array($sub_privacy_module, $sub_privacy_module_val, $sub_privacy_class));

                $alr_send = array(); //users, who are already got message


                /**
                 *  Если пользователь пишет на чьей-то стене - обязательно делаем репост ему на стену
                 *  При этом закрываем это сообщение от других.
                 *  Сообщение не зависит от Privacy
                 */
                if (UID_OTHER != UID)
                {
                    $wi_k_new = array();
                    $wi_r_new = array();

                    $wi_k_new   = array_merge(array('is_copy', 'is_copy_mes'), $wi_k);
                    $wi_r_new   = array_merge(array(UID_OTHER, $c_id, UID, UID), $wi_r);
                
                    $alr_send[]  =  UID;
                    $send_mes_id = $this->moWall->Edit($mes_id, $wi_k_new, $wi_r_new);
                    
                    //считаем это сообщение приватным самому себе (!)
                    $this->moWall->EditPrivacy(5, $send_mes_id);
                }



                //send to all subscribers if has an access (everyone && fr&subscribers)
                if (0 == $privacy || 1 == $privacy)
                {
                    //-- check the existing of the sub privacy
                    $ar_subscr = $this->moUser->mUser->GetSubscr(-1, UID_OTHER, -1, -1, $pr_filt);

                    if ($ar_subscr)
                    {
                        foreach ($ar_subscr as $k => $r)
                        {
                            if (!in_array($r['uid'], $alr_send))
                            {
                                $wi_k_new = array();
                                $wi_r_new = array();
                                $wi_k_new = array_merge(array('is_copy', 'is_copy_mes'), $wi_k);
                                $wi_r_new = array_merge(array(UID_OTHER, $c_id, $r['uid'], UID), $wi_r);

                                // Send notif for "Share with"
                                if ($r['uid'] != UID && $r['uid'] != UID_OTHER && UID != UID_OTHER)
                                {
                                    /**
                                     * когда пишем на чьей-то стене - нотификации всем его подписчикам
                                     */
                                    $this->SendExternNotif(UID, $r['uid'], UID_OTHER, $wi['story'], isset($wi['mtype']) ? $wi['mtype'] : 1, $c_id);
                                }
                                else
                                {
                                    /**
                                     * пишем на своей стене - репост всем подписчикам
                                     */
                                    $id_subscr[] = $this->moWall->Edit($mes_id, $wi_k_new, $wi_r_new);
                                }
                                $alr_send[] = $r['uid'];
                            }
                        }
                    }
                }


                //send to all friends if has an access (everyone && friends && someone(from friends))
                if (0 == $privacy || 1 == $privacy || 2 == $privacy || 4 == $privacy)
                {
                    //-- check the existing of the sub privacy

                    $ar_friends = $this->moFriends->GetUserFriends(UID_OTHER, 0, 0, array(1), 0, '', 0, -1, 0, 0, $pr_filt);

                    if ($ar_friends)
                    {
                        foreach ($ar_friends as $k => $r)
                        {
                            if (!in_array($r['uid'], $alr_send))
                            {
                                $wi_k_new = array();
                                $wi_r_new = array();
                                $wi_k_new = array_merge(array('is_copy', 'is_copy_mes'), $wi_k);
                                $wi_r_new = array_merge(array(UID_OTHER, $c_id, $r['uid'], UID), $wi_r);

                                // Send notification for "Share with"
                                if ($r['uid'] != UID && $r['uid'] != UID_OTHER && UID != UID_OTHER)
                                {
                                    /**
                                     * когда пишем на чьей-то стене - нотификации всем его друзьям,
                                     * при условии что не отправили как подписчикам
                                     */
                                    $this->SendExternNotif(UID, $r['uid'], UID_OTHER, $wi['story'], isset($wi['mtype']) ? $wi['mtype'] : 1, $c_id);
                                }
                                else
                                {
                                    /**
                                     * пишем на своей стене - репост всем друзьям,
                                     * при условии что не отправили как подписчикам
                                     */
                                    $id_friends[] = $this->moWall->Edit($mes_id, $wi_k_new, $wi_r_new);
                                }
                                $alr_send[] = $r['uid'];
                            }
                        }
                    }
                }


                //send to family
                if (3 == $privacy)
                {
                    $ar_fam = $this->moProfile->GetFamilyList(UID_OTHER);
                    if ($ar_fam)
                    {
                        foreach ($ar_fam as $k => $r)
                        {
                            if (!in_array($r['wuid'], $alr_send))
                            {
                                $wi_k_new = array();
                                $wi_r_new = array();
                                $wi_k_new = array_merge(array('is_copy', 'is_copy_mes'), $wi_k);
                                $wi_r_new = array_merge(array(UID_OTHER, $c_id, $r['wuid'], UID), $wi_r);
                                // Send notif for "Share with"
                                if ($r['uid'] != UID && $r['uid'] != UID_OTHER && UID != UID_OTHER)
                                {
                                    /**
                                     * когда пишем на чьей-то стене - нотификации всей семье,
                                     * при условии что не отправили как подписчикам и друзьям
                                     */
                                    $this->SendExternNotif(UID, $r['uid'], UID_OTHER, $wi['story'], isset($wi['mtype']) ? $wi['mtype'] : 1, $c_id);
                                }
                                else
                                {
                                    /**
                                     * пишем на своей стене - репост всей семье,
                                     * при условии что не отправили как подписчикам и друзьям
                                     */
                                    $id_famalies[] = $this->moWall->Edit($mes_id, $wi_k_new, $wi_r_new);
                                }
                                $alr_send[] = $r['wuid'];
                            }
                        }
                    }
                }


                //update privacy
                if ($id || !empty($mes_id))
                {
                    if (in_array($privacy, array_keys($this->filts)))
                    {
                        //update privacy for all subscr if has an access
                        if (0 == $privacy || 1 == $privacy)
                        {
                            if (!empty($id_subscr))
                            {
                                foreach ($id_subscr as $k => $r)
                                {
                                    if ($r)
                                    {
                                        $c_id_subscr[$k] = $r;
                                    }
                                    else
                                    {
                                        $c_id_subscr[$k] = $mes_id;
                                    }
                                    $this->moWall->EditPrivacy($privacy, $c_id_subscr[$k], $this->filts[$privacy]);
                                }
                            }
                        }

                        //update privacy for all subscr if has an access
                        if (0 == $privacy || 1 == $privacy || 2 == $privacy || 4 == $privacy)
                        {
                            if (!empty($id_friends))
                            {
                                foreach ($id_friends as $k => $r)
                                {
                                    if ($r)
                                    {
                                        $c_id_friends[$k] = $r;
                                    }
                                    else
                                    {
                                        $c_id_friends[$k] = $mes_id;
                                    }

                                    $this->moWall->EditPrivacy($privacy, $c_id_friends[$k], $privacy == 4 ? $si['sub_privacy_module_val'] : $this->filts[$privacy]);
                                }
                            }
                        }

                        //update privacy for all family members
                        if (3 == $privacy)
                        {
                            if (!empty($id_famalies))
                            {
                                foreach ($id_famalies as $k => $r)
                                {
                                    if ($r)
                                    {
                                        $c_id_families[$k] = $r;
                                    }
                                    else
                                    {
                                        $c_id_families[$k] = $mes_id;
                                    }
                                    $this->moWall->EditPrivacy($privacy, $c_id_families[$k], $this->filts[$privacy]);
                                }
                            }
                        }

                        //update privacy for current user (everyone && fr&subscribers)
                        $_pr = 0; //в базе это uvid

                        if ($privacy == 0 && (int) $sub_privacy_module_val)
                        {
                            $_pr = $sub_privacy_module_val;
                        }
                        elseif ($privacy == 0 && (int) $sub_privacy_module_val == 0)
                        {
                            $_pr = 0;
                        }
                        elseif ($privacy == 4 && (int) $sub_privacy_module_val)
                        {
                            $_pr = $sub_privacy_module_val;
                        }
                        else
                        {
                            $_pr = $this->filts[$privacy];
                        }

                        if ($sub_privacy_module == 'ward_id')
                        {
                            $_pr = $sub_privacy_module_val;
                            $sub_privacy_module_val = 100;
                        }

                        if ($sub_privacy_module == 'stake_id')
                        {
                            $_pr = $sub_privacy_module_val;
                            $sub_privacy_module_val = 101;
                        }
                        $this->moWall->EditPrivacy($privacy, $c_id, $_pr, ( ($privacy == 1 || $privacy == 2) && in_array($sub_privacy_module, array('priesthood', 'stake_id', 'ward_id')) && $sub_privacy_module_val ? $sub_privacy_module_val : 0), ( ($privacy == 1 || $privacy == 2) && in_array($sub_privacy_module, array('priesthood')) && $sub_privacy_module_val == 5 ? $sub_privacy_class : 0));
                    }

                    //--send a notification
                    $mtype = isset($wi['mtype']) ? $wi['mtype'] : 1;
                    switch ($mtype)
                    {
                        case 1:
                            $ntype = 1;
                            break;
                        case 2:
                            $ntype = 4;
                            break;
                        case 3:
                            $ntype = 5;
                            break;
                        case 4:
                            $ntype = 2;
                            break;
                        case 5:
                            $ntype = 3;
                            break;
                        default:
                            $ntype = 1;
                    }

                    $n_ad_info = isset($wi['story']) ? $wi['story'] : '';

                    if (1 == $this->moUser->mUi['notify_news'] && !IS_USER)
                    {
                        $s_notify = $this->mlObj['notify']->UpdUNotify($ntype, 1, $n_ad_info);
                    }

                    if (!IS_USER)
                    {
                        $this->mlObj['notify']->AddENentry(UID, UID_OTHER, 2, array('msg' => $n_ad_info));
                    }


                    /**
                     * Готовим возврат
                     */
                    $mai = $this->moWall->GetOne($c_id, array(), UID); //if IS_USER - without filtering
                    $mai['wtype'] = $this->wtype;

                    if (!empty($mai))
                    {
                        if (3 == $mai['mtype'] && $mai['l_url'])
                        {
                            $l = $this->moWall->GetUrlTitle($mai['l_url']);
                            if (!empty($l))
                            {
                                $mai['l_url_label'] = trim($l);
                            }
                            else
                            {
                                $mai['l_url_label'] = GetSiteTitle($mai['l_url']);
                                $this->moWall->EditUrlTitle($mai['l_url'], $mai['l_url_label'] . ' ');
                            }
                        }
                        if (!empty($mai['story']))
                        {
                            $this->moWall->moSmiles->FindSmile($mai['story']);
                        }
                    }
                    
                    $mai['wtype'] = 0;
                    $this->mSmarty->assign_by_ref('ctags_fav', $this->moUser->mUser->GetOneTag(-1, UID, 2));
                    $this->mSmarty->assign_by_ref('mai', $mai);

                    //-- get tags list
                    /*
                    $this->mSmarty->assign_by_ref('ctags', $this->moUser->mUser->GetTags(UID, -1, MAX_MSG_TAGS));
                    $this->mSmarty->assign_by_ref('cnt_ctags', $this->moUser->mUser->GetCntTags(UID));
                    $this->mSmarty->assign_by_ref('ctags_fav', $this->moUser->mUser->GetOneTag(-1, UID, 2));
                    */

                    /**
                     * Получаем классы
                     */
                    $this->mSmarty->assign_by_ref('uclasses_index', $this->moUser->mProfile->GetSchoolClassList(UID, $this -> moUser -> mUinfo['ward_id']/*$this->moUser->mProfile->GetWardId(UID)*/, 2));

                    $this->mSmarty->assign_by_ref('sname',$this->moWall->moSmiles->smile_name);
                    $this->mSmarty->assign_by_ref('snamecode',$this->moWall->moSmiles->smile_name_code);
                    $this->mSmarty->assign_by_ref('status',$this->status_array);

                    $this->mSmarty->display('mods/profile/_wall_one.html');
                }
                else
                    die('not_success');
            }
            else
            {
                die('not_success');
            }
            exit();
        }
        else
        {//show Wall info

            //get ID for show some item
            $show_item = 0;
            foreach ($_REQUEST as $k => $v)
            {
                if (is_numeric($k) && !$v)
                {
                    $show_item = $k;
                    break;
                }
            }

            if ($show_item)
            {
                $this -> mSmarty -> assign('show_item', $show_item);
            }

            $pcnt = 0;
            $rcnt = 7;

            //-- get tags list
            $ctags = $this->moUser->mUser->GetTags(UID_OTHER);
            $this->mSmarty->assign_by_ref('ctags', $ctags);
            $this->mSmarty->assign_by_ref('cnt_ctags', count($ctags));
            $this->mSmarty->assign_by_ref('ctags_fav', $this->moUser->mUser->GetOneTag(-1, UID, 2));

            //-- get filts
            $cfilts = $this->moWall->GetFilt(UID_OTHER);
            $this->mSmarty->assign_by_ref('cfilts', $cfilts);

            $mai = $this->moWall->GetList(UID_OTHER, $pcnt, $rcnt, -1, !IS_USER ? $this->filts : array(), '', !IS_USER ? $this->sfilts['priesthold'] : -1, !IS_USER ? $this->sfilts['classes'] : -1, 0, 0, $show_item); //if IS_USER - without filtering (show all)
            

            $cnt_mes = $this->moWall->GetCnt(UID_OTHER, !IS_USER ? $this->filts : array(), '', !IS_USER ? $this->sfilts['priesthold'] : -1, !IS_USER ? $this->sfilts['classes'] : -1);

            if (!empty($mai))
            {
                $fr_ar = array();

                /** get current user favorites */
                $r_fav = $this->moWall->ChckExFavTag($this->moWall->GetCurrentMesgAr(), UID, 0);

                /** update params */
                $mesg_l = '';

                foreach ($mai as $k => &$r)
                {
                    /* set wtype */
                    $r['wtype'] = $this->wtype;

                    /** set favorite */
                    $r['my_fav'] = !empty($r_fav[$r['id']]) ? 1 : 0;

                    /** check label */
                    if (3 == $r['mtype'] && $r['l_url'])
                    {
                        $l = $this->moWall->GetUrlTitle($r['l_url']);
                        if (!empty($l))
                        {
                            $r['l_url_label'] = trim($l);
                        }
                        else
                        {
                            $r['l_url_label'] = GetSiteTitle($r['l_url']);
                            $this->moWall->EditUrlTitle($r['l_url'], $r['l_url_label'] . ' ');
                        }
                    }
                    if (!isset($fr_ar[$r['uid']]))
                    {
                        $fr_ar[$r['uid']] = $this->moUser->_initRelations($r['uid']);
                    }
                    $r['relations'] = $fr_ar[$r['uid']];

                    $mesg_l .= ( $mesg_l ? ', ' : '') . $r['id'];
                }
            }

            if (!empty($mesg_l))
            {
                $ml = $this->moUser->mUser->GetTagsByMid(UID, $mesg_l, $this->wtype);
                if (!empty($ml))
                {
                    foreach ($mai as $k => &$r)
                    {
                        if (!empty($ml[$r['id']]))
                        {
                            $r['ctags'] = $ml[$r['id']];
                        }
                    }
                }
                //deb($mai);
            }

            //$this -> moWall -> SendPrivateMessage(1, 365, 'Привет медвед!');
            
            $this->mSmarty->assign_by_ref('sname',$this->moWall->moSmiles->smile_name);
            $this->mSmarty->assign_by_ref('snamecode',$this->moWall->moSmiles->smile_name_code);
            $this->mSmarty->assign_by_ref('status',$this->status_array);

            $this->mSmarty->assign_by_ref('mai', $mai);
            $this->mSmarty->assign_by_ref('cnt_mes', $cnt_mes);
            $this->mSmarty->assign_by_ref('pcnt', $pcnt);
            $this->mSmarty->assign_by_ref('rcnt', $rcnt);

            $this->mSmarty->assign('_content', $this->mSmarty->fetch('mods/profile/_wall.html'));
        }
    }/* GetEdit */


    //-- Get & Edit Answers Info
    public function GetEditAnsw()
    {
        $errs = array();
        $wi   = array(); //Wall info (story, ev_title, l_url & etc.)
        $si   = array(); //System info (privacy, is_answ, mes_id, answ_id & etc.)

        $wi = _v('WI');
        $si = _v('SI');
        if (!empty($wi)) //edit Answers info
        {

            if (!defined('UID'))
            {
                $errs[] = 'User is not authorized';
            }
            
            $n_data  = array('story'); //necessery data
            $ex_cols = $this->moWall->GetAnswCols(); //data's columns in DB

            foreach ($wi as $k => $r)
            {
                if (!in_array($k, $ex_cols)) //additional check by existing fields in DB
                    unset($wi[$k]);
                else
                {
                    $wi_k[] = base_chk($k);
                    $wi_r[] = base_chk5($r, 8192);
                }
            }

            $wi['story'] = isset($wi['story']) ? trim(strip_tags($wi['story'])) : '';

            $mes_id  = isset($si['mes_id']) ? (int) $si['mes_id'] : 0;
            $answ_id = isset($si['answ_id']) ? (int) $si['mes_id'] : 0;

            if ($mes_id)
            {
                /**
                 * Получаем автора сообщения и на чьей стене оно оставлено
                 */
                $mes_user = $this -> moWall ->GetBaseMessage($mes_id);
                $n_ad_info = isset($wi['story']) ? $wi['story'] : '';

                /**
                 *  Send notification for first answer
                 */
                if (! $this->moWall->GetAnswCnt($mes_id))
                {
                    $sn = $this->mlObj['notify']->GetForMessage($mes_id);
                    for ($sni=0; $sni<count($sn);$sni++)
                    {
                        if (!empty($sn[$sni]['to_uid']))
                        {
                            $this->mlObj['notify']->UpdUExtNotify(10, 1,
                                    $n_ad_info, UID, $mes_user['uid'], $sn[$sni]['to_uid'],
                                    0);
                        }
                    }
                }
                
                //add commentary
                $wi_k_c = array_merge(array('uid', 'mid'), $wi_k); //add UID_OTHER & UID data
                $wi_r_c = array_merge(array(UID, $mes_id), $wi_r);
                $id = $this->moWall->EditAnsw($answ_id, $wi_k_c, $wi_r_c);

                //send to all subscribers if has an access (everyone && fr&subscribers)
                $mes_copies = $this->moWall->GetCopies(UID_OTHER, $mes_id);
                foreach ($mes_copies as $k => $r)
                {
                    if ($r['is_copy'] && $r['is_copy_mes'])
                    {
                        $wi_k_cop = array_merge(array('uid', 'mid'), $wi_k); //add UID_OTHER & UID data
                        $wi_r_cop = array_merge(array(UID, $r['id']), $wi_r);
                        $this->moWall->EditAnsw($answ_id, $wi_k_cop, $wi_r_cop);
                    }
                }

                //--send a notification
                $ntype = 10;


                /**
                 * $mes_user['uid'] - автор сообщения,  к которому пишут комментарий
                 * UID - тот, кто пишет комментарий
                 */
                if (!empty($mes_user['uid']) && $mes_user['uid'] != UID)
                {
                    $s_notify = $this->mlObj['notify']->UpdUNotify($ntype, 1, $n_ad_info, '', '', UID, $mes_user['uid']);
                }

                if ($id || $answ_id)
                {
                    if ($id)
                        $c_id = $id; else
                        $c_id = $answ_id;
                    $ai = $this->moWall->GetAnswOne($c_id);
                    
                    if (!empty($ai['story']))
                    {
                        $this->moWall->moSmiles->FindSmile($ai['story']);
                    }

                    $this->mSmarty->assign_by_ref('ai', $ai);
                    $this->mSmarty->display('mods/profile/_wall_answ_one.html');
                }
                else
                    die('not_success');
            }
            else
                die('not_success');
            exit();
        }
        else
        {
            //show Answers info
            $mid = (int) _v('mid');
            if (!empty($mid) && defined('UID'))
            {
                $pcnt = -1;
                $rcnt = -1;
                $ai = $this->moWall->GetAnswList(UID_OTHER, $pcnt, $rcnt, -1);

                $this->mSmarty->assign_by_ref('ai', $ai);
                //deb($mai);
                $this->mSmarty->assign('_content', $this->mSmarty->fetch('_ch_wall_templ.html'));
            }
            else
                uni_redirect(PATH_ROOT . '');
        }
    }/* GetEditAnsw */




    
    //---- Ajax Methods
    //-- Get List throught Ajax
    public function GetListAjax()
    {
        if (defined('UID'))
        {
            $rcnt = 7;
            $last_id = (int) _v('last_id', 0);
            
            $sf_type    = _v('sf_type');
            $sf         = (int)_v('sf');
            $str_filter = '';

            if (in_array($sf_type, array('1', '2', '3')) && !empty($sf))
            {
                if (1 == $sf_type || 2 == $sf_type)
                {
                    $str_sf_type = (1 == $sf_type) ? 'w.mtype' : 'p.ptype';
                    $str_filter  = $str_sf_type . ' = ' . $sf;
                    if (1 == $sf_type && 6 == $sf)
                    {
                        $str_sf_type = 'w.sub_mtype';
                        $str_filter  = $str_sf_type . ' = 1';
                    }
                }
                elseif (3 == $sf_type)
                {
                    $sf2 = (int) _v('sf2');
                    $str_filter = 'w.mtype = ' . $sf . ' AND p.ptype = ' . $sf2;
                }
            }

            //-- get tags list
            $ctags     = $this->moUser->mUser->GetTags(UID);
            $cnt_ctags = $this->moUser->mUser->GetCntTags(UID);
            $this->mSmarty->assign_by_ref('ctags', $ctags);
            $this->mSmarty->assign_by_ref('cnt_ctags', $cnt_ctags);

            $this->mSmarty->assign_by_ref('ctags_fav', $this->moUser->mUser->GetOneTag(-1, UID, 2));

            $mai = $this->moWall->GetList(UID_OTHER, 0, $rcnt, -1, !IS_USER ? $this->filts : array(), $str_filter, !IS_USER ? $this->sfilts['priesthold'] : -1, !IS_USER ? $this->sfilts['classes'] : -1, $last_id); //if IS_USER - without filtering (show all)
            //$cnt_mes = $this->moWall->GetCnt(UID_OTHER, !IS_USER ? $this->filts : array(), $str_filter, !IS_USER ? $this->sfilts['priesthold'] : -1, !IS_USER ? $this->sfilts['classes'] : -1, $last_id);
            $first_item = $this -> moWall -> GetFirstMessageId( UID_OTHER, 0, $rcnt, -1, !IS_USER ? $this->filts : array(), $str_filter, !IS_USER ? $this->sfilts['priesthold'] : -1, !IS_USER ? $this->sfilts['classes'] : -1 );

            $mesg_l = '';

            if (!empty($mai))
            {
                $fr_ar = array();
                //deb($mai);
                foreach ($mai as $k => &$r)
                {
                    if (3 == $r['mtype'] && $r['l_url'])
                    {
                        $l = $this->moWall->GetUrlTitle($r['l_url']);
                        if (!empty($l))
                        {
                            $r['l_url_label'] = trim($l);
                        }
                        else
                        {
                            $r['l_url_label'] = GetSiteTitle($r['l_url']);
                            $this->moWall->EditUrlTitle($r['l_url'], $r['l_url_label'].' ');
                        }
                    }
                    $mesg_l .= ($mesg_l ?  ', ' : '') . $r['id'];

                    if (!isset($fr_ar[$r['uid']]))
                    {
                        $fr_ar[$r['uid']] = $this->moUser-> CheckFriendStatus($r['uid']);
                    }
                    $r['relations'] = $fr_ar[$r['uid']];
                }


                $ml = $this -> moUser -> mUser -> GetTagsByMid(UID, $mesg_l, $this -> wtype);
                if (!empty($ml))
                {
                    foreach ($mai as $k => &$r)
                    {
                        if (!empty($ml[$r['id']]))
                        {
                            $r['ctags'] = $ml[$r['id']];
                        }
                    }
                }
            }

            //deb($mai);

            $this->mSmarty->assign_by_ref('sname',$this->moWall->moSmiles->smile_name);
            $this->mSmarty->assign_by_ref('snamecode',$this->moWall->moSmiles->smile_name_code);
            $this->mSmarty->assign_by_ref('status',$this->status_array);

            $this->mSmarty->assign_by_ref('sf_type', $sf_type);
            $this->mSmarty->assign_by_ref('sf', $sf);
            $this->mSmarty->assign('rcnt', $rcnt);
            $this->mSmarty->assign_by_ref('mai', $mai);
            //$this->mSmarty->assign_by_ref('cnt_mes', $cnt_mes);

            if (!empty($first_item) && !empty($mai) && $mai[count($mai)-1]['id'] > $first_item)
            {
                $this->mSmarty->assign('show_more', 1);
            }

            $this->mSmarty->assign_by_ref('uclasses_index', $this->moUser->mProfile->GetSchoolClassList(UID, $this -> moUser -> mUinfo['ward_id']/*$this->moUser->mProfile->GetWardId(UID)*/, 2));
            $this->mSmarty->display('mods/profile/_wall_list.html');
        }
        else
            die('not_success');
        exit();
    }/* GetListAjax */


    //-- Get One Message throught Ajax
    public function GetOneAjax()
    {
        $id = (int) _v('id');
        if (defined('UID') && !empty($id))
        {
            //-- get tags list
            $ctags = $this->moUser->mUser->GetTags(UID);
            $cnt_ctags = $this->moUser->mUser->GetCntTags(UID);
            $this->mSmarty->assign_by_ref('ctags', $ctags);
            $this->mSmarty->assign_by_ref('cnt_ctags', $cnt_ctags);

            $this->mSmarty->assign_by_ref('ctags_fav', $this->moUser->mUser->GetOneTag(-1, UID, 2));

            $mai = $this->moWall->GetOne($id, !IS_USER ? $this->filts : array(), UID_OTHER, !IS_USER ? $this->sfilts['priesthold'] : -1, !IS_USER ? $this->sfilts['classes'] : -1); //if IS_USER - without filtering
            if (!empty($mai))
            {
                if (3 == $mai['mtype'] && $mai['l_url'])
                {
                    $l = $this->moWall->GetUrlTitle($mai['l_url']);
                    if (!empty($l))
                    {
                        $mai['l_url_label'] = trim($l);
                    }
                    else
                    {
                        $mai['l_url_label'] = GetSiteTitle($mai['l_url']);
                        $this->moWall->EditUrlTitle($mai['l_url'], $mai['l_url_label'].' ');
                    }
                }
            }


            if (!empty($mai['id']))
            {
                $ml = $this -> moUser -> mUser -> GetTagsByMid(UID, $mai['id'], $this -> wtype);
                if (!empty($ml) && !empty($ml[$mai['id']]))
                {
                    $mai['ctags'] = $ml[$mai['id']];
                }
            }


            $this->mSmarty->assign_by_ref('mai', $mai);
            $this->mSmarty->assign_by_ref('uclasses_index', $this->moUser->mProfile->GetSchoolClassList(UID, $this -> moUser -> mUinfo['ward_id']/*$this->moUser->mProfile->GetWardId(UID)*/, 2));

            $this->mSmarty->assign_by_ref('sname',$this->moWall->moSmiles->smile_name);
            $this->mSmarty->assign_by_ref('snamecode',$this->moWall->moSmiles->smile_name_code);
            $this->mSmarty->assign_by_ref('status',$this->status_array);

            $this->mSmarty->display('mods/profile/_wall_one.html');
        }
        else
            die('not_success');
        exit();
    }/* GetOneAjax */

    
    //-- Set One Status to Wall message throught Ajax
    public function GetOneSmStat()
    {
        $mid = (int) _v('mid');
        $suid = (int) _v('suid');
        $name = _v('name');
        $cnt  = _v('cnt', 1);
        
        if (defined('UID') && !empty($mid))
        {
            //check if already exist user status
            $is_exist = $this->moWall->CheckSmStatus($mid, $name, $suid);

            if ($is_exist && UID != 1)
            {
                echo 'exist';
            }
            else
            {
                if (UID==1 && $cnt > 1)
                {
                    for ($i=0;$i<$cnt;$i++)
                    {
                        $stat_id = $this->moWall->SetSmStatus($mid, $name, $suid);
                    }
                }
                else
                {
                    $stat_id = $this->moWall->SetSmStatus($mid, $name, $suid);
                }

                $status_uids = $this->moWall->GetStatWid($mid);
                $status = $this->moWall->GetStatusForWall($mid);

                //$this->mSmarty->assign_by_ref('status_new', $status);
                $this->mSmarty->assign_by_ref('status_new', $status_uids);
                $this->mSmarty->assign_by_ref('status', $this->status_array);
                $this->mSmarty->display('mods/profile/_wall_sm_stat_list.html');
            }
          //deb($stat_id);
        }
        else
            die('not_success');
        exit();
    }/* GetOneSmStat */

    
    //-- Get One Message throught Ajax
    public function GetAnswListAjax()
    {
        $mid = (int) _v('mid');
        if (defined('UID') && !empty($mid))
        {
            /*
            $apcnt = (int) _v('apcnt');
            $arcnt = (int) _v('arcnt');
            if (empty($apcnt))
                $apcnt = 0;
            if (empty($arcnt))
                $arcnt = $this->moWall->GetAnswCnt($mid);
            */
            $ai = $this->moWall->GetAnswList($mid, /*$apcnt*/-1, /*$arcnt*/-1, 'wa.pdate ASC'); //if IS_USER - without filtering (show all)

            $this->mSmarty->assign_by_ref('ai', $ai);
            $this->mSmarty->display('mods/profile/_wall_answ_list.html');
        }
        else
            die('not_success');
        exit();
    }


    //-- Delete Message throught Ajax
    public function DelAjax()
    {
        $id = (int) _v('mes_id');
        if (defined('UID') && !empty($id))
            $this->moWall->Del($id, UID);
        else
            die('not_success');
        exit();
    }/* DelAjax */

    
    /* Upload picture */
    /* Upload picture */
    public function AjaxFileUpload()
    {
        $error = "";
        $msg = "";
        $ftype = _v('ftype', 'default');
        $fileElementName = _v('fid', 'fileToUpload');
        $file = array('new_name' => '', 'ext' => '');


        if(defined('UID'))
        {
            if (!empty($_FILES[$fileElementName]['error']))
            {
                switch ($_FILES[$fileElementName]['error'])
                {
                    case '1':
                        $error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
                        break;
                    case '2':
                        $error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
                        break;
                    case '3':
                        $error = 'The uploaded file was only partially uploaded';
                        break;
                    case '4':
                        $error = 'No file was uploaded.';
                        break;
                    case '6':
                        $error = 'Missing a temporary folder';
                        break;
                    case '7':
                        $error = 'Failed to write file to disk';
                        break;
                    case '8':
                        $error = 'File upload stopped by extension';
                        break;
                    case '999':
                    default:
                        $error = 'No error code avaiable';
                }
            }
            elseif (empty($_FILES[$fileElementName]['tmp_name']) || $_FILES[$fileElementName]['tmp_name'] == 'none')
            {
                $error = 'You have not selected a file';
            }
            else
            {
                switch ($ftype)
                {
                    case 'default':
                    case 'img':
                        $MaxFileSize = 1024; //KB
                        $MaxImgWidth = 70;
                        $ThumbSize = 70;
                        $AllowedExts = array('gif', 'jpg', 'jpeg', 'png');
                        break;
                }

                $file['size'] = (int) @filesize($_FILES[$fileElementName]['tmp_name']);
                $file['size'] = ceil($file['size'] / 1024); //KB
                $file['name'] = $_FILES[$fileElementName]['name'];
                $file['ext'] = explode('.', $file['name']);
                $file['ext'] = $file['ext'][count($file['ext']) - 1];
                $file['new_name'] = md5(mktime().rand(100, 99999)).'.'.$file['ext'];

                if (!in_array(strtolower($file['ext']), $AllowedExts))
                {
                    $error = 'Wrong file format!';
                }
                elseif ($file['size'] > $MaxFileSize)
                {
                    $error = 'File size exceeds ' . $MaxFileSize . 'KB';
                }
                else
                {
                    switch ($ftype)
                    {
                        case 'default':
                        case 'img':

                            require_once 'Ctrl/Image/Image_Transform.php';
                            require_once 'Ctrl/Image/Image_Transform_Driver_GD.php';

                            //$imgPath = $this->fpath . UID . '/t/' . $file['new_name'] . '.' . $file['ext'];
							$imgPath = $this -> fpath_tmp.'t/';

							//deb(file_exists($imgPath));
                            //deb($imgPath);
                            //$thumbPath = $this->fpath_tmp . 't/' . $file['new_name'] . '.' . $file['ext'];

							i_crop_copy(70, 70, $_FILES[$fileElementName]['tmp_name'], $imgPath.$file['new_name'], 2);

							//i_crop_copy($MaxImgWidth, 0, $_FILES[$fileElementName]['tmp_name'], $imgPath, 0);

                           /* $picInfo = getimagesize($imgPath);
                            $picWidth = isset($picInfo[0]) ? (int) $picInfo[0] : 0;
                            $picHeight = isset($picInfo[1]) ? (int) $picInfo[1] : 0;
                            if ($picWidth > $MaxImgWidth)
                            {
                                i_crop_copy($MaxImgWidth, $picHeight, $imgPath, $imgPath, 0);
                            } */
                            //i_crop_copy($ThumbSize, $ThumbSize, $_FILES[$fileElementName]['tmp_name'], $thumbPath, 1);

                            $msg = $file['new_name'];

                            break;
                    }
                }
                if ($ftype == 'img')
                {
                    if (isset($_SESSION['uploaded_file']) && !empty($_SESSION['uploaded_file']))
                    {
                        @unlink($this->fpath . UID . '/t/' . $_SESSION['uploaded_file']);
                        //@unlink($this->fpath_tmp . '/' . '/usernews/thumb/' . $_SESSION['uploaded_file']);
                    }
                    $_SESSION['uploaded_file'] = $file['new_name'];
                }

                //for security reason, we force to remove all uploaded file
                @unlink($_FILES[$fileElementName]['tmp_name']);
            }
        }

        echo "{";
        echo "error: '" . $error . "',\n";
        echo "msg: '" . $msg . "',\n";
        echo "imgname: '" . $file['new_name'] . "'\n";
        echo "}";
        exit();
    }

    //-- Delete Answer throught Ajax
    public function DelAnswAjax()
    {
        $mid = (int) _v('mid');
        if (defined('UID') && !empty($mid))
            $this->moWall->DelAnsw($mid);
        else
            die('not_success');
        exit();
    }

    /* DelAnswAjax */

    //-- Check Video existing
    public function ChckVideoAjax()
    {
        $id = (int) _v('id');
        if (defined('UID') && !empty($id))
        {
            $vi = $this->mVideo->Get($id);
            $res = array('id' => $id, 'vi' => '');
            if (!empty($vi) && !empty($vi['video']))
                $res['vi'] = $vi['video'];
            echo Ar2Json($res);
        }
        else
        {
            die('not_success');
        }
        exit();
    }

    /* ChckVideoAjax */

    //-- Check Link existing
    public function GetLinkInfoAjax()
    {
        /*
        $res = array('q' => 'ok','title' => 'Лента.ру', 'link' => 'http://lenta.ru');
        echo json_encode($res);
        exit();
        */
        $link = _v('link');
        if (defined('UID') && !empty($link))
        {
            $link = chk_link(base_chk($link));
            if ($link != null) 
            {
                $title = @GetSiteTitle($link);
            }
            else
            {
                $title = '';
            }
            $res = array('q' => 'ok','title' => $title, 'link' => $link);

        }
        else
        {
            $res = array('q' => 'err','title' => $title, 'link' => $link);
        }
        echo json_encode($res);
        exit();
    }

    //-- Get List throught Ajax
    public function FiltUsersAjax()
    {
        if (defined('UID'))
        {
            $ptype = (int) _v('ptype');
            require_once 'Model/Base/Friends.class.php';
            $moFriends = new Model_Base_Friends($this->mlObj['gDb']);

            include_once 'Model/Profile/Profile.class.php';
            $moProfile = new Model_Base_Profile($this->mlObj['gDb']);

            $ar_friends = array();
            $ar_subscr = array();
            $ar_fam = array();
            $ar_users = array();
            switch ($ptype)
            {
                case 0:
                    $ar_friends = $moFriends->GetUserFriends(UID_OTHER, 0, 0, array(1));
                    $ar_subscr = $this->moUser->mUser->GetSubscr(-1, UID_OTHER, -1, -1);
                    $ar_fam = $moProfile->GetFamilyList(UID_OTHER);
                    if ($ar_fam)
                    {
                        foreach ($ar_fam as $k => $r)
                        {
                            $ar_fam[$k]['uid'] = $ar_fam[$k]['wuid'];
                            unset($ar_fam[$k]['wuid']);
                        }
                    }
                    $ar_users = array_merge($ar_friends, $ar_subscr, $ar_fam);
                    if ($ar_users)
                    {
                        $pr_repval = array();
                        foreach ($ar_users as $k => $r)
                        {
                            if (!in_array($r['uid'], $pr_repval))
                                $pr_repval[] = $r['uid'];
                            else
                                unset($ar_users[$k]);
                        }
                    }
                    break;
                case 1: //friends & subscr
                    $ar_friends = $moFriends->GetUserFriends(UID_OTHER, 0, 0, array(1));
                    $ar_subscr = $this->moUser->mUser->GetSubscr(-1, UID_OTHER, -1, -1);

                    $ar_users = array_merge($ar_friends, $ar_subscr);
                    if ($ar_users)
                    {
                        $pr_repval = array();
                        foreach ($ar_users as $k => $r)
                        {
                            if (!in_array($r['uid'], $pr_repval))
                                $pr_repval[] = $r['uid'];
                            else
                                unset($ar_users[$k]);
                        }
                    }
                    break;
                case 2: //friends
                    $ar_friends = $moFriends->GetUserFriends(UID_OTHER, 0, 0, array(1));
                    $ar_users = $ar_friends;
                    break;
                case 3: //family
                    $ar_fam = $moProfile->GetFamilyList(UID_OTHER);
                    $ar_users = $ar_fam;
                    break;
            }

            $this->mSmarty->assign_by_ref('ptype', $ptype);
            $this->mSmarty->assign_by_ref('ar_filt_user', $ar_users);
            $this->mSmarty->display('mods/friends/_filter_list.html');
        }
        exit();
    }

    /* FiltUsersAjax */

    public function AddFiltAjax()
    {
        $fi = _v('FI');
        if ($fi)
        {
            $errs = array();
            foreach ($fi as $k => $r)
            {
                $fi[$k] = base_chk($r);
            }
            if (empty($fi['name']))
                $errs[] = 1;
            if (empty($errs))
                $this->moWall->EditFilt(UID, $fi['name'], $fi['ptype'], $fi['mtype']);
            else
                echo 'not_success';
        }
        exit();
    }

    /* AddFiltAjax */

    public function DelFiltAjax()
    {
        if (defined('UID'))
        {
            $id = _v('fid');
            $this->moWall->DelFilt($id, UID);
        }
        else
            echo 'not_success';
        exit();
    }

    /* DelFiltAjax */

    //---- Additional Methods

    public function ChkUplPhoto()
    {
        $errs = array();

        $ret = array('status' => 'err', 'errs' => &$errs);
        if (!empty($_FILES['Filedata']['tmp_name']))
        {
            if (!is_uploaded_file($_FILES['Filedata']['tmp_name']))
                $errs[] = 'File is already uploaded';
            else
            {
                if (10240000 < $_FILES['Filedata']['size'] || 1 > $_FILES['Filedata']['size'])
                    $errs[] = 'File has an incorrect size';
                else
                {
                    $ext = get_img_ext($_FILES['Filedata']['tmp_name']);

                    if (false === $ext)
                        $errs[] = 'Incorrect extension';
                    else
                    {
                        $tempFile = $_FILES['Filedata']['tmp_name'];
                        $targetPath = $this->fpath_tmp;

                        if (!file_exists($targetPath))        { mkdir($targetPath, 0777);        chmod($targetPath, 0777); }
                        if (!file_exists($targetPath . 'n/')) { mkdir($targetPath . 'n/', 0777); chmod($targetPath, 0777); }
                        if (!file_exists($targetPath . 'a/')) { mkdir($targetPath . 'a/', 0777); chmod($targetPath, 0777); }
                        if (!file_exists($targetPath . 'm/')) { mkdir($targetPath . 'm/', 0777); chmod($targetPath, 0777); }
                        if (!file_exists($targetPath . 's/')) { mkdir($targetPath . 's/', 0777); chmod($targetPath, 0777); }

                        $crand = mktime().rand(100, 999);
                        //$targetFile = UID.'_w_'.UID_OTHER.'_'.date('dmYHi').'_'.$crand.'_'.$_FILES['Filedata']['name'];
                        $targetFile = UID . '_w_' . UID_OTHER . '_' . $crand . '_' . Txt2Charset($_FILES['Filedata']['name']);

                        $target = $targetPath . $targetFile;
                        if (file_exists($target))
                            unlink($target);

//                        $cnt_photo = (int) $_POST['cnt_p_img'];
//                        if (!empty($cnt_photo))
//                            $p_width = 358 / $cnt_photo;
//                        if (200 <= $p_width)
//                            $p_width = 200;

						i_crop_copy(658, 439, $_FILES['Filedata']['tmp_name'], $targetPath . 'n/n_' . $targetFile, 2);
						$src = $targetPath . 'n/n_' . $targetFile;

                        i_crop_copy(358, 200, $src, $target, 2);
                        i_crop_copy(324, 217, $src, $targetPath . 'a/a_' . $targetFile, 2);
                        i_crop_copy(69, 69,   $src, $targetPath . 'm/m_' . $targetFile, 1);
                        i_crop_copy(49, 49,   $src, $targetPath . 's/s_' . $targetFile, 1);

                        $ret['status'] = 'success';
                        $ret['image'] = $targetFile;
                    }
                }
            }
        }
        include_once 'Ctrl/Ajax/Json.php';
        $mJson = new Services_JSON();
        echo $mJson->encode($ret);
        exit();
    }


    //-- Get & Edit Wall Info (Messages & Answers)

    public function GetEditWall()
    {

        $errs = array();
        $wi = array(); //Wall info (story, ev_title, l_url & etc.)
        $si = array(); //System info (privacy, is_answ, mes_id, answ_id & etc.)

        $wi = _v('WI');
        $si = _v('SI');
        if (!empty($wi))
        {//edit Wall info
            if (!defined('UID'))
                $errs[] = 'User is not authorized';

            $is_answ = (int) $si['is_answ'];
            if (!$is_answ)
            {
                /* Set the necessery to complete fields
                  $mtype - 1 - message
                  - 2 - event
                  - 3 - link
                  - 4 - photo
                  - 5 - video
                */
                $n_data = array(); //necessary data array
                $mtype = (int) $wi['mtype'];
                switch ($mtype)
                {
                    case 1:
                        $n_data = array('story');
                        break;
                    case 2:
                        $n_data = array('ev_title', 'ev_where', 'ev_dt');
                        break;
                    case 3:
                        $n_data = array('l_url');
                        break;
                    default:
                        $errs[] = 'Incorrect flag has been detected - "' . $mtype . '"';
                        break;
                    default:
                }
                $ex_cols = $this->moWall->GetCols(); //data's columns in DB
            }
            else
            {
                $mtype = 1;
                $n_data = array('story');
                $ex_cols = $this->moWall->GetAnswCols(); //data's columns in DB
            }

            //-----checking data
            if (!empty($n_data))
            {
                foreach ($wi as $k => $r)
                {
                    $_SESSION['uploaded_file'] = '';
                    if (!in_array($k, $ex_cols)) //additional check by existing fields in DB
                        unset($wi[$k]);
                    else
                    {
                        if (in_array($k, $n_data) && empty($r))  //check filling all the necessary fields
                            $errs[] = 'Required field - "' . $k . '" - has been left blank or incomplete';

                        $wi_k[] = base_chk($k);
                        if (3 == $mtype && 'l_url' == $k)
                            chk_link($wi['l_url']) ? $wi_r[] = chk_link($wi['l_url']) : $errs[] = 'Incorrect data has been detected - "' . $wi['l_url'] . '"';
                        else
                            $wi_r[] = base_chk4($r, 8192);
                    }
                }
            }

            //-----update data
            $mes_id = (int) $si['mes_id'];
            $answ_id = (int) $si['answ_id'];
            if (empty($errs))
            {
                $_SESSION['uploaded_file'] = '';
                if (!$is_answ) //if it's a Message (if $mes_id - edit, else - add)

                {
                    $wi_k = array_merge(array('wuid', 'uid'), $wi_k); //add UID_OTHER & UID data
                    $wi_r = array_merge(array(UID_OTHER, UID), $wi_r);

                    $id = $this->moWall->Edit($mes_id, $wi_k, $wi_r);
                    if ($id || $mes_id)
                    {
                        $c_id =  ($id) ? $id : $mes_id;
                        
                        //update privacy
                        $privacy = (int) $si['privacy'];
                        if (in_array($privacy, array_keys($this->filts)))
                            $this->moWall->EditPrivacy($privacy, $c_id, $this->filts[$privacy]);

                        $mi = $this->moWall->GetOne($c_id, array(), UID); //if IS_USER - without filtering
                        $this->mSmarty->assign_by_ref('mi', $mi);
                        //display tmpl
                    }
                    else
                        die('not_success');
                }
                else if ($mes_id) //if it's an Answer (if $answ_id - edit, else - update)
                {
                    $wi_k = array_merge(array('uid', 'mid'), $wi_k); //add UID_OTHER & UID data
                    $wi_r = array_merge(array(UID, $mes_id), $wi_r);

                    $id = $this->moWall->EditAnsw($answ_id, $wi_k, $wi_r);

                    if ($id || $answ_id)
                    {
                        if ($id)
                            $c_id = $id; else
                            $c_id = $answ_id;
                        $mi = $this->moWall->GetAnswOne($c_id);
                        $this->mSmarty->assign_by_ref('mi', $mi);
                        //display tmpl
                    }
                    else
                        die('not_success');
                }
                else
                    die('not_success');
            }
            else
                die('not_success');
            exit();
        }
        else if (defined('UID'))
        {//show Wall info
            $mai = $this->moWall->GetList(UID_OTHER, -1, -1, -1, !IS_USER ? $this->filts : array(), '', !IS_USER ? $this->sfilts['priesthold'] : -1, !IS_USER ? $this->sfilts['classes'] : -1); //if IS_USER - without filtering (show all)

            $this->mSmarty->assign_by_ref('mai', $mai);

            //display tmpl
            $this->mSmarty->assign('_content', $this->mSmarty->fetch('_ch_wall_templ.html'));
        }
        else
            uni_redirect(PATH_ROOT . '');
    }/* GetEditWall */


    private function SendExternNotif($uid, $to_uid, $wid, $story, $event_type, $event_id)
    {
        $event_type = $event_type > 0 ? $event_type : 1;

        switch ($event_type)
        {
            case 1:
                $ntype = 1;
                break;
            case 2:
                $ntype = 4;
                break;
            case 3:
                $ntype = 5;
                break;
            case 4:
                $ntype = 2;
                break;
            case 5:
                $ntype = 3;
                break;
            default:
                $ntype = 1;
        }

        $n_ad_info =  (!empty($story)) ? $story : '';
        $ui = ($this->moUser->mUser->Get($to_uid));

        if (1 == $ui['notify_news'])
            $s_notify = $this->mlObj['notify']->UpdUExtNotify($ntype, $event_type, $n_ad_info, $uid, $to_uid, $wid, $event_id);
    }
}

/** Ctrl_Profile_Wall */
?>
