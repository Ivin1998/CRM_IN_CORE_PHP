<?php
 date_default_timezone_set('Asia/Calcutta');

include 'connections.php';


if (isset($_POST['update'])) {

    $mod_date=$_POST['mod_date'];
    $user_id = $_GET['user_id'];
    $first_name = $_POST['firstName'];
    $last_name = $_POST['lastName'];
    $mobile_number = $_POST['mobileNumber'];
    $office_number = $_POST['officeNumber'];
    $email_id = $_POST['Email'];
    $instagram_id = $_POST['Instagram'];
    $twitter_id = $_POST['Twitter'];
    $linkedin_id = $_POST['Linkedin)'];
    $facebook_id = $_POST['Facebook)'];

    $sql = "UPDATE contact_information SET first_name='$first_name',last_name='$last_name',
    mobile_number='$mobile_number',office_number='$office_number',email_id='$email_id',instagram_id=' $instagram_id',
    twitter_id='$twitter_id',linkedin_id='$linkedin_id',facebook_id='$facebook_id',mod_date='$mod_date' where user_id='$user_id'";

    $result = $con->query($sql);


    if ($result == TRUE) {
        echo "Record updated Successfully";
    } else {
        echo "Error:" . $sql . "<br>" . $con->error;
    }
}
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    $sql = "SELECT * FROM contact_information WHERE user_id= '$user_id'";
    $result = mysqli_query($con, $sql);
    if ($result->num_rows > 0) {
        while ($rows = $result->fetch_assoc()) {

            $first_name = $rows['first_name'];
            $last_name = $rows['last_name'];
            $mobile_number = $rows['mobile_number'];
            $office_number = $rows['office_number'];
            $email_id = $rows['email_id'];
            $instagram_id = $rows['instagram_id'];
            $twitter_id = $rows['twitter_id'];
            $linkedin_id = $rows['linkedin_id'];
            $facebook_id = $rows['facebook_id'];
        }
        ?>
        <h2>Edit</h2>
        <form action="" method="POST">

            First Name:<input type="text" name="first_name" value="<?php echo $first_name; ?>">
            Last Name:<input type="text" name="last_name" value="<?php echo $last_name; ?>">
            Mobile Number:<input type="text" name="mobile_number" value="<?php echo $mobile_number; ?>">
            Office Number:<input type="text" name="office_number" value="<?php echo $office_number; ?>">
            Email Id:<input type="text" name="email_id" value="<?php echo $email_id; ?>">
            Instagram Id:<input type="text" name="instagram_id" value="<?php echo $instagram_id; ?>">
            Twitter Handle:<input type="text" name="twitter_id" value="<?php echo $twitter_id; ?>">
            LinkedIn profile:<input type="text" name="linkedin_id" value="<?php echo $linkedin_id; ?>">
            Facebook_Id:<input type="text" name="facebook_id" value="<?php echo $facebook_id; ?>">
            <input type="hidden" name="mod_date" value="<?php echo date('Y-m-d H:i:s')?>">
            <input type="submit" value="update" name="update" />

        </form>
        <?php
    } else {

    }

}
?>