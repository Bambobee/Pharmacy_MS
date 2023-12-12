<?php
include('../config/Database.php');
include('function.php');
if (isset($_POST["user_id"])) {
    $output = array();
    $statement = $conn->prepare(
        "SELECT * FROM tbl_medicine 
  WHERE id = '" . $_POST["user_id"] . "' 
  LIMIT 1"
    );
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        $output["name"] = $row["name"];
        $output["description"] = $row["description"];
        $output["price"] = $row["price"];
        $output["category"] = $row["category"];
        $output["date"] = $row["date"];
        $output["active"] = $row["active"];
        $output["featured"] = $row["featured"];
        if ($row["image"] != '') {
            $output['user_image'] = '<img src="Medicine_images/' . $row["image"] . '" class="img-thumbnail" width="120" height="90" />
            <input type="hidden" name="hidden_user_image" value="' . $row["image"] . '" />';
        } else {
            $output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';
        }
    }
    echo json_encode($output);
}
