<?php
require_once 'config.php';
require_once 'Parcel.php';

$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("Sikertelen kapcsolódás az adatbázishoz: " . $conn->connect_error);
}

$parcel = new Parcel($conn);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['parcel_number'])) {
        $parcel_number = $_GET['parcel_number'];

        $parcelData = $parcel->getParcelByNumber($parcel_number);

        if ($parcelData) {
            header('Content-Type: application/json');
            echo json_encode($parcelData);
        } else {
            echo "Nincs ilyen csomag az adatbázisban.";
        }
    } else {
        echo "Hibás kérés: hiányzó csomagszám paraméter.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if (isset($_POST['size']) && isset($_POST['user_id'])) {
        $size = $_POST['size'];
        $user_id = $_POST['user_id'];

        $userExists = $conn->query("SELECT id FROM users WHERE id = $user_id")->num_rows > 0;

        if (!$userExists) {
            $response = array(
                "error" => "A megadott felhasználói azonosító nem létezik az adatbázisban."
            );

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
        $newParcel = $parcel->addParcel($size, $user_id);

        if ($newParcel) {
            header('Content-Type: application/json');
            echo json_encode($newParcel);
        } else {
            $response = array(
                "error" => "Hiba történt a csomag hozzáadása során."
            );

            header('Content-Type: application/json');
            echo json_encode($response);
        }
    } else {
        $response = array(
            "error" => "Hiányzó adatok a POST kérésben."
        );

        header('Content-Type: application/json');
        echo json_encode($response);
    }
}

$conn->close();
?>
