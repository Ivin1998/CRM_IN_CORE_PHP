<?php
<<<<<<< HEAD
$con=mysqli_connect("localhost","root","CsAdmin12#$","contacts");


?>

=======
include './connections.php';

    $message = "";
    if (count($_POST) > 0) {
        $isSuccess = 0;
        $userName = $_POST['user_name'];
        $sql = "SELECT * FROM users WHERE user_name= ?";
        $statement = $con->prepare($sql);
        $statement->bind_param('s', $userName);
        $statement->execute();
        $result = $statement->get_result();
        while ($row = $result->fetch_assoc()) {
            if (!empty($row)) {
                $hashedPassword = $row["password"];
                if (password_verify($_POST["password"], $hashedPassword)) {
                    $isSuccess = 1;
                }
            }
        }
        if ($isSuccess == 0) {
            $message = "Invalid Username or Password!";
        } else {
            header("Location:  ./contacts.php");
        }
    }
    ?>

>>>>>>> assets


<html>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
 <link rel="stylesheet" href="styles.css">
<center>
 <body>
    <title>Login</title>
    <h2>Login</h2>
    <div>
<<<<<<< HEAD
    <form method="post" class="login">
=======
    <form action="contacts.php" class="login">
>>>>>>> assets
        <label style="text-align:left">User Name</label>
        <input type="text" name="user_name" placeholder="Enter your email"class="form-control input" ><br>
        <label style="text-align:left">Password</label>
        <input type="password" name="password" placeholder="Enter your Password"class="form-control input"><br>
<<<<<<< HEAD
        <button type="submit" class="btn btn-primary" >Login</button>
        <h5 id="forgot" >Forgotten Password?</h5>
    </form>

<?php
    $message = "";
    if (count($_POST) > 0) {
        $isSuccess = 0;
      
        $userName = $_POST['user_name'];
        $sql = "SELECT * FROM users WHERE user_name= ?";
        $statement = $con->prepare($sql);
        $statement->bind_param('s', $userName);

        $statement->execute();
        $result = $statement->get_result();
        
        while ($row = $result->fetch_assoc()) {
        
            if (!empty($row)) {
               
                $hashedPassword = $row["password"];
                if (password_verify($_POST["password"], $hashedPassword)) {
                    $isSuccess = 1;
                }
            }
        }
        if ($isSuccess == 0) {
            $message = "Invalid Username or Password!";
            
        
        } else {
            header("Location:contacts.php");
        }
        
    }
    ?>



    

=======
        <button type="submit" class="btn btn-primary">Login</button>
        <h5 id="forgot" >Forgotten Password?</h5>

    </form>


>>>>>>> assets
</body>
</center>


</html>