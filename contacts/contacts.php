<?php
date_default_timezone_set('Asia/Calcutta');
include '../database/connections.php';
include '../mvc/controller.php';
$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];
$count_query = "SELECT COUNT(*) FROM contacts WHERE is_deleted=0 AND user_id='$user_id'";
$result = mysqli_query($con, $count_query);
$row = mysqli_fetch_assoc($result);

$set = $row['COUNT(*)'];
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
    <link rel="stylesheet" href="../assets/style_sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
    <script type="text/javascript" src="../assets/sweetalert.js"></script>
    <script type="text/javascript" src="../assets/jquery.js"></script>
    <script type="text/javascript" src="../assets/bootstrapjs.js"></script>
    <script type="text/javascript" src="../assets/datatable1.js"></script> <!-- Pagination -->
    <script type="text/javascript" src="../assets/datatable2.js"></script> <!-- CSV in database table -->
    <script type="text/javascript" src="../assets/datatable3.js"></script><!-- Excel in database table -->
    <script type="text/javascript" src="../assets/datatable4.js"></script> <!-- PDF button in database table -->
    <script type="text/javascript" src="../assets/datatable5.js"></script> <!-- Displaying the datatables buttons -->
    <script type="text/javascript" src="../assets/datatable6.js"></script><!-- Print in database table -->
    <script type="text/javascript" src="../assets/datatable7.js"></script><!-- PDF download in database table -->
    <script type="text/javascript" src="../assets/validations.js"></script>
    </head>
<body>
<div class="header" id="myHeader">
  <h2>User Application</h2>
</div>
    <div class="sidebar">
    <a  href="contacts.php">Home</a>
  <a class="active" href="contacts.php">Contacts <?php echo "<span class=badge>". $set ."</span>" ?></a>
  <a href="../departments/departments.php">Departments</a>
  <a  href="../region/country_crud.php">Countries</a>
    <a  href="../region/state_crud.php">States</a>
    <a  href="../region/city_crud.php">Cities</a>
    </div>
    <div class="content"> 
           <div class="row" style="padding-top: 15px;">
        <div class="col col-sm-6 ">
        </div>
        <div class="col col-sm-2"><button id="add_con" type="button" class="btn btn-primary btn-lg add_con_align " data-toggle="modal"
                data-target="#myModal">Add Contact</button></div>
        <div class="col col-sm-2"><button type="button" class="btn btn-primary btn-lg import add_con_align" data-toggle="modal"
                data-target="#myModal">Import Contact</button></div>
        <div class=" col col-sm-2">
            <button class="btn btn-primary rounded-circle" style="height:40px;margin: -70 70;" ;type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa-solid" >
                    <?php echo "$username[0]$username[1]"; ?>
                </i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            
                <button class="dropdown-item" href="#">My profile</button>
                <button class="dropdown-item" href="#">
                    <?php echo "<p class=intro> $username!</p>"; ?>
                </button>
                <div class="dropdown-content">
                <a  class="dropdown-item" style="text-decoration:none">Export</a>
                <div class="sub-dropdown dropdown-menu">
                    <a class="dropdown-item" href="export_csv.php" style="text-decoration:none">Comma Separated Values (.csv)</a>
                    <a class="dropdown-item" href="export_excel.php" style="text-decoration:none">Microsoft Excel (.xlsx)</a>
                    <a class="dropdown-item" href="export_pdf.php" style="text-decoration:none">PDF (.pdf)</a>
                </div>
                </div>
                <a class="dropdown-item" href="logout.php" style="text-decoration:none">Log out</a>  
            </div>
        </div>
    </div>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" >
                <div style="padding: 15px 15px 0px 15px">
                    <div class="row">
                        <div class="col col-sm-6" id="modal-title">
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
                                 Country: <select name="country" id="country_dropdown" class="form-control">
                                 <option value="">Select Country</option>

                                <?php
                                $sql="SELECT * FROM countries WHERE is_deleted=0";
                                $result_country=mysqli_query($con,$sql);
                                while($rows_country=mysqli_fetch_array($result_country)){
                                    ?><option value="<?php echo $rows_country['id'] ?>">
                                        <?php echo $rows_country['name']; ?>
                                    </option>
                                    <?php
                                }
                                ?>  </select><br></br>
       
                                      State: <select name ="state" id="state_dropdown" class="form-control">                                  
                                        <option value="">Select State</option>
                                 
                                 </select><br></br>
                                 City: <select name="city" id="city_dropdown" class="form-control">
                                 <option value="">Select City</option>

                                 </select><br></br>
                                Instagram Profile: <input type="text" name="Instagram" id="Instagram"
                                    class="form-control" /><br><br>
                                Twitter Handle: <input type="text" name="Twitter" id="Twitter"
                                    class="form-control" /><br><br>
                                Linkedin Id: <input type="text" name="Linkedin" id="Linkedin"
                                    class="form-control" /><br><br>
                                Facebook Id: <input type="text" name="Facebook" id="Facebook"
                                    class="form-control" /><br><br>
                                <input type="hidden" name="id" id="id"/>
                                <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id ?>">
                                <input type="hidden" name="created_date" value="<?php echo date('Y-m-d H:i:s') ?>" />
                                <input type="hidden" name="mod_date" value='<?php echo date('Y-m-d H:i:s') ?>' />
                                <button type="button" onclick="savecontact()" id="Add"
                                    class="btn btn-primary form-control">Add</button>
                                <button id="update_button" class="btn btn-primary form-control"
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
                    <th style="width:200px">Actions</th>
                    <th>Department</th>
                    <th>Country</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                     $no = 1;
                    $value = new extract("localhost", "root", "CsAdmin12#$", "contacts");
                    $row=$value->fetch_data(); 
                    foreach($row as $rows){
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
                        <td style="text-align:right;padding:10"> <!-- For changing the date format and printing the created date -->
                            <?php $timestamp = strtotime($rows['created_date']);
                            $date = date('M-d-Y H:i:s', $timestamp);
                            echo $date;
                            ?>
                        </td>
                        <td style="text-align:right;padding:10">
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
                        <td style="text-align:center"><a class="btn-lg view_data eye-icon" id="<?php echo $rows['unique_id']; ?>"><i
                                    class="fa fa-eye" ></i></a>
                            <a class="btn-lg edit_icon edit_data" id="<?php echo $rows['unique_id']; ?>"><i
                                    class="fa fa-edit"></i></a>
                            <a class="btn btn-lg delete-icon"
                                onclick="highlight(this); checkDelete(<?php echo $rows['unique_id']; ?>); "><i
                                    class="fa fa-trash"></i></a>
                        </td>
                        <td>
                            <?php echo $rows['department_name']; ?>
                        </td>
                        <td>
                            <?php echo $rows['name']; ?>
                        </td> 
                    </tr>
                    <?php
                    }
                    ?>
            </tbody>
        </table> 
            </body>
</html>