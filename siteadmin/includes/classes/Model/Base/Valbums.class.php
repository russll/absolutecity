<?php

/**
 * Valbums Base model
 * @package    5dev Catalog
 * @version    1.0
 * @since      1.03.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */
class Model_Base_Valbums
{

    //system params
    private $mDb;
    //tables
    /** Video Albums */
    private $mTbValbums;
    /** Video in albums */
    private $mTbValbumsV;

    /** comments to videos */
    private $mTbValbumsVCom;
    private $mTbValbumsTmp;
    private $mTbUsers;
    private $mTbUWall;
    private $mTbMWall;
    private $mTbWWall;

    /**
     * Constructor
     *
     * @param $glObj
     */
    public function __construct(&$gDb)
    {
        //wall's tables
        $this->mDb = & $gDb;
        $this->mTbValbums = TB . 'users_valbums';
        $this->mTbValbumsV = TB . 'users_valbums_video';
        $this->mTbValbumsVCom = TB . 'users_valbums_comments';
        $this->mTbUsers = TB . 'users';


        $this->mTbUWall = TB . 'users_wall';
        $this->mTbMWall = TB . 'mission_wall';
        $this->mTbWWall = TB . 'wards_wall';
    }


    //Get list of the Tables
    public function GetTables()
    {
        $sql = "SHOW TABLES";
        $db = $this->mDb->query($sql);
        while ($ar_f = $db->fetchRow())
        {
            $r[] = $ar_f['Tables_in_inz'];
        }
        return array_values($r);
    }


    public function GetCntAlb($uid = -1)
    {
        $sql = 'SELECT COUNT(vaid) FROM ' . $this->mTbValbums;
        if (-1 != $uid)
        {
            $sql .= ' WHERE uid = ?';
        }
        return $this->mDb->getOne($sql, array($uid));
    }


    public function GetCntVideoCom($vid = -1)
    {
        $sql = 'SELECT COUNT(id) FROM ' . $this->mTbValbumsVCom;
        if (-1 != $vid)
            $sql .= ' WHERE vid = ?';
        return $this->mDb->getOne($sql, array($vid));
    }


    public function GetCntVideoComByUID($uid = -1)
    {
        $sql = 'SELECT COUNT(id) FROM ' . $this->mTbValbumsVCom;
        if (-1 != $uid)
            $sql .= ' WHERE user_id = ' . $uid;
        return $this->mDb->getOne($sql);
    }


    public function GetVAlbum($id = -1)
    {
        $sql = 'SELECT * FROM ' . $this->mTbValbums . ' WHERE vaid = ?';
        $r = $this->mDb->getRow($sql, array($id));
        return $r;
    }

    public function GetUValbums($uid = -1, $type = -1, $first = -1, $pcnt = -1, $sort = -1, $filter = -1, $with_last_video = 0)
    {
        $sql = 'SELECT a.*, COUNT(i.id) AS cnt_video
               ' . ($with_last_video ? ', a.name AS aname, a.type AS atype, vv.video' : '') . '
                FROM ' . $this->mTbValbums . ' a
                LEFT JOIN ' . $this->mTbValbumsV . ' i ON ( i.vaid = a.vaid )
    			';
        if ($with_last_video)
        {
            $sql .= ' LEFT JOIN ' . $this->mTbValbumsV . ' vv ON (a.last_video = vv.id) ';
        }

        $sql .= ' WHERE 1 ';
        if (-1 != $uid)
        {
            $sql .= ' AND a.uid = ' . (int) $uid;
        }

        if (-1 != $type)
        {
            $sql .= ' AND a.type = ' . $type;
        }

        $sql .= ' GROUP BY a.vaid';
        if (-1 != $sort)
        {
            $sql .= ' ORDER BY ' . $sort;
        } else
        {
            $sql .= ' ORDER BY a.vaid DESC';
        }

        if (-1 != $first && -1 != $pcnt)
        {
            $db = $this->mDb->limitQuery($sql, $first, $pcnt);
        } else
        {
            $db = $this->mDb->query($sql);
        }

        $r = array();
        while ($row = $db->fetchRow())
        {
            if (!empty($row['video']))
            {
                $res = chk_embed_code($row['video'], 350, 250, 1);
                if (!empty($res))
                {
                    $row['video'] = $res[0];
                    $row['video_img'] = $res[1];
                }
            }

            $r[] = $row;
        }
        return $r;
    }


