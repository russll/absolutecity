<?php
/**
 * Mission's Wall controller
 *
 * @package    5dev Wall
 * @version    1.0
 * @since      29.03.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */
class Ctrl_Mission_Wall extends Ctrl_Base
{
    //system params
    private $moWall;
    private $moMission;
    private $fpath;
    private $fpath_tmp;
    private $mission_id;

    //handle params
    private $cnt_p_upl; //count of the uploading photos
    private $wtype;

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

        //init Mission's info
        include_once 'Model/Base/Mission.class.php';
        $this -> moMission = new Model_Base_Mission($glObj['gDb']);
        $this -> mission_id = $this -> _initMission(); //initialization of the Mission Info

        //init Mission's Wall info
        require_once 'Model/Mission/Wall.class.php';
        $this -> moWall = new Model_Mission_Wall($glObj['gDb']);

        require_once 'Model/Profile/Wall.class.php';
        $this -> moUWall = new Model_Profile_Wall($glObj['gDb']);

        $this -> wtype = $this -> moWall -> GetWtype();

        $this -> mSmarty -> assign('wtype', $this -> wtype);
        $this -> mSmarty -> assign('m_page', 'mission_wall');
        $this -> fpath = DIR_WS_IMAGE . 'mission/wall/';
        $this -> fpath_tmp = DIR_WS_IMAGE . 'mission/wall/_temp/';
    }


    //---- System Methods

    /**
     * Initialization of the Mission Access & Info
     *
     * @return Mission's ID or null;
     */
    public function _initMission()
    {
        //Check existing of the Mission
        require_once 'Ctrl/Base/Mission.class.php';
        $coMission = new Ctrl_Base_Mission($this -> mlObj);
        $coMission -> _Init();

        $mission_id = (int) _v('id');

        if (!empty($mission_id))
        {
            $this -> mission_i = $this -> moMission -> Get($mission_id);
            $this -> mission_i['ucnt'] = $this -> moMission -> GetUCnt($mission_id);
            $this -> mission_i['is_mine'] = $my_mis = $this -> moMission -> GetUMission($mission_id, UID);

            if (!$this -> mission_i['is_mine'])
            {
                $this -> mission_i['loc_info'] = $this -> moMission -> GetULocInfo($mission_id);
            }

            if (defined('CAN_EDIT'))
            {
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

                $fm['mission_id'] = $this -> mission_i['is_mine']['mid'];
                $fm['mission_location'] = $this -> mission_i['is_mine']['location'];

                $fm['fdate'] = array();
                $i_max = count($this -> mission_i['is_mine']['time']);
                for ($i = 0; $i < $i_max; $i++)
                {
                    $mfdate = $this -> mission_i['is_mine']['time'][$i]['fdate'];
                    $mtdate = $this -> mission_i['is_mine']['time'][$i]['tdate'];
                    $fdate_id = $this -> mission_i['is_mine']['time'][$i]['id'];

                    $fm['fdate'][$fdate_id]['fyear'] = (int) substr($mfdate, 0, 4);
                    $fm['fdate'][$fdate_id]['fmonth'] = (int) substr($mfdate, 5, 2);
                    $fm['fdate'][$fdate_id]['fday'] = (int) substr($mfdate, 8, 2);
                    $fm['fdate'][$fdate_id]['tyear'] = (int) substr($mtdate, 0, 4);
                    $fm['fdate'][$fdate_id]['tmonth'] = (int) substr($mtdate, 5, 2);
                    $fm['fdate'][$fdate_id]['tday'] = (int) substr($mtdate, 8, 2);
                }

                $this -> mSmarty -> assign_by_ref('mm', $mm);
                $this -> mSmarty -> assign_by_ref('dd', $dd);
                $this -> mSmarty -> assign_by_ref('yy', $yy);

                $this -> mSmarty -> assign_by_ref('fm', $fm);
            }

            $ar_nloc_places = array(1 => 'Best places', 2 => 'Food I like', 3 => 'Food I hate', 4 => 'What I will miss', 5 => 'Testimony');
            $this -> mSmarty -> assign_by_ref('ar_nloc_places', $ar_nloc_places);

            $this -> mSmarty -> assign_by_ref('mission_i', $this -> mission_i);
            $this -> mSmarty -> assign_by_ref('mission_id', $mission_id);
            return $mission_id;
        }
        else
        {
            uni_redirect(PATH_ROOT . '');
            exit;
        }
    }


    //---- Main Methods

    //--Get & Edit Wall Info
    public function GetEdit()
    {
        $errs = array();
        $wi = array(); //Wall info (story, ev_title, l_url & etc.)
        $si = array(); //System info (privacy, is_answ, mes_id, answ_id & etc.)

        $wi = _v('WI');
        $si = _v('SI');
        if (!empty($wi)) //edit Wall info
        {
            
            /* Set the necessery to complete fields
               $mtype - 1 - message, 2 - event, 3 - link, 4 - photo, 5 - video
            */
            $n_data = array(); //necessary data array
            $mtype  = isset($wi['mtype']) ? (int) $wi['mtype'] : 0;

            if (!empty($mtype)) //if additional attaches exists - do check & mes are not checked, else - mes checking
            {
                switch ($mtype)
                {
                    //badge
                    case 1:
                        $n_data = array('story','sub_mtype','b_img_name');
                        break;
                    
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
                $n_data = array('story');

            $ex_cols = $this->moWall->GetCols(); //data's columns in DB
            if (!empty($n_data))
            {
                foreach ($wi as $k => $r)
                {
                    if (empty($k) || empty($r))
                    {
                        continue;
                    }

                    if ('p_img' != $k && 'v_file' != $k && !in_array($k, $ex_cols)) //additional check by existing fields in DB
                        unset($wi[$k]);
                    else
                    {
                        if (in_array($k, $n_data) && empty($r)) //check filling all the necessary fields
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
                            $ualb_sys = $moAlbums->GetUAlbums(UID, 2);
                            foreach ($ualb_sys as $k => $r)
                            {
                                if ('Mission' == $r['name'])
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

                                if (file_exists($tfolder . $wi_r[$cur_el])) //copy files int the necessary folder
                                {
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
                                            $wi_k[$cur_el + 10] = 'p_img_' . $i . '_id';
                                    }
                                }
                            }

                            $wi_k = array_merge(array('p_path', 'p_img_aid'), $wi_k); //add path to photo data in DB
                            $wi_r = array_merge(array(GetPostfix(UID), $swall_id), $wi_r);
                        }
                        elseif (4 == $mtype && 'p_url' == $k)
                        { //check photo
                            $l_el = !count($wi_k) ? 0 : count($wi_k) - 1;

                            //get ID of the current system_album
                            require_once 'Model/Base/Albums.class.php';
                            $moAlbums = new Model_Base_Albums($this->mlObj['gDb']);
                            $ualb_sys = $moAlbums->GetUAlbums(UID, 2);
                            foreach ($ualb_sys as $k => $r)
                            {
                                if ('Mission' == $r['name'])
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
//                                        $wi_r[$cur_el + 10] = $moAlbums->UpdImg($wpar, $wval);
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
                                $wi_k[]     = base_chk($k);
                                $video_code = chk_embed_code($r);
                                $wi_r[]     = $video_code;

                                //get ID of the current system_album
                                require_once 'Model/Base/Valbums.class.php';
                                $moVAlbums = new Model_Base_Valbums($this->mlObj['gDb'], GetPostfix(UID));
                                $ualb_sys = $moVAlbums->GetUValbums(UID_OTHER, 2);
                                foreach ($ualb_sys as $k => $r)
                                {
                                    if ('Mission' == $r['name'])
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
                                        $wval = array($svwall_id, $video_code, '');

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
                            elseif ($k == 'story')
                            {
                                $wi_r[] = base_chk4($r, 8192);
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

            if (empty($errs) && defined('CAN_EDIT') && !empty($wi_k))
            {
                $wi_k = array_merge(array('mission_id', 'uid'), $wi_k); //add mission's ID & UID data in DB
                $wi_r = array_merge(array($this->mission_id, UID), $wi_r);

                isset($wi['mes_id']) ? $mes_id = (int) $wi['mes_id'] : $mes_id = 0;

                $id = $this->moWall->Edit($mes_id, $wi_k, $wi_r);
                if ($id)
                    $c_id = $id; else
                    $c_id = $mes_id;

                $alr_send = array(); //users, who are already got message
                //send to all subscribers
                //-- check the existing of the sub privacy
                /*$ar_subscr = $this->moMission->GetSubscr(-1, $this->mission_id, -1, -1);
                if ($ar_subscr)
                {
                    foreach ($ar_subscr as $k => $r)
                    {
                        $wi_k_new = array();
                        $wi_r_new = array();
                        $wi_k_new = array_merge(array('wuid', 'is_copy', 'is_copy_type', 'is_copy_mes'), $wi_k);
                        $wi_r_new = array_merge(array($r['uid'], $this->mission_id, 1, $c_id), $wi_r);
                        unset($wi_k_new[4], $wi_r_new[4]);

                        $id_subscr[] = $this->moUWall->Edit($mes_id, $wi_k_new, $wi_r_new);
                        $alr_send[] = $r['uid'];
                    }
                }*/

                if ($id || !empty($mes_id))
                {
                    if ($id)
                        $c_id = $id; else
                        $c_id = $mes_id;
                    //update privacy for all subscr
                    if (!empty($id_subscr))
                    {
                        foreach ($id_subscr as $k => $r)
                        {
                            if ($r)
                                $c_id_subscr[$k] = $r; else
                                $c_id_subscr[$k] = $mes_id;
                            $this->moUWall->EditPrivacy(0, $c_id_subscr[$k]);
                        }
                    }

                    $mai = $this->moWall->GetOne($c_id, UID); //if IS_USER - without filtering
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

                    $this->mSmarty->assign_by_ref('mai', $mai);

                    //-- get tags list
                    $ctags = $this->moUser->mUser->GetTags(UID);
                    $cnt_ctags = $this->moUser->mUser->GetCntTags(UID);
 
                    $this->mSmarty->assign_by_ref('sname',$this->moWall->moSmiles->smile_name);
                    $this->mSmarty->assign_by_ref('snamecode',$this->moWall->moSmiles->smile_name_code);

                    $this->mSmarty->assign_by_ref('ctags', $ctags);
                    $this->mSmarty->assign_by_ref('cnt_ctags', $cnt_ctags);

                    $this->mSmarty->assign_by_ref('ctags_fav', $this->moUser->mUser->GetOneTag(-1, UID, 2));

                    $this->mSmarty->display('mods/mission/_wall_one.html');
                }
                else
                    die('not_success');
            }
            else
                die('not_success');
            exit();
        }
        else //show Wall info
        {
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


            //-- get tags list
            $ctags = $this->moUser->mUser->GetTags(UID);
            $cnt_ctags = $this->moUser->mUser->GetCntTags(UID);
            $this->mSmarty->assign_by_ref('ctags', $ctags);
            $this->mSmarty->assign_by_ref('cnt_ctags', $cnt_ctags);

            $this->mSmarty->assign_by_ref('ctags_fav', $this->moUser->mUser->GetOneTag(-1, UID, 2));

            //-- get users of this Mission
            $ar_musers = $this->moMission->GetUsers($this->mission_id);

            $cd = date('Y-m-d');
            $ar_musers_nh = array();
            $ar_musers_wh = array();
            $ar_musers_gh = array();
            foreach ($ar_musers as $k => $r)
            {
                if ($r['m_tdate'] > $cd && $r['m_fdate'] <= $cd)
                    $ar_musers_nh[] = $ar_musers[$k];
                else if ($r['m_tdate'] <= $cd)
                    $ar_musers_wh[] = $ar_musers[$k];
                else if ($r['m_fdate'] > $cd)
                    $ar_musers_gh[] = $ar_musers[$k];
            }

            //-- get followers of this Mission
            $ar_msubscr = $this->moMission->GetSubscr(-1, $this->mission_id);

            $ar_msubscr = array_diff($ar_msubscr, $ar_musers);

            $this->mSmarty->assign_by_ref('ar_musers', $ar_musers);
            $this->mSmarty->assign_by_ref('ar_musers_nh', $ar_musers_nh);
            $this->mSmarty->assign_by_ref('ar_musers_wh', $ar_musers_wh);
            $this->mSmarty->assign_by_ref('ar_musers_gh', $ar_musers_gh);

            $this->mSmarty->assign_by_ref('cnt_show_musers', count($ar_musers));
            $this->mSmarty->assign_by_ref('cnt_show_musers_nh', count($ar_musers_nh));
            $this->mSmarty->assign_by_ref('cnt_show_musers_wh', count($ar_musers_wh));
            $this->mSmarty->assign_by_ref('cnt_show_musers_gh', count($ar_musers_gh));

            $this->mSmarty->assign_by_ref('ar_msubscr', $ar_msubscr);

            $this->mSmarty->assign_by_ref('cnt_show_msubscr', count($ar_musers));

            $mai = $this->moWall->GetList($this->mission_id, $pcnt, $rcnt, -1, array(), -1, 0, 0, $show_item); //if IS_USER - without filtering (show all)
            $cnt_mes = $this->moWall->GetCnt($this->mission_id);

            if (!empty($mai))
            {
                $fr_ar = array();

                /** get current user favorites */
                $r_fav = $this->moWall->ChckExFavTag($this->moWall->GetCurrentMesgAr(), UID, 2);

                $mesg_l = '';

                /** update params */
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
                        } else
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
                    $mesg_l .= ($mesg_l ? ', ' : '') . $r['id'];
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
            
            $this->mSmarty->assign_by_ref('sname',$this->moWall->moSmiles->smile_name);
            $this->mSmarty->assign_by_ref('snamecode',$this->moWall->moSmiles->smile_name_code);

            $this->mSmarty->assign_by_ref('mai', $mai);
            $this->mSmarty->assign_by_ref('cnt_mes', $cnt_mes);
            $this->mSmarty->assign_by_ref('pcnt', $pcnt);
            $this->mSmarty->assign_by_ref('rcnt', $rcnt);

            $this->mSmarty->assign('_content', $this->mSmarty->fetch('mods/mission/_wall.html'));
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
            $ex_cols = $this -> moWall -> GetAnswCols(); //data's columns in DB

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

            isset($si['mes_id']) ? $mes_id = (int) $si['mes_id'] : $mes_id = 0;
            isset($si['answ_id']) ? $answ_id = (int) $si['mes_id'] : $answ_id = 0;

            if ($mes_id)
            {
                $wi_k = array_merge(array('uid', 'mid'), $wi_k); //add mission's ID & UID data
                $wi_r = array_merge(array(UID, $mes_id), $wi_r);

                $id = $this -> moWall -> EditAnsw($answ_id, $wi_k, $wi_r);

                if ($id || $answ_id)
                {
                    if ($id) $c_id = $id; else $c_id = $answ_id;
                    $ai = $this -> moWall -> GetAnswOne($c_id);

                    if (!empty($ai['story']))
                    {
                        $this->moWall->moSmiles->FindSmile($ai['story']);
                    }

                    $this -> mSmarty -> assign_by_ref('ai', $ai);
                    $this -> mSmarty -> display('mods/mission/_wall_answ_one.html');
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
                $ai = $this -> moWall -> GetAnswList($this -> mission_id, $pcnt, $rcnt, -1);
                $this -> mSmarty -> assign_by_ref('ai', $ai);

                $this -> mSmarty -> assign('_content', $this -> mSmarty -> fetch('_ch_wall_templ.html'));
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
            $rcnt = 7;
            $last_id = (int) _v('last_id', 0);
            $pcnt = 0;

            $sf_type = _v('sf_type');
            $sf = (int) _v('sf');
            $str_filter = '';


            if (in_array($sf_type, array(1, 2, 3)) && !empty($sf))
            {
                if (1 == $sf_type)
                {
                    $str_filter = 'w.mtype ' . (-1 != $sf ? ' = ' . $sf : ' = 0 ');
                    //$str_sf_type = 'w.mtype';
                }
                else if (2 == $sf_type)
                {
                    $str_filter = 'p.ptype ' . (-1 != $sf ? ' = ' . $sf : ' = 0 ');
                    //$str_sf_type = 'p.ptype';
                }
                else
                {
                    $str_filter = ($sf == 2 ? '(w.ltype = 2 OR w.ltype = 3)' : 'w.ltype = ' . (-1 != $sf ? $sf : '0'));
                    //$str_filter = $str_sf_type.' '.( -1 != $sf ? ' = '.$sf : ' = 0 ' );
                    //$str_sf_type = 'w.ltype';
                }
                //$str_filter = $str_sf_type.' '.( -1 != $sf ? ' = '.$sf : ' = 0 ' );
            }
            if (!$str_filter)
            {
                $str_filter = ' 1 ';
            }

            //-- get tags list
            $ctags = $this -> moUser -> mUser -> GetTags(UID);
            $cnt_ctags = $this -> moUser -> mUser -> GetCntTags(UID);
            $this -> mSmarty -> assign_by_ref('ctags', $ctags);
            $this -> mSmarty -> assign_by_ref('cnt_ctags', $cnt_ctags);

            $this -> mSmarty -> assign_by_ref('ctags_fav', $this -> moUser -> mUser -> GetOneTag(-1, UID, 2));

            $mai = $this -> moWall -> GetList($this -> mission_id, $pcnt, $rcnt, -1, !IS_USER ? $this -> filts : array(), $str_filter, $last_id); //if IS_USER - without filtering (show all)
            $first_item = $this -> moWall -> GetFirstMessageId($this -> mission_id, $pcnt, $rcnt, -1, !IS_USER ? $this -> filts : array(), $str_filter);
            //$cnt_mes = $this -> moWall -> GetCnt( $this -> mission_id, !IS_USER ? $this -> filts: array(), $str_filter, $last_id );


            if (!empty($mai))
            {
                $fr_ar = array();

                /** get current user favorites */
                $r_fav = $this -> moWall -> ChckExFavTag($this -> moWall -> GetCurrentMesgAr(), UID, 2);

                /** update params */
                foreach ($mai as $k => &$r)
                {
                    /* set wtype */
                    $r['wtype'] = $this -> wtype;
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
                }
            }

            if (!empty($first_item) && !empty($mai) && $mai[count($mai) - 1]['id'] > $first_item)
            {
                $this->mSmarty->assign('show_more', 1);
            }

            $this->mSmarty->assign_by_ref('sname',$this->moWall->moSmiles->smile_name);
            $this->mSmarty->assign_by_ref('snamecode',$this->moWall->moSmiles->smile_name_code);

            $this -> mSmarty -> assign_by_ref('sf_type', $sf_type);
            $this -> mSmarty -> assign_by_ref('sf', $sf);

            $this -> mSmarty -> assign_by_ref('pcnt', $pcnt);
            $this -> mSmarty -> assign_by_ref('rcnt', $rcnt);
            $this -> mSmarty -> assign_by_ref('mai', $mai);
            //$this -> mSmarty -> assign_by_ref( 'cnt_mes', $cnt_mes );

            $this -> mSmarty -> display('mods/mission/_wall_list.html');
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
            //-- get tags list
            $ctags = $this -> moUser -> mUser -> GetTags(UID);
            $cnt_ctags = $this -> moUser -> mUser -> GetCntTags(UID);
            $this -> mSmarty -> assign_by_ref('ctags', $ctags);
            $this -> mSmarty -> assign_by_ref('cnt_ctags', $cnt_ctags);

            $this -> mSmarty -> assign_by_ref('ctags_fav', $this -> moUser -> mUser -> GetOneTag(-1, UID, 2));

            $mai = $this -> moWall -> GetOne($id, UID); //if IS_USER - without filtering
            if (!empty($mai))
            {
                $mai['wtype'] = $this -> wtype;
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
            }
            $this -> mSmarty -> assign_by_ref('mai', $mai);
            $this -> mSmarty -> display('mods/mission/_wall_one.html');
        }
        else
            die('not_success');
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
                $arcnt = $this -> moWall -> GetAnswCnt($mid);
            */
            $ai = $this -> moWall -> GetAnswList($mid, /*$apcnt*/-1, /*$arcnt*/-1, 'wa.pdate ASC'); //if IS_USER - without filtering (show all)
            $this -> mSmarty -> assign_by_ref('ai', $ai);
            $this -> mSmarty -> display('mods/mission/_wall_answ_list.html');
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
            $this -> moWall -> Del($id, UID);
        else
            die('not_success');
        exit();
    }


    //-- Delete Answer throught Ajax
    public function DelAnswAjax()
    {
        $mid = (int) _v('mid');
        if (defined('UID') && !empty($mid))
            $this -> moWall -> DelAnsw($mid);
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
            $vi = $this -> mVideo -> Get($id);
            $res = array('id' => $id, 'vi' => '');
            if (!empty($vi) && !empty($vi['video']))
                $res['vi'] = $vi['video'];
            echo Ar2Json($res);
        }
        else
            die('not_success');
        exit();
    }


    //---- Additional Methodss

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
                        $targetPath = $this -> fpath_tmp;

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
                        //$targetFile = UID.'_mw_'.$this -> mission_id.'_'.date('dmYHi').'_'.$crand.'_'.$_FILES['Filedata']['name'];
                        $targetFile = UID . '_mw_' . $this -> mission_id . '_' . $crand . '_' . Txt2Charset($_FILES['Filedata']['name']);

                        $target = $targetPath . $targetFile;
                        if (file_exists($target))
                            unlink($target);


                        i_crop_copy(658, 439, $_FILES['Filedata']['tmp_name'], $targetPath . 'n/n_' . $targetFile, 2);
                        $src = $targetPath . 'n/n_' . $targetFile;
                        i_crop_copy(358, 200, $src, $target, 2);
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