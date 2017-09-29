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

    //#######################################################################################################
    //############################## FONCTIONS DE MODIFICATIONS  ############################################
    //#######################################################################################################

	public function mettreMajuscule($champ) {
		return strtoupper($champ);
	}

	public function mettreMinuscule($champ) {
		return strtolower($champ);
	}

	/*
	 * Retire les accents dans la chaine
	 */
	public function retirerAccent($champ) {
		$champ = preg_replace('#Ç#', 'C', $champ);
	    $champ = preg_replace('#ç#', 'c', $champ);
	    $champ = preg_replace('#è|é|ê|ë#', 'e', $champ);
	    $champ = preg_replace('#È|É|Ê|Ë#', 'E', $champ);
	    $champ = preg_replace('#à|á|â|ã|ä|å#', 'a', $champ);
	    $champ = preg_replace('#@|À|Á|Â|Ã|Ä|Å#', 'A', $champ);
	    //A tester car fait avec mon mac les symboles
	    $champ = preg_replace('/œ/','oe',$champ);
        $champ = preg_replace('/Œ/','OE',$champ);
        $champ = preg_replace('/æ/','ae',$champ);
        $champ = preg_replace('/Æ/','AE',$champ);
	    $champ = preg_replace('#ì|í|î|ï#', 'i', $champ);
	    $champ = preg_replace('#Ì|Í|Î|Ï#', 'I', $champ);
	    $champ = preg_replace('#ð|ò|ó|ô|õ|ö#', 'o', $champ);
	    $champ = preg_replace('#Ò|Ó|Ô|Õ|Ö#', 'O', $champ);
	    $champ = preg_replace('#ù|ú|û|ü#', 'u', $champ);
	    $champ = preg_replace('#Ù|Ú|Û|Ü#', 'U', $champ);
	    $champ = preg_replace('#ý|ÿ#', 'y', $champ);
	    return preg_replace('#Ý#', 'Y', $champ);
	}
	public function cassePrenom($champ)
	{
		$champ = $this->mettreMinuscule($champ);
		$prem = $this->retirerAccent($champ[0]);
		for ($i=1; $i<strlen($champ); $i++) {
			$prem= $prem.$champ[$i];
		}
		$prem = ucwords($prem);
		$tab = $this->rechercheTiret($prem);
        $this->majusculeApresTiret($prem,$tab);
		return $prem;
	}
	public static function rechercheTiret($champ)
	{
		$tab = array();
		$i=0;
		while (preg_match("#-#", $champ))
		{
			$tab[$i]=strpos($champ,"-");
			$champ[$tab[$i]]="a";
			$i++;
		}
		return $tab;
	}

	public function majusculeApresTiret($champ,$tab)
	{
		foreach ($tab as $i) {
			$champ[$tab[$i]]= $this->mettreMajuscule($champ[$tab[$i]]);
		}
		return $champ;
	}

    /**
     * Transformer les multiples espaces en simple espace
     */
    public function supprimerLesEspacesMultiples($champ) {
        $model = "/(\/s)+/";
        return preg_replace($model," ",$champ);
    }

    /*
    * Mettre des majuscules sur la première lettre après les tirets et le début
    */
    public function majusculesApresTiret($champ) {
        return implode('-', array_map('ucwords', explode('-', $champ)));
    }

    public function faireUnTest() {
        $champ = $this->supprimerTiretsEtEspacesALaFin(" qzdqzd-qzdq zd");
        return $this->majusculesApresTiret($champ);
    }

    /**
     * Verifier si le champ n'a pas de tiret  ( fin et début )
     * @param $champ
     * @return Le champ modifié
     */
    public function supprimerTiretsEtEspacesALaFin($champ) {
        $model = "/(^[\s-]+)|([\s-]$)/";
        if (preg_match($model,$champ)) {
            return preg_replace($model,"",$champ);
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
    private function faireToutesLesVerifications($champ){
        if ($this->verifierLesBackSlashs($champ) &&  $this->verifierLesQuotes($champ)
            && $this->verifierLesDoublesTirets($champ) && $this->verifierLeSigneEuro($champ)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $champ
     */

    /*
     * Verifie la validité d'un nom
     */
    public function verifierValiditeChamp($champ) {
        return $this->faireToutesLesVerifications($champ);
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
        return !preg_match("/^'$/",$champ);
    }

    /**
     * Verifier si le champ contient un signe euro car interdit
     * @param $champ
     * @return int
     */
    private function verifierLeSigneEuro($champ) {
        return preg_match('/€/',$champ);
    }

    /**
     * Verifier si le champs contient des backslach -> si oui interdit
     * Return true si la chaine ne contient pas de backslash
     */
    private static function verifierLesBackSlashs($champ) {
        return !preg_match("/(\\\)+/",$champ);
    }
}