<?php
include '../database/connections.php';
include '../header.php';
$username = $_GET['email'];
$todays_date = date("Y-m-d");
$sql = "SELECT resettokenexp FROM users WHERE email='$username'";
$query = mysqli_query($con, $sql);
while ($row = mysqli_fetch_assoc($query)) {
    $created_date = $row['resettokenexp'];
}
if ($created_date == $todays_date) {
    ?>
    <html>
    <title>Reset Password</title>

    <body class="index_page">

        <div class="row" style="width:100%">
            <div class="col col-sm-6 ">
            </div>
            <div class="col col-sm-6" style="margin-top:5%">
                <h1 style="color:blue"><B>Reset password</B></h1>
                <form name="create_account" id="new_user" style="padding:15px;width:50%" class="login" method="POST">
                    <input type="password" placeholder="New Password" name="password" id="password" class="form-control"
                        style="padding-top:15;margin:25 0;width:80%">
                    <span class="password" style="color:red;"></span>
                    <input type="password" placeholder="Confirm your password" name="confirmPassword" id="confirmPassword"
                        class="form-control" style="padding-top:15;margin: 25 0;width:80%">
                    <span class="registrationFormAlert" style="color:green;" id="CheckPasswordMatch"></span>
                    <br>
                    <input type="submit" class="btn-lg btn-success" onclick="reset_password('<?php echo $username; ?>')"
                        style="margin:0 0 5% 40%;"><br>
                    or<a href="../index.php"> sign in</a>
                </form>
            </div>
        </div>
    <?php } else { ?>

        <body class="index_page">
            <h1 style="text-align:center">Invalid link or expired link! 😞</h1>
        </body>

    <?php } ?>
    <script>
        function reset_password(user_name) {
            var confirmPassword = $('#confirmPassword').val();
            $.ajax({
                url: 'update_password.php',
                type: "POST",
                data: { user: user_name, password: confirmPassword },
                success: function (data) {
                    swal.fire({
                        text: "User activation status updated successfully!",
                        icon: "success",
                    })
                    location.replace('../index.php');
                }
            })

        };

    </script>

</body>

</html>