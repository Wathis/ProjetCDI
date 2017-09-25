<?php
class Controller
{
    public $bdd;
    public $model;

    function __construct() {
        $this->ouvrirLaConnexionBDD();
    }

    private function ouvrirLaConnexionBDD() {
        //Configuration de la database
        try {
            $this->bdd = new PDO(BDD_TYPE . ':host=' . BDD_HOST . ';dbname=' . BDD_NAME . ';',BDD_USER, BDD_PASS);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    protected function loadModel($modelName) {
        require APP . 'model/' . $modelName . '.php';
        $this->model = new $modelName($this->bdd);
    }
}
