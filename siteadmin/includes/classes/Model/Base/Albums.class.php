<?php
/**
 * Albums Base model
 * @package    5dev Catalog
 * @version    1.0
 * @since      1.03.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */
class Model_Base_Albums
{
    //system params
    private $mDb;

    //tables
    private $mTbAlbums;
    private $mTbAlbumsPr;
    private $mTbUsers;
    private $mTbAlbumsImg;
    private $mTbAlbumsImgCom;
    private $mTbUWall;
    private $mTbMWall;
    private $mTbWWall;
    private $mTbAlbumsTags;
    private $mTbAlbumsTagsList;

    /**
     * Constructor
     *
     * @param $glObj
     */
    public function __construct( &$gDb )
    {
        //wall's tables
        $this -> mDb          	  =& $gDb;
        $this -> mTbAlbums        = TB . 'users_albums';
        $this -> mTbAlbumsPr      = TB . 'users_albums_privacy';
        $this -> mTbAlbumsImg     = TB . 'users_albums_img';
        $this -> mTbAlbumsImgCom  = TB . 'users_albums_comments';
        $this -> mTbUsers         = TB . 'users';

        $this -> mTbUWall      =  TB.'users_wall';
        $this -> mTbMWall      =  TB.'mission_wall';
        $this -> mTbWWall      =  TB.'wards_wall';

        //Albums tags
        $this -> mTbAlbumsTags      =  TB.'albums_tags';
        $this -> mTbAlbumsTagsList      =  TB.'albums_tags_list';

    }/* __construct */

    /* Init String of Filters for Requests
	 * 
	 * @param $type - type of Privacy ('')
	 * @return wall info
    */
    public function _initFilts ( $filt )
    {
        $sq_f = '';
        if (!empty($filt))
        {
            foreach ($filt as $k => &$v)
            {
                $sq_f .= ($sq_f ? ' OR ' : '').'(p.ptype = '.(int)$k.' AND p.uvid IN ('.(is_array($v) ? Ar2Str($v) : ($v==0 ? '-1' : $v)).'))';
            }
            $sq_f .= ' OR (p.ptype = 0)';
        }
        return $sq_f;
    }/* _initFilt */



    //Get list of the Tables
    public function GetTables(  )
    {
        $sql = "SHOW TABLES";
        $db = $this -> mDb -> query( $sql );
        while ($ar_f = $db -> fetchRow())
        {
            $r[]= $ar_f['Tables_in_inz'];
        }
        return array_values($r);
    }/* GetAnswCols */

    public function GetCntAlb( $uid = -1 )
    {
        $sql = 'SELECT COUNT(aid) FROM '.$this->mTbAlbums;
        if (-1 != $uid)
            $sql .= ' WHERE uid = ?';
        return $this -> mDb -> getOne($sql, array($uid));
    }/* GCntAlb */

    public function GetCntImgCom( $iid = -1 )
    {
        $sql = 'SELECT COUNT(id) FROM '.$this->mTbAlbumsImgCom;
        if (-1 != $iid)
            $sql .= ' WHERE iid = ?';
        return $this -> mDb -> getOne($sql, array($iid));
    }/* GCntImgCom */

    public function GetCntImgComByUID( $uid = -1 )
    {
        $sql = 'SELECT COUNT(id) FROM '.$this->mTbAlbumsImgCom;
        if (-1 != $uid)
            $sql .= ' WHERE user_id = '.$uid;
        return $this -> mDb -> getOne($sql);
    }/* GCntImgComByUID */


