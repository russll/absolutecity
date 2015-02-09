<?php
/**
 * Smarty plugin
 * -------------------------------------------------------------
 * Type:     function
 * Name:     html_tmpl_time
 * Version   1.1 (bugfix by Elzor)
 */
function smarty_function_html_tmpl_time($params, &$smarty)
{
    if (empty($params['val']))
        return;
   	
    if (empty($params['type']))
        $params['type'] = 1;
        
    $params['val'] = (is_numeric($params['val'])) ? $params['val'] : strtotime($params['val']);

    $smarty -> assign('type'   , $params['type']);
    $smarty -> assign('mins'   , abs(floor((NOW_TIME - $params['val'])/60)));
    $smarty -> assign('hours'  , abs(floor((NOW_TIME - $params['val'])/3600)));
    $smarty -> assign('days'   , abs(floor((NOW_TIME - $params['val'])/86400)));
    $smarty -> assign('dt'     , $params['val']);
	
    $output = $smarty -> fetch('mods/adtmpl/_tmpl_time.html');
    
    echo $output;
}
?>
