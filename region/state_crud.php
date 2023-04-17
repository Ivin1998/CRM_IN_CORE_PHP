<?php
include '../database/connections.php';
include '../header.php';
include '../static_bar.php';
?>
<html>
<title>States</title>
<div class="content">
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="col col-sm-4" id="modal-title">
                    <h5>Edit State</h5>
                </div>
                <div class="modal-body">
                    <form id="country_name">
                        State Name: <input type="text" id="name" name="name" class="form-control" /><br><br>
                        <input type="hidden" name="id" id="id" />
                        <button id="update_button" class="btn btn-primary form-control" type="button"
                            onclick="update_region(2)">Update</button>
                        <button id="add_button" class="btn btn-primary form-control" onclick="add_region(2)"
                            type="button">Add</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="reload" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <h1 class="page-header">States</h1>
    <div class=" region_table">
        <button class="btn btn-primary state_name" id="add_state" data-toggle="modal" data-target="#myModal"
            style="margin: 10 10 5 820;">Add State</button>


        <div>
            <div class="region_table">

                <table border="1" padding=15 class="table table-striped table-hover ">

                    <tr>
                        <th style="text-align: left;"> Name</th>
                        <th style="text-align: left;"> Actions</th>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM states WHERE is_deleted=0 ORDER BY id DESC";
                    $result_state = mysqli_query($con, $sql);

                    while ($rows_state = mysqli_fetch_assoc($result_state)) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $rows_state['name'] ?>
                            </td>
                            <td>
                                <a title="view cities of this state" class="btn-lg eye-icon"
                                    onclick="view_region(<?php echo $rows_state['id'] ?>,2)"><i class="fa fa-eye"
                                        data-toggle="modal" data-target="#myModal"></i></a>
                                <a title="edit the state name" class=" btn-lg edit_icon"
                                    onclick="edit_region(<?php echo $rows_state['id'] ?>,2);" ?><i class="fa fa-edit"
                                        data-toggle="modal" data-target="#myModal"></i></a>
                                <a title="delete this state" class="btn btn-lg delete-icon"
                                    onclick="check_region_Delete(<?php echo $rows_state['id'] ?>,2);"><i
                                        class="fa fa-trash"></i></a>

                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                $('.sidebar a').removeClass('active');
                $('.states').addClass('active');
            })
        </script>
        </script>

</html>