<?php
include 'header.php';
?>
<html>
    
<center>
    <body>
        <title>Login</title>
        <h2>Login</h2>
        <div>
            <form method="post" class="login">
                <label style="text-align:left">User Name</label>
                <input type="text" name="user_name" placeholder="Enter your email" class="form-control input"><br>
                <label style="text-align:left">Password</label>
                <input type="password" name="password" placeholder="Enter your Password" id="myInput"
                    class="form-control input">
                <div class="show"><input type="checkbox" onclick="checkPassword()"> Show password</input></div>
                <button type="submit" name="submit" class="btn btn-primary">Login</button>
                <h5 id="forgot">Forgotten Password?</h5>
            </form>
            <script>
                function checkPassword() {
                    var x = document.getElementById("myInput");
                    if (x.type === "password") {
                        x.type = "text";
                    } else {
                        x.type = "password";
                    }
                }
            </script>
    </body>
</center>
</html>
<?php
session_start();
include './database/connections.php';
session_regenerate_id();
if (isset($_POST["submit"])) {
    $username = $_POST['user_name'];
    $password = md5($_POST['password']); 
    $session_id = session_id();
    
    $stmt = $con->prepare("SELECT user_name, password,user_id FROM users WHERE user_name=? AND password=? LIMIT 1");
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $stmt->bind_result($username, $password, $user_id);
    $stmt->store_result();
    if ($stmt->num_rows == 1) {
        if ($stmt->fetch()) { {
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $username;
                header("Location: contacts/contacts.php");
                exit();
            }
        }
    } else {
        echo "
        <script>Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Invalid username or password!',
          });
        </script>";
    }
    $stmt->close();
}
$con->close();
?>