<?php

if (!isset($_SESSION['USER_ID'])) {
    header('Location: ../');
    exit;
}

switch ($o) {

    case 'new':
        if (!empty($_POST)) {

            try {

                $news = new News();
                $NewsID = $news->addNews($_POST);
                header('Location: ./?m=news&o=edit&NewsID=' . $NewsID);

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
                $smarty->assign('info', Utils::displayInfo($_POST));
            }
        }

        ## Init FCK fields
        $content = new FCKeditor('Content', '100%', 200); //nume camp, latime, inaltime

        $smarty->assign(array(
            'types' => News::$msNewsTypes,
            'content' => $content->Create(), // activate fck field
            'images' => $images = Utils::listFiles('images/50'), //show images
        ));

        $center_file = 'news_new.tpl';

        break;

    case 'edit':

        $NewsID = (int)$_GET['NewsID'];
        $news = new News($NewsID);
        if (!empty($_POST)) {

            try {

                $news->editNews($_POST);

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }
        $newsData = $news->getNews();

        ## Init FCK fields
        $content = new FCKeditor('Content', '100%', 200); //nume camp, latime, inaltime
        $content->Value = $newsData['Content'];

        $smarty->assign(array(
            'info' => !empty($_POST) ? Utils::displayInfo($_POST) : $newsData,
            'content' => $content->Create(), // activate fck field
            'types' => News::$msNewsTypes,
            'images' => $images = Utils::listFiles('images/50'), //show images
        ));

        $center_file = 'news_new.tpl';

        break;

    case 'del':

        $NewsID = (int)$_GET['NewsID'];
        $news = new News($NewsID);
        $news->delNews();

        header('Location: ./?m=news');
        exit;

        break;

    default:

        $action = !empty($_GET['action']) ? $_GET['action'] : 'default';
        $news = News::getAllNews();

        switch ($action) {
            case 'export':
                unset($news[0]);
                $excel = array();
                foreach ($news as $k => $v) {
                    $excel[$k]['Titlu stire'] = $v['Title'];
                    $excel[$k]['Data crearii'] = $v['data'];
                }
                include("libs/xlsStream.php");
                export_file($excel, 'stiri');
                break;
            case 'export_doc':
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=stiri.doc");
                $smarty->assign(array(
                    'news' => $news,
                    'types' => News::$msNewsTypes,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('news_print.tpl');
                exit;
                break;
            case 'print_page':
            case 'print_all':
                $smarty->assign(array(
                    'news' => $news,
                    'types' => News::$msNewsTypes,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('news_print.tpl');
                exit;
                break;
            default:
                $request_uri = !empty($_GET['res_per_page']) ? "./?m=news&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}" : "./?m=news";
                $smarty->assign(array(
                    'news' => $news,
                    'types' => News::$msNewsTypes,
                    'request_uri' => $request_uri,
                ));
                # Pagination
                $pagination = Utils::paginate($news[0]['pageNo'], $news[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
                $smarty->assign('pagination', $pagination);
                $center_file = 'news.tpl';
                break;
        }

        break;
}

?>