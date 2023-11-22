<?php 
    require ("connection.php");
    if($con) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $json = file_get_contents('php://input');
            $data = json_decode($json);

            $f_name = $data->f_name;
            $l_name = $data->l_name;
            $email = $data->email;
            $phone = $data->phone;
            $address = $data->address;
            $password = MD5($data->password);
            
            $sql = "INSERT INTO user (f_name, l_name, email, phone, address, password) values ('$f_name', '$l_name', '$email', '$phone', '$address', '$password')";
            $result = $con->query($sql);
            
            if($result) {
                echo json_encode($data);
                echo "\nUser created successfully!";
            }
        } else {
            echo "Unsupported request";
        }
    } else {
        echo "Error Connecting";
    }
?>