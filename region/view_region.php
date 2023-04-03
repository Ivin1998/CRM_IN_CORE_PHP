<?php
include '../database/connections.php';
if($_POST['type']==1){

    if (isset($_POST['id'])) {
        $output = '';
        $query = "SELECT * FROM contacts.countries a inner join contacts.states b on b.country_id= a.id WHERE b.country_id='" . $_POST["id"] . "'";
        $result = mysqli_query($con, $query);
        $output .= '
        <div class="table-responsive">  
        <table class="table table-bordered">';
        while ($row = mysqli_fetch_array($result)) {
            $output .= '
            <tr>  
            <td width="70%">' . $row["name"] . '</td> ';
        }
        $output .= '
        </table>
        </div>
        ';
        echo $output;
    }
};

if($_POST['type']==2){
    if(isset($_POST['id'])){
        $output = '';
        $query = "SELECT * FROM contacts.states a inner join contacts.cities b on a.id= b.state_id WHERE b.state_id='" . $_POST["id"] . "'";
        $result = mysqli_query($con, $query);
        $output .= '
        <div class="table-responsive">  
        <table class="table table-bordered">
        <td width="30%"><label>Cities in this state</label></td> ';
        while ($row = mysqli_fetch_array($result)) {
            $output .= '
            <tr>  
            <td width="70%">' . $row["name"] . '</td> ';
        }
        $output .= '
        </table>
        </div>
        ';
        echo $output;
    }
}

?>