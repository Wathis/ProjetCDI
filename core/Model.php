<?php 


class Model {

	protected $db;

	public function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Connexion à la base de donnée impossible');
        }
    }


    protected function getMaxId($from,$champ,$suffixe) {
    	$sql = 'SELECT max(CAST(SUBSTR('. $champ . ',2)as UNSIGNED INT)) as maxi FROM ' . $from . ';';
        $query = $this->db->prepare($sql);
        $query->execute();
        $query=$query->fetch();
        if ($query["maxi"] + 1 < 10) {
            $maxId = $suffixe . '0' . ($query["maxi"] + 1);
        } else {    
            $maxId = $suffixe . ($query["maxi"] + 1);
        }
        return $maxId;
    }

}