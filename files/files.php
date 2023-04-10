<?php
date_default_timezone_set('Asia/Calcutta');
include '../database/connections.php';
include '../contacts/header.php';
session_start();

$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];
$count_query = "SELECT COUNT(*) FROM contacts WHERE is_deleted=0 AND user_id='$user_id'";
$result = mysqli_query($con, $count_query);
$row = mysqli_fetch_assoc($result);
$set = $row['COUNT(*)'];
?>

<html>

<head>
    <title>Users_list</title>
</head>

<body>
    <div class="header" id="myHeader">
        <h2>User Application</h2>
    </div>
    <div class="sidebar">
        <a href="contacts.php">Home</a>
        <a href="../contacts/contacts.php">Contacts
            <?php echo "<span class=badge>" . $set . "</span>" ?>
        </a>
        <a class="active" href="../files/files.php">Files</a>
        <a href="../departments/departments.php">Departments</a>
        <a href="../region/country_crud.php">Countries</a>
        <a href="../region/state_crud.php">States</a>
        <a href="../region/city_crud.php">Cities</a>
    </div>
    <div class="content"><br>
        <form action="uploadscript.php" style="width:30%" id="files" method="post" enctype="multipart/form-data">
            <input type="file" class="btn btn-primary btn-lg" name="the_file"><br>
            <input type="submit" class="btn btn-success" name="submit" value="Upload" />

        </form>
        <br>
        <table class="table-bordered" style="width:50%">
            <thead>
                <tr>
                    <th style="text-align:center"> File Name</th>
                    <th style="text-align:center"> Actions</th>

                </tr>
            </thead>

            <?php
            $file = "SELECT * FROM files";
            $result = mysqli_query($con, $file);
            while ($row = mysqli_fetch_assoc($result)) {


                $fileName = $row['file_name'];


                ?>
                <tr>
                    <td>
                        <?php echo $fileName ?>
                    </td>
                    <td>
                        <?php echo "<a href='upload_files/$fileName'>" . '<i class="fa fa-eye eye-icon btn-lg"></i>' . "</a>" ?></a>
                        <?php echo "<a href='upload_files/$fileName' download>" . '<i class="fa fa-download"></i>' . "</a>" ?></a>
                    </td>
                </tr>
                <?php
            } ?>

        </table>

    </div>
    <script>
        $(document).ready(function () {
            $('#files').submit(function (event) {
                event.preventDefault();
                var formdata = new FormData(this);
                $.ajax({
                    url: "uploadscript.php",
                    type: "POST",
                    data: formdata,
                    processData: false, //to prevent it from converting into query string
                    contentType: false, //to prevent from the default content type
                    success: function (data) {
                        swal.fire({
                            text: "Uploaded successfully",
                            icon: "success",
                        });
                        location.reload();
                    },
                });
            })
        });
    </script>
</body>

</html>