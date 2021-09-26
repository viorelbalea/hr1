<?php

if (!isset($_SESSION['USER_ID'])) {
    header('Location: ../');
    exit;
}

switch ($o) {

    case 'new-intern':
        if (!empty($_POST)) {

            try {

                $news = new Newsletter();
                $NewsletterID = $news->addNewsletter(1, $_POST);

                //Create de campain folder
                if (!is_dir('online-newsletters/' . preg_replace('/[^a-z\d ]/i', '', $_POST['Campaign'])))
                    mkdir('online-newsletters/' . preg_replace('/[^a-z\d ]/i', '', $_POST['Campaign']), 0777);

                // Stergem fisier vechi daca exista
                if (is_file('online-newsletters/' . preg_replace('/[^a-z\d ]/i', '', $_POST['Campaign']) . "/" . "index.html"))
                    unlink('online-newsletters/' . preg_replace('/[^a-z\d ]/i', '', $_POST['Campaign']) . "/" . "index.html");

                //Create and write the file as index.html
                $news = new Newsletter($NewsletterID);
                $newsData = $news->previewNewsletter();
                $smarty->assign(array(
                    'info' => $newsData,
                ));
                $output = $smarty->fetch('newsletters_mail.tpl');
                $fh = fopen('online-newsletters/' . preg_replace('/[^a-z\d ]/i', '', $_POST['Campaign']) . "/" . "index.html", 'w') or die("can't open file");
                fwrite($fh, $output);
                fclose($fh);

                // Save attachment
                if (!empty($_FILES['doc']['name'])) {
                    if (!is_dir('online-newsletters/' . preg_replace('/[^a-z\d ]/i', '', $_POST['Campaign']) . '/docs'))
                        mkdir('online-newsletters/' . preg_replace('/[^a-z\d ]/i', '', $_POST['Campaign']) . '/docs', 0777, true);
                    if (!@move_uploaded_file($_FILES['doc']['tmp_name'], "online-newsletters/" . preg_replace('/[^a-z\d ]/i', '', $_POST['Campaign']) . "/docs/" . str_replace(' ', '-', basename($_FILES['doc']['name'])))) {
                        throw new Exception('Eroare incarcare document');
                    }
                }

                header('Location: ./?m=newsletters&o=edit-intern&NewsletterID=' . $NewsletterID . '&msg=1');

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
                $smarty->assign('info', Utils::displayInfo($_POST));
            }
        }

        ## Init FCK fields
        $content = new FCKeditor('Content', '100%', 200); //nume camp, latime, inaltime

        $smarty->assign(array(
            'status' => Newsletter::$msNewsletterStatus,
            'content' => $content->Create(), // activate fck field
            'status' => Newsletter::$msNewsletterStatus,
            'self' => Company::getSelfCompanies(),
            'jquery' => 1,
        ));

        $center_file = 'newsletters_new.tpl';

        break;

    case 'new-extern':
        if (!empty($_POST)) {

            try {

                $news = new Newsletter();
                $NewsletterID = $news->addNewsletter(2, $_POST);

                //Create de campain folder
                if (!is_dir('online-newsletters/' . preg_replace('/[^a-z\d ]/i', '', $_POST['Campaign'])))
                    mkdir('online-newsletters/' . preg_replace('/[^a-z\d ]/i', '', $_POST['Campaign']), 0777);

                // Stergem fisier vechi daca exista
                if (is_file('online-newsletters/' . preg_replace('/[^a-z\d ]/i', '', $_POST['Campaign']) . "/" . "index.html"))
                    unlink('online-newsletters/' . preg_replace('/[^a-z\d ]/i', '', $_POST['Campaign']) . "/" . "index.html");

                //Create and write the file as index.html
                $news = new Newsletter($NewsletterID);
                $newsData = $news->previewNewsletter();
                $smarty->assign(array(
                    'info' => $newsData,
                ));
                $output = $smarty->fetch('newsletters_mail.tpl');
                $fh = fopen('online-newsletters/' . preg_replace('/[^a-z\d ]/i', '', $_POST['Campaign']) . "/" . "index.html", 'w') or die("can't open file");
                fwrite($fh, $output);
                fclose($fh);

                // Save attachment
                if (!empty($_FILES['doc']['name'])) {
                    if (!is_dir('online-newsletters/' . preg_replace('/[^a-z\d ]/i', '', $_POST['Campaign']) . '/docs'))
                        mkdir('online-newsletters/' . preg_replace('/[^a-z\d ]/i', '', $_POST['Campaign']) . '/docs', 0777, true);
                    if (!@move_uploaded_file($_FILES['doc']['tmp_name'], "online-newsletters/" . preg_replace('/[^a-z\d ]/i', '', $_POST['Campaign']) . "/docs/" . str_replace(' ', '-', basename($_FILES['doc']['name'])))) {
                        throw new Exception('Eroare incarcare document');
                    }
                }
                header('Location: ./?m=newsletters&o=edit-extern&NewsletterID=' . $NewsletterID . '&msg=1');

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
                $smarty->assign('info', Utils::displayInfo($_POST));
            }
        }

        ## Init FCK fields
        $content = new FCKeditor('Content', '100%', 200); //nume camp, latime, inaltime

        $smarty->assign(array(
            'types' => Newsletter::$msNewsletterStatus,
            'content' => $content->Create(), // activate fck field
            'status' => Newsletter::$msNewsletterStatus,
            'companies' => Company::getNonSelfCompanies(),
            'jquery' => 1,
        ));

        $center_file = 'newsletters_new.tpl';

        break;

    case 'edit-intern':

        $NewsletterID = (int)$_GET['NewsletterID'];
        $news = new Newsletter($NewsletterID);
        if (!empty($_POST)) {
            try {

                $news->editNewsletter($_POST);

                //Create de campain folder
                if (!is_dir('online-newsletters/' . preg_replace('/[^a-z\d ]/i', '', $_POST['Campaign'])))
                    mkdir('online-newsletters/' . preg_replace('/[^a-z\d ]/i', '', $_POST['Campaign']), 0777);

                // Stergem fisier vechi daca exista
                if (is_file('online-newsletters/' . preg_replace('/[^a-z\d ]/i', '', $_POST['Campaign']) . "/" . "index.html"))
                    unlink('online-newsletters/' . preg_replace('/[^a-z\d ]/i', '', $_POST['Campaign']) . "/" . "index.html");

                //Create and write the file as index.html
                $newsData = $news->previewNewsletter();
                $smarty->assign(array(
                    'info' => $newsData,
                ));
                $output = $smarty->fetch('newsletters_mail.tpl');
                $fh = fopen('online-newsletters/' . preg_replace('/[^a-z\d ]/i', '', $_POST['Campaign']) . "/" . "index.html", 'w') or die("can't open file");
                fwrite($fh, $output);
                fclose($fh);

                // Save attachment
                if (!empty($_FILES['doc']['name'])) {
                    if (!is_dir('online-newsletters/' . preg_replace('/[^a-z\d ]/i', '', $_POST['Campaign']) . '/docs'))
                        mkdir('online-newsletters/' . preg_replace('/[^a-z\d ]/i', '', $_POST['Campaign']) . '/docs', 0777, true);
                    if (!@move_uploaded_file($_FILES['doc']['tmp_name'], "online-newsletters/" . preg_replace('/[^a-z\d ]/i', '', $_POST['Campaign']) . "/docs/" . str_replace(' ', '-', basename($_FILES['doc']['name'])))) {
                        throw new Exception('Eroare incarcare document');
                    }
                }

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }
        $newsData = $news->getNewsletter();

        // Delete attachment
        if (!empty($_GET['action'])) {
            switch ($_GET['action']) {
                case 'del_doc':
                    @unlink($_GET['doc']);
                    break;
            }
        }

        ## Init FCK fields
        $content = new FCKeditor('Content', '100%', 200); //nume camp, latime, inaltime
        $content->Value = $newsData['Content'];
        //$info = !empty($_POST) ? Utils::displayInfo($_POST) : $newsData;
        $docs = array();
        foreach ((array)glob('online-newsletters/' . $newsData['Campaign'] . '/docs/*') as $item) {
            $docs[$item] = basename($item);
        }

        $smarty->assign(array(
            'info' => $newsData,
            'content' => $content->Create(), // activate fck field
            'types' => Newsletter::$msNewsletterTypes,
            'status' => Newsletter::$msNewsletterStatus,
            'self' => Company::getSelfCompanies(),
            'docs' => $docs,
            'jquery' => 1,
        ));

        $center_file = 'newsletters_new.tpl';

        break;

    case 'edit-extern':

        $NewsletterID = (int)$_GET['NewsletterID'];
        $news = new Newsletter($NewsletterID);
        if (!empty($_POST)) {

            try {

                $news->editNewsletter($_POST);

                //Create de campain folder
                if (!is_dir('online-newsletters/' . preg_replace('/[^a-z\d ]/i', '', $_POST['Campaign'])))
                    mkdir('online-newsletters/' . preg_replace('/[^a-z\d ]/i', '', $_POST['Campaign']), 0777);

                // Stergem fisier vechi daca exista
                if (is_file('online-newsletters/' . preg_replace('/[^a-z\d ]/i', '', $_POST['Campaign']) . "/" . "index.html"))
                    unlink('online-newsletters/' . preg_replace('/[^a-z\d ]/i', '', $_POST['Campaign']) . "/" . "index.html");

                //Create and write the file as index.html
                $newsData = $news->previewNewsletter();
                $smarty->assign(array(
                    'info' => $newsData,
                ));
                $output = $smarty->fetch('newsletters_mail.tpl');
                $fh = fopen('online-newsletters/' . preg_replace('/[^a-z\d ]/i', '', $_POST['Campaign']) . "/" . "index.html", 'w') or die("can't open file");
                fwrite($fh, $output);
                fclose($fh);

                // Save attachment
                if (!empty($_FILES['doc']['name'])) {
                    if (!is_dir('online-newsletters/' . preg_replace('/[^a-z\d ]/i', '', $_POST['Campaign']) . '/docs'))
                        mkdir('online-newsletters/' . preg_replace('/[^a-z\d ]/i', '', $_POST['Campaign']) . '/docs', 0777, true);
                    if (!@move_uploaded_file($_FILES['doc']['tmp_name'], "online-newsletters/" . preg_replace('/[^a-z\d ]/i', '', $_POST['Campaign']) . "/docs/" . str_replace(' ', '-', basename($_FILES['doc']['name'])))) {
                        throw new Exception('Eroare incarcare document');
                    }
                }

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }
        $newsData = $news->getNewsletter();

        // Delete attachment
        if (!empty($_GET['action'])) {
            switch ($_GET['action']) {
                case 'del_doc':
                    @unlink($_GET['doc']);
                    break;
            }
        }

        ## Init FCK fields
        $content = new FCKeditor('Content', '100%', 200); //nume camp, latime, inaltime
        $content->Value = $newsData['Content'];

        $docs = array();
        foreach ((array)glob('online-newsletters/' . $newsData['Campaign'] . '/docs/*') as $item) {
            $docs[$item] = basename($item);
        }

        $smarty->assign(array(
            //'info' => !empty($_POST) ? Utils::displayInfo($_POST) : $newsData,
            'info' => $newsData,
            'content' => $content->Create(), // activate fck field
            'types' => Newsletter::$msNewsletterTypes,
            'status' => Newsletter::$msNewsletterStatus,
            'companies' => Company::getNonSelfCompanies(),
            'docs' => $docs,
            'jquery' => 1,
        ));

        $center_file = 'newsletters_new.tpl';

        break;

    case 'preview':
        $NewsletterID = (int)$_GET['NewsletterID'];
        $news = new Newsletter($NewsletterID);
        $newsData = $news->previewNewsletter();
        $smarty->assign(array(
            'info' => $newsData,
        ));

        echo $output = $smarty->fetch('newsletters_mail.tpl');

        exit;

        break;

    case 'send-test':
        $NewsletterID = (int)$_GET['NewsletterID'];
        $news = new Newsletter($NewsletterID);
        $newsData = $news->previewNewsletter();

        // Get mail content
        $message = file_get_contents('online-newsletters/' . $newsData['Campaign'] . '/index.html');
        $message = str_replace("<br />", "<br/>", $message);
        // Get attachments
        $docs = array();
        foreach ((array)glob('online-newsletters/' . $newsData['Campaign'] . '/docs/*') as $item) {
            $docs[] = $item;
        }
        // Get test E-mails
        if (!empty($newsData['TestRecipients'])) {
            $emailsTest = explode(';', $newsData['TestRecipients']);
            if (!empty($emailsTest))
                foreach ($emailsTest as $email) {
                    if (filter_var(trim($email), FILTER_VALIDATE_EMAIL))
                        $emails[] = trim($email);
                }
            $emails = array_unique($emails);

            // Send the e-mails
            if (!empty($emails)) {
                include('libs/sendMail.php');
                foreach ($emails as $email) {
                    sendMail($newsData['FromAlias'], $newsData['FromEmail'], $email, $email, $newsData['Title'], $message, $docs);
                }
                header('Location: ./?m=newsletters&o=edit-intern&NewsletterID=' . $NewsletterID . '&msg=2');
            }
        } else
            throw new Exception('Adresa de test incorecta!');

        break;

    case 'del':

        $NewsletterID = (int)$_GET['NewsletterID'];
        $news = new Newsletter($NewsletterID);
        $news->delNewsletter();

        header('Location: ./?m=newsletters');
        exit;

        break;

    default:

        $action = !empty($_GET['action']) ? $_GET['action'] : 'default';
        $news = Newsletter::getAllNewsletters();

        switch ($action) {
            case 'export':
                unset($news[0]);
                $excel = array();
                foreach ($news as $k => $v) {
                    $excel[$k]['Campanie'] = $v['Campaign'];
                    $excel[$k]['Titlu stire'] = $v['Title'];
                    $excel[$k]['Tip'] = Newsletter::$msNewsletterTypes[$v['Type']];
                    $excel[$k]['Status'] = Newsletter::$msNewsletterStatus[$v['Status']];
                    $excel[$k]['Data crearii'] = $v['data'];
                }
                include("libs/xlsStream.php");
                export_file($excel, 'stiri');
                break;
            case 'export_doc':
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=newslettere.doc");
                $smarty->assign(array(
                    'news' => $news,
                    'types' => Newsletter::$msNewsletterTypes,
                    'status' => Newsletter::$msNewsletterStatus,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('newsletters_print.tpl');
                exit;
                break;
            case 'print_page':
            case 'print_all':
                $smarty->assign(array(
                    'news' => $news,
                    'types' => Newsletter::$msNewsletterTypes,
                    'status' => Newsletter::$msNewsletterStatus,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('newsletters_print.tpl');
                exit;
                break;
            default:
                $request_uri = !empty($_GET['res_per_page']) ? "./?m=newsletters&search_for={$_GET['search_for']}&Type={$_GET['Type']}&Status={$_GET['Status']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}" : "./?m=newsletters";
                $smarty->assign(array(
                    'news' => $news,
                    'types' => Newsletter::$msNewsletterTypes,
                    'status' => Newsletter::$msNewsletterStatus,
                    'request_uri' => $request_uri,
                ));
                # Pagination
                $pagination = Utils::paginate($news[0]['pageNo'], $news[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
                $smarty->assign('pagination', $pagination);
                $center_file = 'newsletters.tpl';
                break;
        }

        break;
}

?>