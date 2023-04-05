<?php
include '../database/connections.php';
?>
<html>

<head>
    <link rel="stylesheet" href="../assets/bootstrapmin.css" />
    <link rel="stylesheet" href="../assets/formbootstrap.css">
    <link rel="stylesheet" href="../assets/styles.css">
    <script type="text/javascript" src="../assets/jquery.js"></script>
    <script type="text/javascript" src="../assets/bootstrap.bundle.min.js"></script>
</head>
<div class="accordion accordion-flush" id="accordionFlushExample">
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                <?php
                if ($_POST['type'] == 1) { ?>
                    <h4>View States</h4>
                    <?php
                } ?>
                <?php
                if ($_POST['type'] == 2) { ?>
                    <h4>View Cities</h4>
                <?php }
                ?>
            </button>
        </h2>
        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <?php
                if ($_POST['type'] == 1) {

                    if (isset($_POST['id'])) {
                        $output = '';
                        $query = "SELECT a.name AS country_name, b.*
                            FROM contacts.countries a 
                            INNER JOIN contacts.states b ON b.country_id = a.id 
                            WHERE b.country_id = '" . $_POST["id"] . "'";
                        $result = mysqli_query($con, $query);
                        $output .=
                            $last_country = '
                        <div class="accordion">  
                        <div class="panel">';
                        while ($row = mysqli_fetch_assoc($result)) {
                            $country_name = $row["country_name"];
                            $name = $row["name"];

                            if ($last_country !== $country_name) {
                                $output .= '<div>' . '<h3>States in ' . $country_name . '</h3><br></div>';
                                $last_country = $country_name;
                            }
                            $output .= '
                        <ul> 
                        <li>' . $name . '</li>  </ul> ';
                        }
                        $output .= '
                    </table>
                    </div>
                    ';
                        echo $output;
                    }
                }
                ;

                if ($_POST['type'] == 2) {
                    if (isset($_POST['id'])) {
                        $output = '';
                        $query = "SELECT a.name AS state_name, b.name FROM contacts.states a inner join
                        contacts.cities b on a.id= b.state_id WHERE b.state_id='" . $_POST["id"] . "'";

                        $result = mysqli_query($con, $query);
                        $output .=
                            $last_state = '
                            <div class="table-responsive">  
                            <table class="table table-bordered">';
                        while ($row = mysqli_fetch_array($result)) {
                            $state_name = $row['state_name'];
                            $name = $row['name'];

                            if ($last_state !== $state_name) {
                                $output .= '<div>' . '<h3>Cities in ' . $state_name . '</h3<br></div>';
                                $last_state = $state_name;
                            }
                            $output .= '
                            <ul>  
                            <li>' . $name . '</li> </ul>';
                        }
                        $output .= '
                            </table>
                            </div>
                            ';
                        echo $output;
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>

</html>