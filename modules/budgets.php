<?php

if (!isset($_SESSION['USER_ID'])) {
    header('Location: ../');
    exit;
}

switch ($_GET['o']) {

    case 'planned':

        if (!empty($_GET['year'])) {

            if (!empty($_POST)) {
                foreach ($_POST['b'] as $DepartmentID => $v) {
                    $conn->query("DELETE FROM budget_planned WHERE year = '{$_GET['year']}' AND DepartmentID = $DepartmentID");
                    foreach ($v as $month => $vv) {
                        echo $query = "INSERT INTO budget_planned(year, month, DepartmentID, s1, s2, s3, s4, s5, b1, b2, b3, b4, b5, b6, b7, b8, b9, b10, b11, b12, b13) 
			                  VALUES('{$_GET['year']}', $month, $DepartmentID, '{$vv['s1']}', '{$vv['s2']}', '{$vv['s3']}', '{$vv['s4']}','{$vv['s5']}',
					         '{$vv['b1']}', '{$vv['b2']}', '{$vv['b3']}', '{$vv['b4']}', '{$vv['b5']}', '{$vv['b6']}', '{$vv['b7']}', 
					         '{$vv['b8']}', '{$vv['b9']}', '{$vv['b10']}', '{$vv['b11']}', '{$vv['b12']}', '{$vv['b13']}')";
                        $conn->query($query);

                    }

                }
                header('Location: ./?m=budgets&o=planned&year=' . $_GET['year'] . '&CompanyID=' . $_GET['CompanyID']);
                exit;
            }

            $cond = !empty($_GET['CompanyID']) ? " AND a.CompanyID = '{$_GET['CompanyID']}'" : "";
            $deps = array();
            $budget = array();

            $conn->query("SELECT DISTINCT a.DivisionID, a.DepartmentID FROM payroll a WHERE 1=1 $cond");
            while ($row = $conn->fetch_array()) {
                if (empty($row['DivisionID']) || empty($row['DepartmentID'])) {
                    continue;
                }
                $persons[$row['DivisionID']][$row['DepartmentID']] = 1;
                $deps[$row['DepartmentID']] = 1;
            }

            $conn->query("SELECT * FROM budget_planned WHERE year = '{$_GET['year']}' AND DepartmentID IN (" . (!empty($deps) ? implode(',', array_keys($deps)) : 0) . ")");
            while ($row = $conn->fetch_array()) {
                $budget[$row['DepartmentID']][$row['month']] = $row;
                $budget[$row['DepartmentID']][$row['month']]['total'] = $row['s1'] + $row['s2'] + $row['s3'] + $row['s4'] + $row['s5'] +
                    $row['b1'] + $row['b2'] + $row['b3'] + $row['b4'] +
                    $row['b5'] + $row['b6'] + $row['b7'] + $row['b8'] + $row['b9'] + $row['b10'] + $row['b11'] + $row['b12'] + $row['b13'];
            }

            $smarty->assign(array(
                'months' => array(1 => 'Ian', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mai', 6 => 'Iun', 7 => 'Iul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Noi', 12 => 'Dec'),
                'persons' => $persons,
                'divisions' => Utils::getDivisions(),
                'departments' => Utils::getDepartments(),
                'budget' => $budget,
            ));
        }

        $smarty->assign(array(
            'years' => range(date('Y'), 2011),
            'self' => Company::getSelfCompanies(),
        ));
        if (!empty($_GET['export_doc'])) {
            header("Content-Type: application/vnd.ms-word");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("content-disposition: attachment;filename=budget_planned.doc");

            $content = $smarty->fetch('budget_planned_print.tpl');
            $content = preg_replace("/<img[^>]+\>/i", "", $content);
            echo $content;
            exit;
        }

        if (!empty($_GET['export'])) {
            header("Content-Type: application/vnd.ms-excel");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("content-disposition: attachment;filename=budget_planned.xls");

            $content = $smarty->fetch('budget_planned_print.tpl');
            $content = preg_replace("/<img[^>]+\>/i", "", $content);
            echo $content;
            exit;
        }

        if (!empty($_GET['print'])) {
            $smarty->display('budget_planned_print.tpl');
            exit;
        }
        $center_file = 'budget_planned.tpl';

        break;

    case 'compare':

        if (!empty($_GET['year'])) {

            $cond = !empty($_GET['CompanyID']) ? " AND a.CompanyID = '{$_GET['CompanyID']}'" : "";
            $deps = array();
            $budget = array();

            $conn->query("SELECT DISTINCT a.DivisionID, a.DepartmentID FROM payroll a WHERE 1=1 $cond");
            while ($row = $conn->fetch_array()) {
                if (empty($row['DivisionID']) || empty($row['DepartmentID'])) {
                    continue;
                }
                $persons[$row['DivisionID']][$row['DepartmentID']] = 1;
                $deps[$row['DepartmentID']] = 1;
            }

            $conn->query("SELECT * 
		              FROM   budget_planned 
		              WHERE  year = '{$_GET['year']}' AND month <= '{$_GET['month']}' AND
			             DepartmentID IN (" . (!empty($deps) ? implode(',', array_keys($deps)) : 0) . ")");
            while ($row = $conn->fetch_array()) {
                if ($row['month'] == $_GET['month']) {
                    $budget[$row['DepartmentID']][$row['month']] = $row;
                    $budget[$row['DepartmentID']][$row['month']]['total'] = $row['s1'] + $row['s2'] + $row['s3'] + $row['s4'] + $row['s5'] +
                        $row['b1'] + $row['b2'] + $row['b3'] + $row['b4'] +
                        $row['b5'] + $row['b6'] + $row['b7'] + $row['b8'] + $row['b9'] + $row['b10'] + $row['b11'] + $row['b12'] + $row['b13'];
                } else {
                    @$budget[$row['DepartmentID']]['before']['s1'] += $row['s1'];
                    @$budget[$row['DepartmentID']]['before']['s2'] += $row['s2'];
                    @$budget[$row['DepartmentID']]['before']['s3'] += $row['s3'];
                    @$budget[$row['DepartmentID']]['before']['s4'] += $row['s4'];
                    @$budget[$row['DepartmentID']]['before']['s5'] += $row['s5'];
                    @$budget[$row['DepartmentID']]['before']['b1'] += $row['b1'];
                    @$budget[$row['DepartmentID']]['before']['b2'] += $row['b2'];
                    @$budget[$row['DepartmentID']]['before']['b3'] += $row['b3'];
                    @$budget[$row['DepartmentID']]['before']['b4'] += $row['b4'];
                    @$budget[$row['DepartmentID']]['before']['b5'] += $row['b5'];
                    @$budget[$row['DepartmentID']]['before']['b6'] += $row['b6'];
                    @$budget[$row['DepartmentID']]['before']['b7'] += $row['b7'];
                    @$budget[$row['DepartmentID']]['before']['b8'] += $row['b8'];
                    @$budget[$row['DepartmentID']]['before']['b9'] += $row['b9'];
                    @$budget[$row['DepartmentID']]['before']['b10'] += $row['b10'];
                    @$budget[$row['DepartmentID']]['before']['b11'] += $row['b11'];
                    @$budget[$row['DepartmentID']]['before']['b12'] += $row['b12'];
                    @$budget[$row['DepartmentID']]['before']['b13'] += $row['b13'];
                    @$budget[$row['DepartmentID']]['before']['total'] += $row['s1'] + $row['s2'] + $row['s3'] + $row['s4'] + $row['s5'] +
                        $row['b1'] + $row['b2'] + $row['b3'] + $row['b4'] +
                        $row['b5'] + $row['b6'] + $row['b7'] + $row['b8'] + $row['b9'] + $row['b10'] + $row['b11'] + $row['b12'] + $row['b13'];
                }
            }
            $MonthSel = $_GET['year'] . '-' . ($_GET['month'] <= 9 ? '0' . $_GET['month'] : $_GET['month']);
            $conn->query("SELECT b.DepartmentID, a.Month, a.Type, SUM(a.Salary) AS TSalary
		              FROM   budget_consumed a
			             INNER JOIN payroll b ON a.PersonID = b.PersonID AND b.DepartmentID IN (" . (!empty($deps) ? implode(',', array_keys($deps)) : 0) . ")
		              WHERE  a.Month >= '{$_GET['year']}-01' AND a.Month <= '$MonthSel'
			      GROUP  BY b.DepartmentID, a.Month, a.Type");
            while ($row = $conn->fetch_array()) {
                if ($row['Month'] == $MonthSel) {
                    $budgetc[$row['DepartmentID']][$_GET['month']][$row['Type']] = round($row['TSalary'], 0);
                    @$budgetc[$row['DepartmentID']][$_GET['month']]['total'] += round($row['TSalary'], 0);
                } else {
                    @$budgetc[$row['DepartmentID']]['before'][$row['Type']] += round($row['TSalary'], 0);
                    @$budgetc[$row['DepartmentID']]['before']['total'] += round($row['TSalary'], 0);
                }
            }

            $smarty->assign(array(
                'persons' => $persons,
                'divisions' => Utils::getDivisions(),
                'departments' => Utils::getDepartments(),
                'budget' => $budget,
                'budgetc' => $budgetc,
            ));
        }

        $smarty->assign(array(
            'years' => range(date('Y'), date('Y') - 3),
            'months' => array(1 => 'Ian', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mai', 6 => 'Iun', 7 => 'Iul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Noi', 12 => 'Dec'),
            'self' => Company::getSelfCompanies(),
        ));
        if (!empty($_GET['export_doc'])) {
            header("Content-Type: application/vnd.ms-word");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("content-disposition: attachment;filename=budget_compare.doc");

            $content = $smarty->fetch('budget_compare_print.tpl');
            $content = preg_replace("/<img[^>]+\>/i", "", $content);
            echo $content;
            exit;
        }

        if (!empty($_GET['export'])) {
            header("Content-Type: application/vnd.ms-excel");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("content-disposition: attachment;filename=budget_compare.xls");

            $content = $smarty->fetch('budget_compare_print.tpl');
            $content = preg_replace("/<img[^>]+\>/i", "", $content);
            echo $content;
            exit;
        }

        if (!empty($_GET['print'])) {
            $smarty->display('budget_compare_print.tpl');
            exit;
        }
        $center_file = 'budget_compare.tpl';

        break;

    case 'consumed':
        if (!empty($_GET['export_doc'])) {
            //ob_clean();
            //flush();
            header("Content-Type: application/vnd.ms-word");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("content-disposition: attachment;filename=budget_consumed.doc");
        }
        //Utils::pa($_SESSION);
        echo "<div id='loading' style='position:absolute; width:97%;top:300px; color:#333; text-align:center; background-color:#FFF; padding:12px;'>x</div> ";
        echo "<script type='text/javascript'>document.getElementById('loading').innerHTML = '<img src=images/loader.gif></img><br><br>Se verifica datele...';</script>";
        flush();
        ob_flush();

        $benefits = Budget::$msBenefits;
        //Utils::pa($_SESSION);
        $currency = empty($_GET['Currency']) ? $_SESSION['CURRENCY']['CURRENT'] : $_GET['Currency'];
        $exrate = empty($_GET['Currency']) || empty($_SESSION['CURRENCY']['RATES'][date('Y')][$currency]['Rate']) ? 1 : $_SESSION['CURRENCY']['RATES'][date('Y')][$currency]['Rate'];

        $StartDate = Budget::getConsumedStartDate();
        $EndDate = Budget::getConsumedEndDate();

        if (!empty($_GET['CompanyID'])) {
            $cond = " AND a.CompanyID={$_GET['CompanyID']} ";
            $depcond = " AND b.CompanyID={$_GET['CompanyID']} ";
            $perscond = " AND b.CompanyID={$_GET['CompanyID']} ";
        }


        if ($_GET['new'] == 1) {
            echo "<script type='text/javascript'>document.getElementById('loading').innerHTML = '<img src=images/loader.gif></img><br><br>Se actualizeaza datele...';</script>";
            flush();
            ob_flush();

            ## Update last generated date
            Budget::updateConsumedLastGeneratedDate();

            ## Delete current Report data
            Budget::deleteBudgetConsumedData();

            ## Start Budget Report Generation
            $conn->query("SELECT a.PersonID FROM persons a
		 				LEFT JOIN payroll b ON a.PersonID=b.PersonID
		 				LEFT JOIN departments c ON b.DepartmentID=c.DepartmentID
                         WHERE 1=1");
            while ($row = $conn->fetch_array()) {
                $persons[] = $row['PersonID'];
            }

            echo "<script type='text/javascript'>document.getElementById('loading').innerHTML = '<img src=images/loader.gif></img><br><br>Se colecteaza datele curente...';</script>";
            flush();
            ob_flush();
            foreach ($persons as $person) {
                $persons_salary_cost[$person] = Budget::computePersonSalaryMonthlyCost($person, $currency, $StartDate, $EndDate);
                $persons_displacement_cost[$person] = Budget::computePersonDisplacementMonthlyCost($person, $currency, $StartDate, $EndDate);
                $persons_pfa_cost[$person] = Budget::computePersonPFAMonthlyCost($person, $currency, $StartDate, $EndDate);
                $persons_bonus_cost[$person] = Budget::computePersonBonusMonthlyCost($person, $currency, $StartDate, $EndDate);
                $persons_malus_cost[$person] = Budget::computePersonMalusMonthlyCost($person, $currency, $StartDate, $EndDate);
                $persons_b1[$person] = Budget::computePersonBenefitsMonthlyCost($person, $currency, 1, $StartDate, $EndDate);
                $persons_b2[$person] = Budget::computePersonBenefitsMonthlyCost($person, $currency, 2, $StartDate, $EndDate);
                $persons_b3[$person] = Budget::computePersonBenefitsMonthlyCost($person, $currency, 3, $StartDate, $EndDate);
                $persons_b4[$person] = Budget::computePersonBenefitsMonthlyCost($person, $currency, 4, $StartDate, $EndDate);
                $persons_b5[$person] = Budget::computePersonBenefitsMonthlyCost($person, $currency, 5, $StartDate, $EndDate);
                $persons_b6[$person] = Budget::computePersonBenefitsMonthlyCost($person, $currency, 6, $StartDate, $EndDate);
                $persons_b7[$person] = Budget::computePersonBenefitsMonthlyCost($person, $currency, 7, $StartDate, $EndDate);
                $persons_b8[$person] = Budget::computePersonBenefitsMonthlyCost($person, $currency, 8, $StartDate, $EndDate);
                $persons_b9[$person] = Budget::computePersonBenefitsMonthlyCost($person, $currency, 9, $StartDate, $EndDate);
                $persons_b10[$person] = Budget::computePersonBenefitsMonthlyCost($person, $currency, 10, $StartDate, $EndDate);
                $persons_b11[$person] = Budget::computePersonBenefitsMonthlyCost($person, $currency, 11, $StartDate, $EndDate);
                $persons_b12[$person] = Budget::computePersonBenefitsMonthlyCost($person, $currency, 12, $StartDate, $EndDate);
                $persons_b13[$person] = Budget::computePersonBenefitsMonthlyCost($person, $currency, 13, $StartDate, $EndDate);
            }
            //Utils::pa($persons_b10);
            // Inserare Salarii
            echo "<script type='text/javascript'>document.getElementById('loading').innerHTML = '<img src=images/loader.gif></img><br><br>Se actualizeaza datele...salarii';</script>";
            flush();
            ob_flush();
            // Inserare salariu
            foreach ($persons_salary_cost as $person => $costs) {
                foreach ($costs as $month => $value) {
                    $quarter = Utils::quarterByDate($month);
                    $query = "INSERT INTO budget_consumed SET 
						PersonID='$person', 
						CompanyID=(SELECT CompanyID FROM payroll WHERE PersonID='$person' LIMIT 1), 
						Month='$month', 
						Quarter='$quarter', 
						Salary='$value', 
						Type='salary',
						Currency='$currency'";
                    $conn->query($query);
                }
            }

            // Inserare Deplasari
            echo "<script type='text/javascript'>document.getElementById('loading').innerHTML = '<img src=images/loader.gif></img><br><br>Se actualizeaza datele...deplasari';</script>";
            flush();
            ob_flush();
            // Inserare salariu
            foreach ($persons_displacement_cost as $person => $costs) {
                foreach ($costs as $month => $value) {
                    $quarter = Utils::quarterByDate($month);
                    $query = "INSERT INTO budget_consumed SET 
						PersonID='$person', 
						CompanyID=(SELECT CompanyID FROM payroll WHERE PersonID='$person' LIMIT 1), 
						Month='$month', 
						Quarter='$quarter', 
						Salary='$value', 
						Type='displacement',
						Currency='$currency'";
                    $conn->query($query);
                }
            }

            echo "<script type='text/javascript'>document.getElementById('loading').innerHTML = '<img src=images/loader.gif></img><br><br>Se actualizeaza datele...contracte PFA';</script>";
            flush();
            ob_flush();
            // Inserare PFA
            foreach ($persons_pfa_cost as $person => $costs) {
                foreach ($costs as $month => $value) {
                    $quarter = Utils::quarterByDate($month);
                    $query = "INSERT INTO budget_consumed SET 
						PersonID='$person', 
						CompanyID=(SELECT CompanyID FROM payroll WHERE PersonID='$person' LIMIT 1), 
						Month='$month', 
						Quarter='$quarter', 
						Salary='$value', 
						Type='contract',
						Currency=(SELECT Currency FROM persons_salary_pfa WHERE PersonID='$person' AND $month >=DATE_FORMAT(StartDate, '%m-%Y') LIMIT 1)";
                    $conn->query($query);
                }
            }

            echo "<script type='text/javascript'>document.getElementById('loading').innerHTML = '<img src=images/loader.gif></img><br><br>Se actualizeaza datele...bonusuri';</script>";
            flush();
            ob_flush();
            // Inserare bonus
            foreach ($persons_bonus_cost as $person => $costs) {
                foreach ($costs as $month => $value) {
                    $quarter = Utils::quarterByDate($month);
                    $query = "INSERT INTO budget_consumed SET 
						PersonID='$person', 
						CompanyID=(SELECT CompanyID FROM payroll WHERE PersonID='$person' LIMIT 1), 
						Month='$month', 
						Quarter='$quarter', 
						Salary='$value', 
						Type='bonus',
						Currency=(SELECT Currency FROM persons_salary_extra WHERE PersonID='$person' AND Type='bonus'  AND $month >=DATE_FORMAT(StartDate, '%m-%Y') LIMIT 1)";
                    $conn->query($query);
                }
            }

            echo "<script type='text/javascript'>document.getElementById('loading').innerHTML = '<img src=images/loader.gif></img><br><br>Se actualizeaza datele...penalizari';</script>";
            flush();
            ob_flush();
            // Inserare malus
            foreach ($persons_malus_cost as $person => $costs) {
                foreach ($costs as $month => $value) {
                    $quarter = Utils::quarterByDate($month);
                    $query = "INSERT INTO budget_consumed SET 
						PersonID='$person', 
						CompanyID=(SELECT CompanyID FROM payroll WHERE PersonID='$person' LIMIT 1), 
						Month='$month', 
						Quarter='$quarter', 
						Salary=-'$value', 
						Type='malus',
						Currency=(SELECT Currency FROM persons_salary_extra WHERE PersonID='$person' AND Type='malus' AND $month >=DATE_FORMAT(StartDate, '%m-%Y') LIMIT 1)";
                    $conn->query($query);
                }
            }

            echo "<script type='text/javascript'>document.getElementById('loading').innerHTML = '<img src=images/loader.gif></img><br><br>Se actualizeaza datele...beneficii';</script>";
            flush();
            ob_flush();
            // Inserare beneficiu sanatate
            foreach ($persons_b1 as $person => $costs) {
                foreach ($costs as $month => $value) {
                    $quarter = Utils::quarterByDate($month);
                    $query = "INSERT INTO budget_consumed SET 
						PersonID='$person', 
						CompanyID=(SELECT CompanyID FROM payroll WHERE PersonID='$person' LIMIT 1), 
						Month='$month', 
						Quarter='$quarter', 
						Salary='$value', 
						Type='1',
						Currency=(SELECT Currency FROM persons_beneficii WHERE PersonID='$person' AND Type='1' AND $month >=DATE_FORMAT(RegDate, '%m-%Y') LIMIT 1)";
                    $conn->query($query);
                }
            }

            // Inserare beneficiu asig viata
            foreach ($persons_b2 as $person => $costs) {
                foreach ($costs as $month => $value) {
                    $quarter = Utils::quarterByDate($month);
                    $query = "INSERT INTO budget_consumed SET 
						PersonID='$person', 
						CompanyID=(SELECT CompanyID FROM payroll WHERE PersonID='$person' LIMIT 1), 
						Month='$month', 
						Quarter='$quarter', 
						Salary='$value', 
						Type='2',
						Currency=(SELECT Currency FROM persons_beneficii WHERE PersonID='$person' AND Type='2' AND $month >=DATE_FORMAT(RegDate, '%m-%Y') LIMIT 1)";
                    $conn->query($query);
                }
            }

            // Inserare beneficiu pensie
            foreach ($persons_b3 as $person => $costs) {
                foreach ($costs as $month => $value) {
                    $quarter = Utils::quarterByDate($month);
                    $query = "INSERT INTO budget_consumed SET 
						PersonID='$person', 
						CompanyID=(SELECT CompanyID FROM payroll WHERE PersonID='$person' LIMIT 1), 
						Month='$month', 
						Quarter='$quarter', 
						Salary='$value', 
						Type='3',
						Currency=(SELECT Currency FROM persons_beneficii WHERE PersonID='$person' AND Type='3' AND $month >=DATE_FORMAT(RegDate, '%m-%Y') LIMIT 1)";
                    $conn->query($query);
                }
            }

            // Inserare bonuri de masa
            foreach ($persons_b4 as $person => $costs) {
                foreach ($costs as $month => $value) {
                    $quarter = Utils::quarterByDate($month);
                    $query = "INSERT INTO budget_consumed SET 
						PersonID='$person', 
						CompanyID=(SELECT CompanyID FROM payroll WHERE PersonID='$person' LIMIT 1), 
						Month='$month', 
						Quarter='$quarter', 
						Salary='$value', 
						Type='4',
						Currency=(SELECT Currency FROM persons_beneficii WHERE PersonID='$person' AND Type='4' AND $month >=DATE_FORMAT(RegDate, '%m-%Y') LIMIT 1)";
                    $conn->query($query);
                }
            }

            // Inserare asig. stomato
            foreach ($persons_b5 as $person => $costs) {
                foreach ($costs as $month => $value) {
                    $quarter = Utils::quarterByDate($month);
                    $query = "INSERT INTO budget_consumed SET 
						PersonID='$person', 
						CompanyID=(SELECT CompanyID FROM payroll WHERE PersonID='$person' LIMIT 1), 
						Month='$month', 
						Quarter='$quarter', 
						Salary='$value', 
						Type='5',
						Currency=(SELECT Currency FROM persons_beneficii WHERE PersonID='$person' AND Type='5' AND $month >=DATE_FORMAT(RegDate, '%m-%Y') LIMIT 1)";
                    $conn->query($query);
                }
            }
            // Inserare tichete
            foreach ($persons_b6 as $person => $costs) {
                foreach ($costs as $month => $value) {
                    $quarter = Utils::quarterByDate($month);
                    $query = "INSERT INTO budget_consumed SET 
						PersonID='$person', 
						CompanyID=(SELECT CompanyID FROM payroll WHERE PersonID='$person' LIMIT 1), 
						Month='$month', 
						Quarter='$quarter', 
						Salary='$value', 
						Type='6',
						Currency=(SELECT Currency FROM persons_beneficii WHERE PersonID='$person' AND Type='6' AND $month >=DATE_FORMAT(RegDate, '%m-%Y') LIMIT 1)";
                    $conn->query($query);
                }
            }

            // Inserare outplacement
            foreach ($persons_b7 as $person => $costs) {
                foreach ($costs as $month => $value) {
                    $quarter = Utils::quarterByDate($month);
                    $query = "INSERT INTO budget_consumed SET 
						PersonID='$person', 
						CompanyID=(SELECT CompanyID FROM payroll WHERE PersonID='$person' LIMIT 1), 
						Month='$month', 
						Quarter='$quarter', 
						Salary='$value', 
						Type='7',
						Currency=(SELECT Currency FROM persons_beneficii WHERE PersonID='$person' AND Type='7' AND $month >=DATE_FORMAT(RegDate, '%m-%Y') LIMIT 1)";
                    $conn->query($query);
                }
            }
            // Inserare traininguri
            foreach ($persons_b8 as $person => $costs) {
                foreach ($costs as $month => $value) {
                    $quarter = Utils::quarterByDate($month);
                    $query = "INSERT INTO budget_consumed SET 
						PersonID='$person', 
						CompanyID=(SELECT CompanyID FROM payroll WHERE PersonID='$person' LIMIT 1), 
						Month='$month', 
						Quarter='$quarter', 
						Salary='$value', 
						Type='8',
						Currency=(SELECT Currency FROM persons_beneficii WHERE PersonID='$person' AND Type='8' AND $month >=DATE_FORMAT(RegDate, '%m-%Y') LIMIT 1)";
                    $conn->query($query);
                }
            }
            // Inserare cantina
            foreach ($persons_b9 as $person => $costs) {
                foreach ($costs as $month => $value) {
                    $quarter = Utils::quarterByDate($month);
                    $query = "INSERT INTO budget_consumed SET 
						PersonID='$person', 
						CompanyID=(SELECT CompanyID FROM payroll WHERE PersonID='$person' LIMIT 1), 
						Month='$month', 
						Quarter='$quarter', 
						Salary='$value', 
						Type='9',
						Currency=(SELECT Currency FROM persons_beneficii WHERE PersonID='$person' AND Type='9' AND $month >=DATE_FORMAT(RegDate, '%m-%Y') LIMIT 1)";
                    $conn->query($query);
                }
            }
            // Inserare masina serviciu
            foreach ($persons_b10 as $person => $costs) {
                foreach ($costs as $month => $value) {
                    $quarter = Utils::quarterByDate($month);
                    $query = "INSERT INTO budget_consumed SET 
						PersonID='$person', 
						CompanyID=(SELECT CompanyID FROM payroll WHERE PersonID='$person' LIMIT 1), 
						Month='$month', 
						Quarter='$quarter', 
						Salary='$value', 
						Type='10',
						Currency=(SELECT Currency FROM persons_beneficii WHERE PersonID='$person' AND Type='10' AND $month >=DATE_FORMAT(RegDate, '%m-%Y') LIMIT 1)";
                    $conn->query($query);
                }
            }

            // Inserare sport
            foreach ($persons_b11 as $person => $costs) {
                foreach ($costs as $month => $value) {
                    $quarter = Utils::quarterByDate($month);
                    $query = "INSERT INTO budget_consumed SET 
						PersonID='$person', 
						CompanyID=(SELECT CompanyID FROM payroll WHERE PersonID='$person'), 
						Month='$month', 
						Quarter='$quarter', 
						Salary='$value', 
						Type='11',
						Currency=(SELECT Currency FROM persons_beneficii WHERE PersonID='$person' AND Type='11' AND $month >=DATE_FORMAT(RegDate, '%m-%Y') LIMIT 1)";
                    $conn->query($query);
                }
            }
            // Inserare Pensii Facultative
            foreach ($persons_b12 as $person => $costs) {
                foreach ($costs as $month => $value) {
                    $quarter = Utils::quarterByDate($month);
                    $query = "INSERT INTO budget_consumed SET 
						PersonID='$person', 
						CompanyID=(SELECT CompanyID FROM payroll WHERE PersonID='$person'), 
						Month='$month', 
						Quarter='$quarter', 
						Salary='$value', 
						Type='12',
						Currency=(SELECT Currency FROM persons_beneficii WHERE PersonID='$person' AND Type='12' AND $month >=DATE_FORMAT(RegDate, '%m-%Y') LIMIT 1)";
                    $conn->query($query);
                }
            }
            // Inserare Avantaj Natura
            foreach ($persons_b13 as $person => $costs) {
                foreach ($costs as $month => $value) {
                    $quarter = Utils::quarterByDate($month);
                    $query = "INSERT INTO budget_consumed SET 
						PersonID='$person', 
						CompanyID=(SELECT CompanyID FROM payroll WHERE PersonID='$person'), 
						Month='$month', 
						Quarter='$quarter', 
						Salary='$value', 
						Type='13',
						Currency=(SELECT Currency FROM persons_beneficii WHERE PersonID='$person' AND Type='13' AND $month >=DATE_FORMAT(RegDate, '%m-%Y') LIMIT 1)";
                    $conn->query($query);
                }
            }

            //header('Location: ./?m=budgets');
        }


        ######################
        ### Afisare date #####
        ######################
        echo "<script type='text/javascript'>document.getElementById('loading').innerHTML = '<img src=images/loader.gif></img><br><br>Se pregateste afisarea...';</script>";
        flush();
        ob_flush();

        $html = '';

############################################################# Raport pe luni  #########################################
        // Listare quartere
        $q1 = "SELECT a.* FROM budget_consumed a
		 				GROUP BY a.Quarter,DATE_FORMAT(CONCAT(a.Month,'-01'),'%Y')
		 				ORDER BY a.Month ASC";

        $r1 = $conn->query($q1);
        $html .= "<tr bgcolor='#366092'><th style='color:#fff;' nowrap='nowrap' align='left'><b>Cost Type</b></th><th></th>";
        while ($row1 = $conn->fetch_array($r1)) {
            $html .= "<th style='color:#fff; border-bottom:solid 1px #000;' colspan='3' align='center' nowrap='nowrap'><b>Quarter {$row1['Quarter']}</b></th>";

        }
        $html .= "</tr>";

        // Listare luni
        $q1 = "SELECT a.* FROM budget_consumed a
		 				GROUP BY a.Month
		 				ORDER BY a.Month";

        $r1 = $conn->query($q1);
        $html .= "<tr bgcolor='#366092' ><th style='color:#fff;' align='left'  nowrap='nowrap'>$currency</td><th></th>";
        while ($row1 = $conn->fetch_array($r1)) {
            $html .= "<th style='color:#fff; border-bottom:solid 1px #000;' nowrap='nowrap'><b>" . date('M y', strtotime($row1['Month'])) . "</b></th>";

        }
        $html .= "</tr>";
        ############################
        // Total luni
        $q1 = "SELECT a.*,p.FullName,c.Department, SUM(a.Salary) AS salary FROM budget_consumed a
						INNER JOIN persons p ON a.PersonID=p.PersonID
		 				INNER JOIN payroll b ON a.PersonID=b.PersonID
		 				INNER JOIN departments c ON b.DepartmentID=c.DepartmentID
		 				WHERE 1=1
		 				$cond
		 				GROUP BY a.Month";

        $r1 = $conn->query($q1);
        $html .= "<tr bgcolor='#538DD5'><td style='color:#fff;' align='left'><b>Total</b>";
        if (empty($_GET['print']) || empty($_GET['export_doc']))
            $html .= "  <a style='color:#000;' href='#' onclick=\"javascript:popUp('./?m=budgets&o=graph_total&CompanyID={$_GET['CompanyID']}','Total/ Departamente',800,700); return false;\"  title='Vezi grafic'><img src='images/graph.png' align='absbottom' alt='Vezi grafic'></a>";
        $html .= "</td><td></td>";
        if ($conn->get_num_rows($r1) > 0) {
            while ($row1 = $conn->fetch_array($r1)) {
                $html .= "<td style='color:#fff;' align='right'><b>" . ceil($row1['salary'] * $exrate) . "</b></td>";

            }
        } else {
            for ($i = 0; $i < 12; $i++)
                $html .= "<td style='color:#fff;' align='right'><b>0</b></td>";
        }
        $html .= "</tr>";
        ###############################
        // Totalurii departamente/luni
        $q1 = "SELECT a.DepartmentID, a.Department FROM departments a INNER JOIN payroll b ON a.DepartmentID=b.DepartmentID WHERE 1=1 $depcond GROUP BY a.DepartmentID ORDER BY Department ASC";
        $r1 = $conn->query($q1);
        while ($row1 = $conn->fetch_array($r1)) {
            $html .= "<tr><td colspan='2' align='left'>{$row1['Department']}</td>";
            $html .= "";
            $q2 = "SELECT a.*,p.FullName,c.Department, SUM(a.Salary) AS salary FROM budget_consumed a
						INNER JOIN persons p ON a.PersonID=p.PersonID
		 				INNER JOIN payroll b ON a.PersonID=b.PersonID
		 				INNER JOIN departments c ON b.DepartmentID=c.DepartmentID
		 				AND c.DepartmentID={$row1['DepartmentID']}
		 				$cond
		 				GROUP BY a.Month";

            $r2 = $conn->query($q2);
            if ($conn->get_num_rows($r2) > 0) {
                while ($row2 = $conn->fetch_array($r2)) {
                    $html .= "<td align='right'>" . ceil($row2['salary'] * $exrate) . "</td>";
                }
            } else {
                for ($i = 0; $i < 12; $i++)
                    $html .= "<td align='right'>0</td>";
            }
            $html .= "</tr>";

        }

        ####################
        // Total salarii+pfa+extra/luni
        $q1 = "SELECT a.*,p.FullName,c.Department, SUM(a.Salary) AS salary FROM budget_consumed a
						INNER JOIN persons p ON a.PersonID=p.PersonID
		 				INNER JOIN payroll b ON a.PersonID=b.PersonID
		 				INNER JOIN departments c ON b.DepartmentID=c.DepartmentID
		 				WHERE (a.Type='salary' OR a.Type='bonus' OR a.Type='malus' OR a.Type='contract' OR a.Type='displacement')
		 				$cond
		 				GROUP BY a.Month";

        $r1 = $conn->query($q1);
        $html .= "<tr bgcolor='#538DD5'><td style='color:#fff;' align='left'><b>Salarii</b>";
        if (empty($_GET['print']) || empty($_GET['export_doc']))
            $html .= "  <a style='color:#000;' href='#' onclick=\"javascript:popUp('./?m=budgets&o=graph_salary&CompanyID={$_GET['CompanyID']}','Salarii/ Departamente',800,700); return false;\" title='Vezi grafic'><img src='images/graph.png' align='absbottom' alt='Vezi grafic'></a>";
        $html .= "</td><td></td>";
        if ($conn->get_num_rows($r1) > 0) {
            while ($row1 = $conn->fetch_array($r1)) {
                $html .= "<td style='color:#fff;' align='right'><b>" . ceil($row1['salary'] * $exrate) . "</b></td>";

            }
        } else {
            for ($i = 0; $i < 12; $i++)
                $html .= "<td style='color:#fff;' align='right'><b>0</b></td>";
        }
        $html .= "</tr>";

        // Totalurii salarii+pfa+extra/departamente/luni
        $q1 = "SELECT a.DepartmentID, a.Department FROM departments a INNER JOIN payroll b ON a.DepartmentID=b.DepartmentID WHERE 1=1 $depcond GROUP BY a.DepartmentID ORDER BY Department ASC";
        $r1 = $conn->query($q1);
        while ($row1 = $conn->fetch_array($r1)) {
            $html .= "<td colspan='2' align='left'>{$row1['Department']}</td>";
            $html .= "";
            $q2 = "SELECT a.*,p.FullName,c.Department, SUM(a.Salary) AS salary FROM budget_consumed a
						INNER JOIN persons p ON a.PersonID=p.PersonID
		 				INNER JOIN payroll b ON a.PersonID=b.PersonID
		 				INNER JOIN departments c ON b.DepartmentID=c.DepartmentID
		 				WHERE (a.Type='salary' OR a.Type='bonus' OR a.Type='malus' OR a.Type='contract' OR a.Type='displacement')
		 				AND c.DepartmentID={$row1['DepartmentID']}
		 				$cond
		 				GROUP BY a.Month";

            $r2 = $conn->query($q2);
            if ($conn->get_num_rows($r2) > 0) {
                while ($row2 = $conn->fetch_array($r2)) {
                    $html .= "<td align='right'>" . ceil($row2['salary'] * $exrate) . "</td>";
                }
            } else {
                for ($i = 0; $i < 12; $i++)
                    $html .= "<td align='right'>0</td>";
            }
            $html .= "</tr>";
        }

        // Total beneficii/luni
        $q1 = "SELECT a.*,p.FullName,c.Department, SUM(a.Salary) AS salary FROM budget_consumed a
						INNER JOIN persons p ON a.PersonID=p.PersonID
		 				INNER JOIN payroll b ON a.PersonID=b.PersonID
		 				INNER JOIN departments c ON b.DepartmentID=c.DepartmentID
		 				WHERE (a.Type='1' OR a.Type='2' OR a.Type='3' OR a.Type='4' OR a.Type='5' OR a.Type='6' OR a.Type='7' OR a.Type='8' OR a.Type='9' OR a.Type='10' OR a.Type='11')
		 				$cond
		 				GROUP BY a.Month";

        $r1 = $conn->query($q1);
        $html .= "<tr bgcolor='#538DD5'><td style='color:#fff;' align='left'><b>Beneficii</b>";
        if (empty($_GET['print']) || empty($_GET['export_doc']))
            $html .= "  <a style='color:#000;' href='#' onclick=\"javascript:popUp('./?m=budgets&o=graph_benefits&CompanyID={$_GET['CompanyID']}','Beneficii',800,700); return false;\" title='Vezi grafic'><img src='images/graph.png' align='absbottom' alt='Vezi grafic'></a>";
        $html .= "</td><td></td>";
        if ($conn->get_num_rows($r1) > 0) {
            while ($row1 = $conn->fetch_array($r1)) {
                $html .= "<td style='color:#fff;' align='right'><b>" . ceil($row1['salary'] * $exrate) . "</b></td>";

            }
        } else {
            for ($i = 0; $i < 12; $i++)
                $html .= "<td style='color:#fff;' align='right'><b>0</b></td>";
        }
        $html .= "</tr>";
        ##
        ##
        ##
        // Totalurii beneficii/tipuri/luni
        foreach ($benefits as $benefitType => $benefit) {
            $html .= "<td colspan='2' align='left'>$benefit</td>";
            $html .= "";
            $q2 = "SELECT a.*,p.FullName,c.Department, SUM(a.Salary) AS salary FROM budget_consumed a
						INNER JOIN persons p ON a.PersonID=p.PersonID
		 				INNER JOIN payroll b ON a.PersonID=b.PersonID
		 				INNER JOIN departments c ON b.DepartmentID=c.DepartmentID
		 				WHERE a.Type='$benefitType'
		 				$cond
		 				GROUP BY a.Month";

            $r2 = $conn->query($q2);
            if ($conn->get_num_rows($r2) > 0) {
                while ($row2 = $conn->fetch_array($r2)) {
                    $html .= "<td align='right'>" . ceil($row2['salary'] * $exrate) . "</td>";
                }
            } else {
                for ($i = 0; $i < 12; $i++)
                    $html .= "<td align='right'>0</td>";
            }
            $html .= "</tr>";

        }
        ########################################

        // Totalurii salarii/oameni/departamente/luni
        $q1 = "SELECT a.DepartmentID, a.Department FROM departments a INNER JOIN payroll b ON a.DepartmentID=b.DepartmentID WHERE 1=1 $depcond GROUP BY a.DepartmentID  ORDER BY Department ASC";
        $r1 = $conn->query($q1);
        while ($row1 = $conn->fetch_array($r1)) {
            // Departamente
            $html .= "<tr bgcolor='#95B3D7'><td colspan='2' align='left'>{$row1['Department']}</td>";
            $q2 = "SELECT a.*,c.Department, SUM(a.Salary) AS salary FROM budget_consumed a
		 				INNER JOIN payroll b ON a.PersonID=b.PersonID
		 				INNER JOIN departments c ON b.DepartmentID=c.DepartmentID
		 				WHERE c.DepartmentID={$row1['DepartmentID']}
		 				$cond
		 				GROUP BY a.Month,b.DepartmentID";
            $r2 = $conn->query($q2);
            if ($conn->get_num_rows($r2) > 0) {
                while ($row2 = $conn->fetch_array($r2)) {
                    $html .= "<td align='right'>" . ceil($row2['salary'] * $exrate) . "</td>";
                }
            } else {
                for ($i = 0; $i < 12; $i++)
                    $html .= "<td align='right'>0</td>";
            }
            $html .= "</tr>";

            // Listare Oameni
            $html .= "<tr>";
            $q4 = "SELECT a.* FROM persons a INNER JOIN payroll b ON a.PersonID=b.PersonID WHERE DepartmentID={$row1['DepartmentID']} $perscond";
            $r4 = $conn->query($q4);
            while ($row4 = $conn->fetch_array($r4)) {
                // Total costuri/Om
                $html .= "<td bgcolor='#FFFFFF' style='border-top:solid 1px #000;' align='left' rowspan='2'>{$row4['FullName']}</td><td bgcolor='#B8CCE4' style='border-top:solid 1px #000;' nowrap='nowrap'><b>Total cost</b></td>";
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Month, a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html .= "<td bgcolor='#B8CCE4' style='border-top:solid 1px #000;' align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 12; $i++)
                        $html .= "<td bgcolor='#B8CCE4' style='border-top:solid 1px #000;' align='right'>0</td>";
                }
                $html .= "</tr>";
                // Total sal+pfa+bonus+malus+deplasari/Om
                $html .= "<td bgcolor='#DCE6F1' align='left'><b>Salariu</b></td>";
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE (a.Type='salary' OR a.Type='bonus' OR a.Type='malus' OR a.Type='contract' OR a.Type='displacement')
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Month, a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html .= "<td bgcolor='#DCE6F1' align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 12; $i++)
                        $html .= "<td bgcolor='#DCE6F1' align='right'>0</td>";
                }
                $html .= "</tr>";
                // Salariu/Om
                $html .= "<th bgcolor='#FFFFFF'>&nbsp;</th><td bgcolor='#FFFFFF' nowrap='nowrap' align='left'>Salariu</td>";
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='salary'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Month, a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 12; $i++)
                        $html .= "<td align='right'>0</td>";
                }
                $html .= "</tr>";
                // PFA/Om
                $html .= "<th bgcolor='#FFFFFF'>&nbsp;</th><td bgcolor='#FFFFFF' nowrap='nowrap' align='left'>Contract PFA</td>";
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='contract'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Month, a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 12; $i++)
                        $html .= "<td align='right'>0</td>";
                }
                $html .= "</tr>";
                // Bonus/Om
                $html .= "<th bgcolor='#FFFFFF'>&nbsp;</th><td bgcolor='#FFFFFF' nowrap='nowrap' align='left'>Bonus</td>";
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='bonus'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Month, a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 12; $i++)
                        $html .= "<td align='right'>0</td>";
                }
                $html .= "</tr>";
                // Malus/Om
                $html .= "<th bgcolor='#FFFFFF'>&nbsp;</th><td bgcolor='#FFFFFF' nowrap='nowrap' align='left'>Malus</td>";
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='malus'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Month, a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 12; $i++)
                        $html .= "<td align='right'>0</td>";
                }
                $html .= "</tr>";

                // Deplasari/Om
                $html .= "<th bgcolor='#FFFFFF'>&nbsp;</th><td bgcolor='#FFFFFF' nowrap='nowrap' align='left'>Deplasari</td>";
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='displacement'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Month, a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 12; $i++)
                        $html .= "<td align='right'>0</td>";
                }
                $html .= "</tr>";


                // Total Beneficii/Om
                $html .= "<th bgcolor='#FFFFFF' >&nbsp;</th><td bgcolor='#DCE6F1' align='left'><b>Beneficiu</b></td>";
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE (a.Type='1' OR a.Type='2' OR a.Type='3' OR a.Type='4' OR a.Type='5' OR a.Type='6' OR a.Type='7' OR a.Type='8' OR a.Type='9' OR a.Type='10' OR a.Type='11' OR a.Type='12' OR a.Type='13')
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Month, a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html .= "<td bgcolor='#DCE6F1' align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 12; $i++)
                        $html .= "<td bgcolor='#DCE6F1' align='right'>0</td>";
                }
                $html .= "</tr>";
                // As sanatate/Om
                $html .= "<th bgcolor='#FFFFFF'>&nbsp;</th><td bgcolor='#FFFFFF' nowrap='nowrap' align='left'>As. sanatate</td>";
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='1'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Month, a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 12; $i++)
                        $html .= "<td align='right'>0</td>";
                }
                $html .= "</tr>";
                // As viata/Om
                $html .= "<th bgcolor='#FFFFFF'>&nbsp;</th><td bgcolor='#FFFFFF' nowrap='nowrap' align='left'>As. viata</td>";
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='2'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Month, a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 12; $i++)
                        $html .= "<td align='right'>0</td>";
                }
                $html .= "</tr>";
                // As pensie/Om
                $html .= "<th bgcolor='#FFFFFF'>&nbsp;</th><td bgcolor='#FFFFFF' nowrap='nowrap' align='left'>As. pensie</td>";
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='3'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Month, a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 12; $i++)
                        $html .= "<td align='right'>0</td>";
                }
                $html .= "</tr>";
                // Bonuri masa
                $html .= "<th bgcolor='#FFFFFF'>&nbsp;</th><td bgcolor='#FFFFFF' nowrap='nowrap' align='left'>Bonuri masa</td>";
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='4'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Month, a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 12; $i++)
                        $html .= "<td align='right'>0</td>";
                }
                $html .= "</tr>";
                // As stomato
                $html .= "<th bgcolor='#FFFFFF'>&nbsp;</th><td bgcolor='#FFFFFF' nowrap='nowrap' align='left'>As. stomato.</td>";
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='5'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Month, a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 12; $i++)
                        $html .= "<td align='right'>0</td>";
                }
                $html .= "</tr>";
                // Tichete
                $html .= "<th bgcolor='#FFFFFF'>&nbsp;</th><td bgcolor='#FFFFFF' nowrap='nowrap' align='left'>Tichete cadou</td>";
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='6'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Month, a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 12; $i++)
                        $html .= "<td align='right'>0</td>";
                }
                $html .= "</tr>";
                // Outplacement
                $html .= "<th bgcolor='#FFFFFF'>&nbsp;</th><td bgcolor='#FFFFFF' nowrap='nowrap' align='left'>Outplacement</td>";
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='7'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Month, a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 12; $i++)
                        $html .= "<td align='right'>0</td>";
                }
                $html .= "</tr>";
                // Traininguri
                $html .= "<th bgcolor='#FFFFFF'>&nbsp;</th><td bgcolor='#FFFFFF' nowrap='nowrap' align='left'>Training</td>";
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='8'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Month, a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 12; $i++)
                        $html .= "<td align='right'>0</td>";
                }
                $html .= "</tr>";
                // Cantina
                $html .= "<th bgcolor='#FFFFFF'>&nbsp;</th><td bgcolor='#FFFFFF' nowrap='nowrap' align='left'>Cantina</td>";
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='9'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Month, a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 12; $i++)
                        $html .= "<td align='right'>0</td>";
                }
                $html .= "</tr>";
                // Masina serviciu
                $html .= "<th bgcolor='#FFFFFF'>&nbsp;</th><td bgcolor='#FFFFFF' nowrap='nowrap' align='left'>Masina serviciu</td>";
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='10'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Month, a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 12; $i++)
                        $html .= "<td align='right'>0</td>";
                }
                $html .= "</tr>";

                // Sportiv
                $html .= "<th bgcolor='#FFFFFF'>&nbsp;</th><td bgcolor='#FFFFFF' nowrap='nowrap' align='left'>Sportiv</td>";
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='11'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Month, a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 12; $i++)
                        $html .= "<td align='right'>0</td>";
                }
                $html .= "</tr>";

                // Pensii facultative
                $html .= "<th bgcolor='#FFFFFF'>&nbsp;</th><td bgcolor='#FFFFFF' nowrap='nowrap' align='left'>Pensii facultative</td>";
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='12'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Month, a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 12; $i++)
                        $html .= "<td align='right'>0</td>";
                }
                $html .= "</tr>";

                // Avantaj Natura
                $html .= "<th bgcolor='#FFFFFF'>&nbsp;</th><td bgcolor='#FFFFFF' nowrap='nowrap' align='left'>Avantaj natura</td>";
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='13'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Month, a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 12; $i++)
                        $html .= "<td align='right'>0</td>";
                }
                $html .= "</tr>";
            }
        }


        ############################################################# Raport pe QUARTERE  #########################################

        $html2 = "";
        // Listare quartere
        $q1 = "SELECT a.* FROM budget_consumed a
		 				GROUP BY a.Quarter
		 				ORDER BY a.Month ASC";
        $r1 = $conn->query($q1);
        $html2 .= "<tr bgcolor='#16365C'>";
        $cnt = 0;
        while ($row1 = $conn->fetch_array($r1)) {
            $html2 .= "<th style='color:#fff;'align='center' nowrap='nowrap'><b>Q {$row1['Quarter']}</th>";
            $cnt++;
        }
        $html2 .= "</tr>";


        $html2 .= "<tr bgcolor='#16365C'>";
        for ($i = 1; $i <= $cnt; $i++) {
            $html2 .= "<th style='color:#fff; border-bottom:solid 1px #000;' nowrap='nowrap'>&nbsp;</th>";
        }
        $html2 .= "</tr>";

        ############################
        // Total quartere
        $q1 = "SELECT a.*,p.FullName,c.Department, SUM(a.Salary) AS salary FROM budget_consumed a
						INNER JOIN persons p ON a.PersonID=p.PersonID
		 				INNER JOIN payroll b ON a.PersonID=b.PersonID
		 				INNER JOIN departments c ON b.DepartmentID=c.DepartmentID
		 				WHERE 1=1
		 				$cond
		 				GROUP BY a.Quarter
		 				ORDER BY a.Month ASC";

        $r1 = $conn->query($q1);
        $html2 .= "<tr bgcolor='#538DD5'>";
        if ($conn->get_num_rows($r1) > 0) {
            while ($row1 = $conn->fetch_array($r1)) {
                $html2 .= "<td style='color:#fff;' align='right'><b>" . ceil($row1['salary'] * $exrate) . "</b></td>";
            }
        } else {
            for ($i = 0; $i < 4; $i++)
                $html2 .= "<td style='color:#fff;' align='right'><b>0</b></td>";
        }
        $html2 .= "</tr>";
        ###############################
        // Totalurii departamente/luni
        $q1 = "SELECT a.DepartmentID, a.Department FROM departments a INNER JOIN payroll b ON a.DepartmentID=b.DepartmentID WHERE 1=1 $depcond GROUP BY a.DepartmentID ORDER BY Department ASC";
        $r1 = $conn->query($q1);
        while ($row1 = $conn->fetch_array($r1)) {
            $html2 .= "<tr>";
            $html2 .= "";
            $q2 = "SELECT a.*,p.FullName,c.Department, SUM(a.Salary) AS salary FROM budget_consumed a
						INNER JOIN persons p ON a.PersonID=p.PersonID
		 				INNER JOIN payroll b ON a.PersonID=b.PersonID
		 				INNER JOIN departments c ON b.DepartmentID=c.DepartmentID
		 				AND c.DepartmentID={$row1['DepartmentID']}
		 				$cond
		 				GROUP BY a.Quarter
		 				ORDER BY a.Month ASC";

            $r2 = $conn->query($q2);
            if ($conn->get_num_rows($r2) > 0) {
                while ($row2 = $conn->fetch_array($r2)) {
                    $html2 .= "<td align='right'>" . ceil($row2['salary'] * $exrate) . "</td>";
                }
            } else {
                for ($i = 0; $i < 4; $i++)
                    $html2 .= "<td align='right'>0</td>";
            }
            $html2 .= "</tr>";

        }

        ####################
        // Total salarii+pfa+extra/luni
        $q1 = "SELECT a.*,p.FullName,c.Department, SUM(a.Salary) AS salary FROM budget_consumed a
						INNER JOIN persons p ON a.PersonID=p.PersonID
		 				INNER JOIN payroll b ON a.PersonID=b.PersonID
		 				INNER JOIN departments c ON b.DepartmentID=c.DepartmentID
		 				WHERE (a.Type='1' OR a.Type='2' OR a.Type='3' OR a.Type='4' OR a.Type='5' OR a.Type='6' OR a.Type='7' OR a.Type='8' OR a.Type='9' OR a.Type='10' OR a.Type='11')
		 				$cond
		 				GROUP BY a.Quarter
		 				ORDER BY a.Month ASC";

        $r1 = $conn->query($q1);
        $html2 .= "<tr bgcolor='#538DD5'>";
        if ($conn->get_num_rows($r1) > 0) {
            while ($row1 = $conn->fetch_array($r1)) {
                $html2 .= "<td style='color:#fff;' align='right'><b>" . ceil($row1['salary'] * $exrate) . "</b></td>";

            }
        } else
            $html2 .= "<td style='color:#fff;' align='right'><b>0</b></td>";
        $html2 .= "</tr>";

        // Totalurii salarii+pfa+extra/departamente/luni
        $q1 = "SELECT a.DepartmentID, a.Department FROM departments a INNER JOIN payroll b ON a.DepartmentID=b.DepartmentID WHERE 1=1 $depcond GROUP BY a.DepartmentID ORDER BY Department ASC";
        $r1 = $conn->query($q1);
        while ($row1 = $conn->fetch_array($r1)) {
            $q2 = "SELECT a.*,p.FullName,c.Department, SUM(a.Salary) AS salary FROM budget_consumed a
						INNER JOIN persons p ON a.PersonID=p.PersonID
		 				INNER JOIN payroll b ON a.PersonID=b.PersonID
		 				INNER JOIN departments c ON b.DepartmentID=c.DepartmentID
		 				WHERE (a.Type='salary' OR a.Type='bonus' OR a.Type='malus' OR a.Type='contract' OR a.Type='desplacement')
		 				AND c.DepartmentID={$row1['DepartmentID']}
		 				$cond
		 				GROUP BY a.Quarter
		 				ORDER BY a.Month ASC";

            $r2 = $conn->query($q2);
            if ($conn->get_num_rows($r2) > 0) {
                while ($row2 = $conn->fetch_array($r2)) {
                    $html2 .= "<td align='right'>" . ceil($row2['salary'] * $exrate) . "</td>";
                }
            } else {
                for ($i = 0; $i < 4; $i++)
                    $html2 .= "<td align='right'>0</td>";
            }
            $html2 .= "</tr>";

        }

        // Total beneficii/luni
        $q1 = "SELECT a.*,p.FullName,c.Department, SUM(a.Salary) AS salary FROM budget_consumed a
						INNER JOIN persons p ON a.PersonID=p.PersonID
		 				INNER JOIN payroll b ON a.PersonID=b.PersonID
		 				INNER JOIN departments c ON b.DepartmentID=c.DepartmentID
		 				WHERE (a.Type='1' OR a.Type='2' OR a.Type='3' OR a.Type='4' OR a.Type='5' OR a.Type='6' OR a.Type='7' OR a.Type='8' OR a.Type='9' OR a.Type='10' OR a.Type='11' OR a.Type='12' OR a.Type='13')
		 				$cond
		 				GROUP BY a.Quarter
		 				ORDER BY a.Month ASC";

        $r1 = $conn->query($q1);
        $html2 .= "<tr bgcolor='#538DD5'>";
        if ($conn->get_num_rows($r1) > 0) {
            while ($row1 = $conn->fetch_array($r1)) {
                $html2 .= "<td style='color:#fff;' align='right'><b>" . ceil($row1['salary'] * $exrate) . "</b></td>";
            }
        } else
            $html2 .= "<td style='color:#fff;' align='right'><b>0</b></td>";
        $html2 .= "</tr>";

        // Totalurii beneficii/tipuri/luni
        foreach ($benefits as $benefitType => $benefit) {
            $q2 = "SELECT a.*,p.FullName,c.Department, SUM(a.Salary) AS salary FROM budget_consumed a
						INNER JOIN persons p ON a.PersonID=p.PersonID
		 				INNER JOIN payroll b ON a.PersonID=b.PersonID
		 				INNER JOIN departments c ON b.DepartmentID=c.DepartmentID
		 				WHERE a.Type='$benefitType'
		 				$cond
		 				GROUP BY a.Quarter
		 				ORDER BY a.Month ASC";

            $r2 = $conn->query($q2);
            if ($conn->get_num_rows($r2) > 0) {
                while ($row2 = $conn->fetch_array($r2)) {
                    $html2 .= "<td align='right'>" . ceil($row2['salary'] * $exrate) . "</td>";
                }
            } else {
                for ($i = 0; $i < 4; $i++)
                    $html2 .= "<td align='right'>0</td>";
            }
            $html2 .= "</tr>";

        }
        ########################################

        // Totalurii salarii/oameni/departamente/quartere
        $q1 = "SELECT a.DepartmentID, a.Department FROM departments a INNER JOIN payroll b ON a.DepartmentID=b.DepartmentID  WHERE 1=1 $depcond GROUP BY a.DepartmentID ORDER BY Department ASC";
        $r1 = $conn->query($q1);
        while ($row1 = $conn->fetch_array($r1)) {
            // Departamente
            $html2 .= "<tr bgcolor='#95B3D7'>";
            $q2 = "SELECT a.*,c.Department, SUM(a.Salary) AS salary FROM budget_consumed a
		 				INNER JOIN payroll b ON a.PersonID=b.PersonID
		 				INNER JOIN departments c ON b.DepartmentID=c.DepartmentID
		 				WHERE c.DepartmentID={$row1['DepartmentID']}
		 				$cond
		 				GROUP BY a.Quarter,b.DepartmentID
		 				ORDER BY a.Month ASC";
            $r2 = $conn->query($q2);
            if ($conn->get_num_rows($r2) > 0) {
                while ($row2 = $conn->fetch_array($r2)) {
                    $html2 .= "<td align='right'>" . ceil($row2['salary'] * $exrate) . "</td>";
                }
            } else {
                for ($i = 0; $i < 4; $i++)
                    $html2 .= "<td align='right'>0</td>";
            }
            $html2 .= "</tr>";

            // Listare Oameni
            $html2 .= "<tr>";
            $q4 = "SELECT a.* FROM persons a INNER JOIN payroll b ON a.PersonID=b.PersonID WHERE DepartmentID={$row1['DepartmentID']} $perscond";
            $r4 = $conn->query($q4);
            while ($row4 = $conn->fetch_array($r4)) {
                // Total costuri/Om
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Quarter, a.PersonID
				 				ORDER BY a.Month ASC";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html2 .= "<td bgcolor='#B8CCE4' style='border-top:solid 1px #000;' align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 4; $i++)
                        $html2 .= "<td bgcolor='#B8CCE4' style='border-top:solid 1px #000;' align='right'>0</td>";
                }
                $html2 .= "</tr>";
                // Total sal+pfa+bonus+malus/Om
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE (a.Type='salary' OR a.Type='bonus' OR a.Type='malus' OR a.Type='contract' OR a.Type='desplacement')
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Quarter, a.PersonID
				 				ORDER BY a.Month ASC";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html2 .= "<td bgcolor='#DCE6F1' align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 4; $i++)
                        $html2 .= "<td bgcolor='#DCE6F1' align='right'>0</td>";
                }
                $html2 .= "</tr>";
                // Salariu/Om
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='salary'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Quarter, a.PersonID
				 				ORDER BY a.Month ASC";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html2 .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 4; $i++)
                        $html2 .= "<td align='right'>0</td>";
                }
                $html2 .= "</tr>";
                // PFA/Om
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='contract'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Quarter, a.PersonID
				 				ORDER BY a.Month ASC";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html2 .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 4; $i++)
                        $html2 .= "<td align='right'>0</td>";
                }
                $html2 .= "</tr>";
                // Bonus/Om
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='bonus'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Quarter, a.PersonID
				 				ORDER BY a.Month ASC";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html2 .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 4; $i++)
                        $html2 .= "<td align='right'>0</td>";
                }
                $html2 .= "</tr>";
                // Malus/Om
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='malus'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Quarter, a.PersonID
				 				ORDER BY a.Month ASC";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html2 .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 4; $i++)
                        $html2 .= "<td align='right'>0</td>";
                }
                $html2 .= "</tr>";

                // Deplasari/Om
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='displacement'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Quarter, a.PersonID
				 				ORDER BY a.Month ASC";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html2 .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 4; $i++)
                        $html2 .= "<td align='right'>0</td>";
                }
                $html2 .= "</tr>";


                // Total beneficii/Om
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE (a.Type='1' OR a.Type='2' OR a.Type='3' OR a.Type='4' OR a.Type='5' OR a.Type='6' OR a.Type='7' OR a.Type='8' OR a.Type='9' OR a.Type='10' OR a.Type='11' OR a.Type='12' OR a.Type='13')
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Quarter, a.PersonID
				 				ORDER BY a.Month ASC";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html2 .= "<td bgcolor='#DCE6F1' align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 4; $i++)
                        $html2 .= "<td bgcolor='#DCE6F1' align='right'>0</td>";
                }
                $html2 .= "</tr>";
                // As sanatate/Om
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='1'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Quarter, a.PersonID
				 				ORDER BY a.Month ASC";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html2 .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 4; $i++)
                        $html2 .= "<td align='right'>0</td>";
                }
                $html2 .= "</tr>";
                // As viata/Om
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='2'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Quarter, a.PersonID
				 				ORDER BY a.Month ASC";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html2 .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 4; $i++)
                        $html2 .= "<td align='right'>0</td>";
                }
                $html2 .= "</tr>";
                // As pensie/Om
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='3'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Quarter, a.PersonID
				 				ORDER BY a.Month ASC";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html2 .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 4; $i++)
                        $html2 .= "<td align='right'>0</td>";
                }
                $html2 .= "</tr>";
                // Bonuri masa
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='4'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Quarter, a.PersonID
				 				ORDER BY a.Month ASC";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html2 .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 4; $i++)
                        $html2 .= "<td align='right'>0</td>";
                }
                $html2 .= "</tr>";
                // As stomato
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='5'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Quarter, a.PersonID
				 				ORDER BY a.Month ASC";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html2 .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 4; $i++)
                        $html2 .= "<td align='right'>0</td>";
                }
                $html2 .= "</tr>";
                // Tichete cadou
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='6'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Quarter, a.PersonID
				 				ORDER BY a.Month ASC";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html2 .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 4; $i++)
                        $html2 .= "<td align='right'>0</td>";
                }
                $html2 .= "</tr>";
                // Outplacement
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='7'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Quarter, a.PersonID
				 				ORDER BY a.Month ASC";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html2 .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 4; $i++)
                        $html2 .= "<td align='right'>0</td>";
                }
                $html2 .= "</tr>";
                // Traininguri
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='8'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Quarter, a.PersonID
				 				ORDER BY a.Month ASC";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html2 .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 4; $i++)
                        $html2 .= "<td align='right'>0</td>";
                }
                $html2 .= "</tr>";
                // Cantina
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='9'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Quarter, a.PersonID
				 				ORDER BY a.Month ASC";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html2 .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 4; $i++)
                        $html2 .= "<td align='right'>0</td>";
                }
                $html2 .= "</tr>";
                // Masina serviciu
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='10'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Quarter, a.PersonID
				 				ORDER BY a.Month ASC";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html2 .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 4; $i++)
                        $html2 .= "<td align='right'>0</td>";
                }
                $html2 .= "</tr>";

                // Sportiv
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='11'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Quarter, a.PersonID
				 				ORDER BY a.Month ASC";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html2 .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 4; $i++)
                        $html2 .= "<td align='right'>0</td>";
                }
                $html2 .= "</tr>";

                // Pensii facultative
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='12'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Quarter, a.PersonID
				 				ORDER BY a.Month ASC";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html2 .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 4; $i++)
                        $html2 .= "<td align='right'>0</td>";
                }
                $html2 .= "</tr>";

                // Avantaj Natura
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='13'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY a.Quarter, a.PersonID
				 				ORDER BY a.Month ASC";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html2 .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else {
                    for ($i = 0; $i < 4; $i++)
                        $html2 .= "<td align='right'>0</td>";
                }
                $html2 .= "</tr>";

            }
        }

        ############################################################# Raport pe ANI  #########################################

        $html3 = "";
        // Listare quartere
        $q1 = "SELECT DATE_FORMAT(CONCAT(a.Month,'-01'),'%Y') as year FROM budget_consumed a
		 				GROUP BY DATE_FORMAT(CONCAT(a.Month,'-01'),'%Y')
		 				ORDER BY DATE_FORMAT(CONCAT(a.Month,'-01'),'%Y')";

        $r1 = $conn->query($q1);
        $cnt = 0;
        $html3 .= "<tr bgcolor='#000'>";
        while ($row1 = $conn->fetch_array($r1)) {
            $html3 .= "<th style='color:#fff;'align='center' nowrap='nowrap'><b>{$row1['year']}</th>";
            $cnt++;
        }
        $html3 .= "</tr>";

        $html3 .= "<tr bgcolor='#000'>";
        for ($i = 1; $i <= $cnt; $i++) {
            $html3 .= "<th style='color:#fff; border-bottom:solid 1px #000;' align='center' nowrap='nowrap'>Totals</th>";
        }
        $html3 .= "</tr>";

        ############################
        // Total luni
        $q1 = "SELECT a.*,p.FullName,c.Department, SUM(a.Salary) AS salary FROM budget_consumed a
						INNER JOIN persons p ON a.PersonID=p.PersonID
		 				INNER JOIN payroll b ON a.PersonID=b.PersonID
		 				INNER JOIN departments c ON b.DepartmentID=c.DepartmentID
		 				WHERE 1=1
		 				$cond
		 				GROUP BY DATE_FORMAT(CONCAT(a.Month,'-01'),'%Y')";

        $r1 = $conn->query($q1);
        $html3 .= "<tr bgcolor='#538DD5'>";
        if ($conn->get_num_rows($r1) > 0) {
            while ($row1 = $conn->fetch_array($r1)) {
                $html3 .= "<td style='color:#fff;' align='right'><b>" . ceil($row1['salary'] * $exrate) . "</b></td>";
            }
        } else
            $html3 .= "<td style='color:#fff;' align='right'><b>0</b></td>";
        $html3 .= "</tr>";
        ###############################
        // Totalurii departamente/luni
        $q1 = "SELECT a.DepartmentID, a.Department FROM departments a INNER JOIN payroll b ON a.DepartmentID=b.DepartmentID WHERE 1=1 $depcond GROUP BY a.DepartmentID ORDER BY Department ASC";
        $r1 = $conn->query($q1);
        while ($row1 = $conn->fetch_array($r1)) {
            $html3 .= "<tr>";
            $html3 .= "";
            $q2 = "SELECT a.*,p.FullName,c.Department, SUM(a.Salary) AS salary FROM budget_consumed a
						INNER JOIN persons p ON a.PersonID=p.PersonID
		 				INNER JOIN payroll b ON a.PersonID=b.PersonID
		 				INNER JOIN departments c ON b.DepartmentID=c.DepartmentID
		 				AND c.DepartmentID={$row1['DepartmentID']}
		 				$cond
		 				GROUP BY DATE_FORMAT(CONCAT(a.Month,'-01'),'%Y')";

            $r2 = $conn->query($q2);
            if ($conn->get_num_rows($r2) > 0) {
                while ($row2 = $conn->fetch_array($r2)) {
                    $html3 .= "<td align='right'>" . ceil($row2['salary'] * $exrate) . "</td>";
                }
            } else
                $html3 .= "<td align='right'>0</td>";
            $html3 .= "</tr>";

        }

        ####################
        // Total salarii+pfa+extra/luni
        $q1 = "SELECT a.*,p.FullName,c.Department, SUM(a.Salary) AS salary FROM budget_consumed a
						INNER JOIN persons p ON a.PersonID=p.PersonID
		 				INNER JOIN payroll b ON a.PersonID=b.PersonID
		 				INNER JOIN departments c ON b.DepartmentID=c.DepartmentID
		 				WHERE (a.Type='salary' OR a.Type='bonus' OR a.Type='malus' OR a.Type='contract' OR a.Type='desplacement')
		 				$cond
		 				GROUP BY DATE_FORMAT(CONCAT(a.Month,'-01'),'%Y')";

        $r1 = $conn->query($q1);
        $html3 .= "<tr bgcolor='#538DD5'>";
        if ($conn->get_num_rows($r1) > 0) {
            while ($row1 = $conn->fetch_array($r1)) {
                $html3 .= "<td style='color:#fff;' align='right'><b>" . ceil($row1['salary'] * $exrate) . "</b></td>";
            }
        } else
            $html3 .= "<td style='color:#fff;' align='right'><b>0</b></td>";
        $html3 .= "</tr>";

        // Totalurii salarii+pfa+extra/departamente/luni
        $q1 = "SELECT a.DepartmentID, a.Department FROM departments a INNER JOIN payroll b ON a.DepartmentID=b.DepartmentID WHERE 1=1 $depcond GROUP BY a.DepartmentID ORDER BY Department ASC";
        $r1 = $conn->query($q1);
        while ($row1 = $conn->fetch_array($r1)) {
            $q2 = "SELECT a.*,p.FullName,c.Department, SUM(a.Salary) AS salary FROM budget_consumed a
						INNER JOIN persons p ON a.PersonID=p.PersonID
		 				INNER JOIN payroll b ON a.PersonID=b.PersonID
		 				INNER JOIN departments c ON b.DepartmentID=c.DepartmentID
		 				WHERE (a.Type='salary' OR a.Type='bonus' OR a.Type='malus' OR a.Type='contract' OR a.Type='desplacement')
		 				AND c.DepartmentID={$row1['DepartmentID']}
		 				$cond
		 				GROUP BY DATE_FORMAT(CONCAT(a.Month,'-01'),'%Y')";

            $r2 = $conn->query($q2);
            if ($conn->get_num_rows($r2) > 0) {
                while ($row2 = $conn->fetch_array($r2)) {
                    $html3 .= "<td align='right'>" . ceil($row2['salary'] * $exrate) . "</td>";
                }
            } else
                $html3 .= "<td align='right'>0</td>";
            $html3 .= "</tr>";

        }

        // Total beneficii/luni
        $q1 = "SELECT a.*,p.FullName,c.Department, SUM(a.Salary) AS salary FROM budget_consumed a
						INNER JOIN persons p ON a.PersonID=p.PersonID
		 				INNER JOIN payroll b ON a.PersonID=b.PersonID
		 				INNER JOIN departments c ON b.DepartmentID=c.DepartmentID
		 				WHERE (a.Type='1' OR a.Type='2' OR a.Type='3' OR a.Type='4' OR a.Type='5' OR a.Type='6' OR a.Type='7' OR a.Type='8' OR a.Type='9' OR a.Type='10' OR a.Type='11' OR a.Type='12' OR a.Type='13')
		 				$cond
		 				GROUP BY DATE_FORMAT(CONCAT(a.Month,'-01'),'%Y')";

        $r1 = $conn->query($q1);
        $html3 .= "<tr bgcolor='#538DD5'>";
        if ($conn->get_num_rows($r1) > 0) {
            while ($row1 = $conn->fetch_array($r1)) {
                $html3 .= "<td style='color:#fff;' align='right'><b>" . ceil($row1['salary'] * $exrate) . "</b></td>";
            }
        } else
            $html3 .= "<td style='color:#fff;' align='right'><b>0</b></td>";
        $html3 .= "</tr>";

        // Totaluri beneficii/tipuri/luni
        foreach ($benefits as $benefitType => $benefit) {
            $q2 = "SELECT a.*,p.FullName,c.Department, SUM(a.Salary) AS salary FROM budget_consumed a
						INNER JOIN persons p ON a.PersonID=p.PersonID
		 				INNER JOIN payroll b ON a.PersonID=b.PersonID
		 				INNER JOIN departments c ON b.DepartmentID=c.DepartmentID
		 				WHERE a.Type='$benefitType'
		 				$cond
		 				GROUP BY DATE_FORMAT(CONCAT(a.Month,'-01'),'%Y')";

            $r2 = $conn->query($q2);
            if ($conn->get_num_rows($r2) > 0) {
                while ($row2 = $conn->fetch_array($r2)) {
                    $html3 .= "<td align='right'>" . ceil($row2['salary'] * $exrate) . "</td>";
                }
            } else
                $html3 .= "<td align='right'>0</td>";
            $html3 .= "</tr>";

        }
        ########################################

        // Totalurii salarii/oameni/departamente/luni
        $q1 = "SELECT a.DepartmentID, a.Department FROM departments a INNER JOIN payroll b ON a.DepartmentID=b.DepartmentID WHERE 1=1 $depcond GROUP BY a.DepartmentID ORDER BY Department ASC";
        $r1 = $conn->query($q1);
        while ($row1 = $conn->fetch_array($r1)) {
            // Departamente
            $html3 .= "<tr bgcolor='#95B3D7'>";
            $q2 = "SELECT a.*,c.Department, SUM(a.Salary) AS salary FROM budget_consumed a
		 				INNER JOIN payroll b ON a.PersonID=b.PersonID
		 				INNER JOIN departments c ON b.DepartmentID=c.DepartmentID
		 				WHERE c.DepartmentID={$row1['DepartmentID']}
		 				$cond
		 				GROUP BY DATE_FORMAT(CONCAT(a.Month,'-01'),'%Y'),b.DepartmentID";
            $r2 = $conn->query($q2);
            if ($conn->get_num_rows($r2) > 0) {
                while ($row2 = $conn->fetch_array($r2)) {
                    $html3 .= "<td align='right'>" . ceil($row2['salary'] * $exrate) . "</td>";
                }
            } else
                $html3 .= "<td align='right'>0</td>";
            $html3 .= "</tr>";

            // Listare Oameni
            $html2 .= "<tr>";
            $q4 = "SELECT a.* FROM persons a INNER JOIN payroll b ON a.PersonID=b.PersonID WHERE DepartmentID={$row1['DepartmentID']} $perscond";
            $r4 = $conn->query($q4);
            while ($row4 = $conn->fetch_array($r4)) {
                // Total costuri/Om
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY DATE_FORMAT(CONCAT(a.Month,'-01'),'%Y'), a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html3 .= "<td bgcolor='#B8CCE4' style='border-top:solid 1px #000;' align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else
                    $html3 .= "<td bgcolor='#B8CCE4' style='border-top:solid 1px #000;' align='right'>0</td>";
                $html3 .= "</tr>";
                // Total sal+pfa+bonus+malus/Om
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE (a.Type='salary' OR a.Type='bonus' OR a.Type='malus' OR a.Type='contract')
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY DATE_FORMAT(CONCAT(a.Month,'-01'),'%Y'), a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html3 .= "<td bgcolor='#DCE6F1' align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else
                    $html3 .= "<td bgcolor='#DCE6F1' align='right'>0</td>";
                $html3 .= "</tr>";
                // Salariu/Om
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='salary'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY DATE_FORMAT(CONCAT(a.Month,'-01'),'%Y'), a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html3 .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else
                    $html3 .= "<td align='right'>0</td>";
                $html3 .= "</tr>";
                // PFA/Om
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='contract'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY DATE_FORMAT(CONCAT(a.Month,'-01'),'%Y'), a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html3 .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else
                    $html3 .= "<td align='right'>0</td>";
                $html3 .= "</tr>";
                // Bonus/Om
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='bonus'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY DATE_FORMAT(CONCAT(a.Month,'-01'),'%Y'), a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html3 .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else
                    $html3 .= "<td align='right'>0</td>";
                $html3 .= "</tr>";
                // Malus/Om
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='malus'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY DATE_FORMAT(CONCAT(a.Month,'-01'),'%Y'), a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html3 .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else
                    $html3 .= "<td align='right'>0</td>";
                $html3 .= "</tr>";

                // Deplasari/Om
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='displacement'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY DATE_FORMAT(CONCAT(a.Month,'-01'),'%Y'), a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html3 .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else
                    $html3 .= "<td align='right'>0</td>";
                $html3 .= "</tr>";

                // Total beneficii/Om
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE (a.Type='1' OR a.Type='2' OR a.Type='3' OR a.Type='4' OR a.Type='5' OR a.Type='6' OR a.Type='7' OR a.Type='8' OR a.Type='9' OR a.Type='10' OR a.Type='11' OR a.Type='12' OR a.Type='13')
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY DATE_FORMAT(CONCAT(a.Month,'-01'),'%Y'), a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html3 .= "<td bgcolor='#DCE6F1' align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else
                    $html3 .= "<td bgcolor='#DCE6F1' align='right'>0</td>";
                $html3 .= "</tr>";
                // As sanatate/Om
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='1'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY DATE_FORMAT(CONCAT(a.Month,'-01'),'%Y'), a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html3 .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else
                    $html3 .= "<td align='right'>0</td>";
                $html3 .= "</tr>";
                // As viata /Om
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='2'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY DATE_FORMAT(CONCAT(a.Month,'-01'),'%Y'), a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html3 .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else
                    $html3 .= "<td align='right'>0</td>";
                $html3 .= "</tr>";
                // As pensie/Om
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='3'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY DATE_FORMAT(CONCAT(a.Month,'-01'),'%Y'), a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html3 .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else
                    $html3 .= "<td align='right'>0</td>";
                $html3 .= "</tr>";
                // Bonuri masa
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='4'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY DATE_FORMAT(CONCAT(a.Month,'-01'),'%Y'), a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html3 .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else
                    $html3 .= "<td align='right'>0</td>";
                $html3 .= "</tr>";
                // As stomato
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='5'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY DATE_FORMAT(CONCAT(a.Month,'-01'),'%Y'), a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html3 .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else
                    $html3 .= "<td align='right'>0</td>";
                $html3 .= "</tr>";
                // Tichete cadou
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='6'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY DATE_FORMAT(CONCAT(a.Month,'-01'),'%Y'), a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html3 .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else
                    $html3 .= "<td align='right'>0</td>";
                $html3 .= "</tr>";
                // Outplacement
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='7'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY DATE_FORMAT(CONCAT(a.Month,'-01'),'%Y'), a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html3 .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else
                    $html3 .= "<td align='right'>0</td>";
                $html3 .= "</tr>";
                // Training
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='8'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY DATE_FORMAT(CONCAT(a.Month,'-01'),'%Y'), a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html3 .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else
                    $html3 .= "<td align='right'>0</td>";
                $html3 .= "</tr>";
                // Cantina
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='9'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY DATE_FORMAT(CONCAT(a.Month,'-01'),'%Y'), a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html3 .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else
                    $html3 .= "<td align='right'>0</td>";
                $html3 .= "</tr>";
                // Masina serviciu
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='10'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY DATE_FORMAT(CONCAT(a.Month,'-01'),'%Y'), a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html3 .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else
                    $html3 .= "<td align='right'>0</td>";
                $html3 .= "</tr>";

                // Sportiv
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='11'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY DATE_FORMAT(CONCAT(a.Month,'-01'),'%Y'), a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html3 .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else
                    $html3 .= "<td align='right'>0</td>";
                $html3 .= "</tr>";

                // Pensii facultative
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='12'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY DATE_FORMAT(CONCAT(a.Month,'-01'),'%Y'), a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html3 .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else
                    $html3 .= "<td align='right'>0</td>";
                $html3 .= "</tr>";

                // Avantaj Natura
                $q3 = "SELECT SUM(a.Salary) AS salary FROM budget_consumed a
				 				WHERE a.Type='13'
				 				AND a.PersonID={$row4['PersonID']}
				 				$cond
				 				GROUP BY DATE_FORMAT(CONCAT(a.Month,'-01'),'%Y'), a.PersonID";
                $r3 = $conn->query($q3);
                if ($conn->get_num_rows($r3) > 0) {
                    while ($row3 = $conn->fetch_array($r3)) {
                        $html3 .= "<td align='right'>" . ceil($row3['salary'] * $exrate) . "</td>";
                    }
                } else
                    $html3 .= "<td align='right'>0</td>";
                $html3 .= "</tr>";

            }
        }

        //echo "<script type='text/javascript'>document.getElementById('loading').style.display = 'none';</script>";
        echo "<script type='text/javascript'>document.getElementById('loading').innerHTML = '<img src=images/loader.gif></img><br><br>Se afiseaza raportul...';</script>";

        $smarty->assign(array(
            'report_html' => $html,
            'report_html2' => $html2,
            'report_html3' => $html3,
            'StartDate' => Utils::toDisplayDate($StartDate),
            'EndDate' => Utils::toDisplayDate($EndDate),
            'LastGeneratedDate' => Utils::toDisplayTime(Budget::getLastGeneratedDate()),
            'self' => Company::getSelfCompanies(),
            'currencies' => Currency::getDefinedRates(date('Y'), $_SESSION['CURRENCY']['CURRENT']),
        ));

        if (!empty($_GET['export_doc'])) {
            $content = $smarty->fetch('budget_consumed_print.tpl');
            $content = preg_replace("/<img[^>]+\>/i", "", $content);
            echo $content;
            exit;
        }

        if (!empty($_GET['print'])) {
            $smarty->display('budget_consumed_print.tpl');
            exit;
        }

        $center_file = 'budget_consumed.tpl';

        break;

    case'graph_total':
        $smarty->assign(array(
            'budget_graph' => Budget::generateTotalGraph($_GET['CompanyID']),
        ));
        $smarty->display('budget_graphs.tpl');
        exit;

        break;
    case'graph_salary':
        $smarty->assign(array(
            'budget_graph' => Budget::generateSalaryGraph($_GET['CompanyID']),
        ));
        $smarty->display('budget_graphs.tpl');
        exit;
        break;

    case'graph_benefits':
        $smarty->assign(array(
            'budget_graph' => Budget::generateBenefitsGraph($_GET['CompanyID']),
        ));
        $smarty->display('budget_graphs.tpl');
        exit;
        break;

    default:
        $center_file = 'budget.tpl';
        break;

}
?>