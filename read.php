<?php
    require ("connection.php");
    if($con) {
        $sql = "SELECT * FROM user";
        $result = $con->query($sql);
        $response = array();
        
        while($row = $result->fetch_assoc()) {
            $response[] = $row;
        }
        echo json_encode($response);
    } else {
        echo "Error Connecting";
    }

?>