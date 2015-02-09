<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 *
 * @version 1.2 by Elzor
 * @notic   fix for UTF-8
 */


/**
 * Smarty truncate modifier plugin
 *
 * Type:     modifier<br>
 * Name:     truncate<br>
 * Purpose:  Truncate a string to a certain length if necessary,
 *           optionally splitting in the middle of a word, and
 *           appending the $etc string or inserting $etc into the middle.
 * @link http://smarty.php.net/manual/en/language.modifier.truncate.php
 *          truncate (Smarty online manual)
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @param string
 * @param integer
 * @param string
 * @param boolean
 * @param boolean
 * @return string
 */
function smarty_modifier_truncate($string, $length = 80, $etc = '...',
                                  $break_words = false, $middle = false)
{

    if ($length == 0)
        return '';

    if (strlen_utf8($string) > $length) {
        $length -= strlen_utf8($etc);
        if (!$break_words && !$middle) {
            $string = preg_replace('/\s+?(\S+)?$/', '', substr_utf8($string, 0, $length+1));
        }
        if(!$middle) {
            return substr_utf8($string, 0, $length).$etc;
        } else {
            return substr_utf8($string, 0, $length/2) . $etc . substr_utf8($string, -$length/2);
        }
    } else {
        return $string;
    }
}

/* vim: set expandtab: */

?>
