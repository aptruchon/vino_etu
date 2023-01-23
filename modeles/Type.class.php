<?php
/**
 * Class Type
 * Cette classe possède les fonctions de gestion des Types dans le cellier et des Types dans le catalogue complet.
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2019-01-21
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */
class Type extends Modele {
	const TABLE = 'vino__type';

    public function __construct()
    {
        parent::__construct();
    }
    
	public function getTypes(){
        $rowsType = $this->_db->query("select * from vino__type");
        $arrayTypes = [];
        while($row = $rowsType->fetch_assoc()){
            array_push($arrayTypes, $row);
        }

        return $arrayTypes;
    }
}

?>