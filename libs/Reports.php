<?php

class Reports
{

    public static function getReports()
    {

        global $conn;

        $reports = array();

        if (!empty($_GET['GroupID'])) {
            $cond = " AND GroupID = " . (int)$_GET['GroupID'];
        } else {
            $cond = "";
        }

        if ($_SESSION['USER_ID'] == 1) {
            $query = "SELECT ReportID, Report FROM reports WHERE ModuleID = 7 AND Status = 1 $cond ORDER BY Report";
        } elseif (isset($_SESSION['REPORT_RIGHTS'][7])) {
            $query = "SELECT ReportID, Report FROM reports WHERE Status=1 AND ReportID IN (" . implode(',', $_SESSION['REPORT_RIGHTS'][7]) . ") $cond ORDER BY Report";
        } else {
            return $reports;
        }

        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $reports[] = $row;
        }

        return $reports;
    }

    //set report data, visibility & order
    // $fieldArray => array(array('name1', 'label1', 'align1'), array('name2', 'label2', 'align2'), etc.)
    // dataArray = array of data to be displayed on the table
    // $idx = index of the first column displayed
    public static function setReportDVO($reportID, $fieldArray, $dataArray, $idx = 1)
    {
        $i = 0;
        $fields = array();

        foreach ($fieldArray as $field) {
            $fields[$reportID][$i]['name'] = $field[0];
            $fields[$reportID][$i]['label'] = $field[1];
            $fields[$reportID][$i]['align'] = (isset($field[2])) ? $field[2] : 'left';

            $i += 1;
        }

        $_SESSION['report_fields_names'][$reportID] = $fields[$reportID];

        if (!empty($dataArray)) {
            foreach ($dataArray as $data) {
                for ($j = 0; $j < $i; $j++) {
                    $fields[$reportID][$j]['data'][] = $data[$fields[$reportID][$j]['name']];
                }
            }
        }

        // Report visibility&order settings
        $fields_order[$reportID] = array();
        for ($j = 0; $j < $i; $j++) {
            $fields_order[$reportID][] = array('field_id' => $j, 'visible' => true, 'position' => $j + $idx);
        }

        // Save order in session
        if (empty($_SESSION['report_fields_order'][$reportID])) {
            $_SESSION['report_fields_order'][$reportID] = $fields_order[$reportID];
        }
        // Set reorder of data
        foreach ($_SESSION['report_fields_order'][$reportID] as $k => $v) {
            if ($v['visible'])
                $fields_final[$reportID][] = $fields[$reportID][$v['field_id']];
        }

        return $fields_final[$reportID];
    }

    public static function getReportFilters($reportID)
    {
        $filters = array();
        switch ($reportID) {
            case 31:
                $filters[] = array('name' => 'StartDate', 'label' => 'Data inceput', 'mandatory' => true);
                $filters[] = array('name' => 'EndDate', 'label' => 'Data sfarsit', 'mandatory' => true);
                $filters[] = array('name' => 'CompanyID', 'label' => 'Companie self', 'mandatory' => false);
                $filters[] = array('name' => 'DivisionID', 'label' => 'Divizie', 'mandatory' => false);
                $filters[] = array('name' => 'DepartmentID', 'label' => 'Departament', 'mandatory' => false);
                $filters[] = array('name' => 'ViewAll', 'label' => 'Toti angajatii', 'mandatory' => false);
                $filters[] = array('name' => 'VacationType', 'label' => 'Tip concediu', 'mandatory' => false);
                break;

            case 33:
            case 35:
            case 87:
            case 88:
                $filters[] = array('name' => 'StartDate', 'label' => 'Data inceput', 'mandatory' => true);
                $filters[] = array('name' => 'EndDate', 'label' => 'Data sfarsit', 'mandatory' => true);
                $filters[] = array('name' => 'CompanyID', 'label' => 'Companie', 'mandatory' => false);
                $filters[] = array('name' => 'DivisionID', 'label' => 'Divizie', 'mandatory' => false);
                $filters[] = array('name' => 'DepartmentID', 'label' => 'Departament', 'mandatory' => false);
                $filters[] = array('name' => 'SubdepartmentID', 'label' => 'Subdepartament', 'mandatory' => false);
                $filters[] = array('name' => 'Status', 'label' => 'Status', 'mandatory' => false);
                $filters[] = array('name' => 'ContractType', 'label' => 'Tip contract', 'mandatory' => false);
                break;

            case 34:
                $filters[] = array('name' => 'StartDate', 'label' => 'Data inceput', 'mandatory' => true);
                $filters[] = array('name' => 'EndDate', 'label' => 'Data sfarsit', 'mandatory' => true);
                $filters[] = array('name' => 'Status', 'label' => 'Status', 'mandatory' => false);
                $filters[] = array('name' => 'ContractType', 'label' => 'Tip contract', 'mandatory' => false);
                break;

            case 36:
                $filters[] = array('name' => 'Year', 'label' => 'An', 'mandatory' => true);
                $filters[] = array('name' => 'DivisionID', 'label' => 'Divizie', 'mandatory' => false);
                $filters[] = array('name' => 'DepartmentID', 'label' => 'Departament', 'mandatory' => false);
                $filters[] = array('name' => 'TrainingTypeID', 'label' => 'Tip training', 'mandatory' => false);
                break;

            case 37:
                $filters[] = array('name' => 'StartDate', 'label' => 'Data inceput', 'mandatory' => true);
                $filters[] = array('name' => 'EndDate', 'label' => 'Data sfarsit', 'mandatory' => true);
                $filters[] = array('name' => 'Type', 'label' => 'Tip actiune', 'mandatory' => false);
                break;

            case 38:
                $filters[] = array('name' => 'SelDate', 'label' => 'Data inceput', 'mandatory' => false);
                $filters[] = array('name' => 'SelDatef', 'label' => 'Data sfarsit', 'mandatory' => false);
                $filters[] = array('name' => 'CompanyID', 'label' => 'Companie self', 'mandatory' => false);
                $filters[] = array('name' => 'DivisionID', 'label' => 'Divizie', 'mandatory' => false);
                $filters[] = array('name' => 'DepartmentID', 'label' => 'Departament', 'mandatory' => false);
                $filters[] = array('name' => 'SubDepartmentID', 'label' => 'Subdepartament', 'mandatory' => false);
                $filters[] = array('name' => 'ShowLeft', 'label' => 'Afiseaza plecati', 'mandatory' => false);
                $filters[] = array('name' => 'ContractType', 'label' => 'Tip contract', 'mandatory' => false);
                $filters[] = array('name' => 'Status', 'label' => 'Status', 'mandatory' => false);
                break;

            case 42:
                $filters[] = array('name' => 'StartDate', 'label' => 'Data inceput', 'mandatory' => true);
                $filters[] = array('name' => 'EndDate', 'label' => 'Data sfarsit', 'mandatory' => false);
                $filters[] = array('name' => 'Status', 'label' => 'Status', 'mandatory' => false);
                $filters[] = array('name' => 'ContractType', 'label' => 'Tip contract', 'mandatory' => false);
                break;

            case 44:
                $filters[] = array('name' => 'StartDate', 'label' => 'Data inceput', 'mandatory' => true);
                $filters[] = array('name' => 'EndDate', 'label' => 'Data sfarsit', 'mandatory' => false);
                $filters[] = array('name' => 'CVSource1', 'label' => 'bestjobs', 'mandatory' => false);
                $filters[] = array('name' => 'CVSource2', 'label' => 'ejobs', 'mandatory' => false);
                $filters[] = array('name' => 'CVSource3', 'label' => 'recomandare', 'mandatory' => false);
                $filters[] = array('name' => 'CVSource4', 'label' => 'mail', 'mandatory' => false);
                break;

            case 46:
                $filters[] = array('name' => 'StartDate', 'label' => 'Data inceput', 'mandatory' => true);
                $filters[] = array('name' => 'EndDate', 'label' => 'Data sfarsit', 'mandatory' => false);
                $filters[] = array('name' => 'CompanyID', 'label' => 'Companie', 'mandatory' => false);
                $filters[] = array('name' => 'DepartmentID', 'label' => 'Departament', 'mandatory' => false);
                break;

            case 49:
                $filters[] = array('name' => 'StartDate', 'label' => 'Data inceput', 'mandatory' => true);
                $filters[] = array('name' => 'EndDate', 'label' => 'Data sfarsit', 'mandatory' => true);
                $filters[] = array('name' => 'CompanyID', 'label' => 'Companie self', 'mandatory' => false);
                $filters[] = array('name' => 'DivisionID', 'label' => 'Divizie', 'mandatory' => false);
                $filters[] = array('name' => 'DepartmentID', 'label' => 'Departament', 'mandatory' => false);
                $filters[] = array('name' => 'SubDepartmentID', 'label' => 'Subdepartament', 'mandatory' => false);
                $filters[] = array('name' => 'Aprove', 'label' => 'Status', 'mandatory' => false);
                break;

            case 59:
                $filters[] = array('name' => 'StartDate', 'label' => 'Data inceput', 'mandatory' => true);
                $filters[] = array('name' => 'EndDate', 'label' => 'Data sfarsit', 'mandatory' => false);
                $filters[] = array('name' => 'NoCatering', 'label' => 'Fara meniu', 'mandatory' => false);
                break;

            case 62:
                $filters[] = array('name' => 'StartDate', 'label' => 'Data inceput', 'mandatory' => true);
                $filters[] = array('name' => 'EndDate', 'label' => 'Data sfarsit', 'mandatory' => true);
                $filters[] = array('name' => 'CompanyID', 'label' => 'Companie self', 'mandatory' => false);
                $filters[] = array('name' => 'DivisionID', 'label' => 'Divizie', 'mandatory' => false);
                $filters[] = array('name' => 'DepartmentID', 'label' => 'Departament', 'mandatory' => false);
                $filters[] = array('name' => 'SubDepartmentID', 'label' => 'Subdepartament', 'mandatory' => false);
                break;

            case 83:
            case 89:
                $filters[] = array('name' => 'CompanyID', 'label' => 'Companie self', 'mandatory' => false);
                $filters[] = array('name' => 'DivisionID', 'label' => 'Divizie', 'mandatory' => false);
                $filters[] = array('name' => 'DepartmentID', 'label' => 'Departament', 'mandatory' => false);
                $filters[] = array('name' => 'SubDepartmentID', 'label' => 'Subdepartament', 'mandatory' => false);
                $filters[] = array('name' => 'ShowLeft', 'label' => 'Afiseaza plecati', 'mandatory' => false);
                $filters[] = array('name' => 'ContractType', 'label' => 'Tip contract', 'mandatory' => false);
                $filters[] = array('name' => 'Status', 'label' => 'Status', 'mandatory' => false);
                break;

            case 157:
                $filters[] = array('name' => 'CompanyID', 'label' => 'Companie self', 'mandatory' => false);
                $filters[] = array('name' => 'DivisionID', 'label' => 'Divizie', 'mandatory' => false);
                $filters[] = array('name' => 'DepartmentID', 'label' => 'Departament', 'mandatory' => false);
                $filters[] = array('name' => 'SubDepartmentID', 'label' => 'Subdepartament', 'mandatory' => false);
                $filters[] = array('name' => 'ShowLeft', 'label' => 'Afiseaza plecati', 'mandatory' => false);
                $filters[] = array('name' => 'ContractType', 'label' => 'Tip contract', 'mandatory' => false);
                $filters[] = array('name' => 'Status', 'label' => 'Status', 'mandatory' => false);
                break;
            case 158:
                $filters[] = array('name' => 'CompanyID', 'label' => 'Companie self', 'mandatory' => false);
                $filters[] = array('name' => 'DivisionID', 'label' => 'Divizie', 'mandatory' => false);
                $filters[] = array('name' => 'DepartmentID', 'label' => 'Departament', 'mandatory' => false);
                $filters[] = array('name' => 'SubDepartmentID', 'label' => 'Subdepartament', 'mandatory' => false);
                $filters[] = array('name' => 'ShowLeft', 'label' => 'Afiseaza plecati', 'mandatory' => false);
                $filters[] = array('name' => 'ContractType', 'label' => 'Tip contract', 'mandatory' => false);
                $filters[] = array('name' => 'Status', 'label' => 'Status', 'mandatory' => false);
                break;

            case 86:
                $filters[] = array('name' => 'Year', 'label' => 'An', 'mandatory' => true);
                $filters[] = array('name' => 'CompanyID', 'label' => 'Companie', 'mandatory' => false);
                $filters[] = array('name' => 'DivisionID', 'label' => 'Divizie', 'mandatory' => false);
                $filters[] = array('name' => 'DepartmentID', 'label' => 'Departament', 'mandatory' => false);
                $filters[] = array('name' => 'SubdepartmentID', 'label' => 'Subdepartament', 'mandatory' => false);
                $filters[] = array('name' => 'Status', 'label' => 'Status', 'mandatory' => false);
                break;

            case 90:
            case 92:
            case 93:
            case 94:
            case 96:
            case 113:
            case 114:
                $filters[] = array('name' => 'Year', 'label' => 'An', 'mandatory' => true);
                $filters[] = array('name' => 'Trimester', 'label' => 'Trimestru', 'mandatory' => false);
                $filters[] = array('name' => 'Month', 'label' => 'Luna', 'mandatory' => false);
                $filters[] = array('name' => 'CompanyID', 'label' => 'Companie self', 'mandatory' => false);
                break;

            case 97:
                $filters[] = array('name' => 'CompanyID', 'label' => 'Companie', 'mandatory' => true);
                $filters[] = array('name' => 'Year', 'label' => 'An', 'mandatory' => false);
                $filters[] = array('name' => 'DepartmentID', 'label' => 'Departament', 'mandatory' => false);
                $filters[] = array('name' => 'SalaryType', 'label' => 'Tip salariu', 'mandatory' => false);
                break;

            case 98:
                $filters[] = array('name' => 'CompanyID', 'label' => 'Companie', 'mandatory' => true);
                $filters[] = array('name' => 'Year', 'label' => 'An', 'mandatory' => false);
                $filters[] = array('name' => 'Month', 'label' => 'Luna', 'mandatory' => false);
                $filters[] = array('name' => 'DepartmentID', 'label' => 'Departament', 'mandatory' => false);
                $filters[] = array('name' => 'SalaryType', 'label' => 'Tip salariu', 'mandatory' => false);
                break;

            case 116:
                $filters[] = array('name' => 'CompanyID', 'label' => 'Companie self', 'mandatory' => false);
                $filters[] = array('name' => 'DepartmentID', 'label' => 'Departament', 'mandatory' => false);
                $filters[] = array('name' => 'Status', 'label' => 'Status', 'mandatory' => false);
                $filters[] = array('name' => 'ContractType', 'label' => 'Tip contract', 'mandatory' => false);
                break;

            case 118:
            case 119:
                $filters[] = array('name' => 'StartDate', 'label' => 'Data inceput', 'mandatory' => true);
                $filters[] = array('name' => 'EndDate', 'label' => 'Data sfarsit', 'mandatory' => true);
                $filters[] = array('name' => 'CompanyID', 'label' => 'Companie', 'mandatory' => false);
                $filters[] = array('name' => 'Status', 'label' => 'Status', 'mandatory' => false);
                $filters[] = array('name' => 'InterventionType', 'label' => 'Tip interventie', 'mandatory' => false);
                $filters[] = array('name' => 'Type', 'label' => 'Tip', 'mandatory' => false);
                $filters[] = array('name' => 'PersonID', 'label' => 'Responsabil', 'mandatory' => false);
                break;

            case 120:
                $filters[] = array('name' => 'StartDate', 'label' => 'Data inceput', 'mandatory' => false);
                $filters[] = array('name' => 'EndDate', 'label' => 'Data sfarsit', 'mandatory' => false);
                $filters[] = array('name' => 'CompanyID', 'label' => 'Beneficiar', 'mandatory' => false);
                $filters[] = array('name' => 'Self', 'label' => 'Companie self', 'mandatory' => false);
                $filters[] = array('name' => 'FinanciarID', 'label' => 'Responsabil financiar', 'mandatory' => false);
                $filters[] = array('name' => 'TehnicID', 'label' => 'Responsabil tehnic', 'mandatory' => false);
                $filters[] = array('name' => 'Status', 'label' => 'Stare contract', 'mandatory' => false);
                break;

            case 124:
                $filters[] = array('name' => 'CompanyID', 'label' => 'Companie self', 'mandatory' => true);
                $filters[] = array('name' => 'Year', 'label' => 'An', 'mandatory' => false);
                $filters[] = array('name' => 'DepartmentID', 'label' => 'Departament', 'mandatory' => false);
                $filters[] = array('name' => 'SalaryType', 'label' => 'Tip salariu', 'mandatory' => false);
                break;

            case 125:
                $filters[] = array('name' => 'StartDate', 'label' => 'Data inceput', 'mandatory' => true);
                $filters[] = array('name' => 'EndDate', 'label' => 'Data sfarsit', 'mandatory' => true);
                $filters[] = array('name' => 'CompanyID', 'label' => 'Companie self', 'mandatory' => false);
                $filters[] = array('name' => 'DepartmentID', 'label' => 'Departament', 'mandatory' => false);
                break;

            case 126:
            case 127:
                $filters[] = array('name' => 'StartDate', 'label' => 'Data inceput', 'mandatory' => true);
                $filters[] = array('name' => 'EndDate', 'label' => 'Data sfarsit', 'mandatory' => true);
                $filters[] = array('name' => 'CompanyID', 'label' => 'Companie self', 'mandatory' => false);
                $filters[] = array('name' => 'DepartmentID', 'label' => 'Departament', 'mandatory' => false);
                $filters[] = array('name' => 'InventarCategoryID', 'label' => 'Categorie', 'mandatory' => false);
                $filters[] = array('name' => 'Token', 'label' => 'Cuvant cheie', 'mandatory' => false);
                break;

            case 128:
                $filters[] = array('name' => 'StartDate', 'label' => 'Data inceput', 'mandatory' => true);
                $filters[] = array('name' => 'EndDate', 'label' => 'Data sfarsit', 'mandatory' => true);
                $filters[] = array('name' => 'CompanyID', 'label' => 'Companie self', 'mandatory' => false);
                $filters[] = array('name' => 'DepartmentID', 'label' => 'Departament', 'mandatory' => false);
                $filters[] = array('name' => 'ShowAll', 'label' => 'Date abonament', 'mandatory' => false);
                break;

            case 129:
                $filters[] = array('name' => 'StartDate', 'label' => 'Data inceput', 'mandatory' => true);
                $filters[] = array('name' => 'EndDate', 'label' => 'Data sfarsit', 'mandatory' => false);
                $filters[] = array('name' => 'CompanyID', 'label' => 'Companie self', 'mandatory' => false);
                $filters[] = array('name' => 'DivisionID', 'label' => 'Divizie', 'mandatory' => false);
                $filters[] = array('name' => 'DepartmentID', 'label' => 'Departament', 'mandatory' => false);
                break;

            case 130:
                $filters[] = array('name' => 'Year', 'label' => 'An', 'mandatory' => false);
                $filters[] = array('name' => 'Month', 'label' => 'Luna', 'mandatory' => false);
                $filters[] = array('name' => 'CompanyID', 'label' => 'Companie self', 'mandatory' => false);
                $filters[] = array('name' => 'DepartmentID', 'label' => 'Departament', 'mandatory' => false);
                $filters[] = array('name' => 'CostType', 'label' => 'Tip cost', 'mandatory' => false);
                break;


            case 155:
                $filters[] = array('name' => 'Year', 'label' => 'An', 'mandatory' => true);
                $filters[] = array('name' => 'DivisionID', 'label' => 'Divizie', 'mandatory' => false);
                $filters[] = array('name' => 'Name', 'label' => 'Nume', 'mandatory' => false);
                break;

            case 156:
                $filters[] = array('name' => 'Year', 'label' => 'An', 'mandatory' => true);
                $filters[] = array('name' => 'CompanyID', 'label' => 'Companie self', 'mandatory' => false);
                $filters[] = array('name' => 'DivisionID', 'label' => 'Divizie', 'mandatory' => false);
                $filters[] = array('name' => 'DepartmentID', 'label' => 'Departament', 'mandatory' => false);
                $filters[] = array('name' => 'SubdepartmentID', 'label' => 'Subdepartament', 'mandatory' => false);
                $filters[] = array('name' => 'Status', 'label' => 'Status', 'mandatory' => false);
                break;

            case 159:
                $filters[] = array('name' => 'StartDate', 'label' => 'Data inceput', 'mandatory' => true);
                $filters[] = array('name' => 'EndDate', 'label' => 'Data sfarsit', 'mandatory' => false);
                $filters[] = array('name' => 'JobTypeID', 'label' => 'Job type', 'mandatory' => false);
                $filters[] = array('name' => 'StatusID', 'label' => 'Status tichet', 'mandatory' => false);
                $filters[] = array('name' => 'DepartmentID', 'label' => 'Departament', 'mandatory' => false);
                break;

            case 157:
                $filters[] = array('name' => 'CompanyID', 'label' => 'Companie self', 'mandatory' => false);
                $filters[] = array('name' => 'DivisionID', 'label' => 'Divizie', 'mandatory' => false);
                $filters[] = array('name' => 'DepartmentID', 'label' => 'Departament', 'mandatory' => false);
                $filters[] = array('name' => 'SubDepartmentID', 'label' => 'Subdepartament', 'mandatory' => false);
                $filters[] = array('name' => 'ShowLeft', 'label' => 'Afiseaza plecati', 'mandatory' => false);
                $filters[] = array('name' => 'ContractType', 'label' => 'Tip contract', 'mandatory' => false);
                $filters[] = array('name' => 'Status', 'label' => 'Status', 'mandatory' => false);
                break;

            case 158:
                $filters[] = array('name' => 'CompanyID', 'label' => 'Companie self', 'mandatory' => false);
                $filters[] = array('name' => 'DivisionID', 'label' => 'Divizie', 'mandatory' => false);
                $filters[] = array('name' => 'DepartmentID', 'label' => 'Departament', 'mandatory' => false);
                $filters[] = array('name' => 'SubDepartmentID', 'label' => 'Subdepartament', 'mandatory' => false);
                $filters[] = array('name' => 'ShowLeft', 'label' => 'Afiseaza plecati', 'mandatory' => false);
                $filters[] = array('name' => 'ContractType', 'label' => 'Tip contract', 'mandatory' => false);
                $filters[] = array('name' => 'Status', 'label' => 'Status', 'mandatory' => false);
                break;

            case 160:
                $filters[] = array('name' => 'Year', 'label' => 'An', 'mandatory' => true);
                $filters[] = array('name' => 'CompanyID', 'label' => 'Companie self', 'mandatory' => false);
                $filters[] = array('name' => 'DivisionID', 'label' => 'Divizie', 'mandatory' => false);
                $filters[] = array('name' => 'Status', 'label' => 'Status', 'mandatory' => false);
                $filters[] = array('name' => 'Name', 'label' => 'Nume', 'mandatory' => false);
                break;

            case 161:
                $filters[] = array('name' => 'Year', 'label' => 'An', 'mandatory' => true);
                $filters[] = array('name' => 'Month', 'label' => 'Luna', 'mandatory' => true);
                $filters[] = array('name' => 'CompanyID', 'label' => 'Companie self', 'mandatory' => false);
                $filters[] = array('name' => 'DivisionID', 'label' => 'Divizie', 'mandatory' => false);
                $filters[] = array('name' => 'Status', 'label' => 'Status', 'mandatory' => false);
                break;
        }
        return $filters;
    }

    public static function setReportFiltersVisibility($reportID, $filters, $settings)
    {
        if (empty($filters) || count($filters) == 0) return null;

        $filters_final = array();
        $filters_final['names'] = $filters;
        $filters_final['lstVisibleFilters'] = array();

        if (empty($settings)) {
            for ($i = 0; $i < count($filters_final['names']); $i++) {
                $filters_final['visibility'][$i] = array('filter_id' => $i, 'visible' => true);
                $filters_final['lstVisibleFilters'][] = $filters_final['names'][$i]['name'];
            }
        } else {
            $i = 0;
            foreach ($settings['visibility'] as $set) {
                $filters_final['visibility'][$i] = $set;
                if ($set['visible'] == true) {
                    $filters_final['lstVisibleFilters'][] = $filters_final['names'][$set['filter_id']]['name'];
                }
                $i++;
            }
        }
        return $filters_final;
    }

    public static function getReports_1()
    {

        global $conn;

        $events = array();

        $order_by = !empty($_GET['order_by']) && in_array($_GET['order_by'], array('Scope', 'UserName', 'FullName', 'Details', 'EventType', 'EventData')) ? $_GET['order_by'] : 'a.CreateDate';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'desc';

        $query = "SELECT a.*, b.UserName, c.FullName, DATE_FORMAT(a.EventData, '%d.%m.%Y') AS fEventData
	              FROM   events a
                         INNER JOIN users b ON a.UserID = b.UserID
                         INNER JOIN persons c ON a.ConsultantID = c.PersonID
	              WHERE  (a.UserID = {$_SESSION['USER_ID']} OR {$_SESSION['USER_ID']} = 1)
	              ORDER  BY $order_by $asc_or_desc ";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $events[$row['EventID']] = $row;
        }

        return $events;
    }

    public static function getReports_2()
    {

        global $conn;

        $persons = array();

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.FullName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        $query = "SELECT a.*, d.CityName, e.DistrictName,
                       FLOOR(DATEDIFF(CURRENT_DATE, a.DateOfBirth) / 365) AS varsta
	              FROM   persons a
	                     INNER JOIN address b ON a.AddressID = b.AddressID
                       INNER JOIN address_city d ON d.CityID = b.CityID" . (!empty($_GET['CityID']) ? " AND d.CityID = " . (int)$_GET['CityID'] : "") . "
                       INNER JOIN address_district e ON e.DistrictID = d.DistrictID" . (!empty($_GET['DistrictID']) ? " AND e.DistrictID = " . (int)$_GET['DistrictID'] : "") . "
	              WHERE  (a.UserID = {$_SESSION['USER_ID']} OR {$_SESSION['USER_ID']} = 1) AND
	                     a.Status = 5 AND a.SubStatus = 3
	              ORDER  BY $order_by $asc_or_desc";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $persons[$row['PersonID']] = $row;
        }

        return $persons;
    }

    public static function getReports_3()
    {

        global $conn;

        $persons = array();

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.FullName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        $query = "SELECT a.*, d.CityName, e.DistrictName,
                       FLOOR(DATEDIFF(CURRENT_DATE, a.DateOfBirth) / 365) AS varsta
	              FROM   persons a
	                     INNER JOIN address b ON a.AddressID = b.AddressID
                       INNER JOIN address_city d ON d.CityID = b.CityID" . (!empty($_GET['CityID']) ? " AND d.CityID = " . (int)$_GET['CityID'] : "") . "
                       INNER JOIN address_district e ON e.DistrictID = d.DistrictID" . (!empty($_GET['DistrictID']) ? " AND e.DistrictID = " . (int)$_GET['DistrictID'] : "") . "
	              WHERE  (a.UserID = {$_SESSION['USER_ID']} OR {$_SESSION['USER_ID']} = 1) AND
	                     a.Status = 5 AND a.SubStatus = 5
	              ORDER  BY $order_by $asc_or_desc";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $persons[$row['PersonID']] = $row;
        }

        return $persons;
    }

    public static function getReports_4()
    {

        global $conn;

        $companies = array();

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.CompanyName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'desc';

        $query = "SELECT a.*, d.CityName, e.DistrictName, f.Domain
	              FROM   companies a
	                     INNER JOIN address b ON a.AddressID = b.AddressID
                         INNER JOIN address_city d ON d.CityID = b.CityID" . (!empty($_GET['CityID']) ? " AND d.CityID = " . (int)$_GET['CityID'] : "") . "
                         INNER JOIN address_district e ON e.DistrictID = d.DistrictID" . (!empty($_GET['DistrictID']) ? " AND e.DistrictID = " . (int)$_GET['DistrictID'] : "") . "
                         INNER JOIN jobsdomain f ON a.CompanyDomainID = f.JobDomainID" . (!empty($_GET['CompanyDomainID']) ? " AND f.JobDomainID = " . (int)$_GET['CompanyDomainID'] : "") . "
                  WHERE  (a.UserID = {$_SESSION['USER_ID']} OR {$_SESSION['USER_ID']} = 1)
	              ORDER  BY $order_by $asc_or_desc ";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $companies[$row['CompanyID']] = $row;
        }

        return $companies;
    }

    public static function getReports_6()
    {

        global $conn;

        $pers = array();

        if (!empty($_POST['CostCenterID'])) {
            $conn->query("SELECT PersonID FROM payroll_costcenter WHERE CostCenterID = {$_POST['CostCenterID']}");
            while ($row = $conn->fetch_array()) {
                $pers[$row['PersonID']] = $row['PersonID'];
            }
        }
        if (!empty($_POST['SiteID'])) {
            $conn->query("SELECT PersonID FROM payroll WHERE SiteID = {$_POST['SiteID']}");
            while ($row = $conn->fetch_array()) {
                $pers[$row['PersonID']] = $row['PersonID'];
            }
        }

        if (count($pers)) {

            $persons = array();

            $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.FullName';
            $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

            $query = "SELECT a.*, d.CityName, e.DistrictName,
                       FLOOR(DATEDIFF(CURRENT_DATE, a.DateOfBirth) / 365) AS varsta
	              FROM   persons a
	                     INNER JOIN address b ON a.AddressID = b.AddressID
                       INNER JOIN address_city d ON d.CityID = b.CityID" . (!empty($_GET['CityID']) ? " AND d.CityID = " . (int)$_GET['CityID'] : "") . "
                       INNER JOIN address_district e ON e.DistrictID = d.DistrictID" . (!empty($_GET['DistrictID']) ? " AND e.DistrictID = " . (int)$_GET['DistrictID'] : "") . "
	              WHERE  a.PersonID IN (SELECT DISTINCT PersonID FROM event_persons WHERE PersonID IN (" . (!empty($pers) ? implode(',', $pers) : 0) . "))
	              ORDER  BY $order_by $asc_or_desc";
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $persons[$row['PersonID']] = $row;
            }

            return $persons;
        }
    }

    public static function getReports_7()
    {

        global $conn;

        $persons = array();

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.FullName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        $query = "SELECT a.*, d.CityName, e.DistrictName,
                       FLOOR(DATEDIFF(CURRENT_DATE, a.DateOfBirth) / 365) AS varsta
	              FROM   persons a
	                     INNER JOIN address b ON a.AddressID = b.AddressID
                       INNER JOIN address_city d ON d.CityID = b.CityID" . (!empty($_GET['CityID']) ? " AND d.CityID = " . (int)$_GET['CityID'] : "") . "
                       INNER JOIN address_district e ON e.DistrictID = d.DistrictID" . (!empty($_GET['DistrictID']) ? " AND e.DistrictID = " . (int)$_GET['DistrictID'] : "") . "
	              WHERE  a.Status = 5 AND a.SubStatus = 3
	              ORDER  BY $order_by $asc_or_desc";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $persons[$row['PersonID']] = $row;
        }

        return $persons;
    }

    public static function getReports_8()
    {

        global $conn;

        $persons = array();

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.FullName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        $query = "SELECT a.*, d.CityName, e.DistrictName,
                       FLOOR(DATEDIFF(CURRENT_DATE, a.DateOfBirth) / 365) AS varsta
	              FROM   persons a
	                     INNER JOIN address b ON a.AddressID = b.AddressID
                       INNER JOIN address_city d ON d.CityID = b.CityID" . (!empty($_GET['CityID']) ? " AND d.CityID = " . (int)$_GET['CityID'] : "") . "
                       INNER JOIN address_district e ON e.DistrictID = d.DistrictID" . (!empty($_GET['DistrictID']) ? " AND e.DistrictID = " . (int)$_GET['DistrictID'] : "") . "
	              WHERE  a.Status = 5 AND a.SubStatus = 6
	              ORDER  BY $order_by $asc_or_desc";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $persons[$row['PersonID']] = $row;
        }

        return $persons;
    }


    public static function getReports_30()
    {

        global $conn;

        $children = array();

        if (!empty($_GET['Year'])) {
            $cond .= "AND YEAR(c.StartDate) <= '{$_GET['Year']}'";
        }
        if (!empty($_GET['Status'])) {
            $cond .= "AND b.Status = '{$_GET['Status']}'";
        }
        if (!empty($_GET['CompanyID'])) {
            $cond .= "AND c.CompanyID = '{$_GET['CompanyID']}'";
        }
        if (!empty($_GET['DivisionID'])) {
            $cond .= "AND c.DivisionID = '{$_GET['DivisionID']}'";
        }
        if (!empty($_GET['DepartmentID'])) {
            $cond .= "AND c.DepartmentID = '{$_GET['DepartmentID']}'";
        }
        if (!empty($_GET['SubdepartmentID'])) {
            $cond .= "AND c.SubdepartmentID = '{$_GET['SubdepartmentID']}'";
        }

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'b.FullName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        $query = "SELECT a.ChildName, DATE_FORMAT(a.ChildBirthDate, '%d.%m.%Y') AS BirthDate, a.ChildCNP,
	                     FLOOR(DATEDIFF(CURRENT_DATE, a.ChildBirthDate) / 365) AS varsta,
	                     b.FullName, f.Department
	              FROM   persons_children a
		             INNER JOIN persons b ON a.PersonID = b.PersonID
		             LEFT JOIN payroll c ON a.PersonID = c.PersonID
              		LEFT JOIN companies d ON c.CompanyID = d.CompanyID
              		LEFT JOIN divisions e ON c.DivisionID = e.DivisionID
              		LEFT JOIN departments f ON c.DepartmentID = f.DepartmentID
              		WHERE 1=1 $cond
	              ORDER  BY $order_by $asc_or_desc";
        $conn->query($query);
        $total = 0;
        while ($row = $conn->fetch_array()) {
            $children[] = $row;
            $total++;
        }
        $children['Total'] = $total;

        return $children;
    }

    public static function getReports_31()
    {

        global $conn;

        $vacations = array();
        $cond = "";

        if (empty($_GET['StartDate']) || empty($_GET['EndDate'])) {
            return $vacations;
        }

        $StartDate = Utils::toDBDate($_GET['StartDate']);
        $EndDate = Utils::toDBDate($_GET['EndDate']);
        $cond = '';
        if (empty($_GET['ViewAll'])) {
            $cond .= " AND ((a.StartDate BETWEEN '{$StartDate}' AND '{$EndDate}') OR
		             (a.StopDate BETWEEN '{$StartDate}' AND '{$EndDate}') OR
		             ('{$StartDate}' BETWEEN a.StartDate AND a.StopDate)) AND a.Aprove >= 0";
        }
        if (!empty($_GET['CompanyID'])) {
            $cond .= " AND c.CompanyID = " . (int)$_GET['CompanyID'];
        }
        if (!empty($_GET['DivisionID'])) {
            $cond .= " AND c.DivisionID = " . (int)$_GET['DivisionID'];
        }
        if (!empty($_GET['DepartmentID'])) {
            $cond .= " AND c.CompanyID = " . (int)$_GET['DepartmentID'];
        }
        if (!empty($_GET['VacationType'])) {
            $cond .= " AND a.Type='{$_GET['VacationType']}'";
        }

        $calh = array(0 => 'D', 1 => 'L', 2 => 'M', 3 => 'M', 4 => 'J', 5 => 'V', 6 => 'S');

        global $cal;

        $st_y = (int)substr($StartDate, 0, 4);
        $st_m = (int)substr($StartDate, 5, 2);
        $st_d = (int)substr($StartDate, 8, 2);
        $i = 0;
        $j = 0;
        while (true) {
            $time = mktime(0, 0, 0, $st_m, $st_d + $i, $st_y);
            $date = date('Y-m-d', $time);
            if ($date <= $EndDate) {
                $cal[$date] = $calh[date('w', $time)];
                if ($cal[$date] != 'S' && $cal[$date] != 'D') {
                    $j++;
                }
                $i++;
            } else {
                break;
            }
        }

        $query = "SELECT b.FullName, a.PersonID, a.StartDate, a.StopDate, a.Type, a.Aprove, c.CompanyID, c.DepartmentID
		      FROM   vacations_details a
		             JOIN persons b ON a.PersonID = b.PersonID
                             JOIN payroll c ON c.PersonID = a.PersonID
		      WHERE  1=1 AND a.Type != 'INV' $cond
		      ORDER  BY b.LastName, a.StartDate";
        $conn->query($query);
        $arr = array();
        while ($row = $conn->fetch_array()) {
            $arr[$row['PersonID']][$row['StartDate']] = $row;
        }

        foreach ($arr as $k => $v) {
            $i = 1;
            foreach ($v as $sd => $vac) {
                $vacations[$k]['FullName'] = $vac['FullName'];
                //$vacations[$k]['TotalVac'] = 0;
                foreach ($cal as $date => $w) {
                    if (isset(ConfigData::$msLegal[$date])) {
                        $vacations[$k][$date] = array('SL', 1);
                    } elseif ($sd <= $date && $date <= $vac['StopDate'] && $w != 'S' && $w != 'D') {
                        $vacations[$k]['TotalVac'] = $i++;
                        $vacations[$k][$date] = array($vac['Type'], $vac['Aprove']);
                    }
                }
            }
        }

        return $vacations;
    }

    public static function getReports_32()
    {

        global $conn;

        $Year = !empty($_GET['Year']) ? $_GET['Year'] : date('Y');

        $persons = array();

        $query = "SELECT b.FullName, DATE_FORMAT(c.StartDate, '%d.%m.%Y') AS DataStart, a.TotalCO,
	                     (SELECT SUM(DaysNo) FROM vacations_details WHERE PersonID = a.PersonID AND Type = 'CO' AND SUBSTRING(StartDate, 1, 4) = '$Year' AND Aprove >= 0) AS TCO,
	                     (SELECT SUM(DaysNo) FROM vacations_details WHERE PersonID = a.PersonID AND Type = 'CM' AND SUBSTRING(StartDate, 1, 4) = '$Year' AND Aprove >= 0) AS TCM,
	                     (SELECT SUM(DaysNo) FROM vacations_details WHERE PersonID = a.PersonID AND Type = 'CFS' AND SUBSTRING(StartDate, 1, 4) = '$Year' AND Aprove >= 0) AS TCFS,
	                     (SELECT SUM(DaysNo) FROM vacations_details WHERE PersonID = a.PersonID AND Type = 'CE' AND SUBSTRING(StartDate, 1, 4) = '$Year' AND Aprove >= 0) AS TCE,
	                     (SELECT SUM(DaysNo) FROM vacations_details WHERE PersonID = a.PersonID AND Type = 'CIC' AND SUBSTRING(StartDate, 1, 4) = '$Year' AND Aprove >= 0) AS TCIC
	              FROM   vacations a
	                     INNER JOIN persons b ON a.PersonID = b.PersonID
	                     INNER JOIN payroll c ON a.PersonID = c.PersonID
	              WHERE  a.Year = '$Year' AND
	                     (b.UserID = {$_SESSION['USER_ID']} OR {$_SESSION['USER_ID']} = 1)
	              ORDER  BY b.FullName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $persons[] = $row;
        }

        return $persons;
    }

    public static function getReports_33()
    {

        global $conn;

        $persons = array();

        if (empty($_GET['StartDate']) || empty($_GET['EndDate'])) {
            return $persons;
        }

        $StartDate = Utils::toDBDate($_GET['StartDate']);
        $EndDate = Utils::toDBDate($_GET['EndDate']);

        if (!empty($_GET['Status'])) {
            $cond .= "AND b.Status = '{$_GET['Status']}'";
        }
        if (!empty($_GET['ContractType'])) {
            $cond .= "AND c.ContractType = '{$_GET['ContractType']}'";
        }
        if (!empty($_GET['CompanyID'])) {
            $cond .= "AND c.CompanyID = '{$_GET['CompanyID']}'";
        }
        if (!empty($_GET['DivisionID'])) {
            $cond .= "AND c.DivisionID = '{$_GET['DivisionID']}'";
        }
        if (!empty($_GET['DepartmentID'])) {
            $cond .= "AND c.DepartmentID = '{$_GET['DepartmentID']}'";
        }
        if (!empty($_GET['SubdepartmentID'])) {
            $cond .= "AND c.SubdepartmentID = '{$_GET['SubdepartmentID']}'";
        }

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'b.FullName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';


        $query = "SELECT b.FullName, b.Status, DATE_FORMAT(c.StopDate, '%d.%m.%Y') AS DataEnd, DATE_FORMAT(c.StartDate, '%d.%m.%Y') AS DataStart, c.ContractType, d.CompanyName, e.Division, f.Department, g.Subdepartment,
	                     (
	                    	SELECT SUM(DaysNo)
	                    	FROM   vacations_details
	                    	WHERE  PersonID = a.PersonID AND Type = 'CM' AND Aprove >= 0 AND
	                    	       ((StartDate BETWEEN '{$StartDate}' AND '{$EndDate}') OR
		                        (StopDate BETWEEN '{$StartDate}' AND '{$EndDate}') OR
		                        ('{$StartDate}' BETWEEN StartDate AND StopDate))
	                     ) AS TCM
	              FROM   vacations a
	                     INNER JOIN persons b ON a.PersonID = b.PersonID
	                     INNER JOIN payroll c ON a.PersonID = c.PersonID
	                     INNER JOIN (
	                    		    SELECT DISTINCT PersonID
	                    		    FROM   vacations_details
	                    		    WHERE  Type = 'CM' AND Aprove >= 0 AND
	                    		           ((StartDate BETWEEN '{$StartDate}' AND '{$EndDate}') OR
		                                    (StopDate BETWEEN '{$StartDate}' AND '{$EndDate}') OR
		                                    ('{$StartDate}' BETWEEN StartDate AND StopDate))
	                    		) d ON a.PersonID = d.PersonID
	              		LEFT JOIN companies d ON c.CompanyID = d.CompanyID
	              		LEFT JOIN divisions e ON c.DivisionID = e.DivisionID
	              		LEFT JOIN departments f ON c.DepartmentID = f.DepartmentID
	              		LEFT JOIN subdepartments g ON c.SubdepartmentID = g.SubdepartmentID
	              WHERE  (b.UserID = {$_SESSION['USER_ID']} OR {$_SESSION['USER_ID']} = 1) $cond
	              GROUP BY a.PersonID
	              ORDER  BY $order_by $asc_or_desc";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $persons[] = $row;
        }

        return $persons;
    }

    public static function getReports_34()
    {

        global $conn;

        $persons = array();

        if (empty($_GET['StartDate']) || empty($_GET['EndDate'])) {
            return $persons;
        }

        $StartDate = Utils::toDBDate($_GET['StartDate']);
        $EndDate = Utils::toDBDate($_GET['EndDate']);

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.FullName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';


        $cond = '';
        if (!empty($_GET['Status'])) {
            $cond .= " AND a.Status = '{$_GET['Status']}'";
        }
        if (!empty($_GET['ContractType'])) {
            $cond .= " AND b.ContractType = '{$_GET['ContractType']}'";
        }


        $query = "SELECT a.FullName, DATE_FORMAT(b.StartDate, '%d.%m.%Y') AS DataStart, a.Status, b.ContractType
	              FROM persons a
	              		INNER JOIN payroll b ON a.PersonID = b.PersonID
	              WHERE  (b.StartDate BETWEEN '{$StartDate}' AND '{$EndDate}') $cond
	              ORDER  BY $order_by $asc_or_desc";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $persons[] = $row;
        }

        return $persons;
    }

    public static function getReports_35()
    {

        global $conn;

        $persons = array();

        if (empty($_GET['StartDate']) || empty($_GET['EndDate'])) {
            return $persons;
        }

        $StartDate = Utils::toDBDate($_GET['StartDate']);
        $EndDate = Utils::toDBDate($_GET['EndDate']);

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.FullName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        $cond = '';
        if (!empty($_GET['Status'])) {
            $cond .= "AND a.Status = '{$_GET['Status']}'";
        }
        if (!empty($_GET['ContractType'])) {
            $cond .= "AND b.ContractType = '{$_GET['ContractType']}'";
        }
        if (!empty($_GET['CompanyID'])) {
            $cond .= "AND b.CompanyID = '{$_GET['CompanyID']}'";
        }
        if (!empty($_GET['DivisionID'])) {
            $cond .= "AND b.DivisionID = '{$_GET['DivisionID']}'";
        }
        if (!empty($_GET['DepartmentID'])) {
            $cond .= "AND b.DepartmentID = '{$_GET['DepartmentID']}'";
        }
        if (!empty($_GET['SubdepartmentID'])) {
            $cond .= "AND b.SubdepartmentID = '{$_GET['SubdepartmentID']}'";
        }


        $query = "SELECT a.FullName, a.CNP, a.Status, TIMESTAMPDIFF(YEAR, a.DateOfBirth, CURDATE()) AS Varsta, CONCAT(TIMESTAMPDIFF(YEAR, b.StartDate, b.StopDate), ' ani si ', MOD(TIMESTAMPDIFF(MONTH, b.StartDate, b.StopDate), 12), ' luni') AS Vechime, a.Sex, DATE_FORMAT(b.StopDate, '%d.%m.%Y') AS DataEnd, DATE_FORMAT(b.StartDate, '%d.%m.%Y') AS DataStart, b.ContractType, c.CompanyName, d.Division, e.Department, f.Subdepartment, b.LeaveReason, b.Law
	              FROM persons a
	              		INNER JOIN ( SELECT b1.*
						FROM payroll as b1
						LEFT JOIN payroll AS b2
							ON b1.PayrollID = b2.PayrollID AND b1.CreateDate < b2.CreateDate
							WHERE b2.PayrollID IS NULL ) AS b ON a.PersonID = b.PersonID
	              		LEFT JOIN companies c ON b.CompanyID = c.CompanyID
	              		LEFT JOIN divisions d ON b.DivisionID = d.DivisionID
	              		LEFT JOIN departments e ON b.DepartmentID = e.DepartmentID
	              		LEFT JOIN subdepartments f ON b.SubdepartmentID = f.SubdepartmentID
	              WHERE  ((b.StopDate BETWEEN '{$StartDate}' AND '{$EndDate}') OR (b.StartDate BETWEEN '{$StartDate}' AND '{$EndDate}'))  $cond
	              GROUP BY a.PersonID
	              ORDER  BY $order_by $asc_or_desc";
        $conn->query($query);
        $i = 0;
        while ($row = $conn->fetch_array()) {

            $persons[$i] = $row;
            $persons[$i]['Motiv'] = ConfigData::$msSubStatus[6][$row['LeaveReason']];
            $i++;
        }

        return $persons;
    }

    public static function getReports_36()
    {

        global $conn;

        $persons = array();

        if (empty($_GET['Year'])) {
            return $persons;
        }

        $cond = "";
        if (!empty($_GET['DivisionID'])) {
            $cond .= " AND e.DivisionID = " . (int)$_GET['DivisionID'];
        }
        if (!empty($_GET['DepartmentID'])) {
            $cond .= " AND e.DepartmentID = " . (int)$_GET['DepartmentID'];
        }
        if (!empty($_GET['TrainingTypeID'])) {
            $cond .= " AND c.TrainingTypeID = " . (int)$_GET['TrainingTypeID'];
        }

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.FullName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';


        $query = "SELECT a.FullName, d.TrainingType, c.Type, SUM(c.Hours) AS TotalHours
	              FROM persons a
	              INNER JOIN training_persons b ON a.PersonID = b.PersonID
	              INNER JOIN trainings c ON b.TrainingID = c.TrainingID
	              INNER JOIN training_types d ON c.TrainingTypeID = d.TrainingTypeID
	              INNER JOIN payroll e ON a.PersonID=e.PersonID
	              WHERE DATE_FORMAT(c.StartDate, '%Y') <= {$_GET['Year']} AND DATE_FORMAT(c.StopDate, '%Y') >= {$_GET['Year']}
	              $cond
	              GROUP BY a.PersonID, d.TrainingType
	              ORDER  BY $order_by $asc_or_desc";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $persons[] = $row;
        }

        return $persons;
    }

    public static function getReports_37()
    {

        global $conn;

        $actions = array();

        if (empty($_GET['StartDate']) || empty($_GET['EndDate'])) {
            return $actions;
        }

        $StartDate = Utils::toDBDate($_GET['StartDate']);
        $EndDate = Utils::toDBDate($_GET['EndDate']);

        $cond = "";
        if (!empty($_GET['PersonID'])) {
            $cond .= " AND a.PersonID = " . (int)$_GET['PersonID'];
        }
        if (!empty($_GET['Type'])) {
            $cond .= " AND b.Type = " . (int)$_GET['Type'];
        }

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'b.CreateDate';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'desc';


        $query = "SELECT a.FullName, a.CNP, b.Type,b.Comment,b.CreateDate,c.UserName, (SELECT FullName FROM persons WHERE PersonID=b.PID) AS UpdateFullName
	              FROM persons a
	              		INNER JOIN persons_log b ON a.PersonID = b.PersonID
	              		INNER JOIN users c ON b.UserID=c.UserID
	              WHERE  (b.CreateDate BETWEEN '{$StartDate}' AND '{$EndDate}')
	              $cond
	              ORDER  BY  $order_by $asc_or_desc";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $row['Date'] = Utils::toDBDateTime($row['CreateDate']);
            $actions[] = $row;
        }
        //var_dump($actions);
        return $actions;
    }

    public static function getReports_38()
    {

        global $conn;

        $persons = array();

        if (empty($_GET['SelDate']) && empty($_GET['SelDatef'])) {
            return $persons;
        }
        $SelDate = !empty($_GET['SelDate']) ? Utils::toDBDate($_GET['SelDate']) : '';
        $SelDatef = !empty($_GET['SelDatef']) ? Utils::toDBDate($_GET['SelDatef']) : '';
        $ColDate = !empty($_GET['Status']) && in_array($_GET['Status'], array(5, 6)) ? 'b.StopDate' : 'b.StartDate';
        $cond = !empty($SelDate) && !empty($SelDatef) ? "({$ColDate} BETWEEN '{$SelDate}' AND '{$SelDatef}')" : (!empty($SelDate) ? "{$ColDate} >= '{$SelDate}'" : "{$ColDate} <= '{$SelDatef}'");

        if ($_GET['ShowLeft'] == 0)
            $cond .= " AND (b.StopDate='00-00-0000' OR b.StopDate IS NULL)";

        if (!empty($_GET['Status'])) {
            $cond .= " AND a.Status = " . (int)$_GET['Status'];
        }

        if (!empty($_GET['ContractType'])) {
            $cond .= " AND b.ContractType = " . (int)$_GET['ContractType'];
        }

        if (!empty($_GET['CompanyID'])) {
            $cond .= " AND a.PersonID IN (
					    SELECT PersonID
					    FROM   payroll
					    WHERE  CompanyID = " . (int)$_GET['CompanyID'] . "
					)";
        }

        if (!empty($_GET['DepartmentID'])) {
            $cond .= " AND a.PersonID IN (
					    SELECT PersonID
					    FROM   payroll
					    WHERE  DepartmentID = " . (int)$_GET['DepartmentID'] . "
					)";
        }
        if (!empty($_GET['SubDepartmentID'])) {
            $cond .= " AND b.SubDepartmentID = " . (int)$_GET['SubDepartmentID'];

        }

        if (!empty($_GET['DivisionID'])) {
            $cond .= " AND a.PersonID IN (
					    SELECT PersonID
					    FROM   payroll
					    WHERE  DivisionID = " . (int)$_GET['DivisionID'] . "
					)";
        }

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.FullName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';


        $query = "SELECT *, DATE_FORMAT(b.StartDate, '%d.%m.%Y') AS DataStart,DATE_FORMAT(b.StopDate, '%d.%m.%Y') AS DataStop, a.Status AS PersonStatus
	              FROM persons a
	              INNER JOIN payroll b ON a.PersonID = b.PersonID
	              LEFT  JOIN departments c ON b.DepartmentID = c.DepartmentID
                  LEFT  JOIN subdepartments d ON b.SubDepartmentID = d.SubDepartmentID
                  LEFT  JOIN companies e ON b.CompanyID = e.CompanyID
                  LEFT  JOIN divisions f ON b.DivisionID = f.DivisionID
	              WHERE  ($cond)
	              ORDER  BY $order_by $asc_or_desc";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $persons[] = $row;
        }

        return $persons;
    }


    public static function getReports_42()
    {

        global $conn;

        $persons = array();

        if (empty($_GET['StartDate'])) {
            return $persons;
        }

        if (empty($_GET['EndDate'])) {
            $_GET['EndDate'] = date('d-m-Y');
        }

        $StartDate = Utils::toDBDate($_GET['StartDate']);
        $EndDate = Utils::toDBDate($_GET['EndDate']);

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.FullName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';


        $cond = '';
        if (!empty($_GET['Status'])) {
            $cond .= " AND a.Status = '{$_GET['Status']}'";
        }
        if (!empty($_GET['ContractType'])) {
            $cond .= " AND b.ContractType = '{$_GET['ContractType']}'";
        }

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'LastName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        $query = "SELECT l.*, m.*,n.*, a.FullName, a.FirstName, a.LastName, a.Status, a.CNP, 
	    				b.WorkNorm, c.Function, c.COR, b.ContractType,b.ContractNo, b.HealthCompanyID,
	                     DATE_FORMAT(b.StartDate, '%d.%m.%Y') AS data_inch,
			     		 DATE_FORMAT(b.StopDate, '%d.%m.%Y') AS data_exp,
			     		 DATE_FORMAT(b.ContractDate, '%d.%m.%Y') AS cdata_inch,
			     		 DATE_FORMAT(b.ContractExpDate, '%d.%m.%Y') AS cdata_exp,
			     		 (SELECT Salary FROM persons_salary WHERE PersonID=a.PersonID ORDER BY SalaryID DESC LIMIT 1) AS Salary,
			     		 (SELECT SalaryNet FROM persons_salary WHERE PersonID=a.PersonID ORDER BY SalaryID DESC LIMIT 1) AS SalaryNet,
			     		 d.Department
	              FROM   persons a
		             LEFT JOIN payroll b ON a.PersonID = b.PersonID
			     LEFT JOIN functions c ON b.FunctionID = c.FunctionID
			     LEFT JOIN departments d ON b.DepartmentID=d.DepartmentID
			     LEFT JOIN address l ON a.AddressID=l.AddressID
                 LEFT JOIN address_city m ON l.CityID=m.CityID
                 LEFT JOIN address_district n ON m.DistrictID=n.DistrictID
		      WHERE  
		      (b.StartDate BETWEEN '{$StartDate}' AND '{$EndDate}') $cond
		      ORDER  BY $order_by $asc_or_desc";
        $conn->query($query);
        while ($info = $conn->fetch_array()) {
            $PersonAddress = '';
            if ($info['StreetName']) $PersonAddress .= 'Strada: ' . $info['StreetName'];
            if ($info['StreetCode']) $PersonAddress .= ', Cod postal: ' . $info['StreetCode'];
            if ($info['StreetNumber']) $PersonAddress .= ', Numar: ' . $info['StreetNumber'];
            if ($info['Bl']) $PersonAddress .= ', Bl: ' . $info['Bl'];
            if ($info['Sc']) $PersonAddress .= ', Sc: ' . $info['Sc'];
            if ($info['Et']) $PersonAddress .= ', Et: ' . $info['Et'];
            if ($info['Ap']) $PersonAddress .= ', Ap: ' . $info['Ap'];
            if ($info['CityName']) $PersonAddress .= ', ' . $info['CityName'];
            if ($info['DistrictName']) $PersonAddress .= ', ' . $info['DistrictName'];
            $PersonAddress = trim($PersonAddress, ',');
            $info['PersonAddress'] = $PersonAddress;
            $persons[] = $info;
        }
        return $persons;
    }

    public static function getReports_43()
    {

        global $conn;

        $CostCenterID = (int)$_GET['CostCenterID'];
        if (empty($CostCenterID)) {
            return;
        }

        $persons = array();

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'FullName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        $query = "SELECT a.FullName, a.Status, d.CostCenterID,
	                     DATE_FORMAT(b.StartDate, '%d.%m.%Y') AS data_inch,
			     DATE_FORMAT(b.StopDate, '%d.%m.%Y') AS data_exp,
			     c.Function
	              FROM   persons a
		             INNER JOIN payroll b ON a.PersonID = b.PersonID
		             INNER JOIN payroll_costcenter d ON a.PersonID = d.PersonID AND d.CostCenterID = $CostCenterID
			     LEFT JOIN functions c ON b.FunctionID = c.FunctionID
		      WHERE  a.Status IN (2,3,4,7)
		      ORDER  BY $order_by $asc_or_desc";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $persons[] = $row;
        }
        return $persons;
    }

    public static function getReports_44()
    {

        global $conn;

        if (!isset($_GET['StartDate'])) {
            return;
        }

        $cond = '';

        if (!empty($_GET['StartDate'])) {
            $StartDate = Utils::toDBDate($_GET['StartDate']);
            $cond .= " AND a.CreateDate >= '{$StartDate}'";
        }
        if (!empty($_GET['EndDate'])) {
            $EndDate = Utils::toDBDate($_GET['EndDate']);
            $cond .= " AND a.CreateDate <= '{$EndDate}'";
        }
        if (!empty($_GET['CVSource1']) || !empty($_GET['CVSource2']) || !empty($_GET['CVSource3']) || !empty($_GET['CVSource4'])) {
            if (!empty($_GET['CVSource1'])) {
                $cnd[] = " CVSource = '{$_GET['CVSource1']}'";
            }
            if (!empty($_GET['CVSource2'])) {
                $cnd[] = " CVSource = '{$_GET['CVSource2']}'";
            }
            if (!empty($_GET['CVSource3'])) {
                $cnd[] = " CVSource = '{$_GET['CVSource3']}'";
            }
            if (!empty($_GET['CVSource4'])) {
                $cnd[] = " CVSource = '{$_GET['CVSource4']}'";
            }
            $cond .= " AND (" . implode(" OR ", $cnd) . ")";
        }

        $persons = array();

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'FullName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        $query = "SELECT a.FullName, DATE_FORMAT(a.CreateDate, '%d.%m.%Y') AS data, a.CVSource, CVSourceDetails
	              FROM   persons a
		      WHERE  a.Status = 1 $cond
		      ORDER  BY $order_by $asc_or_desc";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $persons[] = $row;
        }
        return $persons;
    }

    public static function getReports_46()
    {

        global $conn, $deps;

        $deps = array();
        $cond = "";
        if (!empty($_GET['CompanyID'])) {
            $cond = " AND b.CompanyID = '{$_GET['CompanyID']}'";
            $conn->query("SELECT DISTINCT DepartmentID FROM payroll b WHERE 1=1 $cond");
            while ($row = $conn->fetch_array()) {
                $deps[$row['DepartmentID']] = 1;
            }
        }

        if (!isset($_GET['StartDate'])) {
            return;
        }

        $cond .= !empty($_GET['DepartmentID']) ? " AND b.DepartmentID = '{$_GET['DepartmentID']}'" : "";

        if (empty($_GET['EndDate'])) {
            $_GET['EndDate'] = date('d-m-Y');
        }
        $StartDate = Utils::toDBDate($_GET['StartDate']);
        $EndDate = Utils::toDBDate($_GET['EndDate']);

        $query = "SELECT a.PersonID, a.FullName, b.DepartmentID
	              FROM   persons a
		             INNER JOIN payroll b ON a.PersonID = b.PersonID WHERE a.Status IN (2,9,12) $cond
		      ORDER  BY a.FullName";

        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $persons[$row['PersonID']] = $row;
        }

        $query = "SELECT a.PersonID, a.RegDate, a.EndDate
		      FROM   persons_beneficii a
		      WHERE  a.Type = 4 AND
		             ((a.RegDate >= '{$StartDate}') OR
		              (a.EndDate <= '{$EndDate}') OR
		              ('{$StartDate}' BETWEEN a.RegDate AND a.EndDate))
                            AND a.PersonID IN ('" . implode("','", array_keys($persons)) . "')
		      ORDER  BY a.RegDate";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $DataIni = strtotime($StartDate) >= strtotime($row['RegDate']) ? $StartDate : $row['RegDate'];
            $DataFin = strtotime($EndDate) >= strtotime($row['EndDate']) && $row['EndDate'] != '0000-00-00' ? $row['EndDate'] : $EndDate;
            $persons[$row['PersonID']]['DataIni'] = $DataIni;
            $persons[$row['PersonID']]['DataFin'] = $DataFin;
            $persons[$row['PersonID']]['work_days'] += Utils::getDaysDiff($DataIni, $DataFin);
        }

        $vacations = array();
        $query = "SELECT a.PersonID, a.StartDate, a.StopDate FROM vacations_details a
                            WHERE a.Aprove = 1 AND ((a.StartDate >= '{$StartDate}' AND a.StartDate <='{$EndDate}')
                            OR (a.StopDate >= '{$StartDate}' AND a.StopDate <= '{$EndDate}'))";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $vacations[$row['PersonID']][] = $row;
        }

        $displacements = array();
        $query = "SELECT a.PersonID, a.StartDate, a.StopDate FROM persons_displacement a
                            WHERE (a.StartDate >= '{$StartDate}' AND a.StartDate <='{$EndDate}')
                            OR (a.StopDate >= '{$StartDate}' AND a.StopDate <= '{$EndDate}')";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $displacements[$row['PersonID']][] = $row;
        }

        foreach ($persons as $PersonID => $person) {
            if (!empty($vacations[$PersonID]))
                foreach ($vacations[$PersonID] as $vacation) {
                    $DataIni = strtotime($person['DataIni']) >= strtotime($vacation['StartDate']) ? $person['DataIni'] : $vacation['StartDate'];
                    $DataFin = strtotime($person['DataFin']) >= strtotime($vacation['StopDate']) ? $vacation['StopDate'] : $person['DataFin'];
                    $persons[$PersonID]['vac_days'] += Utils::getDaysDiff($DataIni, $DataFin);
                }
            if (!empty($displacements[$PersonID]))
                foreach ($displacements[$PersonID] as $displacement) {
                    $DataIni = strtotime($person['DataIni']) >= strtotime($displacement['StartDate']) ? $person['DataIni'] : $displacement['StartDate'];
                    $DataFin = strtotime($person['DataFin']) >= strtotime($displacement['StopDate']) ? $displacement['StopDate'] : $person['DataFin'];
                    $diff = Utils::getDateTimeDiff($DataIni, $DataFin);
                    $persons[$PersonID]['disp_days'] += $diff['days'];
                    if ($diff['h'] >= 12) {
                        $persons[$PersonID]['disp_days']++;
                    }
                }

            $query = "SELECT PersonID, SUM(Hours_Abs + Hours_P + Hours_LP) AS Abs
	                  FROM   pontaj_simple
		          WHERE  Data BETWEEN '{$person['DataIni']}' AND '{$person['DataFin']}'
                                    AND PersonID = '{$PersonID}'";
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                if (isset($persons[$row['PersonID']])) {
                    @$persons[$row['PersonID']]['abs_days'] += $row['Abs'];
                }
            }
        }

        return $persons;
    }

    public static function getReports_47()
    {

        global $conn;

        $persons = array();

        if (!empty($_GET['status'])) {
            $query = "SELECT LastName, FirstName, CNP, Email,
		                   CASE WHEN DateOfBirth > '0000-00-00' THEN DATE_FORMAT(DateOfBirth, '%d.%m.%Y') ELSE '' END AS DateOfBirth,
				   MotherFirstName, FatherFirstName,
				   CASE WHEN StartDate > '0000-00-00' THEN DATE_FORMAT(StartDate, '%d.%m.%Y') ELSE '' END AS StartDate,
				   c.CompanyName
	                    FROM   persons a
			           LEFT JOIN payroll b ON a.PersonID = b.PersonID
				   LEFT JOIN companies c ON b.CompanyID = c.CompanyID
			    WHERE  Status IN ({$_GET['status']})
		            ORDER  BY LastName, FirstName";
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $persons[] = $row;
            }
        }

        return $persons;
    }

    public static function getReports_48()
    {

        global $conn;

        $persons = array();

        if (!empty($_GET['status'])) {
            $query = "SELECT LastName, FirstName, CNP, CASE WHEN Mobile > '' THEN Mobile ELSE Phone END AS Phone, Email,
		                   b.StreetName, b.StreetCode, b.StreetNumber, b.Bl, b.Sc, b.Et, b.Ap, d.CityName, e.DistrictName,
				   Sex, Nationality, Studies, FLOOR(DATEDIFF(CURRENT_DATE, a.DateOfBirth) / 365) AS varsta,
				   CASE WHEN StartDate > '0000-00-00' THEN DATE_FORMAT(StartDate, '%Y') ELSE '' END AS YearIn,
				   CASE WHEN StartDate > '0000-00-00' THEN DATE_FORMAT(StartDate, '%m') ELSE '' END AS MonthIn,
				   CASE WHEN StopDate > '0000-00-00' THEN DATE_FORMAT(StopDate, '%Y') ELSE '' END AS YearOut,
				   CASE WHEN StopDate > '0000-00-00' THEN DATE_FORMAT(StopDate, '%m') ELSE '' END AS MonthOut
	                    FROM   persons a
			           LEFT JOIN address b ON b.AddressID = a.AddressID
                        	   LEFT JOIN address_city d ON d.CityID = b.CityID
                        	   LEFT JOIN address_district e ON e.DistrictID = d.DistrictID
				   LEFT JOIN payroll f ON a.PersonID = f.PersonID				   
			    WHERE  Status IN ({$_GET['status']})
		            ORDER  BY LastName, FirstName";
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $persons[] = $row;
            }
        }
        return $persons;
    }

    public static function getReports_49()
    {

        global $conn;

        $vacations = array();
        $cond = "";

        if (empty($_GET['StartDate']) || empty($_GET['EndDate'])) {
            return $vacations;
        }

        if (!empty($_GET['CompanyID'])) {
            $cond .= " AND a.PersonID IN (
					    SELECT PersonID
					    FROM   payroll
					    WHERE  CompanyID = " . (int)$_GET['CompanyID'] . "
					)";
        }

        if (!empty($_GET['DepartmentID'])) {
            $cond .= " AND a.PersonID IN (
					    SELECT PersonID
					    FROM   payroll
					    WHERE  DepartmentID = " . (int)$_GET['DepartmentID'] . "
					)";
        }
        if (!empty($_GET['SubDepartmentID'])) {
            $cond .= " AND c.SubDepartmentID = " . (int)$_GET['SubDepartmentID'];

        }

        if (!empty($_GET['DivisionID'])) {
            $cond .= " AND a.PersonID IN (
					    SELECT PersonID
					    FROM   payroll
					    WHERE  DivisionID = " . (int)$_GET['DivisionID'] . "
					)";
        }

        if ($_GET['Aprove'] != '')
            $cond .= " AND a.Aprove = {$_GET['Aprove']}";

        $StartDate = Utils::toDBDate($_GET['StartDate']);
        $EndDate = Utils::toDBDate($_GET['EndDate']);


        $query = "SELECT *, b.FullName, a.StartDate AS VacationStartDate, a.StopDate AS VacationStopDate
		      FROM   vacations_details a
		             INNER JOIN persons b ON a.PersonID = b.PersonID
		             INNER JOIN payroll c ON a.PersonID = c.PersonID
	              	 LEFT  JOIN departments d ON c.DepartmentID = d.DepartmentID
                     LEFT  JOIN subdepartments e ON c.SubDepartmentID = e.SubDepartmentID
                     LEFT  JOIN companies f ON c.CompanyID = f.CompanyID
                     LEFT  JOIN divisions g ON c.DivisionID = g.DivisionID
		      WHERE  ((a.StartDate BETWEEN '{$StartDate}' AND '{$EndDate}') OR
		             (a.StopDate BETWEEN '{$StartDate}' AND '{$EndDate}') OR
		             ('{$StartDate}' BETWEEN a.StartDate AND a.StopDate))
		              $cond
		      ORDER  BY b.FullName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $res[] = $row;
        }
