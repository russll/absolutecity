<?php
/**
 * Inbox model
 * @package    5dev Catalog
 * @version    1.0
 * @since      10.05.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */
class Model_Base_Inbox
{
    //system params
    private $mDb;

    //tables
    private $mTbInboxX;
    private $mTbInbox;
    private $mTbInboxAnsw;
    private $mTbInboxTag;
    private $mTbInboxPrivacy;
    private $mTbVards;
    private $mTbGroups;

    /**
     * Constructor
     *
     * @param $glObj
     */
    public function __construct( &$gDb )
    {

        //inbox's tables
        $this -> mDb          	 =& $gDb;
        $this -> mTbInbox      	 = TB . 'users_inbox';

        //tags tables
        $this -> mTbUsersTags    = TB . 'users_tags';
        $this -> mTbUsersTagsM   = TB . 'users_tags_mes';

        //init smiles
        require_once 'Model/Profile/Smile.class.php';
        $this->moSmiles = new Model_Profile_Smile();

        //users tables
        $this -> mTbUsers      	 = TB.'users';

    }/* __construct */


    //----SYSTEM METHODS

    //Get names of the columns of Table Inbox
    public function GetCols(  )
    {
        $sql = "SHOW COLUMNS FROM ".$this -> mTbInbox;
        $db = $this -> mDb -> query( $sql );
        while ($ar_f = $db -> fetchRow())
        {
            $r[]= $ar_f['Field'];
        }
        return array_values($r);
    }/** GetColumns */

   
    /* Init String of Filters for Requests
    
    
    //----GET METHODS
    
    /* Get count of Messages on the Inbox
	 * 
	 * @param $uid - user's or groups ID (-1)
	 * @return inbox info
    */
    public function GetCnt( $puid, $uid, $wuid = -1, $filter = '' )
    {
        $sql = 'SELECT COUNT(id) FROM '.$this -> mTbInbox.' w
				 WHERE 1 ';
        $ar_q = array();
        if (-1 != $puid)
            $sql .= ' AND puid = '.$puid;
        if (-1 != $uid && -1 != $wuid)
        {
            $sql .= ' AND ((w.uid = ? AND w.wuid = ?) OR (w.uid = ? AND w.wuid = ?))';
            $ar_q = array($uid, $wuid, $wuid, $uid);
        }
        else if (-1 != $uid)
        {
            $sql .= ' AND w.uid = ?';
            $ar_q = array($uid);
        }
        else if (-1 != $wuid)
        {
            $sql .= ' AND w.wuid = ?';
            $ar_q = array($wuid);
        }
        if ($filter)
            $sql .= ' AND '.$filter;

        return $this -> mDb -> getOne( $sql, $ar_q );
    }/* GetCnt */


    /**
     * Get first friend with new messages
     * @return int
     */
    public function GetFriendByNewMessages( $uid )
    {
        $sql = 'SELECT w.uid
		FROM '.$this -> mTbInbox.' w
		WHERE w.puid = ? AND w.new = 1 AND w.new_blocked = 0';
        return $this -> mDb -> getOne($sql, array($uid));
    }


    public function GetMsgSince($uid, $pid, $since)
    {
        $sql = 'SELECT w.*, u.email, u.first_name, u.last_name, u.image, u.fpath, UNIX_TIMESTAMP(w.pdate) as uts
				FROM '.$this -> mTbInbox.' w 
				LEFT JOIN '.$this -> mTbUsers.' u ON ( u.uid = w.uid )
				WHERE w.wuid = ? AND w.puid = ?';

        $since = (int)$since;
        if($since)
        {
            $sql .= ' AND UNIX_TIMESTAMP(w.pdate) > '.$since;
        }

        $sql .= ' ORDER BY w.pdate DESC';

        $db = $this -> mDb -> query($sql, array($uid, $pid));

        $r = array();
        while($row = $db -> fetchRow())
        {
            $r[] = $row;
        }

        return $r;
    }


