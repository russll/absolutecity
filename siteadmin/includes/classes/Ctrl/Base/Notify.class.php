<?php
/**
 * Notify controller
 *
 * @package    5dev Notify
 * @version    1.0
 * @since      1.03.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */
class Ctrl_Base_Notify extends Ctrl_Base
{
    //system params
    private $moNotify;
    private $mAlbums;
    private $moVAlbums;
    //handle params
    private $cnt_p_upl; //count of the uploading photos

    /**
     * Constructor
     *
     * @param $glObj
     * @return void
     */
    public function __construct(&$glObj)
    {
        parent :: __construct($glObj);

        if (!defined('UID'))
            uni_redirect(PATH_ROOT . '');


        include_once 'Model/Base/Albums.class.php';
        $this->moAlbums = new Model_Base_Albums($glObj['gDb']);

        include_once 'Model/Base/Valbums.class.php';
        $this->moVAlbums = new Model_Base_Valbums($glObj['gDb']);
        $this->moNotify = $this->mlObj['notify'];
        $this->mSmarty->assign('HIDE_LC', 1); //hide LEFT COLUMN
        $this->mSmarty->assign('m_page', 'notify_list');
    }

    //---- System Methods

    public function GetList()
    {
        $pcnt = (int) _v('pcnt');
        $rcnt = (int) _v('rcnt');
        $ajax = (int) _v('ajax');

        if (!$rcnt)
            $rcnt = 7;

        //set all notices read
        $cnt_ar_notify = $this->moNotify->MarkAllRead(UID);

        $ar_notify = $this->moNotify->GetUNotify(-1, UID, -1, -1, $pcnt, $rcnt);

        if (!empty($_REQUEST['test']))
        {
            deb( $ar_notify );
        }
        $cnt_ar_notify = $this->moNotify->GetCntUNotify(-1, UID);

        if ($ar_notify)
        {
            foreach ($ar_notify as $k => $r)
            {
                if (3 == $r['wtype'] && 1 == $r['type'] && $r['link'])
                { //PHOTO
                    $ar_p = explode('/', $r['link']);
                    if ($ar_p)
                    {
                        $pi = $this->moAlbums->GetPhoto(substr($ar_p[3], 2), substr($ar_p[4], 2));
                        $ar_notify[$k]['img'] = $pi;
                    }
                }
                else if (4 == $r['wtype'] && 1 == $r['type'] && $r['link'])
                { //VIDEO
                    $ar_p = explode('/', $r['link']);
                    if ($ar_p)
                    {
                        $vi = $this->moVAlbums->GetVideo(substr($ar_p[3], 2), substr($ar_p[4], 2));
                        if ($vi)
                        {
                            $res = array();
                            preg_match('/http:\/\/www\.youtube\.com\/v\/([0-9A-Za-z_\-]+)/', $vi['video'], $res);
                            if (count($res) > 0)
                            {
                                $ar_notify[$k]['video_img'] = $vi;
                                $ar_notify[$k]['video_img']['video_img'] = 'http://i.ytimg.com/vi/' . $res[1] . '/1.jpg';
                            }
                        }
                    }
                }
            }
        }
        $this->mSmarty->assign_by_ref('pcnt', $pcnt);
        $this->mSmarty->assign_by_ref('rcnt', $rcnt);
        $this->mSmarty->assign_by_ref('ar_notify', $ar_notify);
        $this->mSmarty->assign_by_ref('cnt_ar_notify', $cnt_ar_notify);
        //deb($ar_notify);
        if ($ajax)
        {
            echo $this->mSmarty->fetch('mods/users/_notify_list.html');
            exit;
        }

        $this->mSmarty->assign('_content', $this->mSmarty->fetch('mods/users/_notify_list.html'));

        if (_v('pcnt') && _v('rcnt'))
        {
            $this->mSmarty->assign('ajax', 1);
            $this->mSmarty->display('mods/users/_notify_list.html');
            exit();
        }
    }


