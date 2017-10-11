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
			':CL_NOM' =>  $client["nom"],
			':CL_PRENOM' =>  $client["prenom"],
			':CL_LOCALITE' =>  $client["ville"],
			':CL_PAYS' =>  $client["pays"],
			':CL_CA' =>  $client["ca"],
			':CL_TYPE' =>  $client["type"],
			':EMP_ENUME' =>  $client["enume"]
		));
	}
	public function supprimerClient($num)
	{
		var_dump($num);
		$sql = "DELETE FROM CDI_CLIENT where CL_NUMERO='$num'";
		var_dump($sql);
		$query = $this->db->prepare($sql);
		$query->execute();
	}
	public function getClient($num)
	{
		$sql = "SELECT CL_NOM,CL_PRENOM,CL_LOCALITE,CL_PAYS FROM cdi_client where CL_NUMERO='$num'";
		$query = $this->db->prepare($sql);
		$query->execute();
		$query=$query->fetch();
		$client["nom"]=$query["CL_NOM"];
		$client["prenom"]=$query["CL_PRENOM"];
		$client["ville"]=$query["CL_LOCALITE"];
		$client["pays"]=$query["CL_PAYS"];

		return $client;
	}
}