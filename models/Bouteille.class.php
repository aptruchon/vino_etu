<?php

/**
 * Class Bouteille
 * Cette classe possède les fonctions de gestion des bouteilles dans le cellier et des bouteilles dans le catalogue complet.
 */
class Bouteille extends Modele
{
	const TABLE = 'vino__bouteille';

	/**
	 * Function qui récupère une bouteille par son ID
	 * 
	 * @param integer $id
	 * 
	 * @throws Exception Erreur de requête sur la base de données 
	 * 
	 * @return array $res
	 */
	public function getBouteilleParId($id)
	{
		$requete = "SELECT * FROM vino__bouteille WHERE id =" . $id;

		if (($res = $this->_db->query($requete)) ==	 true) {
			if ($res->num_rows) {
				$res = $res->fetch_assoc();
			}
		} else {
			throw new Exception("Erreur de requête sur la base de donnée", 1);
		}

		return $res;
	}

	/**
	 * Function qui récupère une liste OU une des bouteilles d'un cellier par son ID
	 * 
	 * @param integer $userId
	 * @param integer $cellierId
	 * @param integer $idBouteille
	 * 
	 * @throws Exception Erreur de requête sur la base de données 
	 * 
	 * @return array $res
	 */
	public function getListeBouteilleCellier($userId, $cellierId, $idBouteille = -1)
	{
		$rows = array();
		$requete = 'SELECT 
						cc.id AS id_bouteille_cellier, 
						cc.vino__bouteille_id, 
						cc.vino__cellier_id, 
						cc.nom, 
						cc.pays, 
						cc.description, 
						cc.format, 
						cc.date_ajout, 
						cc.garde_jusqua, 
						cc.notes, 
						cc.prix AS prix_paye, 
						cc.quantite, 
						cc.millesime, 
						b.image, 
						b.code_saq, 
						b.url_saq, 
						b.prix_saq, 
						t.type, 
						ce.vino__utilisateur_id 
						from vino__cellier_contient cc 
						INNER JOIN vino__bouteille b ON cc.vino__bouteille_id = b.id 
						INNER JOIN vino__type t ON t.id = cc.vino__type_id 
						INNER JOIN vino__cellier ce ON ce.id = cc.vino__cellier_id 
						WHERE ce.vino__utilisateur_id =' . $userId . '
						AND cc.vino__cellier_id =' . $cellierId;

		if ($idBouteille != -1) {
			$requete = $requete . ' AND cc.vino__bouteille_id = ' . $idBouteille;
		}

		$requete = $requete . ' ORDER BY id_bouteille_cellier DESC';

		if (($res = $this->_db->query($requete)) ==	 true) {
			if ($res->num_rows) {
				while ($row = $res->fetch_assoc()) {
					$row['nom'] = trim(mb_convert_encoding($row['nom'], "UTF-8"));
					$rows[] = $row;
				}
			}
		} else {

			throw new Exception("Erreur de requête sur la base de donnée", 1);
		}

		return $rows;
	}

