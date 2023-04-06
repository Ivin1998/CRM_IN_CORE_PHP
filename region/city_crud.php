<?php
include '../database/connections.php';
include '../contacts/header.php';

session_start();
$user_id = $_SESSION['user_id'];

$count_query = "SELECT COUNT(*) FROM contacts WHERE is_deleted=0 AND user_id='$user_id'";
$result = mysqli_query($con, $count_query);
$row = mysqli_fetch_assoc($result);
$set = $row['COUNT(*)'];
?>
<html>
<title>Cities</title>
<div class="header" id="myHeader">
    <h2>User Application</h2>
</div>
<div class="sidebar" id="myHeader">
    <a href="../contacts/contacts.php">Home</a>
    <a href="../contacts/contacts.php">Contacts
        <?php echo "<span class=badge>" . $set . "</span>" ?>
    </a>
    <a href="../departments/departments.php">Departments</a>
    <a href="../region/country_crud.php">Countries</a>
    <a href="../region/state_crud.php">States</a>
    <a class="active" href="../region/city_crud.php">Cities</a>

</div>

<div class="content">
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="col col-sm-4" id="modal-title">
                    <h5>Edit City</h5>
                </div>
                <div class="modal-body">
                    <form id="country_name">
                        City Name: <input type="text" id="name" name="name" class="form-control" /><br><br>
                        <input type="hidden" name="id" id="id" />
                        <button id="add_button" class="btn btn-primary form-control" onclick="add_region(3)"
                            type="button">Add</button>
                        <button id="update_button" class="btn btn-primary form-control" type="button"
                            onclick="update_region(3)">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- City -->
    <h1 class="page-header">Region</h1> <button class="btn btn-primary city_name" id="add_city" data-toggle="modal"
        data-target="#myModal">Add city</button>
    <div class="col col-sm-4 region_table">
        <div>

            <div class="col col-sm-4 region_table">

                <table border="1" padding=15 class="table table-striped table-hover">


                    <tr>
                        <th style="text-align: center;"> City</th>
                        <th style="text-align: center;"> Actions</th>
                    </tr>

                    <?php
                    $sql = "SELECT * FROM cities WHERE is_deleted=0 ORDER BY id DESC";
                    $result_city = mysqli_query($con, $sql);

                    while ($rows_city = mysqli_fetch_assoc($result_city)) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $rows_city['name'] ?>
                            </td>
                            <td>
                                <a class=" btn-lg edit_icon " onclick="edit_region(<?php echo $rows_city['id'] ?>,3);" ?><i
                                        class="fa fa-edit" data-toggle="modal" data-target="#myModal"></i></a>
                                <a class="btn btn-lg delete-icon"
                                    onclick="check_region_Delete(<?php echo $rows_city['id'] ?>,3);"><i
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
</div>

</html>