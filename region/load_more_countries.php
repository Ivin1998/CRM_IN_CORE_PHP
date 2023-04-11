<?php
$html = '';
if (!empty($_POST["id"])) {

    include '../database/connections.php';
    $query = $con->query("SELECT COUNT(*) as num_rows FROM countries WHERE id < " . $_POST['id'] . " ORDER BY id DESC");
    $row = $query->fetch_assoc();
    $totalRowCount = $row['num_rows'];
    $showLimit = 5;

    $query = $con->query("SELECT * FROM countries WHERE is_deleted=0 AND id < " . $_POST['id'] . " ORDER BY id DESC LIMIT $showLimit");

    if ($query->num_rows > 0) {
        while ($row = $query->fetch_assoc()) {
            $postID = $row['id'];
            $name = $row['name'];
            $html .= '<tr>
                        <td>' . $name . '</td>
                        <td> <a class="btn-lg eye-icon" onclick="view_region(' . $postID . ',1)"><i
                                                class="fa fa-eye" data-toggle="modal" data-target="#myModal"></i></a>
                            <a class=" btn-lg edit_icon" onclick="edit_region(' . $postID . ',1)"> <i
                                                class="fa fa-edit"data-toggle="modal" data-target="#myModal"></i></a>
                            <a class="btn btn-lg delete-icon" onclick="check_region_Delete(' . $postID . ',1);"><i
                                                class="fa fa-trash"></i></a></td>

                    </tr>';

        } ?>

        <?php
    }
}
echo json_encode(array("status" => "success", "html" => $html, "lastid" => $postID));
?>