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
<h1 style="color:blue"><B>Sign up</B></h1>
<form name="create_account" id="new_user" style="padding:15px" class="login" method="POST">
    <div class="row">
        <div class="col col-sm-6">
        <input type="text" placeholder="First Name" name="firstName" id="firstName" class="form-control">
           <span class="firstName" style="color:red;"></span>
        </div>
        <div class="col col-sm-6">
    <input type="text" placeholder="Last Name" id="lastName" name="lastName" class="form-control">
    <span class="lastName" style="color:red;"></span>

    </div>
    </div>
    <input type="text" placeholder="Enter your email address" name="Email" class="form-control" id="Email"
        style=" padding-top:15;margin:25 0 0;">
        <span class="Email" style="color:red;"></span>
    <input type="password" placeholder="New Password" name="password" id="password" class="form-control"
        style="padding-top:15;margin:25 0;">
        <span class="password" style="color:red;"></span>
    <input type="password" placeholder="Confirm your password" name="confirmPassword" id="confirmPassword"
        class="form-control" style="padding-top:15;margin: 25 0;">
    <span class="registrationFormAlert" style="color:green;" id="CheckPasswordMatch"></span>

    <div style="margin-left:6%">
        <input type="checkbox" id="checkbox" /> By clicking Sign Up, you agree to our
        <a href="https://www.facebook.com/legal/terms/update" target="_blank">Terms,</a>
        <a href="https://www.facebook.com/privacy/policy/?entry_point=data_policy_redirect&entry=0" target="_blank">
            Privacy Policy</a> and
        <a href="https://www.facebook.com/privacy/policies/cookies/?entry_point=cookie_policy_redirect&entry=0"
            target="_blank">Cookies Policy.</a> You may receive SMS notifications from us and
        can opt out at any time.
    </div>
<span class="checkbox"></span>
        <br>
<button type="button" class="btn-lg btn-success" onclick="new_user()" style="margin:0 0 5% 40%;">Sign up</button><br>
or<a href="../index.php"> sign in</a>

</div>

</div>
</form>
    </body>
</html>