    public function GetAlbum( $id = -1, $filt = array() )
    {
        $sql = 'SELECT a.* '.(!empty($filt) ? ', p.ptype' : '').' FROM '.(!empty($filt) ? $this -> mTbAlbumsPr.' p,' : '').' '.$this -> mTbAlbums.' a
    		WHERE a.aid = ?';
        if ($filt)
        {
            $sq_f = $this -> _initFilts($filt);
            $sql .= $sq_f ? ' AND ('.$sq_f.')' : '';
            $sql .= ' AND p.aid = a.aid AND p.uid = a.uid';
        }

        $r = $this -> mDb -> getRow($sql, array($id));

        return $r;
    }/* GetAlbum*/

    
    /* eugene, filters not tested */
    public function GetRandomUAlbums ( $uid, $filt = array())
    {
        $sql = 'SELECT a.*, RAND() as ordf, COUNT(i.id) AS cnt_img, a.name AS aname, a.type AS atype, vi.img, vi.fpath '.(!empty($filt) ? ', p.ptype' : '').'
				FROM '.(!empty($filt) ? $this -> mTbAlbumsPr.' p,':'').'('.$this -> mTbAlbums.' a LEFT JOIN '.$this -> mTbAlbumsImg.' i ON ( a.aid = i.aid  ))
				LEFT JOIN '.$this -> mTbAlbumsImg.' vi ON (a.last_image = vi.id)
				WHERE a.uid = ? AND a.type = 1';

        if ($filt)
        {
            $sq_f = $this -> _initFilts($filt);
            $sql .= $sq_f ? ' AND ('.$sq_f.')' : '';
            $sql .= ' AND p.aid = a.aid AND p.uid = a.uid';
        }

        $sql .= ' GROUP BY a.aid ORDER BY ordf LIMIT 3';

        $db = $this -> mDb -> query( $sql, array($uid) );


        $r = array();
        while ($row = $db -> fetchRow())
        {
            if ($row['last_image'])
                $row['img'] = $this ->GetPhoto($row['aid'], $row['last_image']);
            if (count($row['img']) == 0)
                $row['img'] = $this ->GetLastPhoto($row['aid']);

            $r[]= $row;
        }

        return $r;
    }


    public function GetUAlbums( $uid = -1, $type = -1, $first = -1, $pcnt = -1, $sort = -1, $filt = array(), $filter = -1, $with_last_image = 0 )
    {
        /**
         * atype - album types -1 - system, 2 - user's
         */

        /*
        $sql = 'SELECT * FROM '.$this -> mTbAlbums;
        $db  = $this -> mDb -> query($sql);
        while ($row = $db -> FetchRow())
        {
            $nid = $this -> mDb -> getOne('SELECT id FROM '.$this -> mTbAlbumsImg.' WHERE aid = ? ORDER BY dt LIMIT 1', array($row['aid']));
            $this -> mDb -> query('UPDATE '.$this -> mTbAlbums.' SET last_image = ? WHERE aid = ?',
                    array($nid, $row['aid']));
        }
        exit();
        */

        /* $sql = 'SELECT a.*, '.(!empty($filt) ? 'p.ptype,' : '').' COUNT(i.id) AS cnt_img
                '.($with_last_image ? ', a.name AS aname, a.type AS atype, vi.img, vi.fpath' : '').'
                FROM '.(!empty($filt) ? $this -> mTbAlbumsPr.' p,' : '').' '.$this -> mTbAlbums.' a
    	        LEFT JOIN '.$this -> mTbAlbumsImg.' i ON ( a.aid = i.aid  )
    		'; */

        $sql = 'SELECT a.*, p2.ptype as aptype, '.(!empty($filt) ? 'p.ptype,' : '').' COUNT(i.id) AS cnt_img
                '.($with_last_image ? ', a.name AS aname, a.type AS atype, vi.img, vi.fpath' : '').'
                FROM '.(!empty($filt) ? $this -> mTbAlbumsPr.' p,' : '').' '.$this -> mTbAlbums.' a
    	        LEFT JOIN '.$this -> mTbAlbumsImg.' i ON ( a.aid = i.aid  ) LEFT JOIN '.$this -> mTbAlbumsPr.' p2 ON (p2.aid = a.aid)
    		';

        if ($with_last_image)
        {
            $sql .= ' RIGHT JOIN '.$this -> mTbAlbumsImg.' vi ON (a.last_image = vi.id) ';
        }

        $sql .= ' WHERE 1 ';

        if (-1 != $uid)
        {
            $sql .= ' AND a.uid = '.$uid;
        }

        if ($filt)
        {
            $sq_f = $this -> _initFilts($filt);
            $sql .= $sq_f ? ' AND ('.$sq_f.')' : '';
            $sql .= ' AND p.aid = a.aid AND p.uid = a.uid';
        }

        if (-1 != $filter)
        {
            $sql .= ' AND '.$filter;
        }
        if (-1 != $type)
        {
            $sql .= ' AND a.type = '.$type;
        }

        $sql .= ' GROUP BY a.aid';
        if (-1 != $sort)
        {
            $sql .= ' ORDER BY '.$sort;
        }
        else
        {
            $sql .= ' ORDER BY a.aid DESC';
        }
        if (-1 != $first && -1 != $pcnt)
        {
            $db = $this -> mDb -> limitQuery( $sql, $first, $pcnt );
        }
        else
        {
            $db = $this -> mDb -> query( $sql );
        }

        $r = array();
        while ($row = $db -> fetchRow())
        {
            switch($row['aptype'])
            {
                case 0: $row['aptype_t'] = 'everyone';
                    break;
                case 1: $row['aptype_t'] = 'friends and followers';
                    break;
                case 2: $row['aptype_t'] = 'friends only';
                    break;
                case 3: $row['aptype_t'] = 'family only';
                    break;
                case 5: $row['aptype_t'] = 'me only';
                    break;

            }
            $r[]= $row;
        }
        return $r;
    }/* GetUAlbums */

