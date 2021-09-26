<?php

class Address
{

    public static function getStreetByCode($districtID, $city, $code)
    {

        global $conn;

        $districtID = (int)$districtID;
        $city = strtolower(trim($city));
        $code = trim($code);

        $conn->query("SELECT StreetName 
                      FROM   address_street
                      WHERE  CityID = (SELECT CityID FROM address_city WHERE DistrictID = $districtID AND LOWER(CityName) = '$city') AND
                             StreetCode = '$code'");

        return ($row = $conn->fetch_array()) ? $row['StreetName'] : '';
    }

    public static function getDistricts()
    {

        global $conn;

        $conn->query("SELECT DistrictID, DistrictName 
                      FROM   address_district 
                      WHERE  CountryID = 181 AND Active = 1
                      ORDER  BY DistrictName");
        $districts = array();

        while ($row = $conn->fetch_array()) {
            $districts[$row['DistrictID']] = $row['DistrictName'];
        }

        return $districts;
    }

    public static function getCities($districtID, $pattern = '')
    {

        global $conn;

        $districtID = (int)$districtID;

        $cond = !empty($pattern) ? " AND LOWER(CityName) LIKE '" . strtolower($pattern) . "%' " : "";

        $conn->query("SELECT CityID, CityName
                      FROM   address_city
                      WHERE  DistrictID = $districtID AND Active = 1 $cond
                      ORDER  BY CityName");
        $cities = array();

        while ($row = $conn->fetch_array()) {
            $cities[$row['CityID']] = $row['CityName'];
        }

        return $cities;
    }

    public static function getAllCities()
    {

        global $conn;

        $conn->query("SELECT CityID, CityName FROM address_city WHERE Active = 1 ORDER BY CityName");
        $cities = array();

        while ($row = $conn->fetch_array()) {
            $cities[$row['CityID']] = $row['CityName'];
        }

        return $cities;
    }

    public static function getDistrictsAdmin()
    {

        global $conn;

        $conn->query("SELECT DistrictID, DistrictName, Active
                      FROM   address_district 
                      WHERE  CountryID = 181
                      ORDER  BY DistrictName");
        $districts = array();

        while ($row = $conn->fetch_array()) {
            $districts[$row['DistrictID']] = $row;
        }

        return $districts;
    }

    public static function setDistrict($DistrictID)
    {

        global $conn;

        if ($DistrictID > 0 && !empty($_GET['delDistrict'])) {
            $conn->query("DELETE 
	                  FROM   address_district 
			  WHERE  DistrictID = $DistrictID AND NOT EXISTS (SELECT * FROM address_city WHERE DistrictID = $DistrictID)");
            if (!$conn->get_affected_rows()) {
                echo "<body onload=\"alert('Nu se poate sterge acest judet deoarece contine orase!\\nVa recomandam inactivarea lui!'); window.location.href = './?m=dictionary&o=city';\"></body>";
                exit;
            }

        } else {

            $DistrictName = Utils::formatStr($_GET['DistrictName']);

            if ($DistrictID > 0) {
                $Active = !empty($_GET['Active']) ? 1 : 0;
                $conn->query("UPDATE address_district SET DistrictName = '$DistrictName', Active = $Active WHERE DistrictID = $DistrictID");
            } else {
                $conn->query("INSERT INTO address_district(DistrictName) VALUES('$DistrictName')");
            }
        }
    }

    public static function getCitiesAdmin($districtID)
    {

        global $conn;

        $districtID = (int)$districtID;

        $res_per_page = Config::$msResPerPage;

        $query = "SELECT COUNT(*) AS total FROM address_city WHERE DistrictID = $districtID";
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $cities = array();
        $cities[0]['pageNo'] = $pageNo;
        $cities[0]['page'] = $page;

        $conn->query("SELECT CityID, CityName, Active
                      FROM   address_city
                      WHERE  DistrictID = $districtID
                      ORDER  BY CityName
		      LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        while ($row = $conn->fetch_array()) {
            $cities[$row['CityID']] = $row;
        }

        return $cities;
    }

    public static function setCity($DistrictID, $CityID)
    {

        global $conn;

        if ($CityID > 0 && !empty($_GET['delCity'])) {
            if (!empty($_GET['NewCityID'])) {
                $conn->query("UPDATE address SET CityID = " . (int)$_GET['NewCityID'] . " WHERE CityID = $CityID");
            }
            $conn->query("DELETE 
	                  FROM   address_city
			  WHERE  CityID = $CityID AND NOT EXISTS (SELECT * FROM address WHERE CityID = $CityID)");
            if (!$conn->get_affected_rows()) {
                echo "<body onload=\"alert('Nu se poate sterge acest oras deoarece contine adrese!\\nVa recomandam inactivarea lui sau alocarea altui oras adreselor existente!'); window.location.href = './?m=dictionary&o=city&DistrictID=$DistrictID';\"></body>";
                exit;
            }

        } else {

            $CityName = Utils::formatStr($_GET['CityName']);

            if ($CityID > 0) {
                $Active = !empty($_GET['Active']) ? 1 : 0;
                $conn->query("UPDATE address_city SET CityName = '$CityName', Active = $Active WHERE CityID = $CityID");
            } else {
                $conn->query("INSERT INTO address_city(DistrictID, CityName) VALUES($DistrictID, '$CityName')");
            }
        }
    }

}

?>