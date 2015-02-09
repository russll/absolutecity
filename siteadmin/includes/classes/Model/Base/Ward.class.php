<?php
/**
 * CH Wall model
 * @package    5dev Catalog
 * @version    1.0
 * @since      1.03.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */
class Model_Base_Ward
{
    //system params
    private $mDb;

    //tables
    private $mTbWards;
    private $mTbWardsTmp;
    private $mTbUsers;
    private $mTbUsWBishop;
    private $mTbWardsWhatch;

    /**
     * Constructor
     *
     * @param $glObj
     */
    public function __construct( &$gDb )
    {
        //wall's tables
        $this -> mDb             =& $gDb;
        $this -> mTbWards        = TB . 'wards';
        $this -> mTbWardsTmp     = TB . 'ward_tmp';
        $this -> mTbUsWBishop    = TB . 'wards_bishopric';
        $this -> mTbWardsWhatch  = TB . 'wards_whatching';
        $this -> mTbUsers        = TB . 'users';
    }/* __construct */


    public function Get( $id )
    {
        $sql = 'SELECT w.*, w2.title AS ward_title
				FROM '.$this -> mTbWards.' w LEFT JOIN '.$this -> mTbWards.' w2 ON (w2.id = w.id_parent)
				WHERE w.id = ?';
        $r   = $this -> mDb -> getRow($sql, array($id));
        return $r;
    }/** Get */

	
    public function GetList( $parent_id = -1, $ward_type = -1, $first = 0, $cnt = 0, $sortv = '', $ignore = -1 )
    {
        $sql = 'SELECT w.*, w2.title AS ward_title
				FROM '.$this -> mTbWards.' w, '.$this -> mTbWards.' w2
				WHERE w.id_parent = w2.id AND w.id > 0
               ';

	if ($ignore != -1)
        {
            $sql .= ' AND w.id != ' . (int) $ignore;
        }

        if ($parent_id != -1)
        {
            $sql .= ' AND w.id_parent = '.$parent_id;
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
            $sql .= ' ORDER BY (w.id_parent AND w.title) ';
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
    }/** GetList */

    public function GetCount($parent_id = -1, $ward_type = -1)
    {
        $sql = 'SELECT COUNT(w.id)
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
        $r = $this -> mDb -> getOne($sql);
        return $r;
    }/** GetCount */

    public function GetSearchCount($sstr, $stype = 'all')
    {
        if ($sstr)
            $sstr = '%'.$sstr.'%';

        $params = array();

        $sql = "SELECT count(id) FROM ".$this -> mTbWards." WHERE 1=1 ";
        if ($sstr)
        {
            $sql .= " AND (title LIKE ? OR country LIKE ? OR city LIKE ? OR region LIKE ?)";
            $params = array_fill(0, 4, $sstr);
        }

        switch ($stype)
        {
            case 'moderated':
                $sql .= ' AND moderated = 1';
                break;
            case 'unmoderated':
                $sql .= ' AND moderated = 0';
                break;
        }
        return $this -> mDb -> getOne($sql, $params);
    }

    public function ChangeActive($wid)
    {
        $this -> mDb -> query("UPDATE ".$this -> mTbWards." SET moderated = NOT moderated WHERE id = ?", array($wid));
        return $this -> mDb -> getOne("SELECT moderated FROM ".$this -> mTbWards." WHERE id = ?", array($wid));
    }

    public function SearchWard_v2($sstr, $stype, $first = 0, $cnt = 0)
    {
        $r = array();
        if ($sstr)
            $sstr = '%'.$sstr.'%';

        $params = array();

        $sql = "SELECT * FROM ".$this -> mTbWards." WHERE 1=1" ;
        if ($sstr)
        {
            $sql .= " AND (title LIKE ? OR country LIKE ? OR city LIKE ? OR region LIKE ?) ";
            $params = array_fill(0, 4, $sstr);
        }

        switch ($stype)
        {
            case 'moderated':
                $sql .= ' AND moderated = 1';
                break;
            case 'unmoderated':
                $sql .= ' AND moderated = 0';
                break;
        }

        $sql .= ' ORDER by moderated ASC';

        $res = $this -> mDb -> limitQuery($sql, $first, $cnt, $params);

        while($row = $res -> fetchRow())
        {
            $r[] = $row;
        }
        return $r;
    }

    /**
     *
     * @param <type> $id
     * @return <type>
     */
    public function SearchWard( $q, $ward_type = -1 )
    {
        $q = '%'.ToLower($q).'%';
        $sql = 'SELECT * FROM '.$this -> mTbWards.' WHERE id > 0 AND LOWER(title) LIKE ?';

        if (1==$ward_type)
        {
            $sql .= ' AND ward_type = 1';
        }
        elseif (2==$ward_type)
        {
            $sql .= ' AND ward_type = 2';
        }
        $sql .= ' ORDER BY country, city, title';

        $h = $this -> mDb -> getAssoc($sql, true, array($q));
        //deb($this -> mDb);
        return $h;
    }/* SearchWard */

    public function GetCntUList( $uid )
    {
        $sql = 'SELECT COUNT(w.id)
				FROM '.$this -> mTbWards.' w, '.$this -> mTbWards.' w2, '.$this -> mTbUsers.' u 
				WHERE u.uid = ? AND w.id_parent = w2.id AND w.id <> 0 '.
					//'AND ( w.id = u.ward_id OR w.id = u.stake_id )'
					  'AND ( w.id = u.ward_id )'
		;
        $r = $this -> mDb -> getOne($sql, array($uid));
        return $r;
    }/* GetCntUList */

    public function GetUList( $uid, $first = 0, $cnt = 0 )
    {
        $sql = 'SELECT w.*, w2.title AS ward_title
				FROM '.$this -> mTbWards.' w, '.$this -> mTbWards.' w2, '.$this -> mTbUsers.' u 
				WHERE u.uid = ? AND w.id_parent = w2.id AND w.id <> 0 '.
						//'AND ( w.id = u.ward_id OR w.id = u.stake_id )'
						'AND ( w.id = u.ward_id )'
		;
        if ($cnt)
            $db = $this -> mDb -> limitQuery($sql, $first, $cnt, array($uid));
        else
            $db = $this -> mDb -> query($sql, array($uid));

        $r = array();
        while ($row = $db -> FetchRow())
        {
            $r[] = $row;
        }
        return $r;
    }/* GetUList */

    public function GetUCnt( $id )
    {
        $sql = 'SELECT COUNT(uid) FROM '.$this -> mTbUsers.' WHERE ward_id = ? OR stake_id = ?';
        return $this -> mDb -> getOne($sql, array($id,$id));
    }

    public function GetUBishopric( $wid, $uid )
    {
        $sql = 'SELECT uwb.*
				FROM '.$this -> mTbUsWBishop.' uwb
				WHERE uwb.wid = ? AND uwb.uid = ?';
        $r   = $this -> mDb -> getRow($sql, array( $wid, $uid ));
        return $r;
    }/* GetUBishopric */

    public function GetCntWhatching( $uid )
    {
        $sql = 'SELECT COUNT(id) FROM '.$this -> mTbWardsWhatch.' WHERE uid = ?';
        return $this -> mDb -> getOne($sql, array($uid));
    }/* GetCntWhatching */

    public function GetWhatching( $wid, $uid )
    {
        $sql = 'SELECT uww.*
				FROM '.$this -> mTbWardsWhatch.' uww
				WHERE uww.wid = ? AND uww.uid = ?';
        $r   = $this -> mDb -> getRow($sql, array( $wid, $uid ));
        return $r;
    }/* GetWhatching */

    public function GetWhatchingList( $uid, $first = 0, $cnt = 0, $order = -1, $as_assoc = 0 )
    {
        $sql = 'SELECT ww.*, w.title AS ward_title, w2.title as stake_title, DATE_FORMAT(ww.dt, "%M %e, %Y") as start_date
				FROM '.$this -> mTbWardsWhatch.' ww
				LEFT JOIN '.$this -> mTbWards.' w ON ( w.id = ww.wid )
				LEFT JOIN '.$this -> mTbWards.' w2 ON ( w.id_parent = w2.id )'.
				//'LEFT JOIN '.$this -> mTbUsers.' u ON ( (u.stake_id = uww.wid AND w.ward_type = 2) OR (u.ward_id = uww.wid AND w.ward_type = 1) AND ( u.stake_id <> 0 OR u.ward_id <> 0 ) )
				'WHERE ww.uid = ?';
        if (-1 != $order)
            $sql .= ' ORDER BY '.$order;
        else
            $sql .= ' ORDER BY ww.dt DESC';
        $ar_q = array( $uid );
        if ($cnt)
            $db = $this -> mDb -> limitQuery($sql, $first, $cnt, $ar_q);
        else
            $db = $this -> mDb -> query($sql, $ar_q);
        $r = array();

     
        while ($row = $db -> FetchRow())
        {
            if ($as_assoc)
            {
                $r[$row['wid']] = $row;
            }
            else
            {
                $r[] = $row;
            }
        }
        return $r;
    }/* GetWhatchingList */

    
    public function EditWhatching( $uid, $wid, $act = 1 )
    {
        $ar_q = array($wid, $uid);
        $ex = $this -> mDb -> getOne('SELECT id FROM '.$this -> mTbWardsWhatch.' WHERE wid = ? AND uid = ?', $ar_q);
        if (1 == $act && !$ex)
        {
            $sql = 'INSERT INTO '.$this -> mTbWardsWhatch.' ( wid, uid, dt )
					VALUES ( ?, ?, NOW() )';
            $this -> mDb -> query( $sql, $ar_q );
            return $this -> mDb -> getOne( 'SELECT LAST_INSERT_ID()' );
        }
        else
            $this -> mDb -> query('DELETE FROM '.$this -> mTbWardsWhatch.' WHERE wid = ? AND uid = ?', $ar_q);
    }/* EditWhatching */


    public function CntSearch($ward_title = '', $stake_title = '', $parent_id = -1, $mfilt = -1, $par_like = '')
    {
        $sql = 'SELECT COUNT(w.id)
				FROM ' . $this->mTbWards . ' w RIGHT JOIN ' . $this->mTbWards . ' w2
					ON (w.id_parent = w2.id ' . ($par_like ? ' AND w2.title LIKE "%' . mysql_real_escape_string($par_like) . '%")' : ') ') . '
				WHERE w.id > 0 
               ';

        if (-1 != $mfilt)
            $sql .= ' AND ' . $mfilt;

        if (-1 != $parent_id)
            $sql .= ' AND w.parent_id = ' . $parent_id;

        if ($ward_title)
        {
            $ward_title = trim(mysql_escape_string($ward_title));
            $sql .= ' AND ( w.title LIKE "%' . $ward_title . '%" OR w2.title LIKE "%' . $ward_title . '%")';
        }
        $r = $this -> mDb -> getOne($sql);
        return $r;
    }/* CntSearch */


