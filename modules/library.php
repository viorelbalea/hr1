<?php

if (!isset($_SESSION['USER_ID'])) {
    header('Location: ../');
    exit;
}

switch ($o) {

    case 'new':

        $doc_dir = 'docs/' . md5($_SESSION['USER_ID'] > 0 ? $_SESSION['USER_ID'] . '_0' : '0_' . $_SESSION['PERS']) . '/';

        if (!empty($_POST)) {

            try {

                $_POST['FileName'] = $_FILES['FileName']['name'];
                $library = new Library();
                $library->addDoc($_POST, $_FILES, $doc_dir);

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
                $smarty->assign('info', Utils::displayInfo($_POST));
            }
        }

        $categories = Library::getCategoriesByUser(true);

        $smarty->assign(array(
            'cats' => Library::getAllCats(),
            'categories' => $categories,
            'internal_functions' => Utils::getGroupFunctions(),
        ));

        $center_file = 'library_new.tpl';

        break;

    case 'edit':

        $DocID = (int)$_GET['DocID'];
        $library = new Library($DocID);
        $info = $library->getDoc();

        $doc_dir = 'docs/' . md5($info['UserID'] > 0 ? $info['UserID'] . '_0' : '0_' . $info['PersonID']) . '/';

        if (!empty($_POST)) {

            try {
                $library->editDoc($_POST, $_FILES, $doc_dir);
                $info = $library->getDoc();
            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }

        $categories = Library::getCategoriesByUser();

        $smarty->assign(array(
            'cats' => Library::getAllCats(),
            'categories' => $categories,
            'internal_functions' => Utils::getGroupFunctions(),
            'info' => $info,
        ));

        $center_file = 'library_new.tpl';

        break;

    case 'del':

        $DocID = (int)$_GET['DocID'];
        $library = new Library($DocID);
        $info = $library->getDoc();

        @unlink($info['curr_filename']);
        $library->delDoc();

        header('Location: ./?m=library');
        exit;

        break;

    default:

        $categories = Library::getCategoriesByUser();

        $action = !empty($_GET['action']) ? $_GET['action'] : 'default';
        $docs = Library::getAllDocuments($action);

        switch ($action) {
            case 'export':
                unset($docs[0]);
                $excel = array();
                foreach ($docs as $k => $doc) {
                    $excel[$k]['Nume document'] = $doc['DocName'];
                    $excel[$k]['Categorie'] = $doc['CatName'];
                    $excel[$k]['Cod document'] = $doc['DocCode'];
                    $excel[$k]['Versiune'] = $doc['DocVersion'];
                    $excel[$k]['Descriere'] = $doc['DocDescr'];
                    $excel[$k]['Data crearii'] = $doc['data'];
                }
                include("libs/xlsStream.php");
                export_file($excel, 'documente');
                break;
            case 'export_doc':
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=documente.doc");
                $smarty->assign(array(
                    'docs' => $docs,
                    'cats' => Library::getAllCats(),
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('library_print.tpl');
                exit;
                break;
            case 'print_page':
            case 'print_all':
                $smarty->assign(array(
                    'docs' => $docs,
                    'cats' => Library::getAllCats(),
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('library_print.tpl');
                exit;
                break;
            default:
                $request_uri = !empty($_GET['res_per_page']) ? "./?m=library&CatID={$_GET['CatID']}&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}" : "./?m=library";
                $smarty->assign(array(
                    'docs' => $docs,
                    'cats' => Library::getAllCats(),
                    'categories' => $categories,
                    'request_uri' => $request_uri,
                ));
                # Pagination
                if (!isset($_GET['order_by']))
                    $_GET['order_by'] = NULL;
                if (!isset($_GET['asc_or_desc']))
                    $_GET['asc_or_desc'] = NULL;
                $pagination = Utils::paginate($docs[0]['pageNo'], $docs[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
                $smarty->assign('pagination', $pagination);
                $center_file = 'library.tpl';
                break;
        }

        break;
}

?>