<?php
include 'header.php';
include 'database/connections.php';
ob_start();
session_start();
session_regenerate_id();
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
                        <h5 id="forgot" style="color:blue" data-toggle="modal" data-target="#forgotModal">Forgot Password?</h5>
                        <hr style="height:2px;border-width:thin">
                        <a href="login_users/create_account.php" class="btn create_new" >Create new account</a>

                    </form>
                </div>
            </div>

            <!-- Modal for forgot password-->
            <div class="modal fade" id="forgotModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content" style="margin-top: 40%;">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel"><B>Find Your Account</B></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                           <h4>Please enter your email address to reset password for your account.</h4>
                           <input type="text" placeholder="Enter your email address" class="form-control" style="width: 75%;"/>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary">Send</button>
                        </div>
                    </div>
                </div>
            </div>


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

<?php
if (isset($_POST["submit"])) {
    $username = $_POST['user_name'];
    $password = md5($_POST['password']);
    $session_id = session_id();

    $stmt = $con->prepare("SELECT email, password,user_id,is_admin FROM users WHERE email=? AND password=? LIMIT 1");
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $stmt->bind_result($username, $password, $user_id, $is_admin);
    $stmt->store_result();
    if ($stmt->num_rows == 1) {
        if ($stmt->fetch()) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['is_admin'] = $is_admin;
            header("Location: contacts/contacts.php");
            exit();
        }
    } else {
        if($username!=='' && $password!==''){
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Invalid username or password!',
              });
            </script>";
        }
        else{
            echo "<script>
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Please enter the username and password!',
              });
            </script>";
        }
        
    }
    $stmt->close();
}
$con->close();
?>