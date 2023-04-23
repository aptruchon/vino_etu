<?php
/**
 * Gestion des celliers
 */
class CellierController extends Controller
{
	/**
	 * Affiche la vue de la page cellier
	 */
	protected function cellier($userId)
	{
		// Redirection si un utilisateur non-connecté essaie d'aller sur une page qui requiert une authentification
		if(!isset($_SESSION["utilisateur"])){
			Utilitaires::nouvelleRoute('index.php?requete=connexion');
			die();
		}

		$_SESSION["cellierId"] = $_GET["cellierId"];

		// Récupère le bon cellier		
		$cellier = new Cellier();
		$cellierParId = $cellier->getCellierParId($_SESSION["cellierId"]);

		// Valider si le cellier appartient à l'utilisateur
		if($cellierParId["vino__utilisateur_id"] !== $_SESSION["utilisateur"]["id"]){
			Utilitaires::nouvelleRoute('index.php?requete=mesCelliers');
			die();
		}

		// Liste des bouteilles d'un cellier
		$bte = new Bouteille();
		$data = $bte->getListeBouteilleCellier($userId, $_SESSION["cellierId"]);

		// Pour le titre de la page
		$_SESSION["nomCellier"] = $cellierParId["nom"];

		include("vues/entete.php");
		include("vues/navigation.php");
		include("vues/cellier.php");
		include("vues/pied.php");
	}

	/**
	 * Affiche la vue de la page mesCelliers
	 */
	protected function mesCelliers($userId)
	{
		// Redirection si un utilisateur non-connecté essaie d'aller sur une page qui requiert une authentification
		if(!isset($_SESSION["utilisateur"])){
			Utilitaires::nouvelleRoute('index.php?requete=connexion');
			die();
		}
		
		$cellier = new Cellier();
		$mesCelliers = $cellier->getCelliers($userId);

		json_encode($mesCelliers);
		include("vues/entete.php");
		include("vues/navigation.php");
		include("vues/mesCelliers.php");
		include("vues/pied.php");
	}

	protected function ajouterCellier($userId) {
		$cellier = new Cellier();
		$body = $_POST;

		if(!empty($body)){
			$resultatCelliers = $cellier->ajouterCellier($userId, $body["nomCellier"]);
			Utilitaires::nouvelleRoute('index.php?requete=mesCelliers');
			die();
		}
	}

	protected function modifierCellier($userId) {
		$cellier = new Cellier();

		$cellierParId = $cellier->getCellierParId($_POST["idCellier"]);

		if($cellierParId["vino__utilisateur_id"] !== $userId){
			Utilitaires::nouvelleRoute('index.php?requete=mesCelliers');
			die();
		}

		$cellier->modifierCellier($_POST);
		Utilitaires::nouvelleRoute('index.php?requete=mesCelliers');

	}

	protected function supprimerCellier($userId) {
		$cellier = new Cellier();

		$cellierParId = $cellier->getCellierParId($_POST["idCellier"]);

		if($cellierParId["vino__utilisateur_id"] !== $userId){
			Utilitaires::nouvelleRoute('index.php?requete=mesCelliers');
			die();
		}

		$cellier->supprimerCellier($_POST);
		Utilitaires::nouvelleRoute('index.php?requete=mesCelliers');
	}
}
