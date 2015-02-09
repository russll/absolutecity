<?php
/**
 * Front-office front-controller
 *
 * @package    5dev Social
 * @subpackage OmniCoim
 * @version    1.0
 * @since      14.12.2009
 * @copyright  2004-2010 5Dev
 * @link       http://5dev.com
 */
//error_reporting(E_ALL);
    define('SMODULE','Public');

    require '_top.php';

    require 'Ctrl/Init.class.php'; 

    new Ctrl_Init( $glObj, 'index' );
?>