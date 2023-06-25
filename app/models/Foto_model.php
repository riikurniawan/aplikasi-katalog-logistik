<?php

class Foto_model extends Database
{
    private $table = 'foto';

    public function create($data)
    {
        // query 
        $query = "INSERT INTO " . $this->table . " VALUES (:id_produk, :file_foto)";

        // prepare statement
        $stmt = $this->db()->prepare($query);

        $data = [
            ':id_produk' => $data['id_produk'],
            ':file_foto' => $data['file_foto'],
        ];

        // execute query
        if ($stmt->execute($data)) {
            return true;
        } else {
            return false;
        }
    }
    public function update($id, $data)
    {
        // query 
        $query = "INSERT INTO " . $this->table . " VALUES (:id_produk, :file_foto)";

        // prepare statement
        $stmt = $this->db()->prepare($query);

        $data = [
            ':id_produk' => $id,
            ':file_foto' => $data['file_foto'],
        ];

        // execute query
        if ($stmt->execute($data)) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        // query 
        $query = "DELETE FROM " . $this->table . " WHERE `id_produk` = :id_produk";

        // prepare statement
        $stmt = $this->db()->prepare($query);
        $stmt->bindValue(':id_produk', $id);

        // execute query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