//Utils::pa($res);
        return $res;
    }

    public static function setReports_49($info = array())
    {

        global $conn;

        if (!empty($info['Aprove1']))
            $aprove = 1;
        if (!empty($info['Aprove0']))
            $aprove = 0;
        if (!empty($info['AproveR']))
            $aprove = -1;

        $conn->query("UPDATE vacations_details SET Notes='{$_POST['Notes']}', Aprove='$aprove' WHERE VacationID='{$_POST['VacationID']}'");
    }

    public static function getReports_50()
    {

        if (empty($_GET['ProjectID'])) {
            return array();
        }

        $ProjectID = (int)$_GET['ProjectID'];

        global $conn;

        $persons = array();

        $query = "SELECT c.LastName, c.FirstName, e.JobTitle, a.InterviewNo, a.InterviewQual,
		                 a.EventData, a.EventHourStart, a.EventHourStop
		          FROM   events a
			         INNER JOIN event_persons b ON a.EventID = b.EventID
				 INNER JOIN persons c ON b.PersonID = c.PersonID
				 INNER JOIN jobs d ON a.InterviewJobID = d.JobID
				 INNER JOIN jobsdictionary e ON d.JobDictionaryID = e.JobDictionaryID 
			  WHERE  a.ProjectID = $ProjectID
			  ORDER  BY c.LastName, c.FirstName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $persons[] = $row;
        }

        return $persons;
    }

    public static function getReports_51($type = 0)
    {

        if (empty($_GET['JobID']) || empty($_GET['Type'])) {
            return array();
        }

        $JobID = (int)$_GET['JobID'];
        $type = $_GET['Type'];

        global $conn;

        $query = "SELECT FunctionIDRecr FROM jobs WHERE JobID = $JobID";
        $conn->query($query);
        $FunctionIDRecr = ($row = $conn->fetch_array()) ? $row['FunctionIDRecr'] : 0;

        if (empty($FunctionIDRecr)) {
            return array();
        }

        if ($type == 'employee') {
            $cond_status = " AND a.Status IN (2,9) ";
        }
        if ($type == 'colaborator') {
            $cond_status = " AND a.Status IN (3,7) ";
        }

        $persons = array();

        if ($type == 'employee' || $type == 'colaborator') {
            $query = "SELECT a.LastName, a.FirstName, a.Email, a.Phone, d.CityName, e.DistrictName
			          FROM   persons a
				         INNER JOIN 
					    (
						SELECT PersonID FROM persons_prof WHERE FunctionIDRecr = $FunctionIDRecr
			        		UNION
						SELECT PersonID FROM persons_func_recr WHERE FunctionIDRecr = $FunctionIDRecr
					    ) b ON a.PersonID = b.PersonID
					 LEFT JOIN address c ON a.AddressID = c.AddressID
	                        	 LEFT JOIN address_city d ON c.CityID = d.CityID
					 LEFT JOIN address_district e ON d.DistrictID = e.DistrictID
					 WHERE 1=1
					 $cond_status
				  ORDER  BY a.LastName, a.FirstName";
        } elseif ($type == 'candidate') {
            $query = "SELECT a.LastName, a.FirstName, a.Email, a.Phone, d.CityName, e.DistrictName
			          FROM   candidates_internal a
				         INNER JOIN 
					    (
						SELECT PersonID FROM candidates_internal_prof WHERE FunctionIDRecr = $FunctionIDRecr
			        		UNION
						SELECT PersonID FROM candidates_internal_func_recr WHERE FunctionIDRecr = $FunctionIDRecr
					    ) b ON a.PersonID = b.PersonID
					 LEFT JOIN address c ON a.AddressID = c.AddressID
	                        	 LEFT JOIN address_city d ON c.CityID = d.CityID
					 LEFT JOIN address_district e ON d.DistrictID = e.DistrictID
					 WHERE 1=1
				  ORDER  BY a.LastName, a.FirstName";
        }
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $persons[] = $row;
        }

        return $persons;
    }

    public static function getReports_58()
    {

        global $conn;

        $StartDate = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - date("d") + 1, date("Y")));
        $EndDate = date("Y-m-d", mktime(0, 0, 0, date("m") + 1, date("d") - date("d"), date("Y")));

        $LastStartDate = date("Y-m-d", mktime(0, 0, 0, date("m") - 1, date("d") - date("d") + 1, date("Y")));
        $LastEndDate = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - date("d"), date("Y")));

        $persons[0]['work_days'] = $work_days = Utils::getDaysDiff($StartDate, $EndDate);

        $old_vacations = array();
        $conn->query("SELECT * FROM vacations_details WHERE Type = 'CO' AND ((StartDate <= '{$LastEndDate}' AND StopDate >= '{$LastStartDate}') OR (StartDate BETWEEN '{$LastStartDate}' AND '{$LastEndDate}'))");
        while ($row = $conn->fetch_array()) {
            $old_vacations[$row['PersonID']][] = $row;
        }

        $vacations = array();
        $conn->query("SELECT * FROM vacations_details WHERE ((StartDate <= '{$EndDate}' AND StopDate >= '{$StartDate}') OR (StartDate BETWEEN '{$StartDate}' AND '{$EndDate}'))");
        while ($row = $conn->fetch_array()) {
            $vacations[$row['PersonID']][$row['Type']][] = $row;
        }

        $query = "SELECT a.PersonID, a.FirstName, a.LastName, c.Department, b.EmpCode, b.StartDate, b.StopDate, b.ContractType, b.ContractDate, ContractExpDate, b.SuspendDate, b.ReturnDate,

	              (SELECT SUM(TotalCost*(IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '" . date('Y') . "'), 1))) FROM persons_beneficii e WHERE Type='11' AND e.PersonID=a.PersonID AND (e.RegDate <='$StartDate' AND e.EndDate>='$EndDate')) AS BSport,
	              (SELECT SUM(TotalCost*(IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '" . date('Y') . "'), 1))) FROM persons_beneficii e WHERE Type='12' AND e.PersonID=a.PersonID AND e.Retained=1 AND (e.RegDate <='$StartDate' AND e.EndDate>='$EndDate')) AS PFac,
	              (SELECT SUM(Salary*(IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '" . date('Y') . "'), 1))) FROM persons_salary_extra f WHERE Type='bonus' AND f.PersonID=a.PersonID AND (f.StartDate BETWEEN '$StartDate' AND '$EndDate')) AS Bonus,
	              (SELECT SUM(Salary*(IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '" . date('Y') . "'), 1))) FROM persons_salary_extra f WHERE Type='bonus_natura' AND f.PersonID=a.PersonID AND (f.StartDate BETWEEN '$StartDate' AND '$EndDate')) AS BNatura,
	    		  (SELECT SUM(SalaryNet*(IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '" . date('Y') . "'), 1))) FROM persons_salary_extra f WHERE Type='bonus_sales' AND f.PersonID=a.PersonID AND (f.StartDate BETWEEN '$StartDate' AND '$EndDate')) AS BSales
	              FROM   persons a
		             LEFT JOIN payroll b ON a.PersonID = b.PersonID
			     LEFT JOIN departments c ON b.DepartmentID = c.DepartmentID
			     WHERE a.Status IN(2,3,9) AND ((DATE_FORMAT(b.StopDate, '%Y-%m')<=DATE_FORMAT(CURRENT_TIMESTAMP, '%Y-%m') OR b.StopDate IS NULL OR b.StopDate='0000-00-00'))
		      ORDER  BY a.LastName, a.FirstName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $PersonStart = (strtotime($row['StartDate']) < strtotime($StartDate) ? $StartDate : $row['StartDate']);
            $PersonStop = $EndDate;
            if (!empty($row['StopDate']) && $row['StopDate'] != '0000-00-00') {
                if (strtotime($row['StopDate']) < strtotime($PersonStop) && strtotime($row['StopDate']) >= strtotime($PersonStart)) {
                    $PersonStop = $row["StopDate"];
                }
            }
            if ($row['ContractType'] == 1 && !empty($row['ContractExpDate']) && $row['ContractExpDate'] != '0000-00-00') {
                if (strtotime($row["ContractExpDate"]) < strtotime($PersonStop) && strtotime($row['ContractExpDate']) >= strtotime($PersonStart)) {
                    $PersonStop = $row['ContractExpDate'];
                }
            }

            $work_days = 0;
            if (in_array($row['ContractType'], array(1, 2))) {
                $work_days = Utils::getDaysDiff($PersonStart, $PersonStop);
            } elseif (in_array($row['ContractType'], array(3))) {
                if (!empty($row['SuspendDate']) && $row['SuspendDate'] != '0000-00-00' && strtotime($row['SuspendDate']) > strtotime($PersonStart)) {
                    @$work_days += Utils::getDaysDiff($PersonStart, $row['SuspendDate']);
                }
                if (!empty($row['ReturnDate']) && $row['ReturnDate'] != '0000-00-00' && strtotime($row['ReturnDate']) < strtotime($PersonStop)) {
                    @$work_days += Utils::getDaysDiff($row['ReturnDate'], $PersonStop);
                }
            }

            if (!empty($vacations[$row['PersonID']]['CO']))
                foreach ($vacations[$row['PersonID']]['CO'] as $co) {
                    $Start = (strtotime($co['StartDate']) < strtotime($PersonStart) ? $PersonStart : $co['StartDate']);
                    $Stop = (strtotime($co['StopDate']) > strtotime($PersonStop) ? $PersonStop : $co['StopDate']);

                    if (strtotime($PersonStop) < strtotime($Stop))
                        $Stop = $PersonStop;

                    @$row['CO'] += Utils::getDaysDiff($Start, $Stop);
                }
            if (!empty($vacations[$row['PersonID']]['CM']))
                foreach ($vacations[$row['PersonID']]['CM'] as $cm) {
                    $Start = (strtotime($cm['StartDate']) < strtotime($PersonStart) ? $PersonStart : $cm['StartDate']);
                    $Stop = (strtotime($cm['StopDate']) > strtotime($PersonStop) ? $PersonStop : $cm['StopDate']);

                    if (strtotime($PersonStop) < strtotime($Stop))
                        $Stop = $PersonStop;

                    @$row['CM'] += Utils::getDaysDiff($Start, $Stop);
                }
            if (!empty($vacations[$row['PersonID']]['CIC']))
                foreach ($vacations[$row['PersonID']]['CIC'] as $cic) {
                    $Start = (strtotime($cic['StartDate']) < strtotime($PersonStart) ? $PersonStart : $cic['StartDate']);
                    $Stop = (strtotime($cic['StopDate']) > strtotime($PersonStop) ? $PersonStop : $cic['StopDate']);

                    if (strtotime($PersonStop) < strtotime($Stop))
                        $Stop = $PersonStop;

                    @$row['CIC'] += Utils::getDaysDiff($Start, $Stop);
                }
            if (!empty($vacations[$row['PersonID']]['CFS']))
                foreach ($vacations[$row['PersonID']]['CFS'] as $cfs) {
                    $Start = (strtotime($cfs['StartDate']) < strtotime($PersonStart) ? $PersonStart : $cfs['StartDate']);
                    $Stop = (strtotime($cfs['StopDate']) > strtotime($PersonStop) ? $PersonStop : $cfs['StopDate']);

                    if (strtotime($PersonStop) < strtotime($Stop))
                        $Stop = $PersonStop;

                    @$row['CFS'] += Utils::getDaysDiff($Start, $Stop);
                }

            if (!empty($old_vacations[$row['PersonID']]))
                foreach ($old_vacations[$row['PersonID']] as $old_co) {
                    $Start = (strtotime($old_co['StartDate']) < strtotime($LastStartDate) ? $LastStartDate : $old_co['StartDate']);
                    $Stop = (strtotime($old_co['StopDate']) > strtotime($LastEndDate) ? $LastEndDate : $old_co['StopDate']);

                    if (strtotime($PersonStop) < strtotime($Stop))
                        $Stop = $PersonStop;

                    @$row['ANT_CO'] += Utils::getDaysDiff($Start, $Stop);
                }


            $eff_days = $work_days - $row['CO'] - $row['CM'] - $row['CIC'] - $row['CFS'];
            $row['LUCR'] = $eff_days;
            $persons[] = $row;
        }
        return $persons;
    }

    public static function getReports_59()
    {

        if (!isset($_GET['StartDate'])) {
            return;
        }

        global $conn;

        $StartDate = Utils::toDBDate($_GET['StartDate']);
        $EndDate = Utils::toDBDate($_GET['EndDate']);

        $catering = array();

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.Date, d.FullName, a.CatID, a.ItemID';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        if (!empty($_GET['NoCatering'])) {
            $query = "SELECT a.FullName, e.EmpCode
		          FROM   persons a
		          INNER JOIN payroll e ON a.PersonID = e.PersonID
				  LEFT JOIN persons_beneficii pb ON pb.PersonID = a.PersonID AND pb.Type = 9
		          WHERE a.PersonID NOT IN (SELECT PersonID FROM persons_catering WHERE (Date BETWEEN '{$StartDate}' AND '{$EndDate}') AND No>0) AND (pb.EndDate = '0000-00-00' OR pb.EndDate >= {$StartDate})  AND a.Status IN(2,7,9,12)
			  ORDER  BY FullName";
        } else {
            $query = "SELECT a.No, b.Category, c.Item, a.Date, d.FullName, e.EmpCode
		          FROM   persons_catering a
			         INNER JOIN catering b ON a.CatID = b.CatID
				 INNER JOIN catering_items c ON a.ItemID = c.ItemID
				 INNER JOIN persons d ON a.PersonID = d.PersonID
				 INNER JOIN payroll e ON d.PersonID = e.PersonID
			  WHERE  (a.Date BETWEEN '{$StartDate}' AND '{$EndDate}') AND a.No>0 AND d.Status IN(2,7,9,12)
			  ORDER  BY $order_by $asc_or_desc";
        }
        //print_r($query);
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $catering[] = $row;
        }
        return $catering;
    }

    public static function getReports_60()
    {

        if (!isset($_GET['StartDate']) && !isset($_GET['EndDate'])) {
            return array();
        }

        $cond = '';
        if (!empty($_GET['FunctionID'])) {
            $FunctionID = (int)$_GET['FunctionID'];
            $cond .= " AND lmf.FunctionID = '$FunctionID'";
        }

        if (!empty($_GET['PersonID'])) {
            $PersonID = (int)$_GET['PersonID'];
            $cond .= " AND pers.PersonID = '$PersonID' ";
        }

        if (!empty($_GET['ReadStatus'])) {
            $ReadStatus = $_GET['ReadStatus'];
            if ($ReadStatus == -1)
                $cond .= ' AND lmr.PersonID IS NULL ';
            if ($ReadStatus == 1)
                $cond .= ' AND lmr.PersonID IS NOT NULL';
        }

        if (!empty($_GET['StartDate'])) {
            $StartDate = Utils::toDBDate($_GET['StartDate']);
            $cond .= " AND lmf.CreateDate >= '" . $StartDate . " 00:00:01'";
        }
        if (!empty($_GET['EndDate'])) {
            $EndDate = Utils::toDBDate($_GET['EndDate']);
            $cond .= " AND lmf.CreateDate <= '" . $EndDate . " 23:59:59'";
        }

        global $conn;

        $res = array();


        $query = "SELECT ld.DocName, pers.FullName, intf.Function, IF(lmr.ReadID, 1, -1) AS ReadStatus, lmr.CreateDate AS ReadCreateDate
                    FROM library_mandatory_functions lmf
                    INNER JOIN library_documents ld ON ld.DocID = lmf.DocID
                    LEFT JOIN payroll p ON p.InternalFunction = lmf.FunctionID
                    LEFT JOIN persons pers ON pers.PersonID = p.PersonID
                    LEFT JOIN internal_functions intf ON intf.FunctionID = p.InternalFunction
                    LEFT JOIN library_mandatory_reads lmr ON lmr.PersonID = p.PersonID AND lmr.MandatoryID = lmf.MandatoryID
                WHERE ld.MandatoryReading = 1 AND pers.Status NOT IN (5, 6) " . $cond . "
                ORDER BY pers.FullName, ld.DocName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $res[] = $row;
        }

        return $res;
    }


    public static function getReports_61()
    {

        if (!isset($_GET['StartDate']) || empty($_GET['StartDate'])) {
            return;
        }

        global $conn;

        $StartDate = Utils::toDBDate($_GET['StartDate']);
        $EndDate = Utils::toDBDate($_GET['EndDate']);

        $dates = Utils::getDatesFromRange($StartDate, $EndDate);

        $catering = array();

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'd.FullName, a.CatID, a.ItemID, a.Date';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        $vperiods = array();
        $vperiods_merged = array();

        // GET vacations periods for all employees
        $query_v = "SELECT PersonID, StartDate, StopDate FROM vacations_details 
	   				WHERE ((Type='CO' AND Aprove=1) OR Type IN ('CFS','CIC','CS','CM')) 
	   				AND ((StartDate >= '$StartDate' AND StopDate<='$EndDate') OR  
	   					(StartDate <= '$StartDate' AND StopDate<='$EndDate') OR  
	   					(StartDate >= '$StartDate' AND StopDate>='$EndDate') OR  
	   					(StartDate <= '$StartDate' AND StopDate>='$EndDate')
	   					)
	   				";
        //AND ((StartDate BETWEEN '$StartDate' AND '$EndDate') OR  (StopDate BETWEEN '$StartDate' AND '$EndDate'))
        $conn->query($query_v);
        while ($row = $conn->fetch_array()) {
            $row['vdays'] = Utils::getDaysList($row['StartDate'], $row['StopDate'], true, true, null, null, array());
            $vperiods[$row['PersonID']][] = $row['vdays'];
        }

        //Utils::pa($vperiods);

        foreach ($vperiods as $PersonID => $list_days) {
            $vperiods_merged[$PersonID] = array_unique(call_user_func_array('array_merge', $list_days));
        }

        $dperiods = array();
        $dperiods_merged = array();

        // GET displacements periods for all employees
        $query_d = "SELECT PersonID, StartDate, StopDate FROM persons_displacement 
	   				WHERE ((StartDate >= '$StartDate' AND StopDate<='$EndDate') OR  
		   					(StartDate <= '$StartDate' AND StopDate<='$EndDate') OR  
		   					(StartDate >= '$StartDate' AND StopDate>='$EndDate') OR  
		   					(StartDate <= '$StartDate' AND StopDate>='$EndDate')
		   				   )";
        // (StartDate BETWEEN '$StartDate' AND '$EndDate') OR  (StopDate BETWEEN '$StartDate' AND '$EndDate')
        $conn->query($query_d);
        while ($row = $conn->fetch_array()) {
            $row['ddays'] = Utils::getDaysList($row['StartDate'], $row['StopDate'], true, true, null, null, array());
            $dperiods[$row['PersonID']][] = $row['ddays'];
        }
        foreach ($dperiods as $PersonID => $list_days) {
            $dperiods_merged[$PersonID] = array_unique(call_user_func_array('array_merge', $list_days));
        }

        // Main query for persons that ordered
        $query = "SELECT  d.PersonID, a.CatID, a.ItemID, a.Date, b.Category, b.Price, c.Item, d.FullName, e.EmpCode, e.SubDepartmentID, a.No,
			       1 AS NoFree, 
				   (SELECT SUM(pc2.No) FROM persons_catering pc2 WHERE pc2.PersonID = a.PersonID AND pc2.Date = a.Date) AS TotalItems,
			       0 AS NoPaid,
			       e.SubDepartmentID, a.ID as itemCatID
			       FROM persons_catering a			   
			       LEFT JOIN catering_items c ON (c.ItemID = a.ItemID AND c.CatId = a.CatId) 
				   INNER JOIN persons d ON d.PersonID = a.PersonID 
				   LEFT JOIN persons_beneficii cat ON cat.PersonID = d.PersonID AND cat.Type = 9 AND (cat.RegDate <= a.Date AND (cat.EndDate >= a.Date OR cat.EndDate = '0000-00-00')) AND (SELECT MAX(BenID) FROM persons_beneficii pb WHERE pb.PersonID = cat.PersonID) = cat.BenID			       
			       LEFT JOIN catering b ON a.CatID = b.CatID 
			       LEFT JOIN payroll e ON d.PersonID = e.PersonID " . (!empty($_GET['DivisionID']) ? " AND e.DivisionID = '{$_GET['DivisionID']}'" : "") .
            (!empty($_GET['DepartmentID']) ? " AND e.DepartmentID = '{$_GET['DepartmentID']}'" : "") . "
		      WHERE
				(a.Date BETWEEN '{$StartDate}' AND '{$EndDate}')
				AND a.No > 0 
				AND d.Status IN(2,7,9,12) 
				AND e.ContractType != 3 
		      ORDER  BY $order_by $asc_or_desc";
        $conn->query($query);


        while ($row = $conn->fetch_array()) {
            if ($row['No'])
                // Do not add to list if a vacation day
                if (in_array($row['Date'], $vperiods_merged[$row['PersonID']]))
                    continue;
            // Do not add to list if a displacement day
            if (in_array($row['Date'], $dperiods_merged[$row['PersonID']]))
                continue;

            /*if($row['SubDepartmentID']!=Config::CATERING_FREE_SUBDEPARTMENTID && $row['CatID']==Config::CATERING_SEMIFREE_CATEG ){
	    		$row['NoPaid'] = $row['NoPaid']+$row['NoFree'];
	    		$row['NoFree']=0;
	    	}*/
            $catering[0][$row['FullName']][$row['CatID']][$row['Date']]['DefaultFree'] = 1;
            $catering[0][$row['FullName']][$row['CatID']][$row['Date']]['TotalCatNo'] += $row['No'];
            $catering[0][$row['FullName']][$row['CatID']][$row['Date']]['RemCatPaidNo'] = $catering[0][$row['FullName']][$row['CatID']][$row['Date']]['TotalCatNo'] - $catering[0][$row['FullName']][$row['CatID']][$row['Date']]['DefaultFree'];

            $catering[0][$row['FullName']][$row['CatID']][$row['Date']][] = $row;
            if ($arrayPayedByPerson[$row['FullName']][$row['Date']] == "payed") {
                for ($i = 0; $i < 10; $i++) {
                    if ($catering[0][$row['FullName']][$row['CatID']][$row['Date']][$i]) {
                        //Utils::pa($catering[0][$row['FullName']][$row['CatID']][$row['Date']][$i]);
                        $catering[0][$row['FullName']][$row['CatID']][$row['Date']][$i]['NoFree'] = 0;
                        $catering[0][$row['FullName']][$row['CatID']][$row['Date']][$i]['NoPaid'] = $catering[0][$row['FullName']][$row['CatID']][$row['Date']][$i]['No'];
                    }
                }
            } else
                $arrayPayedByPerson[$row['FullName']][$row['Date']] = "payed";
        }
        if ($_SERVER['SERVER_ADDR'] == '10.10.100.234') {
            //Utils::pa($catering[0]);
        }

        // Group by category
        if (is_array($catering[0]))
            foreach ($catering[0] as $v) {
                foreach ($v as $vv) {
                    foreach ($vv as $weekmenu) {
                        foreach ($weekmenu as $daymenu) {
                            if (is_array($daymenu)) {
                                $catering[1][$daymenu['CatID']]['Category'] = $daymenu['Category'];
                                $catering[1][$daymenu['CatID']]['Price'] = $daymenu['Price'];
                                $catering[1][$daymenu['CatID']]['NoFree'] += $daymenu['NoFree'];
                                $catering[1][$daymenu['CatID']]['NoPaid'] += $daymenu['NoPaid'];
                                $catering[1][$daymenu['CatID']]['No'] += $daymenu['No'];
                            }
                        }
                    }
                }
            }
        if ($_SERVER['SERVER_ADDR'] == '10.10.100.234') {
            //Utils::pa($catering[0]);
        }
        // Obtain the name of the free menu category
        $query = "SELECT * FROM catering WHERE CatID='" . Config::CATERING_FREE_CATEG . "'";
        $conn->query($query);
        $row = $conn->fetch_array();
        $free_menu = $row['Category'];
        $free_menu_price = $row['Price'];


        // Add autogenerated menu
        //$cats_array=array(Config::CATERING_FREE_CATEG,4,5,13,14); // list of Base Menu categories
        $cats_array = array(Config::CATERING_FREE_CATEG, 17, 18, 19, 20); // list of Base Menu categories
        foreach ($cats_array as $catID) {
            foreach ($dates AS $date) {

                $query = "SELECT a.FullName, a.PersonID, e.EmpCode, '$date' AS Date, 1 AS NoFree, $catID AS CatID
					          FROM   persons a
					          INNER JOIN payroll e ON a.PersonID = e.PersonID
							  INNER JOIN persons_beneficii cat ON a.PersonID = cat.PersonID AND cat.Type = 9 
					          WHERE cat.RegDate <= '$date' AND (cat.EndDate = '0000-00-00' OR cat.EndDate >= '$date') AND 
					          	a.PersonID NOT IN (SELECT PersonID FROM persons_catering WHERE Date='$date' AND CatID='$catID')
					          AND a.Status IN (2,7,9,12) AND e.ContractType != 3 
				  	  UNION
					  	  	SELECT a.FullName, a.PersonID, e.EmpCode, '$date' AS Date, 1 AS NoFree, $catID AS CatID
					          FROM   persons a
							  INNER JOIN persons_beneficii cat ON a.PersonID = cat.PersonID AND cat.Type = 9 
					          INNER JOIN payroll e ON a.PersonID = e.PersonID
					          WHERE cat.RegDate <= '$date' AND (cat.EndDate = '0000-00-00' OR cat.EndDate >= '$date') AND
					          	((SELECT COUNT(*) FROM persons_catering WHERE Date='$date' AND CatID='$catID' AND No=0 AND a.PersonID=PersonID)>0)
					          AND a.Status IN (2,7,9,12) AND e.ContractType != 3 
				  	  ";
                $conn->query($query);
                if ($_SERVER['SERVER_ADDR'] == '10.10.100.234') {
                    /*print_r($query);
					echo "<br/><br/><br/>";/**/
                }
                while ($row = $conn->fetch_array()) {
                    $nonsel[$catID][$row['PersonID'] . '_' . $date] = $row;
                }
                //echo "<pre>";
                //print_r($nonsel);
                //echo "</pre>";
            }
        }

        $nonsel_result = array_intersect_key($nonsel[Config::CATERING_FREE_CATEG], $nonsel[17], $nonsel[18], $nonsel[19], $nonsel[20]); // list of Base Menu categories-persons that did not select

        //Utils::pa($nonsel);
        foreach ($nonsel_result as $nonsel_person) {
            // Do not add to list if a vacation day
            if (!empty($vperiods_merged[$nonsel_person['PersonID']]) && in_array($nonsel_person['Date'], $vperiods_merged[$nonsel_person['PersonID']]))
                continue;
            // Do not add to list if a displacement day
            if (!empty($dperiods_merged[$nonsel_person['PersonID']]) && in_array($nonsel_person['Date'], $dperiods_merged[$nonsel_person['PersonID']]))
                continue;
            $catering[2][$nonsel_person['FullName']][Config::CATERING_FREE_CATEG][$nonsel_person['Date']]['FullName'] = $nonsel_person['FullName'];
            $catering[2][$nonsel_person['FullName']][Config::CATERING_FREE_CATEG][$nonsel_person['Date']]['EmpCode'] = $nonsel_person['EmpCode'];
            $catering[2][$nonsel_person['FullName']][Config::CATERING_FREE_CATEG][$nonsel_person['Date']]['Date'] = $nonsel_person['Date'];
            $catering[2][$nonsel_person['FullName']][Config::CATERING_FREE_CATEG][$nonsel_person['Date']]['NoFree'] = 1;
            $catering[2][$nonsel_person['FullName']][Config::CATERING_FREE_CATEG][$nonsel_person['Date']]['NoPaid'] = 0;
            $catering[2][$nonsel_person['FullName']][Config::CATERING_FREE_CATEG][$nonsel_person['Date']]['No'] = 1;
            $catering[2][$nonsel_person['FullName']][Config::CATERING_FREE_CATEG][$nonsel_person['Date']]['CatID'] = Config::CATERING_FREE_CATEG;
            $catering[2][$nonsel_person['FullName']][Config::CATERING_FREE_CATEG][$nonsel_person['Date']]['Category'] = $free_menu;
            $catering[2][$nonsel_person['FullName']][Config::CATERING_FREE_CATEG][$nonsel_person['Date']]['Price'] = $free_menu_price;
        }
        //Utils::pa($result);
        ksort($catering[2]);
        // Group by category
        if (is_array($catering[2]))
            foreach ($catering[2] as $v) {
                foreach ($v as $vv) {
                    foreach ($vv as $daymenu) {
                        if (is_array($daymenu) && $daymenu['CatID'] == Config::CATERING_FREE_CATEG) {
                            $catering[1][$daymenu['CatID']]['Category'] = $daymenu['Category'];
                            $catering[1][$daymenu['CatID']]['Price'] = $free_menu_price;
                            $catering[1][$daymenu['CatID']]['NoFree'] += $daymenu['NoFree'];
                            $catering[1][$daymenu['CatID']]['NoPaid'] += $daymenu['NoPaid'];
                            $catering[1][$daymenu['CatID']]['No'] += $daymenu['No'];
                        }
                    }
                }
            }

        return $catering;
    }

    public static function getReports_62()
    {

        global $conn;

        $res = array();
        $cond = "";

        if (empty($_GET['StartDate']) || empty($_GET['EndDate'])) {
            return $res;
        }

        if (!empty($_GET['CompanyID'])) {
            $cond .= " AND a.PersonID IN (
					    SELECT PersonID
					    FROM   payroll
					    WHERE  CompanyID = " . (int)$_GET['CompanyID'] . "
					)";
        }

        if (!empty($_GET['DepartmentID'])) {
            $cond .= " AND a.PersonID IN (
					    SELECT PersonID
					    FROM   payroll
					    WHERE  DepartmentID = " . (int)$_GET['DepartmentID'] . "
					)";
        }
        if (!empty($_GET['SubDepartmentID'])) {
            $cond .= " AND c.SubDepartmentID = " . (int)$_GET['SubDepartmentID'];

        }

        if (!empty($_GET['DivisionID'])) {
            $cond .= " AND a.PersonID IN (
					    SELECT PersonID
					    FROM   payroll
					    WHERE  DivisionID = " . (int)$_GET['DivisionID'] . "
					)";
        }

        if ($_GET['Aprove'] != '')
            $cond .= " AND a.Aprove = {$_GET['Aprove']}";

        $StartDate = Utils::toDBDate($_GET['StartDate']);
        $EndDate = Utils::toDBDate($_GET['EndDate']);


        $query = "SELECT *, b.FullName, a.RegDate AS MedicalStartDate, a.EndDate AS MedicalStopDate, a.Notes AS MedicalNotes, DATEDIFF(EndDate,now()) AS ExpireDays
		      FROM   persons_medical a
		             INNER JOIN persons b ON a.PersonID = b.PersonID
		             INNER JOIN payroll c ON a.PersonID = c.PersonID
	              	 LEFT  JOIN departments d ON c.DepartmentID = d.DepartmentID
                     LEFT  JOIN subdepartments e ON c.SubDepartmentID = e.SubDepartmentID
                     LEFT  JOIN companies f ON c.CompanyID = f.CompanyID
                     LEFT  JOIN divisions g ON c.DivisionID = g.DivisionID
		      WHERE  (a.EndDate BETWEEN '{$StartDate}' AND '{$EndDate}') 
		      		 AND a.Type=2 AND b.Status IN (2, 9, 7, 12)
		              $cond
		      ORDER  BY b.FullName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $res[] = $row;
        }
