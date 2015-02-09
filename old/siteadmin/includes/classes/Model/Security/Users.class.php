<?php
/**
 * Users Class
 * @package   5dev catalog 4
 * @version   0.1a
 * @since     29.04.2006
 * @copyright 2004-2008 5dev Team
 * @link      http://5dev.com
 */

class Model_Security_Users
{
    /**
     * Users table
     * @var string
     */
    private $mTbUsers;

    
    /**
     * DB pointer
     * @var object
     */
    private $mDb;

    /**
     * Crypt object pointer
     * @var object
     */
    private $mRc4;

    public function __construct( &$gDb, $gRc4 )
    {
        $this -> mTbUsers   = TB . 'users';
        $this -> mDb        =& $gDb;
        $this -> mRc4       =& $gRc4;
    }


    /**
     * Change user status
     *
     * @param int   $uid user id
     * @param array $status new status value
     *
     * @return void
     */
    public function ChangeStatus($uid, $status)
    {
        $sql =   'UPDATE '.$this -> mTbUsers.'
                  SET status=? 
                  WHERE uid=?';
        $this -> mDb -> query($sql, array($status, $uid));
    }#ChangeStatus


    public function ChangePassword($uid, $oldPass, $newPass)
    {
        $this -> mRc4 -> crypt($oldPass);
        $oldPass = bin2hex($oldPass);

        $sql = 'SELECT count(*) FROM '.$this -> mTbUsers.' WHERE uid='.$uid.' AND pass="'.$oldPass.'"';

        if( $this -> mDb -> GetOne($sql) )
        {
            $this -> mRc4 -> crypt($newPass);
            $newPass = bin2hex($newPass);
            $this -> UpdValues( $uid, array('pass' => $newPass) );

            return true;
        }
        return false;
    }#ChangeStatus


    public function ChangeActive( $uid )
    {
        $sql = 'UPDATE '.$this -> mTbUsers.' SET active = NOT active WHERE uid = ?';
        $this -> mDb -> query($sql, array($uid));
        return true;
    }/** ChangeActive */


    public function Delete($uid)
    {
        $sql = 'DELETE FROM '.$this -> mTbUsers.' WHERE uid=?';
        $this -> mDb -> query($sql, array($uid));
        return true;
    }


    public function Get($uid)
    {
        $sql = 'SELECT *
                 FROM '.$this -> mTbUsers.' 
                 WHERE uid = ?';
        $r  = $this -> mDb -> getRow($sql, array($uid));
        if (!empty($r))
        {
            if (!empty($r['modules']))
            {
                $mm = explode(';', substr($r['modules'], 1, strlen($r['modules'])-2));
                $r['modules'] = array();
                for ($i = 0; $i < count($mm); $i++)
                {
                    $r['modules'][$mm[$i]] = 1;
                }
            }
        }
        return $r;
    }#Get


    public function GetByLogin($login)
    {
        $sql = 'SELECT uid
                 FROM '.$this -> mTbUsers.' 
                 WHERE public_name = ?';
        $r  = $this -> mDb -> getOne($sql, $login);
        return $r;
    }#GetByLogin


    /**
     * Get user ID by email
     *
     * @param string $email
     * @return int User ID
     */
    function GetByEmail($email)
    {
        $sql = 'SELECT uid
                 FROM '.$this -> mTbUsers.' 
                 WHERE email = ?';
        $db  = $this -> mDb -> query($sql, array($email));
        $r   = 0;
        if ($row = $db -> FetchRow())
        {
            $r = $row['uid'];
        }
        return $r;
    }#GetByEmail


    public function CheckLoginName($login = '')
    {
        $sql = 'SELECT 1
                FROM '.$this -> mTbUsers.' 
                WHERE public_name = ?';

        $r  = $this -> mDb -> getOne($sql, $login);

        if ($r || empty($login))
        {
            return true;
        }
        else
            return false;
    }/** CheckLoginName */


