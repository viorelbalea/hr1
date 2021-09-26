<?php

$content     = file_get_contents('http://www.softsource.ro/_hrs/update-versions/version.txt');
$info        = explode('[CHANGELOG]', $content);
$version     = trim(str_replace('[VERSION]', '', $info[0]));
unset($info);

$update_file = file_get_contents('http://www.softsource.ro/_hrs/update-versions/' . $version . '.zip');
if(!$update_file){
    echo '<div style="margin-top: 10px; padding: 10px; border: 1px solid #b11618; background-color: #ea8177;" align="center">Eroare update la versiunea ' . $version . '</div>';
    exit;
}
$zip_dir     = 'versions/' . $version;
$zip_file    = $zip_dir . '.zip';
file_put_contents($zip_file, $update_file);
$zip = new ZipArchive;
$res = $zip->open($zip_file);
if ($res === TRUE) {
    $zip->extractTo($zip_dir . '/');
    $zip->close();
} else {
    echo '<div style="margin-top: 10px; padding: 10px; border: 1px solid #b11618; background-color: #ea8177;" align="center">Eroare update la versiunea ' . $version . '</div>';
    exit;
}

$backup = 'backup/' . $version;
if (!is_dir($backup)) {
    mkdir($backup . '/' . $entry, 0777);
}
copy_dir($zip_dir, '..', $backup);

if (file_exists($zip_dir . '/update.sql')) {
    include('../libs/Config.php');
    passthru("nohup mysqldump -u " . Config::MYSQL_USER . " -p" . Config::MYSQL_PASS . " " . Config::MYSQL_DBNAME. " > " . $backup . '/dump.sql');
    passthru("nohup mysql -u " . Config::MYSQL_USER . " -p" . Config::MYSQL_PASS . " " . Config::MYSQL_DBNAME. " < " . $zip_dir . '/update.sql');
}

file_put_contents('versions.txt', $version . "\r\n", FILE_APPEND);

function copy_dir($source, $dest, $backup) {
    $dir = dir($source);
    while (false !== $entry = $dir->read()) {
	if ($entry == "." || $entry == ".." || $entry == "update.sql") {
    	    continue;
	}
	if (is_dir($source . '/' . $entry)) {
	    if (!is_dir($backup . '/' . $entry)) {
		mkdir($backup . '/' . $entry, 0777);
	    }
	    if (!is_dir($dest . '/' . $entry)) {
		mkdir($dest . '/' . $entry, 0777);
	    }
	    copy_dir($dest . '/' . $entry, $backup . '/' . $entry, $backup . '/' . $entry);
	    copy_dir($source . '/' . $entry, $dest . '/' . $entry, $backup . '/' . $entry);
	} else {
	    copy($dest . '/' . $entry, $backup . '/' . $entry);
	    copy($source . '/' . $entry, $dest . '/' . $entry);
	}
    }
    $dir->close();
}

?>
<div style="margin-top: 10px; padding: 10px; border: 1px solid #018178; background-color: #a6dbc1;" align="center">Update la versiunea <?=$version?> realizat cu succes!</div>