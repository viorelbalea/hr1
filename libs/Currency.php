<?php

class Currency extends ConfigData
{

    private $RateID;

    public function __construct($RateID = 0)
    {
        if ($v > 0) {
            $this->RateID = $RateID;
        }
    }

    public static function getSysRates($year = '', $currency1 = '', $currency2 = '')
    {

        global $conn;
        $res = NULL;

        $cond = '';
        if (!empty($year))
            $cond .= " AND Year='$year'";
        else {
            $year = date('Y');
            $cond .= " AND Year='$year'";
        }
        if (!empty($currency1))
            $cond .= " AND Currency1='$currency1'";
        if (!empty($currency2))
            $cond .= " AND Currency2='$currency2'";

        $query = "SELECT * FROM rates WHERE 1=1 $cond GROUP BY Year, Currency1, Currency2 ORDER BY Year DESC";
        $conn->query($query);

        while ($row = $conn->fetch_array()) {
            $res[$row['Year']][$row['Currency2']] = $row;

        }
        return $res;
    }

    public static function getRates()
    {

        global $conn;
        $conn->query("SELECT * FROM rates ORDER BY Year DESC");
        while ($row = $conn->fetch_array()) {
            $row['Parity'] = $row['Currency1'] . '/' . $row['Currency2'];
            $res[$row['RateID']] = $row;
        }
        $res[0] = array();
        return $res;
    }

    public static function editRate($RateID)
    {

        global $conn;

        if ($RateID > 0 && !empty($_GET['del'])) {
            $conn->query("DELETE FROM rates WHERE  RateID = $RateID");
        } else {
            $Currencies = explode('/', $_POST['Currency']);
            $Year = (int)$_POST['Year'];
            $Currency1 = $Currencies[0];
            $Currency2 = $Currencies[1];
            $Rate = (float)$_POST['Rate'];
            $Type = (int)$_POST['Type'];
            $Note = $_POST['Note'];
            $Status = (int)$_POST['Status'];

            if ($RateID > 0) {
                $conn->query("UPDATE rates SET Year = '$Year', Currency1 = '$Currency1', Currency2 = '$Currency2',Rate = '$Rate',Type = '$Type', Status='$Status', Note='$Note', LastUpdate=CURRENT_TIMESTAMP  WHERE RateID = $RateID");
            } else {
                $conn->query("INSERT INTO rates SET Year = '$Year', Currency1 = '$Currency1', Currency2 = '$Currency2',Rate = '$Rate',Type = '$Type', Status='$Status', Note='$Note', CreateDate=CURRENT_TIMESTAMP");
            }
        }
    }

    public static function getDefinedRates($year = '', $current_currency = '')
    {

        global $conn;

        $cond = '';
        if (!empty($year))
            $cond .= " AND Year='$year'";
        else {
            $year = date('Y');
            $cond .= " AND Year='$year'";
        }
        if (empty($current_currency))
            $current_currency = $_SESSION['CURRENCY']['CURRENT'];

        $query = "SELECT Currency2 FROM rates WHERE Currency1='$current_currency' AND Year='$year' ORDER BY Currency2 ASC";
        $conn->query($query);

        $res[0] = $_SESSION['CURRENCY']['CURRENT'];

        while ($row = $conn->fetch_array()) {
            $res[] = $row['Currency2'];
        }
        return $res;
    }
}