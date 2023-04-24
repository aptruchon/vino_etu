<?php

/**
 * Gestion des bouteilles
 * 
 */
class BouteilleController extends Controller
{
	/**
	 * Affiche les vins d'un cellier
	 */
	protected function listeBouteille($userId, $cellierId)
	{
		$bte = new Bouteille();
		$cellier = $bte->getListeBouteilleCellier($userId, $cellierId);

		echo json_encode($cellier);
	}

	/**
	 * Affiche la vue de la page Fiche d'un vin
	 */
	protected function ficheDetailsBouteille($userId, $cellierId, $idBouteille, $showMessage = false)
	{
		// Redirection si un utilisateur non-connecté essaie d'aller sur une page qui requiert une authentification
		if (!isset($_SESSION["utilisateur"])) {
			Utilitaires::nouvelleRoute('index.php?requete=connexion');
			die();
		}

		$bte = new Bouteille();
		$dataFiche = $bte->getListeBouteilleCellier($userId, $cellierId, $idBouteille);

		// Afficher message confirmation si modifications
		if ($showMessage) {
			$_SESSION["message"] = "Modifications enregistrées !";
			$_SESSION["estVisible"] = true;
		}
		include("vues/entete.php");
		include("vues/navigation.php");
		include("vues/fiche.php");
		include("vues/pied.php");
	}

	/**
	 * Modifie les informations d'un vin dans un cellier
	 */
	protected function modifierBouteilleCellier($userId, $cellierId, $idBouteille)
	{
		// Redirection si un utilisateur non-connecté essaie d'aller sur une page qui requiert une authentification
		if (!isset($_SESSION["utilisateur"])) {
			Utilitaires::nouvelleRoute('index.php?requete=connexion');
			die();
		}

		$body = json_decode(file_get_contents('php://input'), true);

		if (!empty($body)) {
			$bte = new Bouteille();
			$resultat = $bte->modifierBouteilleCellier($body);

			// Message pop-up confirmation modification faite
			$_SESSION["message"] = "Bouteille modifiée !";
			$_SESSION["estVisible"] = true;

			die();
		} else {
			$type = new Type();
			$dataTypesModifier = $type->getTypes();

			$bte = new Bouteille();
			$dataModifie = $bte->getListeBouteilleCellier($userId, $cellierId, $idBouteille);

			include("vues/entete.php");
			include("vues/navigation.php");
			include("vues/modifier.php");
			include("vues/pied.php");
		}
	}

	/**
	 * Ajoute un nouveau vin dans un cellier
	 */
	protected function ajouterNouvelleBouteilleCellier()
	{
		// Redirection si un utilisateur non-connecté essaie d'aller sur une page qui requiert une authentification
		if (!isset($_SESSION["utilisateur"])) {
			Utilitaires::nouvelleRoute('index.php?requete=connexion');
			die();
		}

		$body = json_decode(file_get_contents('php://input'), true);
		if (!empty($body)) {
			$bte = new Bouteille();
			$resultat = $bte->ajouterBouteilleCellier($body);
			if ($resultat === false) {
				$_SESSION["message"] = "Bouteille déjà créée.";
				$_SESSION["estVisible"] = true;
			} else {
				$_SESSION["message"] = "Bouteille ajoutée !";
				$_SESSION["estVisible"] = true;
			}
			die();
		} else {
			$type = new Type();
			$dataTypes = $type->getTypes();

			include("vues/entete.php");
			include("vues/navigation.php");
			include("vues/ajouter.php");
			include("vues/pied.php");
		}
	}

	/**
	 * Supprime un vin d'un cellier
	 */
	protected function effacerBouteilleCellier($idBouteilleCellier)
	{
		// Redirection si un utilisateur non-connecté essaie d'aller sur une page qui requiert une authentification
		if (!isset($_SESSION["utilisateur"])) {
			Utilitaires::nouvelleRoute('index.php?requete=connexion');
			die();
		}

		$bte = new Bouteille();
		$effacer = $bte->effacerBouteilleCellier($idBouteilleCellier);
		// Message pop-up confirmation bouteille supprimée
		$_SESSION["message"] = "Bouteille supprimée !";
		$_SESSION["estVisible"] = true;
		// Redirection page cellier
		Utilitaires::nouvelleRoute('index.php?requete=cellier&cellierId=' . $_SESSION["cellierId"] . '');
	}

	/* QUANTITÉS --------------------------------------------------*/
	/**
	 * Diminue la quantite de bouteilles d'un vin dans un cellier
	 */
	protected function reduireBouteilleCellier()
	{
		$body = json_decode(file_get_contents('php://input'));

		$bte = new Bouteille();
		$resultat = $bte->modifierQuantiteBouteilleCellier($body->id, -1);
		echo json_encode($resultat);
	}

	/**
	 * Augmente la quantite de bouteilles d'un vin dans un cellier
	 */
	protected function augmenterBouteillecellier()
	{
		$body = json_decode(file_get_contents('php://input'));

		$bte = new Bouteille();
		$resultat = $bte->modifierQuantiteBouteilleCellier($body->id, 1);

		echo json_encode($resultat);
	}

	/* RECHERCHE + INFOS FORMULAIRES AJOUT-----------------------------*/
	/**
	 * Autocompletion de la liste de recherche
	 */
	protected function autocompleteBouteille()
	{
		$bte = new Bouteille();
		$body = json_decode(file_get_contents('php://input'));
		$listeBouteille = $bte->autocomplete($body->nom);

		echo json_encode($listeBouteille);
	}

	/**
	 * Va chercher les infos d'une bouteille pour préremplir les champs du formulaire d'ajout
	 */
	protected function informationBouteilleParId()
	{
		$bte = new Bouteille();
		$id = $_GET["id"];
		$bouteille = $bte->getBouteilleParId($id);
		echo json_encode($bouteille);
	}
}
