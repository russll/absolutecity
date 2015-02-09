<?php

/**
 * Mission Base controller
 * @package    5dev Catalog
 * @version    1.0
 * @since      1.03.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */
class Ctrl_Base_Mission extends Ctrl_Base
{

    private $mMission;
    private $initErrs;

    public function __construct(&$glObj)
    {
        parent :: __construct($glObj);

        if (!defined('UID'))
            uni_redirect(PATH_ROOT . '');

        include_once 'Model/Base/Mission.class.php';
        $this->mMission = new Model_Base_Mission($glObj['gDb']);

        $this->_Init();

        //init Mission's Wall info
        if (isset($this->mission_id))
        {
            include_once 'Model/Mission/Wall.class.php';
            $this->moWall = new Model_Mission_Wall($glObj['gDb']);
        }
        $this->mSmarty->assign('m_page', 'mission_list');

        $this->initErrs = array();

        $this->fpath = DIR_WS_IMAGE . 'mission/info/president/';
        $this->fpath_tmp = DIR_WS_IMAGE . 'mission/info/_temp/president/';
    }


    public function _Init()
    {
        $id = (int) _v('id');

        if ($id)
        {
            $mission = $this->mMission->Get($id);
            if (empty($mission))
            {
                $this->initErrs[] = $this -> mSmarty -> get_config_vars('mission_dnt_exist');//'Mission doesn\'t exist';
                uni_redirect(PATH_ROOT . 'id' . $this->moUser->mUinfo['uid']);
            }

            $my_mis = $this->mMission->GetUMission($id, UID);

            if (!defined('CAN_EDIT'))
            {
                if ($my_mis)
                {
                    define('CAN_EDIT', 1);
                } else
                {
                    define('CAN_EDIT', 0);
                }
            }

            $mis_rel['im_suscr_fr'] = $this->mMission->ChckSubscr(UID, $id);
            $this->mSmarty->assign('mis_rel', $mis_rel);
            $this->umission_id = $my_mis['id'];
            $this->mission_id = $mission['id'];

            $this->mSmarty->assign('CAN_EDIT', CAN_EDIT);
        }
    }


    //-- Get List of the Missions
    public function GetList()
    {
        $dd = array();
        for ($i = 1; $i <= 31; $i++)
        {
            $dd[] = $i;
        }
        $mm = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
        $yy = array();
        for ($i = date("Y"); $i >= date("Y") - 99; $i--)
        {
            $yy[] = $i;
        }

        $this->mSmarty->assign_by_ref('mm', $mm);
        $this->mSmarty->assign_by_ref('dd', $dd);
        $this->mSmarty->assign_by_ref('yy', $yy);

        //-- pagging
        $pcnt = 0;
        $rcnt = 7;

        $cnt_missions = $this->mMission->GetCntUList(UID_OTHER, 'title');
        $ml = $this->mMission->GetUList(UID_OTHER, $pcnt, $rcnt, 'title');

		$watched = $this -> mMission -> GetSubscr(UID_OTHER);
		if (count($watched) > 0)  {
			$this -> mSmarty -> assign_by_ref('wtl', $watched);
			$this -> mSmarty -> assign('whatch_list', 1);
		}


        $this->mSmarty->assign('myMissPage', (UID == UID_OTHER));
        $this->mSmarty->assign_by_ref('pcnt', $pcnt);
        $this->mSmarty->assign_by_ref('rcnt', $rcnt);
        $this->mSmarty->assign_by_ref('cnt_missions', $cnt_missions);

        $this->mSmarty->assign_by_ref('ml', $ml);
        $this->mSmarty->assign('_content', $this->mSmarty->fetch('mods/mission/_list.html'));
    }



    //--Change Mission through Ajax
    public function ChngMission()
    {
        $id = (int) _v('id');

        $fy = _v('mfy', 0);
        $fm = _v('mfm', 0);
        $fd = _v('mfd', 0);
        $ty = _v('mty', 0);
        $tm = _v('mtm', 0);
        $td = _v('mtd', 0);

        if (!checkdate($fm, $fd, $fy) || !checkdate($tm, $td, $ty))
        {
            uni_redirect(PATH_ROOT . '');
        } else
        {
            $fdate = $fy . '-' . $fm . '-' . $fd;
            $tdate = $ty . '-' . $tm . '-' . $td;
        }

        $this->_Init();

        if (empty($this->initErrs))
        {
            $wl = $this->mMission->ChngUMission(UID, $id, $fdate, $tdate);
            uni_redirect(PATH_ROOT . 'mission/id' . $id);
        } else
        {
            uni_redirect(PATH_ROOT . '');
        }
    }


