<?php
/**
 * Mission Base model
 * @package    5dev Catalog
 * @version    1.0
 * @since      1.03.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */
class Model_Base_Mission
{
    //system params
    private $mDb;

    //tables
    private $mTbMission;
    private $mTbMissionTmp;
    private $mTbUsers;

    private $mMissionCount;

    /**
     * Constructor
     *
     * @param $glObj
     */
    public function __construct(&$gDb)
    {
        //wall's tables
        $this -> mDb =& $gDb;
        $this -> mTbMission = TB . 'mission';
        $this -> mTbMissionTmp = TB . 'mission_tmp';
        $this -> mTbMissionSubscr = TB . 'mission_subscr';
        $this -> mTbUsers = TB . 'users';
        $this -> mTbUsMission = TB . 'users_mission';
        $this -> mTbUsMisPres = TB . 'users_mission_president';
    }

    /* __construct */


    public function Get($id)
    {
        $sql = 'SELECT m.*
				FROM ' . $this -> mTbMission . ' m
				WHERE m.id = ?';
        $r = $this -> mDb -> getRow($sql, array($id));
        return $r;
    }

    /** Get */


    /* public function GetList2( $parent_id = -1, $ward_type = -1, $first = 0, $cnt = 0, $sortv = '' )
    {
        $sql = 'SELECT w.*, w2.title AS ward_title
                FROM '.$this -> mTbWards.' w, '.$this -> mTbWards.' w2
                WHERE w.id_parent = w2.id AND w.id > 0
               ';

        if ($parent_id != -1)
        {
            $sql .= ' AND w.parent_id = '.$parent_id;
        }
        if ($ward_type != -1 && (1==$ward_type || 2==$ward_type))
        {
            $sql .= ' AND w.ward_type = '.$ward_type;
        }

        if ($sortv)
        {
            $sql .= ' ORDER BY '.$sortv;
        }
        else
        {
            $sql .= ' ORDER BY w.title';
        }

        if ($cnt)
        {
            $db = $this -> mDb -> limitQuery($sql, $first, $cnt);
        }
        else
        {
            $db = $this -> mDb -> query($sql);
        }

        $r = array();

        while ($row = $db -> FetchRow())
        {
            $r[] = $row;
        }

        return $r;
    }*/
    /** GetList */


    public function GetList($first = -1, $cnt = '', $sortv = '')
    {
        $sql = 'SELECT m.*  FROM ' . $this -> mTbMission . ' m ';


        if ($sortv)
        {
            $sql .= ' ORDER BY ' . $sortv;
        }
        else
        {
            $sql .= ' ORDER BY m.id';
        }

        if ($cnt)
        {
            $db = $this -> mDb -> limitQuery($sql, $first, $cnt);
        }
        else
        {
            $db = $this -> mDb -> query($sql);
        }

        $r = array();

        while ($row = $db -> FetchRow())
        {
            $r[] = $row;
        }
        return $r;
    }

    /** GetList */


    public function GetCount()
    {
        $sql = 'SELECT COUNT(id) FROM ' . $this -> mTbMission . '
         	   ';
        $r = $this -> mDb -> getOne($sql);
        return $r;
    }

    /** GetCount */


    public function GetCntUList($uid, $group)
    {
        $sql = 'SELECT COUNT(um.id)
				FROM ' . $this -> mTbUsMission . ' um
				LEFT JOIN ' . $this -> mTbMission . ' m ON ( m.id = um.mid )
				WHERE um.uid = ?';
        /*
         GROUP BY um.mid
        if($group == 'title')
        {
            $sql .= ', m.title';
        }
        */
        $r = $this -> mDb -> getOne($sql, array($uid));
        return $r;
    }

    /* GetCntUList */


    public function GetUList($uid, $first = 0, $cnt = 0, $group = '')
    {
        $sql = 'SELECT um.*, m.id, m.title, m.pdate, m.country, m.city, m.region
                FROM ' . $this -> mTbUsMission . ' um
                LEFT JOIN ' . $this -> mTbMission . ' m ON ( m.id = um.mid )
                WHERE um.uid = ?';
        //GROUP BY ' . ($group == 'title' ? 'm.title' : 'um.mid');
        if ($cnt)
        {
            $db = $this -> mDb -> limitQuery($sql, $first, $cnt, array($uid));
        }
        else
        {
            $db = $this -> mDb -> query($sql, array($uid));
        }

        $r = array();
        while ($row = $db -> fetchRow())
        {
            $r[] = $row;
        }

        //deb($r);
        return $r;
    }

