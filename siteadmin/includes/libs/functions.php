<?php


function strlen_utf8($string)
{
    return iconv('windows-1251', 'utf-8', strlen(iconv('utf-8', 'windows-1251', $string)));
}

function substr_utf8($string, $start = 0, $length = 0)
{
    return iconv('windows-1251', 'utf-8', substr(iconv('utf-8', 'windows-1251', $string), $start, $length));
}

function GetPostfix($uid, $cnt_data = 1000)
{
    return ceil($uid / $cnt_data);
}


function close_tags($text)
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
            { // Если тэг закрывается
                // То удаляем из стека
                if (end($opened_tags_stack) == $tag_name)
                    array_pop($opened_tags_stack);
            } else
            {
                // Если тэг открывается и он не одиночный, то кладем в стек
                if (!in_array($tag_name, $ignore_tags))
                    array_push($opened_tags_stack, $tag_name);
            }
        }
        ;
        while ($tag = array_pop($opened_tags_stack))
        {
            $text .= "</$tag>";
        }
    }
    return $text;
}


function ip_init()
{
    // define('IP', '72.233.44.162');return;

    if (!empty($_SESSION['saved_ip']))
        define('IP', $_SESSION['saved_ip']);
    else
    {
        define('IP', real_ip());
        $_SESSION['saved_ip'] = IP;
    }
}

/** ip_init */

/**
 * generate image path (with create folder) by ID
 */
function gen_path_by_id($id, $path, $max_files_count = 1000)
{
    $p = floor($id / $max_files_count) + 1;
    if (!file_exists($path . '/' . $p) || !is_dir($path . '/' . $p))
    {
        @mkdir($path . '/' . $p);
        @chmod($path . '/' . $p, 0777);
    }
    return $p;
}

/** gen_path_by_id */

/**
 * Get real ip
 *
 * @return mixed false on error or string otherwise
 */
