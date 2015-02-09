<?php
/**
 * Ward's Base controller
 *
 * @package    5dev Wall
 * @version    1.0
 * @since      31.03.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */
class Ctrl_Base_Reports extends Ctrl_Base
{
    private $mWard;

    public function __construct( &$glObj )
    {
        parent :: __construct( $glObj );

        if (!defined('UID'))
            uni_redirect( PATH_ROOT . '' );

        include_once 'Model/Base/Reports.class.php';
        $this -> mRep = new Model_Base_Reports( $glObj['gDb'] );
    }/** __construct */
   

    public function Indexadmin()
    {
        if (!defined('IT_ADMIN'))
        {
            exit();
        }

        $page = _v('page', 1);
        include_once 'View/Acc/Pagging.php';
        $pcnt = 10;
        $rcnt = $this -> mRep -> CountList();
        
		$mpage   =   new Pagging($pcnt, $rcnt, $page, PATH_ROOT_ADM . 'base/reports/');
        $this -> mSmarty -> assign('rcnt', $rcnt);
		$this -> mSmarty -> assign('pcnt', $pcnt);
		$this -> mSmarty -> assign('page', $page);
        $range   =& $mpage -> GetRange(  );
        $this -> mSmarty -> assign('plist_c',  $range[1] - $range[0]);
        $list    =& $this -> mRep -> GetList(0,0, $range[0], $pcnt);

        $this -> mSmarty -> assign_by_ref('pl', $list);
        $this -> mSmarty -> assign('pagging',  $mpage   -> Make($this -> mSmarty));

        $this -> mSmarty -> assign('_content', $this -> mSmarty -> Fetch('mods/reports/_list.html'));
    }/** IndexAdmin */



    public function Del()
    {

        if (!defined('IT_ADMIN')) {
            exit();
        }

        $id = _v('id', 0);
        if ($id) {
            $this -> mRep -> Del($id);
        }
        uni_redirect( $_SERVER['HTTP_REFERER']);
    }/** Del */

    
}/** Ctrl_Base_Ward */
?>