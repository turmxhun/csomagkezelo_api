<?php
class Parcel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getParcelByNumber($parcelNumber) {
        $sql = "SELECT parcels.id, parcels.parcel_number, parcels.size,
                       users.id as user_id, users.first_name, users.last_name,
                       users.email_address, users.phone_number
                FROM parcels
                INNER JOIN users ON parcels.user_id = users.id
                WHERE parcels.parcel_number = '$parcelNumber'";

        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $parcel = array(
                "id" => $row["id"],
                "parcel_number" => $row["parcel_number"],
                "size" => $row["size"],
                "user" => array(
                    "id" => $row["user_id"],
                    "first_name" => $row["first_name"],
                    "last_name" => $row["last_name"],
                    "email_address" => $row["email_address"],
                    "phone_number" => $row["phone_number"]
                )
            );

            return $parcel;
        } else {
            return null;
        }
    }

    public function addParcel($size, $userId) {
        $parcelNumber = $this->generateUniqueParcelNumber();
        $allowedSizes = array('S', 'M', 'L', 'XL');
        if (!in_array($size, $allowedSizes)) {
            return null;
        }
        $sql = "INSERT INTO parcels (parcel_number, size, user_id)
                VALUES ('$parcelNumber', '$size', '$userId')";

        if ($this->conn->query($sql) === true) {
            return $this->getParcelByNumber($parcelNumber);
        } else {
            return null;
        }
    }

    private function generateUniqueParcelNumber() {
        $length = 10;
        $characters = '0123456789ABCDEF';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }
}
?>
