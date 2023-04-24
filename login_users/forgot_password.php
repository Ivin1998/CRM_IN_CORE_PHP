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
<h1 style="color:blue"><B>Find my account</B></h1>
<form id="new_user" style="padding:15px" class="login"  method="POST">
<h4>Please enter your email address to reset password for your account.</h4>
    <input type="text" placeholder="Enter your email address" name="email" class="form-control"
        style="width:86%; padding-top:15;margin: 35;">
        <br>
<button class="btn-lg btn-success" onclick="" style="margin:0 0 5% 40%;">Send</button><br>
or<a href="../index.php"> sign in</a>

</div>

</div>
</form>
    </body>
</html>