    public function GetRandomUAlbums($uid, $filt = array())
    {
        $sql = 'SELECT a.*, RAND() as ordf, COUNT(i.id) AS cnt_video, a.name AS aname, a.type AS atype, i.video
				FROM ' . $this->mTbValbums . ' a LEFT JOIN ' . $this->mTbValbumsV . ' i ON(a.vaid = i.vaid)
				WHERE a.uid = ? AND a.type = 1 GROUP BY a.vaid ORDER BY ordf LIMIT 3';

        $db = $this->mDb->query($sql, array($uid));

        $r = array();
        while ($row = $db->fetchRow())
        {
            //$last_video = $this->GetLastVideo($row['vaid']);
            if (!empty($row['video']))
            {
                $res = chk_embed_code($row['video'], 350, 250, 1);
                if (!empty($res))
                {
                    $row['video'] = $res[0];
                    $row['video_img'] = $res[1];
                }
            }
            $r[] = $row;
        }

        return $r;
    }


    /*
    * Get VAlbum's Videos
    */
    public function GetVideos($vaid = -1, $uid = -1)
    {
        $sql = 'SELECT * FROM ' . $this->mTbValbumsV . ' WHERE 1 ';

        if (-1 != $vaid)
        {
            $sql .= ' AND vaid = ' . $vaid;
        }

        if (-1 != $uid)
        {
            $sql .= ' AND uid = ' . $uid;
        }

        $sql .= ' ORDER BY id';
        $db = $this->mDb->query($sql);
        $r = array();
        while ($row = $db->fetchRow())
        {
            $row['video'] = chk_embed_code($row['video'], '230', '165');
            $r[] = $row;
        }
        return $r;
    }


    /*
    * Get VAlbum's Videos
    */
    public function GetVideo($vaid, $vid)
    {
        $sql = 'SELECT ai.*, a.type AS atype, a.name AS aname FROM ' . $this->mTbValbumsV . ' ai
    			LEFT JOIN ' . $this->mTbValbums . ' a ON ( a.vaid = ai.vaid )
    			WHERE ai.vaid = ? AND ai.id = ?';
        $r = $this->mDb->getRow($sql, array($vaid, $vid));
        if (!empty($r['video']))
        {
            $r['video'] = chk_embed_code($r['video'], 640, 385);
        }


        return $r;
    }


    public function GetValbumByVideo($vid, $uid)
    {
        $sql = 'SELECT * FROM ' . $this->mTbValbums . ' a
						WHERE a.vaid = (SELECT vaid FROM ' . $this->mTbValbumsV . ' ai WHERE ai.id = ?)
						  AND a.uid = ?';
        return $this->mDb->getRow($sql, array($vid, $uid));
    }

    /*
     * Get VAlbum's Videos
     */
    public function GetLastVideo($vaid)
    {
        $sql = 'SELECT * FROM ' . $this->mTbValbumsV . '
    			WHERE vaid = ? 
    			ORDER BY id DESC LIMIT 1';
        $r = $this->mDb->getRow($sql, array($vaid));
        return $r;
    }


    /*
     * Get User's Wall Videos
     */
    public function GetUWallVideos($uid)
    {
        $sql = 'SELECT uw.p_video_1, uw.p_video_2, uw.p_video_3, uw.pdate, uw.p_path FROM ' . $this->mTbUWall . ' uw
    			WHERE uw.mtype = 4 AND uw.wuid = ? 
    			ORDER BY uw.wuid DESC';
        $db = $this->mDb->query($sql, array($uid));
        $r = array();
        while ($row = $db->fetchRow())
        {
            $r[] = $row;
        }
        return $r;
    }


