<?php
/**
 * Groups configuration for default Minify implementation
 * @package Minify
 */

/**
 * You may wish to use the Minify URI Builder app to suggest
 * changes. http://yourdomain/min/builder/
 *
 * See http://code.google.com/p/minify/wiki/CustomSource for other ideas
 **/

return array(
    'jshome' => array('//includes/templates/js/niceforms.js',
        '//includes/templates/js/jquery-1.3.2.min.js',
        '//includes/templates/js/check.js',
        '//includes/templates/js/Classes/Users.js'),

    'jsbasic' => array(
        '//includes/templates/js/jquery-1.3.2.min.js',
        '//includes/templates/js/jquery.form.js',
        '//includes/templates/js/jquery.autocomplete.min.js',
        '//includes/templates/js/json.js',
        '//includes/templates/js/jquery.uploadify.v2.1.0.js',
        '//includes/templates/js/swfobject.min.js',
        '//includes/templates/js/jquery.blockui.js',
        '//includes/templates/js/jquery.keyfilter-1.7.min.js',
        '//includes/templates/js/niceforms.js',
        '//includes/templates/js/jquery.filestyle.js',
        '//includes/templates/js/ajaxfileupload.js',
        '//includes/templates/js/jquery.MultiFile.js',
        '//includes/templates/js/jquery.textarea-expander.js',

        '//includes/templates/js/base.js',
        '//includes/templates/js/Classes/System.js',

        '//includes/templates/js/Classes/Users.js',
        '//includes/templates/js/Classes/UsersProgress.js',
        '//includes/templates/js/Classes/UsersHandlers.js',
        '//includes/templates/js/Classes/Friends/Friends.js',
        '//includes/templates/js/Classes/Search.js',
    ),
    'wallbox' => array(
        '//includes/templates/js/jquery.timers.js',
        '//includes/templates/js/Classes/WallProgress.js',
        '//includes/templates/js/Classes/Wall.js',
    )
    //'js' => array('//js/file1.js', '//js/file2.js'),
    // 'css' => array('//css/file1.css', '//css/file2.css'),
);