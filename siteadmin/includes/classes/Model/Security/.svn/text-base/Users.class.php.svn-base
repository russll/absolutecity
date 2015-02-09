<?php

/**
 * Users Class
 * @package   5dev catalog 4
 * @version   0.1a
 * @since     29.04.2006
 * @copyright 2004-2008 5dev Team
 * @link      http://5dev.com
 */
class Model_Security_Users
{

    /**
     * Users table
     * @var string
     */
    private $mTbUsers;
    /**
     * DB pointer
     * @var object
     */
    private $mDb;
    /**
     * Crypt object pointer
     * @var object
     */
    private $mRc4;
    /** current user info */
    private $mCurInfo;


    private $mTbInvites;
    private $mTbEmailBlocks;


    public function __construct(&$gDb, $gRc4)
    {
        $this->mTbUsers = TB . 'users';
        $this->mTbUsersAlb = TB . 'users_albums';
        $this->mTbUsersAlbPr = TB . 'users_albums_privacy';
        $this->mTbUsersVAlb = TB . 'users_valbums';
        $this->mTbUsersSubscr = TB . 'users_subscr';
        $this->mTbUsersJrnlSubscr = TB . 'users_journal_subscr';
        $this->mTbUsersTags = TB . 'users_tags';
        $this->mTbUsersTagsM = TB . 'users_tags_mes';
        $this->mTbUsersClasses = TB . 'users_classes';
        $this->mTbUsersMission = TB . 'users_mission';
        $this->mTbReports = TB . 'reports';
        $this->mTbInvites = TB . 'invites';
        $this->mTbEmailBlocks  = TB . 'email_blocks';


        $this->mDb = & $gDb;
        $this->mRc4 = & $gRc4;
    }

    /**
     * Change user status
     *
     * @param int   $uid user id
     * @param array $status new status value
     *
     * @return void
     */
    public function ChangeStatus($uid, $status)
    {
        $sql = 'UPDATE ' . $this->mTbUsers . '
                  SET status=? 
                  WHERE uid=?';
        $this->mDb->query($sql, array($status, $uid));
    }

#ChangeStatus

    public function ChangePassword($uid, $oldPass, $newPass)
    {
        $this->mRc4->crypt($oldPass);
        $oldPass = bin2hex($oldPass);

        $sql = 'SELECT count(*) FROM ' . $this->mTbUsers . ' WHERE uid=' . $uid . ' AND pass="' . $oldPass . '"';

        if ($this->mDb->GetOne($sql))
        {
            $this->mRc4->crypt($newPass);
            $newPass = bin2hex($newPass);
            $this->UpdValues($uid, array('pass' => $newPass));

            return true;
        }
        return false;
    }

#ChangeStatus

    public function BlockIP($uid)
    {
        $sql = 'UPDATE ' . $this->mTbUsers . ' SET ip_block = NOT ip_block WHERE uid = ?';
        $this->mDb->query($sql, array($uid));
        return true;
    }

    /** ChangeActive */
    public function ChangeAppear($uid, $offline)
    {
        $sql = 'UPDATE ' . $this->mTbUsers . ' SET appear_offline = ? WHERE uid = ?';
        $this->mDb->query($sql, array($offline, $uid));
        return true;
    }

    /** ChangeAppear */
    public function Delete($uid)
    {
        $sql = 'DELETE FROM ' . $this->mTbUsers . ' WHERE uid=?';
        $this->mDb->query($sql, array($uid));
        return true;
    }

    public function Get($uid)
    {
        $sql = 'SELECT *
                 FROM ' . $this->mTbUsers . '
                 WHERE uid = ?';
        $r = $this->mDb->getRow($sql, array($uid));
        if (!empty($r))
        {
            if (!empty($r['modules']))
            {
                $mm = explode(';', substr($r['modules'], 1, strlen($r['modules']) - 2));
                $r['modules'] = array();
                for ($i = 0; $i < count($mm); $i++)
                {
                    $r['modules'][$mm[$i]] = 1;
                }
            }
        }

        if (!empty($r) && (900 >= (strtotime('now') - strtotime($r['last_date'])) ))
        {
            $r['online'] = 1;
        }
        return $r;
    }

    public function GetByLogin($login)
    {
        $sql = 'SELECT uid
                 FROM ' . $this->mTbUsers . '
                 WHERE public_name = ?';
        $r = $this->mDb->getOne($sql, $login);
        return $r;
    }

    public function GetByFbId($fb_id)
    {
        return $this->mDb->getRow('SELECT * FROM ' . $this->mTbUsers . ' WHERE fb_id = ?', array($fb_id));
    }

    public function GetByEmailFull($email)
    {
        return $this->mDb->getRow('SELECT * FROM ' . $this->mTbUsers . ' WHERE email = ?', array($email));
    }

    /**
     * Get user ID by email
     *
     * @param string $email
     * @return int User ID
     */
    function GetByEmail($email)
    {
        $sql = 'SELECT uid
                 FROM ' . $this->mTbUsers . '
                 WHERE email = ?';
        $db = $this->mDb->query($sql, array($email));
        $r = 0;
        if ($row = $db->FetchRow())
        {
            $r = $row['uid'];
        }
        return $r;
    }

#GetByEmail

    public function CheckLoginName($login = '')
    {
        $sql = 'SELECT 1
                FROM ' . $this->mTbUsers . '
                WHERE public_name = ?';

        $r = $this->mDb->getOne($sql, $login);

        if ($r || empty($login))
        {
            return true;
        }
        else
            return false;
    }

    /** CheckLoginName */

    /**
     * Check login Unique
     *
     * @param string $login - user login
     *
     * @return bool - true - unique, false - not unique
     */
    public function CheckLoginUniq($login, $uid = 0)
    {
        $login = trim($login);
        $sql = 'SELECT 1 FROM ' . $this->mTbUsers . ' WHERE public_name = ?';
        if ($uid && is_numeric($uid))
        {
            $sql .= ' AND uid <> ' . (int) $uid;
        }

        $r = $this->mDb->getOne($sql, array($login));

        if (!$r)
        {
            return true;
        } else
        {
            return false;
        }
    }

    /** CheckLoginUniq */
    public function Add($ar)
    {
        $this->mRc4->crypt($ar['pass']);
        $bx = array($ar['login'],
            bin2hex($ar['pass']),
            strip_tags($ar['first_name']),
            strip_tags($ar['last_name']),
            $ar['email'],
            $ar['gender'],
            $ar['status'],
            $ar['modules'],
            $ar['email'],
            $ar['dob'],
            $ar['last_show']
        );

        $sql = 'INSERT INTO ' . $this->mTbUsers . ' (public_name, pass, first_name, last_name, email, gender, status, modules, notify_email, dob, last_show, created_date)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())';

        $this->mDb->query($sql, $bx);

        $id = $this->mDb->getOne("SELECT LAST_INSERT_ID()");

        $ar_name = array('Ward', 'Mission', 'Journal', 'Wall', 'Inbox');
        $ar_descr = array("Ward wall's photo(s)", "Mission wall's photo(s)", "Journal wall's photo(s)", "Profile wall's photo(s)", "Inbox's photo(s)");
        $ar_v_descr = array("Ward wall's video(s)", "Mission wall's video(s)", "Journal wall's video(s)", "Profile wall's video(s)", "Inbox's video(s)");
        foreach ($ar_name as $k => $r)
        {
            //-- insert Ablums by default
            $sql = 'INSERT INTO ' . $this->mTbUsersAlb . ' ( uid, name, descr, type, created )
        			VALUES ( ?, ?, ?, 2, NOW() )';
            $this->mDb->query($sql, array($id, $r, $ar_descr[$k]));
            $aid = $this->mDb->getOne('SELECT LAST_INSERT_ID()');

            //-- insert Privacy of Ablums by default
            $sql = 'INSERT INTO ' . $this->mTbUsersAlbPr . ' ( uid, aid )
        			VALUES ( ?, ? )';
            $this->mDb->query($sql, array($id, $aid));

            //-- insert Video Ablums by default
            $sql = 'INSERT INTO ' . $this->mTbUsersVAlb . ' ( uid, name, descr, type, created )
        			VALUES ( ?, ?, ?, 2, NOW() )';
            $this->mDb->query($sql, array($id, $r, $ar_v_descr[$k]));

            //-- insert Tags by default (favorites)
            $sql = 'INSERT INTO ' . $this->mTbUsersTags . ' ( uid, name, type, dt )
        			VALUES ( ?, ?, 2, NOW() )';
            $this->mDb->query($sql, array($id, 'Favorite'));
        }
        $sql = 'INSERT INTO ' . $this->mTbUsersTags . ' ( uid, name, type, dt )
        			VALUES ( ?, ?, 2, NOW() )';
        $this->mDb->query($sql, array($id, 'Favorite'));
        return $id;
    }

