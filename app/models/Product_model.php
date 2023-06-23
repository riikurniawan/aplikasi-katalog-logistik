<?php

class Product_model extends Database
{
    private $table = 'produk';

    public function read()
    {
        $stmt = $this->db()->prepare("SELECT * FROM " . $this->table . " ORDER BY `id_produk` DESC");
        $stmt->execute();
        $numRow = $stmt->rowCount();
        if ($numRow > 0) {
            // produk array
            $out['data'] = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $produk_item = array(
                    'id_produk' => $id_produk,
                    'nama' => $nama,
                    'deskripsi' => $deskripsi,
                    'harga' => $harga,
                    'status_publikasi' => $status_publikasi,
                    'bobot_pengiriman' => $bobot_pengiriman,
                    'gambar' => $gambar,
                    'jangkauan_pengiriman' => $jangkauan_pengiriman,
                    'lama_pengiriman' => $lama_pengiriman,
                    'pembuat' => $pembuat
                );

                // push to "data"
                array_push($out['data'], $produk_item);
            }
            return $out;
        } else {
            $out['data'] = [];
            return $out;
        }
    }
    public function show($id)
    {
        $stmt = $this->db()->prepare("SELECT * FROM " . $this->table . " WHERE id_produk = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $numRow = $stmt->rowCount();
        if ($numRow > 0) {

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $out['data'] = array(
                    'id_produk' => $id_produk,
                    'nama' => $nama,
                    'deskripsi' => $deskripsi,
                    'harga' => $harga,
                    'status_publikasi' => $status_publikasi,
                    'bobot_pengiriman' => $bobot_pengiriman,
                    'gambar' => $gambar,
                    'jangkauan_pengiriman' => $jangkauan_pengiriman,
                    'lama_pengiriman' => $lama_pengiriman,
                    'pembuat' => $pembuat
                );
            }
            return $out;
        } else {
            $out['data'] = [];
            return $out;
        }
    }

    public function create($data)
    {
        // // query 
        // $query = "INSERT INTO " . $this->table . " VALUES (:id_produk, :nama, :deskripsi, :harga, :status_publikasi, :bobot_pengiriman, :gambar, :jangkauan_pengiriman, :lama_pengiriman, :pembuat)";

        // // prepare statement
        // $stmt = $this->db()->prepare($query);

        // $data = [
        //     ':id_produk' => $this->generateKode(),
        //     ':nama' => $data['nama'],
        //     ':deskripsi' => $data['deskripsi'],
        //     ':harga' => $data['harga'],
        //     ':status_publikasi' => $data['status_publikasi'],
        //     ':bobot_pengiriman' => $data['bobot_pengiriman'],
        //     ':gambar' => $data['gambar'],
        //     ':jangkauan_pengiriman' => $data['jangkauan_pengiriman'],
        //     ':lama_pengiriman' => $data['lama_pengiriman'],
        //     ':pembuat' => $data['pembuat']
        // ];

        // // execute query
        // if ($stmt->execute($data)) {
        //     $out = [
        //         'message' => 'New product added',
        //     ];
        //     return $out;
        // } else {
        //     $out = [
        //         'message' => 'Oops! something wrong',
        //         'error' => true
        //     ];
        //     return $out;
        // }
        $out = [
            'message' => 'Oops! something wrong',
            'error' => true
        ];
        return $out;
    }
    public function generateKode()
    {
        // query 
        $query = 'SELECT max(id_produk) as kodeTerbesar FROM ' . $this->table;

        // prepare statement
        $stmt = $this->db()->prepare($query);

        // execute query
        $stmt->execute();
        $produk = $stmt->fetch(PDO::FETCH_ASSOC);

        $kodeProduk = $produk['kodeTerbesar'];

        $urutan = (int) substr($kodeProduk, 4, 3);
        $urutan++;

        $huruf = "PROD";
        $kodeProduk = $huruf . sprintf("%03s", $urutan);

        return $kodeProduk;
    }
}
