<?
include "libs/sendMail.php";
include_once('libs/class.phpmailer.php');
include_once('libs/Config.php');

$undeBack=urldecode($_GET['urlreturn']);

$context=str_replace('senddocumentbymail.php','',$_SERVER['PHP_SELF']);
$doc='http://'.$_SERVER['SERVER_NAME'].$context.$_GET['doc'];
$textEmail='Buna ziua, ati primit urmatorul fisier: 
<a href="'.$doc.'">click aici pentru download</a>.';

sendMail('hre', 'hre@'.$_SERVER['SERVER_NAME'], $_GET['mail'], $_GET['mail'], 'Ati primit un fisier din HRE', $textEmail);
//die();
echo '<script>document.location=\'index.php'.$undeBack.'&alertemailsent=1\'; </script>';
?>