    /*
     * Get Album's Photos
    */
    public function GetPhotos( $aid = -1, $uid = -1, $first = -1, $pcnt = -1, $sort = -1, $tag = -1, $allowed_alb = array() )
    {
        // Search by tag
        if(-1 != $tag && -1 != $uid)
        {
            $gtid = $this -> CheckTagExist( $uid, $tag );
            if($gtid)
            {
                $sql = 'SELECT i.*, COUNT(ic.id) AS cnt_com, a.type as a_type, a.name as a_name
						FROM  ' . $this -> mTbAlbums . ' a, ' . $this -> mTbAlbumsImg . ' i
                        LEFT JOIN ' . $this -> mTbAlbumsImgCom . ' ic ON ( ic.iid = i.id )
                        RIGHT JOIN ' . $this -> mTbAlbumsTagsList . ' tl ON ( i.id = tl.pid ) 
						WHERE tl.gtid = ' . $gtid . ' AND a.aid = i.aid';

				if (!empty($allowed_alb)) {
					$sql .= ' AND a.aid IN('.join(',', $allowed_alb).') ';
				}

            }
            else
            {
                return array();
            }
        }
        // Not by tag
        else
        {
            $sql = 'SELECT i.*, COUNT(ic.id) AS cnt_com FROM '.$this -> mTbAlbumsImg.' i
                            LEFT JOIN '.$this -> mTbAlbumsImgCom.' ic ON ( ic.iid = i.id ) WHERE 1';
        }

        //Additional params
        if (-1 != $aid)
            $sql .= ' AND i.aid = '.$aid;

        $sql .= ' GROUP BY i.id';

        if (-1 != $sort)
            $sql .= ' ORDER BY '.$sort;
        else
            $sql .= ' ORDER BY i.id DESC';

        //Results
        if (-1 != $first && -1 != $pcnt)
            $db = $this -> mDb -> limitQuery( $sql, $first, $pcnt );
        else
            $db = $this -> mDb -> query( $sql );
        $r = array();
        while ($row = $db -> fetchRow())
        {
            $r[]= $row;
        }
        return $r;
    }/* GetPhotos */

	public function GetPhotosCount( $aid = -1, $uid = -1, $first = -1, $pcnt = -1, $sort = -1, $tag = -1, $allowed_alb = array() )
    {
        // Search by tag
        if(-1 != $tag && -1 != $uid)
        {
            $gtid = $this -> CheckTagExist( $uid, $tag );
            if($gtid)
            {
                $sql = 'SELECT COUNT(i.id)
						FROM  ' . $this -> mTbAlbums . ' a, ' . $this -> mTbAlbumsImg . ' i
                        RIGHT JOIN ' . $this -> mTbAlbumsTagsList . ' tl ON ( i.id = tl.pid )
						WHERE tl.gtid = ' . $gtid . ' AND a.aid = i.aid';

				if (!empty($allowed_alb)) {
					$sql .= ' AND a.aid IN('.join(',', $allowed_alb).') ';
				}

            }
            else
            {
                return 0;
            }
        }
        // Not by tag
        else
        {
            $sql = 'SELECT COUNT(i.id) FROM '.$this -> mTbAlbumsImg.' i WHERE 1';
        }

		if (-1 != $aid)
            $sql .= ' AND i.aid = '.$aid;


        //Results
        $res =  $this -> mDb -> getOne( $sql );
		//deb($this -> mDb -> last_query);
		return $res;
    }/* GetPhotos */

    /*
     * Get Album's Photos
    */
    public function GetPhoto( $aid, $pid )
    {
        $sql = 'SELECT ai.*, a.type AS atype, a.name AS aname FROM '.$this -> mTbAlbumsImg.' ai
    			LEFT JOIN '.$this -> mTbAlbums.' a ON ( a.aid = ai.aid ) 
    			WHERE ai.aid = ? AND ai.id = ?';
        $r = $this -> mDb -> getRow($sql, array($aid, $pid));
        return $r;
    }/* GetPhoto */

