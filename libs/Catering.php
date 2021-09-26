<?php

class Catering
{

    public static function getCatering()
    {

        global $conn;

        $conn->query("SELECT CatID, Category, Status, Price FROM catering ORDER BY CatID");
        $catering = array();
        while ($row = $conn->fetch_array()) {
            $catering[$row['CatID']] = $row;
        }
        return $catering;
    }

    public static function setCatering($CatID)
    {

        global $conn;

        if (!empty($_GET['delCategory']) && $CatID > 0) {
            $conn->query("DELETE FROM catering WHERE CatID = $CatID AND NOT EXISTS (SELECT CatID FROM persons_catering WHERE CatID = $CatID)");
            if (!$conn->get_affected_rows()) {
                echo "<body onload=\"alert('Nu se poate sterge aceasta categorie deoarece este deja alocata angajatilor!'); window.location.href = './?m=catering&o=dictionary';\"></body>";
                exit;
            } else {
                $conn->query("DELETE FROM catering_items WHERE CatID = $CatID");
                header('Location: ./?m=catering&o=dictionary');
                exit;
            }
        }

        if (!empty($_GET['Category']) && trim($_GET['Category'])) {
            if ($CatID > 0) {
                $conn->query("UPDATE catering SET Category = '" . trim($_GET['Category']) . "', Status = '{$_GET['Status']}'" . ", Price = '{$_GET['Price']}' WHERE CatID = $CatID");
            } else {
                $conn->query("INSERT INTO catering(Category, Price, CreateDate) VALUES('" . trim($_GET['Category']) . "','" . trim($_GET['Price']) . "', CURRENT_TIMESTAMP)");
            }
        }
    }

    public static function getCateringItems($CatID)
    {

        global $conn;

        $conn->query("SELECT ItemID, CatID, Item, Calories, Status FROM catering_items WHERE CatID = $CatID ORDER BY Item");
        $items = array();
        while ($row = $conn->fetch_array()) {
            $items[$row['ItemID']] = $row;
        }
        return $items;
    }

    public static function setCateringItem($CatID, $ItemID)
    {

        global $conn;

        if (!empty($_GET['delItem'])) {
            $conn->query("DELETE FROM catering_items WHERE CatID = $CatID AND ItemID = $ItemID AND NOT EXISTS (SELECT ItemID FROM persons_catering WHERE ItemID = $ItemID)");
            if (!$conn->get_affected_rows()) {
                echo "<body onload=\"alert('Nu se poate sterge acest item deoarece este deja alocat angajatilor!'); window.location.href = './?m=catering&o=dictionary&CatID=$CatID';\"></body>";
                exit;
            }
        }

        if (!empty($_GET['Item']) && trim($_GET['Item'])) {
            if ($ItemID > 0) {
                $conn->query("UPDATE catering_items SET Item = '" . trim($_GET['Item']) . "', Status = '{$_GET['Status']}', Calories='" . trim($_GET['Calories']) . "' WHERE ItemID = $ItemID AND CatID = $CatID");
            } else {
                $conn->query("INSERT INTO catering_items(CatID, Item, Calories, CreateDate) VALUES($CatID, '" . trim($_GET['Item']) . "', '" . trim($_GET['Calories']) . "', CURRENT_TIMESTAMP)");
            }
        }
    }

