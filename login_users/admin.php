<?php
include '../database/connections.php';
include '../header.php';
include '../static_bar.php';
$user_id = $_SESSION['user_id'];
$is_admin = $_SESSION['is_admin'];
$is_approved = $_SESSION['is_approved'];
?>
<html>
<div class="container">
    <table border="1" padding=15 class="table table-striped table-hover" style="width:80%">
        <thead>
            <h1 class="page-header">Users List</h1>

            <tr>
                <td style="text-align:center"><B>First Name</B></td>
                <td style="text-align:center"><B>Last Name</B></td>
                <td style="text-align:center"><B>Email</B></td>
                <td style="padding-left: 8%;"><B>Actions</B></td>
                <td><B>Status</B></td>
            </tr>
        </thead>
        <?php
        $query = "SELECT * FROM users";
        $result = mysqli_query($con, $query);
        while ($rows = mysqli_fetch_assoc($result)) {

            $is_approved = $rows['is_approved'];
            $user_id = $rows['user_id'];
            ?>
            <tr>
                <td>
                    <?php echo $rows['first_name'] ?>
                </td>
                <td>
                    <?php echo $rows['last_name'] ?>
                </td>
                <td>
                    <?php echo $rows['email'] ?>
                </td>
                <td><a class="btn btn-success" style="" id="approve_<?php echo $user_id ?>"
                        onclick="approve(<?php echo $rows['user_id'] ?>,1)">Approve</a>
                    <a class="btn btn-danger" id="disapprove_<?php echo $user_id ?>"
                        onclick="approve(<?php echo $rows['user_id'] ?>,2)">Disapprove</a>
                </td>
                <td>
                    <?php
                    switch ($is_approved) {
                        case 1:
                            echo "<p style=color:green>Active</p>";
                            break;
                        case 0:
                            echo "<p style=color:red>Inactive</p>";
                            break;
                    }
                    ?>
                </td>
            </tr>
            <script>
                $(document).ready(function () {
                    $('.approvals').addClass('active');
                    <?php if ($is_approved == 1) { ?>
                        $('#approve_<?php echo $user_id ?>').attr("disabled", true).css("pointer-events", "none");
                        $('#disapprove_<?php echo $user_id ?>').attr("disabled", false);
                    <?php } else if ($is_approved == 0) { ?>
                            $('#approve_<?php echo $user_id ?>').attr('disabled', false);
                            $('#disapprove_<?php echo $user_id ?>').attr("disabled", true).css("pointer-events", "none");
                    <?php } ?>
                });

            </script>

            <?php
        } ?>

    </table>
</div>



</html>