<?php


class ProductModel implements QueryInterface
{
    private $conn;
    private $db;
    private $productsArray;
    private $resultArray;

    public function __construct()
    {
        $this->db = new Database();
        $this->conn = $this->db->connect();
    }

    public function runQuery($productTypeData)
    {
        $query = 'SELECT t.name AS productTypeName, p.name AS productName
                  FROM product_types t
                  JOIN products p ON t.id = p.id_product_types
                  WHERE t.id = ? ;';

        $statement = $this->conn->prepare($query);
        $statement->execute([$productTypeData]);
        return $statement;
    }

    private function setUrlDirect()
    {
        $url = 'http://'. $_SERVER['HTTP_HOST'] .
                '/KNAF_BE_Uebung3/index.php?action=listtypes';
        return $url;
    }

    public function setResultArray($statement)
    {
        foreach ( $statement as $row ) {
            $this->productsArray[] = array(
                'name' => $row['productName'] ,
                'url' => $this->setUrlDirect()
            );
        }

        $this->resultArray = array (
               "productType" => $row['productTypeName'] ,
               "products" => $this->productsArray,
        );
        return $this->resultArray;
    }
}

