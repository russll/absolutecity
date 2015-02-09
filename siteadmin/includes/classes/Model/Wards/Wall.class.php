<?php
/**
 * Ward's Wall model
 * @package    5dev Catalog
 * @version    1.0
 * @since      29.03.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */
class Model_Wards_Wall
{
    //system params
    private $mDb;

    //tables
    private $mTbWards;
    private $mTbWall;
    private $mTbWallAnsw;
    private $mTbWallPrivacy;
    private $mTbUrlTitles;
    private $mTbUsersTags;
    private $mTbUsersTagsM;

    private $wtype;

    /**
     * Message ID arrays
     * @var array
     */
    private $mMesgAr;

    /**
     * Constructor
     *
     * @param $glObj
     */
    public function __construct(&$gDb)
    {
        //'CAN_WRITE'
        //wall's tables
        $this -> mDb =& $gDb;
        $this -> mTbWards = TB . 'wards';
        $this -> mTbWall = TB . 'wards_wall';
        $this -> mTbWallAnsw = TB . 'wards_wall_answ';
        $this -> mTbWallPrivacy = TB . 'wards_wall_privacy';

        //tags tables
        $this -> mTbUsersTags = TB . 'users_tags';
        $this -> mTbUsersTagsM = TB . 'users_tags_mes';

        //users tables
        $this -> mTbUsers = TB . 'users';
        $this -> mTbUrlTitles = TB . 'url_titles';

        //init smiles
        require_once 'Model/Profile/Smile.class.php';
        $this->moSmiles = new Model_Profile_Smile();

        $this -> wtype = 3;
    }

    /* __construct */


    //----SYSTEM METHODS
    public function GetWtype()
    {
        return $this -> wtype;
    }

    //Get names of the columns of Table Wall
    public function GetCols()
    {
        $sql = "SHOW COLUMNS FROM " . $this -> mTbWall;
        $db = $this -> mDb -> query($sql);
        while ($ar_f = $db -> fetchRow())
        {
            $r[] = $ar_f['Field'];
        }
        return array_values($r);
    }

    /** GetColumns */

    //Get names of the Answer columns of Table
    public function GetAnswCols()
    {
        $sql = "SHOW COLUMNS FROM " . $this -> mTbWallAnsw;
        $db = $this -> mDb -> query($sql);
        while ($ar_f = $db -> fetchRow())
        {
            $r[] = $ar_f['Field'];
        }
        return array_values($r);
    }

    /* GetAnswCols */


