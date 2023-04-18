<?php
include '../database/connections.php';
include '../header.php';
include '../static_bar.php';
$user_id = $_SESSION['user_id'];
?>

<html>
<title>Dashboard</title>
<body>
<div class="content">
<div class="col col-sm-12" style="padding:10%">
<a href="../contacts/contacts.php" class="btn btn-primary btn-lg" style="padding:8%;margin:10;width:25%">Contacts
<?php
$query="SELECT COUNT(*) AS records_count FROM contacts WHERE is_deleted=0 AND user_id='$user_id'";
$result=mysqli_query($con,$query);
$contacts_count = mysqli_fetch_assoc($result);
$total_count=$contacts_count['records_count'];
echo "<span class=badge>".$total_count."</span>" ?>
</a>

<a href="../departments/departments.php" class="btn btn-primary btn-lg" style="padding:8%;margin:10;width:25%">Departments
<?php
$query="SELECT COUNT(*) AS records_count FROM department";
$result=mysqli_query($con,$query);
$department_count = mysqli_fetch_assoc($result);
$total_count=$department_count['records_count'];
echo "<span class=badge>".$total_count."</span>" ?>

</a>
<a href="../files/files.php" class="btn btn-primary btn-lg" style="padding:8%;margin:10;width:25%">Files
<?php
$query="SELECT COUNT(*) AS records_count FROM files WHERE user_id='$user_id'";
$result=mysqli_query($con,$query);
$files_count = mysqli_fetch_assoc($result);
$total_count=$files_count['records_count'];
echo "<span class=badge>".$total_count."</span>" ?>

</a>
    </div>
    </div>
</body>
<script>
    $(document).ready(function () {
        $('.sidebar a').removeClass('active');
        $('.home').addClass('active');
    });
</script>

</html>