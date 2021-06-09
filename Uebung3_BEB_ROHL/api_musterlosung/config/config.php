<?php


include "api_musterlosung/controller/ProductsController.php";
include "api_musterlosung/services/Database.php";
include "api_musterlosung/models/pdoDBGateway.php";


include "api_musterlosung/models/productTypesModel.php";
include "api_musterlosung/models/productsModel.php";
include "api_musterlosung/views/JsonView.php";
include "api_musterlosung/models/cartModel.php";

define("DBHost", "localhost");
define("DBName", "beb_uebung_4");
define("DBPassword", "");
define("DBUsername", "root");
