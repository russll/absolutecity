<?php
/** DB Params */
define('DB_TYPE',   'mysql');         // allow 'mysql','mssql','pgsql' etc. (compatible with PEAR)
define('DB_MYSQL_VER', 4.1);          // MySQL Version
define('DB_HOST',   'localhost');     // mysql-server name
define('DB_USER',   'inzion');          // existing user of database
define('DB_PASS',   'Inzion13');          // and its password
define('DB_NAME',   'inzion_new');      // name of database
define( 'TB',       'inz_' );        // prefix for all tables for this database


define('OS', 'NIX');
/** Site Config */
define('DIR_IMAGE_PATH'          , '/');
define('DIR_IMAGE_FPATH'         , '/');

define('DOMEN'          , 'inzion.com');
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


define( 'INIT_CACHE', 0 );


/** Admin info */	
define('ADMIN_UID', 3);
define('ADMIN_LOGIN', 'admin');

/** Errors */
define('FATAL_ERROR_DISP', 2);/** 1 - show, 2 - send email */   
define('CURRENT_SCP'  , $_SERVER['SCRIPT_NAME']);


// < Time config >

function m_time()
{ 
    return time();
}

function get_mt_time()
{
    $arr = split(' ',microtime());
    return ($arr[0] + $arr[1]);
}

function uniq_time()
{ 
    return str_replace('.', '', get_mt_time());
}

define('DT_FORMAT'        , 'Y-m-d H:i:s');
define('COOKIE_DT_FORMAT' , 'D, d-M-Y 00:00:00 GMT');
define('NOW_TIME'         , m_time());
define('NOW_DATE'         , date(DT_FORMAT, NOW_TIME));
define('NOW_YEAR'         , idate('Y', NOW_TIME));
define('NUL_DATE'         , '1000-01-01');
define('START_DATE'       , '2008-01-01');
define('START_YEAR'       , 2008);
define('START_MONTH'      , 1);
define('CURRENT_DAY'      , date('Y-m-d', NOW_TIME));
define('BEGIN_SCRIPT_TIME', get_mt_time());
define('TODAY_TIME'       , strtotime(CURRENT_DAY));

define('FE_ONLINE'        , 180); // seconds
define('APPROVED_PERIOD'  , 5);   // days
// </ Time config >

define('MAX_MSG_TAGS'    , 15);  // count

// -------------------------------------------------------------------------------------------

    ini_set('mbstring.func_overload' , 7);
    ini_set('default_charset'   , 'UTF-8');
    ini_set('mbstring.language' , 'Russian');
    ini_set('mbstring.internal_encoding'   , 'UTF-8');
    ini_set('mbstring.encoding_translation' , 'on');
    ini_set('mbstring.http_input' , "UTF-8,KOI8-R,CP1251");
    ini_set('mbstring.http_output' , 'UTF-8');
    ini_set('mbstring.detect_order' , "UTF-8,KOI8-R,CP1251");
?>