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
}