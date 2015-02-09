<?php
/**
 * Valbums Base controller
 * @package    5dev Catalog
 * @version    1.0
 * @since      1.03.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */
class Ctrl_Base_Valbums extends Ctrl_Base
{
    private $mValbums;
    private $initErrs;

    public function __construct(&$glObj)
    {
        parent :: __construct($glObj);

        if (!defined('UID'))
            uni_redirect(PATH_ROOT . '');

        $this -> pcnt = 6;

        include_once 'Model/Base/Valbums.class.php';
        $this -> mValbums = new Model_Base_Valbums($glObj['gDb']);

        $this->filts = $this->_initFilts(); //get table Filters

        $this -> mSmarty -> assign('HIDE_LC', 1); //hide LEFT COLUMN
        $this -> fpath = DIR_WS_IMAGE . 'valbums/';
        $this -> fpath_tmp = DIR_WS_IMAGE . 'valbums/_temp/';
        $this -> initErrs = array();


        #global privacy
        /*	if (!IS_USER && !$this -> moUser -> mUi['global']['videos'])
		{
			$this->mSmarty->assign('_content', '<center><h3>This section is set to private</h3></center>');
			$this->mSmarty->assign('no_access', true);
			$this -> mSmarty -> assign('gCnt', $GLOBALS['gCnt']);
            $this -> mSmarty -> assign('gTime', get_mt_time() - $GLOBALS['gtime']);
			$this -> mSmarty -> display('main.html');
			die();
		} */
    }


    public function _initFilts()
    {
        $u_other = $this->moUser->mUi;

        $ar_filts = array(0 => '0', 1 => $u_other['im_suscr_fr'], 2 => $u_other['im_friend'], 3 => $u_other['im_fam'], 4 => UID_OTHER, 5 => UID);
        return $ar_filts;
    }


    public function Index()
    {
        $this -> GetList();
    }
    

    /**
     *  Get List of the Valbums
     */
    public function GetList()
    {
        $albs = $this -> mValbums -> GetUValbums(UID_OTHER, -1, -1, -1, -1, -1, 1);
        
        $al   = array();
        $al_sys = array();
        foreach ($albs as $v)
        {
            if ($v['type']==1)
            {
                $al[] = $v;
            }
            elseif ($v['type']==2)
            {
                $al_sys[] = $v;
            }
        }
        unset($albs);
        $this -> mSmarty -> assign_by_ref('al', $al);
        $this -> mSmarty -> assign_by_ref('al_sys', $al_sys);

        $this -> mSmarty -> assign('m_page', 'valbums_list');
        $this -> mSmarty -> assign('_content', $this -> mSmarty -> fetch('mods/valbums/_list.html'));
    }


    /**
     * Check global privacy 
     * @param  $ai
     * @param bool $ajax
     * @return void
     */
    public function checkGP($ai, $ajax = false)
    {

        if (empty($this -> moUser -> mUi['global']))
        {
            echo 'not_success';
            die();
        }

        $tg = $this -> moUser -> mUi['global'];

        if (empty($ai))
        {
            if ($ajax)
            {
                echo 'not_success';
                die();
            }
            else
                uni_redirect(PATH_ROOT . 'id' . UID_OTHER . '/valbums');
        }
        else
        {
            if (IS_USER && $ai['uid'] != UID)
            {
                /**
                 * Error album ID!!!!
                 */
                if ($ajax)
                {
                    echo 'not_success';
                    die();
                }
                else
                    uni_redirect(PATH_ROOT . 'id' . UID_OTHER . '/valbums');
            }
        }

        if ($ai['name'] == 'Wall' && 2 == $ai['type'] && !$tg['news'])
        {
            if ($ajax)
            {
                echo 'not_success';
                die();
            }
            else
                uni_redirect(PATH_ROOT . 'id' . UID_OTHER . '/valbums');
        }

        if ($ai['name'] == 'Journal' && 2 == $ai['type'] && !$tg['notes'])
        {
            if ($ajax)
            {
                echo 'not_success';
                die();
            }
            else
                uni_redirect(PATH_ROOT . 'id' . UID_OTHER . '/valbums');
        }


        if (!$tg['videos'] && $ai['type'] != 2)
        {
            if ($ajax)
            {
                echo 'not_success';
                die();
            }
            else
                uni_redirect(PATH_ROOT . 'id' . UID_OTHER . '/valbums');
        }
    }


