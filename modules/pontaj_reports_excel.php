<?php

switch ($report_id) {

    case 7:
        foreach ($report as $k => $v) {
            $i = 0;
            foreach ($v['Role'] as $vv) {
                $i++;
                $j = $k . $i;
                if ($i == 1) {
                    $excel[$j]['Cod Proiect'] = $v['Code'];
                    $excel[$j]['Nr. contract'] = $v['ContractNo'];
                    $excel[$j]['Data contract'] = $v['ContractDate'];
                    $excel[$j]['Data inceput'] = $v['Data_Min'];
                    $excel[$j]['Data sfarsit'] = $v['Data_Max'];
                } else {
                    $excel[$j]['Cod Proiect'] = '';
                    $excel[$j]['Nr. contract'] = '';
                    $excel[$j]['Data contract'] = '';
                    $excel[$j]['Data inceput'] = '';
                    $excel[$j]['Data sfarsit'] = '';
                }
                $excel[$j]['Rol'] = $vv['Name'];
                $excel[$j]['Ore'] = $vv['THours'];
                $excel[$j]['Cost'] = '-';
            }
            $j = $j . '1';
            $excel[$j]['Cod Proiect'] = 'TOTAL';
            $excel[$j]['Nr. contract'] = '';
            $excel[$j]['Data contract'] = '';
            $excel[$j]['Data inceput'] = '';
            $excel[$j]['Data sfarsit'] = '';
            $excel[$j]['Rol'] = '';
            $excel[$j]['Ore'] = $v['THours'];
            $excel[$j]['Cost'] = '-';
            $j = $j . '2';
            $excel[$j]['Cod Proiect'] = '';
            $excel[$j]['Nr. contract'] = '';
            $excel[$j]['Data contract'] = '';
            $excel[$j]['Data inceput'] = '';
            $excel[$j]['Data sfarsit'] = '';
            $excel[$j]['Rol'] = '';
            $excel[$j]['Ore'] = '';
            $excel[$j]['Cost'] = '';
        }
        $title = "Raport_pe_lucrare";
        break;

    case 8:
        foreach ($report as $k => $v) {
            $i = 0;
            foreach ($v['Person'] as $vv) {
                $i++;
                $j = $k . $i;
                if ($i == 1) {
                    $excel[$j]['Cod Proiect'] = $v['Code'];
                    $excel[$j]['Nr. contract'] = $v['ContractNo'];
                    $excel[$j]['Data contract'] = $v['ContractDate'];
                    $excel[$j]['Data inceput'] = $v['Data_Min'];
                    $excel[$j]['Data sfarsit'] = $v['Data_Max'];
                } else {
                    $excel[$j]['Cod Proiect'] = '';
                    $excel[$j]['Nr. contract'] = '';
                    $excel[$j]['Data contract'] = '';
                    $excel[$j]['Data inceput'] = '';
                    $excel[$j]['Data sfarsit'] = '';
                }
                $excel[$j]['Angajat'] = $vv['FullName'];
                $excel[$j]['Ore'] = $vv['THours'];
                $excel[$j]['Cost'] = '-';
            }
            $j = $j . '1';
            $excel[$j]['Cod Proiect'] = 'TOTAL';
            $excel[$j]['Nr. contract'] = '';
            $excel[$j]['Data contract'] = '';
            $excel[$j]['Data inceput'] = '';
            $excel[$j]['Data sfarsit'] = '';
            $excel[$j]['Angajat'] = '';
            $excel[$j]['Ore'] = $v['THours'];
            $excel[$j]['Cost'] = '-';
            $j = $j . '2';
            $excel[$j]['Cod Proiect'] = '';
            $excel[$j]['Nr. contract'] = '';
            $excel[$j]['Data contract'] = '';
            $excel[$j]['Data inceput'] = '';
            $excel[$j]['Data sfarsit'] = '';
            $excel[$j]['Angajat'] = '';
            $excel[$j]['Ore'] = '';
            $excel[$j]['Cost'] = '';
        }
        $title = "Raport_pe_angajat";
        break;

    case 9:
        foreach ($report as $k => $v) {
            $i = 0;
            foreach ($v['Phase'] as $kk => $vv) {
                $i++;
                $j = $k . $i;
                if ($i == 1) {
                    $excel[$j]['Cod Proiect'] = $v['Code'];
                    $excel[$j]['Nr. contract'] = $v['ContractNo'];
                    $excel[$j]['Data contract'] = $v['ContractDate'];
                    $excel[$j]['Data inceput'] = $v['Data_Min'];
                    $excel[$j]['Data sfarsit'] = $v['Data_Max'];
                } else {
                    $excel[$j]['Cod Proiect'] = '';
                    $excel[$j]['Nr. contract'] = '';
                    $excel[$j]['Data contract'] = '';
                    $excel[$j]['Data inceput'] = '';
                    $excel[$j]['Data sfarsit'] = '';
                }
                $excel[$j]['Faza'] = $kk;
                $totalp = 0;
                $l = 0;
                foreach ($vv['Activity'] as $kkk => $vvv) {
                    $l++;
                    if ($l > 1) {
                        $j = $j . $l;
                        $excel[$j]['Cod Proiect'] = '';
                        $excel[$j]['Nr. contract'] = '';
                        $excel[$j]['Data contract'] = '';
                        $excel[$j]['Data inceput'] = '';
                        $excel[$j]['Data sfarsit'] = '';
                        $excel[$j]['Faza'] = $kk;
                    }
                    $excel[$j]['Activitate'] = $kkk;
                    $excel[$j]['Ore'] = $vvv['THours'];
                    $excel[$j]['Cost'] = '-';
                    $totalp += $vvv['THours'];
                }
                $j = $j . '1';
                $excel[$j]['Cod Proiect'] = '';
                $excel[$j]['Nr. contract'] = '';
                $excel[$j]['Data contract'] = '';
                $excel[$j]['Data inceput'] = '';
                $excel[$j]['Data sfarsit'] = '';
                $excel[$j]['Faza'] = 'Total faza';
                $excel[$j]['Activitate'] = '';
                $excel[$j]['Ore'] = $totalp;
                $excel[$j]['Cost'] = '-';
            }
            $j = $j . '1';
            $excel[$j]['Cod Proiect'] = 'TOTAL';
            $excel[$j]['Nr. contract'] = '';
            $excel[$j]['Data contract'] = '';
            $excel[$j]['Data inceput'] = '';
            $excel[$j]['Data sfarsit'] = '';
            $excel[$j]['Faza'] = '';
            $excel[$j]['Activitate'] = '';
            $excel[$j]['Ore'] = $v['THours'];
            $excel[$j]['Cost'] = '-';
            $j = $j . '2';
            $excel[$j]['Cod Proiect'] = '';
            $excel[$j]['Nr. contract'] = '';
            $excel[$j]['Data contract'] = '';
            $excel[$j]['Data inceput'] = '';
            $excel[$j]['Data sfarsit'] = '';
            $excel[$j]['Faza'] = '';
            $excel[$j]['Activitate'] = '';
            $excel[$j]['Ore'] = '';
            $excel[$j]['Cost'] = '';
        }
        $title = "Raport_pe_faze";
        break;

    case 10:
        foreach ($report as $k => $v) {
            $i = 0;
            foreach ($v['Activity'] as $kk => $vv) {
                $i++;
                $j = $k . $i;
                if ($i == 1) {
                    $excel[$j]['Cod Proiect'] = $v['Code'];
                    $excel[$j]['Nr. contract'] = $v['ContractNo'];
                    $excel[$j]['Data contract'] = $v['ContractDate'];
                    $excel[$j]['Data inceput'] = $v['Data_Min'];
                    $excel[$j]['Data sfarsit'] = $v['Data_Max'];
                } else {
                    $excel[$j]['Cod Proiect'] = '';
                    $excel[$j]['Nr. contract'] = '';
                    $excel[$j]['Data contract'] = '';
                    $excel[$j]['Data inceput'] = '';
                    $excel[$j]['Data sfarsit'] = '';
                }
                $excel[$j]['Activitate'] = $kk;
                $excel[$j]['Phase'] = $vv['Phase'];
                $excel[$j]['Ore'] = $vv['THours'];
                $excel[$j]['Cost'] = '-';
            }
            $j = $j . '1';
            $excel[$j]['Cod Proiect'] = 'TOTAL';
            $excel[$j]['Nr. contract'] = '';
            $excel[$j]['Data contract'] = '';
            $excel[$j]['Data inceput'] = '';
            $excel[$j]['Data sfarsit'] = '';
            $excel[$j]['Activitate'] = '';
            $excel[$j]['Phase'] = '';
            $excel[$j]['Ore'] = $v['THours'];
            $excel[$j]['Cost'] = '-';
            $j = $j . '2';
            $excel[$j]['Cod Proiect'] = '';
            $excel[$j]['Nr. contract'] = '';
            $excel[$j]['Data contract'] = '';
            $excel[$j]['Data inceput'] = '';
            $excel[$j]['Data sfarsit'] = '';
            $excel[$j]['Activitate'] = '';
            $excel[$j]['Phase'] = '';
            $excel[$j]['Ore'] = '';
            $excel[$j]['Cost'] = '';
        }
        $title = "Raport_pe_activitati";
        break;

    case 11:
        foreach ($report as $k => $v) {
            $excel[$k]['Rol'] = $v['Role'];
            $excel[$k]['Ore'] = $v['THours'];
        }
        $title = "Raport_pe_rol_pe_perioada";
        break;

    case 12:
        foreach ($report as $k => $v) {
            $excel[$k]['Angajat'] = $v['FullName'];
            $excel[$k]['Ore lucrate'] = $v['THours'];
            $excel[$k]['Ore fara activitate'] = $v['THoursFA'];
        }
        $title = "Raport_pe_angajat_pe_perioada";
        break;

    case 13:
        foreach ($report as $k => $v) {
            $excel[$k]['Angajat'] = $v['FullName'];
            $excel[$k]['Data'] = $v['FData'];
            $excel[$k]['Ore lucrate'] = $v['THours'];
        }
        $title = "Raport_pontaj_general";
        break;

    case 14:
        foreach ($report as $k => $v) {
            $excel[$k]['Angajat'] = $v['FullName'];
            $excel[$k]['Data'] = $v['FData'];
        }
        $title = "Raport_pontaj_persoane_care_nu_au_pontat";
        break;

    case 15:
        foreach ($report as $k => $v) {
            $excel[$k]['Angajat'] = $v['FullName'];
            $excel[$k]['Rol'] = $v['Role'];
            $excel[$k]['Data pontaj'] = $v['FData2'];
            $excel[$k]['Cod proiect'] = $v['Code'];
            $excel[$k]['Nr. contract'] = $v['ContractNo'];
            $excel[$k]['Data contract'] = $v['ContractDate'];
            $excel[$k]['Obiect contract'] = $v['Name'];
            $excel[$k]['Faza'] = $v['Phase'];
            $excel[$k]['Activitate'] = $v['Activity'];
            $excel[$k]['Ore pontate'] = $v['Hours'];
            $excel[$k]['Cost'] = '-';
        }
        $title = "RAPORT_GENERAL";
        break;

    case 16:
        foreach ($report as $k => $v) {
            $excel[$k . '_1']['Nume prenume'] = $v['FullName'];
            $excel[$k . '_1']['Tip ore'] = '1.Norm';
            $excel[$k . '_1']['Max'] = $v['MaxNorm'];
            $excel[$k . '_1']['Total'] = $v['TNorm'];
            $i = 0;
            foreach ($cal as $data => $wday) {
                $excel[$k . '_1'][(++$i) . ' ' . $wday] = ($wday == 'S' || $wday == 'D') ? '' : (int)$v['Data'][$data]['Hours_Norm'];
            }
            $excel[$k . '_1']['Ore lucrate normal'] = (int)$v['TNorm'];
            $excel[$k . '_1']['Ore suplimentare'] = (int)$v['TSpl'];
            $excel[$k . '_1']['Ore supl Weekend'] = (int)$v['TSplW'];
            $excel[$k . '_1']['Ore normale'] = (int)$v['TONorm'];
            $excel[$k . '_1']['SPL'] = (int)$v['SPL'];
            $excel[$k . '_1']['Ore noapte'] = (int)$v['TNight'];
            $excel[$k . '_1']['Zile din afara contract'] = (int)$v['TX'];
            $excel[$k . '_1']['Zile CO'] = (int)$v['TCO'];
            $excel[$k . '_1']['Zile CE'] = (int)$v['TCE'];
            $excel[$k . '_1']['Zile CM'] = (int)$v['TCM'];
            $excel[$k . '_1']['Zile CFS'] = (int)$v['TCFS'];
            $excel[$k . '_1']['Zile Absenta'] = (int)$v['TAbs'];
            $excel[$k . '_1']['Zile Invoire'] = (int)$v['TInv'];
            $excel[$k . '_1']['Zile CIC'] = (int)$v['TCIC'];
            $excel[$k . '_1']['Zile T'] = (int)$v['TT'];
            $excel[$k . '_1']['Total zile nelucrate'] = (int)$v['TNelucr'];

            $excel[$k . '_2']['Nume prenume'] = $v['FullName'];
            $excel[$k . '_2']['Tip ore'] = '2.SPL';
            $excel[$k . '_2']['Max'] = $v['MaxSPL'];
            $excel[$k . '_2']['Total'] = $v['SPL'];
            $i = 0;
            foreach ($cal as $data => $wday) {
                $excel[$k . '_2'][(++$i) . ' ' . $wday] = ($wday == 'S' || $wday == 'D') ? '' : 0;
            }
            $excel[$k . '_2']['Ore lucrate normal'] = '';
            $excel[$k . '_2']['Ore suplimentare'] = '';
            $excel[$k . '_2']['Ore supl Weekend'] = '';
            $excel[$k . '_2']['Ore normale'] = '';
            $excel[$k . '_2']['SPL'] = '';
            $excel[$k . '_2']['Ore noapte'] = '';
            $excel[$k . '_2']['Zile din afara contract'] = '';
            $excel[$k . '_2']['Zile CO'] = '';
            $excel[$k . '_2']['Zile CE'] = '';
            $excel[$k . '_2']['Zile CM'] = '';
            $excel[$k . '_2']['Zile CFS'] = '';
            $excel[$k . '_2']['Zile Absenta'] = '';
            $excel[$k . '_2']['Zile Invoire'] = '';
            $excel[$k . '_2']['Zile CIC'] = '';
            $excel[$k . '_2']['Zile T'] = '';
            $excel[$k . '_2']['Total zile nelucrate'] = '';

            $excel[$k . '_3']['Nume prenume'] = $v['FullName'];
            $excel[$k . '_3']['Tip ore'] = '3.Noapte';
            $excel[$k . '_3']['Max'] = $v['MaxNight'];
            $excel[$k . '_3']['Total'] = $v['TNight'];
            $i = 0;
            foreach ($cal as $data => $wday) {
                $excel[$k . '_3'][(++$i) . ' ' . $wday] = ($wday == 'S' || $wday == 'D') ? '' : (int)$v['Data'][$data]['Hours_Night'];
            }
            $excel[$k . '_3']['Ore lucrate normal'] = '';
            $excel[$k . '_3']['Ore suplimentare'] = '';
            $excel[$k . '_3']['Ore supl Weekend'] = '';
            $excel[$k . '_3']['Ore normale'] = '';
            $excel[$k . '_3']['SPL'] = '';
            $excel[$k . '_3']['Ore noapte'] = '';
            $excel[$k . '_3']['Zile din afara contract'] = '';
            $excel[$k . '_3']['Zile CO'] = '';
            $excel[$k . '_3']['Zile CE'] = '';
            $excel[$k . '_3']['Zile CM'] = '';
            $excel[$k . '_3']['Zile CFS'] = '';
            $excel[$k . '_3']['Zile Absenta'] = '';
            $excel[$k . '_3']['Zile Invoire'] = '';
            $excel[$k . '_3']['Zile CIC'] = '';
            $excel[$k . '_3']['Zile T'] = '';
            $excel[$k . '_3']['Total zile nelucrate'] = '';

            $excel[$k . '_4']['Nume prenume'] = $v['FullName'];
            $excel[$k . '_4']['Tip ore'] = '4.Nelucr';
            $excel[$k . '_4']['Max'] = 0;
            $excel[$k . '_4']['Total'] = $v['TNelucr'];
            $i = 0;
            foreach ($cal as $data => $wday) {
                $excel[$k . '_4'][(++$i) . ' ' . $wday] = ($wday == 'S' || $wday == 'D') ? '' : (!empty($v['Data'][$data]['Nelucr']) ? $v['Data'][$data]['Nelucr'] : 0);
            }
            $excel[$k . '_4']['Ore lucrate normal'] = '';
            $excel[$k . '_4']['Ore suplimentare'] = '';
            $excel[$k . '_4']['Ore supl Weekend'] = '';
            $excel[$k . '_4']['Ore normale'] = '';
            $excel[$k . '_4']['SPL'] = '';
            $excel[$k . '_4']['Ore noapte'] = '';
            $excel[$k . '_4']['Zile din afara contract'] = '';
            $excel[$k . '_4']['Zile CO'] = '';
            $excel[$k . '_4']['Zile CE'] = '';
            $excel[$k . '_4']['Zile CM'] = '';
            $excel[$k . '_4']['Zile CFS'] = '';
            $excel[$k . '_4']['Zile Absenta'] = '';
            $excel[$k . '_4']['Zile Invoire'] = '';
            $excel[$k . '_4']['Zile CIC'] = '';
            $excel[$k . '_4']['Zile T'] = '';
            $excel[$k . '_4']['Total zile nelucrate'] = '';

            $excel[$k . '_5']['Nume prenume'] = '';
            $excel[$k . '_5']['Tip ore'] = '';
            $excel[$k . '_5']['Max'] = '';
            $excel[$k . '_5']['Total'] = '';
            $i = 0;
            foreach ($cal as $data => $wday) {
                $excel[$k . '_5'][(++$i) . ' ' . $wday] = '';
            }
            $excel[$k . '_5']['Ore lucrate normal'] = '';
            $excel[$k . '_5']['Ore suplimentare'] = '';
            $excel[$k . '_5']['Ore supl Weekend'] = '';
            $excel[$k . '_5']['Ore normale'] = '';
            $excel[$k . '_5']['SPL'] = '';
            $excel[$k . '_5']['Ore noapte'] = '';
            $excel[$k . '_5']['Zile din afara contract'] = '';
            $excel[$k . '_5']['Zile CO'] = '';
            $excel[$k . '_5']['Zile CE'] = '';
            $excel[$k . '_5']['Zile CM'] = '';
            $excel[$k . '_5']['Zile CFS'] = '';
            $excel[$k . '_5']['Zile Absenta'] = '';
            $excel[$k . '_5']['Zile Invoire'] = '';
            $excel[$k . '_5']['Zile CIC'] = '';
            $excel[$k . '_5']['Zile T'] = '';
            $excel[$k . '_5']['Total zile nelucrate'] = '';
        }
        $title = "RAPORT_PONTAJ_PERSONAL";
        break;

    case 17:
    case 18:
    case 19:
    case 21:
        header("Content-Type: application/vnd.ms-excel");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("content-disposition: attachment;filename=raport_pontaj_$report_id.xls");
        $smarty->assign(array(
            'report' => $report,
            'cal' => $cal,
        ));
        $content = $smarty->fetch('pontaj_reports_print.tpl');
        $content = preg_replace("/<img[^>]+\>/i", "", $content);
        echo $content;
        exit;
        break;

    default:
        $persons = Pontaj::getPersonsByPontaj();
        $projects = Pontaj::getProjectsByPontaj();
        foreach ($report as $k => $v) {
            $excel[$k]['Proiect'] = $projects[$v['ProjectID']];
            $excel[$k]['Cod Proiect'] = $v['Code'];
            $excel[$k]['Faza'] = $v['Phase'];
            $excel[$k]['Activitate'] = $v['Activity'];
            $excel[$k]['Faze activitate'] = $v['PhaseAct'];
            $excel[$k]['Perioada activitate'] = $v['StartDate'] . ' - ' . $v['EndDate'];
            $excel[$k]['Angajat'] = $persons[$v['PersonID']];
            $excel[$k]['Numar total ore'] = $v['THours'];
        }
        $title = "Raport_de_activitate_pe_perioada_{$_GET['StartDate']}_{$_GET['EndDate']}";
        break;
}

?>