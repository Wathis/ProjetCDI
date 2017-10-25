<?php
class Livraison extends Model {

    public function __construct($db) {
        parent::__construct($db);
    }

    //Recuperer toutes les livraisons de la base de donnée
    public function getAllLivraisons() {
        $sql = "SELECT * FROM CDI_LIVRAISON 
                JOIN CDI_LIGLIV USING (li_numero) 
                JOIN CDI_CLIENT USING (CL_NUMERO)
                JOIN CDI_ARTICLE USING (ar_numero)
                JOIN (select * from CDI_LIGCDE) as test USING (ar_numero,co_numero);";
        $query = $this->db->prepare($sql);      
        $query->execute();
        return $query->fetchAll();
    }

    //Permet de recuperer les livraisons concerné par le numero de commande envoyé en parametre
    public function getLivraisonsCommande($co_numero) {
        $sql = 'SELECT * FROM CDI_LIVRAISON  
                JOIN CDI_LIGLIV USING (li_numero) 
                JOIN CDI_CLIENT USING (CL_NUMERO)
                JOIN CDI_ARTICLE USING (ar_numero)
                JOIN (select * from CDI_LIGCDE) as test USING (ar_numero,co_numero) 
                WHERE CO_NUMERO = :co_numero;'
            ;
        $query = $this->db->prepare($sql);
        $parameters = array(':co_numero' => $co_numero);
        $query->execute($parameters);
        return $query->fetchAll();
    }

    //Renvoie les ids des commandes 
    public function getLivraisonsEnRetard(){
        $sql = "SELECT LI_NUMERO FROM CDI_LIVRAISON WHERE CO_NUMERO IN ( 
                    SELECT CO_NUMERO FROM CDI_LIGCDE WHERE LIC_QTCMDEE > LIC_QTLIVREE 
                ) AND DATE_LIV <= NOW()";
        $query = $this->db->prepare($sql);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC); 
        //Extraire juste les ids
        $ids = array();
        foreach ($results as $result) {
            $ids[] = $result["LI_NUMERO"];
        }
        return $ids;
    }

     //Ajouter une quantite d'article a un nouvel 
    public function ajouterUneQuantiteArticleLivre($ar_numero,$li_numero,$quantite) {
        $sql = "SELECT * FROM CDI_LIGCDE WHERE ar_numero = '$ar_numero' AND co_numero = 
                ( 
                    select co_numero from cdi_commande where co_numero = 
                    ( 
                        select distinct co_numero from CDI_LIVRAISON Where li_numero = '$li_numero' 
                    ) 
                );";
        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetch();
        $qteCmdee = intval($result["LIL_QTCMDEE"]);
        $qteLivree = intval($result["LIL_QTLIVREE"]);
        echo $qteLivree;
        echo $qteCmdee;
        $nvQuantite = $qteLivree + intval($quantite);
        echo $nvQuantite;
        if ($qteCmdee - $nvQuantite >= 0) {
            echo "cc";
            $sql = "UPDATE CDI_LIGLIV SET LIL_QTLIVREE = $nvQuantite WHERE ar_numero = '$ar_numero' AND li_numero = '$li_numero'";
            $query = $this->db->prepare($sql);
            $query->execute();
             $sql = "UPDATE CDI_LIGCDE SET LIL_QTLIVREE = $nvQuantite WHERE ar_numero = '$ar_numero' AND co_numero = (select co_numero from cdi_commande where li_numero = '$li_numero')";
            $query = $this->db->prepare($sql);
            $query->execute();
        }
    }

    //Permet de recuperer les livraisons concerné par le numero de client envoyé en parametre
    public function getLivraisonsDuClient($cl_numero) {
        $sql = 'SELECT * FROM CDI_LIVRAISON  
                JOIN CDI_LIGLIV USING (li_numero) 
                JOIN CDI_CLIENT USING (CL_NUMERO)
                JOIN CDI_ARTICLE USING (ar_numero)
                JOIN (select * from CDI_LIGCDE) as test USING (ar_numero,co_numero)
                WHERE CL_NUMERO = :cl_numero';
        $query = $this->db->prepare($sql);
        $parameters = array(':cl_numero' => $cl_numero);
        $query->execute($parameters);
        return $query->fetchAll();
    }
    public function getLivraisonRecherche($champ,$choix,$ordre) {
        $choix= htmlspecialchars($choix);
        $champ=htmlspecialchars($champ);
        $sql = 'SELECT * FROM CDI_LIVRAISON where '.$choix.' like "%'.$champ.'%" order by '.$choix.' '.$ordre.'';
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function getLivraisonOrder($choix,$ordre){
        $choix= htmlspecialchars($choix);
        $sql = 'SELECT * FROM CDI_LIVRAISON order by '.$choix.' '.$ordre.'';
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
}