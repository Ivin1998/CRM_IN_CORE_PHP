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
<form id="new_user" style="padding:15px" class="login"  method="POST">
    <input type="text" placeholder="First Name" name="firstName" class="form-control"
        style="width:40%;float:left;margin:0 35;">
    <input type="text" placeholder="Last Name" name="lastName" class="form-control" style="width:40%">
    <input type="text" placeholder="Enter your email address" name="email" class="form-control"
        style="width:86%; padding-top:15;margin: 35;">
    <input type="text" placeholder="New Password" name="password" id="password" class="form-control"
        style="width:86%; padding-top:15;margin: 35;">
    <input type="text" placeholder="Confirm your password" name="confirmPassword" id="confirmPassword"
        class="form-control" style="width:86%; padding-top:15;margin: 0 0 20 35;">
    <span class="registrationFormAlert" style="color:green;" id="CheckPasswordMatch"></span>

    <div style="margin-left:6%">
        <input type="checkbox" /> By clicking Sign Up, you agree to our
        <a href="https://www.facebook.com/legal/terms/update" target="_blank">Terms,</a>
        <a href="https://www.facebook.com/privacy/policy/?entry_point=data_policy_redirect&entry=0" target="_blank">
            Privacy Policy</a> and
        <a href="https://www.facebook.com/privacy/policies/cookies/?entry_point=cookie_policy_redirect&entry=0"
            target="_blank">Cookies Policy.</a> You may receive SMS notifications from us and
        can opt out at any time.
    </div>

        <br>
<button class="btn-lg btn-success" onclick="new_user()" style="margin:0 0 5% 40%;">Sign up</button><br>
or<a href="../index.php"> sign in</a>

</div>

</div>
</form>
    </body>
</html>