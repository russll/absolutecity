<?php

/**
 * Albums Base controller
 * @package    5dev Catalog
 * @version    1.0
 * @since      1.03.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */
class Ctrl_Base_Albums extends Ctrl_Base
{

    private $mAlbums;
    private $initErrs;

    public function __construct(&$glObj)
    {
        parent :: __construct($glObj);

        $this -> pcnt = 6;

        if (!defined('UID'))
            uni_redirect(PATH_ROOT . '');

        $cnt_data = 10000; //count of data in one Table of DB
        $this->filts = $this->_initFilts(); //get table Filters

        include_once 'Model/Base/Albums.class.php';
        $this->mAlbums = new Model_Base_Albums($glObj['gDb']);

        //$this -> mSmarty -> assign('HIDE_LC', 1);	//hide LEFT COLUMN
        $this->fpath = DIR_WS_IMAGE . 'albums/';
        $this->fpath_tmp = DIR_WS_IMAGE . 'albums/_temp/';
        $this->initErrs = array();

    }


    /**
     * Initialization of privacy
     *  ar_filts:
     *             1 - friends & subscribers (1 - yes, 0 - not)
     *             2 - friend (1 - yes, 0 - not)
     *             3 - only family (1 - yes, 0 - not)
     *             4 - one (some person)
     *             5 - private (only me)
     *
     * @return filters array (ptype => uvid)
     */
    public function _initFilts()
    {
        $u_other = $this->moUser->mUi;
        $ar_filts = array(0 => UID,
            1 => (int) ($u_other['im_suscr_fr'] || $u_other['im_friend']),
            2 => $u_other['im_friend'],
            3 => $u_other['im_fam'],
            4 => UID,
            5 => UID,
            100 => $this->moUser->mProfile->GetWardId(UID),
            101 => $this->moUser->mProfile->GetStakeId(UID)); // 4 => UID ?????
        return $ar_filts;
    }


    //-- Get List of the Albums
    public function GetList()
    {
        $al = $this->mAlbums->GetUAlbums(UID_OTHER, 1, -1, -1, -1, !IS_USER ? $this->filts : array());

        $al_sys = $this->mAlbums->GetUAlbums(UID_OTHER, 2);

        $this->mSmarty->assign_by_ref('al', $al);
        $this->mSmarty->assign_by_ref('al_sys', $al_sys);
        foreach ($al as $k => $r)
        {
            $al[$k]['img'] = $this->mAlbums->GetLastPhoto($al[$k]['aid']);
        }
        foreach ($al_sys as $k => $r)
        {
            $al_sys[$k]['img'] = $this->mAlbums->GetLastPhoto($al_sys[$k]['aid']);
        }

        //deb($al);
        $this->mSmarty->assign('m_page', 'albums_list');
        $this->mSmarty->assign('_content', $this->mSmarty->fetch('mods/albums/_list.html'));
    }


