<?php
include '../database/connections.php';
include '../header.php';
?>
<html>
    <title>New account registration</title>
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
<button type="button" class="btn-lg btn-success" onclick="reset_password()" style="margin:0 0 5% 40%;">Update</button><br>
or<a href="../index.php"> sign in</a>

</div>

</div>
</form>
    </body>
</html>