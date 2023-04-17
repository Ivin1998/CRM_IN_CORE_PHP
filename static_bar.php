<?php
session_start();
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$todays_date=date('Y-m-d');
$count_query = "SELECT COUNT(*), DATE_FORMAT(created_date, 'Y-m-d') AS formatted_date 
FROM contacts WHERE DATE(created_date) = '$todays_date' AND is_deleted = 0 AND user_id = '$user_id'
GROUP BY DATE_FORMAT(created_date, 'Y-m-d');";
$result = mysqli_query($con, $count_query);
$row = mysqli_fetch_assoc($result);
$set = $row['COUNT(*)'];
?>
<html>
<body>
    <div class="header" id="myHeader">
        <h2>User Application</h2>
    </div>
    <div class="sidebar">
        <a href="../contacts/contacts.php">Home</a>
        <a class="contact" href="../contacts/contacts.php">Contacts
            <?php echo "<span class=badge>" . $set . "</span>" ?>
        </a>
        <a class="files" href="../files/files.php">Files</a>
        <a class="department" href="../departments/departments.php">Departments</a>
        <a class="countries" href="../region/country_crud.php">Countries</a>
        <a class="states" href="../region/state_crud.php">States</a>
        <a class="cities" href="../region/city_crud.php">Cities</a>
        <a class="logout" href="../contacts/logout.php" style="position: fixed; bottom: 0; left: 0;"><i
                class="fa fa-power-off" aria-hidden="true"></i></a>
    </div>
    <div class="row" style="padding-top: 15px;">
        <div class="col col-sm-6">
        </div>
        <div class="col col-sm-2"><button id="add_con" type="button" class="btn btn-primary btn-lg add_con_align "
                data-toggle="modal" data-target="#myModal" style="display:none">Add Contact</button></div>
        <div class="col col-sm-2"><button type="button" class="btn btn-primary btn-lg import add_con_align"
                data-toggle="modal" data-target="#myModal" style="display:none">Import Contact</button></div>
        <div class=" col col-sm-2">
            <button class="btn btn-primary rounded-circle" style="height:40px;margin: -70 70;" ;type="button"
                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa-solid">
                    <?php echo "$username[0]$username[1]"; ?>
                </i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                <button class="dropdown-item" href="#">My profile</button>
                <button class="dropdown-item" href="#">
                    <?php echo "<p class=intro> $username!</p>"; ?>
                </button>
                <a class="dropdown-item" href="../contacts/logout.php" style="text-decoration:none">Log out</a>
            </div>
        </div>
    </div>
    <body>
</html>