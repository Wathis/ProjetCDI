<?php


class Form {

    const TAILLE_MAX_NOM_PRENOM = 25;
    const AUTHORIZED_SPECIALS_CHARS = "àâäéèêëïîôöùûüÿçœæ";

    /**
     * Charger les valeurs dans le formulaire qui sont presentes dans le tableau $_POST
     * @param nom des formulaires
     * @return array
     */
	public function chargerValeursFormulairePost($names) {
        $informationForm = array();
        foreach ($names as $name) {
            if (isset($_POST[$name])) {
                $informationForm[$name] = $_POST[$name];
            }   
        }
        return $informationForm;
	}

    function validerDate($date) {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }

    /**
     * Securise un champ pour l'insertion bdd
     * @param $champ
     * @return string
     */
    public function securiserChamp($champ) {
        $champ = htmlspecialchars($champ);
        return htmlentities($champ);
    }

    /**
     * Decode un champ securisé
     * @param $champ
     * @return string
     */
    public function decoderChampSecurise($champ) {
        $champ = htmlspecialchars_decode($champ);
        return html_entity_decode($champ);
    }

    // Renvoie null si le champ est vide
    public function securiserLesChamps($champs) {
        foreach ($champs as $id => $champ) {
            $champs[$id] = $this->securiserChamp($champ);
        }
        return $champs;
    }


	/**
	 * Savoir si les champs d'un formulaire sont remplis
	 * @param Champs à verifier
	*/
	public static function champsSontRemplisPost($champs) {
		foreach ($champs as $champ) {
			if (!isset($_POST[$champ]) || empty($_POST[$champ])) {
				return false;
			}
		}
		return true; 
	
}
	/**
	 * Permet de remplir un champ d'un formulaire si il a déjà été rempli 
	*/
	public static function remplirChamp($tab,$champ) {
		echo isset($tab[strtoupper($champ)]) ? $tab[strtoupper($champ)] : '';
	}

    //#######################################################################################################
    //############################## FONCTIONS DE MODIFICATIONS  ############################################
    //#######################################################################################################

    /**
     * Transforme un champ en nom valide
     * Attention : Ne pas oublier à utiliser la fonction faireToutesLesVerifications() pour verifier si le nom est valide
     * @param $champ
     * @return string
     */
    public function transformerChampEnNom($champ) {
	    $champ = $this->supprimerAccent($champ);
	    $champ = $this->supprimerCaracteresSpeciaux($champ);
        $champ = $this->supprimerLesEspacesEnTrop($champ);
        $champ = $this->supprimerTiretsEtEspacesALaFin($champ);
        return $champ = $this->mettreMajuscule($champ);
    }

    //Transforme un champ en prenom
    public function transformerChampEnPrenom($champ){
        $champ = $this->supprimerLesEspacesEnTrop($champ);
        $champ = $this->supprimerTiretsEtEspacesALaFin($champ);
        $champ = $this->supprimerCaracteresSpeciaux($champ);
        $champ = $this->cassePrenom($champ);
        if ($champ == "x") {
            $champ = strtoupper($champ);
        }
        return $champ;
    }

    /**
     * Extrait les informations du client present dans le tableau POST
     */
    public function extraireClientDuPost() {
        $client = array(
            "CL_NOM" => isset($_POST["CL_NOM"]) ? $_POST["CL_NOM"] : "",
            "CL_PRENOM" => isset($_POST["CL_PRENOM"]) ? $_POST["CL_PRENOM"] : "",
            "CL_LOCALITE" => isset($_POST["CL_LOCALITE"]) ? $_POST["CL_LOCALITE"] : "",
            "CL_PAYS" => isset($_POST["CL_PAYS"]) ? $_POST["CL_PAYS"] : "",
            "EMP_ENUME" => isset($_POST["EMP_ENUME"]) ? $_POST["EMP_ENUME"] : NULL,
            "CL_TYPE" => isset($_POST["CL_TYPE"]) ? $_POST["CL_TYPE"] : NULL,
            "CL_CA" => isset($_POST["CL_CA"]) ? $_POST["CL_CA"] : NULL
        );
        return $client;
    }