    public function GetPhotos()
    {

        $pl = array();

        $aid = (int) _v('aid');

        if ($aid)
        {
            $atype = 'album';
            $ai = $this->mAlbums->GetAlbum($aid, !IS_USER ? $this->filts : array());
            $this->mSmarty->assign('owner', $ai['uid'] == UID);


            /** check access to album */
            $this->checkGP($ai);

            $page = _v('page', 1);
            include_once 'View/Acc/Pagging.php';
            $pl = $this->mAlbums->GetPhotos($aid, -1);


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

            if ($pl)
            {
                $pla = array();
                $jc = 0;
                foreach ($pl as $k => $r)
                {
                    /** check rights */
                    if (!empty($check_wall_rights) && !empty($w_filts) && !empty($w_sfilts))
                    {
                        $mid = $moWall->moWall->CheckMessagePhotoAccess($r['id'], $w_filts, UID_OTHER, !IS_USER ? $w_sfilts['priesthold'] : -1, !IS_USER ? $w_sfilts['classes'] : -1);
                        if (!$mid)
                        {
                            continue;
                        }
                    }
                    elseif (!empty($check_journal_rights) && !empty($j_filts) && !empty($j_sfilts))
                    {
                        $mid = $moJournal->moWall->CheckMessagePhotoAccess($r['id'], $j_filts, UID_OTHER, !IS_USER ? $j_sfilts['priesthold'] : -1, !IS_USER ? $j_sfilts['classes'] : -1);
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

                        $mid = $moWard->moWall->CheckMessagePhotoAccess($r['id'], $wd_filts, UID_OTHER);
                        if (!$mid)
                        {
                            continue;
                        }
                    }


                    $pla[] = $r;
                    $jc++;
                }
                $pl = $pla;
                unset($pla);
            }

            $rcnt = count($pl); // total allowed messages, need pagging now
            $mpage = new Pagging($this -> pcnt, $rcnt, $page);
            $range =& $mpage->GetRange();

            $pl = array_slice($pl, $range[0], $this -> pcnt);
            foreach ($pl as &$ph)
            {
                $ph['lcom'] = $this->mAlbums->GetAlbImgLastCom($ph['aid'], $ph['id']);
            }

            $this->mSmarty->assign('rcnt', $rcnt);
            $this->mSmarty->assign('plist_c', $range[1] - $range[0]);

            $this->mSmarty->assign('pagging', $mpage->Make($this->mSmarty));


            //get List of the User's Albums
            $al = $this->mAlbums->GetUAlbums(UID_OTHER, 1, 1, -1, -1, !IS_USER ? $this->filts : array());

            $this->mSmarty->assign_by_ref('al', $al);

            //get List of the 3 random abums
            if ($al)
            {
                $other_alb = $this->mAlbums->GetRandomUAlbums(UID_OTHER, !IS_USER ? $this->filts : array());
                if (1 == 0) /* wtf ?? */
                {
                    $oalb_ex = array();
                    for ($j = 0; $j < 3; $j++)
                    {
                        $naid = $al[rand(0, count($al) - 1)];
                        if (!in_array($naid['aid'], $oalb_ex))
                        {
                            $other_alb[$j] = $naid;
                            $other_alb[$j]['img'] = $this->mAlbums->GetLastPhoto($naid['aid']);
                            $oalb_ex[] = $naid['aid'];
                        }
                    }
                }

                $this->mSmarty->assign_by_ref('other_alb', $other_alb);
            }

            //get List of the last commented photos of the current album
            $what = array('*');
            $wpar = array('ic.aid');
            $wval = array($aid);
            $lcom = $this->mAlbums->GetAlbImgCom($what, $wpar, $wval, 0, 2, 'id DESC');
            $ind = 0;
            $ar_lap_com = array();
            if ($lcom)
            {
                $oalb_ex = array();
                foreach ($lcom as $k => $r)
                {
                    if (!in_array($lcom[$k]['iid'], $oalb_ex))
                    {
                        $cp = $this->mAlbums->GetPhoto($aid, $lcom[$k]['iid']);
                        if ($cp)
                        {
                            $ar_lap_com[$ind] = $cp;
                            $what = array('*');
                            $wpar = array('ic.aid', 'ic.iid');
                            $wval = array($aid, $ar_lap_com[$ind]['id']);
                            $ar_lap_com[$ind]['com'] = $this->mAlbums->GetAlbImgCom($what, $wpar, $wval, 0, 3, 'id DESC');
                        }
                        $oalb_ex[] = $lcom[$k]['iid'];
                    }
                    $ind++;
                }
                //deb($ar_lap_com);
                $this->mSmarty->assign_by_ref('ar_lap_com', $ar_lap_com);
            }

            $this->mSmarty->assign_by_ref('pl', $pl);
            $this->mSmarty->assign_by_ref('cnt_pl', count($pl));
            $this->mSmarty->assign_by_ref('cnt_hpl', ceil(count($pl) / 2));
            $this->mSmarty->assign_by_ref('atype', $atype);
            $this->mSmarty->assign_by_ref('ai', $ai);

            //deb(ceil(count($pl)/2));
            $this->mSmarty->assign('m_page', 'albums_photos');
            $this->mSmarty->assign('_content', $this->mSmarty->fetch('mods/albums/_photos.html'));
        }
        else
            uni_redirect(PATH_ROOT . 'id' . UID_OTHER . '/albums');
    }


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
                uni_redirect(PATH_ROOT . 'id' . UID_OTHER . '/albums');
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
                    uni_redirect(PATH_ROOT . 'id' . UID_OTHER . '/albums');
            }
        }

        if ($ai['name'] == 'Wall' && !$tg['news'])
            if ($ajax)
            {
                echo 'not_success';
                die();
            }
            else
                uni_redirect(PATH_ROOT . 'id' . UID_OTHER . '/albums');

        if ($ai['name'] == 'Journal' && !$tg['notes'])
            if ($ajax)
            {
                echo 'not_success';
                die();
            }
            else
                uni_redirect(PATH_ROOT . 'id' . UID_OTHER . '/albums');

        if (!$tg['photos'] && $ai['type'] != 2)
            if ($ajax)
            {
                echo 'not_success';
                die();
            }
            else
                uni_redirect(PATH_ROOT . 'id' . UID_OTHER . '/albums');
    }


    public function GetPhoto()
    {
        $aid = (int) _v('aid');
        $pid = (int) _v('pid');

        $ai = $this->mAlbums->GetAlbum($aid, !IS_USER ? $this->filts : array());
        $pi = $this->mAlbums->GetPhoto($aid, $pid);
        $ti = $this->mAlbums->GetTags(UID_OTHER, $pid);


        $this ->checkGP($ai);

        if ($ai && $pi)
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

            if ($pi['aid'] != $ai['aid'])
            {
                //error album ID
                uni_redirect(PATH_ROOT . 'id' . $uid_alb . '/albums/id' . $ai['aid']);
            }

            $this->mAlbums->UpdViewed($pid, $aid);

            $nimg = $this->mAlbums->GetNPImg($aid, $pid, 2, 'id DESC');
            $pimg = $this->mAlbums->GetNPImg($aid, $pid, 1, 'id ASC');
            $this->mSmarty->assign_by_ref('nimg', $nimg);
            $this->mSmarty->assign_by_ref('pimg', $pimg);

            /* Get List of the User's Albums */
            $al = $this->mAlbums->GetUAlbums($uid_alb, 1);
            foreach ($al as $k => $r)
            {
                if ($aid == $r['aid'])
                    unset($al[$k]);
            }
            $this->mSmarty->assign_by_ref('al', $al);

            /* Comments */
            $pcnt = 4;
            $fcnt = 0;

            $what = array('*');
            $wpar = array('ic.iid');
            $wval = array($pid);
            $ar_img_com = $this->mAlbums->GetAlbImgCom($what, $wpar, $wval, $fcnt, $pcnt, 'id DESC');
            $cnt_img_com = $this->mAlbums->GetCntImgCom($pid);

            $this->mSmarty->assign_by_ref('fcnt', $fcnt);
            $this->mSmarty->assign_by_ref('ncnt', $ncnt);
            $this->mSmarty->assign_by_ref('pcnt', $pcnt);
            $this->mSmarty->assign_by_ref('ar_img_com', $ar_img_com);
            $this->mSmarty->assign_by_ref('cnt_img_com', $cnt_img_com);

            $this->mSmarty->assign_by_ref('pi', $pi);
            $this->mSmarty->assign_by_ref('ai', $ai);
            $this->mSmarty->assign_by_ref('ti', $ti);
            $this->mSmarty->assign('m_page', 'albums_photo');

            $this->mSmarty->assign('HIDE_LC', 1); //hide LEFT COLUMN
            $this->mSmarty->assign('_content', $this->mSmarty->fetch('mods/albums/_photo.html'));
        }
        else
            uni_redirect(PATH_ROOT . 'id' . UID_OTHER . '/albums');
    }


    public function Edit()
    {
        $ai = _v('AI');
        if (!empty($ai))
        {
            if (!empty($ai['name']))
            {
                $ai_k = array();
                $ai_r = array();
                $aid = -1;
                foreach ($ai as $k => $r)
                {
                    if ('id' != $k && 'ptype' != $k)
                    {
                        $ai_chk[$k] = base_chk($r);
                    }
                    $ai[$k] = base_chk($r);
                }

                if (!empty($ai_chk))
                {
                    $lid = $this->mAlbums->EditAlbum($ai_chk, $aid, UID);
                    if ($lid)
                    {
                        $this->mAlbums->EditPrivacy(UID, $ai['ptype'], $lid, $this->filts[$ai['ptype']]);
                        $this->mSmarty->assign_by_ref('alb_i', $this->mAlbums->GetAlbum($lid));
                    }
                    $this->mSmarty->display('mods/albums/_album_one.html');
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


    //-- Delete Album through Ajax
    public function DelAjax()
    {
        $aid = (int) _v('aid');

        $album = $this -> mAlbums -> GetAlbum($aid);
        $uido = !empty($album['uid']) ? $album['uid'] : 0;
        $is_user = (defined('UID') && ($uido == UID) ? true : false);

        if (defined('UID') && !empty($aid) && $is_user)
            $this->mAlbums->Del($aid, UID);
        else
            die('not_success');
        exit();
    }


    public function UplPhotos()
    {
        $pi = _v('PI');
        if ($pi)
        {
            $pi_img = array();
            foreach ($pi as $k => $r)
            {
                if (is_array($r))
                {
                    for ($i = 0; $i <= count($r); $i++)
                    {
                        if (isset($r[$i]))
                            $pi_img[] = $r[$i];
                    }
                }
            }
            unset($pi['p_img']);

            foreach ($pi as $k => $r)
            {
                $pi_chk[base_chk($k)] = base_chk($r);
            }

            $lid = array();
            foreach ($pi_img as $k => $r)
            {
                $wpar = array('aid', 'img', 'descr', 'fpath');
                $wval = array($pi['aid'], Txt2Charset($r), $pi['descr'], GetPostfix(UID));

                $lid[] = $this->mAlbums->UpdImg($wpar, $wval);
            }

            if (!empty($lid))
            {
                $pl = $this->mAlbums->GetPhotos($pi['aid']);
                $atype = 'album';
                $ai = $this->mAlbums->GetAlbum($pi['aid']);
                $this->mSmarty->display('mods/albums/_photos.html');
            }
            else
                echo 'not_success';
        }
        exit();
    }


    //--Change Albums through Ajax
    public function ChngAlbums()
    {
        $pid = (int) _v('pid');
        $aid = (int) _v('aid');

        if ($pid && $aid)
        {
            $album = $this->mAlbums->GetAlbum($aid);
            $old_album = $this->mAlbums ->GetAlbumByPhoto($pid, UID);

            if (UID == $album['uid'] && UID == $old_album['uid'])
            {
                if (2 != $album['type'] && 2 != $old_album['type'])
                {
                    $this->mAlbums->ChngAlbum($pid, $aid);
                }
                elseif (2 != $album['type'] && 2 == $old_album['type'])
                { #из системного в обычный
                    $photo = $this -> mAlbums ->GetPhoto($old_album['aid'], $pid);
                    if ($photo)
                    {

                        $fname = $photo['img'];
                        $oan = ToLower($old_album['name']); #old album name
                        switch ($oan)
                        {
                            case 'journal':
                            case 'wall':
                            case 'inbox':
                                $old_path = BPATH . 'files/images/' . $oan . '/' . $photo['fpath'];
                                break;

                            case 'mission':
                                $old_path = BPATH . 'files/images/mission/wall/' . $photo['fpath'];
                                break;

                            case 'ward':
                                $old_path = BPATH . 'files/images/wards/wall/' . $photo['fpath'];
                                break;

                            default :
                                return false;
                                break;
                        }

                        $new_path = BPATH . 'files/images/albums/' . $photo['fpath'];

                        if ($fname && file_exists($old_path . '/' . $fname) && !file_exists($new_path . '/' . $fname))
                            copy($old_path . '/' . $fname, $new_path . '/' . $fname);

                        if ($fname && file_exists($old_path . '/a/a_' . $fname) && !file_exists($new_path . '/a/a_' . $fname))
                            copy($old_path . '/a/a_' . $fname, $new_path . '/a/a_' . $fname);

                        if ($fname && file_exists($old_path . '/m/m_' . $fname) && !file_exists($new_path . '/m/m_' . $fname))
                            copy($old_path . '/m/m_' . $fname, $new_path . '/m/m_' . $fname);

                        if ($fname && file_exists($old_path . '/n/n_' . $fname) && !file_exists($new_path . '/n/n_' . $fname))
                            copy($old_path . '/n/n_' . $fname, $new_path . '/n/n_' . $fname);

                        if ($fname && file_exists($old_path . '/s/s_' . $fname) && !file_exists($new_path . '/s/s_' . $fname))
                            copy($old_path . '/s/s_' . $fname, $new_path . '/s/s_' . $fname);


                        $this->mAlbums->UpdImg(array('aid', 'img', 'fpath', 'descr'),
                            array($album['aid'], $fname, $photo['fpath'], $photo['descr']));
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
            exit();
        }
    }


    //---- Ajax Methods
    public function GetEditPhotoAjax()
    { //get & edit current image info
        $aid = (int) _v('aid');
        $pid = (int) _v('pid');

        $album = $this ->mAlbums ->GetAlbum($aid);
        $uido = !empty($album['uid']) ? $album['uid'] : 0;
        $is_user = ($uido == UID ? true : false);
        $this -> mSmarty -> assign('IS_USER', $is_user);

        if ($pid && $aid && $uido)
        {

            $this ->checkGP($album, true);

            $ci = _v('CI');

            if ($ci)
            {
                if (!empty($ci['text']))
                {
                    $wpar = array('user_id', 'iid');
                    $wval = array(UID, $pid);
                    foreach ($ci as $k => $r)
                    {
                        $wpar[] = $k;
                        $wval[] = base_chk($r);
                    }
                    $wpar[] = 'aid';
                    $wval[] = $aid;

                    $whpar = array();
                    $whval = array();
                    $id_com = (int) _v('id_com');
                    if (!empty($id_com))
                    {
                        $whpar[] = 'id';
                        $whval[] = $id_com;
                    }
                    $lid = $this->mAlbums->EditImgCom($wpar, $wval, $whpar, $whval);
                    if ($lid)
                    {
                        //--send a notification
                        $ntype = 1;
                        isset($ci['text']) ? $n_ad_info = $ci['text'] : $_nad_info = '';
                        $n_ad_link = '/id' . $uido . '/albums/id' . $aid . '/id' . $pid;
                        $n_ad_link_txt = $this->moUser->mUi['first_name'] . ' ' . $this->moUser->mUi['last_name'];

                        if (1 == $this->moUser->mUi['notify_photo'] && !$is_user)
                            $s_notify = $this->mlObj['notify']->UpdUNotify($ntype, 3, $n_ad_info, $n_ad_link, $n_ad_link_txt);
                        if (!$is_user)
                        {
                            //notification
                            $this -> mlObj['notify'] -> AddENentry(UID, $uido, 5, array('aid' => $aid, 'pid' => $pid, 'msg' => $n_ad_info));
                        }
                    }
                }
            }

            /* Get List of the User's Albums */
            $al = $this->mAlbums->GetUAlbums($uido, 1);
            $this->mSmarty->assign_by_ref('al', $al);

            //album & photo info
            $ai = $this->mAlbums->GetAlbum($aid);
            $pi = $this->mAlbums->GetPhoto($aid, $pid);
            $ti = $this->mAlbums->GetTags($uido, $pid);
            $this->mSmarty->assign_by_ref('ai', $ai);

            $this->mSmarty->assign_by_ref('pi', $pi);
            $this->mSmarty->assign_by_ref('ti', $ti);

            $rtype = _v('rtype');
            if ('all' == $rtype)
            {
                //additional photo info (navigation etc.)
                $nimg = $this->mAlbums->GetNPImg($aid, $pid, 2, 'id DESC');
                $pimg = $this->mAlbums->GetNPImg($aid, $pid, 1, 'id ASC');
                $this->mSmarty->assign_by_ref('nimg', $nimg);
                $this->mSmarty->assign_by_ref('pimg', $pimg);
            }

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

                if (!$fcnt || $fcnt < 0)
                    $fcnt = 0;

                $what = array('*');
                $wpar = array('ic.iid');
                $wval = array($pid);
                $ar_img_com = $this->mAlbums->GetAlbImgCom($what, $wpar, $wval, $fcnt, $pcnt, 'id DESC');
                $cnt_img_com = $this->mAlbums->GetCntImgCom($pid);

                $this->mSmarty->assign_by_ref('fcnt', $fcnt);
                $this->mSmarty->assign_by_ref('ncnt', $ncnt);
                $this->mSmarty->assign_by_ref('pcnt', $pcnt);
                $this->mSmarty->assign_by_ref('ar_img_com', $ar_img_com);
                $this->mSmarty->assign_by_ref('cnt_img_com', $cnt_img_com);
            }

            if ('all' == $rtype)
            {
                $r = array();
                $r[0] = $pimg;
                $r[1] = $nimg;
                $r[2] = $this->mSmarty->fetch('mods/albums/_photo_one.html');
                $r[3] = $this->mSmarty->fetch('mods/albums/_photo_right_one.html');
                $r[4] = $this -> mSmarty -> fetch('mods/_popups/_album_photo_share.html');
                echo Ar2Json($r);
            } else if ('com' == $rtype)
            {
                $this->mSmarty->display('mods/albums/_photo_com_list.html');
            }
            exit();
        }
        else
            echo 'not_sucess';
        exit();
    }


    public function DelPhotoAjax()
    {
        $aid = _v('aid');
        $pid = _v('pid');

        $album = $this -> mAlbums -> GetAlbum($aid);
        $uido = !empty($album['uid']) ? $album['uid'] : 0;
        $is_user = (defined('UID') && ($uido == UID) ? true : false);

        if ($aid && $pid && $is_user)
        {
            $photo = $this->mAlbums->GetPhoto($aid, $pid);
            if (!empty($photo) && isset($photo['atype']))
                $this->mAlbums->DelPhoto($aid, $pid);
            else
                echo 'not_success';
        }
        else
            echo 'not_success';
        exit();
    }


    //---- Additional Methods

    /* mod by eugene */
    public function ChkUplPhoto()
    {

        $errs = array();

        include_once 'Ctrl/Ajax/Json.php';
        $mJson = new Services_JSON();

        $aid = (int) $_POST['aid'];
        $crand = mktime() . rand(100, 999);
        $descr = !empty($_POST['descr']) ? trim(htmlspecialchars(strip_tags($_POST['descr']))) : '';

        $album = $this -> mAlbums -> GetAlbum($aid);
        if ($album['uid'] != UID)
        {
            $errs[] = $this -> mSmarty -> get_config_vars('alb_err1'); //'This is not your album!';
        }
        elseif (!empty($_FILES['Filedata']['tmp_name']) && $_POST['aid'] && UID)
        {
            if (!is_uploaded_file($_FILES['Filedata']['tmp_name']))
                $errs[] = $this -> mSmarty -> get_config_vars('alb_err2'); //'File is already uploaded';
            else
            {
                if (10240000 < $_FILES['Filedata']['size'] || 1 > $_FILES['Filedata']['size'])
                    $errs[] = $this -> mSmarty -> get_config_vars('alb_err3'); //'File has an incorrect size';
                else
                {
                    $ext = get_img_ext($_FILES['Filedata']['tmp_name']);


                    if (false === $ext)
                        $errs[] = $this -> mSmarty -> get_config_vars('alb_err4'); //'Incorrect extension';
                    elseif (empty($errs))
                    {
                        $tempFile = $_FILES['Filedata']['tmp_name'];
                        $targetPath = $this->fpath . GetPostfix(UID) . '/';

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


                        //$targetFile = UID.'_alb_'.$aid.'_'.date('dmYHi').'_'.$crand.'_'.$_FILES['Filedata']['name'];
                        $targetFile = UID . '_alb_' . $aid . '_' . $crand . '_' . Txt2Charset($_FILES['Filedata']['name']);
                        i_crop_copy(658, 439, $_FILES['Filedata']['tmp_name'], $targetPath . 'n/n_' . $targetFile, 2);
                        $src = $targetPath . 'n/n_' . $targetFile;

                        i_crop_copy(324, 217, $src, $targetPath . 'a/a_' . $targetFile, 2);
                        i_crop_copy(69, 69, $src, $targetPath . 'm/m_' . $targetFile, 1);
                        i_crop_copy(49, 49, $src, $targetPath . 's/s_' . $targetFile, 1);


                        $exif = exif_read_data($_FILES['Filedata']['tmp_name']);
                        //file_put_contents(BPATH . '1.txt', print_r($exif, true));
                        if (!empty($exif['DateTimeDigitized']))
                        {
                            if (preg_match('|^\d{4}:\d{2}:\d{2}\s\d{2}:\d{2}:\d{2}$|i', $exif['DateTimeDigitized']))
                                $shot = str_replace(':', '-', $exif['DateTimeDigitized']);
                            else
                                $shot = 0;
                        }
                        else
                            $shot = 0;

                        $wpar = array('aid', 'img', 'descr', 'fpath', 'shot');
                        $wval = array($aid, $targetFile, $descr, GetPostfix(UID), $shot);
                        $this -> mAlbums -> UpdImg($wpar, $wval /*, $whpar, $whval */);

                        echo $mJson->encode(array('status' => 'ok'));
                        exit();
                        //return true;
                    }
                }
            }
        }
        echo $mJson->encode(array('status' => 'err', 'errs' => $errs));
        exit();
    }


    public function Index()
    {
        $this->GetList();
    }


    /* Tags page  */

    public function Tags()
    {
        // Get List of the User's Albums
        $this->mSmarty->assign_by_ref('other_alb', $this->mAlbums->GetRandomUAlbums(UID_OTHER, !IS_USER ? $this->filts : array()));

        $al = $this->mAlbums->GetUAlbums(UID_OTHER, 1, 1, -1, -1, !IS_USER ? $this->filts : array());
        $allowed_alb = array();

        if (UID != UID_OTHER)
        {
            foreach ($al as $a)
            {
                $allowed_alb[] = $a['aid'];
            }
        }

        $this->mSmarty->assign_by_ref('al', $al);

        // Get list of user Tags
        $ti = $this->mAlbums->GetTags(UID_OTHER, 0, false, '', 0, 15);
        $this->mSmarty->assign('ti', $ti);

        // Tagged photos
        $pl = array();
        $tag = strtolower(strip_tags(_v('tag')));
        if ('' != $tag)
        {
            $page = _v('page', 1);
            include_once 'View/Acc/Pagging.php';
            $pcnt = $this -> pcnt;
            $rcnt = $this -> mAlbums -> GetPhotosCount(-1, UID_OTHER, -1, -1, -1, $tag, $allowed_alb);
            $mpage = new Pagging($pcnt, $rcnt, $page);

            $this -> mSmarty -> assign('rcnt', $rcnt);
            $range =& $mpage -> GetRange();
            $this -> mSmarty -> assign('plist_c', $range[1] - $range[0]);
            $this -> mSmarty -> assign('pagging', $mpage   -> Make($this -> mSmarty));
            $pl = $this->mAlbums->GetPhotos(-1, UID_OTHER, $range[0], $pcnt, -1, $tag, $allowed_alb);

            $this->mSmarty->assign_by_ref('pl', $pl);
            $this->mSmarty->assign_by_ref('cnt_pl', count($pl));
            $this->mSmarty->assign_by_ref('cnt_hpl', ceil(count($pl) / 2));

            $this->mSmarty->assign('m_page', 'albums_photos');
            $this->mSmarty->assign('tag', $tag);
            $this->mSmarty->assign('taglist', 1);
            $this->mSmarty->assign('_content', $this->mSmarty->fetch('mods/albums/_photos.html'));
        }
        else
            uni_redirect(PATH_ROOT . 'id' . UID_OTHER . '/albums');
    }


    /* Tags Ajax */
    public function SearchTagAjax()
    {
        $q = preg_replace('|[^a-z0-9\s]|i', '', _v('q'));
        if ('' != $q)
        {
            $tags = $this -> mAlbums -> GetTags(UID, 0, false, $q);
            if (count($tags) > 0)
            {
                foreach ($tags as $tag)
                {
                    echo $tag['name'] . "\n";
                }
            }
        }
        n_exit();
    }


    public function AddTagAjax()
    {
        $name = _v('name', '');
        if ('' != $name)
        {
            $gtid = $this -> mAlbums ->CheckTagExist(UID, $name);

            if (!$gtid)
            {
                $gtid = $this -> mAlbums -> AddTag(UID, $name);
            }

            echo $gtid;
        }
        else
        {
            echo 'not_success';
        }
        n_exit();
    }


    public function AddTagToPhotoAjax()
    {
        $pid = _v('pid', 0);
        $name = _v('name', '');
        $name = preg_replace('|[^a-z0-9\s]|i', '', $name);

        if ($pid && '' != $name)
        {
            $id = $this -> mAlbums -> AddTagToPhoto(UID, $pid, $name);
            if ($id)
            {
                $this -> mSmarty -> assign('ti', array(array('id' => $id, 'name' => $name)));
                $this -> mSmarty -> assign('pi', array('id' => $pid));
                echo $this -> mSmarty -> fetch('mods/_ajax/tag_list.html');
                n_exit();
            }
        }
        echo 'not_success';
        n_exit();
    }


    public function DelTagAjax()
    {
        $gtid = _v('gtid', 0);
        if ($gtid)
        {
            $this -> mAlbums -> DelTag(UID, $gtid);

            echo 1;
        }
        else
        {
            echo 'not_success';
        }
        n_exit();
    }


    public function DelTagFromPhotoAjax()
    {
        $pid = _v('pid', 0);
        $gtid = _v('gtid', 0);
        if ($pid && $gtid)
        {
            $this -> mAlbums -> DelTagFromPhoto(UID, $gtid, $pid);

            echo 1;
        }
        else
        {
            echo 'not_success';
        }
        n_exit();
    }
}

?>