    /**
     * Check login Unique
     *
     * @param string $login - user login
     *
     * @return bool - true - unique, false - not unique
     */
    public function CheckLoginUniq( $login, $uid = 0 )
    {
        $login = trim($login);
        $sql = 'SELECT 1 FROM '.$this -> mTbUsers.' WHERE public_name = ?';
        if ($uid && is_numeric($uid))
        {
            $sql .= ' AND uid <> '.(int)$uid;
        }

        $r   = $this -> mDb -> getOne($sql, array($login));

        if (!$r)
        {
            return true;
        }
        else
        {
            return false;
        }
    }/** CheckLoginUniq */


    public function Add($ar)
    {

        $this -> mRc4 -> crypt($ar['pass']);
        $bx = array($ar['login'],
                bin2hex( $ar['pass'] ),
                strip_tags($ar['first_name']),
                strip_tags($ar['last_name']),
                $ar['email'],
                $ar['status'],
                $ar['modules']
        );

        $sql = 'INSERT INTO '.$this -> mTbUsers.' (public_name, pass, first_name, last_name, email, status, modules, created_date)
                    VALUES (?, ?, ?, ?, ?, ?, ?, NOW())';

        $this -> mDb -> query( $sql, $bx );
     
        $id  = $this -> mDb -> getOne("SELECT LAST_INSERT_ID()");
        return $id;

    }/** Add */


    public function UpdValues( $uid, $vars )
    {
        $sql = 'UPDATE '.$this -> mTbUsers.' SET uid = uid';
        foreach ( $vars as $k => &$v)
        {
            $sql .= ', ' . $k  . ' = "'.mysql_escape_string($v).'"';
        }
        $sql .= ' WHERE uid = '.(int)$uid;
        $this -> mDb -> query( $sql );

        return true;
    }/** UpdValues */


    public function UpdOptions( $uid, $vars )
    {
        $sql = 'UPDATE '.$this -> mTbUsersOptions.' SET uid = uid';

        foreach ( $vars as $k => &$v)
        {
            $sql .= ', ' . $k . ' = "'.mysql_escape_string($v).'"';
        }
        $sql .= ' WHERE uid = '.(int)$uid;
        $this -> mDb -> query( $sql );

        return true;
    }/** UpdValues */


    public function Change($uid, &$ar)
    {
        $sql = 'SELECT 1
                FROM '.$this -> mTbUsers.' 
                WHERE uid <> ? AND public_name = ?';
        $r  = $this -> mDb -> getOne($sql, array($uid, $ar['login']));

        if ( $r )
        {
            $this -> LastError = 1; // = error #1: user already exists;
            return false;
        }
        else
        {
            $this -> mRc4 -> crypt($ar['pass']);
            $sql = 'UPDATE ' . $this -> mTbUsers . ' SET public_name = ?'.
                    ((0 < strlen($ar['pass'])) ? ', pass=\''.bin2hex($ar['pass']).'\'' : '').
                    ', email   = ?, name    = ?, scname = "", sclist = "", status  = ?, modules = ?
                      WHERE uid = ?';

            $this -> mDb -> query($sql, array( $ar['login'], $ar['email'], strip_tags($ar['name']), $ar['status'], $ar['modules'], $uid ) );
            return true;
        }
    }/** Change */


    public function Del( $uid )
    {
        $sql = 'DELETE FROM '.$this -> mTbUsers.' WHERE uid = ?';
        $this -> mDb -> query( $sql, $uid );
        return true;
    }/** Del */