function real_ip()
{
    $REMOTE_ADDR = @$_SERVER['REMOTE_ADDR'];
    $HTTP_X_FORWARDED_FOR = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $HTTP_X_FORWARDED = @$_SERVER['HTTP_X_FORWARDED'];
    $HTTP_FORWARDED_FOR = @$_SERVER['HTTP_FORWARDED_FOR'];
    $HTTP_FORWARDED = @$_SERVER['HTTP_FORWARDED'];
    $HTTP_VIA = @$_SERVER['HTTP_VIA'];
    $HTTP_X_COMING_FROM = @$_SERVER['HTTP_VIA'];
    $HTTP_COMING_FROM = @$_SERVER['HTTP_COMING_FROM'];

    $proxy_ip = '';

    if ($HTTP_X_FORWARDED_FOR)
        $proxy_ip = $HTTP_X_FORWARDED_FOR;
    else
    {
        if ($HTTP_X_FORWARDED)
            $proxy_ip = $HTTP_X_FORWARDED;
        else
        {
            if ($HTTP_FORWARDED_FOR)
                $proxy_ip = $HTTP_FORWARDED_FOR;
            else
            {
                if ($HTTP_FORWARDED)
                    $proxy_ip = $HTTP_FORWARDED;
                else
                {
                    if ($HTTP_VIA)
                        $proxy_ip = $HTTP_VIA;
                    else
                    {
                        if ($HTTP_X_COMING_FROM)
                            $proxy_ip = $HTTP_X_COMING_FROM;
                        else
                        {
                            if ($HTTP_COMING_FROM)
                                $proxy_ip = $HTTP_COMING_FROM;
                        }
                    }
                }
            }
        }
    }

    if (!$proxy_ip)
        return $REMOTE_ADDR;
    else
    {
        $matches = array();
        if (preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/', $proxy_ip, $matches))
            return $matches[0];
        else
            return $REMOTE_ADDR;
    }
}

/** real_ip */
function GetSafeHTMLCode($str, $tag, $allowable_tags)
{
    foreach ($tag as $value)
    {
        if ($value == 'font')
        {
            while ((bool) preg_match(':<' . $value . '(.+?)>(.+?)<\/' . $value . '>:i', $str))
            {
                $str = preg_replace(':<' . $value . '(.+?)>(.+?)<\/' . $value . '>:i', '[' . $value . ' $1]$2[/' . $value . ']', $str);
            }
            continue;
        }
        while ((bool) preg_match(':<' . $value . '>(.+?)<\/' . $value . '>:i', $str))
        {
            $str = preg_replace(':<' . $value . '>(.+?)<\/' . $value . '>:i', '[' . $value . ']$1[/' . $value . ']', $str);
        }
    }
    $str = strip_tags($str, $allowable_tags);
    foreach ($tag as $value)
    {
        if ($value == 'font')
        {
            while ((bool) preg_match(':\[' . $value . '(.+?)\](.+?)\[\/' . $value . '\]:i', $str))
            {
                $str = preg_replace(':\[' . $value . '(.+?)\](.+?)\[\/' . $value . '\]:i', '<' . $value . '$1>$2</' . $value . '>', $str);
            }
            continue;
        }
        while ((bool) preg_match(':\[' . $value . '\](.+?)\[\/' . $value . '\]:i', $str))
        {
            $str = preg_replace(':\[' . $value . '\](.+?)\[\/' . $value . '\]:i', '<' . $value . '>$1</' . $value . '>', $str);
        }
    }
    return $str;
}

function z_or_1($r)
{
    return $r ? 1 : 0;
}

function PrepTags($t = '')
{
    $t = trim($t);
    if (!empty($t))
    {
        $a = explode(',', $t);
        $t = array();
        foreach ($a as $k => $v)
        {
            $v = trim(strip_tags($v));
            if (!empty($v) && $v != ',' && !in_array($v, $t))
            {
                $t[] = $v;
            }
        }
        $t = (empty($t)) ? '' : ',' . implode(',', $t) . ',';
    }
    return $t;
}

/** PrepTags */
function UnPrepTags($t = '')
{
    if (!empty($t))
    {
        $t = substr($t, 1, strlen($t) - 2);
    }
    return $t;
}

/** UnPrepTags */
function hex2bin($h)
{
    if (!is_string($h))
        return null;
    $r = '';
    for ($a = 0; $a < strlen($h); $a += 2)
    {
        $r .= chr(hexdec($h
        {$a} . $h
        {($a + 1)}));
    }
    return $r;
}

/** Debug functions */
function debm($vr)
{
    @mail('sergysh@gmail.com', 'Debug', print_r($vr, true));
}

/** debm */
function deb(&$val, $ondie = true)
{
    echo '<pre>';
    print_r($val);
    if ($ondie)
    {
        die();
    }
}

/** deb */

/**
 * PEAR Error handling function. Generate exception.
 *
 * @param object $errorPbj
 * @return void
 */
function pear_error_callback($errorObj)
{
    if (empty($GLOBALS['noDbErrors']))
        sc_error($errorObj->message . '<br /><br />' . $errorObj->userinfo);
}

/**
 * Standard function for display of errors
 *
 * @param string $mess       message of error
 * @param string $addMess    additional information about error
 * @param string $fName      script name
 * @param string $lineNumber number of line in script
 *
 * @return string
 */
function sc_error($mess, $addMess = '', $fName = '', $lineNumber = '')
{
    $trace = '';
    if (is_object($mess))
    {
        $trace = $mess->getTrace();
        $newArr = array();
        for ($i = 0; $i < count($trace); $i++)
        {
            if (preg_match('/(pear|db\.php)/i', $trace[$i]['file']))
                continue;

            $newArr[] = $trace[$i];
        }

        $trace = '<pre>' . print_r($newArr, true) . '</pre>';
        $lineNumber = $mess->getLine();
        $fName = $mess->getFile();
        $mess = $mess->getMessage();
    }

    if (!empty($fName))
        $mess .= '<br /><br />file: ' . $fName . '<br />line: ' . $lineNumber;
    else
        $mess .= '<br /><br />script: ' . getenv('SCRIPT_NAME');

    $mess = '<font color="#000000"><b>' . $mess . '<br /><br />';

    if (!empty($addMess))
        $mess .= $addMess . '<br /><br />';

    $mess .= '<small><font color="#ff0000">STOP</font></small>'
            . '<br /><br /></b></font>' . $trace;

    if (FATAL_ERROR_DISP == 1)
        die($mess);
    else
    {
        if (!empty($_REQUEST))
        {
            $mess .= '<br /><br />REQUEST:<pre>'.print_r($_REQUEST, 1).'</pre>';
        }

        if (!empty($_SERVER))
        {
            $mess .= '<br /><br />SERVER:<pre>'.print_r($_SERVER, 1).'</pre>';
        }
        
        if (!empty($_SESSION))
        {
            $mess .= '<br /><br />SESSION:<pre>'.print_r($_SESSION, 1).'</pre>';
        }

        if (!empty($_COOKIE))
        {
            $mess .= '<br /><br />COOKIE:<pre>'.print_r($_COOKIE, 1).'</pre>';
        }

        admin_notify('Fatal Error', $mess);
        uni_redirect(PATH_ROOT . '404.php', 2);
    }
}

/**
 * Send email to admin (with email ADMIN_EMAIL)
 *
 * @param string $source  message subject
 * @param string $message message text
 *
 * @return void
 *
 * @see includes/config/main.ini
 */
function admin_notify($source, $message)
{
    $headers = '';
    $headers .= 'From: ' . SUPPORT_SITENAME . ' Notification <' . SUPPORT_EMAIL . ">\n";
    $headers .= 'Content-Type: text/html; charset=' . DEF_CHARSET . "\n";
    @mail(ADMIN_EMAIL, 'New notify: ' . $source, $message, $headers);
}

/** Check ? in string */
function cb($s)
{
    return (0 < strpos('_' . $s, '?')) ? '&' : '?';
}

/** cb */

/**
 * Prepare var from request
 *
 */
function _v($var, $val = '')
{
    $num = (is_numeric($val)) ? 1 : 0;
    $r = (!empty($_REQUEST[$var]) && (!$num || ($num && is_numeric($_REQUEST[$var]) && 0 <= $_REQUEST[$var]))) ? $_REQUEST[$var] : $val;
    return $r;
}

/** _v */

/**
 * Universal function for redirect. Auto-update urls if use_trans_id is on.
 *
 * @param string $url       url for redirect
 * @param int    $flag      type of redirect: 1,3 - through HTTP Header, 2,4 - through meta-tag. 3,4 - auto-update url with https (SSL Only)
 * @param int    $useSID    update url with session id: 0 - never, 1 - if no host in url, 2 - always
 * @param string $addParams this string is put in url end
 *
 * @return void
 */
function uni_redirect($url, $flag = 1, $useSID = 1, $addParams = '') //
{
    $url = add_sid($url, $useSID);
    if ('' != $addParams)
    {
        $purl = parse_url($url);

        if (3 == $flag || 4 == $flag)
            $scheme = 'https://';
        else
            $scheme = (!empty($purl['scheme'])) ? $purl['scheme'] . '://' : '';

        $host = (!empty($purl['host'])) ? $purl['host'] : '';
        $port = (!empty($purl['port'])) ? $purl['port'] : '';
        $path = (!empty($purl['path'])) ? $purl['path'] : '/';


        $url = $scheme . $host . $port . $path . '?';

        $url .= (!empty($purl['query'])) ? $purl['query'] . '&' : '';
        $url .= $addParams;
    }

    if (1 == $flag || 3 == $flag)
        header('Location: ' . $url);
    else
        echo '<html><head><meta http-equiv="Refresh" content="0; url=' . $url . '" /></head></html>';

    exit();
}

/** uni_redirect */

/**
 * Add session id in url if it is required
 *
 * @param string $url     url
 * @param int    $useSID  0 - no , 1 - if no host, 2 - always
 *
 * @return string result url
 *
 * @see uni_redirect()
 */
function add_sid($url, $useSID = 1) //
{
    $purl = parse_url($url);
    $scheme = (!empty($purl['scheme'])) ? $purl['scheme'] . '://' : '';
    $host = (!empty($purl['host'])) ? $purl['host'] : '';
    $port = (!empty($purl['port'])) ? $purl['port'] : '';
    $path = (!empty($purl['path'])) ? $purl['path'] : '/';

    $url = $scheme . $host . $port . $path;

    if (defined('SID') && strlen(SID) > 0
            && (2 == $useSID || 1 == $useSID && empty($host)))
    {
        if (!empty($purl['query']) && preg_match('/' . SID . '/', $purl['query']))
            $url = $url . '?' . $purl['query'];
        else
            $url = (!empty($purl['query'])) ? $url . '?' . $purl['query'] . '&' . SID : $url . '?' . SID;
    }
    else
        $url = (!empty($purl['query'])) ? $url . '?' . $purl['query'] : $url;

    return $url;
}

/** add_sid */
function PrepMethodName($name, $val = '')
{
    $name = trim(strtolower($name));
    if (empty($name) || !preg_match('/^[0-9a-z]+$/i', $name))
    {
        $name = $val;
    }
    else
    {
        $name[0] = strtoupper($name[0]);
    }
    return $name;
}

/** PrepMethodName */

/**
 * Make Uppercase
 * (for insert mb_string)
 * @param string $str input string
 * @return string
 */
function ToUpper($str)
{
    return strtoupper($str);
    //return mb_strtoupper($str, 'utf8');
}

/**
 * Make lowercase
 * (for insert mb_string)
 *
 * @param string $str input string
 * @return string
 */
function ToLower($str)
{
    return strtolower($str);
    //return mb_strtolower($str, 'utf8');
}

/** ToLower */
function StringLen($str)
{
    return strlen($str);
    //return mb_strlen($str, 'utf8');
}

/**
 * Verify Email
 *
 * @param string $email email for checking
 *
 * @return bool false if bad email or true if email is correct
 */
function verify_email($email)
{
    if (7 > strlen($email))
        return false;

    $zones = array(
        'ac', 'ad', 'ae', 'af', 'ag', 'ai', 'al', 'am', 'an', 'ao', 'aq', 'ar', 'as', 'at', 'au', 'aw', 'az',
        'ax', 'ba', 'bb', 'bd', 'be', 'bf', 'bg', 'bh', 'bi', 'bj', 'bm', 'bn', 'bo', 'br', 'bs', 'bt', 'bv',
        'bw', 'by', 'bz', 'ca', 'cc', 'cd', 'cf', 'cg', 'ch', 'ci', 'ck', 'cl', 'cm', 'cn', 'co', 'cr', 'cs',
        'cu', 'cv', 'cx', 'cy', 'cz', 'de', 'dj', 'dk', 'dm', 'do', 'dz', 'ec', 'ee', 'eg', 'eh', 'er', 'es',
        'et', 'eu', 'fi', 'fj', 'fk', 'fm', 'fo', 'fr', 'ga', 'gb', 'gd', 'ge', 'gf', 'gg', 'gh', 'gi', 'gl',
        'gm', 'gn', 'gp', 'gq', 'gr', 'gs', 'gt', 'gu', 'gw', 'gy', 'hk', 'hm', 'hn', 'hr', 'ht', 'hu', 'id',
        'ie', 'il', 'im', 'in', 'io', 'iq', 'ir', 'is', 'it', 'je', 'jm', 'jo', 'jp', 'ke', 'kg', 'kh', 'ki',
        'km', 'kn', 'kp', 'kr', 'kw', 'ky', 'kz', 'la', 'lb', 'lc', 'li', 'lk', 'lr', 'ls', 'lt', 'lu', 'lv',
        'ly', 'ma', 'mc', 'md', 'mg', 'mh', 'mk', 'ml', 'mm', 'mn', 'mo', 'mp', 'mq', 'mr', 'ms', 'mt', 'mu',
        'mv', 'mw', 'mx', 'my', 'mz', 'na', 'nc', 'ne', 'nf', 'ng', 'ni', 'nl', 'no', 'np', 'nr', 'nu', 'nz',
        'om', 'pa', 'pe', 'pf', 'pg', 'ph', 'pk', 'pl', 'pm', 'pn', 'pr', 'ps', 'pt', 'pw', 'py', 'qa', 're',
        'ro', 'ru', 'rw', 'sa', 'sb', 'sc', 'sd', 'se', 'sg', 'sh', 'si', 'sj', 'sk', 'sl', 'sm', 'sn', 'so', 'su',
        'sr', 'st', 'sv', 'sy', 'sz', 'tc', 'td', 'tf', 'tg', 'th', 'tj', 'tk', 'tl', 'tm', 'tn', 'to', 'tp',
        'tr', 'tt', 'tv', 'tw', 'tz', 'ua', 'ug', 'uk', 'um', 'us', 'uy', 'uz', 'va', 'vc', 've', 'vg', 'vi',
        'vn', 'vu', 'wf', 'ws', 'ye', 'yt', 'yu', 'za', 'zm', 'zw',
        'aero', 'biz', 'cat', 'com', 'coop', 'info', 'jobs', 'mobi', 'museum', 'name', 'net',
        'org', 'pro', 'travel', 'gov', 'edu', 'mil', 'int'
    );
    $regEmail = '/^[\w-\.]+@([\w-]+\.)+([\w-]{2,4})$/';

    $matches = array();
    if (!preg_match($regEmail, $email, $matches))
        return false;

    if (!in_array($matches[2], $zones))
        return false;

    return true;
}

#verify_email

/**
 * function human_file_size
 * Get normal file size (Mb,Kb etc.)
 * @param  int32
 * @return string
 */
function human_file_size($size)
{
    $filesizename = array(' Bytes', ' KB', ' MB', ' GB', ' TB', ' PB', ' EB', ' ZB', ' YB');
    return round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . $filesizename[$i];
}

/**
 * Make original filename
 * @param string $fname - filename
 * @param string $path   - filepath, for example see DIR_WS_IMAGE in main.php
 * @return string - unique image name
 */
function MakeOrig($fname = '', $path = '', $rv = 0)
{
    if ($fname == '' || $path == '')
    {
        return $fname;
    }
    $i = explode('.', $fname);
    if (count($i) < 2)
    {
        $i[1] = 'jpg';
    }
    if (1 == $rv)
    {
        $i[0] = randval();
    }
    $ic = $i[0];
    $k = 0;
    while (file_exists($path . '/' . $ic . '.' . $i[count($i) - 1]))
    {
        $ic = $i[0] . $k;
        $k++;
    }
    $s = $ic . '.' . $i[count($i) - 1];
    return $s;
}

#MakeOrig
// --------------------------------------------------------------------------------

/**
 * Generate random unique integer value dependent on current time
 *
 * @return int
 */
function randval()
{
    return (int) date('n') . date('j') . date('y') . date('h') . date('i') . date('s') . rand(99, 2);
}

// --------------------------------------------------------------------------------

/**
 * Crop function with copy image
 * @param  int $crop resize method: 1,2
 * @return int
 */
function i_crop_copy($w, $h, $uploadfile, $res_img, $crop = 1)
{
    $size = getimagesize($uploadfile);
    if ($size)
    {
        $width = $size[0];
        $height = $size[1];

        $imgObjName = 'Image_Transform_Driver_GD';
        $img = & new $imgObjName();

        if ($width > $w || $height > $h)
        {
            $wx = $w;
            $hx = $h;

            $img->load($uploadfile);

            if (1 == $crop)
            {
                $crop_height = ($width * $hx) / $wx;

                if ($crop_height > $height) // crop by width
                {
                    $crop_width = ($height * $wx) / $hx;
                    $crop_height = $height;

                    $img->crop(($width - $crop_width) / 2, 0, $crop_width, $height);
                }
                else // Crop by height
                {
                    $crop_width = $width;
                    $img->crop(0, ($height - $crop_height) / 2, $width, $crop_height);
                }

                $img->save($res_img);
                $img->load($res_img);
            }
            else
            {
                $coeff = $height / $width;

                if ($coeff * $wx > $hx)
                    $wx = $width * $hx / $height;
                else
                    $hx = $height * $wx / $width;
            }

            if ($img->resize($wx, $hx))
            {
                $img->save($res_img, 'jpeg');
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            copy($uploadfile, $res_img);
        }
    }
    else
    {
        return false;
    }
}

#i_crop_copy

/**
 * GZ-Compress (i)

 * @param Smarty $gSmarty
 *
 * @return void
 */
function load_gz_compress(&$gSmarty)
{
    if (defined('GZ_COMPRESS') && 1 == GZ_COMPRESS
            && false !== strpos(getenv('HTTP_ACCEPT_ENCODING'), 'gzip')
    )
    {
        header('Content-Encoding: gzip');

        function GZCallback($buffer)
        {
            return gzencode($buffer, 9);
        }

        ob_start('GZCallback');
        ob_implicit_flush(0);
        $gSmarty->assign('GZ_COMPRESS', GZ_COMPRESS);
    }
}

/**
 * Generate random string value (through md5) based on unique information.
 * Initial unique information is supplemented with random numbers
 *
 * @param string $info unique information for encryption
 *
 * @return string
 */
function uni_id2($info = '')
{
    define('SALT_LENGTH', 8);
    $length = SALT_LENGTH;
    $chars = '0123456789abcdef';
    $salt = '';
    mt_srand((double) microtime() * 1000000);
    while ($length--)
    {
        $salt .= $chars[mt_rand(0, strlen($chars) - 1)];
    }

    return md5($salt . $info . mt_rand(0, 1000000) . get_mt_time());
}

function MakeOrigName($fname)
{
    $ext = str_replace('.', '', strrchr($fname, "."));
    $name = translit(substr($fname, 0, strlen($fname) - strlen($ext) - 1));

    $ext = (empty($ext)) ? '.jpg' : $ext;
    $name = (empty($name)) ? mktime() : $name;
    while (file_exists(BPATH . 'files/images/' . $name . '.' . $ext))
    {
        $name = $name . rand(100, 999);
    }
    $fname = strtolower($name . '.' . $ext);
    return $fname;
}

/** MakeOrigName */

/**
 * Get url through cURL
 *
 * @return mixed false on error or string otherwise
 */
function curlget($url, $ua = false, $timeout = 60, $method = 'get', $proxy = false)
{
    if ($ua === false)
        $ua = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows 98; Q312461)';

    if ($method == 'post')
    {
        $purl = parse_url($url);
        $scheme = !empty($purl['scheme']) ? $purl['scheme'] . '://' : '';
        $host = !empty($purl['host']) ? $purl['host'] : '';
        $port = !empty($purl['port']) ? $purl['port'] : '';
        $path = !empty($purl['path']) ? $purl['path'] : '/';
        $query = !empty($purl['query']) ? $purl['query'] : '';

        $headers = array('Connection: Keep-Alive');
        $url = $scheme . $host . $port . $path;
        $ch = curl_init($url);
        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_REFERER, $scheme . $host);
        curl_setopt($ch, CURLOPT_USERAGENT, $ua);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);

        if ($proxy !== false)
            curl_setopt($ch, CURLOPT_PROXY, $proxy);

        curl_setopt($ch, CURLOPT_POST, 1); // set POST method
    }
    else
    {
        $refAr = parse_url($url);
        $scheme = !empty($refAr['scheme']) ? $refAr['scheme'] . '://' : '';
        $headers = array('Connection: Keep-Alive');
        $ch = curl_init($url);
        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_REFERER, $scheme . $refAr['host']);
        curl_setopt($ch, CURLOPT_USERAGENT, $ua);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);

        if ($proxy !== false)
            curl_setopt($ch, CURLOPT_PROXY, $proxy);
    }
    $result = curl_exec($ch);
    if (!$ch)
        return false;
    curl_close($ch);
    return $result;
}