    /** Add */
    public function UpdValues($uid, $vars)
    {
        $sql = 'UPDATE ' . $this->mTbUsers . ' SET uid = uid';
        foreach ($vars as $k => &$v)
        {
            $sql .= ', ' . $k . ' = "' . mysql_escape_string($v) . '"';
        }
        $sql .= ' WHERE uid = ' . (int) $uid;
        $this->mDb->query($sql);

        return true;
    }

    /** UpdValues */
    public function UpdOptions($uid, $vars)
    {
        $sql = 'UPDATE ' . $this->mTbUsersOptions . ' SET uid = uid';

        foreach ($vars as $k => &$v)
        {
            $sql .= ', ' . $k . ' = "' . mysql_escape_string($v) . '"';
        }
        $sql .= ' WHERE uid = ' . (int) $uid;
        $this->mDb->query($sql);

        return true;
    }

/** UpdValues */

    public function GetCntSubscr($wuid = -1, $uid = -1)
    {
        $sql = 'SELECT COUNT(s.id) FROM ' . $this->mTbUsersSubscr . ' s
                RIGHT JOIN ' . $this->mTbUsers . ' u ON ( ' . (-1 != $wuid ? ' u.uid = s.uid ' : ' u.uid = s.wuid ' ) . ' AND u.checksum = "" )
                WHERE 1 ';
        if (-1 != $wuid)
            $sql .= ' AND s.wuid = ' . $wuid;
        if (-1 != $uid)
            $sql .= ' AND s.uid = ' . $uid;
        return $this->mDb->getOne($sql);
    }

