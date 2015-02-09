<?php
/**
 * Profile's Base controller
 *
 * @package    5dev Wall
 * @version    1.0
 * @since      29.03.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */
class Ctrl_Base_Profile extends Ctrl_Base
{ 
    
    public function __construct( &$glObj )
    {
        parent :: __construct( $glObj );
        include_once 'Model/Base/Profile.class.php';
        $this -> mCoin = new Model_Base_Profile( $glObj['gDb'] );
    }/** __construct */
    
    
}/** Ctrl_Base_Profile */
?>