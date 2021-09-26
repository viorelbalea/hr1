<?php

	if($_POST) { print_r($_POST); exit();	}

print_r($_POST);
include("fckeditor.php") ;
?>
		<form action="" method="post" target="_blank">
		<div style='width:780px; height:500px;'>
<?php
$sBasePath = $_SERVER['PHP_SELF'] ;
$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;

$oFCKeditor = new FCKeditor('FCKeditor1') ;
$oFCKeditor->BasePath	= srvd.'pages/js/fck/';
$oFCKeditor->Value		= '<p>This is some <strong>sample text</strong>. You are using <a href="http://www.fckeditor.net/">FCKeditor</a>.</p>' ;
$oFCKeditor->Create() ;
?></div>
			<br>
			<input type="submit" value="Submit">
		</form>