<?phpclass Alert extends ConfigData{    public static function logAlert($AlertID, $PersonID = 0, $EmailedPersonID, $isRead = 0, $Email = "", $Subject = "", $Message = "")    {        @$conn = new DB(Config::MYSQL_HOST, Config::MYSQL_USER, Config::MYSQL_PASS, Config::MYSQL_DBNAME);        $conn->query("INSERT INTO alert_log (AlertID, PersonID, EmailedPersonID, isRead, Email, Subject, Message, CreateDate)                                     VALUES('$AlertID', '$PersonID', '$EmailedPersonID', '$isRead', '$Email', '$Subject', '" . $conn->real_escape_string($Message) . "', CURRENT_TIMESTAMP)");    }    public static function getPersonAlerts($PersonID)    {        global $conn;        $conn->query("SELECT a.*                       FROM   alert_log a                              INNER JOIN alert b ON a.AlertID = b.ID AND b.Dashboard = 1    		      WHERE  a.PersonID = '$PersonID' OR   			     a.EmailedPersonID = '$PersonID' OR                              a.Email=(SELECT Email FROM persons WHERE PersonID='$PersonID') OR                             {$_SESSION['USER_ID']} = 1	                      ORDER BY a.CreateDate DESC");        while ($row = $conn->fetch_array()) {            $alerts[$row['ID']] = $row;        }        return $alerts;    }}?>