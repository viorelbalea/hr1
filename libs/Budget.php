<?php

class Budget extends ConfigData
{

    ################################
    ### Functii Raport Buget  ######
    ################################

    // Salarii
    public static function computePersonSalaryMonthlyCost($PersonID, $currency, $StartDate, $EndDate)
    {
        global $conn;

        $dates = Utils::listWorkdays($StartDate, $EndDate, array_keys(Utils::$msLegal));
        $months = Utils::get_months($StartDate, $EndDate);
        $days = array();
        $costs = array();

        $currency_current = $_SESSION['CURRENCY']['CURRENT'];
        $exrate = empty($_SESSION['CURRENCY']['RATES'][date('Y')][$currency]['Rate']) ? 1 : $_SESSION['CURRENCY']['RATES'][date('Y')][$currency]['Rate'];

        foreach ($dates as $date) {
            $query = "SELECT PersonID AS ID,'$date' AS day, IF(Currency='$currency_current',salary,salary*(1/$exrate)) AS salary FROM persons_salary WHERE
					DATEDIFF('$date',StartDate)>=0
					AND DATEDIFF(IF(StopDate<>'0000-00-00',StopDate,CURRENT_TIMESTAMP),'$date')>=0
					AND PersonID=$PersonID
					ORDER BY ID DESC";
            //echo "<BR>";
            $conn->query($query);
            $row = $conn->fetch_array();
            //Utils::pa($row);
            $days[] = $row;
        }
        //exit;

        foreach ($months as $month) {
            //$res[$month][0] = countDaysInMonth($month);
            //$res[$month][1] = countWorkdaysInMonth($month, array_keys(Utils::$msLegal));
            foreach ($days as $day) {
                if (strrpos($day['day'], $month) !== false)
                    $costs[$month][$day['day']] = $day['salary'];
                else
                    $costs[$month][$day['day']] = '';

            }
        }
        //Utils::pa($costs);

        foreach ($costs as $month => $cost) {
            $avg_costs[$month] = array_sum($cost) / Utils::countWorkdaysInMonth($month, array_keys(Utils::$msLegal));
        }
        //Utils::pa($avg_costs);

        foreach ($months as $month) {
            if ($avg_costs[$month])
                $avg_costs_tot[$month] = $avg_costs[$month];
            else
                $avg_costs_tot[$month] = 0;
        }
        return $avg_costs_tot;
    }

    // Deplasari
    public static function computePersonDisplacementMonthlyCost($PersonID, $currency, $StartDate, $EndDate)
    {
        global $conn;

        $dates = Utils::listWorkdays($StartDate, $EndDate, array_keys(Utils::$msLegal));
        $months = Utils::get_months($StartDate, $EndDate);
        $days = array();
        $costs = array();

        $currency_current = $_SESSION['CURRENCY']['CURRENT'];
        $exrate = empty($_SESSION['CURRENCY']['RATES'][date('Y')][$currency]['Rate']) ? 1 : $_SESSION['CURRENCY']['RATES'][date('Y')][$currency]['Rate'];

        foreach ($dates as $date) {
            $query = "SELECT PersonID AS ID,'$date' AS day, IF(Currency='$currency_current',Cost,Cost*(1/$exrate)) AS salary FROM persons_displacement WHERE
					DATEDIFF('$date',StartDate)>=0
					AND DATEDIFF(IF(StopDate<>'0000-00-00',StopDate,CURRENT_TIMESTAMP),'$date')>=0
					AND PersonID=$PersonID
					ORDER BY ID DESC";
            //echo "<BR>";
            $conn->query($query);
            $row = $conn->fetch_array();
            //Utils::pa($row);
            $days[] = $row;
        }
        //exit;

        foreach ($months as $month) {
            //$res[$month][0] = countDaysInMonth($month);
            //$res[$month][1] = countWorkdaysInMonth($month, array_keys(Utils::$msLegal));
            foreach ($days as $day) {
                if (strrpos($day['day'], $month) !== false)
                    $costs[$month][$day['day']] = $day['salary'];
                else
                    $costs[$month][$day['day']] = '';

            }
        }
        //Utils::pa($costs);

        foreach ($costs as $month => $cost) {
            $avg_costs[$month] = array_sum($cost) / Utils::countWorkdaysInMonth($month, array_keys(Utils::$msLegal));
        }
        //Utils::pa($avg_costs);

        foreach ($months as $month) {
            if ($avg_costs[$month])
                $avg_costs_tot[$month] = $avg_costs[$month];
            else
                $avg_costs_tot[$month] = 0;
        }
        return $avg_costs_tot;
    }


