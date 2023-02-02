<?php
/**
 * Class Cellier
 * Cette classe possède les fonctions de gestion des Celliers dans le cellier et des Celliers dans le catalogue complet.
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2019-01-21
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */
class Cellier extends Modele {
	const TABLE = 'vino__Cellier';

    public function __construct()
    {
        parent::__construct();
    }
    
	public function getCelliers($userId){
        $celliers = $this->_db->query("SELECT vc.id, vc.nom, COUNT(vcc.id) AS nbDeVins FROM vino__cellier vc LEFT JOIN vino__cellier_contient vcc ON vc.id = vcc.vino__cellier_id WHERE vc.vino__utilisateur_id = " .$userId. " GROUP BY vc.nom, vc.id");
        $arrayCelliers = [];
        while($row = $celliers->fetch_assoc()){
            array_push($arrayCelliers, $row);
        }

        return $arrayCelliers;
    }
}

?>