    public function Index()
    {
        $this->GetList();
    }


    public function Indexadmin()
    {
        if (!defined('IT_ADMIN'))
        {
            exit();
        }

        $page = _v('page', 1);
        include_once 'View/Acc/Pagging.php';
        $pcnt = 20;
        $rcnt = $this->mMission->GetCount();
        $mpage = new Pagging($pcnt,
                        $rcnt,
                        $page,
                        PATH_ROOT_ADM . 'base/mission/');
        $this->mSmarty->assign('rcnt', $rcnt);
        $range = & $mpage->GetRange();
        $this->mSmarty->assign('plist_c', $range[1] - $range[0]);
        $list = & $this->mMission->GetList($range[0], $pcnt, 'm.country, m.city, m.title');
        $this->mSmarty->assign_by_ref('pl', $list);
        $this->mSmarty->assign('pagging', $mpage->Make($this->mSmarty));

        $this->mSmarty->assign('_content', $this->mSmarty->Fetch('mods/mission/_list.html'));
    }

    
    public function Edit()
    {
        if (!defined('IT_ADMIN'))
        {
            exit();
        }

        $id = _v('id', 0);

        if ($id)
        {
            $fx = $this->mMission->Get($id);
            if (empty($fx))
            {
                $id = 0;
            }
            $this->mSmarty->assign('id', $id);
        }

        if (!empty($_POST['fm']))
        {
            $fm = $_POST['fm'];
            $errs = array();

            if (empty($fm['title']))
            {
                $errs[] = $this -> mSmarty -> get_config_vars('misssion_err_t');//'Please specify mission title';
            }
            if (empty($fm['location']))
            {
                $errs[] = $this -> mSmarty -> get_config_vars('misssion_err_l');//'Please specify mission location';
            } else
            {
                $cc = explode(', ', $fm['location']);

                if (3 == count($cc))
                {
                    $cc = $this->mlObj['geo']->CheckCity(trim($cc[0]), trim($cc[2]), trim($cc[1]));
                } elseif (2 == count($cc))
                {
                    $cc = $this->mlObj['geo']->CheckCity(trim($cc[0]), trim($cc[1]));
                }
                elseif (1 == count($cc))
                {
                    $cc = $this->mlObj['geo']->CheckCity($cc[0]);
                }
                if (empty($cc))
                {
                    $errs[] = $this -> mSmarty -> get_config_vars('misssion_err_ld');//'Location not found';
                }
                elseif (1 < count($cc))
                {
                    $errs[] = $this -> mSmarty -> get_config_vars('misssion_err_cd');//'Found more than one city';
                }
            }

            if (empty($errs))
            {
                $mid = $this->mMission->Edit($fm['title'], $cc[0]['name'],
                                !empty($cc[0]['country_name']) ? $cc[0]['country_name'] : '',
                                !empty($cc[0]['region_name']) ? $cc[0]['region_name'] : '',
                                $id ? $id : 0
                );
                uni_redirect(PATH_ROOT_ADM . 'base/mission/');
            }
            $this->mSmarty->assign_by_ref('errs', $errs);
            $this->mSmarty->assign_by_ref('fm', $fm);
        }
        elseif (!empty($fx))
        {
            $this->mSmarty->assign_by_ref('fm', $fx);
        }

        $this->mSmarty->assign_by_ref('mission', $this->mMission->GetList());
        $this->mSmarty->assign('_content', $this->mSmarty->Fetch('mods/mission/_edit.html'));
    }


