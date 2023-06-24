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


        echo json_encode(count($_FILES['product_detail_image']['name']));

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
                    $out['message'] = 'Product image field is required';
                    $out['error'] = true;
                    $statuscode = 400;
                } else {
                    // validasi upload gambar
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
                    $newFileName = strtolower($_POST['product_name']) . '_' . uniqid() . '.' . $file_ext;

                    // path upload gambar
                    $path = "assets/images/products/" . $newFileName;

                    if (in_array($file_ext, $allowed_ext)) {
                        if ($filesize > $allowed_size) {
                            $out['message'] = 'File size exceeds the allowed limit (1 MB)';
                            $out['error'] = true;
                            $statuscode = 422;
                        } else {
                            $data = [
                                'nama' => $_POST['product_name'],
                                'deskripsi' => $_POST['product_desc'],
                                'harga' => $_POST['product_price'],
                                'status_publikasi' => intval(($_POST['product_publish'] === 'true') ? true : false),
                                'bobot_pengiriman' => $_POST['product_weight'],
                                'gambar' => $newFileName,
                                'jangkauan_pengiriman' => $_POST['delivery_area'],
                                'lama_pengiriman' => $_POST['delivery_estimate'],
                                'pembuat' => $_SESSION['logged_in']
                            ];
                            $product = $this->model('Product_model')->create($data);

                            foreach ($product as $key => $val) {
                                $out[$key] = $val;
                            }

                            // if validate pass
                            if ($out['error'] != true) {
                                // upload gambar
                                move_uploaded_file($tmp_file, $path);
                            } else {
                                $statuscode = 500;
                            }
                        }
                    } else {
                        $out['message'] = 'Image extension allowed: jpeg, jpg, png';
                        $out['error'] = true;
                        $statuscode = 422;
                    }
                }

                http_response_code($statuscode);
                echo json_encode($out);
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
                    $product = $this->model('Product_model')->show($id);
                    $product = $product['data'];

                    if ($product) {
                        if (isset($_FILES['product_img'])) {
                            // ambil gambar lama
                            $gambar_lama = $product['gambar'];

                            // validasi upload gambar
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
                            $newFileName = strtolower($_POST['product_name']) . '_' . uniqid() . '.' . $file_ext;

                            // path upload gambar
                            $path = "assets/images/products/";

                            $newUploadPath = $path . $newFileName;
                            $oldUploadPath = $path . $gambar_lama;

                            if (in_array($file_ext, $allowed_ext)) {
                                if ($filesize > $allowed_size) {
                                    $out['message'] = 'File size exceeds the allowed limit (1 MB)';
                                    $out['error'] = true;
                                    $statuscode = 422;
                                } else {
                                    $data = [
                                        'nama' => $_POST['product_name'],
                                        'deskripsi' => $_POST['product_desc'],
                                        'harga' => $_POST['product_price'],
                                        'status_publikasi' => intval(($_POST['product_publish'] === 'true') ? true : false),
                                        'bobot_pengiriman' => $_POST['product_weight'],
                                        'jangkauan_pengiriman' => $_POST['delivery_area'],
                                        'lama_pengiriman' => $_POST['delivery_estimate']
                                    ];

                                    $updateProduct = $this->model('Product_model')->update($id, $data, $newFileName);
                                    if ($updateProduct) {
                                        // hapus foto lama
                                        unlink($oldUploadPath);

                                        // upload foto baru
                                        move_uploaded_file($tmp_file, $newUploadPath);

                                        $out['message'] = "Product has been updated";
                                    } else {
                                        $statuscode = 500;
                                        $out['message'] = "Oops! something wrong";
                                        $out['error'] = true;
                                    }
                                }
                            } else {
                                $out['message'] = 'Image extension allowed: jpeg, jpg, png';
                                $out['error'] = true;
                                $statuscode = 422;
                            }
                        } else {
                            $data = [
                                'nama' => $_POST['product_name'],
                                'deskripsi' => $_POST['product_desc'],
                                'harga' => $_POST['product_price'],
                                'status_publikasi' => intval(($_POST['product_publish'] === 'true') ? true : false),
                                'bobot_pengiriman' => $_POST['product_weight'],
                                'jangkauan_pengiriman' => $_POST['delivery_area'],
                                'lama_pengiriman' => $_POST['delivery_estimate']
                            ];
                            $updateProduct = $this->model('Product_model')->update($id, $data);
                            if ($updateProduct) {
                                $out['message'] = "Product has been updated";
                            } else {
                                $statuscode = 500;
                                $out['message'] = "Oops! something wrong";
                            }
                        }
                    } else {
                        $statuscode = 404;
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
                    $path = "assets/images/products/" . $gambar;

                    // hapus data di database
                    $hasil = $this->model('Product_model')->delete($id);

                    if ($hasil) {
                        unlink($path);
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
