<?php
ini_set('display_errors', '0');

class DB
{

    // {{{
    /**
     * data members
     */
    var $obj = array("sql_db" => "",
        "sql_user" => "",
        "sql_pass" => "",
        "sql_host" => "",
        "sql_port" => "
        ",
        "persistent" => "0",
    );

    var $query_id = "";
    var $connection_id = "";
    var $error = "";
    var $errno = 0;
    var $reporterror = 1;
    var $record_row = array();
    var $external_data = array('_AcceptedErrors_' => array(1062 => 1062));
    // }}}

    // {{{ DB()
    /**
     * constructor
     * sets data members
     */
    function __construct($host, $user, $pass, $dbname)
    {
        $this->obj['sql_host'] = $host;
        $this->obj['sql_user'] = $user;
        $this->obj['sql_pass'] = $pass;
        $this->obj['sql_db'] = $dbname;
        $this->connect();
    }
    // }}}

    // {{{ connect()
    /**
     * connection to mysql server
     */
    function connect()
    {
        $this->connection_id = mysqli_connect($this->obj['sql_host'], $this->obj['sql_user'], $this->obj['sql_pass']);
        //print_r($this->obj['sql_host']);
        if (!$this->connection_id) $this->errorHandle("Database connection error!");
        if (!mysqli_select_db($this->connection_id, $this->obj['sql_db'])) {
            $this->errorHandle("Database connection error!");
        }


        //die();
        /*$j = 1;
        for ($i = 1; $i <= 9999999999999999999; $i++) {
             $j = $j + $j;
        }/**/
    }
    // }}}

    // {{{ query()

    /**
     * handling errors
     */
    function errorHandle($msg)
    {
        if ($this->reporterror == 1) {
            $this->setError();
            $this->setErrno();
            // errors accepted
            if (isset($this->external_data['_AcceptedErrors_'][$this->errno])) return;
            $message = "{$msg}\n{$this->error}\nUrl: {$_SERVER['REQUEST_URI']}\nIP: {$_SERVER['REMOTE_ADDR']}";
            // TO DO
            throw new Exception(nl2br($message));
        }
    }
    // }}}

    // {{{ fetch_array()

    function setError()
    {
        $this->error = mysqli_error($this->connection_id);
    }
    // }}}

    // {{{ get_affected_rows()

    function setErrno()
    {
        $this->errno = mysqli_errno($this->connection_id);
    }
    // }}}

    // {{{ get_num_rows()

    /**
     * query processing
     */
    function query($query, $params = [])
    {
        if (defined('DEBUG') && DEBUG == 1) {
            $_SESSION['q'][] = $query;
        }
        if (!empty($params)) {
            $stmt = mysqli_prepare($this->connection_id, $query);

            mysqli_stmt_bind_param($stmt, "s", $params);

            $this->query_id = mysqli_stmt_execute($stmt);
        } else {
            $this->query_id = mysqli_query($this->connection_id, $query);
        }

        if (!$this->query_id) {
            $this->errorHandle("Query error : $query");
            return 0;
        }
        return $this->query_id;
    }
    // }}}

    // {{{ real_escape_string()

    function fetch_array($query_id = "")
    {
        if ($query_id == "") {
            $query_id = $this->query_id;
        }
        $this->record_row = mysqli_fetch_array($query_id, MYSQLI_ASSOC);
        return $this->record_row;
    }
    // }}}

    // {{{ get_insert_id()    

    function get_affected_rows()
    {
        return mysqli_affected_rows($this->connection_id);
    }
    // }}}

    // {{{ free_result()

    function get_num_rows($query_id = "")
    {
        if ($query_id == "") {
            $query_id = $this->query_id;
        }
        return mysqli_num_rows($query_id);
    }
    // }}}

    // {{{ disconnect()

    function real_escape_string($string)
    {
        return mysqli_real_escape_string($this->connection_id, $string);
    }
    // }}}

    // {{{ errorHandle()

    function get_insert_id()
    {
        return mysqli_insert_id($this->connection_id);
    }
    // }}}

    // {{{ setError()

    function free_result($query_id = "")
    {
        if ($query_id == "") {
            $query_id = $this->query_id;
        }
        @mysql_free_result($query_id);
    }
    // }}}

    // {{{ setErrno()

    /**
     * disconnect from mysql server
     */
    function disconnect()
    {
        return @mysql_close($this->connection_id);
    }
    // }}}

    // {{{ getExternalData()

    function getExternalData($external_data = array())
    {
        $this->external_data = $external_data;
    }
    // }}}
}

?>