    /* GetUList */


    public function GetUCnt($id)
    {
        $sql = 'SELECT COUNT(DISTINCT(uid)) FROM ' . $this -> mTbUsMission . ' WHERE mid = ?';
        return $this -> mDb -> getOne($sql, array($id));
    }

    public function GetMissionTime($mid, $uid)
    {
        $sql = "SELECT id, fdate, tdate FROM " . $this -> mTbUsMission . ' WHERE uid = ? AND mid = ?';
        $db = $this -> mDb -> query($sql, array($uid, $mid));

        $r = array();
        while ($row = $db -> FetchRow())
        {
            if ('0000-00-00' != $row['fdate'] && '0000-00-00' != $row['fdate'])
            {
                $r[] = $row;
            }
        }

        return $r;
    }

    public function GetUsers($id, $first = -1, $pcnt = -1)
    {
        $sql = 'SELECT u.uid, u.public_name, u.first_name, u.last_name, u.fpath, u.image, u.fpath, um.fdate AS m_fdate, um.tdate AS m_tdate, u.email, u.notify_email, u.notify_news, u.notify_ward, u.notify_photo, u.notify_video, u.notify_events
				FROM ' . $this -> mTbUsMission . ' um
    			LEFT JOIN ' . $this -> mTbUsers . ' u ON ( u.uid = um.uid )
    			WHERE um.mid = ? GROUP BY u.uid';

        if (-1 != $first && -1 != $pcnt)
        {
            $db = $this -> mDb -> limitQuery($sql, $first, $pcnt, array($id));
        }
        else
        {
            $db = $this -> mDb -> query($sql, array($id));
        }

        $r = array();
        while ($row = $db -> fetchRow())
        {
            $r[] = $row;
        }
        return $r;
    }

    /* GetUsers */


    public function GetUMission($id, $uid)
    {
        $sql = 'SELECT um.*, umpr.first_name AS pr_first_name, umpr.last_name AS pr_last_name, umpr.phone AS pr_phone, umpr.email AS pr_email, umpr.p_img AS pr_p_img 
				FROM ' . $this -> mTbUsMission . ' um
				LEFT JOIN ' . $this -> mTbUsMisPres . ' umpr ON ( umpr.mid = um.mid AND umpr.umid = um.id )
				WHERE um.mid = ? AND um.uid = ?';
        $r = $this -> mDb -> getRow($sql, array($id, $uid));

        // get time
        if (!empty($r))
        {
            $t = $this -> GetMissionTime($id, $uid);
            $r['time'] = $t;
        }

        return $r;
    }

    /* GetUMission */


    public function GetULocInfo($id)
    {
        $sql = 'SELECT um.uid, u.first_name, u.last_name, um.loc_best_place, um.loc_food_like, um.loc_food_dislike, um.loc_will_miss, um.loc_temp_language,
                RAND() AS ordf
		FROM ' . $this->mTbUsMission . ' um
		LEFT JOIN ' . $this->mTbUsers . ' u ON ( u.uid = um.uid )
		WHERE um.mid = ?
                ORDER BY ordf';
        $db = $this->mDb->query($sql, array($id));

        $r = array('loc_best_place' => array(), 'loc_food_like' => array(), 'loc_food_dislike' => array(), 'loc_will_miss' => array(), 'loc_temp_language' => array());
        $k = 0;
        while ($row = $db->FetchRow())
        {
            if (
                    3 <= count($r['loc_best_place']) && 3 <= count($r['loc_food_like']) && 3 <= count($r['loc_food_dislike']) && 3 <= count($r['loc_will_miss']) && 3 <= count($r['loc_temp_language'])
            )
            {
                break;
            }

            if (3 > count($r['loc_best_place']) && $row['loc_best_place'])
            {
                $r['loc_best_place'][] = array('fname' => $row['first_name'] . ' ' . $row['last_name'], 'text' => $row['loc_best_place']);
            }

            if (3 > count($r['loc_food_like']) && $row['loc_food_like'])
            {
                $r['loc_food_like'][] = array('fname' => $row['first_name'] . ' ' . $row['last_name'], 'text' => $row['loc_food_like']);
            }

            if (3 > count($r['loc_food_dislike']) && $row['loc_food_dislike'])
            {
                $r['loc_food_dislike'][] = array('fname' => $row['first_name'] . ' ' . $row['last_name'], 'text' => $row['loc_food_dislike']);
            }

            if (3 > count($r['loc_will_miss']) && $row['loc_will_miss'])
            {
                $r['loc_will_miss'][] = array('fname' => $row['first_name'] . ' ' . $row['last_name'], 'text' => $row['loc_will_miss']);
            }

            if (3 > count($r['loc_temp_language']) && $row['loc_temp_language'])
            {
                $r['loc_temp_language'][] = array('fname' => $row['first_name'] . ' ' . $row['last_name'], 'text' => $row['loc_temp_language']);
            }
            $k++;
        }
        return $r;
    }

