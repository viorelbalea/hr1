<?php

if (!isset($_SESSION['USER_ID'])) {
    header('Location: ../');
    exit;
}

switch ($o) {

    case 'new':

        if (!empty($_POST)) {

            try {

                $product = new Product();
                $ProductID = $product->addProduct($_POST);

                if (!empty($_FILES['photo']['name'])) {
                    if (in_array(substr(strtolower($_FILES['photo']['name']), -4), array('.jpg', '.gif'))) {
                        if (@move_uploaded_file($_FILES['photo']['tmp_name'], 'photos/products/' . md5($ProductID) . '.jpg')) {
                            $resized = Thumbnail::resize_img(Config::SRV_URL . 'photos/products/' . md5($ProductID) . '.jpg', 100, 100);
                            rename('photos/_tmp/' . basename($resized), 'photos/products/' . basename($resized));
                            $ThumbURL = Config::SRV_URL . 'photos/products/' . md5($ProductID) . '_100_100.jpg';
                            Product::setProductThumb($ProductID, $ThumbURL);
                        } else {
                            throw new Exception(Message::getMessage('PHOTO_ERROR_UPLOAD'));
                        }
                    } else {
                        throw new Exception(Message::getMessage('PHOTO_ERROR_TYPE'));
                    }
                }

                echo "<body onload=\"window.location.href = './?m=products&o=edit&ProductID={$ProductID}&msg=1'\"></body>";
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }

            $smarty->assign('info', Utils::displayInfo($_POST));
        }

        $smarty->assign(array(
            'companies' => Company::getCompanies(),
            'categories' => Utils::getAllProductCats(),
            'measurement_units' => Utils::getMeasurementUnits(),
            'customfields' => Utils::getCustomFields(),
        ));

        $center_file = 'product_new.tpl';

        break;

    case 'edit':

        $ProductID = (int)$_GET['ProductID'];
        $product = new Product($ProductID);

        if (!empty($_POST) || !empty($_GET['action'])) {

            try {

                $product->editProduct($_POST);

                if (!empty($_FILES['photo']['name'])) {
                    if (in_array(substr(strtolower($_FILES['photo']['name']), -4), array('.jpg', '.gif', '.png'))) {
                        if (@move_uploaded_file($_FILES['photo']['tmp_name'], 'photos/products/' . md5($ProductID) . '.jpg')) {
                            $resized = Thumbnail::resize_img(Config::SRV_URL . 'photos/products/' . md5($ProductID) . '.jpg', 100, 100);
                            rename('photos/_tmp/' . basename($resized), 'photos/products/' . basename($resized));
                            $ThumbURL = Config::SRV_URL . 'photos/products/' . md5($ProductID) . '_100_100.jpg';
                            Product::setProductThumb($ProductID, $ThumbURL);
                        } else {
                            throw new Exception(Message::getMessage('PHOTO_ERROR_UPLOAD'));
                        }
                    } else {
                        throw new Exception(Message::getMessage('PHOTO_ERROR_TYPE'));
                    }
                }

                echo "<body onload=\"window.location.href = './?m=products&o=edit&ProductID={$ProductID}&msg=1'\"></body>";
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }

        $smarty->assign(array(
            'companies' => Company::getCompanies(),
            'categories' => Utils::getAllProductCats(),
            'measurement_units' => Utils::getMeasurementUnits(),
            'customfields' => Utils::getCustomFields(),
            'info' => !empty($_POST) ? Utils::displayInfo($_POST) : $product->getProduct(),
        ));

        $center_file = 'product_new.tpl';

        break;

    case 'del':

        $ProductID = (int)$_GET['ProductID'];
        $product = new Product($ProductID);
        $product->delProduct();

        echo "<body onload=\"window.location.href = './?m=products'\"></body>";
        exit;

        break;

    case 'del_photo':

        $ProductID = (int)$_GET['ProductID'];
        $product = new Product($ProductID);

        try {
            $product->delProductPhoto();
            header('Location: ./?m=products&o=edit&ProductID=' . $ProductID);
            exit;
        } catch (Exception $exp) {
            $err->setError($exp->getMessage());
        }

        break;

    default:

        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS2'][37][1] > 0)) {
            $center_file = 'product_menu.tpl';
            return;
        }

        $action = !empty($_GET['action']) ? $_GET['action'] : 'default';
        $products = Product::getAllProducts($action);

        switch ($action) {
            case 'export':
                header("Content-Type: application/vnd.ms-excel");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=produse.xls");
                $smarty->assign(array(
                    'personalisedlist' => Utils::getPersonalisedList('Product'),
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    'products' => $products,
                ));
                $smarty->display('products_print.tpl');
                exit;
                break;
            case 'export_doc':
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=produse.doc");
                $smarty->assign(array(
                    'personalisedlist' => Utils::getPersonalisedList('Product'),
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    'products' => $products,
                ));
                $smarty->display('products_print.tpl');
                exit;
                break;
            case 'print_page':
            case 'print_all':
                $smarty->assign(array(
                    'personalisedlist' => Utils::getPersonalisedList('Product'),
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    'products' => $products,
                ));
                $smarty->display('products_print.tpl');
                exit;
                break;
            default:
                $request_uri = !empty($_GET['res_per_page']) ? "./?m=products&CompanyID={$_GET['CompanyID']}&CategoryID={$_GET['CategoryID']}&Promo={$_GET['Promo']}&SecondHand={$_GET['SecondHand']}&StocOff={$_GET['StocOff']}&CustomProduct1={$_GET['CustomProduct1']}&CustomProduct2={$_GET['CustomProduct2']}&CustomProduct3={$_GET['CustomProduct3']}&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}" : "./?m=products";
                $customfields = Utils::getCustomFields();
                $smarty->assign(array(
                    'personalisedlist' => Utils::getPersonalisedList('Product'),
                    'companies' => Company::getCompanies(),
                    'categories' => Utils::getAllProductCats(),
                    'customproducts1' => isset($customfields['CustomProduct1']) ? Product::getValuesByField('CustomProduct1') : array(),
                    'customproducts2' => isset($customfields['CustomProduct2']) ? Product::getValuesByField('CustomProduct2') : array(),
                    'customproducts3' => isset($customfields['CustomProduct3']) ? Product::getValuesByField('CustomProduct3') : array(),
                    'request_uri' => $request_uri,
                    'products' => $products,
                ));
                $pagination = Utils::paginate($products[0]['pageNo'], $products[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
                $smarty->assign('pagination', $pagination);
                $center_file = 'products.tpl';
                break;
        }

        break;
}

?>