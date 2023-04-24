<?php
/**
 * Class Type
 * Cette classe possède les fonctions de gestion des Types dans le cellier et des Types dans le catalogue complet.
 */
class Type extends Modele {
    /**
	 * Function qui récupère tous les types de la DB
	 * 
	 * @return array $arrayTypes
	 */
	public function getTypes(){
        $rowsType = $this->_db->query("select * from vino__type");
        $arrayTypes = [];
        while($row = $rowsType->fetch_assoc()){
            array_push($arrayTypes, $row);
        }

        return $arrayTypes;
    }
}
