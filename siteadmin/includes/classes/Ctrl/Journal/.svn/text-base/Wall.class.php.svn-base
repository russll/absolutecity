<?php

/**
 * Journal's Wall controller
 *
 * @package    5dev Wall
 * @version    1.0
 * @since      8.04.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */
class Ctrl_Journal_Wall extends Ctrl_Base
{

    //system params
    public $moWall;
    private $filts;
    private $sfilts;
    private $fpath;
    private $fpath_tmp;
    //handle params
    private $cnt_p_upl; //count of the uploading photos
    private $wtype = 5;

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

        include_once 'Model/Profile/Profile.class.php';
        $this->moProfile = new Model_Base_Profile($glObj['gDb']);

        $this->filts = $this->_initFilts();  //get table Filters
        $this->sfilts = $this->_initSFilts(); //get table sub Filters

        require_once 'Model/Journal/Wall.class.php';
        $this->moWall = new Model_Journal_Wall($glObj['gDb']);

        $this->mSmarty->assign('HIDE_RC', 1); //hide LEFT COLUMN
        $this->mSmarty->assign('m_page', 'journal');
        $this->fpath = DIR_WS_IMAGE . 'journal/';
        $this->fpath_tmp = DIR_WS_IMAGE . 'journal/_temp/';

        #global privacy
        if (!IS_USER && !$this->moUser->mUi['global']['notes'])
        {
            $this->mSmarty->assign('_content', $this -> mSmarty -> get_config_vars('no_access')/*'<center><h3>This section is set to private</h3></center>'*/);
            $this->mSmarty->assign('no_access', true);
            $this->mSmarty->assign('gCnt', $GLOBALS['gCnt']);
            $this->mSmarty->assign('gTime', get_mt_time() - $GLOBALS['gtime']);
            $this->mSmarty->display('main.html');
            die();
        }
    }

    /* __construct */

    //---- System Methods

    /**
     * Initialization of privacy
     *  ar_filts:
     *          1 - friends & followerd (1 - yes, 0 - not)
     * 			2 - friends only
     * 			3 - only family (1 - yes, 0 - not)
     * 			4 - one (some person)
     * 			5 - private (only me)
     *
     * @return filters array (ptype => uvid)
     */
    public function _initFilts()
    {
        $u_other = $this->moUser->mUi;
        $ar_filts = array(
                         0 => UID,
                         1 => (int)($u_other['im_suscr_fr'] || 1==$u_other['im_friend']),
                         2 => 1==$u_other['im_friend'] ? 1 : 0,
                         3 => $u_other['im_fam'],
                         4 => UID,
                         5 => UID,
                         100 => $this->moUser->mProfile->GetWardId(UID),
                         101 => $this->moUser->mProfile->GetStakeId(UID)); // 4 => UID ?????
        return $ar_filts;
    }


    public function _initSFilts()
    {
        $u = $this->moUser->mUinfo;

        $classes = $this->moUser->mProfile->GetSchoolClassList(UID, $this -> moUser -> mUinfo['ward_id']/*$this->moUser->mProfile->GetWardId(UID)*/);
        $ar_sfilts = array('priesthold' => $u['priesthood'], 'classes' => $classes);
        //deb($ar_sfilts);
        return $ar_sfilts;
    }

    
    //---- Main Methods
    //--Get & Edit Wall Info
    public function GetEdit()
    {
        $errs = array();
        $wi = array(); //Wall info (story, ev_title, l_url & etc.)
        $si = array(); //System info (privacy, is_answ, mes_id, answ_id & etc.)
        $wi_tags = array();
        $wi = _v('WI');
        $si = _v('SI');

        //deb($wi);
        if (!empty($wi)) //edit Wall info
        {
            $wi['taglist'] = !empty($wi['taglist']) ? trim(strip_tags($wi['taglist'])) : '';
            $wi_tags = explode(',', $wi['taglist']);
            $mt = 0;
            foreach ($wi_tags as &$vt)
            {
                $vt = trim($vt);
                if (empty($vt))
                {
                    unset($vt);
                }
                /*
                elseif ($vt == 'my church talks')
                {
                    $mt = 1;
                }
                */
            }
            if (empty($wi_tags))
            {
                $wi_tags = array();
            }
            /*
            if (!$mt)
            {
                $wi_tags[] = 'my church talks';
            }
            */
            


            /* Set the necessery to complete fields
              $mtype - 1 - message, 2 - event, 3 - link, 4 - photo, 5 - video */
            $n_data = array(); //necessary data array
            $mtype =  isset($wi['mtype']) ? (int) $wi['mtype'] : 0;
            if (!empty($mtype))  //if additional attaches exists - do check & mes are not checked, else - mes checking
            {
                switch ($mtype)
                {
                    case 2:
                        $n_data = array('ev_title', 'ev_where', 'ev_dt');
                        break;
                    case 3:
                        $n_data = array('l_url');
                        break;
                    case 4:
                        if (!isset($wi['p_img']))
                        {
                            $n_data = array('p_url'); //if uploading photo from URL
                        } else
                        {
                            $n_data = array('p_img'); //if uploading photo from PC
                        }
                        break;
                    case 5:
                        if (!isset($wi['v_file']))
                        {
                            $n_data = array('v_code'); //if uploading video from Code
                        } else
                        {
                            $n_data = array('v_file'); //if uploading video from PC
                        }
                        break;
                    default:
                        $errs[] = 'Incorrect flag has been detected - "' . $mwhat . '"';
                        break;
                }
            }
            else
            {
                $n_data = array('story', 'subject');
            }

           

            $ex_cols = $this->moWall->GetCols(); //data's columns in DB

            $wi_k = array();
            $wi_r = array();
            
            if (!empty($n_data))
            {
                foreach ($wi as $k => $r)
                {
                    if (empty($k) || empty($r))
                        continue;

                    if ('p_img' != $k && 'v_file' != $k && !in_array($k, $ex_cols)) //additional check by existing fields in DB
                        unset($wi[$k]);
                    else
                    {
                        if (in_array($k, $n_data) && empty($r))  //check filling all the necessary fields
                            $errs[] = 'Required field - "' . $k . '" - has been left blank or incomplete';

                        if (3 == $mtype && 'l_url' == $k) //check link
                        {
                            $wi_k[] = base_chk($k);
                            chk_link($wi['l_url']) ? $wi_r[] = chk_link($wi['l_url']) : $errs[] = 'Incorrect data has been detected - "' . $wi['l_url'] . '"';
                        } elseif (4 == $mtype && 'p_img' == $k) //check photo
                        {
                            isset($wi['p_img']) ? $cnt_wi_pimg = count($wi['p_img']) : $cnt_wi_pimg = 0;
                            $this->cnt_p_upl = $cnt_wi_pimg;
                            !count($wi_k) ? $l_el = 0 : $l_el = count($wi_k) - 1;

                            //get ID of the current system_album
                            require_once 'Model/Base/Albums.class.php';
                            $moAlbums = new Model_Base_Albums($this->mlObj['gDb']);
                            $ualb_sys = $moAlbums->GetUAlbums(UID_OTHER, 2);
                            foreach ($ualb_sys as $k => $r)
                            {
                                if ('Journal' == $r['name'])
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
                                    $wi_r[$cur_el] = $wi['p_img'][$i - 1];
                                else
                                    $wi_r[$cur_el] = $wi['p_img'];

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
                                if (!file_exists($folder . 's/'))
                                {
                                    mkdir($folder . 's/', 0777);
                                    chmod($folder, 0777);
                                }
                                if (!file_exists($folder . 'm/'))
                                {
                                    mkdir($folder . 'm/', 0777);
                                    chmod($folder, 0777);
                                }

                                if (file_exists($tfolder . $wi_r[$cur_el])) //copy files int the necessary folder
                                {
                                    if (copy($tfolder . $wi_r[$cur_el], $folder . $wi_r[$cur_el]) &&
                                            copy($tfolder . 'n/n_' . $wi_r[$cur_el], $folder . 'n/n_' . $wi_r[$cur_el]) &&
                                            copy($tfolder . 'n/n_' . $wi_r[$cur_el], $folder . 's/s_' . $wi_r[$cur_el]) &&
                                            copy($tfolder . 'n/n_' . $wi_r[$cur_el], $folder . 'm/m_' . $wi_r[$cur_el]) &&
                                            copy($tfolder . 'a/a_' . $wi_r[$cur_el], $folder . 'a/a_' . $wi_r[$cur_el])) //after copying do unlink
                                    {
                                        unlink($tfolder . 'n/n_' . $wi_r[$cur_el]);
                                        unlink($tfolder . 'a/a_' . $wi_r[$cur_el]);
                                        unlink($tfolder . 's/s_' . $wi_r[$cur_el]);
                                        unlink($tfolder . 'm/m_' . $wi_r[$cur_el]);
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
                                            $wi_k[$cur_el + 10] = 'p_img_' . $i . '_id';
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
                                if ('Journal' == $r['name'])
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
                                $v_code = chk_embed_code($r);
                                $wi_k[] = base_chk($k);
                                $wi_r[] = $v_code;

                                //get ID of the current system_album
                                require_once 'Model/Base/Valbums.class.php';
                                $moVAlbums = new Model_Base_Valbums($this->mlObj['gDb'], GetPostfix(UID));
                                $ualb_sys = $moVAlbums->GetUValbums(UID_OTHER, 2);
                                foreach ($ualb_sys as $k => $r)
                                {
                                    if ('Journal' == $r['name'])
                                    {
                                        $svwall_id = $r['vaid'];
                                        break;
                                    }
                                }

                                //put info about video into the Albums & table of this wall
                                if (empty($errs))
                                {
                                    if (isset($svwall_id))
                                    {
                                        $wpar = array('vaid', 'video', 'descr');
                                        $wval = array($svwall_id, $v_code, '');

                                        $wi_k[10] = 'v_code_id';
                                        $wi_r[10] = $moVAlbums->UpdVideo($wpar, $wval);
                                    }
                                }
                            }
                            else if ('v_file' == $k)
                            {
                                isset($wi['v_file']) ? $cnt_wi_vfile = count($wi['v_file']) : $cnt_wi_vfile = 0;
                                !count($wi_k) ? $l_el = 0 : $l_el = count($wi_k) - 1;

                                for ($i = 1; $i <= $cnt_wi_vfile; $i++)
                                {
                                    $cur_el = $l_el + $i;
                                    $wi_k[$cur_el] = 'v_file_' . $i;
                                    if (is_array($wi['v_file']))
                                        $wi_r[$cur_el] = $wi['v_file'][$i - 1];
                                    else
                                        $wi_r[$cur_el] = $wi['v_file'];
                                }
                            }
                            else
                            {
                                if ($k == 'story')
                                {
                                    if ($r == 'r' || empty($r))
                                    {
                                        $r = '';
                                    }
                                    $wi_k[] = base_chk($k);
                                    $wi_r[] = close_tags( base_chk7($r) );
                                }
                                elseif ($k == 'subj')
                                {
                                    if ($r == 'Subject' || empty($r))
                                    {
                                        $r = 'No subject';
                                    }
                                    $wi_k[] = base_chk($k);
                                    $wi_r[] = base_chk4($r, 8192);
                                }
                                
                            }
                        } 
                        else
                        {//check other elements
                            $wi_k[] = base_chk($k);
                            //$wi_r[] = base_chk4($r, ($k == 'story' ? -1 : 480));


                            if ($k == 'ev_title')
                            {
                                $wi_r[] = base_chk5($r, 80);
                            } elseif ($k == 'ev_where')
                            {
                                $wi_r[] = base_chk5($r, 80);
                            }
                            elseif ($k == 'story')
                            {
                                if ($r == 'r')
                                {
                                    $r = '';
                                }

                                $wi_r[] = close_tags( base_chk7($r) );
                            }
                            elseif ($k == 'ev_dt')
                            {
                                $wi_r[] = date('Y-m-d H:i:s', strtotime($r));
                            }
                            elseif ($k == 'subj')
                            {
                                if ('Subject' == $r)
                                {
                                    $r = 'No subject';
                                }
                                $wi_r[] = base_chk5($r, 8192);
                            }
                            else
                            {
                                $wi_r[] = close_tags( base_chk7($r) );
                            }
                        }
                    }
                }
            }

            //add mtype if not exist
            $j = 0;
            foreach($wi_k as $k => $v)
            {
                if ($v=='mtype')
                {
                    $j++;
                }
            }
            if (!$j)
            {
                $wi_k[] = 'mtype';
                $wi_r[] = $mtype;
            }


            //add
            if (empty($errs) && !empty($wi_k))
            {
                $wi_k = array_merge(array('juid', 'uid'), $wi_k); //add UID_OTHER & UID data in DB
                $mes_id = isset($si['mes_id']) ? (int) $si['mes_id'] : 0;
                $privacy = isset($si['privacy']) ? (int) $si['privacy'] : 0;  //set privacy

                //send to current user
                $wi_r_c = array_merge(array(UID_OTHER, UID), $wi_r);
                $id = $this->moWall->Edit($mes_id, $wi_k, $wi_r_c);

                // Add tags
                if ($id && !empty($wi_tags))
                {
                    foreach ($wi_tags as $tag)
                    {
                        $tag = ToLower(trim(strip_tags($tag)));
                        
                        if (!empty($tag))
                        {
                            $tid = $this->moUser->mUser->EditTags(1, UID, $tag, -1, 5);
                            if ($tid)
                            {
                                $ret = $this->moUser->mUser->AddTagsMesg($tid, $id, UID, $this->moUser->mUinfo['fpath'], 5);
                            }
                        }
                    }
                }

                //-- check subprivacy
                $c_id = $id ? $id : $mes_id;

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

                $sub_privacy_class = (isset($si['sub_privacy_class'])) ? $si['sub_privacy_class'] : 0;

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

                $alr_send = array(); //users, who are already got message
                
                if (0 == $privacy || 1 == $privacy)
                {
                    //-- check the existing of the sub privacy
                    $ar_subscr = $this->moUser->mUser->GetSubscr(-1, UID_OTHER, -1, -1, $pr_filt);
                    if (!empty($ar_subscr))
                    {
                        foreach ($ar_subscr as $k => $r)
                        {
                            $wi_k_new = array();
                            $wi_r_new = array();
                            $wi_k_new = array_merge(array('is_copy', 'is_copy_mes'), $wi_k);
                            $wi_r_new = array_merge(array(UID_OTHER, $c_id, $r['uid'], UID), $wi_r);
                            // Send notif for "Share with"
                            if ($r['uid'] != UID && $r['uid'] != UID_OTHER)
                            {
                                $this->SendExternNotif(UID, $r['uid'], UID_OTHER, $wi['story'], isset($wi['mtype']) ? $wi['mtype'] : 1, $c_id);
                            }
                            $alr_send[] = $r['uid'];
                        }
                    }
                }

                //send to all friends if has an access (everyone && friends && someone(from friends))
                if (0 == $privacy || 1 == $privacy || 2 == $privacy || 4 == $privacy)
                {
                    //-- check the existing of the sub privacy
                    $ar_friends = $this->moFriends->GetUserFriends(UID_OTHER, 0, 0, array(1), 0, '', 0, -1, 0, 0, $pr_filt);

                    if (!empty($ar_friends))
                    {
                        foreach ($ar_friends as $k => $r)
                        {
                            if (!in_array($r['uid'], $alr_send))
                            {
                                $wi_k_new = array();
                                $wi_r_new = array();
                                $wi_k_new = array_merge(array('is_copy', 'is_copy_mes'), $wi_k);
                                $wi_r_new = array_merge(array(UID_OTHER, $c_id, $r['uid'], UID), $wi_r);
                                // Send notif for "Share with"
                                if ($r['uid'] != UID && $r['uid'] != UID_OTHER)
                                {
                                    $this->SendExternNotif(UID, $r['uid'], UID_OTHER, $wi['story'], isset($wi['mtype']) ? $wi['mtype'] : 1, $c_id);
                                }
                                $alr_send[] = $r['uid'];
                            }
                        }
                    }
                }

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
                                if ($r['uid'] != UID && $r['uid'] != UID_OTHER)
                                {
                                    $this->SendExternNotif(UID, $r['uid'], UID_OTHER, $wi['story'], isset($wi['mtype']) ? $wi['mtype'] : 1, $c_id);
                                }
                                $alr_send[] = $r['wuid'];
                            }
                        }
                    }
                }

                if (0 == $privacy)
                {
                    $jrn_subscr = $this->moWall->GetSubscr(-1, UID);
                    foreach ($jrn_subscr as $val)
                    {
                        if (!in_array($val['uid'],$alr_send))
                        {
                            if ($val['uid'] != UID && $val['uid'] != UID_OTHER)
                            {
                               $this->SendExternNotif(UID, $val['uid'], UID_OTHER, $wi['story'], isset($wi['mtype']) ? $wi['mtype'] : 1, $c_id);
                            }
                            $alr_send[] = $val['uid'];
                        }
                    }
                }

                if ($id || !empty($mes_id))
                {
                    if (in_array($privacy, array_keys($this->filts)))
                    {
                        //update privacy for all subscr if has an access
                        if ((0 == $privacy || 1 == $privacy) && !empty($id_subscr))
                        {
                            foreach ($id_subscr as $k => $r)
                            {
                                $c_id_subscr[$k] = $r ? $r : $mes_id;
                                $this->moWall->EditPrivacy($privacy, $c_id_subscr[$k], $this->filts[$privacy]);
                            }
                        }

                        //update privacy for all subscr if has an access
                        //deb($c_id_friends);
                        if ((0 == $privacy || 1 == $privacy || 2 == $privacy || 4 == $privacy) && !empty($id_friends))
                        {
                            foreach ($id_friends as $k => $r)
                            {
                                $c_id_friends[$k] = $r ? $r : $mes_id;
                                $this->moWall->EditPrivacy($privacy, $c_id_friends[$k], $privacy == 4 ? $si['sub_privacy_module_val'] : $this->filts[$privacy]);
                            }
                        }

                        //update privacy for all family members
                        if (3 == $privacy && !empty($id_famalies))
                        {
                            foreach ($id_famalies as $k => $r)
                            {
                                $c_id_families[$k] = $r ? $r : $mes_id;
                                $this->moWall->EditPrivacy($privacy, $c_id_families[$k], $this->filts[$privacy]);
                            }
                        }

                        //update privacy for current user (everyone && fr&subscribers)
                        $_pr = 0; //в базе это uvid
                        if ($privacy == 0 && (int) $sub_privacy_module_val)
                        {
                            $_pr = $sub_privacy_module_val;
                        } elseif ($privacy == 0 && (int) $sub_privacy_module_val == 0)
                        {
                            $_pr = 0;
                        } elseif ($privacy == 4 && (int) $sub_privacy_module_val)
                        {
                            $_pr = $sub_privacy_module_val;
                        } else
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
                        //deb($g = array($privacy, $spModules, $sub_privacy_module, $sub_privacy_module_val));
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
                            } else
                            {
                                $mai['l_url_label'] = GetSiteTitle($mai['l_url']);
                                $this->moWall->EditUrlTitle($mai['l_url'], $mai['l_url_label'] . ' ');
                            }
                        }
                    }

                    if (!empty($mai['id']))
                    {
                        $ml = $this->moUser->mUser->GetTagsByMid(UID, $mai['id'], $this->wtype);
                        if (!empty($ml) && !empty($ml[$mai['id']]))
                        {
                            $mai['ctags'] = $ml[$mai['id']];
                            unset($ml);
                        }
                    }
                    $mai['wtype'] = 4;

                    if (!empty($mai['story']))
                    {
                        $this->moWall->moSmiles->FindSmile($mai['story']);
                    }

                    $this->mSmarty->assign_by_ref('sname',$this->moWall->moSmiles->smile_name);
                    $this->mSmarty->assign_by_ref('snamecode',$this->moWall->moSmiles->smile_name_code);

                    $this->mSmarty->assign_by_ref('ctags_fav', $this->moUser->mUser->GetOneTag(-1, UID, 2));
                    $this->mSmarty->assign_by_ref('mai', $mai);

                    $this->mSmarty->assign_by_ref('uclasses_index', $this->moUser->mProfile->GetSchoolClassList(UID, $this -> moUser -> mUinfo['ward_id']/*$this->moUser->mProfile->GetWardId(UID)*/, 2));
            
                    //prepate template
                    $this->mSmarty->display('mods/journal/_wall_one.html');
                } else
                {
                    die('not_success');
                }
            } else
            {
                die('not_success');
            }
            exit();
        }
        else
        {
            //show Wall info
            $pcnt = 0;
            $rcnt = 7;


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

            $mai = $this->moWall->GetList(UID_OTHER, $pcnt, $rcnt, -1, !IS_USER ? $this->filts : array(), '', !IS_USER ? $this->sfilts['priesthold'] : -1, !IS_USER ? $this->sfilts['classes'] : -1, 0, 0, $show_item); //if IS_USER - without filtering (show all)
            $cnt_mes = $this->moWall->GetCnt(UID_OTHER, !IS_USER ? $this->filts : array(), '', !IS_USER ? $this->sfilts['priesthold'] : -1, !IS_USER ? $this->sfilts['classes'] : -1);

            $mesg_l = '';
            if ($mai)
            {
                /** get current user favorites */
                $r_fav = $this->moWall->ChckExFavTag($this->moWall->GetCurrentMesgAr(), UID, 5);

                $mesg_l = '';

                foreach ($mai as $k => &$r)
                {
                    /* set wtype */
                    $r['wtype'] = 5;

                    /** set favorite */
                    $r['my_fav'] = !empty($r_fav[$r['id']]) ? 1 : 0;

                    if (3 == $r['mtype'] && $r['l_url'])
                    {
                        $l = $this->moWall->GetUrlTitle($r['l_url']);
                        if (!empty($l))
                        {
                            $r['l_url_label'] = trim($l);
                        } else
                        {
                            $r['l_url_label'] = GetSiteTitle($r['l_url']);
                            $this->moWall->EditUrlTitle($r['l_url'], $r['l_url_label'] . ' ');
                        }
                    }
                    //$mai[$k]['cnt_answ']  = $this -> moWall -> GetAnswCnt( $r['id'] );
                    $mai[$k]['relations'] = $this->moUser->_initRelations($mai[$k]['uid']);

                    $mesg_l .= ( $mesg_l ? ', ' : '') . $r['id'];
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
                }
            }
            //get journal tags
            $j_ctags = $this->moUser->mUser->GetTags(UID_OTHER, -1, MAX_MSG_TAGS);

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
            $this->mSmarty->assign_by_ref('sname',$this->moWall->moSmiles->smile_name);
            $this->mSmarty->assign_by_ref('snamecode',$this->moWall->moSmiles->smile_name_code);

            $this->mSmarty->assign_by_ref('ctags_fav', $this->moUser->mUser->GetOneTag(-1, UID, 2));

            $this->mSmarty->assign_by_ref('j_ctags', $j_ctags);
            $this->mSmarty->assign_by_ref('mai', $mai);
            $this->mSmarty->assign_by_ref('cnt_mes', $cnt_mes);
            $this->mSmarty->assign_by_ref('pcnt', $pcnt);
            $this->mSmarty->assign_by_ref('rcnt', $rcnt);

            $this->mSmarty->assign('_content', $this->mSmarty->fetch('mods/journal/_wall.html'));
        }
    }

    public function DoSubscrAjax()
    {
/*        if (empty($this->mSystemLogin))
        {
            uni_redirect('/');
        }
*/
        if (!IS_USER)
        {
            echo $this->moWall->EditSubscr(UID, UID_OTHER);
        } else
        {
            echo 'not_success';
        }
        exit();
    }
    /* DoSubscrAjax */

    public function GetSubscr()
    {
/*        if (empty($this->mSystemLogin))
        {
            uni_redirect('/');
        }
*/
        //-- get Subscribers list
        $pcnt = 10;
        $page = _v('page', 1);
        include_once 'View/Acc/Pagging.php';


        $cnt_ar_subscribition = $this->moWall->GetCntSubscr(-1, UID_OTHER);
        $mpage = new Pagging($pcnt, $cnt_ar_subscribition, $page, '');
        $range = $mpage -> GetRange();
        $ar_subscribition = $this->moWall->GetSubscr(UID_OTHER, -1, -1, $pcnt, -1, $range[0]);
        $this -> mSmarty -> assign('pagging',  $mpage   -> Make($this -> mSmarty, '', 'oJournal.SubscrPage'));

        $this->mSmarty->assign('ar_subscribition', $ar_subscribition);
        $this->mSmarty->assign('cnt_ar_subscribition', $cnt_ar_subscribition);
        $this->mSmarty->assign('m_page', 'journal');
        $this->mSmarty->assign_by_ref('_content', $this->mSmarty->Fetch('mods/journal/_subscr_list.html'));
    }
    /*GetSubscr*/

    /**
     * Получение списка журналов на которыe есть подписка
     * @return void
     */
    public function GetSubscrListAjax()
    {
/*        if (empty($this->mSystemLogin))
        {
            uni_redirect('/');
        }
*/
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
                 * Журналы, на которые подписался пользователь
                 */
                $cnt_ar_subscribition = $this->moWall->GetCntSubscr(-1, UID_OTHER);
                $mpage = new Pagging($pcnt, $cnt_ar_subscribition, $page, '');
                $range = $mpage -> GetRange();
                $ar_subscribition = $this->moWall->GetSubscr(UID_OTHER, -1, -1, $pcnt, -1, $range[0]);

                $this->mSmarty->assign('ar_subscribition', $ar_subscribition);
                $res['data'] = $this->mSmarty->Fetch('mods/journal/_subscr_list_ajax.html');
                $res['q']    = 'ok';
                $res['pagging'] = $mpage   -> Make($this -> mSmarty, '', 'oJournal.SubscrPage');
                echo Ar2Json($res);
                exit();
                break;
        }
    }

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

        $n_ad_info = (!empty($story)) ? $story : '';
        $ui = $this->moUser->mUser->Get($to_uid);

        if (1 == $ui['notify_news'])
        {
            $s_notify = $this->mlObj['notify']->UpdUExtNotify($ntype, $event_type, $n_ad_info, $uid, $to_uid, $wid, $event_id, 2);
        }
    }

    //-- Get & Edit Answers Info
    public function GetEditAnsw()
    {
        $errs = array();
        $wi = array(); //Wall info (story, ev_title, l_url & etc.)
        $si = array(); //System info (privacy, is_answ, mes_id, answ_id & etc.)

        $wi = _v('WI');
        $si = _v('SI');
        if (!empty($wi)) //edit Answers info
        {
            if (!defined('UID'))
                $errs[] = 'User is not authorized';

            $n_data = array('story'); //necessery data
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
            $answ_id = isset($si['answ_id']) ? (int) $si['answ_id'] : 0;

            if ($mes_id)
            {
                $wi_k = array_merge(array('uid', 'mid'), $wi_k); //add UID_OTHER & UID data
                $wi_r = array_merge(array(UID, $mes_id), $wi_r);

                $id = $this->moWall->EditAnsw($answ_id, $wi_k, $wi_r);

                if ($id || $answ_id)
                {
                    $c_id =  $id ? $id : $answ_id;
                    $ai   = $this -> moWall -> GetAnswOne($c_id);

                    //smiles
                    if (!empty($ai['story']))
                    {
                        $this->moWall->moSmiles->FindSmile($ai['story']);
                    }

                    $this->mSmarty->assign_by_ref('ai', $ai);
                    $this->mSmarty->display('mods/journal/_wall_answ_one.html');
                }
                else
                    die('not_success');
            }
            else
                die('not_success');
            exit();
        }
        else //show Answers info
        {
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
    }

    //---- Ajax Methods
    //-- Get List throught Ajax
    public function GetListAjax()
    {
        if (defined('UID'))
        {
            $rcnt    = 7;
            $last_id = _v('last_id', 0);
            $pcnt    = 0;
            

            $sf_type    = _v('sf_type');
            $sf         = (int) _v('sf');
            $str_filter = '';
            if (in_array($sf_type, array('1', '2')) && !empty($sf))
            {
                $str_sf_type = (1 == $sf_type) ? 'w.mtype' : 'p.ptype';
                $str_filter = $str_sf_type . ' = ' . $sf;
            }

            $mai = $this->moWall->GetList(UID_OTHER, $pcnt, $rcnt, -1, !IS_USER ? $this->filts : array(), $str_filter, !IS_USER ? $this->sfilts['priesthold'] : -1, !IS_USER ? $this->sfilts['classes'] : -1, $last_id); //if IS_USER - without filtering (show all)
            $first_item = $this -> moWall -> GetFirstMessageId(UID_OTHER, $pcnt, $rcnt, -1, !IS_USER ? $this->filts : array(), $str_filter, !IS_USER ? $this->sfilts['priesthold'] : -1, !IS_USER ? $this->sfilts['classes'] : -1);

            $mesg_l = '';
            if ($mai)
            {
                foreach ($mai as $k => &$r)
                {
                    if (3 == $r['mtype'] && $r['l_url'])
                    {
                        $l = $this->moWall->GetUrlTitle($r['l_url']);
                        if (!empty($l))
                        {
                            $r['l_url_label'] = trim($l);
                        } else
                        {
                            $r['l_url_label'] = GetSiteTitle($r['l_url']);
                            $this->moWall->EditUrlTitle($r['l_url'], $r['l_url_label'] . ' ');
                        }
                    }
                    $mesg_l = (!empty($mesg_l) ?  $mesg_l . ', ' : '') . $r['id'];
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
                            $r['wtype'] = $this->wtype;
                        }
                    }
                }
            }

            $this->mSmarty->assign_by_ref('sname',$this->moWall->moSmiles->smile_name);
            $this->mSmarty->assign_by_ref('snamecode',$this->moWall->moSmiles->smile_name_code);

            $this->mSmarty->assign_by_ref('pcnt', $pcnt);
            $this->mSmarty->assign_by_ref('rcnt', $rcnt);
            $this->mSmarty->assign_by_ref('mai', $mai);


            if (!empty($first_item) && !empty($mai) && $mai[count($mai)-1]['id'] > $first_item)
            {
                $this->mSmarty->assign('show_more', 1);
            }

            $this->mSmarty->assign_by_ref('uclasses_index', $this->moUser->mProfile->GetSchoolClassList(UID, $this -> moUser -> mUinfo['ward_id']/*$this->moUser->mProfile->GetWardId(UID)*/, 2));
            $this->mSmarty->display('mods/journal/_wall_list.html');
        }
        else
            die('not_success');
        exit();
    }


    //-- Get One Message throught Ajax
    public function GetOneAjax()
    {
        $id = (int) _v('id');
        if (defined('UID') && !empty($id))
        {
            $mai = $this->moWall->GetOne($id, !IS_USER ? $this->filts : array(), UID_OTHER, !IS_USER ? $this->sfilts['priesthold'] : -1, !IS_USER ? $this->sfilts['classes'] : -1); //if IS_USER - without filtering
            if (!empty($mai))
            {
                if (3 == $mai['mtype'] && $mai['l_url'])
                {
                    $l = $this->moWall->GetUrlTitle($mai['l_url']);
                    if (!empty($l))
                    {
                        $mai['l_url_label'] = trim($l);
                    } else
                    {
                        $mai['l_url_label'] = GetSiteTitle($mai['l_url']);
                        $this->moWall->EditUrlTitle($mai['l_url'], $mai['l_url_label'] . ' ');
                    }
                }

                $ml = $this->moUser->mUser->GetTagsByMid(UID, $mai['id'], $this->wtype);
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

            if (!empty($mai['story']))
            {
                $this->moWall->moSmiles->FindSmile($mai['story']);
            }

            $this->mSmarty->assign_by_ref('sname',$this->moWall->moSmiles->smile_name);
            $this->mSmarty->assign_by_ref('snamecode',$this->moWall->moSmiles->smile_name_code);

            $this->mSmarty->assign_by_ref('mai', $mai);
            $this->mSmarty->display('mods/journal/_wall_one.html');
        }
        else
            die('not_success');
        exit();
    }


    //-- Edit One Message throught Ajax
    public function EditOneAjax()
    {
        $id = (int) _v('id');
        $act = (int) _v('act', 0);
        $succ_edit = 0;

        if (1 == $act)
        {
            $subj = _v('subj', '');
            $story = _v('story', '');

            $subj = base_chk($subj);
            $story = base_chk4($story);

            //checkRigts && edit
            if ($subj && $story && $this->moWall->CheckRights($id, UID))
            {
                $this->moWall->Edit($id, array('subj', 'story'), array($subj, $story));
                $succ_edit = 1;
            }
        }

        $r = array('id' => 0, 'subj' => '', 'story' => '', 'succ_edit' => $succ_edit);
        if (defined('UID') && !empty($id))
        {
            $mai = $this->moWall->GetOne($id, array(), UID); //if IS_USER - without filtering
            if (!empty($mai))
            {
                $r['id'] = $mai['id'];
                $r['subj'] = $mai['subj'];
                $r['story'] = $mai['story'];
            }
        }
        echo Ar2Json($r);
        exit();
    }


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

            $this->mSmarty->assign_by_ref('sname',$this->moWall->moSmiles->smile_name);
            $this->mSmarty->assign_by_ref('snamecode',$this->moWall->moSmiles->smile_name_code);

            $this->mSmarty->assign_by_ref('ai', $ai);
            $this->mSmarty->display('mods/journal/_wall_answ_list.html');
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
            die('not_success');
        exit();
    }

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
                        if (!file_exists($targetPath . 'm/'))
                        {
                            mkdir($targetPath . 'm/', 0777);
                            chmod($targetPath, 0777);
                        }
                        if (!file_exists($targetPath . 's/'))
                        {
                            mkdir($targetPath . 's/', 0777);
                            chmod($targetPath, 0777);
                        }

                        $crand = mktime() . rand(100, 999);
                        $targetFile = UID . '_j_' . UID_OTHER . '_' . $crand . '_' . Txt2Charset($_FILES['Filedata']['name']);

                        $target = $targetPath . $targetFile;
                        if (file_exists($target))
                            unlink($target);


                        i_crop_copy(658, 439, $_FILES['Filedata']['tmp_name'], $targetPath . 'n/n_' . $targetFile, 2);
                        $src = $targetPath . 'n/n_' . $targetFile;
                        i_crop_copy(570, 300, $src, $target, 2);
                        i_crop_copy(324, 217, $src, $targetPath . 'a/a_' . $targetFile, 2);
                        i_crop_copy(69, 69, $src, $targetPath . 'm/m_' . $targetFile, 1);
                        i_crop_copy(49, 49, $src, $targetPath . 's/s_' . $targetFile, 1);

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

}
?>