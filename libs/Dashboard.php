<?php

class Dashboard extends ConfigData
{

    public static function getDepartments($CompanyID)
    {
        $q1 = "SELECT a.DepartmentID, a.Department FROM departments a INNER JOIN payroll b ON a.DepartmentID=b.DepartmentID WHERE 1=1 $cond GROUP BY a.DepartmentID ORDER BY Department ASC";
        $r1 = $conn->query($q1);
        while ($row1 = $conn->fetch_array($r1)) {
            //Utils::pa($row1);
            $departments[$row1['DepartmentID']] = $row1['Department'];

        }
        return $departments;
    }

    public static function getEmployees()
    {

        global $conn;

        $cond = "";

        $res = array();
        //radu: modificat rand 65 inner join devine right join si cu ocazia asta apar in dashboard companiile fara angajati
        $query = "SELECT c.CompanyID,c.CompanyName, 
                    (SELECT COUNT(*) FROM persons x INNER JOIN payroll y ON x.PersonID=y.PersonID WHERE x.Status=2 AND y.CompanyID=c.CompanyID) AS TotalEmployees,
                    (SELECT COUNT(*) FROM persons x INNER JOIN payroll y ON x.PersonID=y.PersonID WHERE x.Status=2 AND y.CompanyID=c.CompanyID AND y.ContractType=2) AS NoEmployeesUndet,
                    (SELECT COUNT(*) FROM persons x INNER JOIN payroll y ON x.PersonID=y.PersonID WHERE x.Status=2 AND y.CompanyID=c.CompanyID AND y.ContractType=1) AS NoEmployeesDet,
                    (SELECT COUNT(*) FROM persons x INNER JOIN payroll y ON x.PersonID=y.PersonID WHERE x.Status=7 AND y.CompanyID=c.CompanyID) AS TotalCollaborators,
                    (SELECT COUNT(*) FROM persons x INNER JOIN payroll y ON x.PersonID=y.PersonID WHERE x.Status IN (2,7) AND YEAR(y.StartDate) = YEAR(CURDATE()) AND y.CompanyID=c.CompanyID) AS TotalIN,
                    (SELECT COUNT(*) FROM persons x INNER JOIN payroll y ON x.PersonID=y.PersonID WHERE x.Status NOT IN (2,7) AND YEAR(y.StopDate) = YEAR(CURDATE()) AND y.CompanyID=c.CompanyID) AS TotalOUT
                  FROM persons a
	    		  INNER JOIN payroll b ON a.PersonID=b.PersonID
	    		  RIGHT JOIN companies c ON b.CompanyID=c.CompanyID
	    		  WHERE c.Self=1 $cond
                  GROUP BY c.CompanyID
                  ORDER BY c.CompanyName
                  ";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $res[$row['CompanyID']] = $row;
        }
        return $res;
    }

    public static function countTickets()
    {
        global $conn;
        $res = array();
        $conn->query("SELECT a.Status, COUNT(*) NoTickets, (SELECT COUNT(*) FROM ticketing) AS TotalTickets FROM   ticketing a
        		      WHERE  1=1 
        		      GROUP BY a.Status
                      ORDER  BY a.Status");
        while ($row = $conn->fetch_array()) {
            $res[0] = $row['TotalTickets'];
            $row['StatusName'] = ConfigData::$msTicketingStatus[$row['Status']];
            $res[$row['Status']] = $row;
        }

        //Utils::pa($res);
        return $res;
    }

    public static function generateTotalGraph($CompanyID)
    {

        include("chart/pChart/pData.php");
        include("chart/pChart/pChart.php");

        global $conn;

        $currency = empty($_GET['Currency']) ? $_SESSION['CURRENCY']['CURRENT'] : $_GET['Currency'];
        $StartDate = Budget::getConsumedStartDate();
        $EndDate = Budget::getConsumedEndDate();
        $months_arr = Utils::get_months($StartDate, $EndDate);

        foreach ($months_arr as $month) {
            $months_arr_str[] = date('M', mktime(0, 0, 0, substr($month, 5, 2), 1, 2000));
        }

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

        $budgets = self::getBudgetDepartments();


        foreach ($depts as $deptId => $dept) {
            $DataSet->AddPoint($budgets[$deptId], $deptId);
            $DataSet->AddSerie($deptId);
            $DataSet->SetSerieName($dept, $deptId);
        }

        //Utils::pa($months_arr);
        $DataSet->AddPoint($months_arr_str, "XLabels");
        $DataSet->SetAbsciseLabelSerie("XLabels");

        $DataSet->SetYAxisName("Cost ($currency)");
        $DataSet->SetXAxisName("Month");

        // Initialise the graph
        $Test = new pChart(570, 400);
        $Test->setFontProperties("libs/chart/Fonts/tahoma.ttf", 8);
        $Test->setGraphArea(55, 30, 550, 190);
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
        $Test->drawTitle(60, 22, "Total/ Departamente " . date('Y'), 50, 50, 50, 585);
        $Test->Render("graphs/dashboard_total_graph.png");

        return "graphs/dashboard_total_graph.png";
    }

    public static function getBudgetDepartments()
    {

        global $conn;
        // Totalurii departamente/luni

        $currency = empty($_GET['Currency']) ? $_SESSION['CURRENCY']['CURRENT'] : $_GET['Currency'];
        $exrate = empty($_GET['Currency']) || empty($_SESSION['CURRENCY']['RATES'][date('Y')][$currency]['Rate']) ? 1 : $_SESSION['CURRENCY']['RATES'][date('Y')][$currency]['Rate'];

        $StartDate = Budget::getConsumedStartDate();
        $EndDate = Budget::getConsumedEndDate();
        $months = Utils::get_months($StartDate, $EndDate);

        $q1 = "SELECT a.DepartmentID, a.Department FROM departments a INNER JOIN payroll b ON a.DepartmentID=b.DepartmentID WHERE 1=1 $cond GROUP BY a.DepartmentID ORDER BY Department ASC";
        $r1 = $conn->query($q1);
        while ($row1 = $conn->fetch_array($r1)) {
            //Utils::pa($row1);
            $departments[$row1['DepartmentID']] = $row1['Department'];

        }


        $q2 = "SELECT a.*,p.FullName,c.Department,c.DepartmentID, SUM(a.Salary) AS salary FROM budget_consumed a
					INNER JOIN persons p ON a.PersonID=p.PersonID
	 				INNER JOIN payroll b ON a.PersonID=b.PersonID
	 				INNER JOIN departments c ON b.DepartmentID=c.DepartmentID
	 				GROUP BY a.Month";

        $r2 = $conn->query($q2);
        while ($row2 = $conn->fetch_array($r2)) {
            //Utils::pa($row2);
            $budget[$row2['DepartmentID']][$row2['Month']] = ceil($row2['salary'] * $exrate);
        }

        foreach ($departments AS $DepartmentID => $Department) {
            foreach ($months as $month) {
                $budgets_structure[$DepartmentID][$month] = !empty($budget[$DepartmentID][$month]) ? $budget[$DepartmentID][$month] : 0;
            }
        }
        //Utils::pa($budgets_structure);
        return $budgets_structure;
    }

}

?>