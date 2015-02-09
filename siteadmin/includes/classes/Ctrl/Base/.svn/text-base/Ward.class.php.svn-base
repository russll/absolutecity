<?php
/**
 * Ward's Base controller
 *
 * @package    5dev Wall
 * @version    1.0
 * @since      31.03.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */
class Ctrl_Base_Ward extends Ctrl_Base
{
    private $mWard;
    private $initErrs;

    public function __construct( &$glObj )
    {
        parent :: __construct( $glObj );

        if (!defined('UID'))
            uni_redirect( PATH_ROOT . '' );

        include_once 'Model/Base/Ward.class.php';
        $this -> mWard = new Model_Base_Ward( $glObj['gDb'] );

        $this -> mSmarty -> assign( 'm_page', 'wards_list' );
        $this -> _Init();
        $this -> initErrs = array();

        $this -> fpath = DIR_WS_IMAGE.'wards/info/bishopric/';
        $this -> fpath_tmp = DIR_WS_IMAGE.'wards/info/_temp/bishopric/';
    }/** __construct */


    public function _Init()
    {
        $id = _v('id', 0);
        
        if ($id)
        {
            $ward = $this -> mWard -> Get($id);

            if (empty($ward))
            {
                uni_redirect( PATH_ROOT . 'id'.$this -> moUser -> mUinfo['uid'] );
            }

            $can_edit = 0;

            if ($ward['ward_type'] == 2 && !empty($this -> moUser -> mUinfo['stake_id']) && $ward['id'] == $this -> moUser -> mUinfo['ward_id'])
            {
                /** it's user's ward */
                $can_edit = 1;
            }

            $this -> ward_id  = $id;
            if (!defined('CAN_EDIT'))
            {
                define('CAN_EDIT', $can_edit);
            }

            $this -> mSmarty -> assign('CAN_EDIT', CAN_EDIT);
        }
        else
        {
            $this -> GetList();
        }
    }


    //-- Get List of the Wards
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

        $this -> mSmarty -> assign_by_ref('mm', $mm);
        $this -> mSmarty -> assign_by_ref('dd', $dd);
        $this -> mSmarty -> assign_by_ref('yy', $yy);

        $pcnt = 0;
        $rcnt = 7;
        $this -> mSmarty -> assign('pcnt', $pcnt);
        $this -> mSmarty -> assign('rcnt', $rcnt);

       
        if (!_v('sall'))
        {
            $cnt_wards = $this -> mWard -> GetCntUList( UID_OTHER );

          /*if (!$cnt_wards && $this -> moUser -> mUinfo['uid'] != UID_OTHER)
            {
                uni_redirect( PATH_ROOT . 'id'.UID_OTHER );
            }*/
            $wl = $this -> mWard -> GetUList( UID_OTHER );

			$watched = $this -> mWard -> GetWhatchingList(UID_OTHER);
			if (count($watched) > 0)  {

				$this -> mSmarty -> assign_by_ref('wtl', $watched);
				$this -> mSmarty -> assign('whatch_list', 1);
			}
        }
        else
        {			
            $wl = $this -> mWard -> GetList( -1, -1, $pcnt, $rcnt );
            $cnt_wards = $this -> mWard -> GetCount(  );
        }

        $this -> mSmarty -> assign_by_ref( 'cnt_wards', $cnt_wards );

        $this -> mSmarty -> assign_by_ref( 'wl', $wl );
        $this -> mSmarty -> assign( 'wards_list', 1 );