//Utils::pa($res);
        return $res;
    }

    public static function getReports_157()
    {

        global $conn;

        $persons = array();
        $cond = '';

        if ($_GET['ShowLeft'] == 0)
            $cond = " AND (b.StopDate='00-00-0000' OR b.StopDate IS NULL)";

        if (!empty($_GET['Status'])) {
            $cond .= " AND a.Status = " . (int)$_GET['Status'];
        }

        if (!empty($_GET['ContractType'])) {
            $cond .= " AND b.ContractType = " . (int)$_GET['ContractType'];
        }

        if (!empty($_GET['CompanyID'])) {
            $cond .= " AND a.PersonID IN (
					    SELECT PersonID
					    FROM   payroll
					    WHERE  CompanyID = " . (int)$_GET['CompanyID'] . "
					)";
        }

        if (!empty($_GET['DepartmentID'])) {
            $cond .= " AND a.PersonID IN (
					    SELECT PersonID
					    FROM   payroll
					    WHERE  DepartmentID = " . (int)$_GET['DepartmentID'] . "
					)";
        }
        if (!empty($_GET['SubDepartmentID'])) {
            $cond .= " AND b.SubDepartmentID = " . (int)$_GET['SubDepartmentID'];

        }

        if (!empty($_GET['DivisionID'])) {
            $cond .= " AND a.PersonID IN (
					    SELECT PersonID
					    FROM   payroll
					    WHERE  DivisionID = " . (int)$_GET['DivisionID'] . "
					)";
        }

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.FullName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';


        $query = "SELECT *, 
			g.Function, 
			g.COR,
			DATE_FORMAT(b.StartDate, '%d.%m.%Y') AS DataStart, 
			DATE_FORMAT(b.StopDate, '%d.%m.%Y') AS DataStop, 
			DATE_FORMAT(b.ContractDate, '%d.%m.%Y') AS ContractDate, 
			floor(DATEDIFF(NOW(),a.DateOfBirth)/365) AS Age,			
			a.Status AS PersonStatus,
			(SELECT Salary FROM persons_salary h WHERE h.PersonID=a.PersonID ORDER BY SalaryID DESC LIMIT 1) AS Salary,
			b.LeaveReason as LeaveReasonNo,
			0 as Seniority,
 b.StartDate AS fStartDate, b.StopDate AS fStopDate

	              FROM persons a
	              INNER JOIN payroll b ON a.PersonID = b.PersonID
	              LEFT  JOIN departments c ON b.DepartmentID = c.DepartmentID
                  LEFT  JOIN subdepartments d ON b.SubDepartmentID = d.SubDepartmentID
                  LEFT  JOIN companies e ON b.CompanyID = e.CompanyID
                  LEFT  JOIN divisions f ON b.DivisionID = f.DivisionID
                  LEFT JOIN functions g ON b.FunctionID = g.FunctionID
                  LEFT JOIN address l ON a.AddressID=l.AddressID
                  LEFT JOIN address_city m ON l.CityID=m.CityID
                  LEFT JOIN address_district n ON m.DistrictID=n.DistrictID

				  LEFT JOIN persons_contracts pc on a.PersonID = pc.PersonID

	              WHERE  1=1 $cond

	              GROUP BY a.PersonID

	              ORDER  BY $order_by $asc_or_desc";
        $conn->query($query);
        while ($info = $conn->fetch_array()) {
            $PersonAddress = '';
            if ($info['StreetName']) $PersonAddress .= 'Strada: ' . $info['StreetName'];
            if ($info['StreetCode']) $PersonAddress .= ', Cod postal: ' . $info['StreetCode'];
            if ($info['StreetNumber']) $PersonAddress .= ', Numar: ' . $info['StreetNumber'];
            if ($info['Bl']) $PersonAddress .= ', Bl: ' . $info['Bl'];
            if ($info['Sc']) $PersonAddress .= ', Sc: ' . $info['Sc'];
            if ($info['Et']) $PersonAddress .= ', Et: ' . $info['Et'];
            if ($info['Ap']) $PersonAddress .= ', Ap: ' . $info['Ap'];
            if ($info['CityName']) $PersonAddress .= ', ' . $info['CityName'];
            if ($info['DistrictName']) $PersonAddress .= ', ' . $info['DistrictName'];
            $PersonAddress = trim($PersonAddress, ',');
            $info['PersonAddress'] = $PersonAddress;
            $care = Person::$msSubStatus[6];
            if ($info['LeaveReasonNo'])
                $info['LeaveReasonNo'] = $care[$info['LeaveReasonNo']] . ", " . $info['Law'];
            else $info['LeaveReasonNo'] = "";
//			$info['LeaveReason']=$leavereason[$info['LeaveReasonNo']];
            $arr = Utils::dateDiff2YMD($info['fStartDate'], $info['fStopDate']);
            $info['Seniority'] = $arr[0] . "/" . $arr[1] . "/" . $arr[2];;
            $persons[] = $info;
        }
//Utils::pa($persons);
        return $persons;
    }

    public static function getReports_158()
    {

        global $conn;

        $persons = array();
        $cond = '';

        if ($_GET['ShowLeft'] == 0)
            $cond = " AND (b.StopDate='00-00-0000' OR b.StopDate IS NULL)";
        if (!empty($_GET['Status'])) {
            $cond .= " AND a.Status = " . (int)$_GET['Status'];
        }

        if (!empty($_GET['ContractType'])) {
            $cond .= " AND b.ContractType = " . (int)$_GET['ContractType'];
        }

        if (!empty($_GET['CompanyID'])) {
            $cond .= " AND a.PersonID IN (
					    SELECT PersonID
					    FROM   payroll
					    WHERE  CompanyID = " . (int)$_GET['CompanyID'] . "
					)";
        }

        if (!empty($_GET['DepartmentID'])) {
            $cond .= " AND a.PersonID IN (
					    SELECT PersonID
					    FROM   payroll
					    WHERE  DepartmentID = " . (int)$_GET['DepartmentID'] . "
					)";
        }
        if (!empty($_GET['SubDepartmentID'])) {
            $cond .= " AND b.SubDepartmentID = " . (int)$_GET['SubDepartmentID'];

        }

        if (!empty($_GET['DivisionID'])) {
            $cond .= " AND a.PersonID IN (
					    SELECT PersonID
					    FROM   payroll
					    WHERE  DivisionID = " . (int)$_GET['DivisionID'] . "
					)";
        }

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.FullName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';


        $query = "SELECT *, 
			g.Function, 
			g.COR,
			DATE_FORMAT(b.StartDate, '%d.%m.%Y') AS DataStart, 
			DATE_FORMAT(b.StopDate, '%d.%m.%Y') AS DataStop, 
			DATE_FORMAT(b.ContractDate, '%d.%m.%Y') AS ContractDate, 
			a.Status AS PersonStatus,
			floor(DATEDIFF(NOW(),a.DateOfBirth)/365) AS Age,
			(SELECT Salary FROM persons_salary h WHERE h.PersonID=a.PersonID ORDER BY SalaryID DESC LIMIT 1) AS Salary,
			0 as Seniority,
			b.StartDate AS fStartDate, b.StopDate AS fStopDate,
			concat(a.BISerie,' ',a.BINumber) as BI,
			pc.ContractNo as CIMNo,
			pc.ContractDate as CIMDate,
                        pm1.RegDate as asigStartDate,
                        pm1.EndDate as asigEndDate,
						pm2.RegDate as analStartDate,
                        pm2.EndDate as analEndDate,
						pm3.RegDate as protStartDate,
                        pm3.EndDate as protEndDate,
				DATE_FORMAT(a.BIStartDate, '%d.%m.%Y') AS BIDataStart, 
				DATE_FORMAT(a.BIStopDate, '%d.%m.%Y') AS BIDataStop 			
	              FROM persons a
	              INNER JOIN payroll b ON a.PersonID = b.PersonID
	              LEFT  JOIN departments c ON b.DepartmentID = c.DepartmentID
                  LEFT  JOIN subdepartments d ON b.SubDepartmentID = d.SubDepartmentID
                  LEFT  JOIN companies e ON b.CompanyID = e.CompanyID
                  LEFT  JOIN divisions f ON b.DivisionID = f.DivisionID
                  LEFT JOIN functions g ON b.FunctionID = g.FunctionID
                  LEFT JOIN address l ON a.AddressID=l.AddressID
                  LEFT JOIN address_city m ON l.CityID=m.CityID
                  LEFT JOIN address_district n ON m.DistrictID=n.DistrictID
				  LEFT join persons_medical pm1 on a.PersonID = pm1.PersonID and pm1.Type=1
				  LEFT join persons_medical pm2 on a.PersonID = pm2.PersonID and pm2.Type=2
				  LEFT join persons_medical pm3 on a.PersonID = pm3.PersonID and pm3.Type=3

				  LEFT JOIN persons_contracts pc on a.PersonID = pc.PersonID

	              WHERE  1=1 $cond

	              GROUP BY a.PersonID

	              ORDER  BY $order_by $asc_or_desc";
        $conn->query($query);
        while ($info = $conn->fetch_array()) {
            $PersonAddress = '';
            if ($info['StreetName']) $PersonAddress .= 'Strada: ' . $info['StreetName'];
            if ($info['StreetCode']) $PersonAddress .= ', Cod postal: ' . $info['StreetCode'];
            if ($info['StreetNumber']) $PersonAddress .= ', Numar: ' . $info['StreetNumber'];
            if ($info['Bl']) $PersonAddress .= ', Bl: ' . $info['Bl'];
            if ($info['Sc']) $PersonAddress .= ', Sc: ' . $info['Sc'];
            if ($info['Et']) $PersonAddress .= ', Et: ' . $info['Et'];
            if ($info['Ap']) $PersonAddress .= ', Ap: ' . $info['Ap'];
            if ($info['CityName']) $PersonAddress .= ', ' . $info['CityName'];
            if ($info['DistrictName']) $PersonAddress .= ', ' . $info['DistrictName'];
            $PersonAddress = trim($PersonAddress, ',');
            $info['PersonAddress'] = $PersonAddress;
            $care = Person::$msSubStatus[6];
            if ($info['LeaveReasonNo'])
                $info['LeaveReasonNo'] = $care[$info['LeaveReasonNo']] . ", " . $info['Law'];
            else $info['LeaveReasonNo'] = "";
//			$info['LeaveReason']=$leavereason[$info['LeaveReasonNo']];
            $arr = Utils::dateDiff2YMD($info['fStartDate'], $info['fStopDate']);
            $info['Seniority'] = $arr[0] . "/" . $arr[1] . "/" . $arr[2];;
            $persons[] = $info;
        }
//Utils::pa($persons);
        return $persons;
    }

    public static function getReports_83()
    {

        global $conn;

        $persons = array();
        $cond = '';

        if ($_GET['ShowLeft'] == 0)
            $cond = " AND (b.StopDate='00-00-0000' OR b.StopDate IS NULL)";

        if (!empty($_GET['Status'])) {
            $cond .= " AND a.Status = " . (int)$_GET['Status'];
        }

        if (!empty($_GET['ContractType'])) {
            $cond .= " AND b.ContractType = " . (int)$_GET['ContractType'];
        }

        if (!empty($_GET['CompanyID'])) {
            $cond .= " AND a.PersonID IN (
					    SELECT PersonID
					    FROM   payroll
					    WHERE  CompanyID = " . (int)$_GET['CompanyID'] . "
					)";
        }

        if (!empty($_GET['DepartmentID'])) {
            $cond .= " AND a.PersonID IN (
					    SELECT PersonID
					    FROM   payroll
					    WHERE  DepartmentID = " . (int)$_GET['DepartmentID'] . "
					)";
        }
        if (!empty($_GET['SubDepartmentID'])) {
            $cond .= " AND b.SubDepartmentID = " . (int)$_GET['SubDepartmentID'];

        }

        if (!empty($_GET['DivisionID'])) {
            $cond .= " AND a.PersonID IN (
					    SELECT PersonID
					    FROM   payroll
					    WHERE  DivisionID = " . (int)$_GET['DivisionID'] . "
					)";
        }

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.FullName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';


        $query = "SELECT *, g.Function, g.COR,
                      IF(b.StartDate > '0000-00-00', DATE_FORMAT(b.StartDate, '%d.%m.%Y'), '') AS DataStart,      
                      IF(b.StopDate > '0000-00-00', DATE_FORMAT(b.StopDate, '%d.%m.%Y'), '') AS DataStop, 
                      IF(b.ContractDate > '0000-00-00', DATE_FORMAT(b.ContractDate, '%d.%m.%Y'), '') AS ContractDate, 
                      a.Status AS PersonStatus,
	    	      (SELECT Salary FROM persons_salary h WHERE h.PersonID=a.PersonID ORDER BY SalaryID DESC LIMIT 1) AS Salary
	              FROM persons a
	              INNER JOIN payroll b ON a.PersonID = b.PersonID
	              LEFT  JOIN departments c ON b.DepartmentID = c.DepartmentID
                  LEFT  JOIN subdepartments d ON b.SubDepartmentID = d.SubDepartmentID
                  LEFT  JOIN companies e ON b.CompanyID = e.CompanyID
                  LEFT  JOIN divisions f ON b.DivisionID = f.DivisionID
                  LEFT JOIN functions g ON b.FunctionID = g.FunctionID
                  LEFT JOIN address l ON a.AddressID=l.AddressID
                  LEFT JOIN address_city m ON l.CityID=m.CityID
                  LEFT JOIN address_district n ON m.DistrictID=n.DistrictID
	              WHERE  1=1 $cond
	              GROUP BY a.PersonID
	              ORDER  BY $order_by $asc_or_desc";
        $conn->query($query);
        while ($info = $conn->fetch_array()) {
            $PersonAddress = '';
            if ($info['StreetName']) $PersonAddress .= 'Strada: ' . $info['StreetName'];
            if ($info['StreetCode']) $PersonAddress .= ', Cod postal: ' . $info['StreetCode'];
            if ($info['StreetNumber']) $PersonAddress .= ', Numar: ' . $info['StreetNumber'];
            if ($info['Bl']) $PersonAddress .= ', Bl: ' . $info['Bl'];
            if ($info['Sc']) $PersonAddress .= ', Sc: ' . $info['Sc'];
            if ($info['Et']) $PersonAddress .= ', Et: ' . $info['Et'];
            if ($info['Ap']) $PersonAddress .= ', Ap: ' . $info['Ap'];
            if ($info['CityName']) $PersonAddress .= ', ' . $info['CityName'];
            if ($info['DistrictName']) $PersonAddress .= ', ' . $info['DistrictName'];
            $PersonAddress = trim($PersonAddress, ',');
            $info['PersonAddress'] = $PersonAddress;
            $persons[] = $info;
        }
