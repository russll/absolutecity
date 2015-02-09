<?php
/**
 * Notifications Base Model
 * @package    5dev Catalog
 * @version    1.0
 * @since      12.05.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */
class Model_Base_Notify
{
    private $mDb;
    private $mUser;

    private $mTbUsers;
    private $mTbUsersNotify;
    private $mTbUsersEmailNotify;

    public function __construct(&$glObj) //** Constructor of the Notify class

    {
        $this -> mDb =& $glObj['gDb'];

        $this -> mTbUsers = TB . 'users';
        $this -> mTbUsersNotify = TB . 'users_notify';
        $this -> mTbUsersEmailNotify = TB . 'users_email_notify';
        $this -> mTbEmailBlocks = TB . 'email_blocks';

        //init smiles
        require_once 'Model/Profile/Smile.class.php';
        $this->moSmiles = new Model_Profile_Smile();

    }

    /* __construct */


    public function GetCntUNotify($uid = -1, $wid = -1, $type = -1, $wtype = -1, $first = -1, $cnt = -1, $order = -1, $read = -1)
    {
        $sql = 'SELECT COUNT(id)
    			FROM ' . $this -> mTbUsersNotify . '
    			WHERE 1 ';
        $ar_q = array();
        if (-1 != $uid)
        {
            $sql .= ' AND uid = ?';
            $ar_q[] = $uid;
        }
        if (-1 != $wid)
        {
            $sql .= ' AND wid = ?';
            $ar_q[] = $wid;
        }
        if (-1 != $type)
        {
            if ($type == 50)
            {
                $sql .= ' AND type >= ?';
                $ar_q[] = $type;
            }
            else
            {
                $sql .= ' AND type = ?';
                $ar_q[] = $type;
            }
        }
        if (-1 != $wtype)
        {
            $sql .= ' AND wtype = ?';
            $ar_q[] = $wtype;
        }
        if (-1 != $read)
        {
            $sql .= ' AND status = ?';
            $ar_q[] = $read ? 1 : 0;
        }
        return $r = $this -> mDb -> getOne($sql, $ar_q);
    }

    /* GetNotify */


    public function GetUNotify($uid = -1, $wid = -1, $type = -1, $wtype = -1, $first = -1, $cnt = -1, $order = -1, $read = -1)
    {
        $sql = 'SELECT n.*, u.email, u.first_name, u.last_name, u.image, u.fpath
    			FROM ' . $this -> mTbUsersNotify . ' n
    			LEFT JOIN ' . $this -> mTbUsers . ' u ON ( u.uid = n.uid )
    			WHERE 1 ';
        $ar_q = array();
        if (-1 != $uid)
        {
            $sql .= ' AND n.uid = ?';
            $ar_q[] = $uid;
        }
        if (-1 != $wid)
        {
            $sql .= ' AND n.wid = ?';
            $ar_q[] = $wid;
        }
        if (-1 != $type)
        {
            if ($type == 50)
            {
                $sql .= ' AND n.type >= ?';
                $ar_q[] = $type;
            }
            else
            {
                $sql .= ' AND n.type = ?';
                $ar_q[] = $type;
            }
        }
        if (-1 != $wtype)
        {
            $sql .= ' AND n.wtype = ?';
            $ar_q[] = $wtype;
        }
        if (-1 != $read)
        {
            $sql .= ' AND n.status = ?';
            $ar_q[] = $read ? 1 : 0;
        }
        if (-1 != $order)
        {
            $sql .= ' ORDER BY ' . $order;
        }
        else
        {
            $sql .= ' ORDER BY n.id DESC';
        }

        if (-1 != $first && -1 != $cnt)
        {
            $db = $this -> mDb -> limitQuery($sql, $first, $cnt, $ar_q);
        }
        else
        {
            $db = $this -> mDb -> query($sql, $ar_q);
        }

        $r = array();
        while ($ar_f = $db -> fetchRow())
        {
            if (isset($ar_f['to_uid']) && $ar_f['to_uid'] > 0)
            {
                $sql = 'SELECT uid, email, last_name, first_name FROM ' . $this -> mTbUsers .
                        ' WHERE uid = ? LIMIT 1';
                $u = $this -> mDb -> query($sql, array($ar_f['to_uid']));

                $row = $u -> FetchRow();

                if (!empty ($row))
                {
                    $ar_f['to_email'] = $row['email'];
                    $ar_f['to_last_name'] = $row['last_name'];
                    $ar_f['to_first_name'] = $row['first_name'];
                }
            }
            //smiles
            if (!empty($ar_f['info']))
            {
               $this->moSmiles->FindSmile($ar_f['info']);
            }

            $r[] = $ar_f;
        }
        return $r;
    }