    public function GetAlbumByPhoto($pid, $uid)
    {
        $sql = 'SELECT * FROM '.$this -> mTbAlbums.' a
						WHERE a.aid = (SELECT aid FROM '.$this -> mTbAlbumsImg.' ai WHERE ai.id = ?)
						  AND a.uid = ?';
        return $this -> mDb -> getRow($sql, array($pid, $uid));
    }

    /*
     * Get Album's Photos
    */
    public function GetLastPhoto( $aid )
    {
        $sql = 'SELECT * FROM '.$this -> mTbAlbumsImg.'
    		WHERE aid = ? 
    		ORDER BY id DESC LIMIT 1';
        $r = $this -> mDb -> getRow($sql, array($aid));
        return $r;
    }/* GetPhoto */

    /*
     * Get User's Wall Photos
    */
    public function GetUWallPhotos( $uid )
    {
        $sql = 'SELECT uw.p_img_1, uw.p_img_2, uw.p_img_3, uw.pdate, uw.p_path FROM '.$this -> mTbUWall.' uw
    			WHERE uw.mtype = 4 AND uw.wuid = ? 
    			ORDER BY uw.wuid DESC';
        $db = $this -> mDb -> query($sql, array($uid));
        $r = array();
        while ($row = $db -> fetchRow())
        {
            $r[]= $row;
        }
        return $r;
    }/* GetUWallPhotos */

    /*
     * Get User's Mission Wall Photos
    */
    public function GetMWallPhotos( $uid )
    {
        $sql = 'SELECT mw.p_img_1, mw.p_img_2, mw.p_img_3, mw.pdate, mw.p_path FROM '.$this -> mTbMWall.' mw
    			WHERE mw.mtype = 4 
    			ORDER BY mw.mission_id DESC';
        $db = $this -> mDb -> query($sql);
        $r = array();
        while ($row = $db -> fetchRow())
        {
            $r[]= $row;
        }
        return $r;
    }/* GetMWallPhotos */

    /*
     * Get User's Mission Wall Photos
    */
    public function GetWWallPhotos( $uid )
    {
        $sql = 'SELECT ww.p_img_1, ww.p_img_2, ww.p_img_3, ww.pdate, ww.p_path FROM '.$this -> mTbWWall.' ww
    			WHERE ww.mtype = 4 
    			ORDER BY ww.wid DESC';
        $db = $this -> mDb -> query($sql);
        $r = array();
        while ($row = $db -> fetchRow())
        {
            $r[]= $row;
        }
        return $r;
    }/* GetWWallPhotos */

    /*
     * Get Next or Previus Photos
    */
    public function GetNPImg( $aid, $id, $act = 1, $order = -1 )
    {
        if (1 == $act)
            $sign = '>';
        else
            $sign = '<';

        $sql = 'SELECT id FROM '.$this -> mTbAlbumsImg.' WHERE aid = ? AND id '.$sign.' ?';
        if (-1 != $order)
            $sql .= ' ORDER BY '.$order;
        $sql .= ' LIMIT 1';
        //echo $sql.'<br />';

        return $this -> mDb -> getOne($sql, array($aid, $id));
    }/* GetNPImg */

    public function GetAlbImgLastCom( $aid, $pid )
    {
        $sql = 'SELECT ic.*, u.public_name, u.fpath, u.image, u.fpath
					FROM '.$this -> mTbAlbumsImgCom.' ic  
					LEFT JOIN '.$this -> mTbUsers.' u ON ( u.uid = ic.user_id ) 
					WHERE ic.aid = ? AND ic.iid = ? ORDER BY ic.id DESC';
        $r = $this -> mDb -> getRow( $sql, array($aid, $pid) );
        return $r;
    }/* GetAlbImgLastCom */

