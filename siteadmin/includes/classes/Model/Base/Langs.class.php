<?php
/**
 * Stat Base model
 * @package    5dev Catalog
 * @version    1.0
 * @since      1.03.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */
class Model_Base_Langs
{
    //system params
    private $mDb;

    //tables
    private $mTbLangs;


    /**
     * Constructor 
     *
     * @param $glObj
     */
    public function __construct( &$gDb )
    {
        //wall's tables
        $this -> mDb          	  =& $gDb;
        $this -> mTbLangs         = TB . 'languages';
    }/* __construct */


	public function searchLang($q = '')
	{
		$h = array();
		if ($q) {

			$res = $this -> mDb -> query("SELECT title FROM ".$this->mTbLangs." WHERE title LIKE ? ", array('%'.$q.'%'));
			while($r = $res -> FetchRow())
			{
				$h[] = $r['title'];
			}
		}
		return $h;
	}


}/* Model_Base_Mission */
?>
