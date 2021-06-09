<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoopSimulationController
 *
 * @author helmuth
 */
class ProductsController
{

    private $jsonView;

    public function __construct()
    {
        $this->jsonView = new JsonView();
    }


    public function route()
    {
        $action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING);

        switch (strtolower($action)) {
            case 'listtypes':
                $this->listProductTypes();
                break;
            case 'listproductsbytypeid':
                $typeId = filter_input(INPUT_GET, "typeId", FILTER_SANITIZE_NUMBER_INT);
                $this->listProductsByTypeId($typeId);
                break;
            case 'addarticle':
                $articleId = filter_input(INPUT_GET, "articleId", FILTER_SANITIZE_NUMBER_INT);
                $this->addArticle($articleId);
                break;
            case 'removearticle':
                $articleId = filter_input(INPUT_GET, "articleId", FILTER_SANITIZE_NUMBER_INT);
                $this->removeArticle($articleId);
                break;
            case 'listcart':
                $this->listCart();
                break;
            default:
                $this->jsonView->streamOutput(
                    [
                        "error" => "Interface not found.",
                        "possible parameters" => "action (listTypes, listProductsByTypeId), typeId"
                    ]);
                return false;
        }
    }

    private function listProductTypes()
    {
        $productsTypesModel = new productTypesModel();
        $types = $productsTypesModel->getProductTypes();

        $backUrl = "http://localhost:63355/Uebung3_BEB_ROHL/index.php?action=listProductsByTypeId&typeId=";
        foreach ($types as &$type) {
            $type['url'] = $backUrl . $type['id'];
        }

        $this->jsonView->streamOutput($types);
    }

    private function listProductsByTypeId($typeId)
    {
        $productsModel = new productsModel();
        $products = $productsModel->listProductsByTypeId($typeId);

        $backUrl = "http://localhost:63355/Uebung3_BEB_ROHL/index.php?action=listTypes";
        foreach ($products as &$product) {
            $product['url'] = $backUrl;
        }

        $this->jsonView->streamOutput($products);
    }

    private function addArticle($articleId)
    {

        $cart = new cartModel();
        $success = $cart->add($articleId);

        if ($success) {
            $message = ['state' => 'OK'];
        } else {
            $message = ['state' => 'ERROR'];
        }

        $this->jsonView->streamOutput($message);
    }

    private function removeArticle($articleId)
    {

        $cart = new cartModel();
        $success = $cart->remove($articleId);

        if ($success) {
            $message = ['state' => 'OK'];
        } else {
            $message = ['state' => 'ERROR'];
        }

        $this->jsonView->streamOutput($message);
    }

    private function listCart()
    {
        $cart = new cartModel();
        $articleList = $cart->listArticles();

        $result = ['cart' => $articleList];
        $this->jsonView->streamOutput($result);
    }


}
