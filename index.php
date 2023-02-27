<?php
include 'connections.php';
?>
<html>
<body>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
   <center><button type="submit" onclick="openform()">Add contact</button></center>
   <link rel="stylesheet" href="styles.css">
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<div class="form-popup" id="myForm">
<form name="contact" onsubmit="return validateform()" method="post" action="form.php">
    <md style="color:red;display:flex;gap:5px;"><span style="color:black">First Name:</span>*</md><input type="text"
        name="Fname" /><br><br>
    <md style="color:red;display:flex;gap:5px;" /><span style="color:black">Last Name:</span>*</md> <input
        type="text" name="Lname" /><br><br>
    <md style="color:red;display:flex;gap:5px;"> <span style="color:black">Mobile Number:</span>*</md> <input
        type="text" name="Mnumber" /><br><br>
    Office Number: <input type="text" name="Onumber" /><br><br>
    Email Id: <input type="text" name="Email" /><br><br>
    Instagram Id: <input type="text" name="Instagram" /><br><br>
    Twitter Id: <input type="text" name="Twitter" /><br><br>
    Linkedin Id: <input type="text" name="Linkedin" /><br><br>
    Facebook Id: <input type="text" name="Facebook" /><br><br>
    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="button" onclick="closeform()" class="btn btn-danger">Cancel</button>
</form>

    

</div>
<?php
        $sql= "select*from contact_information ORDER BY User_Id Desc";
        $result=mysqli_query($con,$sql);
?>
<div>
    
<table border="2"class="table-bordered ">
  <tr>
    <th>Sl.no.</th>
    <th>User Id</th>
    <th>First Name</th>
    <th>Last Name</th>  
    <th>Mobile Number</th>
    <th>Office Number</th>
    <th style="text-align:center">Email Id</th>
    <th>Instagram Id</th>
    <th>Twitter Handle</th>
    <th>LinkedIn profile</th>
    <th>Facebook Id</th>

  </tr>
  <tr>
  <?php 
  $no=1;
    while($rows=mysqli_fetch_assoc($result))
    {
    ?>     
            <td><?php echo $no++; ?></td> <!-- Autoincrementing the sl.no. -->
            <td><?php echo $rows ['user_id'];?></td> <!-- primary key -->
            <td><?php echo $rows['first_name'];?></td>
            <td><?php echo $rows['last_name'];?></td>
            <td><?php echo $rows['mobile_number'];?></td>
            <td><?php echo $rows['office_number'];?></td>
            <td><?php echo $rows['email_id'];?></td>
            <td><?php echo $rows['instagram_id'];?></td>
            <td><?php echo $rows['twitter_id'];?></td>
            <td><?php echo $rows['linkedin_id'];?></td>
            <td><?php echo $rows['facebook_id'];?></td>
            <td><a href="delete.php?ser_id=<?php echo $row["user_id"];?>">Delete</a></td>
        </tr>
    <?php
    }
    ?>

</table>
</div>

    <script type="text/javascript">

        function validateform() {
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


        }
    function openform() {
      document.getElementById("myForm").style.display = "block ";
    } 
    function closeform() {
        document.getElementById("myForm").style.display = "none";
    }  
    
    </script>
    
    </body>
</html>