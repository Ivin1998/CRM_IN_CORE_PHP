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
<title>Countries</title>

<body>
    <div class="header" id="myHeader">
        <h2>User Application</h2>
    </div>
    <div class="sidebar" id="myHeader">
        <a href="../contacts/contacts.php">Home</a>
        <a href="../contacts/contacts.php">Contacts
            <?php echo "<span class=badge>" . $set . "</span>" ?>
        </a>
        <a href="../files/files.php">Files</a>
        <a href="../departments/departments.php">Departments</a>
        <a class="active" href="../region/country_crud.php">Countries</a>
        <a href="../region/state_crud.php">States</a>
        <a href="../region/city_crud.php">Cities</a>
    </div>


    <div class="content">
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="col col-sm-4" id="modal-title">
                        <h5>Edit Country</h5>
                    </div>
                    <div class="modal-body">
                        <form id="country_name" method="post">
                            Country Name: <input type="text" id="name" name="name" class="form-control" /><br><br>
                            <input type="hidden" name="id" id="id" />
                            <button id="update_button" class="btn btn-primary form-control" type="button"
                                onclick="update_region(1)">Update</button>
                            <button id="add_button" class="btn btn-primary form-control" onclick="add_region(1)"
                                type="button">Add</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" id="reload" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <h1 class="page-header">Countries</h1> 
        <div class="region_table ">
        <button class="btn btn-primary country_name" id="add_country"
            data-toggle="modal" data-target="#myModal" style="margin: 10 10 5 700;">Add country</button>
            <!-- Country -->
            <div>
                <div class="region_table ">

                    <table border="1" class="table table-striped table-hover">
                        <thead>

                            <th style="text-align: left;"> Name</th>
                            <th style="text-align: left;"> Actions</th>
                        </thead>
                        <tbody class="postList">
                            <?php
                            $sql = "SELECT * FROM countries WHERE is_deleted=0 ORDER BY id DESC LIMIT 8";
                            $result_country = mysqli_query($con, $sql);
                            while ($rows_country = mysqli_fetch_assoc($result_country)) {
                                $postID = $rows_country['id'];
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $rows_country['name'] ?>
                                    </td>

                                    <td>
                                        <a  title="view states of this country"class="btn-lg eye-icon"
                                            onclick="view_region(<?php echo $rows_country['id'] ?>,1)"><i class="fa fa-eye"
                                                data-toggle="modal" data-target="#myModal"></i></a>
                                        <a title="edit the country name"class=" btn-lg edit_icon"
                                            onclick="edit_region(<?php echo $rows_country['id'] ?>,1)"><i class="fa fa-edit"
                                                data-toggle="modal" data-target="#myModal"></i></a>
                                        <a title="delete this country" class="btn btn-lg delete-icon"
                                            onclick="check_region_Delete(<?php echo $rows_country['id'] ?>,1);"><i
                                                class="fa fa-trash"></i></a>

                                    </td>
                                </tr>
                                <?php
                                $last_id = $rows_country['id'];
                            }
                            ?>
                        </tbody>
                    </table>
                    <input type="hidden" id="last_id" class="last_id" value="<?php echo $last_id; ?>" />
                    <script>

                        $(window).scroll(function () {
                            var lastPostID = $('#last_id').val();
                            if ($(window).scrollTop() == $(document).height() - $(window).height()) {
                                $.ajax({
                                    type: 'POST',
                                    url: 'load_more_countries.php',
                                    dataType: 'json',
                                    data: { id: lastPostID },
                                    success: function (data) {
                                        $('.postList').append(data.html);
                                        $('#last_id').val(data.lastid);
                                    }
                                });
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>

</body>

</html>