    // PFA
    public static function computePersonPFAMonthlyCost($PersonID, $currency, $StartDate, $EndDate)
    {
        global $conn;

        $dates = Utils::listWorkdays($StartDate, $EndDate, array_keys(Utils::$msLegal));
        $months = Utils::get_months($StartDate, $EndDate);
        $days = array();
        $costs = array();

        $currency_current = $_SESSION['CURRENCY']['CURRENT'];
        $exrate = empty($_SESSION['CURRENCY']['RATES'][date('Y')][$currency]['Rate']) ? 1 : $_SESSION['CURRENCY']['RATES'][date('Y')][$currency]['Rate'];

        foreach ($dates as $date) {
            $query = "SELECT PersonID AS ID,'$date' AS day, IF(Currency='$currency',salary,salary*(1/$exrate)) AS salary FROM persons_salary_pfa WHERE
					DATEDIFF('$date',StartDate)>=0
					AND DATEDIFF(IF(StopDate<>'0000-00-00',StopDate,CURRENT_TIMESTAMP),'$date')>=0
					AND PersonID=$PersonID
					ORDER BY ID DESC";
            //echo "<BR>";
            $conn->query($query);
            $row = $conn->fetch_array();
            //Utils::pa($row);
            $days[] = $row;
        }

        foreach ($months as $month) {
            //$res[$month][0] = countDaysInMonth($month);
            //$res[$month][1] = countWorkdaysInMonth($month, array_keys(Utils::$msLegal));
            foreach ($days as $day) {
                if (strrpos($day['day'], $month) !== false)
                    $costs[$month][$day['day']] = $day['salary'];
                else
                    $costs[$month][$day['day']] = '';

            }
        }
        //Utils::pa($costs);

        foreach ($costs as $month => $cost) {
            $avg_costs[$month] = array_sum($cost) / Utils::countWorkdaysInMonth($month, array_keys(Utils::$msLegal));
        }
        //Utils::pa($avg_costs);

        foreach ($months as $month) {
            if ($avg_costs[$month])
                $avg_costs_tot[$month] = $avg_costs[$month];
            else
                $avg_costs_tot[$month] = 0;
        }
        return $avg_costs_tot;
    }

    // Bonus
    public static function computePersonBonusMonthlyCost($PersonID, $currency, $StartDate, $EndDate)
    {
        global $conn;

        $dates = Utils::listWorkdays($StartDate, $EndDate, array_keys(Utils::$msLegal));
        $months = Utils::get_months($StartDate, $EndDate);

        $currency_current = $_SESSION['CURRENCY']['CURRENT'];
        $exrate = empty($_SESSION['CURRENCY']['RATES'][date('Y')][$currency]['Rate']) ? 1 : $_SESSION['CURRENCY']['RATES'][date('Y')][$currency]['Rate'];

        foreach ($months as $month) {
            $query = "SELECT PersonID AS ID,'$month' AS month, IF(Currency='$currency',SUM(salary),SUM(salary)*(1/$exrate)) AS salary FROM persons_salary_extra WHERE
					DATE_FORMAT(StartDate,'%Y-%m')='$month'
					AND PersonID=$PersonID
					AND Type='bonus'
					GROUP BY MONTH(StartDate)
					ORDER BY ID DESC";
            //echo "<BR>";
            $conn->query($query);
            $row = $conn->fetch_array();
            //Utils::pa($row);
            //$days[]=$row;

            if (strrpos($row['month'], $month) !== false)
                $costs[$month][$row['month']] = $row['salary'];
            else
                $costs[$month][$row['month']] = '';

        }


        foreach ($costs as $month => $cost) {
            $avg_costs[$month] = array_sum($cost);
        }
        //Utils::pa($avg_costs);

        foreach ($months as $month) {
            if ($avg_costs[$month])
                $avg_costs_tot[$month] = $avg_costs[$month];
            else
                $avg_costs_tot[$month] = 0;
        }
        return $avg_costs_tot;
    }


