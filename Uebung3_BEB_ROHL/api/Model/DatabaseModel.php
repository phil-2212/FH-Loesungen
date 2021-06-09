<?php


class DatabaseModel
{
    public $shopDatabase;

    public function __construct()
    {
        $this->shopDatabase = new PDO(DATABASE, USERNAME, PASSWORD);
    }

    /**
     * @return PDO
     */
    public function getShopDatabase(): PDO
    {
        return $this->shopDatabase;
    }
}
