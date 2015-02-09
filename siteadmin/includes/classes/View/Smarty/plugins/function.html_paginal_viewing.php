<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * Type:     function
 * Name:     html_paginal_viewing
 */
function smarty_function_html_paginal_viewing($params, &$smarty)
{
    if (empty($params))
        return;

    extract($params);
    $m_arr['baseUrl'] = $base_url;
    $smarty -> assign('gpArr'  , $m_arr);
    $smarty -> display('mods/Acc/SimplePagging.html');
}
?>
