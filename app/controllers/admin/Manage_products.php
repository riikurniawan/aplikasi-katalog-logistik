<?php
class Manage_products extends Controller
{
    public function index()
    {
        $data['title'] = "Manage Products";
        $this->view('templates/header', $data);
        $this->view('templates/navbar-admin');
        $this->view('admin/manage_products/index');
        $this->view('templates/footer');
    }

    public function getAllProducts()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET");
        header('Content-Type: application/json');
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods");

        http_response_code(200);
        $products = $this->model('Product_model')->read();
        echo json_encode($products);
    }

    public function getDeliveryAreas()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET");
        header('Content-Type: application/json');
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods");

        http_response_code(200);
        $product = $this->model('Product_model')->groupByDeliveryArea();
        echo json_encode($product);
    }

    public function getWeights()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET");
        header('Content-Type: application/json');
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods");

        http_response_code(200);
        $product = $this->model('Product_model')->groupByWeight();
        echo json_encode($product);
    }

    public function create()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: POST");
        header('Content-Type: application/json');
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods");

        $requestMethod = $_SERVER['REQUEST_METHOD'];
        switch ($requestMethod) {
            case 'POST':
                $statuscode = 201;
                $out = array('error' => false);
                if (!isset($_POST['product_name'])) {
                    $out['message'] = 'Product name field is required';
                    $out['error'] = true;
                    $statuscode = 400;
                } else if (!isset($_POST['product_desc'])) {
                    $out['message'] = 'Product description field is required';
                    $out['error'] = true;
                    $statuscode = 400;
                } else if (!isset($_POST['product_price'])) {
                    $out['message'] = 'Product price field is required';
                    $out['error'] = true;
                    $statuscode = 400;
                } else if (!isset($_POST['product_weight'])) {
                    $out['message'] = 'Product weight field is required';
                    $out['error'] = true;
                    $statuscode = 400;
                } else if (!isset($_POST['delivery_area'])) {
                    $out['message'] = 'Delivery area field is required';
                    $out['error'] = true;
                    $statuscode = 400;
                } else if (!isset($_POST['delivery_estimate'])) {
                    $out['message'] = 'Delivery estimate field is required';
                    $out['error'] = true;
                    $statuscode = 400;
                } else if (!isset($_FILES['product_img'])) {
                    $out['message'] = 'Product logo field is required';
                    $out['error'] = true;
                    $statuscode = 400;
                } else if (!isset($_FILES['product_detail_image'])) {
                    $out['message'] = 'Product image field is required';
                    $out['error'] = true;
                    $statuscode = 400;
                } else {
                    $getIDProduk = $this->model('Product_model')->generateKode();

                    // array untuk simpan semua file gambar dan logo baru 
                    $uploadLogoImages = array();
                    $uploadImages = array();

                    // array kosong untuk simpan error upload
                    $out['errors'] = array();
                    if (isset($_FILES['product_detail_image'])) {
                        // ambil semua file gambar yg di upload
                        $product_detail_img = $_FILES['product_detail_image'];

                        // ambil semua filename gambar yg di upload
                        $filename = $product_detail_img['name'];

                        // ambil semua filesize gambar yg di upload
                        $filesize = $product_detail_img['size'];

                        // filesize yang di ijinkan 1MB
                        $allowed_size = 1048576; // satuan byte 

                        // ekstensi yang di ijinkan
                        $allowed_ext = array('jpeg', 'jpg', 'png');

                        $uploadImages['images'] = array();

                        // index untuk array errors
                        $index = 0;

                        // looping semua file gambar
                        for ($idx = 0; $idx < count($filename); $idx++) {
                            $file_ext = explode('.', $filename[$idx]);
                            $file_ext = end($file_ext);
                            $allowed_ext = array('jpeg', 'jpg', 'png');

                            // isvalid
                            $isValid = true;

                            // lakukan validasi gambar
                            if (in_array($file_ext, $allowed_ext) && $isValid) {
                                if ($filesize[$idx] > $allowed_size) {
                                    // tidak valid
                                    $isValid = false;

                                    // masukkan error kedalam array
                                    array_push(
                                        $out['errors'],
                                        [
                                            $index => [
                                                'filename' => $product_detail_img['name'][$idx],
                                                'message' => "File size exceeds the allowed limit (1 MB)"
                                            ]
                                        ]
                                    );
                                    $index++;
                                    $out['error'] = true;
                                    $statuscode = 422;
                                } else {
                                    // ambil tmp file
                                    $tmp_file = $product_detail_img['tmp_name'][$idx];

                                    // buat nama gambar baru 
                                    $newFileName = 'img_' . strtolower($getIDProduk) . '_' . uniqid() . '.' . $file_ext;

                                    // masukkan gambar baru kedalam array uploadImages
                                    array_push(
                                        $uploadImages['images'],
                                        [
                                            'filename' => $newFileName,
                                            'tmp_name' => $tmp_file
                                        ]
                                    );
                                }
                            } else {
                                // tidak valid
                                $isValid = false;

                                // masukkan error kedalam array
                                array_push(
                                    $out['errors'],
                                    [
                                        $index => [
                                            'filename' => $product_detail_img['name'][$idx],
                                            'message' => "Image extension allowed: jpeg, jpg, png"
                                        ]
                                    ]
                                );
                                $index++;
                                $out['error'] = true;
                                $statuscode = 422;
                            }
                        }
                    }
                    if (isset($_FILES['product_img'])) {
                        // validasi upload logo gambar
                        $filename = $_FILES['product_img']['name'];
                        $filesize = $_FILES['product_img']['size'];

                        // filesize yang di ijinkan 1MB
                        $allowed_size = 1048576; // satuan byte 

                        $file_ext = explode('.', $filename);
                        $file_ext = end($file_ext);
                        $allowed_ext = array('jpeg', 'jpg', 'png');

                        // tmp file
                        $tmp_file = $_FILES['product_img']['tmp_name'];

                        // buat nama file baru
                        $newFileName = 'logo_' . strtolower($getIDProduk)  . '_' . uniqid() . '.' . $file_ext;

                        // index untuk array errors
                        $index = 0;

                        if (in_array($file_ext, $allowed_ext)) {
                            if ($filesize > $allowed_size) {
                                array_push(
                                    $out['errors'],
                                    [
                                        $index => [
                                            'filename' => $filename,
                                            'message' => "File size exceeds the allowed limit (1 MB)"
                                        ]
                                    ]
                                );
                                $index++;
                                $out['error'] = true;
                                $statuscode = 422;
                            } else {
                                // array untuk simpan semua file gambar logo baru 
                                $uploadLogoImages = [
                                    'filename' => $newFileName,
                                    'tmp_name' => $tmp_file
                                ];
                            }
                        } else {
                            array_push(
                                $out['errors'],
                                [
                                    $index => [
                                        'filename' => $filename,
                                        'message' => "Image extension allowed: jpeg, jpg, png"
                                    ]
                                ]
                            );
                            $index++;
                            $out['error'] = true;
                            $statuscode = 422;
                        }
                    }
                    if (count($uploadImages) > 0 && count($uploadLogoImages) > 0) {
                        $produk = [
                            'nama' => $_POST['product_name'],
                            'deskripsi' => $_POST['product_desc'],
                            'harga' => $_POST['product_price'],
                            'status_publikasi' => intval(($_POST['product_publish'] === 'true') ? true : false),
                            'bobot_pengiriman' => $_POST['product_weight'],
                            'gambar' => $uploadLogoImages['filename'],
                            'jangkauan_pengiriman' => $_POST['delivery_area'],
                            'lama_pengiriman' => $_POST['delivery_estimate'],
                            'pembuat' => $_SESSION['logged_in']
                        ];

                        // array kosong untuk simpan foto produk
                        $foto_produk = array();

                        // menyiapkan data
                        foreach ($uploadImages['images'] as $key => $val) {
                            array_push($foto_produk, [
                                'id_produk' => $getIDProduk,
                                'file_foto' => $val['filename']
                            ]);
                        }

                        // lakukan insert data
                        $product = $this->model('Product_model')->create($produk);

                        $product_img = [];
                        foreach ($foto_produk as $foto) {
                            $result = $this->model('Foto_model')->create($foto);

                            if ($result) {
                                $product_img[] = $result;
                            } else {
                                $product_img = null;
                                break; // Berhenti loop jika ada error dalam membuat foto
                            }
                        }


                        if ($product && ($product_img != null)) {
                            $out = [
                                'message' => 'New product added',
                            ];

                            // path upload gambar
                            $path = "assets/images/products/";

                            // upload gambar logo
                            move_uploaded_file($uploadLogoImages['tmp_name'], $path . $uploadLogoImages['filename']);

                            // upload gambar produk
                            foreach ($uploadImages['images'] as $foto) {
                                move_uploaded_file($foto['tmp_name'], $path . $foto['filename']);
                            }
                        } else {
                            //server error
                            $out = [
                                'message' => 'Oops! something wrong',
                                'error' => true
                            ];
                            $statuscode = 500;
                        }
                    }
                }

                echo json_encode($out);
                http_response_code($statuscode);
                break;
            default:
                http_response_code(405);
                echo json_encode(array(
                    "message" => "REQUEST METHOD NOT ALLOWED",
                    "error" => true
                ));
                break;
        }
    }

    public function update($id)
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: POST");
        header('Content-Type: application/json');
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods");

        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $statuscode = 201;
        $out = array();
        switch ($requestMethod) {
            case 'POST':
                if (!isset($_POST['product_name'])) {
                    $out['message'] = 'Product name field is required';
                    $out['error'] = true;
                    $statuscode = 400;
                } else if (!isset($_POST['product_desc'])) {
                    $out['message'] = 'Product description field is required';
                    $out['error'] = true;
                    $statuscode = 400;
                } else if (!isset($_POST['product_price'])) {
                    $out['message'] = 'Product price field is required';
                    $out['error'] = true;
                    $statuscode = 400;
                } else if (!isset($_POST['product_weight'])) {
                    $out['message'] = 'Product weight field is required';
                    $out['error'] = true;
                    $statuscode = 400;
                } else if (!isset($_POST['delivery_area'])) {
                    $out['message'] = 'Delivery area field is required';
                    $out['error'] = true;
                    $statuscode = 400;
                } else if (!isset($_POST['delivery_estimate'])) {
                    $out['message'] = 'Delivery estimate field is required';
                    $out['error'] = true;
                    $statuscode = 400;
                } else {
                    $produkModel = $this->model('Product_model')->show($id);
                    $produkModel = $produkModel['data'];

                    // jika produk yang ingin di update ada
                    if ($produkModel) {
                        // validasi jika ada upload gambar logo dan gambar produk
                        $uploadGambar['images'] = array();
                        $uploadLogo = [];

                        if (isset($_FILES['product_img']) && isset($_FILES['product_detail_image'])) {
                            // ambil semua index file gambar yg di upload
                            $product_detail_img = $_FILES['product_detail_image'];
                            // ambil semua filename gambar yg di upload
                            $filename = $product_detail_img['name'];
                            // ambil semua filesize gambar yg di upload
                            $filesize = $product_detail_img['size'];
                            // filesize yang di ijinkan 1MB
                            $allowed_size = 1048576; // satuan byte 
                            // ekstensi yang di perbolehkan
                            $allowed_ext = array('jpeg', 'jpg', 'png');

                            // array kosong untuk semua gambar 
                            // yang sukses validasi

                            // index untuk array errors
                            $index = 0;

                            // looping semua file gambar yang di upload 
                            for ($idx = 0; $idx < count($filename); $idx++) {
                                // pecah filename gambar dengan pemisah titik
                                $file_ext = explode('.', $filename[$idx]);
                                // ambil string index terakhir 
                                // untuk mengetahui jenis ekstension
                                $file_ext = end($file_ext);

                                // jenis ekstensi yang diperbolehkan
                                $allowed_ext = array('jpeg', 'jpg', 'png');

                                // variabel untuk mengecek validasi berhasil atau tidak
                                $isValid = true;

                                // lakukan validasi jika gambar yang diupload sesuai
                                // ekstensi yang diperbolehkan
                                if (in_array($file_ext, $allowed_ext) && $isValid) {
                                    // maka, lakukan validasi ukuran file gambar tidak melebihi > 1 MB
                                    if ($filesize[$idx] > $allowed_size) {
                                        // tidak valid
                                        $isValid = false;

                                        // masukkan error kedalam array
                                        array_push(
                                            $out['errors'],
                                            [
                                                $index => [
                                                    'filename' => $product_detail_img['name'][$idx],
                                                    'message' => "File size exceeds the allowed limit (1 MB)"
                                                ]
                                            ]
                                        );
                                        $index++;
                                        $out['error'] = true;
                                        $statuscode = 422;
                                    } else {
                                        // ambil letak tmp file gambar yang di upload
                                        $tmp_file = $product_detail_img['tmp_name'][$idx];

                                        // buat nama gambar baru 
                                        $newFileName = 'img_' . strtolower($produkModel['id_produk']) . '_' . uniqid() . '.' . $file_ext;

                                        // masukkan gambar baru kedalam array uploadImages
                                        array_push(
                                            $uploadGambar['images'],
                                            [
                                                'filename' => $newFileName,
                                                'tmp_name' => $tmp_file
                                            ]
                                        );
                                    }
                                } else {
                                    // jika validasi ekstensi gambar gagal
                                    // ubah nilai validasi menjadi false
                                    $isValid = false;

                                    // masukkan pesan error kedalam array out dengan key errors
                                    array_push(
                                        $out['errors'],
                                        [
                                            $index => [
                                                'filename' => $product_detail_img['name'][$idx],
                                                'message' => "Image extension allowed: jpeg, jpg, png"
                                            ]
                                        ]
                                    );
                                    $index++;

                                    // set error response
                                    $out['error'] = true;
                                    // set httpstatuscode
                                    $statuscode = 422;
                                }



                                // ambil namafile gambar dan ukuran gambar
                                $filenameGambarLogo = $_FILES['product_img']['name'];
                                $filesizeGambarLogo = $_FILES['product_img']['size'];

                                // ukuran yang di perbolehkan 1MB
                                $allowed_size = 1048576; // satuan byte 

                                // pecah string namafile gambar dengan pemisahnya titik
                                $file_ext = explode('.', $filenameGambarLogo);
                                // ambil nilai index terakhir dari string filename
                                $file_ext = end($file_ext);

                                // ekstensi yang diperbolehkan
                                $allowed_ext = array('jpeg', 'jpg', 'png');

                                // mengambil letak gambar sementara setelah di upload
                                $tmp_file = $_FILES['product_img']['tmp_name'];

                                // buat nama file gambar yang baru
                                $newFilename = 'logo_' . strtolower($produkModel['id_produk'])  . '_' . uniqid() . '.' . $file_ext;

                                // index untuk array errors
                                $index = 0;

                                // lakukan validasi jika ekstensi gambar yang di upload
                                // sesuai dengan yang diperbolehkan
                                if (in_array($file_ext, $allowed_ext)) {
                                    // jika sesuai, maka validasi ukuran gambar tidak melebihi > 1MB
                                    if ($filesizeGambarLogo > $allowed_size) {
                                        // kalau ukuran gambar yang di upload terlalu besar
                                        // kirim pesan error ke dalam array out dengan key errors
                                        array_push(
                                            $out['errors'],
                                            [
                                                $index => [
                                                    'filename' => $filenameGambarLogo,
                                                    'message' => "File size exceeds the allowed limit (1 MB)"
                                                ]
                                            ]
                                        );
                                        $index++;

                                        // set error response 
                                        $out['error'] = true;
                                        // set http response
                                        $statuscode = 422;
                                    } else {
                                        // simpan semua file gambar logo baru 
                                        // ke dalam variable uploadLogo
                                        $uploadLogo = [
                                            'filename' => $newFilename,
                                            'tmp_name' => $tmp_file
                                        ];
                                    }
                                } else {
                                    // validasi ekstensi yang diperbolehkan gagal
                                    // kembalikan pesan error ke dalam array out dengan key error
                                    array_push(
                                        $out['errors'],
                                        [
                                            $index => [
                                                'filename' => $filenameGambarLogo,
                                                'message' => "Image extension allowed: jpeg, jpg, png"
                                            ]
                                        ]
                                    );
                                    $index++;

                                    // set error response
                                    $out['error'] = true;
                                    // set httpresponse status
                                    $statuscode = 422;
                                }


                                // masukkan data ke dalam database jika semua form upload gambar terisi
                                // simpan semua data yang di update ke dalam array produkBaru
                                $produkBaru = [
                                    'nama' => $_POST['product_name'],
                                    'deskripsi' => $_POST['product_desc'],
                                    'harga' => $_POST['product_price'],
                                    'status_publikasi' => intval(($_POST['product_publish'] === 'true') ? true : false),
                                    'bobot_pengiriman' => $_POST['product_weight'],
                                    'gambar' => $uploadLogo['filename'],
                                    'jangkauan_pengiriman' => $_POST['delivery_area'],
                                    'lama_pengiriman' => $_POST['delivery_estimate'],
                                ];

                                // array kosong untuk menyimpan semua foto produk
                                $fotoProdukBaru = array();

                                // memasukkan semua data gambar produk yang telah di upload
                                // ke dalam array fotoProdukBaru
                                foreach ($uploadGambar['images'] as $img) {
                                    array_push($fotoProdukBaru, [
                                        'file_foto' => $img['filename']
                                    ]);
                                }

                                // hapus semua foto gambar yang lama
                                $this->model('Foto_model')->delete($produkModel['id_produk']);

                                foreach ($fotoProdukBaru as $foto) {
                                    // melakukan update foto
                                    // menyimpan hasilnya ke dalam variable hasil
                                    $hasil = $this->model('Foto_model')->update($produkModel['id_produk'], $foto);

                                    // jika hasil update berhasil
                                    if ($hasil) {
                                        // tambahkan status update foto kedalam array statusUpdateFoto
                                        $statusUpdateFoto[] = $hasil;
                                    } else {
                                        // kalau gagal
                                        // set menjadi null
                                        $statusUpdateFoto = null;
                                        break; // berhenti loop jika ada error dalam mengubah data foto
                                    }
                                }

                                // ambil gambar lama sebelum di update
                                $gambarLama = $this->model('Product_model')->getProductDetailImages($produkModel['id_produk']);

                                // melakukan update produk
                                $statusUpdateProduk = $this->model('Product_model')->update($produkModel['id_produk'], $produkBaru);

                                // array untuk menyimpan status update foto
                                $statusUpdateFoto = [];
                                foreach ($fotoProdukBaru as $foto) {
                                    // melakukan update foto
                                    // menyimpan hasilnya ke dalam variable hasil
                                    $hasil = $this->model('Foto_model')->update($produkModel['id_produk'], $foto);

                                    // jika hasil update berhasil
                                    if ($hasil) {
                                        // tambahkan status update foto kedalam array statusUpdateFoto
                                        $statusUpdateFoto[] = $hasil;
                                    } else {
                                        // kalau gagal
                                        // set menjadi null
                                        $statusUpdateFoto = null;
                                        break; // berhenti loop jika ada error dalam mengubah data foto
                                    }
                                }

                                // jika status update produk dan update foto tidak ada yang gagal
                                if ($statusUpdateProduk && ($statusUpdateFoto != null)) {
                                    // kembalikan pesan
                                    $out = [
                                        'message' => 'Product has been updated logo, detail image',
                                    ];

                                    // sekarang waktunya upload gambar baru dan hapus gambar lama
                                    // path upload gambar
                                    $path = "assets/images/products/";

                                    // hapus logo produk yang lama
                                    $logoLama = $produkModel['gambar'];
                                    unlink($path . $logoLama);

                                    // upload logo baru
                                    move_uploaded_file($uploadLogo['tmp_name'], $path . $uploadLogo['filename']);

                                    // hapus gambar produk yang lama
                                    $gambarLama = $gambarLama['data'];
                                    foreach ($gambarLama as $gambarLama) {
                                        unlink($path . $gambarLama['file_foto']);
                                    }

                                    // upload gambar produk
                                    foreach ($uploadGambar['images'] as $foto) {
                                        move_uploaded_file($foto['tmp_name'], $path . $foto['filename']);
                                    }
                                } else {
                                    //server error
                                    $out = [
                                        'message' => 'Oops! something wrong',
                                        'error' => true
                                    ];
                                    $statuscode = 500;
                                }
                            }
                        }
                        if (isset($_FILES['product_img']) && !isset($_FILES['product_detail_image'])) {
                            // ambil namafile gambar dan ukuran gambar
                            $filename = $_FILES['product_img']['name'];
                            $filesize = $_FILES['product_img']['size'];

                            // ukuran yang di perbolehkan 1MB
                            $allowed_size = 1048576; // satuan byte 

                            // pecah string namafile gambar dengan pemisahnya titik
                            $file_ext = explode('.', $filename);
                            // ambil nilai index terakhir dari string filename
                            $file_ext = end($file_ext);

                            // ekstensi yang diperbolehkan
                            $allowed_ext = array('jpeg', 'jpg', 'png');

                            // mengambil letak gambar sementara setelah di upload
                            $tmp_file = $_FILES['product_img']['tmp_name'];

                            // buat nama file gambar yang baru
                            $newFilename = 'logo_' . strtolower($produkModel['id_produk'])  . '_' . uniqid() . '.' . $file_ext;

                            // index untuk array errors
                            $index = 0;

                            // lakukan validasi jika ekstensi gambar yang di upload
                            // sesuai dengan yang diperbolehkan
                            if (in_array($file_ext, $allowed_ext)) {
                                // jika sesuai, maka validasi ukuran gambar tidak melebihi > 1MB
                                if ($filesize > $allowed_size) {
                                    // kalau ukuran gambar yang di upload terlalu besar
                                    // kirim pesan error ke dalam array out dengan key errors
                                    array_push(
                                        $out['errors'],
                                        [
                                            $index => [
                                                'filename' => $filename,
                                                'message' => "File size exceeds the allowed limit (1 MB)"
                                            ]
                                        ]
                                    );
                                    $index++;

                                    // set error response 
                                    $out['error'] = true;
                                    // set http response
                                    $statuscode = 422;
                                } else {
                                    // simpan semua file gambar logo baru 
                                    // ke dalam variable uploadLogo
                                    $uploadLogo = [
                                        'filename' => $newFilename,
                                        'tmp_name' => $tmp_file
                                    ];


                                    // simpan semua data yang di update ke dalam array produkBaru
                                    $produkBaru = [
                                        'nama' => $_POST['product_name'],
                                        'deskripsi' => $_POST['product_desc'],
                                        'harga' => $_POST['product_price'],
                                        'status_publikasi' => intval(($_POST['product_publish'] === 'true') ? true : false),
                                        'bobot_pengiriman' => $_POST['product_weight'],
                                        'gambar' => $uploadLogo['filename'],
                                        'jangkauan_pengiriman' => $_POST['delivery_area'],
                                        'lama_pengiriman' => $_POST['delivery_estimate'],
                                    ];

                                    // melakukan update produk
                                    $statusUpdateProduk = $this->model('Product_model')->update($produkModel['id_produk'], $produkBaru);

                                    // jika status update produk dan update foto tidak ada yang gagal
                                    if ($statusUpdateProduk) {
                                        // kembalikan pesan
                                        $out = [
                                            'message' => 'Product has been updated logo',
                                        ];

                                        // sekarang waktunya upload gambar baru dan hapus gambar lama
                                        // path upload gambar
                                        $path = "assets/images/products/";

                                        // hapus logo produk yang lama
                                        $logoLama = $produkModel['gambar'];
                                        unlink($path . $logoLama);

                                        // upload logo baru
                                        move_uploaded_file($uploadLogo['tmp_name'], $path . $uploadLogo['filename']);
                                    } else {
                                        //server error
                                        $out = [
                                            'message' => 'Oops! something wrong',
                                            'error' => true
                                        ];
                                        $statuscode = 500;
                                    }
                                }
                            } else {
                                // validasi ekstensi yang diperbolehkan gagal
                                // kembalikan pesan error ke dalam array out dengan key error
                                array_push(
                                    $out['errors'],
                                    [
                                        $index => [
                                            'filename' => $filename,
                                            'message' => "Image extension allowed: jpeg, jpg, png"
                                        ]
                                    ]
                                );
                                $index++;

                                // set error response
                                $out['error'] = true;
                                // set httpresponse status
                                $statuscode = 422;
                            }
                        } else if (isset($_FILES['product_detail_image']) && !isset($_FILES['product_img'])) {
                            // ambil semua index file gambar yg di upload
                            $product_detail_img = $_FILES['product_detail_image'];

                            // ambil semua filename gambar yg di upload
                            $filename = $product_detail_img['name'];

                            // ambil semua filesize gambar yg di upload
                            $filesize = $product_detail_img['size'];

                            // filesize yang di ijinkan 1MB
                            $allowed_size = 1048576; // satuan byte 

                            // ekstensi yang di perbolehkan
                            $allowed_ext = array('jpeg', 'jpg', 'png');

                            // index untuk array errors
                            $index = 0;

                            // looping semua file gambar yang di upload 
                            for ($idx = 0; $idx < count($filename); $idx++) {
                                // pecah filename gambar dengan pemisah titik
                                $file_ext = explode('.', $filename[$idx]);
                                // ambil string index terakhir 
                                // untuk mengetahui jenis ekstension
                                $file_ext = end($file_ext);

                                // jenis ekstensi yang diperbolehkan
                                $allowed_ext = array('jpeg', 'jpg', 'png');

                                // variabel untuk mengecek validasi berhasil atau tidak
                                $isValid = true;

                                // lakukan validasi jika gambar yang diupload sesuai
                                // ekstensi yang diperbolehkan
                                if (in_array($file_ext, $allowed_ext) && $isValid) {
                                    // maka, lakukan validasi ukuran file gambar tidak melebihi > 1 MB
                                    if ($filesize[$idx] > $allowed_size) {
                                        // tidak valid
                                        $isValid = false;

                                        // masukkan error kedalam array
                                        array_push(
                                            $out['errors'],
                                            [
                                                $index => [
                                                    'filename' => $product_detail_img['name'][$idx],
                                                    'message' => "File size exceeds the allowed limit (1 MB)"
                                                ]
                                            ]
                                        );
                                        $index++;
                                        $out['error'] = true;
                                        $statuscode = 422;
                                    } else {
                                        // ambil letak tmp file gambar yang di upload
                                        $tmp_file = $product_detail_img['tmp_name'][$idx];

                                        // buat nama gambar baru 
                                        $newFileName = 'img_' . strtolower($produkModel['id_produk']) . '_' . uniqid() . '.' . $file_ext;

                                        // masukkan gambar baru kedalam array uploadImages
                                        array_push(
                                            $uploadGambar['images'],
                                            [
                                                'filename' => $newFileName,
                                                'tmp_name' => $tmp_file
                                            ]
                                        );

                                        // hapus gambar produk yang lama
                                        $gambarLama = $this->model('Product_model')->getProductDetailImages($produkModel['id_produk']);
                                        $gambarLama = $gambarLama['data'];

                                        // simpan semua data yang di update ke dalam array produkBaru
                                        $produkBaru = [
                                            'nama' => $_POST['product_name'],
                                            'deskripsi' => $_POST['product_desc'],
                                            'harga' => $_POST['product_price'],
                                            'status_publikasi' => intval(($_POST['product_publish'] === 'true') ? true : false),
                                            'bobot_pengiriman' => $_POST['product_weight'],
                                            'jangkauan_pengiriman' => $_POST['delivery_area'],
                                            'lama_pengiriman' => $_POST['delivery_estimate'],
                                        ];

                                        // array kosong untuk menyimpan semua foto produk
                                        $fotoProdukBaru = array();

                                        // memasukkan semua data gambar produk yang telah di upload
                                        // ke dalam array fotoProdukBaru
                                        foreach ($uploadGambar['images'] as $img) {
                                            array_push($fotoProdukBaru, [
                                                'file_foto' => $img['filename']
                                            ]);
                                        }


                                        // melakukan update produk
                                        $statusUpdateProduk = $this->model('Product_model')->update($produkModel['id_produk'], $produkBaru);

                                        // array untuk menyimpan status update foto
                                        $statusUpdateFoto = [];

                                        // hapus semua foto gambar yang lama
                                        $this->model('Foto_model')->delete($produkModel['id_produk']);

                                        foreach ($fotoProdukBaru as $foto) {
                                            // melakukan update foto
                                            // menyimpan hasilnya ke dalam variable hasil
                                            $hasil = $this->model('Foto_model')->update($produkModel['id_produk'], $foto);

                                            // jika hasil update berhasil
                                            if ($hasil) {
                                                // tambahkan status update foto kedalam array statusUpdateFoto
                                                $statusUpdateFoto[] = $hasil;
                                            } else {
                                                // kalau gagal
                                                // set menjadi null
                                                $statusUpdateFoto = null;
                                                break; // berhenti loop jika ada error dalam mengubah data foto
                                            }
                                        }

                                        // jika status update produk dan update foto tidak ada yang gagal
                                        if ($statusUpdateProduk && ($statusUpdateFoto != null)) {
                                            // kembalikan pesan
                                            $out = [
                                                'message' => 'Product has been updated detail gambar',
                                            ];

                                            // sekarang waktunya upload gambar baru dan hapus gambar lama
                                            // path upload gambar
                                            $path = "assets/images/products/";

                                            foreach ($gambarLama as $gambarLama) {
                                                unlink($path . $gambarLama['file_foto']);
                                            }

                                            // upload gambar produk
                                            foreach ($uploadGambar['images'] as $foto) {
                                                move_uploaded_file($foto['tmp_name'], $path . $foto['filename']);
                                            }
                                        } else {
                                            //server error
                                            $out = [
                                                'message' => 'Oops! something wrong',
                                                'error' => true
                                            ];
                                            $statuscode = 500;
                                        }
                                    }
                                } else {
                                    // jika validasi ekstensi gambar gagal
                                    // ubah nilai validasi menjadi false
                                    $isValid = false;

                                    // masukkan pesan error kedalam array out dengan key errors
                                    array_push(
                                        $out['errors'],
                                        [
                                            $index => [
                                                'filename' => $product_detail_img['name'][$idx],
                                                'message' => "Image extension allowed: jpeg, jpg, png"
                                            ]
                                        ]
                                    );
                                    $index++;

                                    // set error response
                                    $out['error'] = true;
                                    // set httpstatuscode
                                    $statuscode = 422;
                                }
                            }
                        } else if (!isset($_FILES['product_detail_image']) && !isset($_FILES['product_img'])) {
                            // masukkan data ke dalam database jika tidak ada upload file 
                            // simpan semua data produk yang dirubah
                            $data = [
                                'nama' => $_POST['product_name'],
                                'deskripsi' => $_POST['product_desc'],
                                'harga' => $_POST['product_price'],
                                'status_publikasi' => intval(($_POST['product_publish'] === 'true') ? true : false),
                                'bobot_pengiriman' => $_POST['product_weight'],
                                'jangkauan_pengiriman' => $_POST['delivery_area'],
                                'lama_pengiriman' => $_POST['delivery_estimate']
                            ];

                            $updateProduk = $this->model('Product_model')->update($id, $data);
                            if ($updateProduk) {
                                $out['message'] = "Product has been updated nonimg";
                            } else {
                                $statuscode = 500;
                                $out['message'] = "Oops! something wrong";
                            }
                        }
                    } else {
                        // jika produk yang ingin di update tidak ketemu
                        // set http status code
                        $statuscode = 404; // not found

                        // kembalikan pesan
                        $out['message'] = "Product not found";
                    }
                }
                break;
            default:
                $statuscode = 405;
                $out['message'] = "REQUEST METHOD NOT ALLOWED";
                break;
        }
        http_response_code($statuscode);
        echo json_encode($out);
    }

    public function updatePublishStatus()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: POST");
        header('Content-Type: application/json');
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods");
        $data = json_decode(file_get_contents('php://input'));
        $request_method = $_SERVER['REQUEST_METHOD'];

        $status = 200;
        switch ($request_method) {
            case 'POST':
                $out = array();

                if (!isset($data->id_produk) && !isset($data->status_publikasi)) {
                    $status = 404;
                    $out['message'] =  "Product id or publish status not found";
                } else {
                    $update = [
                        'id_produk' => $data->id_produk,
                        'status_publikasi' => $data->status_publikasi
                    ];
                    $updatePublishStatus = $this->model('Product_model')->updatePublishStatus($update);

                    if ($updatePublishStatus) {
                        if ($data->status_publikasi != 0) {
                            $out['message'] = "Product has been listing";
                        } else {
                            $out['message'] = "Product has been archived";
                        }
                    } else {
                        $status = 500;
                        $out['message'] = "Oops! something wrong";
                    }
                }

                http_response_code($status);
                echo json_encode($out);
                break;
            default:
                http_response_code(405);
                echo json_encode(array("message" => "REQUEST METHOD NOT ALLOWED"));
                break;
        }
    }

    public function delete()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: DELETE");
        header('Content-Type: application/json');
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods");
        $data = json_decode(file_get_contents('php://input'));
        $request_method = $_SERVER['REQUEST_METHOD'];

        switch ($request_method) {
            case 'DELETE':

                $id = $data->id;
                $product = $this->model('Product_model')->show($id);
                $product = $product['data'];

                $out = array();
                $status = 200;
                if (empty($product)) {
                    $out['message'] = "Product Id not found";
                    $status = 404;
                } else {
                    // ambil filename gambar
                    $gambar = $product['gambar'];

                    // path upload
                    $path = "assets/images/products/";

                    // hapus data di database
                    $gambarLama = $this->model('Product_model')->getProductDetailImages($id);
                    $gambarLama = $gambarLama['data'];
                    $hasil = $this->model('Product_model')->delete($id);

                    if ($hasil) {
                        // hapus gambar produk yang lama
                        foreach ($gambarLama as $gambarLama) {
                            unlink($path . $gambarLama['file_foto']);
                        }
                        unlink($path . $gambar);
                        $out['message'] = "Product has been deleted";
                    } else {
                        $status = 500;
                        $out['message'] = "Oops! something wrong";
                    }
                }

                http_response_code($status);
                echo json_encode($out);
                break;
            default:
                http_response_code(405);
                echo json_encode(array("message" => "REQUEST METHOD NOT ALLOWED"));
                break;
        }
    }

    public function filterProductsBy()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: POST");
        header('Content-Type: application/json');
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods");

        $data = json_decode(file_get_contents('php://input'));
        $out = array('error' => false);

        $request_method = $_SERVER['REQUEST_METHOD'];
        switch ($request_method) {
            case 'POST':
                $filter = [
                    'delivery_area' => !empty($data->delivery_area) ? $data->delivery_area : null,
                    'weight' => !empty($data->weight) ? $data->weight : null
                ];
                $products = $this->model('Product_model')->filterProducts($filter);
                echo json_encode($products);

                break;
            default:
                http_response_code(405);
                $out['message'] = 'REQUEST METHOD NOT ALLOWED';
                $out['error'] = true;

                echo json_encode($out);
                break;
        }
    }

    public function detail($id)
    {
        $data['id'] = $id;
        $data['title'] = "Product Detail";
        $this->view('templates/header', $data);
        $this->view('templates/navbar-admin');
        $this->view('admin/manage_products/detail', $data);
        $this->view('templates/footer');
    }
}
