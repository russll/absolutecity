<?php
/**
 * Ward's Wall controller
 *
 * @package    5dev Wall
 * @version    1.0
 * @since      29.03.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */
class Ctrl_Wards_Wall extends Ctrl_Base
{
    //system params
    public  $moWall;
    private $moWard;
    private $fpath;
    private $fpath_tmp;
    private $wid;
    private $wtype;

    //handle params
    private $cnt_p_upl;	//count of the uploading photos

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

        //init Ward's info
        include_once 'Model/Base/Ward.class.php';
        $this -> moWard = new Model_Base_Ward($glObj['gDb']);
        if (!defined('ONLY_INIT_WARD'))
        {
            $this -> wid = $this -> _initWard(); //initialization of the Ward Info
        }

        require_once 'Model/Wards/Wall.class.php';
        $this -> moWall = new  Model_Wards_Wall($glObj['gDb']);

        $this -> filts = '';

        if ($this ->wid)
        {
            //init Ward's Wall info
            $this -> filts = $this -> _initFilts(); //get table Filters

            $this -> wtype = $this -> moWall -> GetWtype();

            $this -> mSmarty -> assign('wtype', $this -> wtype);
            $this -> mSmarty -> assign('m_page', 'wards_wall');
            $this -> mSmarty -> assign('noward_page', 0);
            $this -> fpath = DIR_WS_IMAGE . 'wards/wall/';
            $this -> fpath_tmp = DIR_WS_IMAGE . 'wards/wall/_temp/';
        }
        else
        {
            $this -> mSmarty -> assign('noward_page', 1);
        }

        
    }

    //---- System Methods


    /**
     * Initialization of the Ward Access & Info
     *
     * @return Ward's ID or null;
     */
    public function _initWard( $ward_id = 0)
    {
        //Check existing of the Ward
        require_once 'Ctrl/Base/Ward.class.php';
        $coWard = new Ctrl_Base_Ward( $this -> mlObj );
        $coWard -> _Init();

        if ($ward_id)
        {
            //init ward for some user as parameter
            $wid = $ward_id;
            $only_rights = 1;
        }
        else
        {
            $wid = (int)_v('id');
        }

        if (!empty($wid))
        {
            /**
             * Stake structure was deleted => [my_stake] already == 0
             */

            $this -> ward_i = $this -> moWard -> Get( $wid );
            $this -> ward_i['ucnt'] = $this -> moWard -> GetUCnt( $wid );
            if ($this -> moUser -> mUinfo['ward_id'] == $this -> ward_i['id'] || $this -> moUser -> mUinfo['stake_id'] == $this -> ward_i['id'])
            {
                $this -> ward_i['im_member'] = 1;
                $this -> ward_i['my_ward_stake_img'] = $this -> moUser -> mUi['ward_stake_img'];
            }
            else
            {
                $this -> ward_i['im_member'] = 0;
            }

            /* delete with stakes pages
            if (1 == $this -> ward_i['ward_type'] && 1 == $this -> ward_i['im_member'])
            {
                $this -> ward_i['my_stake'] = 1;
            }
            else
            {
                $this -> ward_i['my_stake'] = 0;
            }
            */
            $this -> ward_i['my_stake'] = 0;

            /** my ward's stake */
            $this -> ward_i['my_stake_ward'] = ($this -> moUser -> mUinfo['stake_id']==$this -> ward_i['id_parent']) ? 1 : 0;

            
            if (2 == $this -> ward_i['ward_type'] && 1 == $this -> ward_i['im_member'])
            {
                $this -> ward_i['my_ward'] = 1;
            }
            else
            {
                $this -> ward_i['my_ward'] = 0;
            }

            if (empty($only_rights))
            {
                //get all information - not only rights
                
                $this->ward_i['bishopric'] = $this->moWard->GetUBishopric($wid, UID_OTHER);
                $this->mSmarty->assign('ar_addi', array('cp', 'fc', 'sc', 'es', 'wc'));
                $this->ward_id = $wid;

                $this->mSmarty->assign_by_ref('ward_i', $this->ward_i);
                $this->mSmarty->assign_by_ref('wid', $wid);
            }
            return $wid;
        }
        else
        {
            return 0;
        }
    }

    

    /**
     * Initialization of privacy
     *  ar_filts:
     *			0 - my ward
     *			1 - my stake
     *			2 - other ward
     *			3 - other stake
     *          4 - my stake ward
     *
     * @return filters array (ptype => uwid)
     */
    public function _initFilts()
    {
        $uinfo =& $this->moUser->mUinfo;

        $ar_filts = array(
            0 => !empty($this->ward_i['my_ward']) ? 1 : 0,
            1 => !empty($this->ward_i['my_stake']) ? 1 : 0, 
            2 => $uinfo['ward_id'],
            3 => $uinfo['stake_id'],
            4 => !empty($this->ward_i['my_stake_ward']) ? 1 : 0,
            10 => $uinfo['priesthood'],
            11 => $this->moUser->mProfile->GetSchoolClassList(UID, !empty($this->ward_i['id']) ? $this->ward_i['id'] : 0, 1)
            );
        
        return $ar_filts;
    }/* _initFilts */


    //---- Main Methods

    //--Get & Edit Wall Info
    public function GetEdit()
    {
        $errs = array();
        $errs = array();
        $wi = array(); //Wall info (story, ev_title, l_url & etc.)
        $si = array(); //System info (privacy, is_answ, mes_id, answ_id & etc.)

        $wi = _v('WI');
        $si = _v('SI');
        if (!empty($wi)) //edit Wall info
        {
            /* Set the necessery to complete fields
              $mtype - 1 - message, 2 - event, 3 - link, 4 - photo, 5 - video */
            $n_data = array(); //necessary data array

            isset($wi['mtype']) ? $mtype = (int) $wi['mtype'] : $mtype = 0;

            if (!empty($mtype))  //if additional attaches exists - do check & mes are not checked, else - mes checking
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
                $n_data = array('story');

            $ex_cols = $this->moWall->GetCols(); //data's columns in DB
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
                        }
                        elseif (4 == $mtype && 'p_img' == $k) //check photo
                        {
                            $cnt_wi_pimg = isset($wi['p_img']) ? count($wi['p_img']) : 0;
                            $this->cnt_p_upl = $cnt_wi_pimg;
                            $l_el = !count($wi_k) ? 0 : count($wi_k) - 1;

                            //get ID of the current system_album
                            require_once 'Model/Base/Albums.class.php';
                            $moAlbums = new Model_Base_Albums($this->mlObj['gDb']);
                            $ualb_sys = $moAlbums->GetUAlbums(UID, 2);
                            foreach ($ualb_sys as $k => $r)
                            {
                                if ('Ward' == $r['name'])
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
                                        $wpar = array('aid', 'img', 'descr', 'fpath', 'adi_id', 'adi_id2');
                                        $wval = array($swall_id, $wi_r[$cur_el], '', GetPostfix(UID), $this->wid, $this -> ward_i['id_parent']);
                                        if ($wi_r[$cur_el + 10] = $moAlbums->UpdImg($wpar, $wval))
                                        {
                                            $wi_k[$cur_el + 10] = 'p_img_' . $i . '_id';
                                        }
                                    }
                                }
                            }
                            //deb($errs);
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
                                if ('Ward' == $r['name'])
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
//                              $wi_r[$cur_el + 10] = $moAlbums->UpdImg($wpar, $wval);
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
                                $moVAlbums = new Model_Base_Valbums($this->mlObj['gDb']);
                                $ualb_sys = $moVAlbums->GetUValbums(UID_OTHER, 2);
                                foreach ($ualb_sys as $k => $r)
                                {
                                    if ('Ward' == $r['name'])
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
                                        $wpar = array('vaid', 'video', 'descr', 'adi_id', 'adi_id2');
                                        $wval = array($svwall_id, $video_code, '', $this->wid, $this -> ward_i['id_parent']);

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
                        } else //check other elements
                        {
                            $wi_k[] = base_chk($k);
                            //$wi_r[] = base_chk4($r, ($k == 'story' ? -1 : 480));


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
                $wi_k = array_merge(array('wid', 'uid', 'is_copy', 'is_copy_mes'), $wi_k); //add ward's ID & UID data in DB
                $wi_r = array_merge(array(0, UID, 0, 0), $wi_r);

                //send to current user
                $mes_id  = isset($wi['mes_id']) ? (int) $wi['mes_id'] : 0;
                $privacy = isset($si['privacy']) ? (int) $si['privacy'] : 0;  //set privacy

                //-- check subprivacy
                $sub_privacy = isset($si['sub_privacy']) ? (int) $si['sub_privacy'] : '';
                $sub_privacy_module_val =  (isset($si['sub_privacy_module_val'])) ? (int) $si['sub_privacy_module_val'] : 0;

                //-- class
                $sub_privacy_class =  (isset($si['sub_privacy_class'])) ? $si['sub_privacy_class'] : 0;


                $wards = array($this->moWard->Get($this->wid));
                if ($privacy == 1 && $this->filts[3] > 0)
                {
                    $wards = array_merge($wards, $this->moWard->GetList($this->filts[3], -1, 0, 0, '', $this->wid));
                }
                /* elseif ($privacy == 0 && $this->filts[2] > 0) {		// share for ward
                  $wards = array($this -> moWard ->Get($this->filts[2]));
                  } 
                 */

                $or_mes_id = 0;


                foreach ($wards as $ward)
                {

                    $ind_is_copy = array_search('is_copy', $wi_k);
                    $ind_is_copy_mes = array_search('is_copy_mes', $wi_k);

                    if ($ward['id'] != $this->wid && $or_mes_id && false != $ind_is_copy && false != $ind_is_copy_mes)
                    { // copy
                        $wi_r[$ind_is_copy] = 1;
                        $wi_r[$ind_is_copy_mes] = $or_mes_id;
                    }
                    else
                    {
                        $wi_r[$ind_is_copy] = 0;
                        $wi_r[$ind_is_copy_mes] = 0;
                    }
                    //send to current ward

                    $ind = array_search('wid', $wi_k);
                    if (false !== $wi_r[$ind])
                        $wi_r[$ind] = $ward['id'];
                    else
                        continue;

                    $id = $this->moWall->Edit($mes_id, $wi_k, $wi_r);
                    $c_id = $id ? $id : $mes_id;

                    $or_mes_id = !$or_mes_id ? $id : $or_mes_id;

                    if ($id)
                    {
                        //--send a notification
                        isset($wi['mtype']) ? $mtype = $wi['mtype'] : $mtype = 1;
                        if (1 == $mtype)
                            $ntype = 1;
                        else if (2 == $mtype)
                            $ntype = 4;
                        else if (3 == $mtype)
                            $ntype = 5;
                        else if (4 == $mtype)
                            $ntype = 2;
                        else if (5 == $mtype)
                            $ntype = 3;
                        else
                            $ntype = 1;
                        isset($wi['story']) ? $n_ad_info = $wi['story'] : $n_ad_info = '';
                        $n_ad_link = '/wards/id' . $ward['id'];
                        $n_ad_link_txt = $ward['title'];

                        $ar_wusers = $this->moWall->GetWUsers($ward['id']);
                        foreach ($ar_wusers as $k => $r)
                        {
                            if (1 == $r['notify_ward'] && UID != $r['uid'])
                                $s_notify = $this->mlObj['notify']->UpdUNotify($ntype, 2, $n_ad_info, $n_ad_link, $n_ad_link_txt, UID, $r['uid']);
                        }
                    }

                    if ($id || !empty($mes_id))
                    {
                        //$ptype,    $mid,      $wid,           $uwid,                $stype
                        $this->moWall->EditPrivacy($privacy, $c_id, $ward['id'], $this->filts[$privacy], $sub_privacy_module_val, $sub_privacy_class);
                    }
                }

                
                if ($id || !empty($mes_id))
                {
                    //$ptype,    $mid,      $wid,           $uwid,                $stype
                    //$this -> moWall -> EditPrivacy( $privacy, $c_id, $this -> wid, $this -> filts[$privacy], $sub_privacy_module_val );

                    $mai = $this->moWall->GetOne($c_id, UID); //if IS_USER - without filtering
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
                    $this->mSmarty->assign_by_ref('mai', $mai);
                    //-- smile arrays
                    $this->mSmarty->assign_by_ref('sname',$this->moWall->moSmiles->smile_name);
                    $this->mSmarty->assign_by_ref('snamecode',$this->moWall->moSmiles->smile_name_code);

                    //-- get tags list
                    $ctags = $this->moUser->mUser->GetTags(UID);
                    $cnt_ctags = $this->moUser->mUser->GetCntTags(UID);
                    $this->mSmarty->assign_by_ref('ctags', $ctags);
                    $this->mSmarty->assign_by_ref('cnt_ctags', $cnt_ctags);

                    $this->mSmarty->assign_by_ref('ctags_fav', $this->moUser->mUser->GetOneTag(-1, UID, 2));

                    $this->mSmarty->assign_by_ref('uclasses_index', $this->moUser->mProfile->GetSchoolClassList(UID, $this -> moUser -> mUinfo['ward_id']/*$this->moUser->mProfile->GetWardId(UID)*/, 2));
                    $this->mSmarty->display('mods/wards/_wall_one.html');
                }
                else
                {
                    die('not_success');
                }
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


            //watching            
            $ar_whatching = $this->moWard->GetWhatchingList(UID, 0, 0, -1, 1);

            if (!empty($ar_whatching[$this->wid]))
            {
                //set filter for watching
                $this -> filts['33'] = UID;
            }


            $mai = $this->moWall->GetList($this->wid, $pcnt, $rcnt, -1, '', $this->filts, 0, 0, $show_item); //if IS_USER - without filtering (show all)
            $cnt_mes = $this->moWall->GetCnt($this->wid, '', $this->filts);
           
            if (!empty($mai))
            {
                $fr_ar = array();

                /** get current user favorites */
                $r_fav = $this->moWall->ChckExFavTag($this->moWall->GetCurrentMesgAr(), UID, 3);

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
            }

            //-- get tags list
            $ctags     = $this->moUser->mUser->GetTags(UID);
            $cnt_ctags = $this->moUser->mUser->GetCntTags(UID);
            $this->mSmarty->assign_by_ref('ctags', $ctags);
            $this->mSmarty->assign_by_ref('cnt_ctags', $cnt_ctags);

            $this->mSmarty->assign_by_ref('ctags_fav', $this->moUser->mUser->GetOneTag(-1, UID, 2));

            //-- get ward's users
            $ar_wusers = $this->moWall->GetWUsers($this->wid, 0, 9);
            $this->mSmarty->assign_by_ref('cnt_ar_wusers', $this->moWall->GetCntWUsers($this->wid));
            $this->mSmarty->assign_by_ref('ar_wusers', $ar_wusers);

            //-- Ward/Stake Watching
            $this->mSmarty->assign_by_ref('ar_whatching', $ar_whatching);
            $cnt_whatching = count($ar_whatching);//$this->moWard->GetCntWhatching(UID);
            $this->mSmarty->assign_by_ref('cnt_whatching', $cnt_whatching);

            if (!empty($this->wid))
            {
                $wwhatch = !empty($ar_whatching[$this->wid]) ? $ar_whatching[$this->wid] : array();//$this->moWard->GetWhatching($this->wid, UID);
                $this->mSmarty->assign_by_ref('wwhatch', $wwhatch);
            }

            $this->mSmarty->assign_by_ref('sname',$this->moWall->moSmiles->smile_name);
            $this->mSmarty->assign_by_ref('snamecode',$this->moWall->moSmiles->smile_name_code);

            $this->mSmarty->assign_by_ref('mai', $mai);//deb($mai);
            $this->mSmarty->assign_by_ref('cnt_mes', $cnt_mes);
            $this->mSmarty->assign_by_ref('pcnt', $pcnt);
            $this->mSmarty->assign_by_ref('rcnt', $rcnt);
            $this->mSmarty->assign('_content', $this->mSmarty->fetch('mods/wards/_wall.html'));
        }
    }/* GetEdit */

    //-- Get & Edit Answers Info
    public function GetEditAnsw()
    {
        $errs = array();
        $wi   = array();	//Wall info (story, ev_title, l_url & etc.)
        $si   = array();	//System info (privacy, is_answ, mes_id, answ_id & etc.)
        $wi = _v('WI');
        $si = _v('SI');
        if (!empty($wi))	//edit Answers info

        {
            if (!defined('UID'))
                $errs[] = 'User is not authorized';

            $n_data = array('story');	//necessery data
            $ex_cols = $this -> moWall -> GetAnswCols();	//data's columns in DB

            foreach ($wi as $k=>$r)
            {
                if (!in_array($k, $ex_cols))	//additional check by existing fields in DB
                    unset($wi[$k]);
                else
                {
                    $wi_k[] = base_chk($k);
                    $wi_r[] = base_chk5($r, 8192);
                }
            }

            isset($si['mes_id']) ? $mes_id = (int)$si['mes_id'] : $mes_id = 0;
            isset($si['answ_id']) ? $answ_id = (int)$si['mes_id'] : $answ_id = 0;

            if ($mes_id)
            {
                $wi_k = array_merge(array('uid', 'mid'), $wi_k);	//add ward's ID & UID data
                $wi_r = array_merge(array(UID, $mes_id), $wi_r);

                $id = $this -> moWall -> EditAnsw( $answ_id, $wi_k, $wi_r );

                if ($id)
                {
                    //--send a notification
                    $ntype = 10;
                    isset($wi['story']) ? $n_ad_info = $wi['story'] : $n_ad_info = '';
                    $n_ad_link = '/wards/id'.$this -> ward_id;
                    $n_ad_link_txt = $this -> ward_i['title'];

                    $ar_wusers = $this -> moWall -> GetWUsers( $this -> wid );
                    foreach ( $ar_wusers as $k => $r )
                    {
                        if (1 == $r['notify_ward'] && UID != $r['uid'])
                            $s_notify = $this -> mlObj['notify'] -> UpdUNotify( $ntype, 2, $n_ad_info, $n_ad_link, $n_ad_link_txt, UID, $r['uid'] );
                    }
                }

                if ($id || $answ_id)
                {
                    if ($id) $c_id = $id; else $c_id = $answ_id;
                    $ai = $this -> moWall -> GetAnswOne( $c_id );
                    if (!empty($ai['story']))
                    {
                        $this->moWall->moSmiles->FindSmile($ai['story']);
                    }

                    $this -> mSmarty -> assign_by_ref( 'ai', $ai );
                    $this -> mSmarty -> display( 'mods/wards/_wall_answ_one.html' );
                }
                else
                    die('not_success');
            }
            else
                die('not_success');
            exit();
        }
        else	//show Answers info

        {
            $mid = (int)_v('mid');
            if (!empty($mid) && defined('UID'))
            {
                $pcnt = -1;
                $rcnt = -1;
                $ai = $this -> moWall -> GetAnswList( $this -> wid, $pcnt, $rcnt, -1 );
                $this -> mSmarty -> assign_by_ref( 'ai', $ai );
                //deb($mai);
                $this -> mSmarty -> assign('_content', $this -> mSmarty -> fetch('_ch_wall_templ.html') );
            }
            else
                uni_redirect( PATH_ROOT . '' );
        }
    }/* GetEditAnsw */





    //---- Ajax Methods

    //-- Get List throught Ajax
    public function GetListAjax()
    {
        if (defined('UID'))
        {
            $rcnt    = 7;
            $last_id = (int) _v('last_id', 0);
            $pcnt    = 0;

            $sf_type    = _v('sf_type');
            $sf 	= (int)_v('sf');
            $str_filter = '';
            if (in_array($sf_type, array('1', '2')) && !empty($sf))
            {
                $str_sf_type = (1 == $sf_type) ? 'w.mtype' : 'p.ptype';
                $str_filter  = $str_sf_type.' = '.$sf;
            }

            $ar_whatching = $this->moWard->GetWhatchingList(UID, 0, 0, -1, 1);
            if (!empty($ar_whatching[$this->wid]))
            {
                //set filter for watching
                $this -> filts['33'] = UID;
            }
            
            $mai = $this -> moWall -> GetList( $this -> wid, $pcnt, $rcnt, -1, $str_filter, $this->filts, $last_id );	//if IS_USER - without filtering (show all)
            $first_item = $this -> moWall -> GetFirstMessageId( $this -> wid, $pcnt, $rcnt, -1, $str_filter, $this->filts );

            //$cnt_mes = $this -> moWall -> GetCnt( $this -> wid, $str_filter, $this -> filts, $last_id );

            if (!empty($mai))
            {
                $fr_ar = array();

                /** get current user favorites */
                $r_fav = $this -> moWall -> ChckExFavTag($this -> moWall -> GetCurrentMesgAr(), UID, 3);

                /** update params */
                foreach ($mai as $k => &$r)
                {
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
                            $this->moWall->EditUrlTitle($r['l_url'], $r['l_url_label'].' ');
                        }
                    }
                    if (!isset($fr_ar[$r['uid']]))
                    {
                        $fr_ar[$r['uid']] = $this->moUser->_initRelations($r['uid']);
                    }
                    $r['relations'] = $fr_ar[$r['uid']];

                    $mesg_l = (!empty($mesg_l) ?  $mesg_l . ', ' : '') . $r['id'];
                }
                if (!empty($mesg_l))
                {
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
            }

            $this -> mSmarty -> assign_by_ref( 'sf_type', $sf_type );
            $this -> mSmarty -> assign_by_ref( 'sf', $sf );

            $this -> mSmarty -> assign_by_ref( 'pcnt', $pcnt );
            $this -> mSmarty -> assign_by_ref( 'rcnt', $rcnt );
            $this -> mSmarty -> assign_by_ref( 'mai', $mai );
            //$this -> mSmarty -> assign_by_ref( 'cnt_mes', $cnt_mes );

            if (!empty($first_item) && !empty($mai) && $mai[count($mai)-1]['id'] > $first_item)
            {
                $this->mSmarty->assign('show_more', 1);
            }
            
            //smile arrays
            $this->mSmarty->assign_by_ref('sname',$this->moWall->moSmiles->smile_name);
            $this->mSmarty->assign_by_ref('snamecode',$this->moWall->moSmiles->smile_name_code);

            //-- get tags list
            $ctags = $this -> moUser -> mUser -> GetTags( UID );
            $cnt_ctags = $this -> moUser -> mUser -> GetCntTags( UID );
            $this -> mSmarty -> assign_by_ref( 'ctags', $ctags );
            $this -> mSmarty -> assign_by_ref( 'cnt_ctags', $cnt_ctags );

            $this->mSmarty->assign_by_ref('uclasses_index', $this->moUser->mProfile->GetSchoolClassList(UID, $this -> wid, 2));
            $this -> mSmarty -> assign_by_ref('ctags_fav', $this -> moUser -> mUser -> GetOneTag( -1, UID, 2 ));

            $this -> mSmarty -> display('mods/wards/_wall_list.html');
        }
        else
            die('not_success');
        exit();
    }/* GetListAjax */


    //-- Get One Message throught Ajax
    public function GetOneAjax()
    {
        $id = (int)_v('id');
        if (defined('UID') && !empty($id))
        {
            $mai = $this -> moWall -> GetOne( $id, UID );	//if IS_USER - without filtering
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
            $this -> mSmarty -> assign_by_ref( 'mai', $mai );
        
            $this -> mSmarty -> display('mods/wards/_wall_one.html');
        }
        else
            die('not_success');
        exit();
    }/* GetOneAjax */


    //-- Get One Message throught Ajax
    public function GetAnswListAjax()
    {
        $mid = (int)_v('mid');
        if (defined('UID') && !empty($mid))
        {
            /*
            $apcnt = (int)_v('apcnt');
            $arcnt = (int)_v('arcnt');
            if (empty($apcnt))
                $apcnt = 0;
            if (empty($arcnt))
                $arcnt = $this -> moWall -> GetAnswCnt( $mid );
            */

            $ai = $this -> moWall -> GetAnswList( $mid, /*$apcnt*/-1, /*$arcnt*/-1, 'wa.pdate ASC' );	//if IS_USER - without filtering (show all)
            $this -> mSmarty -> assign_by_ref( 'ai', $ai );
            $this -> mSmarty -> display('mods/wards/_wall_answ_list.html');
        }
        else
            die('not_success');
        exit();
    }

    
    //-- Delete Message throught Ajax
    public function DelAjax()
    {
		if (!defined('UID'))
			exit();

        $id = (int) _v('mes_id', 0);
		$mes = $this -> moWall ->GetOne($id, UID);
        
		if (defined('UID') && !empty($mes) && $mes['uid'] == UID)
            $this -> moWall -> Del( $id, UID );
        else
            die('not_success');
        exit();
    }/* DelAjax */

    //-- Delete Answer throught Ajax
    public function DelAnswAjax()
    {
        $mid = (int)_v('mid');
        if (defined('UID') && !empty($mid))
            $this -> moWall -> DelAnsw( $mid );
        else
            die('not_success');
        exit();
    }/* DelAnswAjax */

    //-- Check Video existing
    public function ChckVideoAjax()
    {
        $id  = (int)_v('id');
        if (defined('UID') && !empty($id))
        {
            $vi  = $this -> mVideo -> Get($id);
            $res = array('id' => $id, 'vi' => '');
            if (!empty($vi) && !empty($vi['video']))
                $res['vi'] =  $vi['video'];
            echo Ar2Json($res);
        }
        else
            die('not_success');
        exit();
    }/* ChckVideoAjax */









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
                if (10240000 < $_FILES['Filedata']['size'] || 1 > $_FILES['Filedata']['size'] )
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
                        if (!file_exists($targetPath.'n/'))
                        {
                            mkdir($targetPath.'n/', 0777);
                            chmod($targetPath, 0777);
                        }
                        if (!file_exists($targetPath.'a/'))
                        {
                            mkdir($targetPath.'a/', 0777);
                            chmod($targetPath, 0777);
                        }
                        if (!file_exists($targetPath.'m/'))
                        {
                            mkdir($targetPath.'m/', 0777);
                            chmod($targetPath, 0777);
                        }
                        if (!file_exists($targetPath.'s/'))
                        {
                            mkdir($targetPath.'s/', 0777);
                            chmod($targetPath, 0777);
                        }

                        $crand = mktime().rand(100, 999);
                        //$targetFile = UID.'_ww_'.$this -> wid.'_'.date('dmYHi').'_'.$crand.'_'.$_FILES['Filedata']['name'];
                        $targetFile = UID.'_ww_'.$this -> wid.'_'.$crand.'_'.Txt2Charset($_FILES['Filedata']['name']);
                        $target = $targetPath.$targetFile;
                        if (file_exists($target))
                            unlink($target);

