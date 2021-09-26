<?php

class CandidateExternal extends ConfigData
{

    public static $msResPerPage = 20;
    private $CandidateID;

    public function __construct($CandidateID = 0)
    {
        if ($CandidateID > 0) {
            $this->CandidateID = $CandidateID;
        }
    }

    public static function getAllCities()
    {

        global $conn;

        $conn->query("SELECT * 
                      FROM   candidate_city 
                      ORDER  BY CityName");
        $cities = array();

        while ($row = $conn->fetch_array()) {
            $cities[$row['CityId']] = $row['CityName'];
        }
        return $cities;
    }

    public static function getAllPostTypes()
    {

        global $conn;

        $conn->query("SELECT * 
                      FROM   candidate_posttype 
                      ORDER  BY PostTypeName");
        $ptype = array();

        while ($row = $conn->fetch_array()) {
            $ptype[$row['PostTypeId']] = $row['PostTypeName'];
        }
        return $ptype;
    }

    public static function getAllPosts()
    {

        global $conn;

        $conn->query("SELECT *
                      FROM   candidate_post
                      ORDER  BY PostName");
        $posts = array();

        while ($row = $conn->fetch_array()) {
            $posts[$row['PostId']] = $row['PostName'];
        }
        return $posts;
    }

    public static function getWorkExperience($CandidateID)
    {

        global $conn;

        $conn->query("SELECT * 
                      FROM   candidate_workexperience
                      WHERE  CvId=$CandidateID
                      ORDER  BY WorkExperienceId DESC");
        $wexp = array();

        while ($row = $conn->fetch_array()) {
            $wexp[$row['WorkExperienceId']] = $row;
        }
        return $wexp;
    }

    public static function getLanguageRead($CandidateID)
    {

        global $conn;

        $conn->query("SELECT * 
                      FROM   candidate_foreignlanguage f, candidate_language l, candidate_languagelevel ll
                      WHERE f.LanguageId=l.LanguageId
                      AND ll.LanguageLevelId=f.ReadLevelId
                      AND  CvId=$CandidateID
                      ORDER  BY ForeignLanguageId DESC");
        $lang = array();

        while ($row = $conn->fetch_array()) {
            $lang[$row['ForeignLanguageId']] = $row;
        }
        return $lang;
    }

    public static function getLanguageWrite($CandidateID)
    {

        global $conn;

        $conn->query("SELECT * 
                      FROM   candidate_foreignlanguage f, candidate_language l, candidate_languagelevel ll
                      WHERE f.LanguageId=l.LanguageId
                      AND  CvId=$CandidateID
                      ORDER  BY ForeignLanguageId DESC");
        $lang = array();

        while ($row = $conn->fetch_array()) {
            $lang[$row['ForeignLanguageId']] = $row;
        }
        return $lang;
    }

    public static function getLanguageSpeak($CandidateID)
    {

        global $conn;

        $conn->query("SELECT * 
                      FROM   candidate_foreignlanguage f, candidate_language l, candidate_languagelevel ll
                      WHERE f.LanguageId=l.LanguageId
                      AND ll.LanguageLevelId=f.SpeakLevelId
                      AND  CvId=$CandidateID
                      ORDER  BY ForeignLanguageId DESC");
        $lang = array();

        while ($row = $conn->fetch_array()) {
            $lang[$row['ForeignLanguageId']] = $row;
        }
        return $lang;
    }

    public static function getAddresses($CandidateID)
    {

        global $conn;

        $conn->query("SELECT * 
                      FROM   candidate_address a
                      LEFT JOIN candidate_city c ON a.CityId=c.CityId
                      WHERE CvId=$CandidateID
                      ORDER  BY AddressId ASC");
        $addr = array();

        while ($row = $conn->fetch_array()) {
            $addr[$row['AddressId']] = $row;
        }
        return $addr;
    }

    public static function getEducation($CandidateID)
    {

        global $conn;

        $conn->query("SELECT * 
                      FROM   candidate_education
                      WHERE  CvId=$CandidateID
                      ORDER  BY EducationId DESC");
        $edu = array();

        while ($row = $conn->fetch_array()) {
            $edu[$row['EducationId']] = $row;
        }
        return $edu;
    }

    public static function getAllCandidates($action = '')
    {

        global $conn;

        $cond = '';

        if (!empty($_GET['search_for']) && $_GET['keyword'] != '') {
            switch ($_GET['search_for']) {

                case 'FullName':
                    $cond .= " AND (LOWER(c.FirstName) LIKE '%" . strtolower($_GET['keyword']) . "%' OR LOWER(c.LastName) LIKE '%" . strtolower($_GET['keyword']) . "%')";
                    break;
                case 'Email':
                    $cond .= " AND c.Email LIKE '%{$_GET['keyword']}%'";
                    break;
                case 'default':
                    $cond .= " AND (LOWER(c.FirstName) LIKE '%" . strtolower($_GET['keyword']) . "%' OR LOWER(c.LastName) LIKE '%" . strtolower($_GET['keyword']) . "%')";
                    break;
            }
        }

        if (!empty($_GET['CityId'])) {
            $cond .= " AND a.CityId = " . (int)$_GET['CityId'];
        }
        if (!empty($_GET['PostTypeId'])) {
            $cond .= " AND c.SourceId = " . (int)$_GET['PostTypeId'];
        }
        if (!empty($_GET['PostId'])) {
            $cond .= " AND p.PostId = " . (int)$_GET['PostId'];
        }

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        $query = "SELECT COUNT(*) AS total
	  			FROM
					candidate_cv c
					INNER JOIN candidate_post p ON c.PostId=p.PostId

					INNER JOIN candidate_address a ON c.CvId=a.CvId

					LEFT JOIN candidate_posttype t on t.PostTypeId=c.SourceId
	            WHERE  1=1 $cond ";
        /*    INNER JOIN candidate_posttype t ON p.PostTypeId=t.PostTypeId   **to de added if necessary */
        $conn->query($query);
        $row = $conn->fetch_array();

        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $jobs = array();
        $jobs[0]['pageNo'] = $pageNo;
        $jobs[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) && in_array($_GET['order_by'], array('c.FirstName', 'PostName', 'Email', 'Phone', 'Mobile', 'PostTypeName',)) ? $_GET['order_by'] : 'c.CvId';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'desc';

        $query = "SELECT c.CvId,c.LastName,c.FirstName,p.PostName,c.Email,c.Phone,c.Mobile,pers.ImportStatus
	  			FROM
					candidate_cv c
					INNER JOIN candidate_post p ON c.PostId=p.PostId

					LEFT JOIN candidate_address a ON a.CvId=c.CvId
					LEFT JOIN candidates_internal pers ON MD5(CONCAT_WS(' ',c.FirstName,c.LastName,BirthDate))=pers.ImportCode
	            WHERE  1=1 $cond
	            ORDER  BY $order_by $asc_or_desc ,c.CvId DESC " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        /*    INNER JOIN candidate_posttype t ON p.PostTypeId=t.PostTypeId   **to de added if necessary */
        $conn->query($query);
        //print_r($query);
        while ($row = $conn->fetch_array()) {
            $jobs[$row['CvId']] = $row;
        }
        //Utils::_debug($jobs, $jobs, $_GET);
        return $jobs;
    }

    public function getCandidate()
    {

        global $conn;

        $query = "SELECT c.*,p.*,t.*,m.*, ci.ImportStatus
	  			FROM
					candidate_cv c 
					LEFT JOIN candidate_post p ON p.PostId=c.PostId
					LEFT JOIN candidate_posttype t ON t.PostTypeId=c.SourceId
					LEFT JOIN candidate_maritalstatus m ON m.MaritalStatusId=c.MaritalStatusId
					LEFT JOIN candidates_internal ci on ci.ImportCode=MD5(CONCAT_WS(' ',c.FirstName,c.LastName,BirthDate))
	            WHERE  c.PostId<>0 
	            AND c.CvId={$this->CandidateID}";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }
    }
}

?>