    public function GetSubscr($uid = -1, $wuid = -1, $order = -1, $limit = -1, $filt = -1, $first = 0)
    {
        $sql = 'SELECT s.*, u.email, u.first_name, u.last_name, u.image, u.fpath, u.country, u.city
    			FROM ' . $this->mTbUsersSubscr . ' s
    			RIGHT JOIN ' . $this->mTbUsers . ' u ON ( ' . (-1 != $wuid ? ' u.uid = s.uid ' : ' u.uid = s.wuid ' ) . ' AND u.checksum = "" )
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
    
    public function GetCntJrnlSubscr($wuid = -1, $uid = -1)
    {
        $sql = 'SELECT COUNT(s.id) FROM ' . $this->mTbUsersJrnlSubscr . ' s
                RIGHT JOIN ' . $this->mTbUsers . ' u ON ( ' . (-1 != $wuid ? ' u.uid = s.uid ' : ' u.uid = s.wuid ' ) . ' AND u.checksum = "" )
                WHERE 1 ';
        if (-1 != $wuid)
            $sql .= ' AND s.wuid = ' . $wuid;
        if (-1 != $uid)
            $sql .= ' AND s.uid = ' . $uid;
        return $this->mDb->getOne($sql);
    }

    public function GetJrnlSubscr($uid = -1, $wuid = -1, $order = -1, $limit = -1, $filt = -1, $first = 0)
    {
        $sql = 'SELECT s.*, u.email, u.first_name, u.last_name, u.image, u.fpath, u.country, u.city
    			FROM ' . $this->mTbUsersJrnlSubscr . ' s
    			RIGHT JOIN ' . $this->mTbUsers . ' u ON ( ' . (-1 != $wuid ? ' u.uid = s.uid ' : ' u.uid = s.wuid ' ) . ' AND u.checksum = "" )
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
    /* GetJrnlSubscr */

    public function GetUsersByClass($class_id)
    {
        $class_id = (int) $class_id;
        $r = array();
        if ($class_id)
        {
            $sql = "SELECT * FROM " . $this->mTbUsersClasses . " WHERE class_id = ?";
            $db = $this->mDb->query($sql, array($class_id));
            while ($row = $db->FetchRow())
            {
                $r[] = $row;
            }
        }
        return $r;
    }

    public function ChckSubscr($uid, $wuid)
    {
        $ex = $this->mDb->getOne('SELECT id FROM ' . $this->mTbUsersSubscr . ' WHERE uid = ? AND wuid = ?', array($uid, $wuid));
        if ($ex)
            return 1;
        else
            return 0;
    }

/* ChckSubscr */

    public function ChckSubscrJrnl($uid, $wuid)
    {
        $ex = $this->mDb->getOne('SELECT id FROM ' . $this->mTbUsersJrnlSubscr . ' WHERE uid = ? AND wuid = ?', array($uid, $wuid));
        if ($ex)
            return 1;
        else
            return 0;
    }

/* ChckSubscrJrl */

    public function EditSubscr($uid, $wuid)
    {
        $ex = $this->mDb->getOne('SELECT id FROM ' . $this->mTbUsersSubscr . ' WHERE uid = ? AND wuid = ?', array($uid, $wuid));
        if (empty($ex))
        {
            $sql = 'INSERT INTO ' . $this->mTbUsersSubscr . ' ( uid, wuid, dt )
        	    VALUES ( ?, ?, NOW() )';
            $this->mDb->query($sql, array($uid, $wuid));
            return 1;
        } else
        {
            $sql = 'DELETE FROM ' . $this->mTbUsersSubscr . ' WHERE uid = ? AND wuid = ?';

            $this->mDb->query($sql, array($uid, $wuid));
            return 0;
        }
    }

/* EditSubscr */

    public function EditScripture($uid, $scr = '')
    {
        $sql = 'UPDATE ' . $this->mTbUsers . ' SET scripture = ?, scripture_dt = NOW() WHERE uid = ? ';
        $this->mDb->query($sql, array($scr, $uid));
    }

    /* EditSscripture */

    public function ChckTags($id)
    {
        $ex = $this->mDb->getOne('SELECT id FROM ' . $this->mTbUsersTags . ' WHERE id = ? ', array($id));
        if ($ex)
            return 1;
        else
            return 0;
    }

    /* ChckTags */

    public function ChckExFavTag($mid, $mpath, $wtype)
    {
        $ex = $this->mDb->getOne('SELECT id FROM ' . $this->mTbUsersTagsM . ' WHERE id = ? AND mpath = ?, AND wtype =?  ', array($mid, $mpath, $wtype));
        if ($ex)
            return 1;
        else
            return 0;
    }

    public function GetCntTags($uid = -1)
    {
        return $this->mDb->getOne('SELECT COUNT(id) FROM ' . $this->mTbUsersTags . ' WHERE uid = ?', array($uid));
    }

    public function GetOneTag($id = -1, $uid = -1, $type = -1)
    {
        $sql = 'SELECT t.*, t.cnt AS cnt_mes FROM ' . $this->mTbUsersTags . ' t WHERE t.id = t.id ';

        if (-1 != $id)
        {
            $sql .= ' AND t.id = ' . $id;
        }
        if (-1 != $uid)
        {
            $sql .= ' AND t.uid = ' . $uid;
        }
        if (-1 != $type)
        {
            $sql .= ' AND t.type = ' . $type;
        }
        $sql .= ' GROUP BY t.id LIMIT 1';
        $r = $this->mDb->getRow($sql);

        if (2 == $type && empty($r) && -1 != $uid)
        {
            $sql = 'INSERT INTO ' . $this->mTbUsersTags . ' ( uid, name, type, cnt, dt ) VALUES ( ?, ?, 2, 0, NOW() )';
            $this->mDb->query($sql, array($uid, 'Favorite'));
            $r = $this->mDb->getOne('SELECT LAST_INSERT_ID()');
        }
        return $r;
    }

    /* GetOneTag */

    public function SearchTags($uid, $q)
    {
        if ('' != $q && $uid)
        {
            $sql = "SELECT t.*, COUNT( tm.id ) AS cnt_mes
    			FROM " . $this->mTbUsersTags . " t
    			LEFT JOIN " . $this->mTbUsersTagsM . " tm ON ( tm.tid = t.id )
    			WHERE t.uid = ? AND t.name LIKE '%" . mysql_escape_string($q) . "%'";

            $sql .= ' GROUP BY t.dt';

            return $this->mDb->getAll($sql, array($uid));
        }
        return '';
    }

    /* SearchTags */

    public function GetTags($uid, $order = -1, $limit = -1, $type = -1)
    {
        $sql = 'SELECT t.*, t.cnt AS cnt_mes, (t.type = 2) AS fav
    		FROM ' . $this->mTbUsersTags . ' t
    		WHERE t.uid = ? AND t.cnt > 0';

        if (-1 != $type)
        {
            $sql .= ' AND t.type = ' . $type;
        }

        if (-1 != $order)
        {
            $sql .= ' ORDER BY ' . $order;
        } else
        {
            $sql .= ' ORDER BY fav DESC, t.id ';
        }

        if (-1 != $limit)
        {
            $sql .= ' LIMIT ' . $limit;
        }
        $res = $this->mDb->getAll($sql, array($uid));
        //deb($res);
        return $res;
    }

    /* GetTags */

    /**
     * получаем список тегов некоего юзера для некоторого сообщения
     * @param int $uid
     * @param string $mids
     * @return array
     */
    public function GetTagsByMid($uid, $mids, $wtype)
    {
        $sql = 'SELECT t.id, t.name, tm.mid FROM ' . $this->mTbUsersTags . ' t, ' . $this->mTbUsersTagsM . ' tm
                WHERE t.type != 2 AND tm.wtype = ' . $wtype . ' AND t.id = tm.tid AND t.uid = ' . $uid . ' AND tm.mid IN (' . $mids . ')
                ORDER BY t.dt
               ';

        $r = array();

        $db = $this->mDb->query($sql);
        while ($row = $db->FetchRow())
        {
            if (empty($r[$row['mid']]))
            {
                $r[$row['mid']] = array($row);
            } else
            {
                $r[$row['mid']][] = $row;
            }
        }

        return $r;
    }

    /**
     * Get some tag info
     * @param string $name - tag
     * @param int $uid - user ID
     * @param int $type - tag type
     * @return array
     */
    public function GetTagInfo($name, $uid, $type)
    {
        $sql = "SELECT * FROM " . $this->mTbUsersTags . " WHERE name = ? AND uid = ?";
        if ($type == 2)
        {
            //favorite
            $sql .= ' AND type = 2';
        }

        $r = $this->mDb->GetRow($sql, array($name, $uid));
        return $r;
    }

    /**
     * Add / Delete tag in tags table
     * @param <type> $act
     * @param <type> $uid
     * @param <type> $name
     * @param <type> $id
     * @param <type> $type
     * @return int
     */
    public function EditTags($act = 0, $uid = -1, $name = '', $id = -1, $type = 1)
    {
        if ((1 == $act || 3 == $act) && $name)
        {
            $tid = $this->GetTagInfo($name, $uid, $type);

            if (empty($tid))
            {
                $sql = 'INSERT INTO ' . $this->mTbUsersTags . ' ( uid, name, dt, cnt, type )
                                    VALUES ( ?, ?, NOW(), 0, ? )';
                $this->mDb->query($sql, array($uid, $name, $type));

                return $this->mDb->getOne("SELECT LAST_INSERT_ID()");
            } elseif ($act == 1)
            {
                return $tid['id'];
            } else
            {
                return 0;
            }
        } else if (2 == $act && -1 != $uid)
        {
            $tid = $this->GetTagInfo($name, $uid);
            if (!empty($tid))
            {

                if ($tid['cnt'] == 1)
                {
                    //delete
                    $this->mDb->query('DELETE FROM ' . $this->mTbUsersTags . ' WHERE id = ?', array($tid['id']));
                } else
                {
                    //update count
                    $this->mDb->query('UPDATE ' . $this->mTbUsersTags . ' SET cnt = cnt - 1 WHERE id = ?', array($tid['id']));
                }
                //$this->mDb->query('DELETE FROM ' . $this->mTbUsersTagsM . ' WHERE tid = ?', array($tid['id']));
                return -33;
            }
        }
    }

    /**
     * Delete tag by ID for user UID
     * @param int $tid
     * @param int $uid
     */
    public function DeleteTag($tid, $uid)
    {
        $ti = $this->GetOneTag($tid, $uid);

        if (!empty($ti))
        {
            $this->mDb->query('DELETE FROM ' . $this->mTbUsersTagsM . ' WHERE tid = ? AND uid = ?', array($tid, $uid));

            $this->mDb->query('DELETE FROM ' . $this->mTbUsersTags . ' WHERE id = ?', array($tid));
            return true;
        }
        return false;
    }

    /**
     * Add tag message (tag already exist in tags table)
     * @param <type> $tid
     * @param <type> $mid
     * @param <type> $uid
     * @param <type> $mpath
     * @param <type> $wtype
     * @return bool
     */
    public function AddTagsMesg($tid, $mid, $uid, $mpath, $wtype)
    {
        $sql = 'SELECT 1 FROM ' . $this->mTbUsersTagsM . ' WHERE tid = ? AND mid = ? AND uid = ? AND mpath = ? AND wtype = ?';
        $ex = (int) $this->mDb->GetOne($sql, array($tid, $mid, $uid, $mpath, $wtype));
        if (!$ex)
        {
            $sql = 'INSERT INTO ' . $this->mTbUsersTagsM . ' (tid, mid, uid, mpath, wtype, dt)
                    VALUES(?, ?, ?, ?, ?, NOW())';
            $this->mDb->query($sql, array($tid, $mid, $uid, $mpath, $wtype));

            //update tags count
            $this->mDb->query('UPDATE ' . $this->mTbUsersTags . ' SET cnt = cnt + 1 WHERE id = ?', array($tid));

            return true;
        }
        return false;
    }

    /**
     * Delete tags Message
     * @param <type> $tid
     * @param <type> $mid
     * @param <type> $uid
     * @param <type> $mpath
     * @param <type> $wtype
     * @return <type>
     */
    public function DeleteTagsMesg($tid, $mid, $uid, $mpath, $wtype)
    {
        $sql = 'SELECT id FROM ' . $this->mTbUsersTagsM . ' WHERE tid = ? AND mid = ? AND uid = ? AND mpath = ? AND wtype = ?';
        $id = (int) $this->mDb->GetOne($sql, array($tid, $mid, $uid, $mpath, $wtype));
        if ($id)
        {
            $sql = 'DELETE FROM ' . $this->mTbUsersTagsM . ' WHERE id = ?';
            $this->mDb->query($sql, array($id));

            return true;
        }
        return false;
    }

    public function GetCntTagsMes($uid, $tid)
    {
        return $this->mDb->getOne('SELECT COUNT(id) FROM ' . $this->mTbUsersTagsM . ' WHERE uid = ? AND tid = ?', array($uid, $tid));
    }

    /* GetCntTagsMes */

    public function GetTagsMes($uid, $tid, $order = -1, $limit = -1)
    {
        $sql = 'SELECT t.*
    			FROM ' . $this->mTbUsersTagsM . ' t
    			WHERE t.uid = ? AND t.tid = ? ';
        $sql .= ' GROUP BY t.dt';
        if (-1 != $order)
            $sql .= ' ORDER BY ' . $order;
        else
            $sql .= ' ORDER BY t.id DESC';
        if (-1 != $limit)
            $sql .= ' LIMIT ' . $limit;

        $res = $this->mDb->getAll($sql, array($uid, $tid));
        return $res;
    }

    /**
     * Delete some tag from
     * @param int $tid
     * @param int $mid
     * @param int $uid
     * @return bool
     */
    public function DelTagFromMesg($tid, $mid, $uid)
    {
        $tid_eq = $this->mDb->getRow('SELECT id, cnt, type FROM ' . $this->mTbUsersTags . ' WHERE uid = ? AND id = ?', array($uid, $tid));
        //deb($tid_eq);
        if (empty($tid_eq))
        {
            return false;
        }
        $ex = $this->mDb->getOne('SELECT id FROM ' . $this->mTbUsersTagsM . ' WHERE tid = ? AND mid = ?', array($tid, $mid));
        if (empty($ex))
        {
            return false;
        }
        $this->mDb->query('DELETE FROM ' . $this->mTbUsersTagsM . ' WHERE id = ?', array($ex));

        //up count
        if (2 == $tid_eq['type'] || $tid_eq['cnt'] > 1)
        {
            $this->mDb->query('UPDATE ' . $this->mTbUsersTags . ' SET cnt = cnt - 1 WHERE id = ?', array($tid));
        } else
        {
            $this->mDb->query('DELETE FROM ' . $this->mTbUsersTags . ' WHERE id = ?', array($tid));
        }
        return true;
    }

    public function EditFavorite($act = 0, $tid, $mid, $uid, $mpath, $wtype, $id = -1)
    {
        $tid_eq = $this->mDb->getOne('SELECT id FROM ' . $this->mTbUsersTags . ' WHERE uid = ? AND id = ?', array($uid, $tid));
        //deb($this->mDb);
        if (empty($tid_eq))
        {
            return false;
        }

        if (1 == $act)
        {
            $ex = $this->mDb->getOne('SELECT id FROM ' . $this->mTbUsersTagsM . ' WHERE tid = ? AND mid = ?',
                            array($tid, $mid));
            if (!$ex)
            {
                $sql = 'INSERT INTO ' . $this->mTbUsersTagsM . ' ( tid, mid, uid, mpath, wtype, dt )
	        			VALUES ( ?, ?, ?, ?, ?, NOW() )';
                $this->mDb->query($sql, array($tid, $mid, $uid, $mpath, $wtype));

                //up count
                $this->mDb->query('UPDATE ' . $this->mTbUsersTags . ' SET cnt = cnt + 1 WHERE id = ?', array($tid));

                return $this->mDb->getOne("SELECT LAST_INSERT_ID()");
            }
        } elseif (2 == $act)
        {
            $ex = $this->mDb->getOne('SELECT id FROM ' . $this->mTbUsersTagsM . ' WHERE tid = ? AND mid = ?',
                            array($tid, $mid));

            if ($ex)
            {
                $sql = 'DELETE FROM ' . $this->mTbUsersTagsM . ' WHERE id = ?';
                $this->mDb->query($sql, array($ex));

                //up count
                $this->mDb->query('UPDATE ' . $this->mTbUsersTags . ' SET cnt = cnt - 1 WHERE id = ?', array($tid));
            }
            return false;
        }
    }

    public function Change($uid, &$ar)
    {
        $sql = 'SELECT 1
                FROM ' . $this->mTbUsers . '
                WHERE uid <> ? AND public_name = ?';
        $r = $this->mDb->getOne($sql, array($uid, $ar['login']));

        if ($r)
        {
            $this->LastError = 1; // = error #1: user already exists;
            return false;
        } else
        {
            $this->mRc4->crypt($ar['pass']);
            $sql = 'UPDATE ' . $this->mTbUsers . ' SET public_name = ?' .
                    ((0 < strlen($ar['pass'])) ? ', pass=\'' . bin2hex($ar['pass']) . '\'' : '') .
                    ', email   = ?, name    = ?, scname = "", sclist = "", status  = ?, modules = ?
                      WHERE uid = ?';

            $this->mDb->query($sql, array($ar['login'], $ar['email'], strip_tags($ar['name']), $ar['status'], $ar['modules'], $uid));
            return true;
        }
    }

    public function Del($uid)
    {
        //$sql = 'DELETE FROM ' . $this->mTbUsers . ' WHERE uid = ?';
        //$this->mDb->query($sql, $uid);

        $ui = $this->Get($uid);
        if (!empty($ui))
        {
            $sql = 'UPDATE ' . $this->mTbUsers . ' SET first_name = "Profile",
            last_name = "Deleted",
            is_deleted=1,
            rchecksum = ?,
            image = "",
            ward_id = 0, stake_id = 0,
            notify_news = 0, notify_photo =0, notify_video = 0, notify_events = 0,	privacy_news = 0,
            privacy_basic =0, privacy_contact =0, 	privacy_pinfo =0, privacy_edu_work =0,	privacy_photo =0, privacy_video = 0,
            privacy_notes = 0,
            email = ?,
            public_name  = ?,
            notify_email = ?
            WHERE uid = ?';
            $this->mDb->query($sql, array(
                $ui['first_name'] . ' ' . $ui['last_name'],
                mktime() . '_' . $ui['email'],
                mktime() . '_' . $ui['email'],
                mktime() . '_' . $ui['email'],
                $uid));
            
            $this->mDb->query('DELETE FROM ' . $this->mTbUsersSubscr . ' WHERE wuid = ? OR uid = ?', array($uid, $uid));
            $this->mDb->query('DELETE FROM ' . TB . 'users_friends WHERE uid = ? OR friend_id = ?', array($uid, $uid));

            //Wall
            $sql = 'SELECT id FROM ' . TB . 'users_wall WHERE wuid = ? OR uid = ?';
            $db = $this -> mDb -> query($sql, array($uid, $uid));
            $res = array();
            while ($r = $db -> fetchRow())
            {
                $res[]= $r['id'];
            }
            $res_list = implode(", ", $res);

            $this->mDb->query('DELETE FROM ' . TB . 'users_wall WHERE wuid = ? OR uid = ?', array($uid, $uid));

            if ($res_list)
                $this->mDb->query('DELETE FROM ' . TB . 'users_wall_answ WHERE uid = ? OR mid IN ('.$res_list.')', array($uid));
            else 
                $this->mDb->query('DELETE FROM ' . TB . 'users_wall_answ WHERE uid = ?', array($uid));
            
            $this->mDb->query('DELETE FROM ' . TB . 'users_wall_filts WHERE uid = ?', array($uid));

            //Valbums
            $sql = 'SELECT * FROM ' . TB . 'users_valbums WHERE uid = ?';
            $db = $this -> mDb -> query($sql, array($uid));
            $res_v = array();
            while ($r = $db -> fetchRow())
            {
                $res_v[]= $r['vaid'];
            }
            $res_v = implode(", ", $res_v);

            $this->mDb->query('DELETE FROM ' . TB . 'users_valbums WHERE uid = ?', array($uid));
            if ($res_v)
            {
                $this->mDb->query('DELETE FROM ' . TB . 'users_valbums_video WHERE vaid IN ('.$res_v.')');
                $this->mDb->query('DELETE FROM ' . TB . 'users_valbums_comments WHERE vaid IN ('.$res_v.') OR user_id=?', array($uid));
            }
            else
            {
                $this->mDb->query('DELETE FROM ' . TB . 'users_valbums_comments WHERE user_id=?', array($uid));
            }
            
            //Photo Albums
            $sql = 'SELECT * FROM ' . TB . 'users_albums WHERE uid = ?';
            $db = $this -> mDb -> query($sql, array($uid));
            $res_img = array();
            while ($r = $db -> fetchRow())
            {
                $res_img[]= $r['aid'];
            }
            $res_img_list = implode(", ", $res_img);

            $this->mDb->query('DELETE FROM ' . TB . 'users_albums WHERE uid = ?', array($uid));
            if ($res_img_list)
            {
                $this->mDb->query('DELETE FROM ' . TB . 'users_albums_img WHERE aid IN ('.$res_img_list.')');
                $this->mDb->query('DELETE FROM ' . TB . 'users_albums_comments WHERE aid IN ('.$res_img_list.') OR user_id=?', array($uid));
                $this->mDb->query('DELETE FROM ' . TB . 'users_albums_privacy WHERE aid IN ('.$res_img_list.') OR uid=?', array($uid));
            }
            else
            {
                $this->mDb->query('DELETE FROM ' . TB . 'users_albums_comments WHERE user_id=?', array($uid));
                $this->mDb->query('DELETE FROM ' . TB . 'users_albums_privacy WHERE uid=?', array($uid));
            }

            //University
            $this->mDb->query('DELETE FROM ' . TB . 'users_university WHERE uid = ?', array($uid));
            
            //Tags
            $this->mDb->query('DELETE FROM ' . TB . 'users_tags WHERE uid = ?', array($uid));
            $this->mDb->query('DELETE FROM ' . TB . 'users_tags_mes WHERE uid = ?', array($uid));
            $this->mDb->query('DELETE FROM ' . TB . 'albums_tags WHERE uid = ?', array($uid));
            $this->mDb->query('DELETE FROM ' . TB . 'albums_tags_list WHERE uid = ?', array($uid));

            //Notify
            $this->mDb->query('DELETE FROM ' . TB . 'users_notify WHERE uid = ? OR to_uid = ?', array($uid, $uid));

            //Mission President
            $this->mDb->query('DELETE FROM ' . TB . 'users_mission_president WHERE umid = ?', array($uid));

            //Mission
            $this->mDb->query('DELETE FROM ' . TB . 'users_mission WHERE uid = ?', array($uid));

            $sql = 'SELECT id FROM ' . TB . 'mission_wall WHERE uid = ?';
            $db = $this -> mDb -> query($sql, array($uid));
            $res_mis = array();
            while ($r = $db -> fetchRow())
            {
                $res_mis[]= $r['id'];
            }
            $res_mis_list = implode(", ", $res_mis);

            $this->mDb->query('DELETE FROM ' . TB . 'mission_wall WHERE uid = ?', array($uid));
            if ($res_mis_list)
                $this->mDb->query('DELETE FROM ' . TB . 'mission_wall_answ WHERE uid = ? OR mid IN ('.$res_mis_list.')', array($uid));
            else
                $this->mDb->query('DELETE FROM ' . TB . 'mission_wall_answ WHERE uid = ?', array($uid));
            $this->mDb->query('DELETE FROM ' . TB . 'mission_subscr WHERE uid = ?', array($uid));

            //Ward
            $sql = 'SELECT id FROM ' . TB . 'wards_wall WHERE uid = ?';
            $db = $this -> mDb -> query($sql, array($uid));
            $res_ward = array();
            while ($r = $db -> fetchRow())
            {
                $res_ward[]= $r['id'];
            }
            $res_ward_list = implode(", ", $res_ward);

            $this->mDb->query('DELETE FROM ' . TB . 'wards_wall WHERE uid = ?', array($uid));
            if ($res_ward_list)
                $this->mDb->query('DELETE FROM ' . TB . 'wards_wall_answ WHERE uid = ? OR mid IN ('.$res_ward_list.')', array($uid));
            else
                $this->mDb->query('DELETE FROM ' . TB . 'wards_wall_answ WHERE uid = ?', array($uid));
            $this->mDb->query('DELETE FROM ' . TB . 'wards_whatching WHERE uid = ?', array($uid));
            $this->mDb->query('DELETE FROM ' . TB . 'wards_bishopric WHERE uid = ?', array($uid));

            //Journal
            $sql = 'SELECT id FROM ' . TB . 'users_journal_wall WHERE uid = ?';
            $db = $this -> mDb -> query($sql, array($uid));
            $res_jour = array();
            while ($r = $db -> fetchRow())
            {
                $res_jour[]= $r['id'];
            }
            $res_jour_list = implode(", ", $res_jour);

            $this->mDb->query('DELETE FROM ' . TB . 'users_journal_wall WHERE uid = ?', array($uid));
            if ($res_jour_list)
                $this->mDb->query('DELETE FROM ' . TB . 'users_journal_wall_answ WHERE uid = ? OR mid IN ('.$res_jour_list.')', array($uid));
            else
                $this->mDb->query('DELETE FROM ' . TB . 'users_journal_wall_answ WHERE uid = ?', array($uid));
            
            //Job
            $this->mDb->query('DELETE FROM ' . TB . 'users_job WHERE uid = ?', array($uid));

            //Interest
            $this->mDb->query('DELETE FROM ' . TB . 'users_interest WHERE uid = ?', array($uid));

            //Inbox/Chat
            $this->mDb->query('DELETE FROM ' . TB . 'users_inbox WHERE uid = ? OR wuid = ?', array($uid, $uid));

            //IM
            $this->mDb->query('DELETE FROM ' . TB . 'users_im WHERE uid = ?', array($uid));

            //Hight School
            $this->mDb->query('DELETE FROM ' . TB . 'users_hschool WHERE uid = ?', array($uid));

            //Family
            $this->mDb->query('DELETE FROM ' . TB . 'users_family WHERE uid = ? OR wuid = ?', array($uid, $uid));

            //Email Notify
            $this->mDb->query('DELETE FROM ' . TB . 'users_email_notify WHERE uid_rec = ? OR uid = ?', array($uid, $uid));

            //Calling
            $this->mDb->query('DELETE FROM ' . TB . 'users_calling WHERE uid = ?', array($uid));

            //Classes
            $this->mDb->query('DELETE FROM ' . TB . 'users_classes WHERE uid = ?', array($uid));
        }
        return true;
    }

    public function DelPhoto($uid)
    {
        $sql = 'SELECT image FROM ' . $this->mTbUsers . ' WHERE uid = ?';
        $r = $this->mDb->getOne($sql, array($uid));
        if ($r)
        {
            if (file_exists(BPATH . 'files/images/users/' . $r))
            {
                unlink(BPATH . 'files/images/users/' . $r);
            }
            if (file_exists(BPATH . 'files/images/users/resize/' . $r))
            {
                unlink(BPATH . 'files/images/users/resize/' . $r);
            }
            if (file_exists(BPATH . 'files/images/users/resize/m_' . $r))
            {
                unlink(BPATH . 'files/images/users/resize/m_' . $r);
            }
            $this->mDb->query('UPDATE ' . $this->mTbUsers . ' SET image = "" WHERE uid = ?', $uid);
        }
        return true;
    }

    /** DelPhoto */
    public function Count($status = -1, $active = -1, $country = '', $wish = '', $login = '')
    {
        $sql = 'SELECT COUNT(*) AS cnt FROM ' . $this->mTbUsers . ' WHERE uid = uid' .
                (-1 != $status ? ' AND status = ' . (int) $status : '');

        $ap = array();
        if (-1 != $active)
        {
            $sql .= ' AND active = ?';
            $ap[] = $active;
        }
        if ($country)
        {
            $ap[] = strip_tags($country);
            $sql .= ' AND LOWER(country) = ?';
        }
        if ($wish)
        {
            $wish = str_replace('"', '', $wish);
            $sql .= ' AND LOWER(wantlist) LIKE "%' . mysql_escape_string($wish) . '%"';
        }
        if ($login)
        {
            $login = str_replace('"', '', $login);
            $sql .= ' AND LOWER(public_name) LIKE "%' . mysql_escape_string($login) . '%"';
        }

        $r = $this->mDb->getOne($sql, $ap);
        return $r;
    }

    public function GetList($status = -1, $sort = '', $first = 0, $cnt = 0, $active = -1, $country = '', $wish = '', $login = '', $str = '', $ip_str = '' )
    {
        $sql = 'SELECT * FROM ' . $this->mTbUsers . ' WHERE uid = uid ' .
                (-1 != $status ? ' AND status = ' . (int) $status : '');

        $ap = array();

        if (-1 != $active)
        {
            $sql .= ' AND active = ?';
            $ap[] = $active;
        }

        if ($country)
        {
            $ap[] = strip_tags($country);
            $sql .= ' AND LOWER(country) = ?';
        }
        if ($wish)
        {
            $wish = str_replace('"', '', $wish);
            $sql .= ' AND LOWER(wantlist) LIKE "%' . mysql_escape_string($wish) . '%"';
        }
        if ($login)
        {
            $login = str_replace('"', '', $login);
            $sql .= ' AND LOWER(public_name) LIKE "%' . mysql_escape_string($login) . '%"';
        }

        if ($str)
        {
            $str = ToLower( mysql_escape_string($str) );
            $sql .= ' AND (
                           LOWER(first_name) LIKE "%'.$str.'%" OR
                           LOWER(last_name) LIKE "%'.$str.'%" OR
                           LOWER(email) LIKE "%'.$str.'%"
                          )';
        }

        if ($ip_str)
        {
            $ip_str = str_replace('"', '', $ip_str);
            $sql .= ' AND LOWER(last_ip) LIKE "%' . mysql_escape_string($ip_str) . '%"';
        }

        $sql .= ( $sort ? ' ORDER BY ' . $sort : '');

        if ($cnt)
        {
            $db = $this->mDb->limitQuery($sql, $first, $cnt, $ap);
        } else
        {
            $db = $this->mDb->query($sql);
        }
        $r = array();
        while ($row = $db->FetchRow())
        {
            $r[] = $row;
        }
        return $r;
    }


    public function GetListCnt($status = -1, $active = -1, $country = '', $wish = '', $login = '', $str = '', $ip_str = '')
    {
        $sql = 'SELECT COUNT(uid) FROM ' . $this->mTbUsers . ' WHERE uid = uid ' .
                (-1 != $status ? ' AND status = ' . (int) $status : '');

        $ap = array();

        if (-1 != $active)
        {
            $sql .= ' AND active = ?';
            $ap[] = $active;
        }

        if ($country)
        {
            $ap[] = strip_tags($country);
            $sql .= ' AND LOWER(country) = ?';
        }
        if ($wish)
        {
            $wish = str_replace('"', '', $wish);
            $sql .= ' AND LOWER(wantlist) LIKE "%' . mysql_escape_string($wish) . '%"';
        }
        if ($login)
        {
            $login = str_replace('"', '', $login);
            $sql .= ' AND LOWER(public_name) LIKE "%' . mysql_escape_string($login) . '%"';
        }

        if ($str)
        {
            $str = ToLower( mysql_escape_string($str) );
            $sql .= ' AND (
                           LOWER(first_name) LIKE "%'.$str.'%" OR
                           LOWER(last_name) LIKE "%'.$str.'%" OR
                           LOWER(email) LIKE "%'.$str.'%"
                          )';
        }

        if ($ip_str)
        {
            $ip_str = str_replace('"', '', $ip_str);
            $sql .= ' AND LOWER(last_ip) LIKE "%' . mysql_escape_string($ip_str) . '%"';
        }

        $r = $this->mDb->getOne($sql);
        return $r;
    }


