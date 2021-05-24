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

    public function setUrlDirect($i){
     {
         $url = "http://" . $_SERVER['HTTP_HOST'] .
             '/KNAF_FE_Uebung4/api/index.php?action=listProductsByTypeId&typeId=' . $i;

         return $url;
     }
}

    public function setResultArray($statement){

        foreach ( $statement as $row ) {

            $this->resultArray[] = array(
                'id'=> $row['id'],
                'productType' => $row['name'],
                'url' => $this->setUrlDirect($this->counter)
            );
            $this->counter++;
        }
        return $this->resultArray;

    }
}