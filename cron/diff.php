<?php

exit;

$StartDate   = '2009-03-14';
$EndDate     = '2010-03-13';

$months = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
if (!(((int)$EndDate)%4)) {
    $months[1] = 29;
}

$DeltaYY     = (int)$EndDate - (int)$StartDate;
$Anniversary = date('Y-m-d', mktime(0, 0, 0, (int)substr($StartDate, 5, 2), (int)substr($StartDate, 8, 2), (int)$StartDate + $DeltaYY));
$YYDelta     = $DeltaYY - ($Anniversary > $EndDate ? 1 : 0);

$MMDelta     = (int)substr($EndDate, 5, 2) - (int)substr($Anniversary, 5, 2);
if ($MMDelta < 0) {
    $MMDelta+= 12;
}
$DDDelta     = (int)substr($EndDate, 8, 2) - (int)substr($Anniversary, 8, 2);
if ($DDDelta < 0) {
    $MMDelta--;
    $DDDelta+= $months[(int)date('m', mktime(0, 0, 0, (int)substr($EndDate, 5, 2) - 1, (int)substr($EndDate, 8, 2), (int)$EndDate)) - 1];
    if ($MMDelta < 0) {
	$MMDelta = 11;
    }
}

echo "$YYDelta / $MMDelta / $DDDelta";

?>