    public function GetCntListByFilt($fpar = array(), $fval = array(), $status = 2, $active = 1, $filt = -1, $ar_filt_par = array(), $ar_filt_val = array(), $bfilt = -1)
    {
        $sql = 'SELECT COUNT(uid)
    			FROM ' . $this->mTbUsers . '
    			WHERE 1 ' . (!empty($fpar) ? ' AND (' . gen_plh($fpar, 4) . ' )' : '');

        if (-1 != $status)
            $sql .= ' AND status = ' . $status;

        if (-1 != $active)
            $sql .= ' AND active = ' . $active;

        if (!empty($filt) && -1 != $filt)
            $sql .= ' AND ' . $filt;

        if (!empty($ar_filt_par) && !empty($ar_filt_par))
        {
            $sql .= ' AND ( ' . gen_plh($ar_filt_par, 3) . ' )';
            $fval = array_merge($fval, $ar_filt_val);
        }

        if (!empty($bfilt) && $bfilt != -1)
        {
            $arFilt = explode(' ', $bfilt);
            $sql_filt = '';
            if (empty($arFilt))
            {
                $arFilt[] = $bfilt;
            }

            $i_max = count($arFilt);
            for ($i = 0; $i < $i_max; $i++)
            {
                if ($arFilt[$i] != '')
                {
                    $sql_filt .= "(first_name LIKE '" . $arFilt[$i] . "%' OR last_name LIKE '" . $arFilt[$i] . "%') " . ($i < $i_max - 1 ? 'OR ' : '');
                }
            }

            if ($sql_filt)
            {
                $sql .= ' AND ' . $sql_filt;
            }
        }

        $r = $this->mDb->getOne($sql, $fval);
        return $r;
    }

