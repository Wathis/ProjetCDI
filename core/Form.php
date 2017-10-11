<?php


class Form {

    const TAILLE_MAX_NOM_PRENOM = 25;

    /**
     * Charger les valeurs dans le formulaire qui sont presentes dans le tableau $_POST
     * @param nom des formulaires
     * @return array
     */
	public function chargerValeursFormulairePost($names) {
        $informationForm = array();
        foreach ($names as $name) {
            if (isset($_POST[$name])) {
                $informationForm[$name] = $this->decoderChampSecurise($_POST[$name]);
            }   
        }
        return $informationForm;
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
            "nom" => isset($_POST["nom"]) ? $_POST["nom"] : "",
            "prenom" => isset($_POST["nom"]) ? $_POST["prenom"] : "",
            "localite" => isset($_POST["localite"]) ? $_POST["localite"] : "",
            "ville" => isset($_POST["ville"]) ? $_POST["ville"] : NULL,
            "pays" => isset($_POST["pays"]) ? $_POST["pays"] : NULL,
            "enume" => isset($_POST["enume"]) ? $_POST["enume"] : NULL,
            "type" => isset($_POST["type"]) ? $_POST["type"] : NULL,
            "ca" => isset($_POST["ca"]) ? $_POST["ca"] : NULL
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
	public function supprimerAccent($champ) {
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

    public function supprimerAccentsSurMajuscules($champ)
    {
        $champ = preg_replace('#È|É|Ê|Ë#', 'E', $champ);
        $champ = preg_replace('#À|Á|Â|Ã|Ä|Å#', 'A', $champ);
        $champ = preg_replace('#Ì|Í|Î|Ï#', 'I', $champ);
        $champ = preg_replace('#Ò|Ó|Ô|Õ|Ö#', 'O', $champ);
        $champ = preg_replace('#Ù|Ú|Û|Ü|Ŭ#', 'U', $champ);
        return preg_replace('#Ý#', 'Y', $champ);
    }

    public function supprimerCaracteresSpeciaux($champ) {
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

	public function cassePrenom($champ)
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
    public function majusculesApresTiret($champ) {
        $champSepare = explode('-',$champ);
        foreach ($champSepare as $index=>$contenu) {
            $champSepare[$index] = mb_convert_case(mb_strtolower($contenu), MB_CASE_TITLE, "UTF-8");
        }
        return implode('-',$champSepare);
    }

    /*
     * Mettre des majuscules sur la première lettre après les quote et le début
     */
    public function majusculesApresQuotes($champ) {
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
    public function supprimerLesEspacesEnTrop($champ) {
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

    public function faireUnTest() {
        $champ = "b\a";
        if ($this->faireToutesLesVerifications($champ)) {
            return "Nom :" . $this->transformerChampEnNom($champ) . " Prenom : " . $this->transformerChampEnPrenom($champ);
        }
        return "interdit";
    }

    /**
     * Verifier si le champ n'a pas de tiret  ( fin et début )
     * @param $champ
     * @return Le champ modifié
     */
    public function supprimerTiretsEtEspacesALaFin($champ)
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

    /*
     * Executer toutes les verifications qui menent à champ interdit
     * Return true si le champ passe tous les tests ( Est donc valide )
     */
    public function faireToutesLesVerifications($champ){
        return $this->verifierLesBackSlashs($champ) &&  $this->verifierLesQuotes($champ)
            && $this->verifierLesDoublesTirets($champ) && $this->verifierLeSigneEuro($champ) &&
            $this->verifierLesGuillemets($champ) && $this->verifierLesExclamations($champ) && $this->verifierLeGrandTiret($champ) && $this->verifierLaLongueurDuChamp($champ);
    }

    /*
     * Verifier si la chaine contient des doubles tirets
     * @return true si verifiation est correcte
     */
    private function verifierLesDoublesTirets($champ) {
        return !preg_match("/--/",$champ);
    }

    /**
     * Verifier si la chaine contient des doubles guillemets
     * Return true si la verification est correcte
     */
    private function verifierLesGuillemets($champ) {
        return !preg_match("/\"/",$champ);
    }

    /**
     * Verifier si la chaine contient des quotes
     * Return true si la verification est correcte
     */
    private function verifierLesQuotes($champ)  {
        return !preg_match("/^'$/",$champ) && !preg_match("/''/",$champ);
    }

    /**
     * Verifie si la chaine contient un point d'exclamation
     * @param $champ
     * @return bool
     */
    public function verifierLesExclamations($champ) {
        return !preg_match("/!/",$champ);
    }

    /**
     * Verifier si le champ contient un signe euro car interdit
     * @param $champ
     * @return int
     */
    private function verifierLeSigneEuro($champ) {
        return !preg_match('/€/',$champ);
    }

    /**
     * Verifier si le champs contient des backslach -> si oui interdit
     * Return true si la chaine ne contient pas de backslash
     */
    private function verifierLesBackSlashs($champ) {
        return !preg_match("/(\\\)+/",$champ);
    }
//test
    /**
     * Renvoie true si la chaine est inferieur à TAILLE_MAX_NOM_PRENOM
     * @param $champ
     * @return bool
     */
    private function verifierLaLongueurDuChamp($champ) {
        return mb_strlen($champ) <= self::TAILLE_MAX_NOM_PRENOM;
    }

    /**
     * Verifier si le champ contient un grand tiret
     * @param $champ
     * @return bool
     */
    private function verifierLeGrandTiret($champ) {
        return !preg_match("/—/",$champ);
    }
}