    // Malus
    public static function computePersonMalusMonthlyCost($PersonID, $currency, $StartDate, $EndDate)
    {
        global $conn;

        $dates = Utils::listWorkdays($StartDate, $EndDate, array_keys(Utils::$msLegal));
        $months = Utils::get_months($StartDate, $EndDate);

        $currency_current = $_SESSION['CURRENCY']['CURRENT'];
        $exrate = empty($_SESSION['CURRENCY']['RATES'][date('Y')][$currency]['Rate']) ? 1 : $_SESSION['CURRENCY']['RATES'][date('Y')][$currency]['Rate'];

        foreach ($months as $month) {
            $query = "SELECT PersonID AS ID,'$month' AS month, IF(Currency='$currency',SUM(salary),SUM(salary)*(1/$exrate)) AS salary FROM persons_salary_extra WHERE
					DATE_FORMAT(StartDate,'%Y-%m')='$month'
					AND PersonID=$PersonID
					AND Type='malus'
					GROUP BY MONTH(StartDate)
					ORDER BY ID DESC";
            //echo "<BR>";
            $conn->query($query);
            $row = $conn->fetch_array();
            //Utils::pa($row);
            //$days[]=$row;

            if (strrpos($row['month'], $month) !== false)
                $costs[$month][$row['month']] = $row['salary'];
            else
                $costs[$month][$row['month']] = '';

        }


        foreach ($costs as $month => $cost) {
            $avg_costs[$month] = array_sum($cost);
        }
        //Utils::pa($avg_costs);

        foreach ($months as $month) {
            if ($avg_costs[$month])
                $avg_costs_tot[$month] = $avg_costs[$month];
            else
                $avg_costs_tot[$month] = 0;
        }
        return $avg_costs_tot;
    }

    // Beneficii
    public static function computePersonBenefitsMonthlyCost($PersonID, $currency, $BenefitType, $StartDate, $EndDate)
    {
        global $conn;

        $dates = Utils::listWorkdays($StartDate, $EndDate, array_keys(Utils::$msLegal));
        $months = Utils::get_months($StartDate, $EndDate);
        $days = array();
        $costs = array();

        $currency_current = $_SESSION['CURRENCY']['CURRENT'];
        $exrate = empty($_SESSION['CURRENCY']['RATES'][date('Y')][$currency]['Rate']) ? 1 : $_SESSION['CURRENCY']['RATES'][date('Y')][$currency]['Rate'];

        foreach ($dates as $date) {
            $query = "SELECT PersonID AS ID,'$date' AS day, IF(Currency='$currency',TotalCost,TotalCost*(1/$exrate)) AS salary FROM persons_beneficii WHERE
					DATEDIFF('$date',RegDate)>=0
					AND DATEDIFF(IF(EndDate<>'0000-00-00',EndDate,CURRENT_TIMESTAMP),'$date')>=0
					AND PersonID=$PersonID
					AND Type=$BenefitType
					ORDER BY ID DESC";
            //echo "<BR>";
            $conn->query($query);
            $row = $conn->fetch_array();
            //Utils::pa($row);
            $days[] = $row;
        }

        foreach ($months as $month) {
            //$res[$month][0] = countDaysInMonth($month);
            //$res[$month][1] = countWorkdaysInMonth($month, array_keys(Utils::$msLegal));
            foreach ($days as $day) {
                if (strrpos($day['day'], $month) !== false)
                    $costs[$month][$day['day']] = $day['salary'];
                else
                    $costs[$month][$day['day']] = '';

            }
        }
        //Utils::pa($costs);

        foreach ($costs as $month => $cost) {
            $avg_costs[$month] = array_sum($cost) / Utils::countWorkdaysInMonth($month, array_keys(Utils::$msLegal));
        }
        //Utils::pa($avg_costs);

        foreach ($months as $month) {
            if ($avg_costs[$month])
                $avg_costs_tot[$month] = $avg_costs[$month];
            else
                $avg_costs_tot[$month] = 0;
        }
        return $avg_costs_tot;
    }

