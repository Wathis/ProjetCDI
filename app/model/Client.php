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

	public function getClientsRecherche($champ,$choix) {
		$choix= htmlspecialchars($choix);
		$champ=htmlspecialchars($champ);
		$sql = 'SELECT * FROM cdi_client where CL_'.$choix.' like "%'.$champ.'%" ';
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}

}