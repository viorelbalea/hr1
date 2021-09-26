<?php

exit;

function __autoload($className) {
    include('../libs/' . $className . '.php');
}

$m = new XPM3_MAIL;
$m->Relay('mail.eptisa.es', 'alerta_hr', '6348Kmj', null, null) or die('Can\'t connect to Relay SMTP Mail Server !');
$m->Delivery('relay');
$m->From('alerta_hr@eptisa.com', 'Alerte');
$m->AddTo('bogdan_marinache@yahoo.com', 'Bogdan Marinache');
$m->Html('Content');
$m->Send('Mesaj de test');
$m->Quit();

?>