    public function GetVideos()
    {
        $vl = array();

        $vaid = _v('vaid', 0);
        if (!$vaid)
        {
            uni_redirect( PATH_ROOT . 'id'.UID.'/valbums' );
        }


        if ($vaid)
        {
            $atype = 'album';
            $ai = $this->mValbums->GetVAlbum($vaid);

            /** check access to album */
            $this->checkGP($ai);

            /** get videos list */
            $page = _v('page', 1);
            include_once 'View/Acc/Pagging.php';
            $vl = $this->mValbums->GetVideos($vaid);
            

            if ($ai['name'] == 'Wall' && 2 == $ai['type'])
            {
                require_once 'Ctrl/Profile/Wall.class.php';
                $moWall = new Ctrl_Profile_Wall($this->mlObj);

                if (UID_OTHER != UID)
                {
                    $w_filts = $moWall->_initFilts();
                    $w_sfilts = $moWall->_initSFilts();
                    $check_wall_rights = 1;
                }
            }
            elseif ($ai['name'] == 'Journal' && 2 == $ai['type'])
            {
                require_once 'Ctrl/Journal/Wall.class.php';
                $moJournal = new Ctrl_Journal_Wall($this->mlObj);
                if (UID_OTHER != UID)
                {
                    $j_filts = $moJournal->_initFilts();
                    $j_sfilts = $moJournal->_initSFilts();
                    $check_journal_rights = 1;
                }
            }
            elseif ($ai['name'] == 'Ward' && 2 == $ai['type'])
            {
                require_once 'Ctrl/Wards/Wall.class.php';
                $moWard = new Ctrl_Wards_Wall($this->mlObj);
                if (UID_OTHER != UID)
                {
                    $wd_filts = $moWard->_initFilts();
                    $check_ward_rights = 1;
                }
            }


            $vla = array();
            foreach ($vl as $k => $r)
            {
                /** check rights */
                if (!empty($check_wall_rights) && !empty($w_filts) && !empty($w_sfilts))
                {
                    $mid = $moWall->moWall->CheckMessageVideoAccess($r['id'], $w_filts, UID_OTHER, !IS_USER ? $w_sfilts['priesthold'] : -1, !IS_USER ? $w_sfilts['classes'] : -1);
                    if (!$mid)
                    {
                        continue;
                    }
                }
                elseif (!empty($check_journal_rights) && !empty($j_filts) && !empty($j_sfilts))
                {
                    $mid = $moJournal->moWall->CheckMessageVideoAccess($r['id'], $j_filts, UID_OTHER, !IS_USER ? $j_sfilts['priesthold'] : -1, !IS_USER ? $j_sfilts['classes'] : -1);
                    if (!$mid)
                    {
                        continue;
                    }
                }
                elseif (!empty($check_ward_rights) && !empty($wd_filts))
                {
                    //deb($vl);
                    $wd_filts[0] = (!empty($r['adi_id']) && !empty($this -> moUser -> mUinfo['ward_id']) && $r['adi_id'] == $this -> moUser -> mUinfo['ward_id']) ? 1 : 0;
                    $wd_filts[4] = (!empty($r['adi_id2']) && !empty($this -> moUser -> mUinfo['stake_id']) && $r['adi_id2'] == $this -> moUser -> mUinfo['stake_id']) ? 1 : 0;

                    //deb($vl, 0);

                    $mid = $moWard->moWall->CheckMessageVideoAccess($r['id'], $wd_filts, UID_OTHER);
                    if (!$mid)
                    {
                        continue;
                    }
                }

                //get last comment for each album
                //$r['lcom'] = $this->mValbums->GetAlbVideoLastCom($r['vaid'], $r['id']);
                $vla[] = $r;
            }
            
            $vl = $vla;
            unset($vla);
        }

        $rcnt = count($vl); // total allowed messages, need pagging now
        $mpage = new Pagging($this -> pcnt, $rcnt, $page);
        $range =& $mpage->GetRange();

        $vl = array_slice($vl, $range[0], $this -> pcnt);
        foreach ($vl as &$ph)
        {
            $ph['lcom'] = $this->mValbums->GetAlbVideoLastCom($ph['vaid'], $ph['id']);
        }

        $this->mSmarty->assign('rcnt', $rcnt);
        $this->mSmarty->assign('plist_c', $range[1] - $range[0]);
        $this->mSmarty->assign('pagging', $mpage->Make($this->mSmarty));

        //get List of the User's Valbums
        $al = $this->mValbums->GetUValbums(UID_OTHER, 1);

        $this->mSmarty->assign_by_ref('al', $al);

        $_ui = $this->moUser->mUi;
        if (!$_ui['global']['videos'])
        {
            $other_alb = array();
        }
        else
        {
            $other_alb = $this->mValbums->GetRandomUAlbums(UID_OTHER);
        }

        $this->mSmarty->assign_by_ref('other_alb', $other_alb);

        $this->mSmarty->assign_by_ref('vl', $vl);
        $this->mSmarty->assign_by_ref('cnt_pl', count($vl));
        $this->mSmarty->assign_by_ref('cnt_hpl', ceil(count($vl) / 2));
        $this->mSmarty->assign_by_ref('atype', $atype);
        $this->mSmarty->assign_by_ref('ai', $ai);

        $this->mSmarty->assign('m_page', 'valbums_videos');
        $this->mSmarty->assign('_content', $this->mSmarty->fetch('mods/valbums/_videos.html'));
    }


