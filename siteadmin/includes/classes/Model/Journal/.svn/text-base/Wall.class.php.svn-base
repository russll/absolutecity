<?php
/**
 * Journal's Wall model
 * @package    5dev Catalog
 * @version    1.0
 * @since      8.04.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */
class Model_Journal_Wall
{
    //system params
    private $mDb;

    //tables
    private $mTbWall;
    private $mTbWallAnsw;
    private $mTbWallTag;
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
    
    /**
     * Constructor
     *
     * @param $glObj
     * @param $TbPostfix
     */
    public function __construct( &$gDb )
    {
        //wall's tables
        $this -> mDb          	 =& $gDb;
        $this -> mTbWall      	 =  TB.'users_journal_wall';
        $this -> mTbWallAnsw   	 =  TB.'users_journal_wall_answ';
        $this -> mTbWallPrivacy     =  TB.'users_journal_wall_privacy';
        $this -> mTbSubscr     =  TB.'users_journal_subscr';

        //tags tables
        $this -> mTbUsersTags   = TB . 'users_tags';
        $this -> mTbUsersTagsM  = TB . 'users_tags_mes';

        //init smiles
        require_once 'Model/Profile/Smile.class.php';
        $this->moSmiles = new Model_Profile_Smile();

        //users tables
        $this -> mTbUsers      	=  TB.'users';
        $this -> mTbUrlTitles   = TB . 'url_titles';
    }/* __construct */
    

    //----SYSTEM METHODS

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


    public function GetUrlTitle($url)
    {
        $url = ToLower($url);
        $url = str_replace('http://', '', $url);
        return $this -> mDb -> getOne('SELECT title FROM '.$this->mTbUrlTitles.' WHERE LOWER(link)=?', array(ToLower($url)));
    }

    public function EditUrlTitle($url, $title)
    {
        $url = ToLower($url);
        $url = str_replace('http://', '', $url);
        $this -> mDb -> query('INSERT INTO '.$this -> mTbUrlTitles.' (link, title, pdate) VALUES(?, ?, ?)', array(ToLower($url), $title, mktime()));
        return true;
    }


