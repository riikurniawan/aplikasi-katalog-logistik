<?php
class Manage_products extends Controller
{
    public function index()
    {
        $this->view('templates/header');
        $this->view('templates/navbar-admin');
        $this->view('admin/manage_products/index');
        $this->view('templates/footer');
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
                                // move_uploaded_file($tmp_file, $path);
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

    public function detail($id)
    {
        $data['id'] = $id;
        $this->view('templates/header');
        $this->view('templates/navbar-admin');
        $this->view('admin/manage_products/detail', $data);
        $this->view('templates/footer');
    }
}
