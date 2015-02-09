<?php
/**
 * Smarty plugin
 * -------------------------------------------------------------
 * Type:     function
 * Name:     html_error
 */
function smarty_function_html_order($params, &$smarty)
{
    if (empty($params))
        return;
   
    extract($params);
   
    $smarty -> assign('val1'    , $val1);
    $smarty -> assign('val2'    , $val2);
    $smarty -> assign('name'    , $name);
    $smarty -> assign('base_url', $base_url);
    $smarty -> display('mods/Acc/Ordering.html');
}

?>