    /*
    * Get User's Mission Wall Videos
    */
    public function GetMWallVideos($uid)
    {
        $sql = 'SELECT mw.p_video_1, mw.p_video_2, mw.p_video_3, mw.pdate, mw.p_path FROM ' . $this->mTbMWall . ' mw
    			WHERE mw.mtype = 4 
    			ORDER BY mw.mission_id DESC';
        $db = $this->mDb->query($sql);
        $r = array();
        while ($row = $db->fetchRow())
        {
            $r[] = $row;
        }
        return $r;
    }


    /*
    * Get User's Mission Wall Videos
    */
    public function GetWWallVideos($uid)
    {
        $sql = 'SELECT ww.p_video_1, ww.p_video_2, ww.p_video_3, ww.pdate, ww.p_path FROM ' . $this->mTbWWall . ' ww
    			WHERE ww.mtype = 4 
    			ORDER BY ww.wid DESC';
        $db = $this->mDb->query($sql);
        $r = array();
        while ($row = $db->fetchRow())
        {
            $r[] = $row;
        }
        return $r;
    }


    /*
     * Get Next or Previus Videos
     */

    public function GetNPVideo($vaid, $id, $act = 1, $order = -1)
    {
        if (1 == $act)
            $sign = '>';
        else
            $sign = '<';

        $sql = 'SELECT id FROM ' . $this->mTbValbumsV . ' WHERE vaid = ? AND id ' . $sign . ' ?';
        if (-1 != $order)
            $sql .= ' ORDER BY ' . $order;
        $sql .= ' LIMIT 1';
        return $this->mDb->getOne($sql, array($vaid, $id));
    }


    public function GetAlbVideoLastCom($vaid, $vid)
    {
        $sql = 'SELECT ic.*, u.public_name, u.first_name, u.last_name, u.fpath, u.image, u.fpath
					FROM ' . $this->mTbValbumsVCom . ' ic
					LEFT JOIN ' . $this->mTbUsers . ' u ON ( u.uid = ic.user_id )
					WHERE ic.vaid = ? AND ic.vid = ? ORDER BY ic.id DESC';
        $r = $this->mDb->getRow($sql, array($vaid, $vid));
        return $r;
    }


    public function GetAlbVideoCom($what = array(), $wpar = array(), $wval = array(), $first = -1, $pcnt = -1, $order = -1, $limit = -1)
    {
        $r = array();
        if (!empty($wpar))
            $sql = 'SELECT ic.' . join(", ic.", $what) . ', ai.video, ai.descr, u.public_name, u.first_name, u.last_name, u.fpath AS user_fpath, u.image, u.fpath  AS user_image
					FROM ' . $this->mTbValbumsVCom . ' ic
					LEFT JOIN ' . $this->mTbUsers . ' u ON ( u.uid = ic.user_id )
					LEFT JOIN ' . $this->mTbValbumsV . ' ai ON ( ai.id = ic.vid )
					WHERE ' . gen_plh($wpar, 2);
        else
            $sql = 'SELECT ic.' . join(", ic.", $what) . ' FROM ' . $this->mTbValbumsVCom;

        if (-1 != $order)
            $sql .= 'ORDER BY ic.' . $order;

        if (-1 != $limit)
            $sql .= 'LIMIT ic.' . $limit;

        if (-1 != $first && -1 != $pcnt)
            $ar_res = $this->mDb->limitQuery($sql, $first, $pcnt, $wval);
        else
            $ar_res = $this->mDb->query($sql, $wval);

        while ($ar_fetched = $ar_res->fetchRow())
        {
            $r[] = $ar_fetched;
        }
        return $r;
    }


