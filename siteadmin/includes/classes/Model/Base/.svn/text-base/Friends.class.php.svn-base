<?php
/**
 * Friend's Base model
 *
 * @package    5dev Wall
 * @version    1.0
 * @since      31.03.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */
define('FOLDER_ALL'         , 10);
define('FOLDER_FRIENDS'     , 20);
define('FOLDER_INVITES'     , 30);
define('FOLDER_FAVOURITES'  , 40);
define('FOLDER_BLOCKED'     , 50);

class Model_Base_Friends
{
    private $mDb;
    private $mTbFriend;
    private $mTbUser;
    private $mTbFav;
    private $mglObjFeeds;

    private $mFriendsWithMesg;

    /**
     * Notify2 object
     *
     */
    private $mglObjNotify2;


    private $mAddBlockFrom = 0;


    private $mDefFolders = array(FOLDER_ALL          => 'All Friends',
            FOLDER_FRIENDS      => 'Friends',
            FOLDER_INVITES      => 'Invites',
            FOLDER_FAVOURITES   => 'Favorites',
            FOLDER_BLOCKED      => 'Blocked'
    );


    public function __construct( &$gDb )
    {
        $this -> mDb =& $gDb;

        $this -> mTbUser   = TB. 'users';
        $this -> mTbFriend = TB. 'users_friends';
        $this -> mTbFav    = TB. 'users_favorites';

        $this -> mTbF      = TB. 'users_friends_folders';
        $this -> mTbFFC    = TB. 'users_friends_folders_connect';
        $this -> mTbUsersClasses = TB . 'users_classes';
    }


    public function SetFriendsMesg()
    {
        $this -> mFriendsWithMesg = 1;
    }

    public function SetBlockFrom()
    {
        $this -> mAddBlockFrom = 1;
    }


    // < Folders >
    public function AddFriendToFolder($tbl_fr_id, $fid)
    {
        $tbl_fr_id = (int)$tbl_fr_id;
        $fid = (int)$fid;

        $sql = 'SELECT count(*) FROM '.$this -> mTbFFC.' WHERE friend_id='.$tbl_fr_id.' AND fid='.$fid;
        if ( !(bool)$this -> mDb -> getOne($sql) )
        {
            $sql = 'INSERT INTO '.$this -> mTbFFC.' (friend_id, fid) VALUES('.$tbl_fr_id.', '.$fid.')';
            $this -> mDb -> query($sql);
        }
    }
    public function IsFriendOfFriend($uid, $oid)
    {

    }
    public function DelFriendFromFolder($tbl_fr_id, $fid)
    {
        $tbl_fr_id = (int)$tbl_fr_id;
        $fid = (int)$fid;
        $sql = 'DELETE FROM '.$this -> mTbFFC.' WHERE friend_id='.$tbl_fr_id.' AND fid='.$fid;
        $this -> mDb -> query($sql);
    }