    public function DelPhoto( $uid )
    {
        $sql = 'SELECT image FROM '.$this -> mTbUsers.' WHERE uid = ?';
        $r   = $this -> mDb -> getOne($sql, array($uid));
        if ($r)
        {
            if (file_exists( BPATH . 'files/images/users/'.$r ))
            {
                unlink( BPATH . 'files/images/users/'.$r  );
            }
            if (file_exists( BPATH . 'files/images/users/resize/'.$r ))
            {
                unlink( BPATH . 'files/images/users/resize/'.$r  );
            }
            if (file_exists( BPATH . 'files/images/users/resize/m_'.$r ))
            {
                unlink( BPATH . 'files/images/users/resize/m_'.$r  );
            }
            $this -> mDb -> query( 'UPDATE '.$this -> mTbUsers.' SET image = "" WHERE uid = ?', $uid);
        }
        return true;
    }/** DelPhoto */


    public function Count( $status = -1, $active = -1, $country = '', $wish = '', $login = '' )
    {
        $sql = 'SELECT COUNT(*) AS cnt FROM '.$this -> mTbUsers.' WHERE uid = uid' .
                (-1 != $status ? ' AND status = '.(int)$status : '');
        
        $ap = array();
        if (-1 != $active)
        {
            $sql .= ' AND active = ?';
            $ap[] = $active;
        }        
        if ($country)
        {
            $ap[] = strip_tags($country);
            $sql .= ' AND LOWER(country) = ?';
        }
        if ($wish)
        {
            $wish = str_replace('"', '', $wish);
            $sql .= ' AND LOWER(wantlist) LIKE "%'.mysql_escape_string($wish).'%"';
        }        
        if ($login)
        {
            $login = str_replace('"', '', $login);
            $sql .= ' AND LOWER(public_name) LIKE "%'.mysql_escape_string($login).'%"';
        }
        
        $r  = $this -> mDb -> getOne($sql, $ap);
        return $r;
    }/** Count */


    public function GetList( $status = -1, $sort = '', $first = 0,  $cnt = 0, $active = -1, $country = '', $wish = '', $login = '' )
    {
        $sql = 'SELECT * FROM '.$this -> mTbUsers.' WHERE uid = uid '.
                (-1 != $status ? ' AND status = '.(int)$status : '');
        
        $ap = array();  
    
        if (-1 != $active)
        {
            $sql .= ' AND active = ?';
            $ap[] = $active;
        }     
      
        if ($country)
        {
            $ap[] = strip_tags($country);
            $sql .= ' AND LOWER(country) = ?';
        }
        if ($wish)
        {
            $wish = str_replace('"', '', $wish);
            $sql .= ' AND LOWER(wantlist) LIKE "%'.mysql_escape_string($wish).'%"';
        }
        if ($login)
        {
            $login = str_replace('"', '', $login);
            $sql .= ' AND LOWER(public_name) LIKE "%'.mysql_escape_string($login).'%"';
        }
        
        $sql .= ($sort ? ' ORDER BY '.$sort : '');
         
        if ($cnt)
        {
            $db = $this -> mDb -> limitQuery( $sql, $first, $cnt, $ap );
        }
        else
        {
            $db = $this -> mDb -> query( $sql );
        }
        $r = array();
        while ($row = $db -> FetchRow())
        {
            $r[] = $row;
        }
        return $r;
    }/** GetList */

    public function GetListByFilt( $what = array(), $fpar = array(), $fval = array(), $status = 2, $active = 1, $sort = -1, $first = 0, $cnt = 0 ) {
    	$sql = 'SELECT '.join(', ', $what).' FROM '.$this -> mTbUsers.' 
    			 WHERE ( '.gen_plh($fpar, 4).' ) ';
    	if (-1 != $status)
    		$sql .= ' AND status = '.$status;
    	if (-1 != $active)
            $sql .= ' AND active = '.$active;
        if (-1 != $sort)
        	$sql .= ' ORDER BY '.$sort;
        else
        	$sql .= ' ORDER BY uid';
        
    	if ($cnt)
        	$db = $this -> mDb -> limitQuery( $sql, $first, $cnt, $fval );
        else
        	$db = $this -> mDb -> query( $sql, $fval );
        $r = array();
        while ($row = $db -> FetchRow())
        {
            $r[] = $row;
        }
        return $r;
    }/* GetListByFilt */
    
