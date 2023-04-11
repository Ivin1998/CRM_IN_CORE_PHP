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
        <form style="width:30%" method="post"  id="myInput_upload" style="text-decoration: none;" enctype="multipart/form-data">
            <input type="file" name="the_file"><br>
            <input type="submit" name="submit" id="submit" value="Upload" /> <br>
            <input type="hidden" name="created_date" value="<?php echo date('Y-m-d H:i:s') ?>" />
        </form>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Preview</h5>
                        <div class="col col-sm-12">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                    </div>
                    <div class="modal-body">
                        <img id="previewImage" src="" alt="" style=" max-width: 100%" ;>

                    </div>
                </div>
            </div>
        </div>
        <br>
        <table class="table-bordered" style="width:50%">
            <thead>
                <tr>
                    <th style="text-align:center"> Sl.no.</th>
                    <th style="text-align:center"> File Name</th>
                    <th style="text-align:center"> Actions</th>

                </tr>
            </thead>
            <?php
            $file = "SELECT * FROM files";
            $result = mysqli_query($con, $file);
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                $fileName = $row['file_name'];
                ?>
                <tr>
                    <td>
                        <?php echo $no++; ?>
                    </td>
                    <td>
                        <?php echo "<a href='upload_files/$fileName'>" . $fileName . "</a>" ?>
                    </td>
                    <td>
                        <?php echo "<a href='#' data-toggle='modal' data-target='#myModal' data-file='upload_files/$fileName'>" . '<i class="fa fa-eye eye-icon btn-lg"></i>' . "</a>" ?>
                        <?php echo "<a href='upload_files/$fileName' download>" . '<i class="fa fa-download"></i>' . "</a>" ?></a>
                    </td>
                </tr>
                <?php
            } ?>

        </table>

    </div>
    <script>
        $(document).ready(function () {
            $('#submit').click(function (event) {
                event.preventDefault();
                var formdata = new FormData(document.getElementById('myInput_upload'));
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
            });
            $('#myModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var filePath = button.data('file');
              
                var image = $('#previewImage');
                image.attr('src', filePath);
            });

        });
    </script>


</body>

</html>