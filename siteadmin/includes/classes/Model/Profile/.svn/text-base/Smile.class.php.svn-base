<?php
/* 
 * 
 * 
 */
class Model_Profile_Smile
{
    //params
    public $smile_name;//list of smile names
    public $smile_name_code;//smile array of name=>code
    public $smile_code_name;//smile array of code=>name
    public $smile_res;//array of smile resources name=>resource
    public $badge_pic;//array of badge pictures name

     /**
     * Constructor
     *
     * @param $glObj
     */
    public function __construct()
    {
      $this->_initSmiles($this->smile_name, $this->smile_name_code, $this->smile_res);
      $this->_initBadgeList($this->badge_pic);
    }
    /* __construct */

    public function _initSmiles(&$smile_name = array(), &$smile_name_code = array(), &$smile_res = array())
    {
            $smile_name = array("smile","sad","wink","bond","open_smile","wow","cry","confused","jokingly","spiteful","diablo","music","kissed","boe","tired","crazy","lol","rose","good","bomb","help","red","secret","angel","king");

            $smile_name_code['smile'] = "(smiling)";
            $smile_name_code['sad'] = "(sad)";
            $smile_name_code['wink'] = "(winking)";
            $smile_name_code['bond'] = "(hiding)";
            $smile_name_code['open_smile'] = "(happy)";
            $smile_name_code['wow'] = "(shoked)";
            $smile_name_code['cry'] = "(crying)";
            $smile_name_code['confused'] = "(confused)";
            $smile_name_code['jokingly'] = "(joking)";
            $smile_name_code['spiteful'] = "(spiteful)";
            $smile_name_code['diablo'] = "(diablo)";
            $smile_name_code['music'] = "(music)";
            $smile_name_code['kissed'] = "(kissed)";
            $smile_name_code['boe'] = "(boeing)";
            $smile_name_code['tired'] = "(tired)";
            $smile_name_code['rose'] = "(rose)";
            $smile_name_code['good'] = "(thumbs up)";
            $smile_name_code['bomb'] = "(bomb)";
            $smile_name_code['help'] = "(help)";
            $smile_name_code['red'] = "(red)";
            $smile_name_code['secret'] = "(secret)";
            $smile_name_code['crazy'] = "(crazy)";
            $smile_name_code['lol'] = "(lol)";
            $smile_name_code['king'] = "(king)";
            $smile_name_code['lazy'] = "(lazy)";
            $smile_name_code['angel'] = "(angel)";

            foreach ($smile_name_code as $name=>$code)
            {
                $smile_res[$name] = '<img src="/i/smiles/'.$name.'.gif" />';
            }
            $this->smile_code_name = array_flip($smile_name_code);
    }
    
    public function _initBadgeList(&$badge_pic = array())
    {
        $badge_pic = array("Angel","Book","BYU","CTR","Inzion","LDS","RM","Temple","UofU","UVU");
    }

    public function FindSmile(&$story = '')
    {
        if ($story)
        {
            $pos_st = strpos($story,"(");
            while (!($pos_st === false))
            {
                $pos_fn = strpos($story,")",$pos_st);
                if (!($pos_fn === false))
                {
                    $sm_str = substr($story,$pos_st,$pos_fn - $pos_st+1);
                    if (array_key_exists($sm_str, $this->smile_code_name))
                    {
                        $new = str_replace($sm_str, $this->smile_res[$this->smile_code_name[$sm_str]], $story);
                        if ($new) $story = $new;
                        $pos_st = strpos($story,"(",$pos_st + strlen($this->smile_res[$this->smile_code_name[$sm_str]]));
                        //print_r($new);
                    }
                    else {return $story;}
                }
                else {return $story;}
            }
        }
        return $story;
    }



}

?>