    /* GetULocInfo */


    public function CntSearch()
    {
        $this -> mMissionCount;   
    }



    public function Search($filt = '', $uid = -1, $fdate = -1, $tdate = -1, $location = -1, $first = 0, $cnt = 0, $sortv = -1, $mfilt = -1, $served_uid = 0)
    {
        $sql = 'SELECT SQL_CALC_FOUND_ROWS m.*' . ((int) $served_uid ? ' , (um.uid  <> NULL) AS served' : '') . '
                FROM ' . $this -> mTbMission . ' m ';
        if ((int) $served_uid)
        {
            $sql .= ' LEFT JOIN ' . $this -> mTbUsMission . ' um ON (m.id = um.mid AND um.uid = ' . (int) $served_uid . ')';
        }

        /**
         * Так как у нас фильтр по связанной таблице только по датам, подключаем ее когда он есть
         * При этом идет поиск по миссиям только с людьми
         *
         */

        if (-1 != $mfilt && !empty($mfilt) && strlen($mfilt) > 1)
        {
            $sql .= ' RIGHT JOIN ' . $this -> mTbUsMission . ' um2 ON (m.id = um2.mid)';
        }


        $sql .= ' WHERE m.id > 0';

        if ($filt)
        {
            $sql .= ' AND (LOWER(m.title) LIKE "' . ToLower($filt) . '%"' . ((int) $served_uid ? ' OR um.location LIKE "' . $filt . '%"' : '') . ')';
        }

        if (-1 != $mfilt && !empty($mfilt) && strlen($mfilt) > 1)
        {
            /**
             * фильтр по датам нахождения в миссиях людей
             */
            $sql .= ' AND ' . $mfilt;
        }

        if (-1 != $uid)
            $sql .= ' AND um.uid = ' . $uid;

        if (-1 != $fdate)
            $sql .= ' AND um.fdate = "' . mysql_escape_string($fdate) . '"';

        if (-1 != $tdate)
            $sql .= ' AND um.tdate = "' . mysql_escape_string($tdate) . '"';

        if (-1 != $location && (int) $served_uid)
        {
            $sql .= ' AND um.location = "' . mysql_escape_string($location) . '"';
        }

        //$sql .= ' GROUP BY m.title'; //cut off missions with one title !!!!!!!

        if (-1 != $sortv)
            $sql .= ' ORDER BY ' . $sortv;
        else
            $sql .= ' ORDER BY m.id';



        if ($cnt)
            $db = $this -> mDb -> limitQuery($sql, $first, $cnt);
        else
            $db = $this -> mDb -> query($sql);


        $r = array();

        while ($row = $db -> FetchRow())
        {
            $row['served'] = !empty($row['served']) ? 1 : 0;
            $r[] = $row;
        }

        $this -> mMissionCount = $this -> mDb -> getOne('SELECT FOUND_ROWS()');
        return $r;
    }

    /* Search */


    /**
     *
     * @param <type> $id
     * @return <type>
     */
    public function SearchMission($q)
    {
        $q = $q . '%';
        $sql = 'SELECT * FROM ' . $this -> mTbMission . ' WHERE id > 0 AND LOWER(title) LIKE ?';
        $sql .= ' ORDER BY country, city, title';

        return $this -> mDb -> getAssoc($sql, true, array($q));
    }

    /* SearchWard */


