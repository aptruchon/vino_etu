<?php
/**
 * Class Cellier
 * Cette classe possède les fonctions de gestion des Celliers dans le cellier et des Celliers dans le catalogue complet.
 * 
 * 
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

    public function getCellierParId($cellierId) {
        $requete = "SELECT id, nom, vino__utilisateur_id from vino__cellier where id = " .$cellierId;
        $resultat = $this->_db->query($requete)->fetch_assoc();

        return $resultat;
    }

    public function ajouterCellier($userId, $nom) {
        $nom = htmlspecialchars($nom);

        $stmt = $this->_db->prepare("INSERT INTO vino__cellier(nom, vino__utilisateur_id) VALUES (?,?)");

        $stmt->bind_param("si", $nom, $userId);

        $resultat = $stmt->execute();

        return $resultat;
    }

    public function modifierCellier($body){
        $id = intval($body["idCellier"]);
        $nom = htmlspecialchars($body["nomCellier"]);

        $stmt = $this->_db->prepare("UPDATE vino__cellier SET nom = ? WHERE id = ?");
        $stmt->bind_param("si", $nom, $id);

        $resultat = $stmt->execute();

        return $resultat;
    }

    public function supprimerCellier($idCellier){
        // Suppression des vins du cellier qu'on veut supprimer
        $stmt = $this->_db->prepare("DELETE FROM vino__cellier_contient WHERE vino__cellier_id = ?");
        $stmt->bind_param("i", $idCellier);
        $resultat = $stmt->execute();

        // Suppression du cellier
        $stmt = $this->_db->prepare("DELETE FROM vino__cellier WHERE id = ?");
        $stmt->bind_param("i", $idCellier);
        $resultat = $stmt->execute();

        return $resultat;
    }
}
