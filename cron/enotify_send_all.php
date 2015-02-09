<?php
    if (!defined('PATH_SEPARATOR'))
    {
        define("PATH_SEPARATOR", ":");
    }

    define('CLASS_PATH', 'siteadmin/includes/classes/');

    $p = '/var/www/vhosts/inzion.com/';
    ini_set("include_path", '.'.PATH_SEPARATOR.$p . ''.CLASS_PATH.PATH_SEPARATOR.$p . ''.CLASS_PATH.'Model/Pear');

    /** Init Libs */
    include_once $p.'siteadmin/includes/config/main.php';
    include_once $p.'siteadmin/includes/libs/functions.php';

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
    $glObj['Smarty'] -> template_dir  = $p .'includes/templates';
    $glObj['Smarty'] -> compile_dir   = $p .'files/templ/';
    $glObj['Smarty'] -> config_dir    = $p .'includes/conf/';
    $glObj['Smarty'] -> plugins_dir   = array(
            'plugins',
            $p .'includes/templates/plugins'
    );

    include_once 'Model/Base/Notify.class.php';

    $gNotify = new Model_Base_Notify($glObj);

    echo $gNotify -> SendENotices($glObj['Smarty']);
?>