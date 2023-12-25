<?php 
    require ("connection.php");
    if($con) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $json = file_get_contents('php://input');
            $data = json_decode($json);

            $email = $data->email;
            $password = MD5($data->password);
            
            $sql = "SELECT * FROM user WHERE email = $email AND password = $password";
            $result = $con->query($sql);
            
            if ($result->num_rows > 0) {
                $response["success"] = true;
                $response["message"] = "Login successful";
                $response["token"] = generateToken();
                
            } else {
                $response["success"] = false;
                $response["message"] = "Login failed";
            }
            
            echo json_encode($response);
            $conn->close();
            
        } else {
            echo "Unsupported request";
        }
    } else {
        echo "Error Connecting";
    }
    
    function generateToken() {
        $token = bin2hex(random_bytes(32));
        return $token;
    }
?>