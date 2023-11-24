<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.ini.php';

class Database {
    public $conn;
    private $connected;

    public function __Construct($data){
        if($this->connected){
            return;
        }
        try {
            $this->conn = new PDO("mysql:host=".$data['servername'].";dbname=".$data['databasename'].";", $data['username'], $data['password']);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e) {
            error_log($e);
            echo "Database couldn't connect!<br> Please check your database info.<br>";
            error_reporting(0);
            exit;
        }
        catch (Exception $e) {
            echo "An exception has occured!";
        }
        $this->connected = true;
    }
}

