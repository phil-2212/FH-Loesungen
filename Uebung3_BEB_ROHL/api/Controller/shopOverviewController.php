<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['cart']))
    $_SESSION['cart'] = array();


class shopOverviewController
{
    private $jsonView;
    private $shopDBData;

    public function __construct()
    {
        $this->jsonView = new JsonView();
        $this->shopDBData = null;
        $this->cart = new listCart();
    }

    public function route()
    {
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_SPECIAL_CHARS);
        $articleId = filter_input(INPUT_GET, 'typeId', FILTER_SANITIZE_SPECIAL_CHARS);

        $paramsValid = $this->startQuery($action, $articleId);

        if ($paramsValid && $action != 'listCart' && $action != 'removeArticle') {
            $result = $this->shopDBData->createDBQuery();
            $this->jsonView->streamOutput($result);

        } else if ($paramsValid && $action == 'listCart') {
            $result = $this->shopDBData->getCart();
            $this->jsonView->streamOutput($result);

        }
        else if ($paramsValid && $action === 'removeArticle') {
            $result = $this->shopDBData->removeFromCart();
            $this->jsonView->streamOutput($result);
        } else {
            $errorData = array(
                "ERROR" => "Data not found."
            );


            $this->jsonView->streamOutput($errorData);
        }
    }

    public function startQuery($action, $typeId)
    {
        switch ($action) {
            case "listTypes":
                $this->shopDBData = new shopListTypesModel();
                break;

            case "listProductsByTypeId":
                $this->shopDBData = new shopProductsByTypeID($typeId);
                break;

            case "listCart":
                $this->shopDBData = new listCart();
                break;

            case "addArticle":
                $this->shopDBData = new addToCart($typeId);
                break;

            case "removeArticle":
                $this->shopDBData = new removeFromCart($typeId);
                break;

            case false:

            default:
                return false;
        }

        return true;

    }
}