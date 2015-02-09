<?php

/**
 * CH Wall model
 * @package    5dev Catalog
 * @version    1.0
 * @since      1.03.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */
class Model_Profile_Wall
{

    //system params
    private $mDb;
    //tables
    private $mTbWall;
    private $mTbWallAnsw;
    private $mTbWallTag;
    private $mTbWallSmStat;
    private $mTbWallPrivacy;
    private $mTbWards;
    private $mTbGroups;
    private $mTbUrlTitles;
    /**
     * Message ID arrays
     * @var array
     */
    private $mMesgAr;
    public $wtype; // type of this wall

    /**
     * Constructor
     *
     * @param $glObj
     */
    public function __construct(&$gDb)
    {
        //wall's tables
        $this->mDb = & $gDb;
        $this->mTbWall = TB . 'users_wall';
        $this->mTbWallAnsw = TB . 'users_wall_answ';
        $this->mTbWallPrivacy = TB . 'users_wall_privacy';
        $this->mTbWallFilt = TB . 'users_wall_filts';
        $this->mTbWallSmStat = TB . 'users_wall_sm_stat';

        //tags tables
        $this->mTbUsersTags = TB . 'users_tags';
        $this->mTbUsersTagsM = TB . 'users_tags_mes';

        //users tables
        $this->mTbUsers = TB . 'users';

        //groups tables
        $this->mTbWards = TB . 'wards_users';
        $this->mTbGroups = TB . 'groups_users';

        $this->mTbUrlTitles = TB . 'url_titles';

        require_once 'Model/Profile/Smile.class.php';
        $this->moSmiles = new Model_Profile_Smile();

        $this->wtype = 0;
    }

/* __construct */

    //----SYSTEM METHODS
    //Get names of the columns of Table Wall
    public function GetCols()
    {
        //return array('id', 'wuid', 'uid', 'is_copy', 'is_copy_type', 'is_copy_mes', 'mtype', 'story', 'ev_title', 'ev_where', 'ev_dt', 'ev_img',
        return array('id', 'wuid', 'uid', 'is_copy', 'is_copy_type', 'is_copy_mes', 'mtype', 'sub_mtype', 'story', 'ev_title', 'ev_where', 'ev_dt', 'ev_img',
            'ev_descr', 'l_url', 'pdate', 'p_url', 'p_img_1', 'p_img_2', 'p_img_3',
            'p_img_aid', 'p_img_1_id', 'p_img_2_id', 'p_img_3_id', 'p_path', 'v_code', 'v_code_id', 'v_file_1', 'v_file_2', 'v_file_3', 'b_img_name');
           // 'p_img_aid', 'p_img_1_id', 'p_img_2_id', 'p_img_3_id', 'p_path', 'v_code', 'v_code_id', 'v_file_1', 'v_file_2', 'v_file_3');
    }

    /** GetColumns */

    public function GetWtype()
    {
        return $this->wtype;
    }

    /**
     * Get names of the Answer columns of Table
     */
    public function GetAnswCols()
    {
        return array('id', 'uid', 'mid', 'story', 'pdate');
    }

/* GetAnswCols */


    /* Init String of Filters for Requests
     * 
     * @param $type - type of Privacy ('')
     * @return wall info
     */

    public function _initFilts($filt, $uid = 0, $psfilt = 0, $pclass = 0)
    {
        $sq_f = '';
        $psfilt = (int) $psfilt;

        if (!empty($filt))
        {
            foreach ($filt as $k => &$v)
            {
                if ($k != 100 && $k != 101)
                {
                    $sq_f .= ($sq_f ? ' OR ' : '') . '(p.ptype = ' . (int) $k . ' AND p.uvid ' . ($k == 0 ? 'NOT' : '') . ' IN (' . (is_array($v) ? Ar2Str($v) : ($v == 0 ? '-1' : $v)) . '))';
                }
            }
//echo $sq_f;die;
            //wards
            $filt[100] = isset($filt[100]) ? (int) $filt[100] : 0;
            $filt[101] = isset($filt[101]) ? (int) $filt[101] : 0;

            if (!empty($filt[1]))
            {
                //friends and folowers
                $sq_f .= ' OR ( (p.ptype = 1) AND p.pstype = 100 AND p.uvid IN (0, ' . $filt[100] . ') ) ';
                $sq_f .= ' OR ( (p.ptype = 1) AND p.pstype = 101 AND p.uvid IN (0, ' . $filt[101] . ') ) ';
            }
            elseif (!empty($filt[2]))
            {
                //only for friends + friends and folowers
                $sq_f .= ' OR ( (p.ptype = 1 OR p.ptype = 2) AND p.pstype = 100 AND p.uvid IN (0, ' . $filt[100] . ') ) ';
                $sq_f .= ' OR ( (p.ptype = 1 OR p.ptype = 2) AND p.pstype = 101 AND p.uvid IN (0, ' . $filt[101] . ') ) ';
            }

            $uid = (int) $uid;
            if ($uid)
            {
                $sq_f .= ' AND (w.wuid = ' . $uid . ') ';
            }

            //subtype

            $sq_f = ' (' . $sq_f . ') ';

            if ($psfilt != -1 && $pclass != -1 && (!empty($filt[1]) || !empty($filt[2]))) // $psfilt - user's priesthold, sfilt for classes - 5 !!!, wards - 100, stakes - 101
            {
                $sfilt = ($psfilt ? '0, 100, 101, ' . $psfilt : '0'); //add ward,stake special ids!!!


                //classes
                $classes = '0';
                if (count($pclass) > 0 && is_array($pclass))
                {
                    foreach ($pclass as $k)
                    {
                        if ($k['class_id'])
                        {
                            $classes .= ', ' . $k['class_id'];
                        }
                    }
                }

                if (!empty($filt[1]))
                {
                    //friends and folowers
                    $sq_f .= ' AND ( (p.pstype IN (' . $sfilt . ') ) OR ';
                    $sq_f .= ' (p.pclass IN (' . $classes . ') AND p.pstype = 5 AND p.ptype = 1) )';
                }
                elseif (!empty($filt[2]))
                {
                    //only for friends + friends and folowers
                    $sq_f .= ' AND ( (p.pstype IN (' . $sfilt . ') ) OR ';
                    $sq_f .= ' (p.pclass IN (' . $classes . ') AND p.pstype = 5 AND (p.ptype = 1 OR p.ptype = 2)) )';
                }
            }
        }
        //echo $sq_f;die;
        return $sq_f;
    }

