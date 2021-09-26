<?php

class Product
{

    public static $ProductImportData;
    private $ProductID;

    public function __construct($ProductID = 0)
    {
        $this->ProductID = $ProductID;
    }

    public static function getAllProducts($action = '')
    {

        global $conn;

        $cond = '';

        if (!empty($_GET['search_for'])) {
            switch ($_GET['search_for']) {
                case 'Title';
                    $cond .= " AND a.Title LIKE '{$_GET['keyword']}%'";
                    break;
                case 'Description';
                    $cond .= " AND a.Description LIKE '{$_GET['keyword']}%'";
                    break;
            }
        }

        if (!empty($_GET['CompanyID'])) {
            $cond .= " AND a.CompanyID = '" . (int)$_GET['CompanyID'] . "'";
        }

        if (!empty($_GET['CategoryID'])) {
            $cond .= " AND a.CategoryID = '" . (int)$_GET['CategoryID'] . "'";
        }

        if (isset($_GET['Promo']) && $_GET['Promo'] != 'all') {
            $cond .= " AND a.Promo = " . (int)$_GET['Promo'];
        }

        if (isset($_GET['SecondHand']) && $_GET['SecondHand'] != 'all') {
            $cond .= " AND a.SecondHand = " . (int)$_GET['SecondHand'];
        }

        if (isset($_GET['StocOff']) && $_GET['StocOff'] != 'all') {
            $cond .= " AND a.StocOff = " . (int)$_GET['StocOff'];
        }

        if (!empty($_GET['CustomProduct1'])) {
            $cond .= " AND a.CustomProduct1 = '" . $_GET['CustomProduct1'] . "'";
        }

        if (!empty($_GET['CustomProduct2'])) {
            $cond .= " AND a.CustomProduct2 = '" . $_GET['CustomProduct2'] . "'";
        }

        if (!empty($_GET['CustomProduct3'])) {
            $cond .= " AND a.CustomProduct3 = '" . $_GET['CustomProduct3'] . "'";
        }

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        $condbase = "('{$_SESSION['USER_RIGHTS2'][37][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}')) OR
	             '{$_SESSION['USER_RIGHTS2'][37][1]}' > 1 OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT COUNT(*) AS total
                   FROM   products a
                   WHERE  ($condbase) $cond";
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $products = array();
        $products[0]['pageNo'] = $pageNo;
        $products[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.Title';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        $query = "SELECT a.*, b.CompanyName, c.Name
	          FROM   products a
	                 LEFT JOIN companies b ON a.CompanyID = b.CompanyID
	                 LEFT JOIN product_categories c ON a.CategoryID = c.CatID
	          WHERE  ($condbase) $cond
	          ORDER  BY $order_by $asc_or_desc " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $products[$row['ProductID']] = $row;
        }

        return $products;
    }

    public static function getValuesByField($field)
    {
        global $conn;
        $values = array();
        $conn->query("SELECT DISTINCT $field FROM products");
        while ($row = $conn->fetch_array()) {
            $values[] = $row[$field];
        }
        return $values;
    }

    public static function getProductsSuggestions()
    {
        global $conn;
        $products_suggest = "";
        $values = array();
        $conn->query("SELECT ProductID as value, Title as label, Description as 'desc', Icon as icon, Price as price, MaxDiscount as maxdiscount from products order by price asc");

        while ($row = $conn->fetch_array()) {
            $values[] = $row;
        }
        return $values;
    }

