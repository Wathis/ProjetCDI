<?php 
class Client {

	private $db;

	public function __construct($db) {

		try {	
			$this->db = $db;
		} catch (PDOException $e) {
			exit('Connexion à la base de donnée impossible');
		}
	}

	public function getAllClients() {
		$sql = 'SELECT * FROM cdi_client';
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}

	public function getClientsRecherche() {
		$_POST["choix"]= htmlentities($_POST["choix"]);
		$_POST["champ"]=htmlentities($_POST["champ"]);
		$sql = 'SELECT * FROM cdi_client where CL_'.$_POST["choix"].' like "%'.$_POST["champ"].'%" ';
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}

}