<?php
include 'model.php';
session_start();

class extract extends database
{
    public function fetch_data()
    {
        $user_id = $_SESSION['user_id'];  //for getting the user_id from session

        if (isset($_GET["department_id"])) {
            $department_id = $_GET['department_id'];     //for getting the department-id from the url
        } else {
            $department_id = '';
        }

        if ($department_id) {
            $sql = "SELECT * FROM contacts a inner join department b on a.department_id=b.department_id inner join countries d on a.country_id=d.id WHERE a.is_deleted=0 AND a.user_id='$user_id' AND  a.department_id='$department_id' ORDER BY id DESC";
            $result = mysqli_query($this->con, $sql);
        } else {
            $sql = "SELECT * FROM contacts a inner join department b on a.department_id=b.department_id inner join countries d on a.country_id=d.id WHERE a.is_deleted=0 AND a.user_id='$user_id' ORDER BY a.id DESC";
            $result = mysqli_query($this->con, $sql);
        }
        while ($rows = mysqli_fetch_assoc($result)) {
            $array[] = $rows;
        }
        return $array;
    }
}

?>