	/**
	 * Cette fonction permet de retourner les résultats de recherche pour la fonction d'autocomplete de l'ajout des bouteilles dans le cellier
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

		$requete = 'SELECT id, nom FROM vino__bouteille where vino__catalogue_id = 1 AND LOWER(nom) like LOWER("%' . $nom . '%") LIMIT 0,' . $nb_resultat;

		if (($res = $this->_db->query($requete)) ==	 true) {
			if ($res->num_rows) {
				while ($row = $res->fetch_assoc()) {
					$row['nom'] = trim(mb_convert_encoding(($row['nom']), "UTF-8"));
					$rows[] = $row;
				}
			}
		} else {
			throw new Exception("Erreur de requête sur la base de données", 1);
		}

		return $rows;
	}

	/**
	 * Cette fonction ajoute une ou des bouteilles au cellier
	 * 
	 * @param Array $data Tableau des données représentants la bouteille.
	 * 
	 * @return Boolean Succès ou échec de l'ajout.
	 */
	public function ajouterBouteilleCellier($data)
	{

		$data["nom"] = htmlspecialchars($data["nom"]);
		$data["pays"] = htmlspecialchars($data["pays"]);
		$data["description"] = htmlspecialchars($data["description"]);
		$data["format"] = htmlspecialchars($data["format"]);
		$data["garde_jusqua"] = htmlspecialchars($data["garde_jusqua"]);
		$data["notes"] = htmlspecialchars($data["notes"]);

		$data["id_type"] = intval($data["id_type"]);
		$data["prix"] = floatval($data["prix"]);
		$data["quantite"] = intval($data["quantite"]);
		$data["millesime"] = intval($data["millesime"]);

		if ($data["id_bouteille"] == "") {
			$stmtAjoutVinoBouteille = $this->_db->prepare("INSERT INTO vino__bouteille(vino__type_id, nom, pays, description, format, vino__catalogue_id) VALUES (?, ?, ?, ?, ?, ?)");

			$catalogueId = 2;

			$stmtAjoutVinoBouteille->bind_param("issssi", $data["id_type"], $data["nom"], $data["pays"], $data["description"], $data["format"], $catalogueId);

			$resultat = $stmtAjoutVinoBouteille->execute();

			$lastInsertedId = $stmtAjoutVinoBouteille->insert_id;
			$data["id_bouteille"] = $lastInsertedId;
		}

		$cellierId = $_SESSION["cellierId"];

		$resultat = $this->_db->query("SELECT id from vino__cellier_contient where vino__cellier_id = " . $cellierId . " AND vino__bouteille_id =" . $data["id_bouteille"]);

		if (!$resultat->num_rows > 0) {
			$stmtAjoutCellier = $this->_db->prepare("INSERT INTO vino__cellier_contient (vino__cellier_id, vino__bouteille_id, vino__type_id, nom, pays, description, date_ajout, garde_jusqua , notes, prix, format, quantite, millesime) VALUES (?,?,?,?,?,?,now(),?,?,?,?,?,?)");

			$stmtAjoutCellier->bind_param(
				"iiisssssdsii",
				$cellierId,
				$data["id_bouteille"],
				$data["id_type"],
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

			$res = $stmtAjoutCellier->execute();
		} else {
			$res = false;
		}

		return $res;
	}

	/**
	 * Cette fonction modifie une bouteille au cellier
	 * 
	 * @param Array $data Tableau des données représentants la bouteille.
	 * 
	 * @return Boolean Succès ou échec de la modification.
	 */
	public function modifierBouteilleCellier($data)
	{
		$stmt = $this->_db->prepare("UPDATE vino__cellier_contient " .
			"SET nom = ?, pays = ?, description = ?, garde_jusqua = ?, notes = ?, prix = ?, format = ?, quantite = ?, millesime = ?, vino__type_id = ? WHERE id = ?");

		// Limite nombre de caracteres des strings
		$data["nom"] = substr(htmlspecialchars($data["nom"]), 0, 200);
		$data["pays"] = substr(htmlspecialchars($data["pays"]), 0, 50);
		$data["description"] = substr(htmlspecialchars($data["description"]), 0, 200);
		$data["garde_jusqua"] = substr(htmlspecialchars($data["garde_jusqua"]), 0, 200);
		$data["notes"] = substr(htmlspecialchars($data["notes"]), 0, 200);
		$data["format"] = substr(htmlspecialchars($data["format"]), 0, 20);

		// Convertit les stings en integer si requis
		$data["quantite"] = intval($data["quantite"]);
		$data["millesime"] = intval($data["millesime"]);
		$data["id_type"] = intval($data["id_type"]);
		$data["id_bouteille"] = intval($data["id_bouteille"]);
		$data["prix"] = floatval($data["prix"]);

		$stmt->bind_param(
			"sssssdsiiii",
			$data["nom"],
			$data["pays"],
			$data["description"],
			$data["garde_jusqua"],
			$data["notes"],
			$data["prix"],
			$data["format"],
			$data["quantite"],
			$data["millesime"],
			$data["id_type"],
			$data["id_bouteille"]
		);

		$res = $stmt->execute();

		return $res;
	}

	/**
	 * Cette fonction efface une bouteille du cellier
	 * 
	 * @param Integer $idBouteilleCellier Id de la table vino__cellier_contient.
	 * 
	 * @return Boolean Succès ou échec de la suppression.
	 */
	public function effacerBouteilleCellier($idBouteilleCellier)
	{
		$stmt = $this->_db->prepare("DELETE FROM vino__cellier_contient WHERE id = ?");

		$stmt->bind_param(
			"i",
			$idBouteilleCellier
		);

		$res = $stmt->execute();

		return $res;
	}

	/**
	 * Cette fonction change la quantité d'une bouteille en particulier dans le cellier
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
		var_dump($res);

		return $res;
	}
}
