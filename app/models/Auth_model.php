<?php

class Auth_model extends Database
{
    private $table = 'admin';

    public function login($data)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE username = :username";
        $stmt = $this->db()->prepare($sql);
        $stmt->bindValue(':username', $data['username']);
        $stmt->execute();
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($admin) {
            if (password_verify($data['password'], $admin['password'])) {
                $out = [
                    'message' => 'login successful',
                    'data' => [
                        'username' => $admin['username'],
                        'name' => $admin['nama']
                    ]
                ];
                return $out;
            } else {
                $out = [
                    'message' => 'Wrong password! Try again..',
                    'error' => true
                ];
                return $out;
            }
        } else {
            $out = [
                'message' => 'Oops! Admin not found..',
                'error' => true
            ];
            return $out;
        }
    }
}
