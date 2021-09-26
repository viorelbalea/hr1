<?php
if (!isset($_SESSION['USER_ID'])) {
    header('Location: ../');
    exit;
}

switch ($o) {

    case 'planif':

        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS2'][4][3] > 0)) {
            $center_file = 'sales_menu.tpl';
            return;
        }

        $days = array();
        $activities = Activity::getAllSalesByPlanif();

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
            'users' => User::getUsers(),
            'activities' => $activities,
        ));
        $center_file = 'sales_planif.tpl';

        break;

    case 'new_activity':

        if (!empty($_GET['del_offer'])) {
            Product::delOffer((int)$_GET['ActivityDetID'], (int)$_GET['del_offer']);
            $parts = explode('&del_offer=', $_SERVER['REQUEST_URI']);
            header('Location: ' . $parts[0]);
            exit;
        }

        if (!empty($_GET['del_doc'])) {
            @unlink($_GET['del_doc']);
            $parts = explode('&del_doc=', $_SERVER['REQUEST_URI']);
            header('Location: ' . $parts[0]);
            exit;
        }

        if ($_GET['ActivityID']) {
            $ActivityID = (int)$_GET['ActivityID'];
            $activityData = Activity::getActivity((int)$_GET['ActivityDetID']);
            $activities = Activity::getAllActivities($ActivityID);
        }
        $companies = Company::getCompaniesList();

        if (isset($_POST['save'])) {

            try {

                $activity = new Activity();
                $ActivityDetID = $activity->addActivity($_POST);

                header("Location:./?m=sales&o=edit_activity&ActivityDetID=$ActivityDetID&ActivityID={$_GET['ActivityID']}&CompanyID={$_GET['CompanyID']}&ContactID={$_GET['ContactID']}");
                //Utils::pa($companies);

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }

            $smarty->assign('info', Utils::displayInfo($_POST));
        }

        if (isset($_POST['savedoc']) && !empty($_GET['ActivityDetID'])) {

            if (!empty($_FILES['doc']['tmp_name'])) {
                $docdir = 'docsact/' . $_GET['ActivityDetID'];
                if (!is_dir($docdir)) {
                    mkdir($docdir, 0775);
                }
                @move_uploaded_file($_FILES['doc']['tmp_name'], $docdir . '/' . str_replace(' ', '_', $_FILES['doc']['name']));
            }
            header("Location:./?m=sales&o=edit_activity&ActivityDetID={$_GET['ActivityDetID']}&ActivityID={$_GET['ActivityID']}&CompanyID={$_GET['CompanyID']}&ContactID={$_GET['ContactID']}");
        }

        if (!empty($_GET['CompanyID'])) {
            $CompanyID = (int)$_GET['CompanyID'];
            $contacts = $companies[$CompanyID]['Contacts'];
            if (!empty($_GET['ContactID'])) {
                $ContactID = (int)$_GET['ContactID'];
                $contact = $companies[$CompanyID]['Contacts'][$ContactID];
            }
        }

        $docs = array();
        if (!empty($_GET['ActivityDetID'])) {
            $docdir = 'docsact/' . $_GET['ActivityDetID'];
            foreach (glob($docdir . '/*') as $doc) {
                $docs[basename($doc)] = $doc;
            }
        }

        unset($companies[0]);
        unset($contacts[0]);

        for ($i = 8; $i <= 20; $i++) {
            $j = $i <= 9 ? '0' . $i : $i;
            $hours[$j . ':00'] = $j . ':00';
            //   $hours[$j . ':15'] = $j . ':15';
            $hours[$j . ':30'] = $j . ':30';
            //   $hours[$j . ':45'] = $j . ':45';
        }


        $smarty->assign(array(
            'hours' => $hours,
            'companies' => $companies,
            'contacts' => $contacts,
            'contact' => $contact,
            'activityStatus' => Activity::$msActivityStatus,
            'activitySubject' => ($activity_subjects = Activity::getActiveSubjects()) ? $activity_subjects : Activity::$msActivitySubject,
            'activitySource' => Utils::getSalesSources(false),
            'activityStage' => Utils::getSalesStages(false),
            'activityCampaign' => Activity::getAllCampaigns(false),
            'activities' => $activities,
            'prototype' => 1,
            'activityStatus' => Activity::$msActivityStatus,
            'activitySubject' => ($activity_subjects = Activity::getActiveSubjects()) ? $activity_subjects : Activity::$msActivitySubject,
            'participation_types' => Activity::$msParticipationTypes,
            'projects' => Project::getActiveProjects(),
            'financial_sources' => Project::$msFinancialSources,
            'coins' => Contract::$msCurrencies,
            'products_offers' => Product::getProductsOffers((int)$_GET['ActivityDetID']),
            'docs' => $docs,
            'info' => !empty($_POST) ? Utils::displayInfo($_POST) : $activityData,
            'request_uri' => "./?m=sales&o=new_activity&CompanyID=$CompanyID",
            'nextOfferIndex' => Product::getNextOfferIndex((int)$_GET['ActivityDetID']),
        ));

        $center_file = 'sales_activity_new.tpl';

        break;

    case 'edit_activity':


        if (!empty($_GET['del_offer'])) {
            Product::delOffer((int)$_GET['ActivityDetID'], (int)$_GET['del_offer']);
            $parts = explode('&del_offer=', $_SERVER['REQUEST_URI']);
            header('Location: ' . $parts[0]);
            exit;
        }
        if (!empty($_GET['del_doc'])) {
            @unlink($_GET['del_doc']);
            $parts = explode('&del_doc=', $_SERVER['REQUEST_URI']);
            header('Location: ' . $parts[0]);
            exit;
        }

        $ActivityID = (int)$_GET['ActivityID'];
        $activity = new Activity($ActivityID);
        $activityData = Activity::getActivity((int)$_GET['ActivityDetID']);
        $companies = Company::getCompaniesList();

        if (!empty($_GET['CompanyID'])) {
            $CompanyID = (int)$_GET['CompanyID'];
            $contacts = $companies[$CompanyID]['Contacts'];
            if (!empty($_GET['ContactID'])) {
                $ContactID = (int)$_GET['ContactID'];
                $contact = $companies[$CompanyID]['Contacts'][$ContactID];
            }
        }

        if (isset($_POST['save']) || !empty($_GET['action'])) {

            try {

                $activity->editActivity($_POST, $_GET['ActivityDetID']);

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }

        if (isset($_POST['savedoc']) && !empty($_GET['ActivityDetID'])) {

            if (!empty($_FILES['doc']['tmp_name'])) {
                $docdir = 'docsact/' . $_GET['ActivityDetID'];
                if (!is_dir($docdir)) {
                    mkdir($docdir, 0775);
                }
                @move_uploaded_file($_FILES['doc']['tmp_name'], $docdir . '/' . str_replace(' ', '_', $_FILES['doc']['name']));
                header('Location: ' . $_SERVER['REQUEST_URI']);
                exit;
            }
        }

        $docs = array();
        $docdir = 'docsact/' . $_GET['ActivityDetID'];
        foreach (glob($docdir . '/*') as $doc) {
            $docs[basename($doc)] = $doc;
        }

        unset($companies[0]);
        unset($contacts[0]);
        $smarty->assign(array(
            'companies' => $companies,
            'contacts' => $contacts,
            'contact' => $contact,
            'activityStatus' => Activity::$msActivityStatus,
            'activitySubject' => ($activity_subjects = Activity::getActiveSubjects()) ? $activity_subjects : Activity::$msActivitySubject,
            'participation_types' => Activity::$msParticipationTypes,
            'activitySource' => Utils::getSalesSources(false),
            'activityStage' => Utils::getSalesStages(false),
            'activityCampaign' => Activity::getAllCampaigns(false),
            'prototype' => 1,
            'activities' => Activity::getAllActivities($ActivityID),
            'docs' => $docs,
            'projects' => Project::getActiveProjects(),
            'financial_sources' => Project::$msFinancialSources,
            'coins' => Contract::$msCurrencies,
            'products_offers' => Product::getProductsOffers((int)$_GET['ActivityDetID']),
            'info' => !empty($_POST) ? Utils::displayInfo($_POST) : $activityData,
            'request_uri' => "./?m=sales&o=edit_activity&ActivityID=$ActivityID&CompanyID=$CompanyID",
            'nextOfferIndex' => Product::getNextOfferIndex((int)$_GET['ActivityDetID']),
        ));

        $center_file = 'sales_activity_new.tpl';

        break;

    case 'del_activity':

        try {

            foreach ($_POST['activity'] as $ActivityID => $checked) {
                if ($checked == 1)
                    Activity::delActivity($ActivityID);
            }
            header('Location: ./?m=sales&o=activities');

        } catch (Exception $exp) {
            $err->setError($exp->getMessage());
        }


        break;

    case 'del_activity_det':

        $ActivityDetID = (int)$_GET['ActivityDetID'];

        try {

            Activity::delActivityDet($ActivityDetID);

            header('Location: ./?m=sales&o=activities');
            exit;

        } catch (Exception $exp) {

            $err->setError($exp->getMessage());
        }

        break;

    case 'activities':

        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS2'][14][1] > 0)) {
            $center_file = 'sales_menu.tpl';
            return;
        }

        $action = !empty($_GET['action']) ? $_GET['action'] : 'default';
        $activities = Activity::getLastActivities($action);
        $get = $_GET;
        $_GET = '';
        $companies = Company::getAllCompanies('', false);
        $_GET = $get;
        $persons = Person::getPersonsByRole('sales');
        $activityStatus = Activity::$msActivityStatus;
        $activitySubject = ($activity_subjects = Activity::getActiveSubjects()) ? $activity_subjects : Activity::$msActivitySubject;
        $activitySource = Utils::getSalesSources(false);
        $activityStage = Utils::getSalesStages(false);
        $activityCampaign = Activity::getAllCampaigns();
        $personalisedlist = Utils::getPersonalisedList('Activity');
        //Utils::pa($companies);
        switch ($action) {
            case 'export':
                unset($activities[0]);
                $excel = array();
                foreach ($activities as $k => $activity) {
                    $excel[$k]['Nume firma'] = $activity['CompanyName'];
                    if (empty($personalisedlist['Activity'])) {
                        $excel[$k]['Responsabil'] = $activity['FullName'];
                        $excel[$k]['Persoana contact'] = $activity['ContactName'] . "; " . $activity['ContactPhone'] . "; " . $activity['ContactPhone2'] . "; " . $activity['ContactEmail'] . "; " . $activity['ContactFunction'];
                        $excel[$k]['Subiect'] = $activitySubject[$activity['Subject']];
                        $excel[$k]['Status'] = $activityStatus[$activity['Status']];
                        $excel[$k]['Rezolutie'] = $activity['Comment'];
                        $excel[$k]['Apelat'] = $activity['Date'];
                        $excel[$k]['De apelat'] = $activity['NextDate'];
                        $excel[$k]['Necesar'] = $activity['Comment2'];
                        $excel[$k]['NewMeet'] = $activity['NewMeet'];
                        $excel[$k]['MeetDate'] = $activity['MeetDate'];
                        $excel[$k]['MeetHourStart'] = $activity['MeetHourStart'];
                        $excel[$k]['MeetHourStop'] = $activity['MeetHourStop'];
                        $excel[$k]['Data'] = $activity['CreateDate'];
                    } else {
                        foreach ($personalisedlist['Activity'] AS $field => $name) {
                            if ($field == 'ContactName')
                                $excel[$k]['Persoana contact'] = $activity['ContactName'] . "; " . $activity['ContactPhone'] . "; " . $activity['ContactPhone2'] . "; " . $activity['ContactEmail'] . "; " . $activity['ContactFunction'];
                            elseif ($field == 'Subject')
                                $excel[$k][$name] = $activitySubject[$activity[$field]];
                            elseif ($field == 'Status')
                                $excel[$k][$name] = $activityStatus[$activity[$field]];
                            elseif ($field == 'SourceID')
                                $excel[$k][$name] = $activitySource[$activity[$field]];
                            elseif ($field == 'StageID')
                                $excel[$k][$name] = $activityStage[$activity[$field]];
                            elseif ($field == 'CampaignID')
                                $excel[$k][$name] = $activityCampaign[$activity[$field]]['Function'];
                            else
                                $excel[$k][$name] = $activity[$field];
                        }

                    }
                }
                include("libs/xlsStream.php");
                export_file($excel, 'activitati');
                break;
            case 'export_doc':
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=activitati.doc");
                //unset($activities[0]);
                $smarty->assign(array(
                    'activities' => $activities,
                    'companies' => $companies,
                    'persons' => $persons,
                    'activityStatus' => Activity::$msActivityStatus,
                    'activitySubject' => ($activity_subjects = Activity::getActiveSubjects()) ? $activity_subjects : Activity::$msActivitySubject,
                    'activitySource' => $activitySource,
                    'activityStage' => $activityStage,
                    'activityCampaign' => $activityCampaign,
                    'personalisedlist' => $personalisedlist,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('sales_activities_print.tpl');
                break;
            case 'print_page':
            case 'print_all':
                //unset($activities[0]);
                $smarty->assign(array(
                    'activities' => $activities,
                    'companies' => $companies,
                    'persons' => $persons,
                    'activityStatus' => Activity::$msActivityStatus,
                    'activitySubject' => ($activity_subjects = Activity::getActiveSubjects()) ? $activity_subjects : Activity::$msActivitySubject,
                    'activitySource' => $activitySource,
                    'activityStage' => $activityStage,
                    'activityCampaign' => $activityCampaign,
                    'personalisedlist' => $personalisedlist,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('sales_activities_print.tpl');
                exit;
                break;
            default:
                $request_uri = !empty($_GET['res_per_page']) ? "./?m=sales&o=activities&PersonID={$_GET['PersonID']}&Subject={$_GET['Subject']}&Status={$_GET['Status']}&DateStart={$_GET['DateStart']}&DateEnd={$_GET['DateEnd']}&NextDateStart={$_GET['NextDateStart']}&NextDateEnd={$_GET['NextDateEnd']}&SourceID={$_GET['SourceID']}&StageID={$_GET['StageID']}&CampaignID={$_GET['CampaignID']}&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}" : "./?m=sales&o=activities";
                $smarty->assign(array(
                    'activities' => $activities,
                    'companies' => $companies,
                    'persons' => $persons,
                    'activityStatus' => Activity::$msActivityStatus,
                    'activitySubject' => ($activity_subjects = Activity::getActiveSubjects()) ? $activity_subjects : Activity::$msActivitySubject,
                    'activitySource' => $activitySource,
                    'activityStage' => $activityStage,
                    'activityCampaign' => $activityCampaign,
                    'personalisedlist' => $personalisedlist,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    'request_uri' => $request_uri,
                ));
                # Pagination
                $pagination = Utils::paginate($activities[0]['pageNo'], $activities[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
                $smarty->assign('pagination', $pagination);

                $center_file = 'sales_activities.tpl';
                break;
        }

        break;

    case 'tender':

        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS2'][14][7] > 0)) {
            $center_file = 'sales_menu.tpl';
            return;
        }

        $action = !empty($_GET['action']) ? $_GET['action'] : 'default';
        $activities = Activity::getOfferActivities($action);
        $activityStatus = Activity::$msActivityStatus;
        $activitySubject = ($activity_subjects = Activity::getActiveSubjects()) ? $activity_subjects : Activity::$msActivitySubject;
        $personalisedlist = Utils::getPersonalisedList('Ofertare');

        switch ($action) {
            case 'export':
                header("Content-Type: application/vnd.ms-excel");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=activitati_ofertare.xls");
                $smarty->assign(array(
                    'activities' => $activities,
                    'activityStatus' => Activity::$msActivityStatus,
                    'activitySubject' => ($activity_subjects = Activity::getActiveSubjects()) ? $activity_subjects : Activity::$msActivitySubject,
                    'participation_types' => Activity::$msParticipationTypes,
                    'financial_sources' => Project::$msFinancialSources,
                    'personalisedlist' => $personalisedlist,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    'request_uri' => $request_uri,
                ));
                $smarty->display('sales_tender_print.tpl');
                break;
            case 'export_doc':
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=activitati_ofertare.doc");
                $smarty->assign(array(
                    'activities' => $activities,
                    'activityStatus' => Activity::$msActivityStatus,
                    'activitySubject' => ($activity_subjects = Activity::getActiveSubjects()) ? $activity_subjects : Activity::$msActivitySubject,
                    'participation_types' => Activity::$msParticipationTypes,
                    'financial_sources' => Project::$msFinancialSources,
                    'personalisedlist' => $personalisedlist,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    'request_uri' => $request_uri,
                ));
                $smarty->display('sales_tender_print.tpl');
                break;
            case 'print_page':
            case 'print_all':
                $smarty->assign(array(
                    'activities' => $activities,
                    'activityStatus' => Activity::$msActivityStatus,
                    'activitySubject' => ($activity_subjects = Activity::getActiveSubjects()) ? $activity_subjects : Activity::$msActivitySubject,
                    'participation_types' => Activity::$msParticipationTypes,
                    'financial_sources' => Project::$msFinancialSources,
                    'personalisedlist' => $personalisedlist,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    'request_uri' => $request_uri,
                ));
                $smarty->display('sales_tender_print.tpl');
                exit;
                break;
            default:
                $request_uri = !empty($_GET['res_per_page']) ? "./?m=sales&o=tender&Subject={$_GET['Subject']}&Status={$_GET['Status']}&DateStart={$_GET['DateStart']}&DateEnd={$_GET['DateEnd']}&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}" : "./?m=sales&o=tender";
                $smarty->assign(array(
                    'activities' => $activities,
                    'activityStatus' => Activity::$msActivityStatus,
                    'activitySubject' => ($activity_subjects = Activity::getActiveSubjects()) ? $activity_subjects : Activity::$msActivitySubject,
                    'participation_types' => Activity::$msParticipationTypes,
                    'financial_sources' => Project::$msFinancialSources,
                    'projects' => Project::getActiveProjects(),
                    'personalisedlist' => $personalisedlist,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    'request_uri' => $request_uri,
                ));
                # Pagination
                $pagination = Utils::paginate($activities[0]['pageNo'], $activities[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
                $smarty->assign('pagination', $pagination);

                $center_file = 'sales_tender.tpl';
                break;
        }

        break;

    ## Campaigns ##
    ###############
    case 'new_campaign':

        if (!empty($_POST)) {

            try {

                $CampaignID = Activity::addCampaign($_POST);

                header('Location: ./?m=sales&o=edit_campaign&CampaignID=' . $CampaignID);
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }
        $smarty->assign(array(
            'info' => Utils::displayInfo($_POST),
            'campaignStatus' => Activity::$msCampaignStatus,
            'campaignType' => Activity::$msCampaignType,
        ));

        $center_file = 'sales_campaign_new.tpl';

        break;

    case 'edit_campaign':

        $CampaignID = (int)$_GET['CampaignID'];

        if (!empty($_POST) || !empty($_GET['action'])) {

            try {

                Activity::editCampaign($_POST, $CampaignID);

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }
        $smarty->assign(array(
            'campaignStatus' => Activity::$msCampaignStatus,
            'campaignType' => Activity::$msCampaignType,
            'campaign' => Activity::getCampaign($CampaignID),
            'info' => !empty($_POST) ? Utils::displayInfo($_POST) : Activity::getCampaign($CampaignID),
        ));

        $center_file = 'sales_campaign_new.tpl';

        break;

    case 'del_campaign':

        $CampaignID = (int)$_GET['CampaignID'];
        try {
            Activity::delCampaign($CampaignID);
            header('Location: ./?m=sales&o=campaigns');
            exit;
        } catch (Exception $exp) {
            $err->setError($exp->getMessage());
        }

        break;


    case 'campaigns':
    default:

        $action = !empty($_GET['action']) ? $_GET['action'] : 'default';
        $campaigns = Activity::getCampaigns($action);

        switch ($action) {
            case 'export':
                unset($campaigns[0]);
                $excel = array();
                foreach ($campaigns as $k => $campaign) {
                    $excel[$k]['Nume campanie'] = $campaign['CompanyName'];
                    $excel[$k]['Tip'] = Activity::$msCampaignType[$campaign['Type']];
                    $excel[$k]['Status'] = Activity::$msCampaignStatus[$campaign['Status']];
                    $excel[$k]['Cost Net'] = $campaign['CostNet'];
                    $excel[$k]['Cost Brut'] = $campaign['Cost'];
                    $excel[$k]['Data inceput'] = $campaign['DateStart'];
                    $excel[$k]['Data sfarsit'] = $campaign['DateEnd'];
                    $excel[$k]['Data creare'] = $campaign['CreateDate'];
                }
                include("libs/xlsStream.php");
                export_file($excel, 'campanii_sales');
                break;
            case 'export_doc':
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=campanii_sales.doc");
                $smarty->assign(array(
                    'campaigns' => $campaigns,
                    'campaignStatus' => Activity::$msCampaignStatus,
                    'campaignType' => Activity::$msCampaignType,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('sales_campaigns_print.tpl');
                break;
            case 'print_page':
            case 'print_all':
                $smarty->assign(array(
                    'campaigns' => $campaigns,
                    'campaignStatus' => Activity::$msCampaignStatus,
                    'campaignType' => Activity::$msCampaignType,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('sales_campaigns_print.tpl');
                exit;
                break;
            default:
                $request_uri = !empty($_GET['res_per_page']) ? "./?m=sales&o=campaigns&CampaignID={$_GET['CampaignID']}&Type={$_GET['Type']}&Status={$_GET['Status']}&DateStart={$_GET['DateStart']}&DateEnd={$_GET['DateEnd']}&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}" : "./?m=sales&o=campaigns";
                $smarty->assign(array(
                    'campaigns' => $campaigns,
                    'campaignStatus' => Activity::$msCampaignStatus,
                    'campaignType' => Activity::$msCampaignType,
                    'request_uri' => $request_uri,
                ));
                # Pagination
                $pagination = Utils::paginate($campaigns[0]['pageNo'], $campaigns[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
                $smarty->assign('pagination', $pagination);

                $center_file = 'sales_campaigns.tpl';
                break;
        }
        break;

    ##  Dailies ##
    ##############

    case 'new_daily':

        if (!empty($_POST)) {

            try {

                $daily = new Daily();
                $DailyID = $daily->addDaily($_POST);

                header('Location: ./?m=sales&o=edit_daily&DailyID=' . $DailyID);
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }

            $smarty->assign('info', Utils::displayInfo($_POST));
        }

        $center_file = 'sales_daily_new.tpl';

        break;

    case 'edit_daily':

        $DailyID = (int)$_GET['DailyID'];
        $daily = new Daily($DailyID);

        if (!empty($_POST) || !empty($_GET['action'])) {

            try {

                $daily->editDaily($_POST);

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }
        $smarty->assign(array(
            'daily' => $daily->getDaily(),
            'info' => !empty($_POST) ? Utils::displayInfo($_POST) : $daily->getDaily(),
        ));

        $center_file = 'sales_daily_new.tpl';

        break;

    case 'del_daily':

        try {

            foreach ($_POST['daily'] as $DailyID => $checked) {
                if ($checked == 1)
                    Daily::delDaily($DailyID);
            }
            header('Location: ./?m=sales&o=dailies');

        } catch (Exception $exp) {
            $err->setError($exp->getMessage());
        }

        break;

    case 'dailies':

        $action = !empty($_GET['action']) ? $_GET['action'] : 'default';
        $dailies = Daily::getAllDailies($action);
        $personalisedlist = Utils::getPersonalisedList('Daily');
        switch ($action) {
            case 'export':
                unset($dailies[0]);
                $excel = array();
                foreach ($dailies as $k => $daily) {
                    $excel[$k]['Responsabil'] = $daily['FullName'];
                    if (empty($personalisedlist['Daily'])) {
                        $excel[$k]['Data'] = $daily['Date'];
                        $excel[$k]['Apeluri noi'] = $daily['CallsNew'];
                        $excel[$k]['Intalniri noi'] = $daily['MeetingsNew'];
                        $excel[$k]['Inatalniri revenire'] = $daily['MeetingsBack'];
                        $excel[$k]['Intalniri efectuate'] = $daily['MeetingsDone'];
                    } else {
                        foreach ($personalisedlist['Daily'] AS $field => $name) {
                            $excel[$k][$name] = $daily[$field];
                        }
                    }

                }
                include("libs/xlsStream.php");
                export_file($excel, 'daily');
                break;
            case 'export_doc':
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=raport_zilnic.doc");
                $smarty->assign(array(
                    'dailies' => $dailies,
                    'personalisedlist' => $personalisedlist,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('sales_dailies_print.tpl');
                break;
            case 'print_page':
            case 'print_all':
                $smarty->assign(array(
                    'dailies' => $dailies,
                    'personalisedlist' => $personalisedlist,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('sales_dailies_print.tpl');
                exit;
                break;
            default:
                $request_uri = !empty($_GET['res_per_page']) ? "./?m=sales&o=dailies&PersonID={$_GET['PersonID']}&DateStart={$_GET['DateStart']}&DateEnd={$_GET['DateEnd']}&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}" : "./?m=sales&o=dailies";
                $smarty->assign(array(
                    'dailies' => $dailies,
                    'dates' => Daily::getDailyDates(),
                    'persons' => Person::getPersonsByRole('sales'),
                    'personalisedlist' => $personalisedlist,
                    'request_uri' => $request_uri,
                ));
                # Pagination
                $pagination = Utils::paginate($dailies[0]['pageNo'], $dailies[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
                $smarty->assign('pagination', $pagination);

                $center_file = 'sales_dailies.tpl';
                break;
        }

        break;
    default:
        header('Location: ./?m=sales&o=activities');

}
?>