    /* Init String of Filters for Requests
	 * 
	 * @param $type - type of Privacy ('')
	 * @return wall info
    */
    public function _initFilts ( $filt, $uid = 0, $psfilt = 0, $pclass = 0 )
    {
        $sq_f = '';
        
        if (!empty($filt))
        {
            foreach ($filt as $k => &$v)
            {
                if($k != 100 && $k != 101)
                {
                    $sq_f .= ( $sq_f ? ' OR ' : '') . '(p.ptype = ' . (int) $k . ' AND p.uvid '.($k == 0 ? 'NOT' : '').' IN (' . (is_array($v) ? Ar2Str($v) : ($v==0 ? '-1' : $v)) . '))';
                }
            }

            //wards
            $filt[100] = isset($filt[100]) ? (int)$filt[100] : 0;
            $filt[101] = isset($filt[101]) ? (int)$filt[101] : 0;

            if (!empty($filt[1]))
            {
                //friends and folowers
                $sq_f .= ' OR ( (p.ptype = 1) AND p.pstype = 100 AND p.uvid IN (0, '.$filt[100].') ) ';
                $sq_f .= ' OR ( (p.ptype = 1) AND p.pstype = 101 AND p.uvid IN (0, '.$filt[101].') ) ';
            }
            elseif (!empty($filt[2]))
            {
                //only for friends + friends and folowers
                $sq_f .= ' OR ( (p.ptype = 1 OR p.ptype = 2) AND p.pstype = 100 AND p.uvid IN (0, '.$filt[100].') ) ';
                $sq_f .= ' OR ( (p.ptype = 1 OR p.ptype = 2) AND p.pstype = 101 AND p.uvid IN (0, '.$filt[101].') ) ';
            }

            if((int)$uid)
            {
                $sq_f .= ' AND (w.juid = ' . (int)$uid . ') ';
            }

            //subtype
            $sq_f = ' ('.$sq_f.') ';

            if($psfilt != -1 && $pclass != -1 && (!empty($filt[1]) || !empty($filt[2]))) // $psfilt - user's priesthold, sfilt for classes - 5 !!!, wards - 100, stakes - 101
            {
                
                $sfilt = ($psfilt ? '0, 100, 101, ' . $psfilt : '0'); //add ward,stake special ids!!!
                
                //classes
                $classes = '0';
                if(count($pclass) > 0 && is_array($pclass))
                {
                    foreach($pclass as $k)
                    {
                        if($k['class_id'])
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
    }/* _initFilt */

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
            //deb($this -> mDb);
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

    public function EditSubscr($uid, $wuid)
    {
        //deb($uid);
        $ex = $this->mDb->getOne('SELECT id FROM ' . $this -> mTbSubscr . ' WHERE uid = ? AND wuid = ?', array($uid, $wuid));
        if (empty($ex))
        {
            $sql = 'INSERT INTO ' . $this -> mTbSubscr . ' ( uid, wuid, dt )
        	    VALUES ( ?, ?, NOW() )';
            $this->mDb->query($sql, array($uid, $wuid));
            return 1;
        } else
        {
            $sql = 'DELETE FROM ' . $this -> mTbSubscr . ' WHERE uid = ? AND wuid = ?';

            $this->mDb->query($sql, array($uid, $wuid));
            return 0;
        }
    }
    /* EditSubscr */

    public function GetSubscr($uid = -1, $wuid = -1, $order = -1, $limit = -1, $filt = -1, $first = 0)
    {
        $sql = 'SELECT s.*, u.email, u.first_name, u.last_name, u.image, u.fpath, u.country, u.city
    			FROM ' . $this -> mTbSubscr . ' s
    			RIGHT JOIN ' . $this->mTbUsers . ' u ON ( ' . (-1 != $wuid ? ' u.uid = s.uid ' : ' u.uid = s.wuid ' ) . ')
    			WHERE 1 ';

        if (-1 != $uid)
            $sql .= ' AND s.uid = ' . $uid;
        if (-1 != $wuid)
            $sql .= ' AND s.wuid = ' . $wuid;
        if (-1 != $filt)
            $sql .= ' AND ' . $filt;
        if (-1 != $order)
            $sql .= ' ORDER BY ' . $order;
        else
            $sql .= ' ORDER BY s.id ';

        if (-1 != $limit)
            $sql .= ' LIMIT ' . ($first ? $first .', '  : '') . $limit;

        return $this->mDb->getAll($sql);
    }
    /* GetSubscr */

    public function GetCntSubscr($wuid = -1, $uid = -1)
    {
        $sql = 'SELECT COUNT(s.id) FROM ' . $this -> mTbSubscr . ' s
                RIGHT JOIN ' . $this->mTbUsers . ' u ON ( ' . (-1 != $wuid ? ' u.uid = s.uid ' : ' u.uid = s.wuid ' ) . ' AND u.checksum = "" )
                WHERE 1 ';
        if (-1 != $wuid)
            $sql .= ' AND s.wuid = ' . $wuid;
        if (-1 != $uid)
            $sql .= ' AND s.uid = ' . $uid;
        return $this->mDb->getOne($sql);
    }
    /* GetCntSubscr */
    
    //----GET METHODS

    /* Get count of Messages on the Wall
	 * 
	 * @param $uid - user's or groups ID (-1)
	 * @return wall info
    */
    public function GetCnt( $cur_uid = -1, $filt = array(), $filter = '', $psfilt = 0, $pclass = 0, $after_id = 0, $before_id = 0 )
    {
        $sql = 'SELECT COUNT(id) FROM '.$this -> mTbWall.' w, '.$this -> mTbWallPrivacy.' p
				 WHERE p.mid = w.id';
        if (-1 != $cur_uid)
        {
            $sql .= ' AND w.juid = ?';
        }

        if ($filter)
        {
            $sql .= ' AND '.$filter;
        }

        $sq_f = $this -> _initFilts($filt, 0, $psfilt, $pclass);

        if ($after_id)
        {
            $sql .= ' AND w.id < '.(int)$after_id;
        }
        if ($before_id)
        {
            $sql .= ' AND w.id >= '.(int)$before_id;
        }
        
        $sql .= $sq_f ? ' AND ('.$sq_f.')' : '';
        return $this -> mDb -> getOne( $sql, $cur_uid );
    }
    /* GetCnt */

    /* Get count of Answers in the Message
	 * 
	 * @param $mid -  ID (-1)
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
    public function GetList( $cur_uid, $first = -1, $cnt = -1, $order = -1, $filt = array(), $filter = '', $psfilt = 0, $pclass = 0, $after_id = 0, $before_id = 0, $only_id = 0 )
    {
        $sql = 'SELECT w.*, p.ptype, p.uvid, p.pstype, p.pclass,
		        u.email, u.first_name, u.last_name, u.image, u.fpath,
		        u2.uid as uid2, u2.email AS email2, u2.first_name AS first_name2, u2.last_name AS last_name2, u2.image AS image2, u2.fpath AS fpath2,
		        u3.uid as uid3, u3.email AS email3, u3.first_name AS first_name3, u3.last_name AS last_name3, u3.image AS image3, u3.fpath AS fpath3,
                COUNT(wa.id) AS cnt_answ
		        FROM ' . $this->mTbWall . ' w LEFT JOIN ' . $this->mTbWallAnsw . ' wa ON (w.id = wa.mid)' .
                ' LEFT JOIN ' . $this->mTbUsers . ' u2 ON (u2.uid = w.juid)' .
                ' LEFT JOIN ' . $this->mTbUsers . ' u3 ON (u3.uid = (SELECT uvid FROM ' . $this->mTbWallPrivacy . ' WHERE mid = w.id))' .
                ', ' . $this->mTbWallPrivacy . ' p, ' . $this->mTbUsers . ' u' .
                ' WHERE w.juid = ? AND p.mid = w.id AND u.uid = w.uid' .
                '';
        if ($filter)
        {
            $sql .= ' AND '.$filter;
        }

        $sq_f = $this -> _initFilts($filt, 0, $psfilt, $pclass);

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

        $sql .= $sq_f ? ' AND ( (' . $sq_f . ') ' . ($filt[0] ? 'OR w.uid = ' . $filt[0] : '' ) . ')' : ''; // $filt[0] - uid of viewer
        $sql .= ' GROUP BY w.id';

        if (-1 != $order)
        {
            $sql .= ' ORDER BY '.$order;
        }
        else
        {
            $sql .= ' ORDER BY w.pdate DESC';
        }
        //echo $sql;die;
        $ar_q = array($cur_uid);	//query array
        if (-1 != $first && -1 != $cnt)
        {
            $db = $this -> mDb -> limitQuery( $sql, $first, $cnt, $ar_q );
        }
        else
        {
            $db = $this -> mDb -> query( $sql, $ar_q );
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
            if ($ar_f['cnt_answ'])
            {
                $r[$j]['answers'] = $this -> GetAnswList( $ar_f['id'], 0, 2 );
            }
            $this -> mMesgAr[] = $ar_f['id'];
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
    public function GetFirstMessageId($cur_uid, $first = -1, $cnt = -1, $order = -1, $filt = array(), $filter = '', $psfilt = 0, $pclass = 0)
    {
        $sql = 'SELECT w.id FROM ' . $this->mTbWall . ' w , ' . $this->mTbWallPrivacy . ' p, ' . $this->mTbUsers . ' u' .
                ' WHERE w.juid = ? AND p.mid = w.id AND u.uid = w.uid';
        if ($filter)
        {
            $sql .= ' AND ' . $filter;
        }

        $sq_f = $this->_initFilts($filt, 0, $psfilt, $pclass);

        $sql .= $sq_f ? ' AND ( (' . $sq_f . ') ' . ($filt[0] ? 'OR w.uid = ' . $filt[0] : '' ) . ')' : ''; // $filt[0] - uid of viewer
        $sql .= ' GROUP BY w.id ORDER BY w.id ASC LIMIT 1';
        return $this -> mDb -> getOne($sql, array($cur_uid));
    }


    /* Get One Message
	 * 
	 * @param $id - Message ID
	 * @param $filt - filtering array (privacy)
	 * @return current answeres of Message
    */
    public function GetOne( $id, $filt = array(), $uid = 0, $psfilt = 0, $pclass = 0 )
    {
        $sql = 'SELECT w.*, p.ptype, p.uvid, p.pstype, p.pclass,
		        u.email, u.first_name, u.last_name, u.image, u.fpath,
	         	u2.email AS email2, u2.first_name AS first_name2, u2.last_name AS last_name2, u2.image AS image2, u2.fpath AS fpath2,
		        u3.uid as uid3, u3.email AS email3, u3.first_name AS first_name3, u3.last_name AS last_name3, u3.image AS image3, u3.fpath AS fpath3
	         	FROM ' . $this->mTbWall . ' w
                LEFT JOIN ' . $this->mTbUsers . ' u2 ON (u2.uid = w.juid)' .
               ' LEFT JOIN ' . $this->mTbUsers . ' u3 ON (u3.uid = (SELECT uvid FROM ' . $this->mTbWallPrivacy . ' WHERE mid = w.id))' .
                ' , ' . $this->mTbWallPrivacy . ' p, ' . $this->mTbUsers . ' u
		        WHERE w.id = ? AND p.mid = w.id AND u.uid = w.uid ';
        if (!empty($filt))
        {
            $sql .= ' AND p.mid = w.id';
            $sq_f = $this->_initFilts($filt, 0, $psfilt, $pclass);
            $sql .= $sq_f ? ' AND ( (' . $sq_f . ') ' . ($filt[0] ? 'OR w.uid = ' . $filt[0] : '' ) . ')' : ''; // $filt[0] - uid of viewer
        }
        
        $sql .=' LIMIT 1';
        $res = $this->mDb->getRow($sql, array($id));
        if (!empty($res))
        {
            $res['my_fav'] = $this->ChckExFavTag($res['id'], $uid, 0) ? 1 : 0;
        }
        return $res;
    }


    public function CheckMessageVideoAccess($video_code_id, $filt = array(), $uid, $psfilt = 0, $pclass = 0)
    {
        $sql = 'SELECT w.id
		FROM ' . $this->mTbWall . ' w
                LEFT JOIN ' . $this->mTbUsers . ' u2 ON (u2.uid = w.juid)' .
                ' LEFT JOIN ' . $this->mTbUsers . ' u3 ON (u3.uid = (SELECT uvid FROM ' . $this->mTbWallPrivacy . ' WHERE mid = w.id))' .
                ' , ' . $this->mTbWallPrivacy . ' p, ' . $this->mTbUsers . ' u
		WHERE w.v_code_id = ? AND p.mid = w.id AND u.uid = w.uid ';

        if (!empty($filt))
        {
            $sql .= ' AND p.mid = w.id';
            $sq_f = $this->_initFilts($filt, 0, $psfilt, $pclass);
            $sql .= $sq_f ? ' AND ( (' . $sq_f . ') ' . ($filt[0] ? 'OR w.uid = ' . $filt[0] : '' ) . ')' : ''; // $filt[0] - uid of viewer
        }

        $sql .=' LIMIT 1';

        $res = $this->mDb->getOne($sql, array($video_code_id));

        return $res;
    }


    public function CheckMessagePhotoAccess($photo_id, $filt = array(), $uid, $psfilt = 0, $pclass = 0)
    {
        $sql = 'SELECT w.id
		FROM ' . $this->mTbWall . ' w
                LEFT JOIN ' . $this->mTbUsers . ' u2 ON (u2.uid = w.juid)' .
                ' LEFT JOIN ' . $this->mTbUsers . ' u3 ON (u3.uid = (SELECT uvid FROM ' . $this->mTbWallPrivacy . ' WHERE mid = w.id))' .
                ' , ' . $this->mTbWallPrivacy . ' p, ' . $this->mTbUsers . ' u
		WHERE (w.p_img_1_id = ? OR w.p_img_2_id = ? OR w.p_img_3_id = ?) AND p.mid = w.id AND u.uid = w.uid ';

        if (!empty($filt))
        {
            $sql .= ' AND p.mid = w.id';
            $sq_f = $this->_initFilts($filt, 0, $psfilt, $pclass);
            $sql .= $sq_f ? ' AND ( (' . $sq_f . ') ' . ($filt[0] ? 'OR w.uid = ' . $filt[0] : '' ) . ')' : ''; // $filt[0] - uid of viewer
        }

        $sql .=' LIMIT 1';

        $res = $this->mDb->getOne($sql, array($photo_id, $photo_id, $photo_id));

        return $res;
    }


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
            //  //smiles
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
            $sql = 'INSERT INTO '.$this -> mTbWall.' ( '.join(' ,', $ar_k).', pdate, mdate )
					VALUES ( '.gen_plh($ar_k, 0).', NOW(), NOW() )';

            $this -> mDb -> query( $sql, $ar_v );
            //deb($this -> mDb);
            return $this -> mDb -> getOne( 'SELECT LAST_INSERT_ID()' );
        }
        else
        {
            $sql = 'UPDATE '.$this -> mTbWall.' SET '.gen_plh($ar_k, 1).', mdate = NOW()
					WHERE id = ?';

            $ar_v = array_merge($ar_v, array( $id ));
            $this -> mDb -> query($sql, $ar_v);
        }
        
    }/* Edit */


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
        } else
        {
            $sql = 'UPDATE ' . $this->mTbWallPrivacy . ' SET ptype = ?, uvid = ?, pstype = ?, pclass = ?
					WHERE mid = ?';
            $this->mDb->query($sql, array($ptype, $uvid, $pstype, $pclass, $mid));
        }
    }


