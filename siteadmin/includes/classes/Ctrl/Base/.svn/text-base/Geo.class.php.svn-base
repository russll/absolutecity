<?php
/**
 * 
 * User: ssergy
 * Date: 16.02.2011
 * Time: 22:05:34
 * 
 */
 
class Ctrl_Base_Geo  extends Ctrl_Base
{
    public function __construct(&$glObj)
    {
        parent :: __construct($glObj);

        if (!defined('UID'))
            uni_redirect(PATH_ROOT . '');

        include_once 'Model/Geografy/Main.class.php';
        $this -> mGeo = new Model_Geografy_Main( $glObj );
    }


    public function Indexadmin()
    {
        if (!defined('IT_ADMIN'))
        {
            exit();
        }

        if (isset($_REQUEST['iso2']))
        {
            $_SESSION['geof_iso2']= $_REQUEST['iso2'];
        }

        $iso2 = !empty($_SESSION['geof_iso2']) ? $_SESSION['geof_iso2'] : '';
        $this -> mSmarty -> assign('iso2', $iso2);
        $str = _v('str', '');

        $page = _v('page', 1);
        $pcnt = 25;
        $str = strip_tags(_v('str', ''));
        $this->mSmarty->assign('str', $str);

        $rcnt = $this -> mGeo -> GetCitiesCount($iso2, $str);

        include_once 'View/Acc/Pagging.php';
        $mpage = new Pagging($pcnt, $rcnt, $page, PATH_ROOT_ADM . 'base/geo/indexadmin' . ($str ? '?str=' . $str : ''));
        $range = $mpage->GetRange();
        $this->mSmarty->assign_by_ref('pl', $this->mGeo->GetCitiesList($iso2, $range[0], $pcnt, $str));

        $this -> mSmarty -> assign_by_ref('countries', $this->mGeo -> GetCountries(1));
        $this->mSmarty->assign('pagging', $mpage->Make($this->mSmarty));
        $this->mSmarty->assign('_content', $this->mSmarty->Fetch('mods/geo/list.html'));
    }


    public function Del()
    {
        $id = _v('id', 0);
        if ($id)
        {
            $this -> mGeo -> DelCity( $id);
        }
        uni_redirect( PATH_ROOT_ADM . 'base/geo/indexadmin' );
    }


    public function Edit()
    {
        $id = _v('id', 0);

        if ($id)
        {
            $pi = $this -> mGeo -> GetCity($id);
            if (empty($pi))
            {
                $id = 0;
            }
        }
        $this -> mSmarty -> assign('id', $id);

        if (!empty($_POST['fm']))
        {
            $fm  = $_POST['fm'];
            $errs = array();

            if (empty($fm['name']))
            {
                $errs[] = 'Please specify city name';
            }

            if (empty($errs))
            {
                $this -> mGeo -> EditCity($id,
                    strip_tags($fm['name']),
                    strip_tags($fm['iso2_cntr']),
                    !empty($fm['subdivision']) ? strip_tags($fm['subdivision']) : ''               
                );
                uni_redirect( PATH_ROOT_ADM . 'base/geo/indexadmin' );
            }
            $this -> mSmarty -> assign_by_ref('errs', $errs);
            $this -> mSmarty -> assign_by_ref('fm', $fm);
        }
        elseif ($id)
        {
            $this -> mSmarty -> assign_by_ref('fm', $pi);
        }

        $this -> mSmarty -> assign_by_ref('countries', $this->mGeo -> GetCountries(1));
        $this->mSmarty->assign('_content', $this->mSmarty->Fetch('mods/geo/edit.html'));
    }
    
}
?>