    public function GetListByFilt($what = array(), $fpar = array(), $fval = array(), $sort = -1, $first = 0, $cnt = 0)
    {
        $tb_ind = 1;
        $r = array();

        $tables = array();
        $dbT = $this->mDb->query('SHOW TABLES');
        while ($ar_fT = $dbT->fetchRow())
        {
            if (substr_count($ar_fT['Tables_in_inz'], '_users_wall_') &&
                    !substr_count($ar_fT['Tables_in_inz'], '_users_wall_answ_') &&
                    !substr_count($ar_fT['Tables_in_inz'], '_users_wall_tag_') &&
                    !substr_count($ar_fT['Tables_in_inz'], '_users_wall_privacy_'))
            {
                $tables[] = $ar_fT['Tables_in_inz'];
            }
        }

        $sql = 'SELECT ' . join(', ', $what) . ', u.email, u.first_name, u.last_name, u.image, u.fpath
					FROM ' . join(' w, ', $tables) . ' w
				    LEFT JOIN ' . $this->mTbUsers . ' u ON (u.uid = w.uid)
				    WHERE ( ' . gen_plh($fpar, 4) . ' )';

        /*
          $sq_f = $this -> _initFilts($filt);
          $sql .= $sq_f ? ' AND ('.$sq_f.')' : '';
         */

        if (-1 != $sort)
            $sql .= ' ORDER BY ' . $sort;
        else
            $sql .= ' ORDER BY w.pdate DESC';

        if ($cnt)
            $db = $this->mDb->limitQuery($sql, $first, $cnt, $fval);
        else
            $db = $this->mDb->query($sql, $fval);

        while ($ar_f = $db->fetchRow())
        {
            $r[] = $ar_f;
        }
        return $r;
    }


    public function EditVAlbum($ai, $vaid = -1, $uid = -1) // edit VAlbum
    {
        if (-1 != $vaid)
        {
            $res = gen_plh2($ai);
            $sql = "UPDATE " . $this->mTbValbums . " SET " . $res[0] . ", updated = NOW() WHERE vaid = " . $vaid;
            $this->mDb->query($sql, $res[1]);
        } else
        {
            $res = gen_plh2($ai, 0);
            if (-1 != $uid)
            {
                $sql = "INSERT INTO  " . $this->mTbValbums . " ( " . join(", ", $res[2]) . ", created, updated, uid ) VALUES ( " . $res[0] . ", NOW(), NOW(), " . $uid . " )";
                $this->mDb->query($sql, $res[1]);
                return $this->mDb->getOne('SELECT LAST_INSERT_ID()');
            }
        }
    }


    /**
     * Update Video
     * @param array $wpar
     * @param array $wval
     * @param array $whpar
     * @param array $whval
     * @return int $id
     */
    public function UpdVideo($wpar = array(), $wval = array(), $whpar = array(), $whval = array())
    {
        if (empty($whpar))
        {
            $sql = 'INSERT INTO ' . $this->mTbValbumsV . ' ( ' . join(", ", $wpar) . ', dt )
					VALUES ( ' . gen_plh($wval, 0) . ', NOW() )';

            $this->mDb->query($sql, $wval);
            $lid = $this->mDb->getOne('SELECT LAST_INSERT_ID()');
        } else
        {
            $sql = 'UPDATE ' . $this->mTbValbumsV . ' SET ' . gen_plh($wpar, 1) . ' WHERE ' . gen_plh($whpar, 2);
            $val = array_merge($wval, $whval);
            $this->mDb->query($sql, $val);
            $lid = $whval[0];
        }

        /** update album last element */
        $this->mDb->query('UPDATE ' . $this->mTbValbums . ' SET last_video = ? WHERE vaid = ?', array($lid, $wval[0]));

        return $lid;
    }


