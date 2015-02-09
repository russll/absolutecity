<?php
/**
 * Image class - Create thumbnails
 * 
 * @package    wsCat Jx
 * @version    1.0
 * @since      24.06.2008
 * @copyright  2004-2008 5Dev
 * @link       http://5dev.com
 */

class Ctrl_Image_Thumb
{
    private $mCacheDir;
    private $mCacheDirRel;
    private $mImage;
    private $mImageDirRel;

    public function __construct($image,
                                $ImageDir    = '',
                                $CacheDir    = '',
                                $ImageDirRel   = '',
                                $CacheDirRel = ''
                                )
    {
        if ($ImageDir == '')
            $ImageDir = DIR_WS_IMAGE .'/';
        if ($CacheDir == '')
            $CacheDir = DIR_WS_IMAGE . '/' . DIR_NAME_IMAGECACHE;
        if ($ImageDirRel == '')
            $ImageDirRel = PATH_ROOT . DIR_NAME_IMAGE . '/';
        if ($CacheDirRel == '')
            $CacheDirRel = PATH_ROOT . DIR_NAME_IMAGE . '/' . DIR_NAME_IMAGECACHE;

        $this -> mImage       = $image;
        $this -> mImageDir    = $ImageDir;
        $this -> mCacheDir    = $CacheDir;
        $this -> mImageDirRel = $ImageDirRel;
        $this -> mCacheDirRel = $CacheDirRel;
    }#End constructor


    /**
    * Create Image Thumbnail
    *
    * @param int $x - new image width
    * @param int $y - new image heigt
    * @param int $aspectratino - if == 1, make autoformat of image by width or height
    * @return array - array(cached(0 - no : 1 - yes),  full image path)
    */
    public function CreateThumbImage($x, $y, $aspectratio = 1)
    {
        global $gSmarty;

        $image = $this -> mImageDir . $this -> mImage;

        $types                 = array (1 => "gif", "jpeg", "png", "swf", "psd", "wbmp");
        $not_supported_formats = array ("GIF", "SWF", "PSD", "BMP"); // Write in capital Letters!!

        #check cachedir
        umask(0);
        !is_dir ($this -> mCacheDir)
            ? mkdir ($this -> mCacheDir, 0777)
            : system ("chmod 0777 ".$this -> mCacheDir);

        #check image exist
        if (!file_exists( $image ))
            throw new Exception ($image . ' - ' . $gSmarty -> _config[0]['vars']['errimage1']);

        $imagedata = getimagesize($image);
        #check image header
        if (!$imagedata[2] || $imagedata[2] == 4 || $imagedata[2] == 5)
            throw new Exception ($gSmarty -> _config[0]['vars']['errimage2']);

        #check Can we resize this format or not
        if (in_array(strtoupper(array_pop(explode('.', $this -> mImage))),$not_supported_formats))
        {
            return array(0, $image);
        }

        #create new image width and height
        if ( !is_numeric($x) || $x == 0 ) $x = floor ($y * $imagedata[0] / $imagedata[1]);
        if ( !is_numeric($y) || $y == 0 ) $y = floor ($x * $imagedata[1] / $imagedata[0]);

        if ( $aspectratio )
            if ( $imagedata[1] / $y > $imagedata[0] / $x )
                $x = ceil( $imagedata[0] / $imagedata[1] * $y );
            else
                $y = ceil( $x/ ($imagedata[0]/$imagedata[1]) );

        $thumbfile =  '/' . $this -> mImage;

        #check if cached
        if ( file_exists( $this -> mCacheDir . $thumbfile ) )
        {
            $thumbdata = getimagesize( $this -> mCacheDir . $thumbfile );
            $thumbdata[0] == $x && $thumbdata[1] == $y
                ? $iscached = true
                : $iscached = false;
        }
        else
            $iscached = false;

        #check Can we resize this image (if width > width_max || heigth > height_max)
        if (!$iscached)
        {
            ($imagedata[0] > $x || $imagedata[1] > $y) || (($imagedata[0] < $x || $imagedata[1] < $y))
                ? $makethumb = true
                : $makethumb = false;
        }
        else
            $makethumb = false;

        if ($makethumb)
        {
            $image = call_user_func("imagecreatefrom".$types[$imagedata[2]], $image);
            if (function_exists("imagecreatetruecolor") && ($thumb = imagecreatetruecolor ($x, $y)))
            {
                #GD ver. >= 2
                imagecopyresampled($thumb, $image, 0, 0, 0, 0, $x, $y, $imagedata[0], $imagedata[1]);
            }
            else
            {
                #GD ver. < 2
                $thumb = imagecreate($x, $y);
                imagecopyresized($thumb, $image, 0, 0, 0, 0, $x, $y, $imagedata[0], $imagedata[1]);
            }
            call_user_func("image".$types[$imagedata[2]], $thumb, $this -> mCacheDir.$thumbfile, 100);
            imagedestroy ($image);
            imagedestroy ($thumb);
            $rimg = array(1, $this -> mCacheDirRel . $thumbfile);
        }
        else
        {
            $iscached
                ? $rimg = array(1, $this -> CacheDirRel . $thumbfile)
                : $rimg = array(0, $image);
        }

        return $rimg;

    }#CreateThumbImage

}#end class
?>