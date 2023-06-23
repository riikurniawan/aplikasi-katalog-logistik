<?php

class Products extends Controller
{
    public function index()
    {
        $this->view('templates/header');
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
        $products = $this->model('Product_model')->read();
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

    public function detail($id)
    {
        $data['id'] = $id;
        $this->view('templates/header');
        $this->view('templates/navbar');
        $this->view('products/detail', $data);
        $this->view('templates/footer');
    }
}
