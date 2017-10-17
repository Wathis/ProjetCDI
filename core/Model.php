<?php 


class Model {

	protected $db;

	public function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Connexion à la base de donnée impossible');
        }
    }



}