function n_exit()
{
    if (is_object($GLOBALS['glObj']['gDb']))
        $GLOBALS['glObj']['gDb']->disconnect();
    exit();
}

/**
 * Get $key-value from POST or GET and delete all bad symbols
 * @param string $key key of array POST or GET
 * @param mixed  $val default value if key not exists in POST or GET
 *
 * @return mixed required value
 */
function _vdate($key, $val = '')
{
    if (isset($_POST[$key]))
        $val = $_POST[$key];
    elseif (isset($_GET[$key]))
        $val = $_GET[$key];

    return $val;
}

function _vc($key, $def_val = '')
{
    if (isset($_COOKIE[$key]))
        $val = $_COOKIE[$key];
    else
        $val = $def_val;

    if (is_numeric($def_val) && !is_numeric($val))
        $val = $def_val;

    return $val;
}

function _vg($key, $def_val = '')
{
    if (isset($_GET[$key]))
        $val = $_GET[$key];
    else
        $val = $def_val;

    if (is_numeric($def_val) && !is_numeric($val))
        $val = $def_val;

    return $val;
}

function _vp($key, $def_val = '')
{
    if (isset($_POST[$key]))
        $val = $_POST[$key];
    else
        $val = $def_val;

    if (is_numeric($def_val) && !is_numeric($val))
        $val = $def_val;

    return $val;
}

