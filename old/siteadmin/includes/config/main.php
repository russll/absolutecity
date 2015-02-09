<?php
/** DB Params */
define('DB_TYPE',   'mysql');         // allow 'mysql','mssql','pgsql' etc. (compatible with PEAR)
define('DB_MYSQL_VER', 4.1);          // MySQL Version
define('DB_HOST',   'localhost');     // mysql-server name
    define('DB_USER',   'inzion');          // existing user of database
    define('DB_PASS',   'Inzion13');              // and its password
    define('DB_NAME',   'inzion');          // name of database
define( 'TB',       'inz_' );        // prefix for all tables for this database


define('OS', 'NIX');
/** Site Config */	
define('DIR_IMAGE_PATH'          , '/');
define('DIR_IMAGE_FPATH'         , '/');

define('DOMEN'          , 'inzdemo.local');
define('PATH_ROOT'      , '/');    // Site root path
define('PATH_ROOT_ADM'  , '/siteadmin/');    // Site root path
define('BPATH'          , $_SERVER['DOCUMENT_ROOT'] . '/');// Web-server root path

define('DEF_CHARSET', 'utf-8'); 
define('SUPPORT_SITENAME', 'inzion.com');
define('SUPPORT_EMAIL', 'not_reply@'.DOMEN);
define('ADMIN_EMAIL', 'sergysh@gmail.com');	

define('SESSION_ID_IN_URL', 0);      // Use session id in url
define('SESSION_NAME', 'omni3id');   // Default session name

define('GZ_COMPRESS', 1);
define('DIR_NAME_IMAGE_SUBDIR', '');

define( 'DIR_NAME_IMAGE', 'files/images/');
define( 'DIR_WS_IMAGE', BPATH . DIR_NAME_IMAGE );

define( 'DIR_NAME_VIDEO', 'files/video/');
define( 'DIR_WS_VIDEO', BPATH . DIR_NAME_VIDEO );

/** Date & Time Info */
define('DT_FORMAT', 'Y-m-d H:i:s');
define('NOW_TIME', time());
define('NOW_DATE', date(DT_FORMAT, NOW_TIME));
define('NOW_YEAR', idate('Y', NOW_TIME));

/** Admin info */	
define('ADMIN_UID', 3);
define('ADMIN_LOGIN', 'admin');

/** Errors */
define('FATAL_ERROR_DISP', 1);/** 1 - show, 2 - send email */   
define('CURRENT_SCP'  , $_SERVER['SCRIPT_NAME']);
?>