    /* GetNotify */


    /**
     * Initialization of notifications
     * @param uid - who is sending the notify
     * @param wuid - where is sending the notify (can be user, wardm photo & video albums, event)
     * @param uid - who is sending the notify
     *
     * @return last inserted ID or false
     */
    public function UpdUNotify($type = 1, $wtype = 1, $ad_info = '', $ad_link = '', $ad_link_txt = '', $uid = -1, $wid = -1)
    {
        if (defined('UID'))
        {
            //-- check data
            $uinfo = array();
            $winfo = array();

            if (-1 == $uid)
                $uid = UID;

            if (-1 == $wid)
                $wid = UID_OTHER;

            if ($uid && $wid)
            {
                $ar_v = array($uid, $wid, $type, $wtype, $ad_info, $ad_link, $ad_link_txt);

                $ex_id = $db = $this->mDb->getOne('SELECT id FROM ' . $this->mTbUsersNotify . '
						       WHERE uid = ? AND wid = ? AND type = ? AND wtype = ? AND info = ? AND link = ? AND link_txt = ? ', $ar_v);
                if (empty($ex_id))
                {
                    $sql = 'INSERT INTO ' . $this->mTbUsersNotify . ' ( uid, wid, type, wtype, info, link, link_txt, dt )
							VALUES ( ?, ?, ?, ?, ?, ?, ?, NOW() )';
                    $this->mDb->query($sql, $ar_v);
                    //deb($this -> mDb);
                    return $this->mDb->getOne('SELECT LAST_INSERT_ID()');
                }
            }
            else
                return false;
        }
        else
            return false;
    }

    /* UpdUNotify */

    public function GetListEmailUnsubscribe()
    {
        $sql = 'SELECT email FROM ' . $this -> mTbEmailBlocks . ' WHERE 1 ';
        $db = $this -> mDb -> query($sql);
        $res = array();
        while ($r = $db -> fetchRow())
        {
            $res[]= $r['email'];
        }
        return $res;
    }
    /* GetListEmailUnsubscribe */
    
    /**
     *
     * @param <type> $type
     * @param <type> $wtype
     * @param <type> $ad_info
     * @param <type> $uid
     * @param <type> $wid
     * @param <type> $to_uid
     * @param <type> $event_id
     * @param int $notify_pos - notify position, 1 - wall, 2 - journal
     * @return <type>
     */
    public function UpdUExtNotify($type = 1, $wtype = 1, $ad_info = '', $uid, $wid, $to_uid, $event_id, $notify_pos = 1)
    {
        if ($uid && $to_uid && $wid)
        {
            $ar_v = array($uid, $to_uid, $wid, $type, $wtype, $ad_info, $event_id);

            $ex_id = $db = $this -> mDb -> getOne('SELECT id FROM ' . $this -> mTbUsersNotify . '
                                                    WHERE uid = ? AND to_uid=? AND wid = ? AND type = ? AND wtype = ? AND info = ? AND event_id=? ', $ar_v);
            if (empty($ex_id))
            {
                $ar_v[] = $notify_pos;
                $sql = 'INSERT INTO ' . $this -> mTbUsersNotify . ' ( uid, to_uid, wid, type, wtype, info, event_id, notify_pos, dt )
                        VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, NOW() )';
                $this -> mDb -> query($sql, $ar_v);
                return $this -> mDb -> getOne('SELECT LAST_INSERT_ID()');
            }
        } else
            return false;

    }

    /* UpdUExtNotify */


    public function GetForMessage($mid, $order = -1)
    {
        $sql = 'SELECT n.id, n.uid, n.wid, n.to_uid
    			FROM ' . $this -> mTbUsersNotify . ' n
    			WHERE n.event_id = ? ';
        $ar_q = array();
        $ar_q[] = $mid;

        if (-1 != $order)
            $sql .= ' ORDER BY ' . $order;
        else
            $sql .= ' ORDER BY n.id DESC';

        $db = $this -> mDb -> query($sql, $ar_q);
        $r = array();
        while ($ar_f = $db -> fetchRow())
        {
            /*
            if ($ar_f['to_uid'] > 0)
            {
                $sql = 'SELECT uid, email, last_name, first_name FROM ' . $this -> mTbUsers .
                        ' WHERE uid = ? LIMIT 1';
                $u = $this -> mDb -> query($sql, array($ar_f['to_uid']));

                $row = $u -> FetchRow();

                if (!empty ($row))
                {
                    $ar_f['to_email'] = $row['email'];
                    $ar_f['to_last_name'] = $row['last_name'];
                    $ar_f['to_first_name'] = $row['first_name'];
                }
            }
            */
            $r[] = $ar_f;
        }

        return $r;
    }



    public function DelNotify($uid = -1, $wid = -1, $wtype = -1, $type = -1)
    {

        $sql = 'DELETE FROM ' . $this -> mTbUsersNotify . '
    			WHERE 1 ';
        $ar_q = array();
        if (-1 != $uid)
        {
            $sql .= ' AND uid = ?';
            $ar_q[] = $uid;
        }
        if (-1 != $wid)
        {
            $sql .= ' AND wid = ?';
            $ar_q[] = $wid;
        }
        if (-1 != $type)
        {
            $sql .= ' AND type = ?';
            $ar_q[] = $type;
        }
        if (-1 != $wtype)
        {
            $sql .= ' AND wtype = ?';
            $ar_q[] = $wtype;
        }
        $this -> mDb -> query($sql, $ar_q);
    }


    /**
     * Delete all notify from both users
     * @param  $uid1
     * @param  $uid2
     * @param  $wtype
     * @param  $type
     * @return bool
     */
    public function DelNotifyFull($uid1, $uid2, $wtype = -1, $type = -1)
    {
        $sql = 'DELETE FROM ' . $this -> mTbUsersNotify . '
    			WHERE ((uid = ? AND wid = ?) OR (uid = ? AND wid = ?))
    			AND wtype = ? AND type = ?';
        $this -> mDb -> query($sql, array($uid1, $uid2, $uid2, $uid1, $wtype, $type));
        return true;
    }


    /*
     * Email Notices types
     * 1 - add friend +
     * 2 - wall msg +
     * 3 - joined ward +
     * 4 - inbox msg +
     * 5 - photo comment
     * 6 - joined mission
     * 7 - birthday
    */
    public function AddENentry($uid, $uid_rec, $entype, $params = array())
    {
     $uid = (int) $uid;
     $uid_rec = (int) $uid_rec;

     //Check for Unsubscribers
     //$dontsend=$this->GetListUnsubscribe();
     //if (empty($dontsend)||( !empty($dontsend)&&!in_array($uid_rec,$dontsend)))
     //{
        $entype = (int) $entype;
        if ($uid && $entype)
        {
            switch ($entype)
            {
                case 1:
                    $msg = isset($params['msg']) ? $params['msg'] : '';

                    $ar_p = array($uid, $uid_rec, $entype, $msg, '', '', '', '', time());
                    break;
                case 2:
                    $msg = isset($params['msg']) ? $params['msg'] : '';

                    $ar_p = array($uid, $uid_rec, $entype, $msg, '', '', '', '', time());
                    break;
                case 3:
                    $ward_id = isset($params['ward_id']) ? $params['ward_id'] : '';

                    $ar_p = array($uid, $uid_rec, $entype, '', $ward_id, '', '', '', time());
                    break;
                case 4:
                    $msg = isset($params['msg']) ? $params['msg'] : '';

                    $ar_p = array($uid, $uid_rec, $entype, $msg, '', '', '', '', time());
                    break;
                case 5:
                    $msg = isset($params['msg']) ? $params['msg'] : '';
                    $aid = isset($params['aid']) ? $params['aid'] : '';
                    $pid = isset($params['pid']) ? $params['pid'] : '';

                    $ar_p = array($uid, $uid_rec, $entype, $msg, '', $aid, $pid, '', time());
                    break;
                case 6:
                    $mid = isset($params['mid']) ? $params['mid'] : '';
                    $ar_p = array($uid, $uid_rec, $entype, '', '', '', '', $mid, time());
                    break;
                case 7:
                    $ar_p = array($uid, $uid_rec, $entype, '', '', '', '', '', time());
                    break;
            }
            if (count($ar_p) > 0)
            {
                $sql = "INSERT INTO " . $this -> mTbUsersEmailNotify . "(uid, uid_rec, entype, msg, ward_id, aid, pid, mid, pdate)
                        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $this -> mDb -> query($sql, $ar_p);
            }
        }
     //}
    }


    public function GetUnsendENotices()
    {
        $r = array();
        $sql = "SELECT en.*, u.uid as user_uid, u.first_name as user_first_name, u.last_name as user_last_name, u.public_name as user_public_name FROM " . $this -> mTbUsersEmailNotify . " en INNER JOIN " . $this->mTbUsers . "  u ON (en.uid = u.uid) WHERE en.status = 0";
        //$sql = "SELECT en.*, u.uid as user_uid, u.first_name as user_first_name, u.last_name as user_last_name, u.public_name as user_public_name FROM " . $this -> mTbUsersEmailNotify . " en INNER JOIN " . $this->mTbUsers . "  u ON (en.uid = u.uid) WHERE en.status = 0";
        $db = $this -> mDb -> query($sql);
        while ($row = $db  -> FetchRow())
        {
            $r[$row['entype']][] = $row;
        }
        return $r;
    }


    public function MarkAllRead($uid)
    {
        $sql = "UPDATE " . $this -> mTbUsersNotify . " SET status = 1 WHERE wid = ?";
        $db = $this -> mDb -> query($sql, array($uid));
    }


    public function MarkENsent($ids)
    {
        if (is_array($ids))
        {
            $sql = "UPDATE " . $this -> mTbUsersEmailNotify . " SET status = 1 WHERE id IN (" . implode(',', $ids) . ")";
            $this -> mDb -> query($sql);
        }
    }


    public function AddENotifyBirthday()
    {
        $sql = "SELECT uid FROM " . $this->mTbUsers . " WHERE DAY(dob) = DAY(NOW()) AND MONTH(dob) = MONTH(NOW())";

        $db = $this -> mDb -> query($sql);

        $i = 0;
        while ($row = $db -> FetchRow())
        {

            $this -> AddENentry($row['uid'], 0, 7);
            $i++;
        }
        return $i;
    }


    /* Email Notices */
    public function GetUsersRecInfo(&$info, $uid_rec)
    {
        $uid_rec = (int) $uid_rec;
        $r = array();

        if ($uid_rec)
        {
            include_once 'Model/Security/Rc4.class.php';
            $mRc4 = new Model_Security_Rc4();
            $mRc4->setKey('idfdnjewrjerjewrjbk');

            include_once 'Model/Security/Users.class.php';
            $moUser = new Model_Security_Users($this->mDb, $mRc4);

            $r[] = $moUser -> Get($uid_rec);
        }
        else
        {
            switch ($info['entype'])
            {
                case 3: // joined ward
                    if ($info['ward_id'] > 0)
                    {
                        include_once 'Model/Base/Ward.class.php';
                        $moWard = new Model_Base_Ward($this -> mDb);
                        $r = $moWard -> GetUsers($info['ward_id']);
                    }
                    break;
                case 6: // joined mission
                    if ($info['mid'])
                    {
                        include_once 'Model/Base/Mission.class.php';

                        $moMission = new Model_Base_Mission($this -> mDb);
                        $r = $moMission -> GetUsers($info['mid']);
                    }
                    break;
                case 7: // birthday
                    if ($info['uid'])
                    {
                        include_once 'Model/Base/Friends.class.php';
                        $moFriends = new Model_Base_Friends($this -> mDb);
                        $r = $moFriends -> GetUserFriends($info['uid']);
                    }
                    break;
            }
        }
        return $r;
    }


    public function SendENotices($smarty, $id = 0)
    {
        $enoticeText = array(
            1 => array('file' => 'notice_friend_invite', 'subject' => '[name] added you as a friend on inZion'),
            2 => array('file' => 'notice_wall_msg', 'subject' => '[name] posted a message on your Wall '),
            3 => array('file' => 'notice_friend_jward', 'subject' => '[name] joined your Ward on inZion'),
            4 => array('file' => 'notice_inbox_msg', 'subject' => '[name] sent you a message'),
            5 => array('file' => 'notice_photo_comment', 'subject' => '[name] commented on your photo on inZion'),
            6 => array('file' => 'notice_friend_jmission', 'subject' => '[name] was added to your Mission on inZion'),
            7 => array('file' => 'notice_friend_birthday', 'subject' => "Today's [name]'s birthday")
        );

        $id_succ = array();

        $newNotices = $this -> GetUnsendENotices();
        $dontsend=$this->GetListEmailUnsubscribe();

        if (count($newNotices) > 0)
        {
            $mail = array();
            $smarty -> assign('siteroot', 'http://' . DOMEN . '/');
            
            foreach ($enoticeText as $entype => $tpl)
            {
                if (isset($newNotices[$entype]))
                {
                    $imax = count($newNotices[$entype]);

                    for ($i = 0; $i < $imax; $i++)
                    {
                        $info = $newNotices[$entype][$i];

                        $smarty -> assign_by_ref('info', $info);

                        // name of user, commited action for notice
                        if ($info['user_first_name'] || $info['user_last_name'])
                        {
                            $userName = '';
                            if ($info['user_first_name'])
                            {
                                $userName = $info['user_first_name'] . ' ';
                            }
                            if ($info['user_last_name'])
                            {
                                $userName .= $info['user_last_name'];
                            }
                        }
                        else
                        {
                            $userName = $info['user_public_name'];
                        }

                        $subject = str_replace('[name]', $userName, $tpl['subject']);
                        $users_rec = $this -> GetUsersRecInfo($info, $info['uid_rec']);

                        if (count($users_rec) > 0)
                        {

                            foreach ($users_rec as $user_rec)
                            {
                              if (!in_array($user_rec['notify_email'],$dontsend))
                              {
                                if ($user_rec['uid'] != $info['uid'] && $user_rec['notify_email'] && (
                                        (!empty($user_rec['notify_events']) && in_array($entype, array(1, 7))) ||
                                                (!empty($user_rec['notify_photo']) && in_array($entype, array(5))) ||
                                                (!empty($user_rec['notify_ward']) && in_array($entype, array(3, 6))) ||
                                                (!empty($user_rec['notify_news']) && in_array($entype, array(2, 4)))
                                ))
                                {
                                    $smarty -> assign('u_rec', $user_rec);
                                    $message = $smarty -> fetch('mails/' . $tpl['file'] . '.html');

                                    /*$mail[] = array('email' => $user_rec['notify_email'], 'subject' => $subject, 'message' => $message);
                                    $ids_succ[] = $info['id'];
                                    print_r($mail);*/

                                    $headers = "From: inZion.com <noreply@inZion.com>\r\n";
                                    $headers .= 'MIME-Version: 1.0' . "\n";
                                    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";


                                    //$fo = fopen('mail_log.txt', 'a');
                                    $fo = '';
                                    if (!empty($fo))
                                    {
                                        fwrite($fo, "mail: " . $user_rec['notify_email'] . ": " . substr($subject, 0, 25) . "... - ");
                                    }

                                    if (mail($user_rec['notify_email'], $subject, $message, $headers))
                                    {
                                        $ids_succ[] = $info['id'];
                                        $msg = "OK";
                                    }
                                    else
                                    {
                                        $msg = "ERROR";
                                    }

                                    if (!empty($fo))
                                    {
                                        fwrite($fo, $msg . "\n");
                                        fclose($fo);
                                    }
                                }
                                else
                                {
                                    $ids_succ[] = $info['id'];
                                }
                              }
                              else
                              {
                                $ids_succ[] = $info['id'];
                              }
                            }
                        }
                        else
                        {
                            //не кому отсылать - не найден получатель
                            $ids_succ[] = $info['id'];
                        }
                    }
                }
            }
            if (isset($ids_succ))
            {
                $this -> MarkENsent( $ids_succ );
                return count( $ids_succ );
            }
            else
            {
                return 0;
            }
        }
    }

}

/** Model_Base_Notify */
?>
