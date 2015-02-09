<?php
/**
 * Modules Class
 * @package   5dev catalog 4
 * @version   0.1a
 * @since     29.04.2006
 * @copyright 2004-2008 5dev Team
 * @link      http://5dev.com
 */

class Ctrl_Security_Modules extends Ctrl_Base
{	
    private $mModules;

    public function __construct( &$glObj )
    {
        parent :: __construct( $glObj );

        $this -> mSmarty -> config_load( 'modules.conf' );
        include_once 'Model/Security/Modules.class.php';
        $this -> mModules = new Model_Security_Modules( $glObj['gDb'] );
    }

    public function Indexadmin()
    {
        $this -> mSmarty -> assign_by_ref('list', $this -> mModules -> GetList());
        $this -> mSmarty -> assign('_content', $this -> mSmarty -> fetch('mods/Security/Modules.html'));
    }/** Showlist */


    public function Edit()
    {
        $ar = $_REQUEST;
        $id = _v('id', 0);

        if ( $id )
        {
            $ar['name']    = $_REQUEST['name'.$id];
            $ar['sortid']  = $_REQUEST['sortid'.$id];
            $ar['fname']   = $_REQUEST['fname'.$id];
        }
        if (!empty($ar['name']) && !empty($ar['fname']))
        {
            $this -> mModules -> Edit($ar);
        }
        uni_redirect( PATH_ROOT_ADM . 'security/modules/' );
    }/** Edit */


    public function Update()
    {
        $list = $this -> mModules -> GetList();
        for ($i = 0; $i < count($list); $i++)
        {
            $ar['id']      = $list[$i]['id'];
            $ar['name']    = $_REQUEST['name'.$ar['id']];
            $ar['sortid']  = $_REQUEST['sortid'.$ar['id']];
            $ar['fname']   = $_REQUEST['fname'.$ar['id']];
            $this -> mModules -> Edit($ar);
        }
        uni_redirect( PATH_ROOT_ADM . 'security/modules/' );
    }/** Update */


    public function Active()
    {
        if (!empty($_REQUEST['id']))
        {
            $this -> mModules -> ChgAct( $_REQUEST['id'] );
        }
        uni_redirect( PATH_ROOT_ADM . 'security/modules/' );
    }/** Active */


    public function Del()
    {
        if (!empty($_REQUEST['id']))
        {
            $this -> mModules -> Del($_REQUEST['id']);
        }
        uni_redirect( PATH_ROOT_ADM . 'security/modules/' );
    }/** Del*/


    public function PrepList()
    {
      
        $this -> mSmarty -> assign_by_ref('ml', $this -> mModules -> GetList());
    }/** PrepList */


}/** Model_Security_Modules */