    public function EditPresident()
    {
        $AI = _v('AI');
        if ($AI && defined('CAN_EDIT'))
        {
            $errs = array();
            $ar_k = array();
            $ar_r = array();
            foreach ($AI as $k => $r)
            {
                $AI[base_chk($k)] = base_chk($r);
                $ar_k[] = base_chk($k);
                $ar_r[] = base_chk($r);
            }

            if (!$AI['first_name'] && !!$AI['last_name'])
                $errs[] = $this -> mSmarty -> get_config_vars('misssion_err_ep1');//'Some fields were left blank';

            if (!$this->mMission->GetUMission($this->mission_id, UID))
                $errs[] = $this -> mSmarty -> get_config_vars('misssion_err_ep2');//'You don\'t have access';

            $img = '';
            $old_inf = $this->mMission->GetUMission((int) $_POST['mission_id'], UID);

            if (!empty($old_inf))
                $img = !empty($old_inf['pr_p_img']) ? $old_inf['pr_p_img'] : '';

            $fname = !empty($_POST['president_p_img']) ? trim(strip_tags($_POST['president_p_img'])) : '';
            if ($fname && file_exists($this->fpath_tmp . $fname) && in_array(get_img_ext($this->fpath_tmp . $fname), array('jpg', 'png', 'gif')))
            {
                $tfolder = $this->fpath_tmp; //temp folder
                $folder = $this->fpath; //necessary folder
                if (copy($tfolder . $fname, $folder . $fname)) //after copying do unlink
                {
                    unlink($tfolder . $fname);
                    $img = $fname;
                }
                else
                    $errs[] = $this -> mSmarty -> get_config_vars('misssion_err_ep3');//'File could not be copied';
            }

            if (!$errs)
            {
                $ar_k = array_merge($ar_k, array('mid', 'umid', 'p_img'));
                $ar_r = array_merge($ar_r, array($this->mission_id, $this->umission_id, $img));

                $lid = $this->mMission->EditUMisPresident($ar_k, $ar_r);
                uni_redirect(PATH_ROOT . 'id' . UID . '/mission/id' . $this->mission_id);
            } else
            {
                //deb($errs);
            }
        }
        uni_redirect(PATH_ROOT . '');
    }



    public function Del()
    {
        if (!defined('IT_ADMIN'))
        {
            exit();
        }
        $id = _v('id', 0);
        if ($id)
        {
            $this->mMission->Del($id);
        }
        uni_redirect(PATH_ROOT_ADM . 'base/mission/');
    }



    public function AjaxMissions()
    {
        $q = ToLower(mysql_escape_string(strip_tags(_v('q'))));
        $stake = _v('stake', 0);
        if (0 < strpos($q, ','))
        {
            $q = substr($q, 0, strpos($q, ','));
        }
        if (1 < strlen($q))
        {
            $res = $this->mMission->SearchMission($q, $stake ? 2 : 1);
            foreach ($res as $k => &$v)
            {
                $out = $k . '|' . $v['title'];
                echo $out . "\n";
            }
        }
        n_exit();
    }



    public function EditUMisAjax()
    {
        $fm = _v('fm');
        $mission_id = (int) _v('id');

        if (defined('UID') && $fm && defined('CAN_EDIT'))
        {
            $ar_k = array();
            $ar_v = array();

            $ltype = 1;
            $story = '';
            foreach ($fm as $k => $r)
            {
                if ('loc_best_place' == $k)
                    $ltype = 1;
                else if ('loc_food_like' == $k)
                    $ltype = 2;
                else if ('loc_food_dislike' == $k)
                    $ltype = 3;
                else if ('loc_will_miss' == $k)
                    $ltype = 4;
                else if ('loc_temp_language' == $k)
                    $ltype = 5;
                else
                    die('not_success');
                $story = $r;
            }

            $umis = $this->mMission->GetUMission($mission_id, UID);
            if ($umis)
            {
                foreach ($fm as $k => $r)
                {
                    $ar_k[] = base_chk($k);
                    $ar_v[] = base_chk($r);
                }
                $this->mMission->EditUMisInfo($umis['id'], $ar_k, $ar_v);
                $this->moWall->EditLocalMes($mission_id, UID, $ltype, $story);
            }
            else
                echo 'not_success';
        }
        else
            echo 'not_success';
        exit();
    }


    public function DoSubscrAjax()
    {
        $act = (int) _v('act');
        $mission_id = (int) _v('id');
        if (!empty($act) && !empty($mission_id))
        {
            $this->mMission->EditSubscr(UID, $mission_id, $act);
        } else
        {
            echo 'no_success';
        }
        exit();
    }


    //-- Additional Methods
    public function UplAvatar()
    {
        $ai = _v('AI');
        if (isset($ai['p_img']))
        {
            $umis = $this->mMission->GetUMission(base_chk($ai['mission_id']), UID);
            if ($umis)
            {
                $wpar = array('mission_img');
                $wval = array(base_chk($ai['p_img']));
                $pf = GetPostfix(UID);
                $ml = $this->mMission->EditUMisInfo($umis['id'], $wpar, $wval);

                $a_img = '/' . DIR_NAME_IMAGE . 'mission/info/' . $pf . '/[fld]' . $wval[0]; // a/a_, s/s_
                echo $a_img;
            } else
            {
                echo 'not_success';
            }
        }
        exit();
    }