    public function GetCntListByMission($miss = '', $fpar = array(), $fval = array(), $status = 2, $active = 1, $filt = -1, $ar_filt_par = array(), $ar_filt_val = array(), $bfilt = -1)
    {
        $sql = 'SELECT count(u.uid)
    			FROM ' . $this->mTbUsers . ' u RIGHT JOIN ' . $this->mTbUsersMission . ' m ON (u.uid = m.uid)
    			WHERE 1 ' . (!empty($fpar) ? ' AND (' . gen_plh($fpar, 4) . ' )' : '');

        if (-1 != $status)
            $sql .= ' AND status = ' . $status;

        if ('' != $miss)
            $sql .= ' AND m.location LIKE \'' . $miss . '%\'';

        if (-1 != $active)
            $sql .= ' AND active = ' . $active;
        if (-1 != $filt)
            $sql .= ' AND ' . $filt;
        if (!empty($ar_filt_par) && !empty($ar_filt_par))
        {
            $sql .= ' AND ( ' . gen_plh($ar_filt_par, 3) . ' )';
            $fval = array_merge($fval, $ar_filt_val);
        }
        if ($bfilt != -1)
        {
            $arFilt = explode(' ', $bfilt);
            $sql_filt = '';
            if (empty($arFilt))
            {
                $arFilt[] = $bfilt;
            }

            $i_max = count($arFilt);
            for ($i = 0; $i < $i_max; $i++)
            {
                if ($arFilt[$i] != '')
                {
                    $sql_filt .= "(first_name LIKE '" . $arFilt[$i] . "%' OR last_name LIKE '" . $arFilt[$i] . "%') " . ($i < $i_max - 1 ? 'OR ' : '');
                }
            }
            $sql .= ' AND ' . $sql_filt;
        }

        $sql .= ' GROUP BY u.uid';

        $r = $this->mDb->query($sql, $fval);
        return mysql_affected_rows();
    }

