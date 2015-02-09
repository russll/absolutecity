<?php
if (!defined("PATH_SEPARATOR"))
{
    define("PATH_SEPARATOR", getenv("COMSPEC")? ";" : ":");
}
define('CLASS_PATH', '/siteadmin/includes/classes/');
//die('.'.PATH_SEPARATOR.dirname(__FILE__) . ''.str_replace('/siteadmin', '', CLASS_PATH).PATH_SEPARATOR.dirname(__FILE__) . ''.str_replace('/siteadmin', '', CLASS_PATH).'Model/Pear');
ini_set("include_path", '.'.PATH_SEPARATOR.dirname(__FILE__) . ''.str_replace('/siteadmin', '', CLASS_PATH).PATH_SEPARATOR.dirname(__FILE__) . ''.str_replace('/siteadmin', '', CLASS_PATH).'Model/Pear');

//ini_set('include_path', '.'.PATH_SEPARATOR.dirname(__FILE__) . '/'.CLASS_PATH.PATH_SEPARATOR.dirname(__FILE__) . '/'.CLASS_PATH.'Model/Pear');

/** Init Libs */
include_once 'includes/config/main.php';
include_once 'includes/libs/functions.php';

/** Session config and initialization */
session_save_path( BPATH . '/files/sessions' );
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

if (!empty($_POST["mbm3id"]))
{
    session_id( $_POST["mbm3id"] );
}
session_start();  // Start session	


/** Init DB */  
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
$glObj['Smarty'] -> compile_dir   = BPATH . 'files/templ/admin/';
$glObj['Smarty'] -> config_dir    = 'includes/templates/lang/';
$glObj['Smarty'] -> plugins_dir   = array(
        'plugins',
        'includes/templates/plugins'
); 
$glObj['Smarty'] -> assign('tplDir', '/siteadmin/includes/templates/');                                     
$glObj['Smarty'] -> assign('imgDir', '/siteadmin/includes/templates/images/');
$glObj['Smarty'] -> assign('stlDir', '/siteadmin/includes/templates/styles/');
$glObj['Smarty'] -> assign('jsDir',  '/siteadmin/includes/templates/js/');

/** Init Base Class */
require 'Ctrl/Base.class.php';

/** Init Users */
include_once 'Ctrl/Security/Users.class.php';
$glObj['moUser'] = new Ctrl_Security_Users( $glObj );

/** Check LogOut */
$glObj['moUser'] -> LogOut();

/** Check Auth */
$glObj['moUser'] -> CheckAuth();



if (!$glObj['moUser'] -> mSystemLogin)
{
    $glObj['moUser'] -> AuthForm();
    exit();
}

$glObj['moUser'] -> __set('mIsAdmin', 1);
define('IT_ADMIN', 1);

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
?>