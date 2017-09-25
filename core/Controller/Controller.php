<?php
class Controller
{
    public $db;
    public $model;

    function __construct() {
        $this->openDatabaseConnection();
    }

    private function openDatabaseConnection() {
        //Configuration de la database
        $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS);
    }

    protected function loadModel($modelName) {
        require APP . 'model/' . $modelName . '.php';
        $this->model = new $modelName($this->db);
    }
}