    public function Search($ward_title = '', $stake_title = '', $parent_id = -1, $first = 0, $cnt = 0, $sortv = -1, $mfilt = -1, $par_like = '')
    {
        $sql = 'SELECT w.*, w2.title AS ward_title
				FROM ' . $this->mTbWards . ' w RIGHT JOIN ' . $this->mTbWards . ' w2
					ON (w.id_parent = w2.id ' . ($par_like ? ' AND w2.title LIKE "%' . mysql_real_escape_string($par_like) . '%")' : ') ') . '
				WHERE w.id > 0';

        if (-1 != $mfilt)
            $sql .= ' AND ' . $mfilt;

        if (-1 != $parent_id)
            $sql .= ' AND w.parent_id = ' . $parent_id;

        if ($ward_title)
        {
            $ward_title = trim(mysql_escape_string($ward_title));
            $sql .= ' AND ( w.title LIKE "%' . $ward_title . '%" OR w2.title LIKE "%' . $ward_title . '%")';
        }

        if (-1 != $sortv)
            $sql .= ' ORDER BY ' . $sortv;
        else
            $sql .= ' ORDER BY (w.id_parent AND w.title) ';

        if ($cnt)
            $db = $this->mDb->limitQuery($sql, $first, $cnt);
        else
            $db = $this->mDb->query($sql);

