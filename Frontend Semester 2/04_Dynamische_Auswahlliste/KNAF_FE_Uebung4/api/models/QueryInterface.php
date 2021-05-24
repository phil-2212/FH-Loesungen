<?php


interface QueryInterface
{
    public function runQuery($productTypeData);
    public function setResultArray($statement);
}