<?php
if (!empty($_POST["id"])) {

    include '../database/connections.php';

    $query = $con->query("SELECT COUNT(*) as num_rows FROM countries WHERE id < " . $_POST['id'] . " ORDER BY id DESC");
    $row = $query->fetch_assoc();
    $totalRowCount = $row['num_rows'];
    $showLimit = 5;



    $query = $con->query("SELECT * FROM countries WHERE id < " . $_POST['id'] . " ORDER BY id DESC LIMIT $showLimit");



    if ($query->num_rows > 0) {
        while ($row = $query->fetch_assoc()) {
            $postID = $row['id'];
            ?>

                <tr>
                    <td>
                        <?php echo $row['name'] ?>
                    </td>
                </tr>
            <?php } ?>

            <?php if ($totalRowCount > $showLimit) { ?>
                <tr>
                    <td class="show_more_main" id="show_more_main<?php echo $postID; ?>">
                    <br><span id="<?php echo $postID; ?>" class="show_more" style="background-color:#c3c3d3"; title="Load more posts">Show more</span>
                        <span class="loding" style="display: none;"><span class="loading_txt">Loading...</span></span>
                    </td>
                    
                </tr>
        <?php } ?>


        <?php
    }
}
?>