//Utils::pa($persons);
        return $persons;
    }


    public static function getReports_86()
    {

        global $conn;

        $persons = array();

        if (empty($_GET['Year'])) {
            return $persons;
        }

        if (!empty($_GET['Status'])) {
            $cond .= "AND a.Status = '{$_GET['Status']}'";
        }
        if (!empty($_GET['CompanyID'])) {
            $cond .= "AND b.CompanyID = '{$_GET['CompanyID']}'";
        }
        if (!empty($_GET['DivisionID'])) {
            $cond .= "AND b.DivisionID = '{$_GET['DivisionID']}'";
        }
        if (!empty($_GET['DepartmentID'])) {
            $cond .= "AND b.DepartmentID = '{$_GET['DepartmentID']}'";
        }
        if (!empty($_GET['SubdepartmentID'])) {
            $cond .= "AND b.SubdepartmentID = '{$_GET['SubdepartmentID']}'";
        }

        $Year = (int)$_GET['Year'];
        $StartDate = $Year . '-01-01';
        $EndDate = $Year . '-12-31';


        $arr_months = Utils::getMonthArray($StartDate, $EndDate);

        $calh = array(0 => 'D', 1 => 'L', 2 => 'M', 3 => 'M', 4 => 'J', 5 => 'V', 6 => 'S');

        global $cal;

        $st_y = (int)substr($Year . '-01-01', 0, 4);
        $st_m = (int)substr($Year . '-01-01', 5, 2);
        $st_d = (int)substr($Year . '-01-01', 8, 2);
        $i = 0;
        $j = 0;
        while (true) {
            $time = mktime(0, 0, 0, $st_m, $st_d + $i, $st_y);
            $date = date('Y-m-d', $time);
            if ($date <= $EndDate) {
                $cal[$date] = $calh[date('w', $time)];
                if ($cal[$date] != 'S' && $cal[$date] != 'D') {
                    $j++;
                }
                $i++;
            } else {
                break;
            }
        }

        // Obtain all vacations from current year
        $query = "SELECT a.FullName, v.PersonID, v.StartDate, v.StopDate, v.Type, v.Aprove
		      FROM   vacations_details v
		             INNER JOIN persons a ON v.PersonID = a.PersonID
		             LEFT JOIN payroll b ON b.PersonID = a.PersonID
		             LEFT JOIN companies d ON b.CompanyID = d.CompanyID
              		 LEFT JOIN divisions e ON b.DivisionID = e.DivisionID
              	     LEFT JOIN departments f ON b.DepartmentID = f.DepartmentID
		      WHERE  ((v.StartDate BETWEEN CONCAT(YEAR('{$StartDate}'),'-01-01') AND CONCAT(YEAR('{$EndDate}'),'-12-31'))) OR
		             (v.StopDate BETWEEN CONCAT(YEAR('{$StartDate}'),'-01-01') AND CONCAT(YEAR('{$EndDate}'),'-12-31')) OR
		             (CONCAT(YEAR('{$StartDate}'),'-01-01')   BETWEEN v.StartDate AND v.StopDate)
		             $cond
		      ORDER  BY v.StartDate";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $arr[$row['PersonID']][$row['StartDate']] = $row;
        }

        //Prepare the table
        $conn->query("DELETE FROM vacations_days_tmp");

        // Insert VacationDays for current year
        foreach ($arr as $k => $v) {
            foreach ($v as $sd => $vac) {
                $vacations[$k]['FullName'] = $vac['FullName'];
                $vacations[$k]['StartDate'] = $vac['StartDate'];
                $vacations[$k]['StopDate'] = $vac['StopDate'];
                foreach ($cal as $date => $w) {
                    //Skip Weekends and Legal free days
                    if ($sd <= $date && $date <= $vac['StopDate'] && $w != 'S' && $w != 'D' && !in_array($date, array_keys(ConfigData::$msLegal))) {
                        //$vacations[$k]['COdays'][$date] = array($vac['Type'],$vac['Aprove']);
                        $conn->query("INSERT INTO vacations_days_tmp(UserID, PersonID, Day, Type, Aprove, CreateDate)
		                  VALUES({$_SESSION['USER_ID']}, $k, '$date', '{$vac['Type']}','{$vac['Aprove']}', CURRENT_TIMESTAMP)");
                    }
                }
            }
        }

        // Obtain the vacations in the specified interval
        $query = "SELECT a.PersonID, DATE_FORMAT(a.Day, '%Y-%m') AS Month, COUNT(Day) AS TCO FROM vacations_days_tmp a 
					LEFT JOIN persons b ON a.PersonID=b.PersonID
					WHERE Aprove>0 AND Type='CO' AND (Day BETWEEN '{$StartDate}' AND '{$EndDate}')
					GROUP BY a.PersonID, DATE_FORMAT(a.Day, '%Y-%m') ORDER BY b.FullName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $tco_arr[$row['PersonID']][$row['Month']]['TCO'] = $row['TCO'];
        }

        // Obtain the month of ReportDateLimit and Add the lost days
        $query = "SELECT a.PersonID, a.ReportDateLimit, DATE_FORMAT(ReportDateLimit, '%Y-%m') AS ReportMonthLimit, (CONVERT(a.TotalCO, SIGNED) -  CONVERT(a.TotalCORef, SIGNED)) AS ExtraCO,
					(SELECT COUNT(*) FROM vacations_days_tmp x WHERE x.PersonID = a.PersonID AND Type = 'CO' AND Aprove >= 0 AND x.Day <= a.ReportDateLimit) AS ConsumedCO
					FROM vacations a 
					WHERE a.Year='$Year'";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            if ($row['ExtraCO'] >= $row['ConsumedCO'])
                $row['LostCO'] = $row['ExtraCO'] - $row['ConsumedCO'];
            else
                $row['LostCO'] = 0;
            $extra_co_arr[$row['PersonID']][$row['ReportMonthLimit']] = $row;
        }
        //Utils::pa($extra_co_arr);

        // Populate even the months with have 0 TCO
        foreach ($tco_arr as $personID => $co_month) {
            foreach ($arr_months as $month => $m) {
                if ($tco_arr[$personID][$month]['TCO'] > 0)
                    $tco[$personID][$month]['TCO'] = $tco_arr[$personID][$month]['TCO'] + $extra_co_arr[$personID][$month]['LostCO'];
                else
                    $tco[$personID][$month]['TCO'] = 0 + $extra_co_arr[$personID][$month]['LostCO'];
                //
            }
        }
        //Utils::pa($tco_arr);
        // Get the sum of all CO days
        $query = "SELECT a.PersonID, a.FullName, Department,
	    			(SELECT CAST((TotalCO - Invoire) AS SIGNED) FROM vacations c WHERE a.PersonID=c.PersonID AND Year=YEAR('{$StartDate}')-1) AS PrevCO,
       				(SELECT SUM(DaysNo) FROM vacations_details d WHERE a.PersonID=d.PersonID AND Type='CO' AND Year=YEAR('{$StartDate}')-1) AS PrevInsertedCO,
	    			(SELECT (TotalCO - Invoire) FROM vacations e WHERE a.PersonID=e.PersonID AND Year=YEAR('{$StartDate}')) AS CurrTotalCO,
                    (SELECT TotalCORef FROM vacations f WHERE a.PersonID=f.PersonID AND Year=YEAR('{$StartDate}')) AS CurrTotalCORef,
       				YEAR('{$StartDate}')-1 AS PrevYear, YEAR('{$StartDate}') AS CurrYear
	    			 FROM persons a 
	    			 LEFT JOIN payroll b ON a.PersonID=b.PersonID
	    			 LEFT JOIN companies d ON b.CompanyID = d.CompanyID
              		 LEFT JOIN divisions e ON b.DivisionID = e.DivisionID
              		 LEFT JOIN departments f ON b.DepartmentID = f.DepartmentID
	    			 WHERE 1=1 $cond ORDER BY a.FullName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $persons['PrevYear'] = $row['PrevYear'];
            $persons['CurrYear'] = $row['CurrYear'];
            $persons[$row['PersonID']]['PersonID'] = $row['PersonID'];
            $persons[$row['PersonID']]['FullName'] = $row['FullName'];
            $persons[$row['PersonID']]['Department'] = $row['Department'];
            $persons[$row['PersonID']]['PrevCO'] = $row['PrevCO'];
            $persons[$row['PersonID']]['PrevInsertedCO'] = $row['PrevInsertedCO'];
            $persons[$row['PersonID']]['PrevTotalCO'] = $row['PrevCO'] - $row['PrevInsertedCO'];
            $persons[$row['PersonID']]['CurrTotalCO'] = $row['CurrTotalCO'];
            $persons[$row['PersonID']]['CurrTotalCORef'] = $row['CurrTotalCORef'];
            //$persons[$row['PersonID']]['Vacations'] = $tco[$row['PersonID']];
        }
        //Utils::pa($persons);
        //Populate the array of persons with all consumed/remaining CO

        $rem_co = array("PrevYear" => $persons['PrevYear'], "CurrYear" => $persons['CurrYear']);
        unset($persons['PrevYear']);
        unset($persons['CurrYear']);
        foreach ($persons as $PersonID => $person) {
            $curr_CO = $person['CurrTotalCO'];
            $rem_co[$PersonID]['FullName'] = $person['FullName'];
            $rem_co[$PersonID]['Department'] = $person['Department'];
            $rem_co[$PersonID]['PrevTotalCO'] = $person['PrevTotalCO'];
            $rem_co[$PersonID]['CurrTotalCO'] = $person['CurrTotalCO'];
            $rem_co[$PersonID]['CurrTotalCORef'] = $person['CurrTotalCORef'];
            if (is_array($tco[$PersonID])) {
                foreach ($tco[$PersonID] as $month => $cons_days) {
                    $rem_co[$PersonID][$month]['TCO'] = $cons_days['TCO'];
                    $rem_co[$PersonID][$month]['RemCO'] = $curr_CO - $cons_days['TCO'];
                    $curr_CO = $curr_CO - $cons_days['TCO'];
                }
            } else
                foreach ($arr_months as $month => $m) {
                    $rem_co[$PersonID][$month]['TCO'] = $curr_CO;
                    $rem_co[$PersonID][$month]['RemCO'] = $curr_CO;
                }
        }


        return $rem_co;
    }

    public static function getReports_87()
    {

        global $conn;

        $persons = array();

        if (empty($_GET['StartDate']) || empty($_GET['EndDate'])) {
            return $persons;
        }

        $StartDate = Utils::toDBDate($_GET['StartDate']);
        $EndDate = Utils::toDBDate($_GET['EndDate']);

        if (!empty($_GET['Status'])) {
            $cond .= "AND b.Status = '{$_GET['Status']}'";
        }
        if (!empty($_GET['ContractType'])) {
            $cond .= "AND c.ContractType = '{$_GET['ContractType']}'";
        }
        if (!empty($_GET['CompanyID'])) {
            $cond .= "AND c.CompanyID = '{$_GET['CompanyID']}'";
        }
        if (!empty($_GET['DivisionID'])) {
            $cond .= "AND c.DivisionID = '{$_GET['DivisionID']}'";
        }
        if (!empty($_GET['DepartmentID'])) {
            $cond .= "AND c.DepartmentID = '{$_GET['DepartmentID']}'";
        }
        if (!empty($_GET['SubdepartmentID'])) {
            $cond .= "AND c.SubdepartmentID = '{$_GET['SubdepartmentID']}'";
        }

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'b.FullName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';


        $query = "SELECT b.PersonID,b.FullName, b.Status, c.StartDate, c.StopDate, DATE_FORMAT(c.StopDate, '%d.%m.%Y') AS DataEnd, DATE_FORMAT(c.StartDate, '%d.%m.%Y') AS DataStart, c.ContractType, d.CompanyName, e.Division, f.Department, g.Subdepartment
	              FROM   persons b
	                    INNER JOIN payroll c ON b.PersonID = c.PersonID
	              		LEFT JOIN companies d ON c.CompanyID = d.CompanyID
	              		LEFT JOIN divisions e ON c.DivisionID = e.DivisionID
	              		LEFT JOIN departments f ON c.DepartmentID = f.DepartmentID
	              		LEFT JOIN subdepartments g ON c.SubdepartmentID = g.SubdepartmentID
	              WHERE  (b.UserID = {$_SESSION['USER_ID']} OR {$_SESSION['USER_ID']} = 1) $cond
	              GROUP BY b.PersonID
	              ORDER  BY $order_by $asc_or_desc";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $arr = Utils::dateDiff2YMD($row['StartDate'], $row['StopDate']);
            $row['CompanyAge'] = $arr[0] . "/" . $arr[1] . "/" . $arr[2];
            $persons[$row['PersonID']] = $row;
        }

        $query = "SELECT *
	                    	FROM   persons_salary
	                    	WHERE  ((StartDate BETWEEN '{$StartDate}' AND '{$EndDate}') OR
		                        (StopDate BETWEEN '{$StartDate}' AND '{$EndDate}') OR
		                        ('{$StartDate}' BETWEEN StartDate AND StopDate))
		                        ORDER BY SalaryID";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $salaries[$row['PersonID']][] = $row;
        }

        foreach ($persons as $personID => $personData) {
            if (!empty($salaries[$personID]))
                $persons[$personID]['Salaries'] = $salaries[$personID];
        }
        return $persons;
    }

    public static function getReports_88()
    {

        global $conn;

        $persons = array();

        if (empty($_GET['StartDate']) || empty($_GET['EndDate'])) {
            return $persons;
        }

        $StartDate = date('Y-m-d', strtotime($conn->real_escape_string($_GET['StartDate'])));
        $EndDate = date('Y-m-d', strtotime($conn->real_escape_string($_GET['EndDate'])));

        if (!empty($_GET['Status'])) {
            $cond .= "AND b.Status = '{$_GET['Status']}'";
        }
        if (!empty($_GET['ContractType'])) {
            $cond .= "AND c.ContractType = '{$_GET['ContractType']}'";
        }
        if (!empty($_GET['CompanyID'])) {
            $cond .= "AND c.CompanyID = '{$_GET['CompanyID']}'";
        }
        if (!empty($_GET['DivisionID'])) {
            $cond .= "AND c.DivisionID = '{$_GET['DivisionID']}'";
        }
        if (!empty($_GET['DepartmentID'])) {
            $cond .= "AND c.DepartmentID = '{$_GET['DepartmentID']}'";
        }
        if (!empty($_GET['SubdepartmentID'])) {
            $cond .= "AND c.SubdepartmentID = '{$_GET['SubdepartmentID']}'";
        }

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'b.FullName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';


        $benefits = array();
        $query = "SELECT PersonID, RegDate, EndDate FROM persons_beneficii WHERE Type = 4 AND RegDate <= '{$EndDate}' AND (EndDate >= '{$StartDate}' OR EndDate IS NULL OR EndDate = '0000-00-00')";

        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $benefits[$row['PersonID']] = $row;
        }

        $query = "SELECT b.PersonID, b.FullName, b.Status, DATE_FORMAT(c.StopDate, '%d.%m.%Y') AS DataEnd, DATE_FORMAT(c.StartDate, '%d.%m.%Y') AS DataStart, c.ContractType, d.CompanyName, e.Division, f.Department, g.Subdepartment 
	              FROM   persons b
	                    JOIN payroll c ON b.PersonID = c.PersonID
	              		LEFT JOIN companies d ON c.CompanyID = d.CompanyID
	              		LEFT JOIN divisions e ON c.DivisionID = e.DivisionID
	              		LEFT JOIN departments f ON c.DepartmentID = f.DepartmentID
	              		LEFT JOIN subdepartments g ON c.SubdepartmentID = g.SubdepartmentID
	              WHERE  (b.UserID = {$_SESSION['USER_ID']} OR {$_SESSION['USER_ID']} = 1)
                      AND (c.StartDate <= '{$EndDate}' AND (c.StopDate >= '{$StartDate}' OR c.StopDate IS NULL OR c.StopDate = '0000-00-00'))     
                      $cond
	              GROUP BY b.PersonID
	              ORDER  BY $order_by $asc_or_desc";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $Start = strtotime($row['DataStart']) > strtotime($StartDate) ? date('Y-m-d', strtotime($row['DataStart'])) : date('Y-m-d', strtotime($StartDate));
            $Stop = (!empty($row['DataEnd']) && strtotime($row['DataEnd']) > strtotime($row['DataStart']) && strtotime($row['DataEnd']) < strtotime($EndDate)) ? date('Y-m-d', strtotime($row['DataEnd'])) : date('Y-m-d', strtotime($EndDate));
            if (strtotime($Start) < strtotime($benefits[$row['PersonID']]['RegDate'])) {
                $Start = date('Y-m-d', strtotime($benefits[$row['PersonID']]['RegDate']));
            }
            if (!empty($benefits[$row['PersonID']]['EndDate']) && $benefits[$row['PersonID']]['EndDate'] != '0000-00-00' && strtotime($Stop) > strtotime($benefits[$row['PersonID']]['EndDate'])) {
                $Stop = date('Y-m-d', strtotime($benefits[$row['PersonID']]['EndDate']));
            }
            $row['Start'] = $Start;
            $row['Stop'] = $Stop;
            $row['wdays'] = isset($benefits[$row['PersonID']]) ? Utils::getDaysDiff($Start, $Stop) : 0;
            $persons[$row['PersonID']] = $row;
        }

        $vacations = array();
        $query = "SELECT a.PersonID, a.StartDate, a.StopDate FROM vacations_details a
                            WHERE a.Aprove = 1 AND ((a.StartDate >= '{$StartDate}' AND a.StartDate <='{$EndDate}')
                            OR (a.StopDate >= '{$StartDate}' AND a.StopDate <= '{$EndDate}'))";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $vacations[$row['PersonID']][] = $row;
        }
        $displacements = array();
        $query = "SELECT a.PersonID, a.StartDate, a.StopDate FROM persons_displacement a
                            WHERE (a.StartDate >= '{$StartDate}' AND a.StartDate <='{$EndDate}')
                            OR (a.StopDate >= '{$StartDate}' AND a.StopDate <= '{$EndDate}')";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $displacements[$row['PersonID']][] = $row;
        }


        foreach ($persons as $PersonID => $person) {
            $vac_days = 0;
            foreach ($vacations[$PersonID] as $vacation) {
                $DataIni = strtotime($person['Start']) >= strtotime($vacation['StartDate']) ? $person['Start'] : $vacation['StartDate'];
                $DataFin = strtotime($person['Stop']) >= strtotime($vacation['StopDate']) ? $vacation['StopDate'] : $person['Stop'];
                $vac_days += Utils::getDaysDiff($DataIni, $DataFin);
            }

            $persons[$PersonID]['vac_days'] = $vac_days;
            $disp_days = 0;
            foreach ($displacements[$PersonID] as $displacement) {
                $DataIni = strtotime($person['Start']) >= strtotime($displacement['StartDate']) ? $person['Start'] : $displacement['StartDate'];
                $DataFin = strtotime($person['Stop']) >= strtotime($displacement['StopDate']) ? $displacement['StopDate'] : $person['Stop'];
                $diff = Utils::getDateTimeDiff($DataIni, $DataFin);
                $disp_days += $diff['days'];
                if ($diff['h'] >= 12) {
                    $disp_days++;
                }
            }
            $persons[$PersonID]['disp_days'] = $disp_days;
            $abs_days = 0;
            $query = "SELECT PersonID, SUM(Hours_Abs + Hours_P + Hours_LP) AS Abs
	                  FROM   pontaj_simple
		          WHERE  Data BETWEEN '{$person['Start']}' AND '{$person['Stop']}'
                                    AND PersonID = '{$PersonID}'";
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                if (isset($persons[$row['PersonID']])) {
                    $abs_days += $row['Abs'];
                }
            }

            $persons[$PersonID]['abs_days'] = $abs_days;
            $persons[$PersonID]['Tickets'] = $person['wdays'] - $vac_days - $disp_days - $abs_days;
            if ($persons[$PersonID]['Tickets'] < 0) {
                $persons[$PersonID]['Tickets'] = 0;
            }
        }

        return $persons;
    }


    public static function getReports_89()
    {

        global $conn;

        $persons = array();
        $cond = '';

        if ($_GET['ShowLeft'] == 0)
            $cond = " AND (b.StopDate='00-00-0000' OR b.StopDate IS NULL)";

        if (!empty($_GET['Status'])) {
            $cond .= " AND a.Status = " . (int)$_GET['Status'];
        }

        if (!empty($_GET['ContractType'])) {
            $cond .= " AND b.ContractType = " . (int)$_GET['ContractType'];
        }

        if (!empty($_GET['CompanyID'])) {
            $cond .= " AND a.PersonID IN (
					    SELECT PersonID
					    FROM   payroll
					    WHERE  CompanyID = " . (int)$_GET['CompanyID'] . "
					)";
        }

        if (!empty($_GET['DepartmentID'])) {
            $cond .= " AND a.PersonID IN (
					    SELECT PersonID
					    FROM   payroll
					    WHERE  DepartmentID = " . (int)$_GET['DepartmentID'] . "
					)";
        }
        if (!empty($_GET['SubDepartmentID'])) {
            $cond .= " AND b.SubDepartmentID = " . (int)$_GET['SubDepartmentID'];

        }

        if (!empty($_GET['DivisionID'])) {
            $cond .= " AND a.PersonID IN (
					    SELECT PersonID
					    FROM   payroll
					    WHERE  DivisionID = " . (int)$_GET['DivisionID'] . "
					)";
        }

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.FullName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';


        $query = "SELECT *,a.Studies,a.JobDictionaryID,a.FullName, g.Function, g.COR,DATE_FORMAT(b.StartDate, '%d.%m.%Y') AS DataStart,DATE_FORMAT(b.StopDate, '%d.%m.%Y') AS DataStop, a.DateOfBirth, DATE_FORMAT(a.DateOfBirth, '%d.%m.%Y') AS BirthDate, a.Status AS PersonStatus,
	    			(SELECT Notes FROM persons_medical h WHERE h.PersonID=a.PersonID AND Type=3 ORDER BY MedicalID DESC LIMIT 1) AS Route,
	    			(SELECT RegDate FROM persons_medical h WHERE h.PersonID=a.PersonID AND Type=3 ORDER BY MedicalID DESC LIMIT 1) AS MedRegDate,
	    			(SELECT EndDate FROM persons_medical h WHERE h.PersonID=a.PersonID AND Type=3 ORDER BY MedicalID DESC LIMIT 1) AS MedEndDate,
	    			DATEDIFF((SELECT EndDate FROM persons_medical h WHERE h.PersonID=a.PersonID AND Type=3 ORDER BY MedicalID DESC LIMIT 1),now()) AS ExpireDays,
	    			o.DistrictName AS BirthDistrict,p.CityName AS BirthCity
	              FROM persons a
	              INNER JOIN payroll b ON a.PersonID = b.PersonID
	              LEFT  JOIN departments c ON b.DepartmentID = c.DepartmentID
                  LEFT  JOIN subdepartments d ON b.SubDepartmentID = d.SubDepartmentID
                  LEFT  JOIN companies e ON b.CompanyID = e.CompanyID
                  LEFT  JOIN divisions f ON b.DivisionID = f.DivisionID
                  LEFT JOIN functions g ON b.FunctionID = g.FunctionID
                  LEFT JOIN address l ON a.AddressID=l.AddressID
                  LEFT JOIN address_city m ON l.CityID=m.CityID
                  LEFT JOIN address_district n ON m.DistrictID=n.DistrictID
                  LEFT JOIN address_district o ON a.BirthDistrictID=o.DistrictID
                  LEFT JOIN address_city p ON a.BirthCityID=p.CityID
	              WHERE  1=1 $cond
	              GROUP BY a.PersonID
	              ORDER  BY $order_by $asc_or_desc";
        $conn->query($query);
        while ($info = $conn->fetch_array()) {
            $PersonAddress = '';
            if ($info['StreetName']) $PersonAddress .= 'Strada: ' . $info['StreetName'];
            if ($info['StreetCode']) $PersonAddress .= ', Cod postal: ' . $info['StreetCode'];
            if ($info['StreetNumber']) $PersonAddress .= ', Numar: ' . $info['StreetNumber'];
            if ($info['Bl']) $PersonAddress .= ', Bl: ' . $info['Bl'];
            if ($info['Sc']) $PersonAddress .= ', Sc: ' . $info['Sc'];
            if ($info['Et']) $PersonAddress .= ', Et: ' . $info['Et'];
            if ($info['Ap']) $PersonAddress .= ', Ap: ' . $info['Ap'];
            if ($info['CityName']) $PersonAddress .= ', ' . $info['CityName'];
            if ($info['DistrictName']) $PersonAddress .= ', ' . $info['DistrictName'];
            $PersonAddress = trim($PersonAddress, ',');
            $info['PersonAddress'] = $PersonAddress;
            $persons[] = $info;
        }
//Utils::pa($persons);
        return $persons;
    }

    public static function getReports_90()
    {

        global $conn;

        $persons = array();
        $cond = '';
        $cond_start = '';
        $cond_stop = '';

        if (empty($_GET['Year'])) {
            return $persons;
        }

        $year = (int)$_GET['Year'];
        $trimester = (int)$_GET['Trimester'];
        $trimesters = array(
            1 => '1,2,3,4',
            2 => '5,6,7,8',
            3 => '9,10,11,12',
        );
        $month = $_GET['Month'];

        if ($month > 0 && $trimester <= 0) {
            if ($month < 5)
                $trimester = 1;
            else if ($month < 9)
                $trimester = 2;
            else
                $trimester = 3;
        }


        if (!empty($_GET['CompanyID'])) {
            $cond .= " AND a.CompanyID = " . (int)$_GET['CompanyID'];
        }

        if ($trimester > 0) {
            if ($trimester == 1)
                $cond .= " AND (StopDate IS NULL OR StopDate='0000-00-00' OR (StopDate IS NOT NULL AND StopDate >= '$year-01-01')) ";
            if ($trimester == 2)
                $cond .= " AND (StopDate IS NULL OR StopDate='0000-00-00' OR (StopDate IS NOT NULL AND StopDate >= '$year-05-01')) ";
            if ($trimester == 3)
                $cond .= " AND (StopDate IS NULL OR StopDate='0000-00-00' OR (StopDate IS NOT NULL AND StopDate >= '$year-09-01')) ";
            $cond_start .= " AND MONTH(StartDate) IN ({$trimesters[$trimester]})";
            $cond_stop .= " AND MONTH(StopDate) IN ({$trimesters[$trimester]})";
        }

        if (!empty($_GET['Month'])) {
            $cond .= " AND (StopDate IS NULL OR StopDate='0000-00-00' OR (StopDate IS NOT NULL AND StopDate >= '$year-$month-01')) ";
            $cond_start .= " AND MONTH(StartDate) = {$month}";
            $cond_stop .= " AND MONTH(StopDate) = {$month}";
        }

        // Get existing persons
        foreach ($trimesters AS $trim => $trimester_months) {
            $cond_query = $cond;
            if ($trimester <= 0) {
                if ($trim == 1)
                    $cond_query = $cond . " AND (StopDate IS NULL OR StopDate='0000-00-00' OR (StopDate IS NOT NULL AND StopDate >= '$year-01-01')) ";
                if ($trim == 2)
                    $cond_query = $cond . " AND (StopDate IS NULL OR StopDate='0000-00-00' OR (StopDate IS NOT NULL AND StopDate >= '$year-05-01')) ";
                if ($trim == 3)
                    $cond_query = $cond . " AND (StopDate IS NULL OR StopDate='0000-00-00' OR (StopDate IS NOT NULL AND StopDate >= '$year-09-01')) ";
            } else if ($trimester != $trim)
                continue;

            $cond_start_date = '';
            if ($trim == 1)
                $cond_start_date = $year . '-04-30';
            if ($trim == 2)
                $cond_start_date = $year . '-08-31';
            if ($trim == 3)
                $cond_start_date = $year . '-12-31';

            $query = "SELECT 
						COUNT(DISTINCT a.PersonID) AS employees, b.CompanyName, b.CompanyID
						FROM payroll a 
						LEFT JOIN companies b ON a.CompanyID=b.CompanyID 
						LEFT JOIN persons c ON a.PersonID=c.PersonID 
						WHERE YEAR(a.StartDate)<='$year' AND a.StartDate <= '$cond_start_date'  
						$cond_query 
						GROUP BY  a.CompanyID";
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $all[$year][$row['CompanyID']][$trim] = $row;
            }
        }

        // Get the employed persons
        $query = "SELECT
					  YEAR(StartDate) AS year,
					  CASE 
					        WHEN 
					             MONTH(StartDate) IN (1,2,3,4) THEN 1
					        WHEN 
					             MONTH(StartDate) IN (5,6,7,8) THEN 2
					        WHEN 
					             MONTH(StartDate) IN (9,10,11,12) THEN 3
					  END AS trimester,
					  COUNT(*) AS employed, b.CompanyName, b.CompanyID
					FROM
					  payroll a
					  LEFT JOIN companies b ON a.CompanyID=b.CompanyID
					  WHERE YEAR(StartDate)='$year' $cond $cond_start
					  GROUP BY year, trimester, a.CompanyID
					  ORDER BY a.CompanyID, trimester";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $employed[$row['year']][$row['CompanyID']][$row['trimester']] = $row;
        }

        // Get the left persons
        $query = "SELECT
					  YEAR(StopDate) AS year,
					  CASE 
					        WHEN 
					             MONTH(StopDate) IN (1,2,3,4) THEN 1
					        WHEN 
					             MONTH(StopDate) IN (5,6,7,8) THEN 2
					        WHEN 
					             MONTH(StopDate) IN (9,10,11,12) THEN 3
					  END AS trimester,
					  COUNT(*) AS employees_left, b.CompanyName, b.CompanyID
					FROM
					  payroll a
					  LEFT JOIN companies b ON a.CompanyID=b.CompanyID
					  WHERE YEAR(StopDate)='$year' $cond $cond_stop
					GROUP BY
					  year, trimester, a.CompanyID";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $left[$row['year']][$row['CompanyID']][$row['trimester']] = $row;
        }

        $self_companies = Company::getSelfCompanies();
        foreach ($self_companies as $companyID => $companyName) {
            foreach ($trimesters as $trim => $trim_months) {
                $employees[$companyID][$trim]['year'] = $year;
                $employees[$companyID][$trim]['trimester'] = $trim;
                $employees[$companyID][$trim]['month'] = $month;
                $employees[$companyID][$trim]['employees'] = $all[$year][$companyID][$trim]['employees'];
                $employees[$companyID][$trim]['employed'] = $employed[$year][$companyID][$trim]['employed'];
                $employees[$companyID][$trim]['employees_left'] = $left[$year][$companyID][$trim]['employees_left'];
                $employees[$companyID][$trim]['CompanyID'] = $all[$year][$companyID][$trim]['CompanyID'];
                $employees[$companyID][$trim]['CompanyName'] = $all[$year][$companyID][$trim]['CompanyName'];
                if ($all[$year][$companyID][$trim]['employees'] > 0)
                    $employees[$companyID][$trim]['fluctuation'] = number_format(($left[$year][$companyID][$trim]['employees_left'] / $all[$year][$companyID][$trim]['employees']) * 100, 2, '.', '');
            }
        }

        foreach ($employees as $emp) {
            foreach ($trimesters as $trim => $trim_months) {
                $persons[] = $emp[$trim];
            }
        }
        //var_dump($persons);
        return $persons;
    }

    public static function getReports_92()
    {

        global $conn;

        $data = array();
        $cond = '';
        $cond_start = '';
        $cond_stop = '';

        if (empty($_GET['Year'])) {
            return $persons;
        }

        $year = (int)$_GET['Year'];
        $month = (int)$_GET['Month'];
        $trimester = (int)$_GET['Trimester'];
        $trimesters = array(
            1 => '1,2,3,4',
            2 => '5,6,7,8',
            3 => '9,10,11,12',
        );

        if (!empty($_GET['CompanyID'])) {
            $cond .= " AND c.PersonID IN (
					    SELECT PersonID
					    FROM   payroll
					    WHERE  CompanyID = " . (int)$_GET['CompanyID'] . "
					)";
        }

        if (!empty($_GET['Trimester'])) {
            $cond_start .= " AND MONTH(a.StartDate) IN ({$trimesters[$trimester]})";
        }

        if (!empty($_GET['Month'])) {
            $cond_start .= " AND MONTH(a.StartDate) = '$month'";
        }

        // Get the employed persons
        $query = "SELECT
					  YEAR(a.StartDate) AS year, MONTH(a.StartDate) AS month,
					  CASE 
					        WHEN 
					             MONTH(a.StartDate) IN (1,2,3,4) THEN 1
					        WHEN 
					             MONTH(a.StartDate) IN (5,6,7,8) THEN 2
					        WHEN 
					             MONTH(a.StartDate) IN (9,10,11,12) THEN 3
					  END AS trimester,
					  (SELECT COUNT(*) FROM training_persons x
					  	LEFT JOIN payroll y ON x.PersonID=y.PersonID
					  	WHERE a.TrainingID=x.TrainingID AND y.CompanyID=c.CompanyID) AS TrainedPersons, 
					  (SELECT COUNT(*) FROM payroll p 
					  	LEFT JOIN persons r ON p.PersonID=r.PersonID 
					  	WHERE r.Status IN (2,7,9)
					  	AND p.StartDate<= a.StopDate AND (p.StopDate IS NULL OR p.StopDate='0000-00-00' OR p.StopDate<a.StopDate)  AND p.CompanyID=c.CompanyID) AS TotalEmployees,
					  a.Cost AS CostPerTraining, a.Currency AS CostPerTrainingCurrency,
					  d.CompanyName, c.CompanyID
					FROM
					  trainings a
					  LEFT JOIN training_persons b ON a.TrainingID=b.TrainingID
					  LEFT JOIN payroll c ON b.PersonID=c.PersonID
					  LEFT JOIN companies d ON c.CompanyID=d.CompanyID
					  WHERE YEAR(a.StartDate)='$year' $cond $cond_start
					GROUP BY
					  year, trimester, month, c.CompanyID";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $data[$row['year']][$row['CompanyID']][$row['trimester']] = $row;
        }
        // Utils::pa($data);

        $self_companies = Company::getSelfCompanies();
        if (is_array($data[$year])) {
            foreach ($data[$year] as $trim_train) {
                foreach ($self_companies as $companyID => $train) {
                    foreach ($trimesters as $trim => $trim_months) {
                        if (!empty($data[$year][$companyID][$trim]))
                            $res[$year . '_' . $companyID . '_' . $trim] = $data[$year][$companyID][$trim];
                    }
                }
            }
        }
        //Utils::pa($res);
        return $res;
    }

    public static function getReports_93()
    {

        global $conn;

        $data = array();
        $cond = '';
        $cond_start = '';
        $cond_stop = '';

        if (empty($_GET['Year'])) {
            return $persons;
        }

        $year = (int)$_GET['Year'];
        $month = (int)$_GET['Month'];
        $trimester = (int)$_GET['Trimester'];
        $trimesters = array(
            1 => '1,2,3,4',
            2 => '5,6,7,8',
            3 => '9,10,11,12',
        );

        if (!empty($_GET['CompanyID'])) {
            $cond .= " AND c.PersonID IN (
					    SELECT PersonID
					    FROM   payroll
					    WHERE  CompanyID = " . (int)$_GET['CompanyID'] . "
					)";
        }

        if (!empty($_GET['Trimester'])) {
            $cond_start .= " AND MONTH(a.StartDate) IN ({$trimesters[$trimester]})";
        }

        if (!empty($_GET['Month'])) {
            $cond_start .= " AND MONTH(a.StartDate) = '$month'";
        }

        // Get the employed persons
        $query = "SELECT
					  YEAR(a.StartDate) AS year, MONTH(a.StartDate) AS month,
					  CASE 
					        WHEN 
					             MONTH(a.StartDate) IN (1,2,3,4) THEN 1
					        WHEN 
					             MONTH(a.StartDate) IN (5,6,7,8) THEN 2
					        WHEN 
					             MONTH(a.StartDate) IN (9,10,11,12) THEN 3
					  END AS trimester,
					  (SELECT COUNT(DISTINCT(x.PersonID)) FROM persons_salary_extra x 
					  	LEFT JOIN payroll y ON x.PersonID=y.PersonID 
					  	WHERE y.CompanyID=c.CompanyID AND MONTH(x.StartDate)=month)  AS BonusedPersons, 
					  (SELECT COUNT(*) FROM payroll p 
					  	LEFT JOIN persons r ON p.PersonID=r.PersonID 
					  	WHERE r.Status IN (2,7,9)
					  	AND p.StartDate<= a.StartDate AND (p.StopDate IS NULL OR p.StopDate='0000-00-00' OR p.StopDate<=a.StartDate) AND p.CompanyID=c.CompanyID) AS TotalEmployees,
					  SUM(a.Salary) AS BonusBrutPerPeriod, a.Currency,
					  d.CompanyName, c.CompanyID
					FROM
					  persons_salary_extra a
					  LEFT JOIN payroll c ON a.PersonID=c.PersonID
					  LEFT JOIN companies d ON c.CompanyID=d.CompanyID
					  WHERE a.Type='bonus' AND YEAR(a.StartDate)='$year' $cond $cond_start
					GROUP BY
					  year, trimester, month, c.CompanyID";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $data[$row['year']][$row['CompanyID']][$row['trimester']] = $row;
        }

        $self_companies = Company::getSelfCompanies();
        if (is_array($data[$year])) {
            foreach ($data[$year] as $trim_train) {
                foreach ($self_companies as $companyID => $train) {
                    foreach ($trimesters as $trim => $trim_months) {
                        if (!empty($data[$year][$companyID][$trim]))
                            $res[$year . '_' . $companyID . '_' . $trim] = $data[$year][$companyID][$trim];
                    }
                }
            }
        }
        //Utils::pa($res);
        return $res;
    }

    public static function getReports_94()
    {

        global $conn;

        $data = array();
        $cond = '';
        $cond_start = '';
        $cond_stop = '';

        if (empty($_GET['Year'])) {
            return $persons;
        }

        $year = (int)$_GET['Year'];
        $month = (int)$_GET['Month'];
        $trimester = (int)$_GET['Trimester'];
        $trimesters = array(
            1 => '1,2,3,4',
            2 => '5,6,7,8',
            3 => '9,10,11,12',
        );

        if (!empty($_GET['CompanyID'])) {
            $cond .= " AND c.PersonID IN (
					    SELECT PersonID
					    FROM   payroll
					    WHERE  CompanyID = " . (int)$_GET['CompanyID'] . "
					)";
        }

        if (!empty($_GET['Trimester'])) {
            $cond_start .= " AND MONTH(a.StartDate) IN ({$trimesters[$trimester]})";
        }

        if (!empty($_GET['Month'])) {
            $cond_start .= " AND MONTH(a.StartDate) = '$month'";
        }

        // Get the employed persons
        $query = "SELECT
					  YEAR(a.StartDate) AS year, MONTH(a.StartDate) AS month,
					  CASE 
					        WHEN 
					             MONTH(a.StartDate) IN (1,2,3,4) THEN 1
					        WHEN 
					             MONTH(a.StartDate) IN (5,6,7,8) THEN 2
					        WHEN 
					             MONTH(a.StartDate) IN (9,10,11,12) THEN 3
					  END AS trimester,
					  (SELECT COUNT(*) FROM training_persons x
					  	LEFT JOIN payroll y ON x.PersonID=y.PersonID
					  	WHERE a.TrainingID=x.TrainingID AND y.CompanyID=c.CompanyID) AS TrainedPersons, 
					  (SELECT COUNT(*) FROM payroll p 
					  	LEFT JOIN persons r ON p.PersonID=r.PersonID 
					  	WHERE r.Status IN (2,7,9)
					  	AND p.StartDate<= a.StopDate AND (p.StopDate IS NULL OR p.StopDate='0000-00-00' OR p.StopDate<a.StopDate)  AND p.CompanyID=c.CompanyID) AS TotalEmployees,
					  a.Hours AS HoursPerTraining,
					  d.CompanyName, c.CompanyID
					FROM
					  trainings a
					  LEFT JOIN training_persons b ON a.TrainingID=b.TrainingID
					  LEFT JOIN payroll c ON b.PersonID=c.PersonID
					  LEFT JOIN companies d ON c.CompanyID=d.CompanyID
					  WHERE YEAR(a.StartDate)='$year' $cond $cond_start
					GROUP BY year, trimester, month, c.CompanyID
					ORDER BY c.CompanyID, trimester,month";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $data[] = $row;
        }
        //Utils::pa($data);

        //Utils::pa($res);
        return $data;
    }

    public static function getReports_96()
    {

        global $conn;

        $data = array();
        $cond = '';
        $cond_start = '';
        $cond_stop = '';

        if (empty($_GET['Year'])) {
            return $persons;
        }

        $year = (int)$_GET['Year'];
        $month = (int)$_GET['Month'];
        $trimester = (int)$_GET['Trimester'];
        $trimesters = array(
            1 => '1,2,3,4',
            2 => '5,6,7,8',
            3 => '9,10,11,12',
        );

        if (!empty($_GET['CompanyID'])) {
            $cond .= " AND c.PersonID IN (
					    SELECT PersonID
					    FROM   payroll
					    WHERE  CompanyID = " . (int)$_GET['CompanyID'] . "
					)";
        }

        if (!empty($_GET['Trimester'])) {
            $cond_start .= " AND MONTH(a.StartDate) IN ({$trimesters[$trimester]})";
        }

        if (!empty($_GET['Month'])) {
            $cond_start .= " AND MONTH(a.StartDate) = '$month'";
        }

        // Get the employed persons
        $query = "SELECT
					  YEAR(a.StartDate) AS year, MONTH(a.StartDate) AS month,
					  CASE 
					        WHEN 
					             MONTH(a.StartDate) IN (1,2,3,4) THEN 1
					        WHEN 
					             MONTH(a.StartDate) IN (5,6,7,8) THEN 2
					        WHEN 
					             MONTH(a.StartDate) IN (9,10,11,12) THEN 3
					  END AS trimester,
					  (SELECT COUNT(*) FROM payroll p 
					  	LEFT JOIN persons r ON p.PersonID=r.PersonID 
					  	WHERE r.Status IN (2,7,9)
					  	AND p.StartDate<= a.StartDate AND (p.StopDate IS NULL OR p.StopDate='0000-00-00' OR p.StopDate<=a.StartDate) AND p.CompanyID=c.CompanyID) AS TotalEmployees,
					  COUNT(*) AS CertificatesPerPeriod,
					  COUNT(DISTINCT(a.PersonID)) AS CertifiedPersons,
					  d.CompanyName, c.CompanyID
					FROM
					  persons_certif a
					  LEFT JOIN payroll c ON a.PersonID=c.PersonID
					  LEFT JOIN companies d ON c.CompanyID=d.CompanyID
					  WHERE YEAR(a.StartDate)='$year' $cond $cond_start
					GROUP BY year, trimester, month, c.CompanyID
					ORDER BY c.CompanyID, trimester,month";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $res[] = $row;
        }
        //Utils::pa($res);
        return $res;
    }


    static function getReports_97()
    {
        global $conn;

        $persons = array();
        $sums = array();
        $totals = array();
        $year = !empty($_GET['Year']) ? (int)$_GET['Year'] : date('Y');
        $company_id = !empty($_GET['CompanyID']) ? (int)$_GET['CompanyID'] : '';
        $department_id = !empty($_GET['DepartmentID']) ? (int)$_GET['DepartmentID'] : '';
        $departments = Utils::getDepartments();
        $type = !empty($_GET['SalaryType']) ? (int)$_GET['SalaryType'] : 1;

        $order_by = !empty($_GET['order_by']) ? $conn->real_escape_string($_GET['order_by']) : 'a.FullName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        if (!empty($company_id)) {

            $benefits = array();

            $conn->query("SELECT ((MONTH(IF(EndDate > '{$year}-12-31' " . ($year == date('Y') ? " OR EndDate > NOW() " : "") . " OR EndDate = '0000-00-00', " . ($year != date('Y') ? "'{$year}-12-31'" : "NOW()") . ",EndDate)) - MONTH(IF(RegDate < '{$year}-01-01' OR RegDate = '0000-00-00','{$year}-01-01',RegDate)))+1)*TotalCost*IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '{$year}'), 1) AS RealValue, BenID, Type, TotalCost, Currency, PersonID, RegDate, EndDate FROM persons_beneficii WHERE Type IN (1,4,9,14) AND ((RegDate <= '{$year}-01-01' AND (EndDate >= '{$year}-01-01' OR EndDate = '0000-00-00')) OR (RegDate >= '{$year}-01-01' AND EndDate <= '{$year}-12-31') OR (EndDate <= '{$year}-12-31' AND (EndDate >= '{$year}-12-31' OR EndDate = '0000-00-00')))");

            while ($row = $conn->fetch_array()) {
                $benefits[$row['Type']][$row['PersonID']][] = $row;
            }

            $trainings = array();

            //$conn->query("SELECT IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '{$year}'), 1)*Cost AS RealValue, PersonID FROM trainings WHERE StartDate >= '{$year}-01-01' AND StartDate <= '{$year}-12-31' AND CompanyID = {$company_id}");
            $query = "SELECT IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '{$year}'), 1)*Cost AS RealValue, b.PersonID
                				FROM trainings a
                				LEFT JOIN training_persons b ON a.TrainingID=b.TrainingID 
                				WHERE 
                				(
                					(YEAR(StartDate) = '$year') 
                				 OR (
                				 		(YEAR(StartDate) <= '$year') AND
                				 		(YEAR(StopDate) >= '$year')
                				 	)
                				) 
                				";
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $trainings[$row['PersonID']] += $row['RealValue'];
            }

            $displacements = array();

            $conn->query("SELECT IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '{$year}'), 1)*CostTotal AS RealValue, PersonID FROM persons_displacement WHERE StartDate >= '{$year}-01-01' AND StartDate <= '{$year}-12-31'");

            while ($row = $conn->fetch_array()) {
                $displacements[$row['PersonID']] += $row['RealValue'];
            }

            $salaries = array();
            $conn->query("SELECT IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '{$year}'), 1)*Salary" . ($type == 2 ? "Net" : "") . " as RealValue, PersonID, StartDate, StopDate FROM persons_salary WHERE YEAR(StartDate) = '{$year}' AND StartDate > '{$year}-01-01' ORDER BY StartDate DESC");

            while ($row = $conn->fetch_array()) {
                $salaries[$row['PersonID']][] = $row;
            }

            $conn->query("SELECT DISTINCT PersonID, IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '{$year}'), 1)*Salary" . ($type == 2 ? "Net" : "") . " as RealValue, StartDate, StopDate FROM persons_salary WHERE StartDate <= '{$year}-01-01' ORDER BY StartDate DESC");
            while ($row = $conn->fetch_array()) {
                $salaries[$row['PersonID']][] = $row;
            }

            #start main q
            $query = 'SELECT a.PersonID, b.DepartmentID, a.FullName';

            #cols req for calculations

            $query .= ", (SELECT TotalCoRef FROM vacations WHERE PersonID = a.PersonID AND Year = '{$year}') AS TotalCoRef";
            $query .= ", (SELECT TotalCo FROM vacations WHERE PersonID = a.PersonID AND Year = '{$year}') AS TotalCo";

            #Month salary

            $query .= ", (SELECT Salary" . ($type == 2 ? "Net" : "") . "*(IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '{$year}'), 1)) FROM persons_salary WHERE PersonID = a.PersonID AND StartDate <= '{$year}-12-31' ORDER BY StartDate DESC LIMIT 1) as MonthSalary";

            #First salary of the year

            $query .= ", (SELECT Salary" . ($type == 2 ? "Net" : "") . "*(IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '{$year}'), 1)) FROM persons_salary WHERE PersonID = a.PersonID AND YEAR(StartDate) = '{$year}' ORDER BY StartDate ASC LIMIT 1) as FirstYearSalary";

            #Worked months

            $query .= ", (SELECT IF('{$year}' > YEAR(NOW()),0,(IF (StopDate != '0000-00-00' AND StopDate IS NOT NULL AND YEAR(StopDate) < '{$year}', 0, (MONTH(IF(StopDate < " . ($year != date('Y') ? "'{$year}-12-31'" : "NOW()") . " AND StopDate != '0000-00-00', StopDate, " . ($year != date('Y') ? "'{$year}-12-31'" : "NOW()") . ")) - MONTH(IF(StartDate < '{$year}-01-01', '{$year}-01-01', StartDate)))+1))) FROM payroll WHERE payroll.PersonID = a.PersonID) AS WMonths";

            #CO Days

            $query .= ", (SELECT IF(TotalCORef-21>0, TotalCORef-21, 0) FROM dual) as CODays";

            #CO value

            $query .= ", (SELECT (SELECT Salary" . ($type == 2 ? "Net" : "") . "*(IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '{$year}'), 1)) FROM persons_salary WHERE PersonID = a.PersonID AND Year(StartDate) <= '{$year}' AND StartDate <= " . ($year != date('Y') ? "{$year}-12-31" : "NOW()") . " ORDER BY StartDate DESC LIMIT 1)/21*CODays FROM dual) AS CO";

            #Overtime

            #$query .= ", (SELECT SUM(Hours) FROM pontaj_detail WHERE PersonID = a.PersonID AND StartDate >= '{$year}-01-01' AND StartDate <= ".($year != date('Y') ? "{$year}-12-31" : "NOW()")." AND Type = 5) AS OT";

            #Bonuses

            $query .= ", (SELECT SUM(Salary" . ($type == 2 ? "Net" : "") . "*(IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '{$year}'), 1))) FROM persons_salary_extra WHERE PersonID = a.PersonID AND (Type = 'bonus' OR Type='bonus_sales' OR Type='bonus_natura') AND StartDate >= '{$year}-01-01' AND StartDate <= " . ($year != date('Y') ? "'{$year}-12-31'" : "NOW()") . ") AS SBonus";

            #Premiums

            $query .= ", (SELECT SUM(Salary" . ($type == 2 ? "Net" : "") . "*(IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '{$year}'), 1))) FROM persons_salary_extra WHERE PersonID = a.PersonID AND Type = 'bonus_prime' AND StartDate >= '{$year}-01-01' AND StartDate <= " . ($year != date('Y') ? "'{$year}-12-31'" : "NOW()") . ") AS SPremium";

            #Concediu neefectuat

            $query .= ", (SELECT SUM(Salary" . ($type == 2 ? "Net" : "") . "*(IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '{$year}'), 1))) FROM persons_salary_extra WHERE PersonID = a.PersonID AND (Type = 'concediu') AND StartDate >= '{$year}-01-01' AND StartDate <= " . ($year != date('Y') ? "'{$year}-12-31'" : "NOW()") . ") AS ConcediuNeefectuat";

            #Latest salary increase

            $query .= ", ((SELECT Salary" . ($type == 2 ? "Net" : "") . "*(IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '{$year}'), 1)) FROM persons_salary WHERE PersonID = a.PersonID AND YEAR(StartDate) <= '{$year}' ORDER BY StartDate DESC LIMIT 1) - (SELECT Salary" . ($type == 2 ? "Net" : "") . "*(IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '{$year}'), 1)) FROM persons_salary WHERE PersonID = a.PersonID AND YEAR(StartDate) <= '{$year}' ORDER BY StartDate DESC LIMIT 1,1)) AS SDiff";

            #Date of latest salary increase

            $query .= ", (SELECT MAX(StartDate) FROM persons_salary WHERE PersonID = a.PersonID AND YEAR(StartDate) <= '{$year}') AS LatSInc";

            #Salary year over year increase

            #$query .= ", ((SELECT Salary".($type == 2 ? "Net" : "")."*(IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '{$year}'), 1)) FROM persons_salary WHERE PersonID = a.PersonID AND YEAR(StartDate) = '{$year}' ORDER BY StartDate DESC LIMIT 1) - (SELECT Salary".($type == 2 ? "Net" : "")."*(IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '".($year-1)."'), 1)) FROM persons_salary WHERE PersonID = a.PersonID AND StartDate <= DATE_SUB(".($year != date('Y') ? "{$year}-12-31" : "NOW()").", INTERVAL 1 YEAR) AND YEAR(StartDate) = '".($year-1)."' ORDER BY StartDate DESC LIMIT 1)) AS SYoyInc";

            #Inventory total value