	public function mettreMajuscule($champ) {
		return strtoupper($champ);
	}

	public function mettreMinuscule($champ) {
		return strtolower($champ);
	}

	/*
	 * Retire les accents dans la chaine
	 */
	private function supprimerAccent($champ) {
	    $champ = preg_replace('#è|é|ê|ë#', 'e', $champ);
	    $champ = preg_replace('#È|É|Ê|Ë#', 'E', $champ);
	    $champ = preg_replace('#à|á|â|ã|ä|å#', 'a', $champ);
	    $champ = preg_replace('#À|Á|Â|Ã|Ä|Å#', 'A', $champ);
	    $champ = preg_replace('#ì|í|î|ï#', 'i', $champ);
	    $champ = preg_replace('#Ì|Í|Î|Ï#', 'I', $champ);
	    $champ = preg_replace('#ð|ò|ó|ô|õ|ö#', 'o', $champ);
	    $champ = preg_replace('#Ò|Ó|Ô|Õ|Ö#', 'O', $champ);
	    $champ = preg_replace('#ù|ú|û|ü#', 'u', $champ);
	    $champ = preg_replace('#Ù|Ú|Û|Ü|Ŭ#', 'U', $champ);
	    $champ = preg_replace('#ý|ÿ#', 'y', $champ);
	    return preg_replace('#Ý#', 'Y', $champ);
    }

    private function supprimerAccentsSurMajuscules($champ)
    {
        $champ = preg_replace('#È|É|Ê|Ë#', 'E', $champ);
        $champ = preg_replace('#À|Á|Â|Ã|Ä|Å#', 'A', $champ);
        $champ = preg_replace('#Ì|Í|Î|Ï#', 'I', $champ);
        $champ = preg_replace('#Ò|Ó|Ô|Õ|Ö#', 'O', $champ);
        $champ = preg_replace('#Ù|Ú|Û|Ü|Ŭ#', 'U', $champ);
        return preg_replace('#Ý#', 'Y', $champ);
    }

    private function supprimerCaracteresSpeciaux($champ) {
        //A tester car fait avec mon mac les symboles
        $champ = preg_replace('#Ç#', 'C', $champ);
        $champ = preg_replace('#ç#', 'c', $champ);
        $champ = preg_replace('#@#', 'A', $champ);
        //A tester car fait avec mon mac les symboles
        $champ = preg_replace('/ñ/','n',$champ);
        $champ = preg_replace('/œ/','oe',$champ);
        $champ = preg_replace('/Œ/','OE',$champ);
        $champ = preg_replace('/æ/','ae',$champ);
        $champ = preg_replace('/Æ/','AE',$champ);
        $champ = preg_replace('#ø#', 'o', $champ);
        return $champ = preg_replace('#Ø#', 'O', $champ);
    }

	private function cassePrenom($champ)
	{
		$champ = $this->mettreMinuscule($champ);
		$prem = $this->supprimerAccent($champ[0]);
		for ($i=1; $i<strlen($champ); $i++) {
			$prem= $prem.$champ[$i];
		}
		$prem = $this->majusculesApresTiret($prem);
		$prem = $this->majusculesApresQuotes($prem);
		$prem = $this->supprimerAccentsSurMajuscules($prem);
		return $prem;
	}

    /*
     * Mettre des majuscules sur la première lettre après les tirets et le début
    */
    private function majusculesApresTiret($champ) {
        $champSepare = explode('-',$champ);
        foreach ($champSepare as $index=>$contenu) {
            $champSepare[$index] = mb_convert_case(mb_strtolower($contenu), MB_CASE_TITLE, "UTF-8");
        }
        return implode('-',$champSepare);
    }

