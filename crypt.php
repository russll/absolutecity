<?php
//echo date("d.m.Y",  	1270121303);die;
include_once '_top.php';

include_once 'Model/Security/Rc4.class.php';
$mRc4  = new Model_Security_Rc4();
$mRc4  -> setKey( 'idfdnjewrjerjewrjbk' );

$v = 'e2b831ce9f47b12ec5';
$v = hex2bin($v);
$mRc4 -> decrypt($v);
echo $v;


?>
