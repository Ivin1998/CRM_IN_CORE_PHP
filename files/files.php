<?php
include '../database/connections.php';
include '../header.php';
include '../static_bar.php';
$user_id = $_SESSION['user_id'];
$is_admin = $_SESSION['is_admin'];
?>
<html>
<head>
    <title>Files</title>
</head>
<body>
    <div class="content"><br>
        <form style="width:30%" id="myInput_upload" method="post" style="text-decoration: none;"
            enctype="multipart/form-data">
            <input type="file" name="the_file[]" multiple><br>
            <input type="submit" name="submit" value="Upload" multiple="multiple" /> <br>
            <input type="hidden" name="created_date" value="<?php echo date('Y-m-d H:i:s') ?>" />
        </form>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Preview</h5>
                        <div class="col col-sm-12">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                    </div>
                    <div class="modal-body-view">
                        <img class="previewImage" style="max-width: 100%;max-height: 100%;" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal for full screen-->
        <div class="modal fade" id="myModal_click" tabindex="-1" role="dialog" aria-labelledby="myModal_click"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <a class="back" data-dismiss="modal" style="text-decoration:none;">Back</a>

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Preview</h5>
                        <div class="col col-sm-12">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                    </div>
                    <div class="modal-body">
                        <img class="previewImage_click" style="max-width: 100%;max-height: 100%;" ;>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>
        <br>
        <table class="table-bordered" style="width:50%">
            <thead>
                <tr>
                    <th style="text-align:center"> Sl.no.</th>
                    <th style="text-align:center"> File Name</th>
                    <th style="text-align:center"> Actions</th>

                </tr>
            </thead>
            <?php
            if($is_admin==1){
                $file = "SELECT * FROM files";
            }
            else{
                $file = "SELECT * FROM files WHERE user_id='$user_id'";
            }
          

            $result = mysqli_query($con, $file);
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                $fileName = $row['file_name'];
                ?>
                <tr>
                    <td>
                        <?php echo $no++; ?>
                    </td>
                    <td>
                        <?php echo "<a href='#' style=text-decoration:none; data-toggle='modal' data-target='#myModal_click' data-file='upload_files/$fileName'>" . $fileName . "</a>" ?>
                    </td>
                    <td>
                        <?php echo "<a href='#' data-toggle='modal' data-target='#myModal' data-file='upload_files/$fileName'>" . '<i title="View the file" class="fa fa-eye eye-icon btn-lg"></i>' . "</a>" ?>
                        <?php echo "<a href='upload_files/$fileName' download>" . '<i title="download the file" class="fa fa-download"></i>' . "</a>" ?></a>
                    </td>
                </tr>
                <?php
            } ?>
        </table>
    </div>
    <script>
        $(document).ready(function () {
            $('#myInput_upload').submit(function (event) {
                event.preventDefault();
                var formdata = new FormData(this);
                $.ajax({
                    url: "uploadscript.php",
                    type: "POST",
                    dataType: 'json',
                    data: formdata,
                    processData: false, //to prevent it from converting into query string
                    contentType: false, //to prevent from the default content type
                    success: function (data) {
                        for (var key in data) {   // for...in loop to iterate over each key in the "data" object.
                            if (data[key].result == 1) {

                                swal.fire({
                                    text: "" + data[key].msg + "",
                                    icon: "error",
                                });
                            } else if (data[key].result == 0) {
                                swal.fire({
                                    text: "" + data[key].msg + "",
                                    icon: "success",
                                });
                                location.reload();
                            }
                        }

                    },
                });
            });
            $('#myModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var filePath = button.data('file');

                fileExtension = filePath.replace(/^.*\./, '');
                if (fileExtension == 'jpg' || fileExtension == 'png') {
                    var image = $('.previewImage');
                    image.attr('src', filePath);
                    $('.previewVideo').replaceWith($('<img>', {
                        addClass: 'previewImage',
                        src: filePath,
                        style: 'width:100%'
                    }));

                }
                else if (fileExtension == 'mp4' || fileExtension == 'pdf' || fileExtension == 'xlsx' || fileExtension == 'docx') {
                    var image = $('.previewImage');
                    $(image).addClass('previewVideo');
                    image.attr('src', filePath);
                    $('.previewVideo').replaceWith($('<iframe>', {
                        addClass: 'previewVideo',
                        src: filePath,
                    }));

                }
            });
            $('#myModal_click').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var filePath = button.data('file');

                fileExtension = filePath.replace(/^.*\./, '');
                if (fileExtension == 'jpg' || fileExtension == 'png') {
                    var image = $('.previewImage_click');
                    image.attr('src', filePath);
                    $('.previewVideo_click').replaceWith($('<img>', {
                        addClass: 'previewImage_click',
                        src: filePath,
                        style: 'width:100%'
                    }));

                }
                else if (fileExtension == 'mp4' || fileExtension == 'pdf' || fileExtension == 'xlsx' || fileExtension == 'docx') {
                    var image = $('.previewImage_click');
                    $(image).addClass('previewVideo_click');
                    image.attr('src', filePath);
                    $('.previewVideo_click').replaceWith($('<iframe>', {
                        addClass: 'previewVideo_click',
                        src: filePath,
                        style: 'width:100%; height:100% ;'

                    }));

                }
            });
        });
        $(document).ready(function () {
            $('.sidebar a').removeClass('active');
            $('.files').addClass('active');
        })
    </script>
</body>
</html>