    /*
     * Mettre des majuscules sur la première lettre après les quote et le début
     */
    private function majusculesApresQuotes($champ) {
        $champSepare = explode("'",$champ);
        $this->supprimerCaracteresSpeciaux($champ);
        foreach ($champSepare as $index=>$contenu) {
            $champSepare[$index] = mb_convert_case(mb_strtolower($contenu), MB_CASE_TITLE, "UTF-8");
        }
        return implode("'",$champSepare);
    }

    /**
     * Transformer les multiples espaces en simple espace
     */
    private function supprimerLesEspacesEnTrop($champ) {
        //Remplace les espaces multiples par un seul espace
        $model = "#(\s)+#";
        $champ = preg_replace($model," ",$champ);
        //Remplace les espace apres les quote par une quote
        $model = "/(\s)*'\s'(\s)*/";
        $champ = preg_replace($model,"' '",$champ);
        //Remplace les espaces en trop apres et avant un tiret
        $model = "#(\s*-\s*)#";
        return preg_replace($model,"-",$champ);
    }

    /**
     * Verifier si le champ n'a pas de tiret  ( fin et début )
     * @param $champ
     * @return Le champ modifié
     */
    private function supprimerTiretsEtEspacesALaFin($champ)
    {
        $model = "/(^[\s-]+)|([\s-]$)/";
        if (preg_match($model, $champ)) {
            return preg_replace($model, "", $champ);
        }
        return $champ;
    }

    //#######################################################################################################
    //############################## FONCTIONS DE VERIFICATIONS  ############################################
    //#######################################################################################################


    /**
     *  Autorise ce genre de modèle : Ébé-ébé
    */ 
    private function verifierChampAvecTiret($champ){
        return preg_match("/^[a-zA-Z" . self::AUTHORIZED_SPECIALS_CHARS . "]+-[a-zA-Z" . self::AUTHORIZED_SPECIALS_CHARS . "]+$/", $champ);
    } 
    /**
     *  Autorise ce genre de modèle : Péron-De-La Branche et Branche peron-de-la et Brance-de peron-de et Pierre Jean 
    */ 
    private function verifierChampAvecTiretEtEspaces($champ){
        return preg_match("/^(([a-zA-Z" . self::AUTHORIZED_SPECIALS_CHARS . "]+(-|)[a-zA-Z" . self::AUTHORIZED_SPECIALS_CHARS . "]*)+\s([a-zA-Z" . self::AUTHORIZED_SPECIALS_CHARS . "]+(-|)[a-zA-Z" . self::AUTHORIZED_SPECIALS_CHARS . "]+)*)+$/", $champ);
    } 

    /**
     *  Autorise ce genre de modèle : Pierre' 'Jean
    */ 
    private function verifierChampAvecQuotes($champ) {
        return preg_match("/^('|)[a-zA-Z". self::AUTHORIZED_SPECIALS_CHARS ."]+'\s'[a-zA-Z". self::AUTHORIZED_SPECIALS_CHARS ."]+('|)$/",$champ);
    }

    /**
     *  Autorise ce genre de modèle : Pierre' ou 'Pierre ou Pierre
    */ 
    private function verifierChampAvecQuote($champ) {
        return preg_match("/^('|)[a-zA-Z". self::AUTHORIZED_SPECIALS_CHARS ."]+('|)$/",$champ);
    }

    /**
     *  Autorise ce genre de modèle : 'éÉ'é-É'bé'
    */ 
    private function verifierChampAvecQuoteEtTirets($champ) {
        return preg_match("/^'[a-zA-Z". self::AUTHORIZED_SPECIALS_CHARS ."]+('|)[a-zA-Z". self::AUTHORIZED_SPECIALS_CHARS ."]+-[a-zA-Z". self::AUTHORIZED_SPECIALS_CHARS ."]+('|)[a-zA-Z". self::AUTHORIZED_SPECIALS_CHARS ."]+'$/",$champ);
    }