    public function GetAlbImgCom( $what = array(), $wpar = array(), $wval = array(), $first = -1, $pcnt = -1, $order = -1, $limit = -1 )
    {
        $r = array();
        if (!empty($wpar))
            $sql = 'SELECT ic.'.join(", ic.", $what).', ai.img, ai.descr, u.public_name, u.first_name, u.last_name, u.fpath AS user_fpath, u.image, u.fpath  AS user_image
					FROM '.$this -> mTbAlbumsImgCom.' ic 
					LEFT JOIN '.$this -> mTbUsers.' u ON ( u.uid = ic.user_id ) 
					LEFT JOIN '.$this -> mTbAlbumsImg.' ai ON ( ai.id = ic.iid ) 
					WHERE '.gen_plh( $wpar, 2 );
        else
            $sql = 'SELECT ic.'.join(", ic.", $what).' FROM '.$this -> mTbAlbumsImgCom;

        if (-1 != $order)
            $sql .= 'ORDER BY ic.'.$order;

        if (-1 != $limit)
            $sql .= 'LIMIT ic.'.$limit;

        if (-1 != $first && -1 != $pcnt)
            $ar_res = $this -> mDb -> limitQuery( $sql, $first, $pcnt, $wval );
        else
            $ar_res = $this -> mDb -> query( $sql, $wval );

        while ($ar_fetched = $ar_res -> fetchRow())
        {
            $r[]= $ar_fetched;
        }
        return $r;
    }/* GetInfo */

    public function GetListByFilt( $what = array(), $fpar = array(), $fval = array(), $sort = -1, $first = 0, $cnt = 0 )
    {
        $tb_ind = 1;
        $r = array();

        $tables = array();
        $dbT = $this -> mDb -> query('SHOW TABLES');
        while ($ar_fT = $dbT -> fetchRow())
        {
            if ( substr_count($ar_fT['Tables_in_inz'], '_users_wall_') &&
                    !substr_count($ar_fT['Tables_in_inz'], '_users_wall_answ_') &&
                    !substr_count($ar_fT['Tables_in_inz'], '_users_wall_tag_') &&
                    !substr_count($ar_fT['Tables_in_inz'], '_users_wall_privacy_') )
            {
                $tables[] = $ar_fT['Tables_in_inz'];
            }
        }

        $sql = 'SELECT '.join(', ', $what).', u.email, u.first_name, u.last_name, u.image, u.fpath
					FROM '.join(' w, ', $tables).' w 
				    LEFT JOIN '.$this -> mTbUsers.' u ON (u.uid = w.uid)
				    WHERE ( '.gen_plh($fpar, 4).' )';

        /*
			$sq_f = $this -> _initFilts($filt);
			$sql .= $sq_f ? ' AND ('.$sq_f.')' : '';
        */

        if (-1 != $sort)
            $sql .= ' ORDER BY '.$sort;
        else
            $sql .= ' ORDER BY w.pdate DESC';

        if ($cnt)
            $db = $this -> mDb -> limitQuery( $sql, $first, $cnt, $fval );
        else
            $db = $this -> mDb -> query( $sql, $fval );

        while ($ar_f = $db -> fetchRow())
        {
            $r[] = $ar_f;
        }
        return $r;
    }/* GetListByFilt */

    public function EditAlbum($ai, $aid = -1, $uid = -1) // edit Album

    {
        if (-1 != $aid)
        {
            $res = gen_plh2($ai);
            $sql = "UPDATE ".$this->mTbAlbums." SET ".$res[0].", updated = NOW() WHERE aid = ".$aid;
            $this -> mDb -> query($sql, $res[1]);
        }
        else
        {
            $res = gen_plh2($ai, 0);
            if (-1 != $uid)
            {
                $sql = "INSERT INTO  ".$this->mTbAlbums." ( ".join(", ", $res[2]).", created, updated, uid ) VALUES ( ".$res[0].", NOW(), NOW(), ".$uid." )";
                $this -> mDb -> query($sql, $res[1]);
                return $this -> mDb -> getOne( 'SELECT LAST_INSERT_ID()' );
            }
        }
    }/* EditAlbum */

    /* Add & Edit Album Privacy
	 * 
	 * @param $ptype - privacy type 
	 * @param $aid - album's ID 
	 * @param $uid - user's ID 
	 * @return if Add - LID, else - void 
    */
    public function EditPrivacy( $uid, $ptype, $aid, $uvid = 0 )
    {
        $privacy = $this -> mDb -> getOne('SELECT ptype FROM '.$this -> mTbAlbumsPr.' WHERE uid = ? AND aid = ?', array( $uid, $aid ));
        if (!isset($privacy))
        {
            $sql = 'INSERT INTO '.$this -> mTbAlbumsPr.' ( ptype, aid, uid, uvid )
					VALUES ( ?, ?, ?, ? )';
            $this -> mDb -> query( $sql, array( $ptype, $aid, $uid, $uvid ) );
            return $this -> mDb -> getOne( 'SELECT LAST_INSERT_ID()' );
        }
        else
        {
            $sql = 'UPDATE '.$this -> mTbAlbumsPr.' SET ptype = ?, uid = ?, uvid = ?
					WHERE aid = ?';
            $this -> mDb -> query($sql, array( $ptype, $uid, $uvid, $aid ));
        }
    }/* EditPrivacy */