function _vgs($key, $def_val = '')
{
    if (isset($_GET[$key]))
        $val = preg_replace('/[^0-9a-z_.-]/i', '', $_GET[$key]);
    else
        $val = $def_val;

    if (is_numeric($def_val) && !is_numeric($val))
        $val = $def_val;

    return $val;
}

function _vps($key, $def_val = '')
{
    if (isset($_POST[$key]))
        $val = preg_replace('/[^0-9a-z_.-]/i', '', $_POST[$key]);
    else
        $val = $def_val;

    if (is_numeric($def_val) && !is_numeric($val))
        $val = $def_val;

    return $val;
}

function _va(&$arr, $key, $val = '')
{
    if (isset($arr[$key]))
        $val = $arr[$key];

    return $val;
}

function base_chk0($str)
{
    return mysql_real_escape_string(trim(strip_tags($str, '')));
}

function base_chk($str)
{
    return trim(strip_tags($str, ''));
}

function base_chk2($str)
{
    return substr(trim(strip_tags($str, '')), 0, 1000);
}

function base_chk3($str, $addtl = '')
{
    return substr(trim(preg_replace('/[^0-9a-z_\.' . $addtl . '-]/i', '', $str)), 0, 1000);
}

function base_chk4($str, $ccnt = 1000)
{
    return substr(strip_tags(trim($str), '<b><i><p><big><small><div><strong><u><br><font><img><span>'), 0, $ccnt);
}

