<?php
date_default_timezone_set('Asia/Calcutta');
include 'connections.php';
?>

<body>
    <title>Users_list</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <br>
    <div style="float: right;"><button id="add_con" type="button" class="btn btn-info btn-lg" data-toggle="modal"
            data-target="#myModal">Add Contact</button>
    </div>
    <link rel="stylesheet" href="styles.css">
    <link type="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.css"> <!-- datatable css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.15/sweetalert2.all.js"></script>

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Contact</h4>
                </div>
                <div class="modal-body">
                    <div id="myForm">
                        <form name="contact" action="import.php" method="post" id="mycontact" enctype="multipart/form-data">
                            <label>Select CSV File:</label>
                            <input type="file" name="csv_file"><br>
                            <input type="submit" name="submit" value="Import">


                            <md style="color:red;display:flex;gap:5px;"><span style="color:black">First Name:</span>*
                            </md><input type="text" name="firstName" id="firstName" /><br><br>
                            <md style="color:red;display:flex;gap:5px;" /><span style="color:black">Last Name:</span>*
                            </md> <input type="text" name="lastName" id="lastName" /><br><br>
                            <md style="color:red;display:flex;gap:5px;"> <span style="color:black">Mobile
                                    Number:</span>*</md> <input type="text" name="mobileNumber"
                                id="mobileNumber" /><br><br>
                            Office Number: <input type="text" name="officeNumber" id="officeNumber" /><br><br>
                            Email Address: <input type="text" name="Email" id="Email" /><br><br>
                            Instagram Profile: <input type="text" name="Instagram" id="Instagram" /><br><br>
                            Twitter Handle: <input type="text" name="Twitter" id="Twitter" /><br><br>
                            Linkedin Id: <input type="text" name="Linkedin" id="Linkedin" /><br><br>
                            Facebook Id: <input type="text" name="Facebook" id="Facebook" /><br><br>
                            <input type="hidden" name="user_id" id="user_id" />
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
    $sql = "select*from contact_information where is_deleted=0 ORDER BY User_Id Desc";
    $result = mysqli_query($con, $sql);
    ?>
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
                            <?php echo $rows['user_id']; ?>
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
                        <td><a class=" btn-lg view_data eye-icon" id="<?php echo $rows['user_id']; ?>"><i
                                    class="fa fa-eye"></i></a>
                            <a class=" btn-lg edit_icon edit_data" id="<?php echo $rows['user_id']; ?>"><i
                                    class="fa fa-edit"></i></a>

                            <a class="btn btn-lg delete-icon"
                                onclick="highlight(this); checkDelete(<?php echo $rows['user_id']; ?>,'<?php echo ($rows['first_name']); ?>'); "><i
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
                        data: { user_id: id },
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
            const num = /^[0-9]/;
            const noalpha = /^[A-Za-z]+$/;
            if (first_name == "" || !noalpha.test(first_name)) {
                swal.fire({
                    text: "Please enter a valid first name!",
                    icon: "info"
                });
                return false;
            }
            let last_name = document.forms["contact"]["lastName"].value;
            if (last_name == "" || !noalpha.test(last_name)) {
                swal.fire({
                    text: "Please enter a valid last name!",
                    icon: "info"
                });
                return false;
            }
            let mobile_number = document.forms["contact"]["mobileNumber"].value;
            if (mobile_number == "" || !num.test(mobile_number)) {
                swal.fire({
                    text: "Please enter a valid contact number!",
                    icon: "info"
                });

                return false;
            }
            let office_number = document.forms["contact"]["officeNumber"].value;
            if (office_number) {
                if (!num.test(office_number)) {
                    swal.fire({
                        text: "Please enter a valid office number!",
                        icon: "info"
                    });

                    return false;
                }
            }

            let email_id = document.forms["contact"]["Email"].value;
            if (email_id) {
                if (noalpha.test(email_id)) {
                    swal.fire({
                        text: "Please enter a valid email id!",
                        icon: "info"
                    });

                    return false;
                }
            }
            let twitter_id = document.forms["contact"]["Twitter"].value;
            if (twitter_id) {
                if (noalpha.test(twitter_id)) {
                    swal.fire({
                        text: "Please enter a valid Twitter handle!",
                        icon: "info"
                    });

                    return false;
                }
            }
            let linkedin_id = document.forms["contact"]["Linkedin"].value;
            if (linkedin_id) {
                if (!noalpha.test(linkedin_id)) {
                    swal.fire({
                        text: "Please enter a valid Linkedin profile!",
                        icon: "info"
                    });

                    return false;
                }
            }
            let facebook_id = document.forms["contact"]["Facebook"].value;
            if (facebook_id) {
                if (!noalpha.test(facebook_id)) {
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
                data: { user_id: user_id },
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
                    $('#user_id').val(user_id);
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
                    data: { user_id: user_id },
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

    </script>
</body>

</html>