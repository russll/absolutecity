<?php
/**
 * Stat Base model
 * @package    5dev Catalog
 * @version    1.0
 * @since      1.03.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */
class Model_Base_Stat
{
    //system params
    private $mDb;

    //tables
    private $mTbUsers;


    /**
     * Constructor 
     *
     * @param $glObj
     */
    public function __construct( &$gDb )
    {
        //wall's tables
        $this -> mDb          	  =& $gDb;
        $this -> mTbUsers         = TB . 'users';
    }/* __construct */


	public function countUsersByPeriod($start = 0, $end = 0, $active = true)
	{
		$sql = 'SELECT count(uid) FROM '.$this -> mTbUsers.' WHERE created_date >= ? AND created_date <= ?';
		$data = $this -> mDb -> getOne($sql, array(date('Y-m-d H:i:s', $start), date('Y-m-d H:i:s', $end)));
		if ($start == 0 && $end ==0)
                {
                    $sql = 'SELECT count(uid) FROM '.$this -> mTbUsers.' WHERE 1';
                    $data2 = $this -> mDb -> getOne($sql);
                    if ($active)
                    {
                       $sql = 'SELECT count(uid) FROM '.$this -> mTbUsers.' WHERE rchecksum = "" ';
                       $data3 = $this -> mDb -> getOne($sql);
                    }
                    return $data2.'['.$data3.']';
                }
                else
                {
                    $sql = 'SELECT count(uid) FROM '.$this -> mTbUsers.' WHERE created_date >= ? AND created_date <= ?';
                    $data = $this -> mDb -> getOne($sql, array(date('Y-m-d H:i:s', $start), date('Y-m-d H:i:s', $end)));
                    if ($active)
        		{
                            $sql = 'SELECT count(uid) FROM '.$this -> mTbUsers.' WHERE created_date >= ? AND created_date <= ? AND rchecksum = "" ';
                            $data2 = $this -> mDb -> getOne($sql, array(date('Y-m-d H:i:s', $start), date('Y-m-d H:i:s', $end)));
                            return $data.'['.$data2.']';
                	}
                    return $data;
                }
	}


    


}/* Model_Base_Mission */
?>
