<?php 

class Form {

	public static function chargerValeursFormulairePost($names) {
        $informationForm = array();
        foreach ($names as $name) {
            if (isset($_POST[$name])) {
                $informationForm[$name] = htmlspecialchars(htmlentities(addslashes($_POST[$name])));
            }   
        }
        return $informationForm;
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
	public static function remplirChamp($tab,$champs) {
		echo isset($tab[$champs]) ? $tab[$champs] : '';
	}

	public function verifierValiditeNom() {
        if ($this->verifierLesBackSlashs() && $this->verifierTiretsEtEspaces() ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Transformer les multiples espaces en simple espace
     */
    public static function supprimerLesEspacesMultiples($champ) {
        $model = "/(\/s)+/";
        return preg_replace($model," ",$champ);
    }


    /**
     * Verifier si le champs contient des backslach -> si oui interdit
     */
	public static function verifierLesBackSlashs($champ) {
        $model = "/(\\\)+/";
        if (preg_match($model,$champ) == true) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Verifier si le champ n'a pas de tiret  ( fin et début )
     * @param $champ
     */
	public static function verifierTiretsEtEspacesALaFin($champ) {
        $model = "/(^[\s-]+)|([\s-]$)/";
        if (preg_match($model,$champ)) {
            return false;
        } else {
            return true;
        }
    }

//	public static function verifierSaisieNouveauClient($champs){
//		$erreur[]
//		$erreur =
//
//
//
//		return $erreur;
//	}

}