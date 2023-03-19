<?php
include 'connections.php';
session_start();
$user_id = $_SESSION['user_id'];

$sql = "SELECT COUNT(*) FROM contact_information WHERE is_deleted=0 AND user_id='$user_id'AND ";

$conditions = [
    "department_one" => "department_id=10",
    "department_two" => "department_id=12",
    "department_three" => "department_id=14",
    "department_four" => "department_id=16",
];
$result1 = mysqli_query($con, $sql . $conditions["department_one"]);
$row1 = mysqli_fetch_assoc($result1);
$result2 = mysqli_query($con, $sql . $conditions["department_two"]);
$row2 = mysqli_fetch_assoc($result2);
$result3 = mysqli_query($con, $sql . $conditions["department_three"]);
$row3 = mysqli_fetch_assoc($result3);
$result4 = mysqli_query($con, $sql . $conditions["department_four"]);
$row4 = mysqli_fetch_assoc($result4);
?>
<html>

<head>
    <link rel="stylesheet" href="./assets/formbootstrap.css">
    <link rel="stylesheet" href="./assets/styles.css">
</head>

<body>
    <table border="1" padding = 15 class="table table-striped table-hover" style="width:50%">
        <thead>
            <h1 class="page-header">Department List</h1>
            <tr>
                <th style="text-align: center;">Department Name</th>
                <th style="text-align: center;">No. of contacts</th>
            </tr>
        </thead>
        <tr>
            <td>Technology Services</td>
            <td>
               <a href="contacts.php"><?php echo $row1['COUNT(*)']; ?></a>
            </td>
        </tr>
        <tr>
            <td>FI Research</td>
            <td>
            <a href="contacts.php"> <?php echo $row2['COUNT(*)']; ?></a>
            </td>
        </tr>
        <tr>
            <td>Medical Imaging</td>
            <td>
            <a href="contacts.php">  <?php echo $row3['COUNT(*)']; ?></a>
            </td>
        </tr>
        <tr>
            <td>CS Research</td>
            <td>
            <a href="contacts.php"><?php echo $row4['COUNT(*)']; ?></a>
            </td>
        </tr>
    </table>
</body>

</html>