    public static function editConsumedPeriod($PeriodID)
    {

        global $conn;

        if ($PeriodID > 0 && !empty($_GET['del'])) {
            $conn->query("DELETE FROM budget_consumed_periods WHERE  PeriodID = $PeriodID");
        } else {
            if (!empty($_POST['YearStart']) && !empty($_POST['MonthStart']))
                $StartDate = $_POST['YearStart'] . '-' . $_POST['MonthStart'] . '-01';
            else
                $StartDate = date('Y') . '-01-01';
            if (!empty($_POST['YearEnd']) && !empty($_POST['MonthEnd']))
                $EndDate = $_POST['YearEnd'] . '-' . $_POST['MonthEnd'] . '-01';
            else
                $EndDate = date('Y') . '-01-01';

            $Status = (int)$_POST['Status'];

            if ($PeriodID > 0) {
                $conn->query("UPDATE budget_consumed_periods SET Status=0");
                $conn->query("UPDATE budget_consumed_periods SET StartDate = '$StartDate', EndDate = '$EndDate', Status=$Status WHERE PeriodID = $PeriodID");
            } else {
                if ($Status == 1)
                    $conn->query("UPDATE budget_consumed_periods SET Status=0");
                $conn->query("INSERT INTO budget_consumed_periods SET StartDate = '$StartDate', EndDate = '$EndDate', Status=$Status");
            }
        }
    }

    public static function updateConsumedLastGeneratedDate()
    {
        global $conn;
        $query = "UPDATE budget_consumed_periods SET LastGeneratedDate=CURRENT_TIMESTAMP WHERE Status=1";
        $conn->query($query);

    }

    public static function getConsumedStartDate()
    {
        global $conn;
        $conn->query("SELECT StartDate FROM budget_consumed_periods WHERE Status=1");
        $row = $conn->fetch_array();
        return !$row['StartDate'] ? date('Y') . '-01-01' : $row['StartDate'];
    }

    public static function getConsumedEndDate()
    {
        global $conn;
        $conn->query("SELECT EndDate FROM budget_consumed_periods WHERE Status=1");
        $row = $conn->fetch_array();
        return !$row['EndDate'] ? date('Y') . '-12-31' : $row['EndDate'];
    }

    public static function getLastGeneratedDate()
    {
        global $conn;
        $conn->query("SELECT LastGeneratedDate FROM budget_consumed_periods WHERE Status=1");
        $row = $conn->fetch_array();
        return $row['LastGeneratedDate'];
    }