    /* Get Message's list
	 * 
	 * @param $cur_uid - current user's ID
	 * @param $first - first message (-1)
	 * @param $cnt - count of parsing messages (-1)
	 * @param $order - order by message (-1)
	 * @param $filt - filtering array (privacy)
	 * @return current user's Messages & Answers List
    */
    public function GetList( $puid, $uid, $wuid, $first = -1, $cnt = -1, $order = -1, $filter = '', $after_id = 0, $before_id = 0 )
    {
        $sql = 'SELECT w.*, u.email, u.first_name, u.last_name, u.image, u.fpath
				FROM '.$this -> mTbInbox.' w 
				LEFT JOIN '.$this -> mTbUsers.' u ON ( u.uid = w.uid )
				WHERE puid = ? AND ((w.uid = ? AND w.wuid = ?) OR (w.uid = ? AND w.wuid = ?))';

        if ($filter)
        {
            $sql .= ' AND '.$filter;
        }
        
        if ($after_id)
        {
            $sql .= ' AND w.id < '.(int)$after_id;
        }
        if ($before_id)
        {
            /*$sql .= ' AND w.id >= '.(int)$before_id;*/
            $sql .= ' AND w.id > '.(int)$before_id;
        }

        if (-1 != $order)
            $sql .= ' ORDER BY '.$order;
        else
            $sql .= ' ORDER BY w.pdate DESC';
            //$sql .= ' ORDER BY w.pdate ASC';

        $ar_q = array($puid, $uid, $wuid, $wuid, $uid);	//query array
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
    }/* GetList */


    public function GetFirstMessageId($puid, $uid, $wuid)
    {
        $sql = 'SELECT w.id
		FROM ' . $this->mTbInbox . ' w
		LEFT JOIN ' . $this->mTbUsers . ' u ON ( u.uid = w.uid )
		WHERE puid = ? AND ((w.uid = ? AND w.wuid = ?) OR (w.uid = ? AND w.wuid = ?))
                ORDER BY w.id ASC LIMIT 1';
        return $this -> mDb -> getOne($sql, array($puid, $uid, $wuid, $wuid, $uid));
    }
    

    /* Get One Message
	 * 
	 * @param $id - Message ID
	 * @param $filt - filtering array (privacy)
	 * @return current answeres of Message
    */
    public function GetOne( $id, $filt = array() )
    {
        $sql = 'SELECT w.*, u.email, u.first_name, u.last_name, u.image, u.fpath
				FROM '.$this -> mTbInbox.' w, '.$this -> mTbUsers.' u  
				WHERE w.id = ? AND u.uid = w.uid ';
        $res = array();
        $res =  $this -> mDb -> getRow( $sql, array( $id ) );
        return $res;
    }/* GetOne */

    public function GetOneByUID( $uid, $wuid, $filt = array() )
    {
        $sql = 'SELECT w.*
				FROM '.$this -> mTbInbox.' w  
				WHERE w.uid = ? AND w.wuid = ? ';
        return $this -> mDb -> getRow( $sql, array( $uid, $wuid ) );
    }/* GetOneByUID */

