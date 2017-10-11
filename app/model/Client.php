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

	public function getClientsRecherche($champ,$choix,$ordre) {
		$choix= htmlspecialchars($choix);
		$champ=htmlspecialchars($champ);
		$sql = 'SELECT * FROM cdi_client where CL_'.$choix.' like "%'.$champ.'%" order by CL_'.$choix.' '.$ordre.'';
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}

    // Fonction pour ajouter un nouveau client dans la base
    // Client est tableau associatif des informations du client
	public function ajouterUnClient($client) {
		$sql = 'SELECT max(CAST(SUBSTR(CL_NUMERO,2)as UNSIGNED INT)) as maxi FROM cdi_client ';
		$query = $this->db->prepare($sql);
		$query->execute();
		$query=$query->fetch();
		$num = 'C'.($query["maxi"]+1);

		var_dump($client);

		$sql = 'INSERT INTO cdi_client (CL_NUMERO,CL_NOM,CL_PRENOM,CL_LOCALITE,CL_PAYS,CL_CA,CL_TYPE,EMP_ENUME) VALUES (:CL_NUMERO,:CL_NOM,:CL_PRENOM,:CL_LOCALITE,:CL_PAYS,:CL_CA,:CL_TYPE,:EMP_ENUME)';
		$query = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

		$query->execute(array(
			':CL_NUMERO' => $num,
			':CL_NOM' =>  $client["cl_nom"],
			':CL_PRENOM' =>  $client["cl_prenom"],
			':CL_LOCALITE' =>  $client["cl_ville"],
			':CL_PAYS' =>  $client["cl_pays"],
			':CL_CA' =>  $client["cl_ca"],
			':CL_TYPE' =>  $client["cl_type"],
			':EMP_ENUME' =>  $client["emp_enume"]
		));
	}
	public function supprimerClient($num)
	{
		$sql = "DELETE FROM CDI_CLIENT where CL_NUMERO='$num'";
		$query = $this->db->prepare($sql);
		$query->execute();
	}
	public function getClient($num)
	{
		$sql = "SELECT * FROM cdi_client where CL_NUMERO='$num'";
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetch(PDO::FETCH_ASSOC);
	}
}