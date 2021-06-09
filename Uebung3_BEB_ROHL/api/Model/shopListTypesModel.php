<?php


class shopListTypesModel implements DBQuery
{



    private string $sql;
    private DatabaseModel $shopDatabase;

    public function __construct()
    {
        $this->shopDatabase = new DatabaseModel();
        $this->sql = "SELECT id AS id, name AS productType FROM product_types ORDER BY name";


    }


    public function createDBQuery(): array
    {
        $stmt = $this->shopDatabase->getShopDatabase()->prepare($this->sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($result as $item){
            $categoryArray[] = array("name" => $item["productType"], "URL" => "http://localhost:63355/Uebung3_BEB_ROHL/index.php?action=listProductsByTypeId&typeId={$item["id"]}", "id" => $item["id"]);

        }


        return $categoryArray;


    }
}