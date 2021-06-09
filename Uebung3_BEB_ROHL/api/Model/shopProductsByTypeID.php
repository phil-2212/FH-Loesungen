<?php


class shopProductsByTypeID implements DBQuery
{

    private string $sql;
    private DatabaseModel $shopDatabase;
    private mixed $articleId;

    public function __construct($typeId)
    {
        $this->shopDatabase = new DatabaseModel();
        $this->articleId = $typeId;
        $this->sql = "SELECT t.name AS productTypeName, p.name AS productName, p.id AS id FROM product_types t JOIN products p ON t.id = p.id_product_types WHERE t.id = {$this->articleId}";


    }

    public function createDBQuery():array
    {


        $stmt = $this->shopDatabase->getShopDatabase()->prepare($this->sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $productsByTypeIdArray["productType"] = $result['0']['productTypeName'];
        foreach ($result as $item){
            $productsByTypeIdArray["products"][] = array("name" => $item['productName'], "id" => $item['id']);
        }
        $productsByTypeIdArray["url"] = "http://localhost:63355/Uebung3_BEB_ROHL/index.php?action=listTypes";



        return $productsByTypeIdArray;


    }
}