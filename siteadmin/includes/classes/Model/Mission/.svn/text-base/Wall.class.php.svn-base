<?php
/**
 * Mission's Wall model
 * @package    5dev Catalog
 * @version    1.0
 * @since      30.03.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */
class Model_Mission_Wall
{
    //system params
    private $mDb;

    //tables
    private $mTbMissions;
    private $mTbUsersMissions;
    private $mTbWall;
    private $mTbWallAnsw;
    private $mTbWallPrivacy;
    private $mTbUrlTitles;
    private $mTbUsersTags;
    private $mTbUsersTagsM;
    private $mTbUsers;

    /**
     * Message ID arrays
     * @var array
     */
    private $mMesgAr;

    private $wtype;

    /**
     * Constructor
     *
     * @param $glObj
     */
    public function __construct( &$gDb )
    {
        //'CAN_WRITE'
        //wall's tables
        $this -> mDb          	  =& $gDb;
        $this -> mTbMissions      =  TB.'mission';
        $this -> mTbUsersMissions =  TB.'users_mission';
        $this -> mTbWall      	  =  TB.'mission_wall';
        $this -> mTbWallAnsw   	  =  TB.'mission_wall_answ';
        $this -> mTbWallPrivacy   =  TB.'mission_wall_privacy';

        //tags tables
        $this -> mTbUsersTags    = TB . 'users_tags';
        $this -> mTbUsersTagsM   = TB . 'users_tags_mes';

        //users tables
        $this -> mTbUsers      	 =  TB.'users';
        $this -> mTbUrlTitles    = TB . 'url_titles';

        //init smiles
        require_once 'Model/Profile/Smile.class.php';
        $this->moSmiles = new Model_Profile_Smile();

        $this -> wtype = 2;
    }/* __construct */
    

    //----SYSTEM METHODS
    public function GetWtype()
    {
        return $this -> wtype;
    }
    //Get names of the columns of Table Wall
    public function GetCols(  )
    {
        $sql = "SHOW COLUMNS FROM ".$this -> mTbWall;
        $db = $this -> mDb -> query( $sql );
        while ($ar_f = $db -> fetchRow())
        {
            $r[]= $ar_f['Field'];
        }
        return array_values($r);
    }/** GetColumns */

