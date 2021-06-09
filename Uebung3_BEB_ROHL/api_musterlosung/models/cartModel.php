<?php
/**
 * Created by PhpStorm.
 * User: helmuth
 * Date: 02.06.20
 * Time: 19:07
 */

class cartModel
{
    private $cart;
    private $dbGateway;

    public function __construct()
    {
        $this->dbGateway = new pdoDBGateway();

        if( ! isset( $_SESSION['cart']) )
        {
            $_SESSION['cart'] = [];
        }

        $this->cart = $_SESSION['cart'];
    }


    public function add($articleId)
    {

        if( ! $this->articleExists($articleId) )
        {
            return false;
        }

        if( ! isset($this->cart[$articleId]) )
        {
            $this->cart[$articleId] = 0;
        }

        $this->cart[$articleId] ++;

        $this->updateSession();

        return true;
    }

    public function remove($articleId)
    {
        if( ! isset($this->cart[$articleId]) )
        {
            return false;
        }
        else
        {
            $this->cart[$articleId] --;
        }

        $this->updateSession();
        return true;
    }

    private function articleExists($articleId)
    {
        $query = "SELECT id FROM products WHERE id = {$articleId} ";
        $result = $this->dbGateway->query($query);

        return count($result) > 0;
    }

    public function listArticles()
    {
        $articleList = [];
        foreach($this->cart as $articleId => $amount)
        {
            $article = $this->getArticleDetails($articleId);
            $article['amount'] = $amount;

            $articleList[] = $article;
        }

        return $articleList;
    }

    private function getArticleDetails($articleId)
    {
        $articleQuery = "SELECT id, name as articleName, price_of_sale as price FROM `products` WHERE id = {$articleId} LIMIT 1";
        $result = $this->dbGateway->query($articleQuery);

        return $result[0];
    }

    private function updateSession()
    {
        foreach($this->cart as $articleId => $amount)
        {
            if($amount <= 0)
            {
                unset($this->cart[$articleId]);
            }
        }

        $_SESSION['cart'] = $this->cart;
    }
}