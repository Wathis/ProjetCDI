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
	//$informations est un tableau associatif
	public function ajouterUnClient($informations)
	{
		$sql = 'SELECT max(CAST(SUBSTR(CL_NUMERO,2)as UNSIGNED INT)) as maxi FROM cdi_client ';
		$query = $this->db->prepare($sql);
		$query->execute();
		$query=$query->fetch();
		$num = 'C'.($query["maxi"]+1) ;

		$nom =$this->securiserChamp($informations["nom"]);
		$prenom =$this->securiserChamp($informations["prenom"]);
		$ville =$this->securiserChamp($informations["ville"]);
		$pays =$this->securiserChamp($informations["pays"]);
		if (empty($informations["ca"]))
		{
			$ca=NULL;
		}
		else
		{
			$ca =$this->securiserChamp($informations["ca"]);		
		}
		$type =$this->securiserChamp($informations["type"]);
		if (empty($informations["enume"]))
		{
			$enume=NULL;
		}
		else
		{
			$enume =$this->securiserChamp($informations["enume"]);			
		}
		echo $num;
		echo ($nom);
		echo ($prenom);
		echo ($ville);
		echo ($pays);
		echo ($ca);
		echo ($type);
		echo ($enume);
		$sql = 'INSERT INTO cdi_client (CL_NUMERO,CL_NOM,CL_PRENOM,CL_LOCALITE,CL_PAYS,CL_CA,CL_TYPE,EMP_ENUME) VALUES (:CL_NUMERO,:CL_NOM,:CL_PRENOM,:CL_LOCALITE,:CL_PAYS,:CL_CA,:CL_TYPE,:EMP_ENUME)';


		$query = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

		$query->execute(array(
			':CL_NUMERO' => $num,
			':CL_NOM' =>  $nom,
			':CL_PRENOM' =>  $prenom,
			':CL_LOCALITE' =>  $ville,
			':CL_PAYS' =>  $pays,
			':CL_CA' =>  $ca,
			':CL_TYPE' =>  $type,
			':EMP_ENUME' =>  $enume
		));
	}

	private function securiserChamp($champ)
	{
		htmlspecialchars($champ);
		return htmlentities($champ);
	}

}