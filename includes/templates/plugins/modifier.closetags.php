<?php
/**
 * 5dev
 * Smarty plugin
 * -------------------------------------------------------------
 * Type:     function
 * Name:     closetags
 */
function smarty_modifier_closetags($text)
{
    $ignore_tags = array('p', 'img', 'br', 'hr');
    // найдем все тэги (и откывающиеся и закрывающиеся)
    if (preg_match_all("/<(\/?)(\w+)/", $text, $matches, PREG_SET_ORDER))
    {
        $opened_tags_stack = array();
        // Цикл по всем найденным
        foreach ($matches as $k => $tag)
        {
            $tag_name = strtolower($tag[2]);
            if ($tag[1])
            {   // Если тэг закрывается
                // То удаляем из стека
                if (end($opened_tags_stack) == $tag_name)
                    array_pop($opened_tags_stack);
            } else
            {
                // Если тэг открывается и он не одиночный, то кладем в стек
                if (!in_array($tag_name, $ignore_tags))
                    array_push($opened_tags_stack, $tag_name);
            }
        };
        while ($tag = array_pop($opened_tags_stack))
        {
            $text .= "</$tag>";
        }
    }
    return $text;
}
?>