    /**
     * Check email unique
     * @param string email
     * @return bool true (mail exist) or false
     */
    public function CheckEmail($email = '', $uid = 0)
    {
        $sql = 'SELECT 1 FROM '.$this -> mTbUsers.' WHERE email = ? AND is_deleted = 0';
        if ($uid)
        {
            $sql .= ' AND uid <> '.(int)$uid;
        }

        $r  = $this -> mDb -> getOne($sql, array($email));

        if ($r)
        {
            return true;
        }
        else
        {
            return false;
        }
    }#CheckEmail


    /**
     * Check current administrator session or make session
     *
     * $module string access admin module
     * $mainpart - if  == 1  - it's main part of the Site (show all modules)
     *
     * @return int 0 on success session. 1 if specified login and password is correct. 2 on bad session. 3 on bad login or password
     */
    public function CheckLogin($module, $mainpart = 0)
    {
        if (preg_match(':/([^/]+\.[^/]+)$:', $module, $matches))
        {
            $module = $matches[1];
        }

        if (strlen(session_id()) <= 0
                || empty($_SESSION['system_uid'])
                || empty($_SESSION['system_login'])
                || empty($_SESSION['system_session'])
                || !isset($_SESSION['system_status'])
                || (0 < $_SESSION['system_status'] && empty($_SESSION['system_modules']) && 0 == $mainpart)
        )
        {
            $_SESSION['system_uid']     = 0;
            $_SESSION['system_login']   = '';
            $_SESSION['system_session'] = '';
            $_SESSION['system_status']  = 0;
            $_SESSION['system_modules'] = '';

            if (!empty($_POST['system_login']) && !empty($_POST['system_pass']))
            {

                $sql = 'SELECT uid, pass, status, modules
                        FROM '.$this -> mTbUsers.'
                        WHERE email = ?
                        AND status <= 2 AND rchecksum = ""';
                $row = $this -> mDb -> getRow($sql, array( $_POST['system_login'] ));

                if (empty($row))
                {
                    return 3;
                }

                $this -> mRc4 -> crypt($_POST['system_pass']);
                if (bin2hex($_POST['system_pass']) == $row['pass']
                        && (0 == $row['status'] || preg_match('/;'.$module.';/', $row['modules']) || $mainpart == 1)
                )
                {
                    $_SESSION['system_uid']     = $row['uid'];
                    $_SESSION['system_login']   = $_POST['system_login'];
                    $_SESSION['system_session'] = md5('pLmz2a4'.$_POST['system_login'].'pN5'.$row['status'].'1gh'.'O7dNm4s'.$row['pass'].'KxJxnz');
                    $_SESSION['system_status']  = $row['status'];
                    $_SESSION['system_modules'] = $row['modules'];
                    return 1;
                }
                else
                    return 3;
            }
            else
                return 2;
        }
        else
        {

            $sql = 'SELECT pass, status, modules
                    FROM '.$this -> mTbUsers.'
                    WHERE email = ?
                    AND status <= 2 AND rchecksum = ""';
            $row = $this -> mDb -> getRow($sql, array($_SESSION['system_login']));

            if (empty($row))
            {
                return 2;
            }

            // Generate check value
            $compValue = md5('pLmz2a4'.$_SESSION['system_login'].'pN5'.$row['status'].'1gh'.'O7dNm4s'.$row['pass'].'KxJxnz');

            if ($_SESSION['system_session'] == $compValue
                    && (0 == $row['status']
                            || preg_match('/;'.$module.';/', $row['modules']) || $mainpart == 1)
            )
                return 0;
            else
                return 2;
        }
    }#CheckLogin


    public function Logout()
    {
        if (!empty($_SESSION['system_uid']))
        {
            unset($_SESSION['system_uid']);
            unset($_SESSION['system_login']);
            unset($_SESSION['system_session']);
            unset($_SESSION['system_status']);
            unset($_SESSION['system_modules']);
        }
        return true;
    }/** Logout */