    public function GetListByMission($miss='', $what = array(), $fpar = array(), $fval = array(), $status = 2, $active = 1, $sort = -1, $first = 0, $cnt = 0, $filt = -1, $ar_filt_par = array(), $ar_filt_val = array(), $bfilt = -1)
    {
        $sql = 'SELECT ' . join(', ', $what) . '
    			FROM ' . $this->mTbUsers . ' u RIGHT JOIN ' . $this->mTbUsersMission . ' m ON (u.uid = m.uid)
    			WHERE 1 ' . (!empty($fpar) ? ' AND (' . gen_plh($fpar, 4) . ' )' : '');

        if (-1 != $status)
            $sql .= ' AND status = ' . $status;

        if ('' != $miss)
            $sql .= ' AND m.location LIKE \'' . $miss . '%\'';

        if (-1 != $active)
            $sql .= ' AND active = ' . $active;
        if (-1 != $filt)
            $sql .= ' AND ' . $filt;
        if (!empty($ar_filt_par) && !empty($ar_filt_par))
        {
            $sql .= ' AND ( ' . gen_plh($ar_filt_par, 3) . ' )';
            $fval = array_merge($fval, $ar_filt_val);
        }

        if ($bfilt != -1)
        {
            $arFilt = explode(' ', $bfilt);
            $sql_filt = '';
            if (empty($arFilt))
            {
                $arFilt[] = $bfilt;
            }

            $i_max = count($arFilt);
            for ($i = 0; $i < $i_max; $i++)
            {
                if ($arFilt[$i] != '')
                {
                    $sql_filt .= "(first_name LIKE '" . $arFilt[$i] . "%' OR last_name LIKE '" . $arFilt[$i] . "%') " . ($i < $i_max - 1 ? 'OR ' : '');
                }
            }
            $sql .= ' AND ' . $sql_filt;
        }

        if (-1 != $sort)
            $sql .= ' GROUP BY u.uid ORDER BY ' . $sort;
        else
            $sql .= ' GROUP BY u.uid ORDER BY uid';

        if ($cnt)
            $db = $this->mDb->limitQuery($sql, $first, $cnt, $fval);
        else
            $db = $this->mDb->query($sql, $fval);

        $r = array();
        while ($row = $db->FetchRow())
        {
            $r[] = $row;
        }
        //deb($this -> mDb -> last_query);
        return $r;
    }


    public function GetCntListByWard($ward = '', $stake = '', $fpar = array(), $fval = array(), $status = 2, $active = 1, $filt = -1, $ar_filt_par = array(), $ar_filt_val = array(), $bfilt = -1)
    {
        $sql = 'SELECT count(u.uid)
    			FROM ' . $this->mTbUsers . ' u 
    			WHERE 1 ' . (!empty($fpar) ? ' AND (' . gen_plh($fpar, 4) . ' )' : '');

        if (-1 != $status)
            $sql .= ' AND status = ' . $status;

        if ('' != $ward)
            $sql .= ' AND u.ward LIKE \'' . $ward . '%\'';

        if ('' != $stake)
            $sql .= ' AND u.stake LIKE \'' . $stake . '%\'';

        if (-1 != $active)
            $sql .= ' AND active = ' . $active;
        if (-1 != $filt)
            $sql .= ' AND ' . $filt;
        if (!empty($ar_filt_par) && !empty($ar_filt_par))
        {
            $sql .= ' AND ( ' . gen_plh($ar_filt_par, 3) . ' )';
            $fval = array_merge($fval, $ar_filt_val);
        }
        if ($bfilt != -1)
        {
            $arFilt = explode(' ', $bfilt);
            $sql_filt = '';
            if (empty($arFilt))
            {
                $arFilt[] = $bfilt;
            }

            $i_max = count($arFilt);
            for ($i = 0; $i < $i_max; $i++)
            {
                if ($arFilt[$i] != '')
                {
                    $sql_filt .= "(first_name LIKE '" . $arFilt[$i] . "%' OR last_name LIKE '" . $arFilt[$i] . "%') " . ($i < $i_max - 1 ? 'OR ' : '');
                }
            }
            $sql .= ' AND ' . $sql_filt;
        }

        $sql .= ' GROUP BY u.uid';

        $r = $this->mDb->query($sql, $fval);
        return mysql_affected_rows();
    }



