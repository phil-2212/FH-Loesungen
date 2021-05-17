<?php


class ProductTypeModel implements QueryInterface
{
    private $db;
    private $conn;
    private $resultArray;
    private $counter = 1;

    public function __construct()
    {
        $this->db = new Database();
        $this->conn = $this->db->connect();
    }

    public function runQuery($productTypeData)
    {
        $query = "SELECT id, name FROM product_types ORDER BY id;";

        $statement = $this->conn->prepare($query);
        $statement->execute();
        return $statement;
    }

    private function setUrlDirect($counter)
    {
         $url = 'http://' . $_SERVER['HTTP_HOST'] .
               '/KNAF_BE_Uebung3/index.php?action=listProductsByTypeId&typeId=' . $counter;

         return $url;
    }

    public function setResultArray($statement)
    {
        foreach ( $statement as $row ) {
            $this->resultArray[] = array(
                'productType' => $row['name'],
                'url' => $this->setUrlDirect($this->counter)
            );
            $this->counter++;
        }
        return $this->resultArray;
    }
}