    public function AddUpdateFolder($fid, $rename, $pass = '', $uid = UID)
    {
        if ($pass)
        {
            $this -> mRc4 -> crypt($pass);
            $pass = bin2hex($pass);
        }

        if ($fid)
        {
            $this -> mDb -> query('UPDATE '.$this -> mTbF.'
                                    SET first_name = ?, pass  = ?
                                    WHERE fid     = '.$fid.'
                                          AND uid = '.$uid, array($rename, $pass));
        }
        else
        {
            $this -> mDb -> query('INSERT INTO '.$this -> mTbF.'
                                    (uid, first_name, pass)
                                    VALUES ('.$uid.', ?, ?)', array($rename, $pass));
        }
        //deb($this -> mDb);
    }

    public function DeleteFolder($fid, $uid = UID)
    {
        $dbout = $this -> mDb -> query('DELETE
                                         FROM '.$this -> mTbF.'
                                         WHERE fid     = '.$fid.'
                                               AND uid = '.$uid);     
        $this -> CleanFolder($fid, $uid);
    }

    public function CleanFolder($fid, $uid = UID)
    {
        $this -> mDb -> query('DELETE FROM '.$this -> mTbFFC.'
                                   WHERE fid = '.$fid);

    }

    public function CheckFolderExists($fid, $uid = UID)
    {
        return (999 < $fid) ? (bool)$this -> mDb -> getOne('SELECT 1
         FROM '.$this -> mTbF.'
         WHERE fid     = '.$fid.'
         AND uid = '.$uid)
                : isset($this -> mDefFolders[$fid]);
    }/** CheckFolderExists */

    // < /Folders >

    public function GetUserInfo( $uid )
    {
        $sql = "SELECT *
			      FROM ".$this -> mTbUser." 
				 WHERE uid = ".$uid; 

        $res = $this -> mDb -> getRow( $sql );
        return $res;
    }

    public function GetFriendFolders( $friend_id )
    {
        $sql = 'SELECT ff.fid FROM '.$this -> mTbF.' ff LEFT JOIN '.$this -> mTbFFC.' ffc ON(ffc.fid = ff.fid) WHERE ffc.friend_id='.$friend_id;
        $res = array();
        $dbout = $this -> mDb -> query( $sql );
        while ($row = $dbout -> fetchRow())
        {
            $res[$row['fid']] = 1;
        }
        return $res;
    }

    public function GetFrOnline( $uid, $ar_active = array(), $first = -1, $cnt = -1, $order = -1, $filter = -1  )
    {
        $sql = 'SELECT u.uid, u.public_name, u.first_name, u.last_name, u.image, u.country, u.city, f.active, u.last_access, u.fpath, f.id as tbl_fr_id
                FROM '.$this -> mTbFriend.' f 
                RIGHT JOIN '.$this -> mTbUser.' u ON (u.uid = f.friend_id) 
                WHERE f.uid = ? AND (900 >= (NOW() - u.last_date)) AND u.appear_offline = 0';


        //ограничение по собственным папкам юзера
        if (!empty($ar_active))
        {
            $sql .= " AND f.active IN (".join(", ", $ar_active).")";
        }

        //условие что я не заблокировано у данного пользователя
        //ставлю как обязательное
        $sql .= " AND f.friend_id IN (SELECT ff.uid FROM ".$this -> mTbFriend." ff WHERE ff.uid = f.friend_id AND ff.friend_id = ".(int)$uid." AND ff.active = 1)";

        //search
        if ($filter && $filter != -1)
        {
            $filter = mysql_escape_string(strip_tags($filter));
            $fa = explode(' ', $filter);
            $sq = '';
            foreach ($fa as &$v)
            {
                $v = trim($v);
                if ($v)
                    $sq .= ($sq ? ' AND ' : ''). '(u.first_name LIKE "'.$v.'%" OR u.last_name LIKE "'.$v.'%")';
            }
            $sql .= $sq ? ' AND ('.$sq.')' : '';
        }

        if (-1 != $order)
            $sql .= ' ORDER BY '.$order;
        else
            $sql .= ' ORDER BY f.id';

        $ar_q = array($uid);
        if (-1 != $first && -1 != $cnt)
            $db = $this -> mDb -> limitQuery( $sql, $first, $cnt, $ar_q );
        else
            $db = $this -> mDb -> query( $sql, $ar_q );
        $r = array();


        while ($ar_f = $db -> fetchRow())
        {
            $r[] = $ar_f;
        }
        return $r;
    }/* GetFrOnline */

    public function GetFrClassmate( $uid, $ar_active = array(), $first = -1, $cnt = -1, $order = -1  )
    {
        $sql = 'SELECT u.uid, u.public_name, u.first_name, u.last_name, u.image, u.country, u.city, f.active, u.last_access, u.fpath, f.id as tbl_fr_id
                FROM '.$this -> mTbFriend.' f
                RIGHT JOIN '.$this -> mTbUser.' u ON (u.uid = f.friend_id)
                LEFT JOIN '.$this -> mTbUsersClasses.' uc ON (u.uid = uc.uid)
                WHERE f.uid = ? AND uc.class_id IN ( SELECT DISTINCT class_id FROM '.$this -> mTbUsersClasses.' WHERE uid = ?)
                ';

        if (-1 != $order)
        {
            $sql .= ' ORDER BY '.$order;
        }
        else
        {
            $sql .= ' ORDER BY f.id';
        }

        $ar_q = array($uid, $uid);
        if (-1 != $first && -1 != $cnt)
        {
            $db = $this -> mDb -> limitQuery( $sql, $first, $cnt, $ar_q );
        }
        else
        {
            $db = $this -> mDb -> query( $sql, $ar_q );
        }
        $r = array();
        while ($ar_f = $db -> fetchRow())
        {
            $r[] = $ar_f;
        }
        return $r;
    }/* GetFrOnline */

    
    public function &GetUserFriends( $uid, $first = 0, $pcnt = 0, $ar_active = array(), $pdate = 0, $filter = '', $commonWith = 0, $order = -1, $knowActiveFor = 0, $fid = 0, $pr_filt = -1, $no_blocked = 0 )
    {
        $ar_fetched = array();
        $commonWith = (int)$commonWith;

        if($commonWith)
        {
            $sql = "SELECT u.uid, u.public_name, u.first_name, u.last_name, u.image, u.email, u.notify_news, u.notify_ward, u.notify_photo, u.notify_video, u.notify_events, f2.active, u.last_access, u.fpath, u.country, u.city, f.id as tbl_fr_id
	    	           FROM ".$this -> mTbUser." u, ".$this -> mTbFriend." f 
	    	          LEFT JOIN ".$this -> mTbFriend." f2 ON (f2.friend_id = f.friend_id AND f2.active = 1)
	    	          WHERE f.uid = ".$uid." AND u.uid = f.friend_id AND f2.uid = ".$commonWith." AND u.uid !=".$uid;
        }
        elseif($knowActiveFor) //

        {
            $sql = "SELECT u.uid, u.public_name, u.first_name, u.last_name, u.image, u.email, u.notify_news, u.notify_ward, u.notify_photo, u.notify_video, u.notify_events, f2.active, u.last_access, u.country, u.city, u.fpath, f.id as tbl_fr_id
					    	         FROM ".$this -> mTbUser." u, ".$this -> mTbFriend." f LEFT JOIN ".$this -> mTbFriend." f2
					    	         					           ON (f2.friend_id = f.friend_id AND f2.uid=".$uid.")
					    	         WHERE f.uid = ".$uid." AND u.uid = f.friend_id";
        }
        elseif(0 != $fid) //

        {
            $sql = "SELECT u.uid, u.public_name, u.first_name, u.last_name, u.image, u.email, u.notify_news, u.notify_ward, u.notify_photo, u.notify_video, u.notify_events, f.active, u.last_access, u.country, u.city, u.fpath, ff.fid, f.id as tbl_fr_id
	    	            FROM ".$this -> mTbUser." u, ".$this -> mTbFriend." f 
	    	            RIGHT JOIN ".$this -> mTbFFC." ff ON (f.id = ff.friend_id) 
	    	            WHERE f.uid = '.$uid.' AND u.uid = f.friend_id AND ff.fid = ".$fid;
        }
        else
        {
            //with blocked status
            if ( $this -> mAddBlockFrom  && $no_blocked)
            {
                $sql = "SELECT u.uid, u.public_name, u.first_name, u.last_name, u.image, u.email, u.notify_news, u.notify_ward, u.notify_photo, u.notify_video, u.notify_events, u.country, u.city, f.active, u.last_access, u.fpath, f.id as tbl_fr_id,
                            ff.active AS factive
	    	            FROM ".$this -> mTbFriend." f
	    	            RIGHT JOIN ".$this -> mTbUser." u ON (u.uid = f.friend_id)
                            LEFT JOIN ".$this -> mTbFriend." ff ON
                                (ff.uid = f.friend_id AND ff.friend_id = ".(int)$uid.")
                        WHERE f.uid = ".$uid;
            }
            else
            {
                $sql = "SELECT u.uid, u.public_name, u.first_name, u.last_name, u.image, u.email, u.notify_news, u.notify_ward, u.notify_photo, u.notify_video, u.notify_events, u.country, u.city, f.active, u.last_access, u.fpath, f.id as tbl_fr_id
	    	            FROM ".$this -> mTbFriend." f
	    	            RIGHT JOIN ".$this -> mTbUser." u ON (u.uid = f.friend_id)
                        WHERE f.uid = ".$uid;
            }
        }

        if (-1 != $pr_filt)
        {
            $sql .= ' AND '.$pr_filt;
        }

        //ограничение по собственным папкам юзера
        if (!empty($ar_active))
        {
            $sql .= " AND f.active IN (".join(", ", $ar_active).")";
        }

        //условие что я не заблокировано у данного пользователя
        //ставлю как обязательное
        //echo '-----'.$no_blocked.'-----';
        if (!$no_blocked)
        {
            $sql .= " AND f.friend_id IN (SELECT ff.uid FROM ".$this -> mTbFriend." ff WHERE ff.uid = f.friend_id AND ff.friend_id = ".(int)$uid." AND ff.active = 1)";
        }

        if ($pdate)
        {
            $sql .= " AND f.pdate >= ".$pdate;
        }
        
        if ($filter)
        {
            $filter = mysql_escape_string(strip_tags($filter));
            $fa = explode(' ', $filter);
            $sq = '';
            foreach ($fa as &$v)
            {
                $v = trim($v);
                if ($v)
                {
                    $sq .= ($sq ? ' AND ' : ''). '(u.first_name LIKE "'.$v.'%" OR u.last_name LIKE "'.$v.'%")';
                }
            }
            $sql .= $sq ? " AND (".$sq.")" : '';
        }

        if (!is_numeric($order) && strlen($order))
        {
            $sql .= " ORDER BY ".$order;
        }
        else
        {
            $sql .= " ORDER BY f.id DESC";
        }

        if ($pcnt)
        {
            $ar_res  = $this -> mDb -> limitQuery( $sql, $first, $pcnt );
        }
        else
        {
            $ar_res  = $this -> mDb -> query( $sql );
        }


        $res = array();
        while ($ar_fetched = $ar_res -> fetchRow())
        {
            if ($this -> mFriendsWithMesg)
            {
                
                $ar_fetched['last_update'] = ToLower( $this -> mDb -> getOne( 'SELECT date_format(pdate, "%m/%d/%Y %h:%i%p") AS pdate FROM '.TB.'users_inbox WHERE puid = '.UID.' AND wuid = ? ORDER BY pdate DESC LIMIT 1', array($ar_fetched['uid']) ) );
            }


            $ar_fetched["first_name"] = stripslashes($ar_fetched["first_name"]);
            $ar_fetched["last_name"] = stripslashes($ar_fetched["last_name"]);
            $ar_fetched["active"] = (int)$ar_fetched["active"];
            //$ar_fetched["friend_folders"] = $ar_fetched['tbl_fr_id'] ? $this -> GetFriendFolders( $ar_fetched['tbl_fr_id'] ) : '';

            if (!empty($ar_fetched["last_access"]) && $ar_fetched["last_access"] >= (mktime() - 5*60))
                $ar_fetched["is_online"] =  1;

            $res[$ar_fetched['uid']] = $ar_fetched;
        }
        //print_r($res);
        return $res;
    }/** GetUserFriends */


    public function &GetUserFriendsCount( $uid, $ar_active = array(), $pdate = 0, $filter = '', $commonWith = 0 )
    {
        $ar_fetched = array();
        $commonWith = (int)$commonWith;

        if($commonWith)
        {
            /*$sql = "SELECT count(*)
	    	           FROM ".$this -> mTbUser." u, ".$this -> mTbFriend." f 
	    	          LEFT JOIN ".$this -> mTbFriend." f2 ON (f2.friend_id = f.friend_id)
	    	          WHERE f.uid = ".$uid." AND u.uid = f.friend_id AND f2.uid = ".$commonWith;*/
            $sql = "SELECT count(*)
	    	           FROM ".$this -> mTbUser." u, ".$this -> mTbFriend." f
	    	          LEFT JOIN ".$this -> mTbFriend." f2 ON (f2.friend_id = f.friend_id AND f2.active = 1)
	    	          WHERE f.uid = ".(int)$uid." AND u.uid = f.friend_id AND f2.uid = ".$commonWith." AND u.uid !=".$uid;
        }
        else
        {
            $sql = "SELECT count(*)
	    	          FROM ".$this -> mTbFriend." f 
	    	         RIGHT JOIN ".$this -> mTbUser." u ON (u.uid = f.friend_id) 
	    	         WHERE f.uid = ".$uid;  	            	
        }


        //ограничение по собственным папкам юзера
        if (!empty($ar_active))
        {
            $sql .= " AND f.active IN (".join(", ", $ar_active).")";
        }

        //условие что я не заблокировано у данного пользователя
        //ставлю как обязательное
        $sql .= " AND f.friend_id IN (SELECT ff.uid FROM ".$this -> mTbFriend." ff WHERE ff.uid = f.friend_id AND ff.friend_id = ".(int)$uid." AND ff.active = 1)";



        if ($pdate)
        {
            $sql .= " AND f.pdate >= ".$pdate;
        }
        
        if ($filter)
        {
            $filter = mysql_escape_string($filter);
            $sql .= " AND (u.first_name LIKE '$filter%' OR u.last_name LIKE '$filter%')";
        }

        $res  = $this -> mDb -> getOne( $sql );

        return $res;
    }/** GetUserFriendsCount */

    public function GetFriend ( $uid, $friend_id, $ar_active = array() )
    {
        $res = array();

        $sql = "SELECT f.active, u.uid, u.public_name, u.first_name, u.last_name, u.image, u.fpath, f.active, u.last_access
    	          FROM ".$this -> mTbFriend." f 
    	         RIGHT JOIN  ".$this -> mTbUser." u ON (u.uid = f.friend_id) 
    	         WHERE f.uid = ? 
    	           AND f.friend_id = ?";

        if (!empty($ar_active))
        {
            $sql .= " AND f.active IN (".join(", ", $ar_active).")";
        }
        
        $res  = $this -> mDb -> getRow( $sql, array( $uid, $friend_id ) );

        return $res;
    }/** GetFriend */

    public function &GetFolders($uid = UID)
    {
        // 2.1 Parse default folders
        $folders = array();
        while (list($key, $val) = each($this -> mDefFolders))
        {
            $row['fid']             = $key;
            $row['name']            = $val;
            $row['pass']            = '';

            $folders[$row['fid']] = $row;
        }
        // 2.2 Parse user folders
        $dbout = $this -> mDb -> query('SELECT fid, name, pass
								         FROM '.$this -> mTbF.'
								         WHERE uid = '.$uid.'
								         ORDER BY fid ASC');

        while ($row = $dbout -> fetchRow())
        {
            $folders[$row['fid']] = $row;
        }

        return $folders;
    }/** GetFriends */


    public function AddFriend( $uid, $friend_id, $mes = '', $active )
    {
        $sql1 = "SELECT id FROM ".$this -> mTbFriend." WHERE uid = ? AND friend_id = ?";

        $fr_exist = $this -> mDb -> getOne($sql1, array($uid, $friend_id));

        if (!$fr_exist)
        {
            $sql2 = "INSERT INTO ".$this -> mTbFriend." (uid, friend_id, mes, active, pdate)
                     VALUES (".$uid.", ".$friend_id.", ?, ".$active.", ".mktime().")";
            $this -> mDb -> query($sql2, array($mes));

            $sql3 = 'SELECT id FROM '.$this -> mTbFriend.' WHERE uid = ? AND friend_id = ?';
            $fr_env_exist = $this -> mDb -> getOne($sql3, array($friend_id, $uid));
            $res = 1;

            if ($fr_env_exist)
            {
                $this -> UpdInvite($uid, $friend_id, 1);
                $this -> UpdInvite($friend_id, $uid, 1);
                $res = 2;
            }
            return $res;
        }
        return false;
    }/** AddFriend */


    public function DelFriend( $uid, $friend_id )
    {
        $sql1 = "DELETE FROM ".$this -> mTbFriend." WHERE uid = ? AND friend_id = ?";
        $this -> mDb -> query( $sql1, array($uid, $friend_id) );

        $sql2 = "DELETE FROM ".$this -> mTbFriend." WHERE friend_id = ? AND uid = ?";
        $this -> mDb -> query( $sql2, array($uid, $friend_id) );

        //** Send info about changes *///----------
        //$ad_text = "<a href='".PATH_ROOT."users/".$friend_info['public_name']."'>".substr($friend_info['public_name'], 0, 40)."</a>";
        //$this -> mglObjFeeds -> UpdateChangesInfo( 180, $ad_text );
    }/** DelFriend */


    public function GetCntUserInvites( $uid )
    {
        return $this -> mDb -> getOne("SELECT COUNT(f.id) FROM ".$this -> mTbFriend." f
				       RIGHT JOIN ".$this -> mTbUser." u ON (u.uid = f.uid)
				       WHERE f.friend_id = ? AND f.active = 0", array( $uid ));

    }/* GetCntUserInvites */

    public function GetUserInvites( $uid, $first = 0, $pcnt = 0 )
    {
        $res = array();

        $sql = "SELECT u.uid, u.public_name, u.email, u.first_name, u.last_name, u.image, u.last_access, f.mes, u.fpath
    	          FROM ".$this -> mTbFriend." f 
    	         RIGHT JOIN ".$this -> mTbUser." u ON (u.uid = f.uid) 
    	         WHERE f.friend_id = ".$uid." 
    	           AND f.active = 0";

        if ($pcnt)
        {
            $db  = $this -> mDb -> limitQuery($sql, $first, $pcnt);
        }
        else
        {
            $db  =$this -> mDb -> query( $sql );
        }

        while ( $row = $db -> FetchRow())
        {
            $row["first_name"] = stripslashes($row["first_name"]);
            $row["last_name"] = stripslashes($row["last_name"]);
            if (!empty($row["last_access"]) && $row["last_access"] >= (mktime()-7*60))
            {
                $row["is_online"] =  1;
            }
            $res[] = $row;
        }
        return $res;
    }#GetUserInvites


    /**
     * Check invite exist
     *
     * @param int $uid
     * @param int $friend_id
     * @return int 0 - No, 1 - Yes
     */
    public function CheckInvite($uid, $friend_id)
    {
        $sql = "SELECT 1
        		  FROM ".$this -> mTbFriend." 
        		 WHERE uid = ? 
        		   AND friend_id = ? 
        		   AND active = 0";
        $r   =  $this -> mDb -> getOne($sql, array($friend_id, $uid));
        if ($r)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }#CheckInvite


    public function UpdInvite( $uid, $friend_id, $active = 0 )
    {
        $sql1     = "SELECT id FROM ".$this -> mTbFriend." WHERE uid = ? AND friend_id = ?";
        $fr_exist = $this -> mDb -> getOne($sql1, array($uid, $friend_id));

        if (!$fr_exist)
        {
            /**
             * друг не добавлен ранее - добавляем
             */
            $friend_info = $this -> GetUserInfo( $friend_id );

            
            $sql2 = "INSERT INTO ".$this -> mTbFriend." (uid, friend_id, active, pdate)
                     VALUES (".$uid.", ".$friend_id.", ".$active.", ".mktime().")";
            $this -> mDb -> query( $sql2 );

            $sql3 = "UPDATE ".$this -> mTbFriend." SET active = 1 WHERE friend_id = ".$uid." AND uid = ".$friend_id;
            $this -> mDb -> query( $sql3 );

            if (1 == $active)
            {
                //send mail

                //** Send info about changes *///----------
                /**
                 * не знаю что это но метода UpdateChangesInfo не существует
                if (!empty($this -> mglObjNotify2[176]))
                {
                    //sendNotice
                    $ad_text = "<a href='".PATH_ROOT."users/".$friend_info['public_name']."'>".substr($friend_info['public_name'], 0, 40)."</a>";
                    $this -> mglObjFeeds -> UpdateChangesInfo( 176, $ad_text );
                }
                */
            }

            if (2 == $active)
            {
                //** Send info about changes *///----------
                /**
                 * не знаю что это но метода UpdateChangesInfo не существует
                $ad_text = "<a href='".PATH_ROOT."users/".$friend_info['public_name']."'>".substr($friend_info['public_name'], 0, 40)."</a>";
                $this -> mglObjFeeds -> UpdateChangesInfo( 181, $ad_text );
                 */
            }
        }
        else
        {
            $sql4 = "UPDATE ".$this -> mTbFriend." SET active = ?  WHERE uid = ? AND friend_id = ?";
            $this -> mDb -> query( $sql4, array($active, $uid, $friend_id) );
        }
    }/** UpdInvite */


    /**
     * Check Active friend
     *
     * @param int $uid - user ID
     * @param int $friend_id - friend ID
     * @return int 0 - not friend, 1 - friend
     */
    public function CheckFriend($uid, $friend_id, $act_status = array(1))
    {
        $sql = "SELECT 1
        		  FROM ".$this -> mTbFriend." 
        		   WHERE uid = ?
        		   AND friend_id = ?";

        if (empty($act_status) || !is_array($act_status))
        {
            $sql .= ' AND active = 1';
        }
        else
        {
            $q = '';
            foreach ($act_status as $v)
            {
                $q .= ($q ? ' OR ' : '') . 'active = '.(int)$v;
            }
            $sql .= ' AND ('.$q.')'; 
        }

        $r   =  $this -> mDb -> getOne($sql, array($uid, $friend_id));
        //deb($this -> mDb);
        if ($r)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }/** CheckFriend */

    public function GetFriendshipStatus($uid, $friend_id)
    {
        $userStatus = '';
        if ($this -> CheckFriend($uid, $friend_id))
        {
            $userStatus = 'Friend';
        }
        else
        {
            $fr_info = $this -> GetFriend ( $uid, $friend_id);
            $userStatus = (count($fr_info) > 0 && !$fr_info['active'] ? 'notYetFriend' : 'notFriend');
        }
        return $userStatus;
    }/** GetFriendshipStatus */

    public function GetCommonFriendsCount($uid, $friend_id)
    {
        $sql = "SELECT count(*) FROM ".$this -> mTbFriend." f1
        						LEFT JOIN ".$this -> mTbFriend." f2
        						ON(f1.friend_id = f2.friend_id)
        		WHERE f1.uid = ? AND f2.uid = ?";

        $r   =  $this -> mDb -> getOne($sql, array($friend_id, $uid));

        if ($r)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }/** GetCommonFriendsCount */

    
    public function EditFrActive( $uid, $fr_id, $active )
    {
        $ex = $this -> mDb -> getOne('SELECT id FROM '.$this -> mTbFriend.' WHERE uid = ? AND friend_id = ? ', array( $uid, $fr_id ) );
        if ($ex)
        {
            //update friend
            $this -> mDb -> query('UPDATE '.$this -> mTbFriend.' SET active = ? WHERE uid = ? AND friend_id = ? ', array( $active, $uid, $fr_id ) );

            //update inbox
            $this -> mDb -> query('UPDATE '.TB.'users_inbox SET new_blocked = ? WHERE new = 1 AND puid = ? AND uid = ? ', array( $active==3 ? 1 : 0, $fr_id, $uid ) );
        }

    }/* EditFrActive */

    public function GetFrActive( $uid, $fr_id )
    {
        $ex = $this -> mDb -> getOne('SELECT active FROM '.$this -> mTbFriend.' WHERE uid = ? AND friend_id = ? ', array( $uid, $fr_id ) );
        if ($ex)
        {
            return $ex;
        }
        else
        {
            return 0;
        }
    }/* GetFrActive */

    public function EditNewState($uid, $what, $val)
    {
        //friend
        if (!in_array($what, array("friend")))
        {
            return false;
        }
        if (0 > $val)
        {
            $sql = "SELECT new_".$what."
            		  FROM ".$this -> mTbUser." 
            		 WHERE id = ?";
            $r   = $this -> mDb -> getOne($sql, array($uid));
            if (!$r)
            {
                return false;
            }
            elseif ($r < abs($val))
            {
                $val = $r;
            }
        }

        $sql = "UPDATE ".$this -> mTbUser."
    	           SET new_".$what." = new_".$what." + ".(int)$val."
    	         WHERE id = ?";
        $this -> mDb -> query($sql, array($uid));
        return true;
    }/**AddNewState */
}
?>