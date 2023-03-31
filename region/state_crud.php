<?php
include '../database/connections.php';
session_start();
$user_id = $_SESSION['user_id'];

$count_query = "SELECT COUNT(*) FROM contacts WHERE is_deleted=0 AND user_id='$user_id'";
$result = mysqli_query($con, $count_query);
$row = mysqli_fetch_assoc($result);
$set = $row['COUNT(*)'];
?>
<html>
<title>States</title>
<head>
    <link rel="stylesheet" href="../assets/formbootstrap.css">
    <link rel="stylesheet" href="../assets/styles.css">
    <link rel="stylesheet" href="../assets/style_sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />

   <script type="text/javascript" src="../assets/sweetalert.js"></script>
    <script type="text/javascript" src="../assets/jquery.js"></script>
   <script type="text/javascript" src="../assets/validations.js"></script> 
</head>
<div class="header" id="myHeader">
    <h2>User Application</h2>
</div>
<div class="sidebar" id="myHeader">
    <a href="../contacts/contacts.php">Home</a>
    <a href="../contacts/contacts.php">Contacts
        <?php echo "<span class=badge>" . $set . "</span>" ?>
    </a>
    <a href="../departments/departments.php">Departments</a>
    <a  href="../region/country_crud.php">Countries</a>
    <a class="active" href="../region/state_crud.php">States</a>
    <a  href="../region/city_crud.php">Cities</a>


</div>

<div class="content">
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
        </div>
    </div>

    <h1 class="page-header">Region</h1>
    <div class="col col-sm-4 region_table">
      
    <div>
        <div class="col col-sm-4 region_table">

            <table border="1" padding=15 class="table table-striped table-hover">

                <tr>
                    <th style="text-align: center;"> State</th>
                </tr>
                <?php
                $sql = "SELECT * FROM states WHERE is_deleted=0";
                $result_state = mysqli_query($con, $sql);

                while ($rows_state= mysqli_fetch_assoc($result_state)) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $rows_state['name'] ?>
                        </td>
                        <td>
                        <a class="btn-lg view_data eye-icon" id="<?php echo $rows['id']; ?>"><i
                                    class="fa fa-eye"></i></a>
                        <a class=" btn-lg edit_icon edit_data" id="<?php echo $rows['id']; ?>"><i
                                    class="fa fa-edit"></i></a>
                        <a class=" btn-lg delete-icon" onclick="check_country_Delete(<?php echo $rows_state['id'] ?>,2);"><i
                                    class="fa fa-trash"></i></a>
                                    
                        </td>
                    </tr>
                    <?php
                }
                ?>

            </table>
        </div>
    </div> 
</div>

</html>