    public function GetListByWard($ward= '', $stake = '', $what = array(), $fpar = array(), $fval = array(), $status = 2, $active = 1, $sort = -1, $first = 0, $cnt = 0, $filt = -1, $ar_filt_par = array(), $ar_filt_val = array(), $bfilt = -1)
    {
        $sql = 'SELECT ' . join(', ', $what) . '
    			FROM ' . $this->mTbUsers . ' u 
    			WHERE 1 ' . (!empty($fpar) ? ' AND (' . gen_plh($fpar, 4) . ' )' : '');

        if (-1 != $status)
            $sql .= ' AND status = ' . $status;

        if ('' != $ward)
            $sql .= ' AND u.ward LIKE \'' . $ward . '%\'';

        if ('' != $stake)
            $sql .= ' AND u.stake LIKE \'' . $stake . '%\'';

        if (-1 != $active)
            $sql .= ' AND active = ' . $active;
        if (-1 != $filt)
            $sql .= ' AND ' . $filt;
        if (!empty($ar_filt_par) && !empty($ar_filt_par))
        {
            $sql .= ' AND ( ' . gen_plh($ar_filt_par, 3) . ' )';
            $fval = array_merge($fval, $ar_filt_val);
        }

        if ($bfilt != -1)
        {
            $arFilt = explode(' ', $bfilt);
            $sql_filt = '';
            if (empty($arFilt))
            {
                $arFilt[] = $bfilt;
            }

            $i_max = count($arFilt);
            for ($i = 0; $i < $i_max; $i++)
            {
                if ($arFilt[$i] != '')
                {
                    $sql_filt .= "(first_name LIKE '" . $arFilt[$i] . "%' OR last_name LIKE '" . $arFilt[$i] . "%') " . ($i < $i_max - 1 ? 'OR ' : '');
                }
            }
            $sql .= ' AND ' . $sql_filt;
        }

        if (-1 != $sort)
            $sql .= ' GROUP BY u.uid ORDER BY ' . $sort;
        else
            $sql .= ' GROUP BY u.uid ORDER BY uid';

        if ($cnt)
            $db = $this->mDb->limitQuery($sql, $first, $cnt, $fval);
        else
            $db = $this->mDb->query($sql, $fval);

        $r = array();
        while ($row = $db->FetchRow())
        {
            $r[] = $row;
        }
        //deb($this -> mDb -> last_query);
        return $r;
    }

    public function GetListByFilt($what = array(), $fpar = array(), $fval = array(), $status = 2, $active = 1, $sort = -1, $first = 0, $cnt = 0, $filt = -1, $ar_filt_par = array(), $ar_filt_val = array(), $bfilt = -1)
    {
        $sql = 'SELECT ' . join(', ', $what) . ' 
    			FROM ' . $this->mTbUsers . '
    			WHERE 1 ' . (!empty($fpar) ? ' AND (' . gen_plh($fpar, 4) . ' )' : '');

        if (-1 != $status)
            $sql .= ' AND status = ' . $status;

        if (-1 != $active)
            $sql .= ' AND active = ' . $active;

        if (!empty($filt) && -1 != $filt)
            $sql .= ' AND ' . $filt;

        if (!empty($ar_filt_par) && !empty($ar_filt_par))
        {
            $sql .= ' AND ( ' . gen_plh($ar_filt_par, 3) . ' )';
            $fval = array_merge($fval, $ar_filt_val);
        }

        if (!empty($bfilt) && $bfilt != -1)
        {
            $arFilt = explode(' ', $bfilt);
            $sql_filt = '';
            if (empty($arFilt))
            {
                $arFilt[] = $bfilt;
            }

            $i_max = count($arFilt);
            for ($i = 0; $i < $i_max; $i++)
            {
                $arFilt[$i] = trim(mysql_escape_string(strip_tags($arFilt[$i])));
                if ($arFilt[$i])
                {
                    $sql_filt .= ( $sql_filt ? ' OR ' : '') . "(first_name LIKE '" . $arFilt[$i] . "%' OR last_name LIKE '" . $arFilt[$i] . "%') ";
                }
            }
            if ($sql_filt)
            {
                $sql .= ' AND (' . $sql_filt . ')';
            }
        }

        if (-1 != $sort)
            $sql .= ' ORDER BY ' . $sort;
        else
            $sql .= ' ORDER BY uid';

        if ($cnt)
            $db = $this->mDb->limitQuery($sql, $first, $cnt, $fval);
        else
            $db = $this->mDb->query($sql, $fval);

        $r = array();
        while ($row = $db->FetchRow())
        {
            $r[] = $row;
        }
        return $r;
    }


    /**
     * Check email unique
     * @param string email
     * @return bool true (mail exist) or false
     */
    public function CheckEmail($email = '', $uid = 0)
    {
        $sql = 'SELECT 1 FROM ' . $this->mTbUsers . ' WHERE email = ? AND is_deleted = 0';
        if ($uid)
        {
            $sql .= ' AND uid <> ' . (int) $uid;
        }

        $r = $this->mDb->getOne($sql, array($email));

        if ($r)
        {
            return true;
        } else
        {
            return false;
        }
    }

#CheckEmail

    /**
     * Check current administrator session or make session
     *
     * $module string access admin module
     * $mainpart - if  == 1  - it's main part of the Site (show all modules)
     *
     * @return int 0 on success session. 1 if specified login and password is correct. 2 on bad session. 3 on bad login or password
     */
    public function CheckLogin($module, $mainpart = 0)
    {
        //deb($_SESSION);
        if (preg_match(':/([^/]+\.[^/]+)$:', $module, $matches))
        {
            $module = $matches[1];
        }

        if (strlen(session_id()) <= 0
                || empty($_SESSION['system_uid'])
                || empty($_SESSION['system_login'])
                || empty($_SESSION['system_session'])
                || !isset($_SESSION['system_status'])
                || (0 < $_SESSION['system_status'] && empty($_SESSION['system_modules']) && 0 == $mainpart)
        )
        {
            $_SESSION['system_uid'] = 0;
            $_SESSION['system_login'] = '';
            $_SESSION['system_session'] = '';
            $_SESSION['system_status'] = 0;
            $_SESSION['system_modules'] = '';


            if (!empty($_COOKIE['remember']))
            {
                $rmb = preg_replace('|^[^a-z0-9]*$|i', '', $_COOKIE['remember']);
                $user = $this->mDb->getRow('SELECT * FROM ' . $this->mTbUsers . ' WHERE remember = ? AND status <= 2 AND ip_block = 0', array($rmb));

                if (!empty($user))
                {
                    $_SESSION['system_uid']     = $user['uid'];
                    $_SESSION['system_login']   = $user['email'];
                    $_SESSION['system_session'] = md5('pLmz2a4' . $user['email'] . 'pN5' . $user['status'] . '1gh' . 'O7dNm4s' . $user['pass'] . 'KxJxnz');
                    $_SESSION['system_status']  = $user['status'];
                    $_SESSION['system_modules'] = $user['modules'];

                    $this->UpdOnline($user['uid']);
                    return 1;
                }
            }
            elseif (!empty($_POST['system_login']) && !empty($_POST['system_pass']))
            {

                $sql = 'SELECT uid, pass, status, modules, fpath
                        FROM ' . $this->mTbUsers . '
                        WHERE email = ?
                        AND status <= 2 AND rchecksum = ""
                        AND ip_block = 0
                        ';
                $row = $this->mDb->getRow($sql, array($_POST['system_login']));

                if (empty($row))
                {
                    return 3;
                }

                $this->mRc4->crypt($_POST['system_pass']);
                if (bin2hex($_POST['system_pass']) == $row['pass']
                        && (0 == $row['status'] || preg_match('/;' . $module . ';/', $row['modules']) || $mainpart == 1)
                )
                {
                    //update fpath
                    if (empty($row['fpath']))
                    {
                        $this->mDb->query('UPDATE ' . $this->mTbUsers . ' SET fpath = ? WHERE uid = ?', array(GetPostfix($row['uid']), $row['uid']));
                    }


                    $_SESSION['system_uid'] = $row['uid'];
                    $_SESSION['system_login'] = $_POST['system_login'];
                    $_SESSION['system_session'] = md5('pLmz2a4' . $_POST['system_login'] . 'pN5' . $row['status'] . '1gh' . 'O7dNm4s' . $row['pass'] . 'KxJxnz');
                    $_SESSION['system_status'] = $row['status'];
                    $_SESSION['system_modules'] = $row['modules'];

                    $this->UpdOnline($row['uid']);


                    if (!empty($_POST['remember']) && 1 == $_POST['remember'])
                    {
                        $rmb = md5(rand(1000, 999999) . mktime() . $row['uid']);
                        $this->mDb->query('UPDATE ' . $this->mTbUsers . ' SET remember = ? WHERE uid = ?', array($rmb, $row['uid']));
                        setcookie('remember', $rmb, mktime() + 86400 * 365, '/');
                    }

                    return 1;
                }
                else
                    return 3;
            }
            else
                return 2;
        }
        else
        {

            $sql = 'SELECT *
                    FROM ' . $this->mTbUsers . '
                    WHERE email = ?
                    AND status <= 2 AND rchecksum = "" AND ip_block = 0';
            $row = $this->mDb->getRow($sql, array($_SESSION['system_login']));

            if (empty($row))
            {
                return 2;
            }

            // Generate check value
            $compValue = md5('pLmz2a4' . $_SESSION['system_login'] . 'pN5' . $row['status'] . '1gh' . 'O7dNm4s' . $row['pass'] . 'KxJxnz');

            if ($_SESSION['system_session'] == $compValue
                    && (0 == $row['status']
                    || preg_match('/;' . $module . ';/', $row['modules']) || $mainpart == 1)
            )
            {
                $this->UpdOnline($row['uid']);
                $this->mCurInfo = $row;
                return 0;
            }
            else
            {
                return 2;
            }
        }
    }
    

