<?php
/**
 * Inbox controller
 *
 * @package    5dev Inbox
 * @version    1.0
 * @since      10.05.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */
class Ctrl_Base_Inbox extends Ctrl_Base
{

    //system params
    private $moInbox;
    private $filts;
    private $fpath;
    private $fpath_tmp;
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

        require_once 'Model/Base/Friends.class.php';
        $this->moFriends = new Model_Base_Friends($glObj['gDb']);

        $this->filts = $this->_initFilts(); //get table Filters

        require_once 'Model/Base/Inbox.class.php';
        $this->moInbox = new Model_Base_Inbox($glObj['gDb']);

        include_once 'Model/Profile/Profile.class.php';
        $this->moProfile = new Model_Base_Profile($glObj['gDb']);

        $this->mSmarty->assign('HIDE_RC', 1); //hide Right COLUMN
        $this->mSmarty->assign('m_page', 'inbox');
        $this->fpath = DIR_WS_IMAGE . 'inbox/';
        $this->fpath_tmp = DIR_WS_IMAGE . 'inbox/_temp/';
    }


    //---- System Methods

    /**
     * Initialization of privacy
     *  ar_filts:
     *             1 - friends & subscribers (1 - yes, 0 - not)
     *             2 - friend (1 - yes, 0 - not)
     *             3 - only family (1 - yes, 0 - not)
     *             4 - one (some person)
     *             5 - private (only me)
     *
     * @return filters array (ptype => uvid)
     */
    public function CheckInboxAjax()
    {
        //$since = _v('last_msg_time', mktime());
        $user_id = (int) _v('pid', 0);
        $last_id = (int) _v('last_id', 0);

        $mai = $this->moInbox->GetList(UID, $user_id, UID, -1, -1, -1, '', 0, $last_id);
        $mai=array_reverse($mai);
        if (empty($mai)) $this -> mSmarty -> assign('no_absent', 1);

        //deb($mai);
        $this->moInbox->EditNewMes(0, UID, $user_id);
        $this->mSmarty->assign_by_ref('mai', $mai);
        $r = array('res' => $this->mSmarty->fetch('mods/inbox/_wall_list_2.html'));
        echo Ar2Json($r);

        exit;
    }


    public function _initFilts()
    {
        $u_other = $this->moUser->mUi;

        $ar_filts = array(0 => '0', 1 => $u_other['im_suscr_fr'], 2 => $u_other['im_friend'], 3 => $u_other['im_fam'], 4 => UID_OTHER, 5 => UID);
        return $ar_filts;
    }


    //---- Main Methods
    //--Get & Edit Inbox Info
    public function GetEdit()
    {
        $errs = array();
        $wi = array(); //Inbox info (story, ev_title, l_url & etc.)
        $si = array(); //System info (privacy, is_answ, mes_id, answ_id & etc.)

        $wi = _v('WI');
        $si = _v('SI');
        $user_id = isset($si['user_id']) ? (int) $si['user_id'] : 0;

        if (!empty($wi) && !empty($user_id))
        { //edit Inbox info

            $fr_info_for_me = $this->moFriends->GetFriend($user_id, UID);

            if (2 != $fr_info_for_me['active'] && 3 != $fr_info_for_me['active'])
            {
                /* Set the necessery to complete fields
                  $mtype - 1 - message, 2 - event, 3 - link, 4 - photo, 5 - video */
                $n_data = array(); //necessary data array
                $mtype = isset($wi['mtype']) ? (int) $wi['mtype'] : 0;

                if (!empty($mtype))
                { //if additional attaches exists - do check & mes are not checked, else - mes checking
                    switch ($mtype)
                    {
                        case 2:
                            $n_data = array('ev_title', 'ev_where', 'ev_dt', 'ev_img', 'ev_descr');
                            break;
                        case 3:
                            $n_data = array('l_url');
                            break;
                        case 4:
                            if (!isset($wi['p_img']))
                            {
                                $n_data = array('p_url'); //if uploading photo from URL
                            }
                            else
                            {
                                $n_data = array('p_img'); //if uploading photo from PC
                            }
                            break;
                        case 5:
                            if (!isset($wi['v_file']))
                            {
                                $n_data = array('v_code'); //if uploading video from Code
                            }
                            else
                            {
                                $n_data = array('v_file'); //if uploading video from PC
                            }
                            break;
                        default:
                            $errs[] = 'Incorrect flag has been detected - "' . $mwhat . '"';
                            break;
                    }
                }
                else
                {
                    $n_data = array('story');
                }

                $ex_cols = $this->moInbox->GetCols(); //data's columns in DB
                if (!empty($n_data))
                {
                    foreach ($wi as $k => $r)
                    {

                        if (empty($k) || empty($r))
                        {
                            continue;
                        }

                        if ('p_img' != $k && 'v_file' != $k && !in_array($k, $ex_cols))
                        { //additional check by existing fields in DB
                            unset($wi[$k]);
                        }
                        else
                        {
                            if (in_array($k, $n_data) && empty($r))
                            { //check filling all the necessary fields
                                $errs[] = 'Required field - "' . $k . '" - has been left blank or incomplete';
                            }

                            if (3 == $mtype && 'l_url' == $k)
                            { //check link
                                $wi_k[] = base_chk($k);
                                if (chk_link($wi['l_url']))
                                {
                                    $wi_r[] = chk_link($wi['l_url']);
                                }
                                else
                                {
                                    $errs[] = 'Incorrect data has been detected - "' . $wi['l_url'] . '"';
                                }
                            }
                            elseif (4 == $mtype && 'p_img' == $k)
                            { //check photo
                                $cnt_wi_pimg = isset($wi['p_img']) ? count($wi['p_img']) : 0;
                                $this->cnt_p_upl = $cnt_wi_pimg;
                                $l_el = !count($wi_k) ? 0 : count($wi_k) - 1;

                                //get ID of the current system_album
                                require_once 'Model/Base/Albums.class.php';
                                $moAlbums = new Model_Base_Albums($this->mlObj['gDb']);
                                $ualb_sys = $moAlbums->GetUAlbums(UID, 2);
                                foreach ($ualb_sys as $k => $r)
                                {
                                    if ('Inbox' == $r['name'])
                                    {
                                        $swall_id = $r['aid'];
                                        break;
                                    }
                                }

                                for ($i = 1; $i <= $cnt_wi_pimg; $i++)
                                {
                                    $cur_el = $l_el + $i;
                                    $wi_k[$cur_el] = 'p_img_' . $i;
                                    if (is_array($wi['p_img']))
                                    {
                                        $wi_r[$cur_el] = $wi['p_img'][$i - 1];
                                    }
                                    else
                                    {
                                        $wi_r[$cur_el] = $wi['p_img'];
                                    }
                                    $tfolder = $this->fpath_tmp; //temp folder
                                    $folder = $this->fpath . GetPostfix(UID) . '/'; //necessary folder
                                    if (!file_exists($folder)) //create temp subdirectory

                                    {
                                        mkdir($folder, 0777);
                                        chmod($folder, 0777);
                                    }
                                    if (!file_exists($folder . 'n/'))
                                    {
                                        mkdir($folder . 'n/', 0777);
                                        chmod($folder, 0777);
                                    }
                                    if (!file_exists($folder . 'a/'))
                                    {
                                        mkdir($folder . 'a/', 0777);
                                        chmod($folder, 0777);
                                    }
                                    if (!file_exists($folder . 'm/'))
                                    {
                                        mkdir($folder . 'm/', 0777);
                                        chmod($folder, 0777);
                                    }
                                    if (!file_exists($folder . 's/'))
                                    {
                                        mkdir($folder . 's/', 0777);
                                        chmod($folder, 0777);
                                    }

                                    if (file_exists($tfolder . $wi_r[$cur_el]))
                                    { //copy files int the necessary folder
                                        if (copy($tfolder . $wi_r[$cur_el], $folder . $wi_r[$cur_el]) &&
                                                copy($tfolder . 'n/n_' . $wi_r[$cur_el], $folder . 'n/n_' . $wi_r[$cur_el]) &&
                                                copy($tfolder . 'm/m_' . $wi_r[$cur_el], $folder . 'm/m_' . $wi_r[$cur_el]) &&
                                                copy($tfolder . 's/s_' . $wi_r[$cur_el], $folder . 's/s_' . $wi_r[$cur_el]) &&
                                                copy($tfolder . 'a/a_' . $wi_r[$cur_el], $folder . 'a/a_' . $wi_r[$cur_el])) //after copying do unlink

                                        {
                                            unlink($tfolder . 'n/n_' . $wi_r[$cur_el]);
                                            unlink($tfolder . 'a/a_' . $wi_r[$cur_el]);
                                            unlink($tfolder . 'm/m_' . $wi_r[$cur_el]);
                                            unlink($tfolder . 's/s_' . $wi_r[$cur_el]);
                                            unlink($tfolder . $wi_r[$cur_el]);
                                        }
                                        else
                                            $errs[] = 'Some files could not be copied';
                                    }
                                    else
                                        $errs[] = 'Required file does not exist in the temporary directory';

                                    //put info about photo into the Albums & table of this wall
                                    if (empty($errs))
                                    {
                                        if (isset($swall_id))
                                        {
                                            $wpar = array('aid', 'img', 'descr', 'fpath',);
                                            $wval = array($swall_id, $wi_r[$cur_el], '', GetPostfix(UID));
                                            if ($wi_r[$cur_el + 10] = $moAlbums->UpdImg($wpar, $wval))
                                            {
                                                $wi_k[$cur_el + 10] = 'p_img_' . $i . '_id';
                                            }
                                        }
                                    }
                                }

                                $wi_k = array_merge(array('p_path', 'p_img_aid'), $wi_k); //add path to photo data in DB
                                $wi_r = array_merge(array(GetPostfix(UID), $swall_id), $wi_r);
                            }
                            elseif (4 == $mtype && 'p_url' == $k)
                            { //check photo
                                $l_el = !count($wi_k) ? 0 : count($wi_k) - 1;

                                //get ID of the current system_album
                                require_once 'Model/Base/Albums.class.php';
                                $moAlbums = new Model_Base_Albums($this->mlObj['gDb']);
                                $ualb_sys = $moAlbums->GetUAlbums(UID, 2);
                                foreach ($ualb_sys as $k => $r)
                                {
                                    if ('Inbox' == $r['name'])
                                    {
                                        $swall_id = $r['aid'];
                                        break;
                                    }
                                }

                                $cur_el = $l_el + 1;
                                $wi_k[$cur_el] = 'p_url';
                                $wi_r[$cur_el] = $wi['p_url'];

                                //put info about photo into the Albums & table of this wall
                                if (isset($swall_id))
                                {
                                    $wpar = array('aid', 'img', 'descr', 'fpath',);
                                    $wval = array($swall_id, $wi_r[$cur_el], '', 'link');
//                                        $wi_r[$cur_el + 10] = $moAlbums->UpdImg($wpar, $wval);
                                    if ($wi_r[$cur_el + 10] = $moAlbums->UpdImg($wpar, $wval))
                                    {
                                        $wi_k[$cur_el + 10] = 'p_img_1_id';
                                    }
                                }

                                $wi_k = array_merge(array('p_img_aid'), $wi_k); //add path to photo data in DB
                                $wi_r = array_merge(array($swall_id), $wi_r);
                            }
                            elseif (5 == $mtype)
                            { //check video code
                                if ('v_code' == $k)
                                {
                                    $wi_k[] = base_chk($k);
                                    $wi_r[] = chk_embed_code($r);
                                    //deb($wi_r);
                                    //get ID of the current system_album
                                    require_once 'Model/Base/Valbums.class.php';

                                    $moVAlbums = new Model_Base_Valbums($this->mlObj['gDb']);
                                    $ualb_sys = $moVAlbums->GetUValbums(UID_OTHER, 2);

                                    foreach ($ualb_sys as $k => $r)
                                    {
                                        if ('Wall' == $r['name'])
                                        {
                                            $svwall_id = $r['vaid'];
                                            break;
                                        }
                                    }

                                    //put info about video into the Albums & table of this wall
                                    if (empty($errs))
                                    {
                                        if (isset($svwall_id))
                                        {
                                            $wpar = array('vaid', 'video', 'descr');
                                            $wval = array($svwall_id, !empty($wi_r[2]) ? $wi_r[2] : '', '');

                                            $wi_k[10] = 'v_code_id';
                                            $wi_r[10] = $moVAlbums->UpdVideo($wpar, $wval);
                                        }
                                    }
                                }
                                else if ('v_file' == $k)
                                {
                                    isset($wi['v_file']) ? $cnt_wi_vfile = count($wi['v_file']) : $cnt_wi_vfile = 0;
                                    !count($wi_k) ? $l_el = 0 : $l_el = count($wi_k) - 1;

                                    for ($i = 1; $i <= $cnt_wi_vfile; $i++)
                                    {
                                        $cur_el = $l_el + $i;
                                        $wi_k[$cur_el] = 'v_file_' . $i;
                                        if (is_array($wi['v_file']))
                                            $wi_r[$cur_el] = $wi['v_file'][$i - 1];
                                        else
                                            $wi_r[$cur_el] = $wi['v_file'];
                                        //$wi_r[$cur_el] = $wi['v_file'][$i-1] ? is_array($wi['v_file']) : $wi_r[$cur_el] = $wi['v_file'];
                                    }
                                }
                                else
                                {
                                    $wi_k[] = base_chk($k);
                                    $wi_r[] = base_chk4($r, 8192);
                                }
                            }
                            else
                            { //check other elements
                                $wi_k[] = base_chk($k);

                                if ($k == 'ev_title')
                                {
                                    $wi_r[] = base_chk5($r, 80);
                                }
                                elseif ($k == 'ev_where')
                                {
                                    $wi_r[] = base_chk5($r, 80);
                                }
                                elseif ($k == 'story')
                                {
                                    $mes = base_chk7($r);
                                    $mes = preg_replace('|\[photo url=(http://beta\.inzion\.com/id[0-9]+/albums/id[0-9]+/id[0-9]+)\]|i',
                                        '<a href="\\1">photo</a>', $mes);

                                    $mes = preg_replace('|\[photo url=(http://inzion\.com/id[0-9]+/albums/id[0-9]+/id[0-9]+)\]|i',
                                        '<a href="\\1">photo</a>', $mes);

                                    //prepare tags in message
                                    $mes = close_tags($mes);
                                    $wi_r[] = $mes;
                                }
                                elseif ($k == 'ev_dt')
                                {
                                    $wi_r[] = date('Y-m-d H:i:s', strtotime($r));
                                }
                                else
                                {
                                    $wi_r[] = close_tags(base_chk7($r));
                                }
                            }
                        }
                    }
                }

                if (empty($errs) && !empty($wi_k))
                {
                    $wi_k = array_merge(array('puid', 'wuid', 'uid', 'new'), $wi_k); //add $user_id & UID data in DB

                    $mes_id = isset($si['mes_id']) ? (int) $si['mes_id'] : 0;
                    $privacy = isset($si['privacy']) ? (int) $si['privacy'] : 0; //set privacy

                    //sent to friend's MC
                    $wi_r_c = array_merge(array($user_id, $user_id, UID, 1), $wi_r);
                    $wi_k_c = $wi_k;

                    if (empty($this -> moUser -> mUserFriends[$user_id]))
                    {
                        //user blocked
                        $wi_k_c[] = 'new_blocked';
                        $wi_r_c[] = 1;
                    }

                    $this->moInbox->Edit($mes_id, $wi_k_c, $wi_r_c);

                    //send to current user MC
                    $wi_r_c = array_merge(array(UID, $user_id, UID, 0), $wi_r);

                    $id = $this->moInbox->Edit($mes_id, $wi_k, $wi_r_c);
                    $c_id = $id ? $id : $mes_id;

                    //notificution
                    $notif_story = '';
                    foreach ($wi_k_c as $k => $v)
                    {
                        switch ($v)
                        {
                            case 'story':
                                if (!empty($wi_r_c[$k]))
                                {
                                    $notif_story .= ($notif_story ? '<br />' : '') . $wi_r_c[$k];
                                }
                                break;

                            case 'p_img_1':

                                if (!empty($wi_r_c[$k]))
                                {
                                    $notif_story .= ($notif_story ? '<br />' : '') . 'Photo for you';
                                }
                                break;

                            case 'p_url':
                                if (!empty($wi_r_c[$k]))
                                {
                                    $notif_story .= ($notif_story ? '<br />' : '') . 'Photo for you';
                                }
                                break;

                            case 'v_code':
                                if (!empty($wi_r_c[$k]))
                                {
                                    $notif_story .= ($notif_story ? '<br />' : '') . 'Video for you';
                                }
                                break;

                            case 'l_url':
                                if (!empty($wi_r_c[$k]))
                                {
                                    $notif_story .= ($notif_story ? '<br />' : '') . 'Link for you';
                                }
                                break;
                        }
                    }

                    $this->mlObj['notify']->AddENentry(UID, $user_id, 4, array('msg' => $notif_story));

                    $mai = $this->moInbox->GetOne($c_id); //if IS_USER - without filtering (show all)
                    
                    if (!empty($mai['story']))
                    {
                        $this->moInbox->moSmiles->FindSmile($mai['story']);
                    }

                    $this->mSmarty->assign_by_ref('sname',$this->moInbox->moSmiles->smile_name);
                    $this->mSmarty->assign_by_ref('snamecode',$this->moInbox->moSmiles->smile_name_code);

                    $this->mSmarty->assign_by_ref('mai', $mai);

                    $res = array('q' => 'ok', 'data' => $this->mSmarty->fetch('mods/inbox/_wall_one.html'), 'cnt' => $this->moInbox->GetCnt(UID, $user_id, UID));
                    echo json_encode($res);
                }
                else
                {
                    echo json_encode(array('q' => 'not_success'));
                }
            }
            else
            {
                if (3 == $fr_info_for_me['active'])
                {
                    echo json_encode(array('q' => 'blocked'));
                }
                else
                {
                    echo json_encode(array('q' => 'not_success'));
                }
            }
            exit();
        }
        else
        { //show Inbox info
            $pcnt = 0;
            $rcnt = 7;

            $this -> moFriends -> SetFriendsMesg();
            $ar_fr = $this->moFriends->GetUserFriends(UID, 0, 0, array(1), 0, '', 0, 'u.first_name');
            $cnt_ar_fr = $this->moFriends->GetUserFriendsCount(UID, array(), 0);

            if ($ar_fr)
            {
                /**
                 * Get user with new message
                 */
                $lfr_id = $this -> moInbox ->  GetFriendByNewMessages(UID);
                if (empty($lfr_id))
                {
                    list($lfr_id, $vv) = each($ar_fr);
                }
                $this -> mSmarty -> assign('lfr_id', $lfr_id);

                $mai = $this->moInbox->GetList(UID, $lfr_id, UID, $pcnt, $rcnt, -1); //if IS_USER - without filtering (show all)
                $mai=array_reverse($mai);

                $cnt_mes = $this->moInbox->GetCnt(UID, $lfr_id, UID);

                $ar_new_mes = $this->moInbox->GetNewMes(UID);
                if ($ar_new_mes)
                {
                    foreach ($ar_fr as $k => $r)
                    {
                        $ar_uids = array_keys($ar_new_mes);
                        if (in_array($r['uid'], $ar_uids))
                            $ar_fr[$k]['cnt_new_mes'] = $ar_new_mes[$r['uid']];
                    }
                }

                //update status of the new messages from this user
                $this->moInbox->EditNewMes(0, UID, $lfr_id);

                $fr_info = $this->moFriends->GetFriend(UID, $lfr_id);
                $fr_info_for_me = $this->moFriends->GetFriend($lfr_id, UID);
                if ($fr_info_for_me)
                    $fr_info['my_active_for_fr'] = $fr_info_for_me['active'];

                if (!empty($mai))
                {
                    $rd = '';
                    $last_msg_time = 0;

                    // that's sooooooo funny :)
                    if (preg_match("/([0-9]{4})\-([0-9]{2})\-([0-9]{2}) ([0-9]{2})\:([0-9]{2})\:([0-9]{2})/", $mai[0]['pdate'], $rd))
                    {
                        $last_msg_time = date('U', mktime(0, 0, 0, $rd[2], $rd[3], $rd[1]));
                    }

                    $stamp = strtotime($mai[0]['pdate']);
                    $last_msg_time = (false != $stamp) ? $stamp : 0;
                }
                else
                {
                    $last_msg_time = 0;
                }

                $this->mSmarty->assign_by_ref('sname',$this->moInbox->moSmiles->smile_name);
                $this->mSmarty->assign_by_ref('snamecode',$this->moInbox->moSmiles->smile_name_code);

                $this->mSmarty->assign('inb_last_msg_time', $last_msg_time);

                $this->mSmarty->assign_by_ref('pcnt', $pcnt);
                $this->mSmarty->assign_by_ref('rcnt', $rcnt);

                $this->mSmarty->assign_by_ref('ar_fr', $ar_fr);
                $this->mSmarty->assign_by_ref('cnt_ar_fr', $cnt_ar_fr);

                $this->mSmarty->assign_by_ref('ar_new_mes', $ar_new_mes);
                $this->mSmarty->assign_by_ref('fr_info', $fr_info);

                $this->mSmarty->assign_by_ref('mai', $mai);
                $this->mSmarty->assign_by_ref('cnt_mes', $cnt_mes);
            }

            $this->mSmarty->assign('_content', $this->mSmarty->fetch('mods/inbox/_wall.html'));
        }
    }


    //-- Get List throught Ajax
    public function GetListAjax()
    {
        $user_id = (int) _v('user_id');
        $new = _v('new', 0);
        //$append = (int) _v('append');
        if (!empty($user_id) && defined('UID'))
        {
            $fr_ex = $this->moFriends->CheckFriend(UID, $user_id, array(1, 2, 3));

            if ($fr_ex)
            {
                $last_id = (int) _v('last_id', 0);
                $rcnt = 7;
                $pcnt=0;

                $mai = $this->moInbox->GetList(UID, $user_id, UID, 0, $rcnt, -1, '', $last_id);
                $first = $this -> moInbox -> GetFirstMessageId(UID, $user_id, UID);
                $mai=array_reverse($mai);

                //update status of the new messages from this user
                $this->moInbox->EditNewMes(0, UID, $user_id);

                $this->mSmarty->assign_by_ref('mai', $mai);

                $fr_info = $this->moFriends->GetFriend(UID, $user_id);
                $this->mSmarty->assign_by_ref('fr_info', $fr_info);

                $this->mSmarty->assign_by_ref('pcnt', $pcnt);
                $this->mSmarty->assign_by_ref('rcnt', $rcnt);

                $fr_info_for_me = $this->moFriends->GetFriend($user_id, UID);
                $this -> mSmarty -> assign('cmai', count($mai));
                $this -> mSmarty -> assign('no_absent', 1);
                $cnt_mes = $this->moInbox->GetCnt(UID, $user_id, UID);

                $this -> mSmarty -> assign('cnt_mes', $cnt_mes);

                //smiles
                $this->mSmarty->assign_by_ref('sname',$this->moInbox->moSmiles->smile_name);
                $this->mSmarty->assign_by_ref('snamecode',$this->moInbox->moSmiles->smile_name_code);


                if (!$new)
                {
                    $r = array($this->mSmarty->fetch('mods/inbox/_wall_list_2.html'),
                        $fr_info_for_me['active'],
                        (empty($mai) || $mai[count($mai) - 1]['id'] == $first) ? 0 : 1
                    );
                }
                else
                {
                    $r = array($this->mSmarty->fetch('mods/inbox/_wall_list.html'),
                        $fr_info_for_me['active'],
                        (empty($mai) || $mai[count($mai) - 1]['id'] == $first) ? 0 : 1
                    );
                }
                echo Ar2Json($r);
            }
            else
                die('not_success');
        }
        else
            die('not_success');
        exit();
    }

    /* GetListAjax */

    //-- Get One Message throught Ajax
    public function GetOneAjax()
    {
        $id = (int) _v('id');

        if (defined('UID') && !empty($id))
        {
            //-- get tags list
            $ctags = $this->moUser->mUser->GetTags(UID);
            $cnt_ctags = $this->moUser->mUser->GetCntTags(UID);
            $this->mSmarty->assign_by_ref('ctags', $ctags);
            $this->mSmarty->assign_by_ref('cnt_ctags', $cnt_ctags);

            $this->mSmarty->assign_by_ref('ctags_fav', $this->moUser->mUser->GetOneTag(-1, UID, 2));

            $mai = $this->moInbox->GetOne($id, !IS_USER ? $this->filts : array()); //if IS_USER - without filtering

            //smiles
            if (!empty($mai['story']))
            {
               $this->moInbox->moSmiles->FindSmile($mai['story']);
            }

            $this->mSmarty->assign_by_ref('sname',$this->moInbox->moSmiles->smile_name);
            $this->mSmarty->assign_by_ref('snamecode',$this->moInbox->moSmiles->smile_name_code);

            $this->mSmarty->assign_by_ref('mai', $mai);

            $this->mSmarty->display('mods/profile/_inbox_one.html');
        }
        else
            die('not_success');
        exit();
    }


    //-- Delete Message throught Ajax
    public function DelAllAjax()
    {
        $id = (int) _v('mes_id');
        $fr_id = (int) _v('fr_id');

        if (!$id)
            $id = -1;
        if (!$fr_id)
            $fr_id = -1;

        if (defined('UID'))
        {
            $this->moInbox->DelAll($id, UID, $fr_id, UID);
            exit();
        }
        else
        {
            die('not_success');
        }
    }


    //-- Delete Message throught Ajax
    public function DelAjax()
    {
        $id = (int) _v('mes_id');
        $fr_id = (int) _v('fr_id');

        if (!$id)
            $id = -1;
        if (!$fr_id)
            $fr_id = -1;

        if (defined('UID'))
        {
            $this->moInbox->Del($id, UID, $fr_id, UID);
            exit();
        }
        else
        {
            die('not_success');
        }
    }


    //-- Check Video existing
    public function ChckVideoAjax()
    {
        $id = (int) _v('id');
        if (defined('UID') && !empty($id))
        {
            $vi = $this->mVideo->Get($id);
            $res = array('id' => $id, 'vi' => '');
            if (!empty($vi) && !empty($vi['video']))
                $res['vi'] = $vi['video'];
            echo Ar2Json($res);
        }
        else
            die('not_success');
        exit();
    }


    //-- Check Link existing
    public function GetLinkInfoAjax()
    {
        $link = _v('link');
        if (defined('UID') && !empty($link))
        {
            $link = chk_link(base_chk($link));
            $title = GetSiteTitle($link);
            echo $title;
        }
        else
            die('not_success');
        exit();
    }


    public function ChngFrListAjax()
    {
        //deb($_REQUEST);
        $sb = (int) _v('sb');
        $str = base_chk(_v('str'));
        if (!$str)
            $str = '';

        $ar_fr = array();
        $this -> moFriends -> SetFriendsMesg();

        switch ($sb)
        {
            case 0:
                $ar_fr = $this->moFriends->GetUserFriends(UID, 0, 0, array(1), strtotime('now - 7days'), $str, 0, 'f.pdate DESC');
                $cnt_ar_fr = count($ar_fr);
                break;
            case 1:

                $ar_fr = $this->moFriends->GetUserFriends(UID, 0, 0, array(1), 0, $str, 0, 'u.first_name');
                $cnt_ar_fr = count($ar_fr);
                break;
            case 2:
                $ar_fr = $this->moFriends->GetUserFriends(UID, 0, 0, array(3), 0, $str);
                $cnt_ar_fr = count($ar_fr);
                break;
            case 3:
                $ar_fr = $this->moFriends->GetFrOnline(UID, array(1));
                $cnt_ar_fr = count($ar_fr);
                break;
        }
        $ar_new_mes = $this->moInbox->GetNewMes(UID, ($sb == 3));
        $ar_uids = array();
        if ($ar_new_mes)
        {
            foreach ($ar_fr as $k => $r)
            {
                $ar_uids = array_keys($ar_new_mes);
                if (in_array($r['uid'], $ar_uids))
                    $ar_fr[$k]['cnt_new_mes'] = $ar_new_mes[$r['uid']];
            }
        }
        $this->mSmarty->assign_by_ref('ar_fr', $ar_fr);
        $this->mSmarty->assign_by_ref('cnt_ar_fr', $cnt_ar_fr);
        $this->mSmarty->assign_by_ref('ar_new_mes', $ar_new_mes);

        $this->mSmarty->display('mods/inbox/_fr_list.html');
        exit();
    }


    //---- Additional Methods
    public function ChkUplPhoto()
    {
        $errs = array();
        $ret = array('status' => 'err', 'errs' => &$errs);
        if (!empty($_FILES['Filedata']['tmp_name']))
        {
            if (!is_uploaded_file($_FILES['Filedata']['tmp_name']))
                $errs[] = 'File is already uploaded';
            else
            {
                if (10240000 < $_FILES['Filedata']['size'] || 1 > $_FILES['Filedata']['size'])
                    $errs[] = 'File has an incorrect size';
                else
                {
                    $ext = get_img_ext($_FILES['Filedata']['tmp_name']);

                    if (false === $ext)
                        $errs[] = 'Incorrect extension';
                    else
                    {
                        $tempFile = $_FILES['Filedata']['tmp_name'];
                        $targetPath = $this->fpath_tmp;

                        if (!file_exists($targetPath))
                        {
                            mkdir($targetPath, 0777);
                            chmod($targetPath, 0777);
                        }
                        if (!file_exists($targetPath . 'n/'))
                        {
                            mkdir($targetPath . 'n/', 0777);
                            chmod($targetPath, 0777);
                        }
                        if (!file_exists($targetPath . 'a/'))
                        {
                            mkdir($targetPath . 'a/', 0777);
                            chmod($targetPath, 0777);
                        }
                        if (!file_exists($targetPath . 'm/'))
                        {
                            mkdir($targetPath . 'm/', 0777);
                            chmod($targetPath, 0777);
                        }
                        if (!file_exists($targetPath . 's/'))
                        {
                            mkdir($targetPath . 's/', 0777);
                            chmod($targetPath, 0777);
                        }
                        $crand = mktime() . rand(100, 999);
                        //$targetFile = UID.'_w_'.UID_OTHER.'_'.date('dmYHi').'_'.$crand.'_'.$_FILES['Filedata']['name'];
                        $targetFile = UID . '_iw_' . UID_OTHER . '_' . $crand . '_' . Txt2Charset($_FILES['Filedata']['name']);

                        $target = $targetPath . $targetFile;
                        if (file_exists($target))
                            unlink($target);

                        i_crop_copy(658, 439, $_FILES['Filedata']['tmp_name'], $targetPath . 'n/n_' . $targetFile, 2);
                        $src = $targetPath . 'n/n_' . $targetFile;

                        i_crop_copy(358, 200, $src, $target, 2);
                        i_crop_copy(324, 217, $src, $targetPath . 'a/a_' . $targetFile, 2);
                        i_crop_copy(69, 69, $src, $targetPath . 'm/m_' . $targetFile, 1);
                        i_crop_copy(49, 49, $src, $targetPath . 's/s_' . $targetFile, 1);

                        $ret['status'] = 'success';
                        $ret['image'] = $targetFile;
                    }
                }
            }
        }

        include_once 'Ctrl/Ajax/Json.php';
        $mJson = new Services_JSON();
        echo $mJson->encode($ret);
        exit();
    }


    public function AjaxFindUser()
    {
        $q = _v('q');
        $rev = _v('rev');
        if ($q)
        {
            $this -> moFriends -> SetFriendsMesg();
            $fr = $this->moFriends->GetUserFriends(UID, 0, 0, array(1), 0, $q);
        }
        if (!empty($fr))
        {
            foreach ($fr as $k => $r)
            {
                if (!$rev)
                {
                    echo $r['uid'] . '|' . $r['first_name'] . ' ' . $r['last_name'] . "\n";
                }
                else
                {
                    echo $r['first_name'] . ' ' . $r['last_name'] . '|' . $r['uid'] . "\n";
                }
            }
        }
        exit;
    }
}
?>