    /* Init String of Filters for Requests
	 * 
	 * @param $type - type of Privacy ('')
	 * @return wall info
    */
    public function _initFilts($filt)
    {
        $sq_f = '';

        if (!empty($filt))
        {
            foreach ($filt as $k => &$v)
            {
                if (10 > $k)
                {
                    if (!$k && !empty($filt[33]))
                    {
                        //add watching
                        $v = (empty($v)) ? $filt[33] : array($v, $filt[33]);    
                    }
                    $sq_f .= ($sq_f ? ' OR ' : '') . '(p.ptype = ' . (int) $k . ' AND p.uwid ' . (2 <= $k ? 'NOT' : '') . ' IN (' . (is_array($v) ? Ar2Str($v) : ($v == 0 ? '-1' : $v)) . ') AND p.stype = 0 )';
                }
                elseif (11 == $k)
                {
                    if (!empty($v))
                    {
                        //some class
                        if (!empty($filt[0]))
                        {
                            /** some ward && some stake */
                            $sq_f .= ($sq_f ? ' OR ' : '') . ' ((p.ptype = 0 OR p.ptype = 1) AND p.pclass IN (' . implode(',', $v) . ') AND p.stype = 5)';
                        }
                        elseif (!empty($filt[4]))
                        {
                            /** only some stake, not ward */
                            $sq_f .= ($sq_f ? ' OR ' : '') . ' ((p.ptype = 1) AND p.pclass IN (' . implode(',', $v) . ') AND p.stype = 5)';
                        }
                    }
                }
                elseif (10==$k)
                {
                    //add filter by role (stype)
                    if (!empty($filt[0]))
                    {
                        /** some ward && some stake */
                        $sq_f .= ($sq_f ? ' OR ' : '') . '((p.ptype = 0 OR p.ptype = 1) AND p.stype = ' . $v . ' )';
                    }
                    elseif (!empty($filt[4]))
                    {
                        /** only some stake, not ward */
                        $sq_f .= ($sq_f ? ' OR ' : '') . '(p.ptype = 1 AND p.stype = ' . $v . ' )';
                    }
                }
            }
            $sq_f .= ' OR w.uid = ' . UID;
        }
       
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
            $db = $this -> mDb -> query($sql, array($uid, $wtype));
            //deb($this -> mDb);
            $r = array();
            while ($row = $db -> FetchRow())
            {
                $r[$row['mid']] = $row['id'];
            }
            return $r;
        }
        else
        {
            $ex = $this->mDb->getOne('SELECT tm.id FROM ' . $this->mTbUsersTagsM . ' tm , ' . $this->mTbUsersTags . ' t
    				      WHERE tm.mid = ? AND tm.uid = ? AND tm.wtype = ? AND tm.tid = t.id AND t.type = 2 ', array($mid, $uid, $wtype));
            if ($ex)
            {
                return 1;
            }
            else
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
    public function GetCnt($wid = -1, $filter = '', $filt = '', $after_id = 0, $before_id = 0)
    {
        $sql = 'SELECT COUNT(w.id)
		FROM ' . $this -> mTbWall . ' w
		LEFT JOIN ' . $this -> mTbWards . ' wrd ON ( wrd.id = (SELECT wid FROM ' . $this -> mTbWall . ' WHERE id = w.is_copy_mes))
                , ' . $this -> mTbUsers . ' u, ' . $this -> mTbWallPrivacy . ' p
		WHERE w.wid = ? AND u.uid = w.uid AND p.mid = w.id AND p.wid = w.wid ';

        //$sql = 'SELECT COUNT(id) FROM '.$this -> mTbWall.' w WHERE w.wid = ?';
        if ($filter)
        {
            $sql .= ' AND ' . $filter;
        }
        $sq_f = $this -> _initFilts($filt);

        if ($after_id)
        {
            $sql .= ' AND w.id < ' . (int) $after_id;
        }
        if ($before_id)
        {
            $sql .= ' AND w.id >= ' . (int) $before_id;
        }

        $sql .= $sq_f ? ' AND (' . $sq_f . ')' : '';

        return $this -> mDb -> getOne($sql, array($wid));
    }

    /* GetCnt */

    /* Get count of Answers in the Message
	 * 
	 * @param $mid -  ID (-1)
	 * @param $uid - user's or group's ID (-1)
	 * @return wall info
    */
    public function GetAnswCnt($mid)
    {
        return $this -> mDb -> getOne('SELECT COUNT(id) FROM ' . $this -> mTbWallAnsw . ' WHERE mid = ?', array($mid));
    }

    /* GetAnswCnt */


    /* Get Message's list
     *
     * @param $cur_uid - current user's ID
     * @param $first - first message (-1)
     * @param $cnt - count of parsing messages (-1)
     * @param $order - order by message (-1)
     * @param $filt - filtering array (privacy)
     * @return current user's Messages & Answers List
    */
    public function GetList($wid, $first = -1, $cnt = -1, $order = -1, $filter = '', $filt = array(), $after_id = 0, $before_id = 0, $only_id = 0)
    {
        $sql = 'SELECT w.*, u.email, u.first_name, u.last_name, u.image, u.fpath, p.ptype, p.stype, p.pclass, COUNT(wa.id) AS cnt_answ, wrd.title as ward_from, wrd.id as ward_from_id
				FROM ' . $this -> mTbWall . ' w LEFT JOIN ' . $this->mTbWallAnsw . ' wa ON (w.id = wa.mid)
				LEFT JOIN ' . $this -> mTbWards . ' wrd ON ( wrd.id = (SELECT wid FROM ' . $this -> mTbWall . ' WHERE id = w.is_copy_mes))
                , ' . $this -> mTbUsers . ' u, ' . $this -> mTbWallPrivacy . ' p
		WHERE w.wid = ? AND u.uid = w.uid AND p.mid = w.id AND p.wid = w.wid ';

        if ($filter)
        {
            $sql .= ' AND ' . $filter;
        }

        $sq_f = $this -> _initFilts($filt);

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

        $sql .= $sq_f ? ' AND (' . $sq_f . ')' : '';

        $sql .= ' GROUP BY w.id';

        if (-1 != $order)
            $sql .= ' ORDER BY ' . $order;
        else
            $sql .= ' ORDER BY w.pdate DESC';

        $ar_q = array($wid); //query array


        if (-1 != $first && -1 != $cnt)
        {
            $db = $this -> mDb -> limitQuery($sql, $first, $cnt, $ar_q);
        }
        else
        {
            $db = $this -> mDb -> query($sql, $ar_q);
        }

        //deb($this -> mDb);

        $r = array();
        $j = 0;
        $this -> mMesgAr = array();
        while ($ar_f = $db -> fetchRow())
        {
            //smiles
            if (!empty($ar_f['story']))
            {
               $this->moSmiles->FindSmile($ar_f['story']);
            }

            $r[$j] = $ar_f;
            $r[$j]['answers'] = $this -> GetAnswList($ar_f['id'], 0, 2);
            $r[$j]['wtype'] = $this -> wtype;

            $this -> mMesgAr[] = $ar_f['id'];
            //$this -> ChckExFavTag( $r[$j]['id'], $r[$j]['fpath'], 3 ) ? $r[$j]['my_fav'] = 1 : $r[$j]['my_fav'] = 0;
            $j++;
        }
        //deb($r);
        return $r;
    }

    /* GetList */


    public function GetCurrentMesgAr()
    {
        return $this -> mMesgAr;
    }

    /** GetCurrentMesgAr */


    /*
     * Get first message in list
     */
    public function GetFirstMessageId($wid, $first = -1, $cnt = -1, $order = -1, $filter = '', $filt = array())
    {
        $sql = 'SELECT w.id
		FROM ' . $this -> mTbWall . ' w, ' . $this -> mTbUsers . ' u, ' . $this -> mTbWallPrivacy . ' p
		WHERE w.wid = ? AND u.uid = w.uid AND p.mid = w.id AND p.wid = w.wid ';

        if ($filter)
        {
            $sql .= ' AND ' . $filter;
        }
        $sq_f = $this -> _initFilts($filt);

        $sql .= $sq_f ? ' AND (' . $sq_f . ')' : '';

        if ($filter)
        {
            $sql .= ' AND ' . $filter;
        }

        $sq_f = $this -> _initFilts($filt);
        $sql .= $sq_f ? ' AND (' . $sq_f . ')' : '';

        $sql .= ' GROUP BY w.id ORDER BY w.id ASC LIMIT 1';
        return $this -> mDb -> getOne($sql, array($wid));
    }


    /* Get One Message
	 * 
	 * @param $id - Message ID
	 * @param $filt - filtering array (privacy)
	 * @return current answeres of Message
    */
    public function GetOne($id, $uid, $filt = array())
    {
        $sql = 'SELECT w.*, u.email, u.first_name, u.last_name, u.image, u.fpath, p.ptype, p.stype, p.pclass
		FROM ' . $this -> mTbWall . ' w, ' . $this -> mTbUsers . ' u, ' . $this -> mTbWallPrivacy . ' p
		WHERE w.id = ? AND u.uid = w.uid AND p.mid = w.id AND p.wid = w.wid';

        $sq_f = $this -> _initFilts($filt);
        $sql .= $sq_f ? ' AND (' . $sq_f . ')' : '';

        $res = array();
        $res = $this -> mDb -> getRow($sql, array($id));
        if (!empty($res))
        {
            $res['my_fav'] = $this -> ChckExFavTag($res['id'], $uid, 3) ? 1 : 0;
            $res['wtype'] = $this -> wtype;
        }
        return $res;
    }

    /* GetOne */


    public function CheckMessageVideoAccess($video_code_id, $filt = array(), $uid)
    {
        $sql = 'SELECT w.id
				FROM ' . $this -> mTbWall . ' w
				LEFT JOIN ' . $this -> mTbWards . ' wrd ON ( wrd.id = (SELECT wid FROM ' . $this -> mTbWall . ' WHERE id = w.is_copy_mes))
                , ' . $this -> mTbUsers . ' u, ' . $this -> mTbWallPrivacy . ' p
		WHERE w.v_code_id = ? AND u.uid = w.uid AND p.mid = w.id AND p.wid = w.wid ';

        $sq_f = $this->_initFilts($filt);
        $sql .= $sq_f ? ' AND ( ' . $sq_f . ') ' : '';
        $sql .= ' LIMIT 1';

        $res = $this->mDb->getOne($sql, array($video_code_id));
        return $res;
    }


    public function CheckMessagePhotoAccess($photo_id, $filt = array(), $uid)
    {
        $sql = 'SELECT w.id
				FROM ' . $this -> mTbWall . ' w
				LEFT JOIN ' . $this -> mTbWards . ' wrd ON ( wrd.id = (SELECT wid FROM ' . $this -> mTbWall . ' WHERE id = w.is_copy_mes))
                , ' . $this -> mTbUsers . ' u, ' . $this -> mTbWallPrivacy . ' p
		WHERE (w.p_img_1_id = ? OR w.p_img_2_id = ? OR w.p_img_3_id = ?) AND u.uid = w.uid AND p.mid = w.id AND p.wid = w.wid ';

        $sq_f = $this->_initFilts($filt);
        $sql .= $sq_f ? ' AND ( ' . $sq_f . ') ' : '';
        $sql .= ' LIMIT 1';

        $res = $this->mDb->getOne($sql, array($photo_id, $photo_id, $photo_id));
        return $res;
    }


    public function GetOneByUID($uid, $wid, $filt = array())
    {
        $sql = 'SELECT w.*
				FROM ' . $this -> mTbWall . ' w, ' . $this -> mTbWallPrivacy . ' p
				WHERE w.uid = ? AND wid = ? ';
        return $this -> mDb -> getRow($sql, array($uid, $wid));
    }

    /* GetOneByUID */

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
        $sql = 'SELECT wa.*, u.email, u.first_name, u.last_name, u.image, u.fpath
				FROM ' . $this -> mTbWallAnsw . ' wa
				LEFT JOIN ' . $this -> mTbUsers . ' u ON ( u.uid = wa.uid )
				WHERE wa.mid = ?';
        if (-1 != $order)
            $sql .= ' ORDER BY ' . $order;
        else
            $sql .= ' ORDER BY wa.pdate DESC';
        $ar_q = array($mid); //query array
        if (-1 != $first && -1 != $cnt)
            $db = $this -> mDb -> limitQuery($sql, $first, $cnt, $ar_q);
        else
            $db = $this -> mDb -> query($sql, $ar_q);
        $r = array();
        while ($ar_f = $db -> fetchRow())
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

    /* GAList */

    /* Get One Answer in Message
	 * 
	 * @param $id - Answer ID
	 * @return current answeres of Message
    */
    public function GetAnswOne($id)
    {
        $sql = 'SELECT wa.*, u.email, u.first_name, u.last_name, u.image, u.fpath
				FROM ' . $this -> mTbWallAnsw . ' wa
				LEFT JOIN ' . $this -> mTbUsers . ' u ON ( u.uid = wa.uid )
				WHERE wa.id = ?';
        return $this -> mDb -> getRow($sql, array($id));
    }

    /* GetAnswOne */

    public function GetCntWUsers($id, $first = -1, $cnt = -1, $order = -1)
    {
        return $this -> mDb -> getOne('SELECT COUNT(u.uid)
				FROM ' . $this -> mTbUsers . ' u
				WHERE u.ward_id = ? OR stake_id = ? ', array($id, $id));
    }

    /* GetCntWUsers */

    public function GetWUsers($id, $first = -1, $cnt = -1, $order = -1)
    {
        $sql = 'SELECT u.uid, u.email, u.first_name, u.last_name, u.image, u.fpath, u.notify_ward
				FROM ' . $this -> mTbUsers . ' u
				WHERE u.ward_id = ? OR stake_id = ? ';
        if (-1 != $order)
            $sql .= ' ORDER BY ' . $order;
        else
            $sql .= ' ORDER BY u.uid DESC';
        $ar_q = array($id, $id);
        if (-1 != $first && -1 != $cnt)
            $db = $this -> mDb -> limitQuery($sql, $first, $cnt, $ar_q);
        else
            $db = $this -> mDb -> query($sql, $ar_q);
        $r = array();
        while ($ar_f = $db -> fetchRow())
        {
            $r[] = $ar_f;
        }
        return $r;
    }

    /* GetWUsers */


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
            $sql = 'INSERT INTO ' . $this -> mTbWall . ' ( ' . join(' ,', $ar_k) . ', pdate )
					VALUES ( ' . gen_plh($ar_k, 0) . ', NOW() )';

            $this -> mDb -> query($sql, $ar_v);
            return $this -> mDb -> getOne('SELECT LAST_INSERT_ID()');
        }
        else
        {
            $sql = 'UPDATE ' . $this -> mTbWall . ' SET ' . gen_plh($ar_k, 1) . '
					WHERE id = ?';

            $ar_v = array_merge($ar_v, array($id));
            $this -> mDb -> query($sql, $ar_v);
        }
    }

    /* Edit */

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
            $sql = 'INSERT INTO ' . $this -> mTbWallAnsw . ' ( ' . join(' ,', $ar_k) . ', pdate )
					VALUES ( ' . gen_plh($ar_k, 0) . ', NOW() )';

            $this -> mDb -> query($sql, $ar_v);
            return $this -> mDb -> getOne('SELECT LAST_INSERT_ID()');
        }
        else
        {
            $sql = 'UPDATE ' . $this -> mTbWallAnsw . ' SET ' . gen_plh($ar_k, 1) . '
					WHERE id = ?';

            $ar_v = array_merge($ar_v, array($id));
            $this -> mDb -> query($sql, $ar_v);
        }
    }

    /* EditAnsw */

    /* Add & Edit Message Privacy
	 * 
	 * @param $ptype - privacy type 
	 * @param $mid - Message ID 
	 * @param $uid - user's ID 
	 * @return if Add - LID, else - void 
    */
    public function EditPrivacy($ptype, $mid, $wid, $uwid, $stype, $pclass = 0)
    {
        $privacy = $this -> mDb -> getOne('SELECT ptype FROM ' . $this -> mTbWallPrivacy . ' WHERE mid = ? AND wid = ?', array($mid, $wid));
        if (!isset($privacy))
        {
            $sql = 'INSERT INTO ' . $this -> mTbWallPrivacy . ' ( ptype, mid, wid, uwid, stype, pclass )
					VALUES ( ?, ?, ?, ?, ?, ? )';
            $this -> mDb -> query($sql, array($ptype, $mid, $wid, $uwid, $stype, $pclass));
            return $this -> mDb -> getOne('SELECT LAST_INSERT_ID()');
        }
        else
        {
            $sql = 'UPDATE ' . $this -> mTbWallPrivacy . ' SET ptype = ?, uwid = ? stype = ?, pclass = ?
					WHERE mid = ? AND wid = ?';
            $this -> mDb -> query($sql, array($ptype, $uwid, $stype, $pclass, $mid, $wid));
        }
    }

    /* EditPrivacy */


    //----DELETE METHODS

    public function Del($id, $uid)
    {
        $ex = $this->mDb->getRow('SELECT w.id FROM ' . $this->mTbWall . ' w
				  WHERE w.id = ? AND w.uid = ?', array($id, $uid));

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
            return true;
        }
        return false;

    }

    /* Del */


    public function DelAnsw($mid)
    {
        $sql = 'DELETE FROM ' . $this -> mTbWall . ' WHERE id = ?';
        $this -> mDb -> query($sql, $id);
    }

    /* DelAnsw */

    //-- ADDITIONAL METHODS

    public function GetCntListByFilt($fpar = array(), $fval = array(), $filt = array(), $ar_filt_par = array(), $ar_filt_val = array(), $uid = 0)
    {
        $tb_ind = 1;
        $r = array();

        $sql = 'SELECT COUNT(w.id)
				    FROM ' . $this -> mTbWall . ' w
				    LEFT JOIN ' . $this->mTbUsers . ' u ON ( u.uid = w.uid )
				    RIGHT JOIN ' . $this->mTbWallPrivacy . ' p ON ( p.mid = w.id )
                    LEFT JOIN ' . $this -> mTbWards . ' wd ON (wd.id = w.wid)
				    WHERE ( ' . gen_plh($fpar, 4) . ' )';

        $sq_f = $this->_initFilts($filt, $uid);
        $sql .= $sq_f ? ' AND (' . $sq_f . ')' : '';

        if (!empty($ar_filt_par) && !empty($ar_filt_par))
        {
            $sql .= ' AND ( ' . gen_plh($ar_filt_par, 3) . ' )';
            $fval = array_merge($fval, $ar_filt_val);
        }

        $r = $this->mDb->getOne($sql, $fval);
        return $r;
    }


    /**
     * Get wards messages by filter
     * @param array $what
     * @param array $fpar
     * @param array $fval
     * @param  $sort
     * @param int $first
     * @param int $cnt
     * @param array $filt
     * @param array $ar_filt_par
     * @param array $ar_filt_val
     * @param int $uid
     * @return array
     */
    public function GetListByFilt($what = array(), $fpar = array(), $fval = array(), $sort = -1, $first = 0, $cnt = 0, $filt = array(), $ar_filt_par = array(), $ar_filt_val = array(), $uid = 0)
    {
        $tb_ind = 1;
        $r = array();

        $sql = 'SELECT ' . join(', ', $what) . ' , u.email, u.first_name, u.last_name, u.image, u.fpath, wd.title as ward_name
		        FROM ' . $this->mTbWall . ' w
		        LEFT JOIN ' . $this->mTbUsers . ' u ON (u.uid = w.uid)' .
                ' RIGHT JOIN ' . $this->mTbWallPrivacy . ' p ON ( p.mid = w.id )' .
                ' LEFT JOIN ' . $this->mTbWards . ' wd ON (wd.id = w.wid)
	        	WHERE ( ' . gen_plh($fpar, 3) . ' )';

        $sq_f = $this -> _initFilts($filt);
        $sql .= $sq_f ? ' AND (' . $sq_f . ')' : '';

        if (!empty($ar_filt_par) && !empty($ar_filt_par))
        {
            $sql .= ' AND ( ' . gen_plh($ar_filt_par, 2) . ' )';
            $fval = array_merge($fval, $ar_filt_val);
        }

        if (-1 != $sort)
        {
            $sql .= ' ORDER BY ' . $sort;
        }
        else
        {
            $sql .= ' ORDER BY w.pdate DESC';
        }

        if ($cnt)
            $db = $this -> mDb -> limitQuery($sql, $first, $cnt, $fval);
        else
            $db = $this -> mDb -> query($sql, $fval);

        while ($ar_f = $db -> fetchRow())
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

    /* GetListByFilt */


    public function GetUrlTitle($url)
    {
        $url = ToLower($url);
        $url = str_replace('http://', '', $url);
        return $this -> mDb -> getOne('SELECT title FROM ' . $this->mTbUrlTitles . ' WHERE LOWER(link)=?', array(ToLower($url)));
    }

    /** GetUrlTitle */


    public function EditUrlTitle($url, $title)
    {
        $url = ToLower($url);
        $url = str_replace('http://', '', $url);
        $this -> mDb -> query('INSERT INTO ' . $this -> mTbUrlTitles . ' (link, title, pdate) VALUES(?, ?, ?)', array(ToLower($url), $title, mktime()));
        return true;
    }
    /** EditUrlTitle */


}

/* Model_Wards_Wall */
?>