<?php

/**
 * Search controller
 *
 * @package    5dev Search
 * @version    1.0
 * @since      1.03.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */
class Ctrl_Base_Search extends Ctrl_Base
{

    //system params
    private $moSearch;
    private $fpath;
    private $fpath_tmp;
    //handle params
    private $cnt_p_upl; //count of the uploading photos

    //-- Initialization Module by Default
    public function Index()
    {
        $this->Show();
    }


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
        {
            uni_redirect(PATH_ROOT . '');
        }
        
        $this->mSmarty->assign('m_page', 'search');
    }


    //---- Main Methods
    public function Show()
    {

        //-- Profile Wall
        require_once 'Model/Profile/Wall.class.php';
        $this->moWall = new Model_Profile_Wall($this -> mlObj['gDb']);

        //-- Wards
        require_once 'Model/Base/Ward.class.php';
        $this->moWard = new Model_Base_Ward($this -> mlObj['gDb']);

        //-- Wards Wall
        require_once 'Model/Wards/Wall.class.php';
        $this->moWardWall = new Model_Wards_Wall($this -> mlObj['gDb']);

        //-- Missions
        require_once 'Model/Base/Mission.class.php';
        $this->moMission = new Model_Base_Mission($this -> mlObj['gDb']);

        //-- Missions Wall
        require_once 'Model/Mission/Wall.class.php';
        $this->moMissionWall = new Model_Mission_Wall($this -> mlObj['gDb']);

        //-- Journal Wall
        require_once 'Model/Journal/Wall.class.php';
        $this->moJournal = new Model_Journal_Wall($this -> mlObj['gDb']);

        
        $errs = array();
        $SI = _v('SI');
        $par_like = '';

        if (!empty($SI))
        {



            if (!empty($SI['btype']) &&
                ( $SI['bfilt'] || isset($SI['static']) || !empty($SI['ftype']['people_mission_location']) || !empty($SI['ftype']['people_ward_name']) || !empty($SI['ftype']['people_stake_name'])
                || (!empty($SI['ftype']['ward_name']) && !empty($SI['ftype']['ward_type']))  ))
            {
                $r = array();
                $ftype_k = array();
                $ftype_r = array();
                $filt = '';

                $btype  = (isset($SI['btype']) && 'All results' != $SI['btype']) ? base_chk0($SI['btype']) : '';
                $nwall  = isset($SI['not_wall']) ? base_chk0($SI['not_wall']) : '';
                $bfilt  = isset($SI['bfilt']) ? base_chk0($SI['bfilt']) : $bfilt = '';
                $ftype  = isset($SI['ftype']) ? $SI['ftype'] : ''; //dinamic filter (willl put automaticly to flitering)
                $static = isset($SI['static']) ? base_chk0($SI['static']) : ''; //static filtering for not Search modules

                if ($ftype)
                {
                    //$ar_no_chck = array( 'age_from', 'age_to', 'interests', 'school_type', 'school_name', 'school_from_month', 'school_from_year', 'school_to_month', 'school_to_year', 'location_country', 'location_city', 'location_street', 'location_zip', 'mission_location', 'mission_from_month', 'mission_from_year', 'mission_to_month', 'mission_to_year' );
                    $ar_chk = array('email', 'first_name', 'last_name', 'gender', 'mob_phone');
                    foreach ($ftype as $k => $r)
                    {
                        $ftype[base_chk($k)] = base_chk($r);

                        if (in_array($k, $ar_chk))
                        {
                            $ftype_k[] = base_chk0($k);
                            $ftype_r[] = base_chk0($r) . '%';
                        }
                        else
                        {
                            $r = base_chk0($r);
                            $k = base_chk0($k);

                            if (!$filt)
                            {
                                $filt = ' 1 ';
                            }

                            //-- Age
                            if ('age_from' == $k && 0 < (int) $r)
                            {
                                $filt .= ' AND (YEAR(dob) > 0 AND ' . $r . ' <= ( YEAR(NOW()) - YEAR(dob) ) ) ';
                            }

                            if ('age_to' == $k && 0 < (int) $r)
                            {
                                $filt .= ' AND (YEAR(dob) > 0 AND ' . $r . ' >= ( YEAR(NOW()) - YEAR(dob) ) ) ';
                            }

                            //-- Interests
                            if ('interests' == $k)
                            {
                                $filt .= ' AND uid in ( SELECT uid FROM inz_users_interest ui WHERE ui.story LIKE "' . $r . '%" ) ';
                            }


                            //-- Education
                            if ('school_type' == $k)
                            {
                                if ('hight' == $r)
                                {
                                    $filt .= ' AND uid in ( SELECT uid FROM inz_users_hschool hs WHERE hs.hschool LIKE "' . base_chk($ftype['school_name']) . '%" ) ';
                                }
                                else if ('university' == $r || 'college' == $r)
                                {
                                    $filt .= ' AND uid in ( SELECT uid FROM inz_users_university hs WHERE hs.university LIKE "' . base_chk($ftype['school_name']) . '%" ) ';
                                }

                                if ('school_from_year' == $k && $r)
                                {
                                    $filt .= ' AND ( ' . $r . ' >= ( YEAR(NOW()) - YEAR(' . ('school_from_year' == $k ? 'hyear' : 'cyear') . ') ) ) ';
                                }

                                if ('school_to_year' == $k && $r)
                                {
                                    $filt .= ' AND ( ' . $r . ' <= ( YEAR(NOW()) - YEAR(' . ('school_from_year' == $k ? 'hyear' : 'cyear') . ') ) ) ';
                                }
                            }

                            //-- Location
                            if (!empty($ftype['location_country']) || !empty($ftype['location_city']))
                            {
                                if ('location_country' == $k && $r)
                                {
                                    $filt .= ' AND country = "' . $r . '" ';
                                }

                                if ('location_city' == $k && $r)
                                {
                                    $filt .= ' AND city LIKE "' . $r . '%" ';
                                }

                                if ('location_street' == $k && $r)
                                {
                                    $filt .= ' AND address LIKE "' . $r . '%" ';
                                }
                                if ('location_zip' == $k && $r)
                                {
                                    $filt .= ' AND zip LIKE "' . $r . '%" ';
                                }
                            }


                            //-- Realationship Status
                            if ('rel_status' == $k && $r)
                            {
                                $filt .= ' AND rel_status = ' . $r;
                            }


                            //-- Mission
                            if (!empty($ftype['mission_location']) || !empty($ftype['mission_from_year']) || !empty($ftype['mission_to_year']))
                            {
                                if ('mission_location' == $k && $r)
                                {
                                    $filt .= "AND (m.title LIKE '%" . $r . "%')";
                                }

                                if ('mission_from_date' == $k && $r)
                                {
                                    $filt .= ' AND ( um2.fdate >= "' . $r . '" ) ';
                                }

                                if ('mission_to_date' == $k && $r)
                                {
                                    $filt .= ' AND ( um2.tdate <= "' . $r . '" ) ';
                                }
                            }


                            //Ward/Stake
                            if (isset($ftype['ward_type']) || isset($ftype['ward_name']))
                            {
                                if ('ward_name' == $k)
                                {
                                    if (!empty($ftype['ward_type']) && $ftype['ward_type'] == 1)
                                    {
                                        $par_like = $r;
                                    }
                                    else
                                    {
                                        $r = mysql_escape_string($r);
                                        $filt .= ' AND (LOWER(w.title) LIKE "%' . ToLower($r) . '%" OR LOWER(w2.title) LIKE "%' . ToLower($r) . '%")';
                                    }
                                }
                            }
                            $filt .= ($btype == 'Stake/Wards') ? ' AND w.ward_type = 2' : '';
                        }
                    }
                }

                if (!$filt)
                {
                    $filt = ' 1 ' . ($nwall && $btype == 'Stake/Wards' ? ' AND w.ward_type = 2 ' : '');
                }


                //-- Pagging
                $PG = _v('PG');
                $pname = isset($PG['pname']) ? base_chk($PG['pname']) : '';
                $pcnt[$pname] = isset($PG['pcnt']) ? $PG['pcnt'] : array();

                if (!empty($PG))
                {
                    $nwall = isset($PG['not_wall']) ? $PG['not_wall'] : 0;
                }

                $ar_pcnt_chck = array('people', 'singles', 'missions', 'wards', 'messages', 'journals');
                $cnt_ar_pcnt_chck = count($ar_pcnt_chck);
                for ($s = 0; $s < $cnt_ar_pcnt_chck; $s++)
                {
                    if (!isset($pcnt[$ar_pcnt_chck[$s]]) || !$pname)
                    {
                        $pcnt[$ar_pcnt_chck[$s]] = 0;
                    }
                    else
                    {
                        $btype = ('wards' == $ar_pcnt_chck[$s]) ? 'Stake/Wards' : ucfirst($ar_pcnt_chck[$s]);
                    }
                }

                $data_rcnt = 20;
                $this->mSmarty->assign_by_ref('pcnt', $pcnt);
                $this->mSmarty->assign_by_ref('pname', $pname);
                $this->mSmarty->assign_by_ref('data_rcnt', $data_rcnt);

                $cnt_all = array();
                $srch_res = array();

                if ($bfilt == 'Find something...')
                {
                    $bfilt = '';
                }


                switch ($btype)
                {
                    case 'All results':
                    default:

                        //People
                        if (!$pname)
                        {
                            $this->mSmarty->assign_by_ref('countries', $GLOBALS['cntrs']);
                            $what = array('uid', 'public_name', 'first_name', 'last_name', 'email', 'status', 'country', 'city', 'address', 'image', 'fpath');

                            $fpar = array();
                            $fval = array();
                            $srch_res['people'] = $this->moUser->mUser->GetListByFilt($what, $fpar, $fval, 2, 1, -1, $pcnt['people'], $data_rcnt, -1, $ftype_k, $ftype_r, $bfilt);
                            $cnt_all['people'] = $this->moUser->mUser->GetCntListByFilt($fpar, $fval, 2, 1, -1, $ftype_k, $ftype_r, $bfilt, -1);

                            // Count common friends
                            include_once 'Model/Base/Friends.class.php';
                            $mFriends = new Model_Base_Friends($this->mDb);
                            for ($i = 0; $i < count($srch_res['people']); $i++)
                            {
                                $srch_res['people'][$i]['mutual'] = $mFriends->GetUserFriendsCount($srch_res['people'][$i]['uid'], array(1, 2, 3), 0, '', (defined('UID') ? UID : 0));
                            }

                            //Messages
                            $what = array('w.*');
                            $fpar = array();
                            $fval = array();

                            $ftype_k_add = array(); //array('w.wuid');
                            $ftype_r_add = array(); //array(UID);

                            $ftype_mes_k = array_merge($ftype_k, $ftype_k_add);
                            $ftype_mes_r = array_merge($ftype_r, $ftype_r_add);

                            $srch_res['messages'] = $this->moWall->GetListByFilt($what, $fpar, $fval, -1, $pcnt['messages'], $data_rcnt, 'fullQuery', $ftype_mes_k, $ftype_mes_r, UID, $bfilt);
                            $cnt_all['messages'] = $this->moWall->GetCntListByFilt($fpar, $fval, 'fullQuery', $ftype_mes_k, $ftype_mes_r, UID, $bfilt);

                            //Journals
                            $what = array('w.*');
                            $fpar = array();
                            $fval = array();

                            //$ftype_jour_k = array_merge($ftype_k, array('w.uid'));
                            //$ftype_jour_r = array_merge($ftype_r, array(UID));

                            $srch_res['journals'] = $this->moJournal->GetListByFilt($what, $fpar, $fval, -1, $pcnt['journals'], $data_rcnt, $ftype_k, $ftype_r, 0, $bfilt);
                            $cnt_all['journals']  = $this->moJournal->GetCntListByFilt($fpar, $fval, $ftype_k, $ftype_r, 0, $bfilt);


                            //Wards/Stake Wall
                            $what = array('w.*');
                            $fpar = array('w.story');
                            $fval = array('%' . mysql_escape_string($bfilt) . '%');

                            $ftype_k_add = array(); //array('w.wuid');
                            $ftype_r_add = array(); //array(UID);

                            $ftype_mes_k = array_merge($ftype_k, $ftype_k_add);
                            $ftype_mes_r = array_merge($ftype_r, $ftype_r_add);

                            $ward_filt = array(
                                0  => 0,
                                1  => 0,
                                2  => $this -> moUser -> mUinfo['ward_id'],
                                3  => $this -> moUser -> mUinfo['stake_id'],
                                4  => 0,
                                10 => $this -> moUser -> mUinfo['priesthood'],
                                11 => $this->moUser->mProfile->GetSchoolClassList(UID, 0, 1)
                            );
                            
                            $srch_res['wards'] = $this->moWardWall->GetListByFilt($what, $fpar, $fval, -1, $pcnt['wards'], $data_rcnt, $ward_filt, $ftype_mes_k, $ftype_mes_r, UID);
                            $cnt_all['wards'] = $this->moWardWall->GetCntListByFilt($fpar, $fval, $ward_filt, $ftype_mes_k, $ftype_mes_r, UID);

                            //Missions
                            $srch_res['missions'] = $this->moMissionWall->GetListByFilt($what, $fpar, $fval, -1, $pcnt['missions'], $data_rcnt, array(), $ftype_mes_k, $ftype_mes_r, UID);
                            $cnt_all['missions'] = $this->moMissionWall->GetCntListByFilt($fpar, $fval, $filt, $ftype_mes_k, $ftype_mes_r, UID);

                            //Singles
                            $what = array('uid', 'public_name', 'first_name', 'last_name', 'email', 'status', 'country', 'city', 'address', 'image', 'fpath', 'live_in');
                            $fpar = array('first_name', 'last_name');
                            $fval = array($bfilt . '%', $bfilt . '%');

                            $filt_stat = 1;
                            if (isset($ftype['rel_status'])) $filt_stat = $ftype['rel_status'];

                            $filt .= ' AND rel_status = '.$filt_stat.' ';

                            $srch_res['singles'] = $this->moUser->mUser->GetListByFilt($what, $fpar, $fval, 2, 1, -1, $pcnt['singles'], $data_rcnt, ($filt ? $filt : -1), $ftype_k, $ftype_r);
                            $cnt_all['singles'] = $this->moUser->mUser->GetCntListByFilt($fpar, $fval, 2, 1, ($filt ? $filt : -1), $ftype_k, $ftype_r);

                        }
                        break;

                    case 'People':

                        $this->mSmarty->assign_by_ref('countries', $GLOBALS['cntrs']);
                        
                        if (!empty($ftype['people_mission_location']) && $ftype['people_mission_location'] != '')
                        {
                            $what = array('m.location', 'u.uid', 'public_name', 'first_name', 'last_name', 'email', 'status', 'country', 'city', 'address', 'image', 'fpath');
                            $fpar = array('first_name', 'last_name');
                            $fval = array($bfilt . '%', $bfilt . '%');

                            $srch_res['people'] = $this->moUser->mUser->GetListByMission($ftype['people_mission_location'], $what, $fpar, $fval, 2, 1, -1, $pcnt['people'], $data_rcnt, ($filt ? $filt : -1), $ftype_k, $ftype_r);
                            $cnt_all['people'] = $this->moUser->mUser->GetCntListByMission($ftype['people_mission_location'], $fpar, $fval, 2, 1, ($filt ? $filt : -1), $ftype_k, $ftype_r);
                        
                        }
                        elseif (!empty($ftype['people_ward_name']) || !empty($ftype['people_stake_name']))
                        {

                            $what = array('u.uid', 'public_name', 'first_name', 'last_name', 'email', 'status', 'country', 'city', 'address', 'image', 'fpath');
                            $fpar = array('first_name', 'last_name');
                            $fval = array($bfilt . '%', $bfilt . '%');

                            $ward = !empty($ftype['people_ward_name']) && 'Enter ward name' != $ftype['people_ward_name'] ? $ftype['people_ward_name'] : '';
                            $stake = !empty($ftype['people_stake_name']) && 'Enter stake name' != $ftype['people_stake_name'] ? $ftype['people_stake_name'] : '';

                            $srch_res['people'] = $this->moUser->mUser->GetListByWard($ward, $stake, $what, $fpar, $fval, 2, 1, -1, $pcnt['people'], $data_rcnt, ($filt ? $filt : -1), $ftype_k, $ftype_r);
                            $cnt_all['people'] = $this->moUser->mUser->GetCntListByWard($ward, $stake, $fpar, $fval, 2, 1, ($filt ? $filt : -1), $ftype_k, $ftype_r);
                        }
                        else
                        {

                            $what = array('uid', 'public_name', 'first_name', 'last_name', 'email', 'status', 'country', 'city', 'address', 'image', 'fpath');
                            $fpar = array('first_name', 'last_name');
                            $fval = array($bfilt . '%', $bfilt . '%');

                            $srch_res['people'] = $this->moUser->mUser->GetListByFilt($what, $fpar, $fval, 2, 1, -1, $pcnt['people'], $data_rcnt, ($filt ? $filt : -1), $ftype_k, $ftype_r);
                            $cnt_all['people'] = $this->moUser->mUser->GetCntListByFilt($fpar, $fval, 2, 1, ($filt ? $filt : -1), $ftype_k, $ftype_r);

                            include_once 'Model/Base/Friends.class.php';
                            $mFriends = new Model_Base_Friends($this->mDb);
                            for ($i = 0; $i < count($srch_res['people']); $i++)
                            {
                                $srch_res['people'][$i]['mutual'] = $mFriends->GetUserFriendsCount($srch_res['people'][$i]['uid'], array(1, 2, 3), 0, '', (defined('UID') ? UID : 0));
                            }
                        }
                        break;

                    case 'Singles':
                        $what = array('uid', 'public_name', 'first_name', 'last_name', 'email', 'status', 'country', 'city', 'address', 'image', 'fpath', 'live_in');
                        $fpar = array('first_name', 'last_name');
                        $fval = array($bfilt . '%', $bfilt . '%');

                        $filt_stat = 1;
                        if (isset($ftype['rel_status'])) $filt_stat = $ftype['rel_status'];

                        //show only singles
                        //$filt .= ' AND rel_status = 1';
                        $filt .= ' AND rel_status = '.$filt_stat.' ';

                        $srch_res['singles'] = $this->moUser->mUser->GetListByFilt($what, $fpar, $fval, 2, 1, -1, $pcnt['singles'], $data_rcnt, ($filt ? $filt : -1), $ftype_k, $ftype_r);
                        $cnt_all['singles'] = $this->moUser->mUser->GetCntListByFilt($fpar, $fval, 2, 1, ($filt ? $filt : -1), $ftype_k, $ftype_r);
                        break;

                    case 'Journals':
                        $what = array('w.*');
                        $fpar = array();
                        $fval = array();
  
                        $srch_res['journals'] = $this->moJournal->GetListByFilt($what, $fpar, $fval, -1, $pcnt['journals'], $data_rcnt, $ftype_k, $ftype_r, 0, $bfilt);
                        $cnt_all['journals']  = $this->moJournal->GetCntListByFilt($fpar, $fval, $ftype_k, $ftype_r, 0, $bfilt);
                       
                        break;

                    case 'Messages':
                        $what = array('w.*');

                        $fpar = array(); //array('w.story');
                        $fval = array(); //array('%' . mysql_escape_string(trim(strip_tags($bfilt))) . '%');

                        $ftype_k = array(); // array_merge($ftype_k, array('w.wuid'));
                        $ftype_r = array(); //array_merge($ftype_r, array(UID));

                        $srch_res['messages'] = $this->moWall->GetListByFilt($what, $fpar, $fval, -1, $pcnt['messages'], $data_rcnt, 'fullQuery', $ftype_k, $ftype_r, UID, $bfilt);
                        $cnt_all['messages'] = $this->moWall->GetCntListByFilt($fpar, $fval, 'fullQuery', $ftype_k, $ftype_r, UID, $bfilt);

                        break;

                    case 'Stake/Wards':
                        $what = array('w.*');
                        $fpar = array('w.story');
                        $fval = array('%' . mysql_escape_string(strip_tags($bfilt)) . '%');

                        $ftype_mes_k = isset($ftype_k) ? $ftype_k : array();
                        $ftype_mes_r = isset($ftype_r) ? $ftype_r : array();

                        if (!empty($ftype['ward_type']))
                        {
                            $ftype_mes_k[] = 'wd.ward_type';
                            $ftype_mes_r[] = $ftype['ward_type'];
                        }
                        if (!empty($ftype['ward_name']))
                        {
                            $cc = explode(', ', $ftype['ward_name']);
                            $fpar[] = 'wd.title';
                            $fval[] = '%' . mysql_escape_string(strip_tags($cc[0])) . '%';
                        }

                        $ward_filt = array(
                                0  => 0,
                                1  => 0,
                                2  => $this -> moUser -> mUinfo['ward_id'],
                                3  => $this -> moUser -> mUinfo['stake_id'],
                                4  => 0,
                                10 => $this -> moUser -> mUinfo['priesthood'],
                                11 => $this->moUser->mProfile->GetSchoolClassList(UID, 0, 1)
                            );

                        $srch_res['wards'] = $this->moWardWall->GetListByFilt($what, $fpar, $fval, -1, $pcnt['wards'], $data_rcnt, $ward_filt, $ftype_mes_k, $ftype_mes_r, UID);
                        $cnt_all['wards']  = $this->moWardWall->GetCntListByFilt($fpar, $fval, $ward_filt, $ftype_mes_k, $ftype_mes_r, UID);
                        break;

                    case 'Missions':

                        if (!$nwall)
                        {
                            $what = array('w.*');
                            $fpar = array('w.story');
                            $fval = array('%' . $bfilt . '%');

                            $ftype_mes_k = isset($ftype_k) ? $ftype_k : array();
                            $ftype_mes_r = isset($ftype_r) ? $ftype_r : array();

                            $srch_res['missions'] = $this->moMissionWall->GetListByFilt($what, $fpar, $fval, -1, $pcnt['missions'], $data_rcnt, array(), $ftype_mes_k, $ftype_mes_r, UID, $filt);

                            $cnt_all['missions'] = $this->moMissionWall->GetCntListByFilt($fpar, $fval, $filt, $ftype_mes_k, $ftype_mes_r, UID);

                        }
                        else
                        {
                          
                            /**
                             * Поиск миссиий - форма поиска на странице миссий
                             */
                            if ($bfilt == 'Find something...')
                            {
                                $bfilt = '';
                            }
                            $srch_res['missions'] = $this->moMission->Search($bfilt, -1, -1, -1, -1, $pcnt['missions'], $data_rcnt, -1, $filt, UID);
                            $cnt_all['missions'] = $this->moMission->CntSearch();
                            
                            $this -> mSmarty -> assign_by_ref('srch_res', $srch_res);
                            $this -> mSmarty -> assign_by_ref('cnt_all', $cnt_all);

                            $this -> mSmarty -> display('mods/system/_search_missions_list.html');
                            exit();
                        }

                        $this->mSmarty->assign('nwall', $nwall);
                        break;
                }
                $this->mSmarty->assign_by_ref('cnt_all', $cnt_all);
                $this->mSmarty->assign_by_ref('cnt_srch_res', $cnt_srch_res);
                $this->mSmarty->assign_by_ref('srch_res', $srch_res);

                include_once 'View/Acc/Pagging.php';
                if ($SI['btype'] == 'All results') $this->mSmarty->assign('all_res', 1);
                else
                {

                    foreach($srch_res as $key=>$val)
                    {
                        if (isset($PG['page'])) $page = $PG['page'];
                        else $page = _v('page', 1);
                        $mpage   =   new Pagging($data_rcnt, $cnt_all[$key], $page, '');
                        $range   =& $mpage -> GetRange( );
                        $this -> mSmarty -> assign('pagging_'.$key,  $mpage   -> Make($this -> mSmarty, '', 'oSearch.SearchPage',$key));
                        $this->mSmarty->assign('page_'.$key, $page);
                    }
                }

                foreach ($pcnt as $pk => $pr)
                {
                    if (!empty($pr))
                    {
                        $this->mSmarty->display('mods/system/_search_' . $pk . '.html');
                    }
                    else
                    {
                        $this->mSmarty->display('mods/system/_search_list.html');
                    }
                    break;
                }
                
            }
            else
                echo 'not_success';
            exit();
        }
        //deb($_GET);
        _v('glsrch') ? $this->mSmarty->assign_by_ref('glsrch', _v('glsrch')) : '';
        _v('glsrchsubfilt') ? $this->mSmarty->assign_by_ref('glsrchsubfilt', _v('glsrchsubfilt')) : '';
        _v('pml') ? $this->mSmarty->assign_by_ref('pml', _v('pml')) : ''; // find users by mission

        _v('pwn') ? $this->mSmarty->assign_by_ref('pwn', _v('pwn')) : ''; // find users by ward name
        _v('psn') ? $this->mSmarty->assign_by_ref('psn', _v('psn')) : ''; // find users by stake name

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
        $this->mSmarty->assign_by_ref('countries', $GLOBALS['cntrs']);
        $this->mSmarty->assign('rel_statuses', array(1 => 'Single', 2 => 'Married', 3 => 'Divorced', 4 => 'Separated', 5 => 'Widowed'));

        $ucnt = $this->moUser->mUser->Count(2, 1); //count of all users
        $this->mSmarty->assign_by_ref('ucnt', $ucnt);
        $this->mSmarty->assign('_content', $this->mSmarty->fetch('mods/system/_search.html'));
    }

    
    /**
     * Find Wards
     * @return void
     */
    public function SearchWards()
    {
        $SI = _v('SI');
        $par_like = '';
        
        if (empty($SI) || (empty($SI['ftype']['ward_name'])/* || empty($SI['ftype']['ward_type'])*/))
        {
            echo 'not_success';
            exit();
        }

        $page  = !empty($_REQUEST['PG']['pcnt']) ? (int)$_REQUEST['PG']['pcnt'] : 0;
        $nwall = !empty($page) ? 1 : 0;
        $data_rcnt = 7;
        
        $this -> mSmarty -> assign('pcnt', $page);
        $this -> mSmarty -> assign('data_rcnt', $data_rcnt);


        $btype = isset($SI['btype']) ? base_chk0($SI['btype']) : '';
        $bfilt = isset($SI['bfilt']) ? base_chk0($SI['bfilt']) : '';

        $ward_type = !empty($SI['ftype']['ward_type']) ? base_chk0($SI['ftype']['ward_type']) : 0;
        $ward_name = base_chk0($SI['ftype']['ward_name']);

        if ($bfilt == 'Find something...')
        {
            $bfilt = '';
        }

        $srch_res['wards'] = array();
        $cnt_all['wards']  = 0;
        $filt = '';


        require_once 'Model/Base/Ward.class.php';
        $this->moWard = new Model_Base_Ward($this -> mlObj['gDb']);

        if ($bfilt == 'Find something...')
        {
            $bfilt = '';
        }


        if ($ward_type == 1)
        {
            $par_like = $ward_name;
            $filt = ' w.ward_type = 2 ';
        }
        else
        {
            $r = $ward_name;
            $filt .= ' (LOWER(w.title) LIKE "%' . ToLower($ward_name) . '%" OR LOWER(w2.title) LIKE "%' . ToLower($ward_name) . '%")';
            $filt .= ' AND w.ward_type = 2'; 
        }

        $srch_res['wards'] = $this->moWard -> Search($bfilt, '', -1, $page, $data_rcnt, 'w.title', $filt, $par_like);
        $cnt_all['wards']  = $this->moWard -> CntSearch($bfilt, '', -1, $filt, $par_like);

        $this -> mSmarty -> assign_by_ref('srch_res', $srch_res);
        $this -> mSmarty -> assign_by_ref('cnt_all', $cnt_all);
        $this -> mSmarty -> assign('nwall', $nwall);
        $this->mSmarty->display('mods/system/_search_wards_list.html');
        exit();
    }


    public function Web()
    {
        include_once 'Model/Search/Gparser.class.php';
        $gPars = new Model_Search_Gparser();
        $q = strip_tags(_v('q', ''));
        $page = _v('page', 0);
        $this -> mSmarty -> assign('q', $q);
        $this -> mSmarty -> assign('page', $page);
        $this -> mSmarty -> assign('pg', $page/10+1);
        $links = $gPars->parse($q, 'google',true, $page, 'en'); //deb($links);

        $this -> mSmarty->assign('results', $links['results']);

        if (isset($links['ad']['top']))
        {
            $this -> mSmarty->assign('ad_top_cnt', !empty($links['ad']['top']['link']) ? count($links['ad']['top']['link']) : 0);
            $this -> mSmarty->assign('ad_top', $links['ad']['top']);
        }

        if (isset ($links['ad']['right']))
        {
            $this -> mSmarty->assign('ad_right_cnt', !empty($links['ad']['right']['link']) ? count($links['ad']['right']['link']) : 0);
            $this -> mSmarty->assign('ad_right', $links['ad']['right']);
        }
        if (isset ($links['ad']['right']) || isset($links['ad']['top']))
        {
            $ac = (!empty($links['ad']['right']['link']) ? count($links['ad']['right']['link']) : 0)
                  +
                  (!empty($links['ad']['top']['link']) ? count($links['ad']['top']['link']) : 0);
            $this -> mSmarty->assign('ad_all_cnt', $ac);
        }
        //deb($links['pages']);
        $this -> mSmarty->assign('pages', $links['pages']);
        $this -> mSmarty->assign('previos', $gPars->previos);
        $this -> mSmarty->assign('next', $gPars->next);

        $this -> mSmarty -> assign('web_search', 1);
        $this->mSmarty->assign('_content', $this->mSmarty->fetch('mods/system/_search_web.html'));
    }

}
?>