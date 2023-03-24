<?php
include './database/connections.php';
session_start();
$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];
$count_query = "SELECT COUNT(*) FROM contact_information WHERE is_deleted=0 AND user_id='$user_id'";
$result = mysqli_query($con, $count_query);
$row = mysqli_fetch_assoc($result);
$set = $row['COUNT(*)'];

// echo $set;
?>
<html>
<title>Dashboards</title>

<head>

<body>
    <link rel="stylesheet" href="./assets/formbootstrap.css">
    <link rel="stylesheet" href="./assets/styles.css">

    </head>
    <button class="btn btn-success btn-lg" style="height:40px" ;>
        Welcome
        <?php echo "$username"; ?>!
    </button>
    <div class="container dashboard ">
        <div class="col-sm-6 " style="text-align:center">
            <a href="contacts/contacts.php" class="btn btn-lg btn-primary " style="padding:80">Contacts<div>
                    <?php echo $set ?>
                </div></a>
        </div>
        <div class="col-sm-6"> <a href="departments/departments.php" class="btn btn-lg btn-primary "
                style="padding:90">Departments</a></div>
</body>

</html>