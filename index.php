<?php
date_default_timezone_set('Asia/Calcutta');
include 'connections.php';
include 'update.php';
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
    <center><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add
            Contact</button></center>
    <link rel="stylesheet" href="styles.css">
    <link type="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.css"> <!-- datatable css -->

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   

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
                        <form name="contact" method="post" id="mycontact" enctype="multipart/form-data">
                        <label>Select CSV File:</label>
                        <input type="file" name="file"><br>
                        <input type="submit" name="submit" value="Import">

                        <md style="color:red;display:flex;gap:5px;"><span style="color:black">First Name:</span>*
                            </md><input type="text" name="Fname" /><br><br>
                            <md style="color:red;display:flex;gap:5px;" /><span style="color:black">Last Name:</span>*
                            </md> <input type="text" name="Lname" /><br><br>
                            <md style="color:red;display:flex;gap:5px;"> <span style="color:black">Mobile
                                    Number:</span>*</md> <input type="text" name="Mnumber" /><br><br>
                            Office Number: <input type="text" name="Onumber" /><br><br>
                            Email Address: <input type="text" name="Email" /><br><br>
                            Instagram Profile: <input type="text" name="Instagram" /><br><br>
                            Twitter Handle: <input type="text" name="Twitter" /><br><br>
                            Linkedin Id: <input type="text" name="Linkedin" /><br><br>
                            Facebook Id: <input type="text" name="Facebook" /><br><br>
                            <input type="hidden" name="created_date" value= "<?php echo date('Y-m-d H:i:s')?>"/>
                            <input type="hidden" name="mod_date" value='<?php echo  date('Y-m-d H:i:s')?>'/>
                            <button type="button" onclick="savecontact()" class="btn btn-primary">Add</button>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <?php
    $sql = "select*from contact_information where id_deleted=false ORDER BY User_Id Desc";
    $result = mysqli_query($con, $sql);
    ?>
    <div>

        <table id="mytable" border="2" class="table-bordered" style="width:100%" >
            <thead>
                <tr> 
                    <th>Sl.no.</th>
                    <th>User Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Mobile Number</th>
                    <th>Office Number</th>
                    <th style="text-align:center">Email Address</th>
                    <th>Instagram Profile</th>
                    <th>Twitter Handle</th>
                    <th>LinkedIn profile</th>
                    <th>Facebook Id</th>
                    <th>Created Date</th>
                    <th>Modified Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
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
                        <td>
                            <?php echo $rows['mobile_number']; ?>
                        </td>
                        <td>
                            <?php echo $rows['office_number']; ?>
                        </td>
                        <td>
                            <?php echo $rows['email_id']; ?>
                        </td>
                        <td>
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
                        </td>
                        <td>    <!-- For changing the date format and printing the created date -->
                        
                            <?php $timestamp = strtotime($rows['created_date']);
                               
                                $date = date('M-d-Y H:i:s', $timestamp); 
                                echo $date;
                               ?> 
                        </td>
                        <td>
                        <!-- For printing modifie date only if data is modified -->
                            <?php 
                            $timestamp = date('Y-m-d H:i:s');
                            if(!empty($rows['mod_date'])){
                              $timestamp= strtotime($rows['mod_date']) ;
                             
                              $date=date('M-d-Y H:i:s', $timestamp);
                              echo $date; 
                            }
                            ?>  
                        </td>
                        <td><a class="btn btn-info btn-lg"
                                href="update.php?user_id=<?php echo $rows['user_id']; ?>">Edit</a>
                        </td>
                        <td><a class="btn btn-danger btn-lg" href="delete.php?user_id=<?php echo $rows['user_id']; ?>"
                                onclick="return checkDelete()">Delete</a></td>

                    </tr>
                    <?php
                    }
                    ?>
            </tbody>
        </table>
    </div>

    <script type="text/javascript">

        function checkDelete() {
            return confirm("Are you sure want to delete?");
        }
        function savecontact(){
            var x = document.forms["contact"]["Fname"].value;
            const num = /^[0-9]/;
            const noalpha = /^[A-Za-z]+$/;
            if (x == "" || !noalpha.test(x)) {
                swal({
                    text: "Please enter a valid first name!",
                    icon: "info"
                });
                return false;
            }
            let y = document.forms["contact"]["Lname"].value;
            if (y == "" || !noalpha.test(y)) {
                swal({
                    text: "Please enter a valid last name!",
                    icon: "info"
                });
                return false;
            }
            let z = document.forms["contact"]["Mnumber"].value;
            if (z == "" || !num.test(z)) {
                swal({
                    text: "Please enter a valid contact number!",
                    icon: "info"
                });

                return false;
            }
            let a = document.forms["contact"]["Onumber"].value;
            if (a) {
                if (!num.test(a)) {
                    swal({
                        text: "Please enter a valid office number!",
                        icon: "info"
                    });

                    return false;
                }
            }

            let b = document.forms["contact"]["Email"].value;
            if (b) {
                if (noalpha.test(b)) {
                    swal({
                        text: "Please enter a valid email id!",
                        icon: "info"
                    });

                    return false;
                }
            }
            let c = document.forms["contact"]["Twitter"].value;
            if (c) {
                if (noalpha.test(c)) {
                    swal({
                        text: "Please enter a valid Twitter handle!",
                        icon: "info"
                    });

                    return false;
                }
            }
            let d = document.forms["contact"]["Linkedin"].value;
            if (d) {
                if (!noalpha.test(d)) {
                    swal({
                        text: "Please enter a valid Linkedin profile!",
                        icon: "info"
                    });

                    return false;
                }
            }
            let e = document.forms["contact"]["Facebook"].value;
            if (e) {
                if (!noalpha.test(e)) {
                    swal({
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
                success: function(data)
                {   
                    swal({
                    text: "User details saved successfully!",
                    icon: "success",    
                });
                    location.reload();

               },
});
        }
        
        $(document).ready(function () {
            $('#mytable').DataTable({
                dom: 'Blfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                    
                ]
            });
        });

    </script>



</body>

</html>