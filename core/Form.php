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

<<<<<<< HEAD
	public static function verifierSaisieNouveauClient($champs){
		$erreur[]
		$erreur =



		return $erreur; 
	}
	public static function mettreMajuscule($champ)
	{
		return strtoupper($champ);
	} 
	public static function mettreMinuscule($champ)
	{
		return strtolower($champ);
	}
	public static function retirerAccent($champ)
	{
		$champ = preg_replace('#Ç#', 'C', $champ);
	    $champ = preg_replace('#ç#', 'c', $champ);
	    $champ = preg_replace('#è|é|ê|ë#', 'e', $champ);
	    $champ = preg_replace('#È|É|Ê|Ë#', 'E', $champ);
	    $champ = preg_replace('#à|á|â|ã|ä|å#', 'a', $champ);
	    $champ = preg_replace('#@|À|Á|Â|Ã|Ä|Å#', 'A', $champ);
	    $champ = preg_replace('#ì|í|î|ï#', 'i', $champ);
	    $champ = preg_replace('#Ì|Í|Î|Ï#', 'I', $champ);
	    $champ = preg_replace('#ð|ò|ó|ô|õ|ö#', 'o', $champ);
	    $champ = preg_replace('#Ò|Ó|Ô|Õ|Ö#', 'O', $champ);
	    $champ = preg_replace('#ù|ú|û|ü#', 'u', $champ);
	    $champ = preg_replace('#Ù|Ú|Û|Ü#', 'U', $champ);
	    $champ = preg_replace('#ý|ÿ#', 'y', $champ);
	    return preg_replace('#Ý#', 'Y', $champ);
	}
	public static function cassePrenom($champ)
	{
		$champ = mettreMinuscule($champ);
		$prem = retirerAccent($champ[0]);
		for ($i=1; $i<strlen($champ); $i++) {
			$prem= $prem.$champ[$i];
		}
		$prem = ucwords($prem);
		$tab = rechercheTiret($prem);
		majusculeApresTiret($prem,$tab);
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
	public static function majusculeApresTiret($champ,$tab)
	{
		foreach ($tab as $i)
		{
			$champ[$tab[$i]]=mettreMajuscule($champ[$tab[$i]]);
		}
		return $champ;
	}

=======
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
>>>>>>> 3b5f4f6de0e61faa52640e610ef007708e00eaeb

}