<?php

class Admin_model extends Database
{
    private $table = 'admin';

    public function update($data)
    {
        $sql = 'UPDATE ' . $this->table . ' SET nama = :nama WHERE username = :username';
        $bindValue = [
            ':nama' => $data['nama'],
            ':username' => $data['username']
        ];
        $stmt = $this->db()->prepare($sql);
        $result = $stmt->execute($bindValue);
        if ($result) {
            $out = [
                'message' => 'Profile updated',
                'data' => [
                    'username' => $data['username'],
                    'name' => $data['nama']
                ]
            ];
            return $out;
        } else {
            $out = [
                'message' => 'Oops! Something wrong',
                'error' => true
            ];
            return $out;
        }
    }

    public function changePassword($data)
    {
        // check username is exist on db
        $query = 'SELECT * FROM ' . $this->table . ' WHERE username = :username';
        $stmt = $this->db()->prepare($query);

        // bind params
        $stmt->bindValue(':username', $data['username']);

        // execute query
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        if ($stmt->rowCount() < 1) {
            $out = [
                'message' => 'Username not found',
                'error' => true
            ];
            return $out;
        } else {
            if (password_verify($data['old_password'], $result->password)) {
                $newPasswordHashed = password_hash($data['new_password'], PASSWORD_DEFAULT);

                // update query
                $query = 'UPDATE ' . $this->table . ' SET password = :password WHERE username = :username';

                // bind params
                $data = [
                    ':username' => $data['username'],
                    ':password' => $newPasswordHashed
                ];

                // prepare statement
                $stmt = $this->db()->prepare($query);

                // execute query
                if ($stmt->execute($data)) {
                    $out = [
                        'message' => 'Password has been updated',
                    ];
                    return $out;
                } else {
                    $out = [
                        'message' => 'Oops! something wrong',
                        'error' => true
                    ];
                    return $out;
                }
            } else {
                $out = [
                    'message' => 'Your old password is wrong',
                    'error' => true
                ];
                return $out;
            }
        }
    }
}
