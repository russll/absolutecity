<?php
/**
 * Admin modules 
 *
 * @package    5Dev catalog 4.1
 * @version    1.0
 * @since      24.10.2006
 * @copyright  2006-2008 5Dev Team
 * @link       http://5Dev.com
 */

class Model_Security_Modules
{
    private $mTbModules;    
    private $mDb;     

    public function __construct( &$gDb )
    {
        $this -> mTbModules =  TB . 'modules';
        $this -> mDb        =&  $gDb; 
    }/** End constructor */

    
    public function Edit($ar = array())
    {
        if (!isset($ar['id']) || !is_numeric($ar['id']))
        {
            $sql = 'INSERT INTO '.$this -> mTbModules.' (name, fname) values (?, ?)';
            $this -> mDb -> query($sql, array($ar['name'], $ar['fname']));
        }
        else 
        {
            $sql = 'UPDATE '.$this -> mTbModules.' SET name = ?, fname = ?, sortid = ? WHERE id = ?';
            $this -> mDb -> query($sql, array($ar['name'], $ar['fname'], $ar['sortid'], $ar['id']));
        }
        return true;
    }/** Edit */
        
    public function ChgAct($id = 0)
    {
        $sql = 'SELECT ACTIVE FROM '.$this -> mTbModules.' WHERE id = ?';
        $ac  = $this -> mDb -> getOne($sql, $id);
        $sql = 'UPDATE '.$this -> mTbModules.' SET active = '.(!$ac ? 1 : 0).' WHERE id = ?';
        $this -> mDb -> query($sql, array($id));
        return true;
    }/** ChgAct */
    
    
    public function Del($id = 0)
    {
        $sql = 'DELETE FROM '.$this -> mTbModules.' WHERE id = ?';    
        $this -> mDb -> query($sql, array($id));
        return true;  
    }/** Del */
    
    
    public function GetOne($id = 0)
    {
        $res = array();
        if (0 == $id)
        {                
            return $res;    
        }
        $sql = 'SELECT * FROM '.$this -> mTbModules.' WHERE id = '.(int)$id;
        $db  = $this -> mDb -> query($sql);
        if ($row = $db -> FetchRow())
        {
            return $row;
        }
        else 
        {
            return $res;
        }
    }/** GetOne */
    
    
    public function GetList($smin = 0, $smax = 0, $active = -1)
    {
        $sql = 'SELECT * FROM '.$this -> mTbModules.' WHERE id = id';
        if (0 < $smax)
        {     
            $sql .= ' AND sortid >='.$smin.' AND sortid < '.$smax;     
        }
        if (0 <= $active)
        {
            $sql .= ' AND active = '.(int)$active;
        }
        $sql .= ' ORDER BY sortid';

        $db  = $this -> mDb -> query($sql);
        $res = array();
        while ($row = $db -> FetchRow())
        {
            $res[] = $row;
        }
        return $res;
    }/** GetList */
    
    
    public function GetCheckList($smin = 0, $smax = 0, $active = -1, $ustatus = 0, $mlist = '')
    {
        $sql = 'SELECT * FROM '.$this -> mTbModules.' WHERE id = id';
        if (0 < $smax)
        {     
            $sql .= ' AND sortid >='.$smin.' AND sortid < '.$smax;     
        }
        if (0 <= $active)
        {
            $sql .= ' AND active = '.(int)$active;
        }
        $sql .= ' ORDER BY sortid';

        $db  = $this -> mDb -> query($sql);
        $res = array();
        while ($row = $db -> FetchRow())
        {
            if (0 == $ustatus || 0 < strpos('_'.$mlist, $row['fname'].'.php'))
            {
                $res[] = $row;
            }    
        }
        return $res;
    }/** GetCheckList */   
    
}    
?>