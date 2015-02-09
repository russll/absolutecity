<?php
/**
 * Main class
 */
class Model_Search_Gparser
{
    private $cx = "partner-pub-1815961026033935:1eve20vw6u8"; // google custom search ID
    public $page = 1;
    public $cnt_pages = 0;
    public $next = -1;
    public $previos = -1;

    public function __construct()
    {

    }

    public function setCx($cx)
    {
        $this->cx = $cx;
        return true;
    }

    public function getCx()
    {
        return $cx;
    }


    public function getPage($url)
    {

        $agent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; ru-RU; rv:1.7.12) Gecko/20050919 Firefox/1.0.7";
        $header [] = "Accept: text/html;q=0.9, text/plain;q=0.8, image/png, */*;q=0.5";
        $header [] = "Accept_charset: windows-1251, utf-8, utf-16;q=0.6, *;q=0.1";
        $header [] = "Accept_encoding: identity";
        $header [] = "Accept_language: ru-ru,ru;q=0.5";
        $header [] = "Connection: close";
        $header [] = "Cache-Control: no-store, no-cache, must-revalidate";
        $header [] = "Keep_alive: 300";
        $header [] = "Expires: Thu, 01 Jan 1970 00:00:01 GMT";

        $process = curl_init($url);
        /**
         * Main
         */
        curl_setopt($process, CURLOPT_HTTPHEADER, $header);
        curl_setopt($process, CURLOPT_HEADER, 0);
        curl_setopt($process, CURLOPT_USERAGENT, $agent);
        curl_setopt($process, CURLOPT_BUFFERSIZE, 64000);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($process, CURLOPT_REFERER, 'http://www.google.com/');

        /**
         * Cookies
         */
        curl_setopt($process, CURLOPT_COOKIEJAR, 'cookie.txt');
        if (file_exists('cookie.txt'))
        {
            curl_setopt($process, CURLOPT_COOKIEFILE, 'cookie.txt');
        }


        /**
         * SSL
         */
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($process, CURLOPT_HTTPHEADER, array('Expect:'));