        $this -> mSmarty -> assign_by_ref('_content', $this -> mSmarty -> fetch('mods/wards/_list.html') );
    }


    //-- Get Whatch List of the Wards
    public function GetWhatchList()
    {
        $wl = $this -> mWard -> GetWhatchingList( UID );

        $this -> mSmarty -> assign_by_ref( 'wl', $wl );
        $this -> mSmarty -> assign( 'whatch_list', 1 );
        $this -> mSmarty -> assign('_content', $this -> mSmarty -> fetch('mods/wards/_list.html') );
    }


    //--Change Ward through
    public function ChngWard()
    {
        $id = (int)_v('id');
        $this -> _Init();

        if (empty($this -> initErrs))
        {
            $ward_i = $this -> mWard -> Get($id);
            $ar_k = array( 'ward_id', 'ward', 'stake_id', 'stake' );

            $stakeId = '';
            $stakeTitle = '';
            if($ward_i['id_parent'])
            {
                $stake_i = $this -> mWard -> Get($ward_i['id_parent']);
                if($stake_i['id'])
                {
					$ar_v = array( $id, $ward_i['title'], $stake_i['id'], $stake_i['title'] );

					$wl = $this -> moUser -> mUser -> EditInfo( UID, $ar_k, $ar_v );
					$this -> mlObj['notify'] -> AddENentry(UID, 0, 3, array('ward_id' => $id));

					uni_redirect( PATH_ROOT . 'id'.UID.'/ward/id'.$id );
                } else
					uni_redirect( $_SERVER['HTTP_REFERER'] );
            } else
				uni_redirect( $_SERVER['HTTP_REFERER'] );
        } else {
            uni_redirect( PATH_ROOT . '' );
        }
        exit();
    }


    public function EditWhatching(  )
    {
        $act = (int)_v('act');
        if (!empty($act))
            $this -> mWard -> EditWhatching( UID, $this -> ward_id, $act );
        else
            echo 'not_success';
        exit();
    }


    public function Index()
    {
        $this -> GetList();
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
        $rcnt = $this -> mWard -> GetCount(-1, -1 );
        $mpage   =   new Pagging($pcnt,
                $rcnt,
                $page,
                PATH_ROOT_ADM . 'base/ward/');
        $this -> mSmarty -> assign('rcnt', $rcnt);
        $range   =& $mpage -> GetRange(  );
        $this -> mSmarty -> assign('plist_c',  $range[1] - $range[0]);
        $list    =& $this -> mWard -> GetList( -1, -1, $range[0], $pcnt );

        $this -> mSmarty -> assign_by_ref('pl', $list);
        $this -> mSmarty -> assign('pagging',  $mpage   -> Make($this -> mSmarty));

        $this -> mSmarty -> assign('_content', $this -> mSmarty -> Fetch('mods/ward/_list.html'));
    }


    //1 - stake; 2 - ward;
    public function Edit()
    {	//deb($_POST);
        if (!defined('IT_ADMIN'))
        {
            exit();
        }

        $id = _v('id', 0);


        if ($id)
        {
            $fx = $this -> mWard -> Get($id);
            if (empty($fx))
            {
                $id = 0;
            }
            $this -> mSmarty -> assign('id', $id);
        }

        if (!empty($_POST['fm']))
        {
            $fm = $_POST['fm'];
            $errs = array();

            if (empty($fm['title']))
            {
                $errs[] = $this -> mSmarty -> get_config_vars('ward_err1');//'Please specify ward title';
            }
            if (empty($fm['location']))
            {
                $errs[] = $this -> mSmarty -> get_config_vars('ward_err2');//'Please specify ward location';
            }
            else
            {
                $cc = explode(', ', $fm['location']);

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
                if (empty($cc))
                {
                    $errs[] = $this -> mSmarty -> get_config_vars('ward_err6');//'Location not found in DB';
                }
                elseif (1 < count($cc))
                {
                    $errs[] = $this -> mSmarty -> get_config_vars('ward_err3');//'Found more than one city';                  
                }
            }

            if (empty($errs))
            {
                if (!isset($fm['id_parent']))
                    $fm['id_parent'] = 0;

                $this -> mWard -> Edit($fm['title'], $fm['ward_type'], $fm['id_parent'], $cc[0]['name'],
                    !empty($cc[0]['country_name']) ? $cc[0]['country_name'] : '',
                    !empty($cc[0]['region_name']) ? $cc[0]['region_name'] : '',
                    $id ? $id : 0,
                    !empty($fm['more']) ? $fm['more'] : ''
                );
                uni_redirect( PATH_ROOT_ADM . 'base/ward/' );
            }
            $this -> mSmarty -> assign_by_ref('errs', $errs);
            $this -> mSmarty -> assign_by_ref('fm', $fm);
        }
        elseif (!empty($fx))
        {
            $this -> mSmarty -> assign_by_ref('fm', $fx);
        }

        $wards = $this -> mWard -> GetList(-1, 1);
        $this -> mSmarty -> assign_by_ref('wards', $wards);
        $this -> mSmarty -> assign('_content', $this -> mSmarty -> Fetch('mods/ward/_edit.html'));
    }


    public function Mod()
    {
        $id = _v('id', 0);
        if (!defined('IT_ADMIN') || !$id)
        {
            die('no pasaran!');
        }

        echo $this -> mWard -> ChangeActive($id);
        die();
    }


    public function Search()
    {
        if (!defined('IT_ADMIN'))
        {
            exit();
        }

        $fm = !empty($_POST['fm']) ? $_POST['fm'] : array();
        $errs = array();

        $surl = _v('sstr', '');
        $stype = _v('stype', '');
        $search_string = !empty($surl) ? trim(strip_tags(htmlspecialchars($surl))) : (!empty($fm['search']) ? trim(strip_tags(htmlspecialchars($fm['search']))) : '');
        $stype = !empty($stype) ? trim(strip_tags(htmlspecialchars($stype))) : (!empty($fm['stype']) ? trim(strip_tags(htmlspecialchars($fm['stype']))) : '');

        /*if (!empty($_POST['fm']) && empty($search_string))
		{
			$errs[] = 'Please specify search string';
		}
		else*/if ($search_string != '' || 1==1) //search all if string is empty

        {
            $page = _v('page', 1);
            include_once 'View/Acc/Pagging.php';
            $pcnt = 20;
            $rcnt = $this -> mWard -> GetSearchCount($search_string, $stype);
            $mpage   =   new Pagging($pcnt, $rcnt, $page, PATH_ROOT_ADM . 'base/ward/search/?sstr='.$search_string.'&stype='.$stype);

            $this -> mSmarty -> assign('rcnt', $rcnt);
            $range   =& $mpage -> GetRange(  );
            $this -> mSmarty -> assign('plist_c',  $range[1] - $range[0]);
            $list    =& $this -> mWard ->SearchWard_v2($search_string, $stype, $range[0], $pcnt );

            if (count($list) == 0)
                $this -> mSmarty -> assign('notfound', true);

            $this -> mSmarty -> assign_by_ref('pl', $list);
            $this -> mSmarty -> assign('pagging',  $mpage   -> Make($this -> mSmarty));
        }

        $fm['search'] = $search_string;
        $fm['stype'] = $stype;

        $this -> mSmarty -> assign_by_ref('errs', $errs);
        $this -> mSmarty -> assign_by_ref('fm', $fm);

        $this -> mSmarty -> assign('_content', $this -> mSmarty -> Fetch('mods/ward/_search.html'));
    }


    public function EditBishopric()
    {

        $AI = _v('AI');
        if ($AI && defined('CAN_EDIT'))
        {
            $errs = array();
            $ar_k = array();
            $ar_r = array();
            foreach ( $AI as $k => $r )
            {
                $AI[base_chk($k)] = base_chk($r);
                $ar_k[] = base_chk($k);
                $ar_r[] = base_chk($r);
            }

            if (!$AI['first_name'] && !!$AI['last_name'] )
                $errs[] = $this -> mSmarty -> get_config_vars('ward_err4');//'Some fields were not entered';

            if (!$this -> mWard -> Get( $this -> ward_id ))
                $errs[] = $this -> mSmarty -> get_config_vars('ward_err7');//'Do not have an access';

            //-- additional representers info
            $ar_req = array('CPI', 'FCI', 'SCI', 'ESI', 'WCI');
            $cnt_ar_req = count($ar_req);
            for ( $j = 0; $j < $cnt_ar_req; $j++ )
            {
                $ADDI = array();
                $ADDI = _v($ar_req[$j]);
                if ($ADDI)
                {
                    $ar_addi_k = array();
                    $ar_addi_r = array();
                    foreach ( $ADDI as $k => $r )
                    {
                        $ar_addi_k[] = base_chk($k);
                        $ar_addi_r[] = base_chk($r);
                    }

                    $ar_k = array_merge($ar_k, $ar_addi_k);
                    $ar_r = array_merge($ar_r, $ar_addi_r);
                }
            }


            $img = '';
            $old_inf = $this ->mWard->GetUBishopric((int) $_REQUEST['id'], UID);
            //deb($old_inf);

            if ($old_inf)
                $img = !empty($old_inf['p_img']) ? $old_inf['p_img'] : '';

            $fname = !empty($_POST['bishop_p_img']) ? trim(strip_tags($_POST['bishop_p_img'])) : '';
            if ($fname && file_exists($this->fpath_tmp . $fname) &&  in_array(get_img_ext($this->fpath_tmp . $fname), array('jpg', 'png', 'gif')))
            {
                $tfolder = $this->fpath_tmp; //temp folder
                $folder = $this->fpath; //necessary folder
                if (copy($tfolder . $fname, $folder . $fname)) //after copying do unlink

                {
                    unlink($tfolder . $fname);
                    $img = $fname;
                }
                else
                    $errs[] = $this -> mSmarty -> get_config_vars('ward_err5');//'File could not be copied';
            }

            if (!$errs)
            {
                $ar_k = array_merge($ar_k, array('wid', 'uid', 'p_img'));
                $ar_r = array_merge($ar_r, array($this -> ward_id, UID, $img));

                $lid = $this -> mWard -> EditUWBishopric( $ar_k, $ar_r );
                uni_redirect( PATH_ROOT . 'id'.UID.'/ward/id'.$this -> ward_id );
            }
        }
        uni_redirect( PATH_ROOT . '' );
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
            $this -> mWard -> Del($id);
        }
        uni_redirect( PATH_ROOT_ADM . 'base/ward/');
    }


    public function AjaxWards()
    {
        $q = ToLower( mysql_escape_string(strip_tags(_v('q'))) );
        $stake = _v('stake', 0);

        $ward_type = _v('ward_type', 0);
        if ($ward_type==2)
        {
            //search by wards
            $stake = 2;
        }

        if (0 < strpos($q, ','))
        {
            $q = substr($q, 0, strpos($q, ','));
        }
        if (1 < strlen($q))
        {
            $res = $this -> mWard -> SearchWard($q, $stake == 1 ? 1 : 2);
            foreach ($res as $k => &$v)
            {
                echo $k.'|'.$v['title'].', '.$v['city'].($v['region'] ? ', '.$v['region'] : '').', '.$v['country']."\n";
            }
        }
        n_exit();
    }


    //-- Additional Methods

    public function UplAvatar()
    {
        return false;
    }


    /**
     * Check of the uploadinf ward's Avatar
     *
     * @return uploaded file
     */
    public function ChkUplAvatar()
    {
        $errs = array();
        $ret = array('status' => 'err', 'errs' => &$errs);
        if (!empty($_FILES['wa_Filedata']['tmp_name']))
        {
            if (!is_uploaded_file($_FILES['wa_Filedata']['tmp_name']))
                $errs[] = $this -> mSmarty -> get_config_vars('file_err1');//'File is already uploaded';
            else
            {
                if (10240000 < $_FILES['wa_Filedata']['size'] || 1 > $_FILES['wa_Filedata']['size'] )
                    $errs[] = $this -> mSmarty -> get_config_vars('file_err2');//'File has an incorrect size';
                else
                {
                    $fpath = DIR_WS_IMAGE.'wards/info/';
                    $fpath_tmp = DIR_WS_IMAGE.'wards/info/_temp/';
                    $ext = get_img_ext($_FILES['wa_Filedata']['tmp_name']);

                    if (false === $ext)
                        $errs[] = $this -> mSmarty -> get_config_vars('file_err3');//'Incorrect extension';
                    else
                    {

                        $tempFile = $_FILES['wa_Filedata']['tmp_name'];
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

                        //$aid = (int)$_POST['aid'];
                        $crand = mktime().rand(100, 999);

                        $targetFile = UID.'_ava_'.$crand.'_'.Txt2Charset($_FILES['wa_Filedata']['name']);


                        i_crop_copy(658, 439, $_FILES['wa_Filedata']['tmp_name'], $targetPath.'n/n_'.$targetFile, 2);
                        $src = $targetPath.'n/n_'.$targetFile;
                        i_crop_copy(156, 156, $src, $targetPath.'a/a_'.$targetFile, 1);
                        i_crop_copy(68, 68, $src, $targetPath.'s/s_'.$targetFile, 1);



                        $wpar = array('ward_stake_img');
                        //$wval = array(base_chk($ai['p_img']));
                        $wval = array($targetFile);
                        $pf = GetPostfix(UID);
                        if (!$this->moUser->mUser->EditInfo(UID, $wpar, $wval))
                        {
                            $ret['status'] = 'not_success';
                        }
                        else
                        {
                            $a_img = '/' . DIR_NAME_IMAGE . 'wards/info/' . $pf . '/[fld]' . $wval[0]; // a/a_, s/s_
                            $ret['status'] = 'ok';
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
     * Check of the uploadinf bishop's Avatar
     *
     * @return uploaded file
     */
    public function ChkUplBishopricAvatar()
    {

        $errs = array();
        $ret = array('status' => 'err', 'errs' => &$errs);
        if (!empty($_FILES['Filedata']['tmp_name']))
        {
            if (!is_uploaded_file($_FILES['Filedata']['tmp_name']))
                $errs[] = $this -> mSmarty -> get_config_vars('file_err1');//'File is already uploaded';
            else
            {
                if (10240000 < $_FILES['Filedata']['size'] || 1 > $_FILES['Filedata']['size'] )
                    $errs[] = $this -> mSmarty -> get_config_vars('file_err2');//'File has an incorrect size';
                else
                {
                    $fpath = DIR_WS_IMAGE.'wards/info/';
                    $fpath_tmp = DIR_WS_IMAGE.'wards/info/_temp/';
                    $ext = get_img_ext($_FILES['Filedata']['tmp_name']);

                    if (false === $ext)
                        $errs[] = $this -> mSmarty -> get_config_vars('file_err3');//'Incorrect extension';
                    else
                    {
                        $tempFile = $_FILES['Filedata']['tmp_name'];
                        $targetPath = $fpath_tmp.'bishopric';

                        $crand = mktime().rand(100, 999);

                        $targetFile = UID.'_ava_'.$crand.'_'.Txt2Charset($_FILES['Filedata']['name']);
                        i_crop_copy(100, 100, $_FILES['Filedata']['tmp_name'], $targetPath.'/'.$targetFile, 1);

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
    
}/** Ctrl_Base_Ward */
?>