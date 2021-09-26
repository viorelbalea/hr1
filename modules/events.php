<?php

if (!isset($_SESSION['USER_ID'])) {
    header('Location: ../');
    exit;
}

switch ($o) {

    case 'new':
    case 'new_interview':

        if (!empty($_POST)) {

            try {

                $event = new Event();
                $EventID = $event->addEvent($_POST);

                header('Location: ./?m=events&o=edit&EventID=' . $EventID);
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }

            $smarty->assign('info', Utils::displayInfo($_POST));
        }

        for ($i = 0; $i <= 23; $i++) {
            $j = $i <= 9 ? '0' . $i : $i;
            $hours[$j . ':00'] = $j . ':00';
            $hours[$j . ':15'] = $j . ':15';
            $hours[$j . ':30'] = $j . ':30';
            $hours[$j . ':45'] = $j . ':45';
        }

        $smarty->assign(array(
            'eventType' => Event::$msEventType,
            'eventRelation' => Event::$msEventRelation,
            'consultants' => Person::getConsultants(),
            'rooms' => Utils::getSitesByRooms(),
            'hours' => $hours,
            'projects' => Project::getActiveProjects(),
            'customfields' => Utils::getCustomFields(),
        ));

        $center_file = 'event_new.tpl';

        break;

    case 'edit':

        $EventID = (int)$_GET['EventID'];
        $event = new Event($EventID);

        if (!empty($_POST) || !empty($_GET['action'])) {

            try {

                $event->editEvent($_POST);

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }

        } elseif (!empty($_GET['mail'])) {
            $conn->query("SELECT c.FullName, c.Email, DATE_FORMAT(a.EventData, '%d.%m.%Y') AS EventData,
    		                     a.FeedBack, a.FeedBackType, a.FeedBackBody, e.JobTitle
    		              FROM   events a
    		                     INNER JOIN event_persons b ON a.EventID = b.EventID
    		                     INNER JOIN persons c ON b.PersonID = c.PersonID
    		                     INNER JOIN jobs d ON a.InterviewJobID = d.JobID
    		                     INNER JOIN jobsdictionary e ON d.JobDictionaryID = e.JobDictionaryID
    		              WHERE  a.EventID = $EventID AND
    		                     (('{$_SESSION['USER_RIGHTS2'][4][1]}' = 3 AND a.UserID = {$_SESSION['USER_ID']}) OR '{$_SESSION['USER_RIGHTS3'][4][1][1]}' = 2 OR {$_SESSION['USER_ID']} = 1)");
            if ($row = $conn->fetch_array()) {
                if (!empty($row['Email'])) {
                    $AlertID = $row['FeedBack'] == 'pozitiv' ? 5 : ($row['FeedBack'] == 'negativ' ? 6 : 0);
                    if ($AlertID > 0) {
                        $conn->query("SELECT Subject, Body, FromEmail, FromAlias FROM alert WHERE ID = $AlertID");
                        $alert = $conn->fetch_array();
                        $to = "\"{$row['FullName']}\" <{$row['Email']}>";
                        $subject = $alert['Subject'];
                        if ($row['FeedBackType'] == 'personalizat') {
                            $alert['Body'] = stripslashes($row['FeedBackBody']);
                        }
                        $message = str_replace(array('<<FullName>>', '<<EventData>>', '<<JobTitle>>'), array($row['FullName'], $row['EventData'], $row['JobTitle']), $alert['Body']);
                        $from = "From: \"{$alert['FromAlias']}\" <{$alert['FromEmail']}>";
                        @mail($to, $subject, $message, $from);
                        $conn->query("UPDATE events SET FeedBackAlert = CURRENT_TIMESTAMP
    		                          WHERE  EventID = $EventID AND
    		                                 (('{$_SESSION['USER_RIGHTS2'][4][1]}' = 3 AND UserID = {$_SESSION['USER_ID']}) OR '{$_SESSION['USER_RIGHTS3'][4][1][1]}' = 2 OR {$_SESSION['USER_ID']} = 1)");
                        echo "<body onload=\"alert('Emailul a fost trimis!'); window.location.href = './?m=events&o=edit&EventID={$EventID}';\"></body>";
                    } else {
                        echo "<body onload=\"alert('Nu ati selectat tipul de feedback!'); window.location.href = './?m=events&o=edit&EventID={$EventID}';\"></body>";
                    }
                } else {
                    echo "<body onload=\"alert('Nu ati completat email-ul persoanei!'); window.location.href = './?m=events&o=edit&EventID={$EventID}';\"></body>";
                }
            } else {
                echo "<body onload=\"alert('Nu ati completat datele aferente interviului: Persoana, Job!'); window.location.href = './?m=events&o=edit&EventID={$EventID}';\"></body>";
            }
            exit;
        }

        for ($i = 0; $i <= 23; $i++) {
            $j = $i <= 9 ? '0' . $i : $i;
            $hours[$j . ':00'] = $j . ':00';
            $hours[$j . ':15'] = $j . ':15';
            $hours[$j . ':30'] = $j . ':30';
            $hours[$j . ':45'] = $j . ':45';
        }

        $smarty->assign(array(
            'eventType' => Event::$msEventType,
            'eventRelation' => Event::$msEventRelation,
            'interviuQ' => Event::$msInterviuQ,
            'consultants' => Person::getConsultants(),
            'rooms' => Utils::getSitesByRooms(),
            'persons' => Person::getEmployees(),
            'candidates' => Candidate::getCandidatesList(),
            'event_persons' => $event->getEventPersons(),
            'event_candidates' => $event->getEventCandidates(),
            'jobs' => Job::getJobsByCompany(),
            'hours' => $hours,
            'projects' => Project::getActiveProjects(),
            'customfields' => Utils::getCustomFields(),
            'info' => !empty($_POST) ? Utils::displayInfo($_POST) : $event->getEvent(),
        ));

        $center_file = 'event_new.tpl';

        break;

    case 'del':

        $EventID = (int)$_GET['EventID'];
        $event = new Event($EventID);

        try {

            $event->delEvent();

            header('Location: ./?m=events' . (!empty($_GET['type']) && $_GET['type'] == 'interviu' ? '&o=interview' : ''));
            exit;

        } catch (Exception $exp) {

            $err->setError($exp->getMessage());
        }

        break;

    case 'planif':

        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS2'][4][3] > 0)) {
            $center_file = 'event_menu.tpl';
            return;
        }

        $days = array();
        $events = Event::getAllEventsByPlanif();

        for ($i = 8; $i <= 20; $i++) {
            $j = $i <= 9 ? '0' . $i : $i;
            $hours[$j . ':00'] = $j . ':00';
            $hours[$j . ':15'] = $j . ':15';
            $hours[$j . ':30'] = $j . ':30';
            $hours[$j . ':45'] = $j . ':45';
        }

        $smarty->assign(array(
            'days' => $days,
            'hours' => $hours,
            'consultants' => Person::getConsultants(),
            'rooms' => Utils::getSitesByRooms(),
            'events' => $events,
        ));
        $center_file = 'event_planif.tpl';

        break;

    case 'interview':

        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS2'][4][4] > 0)) {
            $center_file = 'event_menu.tpl';
            return;
        }

        $action = !empty($_GET['action']) ? $_GET['action'] : 'default';

        $personalisedlist = Utils::getPersonalisedList('Event');
        $events = Event::getAllInterviews($action);
        $eventType = Event::$msEventType;
        $eventStatus = Event::$msEventStatus;
        $eventRelation = Event::$msEventRelation;
        $consultants = Person::getConsultants();

        switch ($action) {
            case 'export':
                //unset($events[0]);
                $excel = array();
                foreach ($events as $k => $event) {
                    $excel[$k]['Scop'] = $event['Scope'];
                    if (empty($personalisedlist['Event'])) {
                        $excel[$k]['Autor'] = $event['UserName'];
                        $excel[$k]['Reprezentant companie'] = $event['FullName'];
                        $excel[$k]['Detalii'] = $event['Details'];
                        $excel[$k]['Status'] = $eventStatus[$event['EventStatus']];
                        $excel[$k]['Intre'] = $eventRelation[$event['EventRelation']];
                        $excel[$k]['Tip'] = $eventType[$event['EventType']];
                        $excel[$k]['Data'] = $event['EventData'];
                    } else {
                        foreach ($personalisedlist['Event'] AS $field => $name) {
                            if ($field == 'ConsultantID')
                                $excel[$k][$name] = $consultants[$event[$field]];
                            elseif ($field == 'EventStatus')
                                $excel[$k][$name] = $eventStatus[$event[$field]];
                            elseif ($field == 'EventType')
                                $excel[$k][$name] = $eventType[$event[$field]];
                            elseif ($field == 'EventRelation')
                                $excel[$k][$name] = $eventRelation[$event[$field]];
                            else
                                $excel[$k][$name] = $event[$field];
                        }
                    }
                }
                include("libs/xlsStream.php");
                export_file($excel, 'evenimente');
                break;
            case 'export_doc':
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=evenimente.doc");
                // unset($events[0]);
                $smarty->assign(array(
                    'events' => $events,
                    'eventType' => Event::$msEventType,
                    'eventStatus' => Event::$msEventStatus,
                    'eventRelation' => Event::$msEventRelation,
                    'consultants' => $consultants,
                    'personalisedlist' => $personalisedlist,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('events_print.tpl');
                exit;
                break;
            case 'print_page':
            case 'print_all':
                //unset($events[0]);
                $smarty->assign(array(
                    'events' => $events,
                    'eventType' => Event::$msEventType,
                    'eventStatus' => Event::$msEventStatus,
                    'eventRelation' => Event::$msEventRelation,
                    'consultants' => $consultants,
                    'personalisedlist' => $personalisedlist,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('events_print.tpl');
                exit;
                break;
            default:
                $request_uri = !empty($_GET['res_per_page']) ? "./?m=events&o=interview&EventType={$_GET['EventType']}&PersonID={$_GET['PersonID']}&DateStart={$_GET['DateStart']}&DateEnd={$_GET['DateEnd']}&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}" : "./?m=events&o=interview";
                $smarty->assign(array(
                    'events' => $events,
                    'eventType' => Event::$msEventType,
                    'eventStatus' => Event::$msEventStatus,
                    'eventRelation' => Event::$msEventRelation,
                    'persons' => Event::getAllEventPersons(),
                    'personalisedlist' => $personalisedlist,
                    'consultants' => $consultants,
                    'request_uri' => $request_uri,
                ));
                # Pagination
                $pagination = Utils::paginate($events[0]['pageNo'], $events[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
                $smarty->assign('pagination', $pagination);

                $center_file = 'events_interviews.tpl';
                break;
        }

        break;

    default:

        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS2'][4][1] > 0)) {
            $center_file = 'event_menu.tpl';
            return;
        }

        $action = !empty($_GET['action']) ? $_GET['action'] : 'default';

        $personalisedlist = Utils::getPersonalisedList('Event');
        $events = Event::getAllEvents($action);
        $eventType = Event::$msEventType;
        $eventStatus = Event::$msEventStatus;
        $eventRelation = Event::$msEventRelation;
        $consultants = Person::getConsultants();

        switch ($action) {
            case 'export':
                //unset($events[0]);
                $excel = array();
                foreach ($events as $k => $event) {
                    $excel[$k]['Scop'] = $event['Scope'];
                    if (empty($personalisedlist['Event'])) {
                        $excel[$k]['Autor'] = $event['UserName'];
                        $excel[$k]['Reprezentant companie'] = $event['FullName'];
                        $excel[$k]['Detalii'] = $event['Details'];
                        $excel[$k]['Status'] = $eventStatus[$event['EventStatus']];
                        $excel[$k]['Intre'] = $eventRelation[$event['EventRelation']];
                        $excel[$k]['Tip'] = $eventType[$event['EventType']];
                        $excel[$k]['Data'] = $event['EventData'];
                    } else {
                        foreach ($personalisedlist['Event'] AS $field => $name) {
                            if ($field == 'ConsultantID')
                                $excel[$k][$name] = $consultants[$event[$field]];
                            elseif ($field == 'EventStatus')
                                $excel[$k][$name] = $eventStatus[$event[$field]];
                            elseif ($field == 'EventType')
                                $excel[$k][$name] = $eventType[$event[$field]];
                            elseif ($field == 'EventRelation')
                                $excel[$k][$name] = $eventRelation[$event[$field]];
                            else
                                $excel[$k][$name] = $event[$field];
                        }
                    }
                }
                include("libs/xlsStream.php");
                export_file($excel, 'evenimente');
                break;
            case 'export_doc':
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=evenimente.doc");
                // unset($events[0]);
                $smarty->assign(array(
                    'events' => $events,
                    'eventType' => Event::$msEventType,
                    'eventStatus' => Event::$msEventStatus,
                    'eventRelation' => Event::$msEventRelation,
                    'consultants' => $consultants,
                    'personalisedlist' => $personalisedlist,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('events_print.tpl');
                exit;
                break;
            case 'print_page':
            case 'print_all':
                //unset($events[0]);
                $smarty->assign(array(
                    'events' => $events,
                    'eventType' => Event::$msEventType,
                    'eventStatus' => Event::$msEventStatus,
                    'eventRelation' => Event::$msEventRelation,
                    'consultants' => $consultants,
                    'personalisedlist' => $personalisedlist,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('events_print.tpl');
                exit;
                break;
            default:
                $request_uri = !empty($_GET['res_per_page']) ? "./?m=events&EventType={$_GET['EventType']}&PersonID={$_GET['PersonID']}&DateStart={$_GET['DateStart']}&DateEnd={$_GET['DateEnd']}&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}" : "./?m=events";
                $smarty->assign(array(
                    'events' => $events,
                    'eventType' => Event::$msEventType,
                    'eventStatus' => Event::$msEventStatus,
                    'eventRelation' => Event::$msEventRelation,
                    'persons' => Event::getAllEventPersons(),
                    'personalisedlist' => $personalisedlist,
                    'consultants' => $consultants,
                    'request_uri' => $request_uri,
                ));
                # Pagination
                if (!isset($_GET['order_by']))
                    $_GET['order_by'] = NULL;
                if (!isset($_GET['asc_or_desc']))
                    $_GET['asc_or_desc'] = NULL;

                $pagination = Utils::paginate($events[0]['pageNo'], $events[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
                $smarty->assign('pagination', $pagination);

                $center_file = 'events.tpl';
                break;
        }

        break;
}

?>