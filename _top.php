<?php

error_reporting(2047);
ini_set('display_startup_errors', 1);
ini_set('display_errors' , 1);


if (!defined("PATH_SEPARATOR"))
{
    define("PATH_SEPARATOR", getenv("COMSPEC")? ";" : ":");
}
define('CLASS_PATH', '/siteadmin/includes/classes/');

ini_set("include_path", '.'.PATH_SEPARATOR.dirname(__FILE__) . ''.CLASS_PATH.PATH_SEPARATOR.dirname(__FILE__) . ''.CLASS_PATH.'Model/Pear');


/** Init Libs */
include_once 'siteadmin/includes/config/main.php';
include_once 'siteadmin/includes/libs/functions.php';

define('START_TIME', get_mt_time());

$GLOBALS['gtime'] = get_mt_time();
//echo get_mt_time();
//echo "<br>".time();
//echo date("O");
$GLOBALS['gCnt']  = 0;
ClearLog();

/** Session config and initialization */
session_save_path( BPATH . 'files/sessions');
session_name(SESSION_NAME);

if (SESSION_ID_IN_URL)
{
    ini_set('session.use_trans_sid'   ,'1');
    ini_set('session.use_only_cookies','0');
}
else
{
    ini_set('session.use_trans_sid'   ,'0');
    ini_set('session.use_only_cookies','1');
}

if (!empty($_POST[SESSION_NAME]))
{
    session_id( $_POST[SESSION_NAME] );
}

session_start();  // Start session	
//$_SESSION['stat'] = '';
//deb($_SESSION);
/** Init DB */  

if (_v('ds', 0))
{
 deb($h = array($_COOKIE, $_SESSION));
}
 
 
include 'Model/Pear/DB.php';
PEAR::setErrorHandling(PEAR_ERROR_CALLBACK,'pear_error_callback');  
try
{
    $glObj['gDb'] =& DB::connect(DB_TYPE.'://'.DB_USER.':'.DB_PASS.'@'.DB_HOST.'/'.DB_NAME); // select db type
}
catch (Exception $exc)
{
    sc_error($exc);
}  
$glObj['gDb'] -> setFetchMode(DB_FETCHMODE_ASSOC);
$glObj['gDb'] -> query('SET NAMES utf8');    

/** Init Smarty */
require 'View/Smarty/Smarty.class.php';
$glObj['Smarty']                  = new Smarty();
$glObj['Smarty'] -> compile_check = true;
$glObj['Smarty'] -> debugging     = false;
$glObj['Smarty'] -> template_dir  = 'includes/templates';
$glObj['Smarty'] -> compile_dir   = 'files/templ/';
$glObj['Smarty'] -> config_dir    = 'includes/conf/';
$glObj['Smarty'] -> plugins_dir   = array('plugins','includes/templates/plugins');
$glObj['Smarty'] -> assign('imgDir', PATH_ROOT.'i/');
$glObj['Smarty'] -> assign('jsDir', PATH_ROOT.'j/');
$glObj['Smarty'] -> assign('jsClDir', PATH_ROOT.'j/Classes/');
$glObj['Smarty'] -> assign('flDir', PATH_ROOT.'fl/');
$glObj['Smarty'] -> assign('stlDir', PATH_ROOT.'s/');
$glObj['Smarty'] -> assign('fImgDir' , PATH_ROOT.'files/images/');

$glObj['Smarty'] -> assign('SSesID' , session_id());
$glObj['Smarty'] -> assign('DOMEN', DOMEN);


/** Init memcached */

include_once 'Model/Cache/Memcache.class.php';
$glObj['moCache'] = new Model_Cache_Memcache();

/** Init Grafics Libs */
require 'Ctrl/Image/Image_Transform.php';
require 'Ctrl/Image/Image_Transform_Driver_GD.php';

/** Init Base Class */
require 'Ctrl/Base.class.php';

/** Init Users */
include_once 'Ctrl/Security/Users.class.php';
$glObj['moUser'] = new Ctrl_Security_Users( $glObj );	

/** Check LogOut */
$glObj['moUser'] -> LogOut();

/** Check Auth */
$glObj['moUser'] -> CheckAuth();

if(defined('IS_USER') && !IS_USER && $glObj['moUser'] -> mUi['im_blocked'] == 1)
{
    if(isset($mod) && $mod != 'wall')
    {
        uni_redirect( PATH_ROOT . 'id' . UID_OTHER);
    }
    $glObj['Smarty'] -> assign('im_blocked' , true);
}
else
{
    $glObj['Smarty'] -> assign('im_blocked' , false);
}

/** Init Geo */
ip_init();
require 'Model/Geografy/Main.class.php';
$glObj['geo'] = new Model_Geografy_Main($glObj);
if (empty($_SESSION['countries']))
{
    $GLOBALS['cntrs']  = $glObj['geo'] -> GetCountries(1);
    $_SESSION['countries'] = $GLOBALS['cntrs'];
}
else
{
    $GLOBALS['cntrs']  = $_SESSION['countries'];
}


    /*include_once 'Model/Base/Notify.class.php';

    $gNotify = new Model_Base_Notify($glObj);

    echo $gNotify -> SendENotices($glObj['Smarty']);

    exit;*/

?>