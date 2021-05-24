/*
 *   First, you need to connect the Backend to your Database.
 *   You will find the configuration params in api/models/Database.php
 */

$(document).ready(()=> {
    let ajaxHandler = new productTypeView();
    ajaxHandler.productTypeAjax();
})