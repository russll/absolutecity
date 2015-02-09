<?php
class Ctrl_Init extends Ctrl_Base
{
     
    public function __construct( $glObj, $what = 0 )
    {
        parent :: __construct( $glObj );
        switch ($what)
        {
            case 'index':
                $this -> InitIndex( $glObj );
                break;
        }
    }/** constructor */

    
    public function InitIndex( &$glObj )
    {
        $this -> mSmarty -> assign('siteAdr', PATH_ROOT);

        /** Init Controls */
        include_once 'Ctrl/Security/Dispath.class.php';
        $moDispath = new Ctrl_Security_Dispath();
 
        /** Start Current Controller */
        $moDispath -> Start( $glObj );
        
        /** Show current */
        $this -> mSmarty -> display('index.html');
        
    }/** InitIndex */
      

}
?>