    public function GetCurInfo()
    {
        return $this->mCurInfo;
    }

    public function Logout()
    {
        //deb($k = array($_SESSION, $_COOKIE));
        if (!empty($_SESSION['system_uid']))
        {
            $_SESSION = array();
            unset($_SESSION['system_uid']);
            unset($_SESSION['system_login']);
            unset($_SESSION['system_session']);
            unset($_SESSION['system_status']);
            unset($_SESSION['system_modules']);
        }
        //setcookie('remember', '');
        setcookie('remember', '', mktime() - 86400, '/');
        return true;
    }

    /** Logout */
    public function UpdOnline($uid)
    {
        $this->mDb->query('UPDATE ' . $this->mTbUsers . ' SET last_date = NOW(), last_ip = "'.$_SESSION['saved_ip'].'" WHERE uid = ?', array($uid));
    }

    /* UpdOnline */

    /**
     * Restore user password
     * @param string $email user email
     * @return string new password
     */
    public function RestorePassword($email)
    {
        $code = md5(mktime());

        $sql = 'UPDATE ' . $this->mTbUsers . ' SET
                    checksum = ?, checksum_date = ?
                    WHERE email = ?';
        $this->mDb->query($sql, array($code, mktime(), $email));
        return $code;
    }

#RestorePassword

    public function GetRestoreCode($code)
    {
        $sql = 'SELECT * FROM ' . $this->mTbUsers . ' WHERE checksum = ? AND checksum_date > ?';
        $r = $this->mDb->getRow($sql, array($code, mktime() - 24 * 3600));
        return $r;
    }

    /** GetRestoreCode */
    public function UpdatePassword($uid, $pass)
    {
        $this->mRc4->crypt($pass);
        $sql = 'UPDATE ' . $this->mTbUsers . ' SET pass = ? WHERE uid = ?';
        $this->mDb->query($sql, array(bin2hex($pass), $uid));
        return true;
    }

    public function GetRegistrationCode($uid)
    {
        $sql = 'SELECT rchecksum FROM ' . $this->mTbUsers . ' WHERE uid = ?';
        $r = $this->mDb->getOne($sql, array($uid));
        if ($r)
        {
            return $r;
        } else
        {
            $r = md5(mktime());
            $this->mDb->query('UPDATE ' . $this->mTbUsers . ' SET rchecksum = ? WHERE uid = ?', array($r, $uid));
            return $r;
        }
    }

    /** GetRegistrationCode */
    public function ApproveByCode($code)
    {
        $sql = 'SELECT uid, email, pass FROM ' . $this->mTbUsers . ' WHERE  rchecksum = ?';
        $r = $this->mDb->getRow($sql, array($code));

        if ($r)
        {
            $this->mDb->query('UPDATE ' . $this->mTbUsers . ' SET rchecksum = "" WHERE uid = ?', array($r['uid']));
            $r['pass'] = hex2bin($r['pass']);
            $this->mRc4->decrypt($r['pass']);
            return $r;
        } else
        {
            return false;
        }
    }

    /** ApprovebyCode */
    public function &SearchUser($query, $uid)
    {
        $query = '%' . $query . '%';
        $res = $this->mDb->getAssoc('SELECT u.uid, TRIM(CONCAT(u.name, \' \', u.lname)) AS full_name
                                         FROM ' . $this->mTbUsers . ' u
                                         WHERE u.status <= 2
                                               ' . (0 < $uid ? 'AND uid <> ' . $uid : '') . '
                                               AND (TRIM(CONCAT(u.name,\' \',u.lname)) LIKE ?
                                                    OR u.login LIKE ?)
                                         ORDER BY u.name ASC, u.lname ASC
                                         LIMIT 0,10', false, array($query, $query));

        return $res;
    }

    /** SearchUser */
    //-- Additional Methods

    public function EditInfo($uid, $ar_k = array(), $ar_v = array())
    {
        $us_ex = $this->mDb->getOne('SELECT uid FROM ' . $this->mTbUsers . ' WHERE uid = ?', array($uid));
        if ($us_ex)
        {
            $sql = 'UPDATE ' . $this->mTbUsers . ' SET ' . gen_plh($ar_k, 1) . '
					WHERE uid = ?';
            $ar_v = array_merge($ar_v, array($uid));
            $this->mDb->query($sql, $ar_v);
            return true;
        }
        else
            return false;
    }

    
    public function InviteUser($uid, $name, $email, $descr)
    {
        $sql = 'INSERT INTO '.$this -> mTbInvites.' (uid, name, email, descr, pdate)
               VALUES(?, ?, ?, ?, ?)';
        $this -> mDb -> query($sql, array($uid, $name, $email, $descr, mktime()));
        return true;
    }


    public function CheckUserInvite($email)
    {
        return $this -> mDb -> getOne('SELECT id FROM '.$this-> mTbInvites.' WHERE email = ?', array($email));
    }

    public function GetInvitesList($send = 1)
    {
        $sql = 'SELECT * FROM '.$this -> mTbInvites.' WHERE id = id';
        if (-1 != $send)
        {
            $sql .= ' AND send = '.(int)$send;
        }
        return $this -> mDb -> getAll($sql);
    }


    public function AddEmailBlock( $email, $uid = 0 )
    {
        $sql = 'SELECT id FROM '.$this -> mTbEmailBlocks.' WHERE LOWER(email) = ?';
        $r   = $this -> mDb -> getOne($sql, array(ToLower($email)));
        if (empty($r))
        {
            $this -> mDb -> query('INSERT INTO '.$this -> mTbEmailBlocks.' (uid, email, pdate)
                                   VALUES(?, ?, ?)',
                                   array($uid, $email, mktime()));
            return true;
        }
        return false;
    }

    public function DelEmailBlock($email)
    {
        $sql = 'SELECT id FROM '.$this -> mTbEmailBlocks.' WHERE LOWER(email) = ?';
        $r   = $this -> mDb -> getOne($sql, array(ToLower($email)));
        if (!empty($r))
        {
            $this -> mDb -> query('DELETE FROM '.$this -> mTbEmailBlocks.' WHERE email = ?',
                                   array($email));
            return true;
        }
        return false;
    }
    


}

/**
 * Define a Users exception class
 */
class UsersException extends Exception
{

    public function __construct($code)
    {
        if (is_array($code))
        {
            $text = serialize($code);
            $code = -1;
        }
        else
            $text = null;

        parent::__construct($text, $code);
    }

#end constructor
}

?>