    public function EditVideoCom($wpar = array(), $wval = array(), $whpar = array(), $whval = array())
    {
        if (empty($whpar))
        {
            $sql = 'INSERT INTO ' . $this->mTbValbumsVCom . ' ( ' . join(', ', $wpar) . ', dt )
					VALUES ( ' . gen_plh($wval, 0) . ', NOW() )';

            $this->mDb->query($sql, $wval);
            $lid = $this->mDb->getOne('SELECT LAST_INSERT_ID()');

            //if (-1 != $vaid)
            //	$this -> mDb -> query('UPDATE '.$this -> mTbValbums.' SET com_qty = com_qty + 1 WHERE vaid = '.$vaid);
            return $lid;
        } else
        {
            $sql = 'UPDATE ' . $this->mTbValbumsVCom . ' SET ' . gen_plh($wpar, 1) . ' WHERE ' . gen_plh($whpar, 2);
            $val = array_merge($wval, $whval);
            $this->mDb->query($sql, $val);
        }
    }


    public function ChngVAlbum($vid, $vaid)
    {
        $sql = 'UPDATE ' . $this->mTbValbumsV . ' SET vaid = ? WHERE id = ?';
        $this->mDb->query($sql, array($vaid, $vid));
    }


    public function Del($vaid, $uid)
    {
        $ex = $this->mDb->getOne('SELECT vaid FROM ' . $this->mTbValbums . ' WHERE vaid = ? AND uid =  ? ', array($vaid, $uid));
        if ($ex)
        {
            if ($this->mDb->query('DELETE FROM ' . $this->mTbValbums . ' WHERE vaid = ? AND uid = ?', array($vaid, $uid)))
            {
                if ($this->mDb->query('DELETE FROM ' . $this->mTbValbumsV . ' WHERE vaid = ?', array($vaid)))
                {
                    if ($this->mDb->query('DELETE FROM ' . $this->mTbValbumsVCom . ' WHERE vaid = ?', array($vaid)))
                    {
                        return true;
                    }
                }
            }
        }
    }


    public function DelVideo($vaid, $vid)
    {
        /** delete video */
        $sql1 = 'DELETE FROM ' . $this->mTbValbumsV . ' WHERE id = ? AND vaid = ?';
        $this->mDb->query($sql1, array($vid, $vaid));

        $sql2 = 'DELETE FROM ' . $this->mTbValbumsVCom . ' WHERE vid = ? AND vaid = ?';
        $this->mDb->query($sql2, array($vid, $vaid));

        /** update video album */
        $vaid = $this->mDb->getOne('SELECT vaid FROM ' . $this->mTbValbums . ' WHERE last_video = ?', array($vid));
        if ($vaid)
        {
            $next_vid = $this->mDb->getOne('SELECT id FROM ' . $this->mTbValbumsV . ' WHERE vaid = ? ORDER BY dt DESC LIMIT 1', array($vaid));
            if (empty($next_vid))
            {
                $next_vid = 0;
            }
            $this->mDb->query('UPDATE ' . $this->mTbValbums . ' SET last_video = ? WHERE vaid = ?', array($next_vid, $vaid));
        }
    }


    //-- Additional Methods
    public function EditInfo($id = -1, $ar_k = array(), $ar_v = array())
    {
        if (-1 == $id)
        {
            $sql = 'INSERT INTO ' . $this->mTbValbums . ' ( ' . join(' ,', $ar_k) . ', pdate )
					VALUES ( ' . gen_plh($ar_k, 0) . ', NOW() )';

            $this->mDb->query($sql, $ar_v);
            return $this->mDb->getOne('SELECT LAST_INSERT_ID()');
        } else
        {
            $sql = 'UPDATE ' . $this->mTbValbums . ' SET ' . gen_plh($ar_k, 1) . '
					WHERE id = ?';

            $ar_v = array_merge($ar_v, array($id));
            $this->mDb->query($sql, $ar_v);
        }
    }


    public function UpdViewed($pid, $aid)
    {
        $this->mDb->query('UPDATE ' . $this->mTbValbumsV . ' SET viewed = viewed + 1 WHERE id = ? AND vaid = ? LIMIT 1', array($pid, $aid));
    }

}
?>