    public static function getProductsByOffer($ActivityDetID, $OfferIndex)
    {
        global $conn;
        $products = array();
        $conn->query("SELECT ap.*, 
						p.Title as Title, 
						p.Description as Description, 
						p.MaxDiscount as maxdiscount FROM activities_products ap
					INNER JOIN products p ON p.ProductID = ap.ProductID
					WHERE ap.ActivityDetID = $ActivityDetID AND ap.OfferIndex = $OfferIndex ORDER BY ap.CreateDate");
        while ($row = $conn->fetch_array()) {
            $products[$row['ActProdID']] = $row;
        }
        return $products;
    }

    public static function setProductsByOffer($ActivityDetID, $OfferIndex)
    {
        global $conn;
        if (!empty($_GET['ActProdID'])) {
            if (!empty($_GET['delete'])) {
                $conn->query("DELETE FROM activities_products WHERE ActProdID = '{$_GET['ActProdID']}' AND ActivityDetID = '{$ActivityDetID}'");
            } else {
                $conn->query("UPDATE activities_products SET
				     ProductID 		= '{$_GET['ProductID']}',
				     Price     		= '{$_GET['Price']}',
				     Discount  		= '{$_GET['Discount']}',
				     Stoc      		= '{$_GET['Stoc']}',
				     LastUpdateDate 	= CURRENT_TIMESTAMP
		              WHERE  ActProdID = '{$_GET['ActProdID']}' AND ActivityDetID = '{$ActivityDetID}'");
            }
        } else {
            $conn->query("INSERT INTO activities_products(ActivityDetID, UserID, OfferIndex, ProductID, Price, Discount, Stoc, CreateDate, LastUpdateDate)
	                  VALUES('{$ActivityDetID}', '{$_SESSION['USER_ID']}', '{$OfferIndex}', '{$_GET['ProductID']}', '{$_GET['Price']}', '{$_GET['Discount']}', '{$_GET['Stoc']}', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
        }
    }

    public static function setProductThumb($ProductID, $ThumbURL)
    {
        global $conn;
        $conn->query("UPDATE products SET Icon = '{$ThumbURL}' WHERE ProductID='" . $ProductID . "'");
    }

    public static function getNextOfferIndex($ActivityDetID)
    {
        global $conn;
        $getMaxOfferIndex = $conn->query("SELECT MAX(OfferIndex) AS MaxOfferIndex FROM activities_products WHERE ActivityDetID= '" . $ActivityDetID . "'");
        $result = $conn->fetch_array($getMaxOfferIndex);
        return ($result['MaxOfferIndex'] + 1);
    }

    public static function getProducts()
    {
        global $conn;
        $products = array();
        $conn->query("SELECT ProductID, Title, Price, MaxDiscount FROM products ORDER BY Title");
        while ($row = $conn->fetch_array()) {
            $products[$row['ProductID'] . '|' . $row['Price'] . '|' . $row['MaxDiscount']] = stripslashes($row['Title']);
        }
        return $products;
    }

    public static function getProductsOffers($ActivityDetID)
    {
        global $conn;
        $offers = array();
        $conn->query("SELECT OfferIndex, SUM(Price*(1-Discount/100)*Stoc) AS OfferValue, MAX(LastUpdateDate) AS OfferDate
	              FROM   activities_products 
		      WHERE  ActivityDetID = $ActivityDetID 
		      GROUP  BY OfferIndex");
        while ($row = $conn->fetch_array()) {
            $offers[$row['OfferIndex']] = $row;
        }
        return $offers;
    }

    public static function delOffer($ActivityDetID, $OfferIndex)
    {
        global $conn;
        $conn->query("DELETE FROM activities_products WHERE ActivityDetID = '{$ActivityDetID}' AND OfferIndex = '{$OfferIndex}'");
    }

    public function addProduct($info = array())
    {

        $this->setData($info);

        global $conn;

        $conn->query("INSERT INTO products(UserID, PID, CreateDate, LastUpdateDate, " . implode(", ", array_keys($info)) . ")
                      VALUES({$_SESSION['USER_ID']}, '{$_SESSION['PERS']}', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '" . implode("', '", $info) . "')");

        return $conn->get_insert_id();
    }

    private function setData(&$info)
    {
        foreach ($info as &$v) {
            if (!is_numeric($v) && !is_array($v)) {
                $v = Utils::formatStr($v);
            }
        }
        if (!$info['Title']) {
            throw new Exception('Nu ati completat denumire produs!');
        }
        if (!empty($info['CustomProduct3'])) {
            $info['CustomProduct3'] = Utils::toDBDate($info['CustomProduct3']);
        }
    }

    public function getProduct()
    {

        global $conn;

        $condbase = "('{$_SESSION['USER_RIGHTS3'][37][1][1]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][37][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}')) OR
	             '{$_SESSION['USER_RIGHTS2'][37][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][37][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}'))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][37][1][1]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT a.*, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
                  FROM   products a
                  WHERE  a.ProductID = {$this->ProductID} AND ($condbase)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            $hash = md5($row['ProductID']);
            if (file_exists('photos/products/' . $hash . '.jpg')) {
                $row['photoBig'] = 'photos/products/' . $hash . '.jpg?rn=' . rand(1, 99999999);
                if (!file_exists('photos/products/' . $hash . '_100_100.jpg')) {
                    $resized = Thumbnail::resize_img(Config::SRV_URL . 'photos/products/' . $hash . '.jpg', 100, 100);
                    rename('photos/_tmp/' . basename($resized), 'photos/products/' . basename($resized));
                }
                $row['photo'] = 'photos/products/' . $hash . '_100_100.jpg?rn=' . rand(1, 99999999);
            }
            return $row;
        } else {
            throw new Exception('Nu exista acest produs');
        }
    }

    public function editProduct($info = array())
    {

        $this->setData($info);

        global $conn;

        $update = '';
        foreach ($info as $k => $v) {
            $update .= "$k = '$v', ";
        }

        $condrw = "('{$_SESSION['USER_RIGHTS2'][37][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}'))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][37][1][1]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("UPDATE products a SET $update LastUpdateDate = CURRENT_TIMESTAMP WHERE ProductID = {$this->ProductID} AND ($condrw)");
    }

    public function delProduct()
    {

        global $conn;

        $condrw = "('{$_SESSION['USER_RIGHTS2'][37][1]}' = 3 AND (UserID = {$_SESSION['USER_ID']} OR PID = '{$_SESSION['PERS']}'))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][37][1][1]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("DELETE FROM products WHERE ProductID = {$this->ProductID} AND ($condrw)");
    }

    public function delProductPhoto()
    {
        if (is_file('photos/products/' . md5($this->ProductID) . '.jpg')) {
            @unlink('photos/products/' . md5($this->ProductID) . '.jpg');
            @unlink('photos/products/' . md5($this->ProductID) . '_100_100.jpg');
            @unlink('photos/_tmp/' . md5($this->ProductID) . '_100_100.jpg');
        }
    }
}

?>