function base_chk5($str, $ccnt = 1000)
{
    return substr(strip_tags(trim($str), ''), 0, $ccnt);
}

function base_chk6($str)
{
    return strip_tags(trim($str), '<b><i><p><big><small><strong><u><em><font><br><span>');
}

function base_chk7($str)
{
    return strip_tags(trim($str), '<b><i><p><big><small><strong><u><em><font><br><span><div>');
}

/**
 * function file_crc
 * Get CRC32-value for specified file
 * @param string $file
 * @return unsigned int
 */
function file_crc($file_string, $flag = false)
{
    if ($flag === false)
        $file_string = file_get_contents($file_string);

    $crc = crc32($file_string);

    unset($file_string);

    return sprintf('%u', $crc);
}

function calc_path($number, $qty_obj = 40)
{
    $qty_1l = $qty_obj * 1000;

    $p1 = ceil($number / $qty_1l);

    $p2 = ceil(($number - ($p1 - 1) * $qty_1l) / $qty_obj);

    return $p1 . '/' . $p2 . '/';
}

function check_secret($secret, $param, $server_key = SERVER_KEY)
{
    return $secret && md5($param . '_' . $server_key) == $secret;
}

function encode_flags($flags)
{
    $res = '';

    while (list($key, $val) = each($flags))
    {
        $res .= (int) $val;
    }

    return bindec($res);
}

