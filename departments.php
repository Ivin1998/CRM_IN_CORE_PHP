<?php
include 'connections.php';
session_start();
$user_id = $_SESSION['user_id'];
$department_name=$_POST['department_name'];


$sql = "SELECT COUNT(*) FROM contact_information WHERE is_deleted=0 AND department_id='$department_name'";
$result1=mysqli_query($con,$sql);
/* $conditions = [
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
 */
?>
<html>
<head>
    <link rel="stylesheet" href="./assets/formbootstrap.css">
    <link rel="stylesheet" href="./assets/styles.css">
    <script type="text/javascript" src="./assets/sweetalert.js"></script>
    <script type="text/javascript" src="./assets/jquery.js"></script>
    <script type="text/javascript" src="./assets/bootstrapjs.js"></script>
    <script type="text/javascript" src="./assets/validations.js"></script>
</head>
<body>

<div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div style="padding: 15px 15px 0px 15px">
                    <div class="row">
                        <div class="col col-sm-6">
                            <h4>Add Department</h4>
                        </div>
                        <div class="col col-sm-6">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div id="myForm">
                       <form id="mycontact">
                            Deptartment Name:
                           <input type="text" name="department_name" class="form-control"/><br>
                            <button type="button" id="dept_add"  class="btn btn-primary" class="form-control">Add</button>
                    </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="reload" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
    <a href="dashboards.php" class="btn btn-primary" style="margin:10">Back to Dashboard</button></a>
    <table border="1" padding = 15 class="table table-striped table-hover" style="width:50%">
        <thead>
            <h1 class="page-header">Department List</h1>
        
            <tr>
                <th style="text-align: center;">Department Name</th>
                <th style="text-align: center;">No. of contacts</th>
            </tr>
        </thead>
            <tr>
        <?php
                           
                           $sql="SELECT * FROM department";
                           $result_dept=mysqli_query($con,$sql);
                           while($rows=mysqli_fetch_assoc($result_dept)){            
            ?>
                        <td>
                            <?php echo $rows['department_name']; ?>
                        </td>
                        <td>
                            <?php echo $rows['COUNT(*)']; ?>
                        </td>

                           </tr>
                           <?php
                    }
                    ?>
        
        <!-- <tr>
            <td>Technology Services</td>
            <td>
               <a href="contacts.php?department_id=10"><?php echo $row1['COUNT(*)']; ?></a>
            </td>
        </tr>
        <tr>
            <td>FI Research</td>
            <td>
            <a href="contacts.php?department_id=12"> <?php echo $row2['COUNT(*)']; ?></a>
            </td>
        </tr>
        <tr>
            <td>Medical Imaging</td>
            <td>
            <a href="contacts.php?department_id=14">  <?php echo $row3['COUNT(*)']; ?></a>
            </td>
        </tr>
        <tr>
            <td>CS Research</td>
            <td>
            <a href="contacts.php?department_id=16"><?php echo $row4['COUNT(*)']; ?></a>
            </td>
        </tr> -->
    </table>
    <button  class="btn btn-primary" data-toggle="modal"  data-target="#myModal">Add Department</button>
    
</body>

</html>