//                $query .= ", (SELECT SUM(inventar.ObjAcqValue) FROM persons_inventar JOIN inventar ON persons_inventar.ObjID = inventar.ObjID WHERE persons_inventar.PersonID = a.PersonID AND YEAR(StartDate) <= '{$year}' AND (StopDate = '0000-00-00' OR YEAR(StopDate) >= '{$year}')) AS TotalInv";

            $query .= " FROM persons a
                            JOIN payroll b ON b.PersonID = a.PersonID
                                    WHERE b.StartDate <= '$year-12-31' 
                                        AND (b.StopDate IS NULL OR b.StopDate = '0000-00-00' OR b.StopDate >= '$year-01-01')     
                                    AND b.CompanyID = {$company_id} " . (!empty($department_id) ? " AND b.DepartmentID = '{$department_id}'" : "")
                . (!empty($_SESSION['PERS']) && !in_array($_SESSION['USER_ID'], array(27, 30)) ? " AND a.PersonID = '{$_SESSION['PERS']}'" : "") . "   
                                            ORDER BY {$order_by} {$asc_or_desc}";


            $conn->query($query);

            while ($row = $conn->fetch_array()) {
                $row['Department'] = $departments[$row['DepartmentID']];
                if (empty($row['MonthSalary'])) {
                    $row['MonthSalary'] = $row['FirstYearSalary'];
                }
                $row['MonthSalary'] = round($row['MonthSalary'], 0);
                $sums[$row['Department'] . "-" . $row['DepartmentID']]['MonthSalary'] += $row['MonthSalary'];
                $totals['MonthSalary'] += $row['MonthSalary'];

                $sums[$row['Department'] . "-" . $row['DepartmentID']]['WMonths'] += $row['WMonths'];
                $totals['WMonths'] += $row['WMonths'];
                !isset($sums[$row['Department'] . "-" . $row['DepartmentID']]['Name']) ? $sums[$row['Department'] . "-" . $row['DepartmentID']]['Name'] = $row['Department'] : '';

                $row['CO'] = round($row['CO'], 0);
                $sums[$row['Department'] . "-" . $row['DepartmentID']]['CODays'] += $row['CODays'];
                $totals['CODays'] += $row['CODays'];
                $sums[$row['Department'] . "-" . $row['DepartmentID']]['CO'] += $row['CO'];
                $totals['CO'] += $row['CO'];

                $row['SBonus'] = round($row['SBonus'], 0);
                $sums[$row['Department'] . "-" . $row['DepartmentID']]['SBonus'] += $row['SBonus'];
                $totals['SBonus'] += $row['SBonus'];

                $row['ConcediuNeefectuat'] = round($row['ConcediuNeefectuat'], 0);
                $sums[$row['Department'] . "-" . $row['DepartmentID']]['ConcediuNeefectuat'] += $row['ConcediuNeefectuat'];
                $totals['ConcediuNeefectuat'] += $row['ConcediuNeefectuat'];

                $row['SPremium'] = round($row['SPremium'], 0);
                $sums[$row['Department'] . "-" . $row['DepartmentID']]['SPremium'] += $row['SPremium'];
                $totals['SPremium'] += $row['SPremium'];

                $row['Catering'] = 0;
                if (!empty($benefits[9][$row['PersonID']])) {
                    foreach ($benefits[9][$row['PersonID']] as $catering) {
                        $row['Catering'] += $catering['RealValue'];
                    }
//                        $row['Catering'] = $row['Catering']*21;
                }

                $row['MealTickets'] = 0;
                $row['TaxMealTickets'] = 0;
                if (!empty($benefits[4][$row['PersonID']])) {
                    foreach ($benefits[4][$row['PersonID']] as $mealtickets) {
                        $row['MealTickets'] += $mealtickets['RealValue'];
                    }
//                        $row['MealTickets'] = $row['MealTickets']*21;
                    $row['TaxMealTickets'] = $row['MealTickets'] * 0.16;
                }

                $row['HealthIns'] = 0;
                if (!empty($benefits[1][$row['PersonID']])) {
                    foreach ($benefits[1][$row['PersonID']] as $healthins) {
                        $row['HealthIns'] += $healthins['RealValue'];
                    }
                }

                $row['FamilyHealthIns'] = 0;
                if (!empty($benefits[14][$row['PersonID']])) {
                    foreach ($benefits[14][$row['PersonID']] as $famhealthins) {
                        $row['FamilyHealthIns'] += $famhealthins['RealValue'];
                    }
                }
                $row['Meal'] = $row['Catering'] + $row['MealTickets'];


                $row['Catering'] = round($row['Catering'], 0);
                $row['MealTickets'] = round($row['MealTickets'], 0);
                $row['TaxMealTickets'] = round($row['TaxMealTickets'], 0);
                $row['HealthIns'] = round($row['HealthIns'], 0);
                $row['FamilyHealthIns'] = round($row['FamilyHealthIns'], 0);
                $row['Meal'] = round($row['Meal'], 0);


                $sums[$row['Department'] . "-" . $row['DepartmentID']]['Catering'] += $row['Catering'];
                $sums[$row['Department'] . "-" . $row['DepartmentID']]['MealTickets'] += $row['MealTickets'];
                $sums[$row['Department'] . "-" . $row['DepartmentID']]['TaxMealTickets'] += $row['TaxMealTickets'];
                $sums[$row['Department'] . "-" . $row['DepartmentID']]['HealthIns'] += $row['HealthIns'];
                $sums[$row['Department'] . "-" . $row['DepartmentID']]['FamilyHealthIns'] += $row['FamilyHealthIns'];
                $sums[$row['Department'] . "-" . $row['DepartmentID']]['Meal'] += $row['Meal'];


                $totals['Catering'] += $row['Catering'];
                $totals['MealTickets'] += $row['MealTickets'];
                $totals['TaxMealTickets'] += $row['TaxMealTickets'];
                $totals['HealthIns'] += $row['HealthIns'];
                $totals['FamilyHealthIns'] += $row['FamilyHealthIns'];
                $totals['Meal'] += $row['Meal'];

                $row['SDiff'] = round($row['SDiff'], 0);
                $row['LatSInc'] = Utils::toDisplayDate($row['LatSInc']);

                $row['SYoyInc'] = 0;
                $person_salary = $salaries[$row['PersonID']];

                for ($i = 0; $i < count($person_salary); $i++) {
                    if ($i < count($person_salary) - 1) {
                        if (strtotime($person_salary[$i]['StartDate']) < strtotime($year . "-01-01")) {
                            $Start = new DateTime($year . "-01-01", new DateTimeZone("Europe/Bucharest"));
                        } else {
                            $Start = new DateTime($person_salary[$i]['StartDate'], new DateTimeZone("Europe/Bucharest"));
                        }
                        if (strtotime($person_salary[$i]['StopDate']) > strtotime($year . "-12-31")) {
                            $Stop = new DateTime($year . "-12-31", new DateTimeZone("Europe/Bucharest"));
                        } else {
                            $Stop = new DateTime($person_salary[$i]['StopDate'], new DateTimeZone("Europe/Bucharest"));
                        }
                        $interval = $Stop->diff($Start);
                        $row['SYoyInc'] += $interval->m * ($person_salary[$i]['RealValue'] - $person_salary[$i + 1]['RealValue']);
                        //Utils::pa($row['SYoyInc']);
                    }
                }

                $row['SYoyInc'] = round($row['SYoyInc'], 0);

                $sums[$row['Department'] . "-" . $row['DepartmentID']]['SYoyInc'] += $row['SYoyInc'];
                $totals['SYoyInc'] += $row['SYoyInc'];


                $row['Trainings'] = round($trainings[$row['PersonID']], 0);
                $row['Displacements'] = round($displacements[$row['PersonID']], 0);
                $row['TotalInv'] = round($row['TotalInv'], 0);

                $sums[$row['Department'] . "-" . $row['DepartmentID']]['Trainings'] += $row['Trainings'];
                $sums[$row['Department'] . "-" . $row['DepartmentID']]['Displacements'] += $row['Displacements'];
                $sums[$row['Department'] . "-" . $row['DepartmentID']]['TotalInv'] += $row['TotalInv'];

                $totals['Trainings'] += $row['Trainings'];
                $totals['Displacements'] += $row['Displacements'];
                $totals['TotalInv'] += $row['TotalInv'];

                $persons[$row['PersonID']] = $row;
            }


            $conn->query("SELECT company_settings FROM settings");
            $company_settings = ($row = $conn->fetch_array()) && !empty($row['company_settings']) ? unserialize($row['company_settings']) : array();

            $left_limit = mktime(0, 0, 0, 1, 1, $year);
            $right_limit = $year != date('Y') ? mktime(0, 0, 0, 12, 31, $year) : time();
            foreach ($persons as $key => $person) {
                $person_ot = 0;
                if (!empty($salaries[$key])) {
                    foreach ($salaries[$key] as $person_salary) {
                        if ($person_salary["StartDate"] != '0000-00-00') {
                            $sd_params = explode("-", $person_salary['StartDate']);
                            $StartDate = mktime(0, 0, 0, $sd_params[1], $sd_params[2], $sd_params[0]);
                        } else {
                            $StartDate = $left_limit;
                        }

                        if ($person_salary['StopDate'] != '0000-00-00') {
                            $ed_params = explode("-", $person_salary['StopDate']);
                            $StopDate = mktime(0, 0, 0, $ed_params[1], $ed_params[2], $ed_params[0]);
                        } else {
                            $StopDate = $right_limit;
                        }
                        $hsal = $person_salary['RealValue'] / 168;
                        $stats = Pontaj::getPersonDetailStat($key, date('Y-m-d', ($left_limit < $StartDate ? $StartDate : $left_limit)), date('Y-m-d', ($right_limit > $StopDate ? $StopDate : $right_limit)));

                        $person_ot += $stats['SplHours'] * $hsal * (($company_settings['pontaj']['proc_normal'] + 100) / 100);
                        $person_ot += $stats['NightHours'] * $hsal * (($company_settings['pontaj']['proc_night'] + 100) / 100);
                        $person_ot += $stats['LegalHours'] * $hsal * (($company_settings['pontaj']['proc_legal'] + 100) / 100);
                        $person_ot += $stats['WkHours'] * $hsal * (($company_settings['pontaj']['proc_weekend'] + 100) / 100);
                    }
                }
                $persons[$key]['OT'] = round($person_ot, 0);

                $sums[$person['Department'] . "-" . $person['DepartmentID']]['OT'] += $persons[$key]['OT'];
                $totals['OT'] += $persons[$key]['OT'];

                $persons[$key]['YearlySalaryPackage'] = $persons[$key]['MonthSalary'] * $persons[$key]['WMonths'] + $persons[$key]['CO'] + $persons[$key]['OT'] + $persons[$key]['SBonus'] + $persons[$key]['ConcediuNeefectuat'] + $persons[$key]['Meal'] + $persons[$key]['TaxMealTickets'] + $persons[$key]['HealthIns'] + $persons[$key]['FamilyHealthIns'] + $persons[$key]['SYoyInc'];
                $persons[$key]['MonthlySalaryPackage'] = ($persons[$key]['WMonths'] > 0 ? $persons[$key]['YearlySalaryPackage'] / $persons[$key]['WMonths'] : 0);
                $persons[$key]['FinancialBenefits'] = $persons[$key]['MonthSalary'] * $persons[$key]['WMonths'] + $persons[$key]['OT'] + $persons[$key]['SBonus'] + $persons[$key]['TaxMealTickets'] + $persons[$key]['SYoyInc'] + $persons[$key]['ConcediuNeefectuat'];
                $persons[$key]['NonFinancialBenefits'] = $persons[$key]['CO'] + $persons[$key]['Meal'] + $persons[$key]['HealthIns'] + $persons[$key]['FamilyHealthIns'];

                $persons[$key]['YearlySalaryPackage'] = round($persons[$key]['YearlySalaryPackage'], 0);
                $persons[$key]['MonthlySalaryPackage'] = round($persons[$key]['MonthlySalaryPackage'], 0);
                $persons[$key]['FinancialBenefits'] = round($persons[$key]['FinancialBenefits'], 0);
                $persons[$key]['NonFinancialBenefits'] = round($persons[$key]['NonFinancialBenefits'], 0);

                $sums[$persons[$key]['Department'] . "-" . $persons[$key]['DepartmentID']]['YearlySalaryPackage'] += $persons[$key]['YearlySalaryPackage'];
                $sums[$persons[$key]['Department'] . "-" . $persons[$key]['DepartmentID']]['MonthlySalaryPackage'] += $persons[$key]['MonthlySalaryPackage'];
                $sums[$persons[$key]['Department'] . "-" . $persons[$key]['DepartmentID']]['FinancialBenefits'] += $persons[$key]['FinancialBenefits'];
                $sums[$persons[$key]['Department'] . "-" . $persons[$key]['DepartmentID']]['NonFinancialBenefits'] += $persons[$key]['NonFinancialBenefits'];

                $totals['YearlySalaryPackage'] += $persons[$key]['YearlySalaryPackage'];
                $totals['MonthlySalaryPackage'] += $persons[$key]['MonthlySalaryPackage'];
                $totals['FinancialBenefits'] += $persons[$key]['FinancialBenefits'];
                $totals['NonFinancialBenefits'] += $persons[$key]['NonFinancialBenefits'];

            }
        }
        ksort($sums);
        return array($persons, $sums, $totals);
    }

    static function getReports_98()
    {
        global $conn;

        $persons = array();
        $sums = array();
        $totals = array();
        $year = !empty($_GET['Year']) ? (int)$_GET['Year'] : date('Y');
        $month = !empty($_GET['Month']) ? (int)$_GET['Month'] : date('m');
        $company_id = !empty($_GET['CompanyID']) ? (int)$_GET['CompanyID'] : '';
        $department_id = !empty($_GET['DepartmentID']) ? (int)$_GET['DepartmentID'] : '';
        $departments = Utils::getDepartments();
        $type = !empty($_GET['SalaryType']) ? (int)$_GET['SalaryType'] : 1;

        $order_by = !empty($_GET['order_by']) ? $conn->real_escape_string($_GET['order_by']) : 'a.FullName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        if (!empty($company_id)) {

            $benefits = array();

            $conn->query("SELECT TotalCost*IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '{$year}'), 1) AS RealValue, BenID, Type, TotalCost, Currency, PersonID, RegDate, EndDate FROM persons_beneficii WHERE Type IN (1,4,9,14) AND RegDate <= '" . date('Y-m-t', strtotime($year . "-" . $month . "-01")) . "' ORDER BY RegDate DESC");

            while ($row = $conn->fetch_array()) {
                if (!isset($benefits[$row['Type']][$row['PersonID']])) {
                    $benefits[$row['Type']][$row['PersonID']] = $row;
                }
            }

            $trainings = array();

            //$conn->query("SELECT IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '{$year}'), 1)*Cost AS RealValue, PersonID FROM trainings WHERE StartDate >= '".date('Y-m-d', strtotime($year."-".$month."-01"))."' AND StartDate <= '".date('Y-m-t', strtotime($year."-".$month."-01"))."' AND CompanyID = {$company_id}");
            $query = "SELECT IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '{$year}'), 1)*Cost AS RealValue, b.PersonID
                				FROM trainings a
                				LEFT JOIN training_persons b ON a.TrainingID=b.TrainingID 
                				WHERE 
                				(
                					(MONTH(StartDate) = '$month' AND YEAR(StartDate) = '$year') 
                				 OR (
                				 		(MONTH(StartDate) <= '$month' AND YEAR(StartDate) <= '$year') AND
                				 		(MONTH(StopDate) >= '$month' AND YEAR(StopDate) >= '$year')
                				 	)
                				) 
                				";
            $conn->query($query);

            while ($row = $conn->fetch_array()) {
                $trainings[$row['PersonID']] += $row['RealValue'];
            }

            $displacements = array();

            $conn->query("SELECT IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '{$year}'), 1)*CostTotal AS RealValue, PersonID FROM persons_displacement WHERE StartDate >= '" . date('Y-m-d', strtotime($year . "-" . $month . "-01")) . "' AND StartDate <= '" . date('Y-m-t', strtotime($year . "-" . $month . "-01")) . "'");

            while ($row = $conn->fetch_array()) {
                $displacements[$row['PersonID']] += $row['RealValue'];
            }

            #start main q
            $query = 'SELECT a.PersonID, b.DepartmentID, a.FullName';

            #Month salary

            $query .= ", (SELECT Salary" . ($type == 2 ? "Net" : "") . "*(IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '{$year}'), 1)) FROM persons_salary WHERE PersonID = a.PersonID AND StartDate <= '" . date('Y-m-t', strtotime($year . "-" . $month . "-01")) . "' ORDER BY StartDate DESC LIMIT 1) as MonthSalary";

            #Bonuses

            $query .= ", (SELECT SUM(Salary" . ($type == 2 ? "Net" : "") . "*(IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '{$year}'), 1))) FROM persons_salary_extra WHERE PersonID = a.PersonID AND (Type = 'bonus' OR Type='bonus_sales' OR Type='bonus_natura') AND StartDate >= '" . date('Y-m-d', strtotime($year . "-" . $month . "-01")) . "' AND StartDate <= '" . date('Y-m-t', strtotime($year . "-" . $month . "-01")) . "') AS SBonus";

            #Concediu neefectuat

            $query .= ", (SELECT SUM(Salary" . ($type == 2 ? "Net" : "") . "*(IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '{$year}'), 1))) FROM persons_salary_extra WHERE PersonID = a.PersonID AND (Type = 'concediu') AND StartDate >= '" . date('Y-m-d', strtotime($year . "-" . $month . "-01")) . "' AND StartDate <= '" . date('Y-m-t', strtotime($year . "-" . $month . "-01")) . "') AS ConcediuNeefectuat";

            #Premiums

            $query .= ", (SELECT SUM(Salary" . ($type == 2 ? "Net" : "") . "*(IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '{$year}'), 1))) FROM persons_salary_extra WHERE PersonID = a.PersonID AND Type = 'bonus_prime' AND StartDate >= '" . date('Y-m-d', strtotime($year . "-" . $month . "-01")) . "' AND StartDate <= '" . date('Y-m-t', strtotime($year . "-" . $month . "-01")) . "') AS SPremium";

            #Inventory total value

            $query .= ", (SELECT SUM(inventar.ObjAcqValue) FROM persons_inventar JOIN inventar ON persons_inventar.ObjID = inventar.ObjID WHERE persons_inventar.PersonID = a.PersonID AND ObjType IN(1,2) AND Active = 1 AND YEAR(StartDate) <= '{$year}' AND (StopDate = '0000-00-00' OR YEAR(StopDate) >= '{$year}')) AS TotalInv";


            $query .= " FROM persons a
                            JOIN payroll b ON b.PersonID = a.PersonID 
                            				WHERE b.StartDate <= '" . date('Y-m-t', strtotime($year . "-" . $month . "-01")) . "'
                                                            AND (b.StopDate IS NULL OR b.StopDate = '0000-00-00' OR b.StopDate >= '$year-$month-01')
                                                 AND b.CompanyID = {$company_id} " . (!empty($department_id) ? " AND b.DepartmentID = '{$department_id}'" : "") .
                (!empty($_SESSION['PERS']) && !in_array($_SESSION['USER_ID'], array(27, 30)) ? " AND a.PersonID = '{$_SESSION['PERS']}'" : "")
                . " ORDER BY {$order_by} {$asc_or_desc}";


            $conn->query($query);

            while ($row = $conn->fetch_array()) {
                $row['Department'] = $departments[$row['DepartmentID']];

                $row['MonthSalary'] = round($row['MonthSalary'], 0);
                $sums[$row['Department'] . "-" . $row['DepartmentID']]['MonthSalary'] += $row['MonthSalary'];
                $totals['MonthSalary'] += $row['MonthSalary'];


                !isset($sums[$row['Department'] . "-" . $row['DepartmentID']]['Name']) ? $sums[$row['Department'] . "-" . $row['DepartmentID']]['Name'] = $row['Department'] : '';

                $row['SBonus'] = round($row['SBonus'], 0);
                $sums[$row['Department'] . "-" . $row['DepartmentID']]['SBonus'] += $row['SBonus'];
                $totals['SBonus'] += $row['SBonus'];

                $row['ConcediuNeefectuat'] = round($row['ConcediuNeefectuat'], 0);
                $sums[$row['Department'] . "-" . $row['DepartmentID']]['ConcediuNeefectuat'] += $row['ConcediuNeefectuat'];
                $totals['ConcediuNeefectuat'] += $row['ConcediuNeefectuat'];

                $row['SPremium'] = round($row['SPremium'], 0);
                $sums[$row['Department'] . "-" . $row['DepartmentID']]['SPremium'] += $row['SPremium'];
                $totals['SPremium'] += $row['SPremium'];

                $row['Trainings'] = round($trainings[$row['PersonID']], 0);
                $row['Displacements'] = round($displacements[$row['PersonID']], 0);
                $row['TotalInv'] = round($row['TotalInv'], 0);

                $sums[$row['Department'] . "-" . $row['DepartmentID']]['Trainings'] += $row['Trainings'];
                $sums[$row['Department'] . "-" . $row['DepartmentID']]['Displacements'] += $row['Displacements'];
                $sums[$row['Department'] . "-" . $row['DepartmentID']]['TotalInv'] += $row['TotalInv'];

                $totals['Trainings'] += $row['Trainings'];
                $totals['Displacements'] += $row['Displacements'];
                $totals['TotalInv'] += $row['TotalInv'];

                $persons[$row['PersonID']] = $row;
            }


            $conn->query("SELECT company_settings FROM settings");
            $company_settings = ($row = $conn->fetch_array()) && !empty($row['company_settings']) ? unserialize($row['company_settings']) : array();

            foreach ($persons as $key => $value) {
                $person_ot = 0;
                $stat = Pontaj::getPersonDetailStat($key, date('Y-m-d', strtotime($year . "-" . $month . "-01")), date('Y-m-t', strtotime($year . "-" . $month . "-01")));
                $wd = ceil($stat['NormalHours'] / 8);
                $hsal = $value['MonthSalary'] / 168;
                $person_ot += $stat['SplHours'] * $hsal * (($company_settings['pontaj']['proc_normal'] + 100) / 100);
                $person_ot += $stat['NightHours'] * $hsal * (($company_settings['pontaj']['proc_night'] + 100) / 100);
                $person_ot += $stat['LegalHours'] * $hsal * (($company_settings['pontaj']['proc_legal'] + 100) / 100);
                $person_ot += $stat['WkHours'] * $hsal * (($company_settings['pontaj']['proc_weekend'] + 100) / 100);

                $persons[$key]['OT'] = round($person_ot, 0);

                $sums[$value['Department'] . "-" . $value['DepartmentID']]['OT'] += $persons[$key]['OT'];
                $totals['OT'] += $persons[$key]['OT'];

                $persons[$key]['Catering'] = 0;
                if (!empty($benefits[9][$key])) {
                    $persons[$key]['Catering'] = $benefits[9][$key]['RealValue'] / 21 * $wd;
                }

                $persons[$key]['MealTickets'] = 0;
                $persons[$key]['TaxMealTickets'] = 0;
                if (!empty($benefits[4][$key])) {
                    $persons[$key]['MealTickets'] = $benefits[4][$key]['RealValue'] / 21 * $wd;
                    $persons[$key]['TaxMealTickets'] = $persons[$key]['MealTickets'] * 0.16;
                }

                $persons[$key]['HealthIns'] = 0;
                if (!empty($benefits[1][$key])) {
                    $persons[$key]['HealthIns'] = $benefits[1][$key]['RealValue'];
                }

                $persons[$key]['FamilyHealthIns'] = 0;
                if (!empty($benefits[14][$key])) {
                    $persons[$key]['FamilyHealthIns'] = $benefits[14][$key]['RealValue'];
                }
                $persons[$key]['Meal'] = $persons[$key]['Catering'] + $persons[$key]['MealTickets'];

                $persons[$key]['Catering'] = round($persons[$key]['Catering'], 0);
                $persons[$key]['MealTickets'] = round($persons[$key]['MealTickets'], 0);
                $persons[$key]['TaxMealTickets'] = round($persons[$key]['TaxMealTickets'], 0);
                $persons[$key]['HealthIns'] = round($persons[$key]['HealthIns'], 0);
                $persons[$key]['FamilyHealthIns'] = round($persons[$key]['FamilyHealthIns'], 0);
                $persons[$key]['Meal'] = round($persons[$key]['Meal'], 0);

                $persons[$key]['MonthlySalaryPackage'] = $persons[$key]['MonthSalary'] + $persons[$key]['OT'] + $persons[$key]['SBonus'] + $persons[$key]['ConcediuNeefectuat'] + $persons[$key]['Meal'] + $persons[$key]['TaxMealTickets'] + $persons[$key]['HealthIns'] + $persons[$key]['FamilyHealthIns'];
                $persons[$key]['FinancialBenefits'] = $persons[$key]['MonthSalary'] + $persons[$key]['OT'] + $persons[$key]['SBonus'] + $persons[$key]['TaxMealTickets'] + $persons[$key]['ConcediuNeefectuat'];
                $persons[$key]['NonFinancialBenefits'] = $persons[$key]['Meal'] + $persons[$key]['HealthIns'] + $persons[$key]['FamilyHealthIns'];

                $sums[$value['Department'] . "-" . $value['DepartmentID']]['MonthlySalaryPackage'] += $persons[$key]['MonthlySalaryPackage'];
                $sums[$value['Department'] . "-" . $value['DepartmentID']]['FinancialBenefits'] += $persons[$key]['FinancialBenefits'];
                $sums[$value['Department'] . "-" . $value['DepartmentID']]['NonFinancialBenefits'] += $persons[$key]['NonFinancialBenefits'];

                $totals['MonthlySalaryPackage'] += $persons[$key]['MonthlySalaryPackage'];
                $totals['FinancialBenefits'] += $persons[$key]['FinancialBenefits'];
                $totals['NonFinancialBenefits'] += $persons[$key]['NonFinancialBenefits'];

                $sums[$value['Department'] . "-" . $value['DepartmentID']]['Catering'] += $persons[$key]['Catering'];
                $sums[$value['Department'] . "-" . $value['DepartmentID']]['MealTickets'] += $persons[$key]['MealTickets'];
                $sums[$value['Department'] . "-" . $value['DepartmentID']]['TaxMealTickets'] += $persons[$key]['TaxMealTickets'];
                $sums[$value['Department'] . "-" . $value['DepartmentID']]['HealthIns'] += $persons[$key]['HealthIns'];
                $sums[$value['Department'] . "-" . $value['DepartmentID']]['FamilyHealthIns'] += $persons[$key]['FamilyHealthIns'];
                $sums[$value['Department'] . "-" . $value['DepartmentID']]['Meal'] += $persons[$key]['Meal'];

                $totals['Catering'] += $persons[$key]['Catering'];
                $totals['MealTickets'] += $persons[$key]['MealTickets'];
                $totals['TaxMealTickets'] += $persons[$key]['TaxMealTickets'];
                $totals['HealthIns'] += $persons[$key]['HealthIns'];
                $totals['FamilyHealthIns'] += $persons[$key]['FamilyHealthIns'];
                $totals['Meal'] += $persons[$key]['Meal'];
            }
            ksort($sums);
            return array($persons, $sums, $totals);
        }


    }

    public static function getReports_113()
    {

        global $conn;

        $data = array();
        $cond = '';
        $cond_start = '';
        $cond_stop = '';

        if (empty($_GET['Year'])) {
            return $persons;
        }

        $year = (int)$_GET['Year'];
        $month = (int)$_GET['Month'];
        $trimester = (int)$_GET['Trimester'];
        $trimesters = array(
            1 => '1,2,3,4',
            2 => '5,6,7,8',
            3 => '9,10,11,12',
        );

        if (!empty($_GET['CompanyID'])) {
            $cond .= " AND a.PersonID IN (
					    SELECT PersonID
					    FROM   payroll
					    WHERE  CompanyID = " . (int)$_GET['CompanyID'] . "
					)";
        }

        if (!empty($_GET['Trimester'])) {
            $cond_start .= " AND MONTH(a.StartDate) IN ({$trimesters[$trimester]})";
        }

        if (!empty($_GET['Month'])) {
            $cond_start .= " AND MONTH(a.StartDate) = '$month'";
        }

        $query = "SELECT YEAR(a.StartDate) AS year, MONTH(a.StartDate) AS month, a.*, c.CompanyName,c.CompanyID,
	    			  COUNT(a.FID) AS VacantPositions,PERIOD_DIFF(a.EndDate,a.StartDate)/30 AS OcuppiedMonth,
	    			  DATEDIFF(
					    (SELECT MAX(EndDate) FROM persons_internal_functions WHERE StartDate < a.StartDate),
					    a.StartDate
					  )/30 AS FreeMonths,
					  CASE 
					        WHEN 
					             MONTH(a.StartDate) IN (1,2,3,4) THEN 1
					        WHEN 
					             MONTH(a.StartDate) IN (5,6,7,8) THEN 2
					        WHEN 
					             MONTH(a.StartDate) IN (9,10,11,12) THEN 3
					  END AS trimester
					  FROM persons_internal_functions a
					  LEFT JOIN payroll b ON a.PersonID=b.PersonID
					  LEFT JOIN companies c ON b.CompanyID=c.CompanyID
					  WHERE YEAR(a.StartDate)='$year' $cond_start $cond
					  GROUP BY year, trimester, month, c.CompanyID
					  ORDER BY c.CompanyID, trimester,month
					  ";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $row['FreeMonths'] = number_format($row['FreeMonths'], 2, ',', ' ');
            $res[] = $row;
        }
        //Utils::pa($res);
        return $res;
    }

    public static function getReports_114()
    {

        global $conn;

        $data = array();
        $cond = '';
        $cond_start = '';
        $cond_stop = '';

        if (empty($_GET['Year'])) {
            return $persons;
        }

        $year = (int)$_GET['Year'];
        $month = (int)$_GET['Month'];
        $trimester = (int)$_GET['Trimester'];
        $trimesters = array(
            1 => '1,2,3,4',
            2 => '5,6,7,8',
            3 => '9,10,11,12',
        );

        if (!empty($_GET['CompanyID'])) {
            $cond .= " AND a.PersonID IN (
					    SELECT PersonID
					    FROM   payroll
					    WHERE  CompanyID = " . (int)$_GET['CompanyID'] . "
					)";
        }

        if (!empty($_GET['Trimester'])) {
            $cond_start .= " AND MONTH(a.StartDate) IN ({$trimesters[$trimester]})";
        }

        if (!empty($_GET['Month'])) {
            $cond_start .= " AND MONTH(a.StartDate) = '$month'";
        }

        $query = "SELECT YEAR(a.StartDate) AS year, MONTH(a.StartDate) AS month, a.*, c.CompanyName,c.CompanyID,
	    			  COUNT(a.FID) AS VacantPositions,PERIOD_DIFF(a.EndDate,a.StartDate)/30 AS OcuppiedMonth,
	    			  DATEDIFF(
					    (SELECT MAX(EndDate) FROM persons_internal_functions WHERE StartDate < a.StartDate),
					    a.StartDate
					  )/30 AS FreeMonths,
					  CASE 
					        WHEN 
					             MONTH(a.StartDate) IN (1,2,3,4) THEN 1
					        WHEN 
					             MONTH(a.StartDate) IN (5,6,7,8) THEN 2
					        WHEN 
					             MONTH(a.StartDate) IN (9,10,11,12) THEN 3
					  END AS trimester
					  FROM persons_internal_functions a
					  LEFT JOIN payroll b ON a.PersonID=b.PersonID
					  LEFT JOIN companies c ON b.CompanyID=c.CompanyID
					  WHERE YEAR(a.StartDate)='$year' $cond_start $cond
					  GROUP BY year, trimester, month, c.CompanyID
					  ORDER BY c.CompanyID, trimester,month
					  ";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $row['FreeMonths'] = number_format($row['FreeMonths'], 2, ',', ' ');
            $res[] = $row;
        }
        //Utils::pa($res);
        return $res;
    }

    public static function getReports_115()
    {

        global $conn;

        if (empty($_GET['StartDate']) || empty($_GET['EndDate'])) {
            return;
        }

        $StartDate = date('Y-m-d H:i:s', strtotime($conn->real_escape_string($_GET['StartDate'])));
        $EndDate = date('Y-m-d H:i:s', strtotime($conn->real_escape_string($_GET['EndDate'] . " 23:59:59")));
        $month = !empty($_GET['Month']) ? $conn->real_escape_string($_GET['Month']) : date('m');
        $year = !empty($_GET['Year']) ? $conn->real_escape_string($_GET['Year']) : date('Y');
        $company_id = !empty($_GET['CompanyID']) ? (int)$_GET['CompanyID'] : '';
        $department_id = !empty($_GET['DepartmentID']) ? (int)$_GET['DepartmentID'] : '';

        $MonthStart = date('Y-m-d', strtotime($year . '-' . $month . '-01'));
        $MonthEnd = date('Y-m-t', strtotime($year . '-' . $month . '-01'));
        $wdays = Utils::getDaysDiff($MonthStart, $MonthEnd);

        $PMonthStart = date('Y', strtotime($StartDate)) . "-" . date('m', strtotime($StartDate)) . "-01";
        $PMonthEnd = date('Y-m-t', strtotime($StartDate));
        $pwdays = Utils::getDaysDiff($PMonthStart, $PMonthEnd);

        $persons = array();
        $query = "SELECT a.PersonID, a.FullName, a.CNP, b.DepartmentID, b.StartDate, b.StopDate, b.ContractType, b.ContractDate, b.ContractExpDate, b.SuspendDate, b.ReturnDate
	              FROM   persons a
		             INNER JOIN payroll b ON a.PersonID = b.PersonID
                             WHERE b.StartDate <= '{$EndDate}' AND(b.StopDate IS NULL OR b.StopDate = '0000-00-00' OR b.StopDate >= '{$StartDate}')";

        if (!empty($department_id)) {
            $query .= " AND b.DepartmentID = '{$department_id}'";
        }
        if (!empty($company_id)) {
            $query .= " AND b.CompanyID = '{$company_id}'";
        }
        if (!empty($_GET['Status'])) {
            $query .= " AND a.Status = '{$_GET['Status']}'";
        }

        $query .= " ORDER  BY a.FullName";

        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $persons[$row['PersonID']] = $row;
        }

        $benefits = array();
        $query = "SELECT a.PersonID, a.RegDate, a.EndDate
		      FROM   persons_beneficii a
		      WHERE  a.Type = 4 AND
		             ((a.RegDate <= '{$EndDate}') OR
		              (a.EndDate >= '{$StartDate}' OR a.EndDate IS NULL OR a.EndDate = '0000-00-00') OR
		              ('{$StartDate}' BETWEEN a.RegDate AND a.EndDate))
                            AND a.PersonID IN ('" . implode("','", array_keys($persons)) . "')
		      ORDER  BY a.RegDate";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $benefits[$row['PersonID']][] = $row;
        }

        $vacations = array();
        $query = "SELECT a.PersonID, a.StartDate, a.StopDate FROM vacations_details a
                            WHERE a.Aprove = 1 AND a.Type != 'INV' AND a.StartDate <= '{$MonthEnd}' AND a.StopDate >= '{$PMonthStart}'";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $vacations[$row['PersonID']][] = $row;
        }
        //temporary fix
        $inv = array();
