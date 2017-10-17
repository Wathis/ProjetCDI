<?php 
class Client extends Model {

	public function __construct($db) {
        parent::__construct($db);
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
		$sql = "SELECT count(*) FROM CDI_COMMANDE WHERE CL_NUMERO = '$num'"; 
		$query = $this->db->prepare($sql); 
		$query->execute(); 
		$nbr = $query->fetchColumn(); 
		if ($nbr == 0 ) {
			$sql = "DELETE FROM CDI_CLIENT where CL_NUMERO='$num'";
			$query = $this->db->prepare($sql);
			$query->execute();
			return true;
		} else {
			return false;
		}
	}
	public function getClient($num)
	{
		$sql = "SELECT * FROM cdi_client where CL_NUMERO='$num'";
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetch(PDO::FETCH_ASSOC);
	}
	public function modifierClient($client,$num)
	{
		$sql = 'UPDATE cdi_client set CL_NOM= :CL_NOM,CL_PRENOM= :CL_PRENOM,CL_LOCALITE= :CL_LOCALITE,CL_PAYS= :CL_PAYS,CL_CA= :CL_CA,CL_TYPE= :CL_TYPE,EMP_ENUME= :EMP_ENUME where CL_NUMERO= :CL_NUMERO';
		$query = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$query->execute(array(
			':CL_NUMERO' => $num,
			':CL_NOM' =>  $client["CL_NOM"],
			':CL_PRENOM' =>  $client["CL_PRENOM"],
			':CL_LOCALITE' =>  $client["CL_LOCALITE"],
			':CL_PAYS' =>  $client["CL_PAYS"],
			':CL_CA' =>  $client["CL_CA"],
			':CL_TYPE' =>  $client["CL_TYPE"],
			':EMP_ENUME' =>  $client["EMP_ENUME"] !=''?  $client['EMP_ENUME'] : null
		));
		var_dump($client);
		var_dump($num);
	}
}