    public function UpdImg( $wpar = array(), $wval = array(), $whpar = array(), $whval = array() )
    {

        if (empty($whpar))
        {
            $sql = 'INSERT INTO '.$this -> mTbAlbumsImg.' ( '.join(", ", $wpar).', dt )
					VALUES ( '.gen_plh($wval, 0).', NOW() )';

            $this -> mDb -> query( $sql, $wval);
            $lid = $this -> mDb -> getOne( 'SELECT LAST_INSERT_ID()' );
        }
        else
        {
            $sql = 'UPDATE '.$this->mTbAlbumsImg.' SET '.gen_plh( $wpar, 1 ).' WHERE '.gen_plh( $whpar, 2 );
            $val = array_merge($wval, $whval);
            $this -> mDb -> query( $sql, $val);
            $lid = $whval[0];
        }

        /** update album last element */
        $this -> mDb -> query('UPDATE '.$this -> mTbAlbums.' SET last_image = ? WHERE aid = ?', array($lid, $wval[0]));
        return $lid;

    }/* UpdImg */

    public function EditImgCom( $wpar = array(), $wval = array(), $whpar = array(), $whval = array() )
    {
        if (empty($whpar))
        {
            $sql = 'INSERT INTO '.$this -> mTbAlbumsImgCom.' ( '.join(', ', $wpar).', dt )
					VALUES ( '.gen_plh($wval, 0).', NOW() )';

            $this -> mDb -> query( $sql, $wval);
            $lid = $this -> mDb -> getOne( 'SELECT LAST_INSERT_ID()' );

            //if (-1 != $aid)
            //	$this -> mDb -> query('UPDATE '.$this -> mTbAlbums.' SET com_qty = com_qty + 1 WHERE aid = '.$aid);
            return $lid;
        }
        else
        {
            $sql = 'UPDATE '.$this -> mTbAlbumsImgCom.' SET '.gen_plh( $wpar, 1 ).' WHERE '.gen_plh( $whpar, 2 );
            $val = array_merge($wval, $whval);
            $this -> mDb -> query( $sql, $val);
        }
    }/* EImgCom */

    public function ChngAlbum( $pid, $aid )
    {
        $sql = 'UPDATE '.$this -> mTbAlbumsImg.' SET aid = ? WHERE id = ?';
        $this -> mDb -> query( $sql, array($aid, $pid));
    }/* ChngAlbum */

    public function Del ( $aid, $uid )
    {
        $ex = $this -> mDb -> getOne( 'SELECT aid FROM '.$this -> mTbAlbums.' WHERE aid = ? AND uid =  ? ', array( $aid, $uid ) );
        if ($ex)
        {
            if ($this -> mDb -> query('DELETE FROM '.$this -> mTbAlbums.' WHERE aid = ? AND uid = ?', array( $aid, $uid ) ))
                if ($this -> mDb -> query('DELETE FROM '.$this -> mTbAlbumsImg.' WHERE aid = ?', array( $aid )))
                    if ($this -> mDb -> query('DELETE FROM '.$this -> mTbAlbumsImgCom.' WHERE aid = ?', array( $aid )))
                        return true;
        }
    }/* DelPhoto */