    //----DELETE METHODS

    public function Del( $id, $juid )
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
    }/* Del */


    public function DelAnsw( $mid )
    {
        $sql = 'DELETE FROM '.$this -> mTbWall.' WHERE id = ?';
        $this -> mDb -> query( $sql, $id );
    }/* DelAnsw */


    //-- ADDITIONAL METHODS

    public function GetCntListByFilt($fpar = array(), $fval = array(), $ar_filt_par = array(), $ar_filt_val = array(), $uid = 0, $bfilt = -1)
    {
        $tb_ind = 1;
        $r = array();

        /*
         ������� � ����������� ������ ������������:
        $sql = 'SELECT COUNT(w.id)
		        FROM ' . $this->mTbWall . ' w
		        LEFT JOIN ' . $this->mTbUsers . ' u ON ( u.uid = w.uid ) ' .
                "RIGHT JOIN " . $this->mTbWallPrivacy . " p ON ( p.mid = w.id AND p.ptype = 0 AND p.uvid <> " . $uid . ") WHERE w.id = w.id ";
        */
        $sql = 'SELECT COUNT(w.id)
                FROM ' . $this->mTbWall . ' w
                LEFT JOIN ' . $this->mTbUsers . ' u ON ( u.uid = w.uid ) ' .
                "RIGHT JOIN " . $this->mTbWallPrivacy . " p ON ( p.mid = w.id AND p.ptype = 0) WHERE w.id = w.id ";


        if (!empty($fpar))
        {
            $sql .= 'AND ( ' . gen_plh($fpar, 4) . ' )';
        }

        if ($uid)
        { 
            $sql .= ' AND w.uid = ' . (int) $uid; //!
        }

        if (!empty($ar_filt_par) && !empty($ar_filt_par))
        {
            $sql .= ' AND ( ' . gen_plh($ar_filt_par, 3) . ' )';
            $fval = array_merge($fval, $ar_filt_val);
        }

        if ($bfilt != -1)
        {
            $bfilt = mysql_escape_string(strip_tags(trim($bfilt)));
            $sql .= " AND (w.story LIKE '%" . $bfilt . "%' OR w.ev_title LIKE '" . $bfilt . "%' OR w.subj LIKE '%" . $bfilt . "%') ";
        }

        $r = $this->mDb->getOne($sql, $fval);
        return $r;
    }



    public function GetListByFilt($what = array(), $fpar = array(), $fval = array(), $sort = -1, $first = 0, $cnt = 0, $ar_filt_par = array(), $ar_filt_val = array(), $uid = 0, $bfilt = -1)
    {
        $tb_ind = 1;
        $r = array();

        /* ������� � ����������� ������ ���� �� ������ �����������
        $sql = 'SELECT DISTINCT ' . join(', ', $what) . ', u.email, u.first_name, u.last_name, u.image, u.fpath
	            FROM ' . $this->mTbWall . ' w
		        LEFT JOIN ' . $this->mTbUsers . ' u ON ( u.uid = w.uid ) ' .
                "RIGHT JOIN " . $this->mTbWallPrivacy . " p ON ( p.mid = w.id AND p.ptype = 0) AND p.uvid <> " . $uid . " WHERE w.id = w.id ";
        */
        $sql = 'SELECT DISTINCT ' . join(', ', $what) . ', u.email, u.first_name, u.last_name, u.image, u.fpath
                        FROM ' . $this->mTbWall . ' w
                        LEFT JOIN ' . $this->mTbUsers . ' u ON ( u.uid = w.uid ) ' .
                        "RIGHT JOIN " . $this->mTbWallPrivacy . " p ON ( p.mid = w.id AND p.ptype = 0) WHERE w.id = w.id ";


        if (!empty($fpar))
        {
			
            $sql .= 'AND ( ' . gen_plh($fpar, 3) . ' ) ';
        }
		
		
        if (!empty($ar_filt_par) && !empty($ar_filt_val))
        {
            $sql .= ' AND ( ' . gen_plh($ar_filt_par, 2) . ' )';
            $fval = array_merge($fval, $ar_filt_val);
        } 

        if ($bfilt != -1)
        {
            $bfilt = mysql_escape_string( strip_tags(trim($bfilt)) );
            $sql .= " AND (w.story LIKE '%" . $bfilt . "%' OR w.ev_title LIKE '" . $bfilt . "%' OR w.subj LIKE '%" . $bfilt . "%') ";
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
        {
            $db = $this->mDb->limitQuery($sql, $first, $cnt, $fval);
        }
        else
        {
            $db = $this->mDb->query($sql, $fval);
        }
        //($this->mDb);
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
    

    public function CheckRights($id, $uid)
    {
        $id = (int)$id;
        $uid = (int)$uid;
        if($id && $uid)
        {
            $sql = "SELECT 1 FROM ".$this -> mTbWall." WHERE id = ? AND uid = ?";
            return (int)$this -> mDb -> GetOne($sql, array($id, $uid));
        }
        return 0;
    }

}/* Model_Journal_Wall */
?>