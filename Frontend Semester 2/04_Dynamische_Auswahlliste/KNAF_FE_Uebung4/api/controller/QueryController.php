<?php


class QueryController
{

    private $jsonView;
    private $queryRunner;

    public function __construct(){

        $this->jsonView = new JsonView();
        $this->queryRunner = null;
    }

    public function route(){

        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_SPECIAL_CHARS);
        $typeId = filter_input(INPUT_GET, 'typeId', FILTER_SANITIZE_SPECIAL_CHARS);

        $creationSuccessful = $this->startDataQuery($action);

        if ( $creationSuccessful ) {

            $queryResult = $this->queryRunner->runQuery($typeId);
            $outputData = $this->queryRunner->setResultArray($queryResult);
            $this->jsonView->streamOutput($outputData);

        }else{

            $error = array( 'Error ' => 'You are not connected to the Database' );
            $this->jsonView->streamOutput($error);
        }
    }

    private function startDataQuery($action)
    {
        switch ( strtolower($action) ) {
            case ( 'listtypes' ):
                 $this->queryRunner = new ProductTypeModel();
                 break;
            case ( 'listproductsbytypeid' ):
                 $this->queryRunner = new ProductModel();
                 break;

            case false:
            default:
                return false;
        }
        return true;
    }
}

