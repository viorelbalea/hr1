<?php

$content   = file_get_contents('http://www.softsource.ro/_hrs/update-versions/version.txt');
$info      = explode('[CHANGELOG]', $content);
$version   = trim(str_replace('[VERSION]', '', $info[0]));
$changelog = trim($info[1]);
unset($info);

$versions  = file('versions.txt');
foreach ((array)$versions as $v) {
    if ($version == trim($v)) {
	exit;
    }
}
if($version != '') {
    ?>
    <div style="margin: 5px 0 5px 0; padding: 10px; border: 1px solid #b11618; background-color: #ea8177;" align="center"><b>Versiune <?= $version ?></b><br><?= $changelog ?>&nbsp;&nbsp;&nbsp;[&nbsp;<a
                href="#" onclick="showInfo('./update/update.php', 'checkversion'); return false;">Instaleaza</a>&nbsp;]
    </div>
    <?php
}