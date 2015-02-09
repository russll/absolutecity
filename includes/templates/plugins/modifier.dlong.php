<?php
/**
 * 5dev
 * Smarty plugin
 * -------------------------------------------------------------
 * Type:     function
 * Name:     dlong
 */
function smarty_modifier_dlong($string, $length = 45, $wrapString = "<br />")
{
    $wrapped = '';
    $word = '';
    $html = false;
    $string = (string) $string;
    $stringLength = mb_strlen($string);
    for($i=0;$i<$stringLength;$i++)
    {

        $char = mb_substr($string, $i, 1,'utf-8' );


        /** HTML Begins */
        if($char === '<' )
        {
            if(!empty($word))
            {
                $wrapped .= $word;
                $word = '';
            }

            $html = true;
            $wrapped .= $char;
        }

        /** HTML ends */
        elseif($char === '>' )
        {
            $html = false;
            $wrapped .= $char;
        }

        /** If this is inside HTML -> append to the wrapped string */
        elseif($html)
        {
            $wrapped .= $char;
        }

        /** Whitespace characted / new line */
        elseif($char === ' ' || $char === "\t" || $char === "\n" )
        {
            $wrapped .= $word.$char;
            $word = '';
        }

        /** Check chars */
        else
        {
            $word .= $char;
            $wordLength = mb_strlen($word);
            if($wordLength > $length && $char == ";" &&  mb_substr ($string, $i+1, 1)== "&" )
            {

                $wrapped .= $word.$wrapString;
                $word = '';
            }
            else if ($wordLength > $length && !preg_match("/&.{1,7};/iu", $word))
            {

                $wrapped .= $word.$wrapString;
                $word = '';
            }
            else if ($wordLength > $length && !preg_match("/&.{1,7};&/iu", $word))
            {

                $wrapped .= $word.$wrapString;
                $word = '';
            }

        }
    }
    if($word !== '')
    {
        $wrapped .= $word;
    }

    return $wrapped;
}
?>