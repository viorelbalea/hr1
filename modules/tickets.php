<?php

if (!isset($_SESSION['USER_ID'])) {
    header('Location: ../');
    exit;
}

switch ($o) {

    case 'new':

        $status = array(3 => Ticket::$msTicketStatus[3]);

        if (!empty($_POST)) {

            try {

                $ticket = new Ticket();
                $TicketID = $ticket->addTicket($_POST);

                echo "<body onload=\"window.location.href = './?m=tickets&o=edit&TicketID={$TicketID}&msg=1'\"></body>";
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }

            $smarty->assign('info', Utils::displayInfo($_POST));
        }
        //Utils::pa(Ticket::$msTicketType);
        $smarty->assign(array(
            'reports' => Ticket::getReportsByTypes(),
            'types' => Ticket::$msTicketType,
            'services' => Ticket::$msTicketServices,
            'status' => $status,
            'departments' => Utils::getDepartments(),
        ));

        $center_file = 'tickets_new.tpl';

        break;

    case 'edit':

        $TicketID = (int)$_GET['TicketID'];
        $Ticket = new Ticket($TicketID);
        $ticket = $Ticket->getTicket();
        $types = array($ticket['Type'] => Ticket::$msTicketType[$ticket['Type']]);

        if (!empty($_POST) || !empty($_GET['action'])) {

            try {

                $Ticket->editTicket($_POST);

                echo "<body onload=\"window.location.href = './?m=tickets&o=edit&TicketID={$TicketID}&msg=1'\"></body>";
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }

        $smarty->assign(array(
            'reports' => Ticket::getReportsByTypes(),
            'types' => $types,
            'services' => Ticket::$msTicketServices,
            'status' => Ticket::$msTicketStatus,
            'departments' => Utils::getDepartments(),
            'info' => !empty($_POST) ? Utils::displayInfo($_POST) : $ticket,
        ));

        $center_file = 'tickets_new.tpl';

        break;

    case 'del':

        $TicketID = (int)$_GET['TicketID'];
        $ticket = new Ticket($TicketID);
        $ticket->delTicket();

        echo "<body onload=\"window.location.href = './?m=tickets'\"></body>";
        exit;

        break;


    default:

        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS2'][29][1] > 0)) {
            $center_file = 'tickets_menu.tpl';
            return;
        }

        $action = !empty($_GET['action']) ? $_GET['action'] : 'default';
        $tickets = Ticket::getAllTickets($action);
        $personalisedlist = Utils::getPersonalisedList('Ticket');

        $self = Company::getSelfCompanies();
        $divisions = Utils::getDivisions();
        $departments = Utils::getDepartments();
        $subdepartments = Utils::getSubDepartments();
        //$costcenter       	= Utils::getCostCenter();
        $types = Ticket::$msTicketType;
        $status = Ticket::$msTicketStatus;
        $services = Ticket::$msTicketServices;

        //Utils::pa($tickets);

        switch ($action) {
            case 'export':
                unset($tickets[0]);
                $excel = array();
                foreach ($tickets as $k => $ticket) {
                    if ($ticket['TicketType'] == 1)
                        $excel[$k]['Cerere'] = $ticket['Report'];
                    if ($ticket['TicketType'] == 2)
                        $excel[$k]['Cerere'] = $services[$ticket['ReportID']];
                    if ($ticket['TicketType'] == 3)
                        $excel[$k]['Cerere'] = 'Diverse';
                    if (empty($personalisedlist['Ticket'])) {
                        $excel[$k]['Nume'] = $ticket['FullName'];
                        $excel[$k]['Tip'] = $types[$ticket['TicketType']];
                        $excel[$k]['Status'] = $status[$ticket['TicketStatus']];
                        $excel[$k]['Comentarii'] = $ticket['Comments'];
                        $excel[$k]['Data'] = $ticket['TCreateDate'];
                        $excel[$k]['Data limita'] = $ticket['TLimitDate'];
                    } else {
                        foreach ($personalisedlist['Ticket'] AS $field => $name) {
                            if ($field == 'Status')
                                $excel[$k][$name] = $status[$ticket['TicketStatus']];
                            elseif ($field == 'Type')
                                $excel[$k][$name] = $types[$ticket['TicketType']];
                            elseif ($field == 'CreateDate')
                                $excel[$k][$name] = $ticket['TCreateDate'];
                            elseif ($field == 'LimitDate')
                                $excel[$k][$name] = $ticket['TLimitDate'];
                            elseif ($field == 'CompanyID')
                                $excel[$k][$name] = $self[$ticket[$field]];
                            elseif ($field == 'DivisionID')
                                $excel[$k][$name] = $divisions[$ticket[$field]];
                            elseif ($field == 'DepartmentID')
                                $excel[$k][$name] = $departments[$ticket[$field]];
                            elseif ($field == 'SubDepartmentID')
                                $excel[$k][$name] = $subdepartments[$ticket[$field]];
                            /*elseif($field == 'CostCenterID')
                                $excel[$k][$name] = $person['CostCenters'];*/
                            else
                                $excel[$k][$name] = $ticket[$field];
                        }
                    }
                }
                include("libs/xlsStream.php");
                export_file($excel, 'cereri');
                break;
            case 'export_doc':
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=cereri.doc");
                $smarty->assign(array(
                    'types' => $types,
                    'services' => $services,
                    'status' => $status,
                    'self' => $self,
                    'divisions' => $divisions,
                    'departments' => $departments,
                    'subdepartments' => $subdepartments,
                    //'costcenter'       	=> $costcenter,
                    'personalisedlist' => Utils::getPersonalisedList('Ticket'),
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    'tickets' => $tickets,
                ));
                $smarty->display('tickets_print.tpl');
                exit;
                break;
            case 'print_page':
            case 'print_all':
                $smarty->assign(array(
                    'types' => $types,
                    'services' => $services,
                    'status' => $status,
                    'self' => $self,
                    'divisions' => $divisions,
                    'departments' => $departments,
                    'subdepartments' => $subdepartments,
                    //'costcenter'       	=> $costcenter,
                    'personalisedlist' => Utils::getPersonalisedList('Ticket'),
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    'tickets' => $tickets,
                ));
                $smarty->display('tickets_print.tpl');
                exit;
                break;
            default:
                $request_uri = !empty($_GET['res_per_page']) ? "./?m=tickets&Type={$_GET['Type']}&Status={$_GET['Status']}&CompanyID={$_GET['CompanyID']}&DepartmentID={$_GET['DepartmentID']}&SubDepartmentID={$_GET['SubDepartmentID']}&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}" : "./?m=tickets";
                $smarty->assign(array(
                    'types' => $types,
                    'services' => $services,
                    'status' => $status,
                    'self' => $self,
                    'divisions' => $divisions,
                    'departments' => $departments,
                    'subdepartments' => $subdepartments,
                    //'costcenter'       	=> $costcenter,
                    'personalisedlist' => Utils::getPersonalisedList('Ticket'),
                    'request_uri' => $request_uri,
                    'tickets' => $tickets,
                ));
                $pagination = Utils::paginate($tickets[0]['pageNo'], $tickets[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
                $smarty->assign('pagination', $pagination);
                $center_file = 'tickets.tpl';
                break;
        }

        break;
}

?>