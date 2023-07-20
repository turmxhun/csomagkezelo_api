<?php

require 'config.php';
require 'User.php';

$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("Sikertelen kapcsolódás az adatbázishoz: " . $conn->connect_error);
}

$user = new User($conn);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $users = $user->getAllUsers();

    header('Content-Type: application/json');
    echo json_encode($users);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {




    if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email_address']) && isset($_POST['password'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email_address = $_POST['email_address'];
        $password = $_POST['password'];
        if(empty($_POST['phone_number']))
        {
            $phone_number = null;
        }
        else{
            $phone_number = $_POST['phone_number'];
        }

        $newUser = $user->addUser($first_name, $last_name, $email_address, $password, $phone_number);

        if ($newUser) {
            header('Content-Type: application/json');
            echo json_encode($newUser);
            exit;
        } else {
            $response = array(
                "error" => "Hiba történt a felhasználó hozzáadása során."
            );

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
    } else {
        $response = array(
            "error" => "Hiányzó adatok a POST kérésben."
        );

        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}

$conn->close();
?>