<?php

include 'Database.php';

class Functions extends Database {
    public function login($username,$password) {
        // $sql = "SELECT * FROM Admin WHERE Username= :username AND Password= :password";
        $sql = "SELECT * FROM admin WHERE Username= :username";
        $data = [
            ":username" => htmlspecialchars($username)
            // ":password" => htmlspecialchars($password)
        ];
        $stmt = $this->db()->prepare($sql);
        $stmt->execute($data);

        $isAdmin = $stmt->fetch(PDO::FETCH_ASSOC);
        if($isAdmin) {
            if(password_verify($password, $isAdmin["Password"]))   {
                return array('success' => $isAdmin["Name"]);
            } else {
                return array('success' => false, 'fail' => "Wrong password!");
            }
        } else {
            return array('success' => false, 'fail' => "Admin not found in database!");
        }
    }
}