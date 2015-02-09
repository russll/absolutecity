<?php
/**
 * Indexe's Base controller
 *
 * @package    5dev Wall
 * @version    1.0
 * @since      29.03.2010
 * @copyright  2010 5dev Team
 * @link       http://5dev.com
 */
class Ctrl_Base_Index extends Ctrl_Base
{

    public function __construct( &$glObj, &$moUser )
    {
        parent :: __construct( $glObj );
    }

    public function Index( )
    {
        if (!empty($_POST['email']))
        {
            $email = _v('email', '');
            if (verify_email($email))
            {
                $sql   = 'SELECT id FROM '.TB.'email WHERE email = ?';
                $r     = $this -> mDb -> getOne($sql, array($email));
                if (!$r)
                {
                    $sql = 'INSERT INTO '.TB.'email (email, pdate) VALUES(?, ?)';
                    $this -> mDb -> query($sql, array($email, mktime()));
                }
            }
        }
    }/** Index */

}
?>