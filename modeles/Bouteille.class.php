<?php

/**
 * Class Bouteille
 * Cette classe possède les fonctions de gestion des bouteilles dans le cellier et des bouteilles dans le catalogue complet.
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2019-01-21
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */
class Bouteille extends Modele
{
	const TABLE = 'vino__bouteille';

	public function getListeBouteille()
	{

		$rows = array();
		$res = $this->_db->query('Select * from ' . self::TABLE);
		if ($res->num_rows) {
			while ($row = $res->fetch_assoc()) {
				$rows[] = $row;
			}
		}

		return $rows;
	}


	public function getBouteilleParId($id)
	{
		$requete = "SELECT * FROM vino__bouteille WHERE id =" . $id;

		if (($res = $this->_db->query($requete)) ==	 true) {
			if ($res->num_rows) {
				$res = $res->fetch_assoc();
			}
		} else {
			throw new Exception("Erreur de requête sur la base de donnée", 1);
			//$this->_db->error;
		}

		return $res;
	}


	public function getListeBouteilleCellier($userId, $cellierId, $idBouteille = -1)
	{

		$rows = array();
		$requete = 'SELECT 
						cc.id AS id_bouteille_cellier, 
						cc.vino__bouteille_id, 
						cc.vino__cellier_id, 
						cc.date_ajout, 
						cc.garde_jusqua, 
						cc.notes, 
						cc.prix AS prix_paye, 
						cc.quantite, 
						cc.millesime, 
						b.nom, 
						b.image, 
						b.code_saq, 
						b.url_saq, 
						b.pays, 
						b.description, 
						b.format, 
						b.prix_saq, 
						t.type, 
						ce.vino__utilisateur_id 
						from vino__cellier_contient cc 
						INNER JOIN vino__bouteille b ON cc.vino__bouteille_id = b.id 
						INNER JOIN vino__type t ON t.id = b.vino__type_id 
						INNER JOIN vino__cellier ce ON ce.id = cc.vino__cellier_id 
						WHERE ce.vino__utilisateur_id =' . $userId . '
						AND cc.vino__cellier_id =' . $cellierId;
		if ($idBouteille != -1) {
			$requete = $requete . ' AND cc.vino__bouteille_id = ' . $idBouteille;
		}

		// var_dump($requete);

		if (($res = $this->_db->query($requete)) ==	 true) {
			if ($res->num_rows) {
				while ($row = $res->fetch_assoc()) {
					$row['nom'] = trim(utf8_encode($row['nom']));
					$rows[] = $row;
				}
			}
		} else {
			throw new Exception("Erreur de requête sur la base de donnée", 1);
			//$this->_db->error;
		}



		return $rows;
	}


	/**
	 * Cette méthode permet de retourner les résultats de recherche pour la fonction d'autocomplete de l'ajout des bouteilles dans le cellier
	 * 
	 * @param string $nom La chaine de caractère à rechercher
	 * @param integer $nb_resultat Le nombre de résultat maximal à retourner.
	 * 
	 * @throws Exception Erreur de requête sur la base de données 
	 * 
	 * @return array id et nom de la bouteille trouvée dans le catalogue
	 */
	public function autocomplete($nom, $nb_resultat = 10)
	{

		$rows = array();
		$nom = $this->_db->real_escape_string($nom);
		$nom = preg_replace("/\*/", "%", $nom);

		//echo $nom;
		$requete = 'SELECT id, nom FROM vino__bouteille where vino__catalogue_id = 1 AND LOWER(nom) like LOWER("%' . $nom . '%") LIMIT 0,' . $nb_resultat;
		//var_dump($requete);
		if (($res = $this->_db->query($requete)) ==	 true) {
			if ($res->num_rows) {
				while ($row = $res->fetch_assoc()) {
					$row['nom'] = trim(utf8_encode($row['nom']));
					$rows[] = $row;
				}
			}
		} else {
			throw new Exception("Erreur de requête sur la base de données", 1);
		}


		//var_dump($rows);
		return $rows;
	}


