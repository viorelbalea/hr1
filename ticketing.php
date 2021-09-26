<?php

if (!isset($_SESSION['USER_ID'])) {
    header('Location: ../');
    exit;
}

switch($o) {

    case 'new':

        if (!empty($_POST)) {

            try {

                $ticket   = new Ticketing();
                $TicketID = $ticket->addTicket($_POST);
		if (!empty($_FILES['doc']['name'])) {
            	    if (!@move_uploaded_file($_FILES['doc']['tmp_name'], 'uploads/tickets/' . md5($TicketID) . '-' . str_replace(' ', '-', basename($_FILES['doc']['name'])))) {
                	throw new Exception('Eroare incarcare document');
                    }
                }

		echo "<body onload=\"window.location.href = './?m=ticketing&o=edit&TicketID={$TicketID}&msg=1'\"></body>";
		exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }

            $smarty->assign('info', Utils::displayInfo($_POST));
        }

        $smarty->assign(array(
				'prototype'  		=> 1,
				'categories'		=> Ticketing::$msTicketingCategories,
				'types'      		=> Ticketing::$msTicketingType,
				'priority'   		=> Ticketing::$msTicketingPriority,
				'importance' 		=> Ticketing::$msTicketingImportance,
				'intervention_type' 	=> Ticketing::$msTicketingInterventionType,
				'persons'    		=> Ticketing::getPersons(),
				'companies'  		=> Ticketing::getCompanies(),
				'costcenter' 		=> Utils::getCostCenter(),
				'application_version'   => Application::getApplicationVersions(-1, true, -1, true, 'DESC'),
				
				'self'                  => Company::getSelfCompanies(),
				'divisions'             => Utils::getDivisions(),
				'departments'           => Utils::getDepartments(),
				'educational_levels'    => Person::$msEducationalLevel,
				'jobs'                  => Job::getJobsTitle(),
				'directmanager'         => Person::getPersonsByRole(1),
                            ));

        $center_file = 'ticketing_new.tpl';

    break;

    case 'edit':

	$TicketID = (int)$_GET['TicketID'];
	$ticket   = new Ticketing($TicketID);

        if (!empty($_POST) || !empty($_GET['action'])) {

            try {

                $ticket->editTicket($_POST);
		if (!empty($_FILES['doc']['name'])) {
            	    if (!@move_uploaded_file($_FILES['doc']['tmp_name'], 'uploads/tickets/' . md5($TicketID) . '-' . str_replace(' ', '-', basename($_FILES['doc']['name'])))) {
                	throw new Exception('Eroare incarcare document');
                    }
                }

		echo "<body onload=\"window.location.href = './?m=ticketing&o=edit&TicketID={$TicketID}&msg=1'\"></body>";
		exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }
	
	$docs = array();
	foreach ((array)glob('uploads/tickets/' . md5($TicketID) . '-*') as $item) {
	    $docs[$item] = str_replace(md5($TicketID) . '-', '', basename($item));
	}

        $smarty->assign(array(
				'prototype'  		=> 1,
				'categories'            => Ticketing::$msTicketingCategories,
				'status'     		=> Ticketing::$msTicketingStatus,
				'types'      		=> Ticketing::$msTicketingType,
				'priority'   		=> Ticketing::$msTicketingPriority,
				'importance' 		=> Ticketing::$msTicketingImportance,
				'intervention_type' 	=> Ticketing::$msTicketingInterventionType,
				'persons'    		=> Ticketing::getPersons(),
				'companies'  		=> Ticketing::getCompanies(),
				'costcenter' 		=> Utils::getCostCenter(),
            			'info'       		=> !empty($_POST) ? Utils::displayInfo($_POST) : $ticket->getTicket(),
				'history'    		=> $ticket->getTicketHistory(),
				'docs'       		=> $docs,
				'application_version'   => Application::getApplicationVersions(-1, true, -1, true, 'DESC'),
				
				'self'                  => Company::getSelfCompanies(),
				'divisions'             => Utils::getDivisions(),
				'departments'           => Utils::getDepartments(),
				'educational_levels'    => Person::$msEducationalLevel,
				'jobs'                  => Job::getJobsTitle(),
				'directmanager'         => Person::getPersonsByRole(1),
                            ));

        $center_file = 'ticketing_new.tpl';

    break;
	
	case 'print-report':

		$TicketID = (int)$_GET['TicketID'];
		$ticket   = new Ticketing($TicketID);
	
        $smarty->assign(array(
				'prototype'  		=> 1,
            	'info'       		=> $ticket->getTicketForReport(),
            ));

		$smarty->display('ticketing_report.tpl');
		exit;

		break;

    case 'del':
    
		$TicketID = (int)$_GET['TicketID'];
		$ticket   = new Ticketing($TicketID);
		$ticket->delTicket();
		
		echo "<body onload=\"window.location.href = './?m=ticketing'\"></body>";
		exit;

    break;

    default:

	if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS2'][30][1] > 0)) {
	    $center_file = 'ticketing_menu.tpl';
	    return;
	}

        $action = !empty($_GET['action']) ? $_GET['action'] : 'default';
	$tickets   		= Ticketing::getAllTickets($action);
	$personalisedlist 	= Utils::getPersonalisedList('Ticketing');
	$status     		= Ticketing::$msTicketingStatus;
	$types     		= Ticketing::$msTicketingType;
	$priority               = Ticketing::$msTicketingPriority;
	$importance             = Ticketing::$msTicketingImportance;
	$persons    = Ticketing::getPersons();
	$companies		= Ticketing::getCompanies();
	$departments   	= Utils::getDepartments();
	$application_version = Application::getApplicationVersions(-1, true, -1, false, 'DESC');
	

        switch ($action) {
            case 'export':
		header("Content-Type: application/vnd.ms-excel");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("content-disposition: attachment;filename=tichete.xls");
		$smarty->assign(array(
					'types' 		=> $types,
					'status' 		=> $status,
					'priority'              => $priority,
					'importance'            => $importance,
					'companies'            => $companies,
					'departments'            => $departments,
					'personalisedlist' 	=> $personalisedlist,
					'res_per_page'  	=> empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
					'tickets'          	=> $tickets,
					'application_version' => $application_version,
	                            ));
                $smarty->display('ticketing_print.tpl');
                exit;
            break;
            case 'export_doc':
	        header("Content-Type: application/vnd.ms-word");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("content-disposition: attachment;filename=tichete.doc");
		$smarty->assign(array(
					'types' 		=> $types,
					'status' 		=> $status,
					'priority'              => $priority,
					'importance'            => $importance,
					'companies'            => $companies,
					'departments'            => $departments,
					'personalisedlist' 	=> $personalisedlist,
					'res_per_page'  	=> empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
					'tickets'          	=> $tickets,
					'application_version' => $application_version,
	                            ));
                $smarty->display('ticketing_print.tpl');
                exit;
            break;
            case 'print_page':
            case 'print_all':
		$smarty->assign(array(
					'types' 		=> $types,
					'status' 		=> $status,
					'priority'              => $priority,
					'importance'            => $importance,
					'companies'            => $companies,
					'departments'            => $departments,
					'personalisedlist' 	=> $personalisedlist,
					'res_per_page'  	=> empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
					'tickets'          	=> $tickets,
					'application_version' => $application_version,
                                    ));
                $smarty->display('ticketing_print.tpl');
                exit;
            break;
            default:
            	$request_uri = !empty($_GET['res_per_page']) ? "./?m=ticketing&Type={$_GET['Type']}&Status={$_GET['Status']}&AssignedPersonID={$_GET['AssignedPersonID']}&DateStart={$_GET['DateStart']}&DateEnd={$_GET['DateEnd']}&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}" : "./?m=ticketing";
                $smarty->assign(array(
					'types' 		=> $types,
					'status' 		=> $status,
					'priority'              => $priority,
					'importance'            => $importance,
                	'companies'            => $companies,
                	'departments'            => $departments,
                	'asignees'			=>$persons,
					'personalisedlist' 	=> $personalisedlist,
                	'request_uri' 		=> $request_uri,
					'tickets'          	=> $tickets,
					'application_version' => $application_version,
                                    ));
		$pagination = Utils::paginate($tickets[0]['pageNo'], $tickets[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
		$smarty->assign('pagination',$pagination);
                $center_file = 'ticketing.tpl';
					
            break;
        }

    break;
}

?>