    /**
     * Restore user password
     * @param string $email user email
     * @return string new password
     */
    public function RestorePassword($email)
    {
        $code    = md5( mktime() );

        $sql     = 'UPDATE '.$this -> mTbUsers.' SET
                    checksum = ?, checksum_date = ?
                    WHERE email = ?';
        $this -> mDb -> query($sql, array($code, mktime(), $email));
        return $code;
    }#RestorePassword


    public function GetRestoreCode( $code )
    {
        $sql = 'SELECT * FROM '.$this -> mTbUsers.' WHERE checksum = ? AND checksum_date > ?';
        $r   = $this -> mDb -> getRow($sql, array($code, mktime()-24*3600));
        return $r;
    }/** GetRestoreCode */

    
    public function UpdatePassword($uid, $pass)
    {
        $this -> mRc4 -> crypt($pass);
        $sql = 'UPDATE '.$this -> mTbUsers.' SET pass = ? WHERE uid = ?';
        $this -> mDb -> query($sql, array(bin2hex( $pass ), $uid));
        return true;
    }/** UpdatePassword */


    public function GetRegistrationCode( $uid  )
    {
        $sql = 'SELECT rchecksum FROM '.$this -> mTbUsers.' WHERE uid = ?';
        $r   = $this -> mDb -> getOne($sql, array($uid));
        if ($r)
        {
            return $r;
        }
        else
        {
            $r = md5(mktime());
            $this -> mDb -> query('UPDATE '.$this -> mTbUsers.' SET rchecksum = ? WHERE uid = ?', array($r, $uid));
            return $r;
        }
    }/** GetRegistrationCode */


    public function ApproveByCode($code)
    {
        $sql = 'SELECT uid, email, pass FROM '.$this -> mTbUsers.' WHERE  rchecksum = ?';
        $r   = $this -> mDb -> getRow($sql, array($code));
        if ($r)
        {
            $this -> mDb -> query('UPDATE '.$this -> mTbUsers.' SET rchecksum = "" WHERE uid = ?', array($r['uid']));
            $r['pass'] = hex2bin($r['pass']);
            $this -> mRc4 -> decrypt($r['pass']);
            return $r;
        }
        else
        {
            return false;
        }
    }/** ApprovebyCode */


    public function &SearchUser($query, $uid)
    {
        $query = '%'.$query.'%';
        $res = $this -> mDb -> getAssoc('SELECT u.uid, TRIM(CONCAT(u.name, \' \', u.lname)) AS full_name
                                         FROM '.$this -> mTbUsers .' u
                                         WHERE u.status <= 2
                                               '. (0 < $uid ? 'AND uid <> '.$uid : '').'
                                               AND (TRIM(CONCAT(u.name,\' \',u.lname)) LIKE ?
                                                    OR u.login LIKE ?)
                                         ORDER BY u.name ASC, u.lname ASC
                                         LIMIT 0,10', false, array($query,$query));

        return $res;
    }/** SearchUser */
    
    //-- Additional Methods
    
    public function EditInfo( $uid, $ar_k = array(), $ar_v = array() ) { 
    	$us_ex = $this -> mDb -> getOne('SELECT uid FROM '.$this -> mTbUsers.' WHERE uid = ?', array( $uid ));
		if ($us_ex)
		{
			$sql = 'UPDATE '.$this -> mTbUsers.' SET '.gen_plh( $ar_k, 1 ).'  
					WHERE uid = ?';
			
			$ar_v = array_merge( $ar_v, array( $uid ) );
			$this -> mDb -> query( $sql, $ar_v );
		}
	}/* EditInfo */
}

/**
 * Define a Users exception class
 */
class UsersException extends Exception
{
    public function __construct($code)
    {
        if (is_array($code))
        {
            $text = serialize($code);
            $code = -1;
        }
        else
            $text = null;

        parent::__construct($text, $code);

    }#end constructor
}
?>