    public function GetVideo()
    {
        $vaid = (int) _v('vaid');
        $vid  = (int) _v('vid');

        $ai   = $this -> mValbums -> GetVAlbum($vaid);

        //global privacy
        $this -> checkGP($ai);

        $vi = $this -> mValbums -> GetVideo($vaid, $vid);

        if ($ai && $vi)
        {
            //check album owner
            $uid_alb = ($ai['uid'] != UID_OTHER) ? $ai['uid'] : UID_OTHER;

            //&& set IS_USER status
            if ($uid_alb == $this -> moUser -> mUinfo['uid'])
            {
                $this->mSmarty->assign('IS_USER', 1);
            }
            else
            {
                $this->mSmarty->assign('IS_USER', 0);
            }

            if ($vi['vaid'] != $ai['vaid'])
            {
                //error album ID
                uni_redirect(PATH_ROOT . 'id' . $uid_alb . '/albums/id' . $ai['vaid']);
            }


            //local privacy - check rights
            if ($ai['name'] == 'Wall' && 2 == $ai['type'])
            {
                require_once 'Ctrl/Profile/Wall.class.php';
                $moWall = new Ctrl_Profile_Wall($this->mlObj);

                if (UID_OTHER != UID)
                {
                    $w_filts = $moWall->_initFilts();
                    $w_sfilts = $moWall->_initSFilts();
                    $check_wall_rights = 1;
                }
            }
            elseif ($ai['name'] == 'Journal' && 2 == $ai['type'])
            {
                require_once 'Ctrl/Journal/Wall.class.php';
                $moJournal = new Ctrl_Journal_Wall($this->mlObj);
                if (UID_OTHER != UID)
                {
                    $j_filts  = $moJournal->_initFilts();
                    $j_sfilts = $moJournal->_initSFilts();
                    $check_journal_rights = 1;
                }
            }

            if (!empty($check_wall_rights) && !empty($w_filts) && !empty($w_sfilts))
            {
                $mid = $moWall->moWall->CheckMessageVideoAccess($vid, $w_filts, UID_OTHER, !IS_USER ? $w_sfilts['priesthold'] : -1, !IS_USER ? $w_sfilts['classes'] : -1);
                if (!$mid)
                {
                    uni_redirect(PATH_ROOT . 'id' . UID_OTHER . '/valbums/id' . $ai['vaid']);
                }
            }
            elseif (!empty($check_journal_rights) && !empty($j_filts) && !empty($j_sfilts))
            {
                $mid = $moJournal->moWall->CheckMessageVideoAccess($vid, $j_filts, UID_OTHER, !IS_USER ? $j_sfilts['priesthold'] : -1, !IS_USER ? $j_sfilts['classes'] : -1);
                if (!$mid)
                {
                    uni_redirect(PATH_ROOT . 'id' . UID_OTHER . '/valbums/id' . $ai['vaid']);
                }
            }


            /*Get List of the User's Valbums */
            if (defined('IS_USER') && IS_USER)
            {
                $al = $this -> mValbums -> GetUValbums($uid_alb, 1);
                foreach ($al as $k => $r)
                {
                    if ($vaid == $r['vaid'])
                        unset($al[$k]);
                }
                $this -> mSmarty -> assign_by_ref('al', $al);
            }

            /* Comments */
            $pcnt = 4;
            $fcnt = 0;

            $what = array('*');
            $wpar = array('ic.vid');
            $wval = array($vid);
            $ar_video_com = $this -> mValbums -> GetAlbVideoCom($what, $wpar, $wval, $fcnt, $pcnt, 'id DESC');
            $cnt_video_com = $this -> mValbums -> GetCntVideoCom($vid);

            $this -> mSmarty -> assign_by_ref('fcnt', $fcnt);
            $this -> mSmarty -> assign_by_ref('ncnt', $ncnt);
            $this -> mSmarty -> assign_by_ref('pcnt', $pcnt);
            $this -> mSmarty -> assign_by_ref('ar_video_com', $ar_video_com);
            $this -> mSmarty -> assign_by_ref('cnt_video_com', $cnt_video_com);

            $this -> mSmarty -> assign_by_ref('vi', $vi);

            $this -> mSmarty -> assign_by_ref('ai', $ai);

            //$this->mValbums->UpdViewed($vid, $vaid);

            $this -> mSmarty -> assign('m_page', 'valbums_video');
            $this -> mSmarty -> assign('_content', $this -> mSmarty -> fetch('mods/valbums/_video.html'));
        }
        else
            uni_redirect(PATH_ROOT . 'id' . UID_OTHER . '/valbums');
    }