    public function GetListAjax()
    {
        $pcnt = (int) _v('pcnt');
        $rcnt = (int) _v('rcnt');
        $ntype = (int) _v('ntype', -1);
        $wtype = (int) _v('wtype', -1);

        if (!$rcnt)
            $rcnt = 7;

        $ar_notify = $this->moNotify->GetUNotify(-1, UID, $ntype, $wtype, $pcnt, $rcnt);
        $cnt_ar_notify = $this->moNotify->GetCntUNotify(-1, UID, $ntype, $wtype);
        if ($ar_notify)
        {
            foreach ($ar_notify as $k => $r)
            {
                if (3 == $r['wtype'] && 1 == $r['type'] && $r['link'])
                { //PHOTO
                    $ar_p = explode('/', $r['link']);
                    if ($ar_p)
                    {
                        $pi = $this->moAlbums->GetPhoto(substr($ar_p[3], 2), substr($ar_p[4], 2));
                        $ar_notify[$k]['img'] = $pi;
                    }
                }
                else if (4 == $r['wtype'] && 1 == $r['type'] && $r['link'])
                { //VIDEO
                    $ar_p = explode('/', $r['link']);
                    if ($ar_p)
                    {
                        $vi = $this->moVAlbums->GetVideo(substr($ar_p[3], 2), substr($ar_p[4], 2));
                        if ($vi)
                        {
                            $res = array();
                            preg_match('/http:\/\/www\.youtube\.com\/v\/([0-9A-Za-z_\-]+)/', $vi['video'], $res);
                            if (count($res) > 0)
                            {
                                $ar_notify[$k]['video_img'] = $vi;
                                $ar_notify[$k]['video_img']['video_img'] = 'http://i.ytimg.com/vi/' . $res[1] . '/1.jpg';
                            }
                        }
                    }
                }
            }
        }
        $this->mSmarty->assign_by_ref('pcnt', $pcnt);
        $this->mSmarty->assign_by_ref('rcnt', $rcnt);
        $this->mSmarty->assign_by_ref('ar_notify', $ar_notify);
        $this->mSmarty->assign_by_ref('cnt_ar_notify', $cnt_ar_notify);
        //deb($ar_notify);

        echo $this->mSmarty->fetch('mods/users/_notify_list.html');
        exit;
    }

    /* Email Notices */
    public function GetUsersRecInfo(&$info, $uid_rec)
    {
        $uid_rec = (int) $uid_rec;
        $r = array();
        if ($uid_rec)
        {
            $r[] = $this->moUser->mUser->Get($uid_rec);
        } else
        {
            switch ($info['entype'])
            {
                case 3: // joined ward
                    if ($info['ward_id'] > 0)
                    {
                        include_once 'Model/Base/Ward.class.php';
                        $moWard = new Model_Base_Ward($this->mlObj['gDb']);
                        $r = $moWard->GetUsers($info['ward_id']);
                    }
                    break;
                case 6: // joined mission
                    if ($info['mid'])
                    {
                        include_once 'Model/Base/Mission.class.php';

                        $moMission = new Model_Base_Mission($this->mlObj['gDb']);
                        $r = $moMission->GetUsers($info['mid']);
                    }
                    break;
                case 7: // birthday
                    if ($info['uid'])
                    {
                        include_once 'Model/Base/Friends.class.php';
                        $moFriends = new Model_Base_Friends($this->mlObj['gDb']);
                        $r = $moFriends->GetUserFriends($info['uid']);
                    }
                    break;
            }
        }

        return $r;
    }


    public function  AddENotifyBirthday()
    {
        return $this -> moNotify -> AddENotifyBirthday();
    }