	/**
	 * Cette méthode ajoute une ou des bouteilles au cellier
	 * 
	 * @param Array $data Tableau des données représentants la bouteille.
	 * 
	 * @return Boolean Succès ou échec de l'ajout.
	 */
	public function ajouterBouteilleCellier($data)
	{
		//TODO : Valider les données.
		var_dump($data);
		$cellierId = 1;
		$stmtBouteille = $this->_db->prepare("INSERT INTO vino__cellier_contient (vino__cellier_id, vino__bouteille_id, vino__type_id, nom, pays, description, date_ajout, garde_jusqua , notes, prix, format quantite, millesime) VALUES (?,?, now(),?,?,?,?,?)");

		$data["nom"] = htmlspecialchars($data["nom"]);
		$data["pays"] = htmlspecialchars($data["pays"]);
		$data["description"] = htmlspecialchars($data["description"]);
		$data["format"] = htmlspecialchars($data["format"]);
		$data["garde_jusqua"] = htmlspecialchars($data["garde_jusqua"]);
		$data["notes"] = htmlspecialchars($data["notes"]);

		$stmtBouteille->bind_param(
			"iissdii",
			$cellierId,
			$data["id_bouteille"],
			$data["nom"],
			$data["pays"],
			$data["description"],
			$data["garde_jusqua"],
			$data["notes"],
			$data["prix"],
			$data["format"],
			$data["quantite"],
			$data["millesime"]
		);


		$res = $stmtBouteille->execute();

		return $res;
	}


	/**
	 * Cette méthode modifie une bouteille au cellier
	 * 
	 * @param Array $data Tableau des données représentants la bouteille.
	 * 
	 * @return Boolean Succès ou échec de la modification.
	 */
	public function modifierBouteilleCellier($data)
	{
		$stmt = $this->_db->prepare("UPDATE vino__cellier_contient " .
			"SET nom = ?, pays = ?, description = ?, date_ajout = ?, garde_jusqua = ?, notes = ?, prix = ?, format = ?, quantite = ?, millesime = ? WHERE id = ?");

		$data["nom"] = substr(htmlspecialchars($data["nom"]), 0, 200);
		$data["pays"] = substr(htmlspecialchars($data["pays"]), 0, 50);
		$data["description"] = substr(htmlspecialchars($data["description"]), 0, 200);
		$data["garde_jusqua"] = substr(htmlspecialchars($data["garde_jusqua"]), 0, 200);
		$data["notes"] = substr(htmlspecialchars($data["notes"]), 0, 200);
		$data["format"] = substr(htmlspecialchars($data["format"]), 0, 20);

		$stmt->bind_param(
			"ssssssdsiii",
			$data["nom"],
			$data["pays"],
			$data["description"],
			$data["date_achat"],
			$data["garde_jusqua"],
			$data["notes"],
			$data["prix"],
			$data["format"],
			$data["quantite"],
			$data["millesime"],
			$data["id_bouteille_cellier"]
		);

		$res = $stmt->execute();

		return $res;
	}


	/**
	 * Cette méthode change la quantité d'une bouteille en particulier dans le cellier
	 * 
	 * @param int $id id de la bouteille
	 * @param int $nombre Nombre de bouteille a ajouter ou retirer
	 * 
	 * @return Boolean Succès ou échec de l'ajout.
	 */
	public function modifierQuantiteBouteilleCellier($id, $nombre)
	{
		// Validation des paramètres.
		if (!is_numeric($id)) {
			throw new Exception("Erreur de paramètre: integer attendu", 1);
		}
		if (!in_array($nombre, [-1, 1])) {
			throw new Exception("Erreur de paramètre: -1 ou 1 attendu", 1);
		}

		$requete = "UPDATE vino__cellier_contient SET quantite = GREATEST(quantite + " . $nombre . ", 0) WHERE id = " . $id;
		//echo $requete;
		$res = $this->_db->query($requete);

		return $res;
	}
}
