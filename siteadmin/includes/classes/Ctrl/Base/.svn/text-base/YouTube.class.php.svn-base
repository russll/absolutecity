<?php

/**
 * Class for Upload
 *
 * @author Elzor
 * @
 */
class  YouTube
{

   /**
    * Google Auth
    * @var <string>
    */
   private  $AccauntType = "GOOGLE";
   private  $Email       = "parmezan1234@gmail.com";//"withuru@gmail.com";
   private  $Passwd      = "0passqwerty";//"tt7Or2tt";
   private  $source      = "Withu7";
   private  $username    = "parmezan1234";//"withuru";


   /**
    * API
    */
   private $AUTH_TOKEN;
   # Это мой ключ, пожалуйста замени его на свой. т.к "AI39si77GURzGQHU--AV-HBdHeZad4-AoRZTFCyuH4yh8NHq2uIonOhiQmQ_ZHvU1uX9Gn2GCOzZgZW6bJkmSx5bTp6RzfZF4Q"
   # забанили чтобы сменить
   # перейди на
   # http://code.google.com/apis/youtube/dashboard/
   private $API_KEY = "AI39si7JsxAYrH5UesmWe4-Na_5-P1ZPHZM6UzjpY_hntNQQiH86Fl3x2iP5WYcNtk3c-hD5yfxcxj944rEtgcciOp7dKgjfZA";


   /**
    * LOGIN
    * @return Auth token string
    */
   private function login()
   {
       $eq = 'accountType='.$this->AccauntType.
             '&Email='.$this->Email.
             '&Passwd='.$this->Passwd.
             '&service=youtube&source='.$this->source;
       if (@$fp=fsockopen ('ssl://www.google.com', 443, $errno, $errstr, 20)) {
          $request ="POST /youtube/accounts/ClientLogin HTTP/1.0\r\n";
          $request.="Host: www.google.com\r\n";
          $request.="Content-Type:application/x-www-form-urlencoded\r\n";
          $request.="Content-Length: ".strlen($eq)."\r\n";
          $request.="\r\n\r\n";
          $request.=$eq;
          fwrite($fp,$request,strlen($request));
          while (!feof($fp))
            $response.=fread($fp,8192);
           
          fclose($fp);
       }
  
       preg_match("!(.*?)Auth=(.*?)\n!si",$response,$ok);
       $AUTH_TOKEN = $ok[2];
       return $AUTH_TOKEN;
   }/* login */


    /**
     * Get Token for upload form
     * @param <string> $title
     * @param <string> $desc
     * @param <string> $cat
     * @param <string> $tags
     * @return <array>
     */
    public function getToken($title, $desc, $cat="Nonprofit", $tags="")
    {
         $AUTH_TOKEN = $this->login();
         $data = <<<EOF
<?xml version="1.0"?>
<entry xmlns="http://www.w3.org/2005/Atom"
  xmlns:media="http://search.yahoo.com/mrss/"
  xmlns:yt="http://gdata.youtube.com/schemas/2007">
  <media:group>
    <media:title type="plain">$title</media:title>
    <media:description type="plain">$desc</media:description>
    <media:category scheme="http://gdata.youtube.com/schemas/2007/categories.cat">$cat</media:category>
    <media:keywords>$tags</media:keywords>
  </media:group>
</entry>
EOF;
        if ($fp = fsockopen ('gdata.youtube.com', 80, $errno, $errstr, 20))
        {
            $request ="POST /action/GetUploadToken HTTP/1.1\r\n";
            $request.="Host: gdata.youtube.com\r\n";
            $request.="Content-Type: application/atom+xml; charset=UTF-8\r\n";
            $request.="Content-Length: ".strlen($data)."\r\n";
            $request .="Authorization: GoogleLogin auth=".$AUTH_TOKEN."\r\n";
            $request.="X-GData-Client: ".$this->source." \r\n";
            $request.="X-GData-Key: key=".$this->API_KEY." \r\n";

            $request.="\r\n";
            $request.=$data."\r\n";
            socket_set_timeout($fp, 10);

            fputs($fp,$request,strlen($request));
            $response = fread($fp,3280);
            fclose($fp);

            preg_match("/<url>(.*)<\/url>/i",$response,$url);
            preg_match("/<token>(.*)<\/token>/i",$response,$token);
            $token = $token[1];
            $url   = $url[1];

            return array ("url"   => $url,
                          "token" => $token
                         );
        }
    }/* getToken */

    
    public function SetToken()
    {
        $this -> AUTH_TOKEN = $this -> login();
    }/** GetToken */

    /**
     * Get Video Information
     * @param <string> $vid - youtube video id
     */
    public function get($vid)
    {
        $AUTH_TOKEN = $this -> AUTH_TOKEN;
        if ($fp = fsockopen ('gdata.youtube.com', 80, $errno, $errstr, 20))
        {
            $request ="GET /feeds/api/users/".$this->username."/uploads/".$vid." HTTP/1.1\r\n";
            $request.="Host: gdata.youtube.com\r\n";
            $request.="Content-Type: application/atom+xml; charset=UTF-8\r\n";
            $request .="Authorization: GoogleLogin auth=".$AUTH_TOKEN."\r\n";
            $request .="Authorization: GoogleLogin auth=".$AUTH_TOKEN."\r\n";
            $request.="X-GData-Client: ".$this->source." \r\n";
            $request.="X-GData-Key: key=".$this->API_KEY." \r\n";
            $request.="\r\n";
            socket_set_timeout($fp, 10);

            fputs($fp,$request,strlen($request));
            $response = fread($fp,3280);
            fclose($fp);
            return $response;
        }
    }

    

}/*end class*/

?>