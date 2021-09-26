<?php

function FCKeditor_IsCompatibleBrowser()
{
    global $HTTP_USER_AGENT;

    if (!isset($_SERVER)) {
        global $HTTP_SERVER_VARS;
        $_SERVER = $HTTP_SERVER_VARS;
    }

    if (isset($HTTP_USER_AGENT))
        $sAgent = $HTTP_USER_AGENT;
    else
        $sAgent = $_SERVER['HTTP_USER_AGENT'];

    if (strpos($sAgent, 'MSIE') !== false && strpos($sAgent, 'mac') === false && strpos($sAgent, 'Opera') === false) {
        $iVersion = (float)substr($sAgent, strpos($sAgent, 'MSIE') + 5, 3);
        return ($iVersion >= 5.5);
    } else if (strpos($sAgent, 'Gecko/') !== false) {
        $iVersion = (int)substr($sAgent, strpos($sAgent, 'Gecko/') + 6, 8);
        return ($iVersion >= 20030210);
    } else if (strpos($sAgent, 'Opera/') !== false) {
        $fVersion = (float)substr($sAgent, strpos($sAgent, 'Opera/') + 6, 4);
        return ($fVersion >= 9.5);
    } else if (preg_match("|AppleWebKit/(\d+)|i", $sAgent, $matches)) {
        $iVersion = $matches[1];
        return ($matches[1] >= 522);
    } else
        return false;
}

$basedir = 'js/fck/';
//echo $basedir;
// if ( !function_exists('version_compare') || version_compare( phpversion(), '5', '<' ) )
include_once($basedir . 'fckeditor_php4.php');
//else
//	include_once( $basedir.'fckeditor_php5.php' ) ;

?>
