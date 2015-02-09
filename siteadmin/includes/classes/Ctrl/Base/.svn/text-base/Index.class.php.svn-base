<?php

/**
 * Indexe's Base controller
 *
 * @package    5dev Wall
 * @version    1.0
 * @since      29.03.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */
class Ctrl_Base_Index extends Ctrl_Base
{

    public function __construct(&$glObj, &$moUser)
    {
        parent :: __construct($glObj);
    }

    public function Index()
    {

        if (defined('UID'))
        {
            uni_redirect(PATH_ROOT . 'id' . UID);
        }


        $dd = array();
        for ($i = 1; $i <= 31; $i++)
        {
            $dd[] = $i;
        }
        $mm = array(1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'May',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Aug',
            9 => 'Sep',
            10 => 'Oct',
            11 => 'Nov',
            12 => 'Dec');
        $yy = array();
        for ($i = date("Y"); $i >= date("Y") - 99; $i--)
        {
            $yy[] = $i;
        }
        $this->mSmarty->assign_by_ref('mm', $mm);
        $this->mSmarty->assign_by_ref('dd', $dd);
        $this->mSmarty->assign_by_ref('yy', $yy);

        /** init registration form */
        $this->mSmarty->assign('_content', $this->mSmarty->Fetch('mods/users/_reg.html'));

        define('INDEX', 1);
    }

    /** Index */

    public function Indexadmin()
    {

    }

    public function AboutUs()
    {
        $this->mSmarty->assign('_content', $this->mSmarty->Fetch('mods/static/_about_us.html'));

        define('INDEX', 1);
    }

    public function ContactUs()
    {
        $this->mSmarty->assign_by_ref('countries', $GLOBALS['cntrs']);

        if (!empty($_POST['fm']))
        {
            $fm = $_POST['fm'];
            $errs = array();

            if (empty($fm['name']))
            {
                $errs[] = $this -> mSmarty -> get_config_vars('index_err1');//'Please specify you name';
            }

            if (empty($fm['email']) || !verify_email($fm['email']))
            {
                $errs[] = $this -> mSmarty -> get_config_vars('index_err2');//'Please specify correct e-mail';
            }

            $fm['mesg'] = empty($fm['mesg']) ? '' : strip_tags($fm['mesg']);

            if (empty($fm['mesg']))
            {
                $errs[] = $this -> mSmarty -> get_config_vars('index_err3');//'Please specify message';
            }

            if (empty($errs))
            {
                include_once 'Ctrl/Mail/PhpMailer/class.phpmailer.php';
                $gMail = new PHPMailer();
                $gMail->From = 'do-not-reply@' . DOMEN;
                $gMail->FromName = 'inZion';
                $gMail->AddAddress(ADMIN_EMAIL, SUPPORT_SITENAME);
                $gMail->WordWrap = 50;
                $gMail->IsHTML(true);
                $this->mSmarty->assign_by_ref('fm', $fm);
                $gMail->Subject = $this -> mSmarty -> get_config_vars('index_err4');//'inZion contact form';
                $gMail->Body = $this->mSmarty->Fetch('mails/contactform.html');
                if (!$gMail->Send())
                {
                    $errs[] = $gMail->ErrorInfo;
                }
                uni_redirect(PATH_ROOT . 'contact_us.html?send=1');
            }
            $this->mSmarty->assign_by_ref('errs', $errs);
            $this->mSmarty->assign_by_ref('fm', $fm);
        }
        $this->mSmarty->assign('send', _v('send', 0));
        $this->mSmarty->assign('_content', $this->mSmarty->Fetch('mods/static/_contact_us.html'));

        define('INDEX', 1);
    }

    public function Donate()
    {
        $this->mSmarty->assign('_content', $this->mSmarty->Fetch('mods/static/_donate.html'));

        define('INDEX', 1);
    }


    public function Terms()
    {
        $this -> mSmarty -> assign('HIDE_RC', 1);
        $this -> mSmarty -> assign('NO_ROBOTS', 1);  
        $this->mSmarty->assign('_content', $this->mSmarty->Fetch('mods/static/_terms.html'));

        define('INDEX', 1);
    }


    public function Privacy()
    {
        $this -> mSmarty -> assign('HIDE_RC', 1);
        $this -> mSmarty -> assign('NO_ROBOTS', 1);                
        $this->mSmarty->assign('_content', $this->mSmarty->Fetch('mods/static/_privacy.html'));
        define('INDEX', 1);
    }


    public function Faq()
    {
        $this -> mSmarty -> assign('HIDE_RC', 1);
        $this -> mSmarty -> assign('HIDE_LC', 1);
        $this -> mSmarty -> assign('NO_ROBOTS', 1);
        $this->mSmarty->assign('_content', $this->mSmarty->Fetch('mods/static/_faq.html'));
        define('INDEX', 1);
    }

}

?>