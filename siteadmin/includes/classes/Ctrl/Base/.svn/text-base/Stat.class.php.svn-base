<?php
/**
 * Mission Base controller
 * @package    5dev Catalog
 * @version    1.0
 * @since      1.03.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */
class Ctrl_Base_Stat extends Ctrl_Base
{
    
    public function __construct( &$glObj )
    {
        parent :: __construct( $glObj );
        
        if (!defined('UID'))
			uni_redirect( PATH_ROOT . '' );
		
        include_once 'Model/Security/Users.class.php';
        $this -> mUsers = new Model_Security_Users( $glObj['gDb'], null );

		include_once 'Model/Base/Stat.class.php';
        $this -> mStat = new Model_Base_Stat( $glObj['gDb'] );
    }
    

	public function Indexadmin()
    {
        if (!defined('IT_ADMIN')) {
            exit();
        }

		$stat = array();

//		echo date('d-m-y H:i:s', strtotime('-7 days'));
		$stat['new'] = array('month' => $this -> mStat -> countUsersByPeriod(strtotime(NOW_YEAR."-".date("m")."-01 00:00:00"), mktime()),
							 'last7days' => $this -> mStat -> countUsersByPeriod(strtotime('-7 days'), mktime()),
							 'week' => $this -> mStat -> countUsersByPeriod(strtotime('last Monday 00:00:00'), mktime()),
							 //'last_day' => $this -> mStat -> countUsersByPeriod(strtotime('-1 days'), mktime()),
                                                         'yesterday' => $this -> mStat -> countUsersByPeriod(strtotime('yesterday 00:00:00'), mktime()),
							 'today' => $this -> mStat -> countUsersByPeriod(strtotime(NOW_YEAR."-".date("m").'-'.date("d").' 00:00:00'), mktime()),
							 'total' => $this -> mStat -> countUsersByPeriod());
                $this -> mSmarty -> assign('stat', $stat);
        $this -> mSmarty -> assign('_content', $this -> mSmarty -> Fetch('mods/stat/_stat.html'));
    }/** IndexAdmin */


}/** Ctrl_Base_Mission */
?>