/**
 * Extended exception
 */
class ExtException extends Exception
{

    protected $mErrArr;

    /**
     * Constructor
     *
     * @param array $errCodes array with error codes
     *
     * @return void
     */
     public function __construct($errCodes)
#    public public function __construct($errCodes)
    {
        if (!is_array($errCodes))
            $errCodes = array((int) $errCodes);

        $this->mErrArr = $errCodes;

        parent::__construct('Extended exception. Please use method "GetCodes".');
    }

    public function GetCodes()
    {
        return $this->mErrArr;
    }

}

/*
 * Generating PH in DB's query:	(action (int): 2 - for get, 1 - for update, 0 - for insert)
 * 
 * @param $ar - array (exp. assoc)
 * @param $action - number of action (0)
 * @param $db_pref - additional parameter (pref) for DataBase? especially for plh ('')
 */

function gen_plh($ar, $action = 0, $db_pref = '')
{
    if ($db_pref)
    {
        $db_pref .= '.';
        $ar_n = array();
        foreach ($ar as $k => $r)
        {
            $ar_n[] = $db_pref . $r;
        }
        unset($ar);
        $ar = $ar_n;
    }

    $plh = $db_pref . '';

    if (0 == $action)
    {
        for ($i = 0; $i < count($ar); $i++)
        {
            $plh = $db_pref . $plh . ', ?';
        }
        $plh = substr($plh, 2);
    }
    else if (1 == $action)
        $plh = join(' = ?, ', $ar) . ' = ? ';
    else if (2 == $action)
        $plh = join(' = ? AND ', $ar) . ' = ? ';
    else if (3 == $action)
        $plh = join(' LIKE ? AND ', $ar) . ' LIKE ? ';
    else if (4 == $action)
        $plh = join(' LIKE ? OR ', $ar) . ' LIKE ? ';
    return $plh;
}

//** Generating PH in DB's query (1 - for update, 0 - for insert) */

function gen_plh2($ar, $action = 1) //Generating PH in DB's query
{
    $cols = array_keys($ar);
    $vals = array_values($ar);

    $plh = '';

    if (0 == $action)
    {
        for ($i = 0; $i < count($cols); $i++)
        {
            $plh = $plh . ', ?';
        }

        $plh = substr($plh, 2);
    }
    else
    {
        $plh = join(' = ?, ', $cols) . ' = ? ';
    }

    return array($plh, $vals, $cols);
}

function chk_link($link) //Check link on correct's datas
{
    //$z2 = 'ru|ad|ae|af|ag|ai|al|am|an|ao|aq|ar|as|at|au|aw|az|ax|ba|bb|bd|be|bf|bg|bh|bi|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gg|gh|gi|gl|gm|gn|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|im|in|io|iq|ir|is|it|je|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|mv|mw|mx|my|mz|na|nc|ne|nf|ng|ni|nl|no|np|nr|nu|nz|om|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|sv|sy|sz|su|tc|td|tf|tg|th|tj|tk|tl|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw|aero|biz|cat|com|coop|info|jobs|mobi|museum|name|net|org|pro|travel|gov|edu|mil|int';
    //$pattern = "`(?:<a [^>]*href=[\"\']{1,})?(?:(?:http|ftp|https):\/\/)?(?:www\.?)?([\w\-_\.]+(?:(?:$z2)+))+(?:[\w\-\.,@?^=%&amp;:/~\+#]*[\w\-\@?^=%&amp;/~\+#])?(?:[\'\"]{1,}[^>]*>(.+?)</a>)?`i";
    //$pattern = "`^(?:<a [^>]*href=[\"\']{1,})?(?:(?:http|ftp|https):\/\/)?(?:www\.?)?([\w\-_\.]+(?:(?:(ru|ad|ae|af|ag|ai|al|am|an|ao|aq|ar|as|at|au|aw|az|ax|ba|bb|bd|be|bf|bg|bh|bi|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gg|gh|gi|gl|gm|gn|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|im|in|io|iq|ir|is|it|je|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|mv|mw|mx|my|mz|na|nc|ne|nf|ng|ni|nl|no|np|nr|nu|nz|om|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|sv|sy|sz|su|tc|td|tf|tg|th|tj|tk|tl|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw|aero|biz|cat|com|coop|info|jobs|mobi|museum|name|net|org|pro|travel|gov|edu|mil|int))+))+(?:[\w\-\.,@?^=%&amp;:/~\+#]*[\w\-\@?^=%&amp;/~\+#])?(?:[\'\"]{1,}[^>]*>(.+?)</a>)?$`i";
    $pattern = "`(?:(?:https?|ftp|telnet)://(?:[a-z0-9_-]{1,32}(?::[a-z0-9_-]{1,32})?@)?)?(?:(?:[a-z0-9-]{1,128}\.)+(?:ru|aero|biz|cat|com|coop|info|jobs|mobi|museum|name|net|org|pro|travel|gov|edu|mil|int|ad|ae|af|ag|ai|al|am|an|ao|aq|ar|as|at|au|aw|az|ax|ba|bb|bd|be|bf|bg|bh|bi|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|com|co|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gg|gh|gi|gl|gm|gn|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|im|in|io|iq|ir|is|it|je|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|mv|mw|mx|my|mz|na|nc|ne|nf|ng|ni|nl|no|np|nr|nu|nz|om|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|sv|sy|sz|su|tc|td|tf|tg|th|tj|tk|tl|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)|(?!0)(?:(?!0[^.]|255)[0-9]{1,3}\.){3}(?!0|255)[0-9]{1,3})(?:/[a-z0-9.,_@%&?+=\~/-]*)?(?:#[^ '\"&<>]*)?`i";

    $matches = array();
    //if (preg_match("|^[-0-9a-z_:\.\/]+\.[a-z]{2,6}\/?$|i", $link))


    if (preg_match($pattern, $link, $matches))
    {
        if (!substr_count($link, 'http://'))
        {
            $link = 'http://' . $matches[0];
        }
        else
            $link = $matches[0];

        return $link;
    }
    else
    {
        return null;
    }
}