    public function Edit()
    {
        $ai = _v('AI');
        if ($ai)
        {
            $ai_k = array();
            $ai_r = array();
            $vaid = -1;
            foreach ($ai as $k => $r)
            {
                if ('id' != $k)
                    $ai_chk[$k] = base_chk($r);
                else
                    $vaid = $r;
            }


            if ($ai_chk['name'] != '')
            {
                $lid   = $this -> mValbums -> EditVAlbum($ai_chk, $vaid, UID);
                $alb_i = $this -> mValbums -> GetVAlbum($lid);
                $this -> mSmarty -> assign_by_ref('alb_i', $alb_i);
                $this -> mSmarty -> display('mods/valbums/_album_one.html');
            }
            else
                echo 'not_success';
        }
        else
            echo 'not_success';
        exit();
    }


    public function UplVideos()
    {
        $pi = _v('PI');
        if ($pi)
        {
            $pi_video = array();
            $video_code = $pi['video'];
            unset($pi['video']);

            foreach ($pi as $k => $r)
            {
                $pi_chk[base_chk($k)] = base_chk($r);
            }
            $pi_chk['video'] = chk_embed_code($video_code);

            $lid = array();

            $wpar = array('vaid', 'video' /*, 'descr'*/);
            $wval = array($pi_chk['vaid'], $pi_chk['video'] /*, $pi_chk['descr']*/);

            $lid = $this -> mValbums -> UpdVideo($wpar, $wval);
            if (!empty($lid))
            {
                echo $pi_chk['vaid'];
            }
            else
                echo 'not_success';
        }
        exit();
    }


    //--Change Valbums through Ajax
    public function ChngValbums()
    {
        $vid = (int) _v('vid');
        $vaid = (int) _v('vaid');

        if ($vid && $vaid)
        {
            $album = $this->mValbums->GetValbum($vaid);
            $old_album = $this->mValbums ->GetValbumByVideo($vid, UID);

            if (UID == $album['uid'] && UID == $old_album['uid'])
            {
                if (2 != $album['type'] && 2 != $old_album['type'])
                {
                    $this -> mValbums -> ChngVAlbum($vid, $vaid);
                }
                elseif (2 != $album['type'] && 2 == $old_album['type'])
                { #из системного в обычный
                    $video = $this -> mValbums ->GetVideo($old_album['vaid'], $vid);
                    if ($video)
                    {

                        $this->mValbums->UpdVideo(array('vaid', 'video', 'descr'),
                            array($album['vaid'], $video['video'], $video['descr']));
                        echo 'hold_still'; # okay
                    }
                    else
                        echo 'not_success';
                }
                else
                    echo 'not_success';
            }
            else
                echo 'not_success';
        }
        else
            echo 'not_success';
        exit();
    }


    //---- Ajax Methods

    //-- Delete Album through Ajax
    public function DelAjax()
    {
        $vaid = (int) _v('vaid');
        if (defined('UID') && !empty($vaid))
            $this -> mValbums -> Del($vaid, UID);
        else
            die('not_success');
        exit();
    }


