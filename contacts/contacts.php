<?php
date_default_timezone_set('Asia/Calcutta');
include '../database/connections.php';
session_start();
$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];

if (isset($_GET["department_id"])) {
    $department_id = $_GET['department_id'];
} else {
    $department_id = '';
}
?>
<html>
<head>
<body>
    <title>Users_list</title>
    <link rel="stylesheet" href="../assets/bootstrapmin.css" />
    <link rel="stylesheet" href="../assets/formbootstrap.css">
    <link rel="stylesheet" href="../assets/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
    <script type="text/javascript" src="../assets/sweetalert.js"></script>
    <script type="text/javascript" src="../assets/jquery.js"></script>
    <script type="text/javascript" src="../assets/bootstrapjs.js"></script>
    <script type="text/javascript" src="../assets/datatable1.js"></script>
    <script type="text/javascript" src="../assets/datatable2.js"></script>
    <script type="text/javascript" src="../assets/datatable3.js"></script>
    <script type="text/javascript" src="../assets/datatable4.js"></script>
    <script type="text/javascript" src="../assets/datatable5.js"></script>
    <script type="text/javascript" src="../assets/datatable6.js"></script>
    <script type="text/javascript" src="../assets/datatable7.js"></script>
    <script type="text/javascript" src="../assets/validations.js"></script>
    </head>
    <div class="row" style="padding-top: 15px;">
        <div class="col col-sm-6 ">
        </div>
        <div class="col col-sm-2"><button id="add_con" type="button" class="btn btn-primary btn-lg" data-toggle="modal"
                data-target="#myModal">Add Contact</button></div>
        <div class="col col-sm-2"><button type="button" class="btn btn-primary btn-lg import" data-toggle="modal"
                data-target="#myModal">Import Contact</button></div>
        <div class=" col col-sm-2">
            <button class="btn btn-primary rounded-circle" style="height:40px" ;type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa-solid">
                    <?php echo "$username[0]$username[1]"; ?>
                </i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <button class="dropdown-item" href="#">My profile</button>
                <button class="dropdown-item" href="#">
                    <?php echo "<p class=intro> $username!</p>"; ?>
                </button>
                <a class="dropdown-item" href="../dashboards.php" style="text-decoration:none">
                    My Dashboard
                </a>
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
                </div>
                <div class="modal-body">
                    <div id="myForm">
                        <form name="contact" method="post" action="import.php" id="mycontact"
                            enctype="multipart/form-data">
                            <div id="importing">
                                <label>Select CSV File:</label>
                                <input type="file" name="csv_file" id><br>
                                <input type="submit" name="submit" id="submit" value="Import"
                                    class="btn btn-primary form-control">
                            </div>
                            <div id="Feed_input">
                                <md style="color:red;display:flex;gap:5px;"><span style="color:black">First
                                        Name:</span>*
                                </md><input type="text" name="firstName" id="firstName" class="form-control" /><br><br>
                                <md style="color:red;display:flex;gap:5px;" /><span style="color:black">Last
                                    Name:</span>*
                                </md> <input type="text" name="lastName" id="lastName" class="form-control" /><br><br>
                                <md style="color:red;display:flex;gap:5px;"> <span style="color:black">
                                        Mobile Number:</span>*</md> <input type="text" name="mobileNumber"
                                    id="mobileNumber" class="form-control" /><br><br>
                                Office Number: <input type="text" name="officeNumber" id="officeNumber"
                                    class="form-control" /><br><br>
                                Email Address: <input type="text" name="Email" id="Email"
                                    class="form-control" /><br><br>
                                Deptartment Name: <select name="department_name" class="form-control">
                                    <?php
                                    $sql = "SELECT * FROM department";
                                    $result_dept = mysqli_query($con, $sql);
                                    while ($rows_dep = mysqli_fetch_assoc($result_dept)) {
                                        $selected = ($rows_dep['department_id'] == $department_id) ? 'selected' : '';
                                        ?>
                                        <option value="<?php echo $rows_dep['department_id']; ?>" <?php echo $selected ?>>

                                            <?php echo $rows_dep['department_name']; ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select><br></br>
                                Instagram Profile: <input type="text" name="Instagram" id="Instagram"
                                    class="form-control" /><br><br>
                                Twitter Handle: <input type="text" name="Twitter" id="Twitter"
                                    class="form-control" /><br><br>
                                Linkedin Id: <input type="text" name="Linkedin" id="Linkedin"
                                    class="form-control" /><br><br>
                                Facebook Id: <input type="text" name="Facebook" id="Facebook"
                                    class="form-control" /><br><br>
                                <input type="hidden" name="id" id="id" />
                                <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id ?>">
                                <input type="hidden" name="created_date" value="<?php echo date('Y-m-d H:i:s') ?>" />
                                <input type="hidden" name="mod_date" value='<?php echo date('Y-m-d H:i:s') ?>' />
                                <button type="button" onclick="savecontact()" id="Add"
                                    class="btn btn-primary form-control">Add</button>
                                <button id="update-btn" class="btn btn-primary form-control"
                                    type="button">Update</button>
                            </div>
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
    if ($department_id) {
        $sql = "SELECT * FROM contact_information a inner join department b on a.department_id=b.department_id WHERE is_deleted=0 AND user_id='$user_id' AND  a.department_id='$department_id' ORDER BY id DESC";
        $result = mysqli_query($con, $sql);
    } else {
        $sql = "SELECT * FROM contact_information a left join department b on a.department_id=b.department_id WHERE is_deleted=0 AND user_id='$user_id' ORDER BY id DESC";
        $result = mysqli_query($con, $sql);
    }
    ?>
    <div>
        <table id="mytable" border="2" class="table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Sl.no.</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Mobile Number</th>
                    <th>Email Address</th>
                    <th>Created Date</th>
                    <th>Modified Date</th>
                    <th style="width:250px">Actions</th>
                    <th>Department</th>
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
                            <?php echo $rows['first_name']; ?>
                        </td>
                        <td>
                            <?php echo $rows['last_name']; ?>
                        </td>
                        <td style="text-align:right; padding:10">
                            <?php echo $rows['mobile_number']; ?>
                        </td>
                        <td>
                            <?php echo '<a href="mailto:' . $rows['email_id'] . '">' . $rows['email_id'] . '</a>'; ?>
                        </td>
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
                        <td><a class="btn-lg view_data eye-icon" id="<?php echo $rows['id']; ?>"><i
                                    class="fa fa-eye"></i></a>
                            <a class=" btn-lg edit_icon edit_data" id="<?php echo $rows['id']; ?>"><i
                                    class="fa fa-edit"></i></a>

                            <a class="btn btn-lg delete-icon"
                                onclick="highlight(this); checkDelete(<?php echo $rows['id']; ?>,'<?php echo ($rows['first_name']); ?>'); "><i
                                    class="fa fa-trash"></i></a>
                        </td>
                        <td>
                            <?php echo $rows['department_name']; ?>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
            </tbody>
        </table>
    </div>
</body>
</html>