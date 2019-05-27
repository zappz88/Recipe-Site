<?php

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
        if (!filter_has_var(INPUT_POST, 'userEmail') && !isset($_POST['userEmail']) && empty($_POST['userEmail'])) {
            echo json_encode(htmlspecialchars('Email is not set'));
        } else {
            $userName = filter_var($_POST['userName'], FILTER_SANITIZE_STRING);
            $userPassword = filter_var($_POST['userPassword'], FILTER_SANITIZE_STRING);
            $userEmail = filter_var($_POST['userEmail'], FILTER_SANITIZE_EMAIL);

            if (filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
                $conn = new mysqli($dbServerName, $dbUserName, $dbPassword, $dbName);
                if ($conn->connect_error) {
                    die(json_encode(htmlspecialchars('Connection failed: ' . $conn->connect_error)));
                    $conn->close();
                } else {
                    $sql = "Select * from Users where UserName = '$userName' and Password = '$userPassword' and Email = '$userEmail';";
                    $result = $conn->query($sql);
                    if ($result->num_rows !== 0) {
                        echo json_encode(htmlspecialchars('User already exists'));
                    } else {
                        $conn->query("Insert into Users(UserName, Password, Email) Values('$userName', '$userPassword', '$userEmail');");
                        echo json_encode(htmlspecialchars('Registered successfully'));
                        $conn->close();
                    }
                }
            } else {
                echo json_encode(htmlspecialchars('Email not valid'));
            }
        }
    }
}
?>