        $r = array();

        while ($row = $db->FetchRow())
        {
            $r[] = $row;
        }

        return $r;
    }/* Search */

    
    public function Edit( $title, $ward_type, $id_parent, $city, $country, $region, $id = 0, $more = '', $moderated = 1 )
    {
        $id_parent = (int)$id_parent;
        if ($id)
        {
            $sql = 'UPDATE '.$this -> mTbWards.' SET title = ?, ward_type = ?, id_parent = ?,
                   city = ?, country = ?, region = ?, more = ?
                   WHERE id = ?';
            $this -> mDb -> query($sql, array($title, $ward_type, $id_parent, $city, $country, $region, $more, $id));
            return true;
        }
        else
        {
            $sql = 'INSERT INTO '.$this -> mTbWards.' (title, ward_type, id_parent, city, country, region, pdate, more, moderated)
                   VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)';
            $this -> mDb -> query($sql, array($title, $ward_type, $id_parent, $city, $country, $region, mktime(), $more, $moderated));
			//return true;
            return $this -> mDb -> getOne('SELECT LAST_INSERT_ID()');
        }
    }/** Edit */

    
    public function EditUWBishopric( $ar_k = array(), $ar_v = array(), $id = '' )
    {

        # WTF is this ??????????????
        # $ex = $this -> mDb -> getOne('SELECT id FROM '.$this -> mTbUsWBishop.' WHERE wid = ? AND uid = ?', array( $ar_v[count($ar_k)-2], $ar_v[count($ar_k)-1] ));

        $wid_ind = array_search('wid', $ar_k);
        $uid_ind = array_search('uid', $ar_k);
        $ex = $this -> mDb -> getOne('SELECT id FROM '.$this -> mTbUsWBishop.' WHERE wid = ? AND uid = ?', array( $ar_v[$wid_ind], $ar_v[$uid_ind] ));

        if (!$id && !$ex)
        {
            $sql = 'INSERT INTO '.$this -> mTbUsWBishop.' ( '.join(' ,', $ar_k).' )
					VALUES ( '.gen_plh($ar_k, 0).' )';

            $this -> mDb -> query( $sql, $ar_v );
            return $this -> mDb -> getOne( 'SELECT LAST_INSERT_ID()' );
        }
        else
        {
            $sql = 'UPDATE '.$this -> mTbUsWBishop.' SET '.gen_plh($ar_k, 1).'
					WHERE id = ?';

            $ar_v = array_merge($ar_v, array( $id ? $id : $ex ));
            $this -> mDb -> query($sql, $ar_v);
        }
    }/* EditInfo */


    public function Del( $id )
    {
        $ward = $this -> Get($id);
        if (!empty($ward))
        {
            if (1==$ward['ward_type'])
            {
                /** delete ward with stakes */
                $sql = 'SELECT id FROM '.$this -> mTbWards.' WHERE ward_type = 2 AND id_parent = ?';
                $db  = $this -> mDb -> query($sql, array($id));
                while ($row = $db -> FetchRow())
                {
                    $sql = 'UPDATE '.$this -> mTbUsers.' SET stake_id = 0 WHERE stake_id = ?';
                    $this -> mDb -> query($sql, array($row['id']));
                }
                $sql = 'DELETE FROM '.$this -> mTbWards.' WHERE ward_type = 2 AND id_parent = ?';
                $this -> mDb -> query($sql, array($id));

                $sql = 'DELETE FROM '.$this -> mTbWards.' WHERE id = ?';
                $this -> mDb -> query($sql, array($id));

                /** update users ward */
                $sql = 'UPDATE '.$this -> mTbUsers.' SET ward_id = 0 WHERE ward_id = ?';
                $this -> mDb -> query($sql, array($id));

            }
            else
            {
                /** delete stake */
                $sql = 'UPDATE '.$this -> mTbUsers.' SET stake_id = 0 WHERE stake_id = ?';
                $this -> mDb -> query($sql, array($id));

                $sql = 'DELETE FROM '.$this -> mTbWards.' WHERE id = ?';
                $this -> mDb -> query($sql, array($id));
            }
        }

    }/** Del */


    public function AddTmp( $uid, $ward, $stake )
    {
        $sql = 'SELECT id FROM '.$this -> mTbWardsTmp.' WHERE LOWER(ward) = ? AND LOWER(stake) = ?';
        $tid = $this -> mDb -> getOne($sql, array(ToLower($ward), ToLower($stake)));

        if (!empty($tid))
        {
            $sql = 'UPDATE '.$this -> mTbWardsTmp.' SET cnt = cnt + 1 WHERE id = ?';
            $this -> mDb -> query($sql, array($tid));
        }
        else
        {
            $sql = 'INSERT INTO '.$this -> mTbWardsTmp.' (uid, ward, stake, pdate) VALUES(?, ?, ?, ?)';
            $this -> mDb -> query($sql, array($uid, $ward, $stake, $pdate));
        }
        return true;
    }/** AddTmp */


    //-- Additional Methods

    public function EditInfo( $id, $ar_k = array(), $ar_v = array() )
    {
        if (!$id)
        {
            $sql = 'INSERT INTO '.$this -> mTbWards.' ( '.join(' ,', $ar_k).', pdate )
					VALUES ( '.gen_plh($ar_k, 0).', NOW() )';

            $this -> mDb -> query( $sql, $ar_v );
            return $this -> mDb -> getOne( 'SELECT LAST_INSERT_ID()' );
        }
        else
        {
            $sql = 'UPDATE '.$this -> mTbWards.' SET '.gen_plh($ar_k, 1).'
					WHERE id = ?';

            $ar_v = array_merge($ar_v, array( $id ));
            $this -> mDb -> query($sql, $ar_v);
        }
    }/* EditInfo */

    public function GetUsers($wid)
    {
        $r = array();
        $sql = "SELECT * FROM " . $this -> mTbUsers . " WHERE ward_id = ?";
        $db = $this -> mDb -> query($sql, array($wid));
        while($row = $db -> FetchRow())
        {
            $r[] = $row;
        }
        return $r;
    }


}/* Model_Base_Ward */
?>
