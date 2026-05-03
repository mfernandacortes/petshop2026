<?php
require_once __DIR__ . '/../models/Product.php';


class ProductController {

    public function index() {
        $model = new Product();
        $products = $model->getAll();

        require_once __DIR__ . '/../views/products/index.php';


    }
    public function personalizar() {
        $id = $_GET['id'];

        $model = new Product();
        $product = $model->getById($id);

        require_once __DIR__ . '/../views/products/personalizar.php';
    }
}