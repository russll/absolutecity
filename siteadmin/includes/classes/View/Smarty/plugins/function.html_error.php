<?php
/**
 * Smarty plugin
 * -------------------------------------------------------------
 * Type:     function
 * Name:     html_error
 */
function smarty_function_html_error($params, &$smarty)
{
    if (empty($params))
        return;
   
    while(list($key, $val) = each($params))
    {
        $matches = array();
        if (preg_match('/^must(\d+)$/i', $key, $matches))
        {
            if (!isset($must))
               $must = array(); 

            $must[$matches[1]] = $val;
        }
        else
            $$key = $val;
    }

    extract($params);
   
    if (is_array($must))
    {
        $cnt = count($must);
        $flag = false;
        for ($i = 0; $i < $cnt; $i++)
        {
            if (in_array($must[$i], $code)) 
            {
                $must = $must[$i];
                $flag = true;
                break;
            }
        }
        if (!$flag)
            return;
    }
    elseif (!in_array($must, $code))
    {
       return;
    }

    if (min($code) == $must)
       $elem = '<script type="text/javascript">elem = \''.$tag.'\';</script>';
     else
       $elem = '';

    if (empty($type))
        $output = '<a href="#" title="'.$errors[$must].'"><img src="'.PATH_ROOT_ADMIN.'includes/templates/images/alert.gif" width="16" height="16" border="0" alt="'.$errors[$must].'" /></a>'.$elem;
    elseif (1 == $type)
        $output = '<font style="font-size:8px" color="red">'.$errors[$must].'</font>'.$elem;
    echo $output;
}

?>