//            $query = "SELECT a.PersonID, SUM(a.HoursNo) AS Hours FROM vacations_details a
//                            WHERE a.Aprove = 1 AND a.Type = 'INV' AND a.StartDate <= '{$MonthEnd}' AND a.StopDate >= '{$PMonthStart}' GROUP BY a.PersonID";
//            $conn->query($query);
//            while($row = $conn->fetch_array()){
//                $inv[$row['PersonID']] = round($row['Hours'], 2);
//            }

        $query = "SELECT PersonID, SUM(DaysNo) as DaysNo FROM persons_invoiri WHERE StartDate BETWEEN '{$StartDate}' AND '{$EndDate}' GROUP BY PersonID";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $inv[$row['PersonID']] = $row['DaysNo'];
        }

        $displacements = array();
        $query = "SELECT a.PersonID, a.StartDate, a.StopDate FROM persons_displacement a
                            WHERE a.StartDate <= '{$EndDate}' AND a.StopDate >= '{$StartDate}'";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $displacements[$row['PersonID']][] = $row;
        }

        foreach ($persons as $PersonID => $person) {
            //$wdays = 0;
            $vdays = 0;
            $xvdays = 0;
            $pvdays = 0;
            $ddays = 0;
            $udays = 0;
//                $benefit_days = array();
            $days = $days_period = $days_month = $days_period_month = array();
            $benefit_range = array();
            if (!empty($benefits[$PersonID]))
                foreach ($benefits[$PersonID] as $benefit) {
                    $Start = $MonthStart;
                    $End = $MonthEnd;

                    if (strtotime($benefit['RegDate']) > strtotime($Start)) {
                        $Start = date('Y-m-d', strtotime($benefit['RegDate']));
                    }
                    if (!empty($benefit['EndDate']) && $benefit['EndDate'] != '0000-00-00' && strtotime($benefit['EndDate']) < strtotime($End)) {
                        $End = date('Y-m-d', strtotime($benefit['EndDate']));
                    }
                    if (strtotime($person['StartDate']) > strtotime($Start)) {
                        $Start = date('Y-m-d', strtotime($person['StartDate']));
                    }
                    if (!emptY($person['StopDate']) && $person['StopDate'] != '0000-00-00' && strtotime($person['StopDate']) < strtotime($End)) {
                        $End = date('Y-m-d', strtotime($person['StopDate']));
                    }
                    if (!empty($person['ContractExpDate']) && $person['ContractExpDate'] != '0000-00-00' && strtotime($person['ContractExpDate']) < strtotime($End) && $person['ContractType'] == 1) {
                        $End = date('Y-m-d', strtotime($person['ContractExpDate']));
                    }

                    // Add
                    //echo $person['SuspendDate'];
                    //$wdays += Utils::getDaysDiff($Start, $End, true, true, null, null, array(array('Start'=>$person['SuspendDate'],'Stop'=>$person['ReturnDate'])));
                    $benefit_range[] = array('Start' => $benefit['RegDate'], 'Stop' => $End);

                    $Start = $StartDate;
                    $End = $EndDate;

                    if (strtotime($benefit['RegDate']) > strtotime($Start)) {
                        $Start = date('Y-m-d', strtotime($benefit['RegDate']));
                    }
                    if (!empty($benefit['EndDate']) && $benefit['EndDate'] != '0000-00-00' && strtotime($benefit['EndDate']) < strtotime($End)) {
                        $End = date('Y-m-d', strtotime($benefit['EndDate']));
                    }
                    if (strtotime($person['StartDate']) > strtotime($Start)) {
                        $Start = date('Y-m-d', strtotime($person['StartDate']));
                    }
                    if (!emptY($person['StopDate']) && $person['StopDate'] != '0000-00-00' && strtotime($person['StopDate']) < strtotime($End)) {
                        $End = date('Y-m-d', strtotime($person['StopDate']));
                    }
                    if (!emptY($person['ContractExpDate']) && $person['ContractExpDate'] != '0000-00-00' && strtotime($person['ContractExpDate']) < strtotime($End) && $person['ContractType'] == 1) {
                        $End = date('Y-m-d', strtotime($person['ContractExpDate']));
                    }
                    $pdays = Utils::getDaysDiff($Start, $End);
                }

            if (!empty($vacations[$PersonID])) {
                foreach ($vacations[$PersonID] as $vacation) {
                    $Start = $vacation['StartDate'];
                    $End = $vacation["StopDate"];
                    if (strtotime($Start) < strtotime($PMonthStart)) {
                        $Start = $PMonthStart;
                    }
                    if (strtotime($End) > strtotime(($MonthEnd))) {
                        $End = $MonthEnd;
                    }
                    $days = array_merge($days, Utils::getDaysList($Start, $End, true, true, null, null, $benefit_range));
                }
                $days = array_unique($days);
                foreach ($days as $day) {
                    if (strtotime($day) >= strtotime($PMonthStart) && strtotime($day) <= strtotime($PMonthEnd)) {
                        $days_period_month[] = $day;
                    }
                    if (strtotime($day) >= strtotime($StartDate) && strtotime($day) <= strtotime($EndDate)) {
                        $days_period[] = $day;
                    }
                    if (strtotime($day) >= strtotime($MonthStart) && strtotime($day) <= strtotime($MonthEnd)) {
                        $days_month[] = $day;
                    }
                }
            }

            if (!empty($displacements[$PersonID]))
                foreach ($displacements[$PersonID] as $displacement) {
                    $dStart = $Start = $displacement['StartDate'];
                    $End = $displacement["StopDate"];
                    $skip = false;
                    $back_do = false;
                    if (strtotime($Start) < strtotime($StartDate)) {
                        $Start = $StartDate;
                        $back_do = true;
                    }
                    if (strtotime($End) > strtotime(($EndDate))) {
                        $End = $EndDate;
                        $skip = true;
                    }

                    $diff = Utils::getDateTimeDiff($Start, $End, true, true, null, null, null, $benefit_range);
                    $ddays += $diff['days'];

                    //if($diff['h']>=12 && !$skip){ //CMU: why this condition???
                    if ($diff['h'] >= 12) {
                        $ddays++;
                    }
                    if ($back_do) {
                        $back_diff = Utils::getDateTimeDiff($dStart, $Start, true, true, null, null, null, $benefit_range);
                        if ($back_diff['h'] >= 12) {
                            $ddays++;
                        }
                    }

                }


            if ($wdays - count($days_month) < 1) {
                if ($pwdays - count($days_period_month) < 1) {
                    $persons[$PersonID]['tickets'] = 0;
                } else {
                    $persons[$PersonID]['tickets'] = 0 - count(array_intersect($days_period_month, $days_period));
                }
            } else {
                if ($pwdays - count($days_period_month) < 1) {
                    $persons[$PersonID]['tickets'] = $wdays - count(array_intersect($days_period, $days_month));
                } else {
                    $persons[$PersonID]['tickets'] = $wdays - count($days_period);
                }
            }
            $persons[$PersonID]['tickets'] -= $ddays;
//                $persons[$PersonID]['tickets'] -= intval($inv[$PersonID]/8);
            $persons[$PersonID]['tickets'] -= $inv[$PersonID];
            if ($persons[$PersonID]['tickets'] < 0) {
                $persons[$PersonID]['tickets'] = 0;
            }
            $persons['TicketsTotal'] += $persons[$PersonID]['tickets'];

            $persons[$PersonID]['wdays'] = $wdays;
            $persons[$PersonID]['vdays'] = count($days_period);
            $persons[$PersonID]['ddays'] = $ddays;
            $persons[$PersonID]['udays'] = $udays;
            $persons[$PersonID]['pdays'] = $pdays;
            $persons[$PersonID]['invdays'] = $inv[$PersonID];
        }

        return array(array($month, $year), $persons);
    }

    public static function getReports_116()
    {
        global $conn;

        $persons = array();
        $company_id = !empty($_GET['CompanyID']) ? (int)$_GET['CompanyID'] : '';
        $department_id = !empty($_GET['DepartmentID']) ? (int)$_GET['DepartmentID'] : '';
        $departments = Utils::getDepartments();
        $internal_functions = Utils::getInternalFunctions();

        $order_by = !empty($_GET['order_by']) ? $conn->real_escape_string($_GET['order_by']) : 'a.FullName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        $query = "SELECT a.PersonID, a.FullName, b.StartDate AS DataAng, b.DepartmentID, b.ContractProbationPeriod, b.InternalFunction, DATE_FORMAT(DATE_ADD(DATE(b.StartDate), INTERVAL b.ContractProbationPeriod-1 DAY), '%Y-%m-%d') AS ContractProbationEnd
                        FROM persons a 
                        INNER JOIN payroll b ON b.PersonID = a.PersonID
                        WHERE DATE_ADD(b.StartDate, INTERVAL b.ContractProbationPeriod-1 DAY) >= DATE_FORMAT(NOW(), '%Y-%m-%d')
							AND a.Status NOT IN (5, 6)
							AND b.StartDate <= CURDATE()";

        if (!empty($company_id)) {
            $query .= " AND b.CompanyID = $company_id";
        }
        if (!empty($department_id)) {
            $query .= " AND b.DepartmentID = $department_id";
        }
        if (!empty($_GET['Status'])) {
            $query .= " AND a.Status = '{$_GET['Status']}'";
        }
        if (!empty($_GET['ContractType'])) {
            $query .= " AND b.ContractType = '{$_GET['ContractType']}'";
        }

        $query .= " ORDER BY {$order_by} {$asc_or_desc}";

        $conn->query($query);

        while ($row = $conn->fetch_array()) {
            $row['Department'] = $departments[$row['DepartmentID']];
            $row['InternalFunctionName'] = $internal_functions[$row['InternalFunction']];
            $row['StartDate'] = Utils::toDisplayDate($row['DataAng']);
            $row['ProbaEnd'] = Utils::toDisplayDate($row['ContractProbationEnd']);
            $row['RemDays'] = Utils::getDaysDiff(date('Y-m-d'), $row['ContractProbationEnd'], false, false);
            $persons[$row['PersonID']] = $row;
        }

        return $persons;
    }

    static function getReports_117()
    {
        global $conn;

        $persons = array();
        $sums = array();
        $totals = array();
        $year = !empty($_GET['Year']) ? (int)$_GET['Year'] : date('Y');
        $end_month = !empty($_GET['Month']) ? (int)$_GET['Month'] : date('m');
        $start_month = !empty($_GET['PrevMonths']) ? 1 : $end_month;
        $company_id = !empty($_GET['CompanyID']) ? (int)$_GET['CompanyID'] : '';
        $department_id = !empty($_GET['DepartmentID']) ? (int)$_GET['DepartmentID'] : '';
        $departments = Utils::getDepartments();
        $type = !empty($_GET['SalaryType']) ? (int)$_GET['SalaryType'] : 1;
        $listed_departments = array();
        $persons_totals = array();
        $sums_totals = array();
        $totals_totals = array();

        $order_by = !empty($_GET['order_by']) ? $conn->real_escape_string($_GET['order_by']) : 'a.FullName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        for ($month = $start_month; $month <= $end_month; $month++) {
            $totals = array();
            $sums = array();
            #start main query
            $query = 'SELECT a.PersonID, b.DepartmentID, a.FullName';

            #Month salary
            $query .= ", (SELECT Salary" . ($type == 2 ? "Net" : "") . "*(IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '{$year}'), 1)) FROM persons_salary WHERE PersonID = a.PersonID AND StartDate <= '" . date('Y-m-t', strtotime($year . "-" . $month . "-01")) . "' ORDER BY StartDate DESC LIMIT 1) as MonthSalary";

            #Bonuses
            $query .= ", (SELECT SUM(Salary" . ($type == 2 ? "Net" : "") . "*(IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '{$year}'), 1))) FROM persons_salary_extra WHERE PersonID = a.PersonID AND (Type = 'bonus' OR Type='bonus_sales' OR Type='bonus_natura') AND StartDate >= '" . date('Y-m-d', strtotime($year . "-" . $month . "-01")) . "' AND StartDate <= '" . date('Y-m-t', strtotime($year . "-" . $month . "-01")) . "') AS SBonus";

            #Premiums
            $query .= ", (SELECT SUM(Salary" . ($type == 2 ? "Net" : "") . "*(IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '{$year}'), 1))) FROM persons_salary_extra WHERE PersonID = a.PersonID AND Type = 'bonus_prime' AND StartDate >= '" . date('Y-m-d', strtotime($year . "-" . $month . "-01")) . "' AND StartDate <= '" . date('Y-m-t', strtotime($year . "-" . $month . "-01")) . "') AS SPremium";

            # Persons
            $query .= " FROM persons a
                            JOIN payroll b ON b.PersonID = a.PersonID 
                            				WHERE (YEAR(b.StartDate) < '{$year}' OR b.StartDate <= '" . date('Y-m-t', strtotime($year . "-" . $month . "-01")) . "')
                                            AND (b.StopDate = '0000-00-00' 
                                                OR b.StopDate IS NULL 
                                                OR YEAR(b.StopDate) > '{$year}'
                                                OR b.StopDate < '" . (($month < 12 ? $year : $year + 1) . "-" . ($month < 9 ? "0" : "") . ($month < 12 ? $month + 1 : "01") . "-01") . "'
                                                ) " . (!empty($company_id) ? " AND b.CompanyID = '{$company_id}'" : "") . " 
                                                " . (!empty($department_id) ? " AND b.DepartmentID = '{$department_id}'" : "") . " 
                                                " . (!empty($_SESSION['PERS']) && !in_array($_SESSION['USER_ID'], array(27, 30)) ? " AND a.PersonID = '{$_SESSION['PERS']}'" : "") . "
                                                ORDER BY {$order_by} {$asc_or_desc}";


            $conn->query($query);

            while ($row = $conn->fetch_array()) {
                $row['MonthSalary'] = round($row['MonthSalary'], 0);
                $sums[$row['DepartmentID']]['MonthSalary'] += $row['MonthSalary'];
                $totals['MonthSalary'] += $row['MonthSalary'];
                $sums_totals[$row['DepartmentID']]['MonthSalary'] += $row['MonthSalary'];
                $totals_totals['MonthSalary'] += $row['MonthSalary'];

                $row['Department'] = $departments[$row['DepartmentID']];

                !isset($sums[$row['DepartmentID']]['Name']) ? $sums[$row['DepartmentID']]['Name'] = $row['Department'] : '';

                $row['SBonus'] = round($row['SBonus'], 0);
                $sums[$row['DepartmentID']]['SBonus'] += $row['SBonus'];
                $totals['SBonus'] += $row['SBonus'];
                $sums_totals[$row['DepartmentID']]['SBonus'] += $row['SBonus'];
                $totals_totals['SBonus'] += $row['SBonus'];

                $row['SPremium'] = round($row['SPremium'], 0);
                $sums[$row['DepartmentID']]['SPremium'] += $row['SPremium'];
                $totals['SPremium'] += $row['SPremium'];
                $sums_totals[$row['DepartmentID']]['SPremium'] += $row['SPremium'];
                $totals_totals['SPremium'] += $row['SPremium'];


                $persons[$row['PersonID']] = $row;
            }


            $conn->query("SELECT company_settings FROM settings");
            $company_settings = ($row = $conn->fetch_array()) && !empty($row['company_settings']) ? unserialize($row['company_settings']) : array();

            foreach ($persons as $key => $value) {
                $person_ot = 0;
                $stat = Pontaj::getPersonDetailStat($key, date('Y-m-d', strtotime($year . "-" . $month . "-01")), date('Y-m-t', strtotime($year . "-" . $month . "-01")));
                $wd = ceil($stat['NormalHours'] / 8);
                $hsal = $value['MonthSalary'] / 168;
                $person_ot += $stat['SplHours'] * $hsal * (($company_settings['pontaj']['proc_normal'] + 100) / 100);
                $person_ot += $stat['NightHours'] * $hsal * (($company_settings['pontaj']['proc_normal'] + 100) / 100);
                $person_ot += $stat['LegalHours'] * $hsal * (($company_settings['pontaj']['proc_normal'] + 100) / 100);
                $person_ot += $stat['WkHours'] * $hsal * (($company_settings['pontaj']['proc_normal'] + 100) / 100);

                $persons[$key]['OT'] = round($person_ot, 0);

                $sums[$value['DepartmentID']]['OT'] += $persons[$key]['OT'];
                $totals['OT'] += $persons[$key]['OT'];

                $sums_totals[$value['DepartmentID']]['OT'] += $persons[$key]['OT'];
                $totals_totals['OT'] += $persons[$key]['OT'];

                $persons[$key]['FinancialBenefits'] = $persons[$key]['MonthSalary'] + $persons[$key]['OT'] + $persons[$key]['SBonus'] + $persons[$key]['SPremium'];

                $sums[$value['DepartmentID']]['FinancialBenefits'] += $persons[$key]['FinancialBenefits'];
                $sums_totals[$value['DepartmentID']]['FinancialBenefits'] += $persons[$key]['FinancialBenefits'];

                $listed_departments[$value['DepartmentID']] = $departments[$value['DepartmentID']];

                $totals['FinancialBenefits'] += $persons[$key]['FinancialBenefits'];
                $totals_totals['FinancialBenefits'] += $persons[$key]['FinancialBenefits'];


                $persons_totals[$key]['MonthSalary'] += $value['MonthSalary'];
                $persons_totals[$key]['SBonus'] += $value['SBonus'];
                $persons_totals[$key]['SPremium'] += $value['SPremium'];
                $persons_totals[$key]['OT'] += $persons[$key]['OT'];
                $persons_totals[$key]['FinancialBenefits'] += $persons[$key]['FinancialBenefits'];

            }
            $monthly_financial[0] = array($persons, $listed_departments, $persons_totals, $sums_totals, $totals_totals);
            $monthly_financial[$month] = array($persons, $sums, $totals);
            //$monthly_financial[$month]= array($persons);
        }
        //Utils::pa($monthly_financial);
        return $monthly_financial;

    }

    public static function getReports_118()
    {
        global $conn;

        $tickets = array();
        if (!empty($_GET['StartDate']) && !empty($_GET['EndDate'])) {
            $StartDate = date('Y-m-d', strtotime($_GET['StartDate']));
            $EndDate = date('Y-m-d', strtotime($_GET['EndDate']));

            $company_id = (int)$_GET['CompanyID'];
            $status = (int)$_GET['Status'];
            $type = (int)$_GET['Type'];
            $interventionType = (int)$_GET['InterventionType'];
            $person = (int)$_GET['PersonID'];
            $order_by = !empty($_GET['order_by']) ? $conn->real_escape_string($_GET['order_by']) : 'a.TicketID';
            $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'desc';

            $query = "SELECT a.TicketID, a.CompanyID, d.CompanyName, a.AssignedPersonID, b.FullName, a.Status, a.Type, a.ContactID, c.ContactName, a.CreateDate 
                                FROM ticketing a
                                LEFT JOIN persons b ON b.PersonID = a.AssignedPersonID
                                LEFT JOIN companies_contacts c ON c.ContactID = a.ContactID
                                LEFT JOIN companies d ON d.CompanyID = a.CompanyID
                                WHERE a.CreateDate BETWEEN '{$StartDate}' AND '{$EndDate}'";


            if (!empty($company_id)) {
                $query .= " AND a.CompanyID = '{$company_id}'";
            }
            if (!empty($status)) {
                $query .= " AND a.Status = '{$status}'";
            }
            if (!empty($type)) {
                $query .= " AND a.Type = '{$type}'";
            }
            if (!empty($interventionType)) {
                $query .= " AND a.InterventionType = '{$interventionType}'";
            }
            if (!empty($person)) {
                $query .= " AND a.AssignedPersonID = '{$person}'";
            }

            $query .= " ORDER BY {$order_by} {$asc_or_desc}";

            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $row['StatusName'] = ConfigData::$msTicketingStatus[$row['Status']];
                $row['TypeName'] = ConfigData::$msTicketingType[$row['Type']];
                $row['CreateDate'] = date('d-m-Y', strtotime($row['CreateDate']));
                $row['History'] = array();
                $row['HistoryCount'] = 0;
                $tickets[$row['TicketID']] = $row;
            }

            $query = "SELECT a.*, b.FullName,
	                     CASE WHEN a.PID > 0 THEN (SELECT FullName FROM persons WHERE PersonID = a.PID) ELSE (SELECT UserName FROM users WHERE UserID = a.UserID) END AS FullNameLast
	              FROM   ticketing_history a
		             LEFT JOIN persons b ON a.AssignedPersonID = b.PersonID
		      WHERE  a.TicketID IN ('" . implode("','", array_keys($tickets)) . "')
		      ORDER  BY a.ID";

            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $row["StatusName"] = ConfigData::$msTicketingStatus[$row['Status']];
                $row['Comment'] = nl2br($row['Comment']);
                $tickets[$row['TicketID']]['History'][] = $row;
                $tickets[$row['TicketID']]['HistoryCount']++;
            }
            $sums['TicketCount'] = count($tickets);
        }
        return array($tickets, $sums);
    }

    public static function getReports_119()
    {
        global $conn;

        $tickets = array();
        $sums = array();
        if (!empty($_GET['StartDate']) && !empty($_GET['EndDate'])) {
            $StartDate = date('Y-m-d', strtotime($_GET['StartDate']));
            $EndDate = date('Y-m-d', strtotime($_GET['EndDate'])) . " 23:59:59";

            $company_id = (int)$_GET['CompanyID'];
            $status = (int)$_GET['Status'];
            $type = (int)$_GET['Type'];
            $interventionType = (int)$_GET['InterventionType'];
            $person = (int)$_GET['PersonID'];
            $order_by = !empty($_GET['order_by']) ? $conn->real_escape_string($_GET['order_by']) : 'a.TicketID';
            $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'desc';

            $query = "SELECT a.TicketID, a.CompanyID, d.CompanyName, a.AssignedPersonID, b.FullName, a.Status, a.Type, a.ContactID, c.ContactName, a.CreateDate, a.TransportTime, a.InterventionType, TIMEDIFF(a.InterventionEndDate, a.InterventionStartDate) AS InterventionDuration 
                                FROM ticketing a
                                LEFT JOIN persons b ON b.PersonID = a.AssignedPersonID
                                LEFT JOIN companies_contacts c ON c.ContactID = a.ContactID
                                LEFT JOIN companies d ON d.CompanyID = a.CompanyID
                                WHERE a.CreateDate BETWEEN '{$StartDate}' AND '{$EndDate}'";


            if (!empty($company_id)) {
                $query .= " AND a.CompanyID = '{$company_id}'";
            }
            if (!empty($status)) {
                $query .= " AND a.Status = '{$status}'";
            }
            if (!empty($type)) {
                $query .= " AND a.Type = '{$type}'";
            }
            if (!empty($interventionType)) {
                $query .= " AND a.InterventionType = '{$interventionType}'";
            }
            if (!empty($person)) {
                $query .= " AND a.AssignedPersonID = '{$person}'";
            }

            $query .= " ORDER BY {$order_by} {$asc_or_desc}";

            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $row['StatusName'] = ConfigData::$msTicketingStatus[$row['Status']];
                $row['TypeName'] = ConfigData::$msTicketingType[$row['Type']];
                $row['CreateDate'] = date('d-m-Y', strtotime($row['CreateDate']));
                $row['InterventionTypeName'] = ConfigData::$msTicketingInterventionType[$row['InterventionType']];
                $intervention = explode(":", $row["InterventionDuration"]);
                $sums['InterventionDuration'] += $intervention[0] * 3600 + $intervention[1] * 60 + $intervention[2];

                $sums['TransportTime'] += $row["TransportTime"];
                $tickets[$row['TicketID']] = $row;
            }

            $intervention_h = floor($sums['InterventionDuration'] / 3600);
            $intervention_m = floor(($sums['InterventionDuration'] % 3600) / 60);
            $intervention_s = $sums['InterventionDuration'] - $intervention_h * 3600 - $intervention_m * 60;
            $sums['InterventionDuration'] = ((strlen($intervention_h) < 2 ? "0" : "") . $intervention_h) . ":" . ((strlen($intervention_m) < 2 ? "0" : "") . $intervention_m) . ":" . ((strlen($intervention_s < 2) ? "0" : "") . $intervention_s);
            $sums['TicketCount'] = count($tickets);
        }

        return array($tickets, $sums);
    }

    public static function getReports_120()
    {
        global $conn;

        $contracts = array();

        $StartDate = !empty($_GET['StartDate']) ? date('Y-m-d', strtotime($_GET['StartDate'])) : '';
        $EndDate = !empty($_GET['EndDate']) ? date('Y-m-d', strtotime($_GET['EndDate'])) . " 23:59:59" : '';

        $company_id = (int)$_GET['CompanyID'];
        $resp_financiar = (int)$_GET['FinanciarID'];
        $resp_tehnic = (int)$_GET['TehnicID'];
        $status = (int)$_GET['Status'];
        $self = (int)$_GET['Self'];

        $order_by = !empty($_GET['order_by']) ? $conn->real_escape_string($_GET['order_by']) : 'c.PayDate, ben.CompanyName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        $query = " SELECT c.ContractID, c.Status, c.PaymentType, ben.CompanyName, ben.CompanyEmail, furn.CompanyName as FurnizorName, p_fin.FullName as resp_financiar, p_teh.FullName as resp_tehnic, c.ContractValue, c.Coin, c.PayDate, 
					adr.StreetName, adr.StreetCode, adr.StreetNumber, adr.Bl, adr.Sc, adr.Et, adr.Ap,
					oras.CityName AS CompanyOras, jud.DistrictName as CompanyJudet 
						FROM contract c
						LEFT JOIN contract_persons cp_fin ON cp_fin.ContractID = c.ContractID AND cp_fin.PersonType = 1
						LEFT JOIN persons p_fin ON cp_fin.PersonID = p_fin.PersonID  
						LEFT JOIN contract_persons cp_teh ON cp_teh.ContractID = c.ContractID AND cp_teh.PersonType = 2
						LEFT JOIN persons p_teh ON cp_teh.PersonID = p_teh.PersonID ";

        if ($self == 1) {
            $query .= "LEFT JOIN companies ben ON ben.CompanyID = c.CompanyID 
						LEFT JOIN companies furn ON furn.CompanyID = c.PartnerID 
						LEFT JOIN companies_locations comp_loc ON comp_loc.CompanyID = c.PartnerID
						LEFT JOIN address adr ON comp_loc.AddressID = adr.AddressID AND adr.DeliveryAddress = 1
						LEFT JOIN address_city oras ON oras.CityID = adr.CityID
						LEFT JOIN address_district jud ON jud.DistrictID = oras.DistrictID ";
        } else {
            $query .= "LEFT JOIN companies ben ON ben.CompanyID = c.PartnerID 
						LEFT JOIN companies furn ON furn.CompanyID = c.CompanyID
						LEFT JOIN companies_locations comp_loc ON comp_loc.CompanyID = c.PartnerID
						LEFT JOIN address adr ON comp_loc.AddressID = adr.AddressID AND adr.DeliveryAddress = 1
						LEFT JOIN address_city oras ON oras.CityID = adr.CityID
						LEFT JOIN address_district jud ON jud.DistrictID = oras.DistrictID ";
        }
        $query .= " WHERE 1=1 ";

        if ($self == 1) {
            $query .= " AND c.CompanyRole = 'Beneficiar' ";
        } else {
            $query .= " AND c.CompanyRole = 'Furnizor' ";
        }

        if (!empty($StartDate)) {
            $query .= " AND c.CreateDate > '{$StartDate}' ";
        }
        if (!empty($EndDate)) {
            $query .= " AND '{$EndDate}' ";
        }
        if (!empty($company_id)) {
            if ($self == 1)
                $query .= " AND c.CompanyID = {$company_id} ";
            else
                $query .= " AND c.PartnerID = {$company_id} ";
        }
        if (!empty($resp_financiar)) {
            $query .= " AND cp_fin.PersonID = {$resp_financiar} ";
        }
        if (!empty($resp_tehnic)) {
            $query .= " AND cp_teh.PersonID = {$resp_tehnic} ";
        }
        if (!empty($status)) {
            $query .= " AND c.Status = {$status} ";
        }

        $query .= " GROUP BY c.ContractID 
						ORDER BY {$order_by} {$asc_or_desc} ";

        $conn->query($query);

        while ($row = $conn->fetch_array()) {
            $CompanyAddress = '';
            if ($row['StreetName']) $CompanyAddress .= 'Strada: ' . $row['StreetName'];
            if ($row['StreetCode']) $CompanyAddress .= ', Cod postal: ' . $row['StreetCode'];
            if ($row['StreetNumber']) $CompanyAddress .= ', Numar: ' . $row['StreetNumber'];
            if ($row['Bl']) $CompanyAddress .= ', Bl: ' . $row['Bl'];
            if ($row['Sc']) $CompanyAddress .= ', Sc: ' . $row['Sc'];
            if ($row['Et']) $CompanyAddress .= ', Et: ' . $row['Et'];
            if ($row['Ap']) $CompanyAddress .= ', Ap: ' . $row['Ap'];
            if ($row['CompanyOras']) $CompanyAddress .= ', Oras: ' . $row['CompanyOras'];
            if ($row['CompanyJudet']) $CompanyAddress .= ', Judet: ' . $row['CompanyJudet'];

            $row['BeneficiarAddress'] = $CompanyAddress;
            if ($row['PayDate'] != '' && $row['PayDate'] != '0000-00-00') {
                $row['PayDate'] = date('d-m-Y', strtotime($row['PayDate']));
            } else {
                $row['PayDate'] = '';
            }

            $paymentType = ($row['PaymentType'] == 1) ? 4 : $row['PaymentType']; //daca e plata integrala atunci consider plata in rate (o singura rata)
            $contracts[$paymentType][$row['ContractID']] = $row;
        }

        $lstContracts = array();
        if (isset($contracts[3])) {
            $lstContracts[3] = $contracts[3]; //plata trimestriala
        }
        if (isset($contracts[2])) {
            $lstContracts[2] = $contracts[2]; //abonament lunar
        }
        if (isset($contracts[4])) {
            $lstContracts[4] = $contracts[4]; //plata in rate (+integrala)
        }
        return $lstContracts;
    }

    public static function getReports_123()
    {
        global $conn;

        $company_id = (int)$_GET['CompanyID'];
        $department_id = (int)$_GET['DepartmentID'];
        $department_id = (int)$_GET['DepartmentID'];
        $year = (int)$_GET['Year'];
        $month = (int)$_GET['Month'];
        $payment_type = (int)$_GET['SalaryPaymentType'];

        $persons = array();

        if (!empty($year) && !empty($month) && !empty($payment_type)) {

            $query = "SELECT a.PersonID, a.FullName, b.WorkNorm, c.BankAccount";

            #Month salary

            $query .= ", (SELECT SalaryNet*(IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '{$year}'), 1)) FROM persons_salary WHERE PersonID = a.PersonID AND StartDate <= '" . date('Y-m-t', strtotime($year . "-" . $month . "-01")) . "' ORDER BY StartDate DESC LIMIT 1) as MonthSalary";

            if ($payment_type == 1) {
                #Bonuses

                $query .= ", (SELECT SUM(SalaryNet*(IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '{$year}'), 1))) FROM persons_salary_extra WHERE PersonID = a.PersonID AND (Type = 'bonus' OR Type='bonus_sales' OR Type='bonus_natura') AND StartDate >= DATE_SUB('" . date('Y-m-d', strtotime($year . "-" . $month . "-01")) . "', INTERVAL 1 MONTH) AND StartDate <= DATE_SUB('" . date('Y-m-t', strtotime($year . "-" . $month . "-01")) . "', INTERVAL 1 MONTH)) AS SBonus";

                #Premiums

                $query .= ", (SELECT SUM(SalaryNet*(IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '{$year}'), 1))) FROM persons_salary_extra WHERE PersonID = a.PersonID AND Type = 'bonus_prime' AND StartDate >= DATE_SUB('" . date('Y-m-d', strtotime($year . "-" . $month . "-01")) . "', INTERVAL 1 MONTH) AND StartDate <= DATE_SUB('" . date('Y-m-t', strtotime($year . "-" . $month . "-01")) . "', INTERVAL 1 MONTH)) AS SPremium";
            }

            if ($payment_type == 1) {
                $start_limit = date('Y-m-d', strtotime("$year-$month-01"));
                $end_limit = date('Y-m-d', strtotime("$year-$month-15"));
            } else {
                $start_limit = date('Y-m-d', strtotime("$year-$month-16"));
                $end_limit = date('Y-m-t', strtotime("$year-$month-01"));
            }

            $query .= " FROM persons a INNER JOIN payroll b ON b.PersonID = a.PersonID
                                INNER JOIN banks c ON c.BankID = b.BankID
                                WHERE b.StartDate <= '" . ($end_limit) . "'
                                    AND (b.StopDate IS NULL OR b.StopDate = '0000-00-00' OR b.StopDate >= '" . ($start_limit) . "')
                                    AND (b.ContractExpDate IS NULL OR b.ContractExpDate = '0000-00-00' OR b.ContractExpDate >= '" . (date('Y-m-d', strtotime("$year-$month-01"))) . "')";


            if (!empty($company_id)) {
                $query .= " AND b.CompanyID = '{$company_id}'";
            }
            if (!empty($department_id)) {
                $query .= " AND b.DepartmentID = '{$department_id}'";
            }

            $query .= " ORDER BY a.FullName";

            $conn->query($query);

            while ($row = $conn->fetch_array()) {
                if (!isset($row['SBonus'])) {
                    $row['SBonus'] = 0;
                } else {
                    $row['SBonus'] = round($row['SBonus'], 2);
                }
                if (!isset($row['SPremium'])) {
                    $row['SPremium'] = 0;
                } else {
                    $row['SPremium'] = round($row['SPremium'], 2);
                }
                $row['SalaryValue'] = round($row['MonthSalary'] / 2, 2);
                $row['OT'] = 0;
                $persons[$row['PersonID']] = $row;
            }

            if ($payment_type == 2) {
                $conn->query("SELECT company_settings FROM settings");
                $company_settings = ($row = $conn->fetch_array()) && !empty($row['company_settings']) ? unserialize($row['company_settings']) : array();
            }
            foreach ($persons as $PersonID => $person) {
                if ($payment_type == 2) {
                    $person_ot = 0;
                    $stats = Pontaj::getPersonDetailStat($PersonID, date('Y-m-d', strtotime("$year-$month-01")), date('Y-m-t', strtotime("$year-$month-01")));

                    $hsal = $person['MonthSalary'] / ($person['WorkNorm'] * 21);
                    $person_ot += $stats['SplHours'] * $hsal * (($company_settings['pontaj']['proc_normal'] + 100) / 100);
                    $person_ot += $stats['NightHours'] * $hsal * (($company_settings['pontaj']['proc_normal'] + 100) / 100);
                    $person_ot += $stats['LegalHours'] * $hsal * (($company_settings['pontaj']['proc_normal'] + 100) / 100);
                    $person_ot += $stats['WkHours'] * $hsal * (($company_settings['pontaj']['proc_normal'] + 100) / 100);

                    $persons[$PersonID]['OT'] = round($person_ot, 2);
                    $persons[$PersonID]['SalaryValue'] += $persons[$PersonID]['OT'];
                    $persons[$PersonID]['SalaryValue'] = number_format($persons[$PersonID]['SalaryValue'], 2, '.', '');
                } else {
                    $persons[$PersonID]['SalaryValue'] += $persons[$PersonID]['SBonus'];
                    $persons[$PersonID]['SalaryValue'] += $persons[$PersonID]['SPremium'];
                    $persons[$PersonID]['SalaryValue'] = number_format($persons[$PersonID]['SalaryValue'], 2, '.', '');
                }
            }

        }

        return $persons;
    }

    static function getReports_124()
    {
        global $conn;

        $persons = array();
        $sums = array();
        $totals = array();
        $year = !empty($_GET['Year']) ? (int)$_GET['Year'] : date('Y');
        $company_id = !empty($_GET['CompanyID']) ? (int)$_GET['CompanyID'] : '';
        $department_id = !empty($_GET['DepartmentID']) ? (int)$_GET['DepartmentID'] : '';
        $departments = Utils::getDepartments();
        $type = !empty($_GET['SalaryType']) ? (int)$_GET['SalaryType'] : 1;

        $order_by = !empty($_GET['order_by']) ? $conn->real_escape_string($_GET['order_by']) : 'a.FullName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        if (!empty($company_id)) {

            #start main q
            $query = 'SELECT a.PersonID, b.DepartmentID, a.FullName, b.StartDate, b.StopDate, b.ContractProbationPeriod';


            #Month salary

            $query .= ", (SELECT Salary" . ($type == 2 ? "Net" : "") . "*(IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '{$year}'), 1)) FROM persons_salary WHERE PersonID = a.PersonID AND StartDate <= '{$year}-12-31' ORDER BY StartDate DESC LIMIT 1) as MonthSalary";


            #Bonuses

            $query .= ", (SELECT SUM(Salary" . ($type == 2 ? "Net" : "") . "*(IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '{$year}'), 1))) FROM persons_salary_extra WHERE PersonID = a.PersonID AND (Type = 'bonus' OR Type='bonus_sales' OR Type='bonus_natura') AND StartDate >= '{$year}-01-01' AND StartDate <= " . ($year != date('Y') ? "'{$year}-12-31'" : "NOW()") . ") AS SBonus";

            #Premiums

            $query .= ", (SELECT SUM(Salary" . ($type == 2 ? "Net" : "") . "*(IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '{$year}'), 1))) FROM persons_salary_extra WHERE PersonID = a.PersonID AND Type = 'bonus_prime' AND StartDate >= '{$year}-01-01' AND StartDate <= " . ($year != date('Y') ? "'{$year}-12-31'" : "NOW()") . ") AS SPremium";


            $query .= " FROM persons a
                            JOIN payroll b ON b.PersonID = a.PersonID";

            $query .= " WHERE (b.StopDate IS NOT NULL AND b.StopDate != '0000-00-00' AND b.StopDate != '')
                            AND b.ContractProbationPeriod > 0
                            AND DATE_ADD(b.StartDate, INTERVAL b.ContractProbationPeriod DAY) >= b.StopDate
                            AND YEAR(b.StopDate) = '{$year}' AND b.CompanyID = '{$company_id}'";

            if (!empty($department_id)) {
                $query .= " AND b.DepartmentID = '{$department_id}'";
            }


            $query .= " ORDER BY {$order_by} {$asc_or_desc}";
            $conn->query($query);

            while ($row = $conn->fetch_array()) {
                $persons[$row['PersonID']] = $row;
            }


            if (!empty($persons)) {

                $benefits = array();

                $conn->query("SELECT TotalCost*IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '{$year}'), 1) AS RealValue, BenID, Type, TotalCost, Currency, PersonID, RegDate, EndDate FROM persons_beneficii WHERE Type IN (1,4,9,14) AND PersonID IN (" . implode(",", array_keys($persons)) . ") AND ((RegDate <= '{$year}-01-01' AND (EndDate >= '{$year}-01-01' OR EndDate = '0000-00-00')) OR (RegDate >= '{$year}-01-01' AND EndDate <= '{$year}-12-31') OR (EndDate <= '{$year}-12-31' AND (EndDate >= '{$year}-12-31' OR EndDate = '0000-00-00')))");

                while ($row = $conn->fetch_array()) {
                    $benefits[$row['Type']][$row['PersonID']][] = $row;
                }

                $trainings = array();

                $conn->query("SELECT IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '{$year}'), 1)*Cost AS RealValue, PersonID FROM trainings WHERE StartDate >= '{$year}-01-01' AND StartDate <= '{$year}-12-31' AND CompanyID = {$company_id} AND PersonID IN (" . implode(",", array_keys($persons)) . ")");

                while ($row = $conn->fetch_array()) {
                    $trainings[$row['PersonID']] += $row['RealValue'];
                }

                $displacements = array();

                $conn->query("SELECT IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '{$year}'), 1)*CostTotal AS RealValue, PersonID FROM persons_displacement WHERE StartDate >= '{$year}-01-01' AND StartDate <= '{$year}-12-31' AND PersonID IN (" . implode(",", array_keys($persons)) . ")");

                while ($row = $conn->fetch_array()) {
                    $displacements[$row['PersonID']] += $row['RealValue'];
                }

                $conn->query("SELECT company_settings FROM settings");
                $company_settings = ($row = $conn->fetch_array()) && !empty($row['company_settings']) ? unserialize($row['company_settings']) : array();

                foreach ($persons as $PersonID => $person) {
                    $months = array();
                    $smonth = date('Y-m', strtotime($person['StartDate']));
                    $emonth = date('Y-m', strtotime($person['StopDate']));
                    $months[$emonth] = array();
                    $limit = 0;
                    while ($smonth != $emonth && $limit < 10) {
                        $months[$smonth] = array();
                        $tmp = explode("-", $smonth);
                        $tmp[1] == 12 ? $tmp[1] = 1 : $tmp[1]++;
                        $tmp[1] = str_pad($tmp[1], 2, 0, STR_PAD_LEFT);
                        $smonth = implode("-", $tmp);
                        $limit++;
                    }
                    foreach (array_keys($months) as $month) {
                        $months[$month]['wdays'] = Utils::getDaysDiff($month . '-01', date('Y-m-t', strtotime($month . '-01')));
                        if ($month == date('Y-m', strtotime($person['StartDate']))) {
                            $months[$month]['pdays'] = Utils::getDaysDiff($person['StartDate'], date('Y-m-t', strtotime($month . '-01')));
                        } elseif ($month == date('Y-m', strtotime($person['StopDate']))) {
                            $months[$month]['pdays'] = Utils::getDaysDiff($month . '-01', $person['StopDate']);
                        } else {
                            $months[$month]['pdays'] = $months[$month]['wdays'];
                        }
                        $persons[$PersonID]['Salary'] += $person['MonthSalary'] / $months[$month]['wdays'] * $months[$month]['pdays'];


                        $persons[$PersonID]['Catering'] = 0;
                        if (!empty($benefits[9][$persons[$PersonID]['PersonID']])) {
                            foreach ($benefits[9][$persons[$PersonID]['PersonID']] as $catering) {
                                $persons[$PersonID]['Catering'] += $catering['RealValue'] / $months[$month]['wdays'] * $months[$month]['pdays'];
                            }
                            //                        $persons[$PersonID]['Catering'] = $persons[$PersonID]['Catering']*21;
                        }

                        $persons[$PersonID]['MealTickets'] = 0;
                        $persons[$PersonID]['TaxMealTickets'] = 0;
                        if (!empty($benefits[4][$persons[$PersonID]['PersonID']])) {
                            foreach ($benefits[4][$persons[$PersonID]['PersonID']] as $mealtickets) {
                                $persons[$PersonID]['MealTickets'] += $mealtickets['RealValue'] / $months[$month]['wdays'] * $months[$month]['pdays'];
                            }
                            //                        $persons[$PersonID]['MealTickets'] = $persons[$PersonID]['MealTickets']*21;
                            $persons[$PersonID]['TaxMealTickets'] = $persons[$PersonID]['MealTickets'] * 0.16;
                        }

                        $persons[$PersonID]['HealthIns'] = 0;
                        if (!empty($benefits[1][$persons[$PersonID]['PersonID']])) {
                            foreach ($benefits[1][$persons[$PersonID]['PersonID']] as $healthins) {
                                $persons[$PersonID]['HealthIns'] += $healthins['RealValue'];
                            }
                        }

                        $persons[$PersonID]['FamilyHealthIns'] = 0;
                        if (!empty($benefits[14][$persons[$PersonID]['PersonID']])) {
                            foreach ($benefits[14][$persons[$PersonID]['PersonID']] as $famhealthins) {
                                $persons[$PersonID]['FamilyHealthIns'] += $famhealthins['RealValue'];
                            }
                        }

                    }


                    $persons[$PersonID]['Salary'] = round($persons[$PersonID]['Salary'], 0);
                    $sums[$persons[$PersonID]['DepartmentID']]['Salary'] += $persons[$PersonID]['Salary'];
                    $totals['Salary'] += $persons[$PersonID]['Salary'];
                    $persons[$PersonID]['Department'] = $departments[$persons[$PersonID]['DepartmentID']];
                    !isset($sums[$persons[$PersonID]['DepartmentID']]['Name']) ? $sums[$persons[$PersonID]['DepartmentID']]['Name'] = $persons[$PersonID]['Department'] : '';


                    $persons[$PersonID]['SBonus'] = round($persons[$PersonID]['SBonus'], 0);
                    $sums[$persons[$PersonID]['DepartmentID']]['SBonus'] += $persons[$PersonID]['SBonus'];
                    $totals['SBonus'] += $persons[$PersonID]['SBonus'];

                    $persons[$PersonID]['SPremium'] = round($persons[$PersonID]['SPremium'], 0);
                    $sums[$persons[$PersonID]['DepartmentID']]['SPremium'] += $persons[$PersonID]['SPremium'];
                    $totals['SPremium'] += $persons[$PersonID]['SPremium'];


                    $persons[$PersonID]['Meal'] = $persons[$PersonID]['Catering'] + $persons[$PersonID]['MealTickets'];


                    $persons[$PersonID]['Catering'] = round($persons[$PersonID]['Catering'], 0);
                    $persons[$PersonID]['MealTickets'] = round($persons[$PersonID]['MealTickets'], 0);
                    $persons[$PersonID]['TaxMealTickets'] = round($persons[$PersonID]['TaxMealTickets'], 0);
                    $persons[$PersonID]['HealthIns'] = round($persons[$PersonID]['HealthIns'], 0);
                    $persons[$PersonID]['FamilyHealthIns'] = round($persons[$PersonID]['FamilyHealthIns'], 0);
                    $persons[$PersonID]['Meal'] = round($persons[$PersonID]['Meal'], 0);


                    $sums[$persons[$PersonID]['DepartmentID']]['Catering'] += $persons[$PersonID]['Catering'];
                    $sums[$persons[$PersonID]['DepartmentID']]['MealTickets'] += $persons[$PersonID]['MealTickets'];
                    $sums[$persons[$PersonID]['DepartmentID']]['TaxMealTickets'] += $persons[$PersonID]['TaxMealTickets'];
                    $sums[$persons[$PersonID]['DepartmentID']]['HealthIns'] += $persons[$PersonID]['HealthIns'];
                    $sums[$persons[$PersonID]['DepartmentID']]['FamilyHealthIns'] += $persons[$PersonID]['FamilyHealthIns'];
                    $sums[$persons[$PersonID]['DepartmentID']]['Meal'] += $persons[$PersonID]['Meal'];


                    $totals['Catering'] += $persons[$PersonID]['Catering'];
                    $totals['MealTickets'] += $persons[$PersonID]['MealTickets'];
                    $totals['TaxMealTickets'] += $persons[$PersonID]['TaxMealTickets'];
                    $totals['HealthIns'] += $persons[$PersonID]['HealthIns'];
                    $totals['FamilyHealthIns'] += $persons[$PersonID]['FamilyHealthIns'];
                    $totals['Meal'] += $persons[$PersonID]['Meal'];


                    $persons[$PersonID]['Trainings'] = round($trainings[$persons[$PersonID]['PersonID']], 0);
                    $persons[$PersonID]['Displacements'] = round($displacements[$persons[$PersonID]['PersonID']], 0);
                    $persons[$PersonID]['TotalInv'] = round($persons[$PersonID]['TotalInv'], 0);

                    $sums[$persons[$PersonID]['DepartmentID']]['Trainings'] += $persons[$PersonID]['Trainings'];
                    $sums[$persons[$PersonID]['DepartmentID']]['Displacements'] += $persons[$PersonID]['Displacements'];
                    $sums[$persons[$PersonID]['DepartmentID']]['TotalInv'] += $persons[$PersonID]['TotalInv'];

                    $totals['Trainings'] += $persons[$PersonID]['Trainings'];
                    $totals['Displacements'] += $persons[$PersonID]['Displacements'];
                    $totals['TotalInv'] += $persons[$PersonID]['TotalInv'];

                    $person_ot = 0;
                    $hsal = $person['MonthlySalary'] / 168;
                    $stats = Pontaj::getPersonDetailStat($PersonID, date('Y-m-d', strtotime($person['StartDate'])), date('Y-m-d', strtotime($person['StartDate'])));
                    $person_ot += $stats['SplHours'] * $hsal * (($company_settings['pontaj']['proc_normal'] + 100) / 100);
                    $person_ot += $stats['NightHours'] * $hsal * (($company_settings['pontaj']['proc_normal'] + 100) / 100);
                    $person_ot += $stats['LegalHours'] * $hsal * (($company_settings['pontaj']['proc_normal'] + 100) / 100);
                    $person_ot += $stats['WkHours'] * $hsal * (($company_settings['pontaj']['proc_normal'] + 100) / 100);


                    $persons[$PersonID]['OT'] = round($person_ot, 0);

                    $persons[$PersonID]['FinancialBenefits'] = $persons[$PersonID]['Salary'] + $persons[$PersonID]['OT'] + $persons[$PersonID]['SBonus'] + $persons[$PersonID]['TaxMealTickets'];
                    $persons[$PersonID]['NonFinancialBenefits'] = $persons[$PersonID]['Meal'] + $persons[$PersonID]['HealthIns'] + $persons[$PersonID]['FamilyHealthIns'];

                    $persons[$PersonID]['FinancialBenefits'] = round($persons[$PersonID]['FinancialBenefits'], 0);
                    $persons[$PersonID]['NonFinancialBenefits'] = round($persons[$PersonID]['NonFinancialBenefits'], 0);


                    $sums[$persons[$PersonID]['DepartmentID']]['FinancialBenefits'] += $persons[$PersonID]['FinancialBenefits'];
                    $sums[$persons[$PersonID]['DepartmentID']]['NonFinancialBenefits'] += $persons[$PersonID]['NonFinancialBenefits'];

                    $totals['FinancialBenefits'] += $persons[$PersonID]['FinancialBenefits'];
                    $totals['NonFinancialBenefits'] += $persons[$PersonID]['NonFinancialBenefits'];
                }
            }

        }
        return array($persons, $sums, $totals);
    }

    public static function getReports_125()
    {
        global $conn;


        $persons = array();
        $sums = array();
        $totals = array();


        if (!empty($_GET['StartDate']) && !empty($_GET['EndDate'])) {
            $StartDate = date('Y-m-d', strtotime($_GET['StartDate']));
            $EndDate = date('Y-m-d', strtotime($_GET['EndDate']));
            $department_id = (int)$_GET['DepartmentID'];
            $company_id = (int)$_GET['CompanyID'];
            $departments = Utils::getDepartments();


            $order_by = !empty($_GET['order_by']) ? $conn->real_escape_string($_GET['order_by']) : 'c.FullName';
            $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

            $query = "SELECT c.PersonID, d.DepartmentID, c.FullName, b.TrainingName, e.CompanyName, b.StartDate, b.StopDate, b.Hours, (IF(b.CostType = 'person', Cost, Cost/(SELECT COUNT(ID) FROM training_persons WHERE TrainingID = b.TrainingID))) AS PersonCost FROM training_persons a
                            INNER JOIN trainings b ON b.TrainingID = a.TrainingID
                            INNER JOIN persons c ON c.PersonID = a.PersonID
                            INNER JOIN payroll d ON d.PersonID = a.PersonID
                            LEFT JOIN companies e ON e.CompanyID = b.CompanyID
                            WHERE b.StopDate >= '{$StartDate}' AND b.StartDate <= '{$EndDate}'";

            if (!empty($company_id)) {
                $query .= " AND d.CompanyID = '{$company_id}'";
            }
            if (!empty($department_id)) {
                $query .= " AND d.DepartmentID = '{$department_id}'";
            }

            $query .= " ORDER BY {$order_by} {$asc_or_desc}";

            $conn->query($query);

            while ($row = $conn->fetch_array()) {
                $row['Department'] = $departments[$row['DepartmentID']];
                $row['PersonCost'] = round($row['PersonCost'], 2);

                $sums[$row['Department'] . "-" . $row['DepartmentID']]['PersonCost'] += $row['PersonCost'];
                $sums[$row['Department'] . "-" . $row['DepartmentID']]['Name'] = $departments[$row['DepartmentID']];
                $totals['PersonCost'] += $row['PersonCost'];

                $persons[$row['PersonID']] = $row;
            }
        }
        ksort($sums);
        return array($persons, $sums, $totals);
    }

    public static function getReports_126()
    {
        global $conn;

        $inventar = array();

        $StartDate = date('Y-m-d', strtotime($_GET['StartDate']));
        $EndDate = date('Y-m-d', strtotime($_GET['EndDate']));
        $company_id = (int)$_GET['CompanyID'];
        $department_id = (int)$_GET['DepartmentID'];
        $departments = Utils::getDepartments();
        $inventar_category_id = (int)$_GET['InventarCategoryID'];
        $token = explode(' ', $conn->real_escape_string($_GET['Token']));

        if (!empty($_GET['StartDate']) && !empty($_GET['EndDate'])) {
            $query = "SELECT a.*, b.ObjName, b.ObjCode, b.ObjAcqDate, b.ObjAcqValue, c.FullName, d.DepartmentID
                                FROM persons_inventar a 
                                JOIN inventar b ON b.ObjID = a.ObjID
                                LEFT JOIN persons c ON c.PersonID = a.PersonID
                                LEFT JOIN payroll d ON d.PersonID = c.PersonID
                                WHERE a.StartDate <= '{$EndDate}' AND (a.StopDate >= '{$StartDate}' OR a.StopDate = '0000-00-00' OR a.StopDate IS NULL) AND a.ObjType IN(1,2) ";

            if (!empty($company_id)) {
                $query .= " AND d.CompanyID = '{$company_id}'";
            }
            if (!empty($department_id)) {
                $query .= " AND d.DepartmentID = '{$department_id}'";
            }
            if (!empty($inventar_category_id)) {
                $query .= " AND b.ObjCategory = '{$inventar_category_id}'";
            }
            if (!empty($token)) {
                foreach ($token as $t) {
                    $query .= " AND (b.ObjName LIKE '%$t%' OR b.ObjCode LIKE '%$t%')";
                }
            }

            $query .= " ORDER BY a.ObjID, a.StartDate DESC";

            $conn->query($query);

            $list = array();

            while ($row = $conn->fetch_array()) {
                $row['Department'] = $departments[$row['DepartmentID']];
                $list[] = $row;
            }

            foreach ($list as $l) {
                $conn->query("SELECT e.PersonID, f.FullName, e.StartDate, e.StopDate FROM persons_inventar e LEFT JOIN persons f ON e.PersonID = f.PersonID WHERE e.ObjType IN(1,2) AND e.ObjID = '" . $l['ObjID'] . "' AND StartDate < '" . $l['StartDate'] . "' ORDER BY StartDate DESC LIMIT 1");
                $row = $conn->fetch_array();
                foreach ($row as $k => $v) {
                    $l['Prev' . $k] = $v;
                }
                $inventar[$l['ID']] = $l;
            }


        }

//            Utils::pa($inventar);exit;

        return $inventar;
    }

    public static function getReports_127()
    {
        global $conn;

        $StartDate = date('Y-m-d', strtotime($_GET['StartDate']));
        $EndDate = date('Y-m-d', strtotime($_GET['EndDate']));

        $company_id = (int)$_GET['CompanyID'];
        $department_id = (int)$_GET['DepartmentID'];
        $departments = Utils::getDepartments();
        $inventar_category_id = (int)$_GET['InventarCategoryID'];
        $token = explode(' ', $conn->real_escape_string($_GET['Token']));

        $products = array();


        if (!empty($_GET['StartDate']) && !empty($_GET['EndDate'])) {
            $query = "SELECT a.*, b.ObjName, b.ObjCode, b.ObjAcqDate, b.ObjAcqValue, c.FullName, d.DepartmentID
                                FROM persons_inventar a 
                                JOIN inventar b ON b.ObjID = a.ObjID
                                LEFT JOIN persons c ON c.PersonID = a.PersonID
                                LEFT JOIN payroll d ON d.PersonID = c.PersonID
                                WHERE a.StartDate <= '{$EndDate}' AND (a.StopDate >= '{$StartDate}' OR a.StopDate = '0000-00-00' OR a.StopDate IS NULL) AND a.PersonProperty = '1' AND a.ObjType IN(1,2) ";

            if (!empty($company_id)) {
                $query .= " AND d.CompanyID = '{$company_id}'";
            }
            if (!empty($department_id)) {
                $query .= " AND d.DepartmentID = '{$department_id}'";
            }
            if (!empty($inventar_category_id)) {
                $query .= " AND b.ObjCategory = '{$inventar_category_id}'";
            }
            if (!empty($token)) {
                foreach ($token as $t) {
                    $query .= " AND (b.ObjName LIKE '%$t%' OR b.ObjCode LIKE '%$t%')";
                }
            }

            $query .= " ORDER BY a.StartDate DESC";

            $conn->query($query);

            $list = array();

            while ($row = $conn->fetch_array()) {
                $row['PaymentTerm'] = Utils::getDaysDiff($row['InvoiceDate'], $row['PaymentDueDate'], false, false) - 1;
                $row['Department'] = $departments[$row['DepartmentID']];
                $list[] = $row;
            }

            foreach ($list as $l) {
                $payed = 0;
                $conn->query("SELECT a.Value*(IF(a.Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = a.Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = YEAR(a.CreateDate) LIMIT 1), 1)) AS RealValue FROM persons_inventar_payments a WHERE a.InventarID = '" . $l['ID'] . "' ORDER BY CreateDate");
                while ($row = $conn->fetch_array()) {
                    $payed += round($row['RealValue'], 2);
                }
                $l['Payed'] = number_format($payed, 2);
                $l['ToPay'] = number_format(round($l['InvoiceValue'] - $payed, 2), 2);
                $l['InvoiceValue'] = number_format($l['InvoiceValue'], 2);
                $products[$l['ObjID']] = $l;
            }

        }
//            Utils::pa($products);exit;

        return $products;
    }


    public static function getReports_128()
    {
        global $conn;

        $phones = array();

        $StartDate = date('Y-m-d', strtotime($_GET['StartDate']));
        $EndDate = date('Y-m-d', strtotime($_GET['EndDate']));
        $company_id = (int)$_GET['CompanyID'];
        $department_id = (int)$_GET['DepartmentID'];
        $departments = Utils::getDepartments();
        $show_all = (int)$_GET['ShowAll'];


        if (!empty($_GET['StartDate']) && !empty($_GET['EndDate'])) {
            $query = "SELECT a.*, c.FullName, d.DepartmentID, b.PhoneNo, b.Cost, b.ContractType";

            if (!empty($show_all)) {
                $query .= ", b.MinuteGrup, b.MinuteNationale, b.MinuteAlte, b.MinuteInternationale, b.SMSRetea, b.SMSNat, b.TraficNational, b.RoamingVoce, b.RoamingTrafic, b.PrelungireAchizitie";
            }

            $query .= " FROM persons_inventar a 
                                JOIN phone_contracts b ON b.ID = a.ObjID
                                LEFT JOIN persons c ON c.PersonID = a.PersonID
                                LEFT JOIN payroll d ON d.PersonID = c.PersonID
                                WHERE a.StartDate <= '{$EndDate}' AND (a.StopDate >= '{$StartDate}' OR a.StopDate = '0000-00-00' OR a.StopDate IS NULL) AND a.ObjType = 3 ";

            if (!empty($company_id)) {
                $query .= " AND d.CompanyID = '{$company_id}'";
            }
            if (!empty($department_id)) {
                $query .= " AND d.DepartmentID = '{$department_id}'";
            }

            $query .= " ORDER BY a.ObjID, a.StartDate DESC";


            $conn->query($query);

            $list = array();

            while ($row = $conn->fetch_array()) {
                $row['Department'] = $departments[$row['DepartmentID']];
                $list[] = $row;
            }

            foreach ($list as $l) {
                $conn->query("SELECT e.PersonID, f.FullName, e.StartDate, e.StopDate FROM persons_inventar e LEFT JOIN persons f ON e.PersonID = f.PersonID WHERE e.ObjType = 3 AND e.ObjID = '" . $l['ObjID'] . "' AND StartDate < '" . $l['StartDate'] . "' ORDER BY StartDate DESC LIMIT 1");
                $row = $conn->fetch_array();
                foreach ($row as $k => $v) {
                    $l['Prev' . $k] = $v;
                }
                $phones[$l['ID']] = $l;
            }


//                Utils::pa($phones);exit;
        }


        return $phones;
    }

    //RAPORT DEPLASARI
    public static function getReports_129()
    {
        global $conn;

        $deplasari = array();

        $StartDate = (!empty($_GET['StartDate'])) ? date('Y-m-d', strtotime($_GET['StartDate'])) : '';
        $EndDate = (!empty($_GET['EndDate'])) ? date('Y-m-d', strtotime($_GET['EndDate'])) : '';
        $company_id = (int)$_GET['CompanyID'];
        $department_id = (int)$_GET['DepartmentID'];
        $division_id = (int)$_GET['DivisionID'];

        $self = Company::getSelfCompanies();
        $departments = Utils::getDepartments();
        //$divisions		=	Utils::getDivisions();


        if (!empty($_GET['StartDate'])) {

            $query = "SELECT pers.FullName, pers.PersonID,
							pay.CompanyID, pay.DepartmentID, 
							depl.DisplacementID, depl.Location, depl.Currency, depl.StartDate, depl.StopDate
							FROM persons pers
							LEFT JOIN payroll pay ON pers.PersonID = pay.PersonID
							LEFT JOIN persons_displacement depl ON pers.PersonID = depl.PersonID
							WHERE depl.StartDate >= '{$StartDate}' AND depl.StartDate <> '0000-00-00 00:00' ";

            if (!empty($EndDate)) {
                $cond .= "AND depl.StopDate <= '{$EndDate}'";
            }

            if (!empty($_GET['CompanyID'])) {
                $cond .= "AND pay.CompanyID = '{$_GET['CompanyID']}'";
            }

            if (!empty($_GET['DivisionID'])) {
                $cond .= "AND pay.DivisionID = '{$_GET['DivisionID']}'";
            }

            if (!empty($_GET['DepartmentID'])) {
                $cond .= "AND pay.DepartmentID = '{$_GET['DepartmentID']}'";
            }

            $query .= $cond . " ORDER BY depl.StartDate ASC, pers.FullName ASC";

            $conn->query($query);

            $list = array();

            while ($row = $conn->fetch_array()) {
                $row['StartDate'] = date('d-m-Y H:i', strtotime($row['StartDate']));
                $row['StopDate'] = date('d-m-Y H:i', strtotime($row['StopDate']));

                $row['Department'] = $departments[$row['DepartmentID']];
                $row['Company'] = $self[$row['CompanyID']];

                $dif_cal = Utils::getDateTimeDiff($row['StartDate'], $row['StopDate'], false, false);
                $row['durata_calendar'] = $dif_cal['d'] . ' zile' . (($dif_cal['h'] > 0) ? (' si ' . $dif_cal['h'] . ' ore') : '');

                $dif_lucr = Utils::getDateTimeDiff($row['StartDate'], $row['StopDate'], true, true);
                $row['durata_lucratoare'] = $dif_lucr['d'] . ' zile' . (($dif_lucr['h'] > 0) ? (' si ' . $dif_lucr['h'] . ' ore') : '');

                $list[] = $row;
            }

            foreach ($list as $l) {
                $conn->query("SELECT CostSubtype, Cost FROM persons_displacement_cost WHERE CostType = 'expense' AND DisplacementID = " . $l['DisplacementID'] . " AND PersonID = " . $l['PersonID']);

                $chelt_total = 0;
                $diurna = 0;
                $chelt = 0;

                while ($v = $conn->fetch_array()) {

                    if ((int)$v['CostSubtype'] == 6) { //diurna
                        $diurna += $v['Cost'];
                    } else {
                        $chelt += $v['Cost'];
                    }
                }
                $chelt_total = $chelt + $diurna;
                $l['diurna'] = $diurna . ' ' . $l['Currency'];
                $l['chelt'] = $chelt . ' ' . $l['Currency'];
                $l['chelt_total'] = $chelt_total . ' ' . $l['Currency'];

                $deplasari[$l['DisplacementID']] = $l;
            }
        }
        //var_dump($deplasari);
        return $deplasari;
    }

    //RAPORT ORE SUPLIMENTARE
    public static function getReports_130()
    {
        global $conn;

        $persons = array();

        $year = !empty($_GET['Year']) ? (int)$_GET['Year'] : date('Y');
        $month = !empty($_GET['Month']) ? (int)$_GET['Month'] : date('m');

        $company_id = (int)$_GET['CompanyID'];
        $department_id = (int)$_GET['DepartmentID'];

        $type = !empty($_GET['CostType']) ? (int)$_GET['CostType'] : 1;

        $order_by = !empty($_GET['order_by']) ? $conn->real_escape_string($_GET['order_by']) : 'a.FullName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        $self = Company::getSelfCompanies();
        $departments = Utils::getDepartments();

        //if(!empty($company_id)){
        if (1 == 1) {

            #start main q
            $query = 'SELECT a.PersonID, b.CompanyID, b.DepartmentID, a.FullName';

            #Month salary
            $query .= ", (SELECT Salary" . ($type == 2 ? "Net" : "") . "*(IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '{$year}'), 1)) FROM persons_salary WHERE PersonID = a.PersonID AND StartDate <= '" . date('Y-m-t', strtotime($year . "-" . $month . "-01")) . "' ORDER BY StartDate DESC LIMIT 1) as MonthSalary";

            $query .= " FROM persons a
                            JOIN payroll b ON b.PersonID = a.PersonID 
								WHERE b.StartDate <= '" . date('Y-m-t', strtotime($year . "-" . $month . "-01")) . "'
												AND (b.StopDate IS NULL OR b.StopDate = '0000-00-00' OR b.StopDate >= '$year-$month-01')
									  " . (!empty($company_id) ? " AND b.CompanyID = '{$company_id}'" : "") . (!empty($department_id) ? " AND b.DepartmentID = '{$department_id}'" : "") .
                (!empty($_SESSION['PERS']) && !in_array($_SESSION['USER_ID'], array(27, 30)) ? " AND a.PersonID = '{$_SESSION['PERS']}'" : "")
                . " ORDER BY {$order_by} {$asc_or_desc}";

            $conn->query($query);

            while ($row = $conn->fetch_array()) {
                $row['Department'] = $departments[$row['DepartmentID']];
                $row['Company'] = $self[$row['CompanyID']];

                $row['MonthSalary'] = round($row['MonthSalary'], 0);
                $persons[$row['PersonID']] = $row;
            }

            $conn->query("SELECT company_settings FROM settings");
            $company_settings = ($row = $conn->fetch_array()) && !empty($row['company_settings']) ? unserialize($row['company_settings']) : array();

            foreach ($persons as $key => $value) {
                $person_ot = 0;
                $ore_supl = 0;

                $stat = Pontaj::getPersonDetailStat($key, date('Y-m-d', strtotime($year . "-" . $month . "-01")), date('Y-m-t', strtotime($year . "-" . $month . "-01")));
                //$wd = ceil($stat['NormalHours']/8);
                $hsal = $value['MonthSalary'] / 168;

                $person_ot += $stat['SplHours'] * $hsal * (($company_settings['pontaj']['proc_normal'] + 100) / 100);
                $person_ot += $stat['NightHours'] * $hsal * (($company_settings['pontaj']['proc_night'] + 100) / 100);
                $person_ot += $stat['LegalHours'] * $hsal * (($company_settings['pontaj']['proc_legal'] + 100) / 100);
                $person_ot += $stat['WkHours'] * $hsal * (($company_settings['pontaj']['proc_weekend'] + 100) / 100);

                $ore_supl += $stat['SplHours'];
                $ore_supl += $stat['NightHours'];
                $ore_supl += $stat['LegalHours'];
                $ore_supl += $stat['WkHours'];

                $persons[$key]['cost'] = round($person_ot, 2);
                $persons[$key]['ore'] = round($ore_supl, 2);
            }
        }

        return $persons;
    }

    public static function getReports_151()
    {

        $month = (int)$_GET['Month'];
        $year = (int)$_GET['Year'];
        $company_id = (int)$_GET['CompanyID'];
        $division_id = (int)$_GET['DivisionID'];
        $department_id = (int)$_GET['DepartmentID'];


        if (empty($month) || empty($year)) {
            return;
        }

        $StartDate = date('Y-m-d', strtotime("$year-$month-01"));
        $EndDate = date('Y-m-t', strtotime("$year-$month-31"));

        global $conn;

        $query = "SELECT a.PersonID, a.FirstName, a.LastName, a.CNP, a.Phone, a.Mobile, a.Email, 
                                b.StartDate, b.StopDate, b.HealthCompanyID, b.ContractType, b.WorkNorm, b.DivisionID,
                                d.StreetName, d.StreetCode, d.StreetNumber, d.Bl, d.Sc, d.Et, d.Ap,
                                e.CityName, f.DistrictName,
                                g.BankName, g.BankLocation, g.BankAccount,
                                h.Function
                
                        ,(SELECT Salary*(IF(Currency != 'RON', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = 'RON' AND Year = '{$year}'), 1)) FROM persons_salary WHERE PersonID = a.PersonID AND StartDate <= '{$year}-{$month}-01' ORDER BY StartDate DESC LIMIT 1) as Salary
                        ,(SELECT SalaryNet*(IF(Currency != 'RON', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = 'RON' AND Year = '{$year}'), 1)) FROM persons_salary WHERE PersonID = a.PersonID AND StartDate <= '{$year}-{$month}-01' ORDER BY StartDate DESC LIMIT 1) as SalaryNet

                        FROM persons a
                        INNER JOIN payroll b on b.PersonID = a.PersonID
                        LEFT JOIN address d ON d.AddressID = a.AddressID
                        LEFT JOIN address_city e ON e.CityID = d.CityID
                        LEFT JOIN address_district f ON f.DistrictID = e.DistrictID
                        LEFT JOIN banks g ON g.BankID = b.BankID
                        LEFT JOIN internal_functions h ON h.FunctionID = b.InternalFunction
                       WHERE 
							b.StartDate >= '$StartDate' AND
							b.StartDate <= '$EndDate'
                        ";
        if (!empty($company_id)) {
            $query .= " AND b.CompanyID = $company_id";
        }
        if (!empty($division_id)) {
            $query .= " AND b.DivisionID = $division_id";
        }
        if (!empty($department_id)) {
            $query .= " AND b.DepartmentID = $department_id";
        }

        $query .= " ORDER BY a.LastName, a.FirstName";

        $conn->query($query);
        $persons = array();

        while ($row = $conn->fetch_array()) {
            if (stristr($row['CityName'], 'Bucuresti, sector')) {
                $split = explode(',', $row['CityName']);
                $row['CityName'] = trim($split[0]);
                $row['Sector'] = ucfirst(trim($split[1]));
            }
            $persons[$row['PersonID']] = $row;
        }