    /**
     * Check of the uploadinf ward's Avatar
     * 
     * @return uploaded file
     */
    public function ChkUplAvatar()
    {
        $errs = array();

        $mid = 0;

        if (empty($_REQUEST['id']))
            $errs[] = $this -> mSmarty -> get_config_vars('mission_dnt_exist');//'Mission not found';
        else
            $mid = (int) $_REQUEST['id'];



        $ret = array('status' => 'err', 'errs' => &$errs);

        if (!empty($_FILES['ma_Filedata']['tmp_name']) && $mid)
        {
            if (!is_uploaded_file($_FILES['ma_Filedata']['tmp_name']))
                $errs[] = $this -> mSmarty -> get_config_vars('misssion_err_ea1');//'File is already uploaded';
            else
            {
                if (10240000 < $_FILES['ma_Filedata']['size'] || 1 > $_FILES['ma_Filedata']['size'])
                    $errs[] = $this -> mSmarty -> get_config_vars('misssion_err_ea2');//'File has an incorrect size';
                else
                {
                    $fpath = DIR_WS_IMAGE . 'mission/info/';
                    $fpath_tmp = DIR_WS_IMAGE . 'mission/info/_temp/';
                    $ext = get_img_ext($_FILES['ma_Filedata']['tmp_name']);

                    if (false === $ext)
                        $errs[] = $this -> mSmarty -> get_config_vars('misssion_err_ea3');//'Incorrect extension';
                    else
                    {
                        $tempFile = $_FILES['ma_Filedata']['tmp_name'];
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
                        //$aid = (int)$_POST['aid'];
                        $crand = mktime() . rand(100, 999);

                        $targetFile = UID . '_ava_' . $crand . '_' . Txt2Charset($_FILES['ma_Filedata']['name']);
                        $umis = $this->mMission->GetUMission($mid, UID);
                        if ($umis)
                        {
                            i_crop_copy(658, 439, $_FILES['ma_Filedata']['tmp_name'], $targetPath . 'n/n_' . $targetFile, 2);
                            $src = $targetPath . 'n/n_' . $targetFile;
                            i_crop_copy(156, 156, $src, $targetPath . 'a/a_' . $targetFile, 1);
                            i_crop_copy(68, 68, $src, $targetPath . 's/s_' . $targetFile, 1);

                            $this->mMission->EditUMisInfo($umis['id'], array('mission_img'), array($targetFile));
                            $ret['status'] = 'success';
                        }
                    }
                }
            }
        }

        include_once 'Ctrl/Ajax/Json.php';
        $mJson = new Services_JSON();
        echo $mJson->encode($ret);
        exit();
    }


    /**
     * Check of the uploadinf ward's Avatar
     * 
     * @return uploaded file
     */
    public function ChkUplPresidentAvatar()
    {

        $errs = array();
        $ret = array('status' => 'err', 'errs' => &$errs);
        if (!empty($_FILES['Filedata']['tmp_name']))
        {
            if (!is_uploaded_file($_FILES['Filedata']['tmp_name']))
                $errs[] = $this -> mSmarty -> get_config_vars('misssion_err_ea1');//'File is already uploaded';
            else
            {
                if (10240000 < $_FILES['Filedata']['size'] || 1 > $_FILES['Filedata']['size'])
                    $errs[] = $this -> mSmarty -> get_config_vars('misssion_err_ea2');//'File has an incorrect size';
                else
                {
                    $fpath = DIR_WS_IMAGE . 'mission/info/';
                    $fpath_tmp = DIR_WS_IMAGE . 'mission/info/_temp/';
                    $ext = get_img_ext($_FILES['Filedata']['tmp_name']);

                    if (false === $ext)
                        $errs[] = $this -> mSmarty -> get_config_vars('misssion_err_ea3');//'Incorrect extension';
                    else
                    {
                        $tempFile = $_FILES['Filedata']['tmp_name'];
                        $targetPath = $fpath_tmp . 'president';

                        $crand = mktime() . rand(100, 999);

                        $targetFile = UID . '_ava_' . $crand . '_' . Txt2Charset($_FILES['Filedata']['name']);

                        i_crop_copy(100, 100, $_FILES['Filedata']['tmp_name'], $targetPath . '/' . $targetFile, 1);
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