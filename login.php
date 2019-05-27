<?php

class Response {

    public function __construct($status, $userName, $userPassword, $message) {
        $this->status = $status;
        $this->userName = $userName;
        $this->userPassword = $userPassword;
        $this->message = $message;
    }

}

$dbServerName = 'localhost';
$dbUserName = 'root';
$dbPassword = '';
$dbName = 'FoodBug';

if (!filter_has_var(INPUT_POST, 'userName') && !isset($_POST['userName']) && empty($_POST['userName'])) {
    echo json_encode(htmlspecialchars('Username is not set'));
} else {
    if (!filter_has_var(INPUT_POST, 'userPassword') && !isset($_POST['userPassword']) && empty($_POST['userPassword'])) {
        echo json_encode(htmlspecialchars('Password is not set'));
    } else {

        $userName = filter_var($_POST['userName'], FILTER_SANITIZE_STRING);
        $userPassword = filter_var($_POST['userPassword'], FILTER_SANITIZE_STRING);


        $conn = new mysqli($dbServerName, $dbUserName, $dbPassword, $dbName);
        if ($conn->connect_error) {
            die(htmlspecialchars('Connection failed: ' . $conn->connect_error));
            $conn->close();
        } else {
            $sql = "Select * from Users where UserName = '$userName' and Password = '$userPassword';";
            $result = $conn->query($sql);

            if ($result->num_rows !== 0) {
                $response = new Response(true, $userName, $userPassword, 'Logged In');
                print_r(json_encode($response));
                $conn->close();
            } else {
                echo json_encode(htmlspecialchars('Username/password incorrect'));
                $conn->close();
            }
        }
    }
}
?>