<?php

class Products extends Controller
{
    public function index()
    {
        $data['title'] = "Products";
        $this->view('templates/header', $data);
        $this->view('templates/navbar');
        $this->view('products/index');
        $this->view('templates/footer');
    }

    public function getAllProducts()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET");
        header('Content-Type: application/json');
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods");

        http_response_code(200);
        $products = $this->model('Product_model')->read_v();
        echo json_encode($products);
    }

    public function getProduct($id)
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET");
        header('Content-Type: application/json');
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods");

        http_response_code(200);
        $product = $this->model('Product_model')->show($id);
        echo json_encode($product);
    }

    public function getDeliveryAreas()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET");
        header('Content-Type: application/json');
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods");

        http_response_code(200);
        $product = $this->model('Product_model')->groupByDeliveryArea_v();
        echo json_encode($product);
    }

    public function getWeights()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET");
        header('Content-Type: application/json');
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods");

        http_response_code(200);
        $product = $this->model('Product_model')->groupByWeight_v();
        echo json_encode($product);
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
                $products = $this->model('Product_model')->filterProducts_v($filter);
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
        $this->view('templates/navbar');
        $this->view('products/detail', $data);
        $this->view('templates/footer');
    }
}