    public static function getCateringByWeek($StartDate, $EndDate)
    {

        global $conn;

        $catering = array();

        $query = "SELECT a.CatID, a.Category, b.ItemID, a.Price, b.Calories, b.Item
	          FROM   catering a
		         INNER JOIN catering_items b ON a.CatID = b.CatID
		  WHERE  a.Status = 1 AND b.Status = 1
		  ORDER  BY a.CatID, b.Item";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            if (!isset($catering[$row['CatID']])) {
                $catering[$row['CatID']][0]['Category'] = $row['Category'];
            }
            $catering[$row['CatID']][$row['ItemID']]['Item'] = $row['Item'];
            $catering[$row['CatID']][$row['ItemID']]['Calories'] = $row['Calories'];
        }

        $query = "SELECT Date, CatID, ItemID FROM catering_weeks WHERE StartDate = '{$StartDate}'";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            if (isset($catering[$row['CatID']][$row['ItemID']])) {
                $catering[$row['CatID']][$row['ItemID']][$row['Date']] = 1;
            }
        }

        return $catering;
    }

    public static function setCateringByWeek($StartDate, $EndDate)
    {

        global $conn;

        $conn->query("DELETE FROM catering_weeks WHERE StartDate = '{$StartDate}'");

        foreach ((array)$_POST['Status'] as $CatID => $v) {
            foreach ((array)$v as $ItemID => $vv) {
                foreach ((array)$vv as $Date => $Status) {
                    $conn->query("INSERT INTO catering_weeks(StartDate, EndDate, Date, CatID, ItemID, CreateDate)
	                      VALUES('{$StartDate}', '{$EndDate}', '{$Date}', $CatID, $ItemID, CURRENT_TIMESTAMP)");
                }
            }
        }
    }

    public static function getCateringByPerson($PersonID, $StartDate, $EndDate)
    {

        global $conn;

        $query = "SELECT a.CatID, a.Category, b.ItemID, b.Item, c.Date, a.Price, b.Calories
	          FROM   catering a
		         INNER JOIN catering_items b ON a.CatID = b.CatID
			 INNER JOIN catering_weeks c ON a.CatID = c.CatID AND b.ItemID = c.ItemID AND c.StartDate = '{$StartDate}'
		  WHERE  a.Status = 1 AND b.Status = 1
		  ORDER  BY a.CatID, c.Date ASC, b.Item ASC";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            if (!isset($catering[$row['CatID']])) {
                $catering[$row['CatID']][0]['Category'] = $row['Category'];
            }
            $catering[$row['CatID']][$row['ItemID']]['Item'] = $row['Item'];
            $catering[$row['CatID']][$row['ItemID']]['Calories'] = $row['Calories'];
            $catering[$row['CatID']][$row['ItemID']]['Date'][$row['Date']] = 1;
        }

        $query = "SELECT Date, CatID, ItemID, No FROM persons_catering WHERE PersonID = $PersonID AND StartDate = '{$StartDate}'";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            if (isset($catering[$row['CatID']][$row['ItemID']])) {
                $catering[$row['CatID']][$row['ItemID']][$row['Date']] = $row['No'];
            }
        }
        return $catering;
    }

    public static function setCateringByPerson($PersonID, $StartDate, $EndDate, $type = '')
    {

        global $conn;

        $conn->query("DELETE FROM persons_catering WHERE PersonID = $PersonID AND StartDate = '{$StartDate}'");

        $query = "SELECT * FROM persons a 
					LEFT JOIN payroll b ON a.PersonID=b.PersonID WHERE a.PersonID='$PersonID'";
        $conn->query($query);
        $personData = $conn->fetch_array();
        $subdepartmentID = $personData['SubDepartmentID'];

        if (Config::CATERING_FREE == 1 && $type == 'week') {
            //*** THIS IS A HARD CODE WHICH DOES THE FOLLOWING - REMOVE THIS BLOCK WHEN NECESSARY
            //** ADDS TO A PERSON FROM Subdepartment 1 A SOUP IF IN THAT DAY HE DOES NOT HAVE ONE
            foreach ((array)$_POST['No'] as $CatID => $v) {
                foreach ((array)$v as $Date => $vv) {
                    foreach ((array)$vv as $ItemID => $No) {
                        if ($subdepartmentID == Config::CATERING_FREE_SUBDEPARTMENTID && $CatID == Config::CATERING_FREE_CATEG && array_sum($_POST['No'][$CatID][$Date]) < 1)
                            $_POST['No'][$CatID][$Date][Config::CATERING_FREE_ITEM] = 1;
                    }
                }
            }
        }
        //** END OF HARDCODED BLOCK
        //print_r($_POST); die();
        foreach ((array)$_POST['No'] as $CatID => $v) {
            foreach ((array)$v as $Date => $vv) {
                foreach ((array)$vv as $ItemID => $No) {
                    $No = (int)$No;
                    $conn->query("INSERT INTO persons_catering(UserID, PersonID, StartDate, EndDate, Date, CatID, ItemID, No, CreateDate)
			                          VALUES({$_SESSION['USER_ID']}, $PersonID, '{$StartDate}', '{$EndDate}',  '{$Date}', $CatID, $ItemID, $No, CURRENT_TIMESTAMP)");
                }
            }
        }
        //Send email
        if (!empty($personData['Email'])) {
            $message = "<b>S-a efectuat o modificare a meniului tau de catering pentru perioada: " . $_GET['StartDate'] . " - " . $_GET['EndDate'] . "<br>";
            include('sendMail.php');
            sendMail('HR Executive Catering', Config::SMTP_EMAIL, $personData['FullName'], $personData['Email'], 'Modificare meniu catering', $message);
        }
    }
}

?>