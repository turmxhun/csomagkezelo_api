<?php
class User {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllUsers() {
        $sql = "SELECT id, first_name, last_name, email_address, phone_number FROM users";
        $result = $this->conn->query($sql);

        $users = array();
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }

        return $users;
    }

    public function addUser($first_name, $last_name, $email_address, $password, $phone_number) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (first_name, last_name, email_address, password, phone_number)
                VALUES ('$first_name', '$last_name', '$email_address', '$hashed_password', ";
        $sql .= $phone_number !== null ? "'$phone_number')" : "NULL)";


        if ($this->conn->query($sql) === true) {
            $user_id = $this->conn->insert_id;
            $user = array(
                "id" => $user_id,
                "first_name" => $first_name,
                "last_name" => $last_name,
                "email_address" => $email_address,
                "phone_number" => $phone_number
            );

            return $user;
        } else {
            return null; 
        }
    }
}
?>