/* Check correctivity of the link's data */

function AddZeros($num, $ncnt = 2)
{
    $ccnt = $ncnt - strlen($num);
    for ($i = 0; $i < $ccnt; $i++)
    {
        $num = '0' . $num;
    }
    return $num;
}

function get_img_ext($fname)
{
    $temp = getimagesize($fname);
    if (!$temp)
        return false;

    $ext = '';
    switch ($temp[2])
    {
        case 1:
            $ext = 'gif';
            break;
        case 2:
            $ext = 'jpg';
            break;
        case 3:
            $ext = 'png';
            break;
        //case 6:  $ext = 'bmp';
        //         break;
        default:
            $ext = false;
            break;
    }
    return $ext;
}

function Ar2Str($ar, $dev = -1)
{
    if (!is_array($ar))
        return $ar;
    $s = '';
    if (-1 == $dev)
        $dev = ', ';
    foreach ($ar as $v)
    {
        $s .= ($s ? $dev : '') . $v;
    }
    return $s;
}

function Ar2Json($arr)
{
    return json_encode($arr);
}

/**
 * Translate symbol to charset
 * @param symb - symbol
 * @return
 */
function Symb2Charset($symb)
{
    $arAlpha = array('а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'jo', 'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
        'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'w', 'ъ' => '#', 'ы' => 'y', 'ь' => '\'', 'э' => 'je', 'ю' => 'ju',
        'я' => 'ja', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Jo', 'Ж' => 'Zh', 'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
        'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C', 'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'W', 'Ъ' => '##', 'Ы' => 'Y', 'Ь' => '\'\'', 'Э' => 'Je', 'Ю' => 'Ju', 'Я' => 'Ja');

    return $arAlpha[$symb] ? $arAlpha[$symb] : $symb;
}

/**
 * Функция для формирования уникального имени файла
 * @param string $txt
 * @return string 
 */
function Txt2Charset($txt)
{
    $ext = strrchr($txt, '.');
    $txt   = substr(md5( substr($txt, 0, strrpos($txt, '.')) . rand(100, 999) ), 0, 22);
    return $txt.$ext;
}
/*
function Txt2Charset($txt)
{
    //file_put_contents('1.txt', $st);
    $arAlpha = array('а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'jo', 'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
        'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'w', 'ъ' => '#', 'ы' => 'y', 'ь' => '\'', 'э' => 'je', 'ю' => 'ju',
        'я' => 'ja', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Jo', 'Ж' => 'Zh', 'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
        'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C', 'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'W', 'Ъ' => '##', 'Ы' => 'Y', 'Ь' => '\'\'', 'Э' => 'Je', 'Ю' => 'Ju', 'Я' => 'Ja');
    //file_put_contents('2.txt', str_replace(array_keys($arAlpha), array_values($arAlpha), mb_strtolower($txt, "utf-8")));
    
    $n   = str_replace(array_keys($arAlpha), array_values($arAlpha), mb_strtolower($txt, "utf-8"));
    $ext = strrchr($n, '.');
    $n   = str_replace($search, $replace, $subject)
}
*/

function GetSiteTitle($url)
{
    if (substr_count($url, 'http://') == 0)
        $url = 'http://' . $url;

    if (@file($url))
    {
        $html = implode('', file($url));

        if (preg_match('|charset=(.*)[\'\"]|i', $html, $out))
        {
            $enc = $out[1];
        }

        if (empty($enc) && mb_check_encoding($html, 'Windows-1251'))
        {
            $enc = 'windows-1251';
        }


        if (eregi('<TITLE>(.*)</TITLE>', $html, $out))
        {
            if (!empty($enc) && ToLower($enc) != 'utf8' && ToLower($enc) != 'utf-8')
            {
                if (strlen($enc) < 15)
                {
                    return @iconv($enc, "utf-8", base_chk($out[1]));
                }
                else
                {
                    return base_chk($out[1]);
                }
            }
            else
            {
                return base_chk($out[1]);
            }
        }
    }
    else
        return '';
}


function SaveLog($query)
{
    /*
    $flog = BPATH . PATH_ROOT . 'log.txt';

    $fl = fopen($flog, (!file_exists($flog)) ? 'w' : 'a');
    fputs($fl, $query . "\n\n");
    fclose($fl);
    */
    if (isset ($GLOBALS['gCnt']))
    {
        $GLOBALS['gCnt']++;
    }
}

function ClearLog()
{
    /*
    $flog = BPATH . PATH_ROOT . 'log.txt';
    if (file_exists($flog))
    {
        @unlink( $flog );
    }
    */
}

function ShowLog()
{
    echo 'Query: ' . $GLOBALS['gCnt'] . ', Time: ' . (get_mt_time() - $GLOBALS['gtime']);
    die;
}


/**
 * Get video information (code && image)
 * @param  $video
 * @return array(code, preview)
 */
function chk_embed_code($video, $w = 350, $h = 250, $return_img = 0)
{
    $resu = array();
    if (strpos($video, 'youtube.com'))
    {
        preg_match('/http:\/\/www\.youtube\.com\/embed\/([0-9A-Za-z_\-]+)/', $video, $res);
        if (count($res) > 0 && !empty($res[1]))
        {
            //$code = '<iframe title="YouTube video player" class="youtube-player" type="text/html" width="' . $w . '" height="' . $h . '" src="http://www.youtube.com/embed/' . $res[1] . '" frameborder="0" allowFullScreen></iframe>';
            $code = '<OBJECT width="' . $w . '" height="' . $h . '"><PARAM name="movie" value="http://www.youtube.com/v/' . $res[1] . '"></PARAM><PARAM name="wmode" value="transparent"></PARAM><PARAM name="allowFullScreen" value="true"></PARAM><EMBED src="http://www.youtube.com/v/' . $res[1] . '" type="application/x-shockwave-flash" wmode="transparent" width="' . $w . '" height="' . $h . '" allowFullScreen="true" ></EMBED></OBJECT>';

            if (!$return_img)
            {
                return $code;
            }
            else
            {
                $video_img = 'http://i.ytimg.com/vi/' . $res[1] . '/1.jpg';
                $resu = array($code, $video_img);
            }
        }
        else
        {
            //old youtube
            preg_match('/http:\/\/www\.youtube\.com\/v\/([0-9A-Za-z_\-]+)/', $video, $res);
            if (count($res) > 0 && !empty($res[1]))
            {
                //$code = '<iframe title="YouTube video player" class="youtube-player" type="text/html" width="' . $w . '" height="' . $h . '" src="http://www.youtube.com/embed/' . $res[1] . '" frameborder="0" allowFullScreen></iframe>';
                $code = '<OBJECT width="' . $w . '" height="' . $h . '"><PARAM name="movie" value="http://www.youtube.com/v/' . $res[1] . '"></PARAM><PARAM name="wmode" value="transparent"></PARAM><PARAM name="allowFullScreen" value="true"></PARAM><EMBED src="http://www.youtube.com/v/' . $res[1] . '" type="application/x-shockwave-flash" wmode="transparent" width="' . $w . '" height="' . $h . '" allowFullScreen="true" ></EMBED></OBJECT>';
                        
                if (!$return_img)
                {
                    return $code;
                }
                else
                {
                    $video_img = 'http://i.ytimg.com/vi/' . $res[1] . '/1.jpg';
                    $resu = array($code, $video_img);
                }
            }
        }
    }
    //old you
    elseif (strpos($video, 'rutube.ru'))
    {
        preg_match('/http:\/\/video\.rutube\.ru\/([0-9A-Za-z_\-]+)/', $video, $res);
        if (count($res) > 0 && !empty($res[1]) && strlen($res[1]) > 4)
        {
            $f[0] = substr($res[1], 0, 2);
            $f[1] = substr($res[1], 2, 2);

            $code = '<OBJECT width="' . $w . '" height="' . $h . '"><PARAM name="movie" value="http://video.rutube.ru/' . $res[1] . '"></PARAM><PARAM name="wmode" value="transparent"></PARAM><PARAM name="allowFullScreen" value="true"></PARAM><EMBED src="http://video.rutube.ru/' . $res[1] . '" type="application/x-shockwave-flash" wmode="transparent" width="' . $w . '" height="' . $h . '" allowFullScreen="true" ></EMBED></OBJECT>';

            if (!$return_img)
            {
                return $code;
            }
            else
            {
                $video_img = 'http://img-2.rutube.ru/thumbs-wide/' . $f[0] . '/' . $f[1] . '/' . $res[1] . '-1-2.jpg';
                $resu = array($code, $video_img);
            }
        }
    }
    elseif (strpos($video, 'vimeo.com'))
    {
        preg_match('/http:\/\/player\.vimeo\.com\/video\/([0-9]+)/', $video, $res);
        if (count($res) > 0 && !empty($res[1]))
        {
            $code = '<iframe src="http://player.vimeo.com/video/' . $res[1] . '" width="' . $w . '" height="' . $h . '" frameborder="0"></iframe>';
            if (!$return_img)
            {
                return $code;
            }
            else
            {
                //get vimeo thumb
                $url = 'http://vimeo.com/api/clip/' . $res[1] . '/php';
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);

                // grab URL and pass it to the browser
                $data = curl_exec($ch);
                curl_close($ch);
                if (!empty($data))
                {
                    $video_ar = @unserialize($data);
                    if (!empty($video_ar[0]['thumbnail_small']))
                    {
                        $video_img = $video_ar[0]['thumbnail_small'];
                        $resu = array($code, $video_img);
                    }
                }
            }
        }
    }
    return $resu;
}

?>