<?php
date_default_timezone_set('Asia/Calcutta');
include 'connections.php';
session_start();
$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];
?>


<html>
<head>
<body>
    <title>Users_list</title>
    <link rel="stylesheet" href="./assets/bootstrapmin.css" />
    <link rel="stylesheet" href="./assets/formbootstrap.css">
    <link rel="stylesheet" href="./assets/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
    <script type="text/javascript" src="./assets/sweetalert.js"></script>
    <script type="text/javascript" src="./assets/jquery.js"></script>
    <script type="text/javascript" src="./assets/bootstrapjs.js"></script>
    <script type="text/javascript" src="./assets/datatable1.js"></script>
    <script type="text/javascript" src="./assets/datatable2.js"></script>
    <script type="text/javascript" src="./assets/datatable3.js"></script>
    <script type="text/javascript" src="./assets/datatable4.js"></script>
    <script type="text/javascript" src="./assets/datatable5.js"></script>
    <script type="text/javascript" src="./assets/datatable6.js"></script>
    <script type="text/javascript" src="./assets/datatable7.js"></script>
    </head>
    <div class="row" style="padding-top: 15px;">
        <div class="col col-sm-8 ">
        </div>
        <div class="col col-sm-2"><button id="add_con" type="button" class="btn btn-info btn-lg" data-toggle="modal"
                data-target="#myModal">Add Contact</button></div>
        <div class=" col col-sm-2 dropdown">
            <button class="btn btn-primary rounded-circle" style="height:40px";"type="button" id="dropdownMenuButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fa-solid">
                    <?php echo "$username[0]$username[1]"; ?>
                </i>

            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <button class="dropdown-item" href="#">My profile</button>
                <button class="dropdown-item" href="#">
                    <?php echo "<p class=intro> $username!</p>"; ?>
                </button>
                <a class="dropdown-item" href="logout.php" style="text-decoration:none">Log out</a>
            </div>
        </div>
    </div>




    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div style="padding: 15px 15px 0px 15px">
                    <div class="row">
                        <div class="col col-sm-6">
                        <h4>Add Contact</h4>
                        </div>
                        <div class="col col-sm-6">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                    </div>
                <!-- 
                 -->
                </div>
                <div class="modal-body">
                    <div id="myForm">
                        <form name="contact" method="post" action="import.php" id="mycontact"
                            enctype="multipart/form-data">
                            <label>Select CSV File:</label>
                            <input type="file" name="csv_file" id><br>
                            <input type="submit" name="submit" id="submit" value="Import">
                            <md style="color:red;display:flex;gap:5px;"><span style="color:black">First Name:</span>*
                            </md><input type="text" name="firstName" id="firstName" /><br><br>
                            <md style="color:red;display:flex;gap:5px;" /><span style="color:black">Last Name:</span>*
                            </md> <input type="text" name="lastName" id="lastName" /><br><br>
                            <md style="color:red;display:flex;gap:5px;"> <span style="color:black">
                                    Mobile Number:</span>*</md> <input type="text" name="mobileNumber"
                                id="mobileNumber" /><br><br>
                            Office Number: <input type="text" name="officeNumber" id="officeNumber" /><br><br>
                            Email Address: <input type="text" name="Email" id="Email" /><br><br>
                            Instagram Profile: <input type="text" name="Instagram" id="Instagram" /><br><br>
                            Twitter Handle: <input type="text" name="Twitter" id="Twitter" /><br><br>
                            Linkedin Id: <input type="text" name="Linkedin" id="Linkedin" /><br><br>
                            Facebook Id: <input type="text" name="Facebook" id="Facebook" /><br><br>
                            <input type="hidden" name="id" id="id" />
                            <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id ?>">
                            <input type="hidden" name="created_date" value="<?php echo date('Y-m-d H:i:s') ?>" />
                            <input type="hidden" name="mod_date" value='<?php echo date('Y-m-d H:i:s') ?>' />
                            <button type="button" onclick="savecontact()" id="Add" class="btn btn-primary">Add</button>
                            <button id="update-btn" class="btn btn-primary" type="button">Update</button>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="reload" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <?php
    $sql = "SELECT * FROM contact_information WHERE is_deleted=0 AND user_id='$user_id' ORDER BY id DESC";
    $result = mysqli_query($con, $sql); ?>
    <div>
        <table id="mytable" border="2" class="table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Sl.no.</th>
                    <th>User Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Mobile Number</th>
                    <!-- <th>Office Number</th> -->
                    <th>Email Address</th>
                    <!-- <th>Instagram Profile</th>
                    <th>Twitter Handle</th>
                    <th>LinkedIn profile</th>
                    <th>Facebook Id</th> -->
                    <th>Created Date</th>
                    <th>Modified Date</th>
                    <th style="width:250px">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $no = 1;
                    while ($rows = mysqli_fetch_assoc($result)) {
                        ?>
                        <td>
                            <?php echo $no++; ?>
                        </td> <!-- incrementing the sl.no. -->
                        <td>
                            <?php echo $rows['id']; ?>
                        </td> <!-- primary key -->
                        <td>
                            <?php echo $rows['first_name']; ?>
                        </td>
                        <td>
                            <?php echo $rows['last_name']; ?>
                        </td>
                        <td style="text-align:right">
                            <?php echo $rows['mobile_number']; ?>
                        </td>
                        <!-- <td style="text-align:right">
                                                                        <?php echo $rows['office_number']; ?>
                        </td> -->
                        <td>
                            <?php echo '<a href="mailto:' . $rows['email_id'] . '">' . $rows['email_id'] . '</a>'; ?>
                        </td>
                        <!-- <td>
                                                                        <?php echo $rows['instagram_id']; ?>
                        </td>
                        <td>
                                                                        <?php echo $rows['twitter_id']; ?>
                        </td>
                        <td>
                                                                        <?php echo $rows['linkedin_id']; ?>
                        </td>
                        <td>
                                                                        <?php echo $rows['facebook_id']; ?>
                        </td> -->
                        <td style="text-align:right"> <!-- For changing the date format and printing the created date -->

                            <?php $timestamp = strtotime($rows['created_date']);

                            $date = date('M-d-Y H:i:s', $timestamp);
                            echo $date;
                            ?>
                        </td>
                        <td style="text-align:right">
                            <!-- For printing modifie date only if data is modified -->
                            <?php
                            $timestamp = date('Y-m-d H:i:s');
                            if (!empty($rows['mod_date'])) {
                                $timestamp = strtotime($rows['mod_date']);

                                $date = date('M-d-Y H:i:s', $timestamp);
                                echo $date;
                            }
                            ?>
                        </td>
                        <td><a class=" btn-lg view_data eye-icon" id="<?php echo $rows['id']; ?>"><i
                                    class="fa fa-eye"></i></a>
                            <a class=" btn-lg edit_icon edit_data" id="<?php echo $rows['id']; ?>"><i
                                    class="fa fa-edit"></i></a>

                            <a class="btn btn-lg delete-icon"
                                onclick="highlight(this); checkDelete(<?php echo $rows['id']; ?>,'<?php echo ($rows['first_name']); ?>'); "><i
                                    class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
            </tbody>
        </table>
    </div>
    <script type="text/javascript">

        function highlight(button) {
            var row = button.parentNode.parentNode; //one parentnode for tr and one parentNode for td
            row.classList.add("highlighted");
        }
        function checkDelete(id, name) {
            swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085D6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: 'delete.php',
                        data: { id: id },
                        success: function (data) {
                            swal.fire({
                                text: "User details deleted successfully!",
                                icon: "success",
                            });
                            location.reload();
                        },
                    });
                }
            })
        }
        function savecontact() {
            var first_name = document.forms["contact"]["firstName"].value;
            const numeric = /^[0-9]/;
            const noalphabets = /^[A-Za-z]+$/;
            if (first_name == "" || !noalphabets.test(first_name)) {
                swal.fire({
                    text: "Please enter a valid first name!",
                    icon: "info"
                });
                return false;
            }
            let last_name = document.forms["contact"]["lastName"].value;
            if (last_name == "" || !noalphabets.test(last_name)) {
                swal.fire({
                    text: "Please enter a valid last name!",
                    icon: "info"
                });
                return false;
            }
            let mobile_number = document.forms["contact"]["mobileNumber"].value;
            if (mobile_number == "" || !numeric.test(mobile_number)) {
                swal.fire({
                    text: "Please enter a valid contact number!",
                    icon: "info"
                });

                return false;
            }
            let office_number = document.forms["contact"]["officeNumber"].value;
            if (office_number) {
                if (!numeric.test(office_number)) {
                    swal.fire({
                        text: "Please enter a valid office number!",
                        icon: "info"
                    });
                    return false;
                }
            }
            let email_id = document.forms["contact"]["Email"].value;
            if (email_id) {
                if (noalphabets.test(email_id)) {
                    swal.fire({
                        text: "Please enter a valid email id!",
                        icon: "info"
                    });
                    return false;
                }
            }
            let twitter_id = document.forms["contact"]["Twitter"].value;
            if (twitter_id) {
                if (noalphabets.test(twitter_id)) {
                    swal.fire({
                        text: "Please enter a valid Twitter handle!",
                        icon: "info"
                    });
                    return false;
                }
            }
            let linkedin_id = document.forms["contact"]["Linkedin"].value;
            if (linkedin_id) {
                if (!noalphabets.test(linkedin_id)) {
                    swal.fire({
                        text: "Please enter a valid Linkedin profile!",
                        icon: "info"
                    });
                    return false;
                }
            }
            let facebook_id = document.forms["contact"]["Facebook"].value;
            if (facebook_id) {
                if (!noalphabets.test(facebook_id)) {
                    swal.fire({
                        text: "Please enter a valid Facebook profile!",
                        icon: "info"
                    });
                    return false;
                }
            }
            $.ajax({
                type: "POST",
                url: 'add_data.php',
                /* dataType : 'json', */
                data: $('#mycontact').serialize(),
                success: function (data) {
                    swal.fire({
                        text: "User details saved successfully!",
                        icon: "success",
                    });
                    location.reload();
                    $('.edit_data').hide();
                },
            });
        }
        /* Edit in popup modal*/
        $(document).on('click', '.edit_data', function () {
            var user_id = $(this).attr("id");

            var row = $(this).closest('tr');
            row.addClass("highlighted");
            $.ajax({
                url: "fetch.php",
                method: "POST",
                data: { id: user_id },
                dataType: "json",
                success: function (data) {
                    $('#firstName').val(data.first_name);
                    $('#lastName').val(data.last_name);
                    $('#mobileNumber').val(data.mobile_number);
                    $('#officeNumber').val(data.office_number);
                    $('#Email').val(data.email_id);
                    $('#Instagram').val(data.instagram_id);
                    $('#Twitter').val(data.twitter_id);
                    $('#Linkedin').val(data.linkedin_id);
                    $('#Facebook').val(data.facebook_id);
                    $('#id').val(user_id);
                    $('#add_con').click()
                    $('.modal-title').html('Edit Details');
                    $('#update-btn').show();
                    $('#Add').hide();
                    $('#reload').click(function () {
                        location.reload();
                    });
                }
            });
        });
        $("#update-btn").click(function () {
            $.ajax({
                url: "update.php",
                type: "POST",
                data: $('#mycontact').serialize(),
                success: function (data) {
                    swal.fire({
                        text: "User details Updated successfully!",
                        icon: "success",
                    });
                    location.reload();
                },

            });
        });
        $(document).ready(function () {
            $("#add_con").click(function () {
                $('#update-btn').hide();
                $('#Add').show();
            });
        });
        $(document).on('click', '.view_data', function () {
            var user_id = $(this).attr("id");
            if (user_id != '') {
                $.ajax({
                    url: "select.php",
                    method: "POST",
                    data: { id: user_id },
                    success: function (data) {
                        $('#myForm').html(data);
                        $('#add_con').click();
                        $('.modal-title').html('User Details');
                        $('#reload').click(function () {
                            location.reload();
                        });
                    }
                });
            }
        });
        //Datatypes
        $(document).ready(function () {
            $('#mytable').DataTable({
                dom: 'Blfrtip',
                pagingType: 'full_numbers',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
        $("#submit").click(function () {
            $.ajax({
                url: "import.php",
                type: "POST",
                data: $('#mycontact').serialize(),
                success: function (data) {
                    swal.fire({
                        text: "User details Added successfully!",
                        icon: "success",
                    });
                    location.reload();
                },
            });
            location.reload();
        });
    </script>
</body>

</html>