    //get & edit current image info
    public function GetEditVideoAjax()
    {
        $vaid = (int) _v('vaid');
        $vid = (int) _v('vid');
        if ($vid && $vaid)
        {
            $ci = _v('CI');
            if ($ci)
            {
                if (!empty($ci['text']))
                {
                    $wpar = array('user_id', 'vid');
                    $wval = array(UID, $vid);
                    foreach ($ci as $k => $r)
                    {
                        $wpar[] = $k;
                        $wval[] = base_chk($r);
                    }
                    $wpar[] = 'vaid';
                    $wval[] = $vaid;

                    $whpar = array();
                    $whval = array();
                    $id_com = (int) _v('id_com');
                    if (!empty($id_com))
                    {
                        $whpar[] = 'id';
                        $whval[] = $id_com;
                    }
                    $lid = $this -> mValbums -> EditVideoCom($wpar, $wval, $whpar, $whval);
                    if ($lid)
                    {
                        //--send a notification
                        $ntype = 1;
                        isset($ci['text']) ? $n_ad_info = $ci['text'] : $_nad_info = '';
                        $n_ad_link = '/id' . UID_OTHER . '/valbums/id' . $vaid . '/id' . $vid;
                        $n_ad_link_txt = $this -> moUser -> mUi['first_name'] . ' ' . $this -> moUser -> mUi['last_name'];

                        if (1 == $this -> moUser -> mUi['notify_video'] && !IS_USER)
                            $s_notify = $this -> mlObj['notify'] -> UpdUNotify($ntype, 4, $n_ad_info, $n_ad_link, $n_ad_link_txt);
                    }
                }
            }

            /*Get List of the User's Valbums */
            $al = $this -> mValbums -> GetUValbums(UID_OTHER, 1);
            $this -> mSmarty -> assign_by_ref('al', $al);

            //album & video info
            $ai = $this -> mValbums -> GetVAlbum($vaid);
            $vi = $this -> mValbums -> GetVideo($vaid, $vid);

            $this -> mSmarty -> assign_by_ref('ai', $ai);
            $this -> mSmarty -> assign_by_ref('vi', $vi);

            $rtype = _v('rtype');
            if ('all' == $rtype || 'com' == $rtype)
            {
                /* Comments */
                $pcnt = 4;
                $fcnt = (int) _v('fcnt');
                $direct = (int) _v('direct');
                if (1 == $direct)
                    $fcnt += $pcnt;
                else
                    $fcnt -= $pcnt;

                if (!$fcnt || $fcnt < 0) $fcnt = 0;

                $what = array('*');
                $wpar = array('ic.vid');
                $wval = array($vid);
                $ar_video_com = $this -> mValbums -> GetAlbVideoCom($what, $wpar, $wval, $fcnt, $pcnt, 'id DESC');
                $cnt_video_com = $this -> mValbums -> GetCntVideoCom($vid);

                $this -> mSmarty -> assign_by_ref('fcnt', $fcnt);
                $this -> mSmarty -> assign_by_ref('ncnt', $ncnt);
                $this -> mSmarty -> assign_by_ref('pcnt', $pcnt);

                $this -> mSmarty -> assign_by_ref('vaid', $vaid);
                $this -> mSmarty -> assign_by_ref('vid', $vid);

                $this -> mSmarty -> assign_by_ref('ar_video_com', $ar_video_com);
                $this -> mSmarty -> assign_by_ref('cnt_video_com', $cnt_video_com);
            }

            if ('all' == $rtype)
            {
                $r = array();
                $r[0] = $pvideo;
                $r[1] = $nvideo;
                $r[2] = $this -> mSmarty -> fetch('mods/valbums/_video_one.html');
                $r[3] = $this -> mSmarty -> fetch('mods/valbums/_video_right_one.html');
                echo Ar2Json($r);
            }
            else if ('com' == $rtype)
                $this -> mSmarty -> display('mods/valbums/_video_com_list.html');
            exit();
        }
        else
            echo 'not_sucess';
        exit();
    }


    public function GetEVideoIAjax()
    {
        if (defined('UID'))
        {
            $res = chk_embed_code(_v('video', ''), 350, 250, 1);
            if (!empty($res))
            {
                echo $res[1];
            }
            else
            {
                echo 'not_success';
            }
            
        }
        else
        {
            echo 'not_success';
        }
        exit();
    }


    public function DelVideoAjax()
    {
        $vaid = _v('vaid', 0);
        $vid = _v('vid', 0);

        $album = $this -> mValbums ->GetVAlbum($vaid);
        if ($album && $album['uid'] != UID)
        {
            die('no way.');
        }

        if ($album && $album['uid'] == UID && $vaid && $vid)
        {
            $video = $this -> mValbums -> GetVideo($vaid, $vid);
            if (!empty($video) && isset($video['atype']))
            {
                //if (2 != $video['atype'])
                //{
                $this -> mValbums -> DelVideo($vaid, $vid);
                //}
                //else
                //{
                //    echo 'not_success';
                //}
                echo $vaid;
            }
            else
            {
                echo 'not_success';
            }
        }
        else
        {
            echo 'not_success';
        }
        exit();
    }


}
?>