    /* _initFilt */


    /**
     * Check favorites
     * @param int $mid
     * @param int $mpath
     * @param int $wtype
     * @return array result
     */
    public function ChckExFavTag($mid, $uid, $wtype)
    {
        if (is_array($mid))
        {
            $sql = 'SELECT tm.id, tm.mid FROM ' . $this->mTbUsersTagsM . ' tm , ' . $this->mTbUsersTags . ' t
                    WHERE tm.mid IN (' . implode(', ', $mid) . ') AND tm.uid = ?
                    AND tm.wtype = ? AND tm.tid = t.id AND t.type = 2';
            $db = $this->mDb->query($sql, array($uid, $wtype));
            //deb($this -> mDb);
            $r = array();
            while ($row = $db->FetchRow())
            {
                $r[$row['mid']] = $row['id'];
            }
            return $r;
        } else
        {
            $ex = $this->mDb->getOne('SELECT tm.id FROM ' . $this->mTbUsersTagsM . ' tm , ' . $this->mTbUsersTags . ' t
    				      WHERE tm.mid = ? AND tm.uid = ? AND tm.wtype = ? AND tm.tid = t.id AND t.type = 2 ', array($mid, $uid, $wtype));
            if ($ex)
            {
                return 1;
            } else
            {
                return 0;
            }
        }
    }

/* ChckExFavTag */

    //----GET METHODS

    /* Get count of Messages on the Wall
     *
     * @param $uid - user's or groups ID (-1)
     * @return wall info
     */
    public function GetCnt($cur_uid = -1, $filt = array(), $filter = '', $psfilt = 0, $pclass = 0, $after_id = 0, $before_id = 0)
    {
        $sql = 'SELECT COUNT(id) FROM ' . $this->mTbWall . ' w, ' . $this->mTbWallPrivacy . ' p
				 WHERE p.mid = w.id';
        if (-1 != $cur_uid)
        {
            $sql .= ' AND w.wuid = ?';
        }
        if ($filter)
        {
            $sql .= ' AND ' . $filter;
        }
        $sq_f = $this->_initFilts($filt, 0, $psfilt, $pclass);

        $sql .= $sq_f ? ' AND (' . $sq_f . ')' : '';

        if ($after_id)
        {
            $sql .= ' AND w.id < ' . (int) $after_id;
        }
        if ($before_id)
        {
            $sql .= ' AND w.id >= ' . (int) $before_id;
        }

        return $this->mDb->getOne($sql, $cur_uid);
    }


    /* Get count of Answers in the Message
    *
    * @param $mid -  ID (-1)
    * @param $uid - user's or group's ID (-1)
    * @return wall info
    */
    public function GetAnswCnt($mid)
    {
        return $this->mDb->getOne('SELECT COUNT(id) FROM ' . $this->mTbWallAnsw . ' WHERE mid = ?', array($mid));
    }

    /* GetAnswCnt */

    /* Get count of some smile status
    *
    * @param $mid -  ID (-1)
    * @param $sname -  name of smile
    * @return wall info
    */
    public function GetSmStatCnt($mid, $sname)
    {
        return $this->mDb->getOne('SELECT COUNT(id) FROM ' . $this->mTbWallSmStat . ' WHERE mid = ? AND s_name = ?', array($mid, $sname));
    }

    /* GetSmStatCnt */

    /* Get Message's list
     * 
     * @param $cur_uid - current user's ID
     * @param $first - first message (-1)
     * @param $cnt - count of parsing messages (-1)
     * @param $order - order by message (-1)
     * @param $filt - filtering array (privacy)
     * @return current user's Messages & Answers List
     */

    public function GetList($cur_uid, $first = -1, $cnt = -1, $order = -1, $filt = array(), $filter = '', $psfilt = 0, $pclass = 0, $after_id = 0, $before_id = 0, $only_id = 0)
    {
        $sql = 'SELECT w.*, p.ptype, p.uvid, p.pstype, p.pclass,
		        u.email, u.first_name, u.last_name, u.image, u.fpath,
		        u2.uid as uid2, u2.email AS email2, u2.first_name AS first_name2, u2.last_name AS last_name2, u2.image AS image2, u2.fpath AS fpath2,
		        u3.uid as uid3, u3.email AS email3, u3.first_name AS first_name3, u3.last_name AS last_name3, u3.image AS image3, u3.fpath AS fpath3,
		        u4.uid as uid4, u4.email AS email4, u4.first_name AS first_name4, u4.last_name AS last_name4, u4.image AS image4, u4.fpath AS fpath4,
                COUNT(wa.id) AS cnt_answ,
                IF (w.is_copy_mes = 0, w.id, w.is_copy_mes) AS com_parent
		        FROM ' . $this->mTbWall . ' w
		              LEFT JOIN ' . $this->mTbWallAnsw . ' wa ON (IF (w.is_copy_mes = 0, w.id, w.is_copy_mes) = wa.mid)' .
                ' LEFT JOIN ' . $this->mTbUsers . ' u2 ON (u2.uid = w.wuid)' .
                ' LEFT JOIN ' . $this->mTbUsers . ' u3 ON (u3.uid = (SELECT uvid FROM ' . $this->mTbWallPrivacy . ' WHERE mid = w.id))' .
                ' LEFT JOIN ' . $this->mTbUsers . ' u4 ON (u4.uid = w.is_copy)' .
                ', ' . $this->mTbWallPrivacy . ' p, ' . $this->mTbUsers . ' u' .
                ' WHERE w.wuid = ? AND p.mid = w.id AND u.uid = w.uid';

        if ($filter)
        {
            $sql .= ' AND ' . $filter;
        }

        $sq_f = $this->_initFilts($filt, 0, $psfilt, $pclass);

        if ($after_id)
        {
            $sql .= ' AND w.id < ' . (int) $after_id;
        }
        if ($before_id)
        {
            $sql .= ' AND w.id >= ' . (int) $before_id;
        }

        if ($only_id)
        {
            $sql .= ' AND w.id = ' . (int) $only_id;
        }

        $sql .= $sq_f ? ' AND ( (' . $sq_f . ') ' . ($filt[0] ? 'OR w.uid = ' . $filt[0] : '') . ')' : ''; // $filt[0] - uid of viewer
        $sql .= ' GROUP BY w.id';
        $sql .= (-1 != $order) ? ' ORDER BY ' . $order : ' ORDER BY w.pdate DESC';

        $ar_q = array($cur_uid); //query array
        if (-1 != $first && -1 != $cnt)
        {
            $db = $this->mDb->limitQuery($sql, $first, $cnt, $ar_q);
        }
        else
        {
            $db = $this->mDb->query($sql, $ar_q);
        }

        $r = array();
        $this->mMesgAr = array();

        while ($ar_f = $db -> FetchRow())
        {
            if ($ar_f['cnt_answ'])
            {
                $ar_f['answers'] = $this -> GetAnswList($ar_f['com_parent'], 0, 2);
            }
            $ar_f['wtype'] = $this -> wtype;

            //$status = $this -> GetStatusForWall($ar_f['com_parent']);
            $status = $this ->GetStatWid($ar_f['com_parent']);
            
            if (!empty($status))
            {
                $ar_f['status'] = $status;
            }

            //smiles
            if (!empty($ar_f['story']))
            {
               $this->moSmiles->FindSmile($ar_f['story']);
            }

            $r[] = $ar_f;

            $this -> mMesgAr[] = $ar_f['id'];
        }

        return $r;
    }


    public function GetCurrentMesgAr()
    {
        return $this->mMesgAr;
    }


    /*
     * Get first message in list
     */
    public function GetFirstMessageId($cur_uid, $first = -1, $cnt = -1, $order = -1, $filt = array(), $filter = '', $psfilt = 0, $pclass = 0)
    {
        $sql = 'SELECT w.id
		        FROM ' . $this->mTbWall . ' w, '
                . $this->mTbWallPrivacy . ' p,
               ' . $this->mTbUsers . ' u
               WHERE w.wuid = ? AND p.mid = w.id AND u.uid = w.uid';

        if ($filter)
        {
            $sql .= ' AND ' . $filter;
        }

        $sq_f = $this->_initFilts($filt, 0, $psfilt, $pclass);

        $sql .= $sq_f ? ' AND ( (' . $sq_f . ') ' . ($filt[0] ? 'OR w.uid = ' . $filt[0] : '') . ')' : ''; // $filt[0] - uid of viewer
        $sql .= ' GROUP BY w.id ORDER BY w.id ASC LIMIT 1';
        return $this -> mDb -> getOne($sql, array($cur_uid));
    }


    /* Get One Message
     * 
     * @param $id - Message ID
     * @param $filt - filtering array (privacy)
     * @return current answeres of Message
     */
    public function GetOne($id, $filt = array(), $uid, $psfilt = 0, $pclass = 0)
    {
        $sql = 'SELECT w.*, p.ptype, p.uvid, p.pstype, p.pclass,
		        u.email, u.first_name, u.last_name, u.image, u.fpath,
	         	u2.email AS email2, u2.first_name AS first_name2, u2.last_name AS last_name2, u2.image AS image2, u2.fpath AS fpath2,
	          	u3.uid as uid3, u3.email AS email3, u3.first_name AS first_name3, u3.last_name AS last_name3, u3.image AS image3, u3.fpath AS fpath3,
	        	IF (w.is_copy_mes = 0, w.id, w.is_copy_mes) AS com_parent
	        	FROM ' . $this->mTbWall . ' w
	        	     LEFT JOIN ' . $this->mTbUsers . ' u2 ON (u2.uid = w.wuid)
                     LEFT JOIN ' . $this->mTbUsers . ' u3 ON (u3.uid = (SELECT uvid FROM ' . $this->mTbWallPrivacy . ' WHERE mid = w.id))' .
                ' , ' . $this->mTbWallPrivacy . ' p, ' . $this->mTbUsers . ' u
		        WHERE w.id = ? AND p.mid = w.id AND u.uid = w.uid ';

        if (!empty($filt))
        {
            $sql .= ' AND p.mid = w.id';
            $sq_f = $this->_initFilts($filt, 0, $psfilt, $pclass);
            $sql .= $sq_f ? ' AND ( (' . $sq_f . ') ' . ($filt[0] ? 'OR w.uid = ' . $filt[0] : '') . ')' : ''; // $filt[0] - uid of viewer
        }

        $sql .= ' LIMIT 1';
        $res = $this->mDb->getRow($sql, array($id));

        if (!empty($res))
        {
            $res['my_fav'] = $this->ChckExFavTag($res['id'], $uid, 0) ? 1 : 0;
        }
        return $res;
    }


    /**
     * Получаем информацию по первому оригинальному сообщению
     * На чьей стене размещено
     * @param int $mid
     */
    public function GetBaseMessage($mid)
    {
        $sql = 'SELECT w.uid, w.wuid, w2.uid AS o_uid, w2.wuid AS o_wuid
                FROM '.$this -> mTbWall.' w
                LEFT JOIN '.$this -> mTbWall.' w2 ON (w.is_copy_mes = w2.id)
                WHERE w.id = ?';
        $r = $this -> mDb -> getRow($sql, array($mid));
        $r['uid']  = !empty($r['o_uid']) ? $r['o_uid'] : $r['uid'];
        $r['wuid'] = !empty($r['o_wuid']) ? $r['o_wuid'] : $r['wuid'];

        return $r;
    }


    public function CheckMessageVideoAccess($video_code_id, $filt = array(), $uid, $psfilt = 0, $pclass = 0)
    {

        $sql = 'SELECT w.id
                FROM ' . $this->mTbWall . ' w LEFT JOIN ' . $this->mTbUsers . ' u2 ON (u2.uid = w.wuid)' .
                ' LEFT JOIN ' . $this->mTbUsers . ' u3 ON (u3.uid = (SELECT uvid FROM ' . $this->mTbWallPrivacy . ' WHERE mid = w.id))' .
                ' , ' . $this->mTbWallPrivacy . ' p, ' . $this->mTbUsers . ' u
		        WHERE w.v_code_id = ? AND p.mid = w.id AND u.uid = w.uid ';

        if (!empty($filt))
        {
            $sql .= ' AND p.mid = w.id';
            $sq_f = $this->_initFilts($filt, 0, $psfilt, $pclass);
            $sql .= $sq_f ? ' AND ( (' . $sq_f . ') ' . ($filt[0] ? 'OR w.uid = ' . $filt[0] : '') . ')' : ''; // $filt[0] - uid of viewer
        }
        $sql .= ' LIMIT 1';

        $res = $this->mDb->getOne($sql, array($video_code_id));

        return $res;
    }


    public function CheckMessagePhotoAccess($photo_id, $filt = array(), $uid, $psfilt = 0, $pclass = 0)
    {

        $sql = 'SELECT w.id
                FROM ' . $this->mTbWall . ' w LEFT JOIN ' . $this->mTbUsers . ' u2 ON (u2.uid = w.wuid)' .
                ' LEFT JOIN ' . $this->mTbUsers . ' u3 ON (u3.uid = (SELECT uvid FROM ' . $this->mTbWallPrivacy . ' WHERE mid = w.id))' .
                ' , ' . $this->mTbWallPrivacy . ' p, ' . $this->mTbUsers . ' u
		WHERE (w.p_img_1_id = ? OR w.p_img_2_id = ? OR w.p_img_3_id = ?) AND p.mid = w.id AND u.uid = w.uid ';

        if (!empty($filt))
        {
            $sql .= ' AND p.mid = w.id';
            $sq_f = $this->_initFilts($filt, 0, $psfilt, $pclass);
            $sql .= $sq_f ? ' AND ( (' . $sq_f . ') ' . ($filt[0] ? 'OR w.uid = ' . $filt[0] : '') . ')' : ''; // $filt[0] - uid of viewer
        }
        $sql .= ' LIMIT 1';

        $res = $this->mDb->getOne($sql, array($photo_id, $photo_id, $photo_id));

        return $res;
    }


    public function GetCopies($is_copy, $is_copy_mes)
    {
        $sql = 'SELECT w.*
				FROM ' . $this->mTbWall . ' w
				WHERE w.is_copy = ? AND w.is_copy_mes = ? ';
        $db = $this->mDb->query($sql, array($is_copy, $is_copy_mes));
        $r = array();
        while ($ar_f = $db->fetchRow())
        {
            $r[] = $ar_f;
        }
        return $r;
    }


    /* Get Answers list
     * 
     * @param $mid - Message ID
     * @param $first - first message (-1)
     * @param $cnt - count of parsing messages (-1)
     * @param $order - order by message (-1)
     * @return current answeres of Message
     */
    public function GetAnswList($mid, $first = -1, $cnt = -1, $order = -1)
    {
        if (is_array($mid))
        {
            $m = '';
            foreach ($mid as $v)
            {
                $m .= ($m ? ', ' : '') . (int) $v;
            }
            $sql = 'SELECT wa.*, u.email, u.first_name, u.last_name, u.image, u.fpath
			FROM ' . $this->mTbWallAnsw . ' wa
				LEFT JOIN ' . $this->mTbUsers . ' u ON ( u.uid = wa.uid )
				WHERE wa.mid IN (' . $m . ')	FROM ' . $this->mTbWallAnsw . ' wa
				LEFT JOIN ' . $this->mTbUsers . ' u ON ( u.uid = wa.uid )
				WHERE wa.mid IN (' . $m . ')';
        } else
        {
            $sql = 'SELECT wa.*, u.email, u.first_name, u.last_name, u.image, u.fpath
				FROM ' . $this->mTbWallAnsw . ' wa
				LEFT JOIN ' . $this->mTbUsers . ' u ON ( u.uid = wa.uid )
				WHERE wa.mid = ' . (int) $mid;
        }

        $sql .= (-1 != $order) ? ' ORDER BY ' . $order : ' ORDER BY wa.pdate DESC';

        if (-1 != $first && -1 != $cnt)
        {
            $db = $this->mDb->limitQuery($sql, $first, $cnt);
        } else
        {
            $db = $this->mDb->query($sql);
        }

        $r = array();
        while ($ar_f = $db->fetchRow())
        {
            //smiles
            if (!empty($ar_f['story']))
            {
               $this->moSmiles->FindSmile($ar_f['story']);
            }

            $r[] = $ar_f;
        }
        return $r;
    }
    
    public function GetStatusForWall($mid)
    {
       $sql = 'SELECT *	FROM ' . $this->mTbWallSmStat . ' WHERE mid = ' . (int) $mid;
       $db = $this->mDb->query($sql);
       $r = array();
       while ($ar_f = $db->fetchRow())
       {
         if (!isset($r[$ar_f['s_name']]))
             $r[$ar_f['s_name']] = 1;
         else
             $r[$ar_f['s_name']] = $r[$ar_f['s_name']]+1;
       }
       return $r;
    }


    /* Get One Answer in Message
     * 
     * @param $id - Answer ID
     * @return current answeres of Message
     */
    public function GetAnswOne($id)
    {
        $sql = 'SELECT wa.*, u.email, u.first_name, u.last_name, u.image, u.fpath
				FROM ' . $this->mTbWallAnsw . ' wa
				LEFT JOIN ' . $this->mTbUsers . ' u ON ( u.uid = wa.uid )
				WHERE wa.id = ?';
        return $this->mDb->getRow($sql, array($id));
    }

    public function GetStatWid($mid)
    {
        $sql = 'SELECT w.*, u.first_name, u.last_name, u.image, u.fpath
				FROM ' . $this->mTbWallSmStat . ' w
				LEFT JOIN ' . $this->mTbUsers . ' u ON ( u.uid = w.suid )
				WHERE w.mid = ?';
        $db = $this->mDb->query($sql, array($mid));
        $r = array();
        $rh = array();
        while ($ar_f = $db->fetchRow())
        {
            if (!isset($r[$ar_f['s_name']]))
            {
                $r[$ar_f['s_name']] = array();
                $r[$ar_f['s_name']]['cnt'] = 1;

                $rh[$ar_f['s_name']][$ar_f['suid']] = 1;
                $r[$ar_f['s_name']][] = $ar_f;
            }
            else
            {
                if (!isset($rh[$ar_f['s_name']][$ar_f['suid']]))
                {
                    $r[$ar_f['s_name']][] = $ar_f;
                    $rh[$ar_f['s_name']][$ar_f['suid']] = 1;
                }
                $r[$ar_f['s_name']]['cnt'] = $r[$ar_f['s_name']]['cnt'] + 1;
            }
        }
        unset($rh);
        return $r;

    }
    
    public function SetSmStatus($id, $name, $uid)
    {
            $sql = 'INSERT INTO ' . $this->mTbWallSmStat . ' (mid ,suid ,s_name, pdate)
                VALUES(?, ?, ?, ?)';
            $this->mDb->query($sql, array($id, $uid, $name, date("Y-m-d H:i:s")));
            $mes_id =  $this -> mDb -> getOne('SELECT LAST_INSERT_ID()');
            return $mes_id;
    }

    public function CheckSmStatus($id, $name, $uid)
    {
        $stat_id = $this->mDb->getOne('SELECT id FROM ' . $this->mTbWallSmStat . ' WHERE mid = ? AND suid = ? AND s_name = ?', array($id, $uid, $name));
        //$stat_id = $this->mDb->getOne('SELECT id FROM ' . $this->mTbWallSmStat . ' WHERE mid = ? AND suid = ?', array($id, $uid));
        if (isset($stat_id)) return $stat_id;
        else return 0;
    }


    //----EDIT METHODS

    /* Add & Edit Message
     *
     * @param $id - Message ID
     * @param $ar_k - array with keys of editing data
     * @param $ar_v - array with values of editing data
     * @return insert - Last Message ID; update - void;
     */
    public function Edit($id, $ar_k = array(), $ar_v = array())
    {
        if (empty($id))
        {
            $sql = 'INSERT INTO ' . $this->mTbWall . ' ( ' . join(' ,', $ar_k) . ', pdate )
					VALUES ( ' . gen_plh($ar_k, 0) . ', NOW() )';

            $this->mDb->query($sql, $ar_v);
            return $this->mDb->getOne('SELECT LAST_INSERT_ID()');
        }
        else
        {
            $sql = 'UPDATE ' . $this->mTbWall . ' SET ' . gen_plh($ar_k, 1) . '
					WHERE id = ?';

            $ar_v = array_merge($ar_v, array($id));

            $this->mDb->query($sql, $ar_v);

        }
    }

    /**
     * Метод для добавления приватного (!!) сообщения от одного пользователя
     * на стену другого
     * @return int
     */
    public function SendPrivateMessage( $uid_from, $uid_to, $story )
    {
        /**
         * Добавляем сообщение
         */
        $sql = 'INSERT INTO '.$this -> mTbWall.' (wuid ,uid ,story, pdate)
                VALUES(?, ?, ?, ?)';
        $this->mDb->query($sql, array($uid_to, $uid_from, $story, date("Y-m-d H:i:s")));
        $mes_id =  $this -> mDb -> getOne('SELECT LAST_INSERT_ID()');

        /**
         * Добавляем приватность
         */
         $this -> mDb -> query('INSERT INTO '.$this -> mTbWallPrivacy.' (ptype, mid, uvid, pstype, pclass)
         VALUES(?, ?, ?, ?, ?)', array(5, $mes_id, $uid_from, 0, 0));


        /**
         * Копируем на стену
         */
         $sql = 'INSERT INTO '.$this -> mTbWall.' (wuid ,uid, is_copy, is_copy_mes, story, pdate)
                VALUES(?, ?, ?, ?, ?, ?)';
         $this->mDb->query($sql, array($uid_from, $uid_from, $uid_to, $mes_id, $story, date("Y-m-d H:i:s")));
         $mes_copy_id =  $this -> mDb -> getOne('SELECT LAST_INSERT_ID()');

        /**
         * Добавляем приватность
         */
         $this -> mDb -> query('INSERT INTO '.$this -> mTbWallPrivacy.' (ptype, mid)
         VALUES(?, ?)', array(5, $mes_copy_id));

        /**
         * Добавляем нотификацию
         */
        $this -> mDb -> query('INSERT INTO '.TB.'users_notify (uid, to_uid, event_id, wid, wtype, notify_pos, type, info, dt, status)
            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array($uid_from, $uid_to, 0, $uid_to, 1, 1, 1, strip_tags($story), date("Y-m-d H:i:s"), 0)
            );

        return true;
    }


    /**
     *
     * @param $id - wall id
     * @param $var - variable
     * @param $val - value
     * @return bool true
     */
    public function EditWallParam($id, $var, $val)
    {
        $sql = 'UPDATE ' . $this->mTbWall . ' SET ' . $var . ' = ? WHERE id = ?';
        $this->mDb->query($sql, array($val, $id));
        return true;
    }


    /* Add & Edit Message
     *
     * @param $id - Answer ID
     * @param $ar_k - array with keys of editing data
     * @param $ar_v - array with values of editing data
     * @return insert - Last Message ID; update - void;
     */
    public function EditAnsw($id, $ar_k = array(), $ar_v = array())
    {
        if (!$id)
        {
            $sql = 'INSERT INTO ' . $this->mTbWallAnsw . ' ( ' . join(' ,', $ar_k) . ', pdate )
					VALUES ( ' . gen_plh($ar_k, 0) . ', NOW() )';

            $this->mDb->query($sql, $ar_v);
            return $this->mDb->getOne('SELECT LAST_INSERT_ID()');
        } else
        {
            $sql = 'UPDATE ' . $this->mTbWallAnsw . ' SET ' . gen_plh($ar_k, 1) . '
					WHERE id = ?';

            $ar_v = array_merge($ar_v, array($id));
            $this->mDb->query($sql, $ar_v);
        }
    }


    /* Add & Edit Message Privacy
     *
     * @param $ptype - privacy type
     * @param $mid - Message ID
     * @param $uid - user's ID
     * @return if Add - LID, else - void
     */
    public function EditPrivacy($ptype, $mid, $uvid = 0, $pstype = 0, $pclass = 0)
    {
        //deb($g = array($ptype, $mid, $uvid, $pstype));
        $privacy = $this->mDb->getOne('SELECT ptype FROM ' . $this->mTbWallPrivacy . ' WHERE mid = ?', array($mid));
        if (!isset($privacy))
        {
            $sql = 'INSERT INTO ' . $this->mTbWallPrivacy . ' ( ptype, mid, uvid, pstype, pclass )
					VALUES ( ?, ?, ?, ?, ? )';
            $this->mDb->query($sql, array($ptype, $mid, $uvid, $pstype, $pclass));
            return $this->mDb->getOne('SELECT LAST_INSERT_ID()');
        }
        else
        {
            $sql = 'UPDATE ' . $this->mTbWallPrivacy . ' SET ptype = ?, uvid = ?, pstype = ?, pclass = ?
					WHERE mid = ?';
            $this->mDb->query($sql, array($ptype, $uvid, $pstype, $pclass, $mid));
        }
    }


    public function GetFilt($uid)
    {
        $id = $this->mDb->getAll('SELECT * FROM ' . $this->mTbWallFilt . ' WHERE uid = ?', array($uid));
        return $id;
    }


    public function EditFilt($uid, $name, $ptype, $mtype)
    {
        $id = $this->mDb->getOne('SELECT id FROM ' . $this->mTbWallFilt . ' WHERE uid = ? AND name= ?', array($uid, $name));
        if (!isset($id))
        {
            $sql = 'INSERT INTO ' . $this->mTbWallFilt . ' ( uid, name, ptype, mtype )
					VALUES ( ?, ?, ?, ? )';
            $this->mDb->query($sql, array($uid, $name, $ptype, $mtype));
            return $this->mDb->getOne('SELECT LAST_INSERT_ID()');
        } else
        {
            $sql = 'UPDATE ' . $this->mTbWallFilt . ' SET name = ?, ptype = ?, mtype = ?
					WHERE uid = ?';
            $this->mDb->query($sql, array($name, $ptype, $mtype, $uid));
        }
    }


    public function DelFilt($id, $uid)
    {
        $ex = $this->mDb->getOne('SELECT id FROM ' . $this->mTbWallFilt . ' WHERE uid = ? AND id= ?', array($uid, $id));
        if ($ex)
        {
            $sql = 'DELETE FROM ' . $this->mTbWallFilt . ' WHERE id = ? AND uid = ?';
            $this->mDb->query($sql, array($id, $uid));
        }
    }


    //----DELETE METHODS

    public function Del($id, $uid)
    {
        $ex = $this->mDb->getRow('SELECT w.id, w.is_copy_mes FROM ' . $this->mTbWall . ' w
				  LEFT JOIN ' . $this->mTbWall . ' w2 ON ( w2.id = w.is_copy_mes )
                                  WHERE w.id = ? AND ( (w.uid = ? OR w.wuid = ?) OR ( w.is_copy_mes <> 0 AND w2.wuid = w.uid ) )', array($id, $uid, $uid));
        if ($ex || IS_USER)
        {
            $this->mDb->query('DELETE FROM ' . $this->mTbWallAnsw . ' WHERE mid = ?', array($id));
            $this->mDb->query('DELETE FROM ' . $this->mTbWallPrivacy . ' WHERE mid = ?', array($id));

            //delete tags
            $db_t = $this->mDb->query('SELECT tid FROM ' . $this->mTbUsersTagsM . ' WHERE mid = ?', array($id));
            while ($row = $db_t->FetchRow())
            {
                $t_c = $this->mDb->getOne('SELECT cnt FROM ' . $this->mTbUsersTags . ' WHERE id = ?', array($row['tid']));
                if ($t_c > 1)
                {
                    $this->mDb->query('UPDATE ' . $this->mTbUsersTags . ' SET cnt = cnt - 1 WHERE id = ?', array($row['tid']));
                }
                else
                {
                    $this->mDb->query('DELETE FROM ' . $this->mTbUsersTags . ' WHERE id = ?', array($row['tid']));
                }
            }
            $this->mDb->query('DELETE FROM ' . $this->mTbUsersTagsM . ' WHERE mid = ?', array($id));

            //delete sub-messages
            if (empty($row['is_copy_mes']))
            {
                $sql = 'SELECT id FROM '.$this -> mTbWall.' WHERE is_copy_mes = ?';
                $this -> mDb -> getAll($sql, array($id));
            }

            if (empty($row['is_copy_mes']))
            {
                //delete all copies
                $sql = 'SELECT id, uid FROM ' . $this->mTbWall . ' WHERE is_copy_mes = ?';
                $l = $this->mDb->getAll($sql, array($id));
                foreach ($l as $v)
                {
                    $this->Del($v['id'], $v['uid']);
                }
            }
            return true;
        }
        return false;
    }


    /**
     * Delete one answer by ID
     * @param  $id
     * @return bool true
     */
    public function DelAnsw($id)
    {
        $sql = 'DELETE FROM ' . $this->mTbWall . ' WHERE id = ?';
        $this->mDb->query($sql, $id);
        return true;
    }


    //-- ADDITIONAL METHODS

    public function GetCntListByFilt($fpar = array(), $fval = array(), $filt = array(), $ar_filt_par = array(), $ar_filt_val = array(), $uid = 0, $bfilt = -1)
    {
        $tb_ind = 1;
        $r = array();

        if (is_array($filt))
        {
            $sql = 'SELECT COUNT(w.id)
				    FROM ' . $this->mTbWall . ' w
				    LEFT JOIN ' . $this->mTbUsers . ' u ON ( u.uid = w.uid )
				    RIGHT JOIN ' . $this->mTbWallPrivacy . ' p ON ( p.mid = w.id )
				    WHERE 1 ';

            $sq_f = $this->_initFilts($filt, $uid);
            $sql .= $sq_f ? ' AND (' . $sq_f . ')' : '';
        }
        else
        {
            $sql = 'SELECT COUNT(w.id)
				    FROM ' . $this->mTbWall . ' w
				    LEFT JOIN ' . $this->mTbUsers . ' u ON ( u.uid = w.uid ) ' .
                    "RIGHT JOIN " . $this->mTbWallPrivacy . " p ON ( p.mid = w.id AND p.ptype = 0 AND p.uvid <> " . $uid . ") WHERE w.is_copy = 0 ";
        }


        if (!empty($fpar))
        {
            $sql .= 'AND ( ' . gen_plh($fpar, 4) . ' )';
        }

        $sql .= ' AND ( (w.uid = ' . $uid . ' AND w.is_copy = 0) OR (w.uid <> ' . $uid . ' AND w.is_copy = 0) )'; //!


        if (!empty($ar_filt_par) && !empty($ar_filt_par))
        {
            $sql .= ' AND ( ' . gen_plh($ar_filt_par, 3) . ' )';
            $fval = array_merge($fval, $ar_filt_val);
        }

        if ($bfilt != -1)
        {
            $bfilt = mysql_escape_string(strip_tags(trim($bfilt)));
            $sql .= " AND (w.story LIKE '%" . $bfilt . "%' OR w.ev_title LIKE '%" . $bfilt . "%' OR w.ev_descr LIKE '%" . $bfilt . "%') ";
        }

        $r = $this->mDb->getOne($sql, $fval);
        return $r;
    }


    public function GetListByFilt($what = array(), $fpar = array(), $fval = array(), $sort = -1, $first = 0, $cnt = 0, $filt = array(), $ar_filt_par = array(), $ar_filt_val = array(), $uid = 0, $bfilt = -1)
    {
        $tb_ind = 1;
        $r = array();

        if (is_array($filt))
        {
            $sql = 'SELECT ' . join(', ', $what) . ', u.email, u.first_name, u.last_name, u.image, u.fpath
				    FROM ' . $this->mTbWall . ' w
				    LEFT JOIN ' . $this->mTbUsers . ' u ON ( u.uid = w.uid )
				    RIGHT JOIN ' . $this->mTbWallPrivacy . ' p ON ( p.mid = w.id )
                                    WHERE 1 ';

            $sq_f = $this->_initFilts($filt, $uid);
            $sql .= $sq_f ? ' AND (' . $sq_f . ')' : '';
        }
        else
        {
            $sql = 'SELECT DISTINCT ' . join(', ', $what) . ', u.email, u.first_name, u.last_name, u.image, u.fpath
				    FROM ' . $this->mTbWall . ' w
				    LEFT JOIN ' . $this->mTbUsers . ' u ON ( u.uid = w.uid ) ' .
                    "RIGHT JOIN " . $this->mTbWallPrivacy . " p ON ( p.mid = w.id AND p.ptype = 0) AND p.uvid <> " . $uid . " WHERE w.is_copy = 0 ";
        }

        if (!empty($fpar))
        {
            $sql .= 'AND ( ' . gen_plh($fpar, 3) . ' ) ';
        }

        if (!empty($ar_filt_par) && !empty($ar_filt_par))
        {
            $sql .= ' AND ( ' . gen_plh($ar_filt_par, 2) . ' )';
            $fval = array_merge($fval, $ar_filt_val);
        }

   
        if ($bfilt != -1)
        {
            $bfilt = mysql_escape_string(strip_tags(trim($bfilt)));
            $sql .= " AND (w.story LIKE '%" . $bfilt . "%' OR w.ev_title LIKE '%" . $bfilt . "%' OR w.ev_descr LIKE '%" . $bfilt . "%') ";
        }

        if (-1 != $sort)
            $sql .= ' ORDER BY ' . $sort;
        else
            $sql .= ' ORDER BY w.pdate DESC';

        if ($cnt)
            $db = $this->mDb->limitQuery($sql, $first, $cnt, $fval);
        else
            $db = $this->mDb->query($sql, $fval);
        //deb($this->mDb);
        while ($ar_f = $db->fetchRow())
        {
            $r[] = $ar_f;
        }
        return $r;
    }


    public function GetUrlTitle($url)
    {
        $url = ToLower($url);
        $url = str_replace('http://', '', $url);
        return $this->mDb->getOne('SELECT title FROM ' . $this->mTbUrlTitles . ' WHERE LOWER(link)=?', array(ToLower($url)));
    }

    public function EditUrlTitle($url, $title)
    {
        $url = ToLower($url);
        $url = str_replace('http://', '', $url);
        $this->mDb->query('INSERT INTO ' . $this->mTbUrlTitles . ' (link, title, pdate) VALUES(?, ?, ?)', array(ToLower($url), $title, mktime()));
        return true;
    }

}
?>