    public function DelPhoto ( $aid, $pid )
    {
        $sql1 = 'DELETE FROM '.$this -> mTbAlbumsImg.' WHERE id = ? AND aid = ?';
        $this -> mDb -> query( $sql1, array( $pid, $aid ) );
        $sql2 = 'DELETE FROM '.$this -> mTbAlbumsImgCom.' WHERE iid = ? AND aid = ?';
        $this -> mDb -> query( $sql2, array( $pid, $aid ) );

        $wall_ex = $this -> mDb -> getRow('SELECT id, p_img_1, p_img_2, p_img_3, p_img_1_id, p_img_2_id, p_img_3_id FROM '.$this -> mTbUWall.' WHERE p_img_aid = ? AND ( p_img_1_id = '.$pid.' OR p_img_2_id = '.$pid.' OR p_img_3_id = '.$pid.' ) ', array($aid));
        if ($wall_ex)
        {
            $this -> mDb -> query('UPDATE '.$this -> mTbUWall.' SET id = id '.( ($pid == $wall_ex['p_img_1_id']) ? ', p_img_1_id = 0' : '' ).' '.( ($pid == $wall_ex['p_img_2_id']) ? ', p_img_2_id = 0' : '' ).' '.( ($pid == $wall_ex['p_img_3_id']) ? ', p_img_3_id = 0' : '' ).' WHERE p_img_aid = ? ', array($aid));
        }
        $miss_ex = $this -> mDb -> getRow('SELECT id, p_img_1, p_img_2, p_img_3, p_img_1_id, p_img_2_id, p_img_3_id FROM '.$this -> mTbMWall.' WHERE p_img_aid = ? AND ( p_img_1_id = '.$pid.' OR p_img_2_id = '.$pid.' OR p_img_3_id = '.$pid.' ) ', array($aid));
        if ($wall_ex)
        {
            $this -> mDb -> query('UPDATE '.$this -> mTbMWall.' SET id = id '.( ($pid == $wall_ex['p_img_1_id']) ? ', p_img_1_id = 0' : '' ).' '.( ($pid == $wall_ex['p_img_2_id']) ? ', p_img_2_id = 0' : '' ).' '.( ($pid == $wall_ex['p_img_3_id']) ? ', p_img_3_id = 0' : '' ).' WHERE p_img_aid = ? ', array($aid));
        }
        $ward_ex = $this -> mDb -> getRow('SELECT id, p_img_1, p_img_2, p_img_3, p_img_1_id, p_img_2_id, p_img_3_id FROM '.$this -> mTbWWall.' WHERE p_img_aid = ? AND ( p_img_1_id = '.$pid.' OR p_img_2_id = '.$pid.' OR p_img_3_id = '.$pid.' ) ', array($aid));
        if ($ward_ex)
        {
            $this -> mDb -> query('UPDATE '.$this -> mTbWWall.' SET id = id '.( ($pid == $ward_ex['p_img_1_id']) ? ', p_img_1_id = 0' : '' ).' '.( ($pid == $ward_ex['p_img_2_id']) ? ', p_img_2_id = 0' : '' ).' '.( ($pid == $ward_ex['p_img_3_id']) ? ', p_img_3_id = 0' : '' ).' WHERE p_img_aid = ? ', array($aid));
        }

        /** update photo album */
        $vaid = $this -> mDb -> getOne('SELECT aid FROM '.$this -> mTbAlbums.' WHERE last_image = ?', array($pid));
        if ($vaid)
        {
            $next_vid = $this -> mDb -> getOne('SELECT id FROM '.$this -> mTbAlbumsImg.' WHERE aid = ? ORDER BY dt DESC LIMIT 1', array($vaid));
            if (empty($next_vid))
            {
                $next_vid = 0;
            }
            $this -> mDb -> query('UPDATE '.$this -> mTbAlbums.' SET last_image = ? WHERE aid = ?', array($next_vid, $vaid));
        }

    }/* DelPhoto */

    //-- Additional Methods

    public function EditInfo( $id = -1, $ar_k = array(), $ar_v = array() )
    {
        if (-1 == $id)
        {
            $sql = 'INSERT INTO '.$this -> mTbAlbums.' ( '.join(' ,', $ar_k).', pdate )
					VALUES ( '.gen_plh($ar_k, 0).', NOW() )';

            $this -> mDb -> query( $sql, $ar_v );
            return $this -> mDb -> getOne( 'SELECT LAST_INSERT_ID()' );
        }
        else
        {
            $sql = 'UPDATE '.$this -> mTbAlbums.' SET '.gen_plh($ar_k, 1).'
					WHERE id = ?';

            $ar_v = array_merge($ar_v, array( $id ));
            $this -> mDb -> query($sql, $ar_v);
        }
    }/* EditInfo */

