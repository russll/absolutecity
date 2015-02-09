<?php
abstract class Ctrl_Base
{
    /**
     * Global object
     * */
    protected $mlObj;
    
    /**
     * Db Pointer
     * */
    protected $mDb;

    /**
     * Smarty
     * */
    protected $mSmarty;

    /**
     * Breadcrumb array
     * @var array
     */
    protected $mBc;

    /**
     * User object
     * @var object
     */
    protected $moUser;

    /**
     * Memcached object
     * @var object
     */
    protected $moMemcached;

    /** Admin area status */
    protected $mItAdmin;


    public function __construct( &$glObj )
    {
        $this -> mDb     =& $glObj['gDb'];
        $this -> mSmarty =& $glObj['Smarty'];
        $this -> mlObj   =& $glObj;
        $this -> moUser  =& $glObj['moUser'];
        $this -> moMemcached =& $glObj['moMemcached'];
        $this -> mItAdmin = !empty($glObj['itAdmin']) ? 1 : 0;
    }


    /**
     * Set breadcrumb array value
     * @param $name
     * @param $link
     * @return void
     */
    public function SetBc($name, $link)
    {
        if (empty($this -> mBc))
        $this -> mBc = array();
        $this -> mBc[] = array('name' => $name, 'link' => $link);
    }/** SetBc */



    /**
     * Assign breadcrumb to smarty
     * @return void
     */
    public function AssignBc()
    {
        $this -> mSmarty -> assign_by_ref('bc', $this -> mBc);
    }
}
?>