    /**
     * Renvoie true si la chaine est inferieur à TAILLE_MAX_NOM_PRENOM
     * @param $champ
     * @return bool
     */
    private function verifierLaLongueurDuChamp($champ) {
        return mb_strlen($champ) <= self::TAILLE_MAX_NOM_PRENOM;
    }

    /**
     * Autorise ce genre de modèle : Delaunay--Gouet Lebrun   OU   Delaunay Gouet--Lebrun
    */
    private function verifierChampAvecUnDoubleTiret($champ) {
        return preg_match("/^('|)(([a-zA-Z". self::AUTHORIZED_SPECIALS_CHARS ."]+('|)[a-zA-Z". self::AUTHORIZED_SPECIALS_CHARS ."]+--[a-zA-Z". self::AUTHORIZED_SPECIALS_CHARS ."]+('|)[a-zA-Z". self::AUTHORIZED_SPECIALS_CHARS ."]+(\s[a-zA-Z". self::AUTHORIZED_SPECIALS_CHARS ."]+('|)[a-zA-Z". self::AUTHORIZED_SPECIALS_CHARS ."]+)*)|([a-zA-Z". self::AUTHORIZED_SPECIALS_CHARS ."]+('|)[a-zA-Z". self::AUTHORIZED_SPECIALS_CHARS ."]+\s[a-zA-Z". self::AUTHORIZED_SPECIALS_CHARS ."]+('|)[a-zA-Z". self::AUTHORIZED_SPECIALS_CHARS ."]+(--[a-zA-Z". self::AUTHORIZED_SPECIALS_CHARS ."]+('|)[a-zA-Z". self::AUTHORIZED_SPECIALS_CHARS ."]+)*))('|)$/",$champ);
    }

    /**
     * Verifie si un prenom est bien formaté 
     * Return true si le nom passe au moins un des test requis
    */
    public function verifierLePrenom($prenom) {
        //$this->debugVerifications($prenom);
        $prenom = $this->transformerChampEnPrenom($prenom);
        return  $this->verifierLaLongueurDuChamp($prenom) 
                && 
                ( 
                    $this->verifierChampAvecQuoteEtTirets($prenom)
                    || $this->verifierChampAvecQuote($prenom) 
                    || $this->verifierChampAvecQuotes($prenom) 
                    || $this->verifierChampAvecTiretEtEspaces($prenom) 
                    || $this->verifierChampAvecTiret($prenom) 
                );
    }

    /**
     * Verifie si un nom est bien formaté 
     * Return true si le nom passe au moins un des test requis
    */
    public function verifierLeNom($nom){
        // $this->debugVerifications($nom);
        $nom = $this->transformerChampEnNom($nom);
        return  $this->verifierLaLongueurDuChamp($nom) 
                && 
                ( 
                    $this->verifierChampAvecQuoteEtTirets($nom)
                    || $this->verifierChampAvecQuote($nom) 
                    || $this->verifierChampAvecQuotes($nom)
                    || $this->verifierChampAvecTiretEtEspaces($nom) 
                    || $this->verifierChampAvecTiret($nom)
                    || $this->verifierChampAvecUnDoubleTiret($nom) 
                );
    }

    //Permet de debuger pour voir quelle verification est passée à true
    public function debugVerifications($champ) {
        echo $this->verifierLaLongueurDuChamp($champ) . " => verifierLaLongueurDuChamp<br \>";
        echo $this->verifierChampAvecQuoteEtTirets($champ) . " => verifierChampAvecQuoteEtTirets<br \>";
        echo $this->verifierChampAvecQuote($champ) . " => verifierChampAvecQuote<br \>";
        echo $this->verifierChampAvecQuotes($champ) . " => verifierChampAvecQuotes<br \>";
        echo $this->verifierChampAvecUnDoubleTiret($champ) . " => verifierChampAvecUnDoubleTiret<br \>";
        echo $this->verifierChampAvecTiretEtEspaces($champ) . " => verifierChampAvecTiretEtEspaces<br \>";
        echo $this->verifierChampAvecTiret($champ) . " => verifierChampAvecTiret<br \>";
    }
}