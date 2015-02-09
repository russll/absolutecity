<?php
/**
 * CH Wall model
 * @package    5dev Catalog
 * @version    1.0
 * @since      1.03.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */
class Model_Base_Reports
{
    //system params
    private $mDb;

    //tables
    private $mTbReports;
    
    /**
     * Constructor
     *
     * @param $glObj
     */
    public function __construct( &$gDb )
    {
        //wall's tables
        $this -> mDb             =& $gDb;
        $this -> mTbReports      = TB . 'reports';
        $this -> mTbUsers        = TB . 'users';
    }/* __construct */


	public function CountList($uid = 0, $uid_to = 0, $start = 0, $cnt = 0) {
		$sql = ' SELECT count(id) FROM '.$this -> mTbReports.'';

		$r = $this -> mDb -> getOne($sql);
		return $r;
	}

    public function GetList($uid = 0, $uid_to = 0, $start = 0, $cnt = 0) {

		$sql = ' SELECT r.*, CONCAT (u.first_name, " ", u.last_name) as who, CONCAT (u2.first_name, " ", u2.last_name) as who2
				 FROM '.$this -> mTbReports.' r
				 LEFT JOIN '.$this -> mTbUsers.' u ON (u.uid = r.uid)
				 LEFT JOIN '.$this -> mTbUsers.' u2 ON (u2.uid = r.uid_to) ';

		if ($cnt > 0)
			$db = $this -> mDb -> limitQuery($sql, $start, $cnt);
		else
			$db = $this -> mDb -> query($sql);

		$r =  array();
		while ($row = $db -> FetchRow()) {
			$row['pdate'] = date('d-m-Y H:i:s', $row['pdate']);
			$r[] = $row;
		}

		return $r;
	}

	public function Report($uid, $uid_to, $url, $mesg)
    {
		$this -> mDb -> query('INSERT INTO '.$this -> mTbReports.' (uid, uid_to, url, mesg, pdate) VALUES (?,?,?,?,?) ', array($uid, $uid_to, $url, $mesg, mktime()));
	}

	public function Del($id)
    {
		$this -> mDb -> query('DELETE FROM '.$this -> mTbReports.' WHERE id = ?', array($id));
	}


}/* Model_Base_Ward */
?>
