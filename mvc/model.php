<?php

class database
{
    protected $host;
    protected $username;
    protected $password;
    protected $dbname;
    protected $con;
    public function __construct($host, $username, $password, $dbname)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
        $this->con = mysqli_connect($host, $username, $password, $dbname);
    }
    public function getconnection()
    {
        return $this->con;
    }
    public function __destruct()
    {
        mysqli_close($this->con);
    }
}
$db = new database("localhost", "root", "CsAdmin12#$", "contacts");
$con = $db->getConnection();
?>