<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/class.database.php';

//Database configuration PDO
$data['servername'] = "localhost";
$data['username']   = "root";
$data['password']   = '';
$data['databasename'] = "carpickdb";

$database = new Database($data);
$configcreation = new Config($data);
;

