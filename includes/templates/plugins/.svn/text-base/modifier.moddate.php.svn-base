<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty date modifier plugin
 *
 * Type:     modifier<br>
 * Name:     moddate<br>
 * Purpose:  date from yyyy-mm-dd to dd Month yyyy
 * @author   ssergy
 * @param string
 * @return string
 */
function smarty_modifier_moddate($string, $no_day = 0)
{
    $yy  = substr($string, 0, 4);
    $mm  = substr($string, 5, 2);
    $dd  = substr($string, 8, 2);
    $ma = array(
            0 => '',
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'May',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Aug',
            9 => 'Sep',
            10 => 'Oct',
            11 => 'Nov',
            12 => 'Dec');

    $maf = array(
            0 => '',
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December');

    if ($no_day)
    {
        return $maf[1*$mm].('0000' != $yy ? ' '.$yy : '');
    }
    else
    {
        return $ma[1*$mm].' '.$dd.('0000' != $yy ? ', '.$yy : '');
    }
}

?>
