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
<title>Countries</title>

<head>
    <link rel="stylesheet" href="../assets/bootstrapmin.css" />
    <link rel="stylesheet" href="../assets/formbootstrap.css">
    <link rel="stylesheet" href="../assets/styles.css">
    <link rel="stylesheet" href="../assets/style_sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/sweetalert.js"></script>
    <script type="text/javascript" src="../assets/jquery.js"></script>
    <script type="text/javascript" src="../assets/bootstrapjs.js"></script>
    <script type="text/javascript" src="../assets/validations.js"></script>
</head>

<body>
    <div class="header" id="myHeader">
        <h2>User Application</h2>
    </div>
    <div class="sidebar" id="myHeader">
        <a href="../contacts/contacts.php">Home</a>
        <a href="../contacts/contacts.php">Contacts
            <?php echo "<span class=badge>" . $set . "</span>" ?>
        </a>
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

        <h1 class="page-header">Region</h1> <button class="btn btn-primary country_name" id="add_country"
            data-toggle="modal" data-target="#myModal">Add country</button>
        <div class="col col-sm-4 region_table">
            <!-- Country -->
            <div>
                <div class="col col-sm-4 region_table">

                    <table border="1" padding=15 class="table table-striped table-hover ">

                        <tr>
                            <th style="text-align: center;"> Country</th>
                            <th style="text-align: center;"> Actions</th>
                        </tr>
                        <?php
                        $sql = "SELECT * FROM countries WHERE is_deleted=0 ORDER BY id DESC ";
                        $result_country = mysqli_query($con, $sql);

                        while ($rows_country = mysqli_fetch_assoc($result_country)) {
                            ?>
                            <tr id="virtual-scroll-container">
                                <td class="item">
                                    <?php echo $rows_country['name'] ?>
                                </td>
                                <td>
                                    <a class="btn-lg eye-icon" onclick="view_region(<?php echo $rows_country['id'] ?>,1)"><i
                                            class="fa fa-eye" data-toggle="modal" data-target="#myModal"></i></a>
                                    <a class=" btn-lg edit_icon"
                                        onclick="edit_region(<?php echo $rows_country['id'] ?>,1)"><i class="fa fa-edit"
                                            data-toggle="modal" data-target="#myModal"></i></a>
                                    <a class="btn btn-lg delete-icon"
                                        onclick="check_region_Delete(<?php echo $rows_country['id'] ?>,1);"><i
                                            class="fa fa-trash"></i></a>

                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                </div>
                </table>
            </div>
        </div>

        <!-- Vitrual scroll -->
        <style type="text/css">
            #virtual-scroll-container {
                position: relative;
                height: 30px;
                overflow-y: scroll;
            }

            .item {
                height: 50px;
                padding: 10px;
                border-bottom: 1px solid #ccc;
            }
        </style>
        <script type="text/javascript">
         $(document).ready(function () {
                var container = $('#virtual-scroll-container');
                var items = container.find('.item'); 
                var itemHeight = items.outerHeight();
                container.scroll(function () {
                    var visibleItems = container.children(':visible').length;
                    if (visibleItems * itemHeight >= container.scrollTop() + container.outerHeight()) {
                        $.ajax({
                            url: 'load_more.php',
                            method: 'POST',
                            data: { last_id: items.last().text() },
                            success: function (data) {
                                container.append(data);
                                items = container.find('.item');
                            }

                        });
                    }

                });
            });
        </script>
</body>

</html>