    public function SendENotices($id = 0)
    {
        $enoticeText = array(
            1 => array('file' => 'notice_friend_invite',   'subject' => $this -> mSmarty -> get_config_vars('notify_text1')/*'[name] added you as a friend on inZion'*/),
            2 => array('file' => 'notice_wall_msg',        'subject' => $this -> mSmarty -> get_config_vars('notify_text2')/*'[name] posted a message on your Wall'*/),
            3 => array('file' => 'notice_friend_jward',    'subject' => $this -> mSmarty -> get_config_vars('notify_text3')/*'[name] joined your Ward on inZion'*/),
            4 => array('file' => 'notice_inbox_msg',       'subject' => $this -> mSmarty -> get_config_vars('notify_text4')/*'[name] posted a message on your Wall on inZion'*/),
            5 => array('file' => 'notice_photo_comment',   'subject' => $this -> mSmarty -> get_config_vars('notify_text5')/*'[name] commented on your photo on inZion'*/),
            6 => array('file' => 'notice_friend_jmission', 'subject' => $this -> mSmarty -> get_config_vars('notify_text6')/*'[name] was added to your Mission on inZion'*/),
            7 => array('file' => 'notice_friend_birthday', 'subject' => $this -> mSmarty -> get_config_vars('notify_text7')/*"Today's [name]'s birthday"*/)
        );

        $id_succ = array();

        $newNotices = $this->moNotify->GetUnsendENotices();
        $dontsend=$this->moNotify->GetListEmailUnsubscribe();

        if (count($newNotices) > 0)
        {
            $mail = array();
            $this->mSmarty->assign('siteroot', 'http://' . DOMEN . '/');

            foreach ($enoticeText as $entype => $tpl)
            {
                if (isset($newNotices[$entype]))
                {
                    $imax = count($newNotices[$entype]);
                    for ($i = 0; $i < $imax; $i++)
                    {
                        $info = $newNotices[$entype][$i];
                        $this->mSmarty->assign('info', $info);

                        // name of user, commited action for notice
                        if ($info['user_first_name'] || $info['user_last_name'])
                        {
                            if ($info['user_first_name'])
                            {
                                $userName = $info['user_first_name'] . ' ';
                            }
                            if ($info['user_last_name'])
                            {
                                $userName = $info['user_last_name'] . ' ';
                            }
                        } else
                        {
                            $userName = $info['user_public_name'];
                        }

                        $subject = str_replace('[name]', $userName, $tpl['subject']);
                        $users_rec = $this->GetUsersRecInfo($info, $info['uid_rec']);

                        if (count($users_rec) > 0)
                        {
                            foreach ($users_rec as $user_rec)
                            {
                              if (!in_array($user_rec['notify_email'],$dontsend))
                              {
                                if ($user_rec['notify_email'] && (
                                        ($user_rec['notify_events'] && in_array($entype, array(1, 7))) ||
                                                ($user_rec['notify_photo'] && in_array($entype, array(5))) ||
                                                ($user_rec['notify_ward'] && in_array($entype, array(3, 6))) ||
                                                ($user_rec['notify_news'] && in_array($entype, array(2, 4)))
                                ))
                                {
                                    $this->mSmarty->assign('u_rec', $user_rec);
                                    $message = $this->mSmarty->fetch('mails/' . $tpl['file'] . '.html');

                                    $mail[] = array('email' => $user_rec['notify_email'], 'subject' => $subject, 'message' => $message);
                                    $ids_succ[] = $info['id'];
                                    //print_r($mail);
                                    /*
                                      $headers  = "From: inZion.com <noreply@inZion.com>\r\n";
                                      $headers .= 'MIME-Version: 1.0' . "\n";
                                      $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
                                      if(mail($user_rec['notify_email'], $subject, $message, $headers))
                                      {
                                      $ids_succ[] = $info['id'];
                                      }
                                     */
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
                    }
                }
            }
            if (isset($ids_succ))
            {
                $this->moNotify->MarkENsent($ids_succ);
                return count($ids_succ);
            }
            else
            {
                return 0;
            }
        }
    }

}
?>