//            Utils::pa($persons);exit;
        return $persons;
    }

    public static function getReports_152()
    {

        $month = (int)$_GET['Month'];
        $year = (int)$_GET['Year'];
        $company_id = (int)$_GET['CompanyID'];
        $division_id = (int)$_GET['DivisionID'];
        $department_id = (int)$_GET['DepartmentID'];


        if (empty($month) || empty($year)) {
            return;
        }

        $StartDate = date('Y-m-d', strtotime("$year-$month-01"));
        $EndDate = date('Y-m-t', strtotime("$year-$month-31"));

        global $conn;

        $query = "SELECT a.PersonID, a.FirstName, a.LastName, a.CNP, a.Phone, a.Mobile, a.Email, 
                                b.StartDate, b.StopDate, b.HealthCompanyID, b.ContractType, b.WorkNorm, b.DivisionID,
                                d.StreetName, d.StreetCode, d.StreetNumber, d.Bl, d.Sc, d.Et, d.Ap,
                                e.CityName, f.DistrictName,
                                g.BankName, g.BankLocation, g.BankAccount,
                                h.Function
                
                        ,(SELECT Salary*(IF(Currency != 'RON', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = 'RON' AND Year = '{$year}'), 1)) FROM persons_salary WHERE PersonID = a.PersonID AND StartDate <= '{$year}-{$month}-01' ORDER BY StartDate DESC LIMIT 1) as Salary
                        ,(SELECT SalaryNet*(IF(Currency != 'RON', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = 'RON' AND Year = '{$year}'), 1)) FROM persons_salary WHERE PersonID = a.PersonID AND StartDate <= '{$year}-{$month}-01' ORDER BY StartDate DESC LIMIT 1) as SalaryNet

                        FROM persons a
                        INNER JOIN payroll b on b.PersonID = a.PersonID
                        LEFT JOIN address d ON d.AddressID = a.AddressID
                        LEFT JOIN address_city e ON e.CityID = d.CityID
                        LEFT JOIN address_district f ON f.DistrictID = e.DistrictID
                        LEFT JOIN banks g ON g.BankID = b.BankID
                        LEFT JOIN internal_functions h ON h.FunctionID = b.InternalFunction
                       WHERE b.StopDate IS NOT NULL AND b.StopDate != '' AND b.StopDate != '0000-00-00' AND b.StopDate BETWEEN '$StartDate' AND '$EndDate'
                        ";

        if (!empty($company_id)) {
            $query .= " AND b.CompanyID = $company_id";
        }
        if (!empty($division_id)) {
            $query .= " AND b.DivisionID = $division_id";
        }
        if (!empty($department_id)) {
            $query .= " AND b.DepartmentID = $department_id";
        }

        $query .= " ORDER BY a.LastName, a.FirstName";

        $conn->query($query);
        $persons = array();

        while ($row = $conn->fetch_array()) {
            if (stristr($row['CityName'], 'Bucuresti, sector')) {
                $split = explode(',', $row['CityName']);
                $row['CityName'] = trim($split[0]);
                $row['Sector'] = ucfirst(trim($split[1]));
            }
            $persons[$row['PersonID']] = $row;
        }
