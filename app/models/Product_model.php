<?php

class Product_model extends Database
{
    private $table = 'produk';

    public function read_v()
    {
        $stmt = $this->db()->prepare("SELECT * FROM " . $this->table . " WHERE `status_publikasi` = 1 ORDER BY `id_produk` DESC");
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

    public function groupByWeight()
    {
        $stmt = $this->db()->prepare("SELECT `bobot_pengiriman` FROM " . $this->table . " GROUP BY `bobot_pengiriman`");
        $stmt->execute();
        $numRow = $stmt->rowCount();
        if ($numRow > 0) {
            // array data
            $out['data'] = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $weightGroup = array(
                    'bobot_pengiriman' => $bobot_pengiriman,
                );

                // push to "data"
                array_push($out['data'], $weightGroup);
            }
            return $out;
        } else {
            $out['data'] = [];
            return $out;
        }
    }
    public function groupByDeliveryArea()
    {
        $stmt = $this->db()->prepare("SELECT `jangkauan_pengiriman` FROM " . $this->table . " GROUP BY `jangkauan_pengiriman`");
        $stmt->execute();
        $numRow = $stmt->rowCount();
        if ($numRow > 0) {
            // array data
            $out['data'] = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $deliveryAreaGroup = array(
                    'jangkauan_pengiriman' => $jangkauan_pengiriman,
                );

                // push to "data"
                array_push($out['data'], $deliveryAreaGroup);
            }
            return $out;
        } else {
            $out['data'] = [];
            return $out;
        }
    }

    public function groupByWeight_v()
    {
        $stmt = $this->db()->prepare("SELECT `bobot_pengiriman` FROM " . $this->table . " WHERE `status_publikasi` = 1 GROUP BY `bobot_pengiriman`");
        $stmt->execute();
        $numRow = $stmt->rowCount();
        if ($numRow > 0) {
            // array data
            $out['data'] = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $weightGroup = array(
                    'bobot_pengiriman' => $bobot_pengiriman,
                );

                // push to "data"
                array_push($out['data'], $weightGroup);
            }
            return $out;
        } else {
            $out['data'] = [];
            return $out;
        }
    }
    public function groupByDeliveryArea_v()
    {
        $stmt = $this->db()->prepare("SELECT `jangkauan_pengiriman` FROM " . $this->table . " WHERE `status_publikasi` = 1 GROUP BY `jangkauan_pengiriman`");
        $stmt->execute();
        $numRow = $stmt->rowCount();
        if ($numRow > 0) {
            // array data
            $out['data'] = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $deliveryAreaGroup = array(
                    'jangkauan_pengiriman' => $jangkauan_pengiriman,
                );

                // push to "data"
                array_push($out['data'], $deliveryAreaGroup);
            }
            return $out;
        } else {
            $out['data'] = [];
            return $out;
        }
    }

    public function filterProducts_v($data)
    {
        if ($data['delivery_area'] != null && $data['weight'] != null) {
            $stmt = $this->db()->prepare("SELECT * FROM " . $this->table . " WHERE `status_publikasi` = 1 AND (`jangkauan_pengiriman` = :delivery_area AND `bobot_pengiriman` = :weight)");
            $stmt->bindValue(':delivery_area', $data['delivery_area']);
            $stmt->bindValue(':weight', $data['weight']);

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
        } else if ($data['delivery_area'] != null && $data['weight'] == null) {
            $stmt = $this->db()->prepare("SELECT * FROM " . $this->table . " WHERE `status_publikasi` = 1 AND `jangkauan_pengiriman` = :delivery_area");
            $stmt->bindValue(':delivery_area', $data['delivery_area']);

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
        } else if ($data['delivery_area'] == null && $data['weight'] != null) {
            $stmt = $this->db()->prepare("SELECT * FROM " . $this->table . " WHERE `status_publikasi` = 1 AND `bobot_pengiriman` = :weight");
            $stmt->bindValue(':weight', $data['weight']);

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
        } else {
            $out['data'] = [];
            return $out;
        }
    }
    public function filterProducts($data)
    {
        if ($data['delivery_area'] != null && $data['weight'] != null) {
            $stmt = $this->db()->prepare("SELECT * FROM " . $this->table . " WHERE `jangkauan_pengiriman` = :delivery_area AND `bobot_pengiriman` = :weight");
            $stmt->bindValue(':delivery_area', $data['delivery_area']);
            $stmt->bindValue(':weight', $data['weight']);

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
        } else if ($data['delivery_area'] != null && $data['weight'] == null) {
            $stmt = $this->db()->prepare("SELECT * FROM " . $this->table . " WHERE `jangkauan_pengiriman` = :delivery_area");
            $stmt->bindValue(':delivery_area', $data['delivery_area']);

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
        } else if ($data['delivery_area'] == null && $data['weight'] != null) {
            $stmt = $this->db()->prepare("SELECT * FROM " . $this->table . " WHERE `bobot_pengiriman` = :weight");
            $stmt->bindValue(':weight', $data['weight']);

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
        } else {
            $out['data'] = [];
            return $out;
        }
    }

    public function create($data)
    {
        // query 
        $query = "INSERT INTO " . $this->table . " VALUES (:id_produk, :nama, :deskripsi, :harga, :status_publikasi, :bobot_pengiriman, :gambar, :jangkauan_pengiriman, :lama_pengiriman, :pembuat)";

        // prepare statement
        $stmt = $this->db()->prepare($query);

        $data = [
            ':id_produk' => $this->generateKode(),
            ':nama' => $data['nama'],
            ':deskripsi' => $data['deskripsi'],
            ':harga' => $data['harga'],
            ':status_publikasi' => $data['status_publikasi'],
            ':bobot_pengiriman' => $data['bobot_pengiriman'],
            ':gambar' => $data['gambar'],
            ':jangkauan_pengiriman' => $data['jangkauan_pengiriman'],
            ':lama_pengiriman' => $data['lama_pengiriman'],
            ':pembuat' => $data['pembuat']
        ];

        // execute query
        if ($stmt->execute($data)) {
            $out = [
                'message' => 'New product added',
            ];
            return $out;
        } else {
            $out = [
                'message' => 'Oops! something wrong',
                'error' => true
            ];
            return $out;
        }
    }

    public function update($id, $data, $img = null)
    {
        if ($img == null) {
            $stmt = $this->db()->prepare("UPDATE " . $this->table .
                " SET nama = :nama, deskripsi = :deskripsi, harga = :harga, status_publikasi = :status_publikasi, bobot_pengiriman = :bobot_pengiriman, jangkauan_pengiriman = :jangkauan_pengiriman, lama_pengiriman = :lama_pengiriman " .
                " WHERE id_produk = :id");
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':nama', $data['nama']);
            $stmt->bindValue(':deskripsi', $data['deskripsi']);
            $stmt->bindValue(':harga', $data['harga']);
            $stmt->bindValue(':status_publikasi', $data['status_publikasi']);
            $stmt->bindValue(':bobot_pengiriman', $data['bobot_pengiriman']);
            $stmt->bindValue(':jangkauan_pengiriman', $data['jangkauan_pengiriman']);
            $stmt->bindValue(':lama_pengiriman', $data['lama_pengiriman']);

            $result = $stmt->execute();

            if ($result) {
                return true;
            } else {
                return false;
            }
        } else {
            $stmt = $this->db()->prepare("UPDATE " . $this->table .
                " SET nama = :nama, deskripsi = :deskripsi, harga = :harga, gambar = :gambar, status_publikasi = :status_publikasi, bobot_pengiriman = :bobot_pengiriman, jangkauan_pengiriman = :jangkauan_pengiriman, lama_pengiriman = :lama_pengiriman " .
                " WHERE id_produk = :id");
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':nama', $data['nama']);
            $stmt->bindValue(':deskripsi', $data['deskripsi']);
            $stmt->bindValue(':harga', $data['harga']);
            $stmt->bindValue(':gambar', $img);
            $stmt->bindValue(':status_publikasi', $data['status_publikasi']);
            $stmt->bindValue(':bobot_pengiriman', $data['bobot_pengiriman']);
            $stmt->bindValue(':jangkauan_pengiriman', $data['jangkauan_pengiriman']);
            $stmt->bindValue(':lama_pengiriman', $data['lama_pengiriman']);

            $result = $stmt->execute();

            if ($result) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function updatePublishStatus($data)
    {
        $stmt = $this->db()->prepare("UPDATE " . $this->table . " SET `status_publikasi` = :publish_status WHERE `id_produk` = :id ");
        $stmt->bindValue(':id', $data['id_produk']);
        $stmt->bindValue(':publish_status', $data['status_publikasi']);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $stmt = $this->db()->prepare("DELETE FROM " . $this->table . " WHERE `id_produk` = :id ");
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
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