    public function ChngUMission($uid, $id, $fdate, $tdate)
    {

        $m_i = $this -> mDb -> getRow('SELECT title, city, country
										   FROM ' . $this -> mTbMission . '
										   WHERE id = ? ', array($id));

        $l = $m_i['city'] . (!empty($m_i['city']) && !empty($m_i['country']) ? ', ' : '') . $m_i['country'];
        $loc = (!empty($m_i['title']) && $m_i['title'] != $l ? $m_i['title'] . ', ' : '') . $l;

        $sql = 'INSERT INTO ' . $this -> mTbUsMission . ' (mid, uid, location, fdate, tdate)
                VALUES(?, ?, ?, ?, ?)';

        $this -> mDb -> query($sql, array($id, $uid, $loc, $fdate, $tdate));
        //$this -> EditSubscr( $uid, $id, 1 );
    }

    /* ChngUMission */


    public function Edit($title, $city, $country, $region, $id = 0)
    {
        if ($id)
        {
            $sql = 'UPDATE ' . $this -> mTbMission . ' SET title = ?, city = ?, country = ?, region = ?
                    WHERE id = ?';
            $this -> mDb -> query($sql, array($title, $city, $country, $region, $id));
            //$id = $this -> mDb -> getOne('SELECT LAST_INSERT_ID()');
        }
        else
        {
            $sql = 'INSERT INTO ' . $this -> mTbMission . ' (title, city, country, region, pdate)
                    VALUES(?, ?, ?, ?, ?)';
            $db = $this -> mDb -> query($sql, array($title, $city, $country, $region, mktime()));
            $id = $this -> mDb -> GetOne('SELECT LAST_INSERT_ID()');
        }
        return $id;
    }

    /** Edit */


    public function Del($id)
    {
        $mission = $this -> Get($id);
        if (!empty($mission))
        {
            $sql = 'DELETE FROM ' . $this -> mTbMission . ' WHERE id = ?';
            $this -> mDb -> query($sql, array($id));

            /** update users mission */
            $sql = 'DELETE FROM ' . $this -> mTbUsMission . ' WHERE mid = ?';
            $this -> mDb -> query($sql, array($id));
        }
    }

    /** Del */


    public function GetCntSubscr($mission_id = -1)
    {
        return $this -> mDb -> getOne('SELECT COUNT(id) FROM ' . $this -> mTbMissionSubscr . ' WHERE mission_id = ?', array($mission_id));
    }

    /* GetCntSubscr */


    public function GetSubscr($uid = -1, $mission_id = -1, $order = -1, $limit = -1, $filt = -1)
    {
        $sql = 'SELECT s.*, u.email, u.first_name, u.last_name, u.image, u.fpath, m.title as mission_title
    	        , m.country, m.city, m.region,
    	        DATE_FORMAT(s.dt, "%M %e, %Y") as start_date
    			FROM ' . $this -> mTbMissionSubscr . ' s
    			LEFT JOIN ' . $this -> mTbUsers . ' u ON ( u.uid = s.uid )
				LEFT JOIN ' . $this -> mTbMission . ' m ON ( s.mission_id = m.id )
    			WHERE 1  AND m.title <> ""';
        if (-1 != $uid)
            $sql .= ' AND s.uid = ' . $uid;
        if (-1 != $mission_id)
            $sql .= ' AND s.mission_id = ' . $mission_id;
        if (-1 != $filt)
            $sql .= ' AND ' . $filt;
        if (-1 != $order)
            $sql .= ' ORDER BY ' . $order;
        else
            $sql .= ' ORDER BY s.id ';
        if (-1 != $limit)
            $sql .= ' LIMIT ' . $limit;
        return $this -> mDb -> getAll($sql);
    }

    /* GetSubscr */


    public function ChckSubscr($uid, $mission_id)
    {
        $ex = $this -> mDb -> getOne('SELECT id FROM ' . $this -> mTbMissionSubscr . ' WHERE uid = ? AND mission_id = ?', array($uid, $mission_id));
        if ($ex)
            return 1;
        else
            return 0;
    }

    /* ChckSubscr */


    public function EditSubscr($uid, $mission_id, $act = 0)
    {
        $ex = $this->mDb->getOne('SELECT id FROM ' . $this->mTbMissionSubscr . ' WHERE uid = ? AND mission_id = ?', array($uid, $mission_id));
        if (1 == $act)
        {
            if (!$ex)
                $sql = 'INSERT INTO ' . $this->mTbMissionSubscr . ' ( uid, mission_id, dt )
        				VALUES ( ?, ?, NOW() )';
        }
        else if (2 == $act)
        {
            if ($ex)
                $sql = 'DELETE FROM ' . $this->mTbMissionSubscr . ' WHERE uid = ? AND mission_id = ?';
        }
        if (isset($sql))
            $this->mDb->query($sql, array($uid, $mission_id));
    }

    /* EditSubscr */


    public function AddTmp($uid, $mission, $stake)
    {
        $sql = 'SELECT id FROM ' . $this -> mTbMissionTmp . ' WHERE LOWER(mission) = ? AND LOWER(stake) = ?';
        $tid = $this -> mDb -> getOne($sql, array(ToLower($mission), ToLower($stake)));

        if (!empty($tid))
        {
            $sql = 'UPDATE ' . $this -> mTbMissionTmp . ' SET cnt = cnt + 1 WHERE id = ?';
            $this -> mDb -> query($sql, array($tid));
        }
        else
        {
            $sql = 'INSERT INTO ' . $this -> mTbMissionTmp . ' (uid, mission, stake, pdate) VALUES(?, ?, ?, ?)';
            $this -> mDb -> query($sql, array($uid, $mission, $stake, mktime()));
        }
        return true;
    }

    /** AddTmp */


    //-- Additional Methods
    public function EditInfo($id, $ar_k = array(), $ar_v = array())
    {
        if (!$id)
        {
            $sql = 'INSERT INTO ' . $this -> mTbMission . ' ( ' . join(' ,', $ar_k) . ', pdate )
					VALUES ( ' . gen_plh($ar_k, 0) . ', NOW() )';

            $this -> mDb -> query($sql, $ar_v);
            return $this -> mDb -> getOne('SELECT LAST_INSERT_ID()');
        }
        else
        {
            $sql = 'UPDATE ' . $this -> mTbMission . ' SET ' . gen_plh($ar_k, 1) . '
					WHERE id = ?';

            $ar_v = array_merge($ar_v, array($id));
            $this -> mDb -> query($sql, $ar_v);
        }
    }

    /* EditInfo */


    public function EditUMisInfo($id, $ar_k = array(), $ar_v = array())
    {
        if (!$id)
        {
            $sql = 'INSERT INTO ' . $this -> mTbUsMission . ' ( ' . join(' ,', $ar_k) . ' )
					VALUES ( ' . gen_plh($ar_k, 0) . ' )';

            $this -> mDb -> query($sql, $ar_v);
            return $this -> mDb -> getOne('SELECT LAST_INSERT_ID()');
        }
        else
        {
            $sql = 'UPDATE ' . $this -> mTbUsMission . ' SET ' . gen_plh($ar_k, 1) . '
					WHERE id = ?';

            $ar_v = array_merge($ar_v, array($id));
            $this -> mDb -> query($sql, $ar_v);
        }
    }

    /* EditInfo */


    public function EditUMisPresident($ar_k = array(), $ar_v = array(), $id = '')
    {
        $mid_ind = array_search('mid', $ar_k);
        $uid_ind = array_search('umid', $ar_k);
        $ex = $this -> mDb -> getOne('SELECT id FROM ' . $this -> mTbUsMisPres . ' WHERE mid = ? AND umid = ?', array($ar_v[$mid_ind], $ar_v[$uid_ind]));

        // omg...  $ex = $this -> mDb -> getOne('SELECT id FROM '.$this -> mTbUsMisPres.' WHERE mid = ? AND umid = ?', array( $ar_v[count($ar_k)-2], $ar_v[count($ar_k)-1] ));
        if (!$id && !$ex)
        {
            $sql = 'INSERT INTO ' . $this -> mTbUsMisPres . ' ( ' . join(' ,', $ar_k) . ' )
					VALUES ( ' . gen_plh($ar_k, 0) . ' )';

            $this -> mDb -> query($sql, $ar_v);
            return $this -> mDb -> getOne('SELECT LAST_INSERT_ID()');
        }
        else
        {
            $sql = 'UPDATE ' . $this -> mTbUsMisPres . ' SET ' . gen_plh($ar_k, 1) . '
					WHERE id = ?';

            $ar_v = array_merge($ar_v, array($id ? $id : $ex));
            $this -> mDb -> query($sql, $ar_v);
        }
    }

    /* EditInfo */


    public function GetMissionByLocation($city, $country, $region = '')
    {
        $sql = 'SELECT id FROM ' . $this -> mTbMission . ' WHERE city = ? AND country = ? AND region = ?';
        $r = $this -> mDb -> getOne($sql, array($city, $country, $region));
        return $r;
    }

    /** GetMissionByLocation */


    public function GetMissionByTitle($title)
    {
        $sql = 'SELECT id FROM ' . $this -> mTbMission . ' WHERE city = "" AND country = "" AND region = "" AND LOWER(title) = ?';
        $r = $this -> mDb -> getOne($sql, array(ToLower(trim(strip_tags($title)))));
        return $r;
    }

}

/* Model_Base_Mission */
?>
