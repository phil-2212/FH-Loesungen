<?php

define("DATABASE", "mysql:host=localhost;dbname=beb_uebung_4;charset=utf8");
define("USERNAME", "root");
define("PASSWORD", "");

include "api_musterlosung/models/pdoDBGateway.php";
include "api_musterlosung/models/productsModel.php";
include "api_musterlosung/models/productTypesModel.php";
include "api_musterlosung/models/cartModel.php";
include "api_musterlosung/Model/cartModel.php";
include "api/View/JsonView.php";
include "api/Controller/shopOverviewController.php";

