<?php
class Ctrl_Security_Dispath
{  
    public $mType;
    public $mModule;
    public $mWhat;

    public function __construct()
    {
        $this -> Dispath( $_SERVER['REQUEST_URI'] );
    }

    /**
     * make path from some url, ex: /security/users/showlist/
     *
     * @param string $std
     * @return bool true
     */
    public function Dispath( $std )
    {
        
        $s = '';
        if (!empty($std))
        {
            $std = substr($std, 1, strlen($std));

            $std = str_replace('&', '?', $std);
            if (0 < strpos('_'.$std, '?'))
            {
                $std = substr($std, 0, strpos($std, '?'));
            }

            if (1 ==  strpos('_'.$std, 'siteadmin/'))
            {
                $std = str_replace('siteadmin/', '', $std);
            }
            $ul  = explode('/', $std);
     
            $k   = 0;
            for ($i = 0; $i < count($ul); $i++)
            {
                if (!empty($ul[$i]) && preg_match('/^[0-9a-z_]+$/i', $ul[$i]))
                {
                    switch ($k)
                    {
                        case 0:
                            $ul[$i][0] = strtoupper($ul[$i][0]);
                            $this -> mType   = $ul[$i];
                            break;

                        case 1:
                            $ul[$i][0] = strtoupper($ul[$i][0]);
                            $this -> mModule = $ul[$i];
                            break;

                        case 2:
                            $ul[$i][0] = strtoupper($ul[$i][0]);
                            $this -> mWhat   = $ul[$i];
                            break;
                    }
                }
                if (2 < $k)
                {
                    break;
                }
                $k++;
            }
        }

        if (!empty($_REQUEST['type']) && preg_match('/^[0-9a-z]+$/i', $_REQUEST['type']))
        {
            $_REQUEST['type'][0] = strtoupper($_REQUEST['type'][0]);
            $this -> mType = $_REQUEST['type'];

            if (!empty($_REQUEST['mod']) && preg_match('/^[0-9a-z]+$/i', $_REQUEST['mod']))
            {
                $_REQUEST['mod'][0] = strtoupper($_REQUEST['mod'][0]);
                $this -> mModule = $_REQUEST['mod'];
                if (!empty($_REQUEST['what']) && preg_match('/^[0-9a-z]+$/i', $_REQUEST['what']))
                {
                    $_REQUEST['what'][0] = strtoupper($_REQUEST['what'][0]);
                    $this -> mWhat = $_REQUEST['what'];
                }
            }
        }

        $this -> mWhat = str_replace('_', '', $this -> mWhat);

        return $s;
    }/** Dispath */


    public function Start( &$glObj )
    {
    
        /**
         * Show module
         */
        $start = 0;
        if ( $this -> mType && $this -> mModule )
        {
            $glObj['Smarty'] -> assign('module', $this -> mModule);

            if (file_exists( BPATH . CLASS_PATH . 'Ctrl/' . $this -> mType . '/' . $this -> mModule . '.class.php' ))
            {
                /** init module - if exits */
                include_once 'Ctrl/' . $this -> mType . '/' . $this -> mModule . '.class.php';

                $v = 'Ctrl_'.$this -> mType.'_'. $this -> mModule;
                
                if ($v == 'Ctrl_Security_Users')
                {
                    $moCur =& $glObj['moUser'];
                }
                else
                {
                    $moCur = new $v( $glObj, $glObj['moUser'] );
                }


                if ( !$this -> mWhat ||  !method_exists( $moCur, $this -> mWhat ) )
                {
                    

                    if ($glObj['moUser'] -> mIsAdmin)
                    {
                        $what = 'Indexadmin';
                    }
                    else
                    {
                        $what = 'Index';
                    }
                    if ( !method_exists( $moCur, $what ) )
                    {
                        $what = '';
                    }
                }
                else
                {
                    $what = $this -> mWhat;
                }
                if ($what)
                {
                    $moCur -> $what();
                }
                return true;
            }
        }

        if (!$start)
        {
            include_once 'Ctrl/Base/Index.class.php';
            $moCur = new Ctrl_Base_Index( $glObj, $glObj['moUser'] );

            if ($glObj['moUser'] -> mIsAdmin)
            {
                $what = 'Indexadmin';
            }
            else
            {
                $what = 'Index';
            }

            if ( !method_exists( $moCur, $what ) )
            {
                $what = '';
            }
            if ($what)
            {
                $moCur -> $what( );
            }
        }
        return false;
    }/** Start */

}/** Ctrl_Security_Dispath */