    public static function getConsumedPeriods()
    {
        global $conn;
        $conn->query("SELECT *,DATE_FORMAT(StartDate,'%Y') AS YearStart, DATE_FORMAT(StartDate,'%m') AS MonthStart,
							 DATE_FORMAT(EndDate,'%Y') AS YearEnd, DATE_FORMAT(EndDate,'%m') AS MonthEnd
						FROM budget_consumed_periods");
        while ($row = $conn->fetch_array()) {
            $res[$row['PeriodID']] = $row;
        }
        $res[0] = array();
        return $res;
    }

    public static function deleteBudgetConsumedData()
    {

        global $conn;
        $conn->query("TRUNCATE TABLE budget_consumed");
    }

    public static function generateTotalGraph($CompanyID)
    {

        include("chart/pChart/pData.php");
        include("chart/pChart/pChart.php");

        global $conn;

        if (!empty($CompanyID)) {
            $cond = " AND a.CompanyID=$CompanyID ";
            $depcond = " AND b.CompanyID=$CompanyID ";
        }

        // Dataset definition
        $DataSet = new pData;

        $q1 = "SELECT a.DepartmentID, a.Department FROM departments a INNER JOIN payroll b ON a.DepartmentID=b.DepartmentID WHERE 1=1 $depcond GROUP BY a.DepartmentID  ORDER BY Department ASC";
        $r1 = $conn->query($q1);
        while ($row1 = $conn->fetch_array($r1)) {
            $depts[$row1['DepartmentID']] = $row1['Department'];
        }

        foreach ($depts as $deptId => $dept) {
            $q2 = "SELECT a.*,p.FullName,c.Department, SUM(a.Salary) AS salary FROM budget_consumed a
					INNER JOIN persons p ON a.PersonID=p.PersonID
	 				INNER JOIN payroll b ON a.PersonID=b.PersonID
	 				INNER JOIN departments c ON b.DepartmentID=c.DepartmentID
	 				WHERE c.DepartmentID=$deptId
					$cond
	 				GROUP BY a.Month";
            $r2 = $conn->query($q2);
            while ($row2 = $conn->fetch_array($r2)) {
                $salary_arr[$deptId][] = ceil($row2['salary']);
                $months_arr[$deptId][] = $row2['Month'];

            }

            $DataSet->AddPoint($salary_arr[$deptId], $deptId);
            $DataSet->AddSerie($deptId);
            $DataSet->SetSerieName($dept, $deptId);
        }
        //Utils::pa($months_arr);
        $DataSet->AddPoint(end($months_arr), "XLabels");
        $DataSet->SetAbsciseLabelSerie("XLabels");

        $DataSet->SetYAxisName("Cost (euro)");
        $DataSet->SetXAxisName("Month");

        // Initialise the graph
        $Test = new pChart(700, 610);
        $Test->setFontProperties("libs/chart/Fonts/tahoma.ttf", 8);
        $Test->setGraphArea(85, 30, 650, 220);
        $Test->drawFilledRoundedRectangle(7, 7, 693, 223, 5, 240, 240, 240);
        $Test->drawRoundedRectangle(5, 5, 695, 225, 5, 230, 230, 230);
        $Test->drawGraphArea(255, 255, 255, TRUE);
        $Test->drawScale($DataSet->GetData(), $DataSet->GetDataDescription(), SCALE_NORMAL, 150, 150, 150, TRUE, 0, 2);
        $Test->drawGrid(4, TRUE, 230, 230, 230, 50);

        // Draw the 0 line
        $Test->setFontProperties("libs/chart/Fonts/tahoma.ttf", 6);
        $Test->drawTreshold(0, 143, 55, 72, TRUE, TRUE);

        // Draw the line graph
        $Test->drawLineGraph($DataSet->GetData(), $DataSet->GetDataDescription());
        $Test->drawPlotGraph($DataSet->GetData(), $DataSet->GetDataDescription(), 3, 2, 255, 255, 255);

        // Finish the graph
        $Test->setFontProperties("libs/chart/Fonts/tahoma.ttf", 8);
        $Test->drawLegend(5, 260, $DataSet->GetDataDescription(), 255, 255, 255);
        $Test->setFontProperties("libs/chart/Fonts/tahoma.ttf", 10);
        $Test->drawTitle(60, 22, "Total/ Departamente", 50, 50, 50, 585);
        $Test->Render("graphs/total_graph.png");

        return "graphs/total_graph.png";
    }

    public static function generateSalaryGraph($CompanyID)
    {

        include("chart/pChart/pData.php");
        include("chart/pChart/pChart.php");

        global $conn;

        if (!empty($CompanyID)) {
            $cond = " AND a.CompanyID=$CompanyID ";
            $depcond = " AND b.CompanyID=$CompanyID ";
        }

        // Dataset definition
        $DataSet = new pData;

        $q1 = "SELECT a.DepartmentID, a.Department FROM departments a INNER JOIN payroll b ON a.DepartmentID=b.DepartmentID WHERE 1=1 $depcond GROUP BY a.DepartmentID  ORDER BY Department ASC";
        $r1 = $conn->query($q1);
        while ($row1 = $conn->fetch_array($r1)) {
            $depts[$row1['DepartmentID']] = $row1['Department'];
        }

        foreach ($depts as $deptId => $dept) {
            $q2 = "SELECT a.*,p.FullName,c.Department, SUM(a.Salary) AS salary FROM budget_consumed a
					INNER JOIN persons p ON a.PersonID=p.PersonID
	 				INNER JOIN payroll b ON a.PersonID=b.PersonID
	 				INNER JOIN departments c ON b.DepartmentID=c.DepartmentID
	 				WHERE (a.Type='salary' OR a.Type='bonus' OR a.Type='malus' OR a.Type='contract')
	 				AND c.DepartmentID=$deptId
					$cond
	 				GROUP BY a.Month";
            $r2 = $conn->query($q2);
            while ($row2 = $conn->fetch_array($r2)) {
                $salary_arr[$deptId][] = ceil($row2['salary']);
                $months_arr[$deptId][] = $row2['Month'];

            }

            $DataSet->AddPoint($salary_arr[$deptId], $deptId);
            $DataSet->AddSerie($deptId);
            $DataSet->SetSerieName($dept, $deptId);
        }
        //Utils::pa($months_arr);
        $DataSet->AddPoint(end($months_arr), "XLabels");
        $DataSet->SetAbsciseLabelSerie("XLabels");
        $DataSet->SetYAxisName("Cost (euro)");
        $DataSet->SetXAxisName("Month");

        // Initialise the graph
        $Test = new pChart(700, 610);
        $Test->setFontProperties("libs/chart/Fonts/tahoma.ttf", 8);
        $Test->setGraphArea(85, 30, 650, 220);
        $Test->drawFilledRoundedRectangle(7, 7, 693, 223, 5, 240, 240, 240);
        $Test->drawRoundedRectangle(5, 5, 695, 225, 5, 230, 230, 230);
        $Test->drawGraphArea(255, 255, 255, TRUE);
        $Test->drawScale($DataSet->GetData(), $DataSet->GetDataDescription(), SCALE_NORMAL, 150, 150, 150, TRUE, 0, 2);
        $Test->drawGrid(4, TRUE, 230, 230, 230, 50);

        // Draw the 0 line
        $Test->setFontProperties("libs/chart/Fonts/tahoma.ttf", 6);
        $Test->drawTreshold(0, 143, 55, 72, TRUE, TRUE);

        // Draw the line graph
        $Test->drawLineGraph($DataSet->GetData(), $DataSet->GetDataDescription());
        $Test->drawPlotGraph($DataSet->GetData(), $DataSet->GetDataDescription(), 3, 2, 255, 255, 255);

        // Finish the graph
        $Test->setFontProperties("libs/chart/Fonts/tahoma.ttf", 8);
        $Test->drawLegend(5, 260, $DataSet->GetDataDescription(), 255, 255, 255);
        $Test->setFontProperties("libs/chart/Fonts/tahoma.ttf", 10);
        $Test->drawTitle(60, 22, "Salarii/ Departamente", 50, 50, 50, 585);
        $Test->Render("graphs/salary_graph.png");

        return "graphs/salary_graph.png";
    }


    public static function generateBenefitsGraph($CompanyID)
    {

        include("chart/pChart/pData.php");
        include("chart/pChart/pChart.php");

        global $conn;

        if (!empty($CompanyID)) {
            $cond = " AND a.CompanyID=$CompanyID ";
            $depcond = " AND b.CompanyID=$CompanyID ";
        }

        // Dataset definition
        $DataSet = new pData;

        $q1 = "SELECT a.*,p.FullName,c.Department, SUM(a.Salary) AS salary FROM budget_consumed a
						INNER JOIN persons p ON a.PersonID=p.PersonID
		 				INNER JOIN payroll b ON a.PersonID=b.PersonID
		 				INNER JOIN departments c ON b.DepartmentID=c.DepartmentID
		 				WHERE (a.Type='1' OR a.Type='2' OR a.Type='3' OR a.Type='4' OR a.Type='5' OR a.Type='6' OR a.Type='7' OR a.Type='8' OR a.Type='9' OR a.Type='10')
		 				$cond
		 				GROUP BY a.Month";

        $r1 = $conn->query($q1);
        while ($row1 = $conn->fetch_array($r1)) {
            $salary_arr[$deptId][] = ceil($row1['salary']);
            $months_arr[$deptId][] = $row1['Month'];

        }

        foreach (self::$msBenefits as $benefitType => $benefit) {
            $q2 = "SELECT a.*,p.FullName,c.Department, SUM(a.Salary) AS salary FROM budget_consumed a
						INNER JOIN persons p ON a.PersonID=p.PersonID
		 				INNER JOIN payroll b ON a.PersonID=b.PersonID
		 				INNER JOIN departments c ON b.DepartmentID=c.DepartmentID
		 				WHERE a.Type='$benefitType'
		 				$cond
		 				GROUP BY a.Month";

            $r2 = $conn->query($q2);

            while ($row2 = $conn->fetch_array($r2)) {
                $salary_arr[$benefitType][] = ceil($row2['salary']);
                $months_arr[$benefitType][] = $row2['Month'];
            }

            $DataSet->AddPoint($salary_arr[$benefitType], $benefitType);
            $DataSet->AddSerie($benefitType);
            $DataSet->SetSerieName($benefit, $benefitType);
        }

        //Utils::pa($months_arr);
        $DataSet->AddPoint(end($months_arr), "XLabels");
        $DataSet->SetAbsciseLabelSerie("XLabels");
        $DataSet->SetYAxisName("Cost (euro)");
        $DataSet->SetXAxisName("Month");

        // Initialise the graph
        $Test = new pChart(700, 400);
        $Test->setFontProperties("libs/chart/Fonts/tahoma.ttf", 8);
        $Test->setGraphArea(85, 30, 650, 220);
        $Test->drawFilledRoundedRectangle(7, 7, 693, 223, 5, 240, 240, 240);
        $Test->drawRoundedRectangle(5, 5, 695, 225, 5, 230, 230, 230);
        $Test->drawGraphArea(255, 255, 255, TRUE);
        $Test->drawScale($DataSet->GetData(), $DataSet->GetDataDescription(), SCALE_NORMAL, 150, 150, 150, TRUE, 0, 2);
        $Test->drawGrid(4, TRUE, 230, 230, 230, 50);

        // Draw the 0 line
        $Test->setFontProperties("libs/chart/Fonts/tahoma.ttf", 6);
        $Test->drawTreshold(0, 143, 55, 72, TRUE, TRUE);

        // Draw the line graph
        $Test->drawLineGraph($DataSet->GetData(), $DataSet->GetDataDescription());
        $Test->drawPlotGraph($DataSet->GetData(), $DataSet->GetDataDescription(), 3, 2, 255, 255, 255);

        // Finish the graph
        $Test->setFontProperties("libs/chart/Fonts/tahoma.ttf", 8);
        $Test->drawLegend(5, 260, $DataSet->GetDataDescription(), 255, 255, 255);
        $Test->setFontProperties("libs/chart/Fonts/tahoma.ttf", 10);
        $Test->drawTitle(60, 22, "Beneficii", 50, 50, 50, 585);
        $Test->Render("graphs/benefits_graph.png");

        return "graphs/benefits_graph.png";
    }

}