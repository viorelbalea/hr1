<?php

function __autoload($className)
{
    include('libs/' . $className . '.php');
}

include('libs/DB.class.php');
include('libs/Smarty.class.php');
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);
try {

    session_start();

    @$conn = new DB(Config::MYSQL_HOST, Config::MYSQL_USER, Config::MYSQL_PASS, Config::MYSQL_DBNAME);

    $o = !empty($_GET['o']) ? $_GET['o'] : 'default';

    switch ($_GET['o']) {
        case 'LoadComputerName':
            echo '
					<select name="ComputerName" id="ComputerName">
						<option value="0">Nume computer</option>
					';
            $sql = "select * from inventar where CompanyId=" . $_GET['CompanyID'];
            $res = mysql_query($sql);
            while ($row = mysql_fetch_array($res)) {
                $aux = "";
                if ($row['ObjID'] == $_GET['CurValue'])
                    $aux = ' selected="selected"';
                echo '<option value="' . $row['ObjID'] . '" ' . $aux . '>' . $row['ObjName'] . '</option>';
            }
            echo '
					</select>
				';
            break;
        default:
        case 'city':

            $listArr = Address::getCities($_GET['districtID']);
            $list = '<select name="CityID"><option value="">alege...</option>';
            foreach ($listArr as $k => $v) {
                $list .= '<option value="' . $k . '"' . ($k == $_GET['CityID'] ? 'selected' : '') . '>' . $v . '</option>';
            }
            echo $list . '</select>';
            exit;

            break;

        case 'Oras':
//			echo "Judet: ".$_GET['Judet']."<br />Oras: ".$_GET['Oras']."<br />";
            if (!empty($_GET['companyID'])) {// radu: fix bug afisare oras la editare
                $query = "SELECT Oras FROM companies WHERE CompanyID =" . $_GET['companyID'];
                $conn->query($query);
                while ($row = $conn->fetch_array()) {
                    $cityId = $row['Oras'];
                }
            }

            $listArr = Address::getCities($_GET['Judet']);
            $list = '<select name="Oras"><option value="">alege...</option>';
            foreach ($listArr as $k => $v) {
                $list .= '<option value="' . $k . '"' . ($k == ($_GET['companyID'] ? $cityId : $_GET['Oras']) ? 'selected' : '') . '>' . $v . '</option>';
            }
            echo $list . '</select>';
            exit;

            break;

        case 'birth_city':

            $listArr = Address::getCities($_GET['districtID']);
            $list = '<select name="BirthCityID"><option value="">alege...</option>';
            foreach ($listArr as $k => $v) {
                $list .= '<option value="' . $k . '"' . ($k == $_GET['CityID'] ? 'selected' : '') . '>' . $v . '</option>';
            }
            echo $list . '</select>';
            exit;

            break;

        case 'street':

            echo '<input type="text" name="StreetName" size="30" maxlength="128" value="' . Address::getStreetByCode($_GET['districtID'], $_GET['city'], $_GET['code']) . '">';

            break;

        case 'jobtitle':

            $listArr = Job::getJobsTitle();
            $list = '';
            foreach ($listArr as $v) {
                $list .= $v . "\n";
            }
            echo $list;
            exit;

            break;

        case 'function':

            $listArr = Utils::getNomCorAjax($_POST['data']);
            $dataList = array();
            foreach ($listArr as $k => $v) {
                $dataList[] = '<li id="' . $k . '"><a href="#">' . htmlentities($v) . '</a></li>';
            }

            if (count($dataList) >= 1) {
                $dataOutput = join("\r\n", $dataList);
                echo $dataOutput;
            } else {
                echo '<li><a href="#">Nu exista rezultate</a></li>';
            }

            exit;

            break;

        case 'domain':

            $listArr = Utils::getNomCaenAjax($_POST['data']);
            $dataList = array();
            foreach ($listArr as $k => $v) {
                $dataList[] = '<li id="' . $k . '"><a href="#">' . htmlentities($v) . '</a></li>';
            }

            if (count($dataList) >= 1) {
                $dataOutput = join("\r\n", $dataList);
                echo $dataOutput;
            } else {
                echo '<li><a href="#">Nu exista rezultate</a></li>';
            }
            exit;

            break;

        case 'trainingtype':

            $trainings = Company::getTrainingTypeByCompany($_GET['CompanyID']);
            $list = '<select name="TrainingTypeID">';
            foreach ($trainings as $k => $v) {
                $list .= '<option value="' . $k . '" ' . ($k == $_GET['TrainingTypeID'] ? 'selected' : '') . '>' . $v . '</option>';
            }
            echo $list . '</select>' . (!empty($_GET['addtraining']) ? '' : '&nbsp;&nbsp;&nbsp;<input type="checkbox" name="Type" value="1" ' . (!empty($_GET['Type']) ? 'checked' : '') . ' onclick="if (this.checked == true) {document.getElementById(\'div_trn\').style.display = \'none\'; document.getElementById(\'div_emp\').style.display = \'block\';} else {document.getElementById(\'div_emp\').style.display = \'none\'; document.getElementById(\'div_trn\').style.display = \'block\';}"> intern');
            exit;

            break;

        case 'trainingperson':

            $CompanyID = (int)$_GET['CompanyID'];
            $company = new Company($CompanyID);

            $persons = $company->getCompanyContacts();
            $list = '<select name="PersonID" id="PersonID">';
            if (!empty($persons)) {
                foreach ($persons as $v) {
                    $list .= '<option value="' . $v['ContactID'] . '" ' . ($v['ContactID'] == $_GET['PersonID'] ? 'selected' : '') . '>' . $v['ContactName'] . '</option>';
                }
            }
            echo $list . '</select>';
            exit;

            break;

        case 'trainingpersonintern':
            $CompanyID = (int)$_GET['CompanyID'];
            $company = new Company($CompanyID);

            $persons = $company->getCompanyTrainers();

            $list = '<select name="PersonID" id="PersonID">';
            foreach ($persons as $k => $v) {
                $list .= '<option value="' . $k . '" ' . ($k == $_GET['PersonID'] ? 'selected' : '') . '>' . $v['FullName'] . '</option>';
            }
            echo $list . '</select>';
            exit;

            break;

        case 'department':

            $departments = Utils::getDepartments();
            $list = '<select name="DepartmentID" onchange="showInfo(\'ajax.php?o=subdepartment&DepartmentID=\' + this.value, \'SubDepartmentID\');" class="dropdown"><option value="0">alege...</option>';
            foreach ($departments as $k => $v) {
                $selected = '';
                if ($k == $_GET['DepartmentID']) // check selected
                    $selected = "selected='selected'";
                $list .= "<option value='$k' $selected>" . $v . "</option>";
            }
            echo $list . '</select>';
            exit;

            break;

        case 'subdepartment':

            $subdepartments = Utils::getSubDepartments();
            $list = '<select name="SubDepartmentID" onchange="showInfo(\'ajax.php?o=subsubdepartment&SubDepartmentID=\' + this.value, \'SubSubDepartmentID\');" class="dropdown"><option value="0">alege...</option>';
            foreach ($subdepartments as $k => $v) {
                $selected = '';
                if ($k == $_GET['SubDepartmentID']) // check selected
                    $selected = "selected='selected'";
                $list .= "<option value='$k' $selected>" . $v . "</option>";
            }
            echo $list . '</select>';
            exit;

            break;

        case 'subsubdepartment':

            $subsubdepartments = Utils::getSubSubDepartments();
            $list = '<select name="SubSubDepartmentID" class="dropdown"><option value="0">alege...</option>';
            foreach ($subsubdepartments as $k => $v) {
                $selected = '';
                if ($k == $_GET['SubSubDepartmentID']) // check selected
                    $selected = "selected='selected'";
                $list .= "<option value='$k' $selected>" . $v . "</option>";
            }
            echo $list . '</select>';
            exit;

            break;

        case 'personsbyfunction':

            $persons = array();
            $persons = Evals::getPersonsByFunction($_GET['FunctionID']);
            //Utils::pa($persons);
            if (!empty($persons)) {
                $list = '<select id="PersonID" name="PersonID[]" class="cod" multiple="multiple" size="10">';
                foreach ($persons as $person) {
                    $list .= '<option value="' . $person['PersonID'] . '">' . $person['FullName'] . '</option>';
                }
                echo $list . '</select><br />Pentru selectie multipla tineti tasta <strong>Ctrl</strong> apasata';
            } else
                echo "Nu exista persoane cu aceasta functie!";
            exit;

            break;

        case 'functionsbycompany':
            $functions = array();
            $functions = Utils::getGroupAvailableFunctions($_GET['CompanyID']);

            if (!empty($functions)) {
                $list = '<select id="InternalFunction" name="InternalFunction" class="cod" >';
                foreach ($functions as $group) {
                    $first = current($group);
                    $list .= "<optgroup label='{$first['GroupName']}'>";
                    if (!empty($group)) {
                        foreach ($group as $key => $function) {
                            if ($function['FunctionID'] == $_GET['FunctionID']) // check selected
                                $selected = "selected='selected'";
                            if ($function['PositionsFree'] <= 0) // check selected
                                $disabled = "disabled='disabled' onclick=\"alert('Numarul de pozitii pentru aceasta functie in cadrul companiei selectate a fost epuizat. Pentru a putea face alocarea, modificati numarul de pozitii disponibile din modulul Organigrama.');\"";
                            $list .= '<option value="' . $function['FunctionID'] . '" ' . $selected . ' ' . $disabled . '>' . $function['Function'] . ' [' . $function['GroupName'] . ' | ' . $function['Grad'] . ']' . '</option>';
                            $selected = '';
                            $disabled = '';
                        }
                    }
                    $list .= "</optgroup>";
                }
                echo $list . '</select>';
            } else
                echo "Nu exista functii alocate acestei companii!";
            exit;

            break;


        case 'personsbyfunction-colleagues':

            $persons = array();
            $persons = Evals::getPersonsByFunction($_GET['FunctionID']);
            //Utils::pa($persons);
            if (!empty($persons)) {
                $list = '<select id="PersonID" name="PersonID" class="cod">';
                foreach ($persons as $person) {
                    $list .= '<option value="' . $person['PersonID'] . '">' . $person['FullName'] . '</option>';
                }
                echo $list . '</select>';
            } else
                echo "Nu exista persoane cu aceasta functie!";
            exit;

            break;

        case 'recipients-internal':

            $companies = Company::getSelfCompaniesData();
            //Utils::pa($companies);

            // Show the ones from selected company
            if ($_GET['CompanyID'] == 'undefined' || $_GET['CompanyID'] == 999999999)
                $_GET['CompanyID'] = 0;

            $NewsletterID = ($_GET['NewsletterID']) ? $_GET['NewsletterID'] : 0;

            if ($NewsletterID > 0) {
                $news = new Newsletter($NewsletterID);
                $newsData = $news->getNewsletter();
                $lstRecipients = $newsData['LstRecipients'];
            }
            $persons = Person::getAllPersons("", 1);
            $list = '<div style="overflow-y:scroll; width:500px; height:200px; border:solid 1px #333;">';
            foreach ($persons as $k => $v) {
                if ($v['Email'] != '')
                    $list .= '<div style="height:20px;"><input name="Recipients[' . $v['PersonID'] . ']" type="checkbox" ' . (($lstRecipients && count($lstRecipients) > 0 && array_key_exists($v['PersonID'], $lstRecipients)) ? ' checked="checked" ' : '') . ' value="' . $v['Email'] . '" />&nbsp;' . $v['Email'] . ' (' . $v['FullName'] . ')' . '</div>';
            }
            foreach ($companies as $k => $v) {
                if ($v['CompanyEmail'] != '')
                    $list .= '<div style="height:20px;"><input name="Recipients[c' . $v['CompanyID'] . ']" type="checkbox" checked="checked" value="' . $v['CompanyEmail'] . '" />&nbsp;' . $v['CompanyEmail'] . ' (' . $v['CompanyName'] . ')' . '</div>';
            }
            // Show the ones from different companies
            if ($_GET['CompanyID'] != 'undefined' && $_GET['CompanyID'] != 999999999) {
                $companyID = $_GET['CompanyID'];
                $_GET['CompanyID'] = 0;
                $persons = Person::getAllPersons("", "AND f.CompanyID!=$companyID", 1);

                foreach ($persons as $k => $v) {
                    if ($v['Email'] != '')
                        $list .= '<div style="height:20px; color:#555;"><input name="Recipients[' . $v['PersonID'] . ']" type="checkbox" value="' . $v['Email'] . '" />&nbsp;' . $v['Email'] . ' (' . $v['FullName'] . ')' . '</div>';
                }
            }
            echo $list . '</div>';
            exit;

            break;

        case 'recipients-external':

            $persons = array();
            // Show the ones from selected company
            if ($_GET['CompanyID'] == 'undefined' || $_GET['CompanyID'] == 999999999) {
                $_GET['CompanyID'] = 0;
                $companies = Company::getCompaniesList(' AND Self!=1');
                $companyItem['Contacts'] = array();
                foreach ($companies as $companyID => $companyItem) {
                    if ($companyItem['CompanyEmail'] != '') {
                        $persons[] = $companyItem['CompanyEmail'];
                        if (!empty($companyItem['Contacts'])) {
                            foreach ($companyItem['Contacts'] as $contactID => $contactItem) {
                                if ($contactItem['ContactEmail'] != '')
                                    $persons[] = $contactItem['ContactEmail'];
                            }

                        }
                    }

                }
            } // Get company data
            else if ($_GET['CompanyID'] != 'undefined' && $_GET['CompanyID'] != 999999999) {
                $Company = new Company($_GET['CompanyID']);
                $companyData = $Company->getCompany();
                if ($companyData['CompanyEmail'] != '')
                    $persons[] = $companyData['CompanyEmail'];

                $companyContacts = $Company->getCompanyContacts();
                if (!empty($companyContacts)) {
                    foreach ($companyContacts as $contact)
                        if ($contact['ContactEmail'] != '')
                            $persons[] = $contact['ContactEmail'];
                }
            }

            $NewsletterID = ($_GET['NewsletterID']) ? $_GET['NewsletterID'] : 0;

            if ($NewsletterID > 0) {
                $news = new Newsletter($NewsletterID);
                $newsData = $news->getNewsletter();
                $lstRecipients = $newsData['LstRecipients'];
            }

            $list = '<div style="overflow-y:scroll; width:500px; height:200px; border:solid 1px #333;">';
            foreach ($persons as $k => $v) {
                $list .= '<div style="height:20px;"><input name="Recipients[' . $k . ']" type="checkbox"' . (($lstRecipients && count($lstRecipients) > 0 && in_array($v, $lstRecipients)) ? ' checked="checked" ' : '') . ' value="' . $v . '" />&nbsp;' . $v . '</div>';
            }
            // Show the ones from different companies
            if ($_GET['CompanyID'] != 'undefined' && $_GET['CompanyID'] != 999999999) {
                $companies = Company::getCompaniesList("AND CompanyID!='{$_GET['CompanyID']}'");
                $companyItem['Contacts'] = array();
                foreach ($companies as $companyID => $companyItem) {
                    if ($companyItem['CompanyEmail'] != '') {
                        $persons[] = $companyItem['CompanyEmail'];
                        if (!empty($companyItem['Contacts'])) {
                            foreach ($companyItem['Contacts'] as $contactID => $contactItem) {
                                if ($contactItem['ContactEmail'] != '')
                                    $persons[] = $contactItem['ContactEmail'];
                            }

                        }
                    }
                }

                foreach ($persons as $k => $v) {
                    if ($v['Email'] != '')
                        $list .= '<div style="height:20px; color:#555;"><input name="Recipients[' . $v . ']" type="checkbox" value="' . $v . '" />&nbsp;' . $v . '</div>';
                }
            }
            echo $list . '</div>';
            exit;

            break;

        case 'project':

            $project = Project::getProject((int)$_GET['ProjectID']);
            $content = '<table cellspacing="0" cellpadding="4">
	                <tr><td>Cod proiect:</td><td>' . $project['Code'] . '</td></tr>
			<tr><td>Statut proiect:</td><td>' . Project::$msProjectTypes[$project['Type']] . '</td></tr>
			<tr><td>Locatie:</td><td>' . $project['Address'] . '</td></tr>
			<tr><td>Sursa de finantare:</td><td>' . Project::$msFinancialSources[$project['FinancialSource']] . '</td></tr>
			<tr><td>Beneficiar final:</td><td>' . $project['Beneficiary'] . '</td></tr>
			</table>';
            echo $content;

            break;

        case 'vacation_docs':

            $id = (int)$_GET['id'];
            $dir = 'uploads/vacations/' . $id;

            if (!empty($_FILES)) {
                if ($id == 0 && is_dir($dir)) {
                    foreach ((array)glob($dir . '/*') as $item) {
                        @unlink($item);
                    }
                }
                if (!is_dir($dir)) {
                    mkdir($dir, 0775);
                }
                if (@move_uploaded_file($_FILES['doc']['tmp_name'], $dir . '/' . str_replace(' ', '-', basename($_FILES['doc']['name'])))) {
                    echo 'Documentul a fost incarcat!';
                } else {
                    echo 'Eroare incarcare document!';
                }
                exit;
            }

            if ($id > 0) {
                if (!empty($_GET['del'])) {
                    @unlink($_GET['del']);
                }
                foreach ((array)glob($dir . '/*') as $item) {
                    echo '[<a href="#" onclick="if (confirm(\'Sunteti sigur(a)?\')) showInfo(\'' . $_SERVER['REQUEST_URI'] . '&del=' . urlencode($item) . '\', \'layer_doc_content\'); return false;" title=\'Sterge document\'">sterge</a>]&nbsp<a href="' . $item . '" target="_blank">' . basename($item) . '</a><br><br>';
                }
            }

            echo '<div id="layer_doc_scroll" class="layerContent"><form id="file_upload_form" action="' . $_SERVER['REQUEST_URI'] . '" method="post" enctype="multipart/form-data" onsubmit="document.getElementById(\'file_upload_form\').target = \'upload_target\';">
	          Document nou:&nbsp;<input type="file" name="doc">&nbsp;
      </div>
      <div class="saveObservatii">
		  <input type="submit" value="Salveaza">
		  <input type="button" value="Anuleaza" onclick="document.getElementById(\'layer_doc\').style.display = \'none\'; document.getElementById(\'layer_doc_x\').style.display = \'none\';">
		  </div>
      <iframe id="upload_target" name="upload_target" src="" style="width:0px;height:0px;border:0px solid #fff;"></iframe>
		  </form>';

            break;

        case 'assurance':

            $listArr = Car::getCostType(0, array((int)$_GET['CostTypeID']), true);
            $list = '<select id="CostTypeID_Dictionary"><option value="">alege...</option>';
            foreach ($listArr as $k => $v) {
                $list .= '<option value="' . $k . '"' . ($k == $_GET['CostTypeID_Dictionary'] ? 'selected' : '') . '>' . $v . '</option>';
            }
            echo $list . '</select>';
            exit;

            break;

        case 'getCarDictionaryValue':
            $dictId = (int)$_GET['DictionaryID'];
            $dictionary = Car::getDictionary($dictId);

            $out = '<input type="text" id="aj_um_value" value="' . $dictionary[$dictId]['UM_Value'] . '" />
                    <input type="text" id="aj_cost" value="' . $dictionary[$dictId]['Cost'] . '" />';
            echo $out;
            exit;
            break;

        case 'getCostType':
            $cost_group = (int)$_GET['CostGroup'];

            $cost_types = Car::getCostTypeDictionary($cost_group);

            $out = '<select id="CostTypeID" name="CostTypeID" class="cod">
                        <option value="0">Tip cheltuiala</option>';

            foreach ($cost_types as $costid => $cost) {
                $out .= '<option value="' . $costid . '">' . $cost['CostType'] . '</option>';
            }

            $out .= '</select>';
            echo $out;
            exit;
            break;

        case 'getCheckups':
            $car_id = (int)$_GET['CarID'];
            $checkup_id = (int)$_GET['CheckupID'];

            $checkups = Car::getAvailableCheckups($car_id, $checkup_id);

            $out = '<select id="CheckupID" name="CheckupID" style="max-width: 140px;">';
            foreach ($checkups as $id => $checkup) {
                $out .= '<option value="' . $id . '">Revizie - ' . $checkup['Km'] . ' Km</option>';
            }

            $out .= '</select>';

            echo $out;
            exit;
            break;

        case 'offer_products':

            if (isset($_GET['ActProdID'])) {
                Product::setProductsByOffer($_GET['ActivityDetID'], $_GET['OfferIndex']);
            }

            $smarty = new Smarty();
            $smarty->template_dir .= '/' . Config::$msAppLng;
            $smarty->compile_dir .= '/' . Config::$msAppLng;
            $offer_products = array();
            if (!empty($_GET['OfferIndex']) && $_GET['OfferIndex'] > 0)
                $offer_products = Product::getProductsByOffer($_GET['ActivityDetID'], $_GET['OfferIndex']);

            $smarty->assign(array(
                'offer_products' => $offer_products,
                'products' => Product::getProducts(),
                'products_suggest' => base64_encode(json_encode(Product::getProductsSuggestions())),

            ));

            echo $smarty->fetch('sales_activity_products.tpl');
            exit;

            break;


        case 'reports_rights':

            $ReportID = (int)$_GET['ReportID'];

            $smarty = new Smarty();
            $smarty->template_dir .= '/' . Config::$msAppLng;
            $smarty->compile_dir .= '/' . Config::$msAppLng;

            $smarty->assign(array(
                'rights' => Utils::getReportRights($ReportID),
                'groups' => Utils::getReportGroups(),
                'types' => Ticket::$msTicketType,
            ));

            echo $smarty->fetch('admin_reports_rights_layer.tpl');
            exit;

            break;

        case 'reports_rights_alloc':

            $smarty = new Smarty();
            $smarty->template_dir .= '/' . Config::$msAppLng;
            $smarty->compile_dir .= '/' . Config::$msAppLng;

            $rights = array();
            $conn->query("SELECT UserID, UserName, UserType FROM users WHERE UserID > 1 ORDER BY UserName");
            while ($row = $conn->fetch_array()) {
                $rights[$row['UserType']][$row['UserID']] = $row['UserName'];
            }

            $smarty->assign(array(
                'reports' => $_GET['reports'],
                'rights' => $rights,
                'groups' => Utils::getReportGroups(),
                'types' => Ticket::$msTicketType,
            ));

            echo $smarty->fetch('admin_reports_rights_alloc_layer.tpl');
            exit;
            break;

        case 'check_person_inventar' :
            $lPersonId = (int)$_GET['PersonID'];
            $lObjectId = (int)$_GET['MobileTerminal'];
            $lMobileId = (int)$_GET['Mobile'];
            $xStartDate = $_GET['StartDate'];
            $xStopDate = $_GET['StopDate'];

            $result = Application::checkPersonPhoneInventar($lPersonId, $lObjectId, $lMobileId, $xStartDate, $xStopDate);

            header('Content-type: application/json');
            echo json_encode($result);

            exit;

            break;
    }

} catch (Exception $exp) {

    echo $exp->getMessage();
}

?>