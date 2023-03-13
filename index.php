<?php
include 'connections.php';

$message = "";
if (count($_POST) > 0) {
    $isSuccess = 0;
    $sql = "SELECT * FROM users WHERE user_name= ?";
    $userName = $_POST['user_name'];
    $statement = $con->prepare($sql);
    $statement->bind_param('user_name', $userName);
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
        header("Location:  contacts.php");
    }
}
?>

<html>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
 <link rel="stylesheet" href="styles.css">
<center>
 <body>
    <title>Login</title>
    <h2>Login</h2>
    <div>
        <!-- had the first action temporary -->
    <form method="post" action="contacts.php"action= "<?php echo $_SERVER['PHP_SELF']; ?>" class="login"> 
        <label style="text-align:left">User Name</label>
        <input type="text" name="user_name" placeholder="Enter your email"class="form-control input" ><br>
        <label style="text-align:left">Password</label>
        <input type="password" name="password" placeholder="Enter your Password"class="form-control input"><br>
        <button type="submit" class="btn btn-primary" >Login</button>
        <h5 id="forgot" >Forgotten Password?</h5>
    </form>

</body>
</center>


</html>