<?php
include '../database/connections.php';
include '../header.php';
include '../static_bar.php';
?>
<html>
<title>Cities</title>
<div class="content">
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="col col-sm-4" id="modal-title">
                    <h5>Edit City</h5>
                </div>
                <div class="modal-body">
                    <form id="country_name">
                        City Name: <input type="text" id="name" name="name" class="form-control" /><br><br>
                        <input type="hidden" name="id" id="id" />
                        <button id="add_button" class="btn btn-primary form-control" onclick="add_region(3)"
                            type="button">Add</button>
                        <button id="update_button" class="btn btn-primary form-control" type="button"
                            onclick="update_region(3)">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- City -->
    <h1 class="page-header">Cities</h1>
    <div class="region_table">
        <button class="btn btn-primary city_name" id="add_city" data-toggle="modal" data-target="#myModal"
            style="margin: 10 10 5 700;">Add city</button>

        <div>

            <div class=" region_table">

                <table border="1" padding=15 class="table table-striped table-hover">


                    <tr>
                        <th style="text-align: left;"> Name</th>
                        <th style="text-align: left;"> Actions</th>
                    </tr>

                    <?php
                    $sql = "SELECT * FROM cities WHERE is_deleted=0 ORDER BY id DESC";
                    $result_city = mysqli_query($con, $sql);

                    while ($rows_city = mysqli_fetch_assoc($result_city)) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $rows_city['name'] ?>
                            </td>
                            <td>
                                <a title="edit the city name" class=" btn-lg edit_icon "
                                    onclick="edit_region(<?php echo $rows_city['id'] ?>,3);" ?><i class="fa fa-edit"
                                        data-toggle="modal" data-target="#myModal"></i></a>
                                <a title="delete this city" class="btn btn-lg delete-icon"
                                    onclick="check_region_Delete(<?php echo $rows_city['id'] ?>,3);"><i
                                        class="fa fa-trash"></i></a>

                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.sidebar a').removeClass('active');
        $('.cities').addClass('active');
    })



</script>

</html>