    //Get names of the Answer columns of Table
    public function GetAnswCols(  )
    {
        $sql = "SHOW COLUMNS FROM ".$this -> mTbWallAnsw;
        $db = $this -> mDb -> query( $sql );
        while ($ar_f = $db -> fetchRow())
        {
            $r[]= $ar_f['Field'];
        }
        return array_values($r);
    }/* GetAnswCols */

    
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
                    WHERE tm.mid IN ('.implode(', ', $mid).') AND tm.uid = ?
                    AND tm.wtype = ? AND tm.tid = t.id AND t.type = 2';
            $db  = $this -> mDb -> query($sql, array($uid, $wtype));
            $r   = array();
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
    }/* ChckExFavTag */



    //----GET METHODS

    /* Get count of Messages on the Wall
	 * 
	 * @param $uid - user's or groups ID (-1)
	 * @return wall info
    */
    public function GetCnt( $mission_id = -1, $filt = array(), $str_filter = -1, $after_id = 0, $before_id = 0 )
    {
        $sql = 'SELECT COUNT(id) FROM '.$this -> mTbWall.' w WHERE w.mission_id = ?';
        if (-1 != $str_filter)
        {
            $sql .= ' AND '.$str_filter;
        }
        
        if ($after_id)
        {
            $sql .= ' AND w.id < '.(int)$after_id;
        }
        if ($before_id)
        {
            $sql .= ' AND w.id >= '.(int)$before_id;
        }

        return $this -> mDb -> getOne( $sql, $mission_id );
    }/* GetCnt */

    /* Get count of Answers in the Message
	 * 
	 * @param $mission_id -  ID (-1)
	 * @param $uid - user's or group's ID (-1)
	 * @return wall info
    */
    public function GetAnswCnt( $mid )
    {
        return $this -> mDb -> getOne('SELECT COUNT(id) FROM '.$this -> mTbWallAnsw.' WHERE mid = ?', array( $mid ));
    }/* GetAnswCnt */
    

    /* Get Message's list
	 * 
	 * @param $cur_uid - current user's ID
	 * @param $first - first message (-1)
	 * @param $cnt - count of parsing messages (-1)
	 * @param $order - order by message (-1)
	 * @param $filt - filtering array (privacy)
	 * @return current user's Messages & Answers List
    */
    public function GetList( $mission_id, $first = -1, $cnt = -1, $order = -1, $filt = array(), $str_filter = -1, $after_id = 0, $before_id = 0, $only_id = 0 )
    {
        $sql = 'SELECT w.*, u.email, u.first_name, u.last_name, u.image, u.fpath,
                COUNT(wa.id) AS cnt_answ
		FROM '.$this -> mTbWall.' w  LEFT JOIN '.$this->mTbWallAnsw.' wa ON (w.id = wa.mid)
                , '.$this -> mTbUsers.' u
		WHERE w.mission_id = ? AND u.uid = w.uid ';

        if (-1 != $str_filter)
            $sql .= ' AND '.$str_filter;

        if ($after_id)
        {
            $sql .= ' AND w.id < '.(int)$after_id;
        }
        if ($before_id)
        {
            $sql .= ' AND w.id >= '.(int)$before_id;
        }
        if ($only_id)
        {
            $sql .= ' AND w.id = '.(int)$only_id;
        }


        $sql .= ' GROUP BY w.id';

        if (-1 != $order)
            $sql .= ' ORDER BY '.$order;
        else
            $sql .= ' ORDER BY w.pdate DESC';

        $ar_q = array($mission_id);	//query array
        if (-1 != $first && -1 != $cnt)
            $db = $this -> mDb -> limitQuery( $sql, $first, $cnt, $ar_q );
        else
            $db = $this -> mDb -> query( $sql, $ar_q );
        $r = array();
        $j = 0;

        //print_r($this -> mDb -> last_query).'<br />';

        $this -> mMesgAr = array();
        while ($ar_f = $db -> fetchRow())
        {
            //smiles
            if (!empty($ar_f['story']))
            {
               $this->moSmiles->FindSmile($ar_f['story']);
            }

            $r[$j] = $ar_f;
            if ($ar_f['cnt_answ'])
            {
                $r[$j]['answers'] = $this -> GetAnswList( $ar_f['id'], 0, 2 );
            }
            $this -> mMesgAr[] = $ar_f['id'];
            //$this -> ChckExFavTag( $r[$j]['id'], $r[$j]['fpath'], 2 ) ? $r[$j]['my_fav'] = 1 : $r[$j]['my_fav'] = 0;
            $j++;
        }
        return $r;
    }/* GetList */


    public function GetCurrentMesgAr()
    {
        return $this -> mMesgAr;
    }/** GetCurrentMesgAr */


    /*
     * Get first message in list
     */
    public function GetFirstMessageId($mission_id, $first = -1, $cnt = -1, $order = -1, $filt = array(), $str_filter = -1)
    {
        $sql = 'SELECT w.*
		FROM ' . $this->mTbWall . ' w, ' . $this->mTbUsers . ' u
		WHERE w.mission_id = ? AND u.uid = w.uid ';

        if (-1 != $str_filter)
            $sql .= ' AND ' . $str_filter;

        $sql .= ' GROUP BY w.id ORDER BY w.id ASC LIMIT 1';
        return $this -> mDb -> getOne($sql, array($mission_id));
    }


    /* Get One Message
	 * 
	 * @param $id - Message ID
         * @param $uid - user ID
	 * @return current answeres of Message
    */
    public function GetOne( $id, $uid )
    {
        $sql = 'SELECT w.*, u.email, u.first_name, u.last_name, u.image, u.fpath
		FROM '.$this -> mTbWall.' w, '.$this -> mTbUsers.' u  
		WHERE w.id = ? AND u.uid = w.uid ';

        $res = array();
        $res =  $this -> mDb -> getRow( $sql, array( $id ) );
        $res['my_fav'] = $this -> ChckExFavTag( $res['id'], $uid, 2 ) ? 1 : 0;
        return $res;
    }/* GetOne */

    public function GetOneByUID( $uid, $mission_id, $filt = array() )
    {
        $sql = 'SELECT w.*
				FROM '.$this -> mTbWall.' w, '.$this -> mTbWallPrivacy.' p 
				WHERE w.uid = ? AND w.mission_id = ? ';
        return $this -> mDb -> getRow( $sql, array( $uid, $mission_id ) );
    }/* GetOneByUID */

    /* Get Answers list
	 * 
	 * @param $mid - Message ID
	 * @param $first - first message (-1)
	 * @param $cnt - count of parsing messages (-1)
	 * @param $order - order by message (-1)
	 * @return current answeres of Message
    */
    public function GetAnswList( $mid, $first = -1, $cnt = -1, $order = -1 )
    {
        $sql = 'SELECT wa.*, u.email, u.first_name, u.last_name, u.image, u.fpath
				FROM '.$this -> mTbWallAnsw.' wa 
				LEFT JOIN '.$this -> mTbUsers.' u ON ( u.uid = wa.uid )
				WHERE wa.mid = ?';
        if (-1 != $order)
            $sql .= ' ORDER BY '.$order;
        else
            $sql .= ' ORDER BY wa.pdate DESC';
        $ar_q = array($mid);	//query array
        if (-1 != $first && -1 != $cnt)
            $db = $this -> mDb -> limitQuery( $sql, $first, $cnt, $ar_q );
        else
            $db = $this -> mDb -> query( $sql, $ar_q );
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
    }/* GAList */

    /* Get One Answer in Message
	 * 
	 * @param $id - Answer ID
	 * @return current answeres of Message
    */
    public function GetAnswOne( $id )
    {
        $sql = 'SELECT wa.*, u.email, u.first_name, u.last_name, u.image, u.fpath
				FROM '.$this -> mTbWallAnsw.' wa
				LEFT JOIN '.$this -> mTbUsers.' u ON ( u.uid = wa.uid )
				WHERE wa.id = ?';
        return $this -> mDb -> getRow( $sql, array( $id ) );
    }/* GetAnswOne */



    //----EDIT METHODS

    /* Add & Edit Message
	 * 
	 * @param $id - Message ID
	 * @param $ar_k - array with keys of editing data
	 * @param $ar_v - array with values of editing data
	 * @return insert - Last Message ID; update - void;
    */
    public function Edit( $id, $ar_k = array(), $ar_v = array() )
    {
        if (empty($id))
        {
            $sql = 'INSERT INTO '.$this -> mTbWall.' ( '.join(' ,', $ar_k).', pdate )
					VALUES ( '.gen_plh($ar_k, 0).', NOW() )';

            $this -> mDb -> query( $sql, $ar_v );
            return $this -> mDb -> getOne( 'SELECT LAST_INSERT_ID()' );
        }
        else
        {
            $sql = 'UPDATE '.$this -> mTbWall.' SET '.gen_plh($ar_k, 1).'
					WHERE id = ?';

            $ar_v = array_merge($ar_v, array( $id ));
            $this -> mDb -> query($sql, $ar_v);
        }
    }/* Edit */

    public function EditLocalMes( $mission_id, $uid, $ltype, $story )
    {
        $ex = $this -> mDb -> getRow( 'SELECT id, pdate FROM '.$this -> mTbWall.' WHERE mission_id = ? AND uid = ? AND ltype = ? ', array( $mission_id, $uid, $ltype ) );
        if (empty($ex))
        {
            $sql = 'INSERT INTO '.$this -> mTbWall.' ( mission_id, uid, ltype, story, pdate )
					VALUES ( ?, ?, ?, ?, NOW() )';

            $this -> mDb -> query( $sql, array( $mission_id, $uid, $ltype, $story ) );
            return $this -> mDb -> getOne( 'SELECT LAST_INSERT_ID()' );
        }
        else
        {
            $sql = 'UPDATE '.$this -> mTbWall.' SET mission_id = ?, uid = ?, ltype = ?, story = ? '.( 0 > (strtotime($ex['pdate']) - strtotime('now - 1minute')) ? ', pdate = NOW()' : '' ).'
					WHERE id = ?';

            $ar_v = array( $mission_id, $uid, $ltype, $story, $ex['id'] );
            $this -> mDb -> query($sql, $ar_v);
        }
    }/* EditLocalMes */

    /* Add & Edit Message
	 * 
	 * @param $id - Answer ID
	 * @param $ar_k - array with keys of editing data
	 * @param $ar_v - array with values of editing data
	 * @return insert - Last Message ID; update - void;
    */
    public function EditAnsw( $id, $ar_k = array(), $ar_v = array() )
    {
        if (!$id)
        {
            $sql = 'INSERT INTO '.$this -> mTbWallAnsw.' ( '.join(' ,', $ar_k).', pdate )
					VALUES ( '.gen_plh($ar_k, 0).', NOW() )';

            $this -> mDb -> query( $sql, $ar_v );
            return $this -> mDb -> getOne( 'SELECT LAST_INSERT_ID()' );
        }
        else
        {
            $sql = 'UPDATE '.$this -> mTbWallAnsw.' SET '.gen_plh($ar_k, 1).'
					WHERE id = ?';

            $ar_v = array_merge($ar_v, array( $id ));
            $this -> mDb -> query($sql, $ar_v);
        }
    }/* EditAnsw */

    /* Add & Edit Message Privacy
	 * 
	 * @param $ptype - privacy type 
	 * @param $mid - Message ID 
	 * @param $uid - user's ID 
	 * @return if Add - LID, else - void 
    */
    public function EditPrivacy( $ptype, $mid, $uvid )
    {
        $privacy = $this -> mDb -> getOne('SELECT ptype FROM '.$this -> mTbWallPrivacy.' WHERE mid = ?', array( $mid ));
        if (!isset($privacy))
        {
            $sql = 'INSERT INTO '.$this -> mTbWallPrivacy.' ( ptype, mid, uvid )
					VALUES ( ?, ?, ? )';
            $this -> mDb -> query( $sql, array( $ptype, $mid, $uvid ) );
            return $this -> mDb -> getOne( 'SELECT LAST_INSERT_ID()' );
        }
        else
        {
            $sql = 'UPDATE '.$this -> mTbWallPrivacy.' SET ptype = ?, uvid = ?
					WHERE mid = ?';
            $this -> mDb -> query($sql, array( $ptype, $uvid, $mid ));
        }
    }/* EditPrivacy */


    //----DELETE METHODS

    public function Del( $id, $uid )
    {
        $ex = $this->mDb->getRow('SELECT w.id FROM ' . $this->mTbWall . ' w
				  WHERE w.id = ? AND w.uid = ?', array($id, $uid));

        if ($ex || IS_USER)
        {
            $this->mDb->query('DELETE FROM ' . $this->mTbWallAnsw . ' WHERE mid = ?', array($id));

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
            $this->mDb->query('DELETE FROM ' . $this -> mTbWall . ' WHERE id = ?', array($id));
            return true;
        }
        return false;
    }/* Del */
    

    public function DelAnsw( $mid )
    {
        $sql = 'DELETE FROM '.$this -> mTbWall.' WHERE id = ?';
        $this -> mDb -> query( $sql, $id );
    }/* DelAnsw */

    //-- ADDITIONAL METHODS

    public function GetCntListByFilt($fpar = array(), $fval = array(), $filt = '', $ar_filt_par = array(), $ar_filt_val = array(), $uid = 0)
    {
        $tb_ind = 1;
        $r = array();

        $sql = 'SELECT COUNT(w.id)
	        FROM '.$this -> mTbWall.' w
		LEFT JOIN ' . $this->mTbUsers . ' u ON ( u.uid = w.uid )
                LEFT JOIN '.$this -> mTbMissions.' m ON (m.id = w.mission_id)
		LEFT JOIN '.$this -> mTbUsersMissions.' um ON (um.id = m.id)
		WHERE ( ' . gen_plh($fpar, 4) . ' )';
        
        /*$sq_f = $this->_initFilts($filt, $uid);
        $sql .= $sq_f ? ' AND (' . $sq_f . ')' : '';*/
        
        if (!empty($ar_filt_par) && !empty($ar_filt_par))
        {
            $sql .= ' AND ( ' . gen_plh($ar_filt_par, 3) . ' )';
            $fval = array_merge($fval, $ar_filt_val);
        }

		if($filt)
        {
            $sql .= ' AND ' . $filt;
        }
        
        $r = $this->mDb->getOne($sql, $fval);
		//deb($filt);
		//deb($this -> mDb -> last_query);
        return $r;
    }
    
    /* GetCntListByFilt */

    public function GetListByFilt($what = array(), $fpar = array(), $fval = array(), $sort = -1, $first = 0, $cnt = 0, $filt = array(), $ar_filt_par = array(), $ar_filt_val = array(), $uid = 0, $filter = '')
    {
		//deb($h = array('what' => $what, 'fpar' => $fpar, 'fval' => $fval, 'sort' => $sort, 'first' => $first, 'cnt' => $cnt, 'filt' => $filt, 			'ar_filt_par' => $ar_filt_par, 'ar_filt_val' => $ar_filt_val, 'uid' => $uid, 'filter'=> $filter));
        $tb_ind = 1;
        $r = array();

        $sql = 'SELECT '.join(', ', $what).' , u.email, u.first_name, u.last_name, u.image, u.fpath, m.title as mission_name
					FROM '.$this -> mTbWall.' w
				    LEFT JOIN '.$this -> mTbUsers.' u ON (u.uid = w.uid)
					LEFT JOIN '.$this -> mTbMissions.' m ON (m.id = w.mission_id)
					LEFT JOIN '.$this -> mTbUsersMissions.' um ON (um.id = m.id)
                    ';
        
        $sql .= 'WHERE ( '.gen_plh($fpar, 3).' )'; 
        if($filter)
        {
            $sql .= ' AND ' . $filter;
        }

        if (!empty($ar_filt_par) && !empty($ar_filt_par))
        {
            $sql .= ' AND ( ' . gen_plh($ar_filt_par, 2) . ' )';
            $fval = array_merge($fval, $ar_filt_val);
        }

        if (-1 != $sort)
            $sql .= ' ORDER BY '.$sort;
        else
            $sql .= ' ORDER BY w.pdate DESC';

        if ($cnt)
            $db = $this -> mDb -> limitQuery( $sql, $first, $cnt, $fval );
        else
            $db = $this -> mDb -> query( $sql, $fval );

		//deb($this -> mDb -> last_query);
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
    }/* GetListByFilt */


    public function GetUrlTitle($url)
    {
        $url = ToLower($url);
        $url = str_replace('http://', '', $url);
        return $this -> mDb -> getOne('SELECT title FROM '.$this->mTbUrlTitles.' WHERE LOWER(link)=?', array(ToLower($url)));
    }/** GetUrlTitle */


    public function EditUrlTitle($url, $title)
    {
        $url = ToLower($url);
        $url = str_replace('http://', '', $url);
        $this -> mDb -> query('INSERT INTO '.$this -> mTbUrlTitles.' (link, title, pdate) VALUES(?, ?, ?)', array(ToLower($url), $title, mktime()));
        return true;
    }/** EditUrlTitle */

}/* Model_Mission_Wall */
?>