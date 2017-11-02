<?php 
class Client extends Model {

	public function __construct($db) {
        parent::__construct($db);
    }

	public function getAllClients() {
		$sql = 'SELECT * FROM CDI_CLIENT';
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}

	//Recupere les numeros des clients qui ont des commandes en retard ( 5 jours )
	public function getClientRetards() {

		$sql = 'SELECT CL_NUMERO FROM CDI_CLIENT WHERE CL_NUMERO IN ( SELECT CL_NUMERO FROM CDI_COMMANDE WHERE CO_NUMERO IN ( SELECT CO_NUMERO FROM CDI_LIGCDE WHERE LIC_QTCMDEE > LIC_QTLIVREE ) AND DATE_ADD(CO_DATE, INTERVAL 5 DAY) < NOW() )';
		$query = $this->db->prepare($sql);
		$query->execute();
		$results = $query->fetchAll();
		$clients = array();
		foreach ($results as $result) {
			$clients[] = $result["CL_NUMERO"];
		}
		return $clients;
	}

	public function getClientsRecherche($champ,$choix,$ordre) {
		$choix= htmlspecialchars($choix);
		$champ=htmlspecialchars($champ);
		$sql = 'SELECT * FROM CDI_CLIENT where '.$choix.' LIKE "%'.$champ.'%" order by '.$choix.' '.$ordre.'';
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}
	public function getClientOrder($choix,$ordre){
        $choix= htmlspecialchars($choix);
        $sql = 'SELECT * FROM CDI_CLIENT order by '.$choix.' '.$ordre.'';
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    // Fonction pour ajouter un nouveau client dans la base
    // Client est tableau associatif des informations du client
	public function ajouterUnClient($client) {
		$num = $this->getMaxId('CDI_CLIENT','CL_NUMERO','C');

		$sql = 'INSERT INTO CDI_CLIENT (CL_NUMERO,CL_NOM,CL_PRENOM,CL_LOCALITE,CL_PAYS,CL_CA,CL_TYPE,EMP_ENUME) VALUES (:CL_NUMERO,:CL_NOM,:CL_PRENOM,:CL_LOCALITE,:CL_PAYS,:CL_CA,:CL_TYPE,:EMP_ENUME)';
		$query = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

		$query->execute(array(
			':CL_NUMERO' => $num,
			':CL_NOM' =>  $client["CL_NOM"],
			':CL_PRENOM' =>  $client["CL_PRENOM"],
			':CL_LOCALITE' =>  $client["CL_LOCALITE"],
			':CL_PAYS' =>  $client["CL_PAYS"],
			':CL_CA' =>  $client["CL_CA"],
			':CL_TYPE' =>  $client["CL_TYPE"],
			':EMP_ENUME' =>  null
		));
	}

	//Fonction qui supprime un client si celui-ci n'a pas de commande 
	//La fonction renvoie true si le delete a été efféctué
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
		$sql = "SELECT * FROM CDI_CLIENT where CL_NUMERO='$num'";
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetch(PDO::FETCH_ASSOC);
	}
	public function modifierClient($client,$num)
	{
		$sql = 'UPDATE CDI_CLIENT set CL_NOM= :CL_NOM,CL_PRENOM= :CL_PRENOM,CL_LOCALITE= :CL_LOCALITE,CL_PAYS= :CL_PAYS,CL_CA= :CL_CA,CL_TYPE= :CL_TYPE,EMP_ENUME= :EMP_ENUME where CL_NUMERO= :CL_NUMERO';
		$query = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$query->execute(array(
			':CL_NUMERO' => $num,
			':CL_NOM' =>  $client["CL_NOM"],
			':CL_PRENOM' =>  $client["CL_PRENOM"],
			':CL_LOCALITE' =>  $client["CL_LOCALITE"],
			':CL_PAYS' =>  $client["CL_PAYS"],
			':CL_CA' =>  $client["CL_CA"],
			':CL_TYPE' =>  $client["CL_TYPE"],
			':EMP_ENUME' =>  null
		));
	}
}