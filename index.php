<?php
include 'header.php';
include './database/connections.php';
session_start();
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
<html>

<body class="index_page">
    <title>Login</title>
    <div class="row" style="width:100%">
        <div class="col-md-2">
        </div>
        <div class="col-md-10">
            <div class="col-md-6">
                
                <h1 class="intro_page"><B>User Application</B></h1>
                <h3 style="line-height: 1.6;">This application helps you to add, remove, modify the users' data. 
                    Also, allows to upload/download and view them.</h3>
            </div>
            <div class="col-md-6">
                <div style="padding-top:20%; width:100%;font-size:20">
                    <form method="post" class="login">
                        <label style="text-align:left">Email</label>
                        <input type="text" name="user_name" placeholder="Enter your email"
                            class="form-control input"><br>
                        <label style="text-align:left">Password</label>
                        <div class="password-wrapper">
                            <input type="password" name="password" placeholder="Enter your Password" id="myInput"
                                class="form-control input">
                            <i class="fa fa-eye-slash" id="toggle-password" style="font-size: 15;"></i>
                        </div>
                        <button type="submit" name="submit" class="btn login_button">Log in</button>
                        <h5 id="forgot" style="color:blue">Forgot Password?</h5>
                        <hr style="height:2px;border-width:thin">
                        <button type="submit" class="btn create_new">Create new account</button>

                    </form>
                    <script>

                        /* View passwords */

                        const passwordInput = document.getElementById('myInput');
                        const togglePassword = document.getElementById('toggle-password');

                        togglePassword.addEventListener('click', function () {
                            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                            passwordInput.setAttribute('type', type);
                            togglePassword.classList.toggle('fa-eye-slash');
                            togglePassword.classList.toggle('fa-eye');

                        });

                    </script>
                </div>

            </div>
        </div>
    </div>

</body>

</html>
