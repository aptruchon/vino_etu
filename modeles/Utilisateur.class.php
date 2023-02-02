<?php

/**
 * Class Utilisateur
 * Cette classe possède les fonctions de gestion des utilisateurs.
 * 
 */
class Utilisateur extends Modele
{
	const TABLE = 'vino__utilisateur';

	private $error_message = '';

	public function getErrorMessage()
	{
		return $this->$error_message;
	}

	public function getUtilisateurParCourriel($courriel)
	{
		$requete = "SELECT * FROM " . self::TABLE . " WHERE courriel = '" . $courriel . "'";

		if (($res = $this->_db->query($requete)) ==	true) {
			if ($res->num_rows) {
				$res = $res->fetch_assoc();
				return $res;
			}
		} else {
			$this->$error_message = "Erreur de requête sur la base de donnée";
			return false;
		}
	}


	/**
	 * Cette méthode ajoute un utilisateur (rôle Utilisateur)
	 * 
	 * @param Array $data Tableau des données représentants l'utilisateur.
	 * 
	 * @return Boolean Succès ou échec de l'ajout.
	 */
	public function ajouterUtilisateur($data)
	{
		$data["uti_prenom"] = substr(htmlspecialchars($data["uti_prenom"]), 0, 200);
		$data["uti_nom"] = substr(htmlspecialchars($data["uti_nom"]), 0, 200);
		$data["uti_courriel"] = substr(htmlspecialchars($data["uti_courriel"]), 0, 200);
		$data["uti_mdp"] = substr(htmlspecialchars($data["uti_mdp"]), 0, 255);


		/*
		** Validation des exigences du mot de passe.
		*/
		$taille_minimum_8 = preg_match('/[0-9a-zA-Z]{8,}/', $data["uti_mdp"]);
		if ($taille_minimum_8 !== 1) {
			$this->$error_message = "Le mot de passe doit avoir au moins 8 caractères";
			return false;
		}

		$une_minuscule = preg_match('/[a-z]/', $data["uti_mdp"]);
		if ($une_minuscule !== 1) {
			$this->$error_message = "Le mot de passe doit avoir au moins une lettre minuscule";
			return false;
		}

		$une_majuscule = preg_match('/[A-Z]/', $data["uti_mdp"]);
		if ($une_majuscule !== 1) {
			$this->$error_message = "Le mot de passe doit avoir au moins une lettre majuscule";
			return false;
		}

		$un_chiffre = preg_match('/[0-9]/', $data["uti_mdp"]);
		if ($un_chiffre !== 1) {
			$this->$error_message = "Le mot de passe doit avoir au moins un chiffre";
			return false;
		}


		/*
		** Validation si existe un autre utilisateur avec le même courriel.
		*/
		$resultat = $this->_db->query("SELECT courriel from " . self::TABLE . " where courriel = '" . $data["uti_courriel"] . "'");

		if ($resultat->num_rows > 0) {
			$this->$error_message = "Nous avons déjà un utilisateur avec ce courriel. Veuillez fournir un autre.";
			return false;
		}


		$stmt = $this->_db->prepare("INSERT INTO " . self::TABLE . " (nom, prenom, courriel, mot_de_passe, date_inscription, vino__role_id) VALUES (?,?,?,?,now(),2)");

		$stmt->bind_param(
			"ssss",
			$data["uti_nom"],
			$data["uti_prenom"],
			$data["uti_courriel"],
			password_hash($data["uti_mdp"], PASSWORD_DEFAULT)
		);

		$res = $stmt->execute();
		$this->$error_message = $stmt->error;

		// var_dump($res);
		return $res;
	}
}
