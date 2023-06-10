<?php

// koneksi database
include 'Database.php';

class Functions extends Database {
    
    // method untuk login
    public function login($username,$password) {
        $sql = "SELECT * FROM admin WHERE username= :username";
        $data = [
            ":username" => htmlspecialchars($username)
        ];
        $stmt = $this->db()->prepare($sql);
        $stmt->execute($data);

        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        if($admin) {
            if(password_verify($password, $admin["password"]))   {
                return array('success' => $admin["nama"]);
            } else {
                return array('success' => false, 'fail' => "Wrong password!");
            }
        } else {
            return array('success' => false, 'fail' => "Admin not found in database!");
        }
    }
}