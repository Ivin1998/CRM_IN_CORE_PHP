<?php
include 'connections.php';
session_start();
$user_id = $_SESSION['user_id'];


?>
<html>
    <title>Department List</title>
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
            
        <?php
                           
                           $sql="SELECT  a.department_id,department_name, count(*) as cnt FROM contacts.contact_information a right join contacts.department b on a.department_id=b.department_id where
                           user_id='$user_id' group by user_id,department_name,a.department_id";
                           $result_dept=mysqli_query($con,$sql);
                           while($rows=mysqli_fetch_assoc($result_dept)){                    
            ?>          <tr>
                        <td>
                            <?php echo $rows['department_name']; ?>
                        </td>
                       
                       
                        <td>
                        <a href="contacts.php?department_id=<?php echo $rows['department_id']?>"><?php echo $rows['cnt']; ?></a>
                        </td>
            
                           </tr>
                           <?php
                    }
                    ?>
        
    </table>
    <button  class="btn btn-primary" data-toggle="modal"  data-target="#myModal">Add Department</button>
    
</body>

</html>