//            Utils::pa($persons);exit;
        return $persons;
    }

    public static function getReports_153()
    {

        if (empty($_GET['SelDate'])) {
            return;
        }

        $date = date('Y-m-d', strtotime($_GET['SelDate']));

        $company_id = (int)$_GET['CompanyID'];
        $department_id = (int)$_GET['DepartmentID'];
        $division_id = (int)$_GET['DivisionID'];
        $age_stamp = array(19, 19, 18, 18, 20, 20);

        global $conn;

        $query = "SELECT a.*, b.FirstName, b.LastName 
                    FROM persons_intretinere a 
                    JOIN persons b ON b.PersonID = a.PersonID
                    JOIN payroll c ON c.PersonID = a.PersonID
                    WHERE (('{$date}' BETWEEN a.DataIni AND a.DataFin) OR a.DataIni <= '{$date}' AND a.DataFin = '0000-00-00')";

        if (!empty($company_id)) {
            $query .= " AND c.CompanyID = '{$company_id}'";
        }
        if (!empty($division_id)) {
            $query .= " AND c.DivisionID = '{$division_id}'";
        }
        if (!empty($department_id)) {
            $query .= " AND c.DepartmentID = '{$department_id}'";
        }

        $query .= " ORDER BY b.FullName";

        $persons = array();
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $name_p = explode(' ', $row['Nume'], 2);
            $row['Nume'] = $name_p[0];
            $row['Prenume'] = $name_p[1];
            $dob = $age_stamp[substr($row['CNP'], 0, 1) - 1] . substr($row['CNP'], 1, 2) . "-" . substr($row['CNP'], 3, 2) . "-" . substr($row['CNP'], 5, 2);
            $dt1 = new DateTime($date);
            if (checkdate((int)substr($dob, 5, 2), (int)substr($dob, 8, 2), (int)substr($dob, 0, 4))) {
                $dt2 = new DateTime($dob);
            } else {
                $dt2 = new DateTime($date);
            }
            $interval = $dt1->diff($dt2);
            $row['Age'] = $interval->y;
            $persons[] = $row;
        }
        return $persons;
    }

    public static function getReports_154()
    {

        if (empty($_GET['Year'])) {
            return;
        }

        $year = (int)$_GET['Year'];

        $StartDate = "$year-04-01";
        $EndDate = ($year + 1) . "-03-31";
        $mwdays = array();

        $m_trans = array_flip(array(4, 5, 6, 7, 8, 9, 10, 11, 12, 1, 2, 3));

        foreach (range(4, 12) as $month) {
            $sday = $year . "-" . str_pad($month, 2, '0', STR_PAD_LEFT) . "-01";
            $eday = date('Y-m-t', strtotime($sday));
            $mwdays[$sday] = Utils::getDaysDiff($sday, $eday);
        }
        foreach (range(1, 3) as $month) {
            $sday = ($year + 1) . "-" . str_pad($month, 2, '0', STR_PAD_LEFT) . "-01";
            $eday = date('Y-m-t', strtotime($sday));
            $mwdays[$sday] = Utils::getDaysDiff($sday, $eday);
        }

        $company_id = (int)$_GET['CompanyID'];
        $division_id = (int)$_GET['DivisionID'];
        $department_id = (int)$_GET['DepartmentID'];

        global $conn;

        $pontaj = array();
        $query = "SELECT a.*, b.FullName, b.CNP, d.Function, c.DivisionID, c.WorkNorm,
                            (SELECT Salary*(IF(Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = '{$year}'), 1)) FROM persons_salary WHERE PersonID = a.PersonID AND YEAR(StartDate) <= '{$year}' ORDER BY StartDate DESC LIMIT 1) as Salary
                            FROM pontaj_monthly a
                            JOIN persons b ON b.PersonID = a.PersonID
                            JOIN payroll c ON c.PersonID = a.PersonID
                            LEFT JOIN functions d ON d.FunctionID = c.FunctionID
                            WHERE a.Month BETWEEN '$StartDate' AND '$EndDate' AND a.Type = 1";

        if (!empty($company_id)) {
            $query .= " AND c.CompanyID = '{$company_id}'";
        }
        if (!empty($division_id)) {
            $query .= " AND c.DivisionID = '{$division_id}'";
        }
        if (!empty($department_id)) {
            $query .= " AND c.DepartmentID = '{$department_id}'";
        }
//            echo $query;exit;
        $conn->query($query);

        while ($row = $conn->fetch_array()) {
            if (!isset($pontaj[$row['PersonID']]['PersonDetails'])) {
                $details['FullName'] = $row['FullName'];
                $details['Function'] = $row['Function'];
                $details['CNP'] = $row['CNP'];
                $details['DivisionID'] = $row['DivisionID'];
                $details['Salary'] = number_format($row['Salary'], 2, '.', '');

                $pontaj[$row['PersonID']]['PersonDetails'] = $details;
            }
            $m = date('n', strtotime($row['Month']));
            $row['Ore'] = $row['StocAnterior'] + $row['Rest'];
            $pontaj[$row['PersonID']]['Months'][$m_trans[$m]] = $row;
        }

//            Utils::pa($pontaj);exit;

        return $pontaj;
    }

    public static function getReports_155()
    {

        if (empty($_GET['Year'])) {
            return;
        }

        $year = (int)$_GET['Year'];

        $division_id = (int)$_GET['DivisionID'];
        $name = $_GET['Name'];

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.FullName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';


        global $conn;

        $persons = array();

        $query = "SELECT a.PersonID, a.FullName, a.CNP, d.Division, c.Salary, c.Currency 
						FROM persons a 
						LEFT JOIN payroll b ON b.PersonID = a.PersonID 
						LEFT JOIN persons_salary c ON b.PersonID = c.PersonID 
						LEFT JOIN divisions d ON d.DivisionID = b.DivisionID
						WHERE (YEAR(c.StartDate) <= '$year' AND (YEAR(c.StopDate) = 0 OR YEAR(c.StopDate) >= '$year')) ";

        if (!empty($division_id)) {
            $query .= " AND b.DivisionID = '{$division_id}'";
        }
        if (!empty($name)) {
            $query .= " AND a.FullName LIKE '%{$name}%'";
        }

        $query .= " ORDER  BY $order_by $asc_or_desc ";

        $conn->query($query);

        while ($row = $conn->fetch_array()) {
            $row['Salary'] = $row['Salary'] . ' ' . $row['Currency'];
            $persons[$row['PersonID']] = $row;
        }

        if (!empty($persons)) {
            foreach ($persons as $personId => $person) {
                $vacationPerson = Person::getVacation($personId, $year);
                $vacationPerson = $vacationPerson[$year];
                if (!empty($vacationPerson)) {
                    $persons[$personId]['LeftCO'] = $vacationPerson['TotalCO'] - $vacationPerson['EffCO'] - $vacationPerson['Invoire'] - $vacationPerson['LostCO'];
                    if ($persons[$personId]['LeftCO'] < 0)
                        $persons[$personId]['LeftCO'] = 0;
                } else {
                    $persons[$personId]['LeftCO'] = 0;
                }
            }
        }
        return $persons;
    }

    public static function getReports_156()
    {

        global $conn;

        $persons = array();

        if (empty($_GET['Year'])) {
            return $persons;
        }

        if (!empty($_GET['Status'])) {
            $cond .= "AND a.Status = '{$_GET['Status']}'";
        }
        if (!empty($_GET['CompanyID'])) {
            $cond .= "AND b.CompanyID = '{$_GET['CompanyID']}'";
        }
        if (!empty($_GET['DivisionID'])) {
            $cond .= "AND b.DivisionID = '{$_GET['DivisionID']}'";
        }
        if (!empty($_GET['DepartmentID'])) {
            $cond .= "AND b.DepartmentID = '{$_GET['DepartmentID']}'";
        }
        if (!empty($_GET['SubdepartmentID'])) {
            $cond .= "AND b.SubdepartmentID = '{$_GET['SubdepartmentID']}'";
        }

        $Year = (int)$_GET['Year'];
        $StartDate = $Year . '-01-01';
        $EndDate = $Year . '-12-31';


        $arr_months = Utils::getMonthArray($StartDate, $EndDate);

        $calh = array(0 => 'D', 1 => 'L', 2 => 'M', 3 => 'M', 4 => 'J', 5 => 'V', 6 => 'S');

        global $cal;

        $st_y = (int)substr($Year . '-01-01', 0, 4);
        $st_m = (int)substr($Year . '-01-01', 5, 2);
        $st_d = (int)substr($Year . '-01-01', 8, 2);
        $i = 0;
        $j = 0;
        while (true) {
            $time = mktime(0, 0, 0, $st_m, $st_d + $i, $st_y);
            $date = date('Y-m-d', $time);
            if ($date <= $EndDate) {
                $cal[$date] = $calh[date('w', $time)];
                if ($cal[$date] != 'S' && $cal[$date] != 'D') {
                    $j++;
                }
                $i++;
            } else {
                break;
            }
        }

        // Obtain all vacations from current year
        $query = "SELECT a.FullName, v.PersonID, v.StartDate, v.StopDate, v.Type, v.Aprove
				  FROM   vacations_details v
						 INNER JOIN persons a ON v.PersonID = a.PersonID
						 LEFT JOIN payroll b ON b.PersonID = a.PersonID
						 LEFT JOIN companies d ON b.CompanyID = d.CompanyID
						 LEFT JOIN divisions e ON b.DivisionID = e.DivisionID
						 LEFT JOIN departments f ON b.DepartmentID = f.DepartmentID
				  WHERE  ((v.StartDate BETWEEN CONCAT(YEAR('{$StartDate}'),'-01-01') AND CONCAT(YEAR('{$EndDate}'),'-12-31'))) OR
						 (v.StopDate BETWEEN CONCAT(YEAR('{$StartDate}'),'-01-01') AND CONCAT(YEAR('{$EndDate}'),'-12-31')) OR
						 (CONCAT(YEAR('{$StartDate}'),'-01-01')   BETWEEN v.StartDate AND v.StopDate)
						 $cond
				  ORDER  BY v.StartDate";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $arr[$row['PersonID']][$row['StartDate']] = $row;
        }

        //Prepare the table
        $conn->query("DELETE FROM vacations_days_tmp");

        // Insert VacationDays for current year
        foreach ($arr as $k => $v) {
            foreach ($v as $sd => $vac) {
                $vacations[$k]['FullName'] = $vac['FullName'];
                $vacations[$k]['StartDate'] = $vac['StartDate'];
                $vacations[$k]['StopDate'] = $vac['StopDate'];
                foreach ($cal as $date => $w) {
                    //Skip Weekends and Legal free days
                    if ($sd <= $date && $date <= $vac['StopDate'] && $w != 'S' && $w != 'D' && !in_array($date, array_keys(ConfigData::$msLegal))) {
                        //$vacations[$k]['COdays'][$date] = array($vac['Type'],$vac['Aprove']);
                        $conn->query("INSERT INTO vacations_days_tmp(UserID, PersonID, Day, Type, Aprove, CreateDate)
							  VALUES({$_SESSION['USER_ID']}, $k, '$date', '{$vac['Type']}','{$vac['Aprove']}', CURRENT_TIMESTAMP)");
                    }
                }
            }
        }

        // Obtain the vacations in the specified interval
        $query = "SELECT a.PersonID, DATE_FORMAT(a.Day, '%Y-%m') AS Month, COUNT(Day) AS TCO FROM vacations_days_tmp a 
						LEFT JOIN persons b ON a.PersonID=b.PersonID
						WHERE Aprove>0 AND Type='CO' AND (Day BETWEEN '{$StartDate}' AND '{$EndDate}')
						GROUP BY a.PersonID, DATE_FORMAT(a.Day, '%Y-%m') ORDER BY b.FullName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $tco_arr[$row['PersonID']][$row['Month']]['TCO'] = $row['TCO'];
        }

        // Obtain the month of ReportDateLimit and Add the lost days
        $query = "SELECT a.PersonID, a.ReportDateLimit, DATE_FORMAT(ReportDateLimit, '%Y-%m') AS ReportMonthLimit, (a.TotalCO - CONVERT(a.TotalCORef, SIGNED)) AS ExtraCO,
						(SELECT COUNT(*) FROM vacations_days_tmp x WHERE x.PersonID = a.PersonID AND Type = 'CO' AND Aprove >= 0 AND x.Day <= a.ReportDateLimit) AS ConsumedCO
						FROM vacations a 
						WHERE a.Year='$Year'";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            if ($row['ExtraCO'] >= $row['ConsumedCO'])
                $row['LostCO'] = $row['ExtraCO'] - $row['ConsumedCO'];
            else
                $row['LostCO'] = 0;
            $extra_co_arr[$row['PersonID']][$row['ReportMonthLimit']] = $row;
        }
        //Utils::pa($extra_co_arr);

        // Populate even the months with have 0 TCO
        foreach ($tco_arr as $personID => $co_month) {
            foreach ($arr_months as $month => $m) {
                if ($tco_arr[$personID][$month]['TCO'] > 0)
                    $tco[$personID][$month]['TCO'] = $tco_arr[$personID][$month]['TCO'] + $extra_co_arr[$personID][$month]['LostCO'];
                else
                    $tco[$personID][$month]['TCO'] = 0 + $extra_co_arr[$personID][$month]['LostCO'];
                //
            }
        }
        //Utils::pa($tco_arr);
        // Get the sum of all CO days
        $query = "SELECT a.PersonID, a.FullName, Department, e.Division as Division,
						(SELECT (TotalCO - CONVERT(Invoire, SIGNED)) FROM vacations c WHERE a.PersonID=c.PersonID AND Year=YEAR('{$StartDate}')-1) AS PrevCO,
						(SELECT SUM(DaysNo) FROM vacations_details d WHERE a.PersonID=d.PersonID AND Type='CO' AND Year=YEAR('{$StartDate}')-1) AS PrevInsertedCO,
						(SELECT (TotalCO - CONVERT(Invoire, SIGNED)) FROM vacations e WHERE a.PersonID=e.PersonID AND Year=YEAR('{$StartDate}')) AS CurrTotalCO,
						(SELECT TotalCORef FROM vacations f WHERE a.PersonID=f.PersonID AND Year=YEAR('{$StartDate}')) AS CurrTotalCORef,
						YEAR('{$StartDate}')-1 AS PrevYear, YEAR('{$StartDate}') AS CurrYear
						 FROM persons a 
						 LEFT JOIN payroll b ON a.PersonID=b.PersonID
						 LEFT JOIN companies d ON b.CompanyID = d.CompanyID
						 LEFT JOIN divisions e ON b.DivisionID = e.DivisionID
						 LEFT JOIN departments f ON b.DepartmentID = f.DepartmentID
						 WHERE 1=1 $cond ORDER BY a.FullName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $persons['PrevYear'] = $row['PrevYear'];
            $persons['CurrYear'] = $row['CurrYear'];
            $persons[$row['PersonID']]['PersonID'] = $row['PersonID'];
            $persons[$row['PersonID']]['FullName'] = $row['FullName'];
            $persons[$row['PersonID']]['Department'] = $row['Department'];
            $persons[$row['PersonID']]['Division'] = $row['Division'];
            $persons[$row['PersonID']]['PrevCO'] = $row['PrevCO'];
            $persons[$row['PersonID']]['PrevInsertedCO'] = $row['PrevInsertedCO'];
            $persons[$row['PersonID']]['PrevTotalCO'] = ($row['PrevCO'] - $row['PrevInsertedCO'] > 0) ? $row['PrevCO'] - $row['PrevInsertedCO'] : 0;
            $persons[$row['PersonID']]['CurrTotalCO'] = $row['CurrTotalCO'];
            $persons[$row['PersonID']]['CurrTotalCORef'] = $row['CurrTotalCORef'];
            //$persons[$row['PersonID']]['Vacations'] = $tco[$row['PersonID']];
        }
        //Utils::pa($persons);
        //Populate the array of persons with all consumed/remaining CO

        $rem_co = array("PrevYear" => $persons['PrevYear'], "CurrYear" => $persons['CurrYear']);
        unset($persons['PrevYear']);
        unset($persons['CurrYear']);
        foreach ($persons as $PersonID => $person) {
            $curr_CO = $person['CurrTotalCO'];
            $rem_co[$PersonID]['FullName'] = $person['FullName'];
            $rem_co[$PersonID]['Department'] = $person['Department'];
            $rem_co[$PersonID]['Division'] = $person['Division'];
            $rem_co[$PersonID]['PrevTotalCO'] = $person['PrevTotalCO'];
            $rem_co[$PersonID]['CurrTotalCO'] = $person['CurrTotalCO'];
            $rem_co[$PersonID]['CurrTotalCORef'] = $person['CurrTotalCORef'];
            if (is_array($tco[$PersonID]))
                foreach ($tco[$PersonID] as $month => $cons_days) {
                    $rem_co[$PersonID][$month]['TCO'] = $cons_days['TCO'];
                    $rem_co[$PersonID][$month]['RemCO'] = $curr_CO - $cons_days['TCO'];
                    $curr_CO = $curr_CO - $cons_days['TCO'];
                }
        }

        //var_dump($rem_co);
        return $rem_co;
    }

    public static function getReports_159()
    {

        global $conn;
        $StartDate = (!empty($_GET['StartDate'])) ? date('Y-m-d', strtotime($_GET['StartDate'])) : '';
        $EndDate = (!empty($_GET['EndDate'])) ? date('Y-m-d', strtotime($_GET['EndDate'])) : '';
        $persons = array();
        $cond = '';


        if (!empty($_GET['StatusID'])) {
            $cond .= " AND t.Status = " . (int)$_GET['StatusID'];
        }

        if (!empty($_GET['DepartmentID'])) {
            $cond .= " AND j.DepartmentID = " . (int)$_GET['DepartmentID'];
        }

        if (!empty($_GET['JobTypeID'])) {
            $cond .= " AND j.JobType = " . (int)$_GET['JobTypeID'];
        }

        if (!empty($_GET['StartDate'])) {
            $cond .= " AND j.StopDate >= '{$StartDate}'";
        }

        if (!empty($_GET['EndDate'])) {
            $cond .= " AND j.StopDate <= '{$EndDate}'";
        }

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'DataStop';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        $query = "SELECT *,
                        DATE_FORMAT(j.StopDate, '%d.%m.%Y') AS DataStop,
                        DATE_FORMAT(j.Startdate, '%d.%m.%Y') AS StartDate,
                        DATEDIFF(CURRENT_DATE, j.StartDate) as DaysGone,
                        CASE
                            WHEN j.StopDate<CURRENT_DATE THEN 'inactiv'
                            ELSE 'activ'
                        END as status,
                        t.Status as Status,
                        CASE j.JobType
                            WHEN '1' THEN 'Full Time'
                            WHEN '2' THEN 'Part Time'
                            WHEN '3' THEN 'Sezonier'
                            WHEN '4' THEN 'Proiect'
                            WHEN '5' THEN 'Voluntariat'     
                        END as JobType,
                        CASE t.Status
                            WHEN '1' THEN 'Nou'
                            WHEN '2' THEN 'Asignat'
                            WHEN '3' THEN 'Confirmat'
                            WHEN '4' THEN 'In lucru'
                            WHEN '5' THEN 'Rezolvat' 
                            WHEN '6' THEN 'Anulat' 
                        END as Status    
                        FROM jobs j 
                        LEFT JOIN job_candidates jc on jc.JobID=j.JobID
                        LEFT JOIN candidates_internal ci on ci.PersonID=jc.PersonID 
                        LEFT JOIN ticketing t on t.TicketID=j.TicketID AND t.Type=11   
                        LEFT JOIN persons p on p.PersonID=t.AssignedPersonID
                        LEFT JOIN companies c ON j.CompanyID = c.CompanyID
                        LEFT JOIN departments d ON j.DepartmentID = d.DepartmentID
                        LEFT JOIN jobsdictionary jd ON j.ProfJobDictionaryID = jd.JobDictionaryID
                        LEFT JOIN job_strategy js ON js.JobID = j.JobID
                        WHERE 1 = 1 $cond
                        GROUP BY j.JobID
                        ORDER  BY $order_by $asc_or_desc";
        //echo $query; die;
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $persons[] = $row;
        }
        return $persons;
    }

    public static function getReports_160()
    {
        global $conn;

        $persons = array();

        if (empty($_GET['Year'])) {
            return $persons;
        }

        if (!empty($_GET['CompanyID'])) {
            $cond .= " AND b.CompanyID = '{$_GET['CompanyID']}' ";
        }
        if (!empty($_GET['DivisionID'])) {
            $cond .= " AND b.DivisionID = '{$_GET['DivisionID']}' ";
        }
        if (!empty($_GET['Status'])) {
            $cond .= " AND a.Status = '{$_GET['Status']}'";
        }
        if (!empty($_GET['Name'])) {
            $cond .= " AND a.FullName LIKE '%{$_GET['Name']}%' ";
        }

        $Year = (int)$_GET['Year'];
        $StartDate = $Year . '-01-01';
        $EndDate = $Year . '-12-31';

        $PrevStartDate = ($Year - 1) . '-01-01';
        $PrevEndDate = ($Year - 1) . '-12-31';

        $arr_months = Utils::getMonthArrayShortFormat($StartDate, $EndDate);

        $calh = array(0 => 'D', 1 => 'L', 2 => 'M', 3 => 'M', 4 => 'J', 5 => 'V', 6 => 'S');

        global $cal;

        $st_y = (int)substr($Year . '-01-01', 0, 4);
        $st_m = (int)substr($Year . '-01-01', 5, 2);
        $st_d = (int)substr($Year . '-01-01', 8, 2);
        $i = 0;
        $j = 0;
        while (true) {
            $time = mktime(0, 0, 0, $st_m, $st_d + $i, $st_y);
            $date = date('Y-m-d', $time);
            if ($date <= $EndDate) {
                $cal[$date] = $calh[date('w', $time)];
                if ($cal[$date] != 'S' && $cal[$date] != 'D') {
                    $j++;
                }
                $i++;
            } else {
                break;
            }
        }

        // Obtain all vacations from current year
        $query = "SELECT a.FullName, v.PersonID, v.StartDate, v.StopDate, v.Type, v.Aprove
			  FROM   vacations_details v
					 INNER JOIN persons a ON v.PersonID = a.PersonID
					 LEFT JOIN payroll b ON b.PersonID = a.PersonID
					 LEFT JOIN companies d ON b.CompanyID = d.CompanyID
					 LEFT JOIN divisions e ON b.DivisionID = e.DivisionID
					 LEFT JOIN departments f ON b.DepartmentID = f.DepartmentID
			  WHERE  ((v.StartDate BETWEEN CONCAT(YEAR('{$StartDate}'),'-01-01') AND CONCAT(YEAR('{$EndDate}'),'-12-31'))) OR
					 (v.StopDate BETWEEN CONCAT(YEAR('{$StartDate}'),'-01-01') AND CONCAT(YEAR('{$EndDate}'),'-12-31')) OR
					 (CONCAT(YEAR('{$StartDate}'),'-01-01')   BETWEEN v.StartDate AND v.StopDate)
					 AND (b.StartDate <= '{$EndDate}' AND (b.StopDate IS NULL OR b.StopDate = '0000-00-00' OR b.StopDate >= '{$StartDate}'))
					 $cond
			  ORDER  BY v.StartDate";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $arr[$row['PersonID']][$row['StartDate']] = $row;
        }

        //Prepare the table
        $conn->query("DELETE FROM vacations_days_tmp");

        // Insert VacationDays for current year
        foreach ($arr as $k => $v) {
            foreach ($v as $sd => $vac) {
                $vacations[$k]['FullName'] = $vac['FullName'];
                $vacations[$k]['StartDate'] = $vac['StartDate'];
                $vacations[$k]['StopDate'] = $vac['StopDate'];
                foreach ($cal as $date => $w) {
                    //Skip Weekends and Legal free days
                    if ($sd <= $date && $date <= $vac['StopDate'] && $w != 'S' && $w != 'D' && !in_array($date, array_keys(ConfigData::$msLegal))) {
                        //$vacations[$k]['COdays'][$date] = array($vac['Type'],$vac['Aprove']);
                        $conn->query("INSERT INTO vacations_days_tmp(UserID, PersonID, Day, Type, Aprove, CreateDate)
						  VALUES({$_SESSION['USER_ID']}, $k, '$date', '{$vac['Type']}','{$vac['Aprove']}', CURRENT_TIMESTAMP)");
                    }
                }
            }
        }

        // Obtain the vacations in the specified interval
        $query = "SELECT a.PersonID, DATE_FORMAT(a.Day, '%Y-%m') AS Month, COUNT(Day) AS TCO 
					FROM vacations_days_tmp a 
					LEFT JOIN persons b ON a.PersonID=b.PersonID
					WHERE Aprove>0 AND Type='CO' AND (Day BETWEEN '{$StartDate}' AND '{$EndDate}')
					GROUP BY a.PersonID, DATE_FORMAT(a.Day, '%Y-%m') ORDER BY b.FullName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $tco_arr[$row['PersonID']][$row['Month']]['TCO'] = $row['TCO'];
        }

        // Obtain the month of ReportDateLimit and Add the lost days
        $query = "SELECT a.PersonID, a.ReportDateLimit, DATE_FORMAT(ReportDateLimit, '%Y-%m') AS ReportMonthLimit, (a.TotalCO - CONVERT(a.TotalCORef, SIGNED)) AS ExtraCO,
					(SELECT COUNT(*) FROM vacations_days_tmp x WHERE x.PersonID = a.PersonID AND Type = 'CO' AND Aprove >= 0 AND x.Day <= a.ReportDateLimit) AS ConsumedCO
					FROM vacations a 
					WHERE a.Year='$Year'";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            if ($row['ExtraCO'] >= $row['ConsumedCO'])
                $row['LostCO'] = $row['ExtraCO'] - $row['ConsumedCO'];
            else
                $row['LostCO'] = 0;
            $extra_co_arr[$row['PersonID']][$row['ReportMonthLimit']] = $row;
        }
        //Utils::pa($extra_co_arr);

        // Populate even the months with have 0 TCO
        foreach ($tco_arr as $personID => $co_month) {
            foreach ($arr_months as $month => $m) {
                if ($tco_arr[$personID][$month]['TCO'] > 0)
                    $tco[$personID][$month]['TCO'] = $tco_arr[$personID][$month]['TCO'] + $extra_co_arr[$personID][$month]['LostCO'];
                else
                    $tco[$personID][$month]['TCO'] = 0 + $extra_co_arr[$personID][$month]['LostCO'];
                //
            }
        }
        //Utils::pa($tco_arr);
        // Get the sum of all CO days
        $query = "SELECT a.PersonID, a.FullName, a.CNP, f.Department, e.Division as Division,
					(SELECT (TotalCO - CONVERT(Invoire, SIGNED)) FROM vacations c WHERE a.PersonID=c.PersonID AND Year=YEAR('{$StartDate}')-1) AS PrevCO,
					(SELECT SUM(DaysNo) FROM vacations_details d WHERE a.PersonID=d.PersonID AND Type='CO' AND Year=YEAR('{$StartDate}')-1) AS PrevInsertedCO,
					(SELECT (TotalCO - CONVERT(Invoire, SIGNED)) FROM vacations e WHERE a.PersonID=e.PersonID AND Year=YEAR('{$StartDate}')) AS CurrTotalCO,
					(SELECT TotalCORef FROM vacations f WHERE a.PersonID=f.PersonID AND Year=YEAR('{$StartDate}')) AS CurrTotalCORef,
					(SELECT Salary FROM persons_salary WHERE PersonID=a.PersonID AND StartDate <= '{$PrevEndDate}' AND (StopDate = '0000-00-00' OR StopDate >= '{$PrevStartDate}')  ORDER BY SalaryID DESC LIMIT 1) AS PrevYearSalaryBrut, 
					(SELECT Currency FROM persons_salary WHERE PersonID=a.PersonID AND StartDate <= '{$PrevEndDate}' AND (StopDate = '0000-00-00' OR StopDate >= '{$PrevStartDate}')  ORDER BY SalaryID DESC LIMIT 1) AS PrevYearSalaryCurrency, 
					(SELECT cc.CostCenter FROM payroll_costcenter pc
						INNER JOIN costcenter cc ON pc.CostCenterID = cc.CostCenterID
						WHERE pc.PersonID = a.PersonID AND cc.Status = 1 
						ORDER BY pc.CreateDate DESC LIMIT 1) AS CostCenter,
					YEAR('{$StartDate}')-1 AS PrevYear, YEAR('{$StartDate}') AS CurrYear
					 FROM persons a 
					 LEFT JOIN payroll b ON a.PersonID=b.PersonID
					 LEFT JOIN companies d ON b.CompanyID = d.CompanyID
					 LEFT JOIN divisions e ON b.DivisionID = e.DivisionID
					 LEFT JOIN departments f ON b.DepartmentID = f.DepartmentID
					 WHERE 1=1 $cond
					AND (b.StartDate <= '{$EndDate}' AND (b.StopDate IS NULL OR b.StopDate = '0000-00-00' OR b.StopDate >= '{$StartDate}'))
					ORDER BY a.FullName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $persons['PrevYear'] = $row['PrevYear'];
            $persons['CurrYear'] = $row['CurrYear'];
            $persons[$row['PersonID']]['PersonID'] = $row['PersonID'];
            $persons[$row['PersonID']]['FullName'] = $row['FullName'];
            $persons[$row['PersonID']]['CNP'] = $row['CNP'];
            $persons[$row['PersonID']]['PrevYearSalaryBrut'] = $row['PrevYearSalaryBrut'];
            $persons[$row['PersonID']]['PrevYearSalaryCurrency'] = $row['PrevYearSalaryCurrency'];
            $persons[$row['PersonID']]['CostCenter'] = $row['CostCenter'];
            $persons[$row['PersonID']]['Department'] = $row['Department'];
            $persons[$row['PersonID']]['Division'] = $row['Division'];
            $persons[$row['PersonID']]['PrevCO'] = $row['PrevCO'];
            $persons[$row['PersonID']]['PrevInsertedCO'] = $row['PrevInsertedCO'];
            $persons[$row['PersonID']]['PrevTotalCO'] = ($row['PrevCO'] - $row['PrevInsertedCO'] > 0) ? $row['PrevCO'] - $row['PrevInsertedCO'] : 0;
            $persons[$row['PersonID']]['CurrTotalCO'] = $row['CurrTotalCO'];
            $persons[$row['PersonID']]['CurrTotalCORef'] = $row['CurrTotalCORef'];
            //$persons[$row['PersonID']]['Vacations'] = $tco[$row['PersonID']];
        }
        //Utils::pa($persons);
        //Populate the array of persons with all consumed/remaining CO

        $rem_co = array("PrevYear" => $persons['PrevYear'], "CurrYear" => $persons['CurrYear']);
        unset($persons['PrevYear']);
        unset($persons['CurrYear']);
        foreach ($persons as $PersonID => $person) {
            $curr_CO = $person['CurrTotalCO'];
            $rem_co[$PersonID]['FullName'] = $person['FullName'];
            $rem_co[$PersonID]['CNP'] = $person['CNP'];
            $rem_co[$PersonID]['PrevYearSalaryBrut'] = $person['PrevYearSalaryBrut'];
            $rem_co[$PersonID]['PrevYearSalaryCurrency'] = $person['PrevYearSalaryCurrency'];
            $rem_co[$PersonID]['CostCenter'] = $person['CostCenter'];
            $rem_co[$PersonID]['Department'] = $person['Department'];
            $rem_co[$PersonID]['Division'] = $person['Division'];
            $rem_co[$PersonID]['PrevTotalCO'] = $person['PrevTotalCO'];
            $rem_co[$PersonID]['CurrTotalCO'] = $person['CurrTotalCO'];
            $rem_co[$PersonID]['CurrTotalCORef'] = $person['CurrTotalCORef'];
            if (is_array($tco[$PersonID]))
                foreach ($tco[$PersonID] as $month => $cons_days) {
                    $rem_co[$PersonID][$month]['TCO'] = $cons_days['TCO'];
                    $rem_co[$PersonID][$month]['RemCO'] = $curr_CO - $cons_days['TCO'];
                    $curr_CO = $curr_CO - $cons_days['TCO'];
                }
            $rem_co[$PersonID]['RestTotalCO'] = $curr_CO;
        }

        //var_dump($rem_co);
        return $rem_co;
    }

    public static function getReports_161()
    {
        global $conn;

        $persons = array();

        if (empty($_GET['Year']) || empty($_GET['Month']) || $_GET['Year'] == 0 || $_GET['Month'] == 0) {
            return $persons;
        }

        if (!empty($_GET['CompanyID'])) {
            $cond .= " AND c.CompanyID = '{$_GET['CompanyID']}' ";
        }
        if (!empty($_GET['DivisionID'])) {
            $cond .= " AND c.DivisionID = '{$_GET['DivisionID']}' ";
        }
        if (!empty($_GET['Status'])) {
            $cond .= " AND a.Status = " . (int)$_GET['Status'];
        }

        $Year = (int)$_GET['Year'];
        $Month = (int)$_GET['Month'];
        $StartDate = $Year . '-' . $Month . '-01';
        $EndDate = date('Y-m-d', strtotime('last day of this month', strtotime($StartDate)));

        $arr_months = Utils::getMonthArrayShortFormat($StartDate, $EndDate);

        $calh = array(0 => 'D', 1 => 'L', 2 => 'M', 3 => 'M', 4 => 'J', 5 => 'V', 6 => 'S');

        global $cal;

        $legal = ConfigData::$msLegal;

        $st_y = (int)substr($StartDate, 0, 4);
        $st_m = (int)substr($StartDate, 5, 2);
        $st_d = (int)substr($StartDate, 8, 2);
        $i = 0;
        $j = 0;
        while (true) {
            $time = mktime(0, 0, 0, $st_m, $st_d + $i, $st_y);
            $date = date('Y-m-d', $time);
            if ($date <= $EndDate) {
                $cal[$date] = $calh[date('w', $time)];
                if ($cal[$date] != 'S' && $cal[$date] != 'D' && !array_key_exists($date, $legal)) {
                    $j++;
                }
                $i++;
            } else {
                break;
            }
        }

        $nr_lucratoare = $j;

        $persons = array();

        $query = "SELECT a.PersonID, a.FullName, a.CNP, a.Sex, 
	            c.WorkNorm, e.Division as Division, 
				b.StartDate AS PStartDate, b.EndDate AS PEndDate, b.Hours, b.Hours2
		        FROM   persons a
					INNER JOIN payroll c ON a.PersonID = c.PersonID
					LEFT JOIN divisions e ON c.DivisionID = e.DivisionID
					LEFT JOIN pontaj_detail b ON a.PersonID = b.PersonID AND b.StartDate BETWEEN '{$StartDate}' AND '{$EndDate}'
			  WHERE  1=1 $cond
			  AND (c.StartDate <= '{$EndDate}' AND (c.StopDate IS NULL OR c.StopDate = '0000-00-00' OR c.StopDate >= '{$StartDate}'))
			  ORDER  BY a.FullName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $persons[$row['PersonID']]['FullName'] = $row['FullName'];
            $persons[$row['PersonID']]['Sex'] = $row['Sex'];
            $persons[$row['PersonID']]['CNP'] = $row['CNP'];
            $persons[$row['PersonID']]['Division'] = $row['Division'];
            $persons[$row['PersonID']]['Sediu'] = '';
            if ($row['Division'] != '') {
                $lstTmp = explode(' - ', $row['Division']);
                if (count($lstTmp) > 1) {
                    $persons[$row['PersonID']]['Sediu'] = str_replace($lstTmp[0] . ' - ', '', $row['Division']);
                }
            }

            $persons[$row['PersonID']]['WorkNorm'] = $row['WorkNorm'];

            if (!empty($row['PStartDate'])) {
                @$persons[$row['PersonID']]['Data'][$row['PStartDate']] += (double)$row['Hours'];
                if ($row['PStartDate'] != $row['PEndDate']) {
                    @$persons[$row['PersonID']]['Data'][$row['PEndDate']] += (double)$row['Hours2'];
                }
            }

            $persons[$row['PersonID']]['TotalOreLucrate'] += (double)$row['Hours'];
        }

        $strPersonsId = '';
        if (count($persons) > 0)
            $strPersonsId = '(' . implode(',', array_keys($persons)) . ')';


        $query = "SELECT PersonID, StartDate, StopDate, Type, Details 
				FROM	vacations_details 
				  WHERE  ((StartDate BETWEEN '{$StartDate}' AND '{$EndDate}') OR
					 (StopDate BETWEEN '{$StartDate}' AND '{$EndDate}') OR
					 ('{$StartDate}' BETWEEN StartDate AND StopDate)) AND Aprove >= 0
					 " . (($strPersonsId != '') ? " AND PersonID IN $strPersonsId " : " AND 1=0 ") .
            " ORDER  BY StartDate";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $vacations[$row['PersonID']][] = $row;
        }

        $query = "SELECT PersonID, Salary, SalaryNet, Currency, StartDate 
					FROM persons_salary
					WHERE StartDate <= '{$EndDate}' AND (StopDate = '0000-00-00' OR StopDate >= '{$StartDate}')
					" . (($strPersonsId != '') ? " AND PersonID IN $strPersonsId " : " AND 1=0 ") .
            " ORDER BY StartDate ASC";
        $conn->query($query);
        $lstSalary = array();
        while ($row = $conn->fetch_array()) {
            $lstSalary[$row['PersonID']] = $row;
        }

        $query = "SELECT PersonID, Salary, SalaryNet, Currency
					FROM persons_salary_extra
					WHERE StartDate BETWEEN '{$StartDate}' AND '{$EndDate}' 
					AND Type = 'bonus_prime'
					" . (($strPersonsId != '') ? " AND PersonID IN $strPersonsId " : " AND 1=0 ") .
            " ORDER BY StartDate ASC";
        $conn->query($query);
        $lstBonus = array();
        while ($row = $conn->fetch_array()) {
            $lstBonus[$row['PersonID']]['Bonus'] += $row['Salary'];
            $lstBonus[$row['PersonID']]['BonusNet'] += $row['SalaryNet'];
            $lstBonus[$row['PersonID']]['BonusCurrency'] = $row['Currency'];
        }

        foreach ($persons as $PersonId => $person) {
            $persons[$PersonId]['TotalZileLucrate'] = round($person['TotalOreLucrate'] / $person['WorkNorm'], 2);
            if ($nr_lucratoare > 0)
                $persons[$PersonId]['TotalOreSupl'] = max($person['TotalOreLucrate'] - $person['WorkNorm'] * $nr_lucratoare, 0);

            if (array_key_exists($PersonId, $lstSalary)) {
                $persons[$PersonId]['SalaryBrut'] = $lstSalary[$PersonId]['Salary'];
                $persons[$PersonId]['SalaryCurrency'] = $lstSalary[$PersonId]['Currency'];
            }

            if (array_key_exists($PersonId, $lstBonus)) {
                $persons[$PersonId]['PrimaNeta'] = $lstBonus[$PersonId]['BonusNet'];
                $persons[$PersonId]['PrimaBruta'] = $lstBonus[$PersonId]['Bonus'];
                $persons[$PersonId]['PrimaCurrency'] = $lstBonus[$PersonId]['BonusCurrency'];
            }


            foreach ($cal as $date => $w) {
                if (isset($vacations[$PersonId])) {
                    foreach ($vacations[$PersonId] as $vac) {
                        if ($vac['StartDate'] <= $date && $date <= $vac['StopDate'] && $w != 'S' && $w != 'D') {
                            if (isset($person['Data'][$date])) {
                                //continue;
                            }
                            $persons[$PersonId]['Data'][$date] = $vac['Type'];
                            $persons[$PersonId]['TotalZile' . $vac['Type']] += 1;
                            $persons[$PersonId]['TotalOre' . $vac['Type']] += $person['WorkNorm'];
                            break;
                        }
                    }
                }
            }
        }

        //var_dump($persons);
        return array(0 => $nr_lucratoare, 1 => $persons);
    }

}

?>