    /* Gallery Tags */
    public function GetTags( $uid, $pid = 0, $onlyCount = false, $filter = '', $first= 0, $cnt = 0, $order = 0 )
    {
        $uid = (int)$uid;

        $sql = 'SELECT ' . ($onlyCount ? 'count(*)' : '*') . ' FROM ' . $this -> mTbAlbumsTagsList . ' tl
                LEFT JOIN ' . $this -> mTbAlbumsTags . ' t ON (t.id = tl.gtid) WHERE tl.uid = ?';

        //filter
        if($pid)
        {
            $sql .= ' AND tl.pid = ' . $pid;
        }
        if($filter)
        {
            $sql .= ' AND t.name LIKE "' . mysql_escape_string(strip_tags($filter)) . '%"';
        }

        //no same names!
        $sql .= ' GROUP BY t.name';

        //order
        if(!$order)
        {
            $sql .= ' ORDER BY t.id';
        }

        //pages
        $first = (int)$first;
        $cnt = (int)$cnt;
        if($first && $cnt)
        {
            $sql .= ' LIMIT ' . $first . ',' . $cnt;
        }

        //results
        if(!$onlyCount)
        {
            $db = $this -> mDb -> query($sql, array($uid));
            $res = array();
            while ($r = $db -> fetchRow())
            {
                $res[] = $r;
            }
        }
        else
        {
            $res = (int) $this -> mDb -> GetOne($sql, array($uid));
        }

        return $res;
    }
    public function AddTagToPhoto( $uid, $pid, $name )
    {
        $uid = (int)$uid;
        $pid = (int)$pid;

        if($uid && $pid && '' != $name)
        {
            $gtid = $this -> CheckTagExist( $uid, $name );

            if(!$gtid)
            {
                $gtid = $this -> AddTag($uid, $name);
            }

            if( !$this -> CheckTagExistForPhoto( $uid, $gtid, $pid ) )
            {
                $sql = 'INSERT INTO ' . $this -> mTbAlbumsTagsList . '(uid, gtid, pid, dt) VALUES (?, ?, ?, NOW())';
                $this -> mDb -> query($sql, array($uid, $gtid, $pid));
                return $this -> mDb -> getOne( 'SELECT LAST_INSERT_ID()' );
            }
        }

        return 0;
    }
    public function AddTag( $uid, $name )
    {
        $uid = (int)$uid;
        $name = strtolower(strip_tags($name));

        if($uid && '' != $name)
        {
            $sql = 'INSERT INTO ' . $this -> mTbAlbumsTags . '(uid, name, dt) VALUES (?, ?, NOW())';
            $this -> mDb -> query($sql, array($uid, $name));

            return $this -> mDb -> getOne( 'SELECT LAST_INSERT_ID()' );
        }

        return 0;
    }
    public function DelTag( $uid, $gtid )
    {
        $uid = (int)$uid;
        $gtid = (int)$gtid;
        if($gtid && $uid)
        {
            $sql = 'DELETE FROM ' . $this -> mTbAlbumsTags . ' WHERE id = ? AND uid = ?';
            $this -> mDb -> query($sql, array($gtid, $uid));

            $sql = 'DELETE FROM ' . $this -> mTbAlbumsTagsList . ' WHERE tgid = ? AND uid = ?';
            $this -> mDb -> query($sql, array($gtid, $uid));

            return 1;
        }
        return 0;
    }
    public function DelTagFromPhoto( $uid, $gtid, $pid )
    {
        $uid = (int)$uid;
        $gtid = (int)$gtid;
        $pid = (int)$pid;
        if($gtid && $uid && $pid)
        {
            $sql = 'DELETE FROM ' . $this -> mTbAlbumsTagsList . ' WHERE gtid = ? AND uid = ? AND pid = ?';
            $this -> mDb -> query($sql, array($gtid, $uid, $pid));

            return 1;
        }
        return 0;
    }
    public function CheckTagExist( $uid, $name )
    {
        $uid = (int)$uid;
        $sql = 'SELECT id FROM ' . $this -> mTbAlbumsTags . ' WHERE uid = ? AND name = ?';
        $h = $this -> mDb -> GetOne($sql, array($uid, $name));
		return $h;
    }
    public function CheckTagExistForPhoto( $uid, $gtid, $pid )
    {
        $uid = (int)$uid;
        $gtid = (int)$gtid;
        $pid = (int)$pid;
        $sql = 'SELECT id FROM ' . $this -> mTbAlbumsTagsList . ' WHERE uid = ? AND gtid = ? AND pid = ?';
        return $this -> mDb -> GetOne($sql, array($uid, $gtid, $pid));
    }

    public function UpdViewed($pid, $aid)
    {
        $this -> mDb -> query('UPDATE '.$this -> mTbAlbumsImg.' SET viewed = viewed + 1 WHERE id = ? AND aid = ? LIMIT 1', array($pid, $aid));
    }


}/* Model_Base_Albums */
?>