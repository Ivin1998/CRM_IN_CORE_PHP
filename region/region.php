<?php
include '../database/connections.php';
session_start();
$user_id = $_SESSION['user_id'];

$count_query = "SELECT COUNT(*) FROM contact_information WHERE is_deleted=0 AND user_id='$user_id'";
$result = mysqli_query($con, $count_query);
$row = mysqli_fetch_assoc($result);
$set = $row['COUNT(*)'];
?>
<html>
<title>Regions</title>

<head>
    <link rel="stylesheet" href="../assets/formbootstrap.css">
    <link rel="stylesheet" href="../assets/styles.css">
    <link rel="stylesheet" href="../assets/style_sidebar.css">
    <script type="text/javascript" src="../assets/sweetalert.js"></script>
    <script type="text/javascript" src="../assets/jquery.js"></script>
    <script type="text/javascript" src="../assets/bootstrapjs.js"></script>
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
    <a class="active" href="../region/region.php">Regions</a>
</div>

<div class="content">
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div style="padding: 15px 15px 0px 15px">
                    <div class="row">
                        <div class="col col-sm-6" id="modal-title">
                            <h4>Add city</h4>
                        </div>
                        <div class="col col-sm-6">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div id="myForm">
                        <form id="mycontact">
                            <input type="text" name="city" class="form-control" /><br>
                            <input type="hidden" id="flag_value" name="flag" />
                            <button type="button" id="add_region" class="btn btn-primary"
                                class="form-control">Add</button>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="reload" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- City -->

    <h1 class="page-header">Region</h1>


    <div class="col col-sm-4">
        <button class="btn btn-primary region_style" data-toggle="modal" data-target="#myModal" id="add_city"
            onclick="add_region(1)">Add City</button>

        <table border="1" padding=15 class="table table-striped table-hover region_table">


            <tr>
                <th style="text-align: center;"> City</th>
            </tr>

            <?php
            $sql = "SELECT region FROM region WHERE flag_value=1";
            $result_city = mysqli_query($con, $sql);

            while ($rows = mysqli_fetch_assoc($result_city)) {
                ?>
                <tr>
                    <td>
                        <?php echo $rows['region'] ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>


    <!-- State -->
    <div>

        <div class="col col-sm-4 ">

            <button class="btn btn-primary region_style" data-toggle="modal" id="add_state" data-target="#myModal"
                onclick="add_region(2)">Add State</button>
            <table border="1" padding=15 class="table table-striped table-hover region_table">

                <tr>
                    <th style="text-align: center;"> State</th>
                </tr>
                <?php
                $sql = "SELECT region FROM region WHERE flag_value=2";
                $result_city = mysqli_query($con, $sql);

                while ($rows = mysqli_fetch_assoc($result_city)) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $rows['region'] ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>

            </table>
        </div>
    </div>
    <!-- Country -->
    <div>
        <div class="col col-sm-4">
            <button class="btn btn-primary region_style" id="add_country" data-toggle="modal" data-target="#myModal"
                onclick="add_region(3)">Add Country</button>

            <table border="1" padding=15 class="table table-striped table-hover region_table">

                <tr>
                    <th style="text-align: center;"> Country</th>
                </tr>
                <?php
                $sql = "SELECT region FROM region WHERE flag_value=3";
                $result_city = mysqli_query($con, $sql);

                while ($rows = mysqli_fetch_assoc($result_city)) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $rows['region'] ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
        </div>
        </table>
    </div>
</div>

</html>