    /* Get New Messages list
	 * 
	 * @param $cur_uid - current user's ID
	 * @param $first - first message (-1)
	 * @param $cnt - count of parsing messages (-1)
	 * @param $order - order by message (-1)
	 * @param $filt - filtering array (privacy)
	 * @return current user's Messages & Answers List
    */
    public function GetNewMes( $puid )
    {
        $sql = 'SELECT COUNT(w.id) as cnt_mes, w.uid
		FROM '.$this -> mTbInbox.' w 
		WHERE w.puid = ? AND w.new = 1 AND w.new_blocked = 0';

        $sql .= ' GROUP BY w.id';

        $db = $this -> mDb -> query( $sql, array( $puid ) );

        $r = array();
        while ($ar_f = $db -> fetchRow())
        {
            if (!isset($r[$ar_f['uid']])) $r[$ar_f['uid']] = 0;
            $r[$ar_f['uid']] += $ar_f['cnt_mes'];
        }
        return $r;
    }/* GetList */


    
    public function EditNewMes( $new = 1, $puid, $uid = -1 )
    {
        $sql = 'UPDATE '.$this -> mTbInbox.' SET new = ? WHERE puid = ? ';

        $ar_q = array( $new, $puid );
        if (-1 != $uid)
        {
            $sql .= ' AND uid = ?';
            $ar_q[] = $uid;
        }
        $this -> mDb -> query($sql, $ar_q);
    }/* EditNewMes */


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
            $sql = 'INSERT INTO '.$this -> mTbInbox.' ( '.join(' ,', $ar_k).', pdate )
					VALUES ( '.gen_plh($ar_k, 0).', NOW() )';

           
            $this -> mDb -> query( $sql, $ar_v );

            return $this -> mDb -> getOne( 'SELECT LAST_INSERT_ID()' );
        }
        else
        {
            $sql = 'UPDATE '.$this -> mTbInbox.' SET '.gen_plh($ar_k, 1).'
					WHERE id = ?';

            $ar_v = array_merge($ar_v, array( $id ));
            $this -> mDb -> query($sql, $ar_v);
        }
    }/* Edit */

    //----DELETE METHODS
    public function DelAll( $id = -1, $puid, $uid = -1, $wuid = -1 )
    {
        $sql2 = 'DELETE FROM ' . $this->mTbInbox . ' WHERE puid = ?';
        if (-1 != $id)
            $sql2 .= ' AND id = ' . $id;
        if (-1 != $uid && -1 != $wuid)
            $sql2 .= ' AND ((uid = ' . $uid . ' AND wuid = ' . $wuid . ') OR (uid = ' . $wuid . ' AND wuid = ' . $uid . '))';
        else
        {
            if (-1 != $uid)
                $sql2 .= ' AND uid = ' . $uid;
            if (-1 != $wuid)
                $sql2 .= ' AND wuid = ' . $wuid;
        }

        if ($this->mDb->query($sql2, array($puid)))
        {
            return true;
        }
        else
        {
            return false;
        }
    }/* Del */
    /* DelAll */

    public function Del( $id = -1, $puid, $uid = -1, $wuid = -1 )
    {
        $sql1 = 'SELECT w.id FROM '.$this -> mTbInbox.' w WHERE w.puid = ? ';
        if ( -1 != $uid && -1 != $wuid )
            $sql1 .= ' AND ((w.uid = '.$uid.' AND w.wuid = '.$wuid.') OR (w.uid = '.$wuid.' AND w.wuid = '.$uid.'))';
        if ( -1 != $id )
            $sql1 .= ' AND w.id = '.$id;
        if ( -1 != $uid )
            $sql1 .= ' AND w.uid = '.$uid;
        if ( -1 != $wuid )
            $sql1 .= ' AND w.wuid = '.$wuid;
        $ex = $this -> mDb -> getRow( $sql1, array($puid) );
        if ($ex)
        {
            $sql2 = 'DELETE FROM '.$this -> mTbInbox.' WHERE puid = ?';
            if ( -1 != $id )
                $sql2 .= ' AND id = '.$id;
            if ( -1 != $uid && -1 != $wuid )
                $sql2 .= ' AND ((uid = '.$uid.' AND wuid = '.$wuid.') OR (uid = '.$wuid.' AND wuid = '.$uid.'))';
            else
            {
                if ( -1 != $uid )
                    $sql2 .= ' AND uid = '.$uid;
                if ( -1 != $wuid )
                    $sql2 .= ' AND wuid = '.$wuid;
            }

            if ($this -> mDb -> query($sql2, array($puid)))
                return true;
        }
        return false;
    }/* Del */
}/* Model_Profile_Inbox */
?>