<?php

if (!isset($_SESSION['USER_ID'])) {
    header('Location: ../');
    exit;
}


switch ($o) {

    case 'new':

        if (!empty($_POST)) {

            try {
                $forum = new Forum();
                $ThreadID = $forum->addThread($_POST);
                header('Location: ./?m=forum&o=edit&ThreadID=' . $ThreadID);

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
                $smarty->assign('info', Utils::displayInfo($_POST));
            }
        }

        $smarty->assign(array(
            'threadStatus' => Forum::$msStatus,
        ));

        $center_file = 'forum_thread_new.tpl';

        break;

    case 'edit':

        $ThreadID = (int)$_GET['ThreadID'];
        $forum = new Forum($ThreadID);

        if (!empty($_POST)) {

            try {

                $forum->editThread($_POST);

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }

        $smarty->assign(array(
            'threadStatus' => Forum::$msStatus,
            'info' => !empty($_POST) ? Utils::displayInfo($_POST) : $forum->getThread(),
        ));

        $center_file = 'forum_thread_new.tpl';

        break;

    case 'del':

        $ThreadID = (int)$_GET['ThreadID'];
        $forum = new Forum($ThreadID);
        $forum->delThread();

        header('Location: ./?m=forum');
        exit;

        break;


    case 'posts':

        $action = !empty($_GET['action']) ? $_GET['action'] : 'default';

        switch ($action) {
            case 'new_post':
                if (!empty($_GET['ThreadID'])) {

                    try {
                        Forum::addPost($_POST);
                        header('Location: ./?m=forum&o=posts&ThreadID=' . $_GET['ThreadID']);

                    } catch (Exception $exp) {

                        $err->setError($exp->getMessage());
                        $smarty->assign('info', Utils::displayInfo($_POST));
                    }
                }
                break;

            case 'del_post':

                $PostID = (int)$_GET['PostID'];
                Forum::delPost($PostID);
                header('Location: ./?m=forum&o=posts&ThreadID=' . $_GET['ThreadID']);
                break;

            default:
                $xThread = new Forum($_GET['ThreadID']);
                $threadInfo = $xThread->getThread();

                $posts = Forum::getPosts($_GET['ThreadID']);
                $smarty->assign(array(
                    'thread' => $threadInfo,
                    'posts' => $posts,
                    'prototype' => 1,
                    'request_uri' => !empty($_GET['res_per_page']) ? "./?m=forum&StatusID={$_GET['CatID']}&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}" : "./?m=forum",
                ));
                break;
        }

        $center_file = 'forum_posts.tpl';

        break;

    default:

        $action = !empty($_GET['action']) ? $_GET['action'] : 'default';
        $threads = Forum::getAllThreads($action);
        //Utils::pa($threads);

        switch ($action) {
            default:
                $request_uri = !empty($_GET['res_per_page']) ? "./?m=forum&StatusID={$_GET['StatusID']}&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}" : "./?m=forum";
                $smarty->assign(array(
                    'threads' => $threads,
                    'persons' => Forum::getPersons(),
                    'threadStatus' => Forum::$msStatus,
                    'request_uri' => $request_uri,
                ));
                # Pagination
                $pagination = Utils::paginate($threads[0]['pageNo'], $threads[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
                $smarty->assign('pagination', $pagination);

                $center_file = 'forum_threads.tpl';
                break;
        }

        break;
}

?>