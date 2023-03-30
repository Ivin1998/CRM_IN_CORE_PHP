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
<title>Regions</title>
<head>
    <link rel="stylesheet" href="../assets/formbootstrap.css">
    <link rel="stylesheet" href="../assets/styles.css">
    <link rel="stylesheet" href="../assets/style_sidebar.css">
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
    <a class="active" href="../region/region.php">Regions</a>
</div>

<div class="content">
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
        </div>
    </div>

    <!-- City -->

    <h1 class="page-header">Region</h1>
    <div class="col col-sm-4">
      

        <table border="1" padding=15 class="table table-striped table-hover region_table">


            <tr>
                <th style="text-align: center;"> City</th>
            </tr>

            <?php
            $sql = "SELECT name FROM cities";
            $result_city = mysqli_query($con, $sql);

            while ($rows = mysqli_fetch_assoc($result_city)) {
                ?>
                <tr>
                    <td>
                        <?php echo $rows['name'] ?>
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

            <table border="1" padding=15 class="table table-striped table-hover region_table">

                <tr>
                    <th style="text-align: center;"> State</th>
                </tr>
                <?php
                $sql = "SELECT name FROM states";
                $result_city = mysqli_query($con, $sql);

                while ($rows = mysqli_fetch_assoc($result_city)) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $rows['name'] ?>
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

            <table border="1" padding=15 class="table table-striped table-hover region_table">

                <tr>
                    <th style="text-align: center;"> Country</th>
                </tr>
                <?php
                $sql = "SELECT name FROM countries";
                $result_city = mysqli_query($con, $sql);

                while ($rows = mysqli_fetch_assoc($result_city)) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $rows['name'] ?>
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