//                        $cnt_photo = (int)$_POST['cnt_p_img'];
//                        if (!empty($cnt_photo))
//                            $p_width = 358/$cnt_photo;
//                        if (200 <= $p_width)
//                            $p_width  = 200;

						i_crop_copy(658, 439, $_FILES['Filedata']['tmp_name'], $targetPath.'n/n_'.$targetFile, 2);
						$src = $targetPath.'n/n_'.$targetFile;
                        i_crop_copy(358, 200, $src,$target,2);
                        i_crop_copy(324, 217, $src, $targetPath.'a/a_'.$targetFile, 2);
                        i_crop_copy(69, 69,   $src, $targetPath.'m/m_'.$targetFile, 1);
                        i_crop_copy(49, 49,	  $src, $targetPath.'s/s_'.$targetFile, 1);

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
    }/* ChkUplPhoto */

    /** Youtube loader class */
    public function YTLoader()
    {
        $errs = array();
        if (defined('UID'))
        {
            ini_set(max_execution_time, 3600);
            ini_set(memory_limit, '512M');
            $upl_dir  = DIR_WS_VIDEO;

            require_once 'Ctrl/Base/YouTube.class.php';
            $res = array('err' => 0);
            $yt = new YouTube();

            $mod = _v('module', '');
            switch ($mod)
            {
                case 'token':
                    $title = 'title';
                    $descr = 'description';

                    $params  = $yt -> getToken($title, $descr, $cat, $tags ? $tags : 'Inzion');
                    if (_v('unid') && !empty($params))
                    {
                        $res['unid']  = _v('unid');

                        $res['url']   = $params['url'].'?nexturl=http://inzion.com.local/id'.$this -> wid.'/wall/ytloader?unid='.$res['unid'];
                        $res['token'] = $params['token'];
                    }
                    break;

                /*
            	case 'test':
	                $data = $yt -> get('JKI0LafCPac');
	                deb($data);
	                break;
                */
                default:
                    $unid = (int)_v('unid');
                    if (!empty($unid))
                    {
                        file_put_contents(BPATH.'files/tmp/'.mktime().'.txt', print_r($_REQUEST, 1));
                        /*
	                    if (!empty($_REQUEST['status']) && 200==$_REQUEST['status'] && !empty($_REQUEST['id']))
	                    {
	                        $this -> mVideo -> UpdVideo($unid, UID, $_REQUEST['id']);
	                    }
                        */
                    }
            }
            echo Ar2Json($res);
        }
        exit();
    }/** YTLoader */
}/** Ctrl_Wards_Wall */
?>