        $return = curl_exec($process);
        $headers = curl_getinfo($process);
        curl_close($process);
        return array('data' => $return,
            'headers' => $headers);
    }


    private function getLinks($document, $se = 'google')
    {
        $links = array();
        switch ($se)
        {
            case 'google':
                preg_match_all("'<\s*li><\s*div[^c]*?class=\"g\"[^>]*?>(.*)</\.*table[^>]*?></\.*div[^>]*?></\.*li[^>]*?>'isx",$document,$block1);

                /**
                 * oldpreg_match_all("'<\s*li><\s*div[^c]*?class=g[^>]*?>(.*)</\.*table[^>]*?></\.*div[^>]*?></\.*ol[^>]*?></\.*div[^>]*?>'isx", $document, $block1);
                 */

                if (!empty($block1[0]))
                {

                    /**
                     * oldpreg_match_all("'<\s*a[^h]*?href[^=]*?=[^\"]*?\"(.*?)\"[^>]*?>(.*?)</\.*a[^>]*?></\.*h2[^>]*?>.*?<\s*div[^c]*?class=std>(.*?)<\s*span[^c]*?class=a[^>]*?>(.*?)</\.*span[^>]*?>.*?</\.*div[^>]*?>'isx", $block1[0][0], $links);
                     */
                    preg_match_all("'<\s*a[^h]*?href[^=]*?=[^\"]*?\"(.*?)\"[^>]*?>(.*?)</\.*a[^>]*?></\.*h2[^>]*?>.*?<\s*div[^c]*?class=\"std\">(.*?)<\s*span[^c]*?class=\"a\"[^>]*?>(.*?)</\.*span[^>]*?>.*?</\.*div[^>]*?>'isx",$block1[0][0],$links);

                    $links[3] = str_replace("<br>", "", $links[3]);
                    $links[3] = str_replace("&nbsp;", "", $links[3]);
                    $links[3] = str_replace("  ", "", $links[3]);
                    $res['link'] = $links[1];
                    $res['title'] = $links[2];
                    $res['descr'] = $links[3];
                    $res['location'] = $links[4];
                    $links = $res;
                }
                break;
        }
        
        return $links;

    }

    private function reject($links, $se = 'google')
    {
        $res = array();

        switch ($se)
        {
            case 'google':
            default:
                for ($i = 0; $i < count($links[1]); $i++)
                {
                    preg_match('#google.com#', $links[1][$i], $ddd);
                    if ($i >= 0 && $links[1][$i][0] != '/' && 0 == count($ddd))
                    {
                        $r['link'] = $links[1][$i];
                        $r['title'] = $links[2][$i];
                        $r['descr'] = $links[3][$i];
                        $res[] = $r;
                    }
                }
        }
        //deb($res);
        return $res;
    }

    /**
     * Результат получается только при lang=en
     * так как используется привязка к "Next" и "Previos"
     * @param <type> $html
     * @return <type>
     */
    public function getCountPages($html)
    {
        preg_match_all("'<\s*div[^i]*?id=\"navbar\"[^>]*?>(.*)</\.*div[^>]*?>[^<]*?</\.*div[^>]*?>'isx",$html,$block);
        /**
         * preg_match_all("'<\s*div[^i]*?id=navbar[^>]*?>(.*)</\.*div[^>]*?>[^<]*?</\.*div[^>]*?>'isx", $html, $block);
         */
        $res = array();
        if (!empty($block[0]))
        {
            /**
             * preg_match_all("'<\s*a[^h]*?href=\".*start=(\d+).*?\"[^>]*?>[^<]*?<\s*span[^>]*?>Next</\.*span[^>]*?>'isx", $block[0][0], $res);
             */
            preg_match_all("'<\s*a[^h]*?href=\".*start=(\d+).*?\"[^>]*?>[^<]*?<\s*span[^>]*?>Next</\.*span[^>]*?>'isx",$block[0][0],$res);
            if (isset ($res[1][0]) && $res[1][0] > 0)
            {
                $this->next = $res[1][0];
            }
            /**
             * preg_match_all("'<\s*a[^h]*?href=.*?start=(\d+)[^>]*?>.*?Previous.*?</\.*a[^>]*?>'isx", $block[0][0], $res);
             */
            preg_match_all("'<\s*a[^h]*?href=.*?start=(\d+)[^>]*?>.*?Previous.*?</\.*a[^>]*?>'isx",$block[0][0],$res);
            if (isset ($res[1][0]) && strlen($res[1][0]) > 0)
            {
                $this->previos = $res[1][0];
            }
            /**
            preg_match_all("'start=(\d+)'isx", $block[0][0], $start);
            */
            preg_match_all("'start=(\d+)'isx", $block[0][0], $start);
            unset ($start[1][0]);
            unset ($start[1][count($start[1])]);
            $res = $start[1];
        }
        return $res;
    }

    public function parse($query, $se = 'google', $ad = false, $ofset = 0, $lang = "en")
    {
        $url = '';
        switch ($se)
        {
            case 'google':
            default:
                //$url = 'http://www.google.com/custom?hl=' . $lang . '&client=google-coop&cof=FORID:13;AH:left;CX:SimpleE;L:http://www.google.com/intl/ru/images/logos/custom_search_logo_sm.gif;LH:30;LP:1;VLC:%23551a8b;DIV:%23cccccc;&adkw=AELymgVrkyd_mjU5bG51AtrPFoCJJ4qhYzZZGygvtRHhnDiHY6mPAplXchNTMvtfxP1fYoOSwPHp1FEH6yNRLKwoBwCXqFetx18Ek31DPgnZZ95HFNWxirA&q=' . urlencode($query) . '&btnG=Поиск&cx=' . $this->cx;

                $url = 'http://www.google.com/custom?hl=en&safe=active&client=pub-1815961026033935&cof=FORID:13%3BAH:left%3BCX:With%2520LOGO%3BL:http://farm6.static.flickr.com/5055/5495223938_2415978f5a_s.jpg%3BLH:50%3BLC:%230000ff%3BVLC:%23663399%3BDIV:%23336699%3B&cx='.$this -> cx.'&adkw=AELymgXSAY-kzxvwgt0SrADX4o7j_wUh8qq6pVN7EBsCBJk3dM8sTlvaKL-b4TwY61cg7wH0SnfT8CPB4zOZgwf3YEg_37MQQmpU1N3J5ROj6qJEwN1fj5Q&channel=5321216805&oe=UTF-8&ei=j694TanuGJGVOpr0-e4G&q='.urlencode($query).'&sa=N';

                if ($ofset > 5)
                {
                    $url .= '&start=' . $ofset;
                }
        }
        $page = $this->getPage($url);
        $html = $page['data'];
        $adv = $this->getAd($html, $se);
        $links = $this->getLinks($html, $se);
        $pages = $this->getCountPages($html);

        if (!$ad)
        {
            return $res;
        }
        else
        {
            return array(
                "results" => $links,
                "ad" => $adv,
                "pages" => $pages
            );
        }

    }

    /**
     * Get ad from page
     * @param html $document
     * @param string $se
     * @return array
     */
    public function getAd($document, $se)
    {
        switch ($se)
        {
            case 'google':
                $res = array();
                /**
                 * preg_match_all("'<\s*div[^i]*?id=tpa1[^>]*?>(.*)</\.*font[^>]*?></\.*div[^>]*?></\.*td[^>]*?></\.*tr[^>]*?></\.*table[^>]*?><br>'isx", $document, $block1);
                 */
                preg_match_all("'<\s*div.*?id=\"tpa1\"[^>]*?>(.*)</\.*font[^>]*?></\.*div[^>]*?></\.*td[^>]*?></\.*tr[^>]*?></\.*table[^>]*?><br><t'isx",$document,$block1);
              
                if (!empty($block1[0]))
                {
                    $block1[1][0] .='</fornt>';
                    
                    /**
                     * preg_match_all("'<\s*a[^h]*?href=(.*?)onmouseover[^>]*?>(.*?)</a><br><font[^>]*?>[^<]*?<\s*span[^c]*?class=a[^>]*?>(.*?)</\.*span[^>]*?>(.*?)</\.*font>'isx", $block1[0][0], $links1);
                     */
                    preg_match_all("'<\s*a[^h]*?href=\"(.*?)\"[^>]*?>(.*?)</a><br><font[^>]*?>[^<]*?<\s*span[^c]*?class=\"a\"[^>]*?>(.*?)</\.*span[^>]*?>(.*?)</\.*font>'misx",$block1[1][0],$links1);
              
                    if (count($links1[1]) != 0)
                    {
                        $res['top']['link'] = $links1[1];
                        $res['top']['title'] = $links1[2];
                        $links1[4] = str_replace("<br>", "", $links1[4]);
                        $links1[4] = str_replace("&nbsp;", "", $links1[4]);
                        $links1[4] = str_replace("  ", "", $links1[4]);
                        $res['top']['descr'] = $links1[4];
                        $res['top']['location'] = $links1[3];
                    }
                }


                /**
                 * preg_match_all("'<\s*td[^c]*?class=std[^n]*?nowrap[^>]*?>(.*?)<br></\.*td[^>]*?>'isx", $document, $block2);
                 */
                preg_match_all("'<\s*td[^n]*?nowrap[^c]*?class=\"std\"[^>]*?>(.*?)<br></\.*td[^>]*?>'isx",$document,$block2);

                if (!empty($block2[0]))
                {
                    /**
                     * preg_match_all("'<\s*a[^h]*?href=\"(.*?)\"[^>]*?>(.*?)</a></font>(.*?)<\s*span[^c]*?class=a[^>]*?>(.*?)</\.*span[^>]*?>'isx", $block2[0][0], $links2);
                     */
                    preg_match_all("'<\s*a[^h]*?href=\"(.*?)\"[^>]*?>(.*g?)</a></font>(.*?)<\s*span[^c]*?class=\"a\"[^>]*?>(.*?)</\.*span[^>]*?>'misx",$block2[1][0],$links2);
              

                    if (count($links2[1]) != 0)
                    {
                        $res['right']['link'] = $links2[1];
                        $res['right']['title'] = $links2[2];
                        $links2[3] = str_replace("<br>", "", $links2[3]);
                        $links2[3] = str_replace("&nbsp;", "", $links2[3]);
                        $links2[3] = str_replace("  ", "", $links2[3]);
                        $res['right']['descr'] = $links2[3];
                        $res['right']['location'] = $links2[4];
                    }
                }
                break;

        }
        return $res;
    }

    private function delDupl($arr)
    {
        $arr = array_unique($arr);
        $res = array();
        for ($i = 0; $i < count($arr) + 15; $i++)
        {
            if (!empty($arr[$i]))
            {
                $res[] = $arr[$i];
            }
        }
        return $res;
    }

    /**
     * Get domain name from some Url
     * @param string $url
     * @return string
     */
    public function GetDomainFromUrl($url)
    {
        $parts = parse_url($url);
        $host = $parts['host'];
        if (empty($parts['host']))
        {
            return $url;
        }
        if (in_array("www", explode(".", $host)))
        {
            $just_domain = explode("www.", $host);
            return $just_domain[1];
        }
        else
        {
            return $host;
        }
    }
    /** GetDomainFromUrl */

}

#end class
?>