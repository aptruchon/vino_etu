<?php
session_start();

/**
 * Class Controller
 * Gère les requêtes HTTP
 * 
 * @author Alana Fulvia Bezerra De Moraes, Alex Poulin Truchon, Claudia Lisboa, Pauline Huby
 * @version 2.0
 * @update 2023-02-05
 * 
 */
class Controller
{
	const BOUTEILLE_LISTE = "listeBouteille";
	const BOUTEILLE_INFO_ID = "informationBouteilleParId";
	const BOUTEILLE_AUTOCOMPLETE = "autocompleteBouteille";
	const BOUTEILLE_AJOUTER = "ajouterNouvelleBouteilleCellier";
	const BOUTEILLE_MODIFIER = "modifierBouteilleCellier";
	const BOUTEILLE_AUGMENTER_QTE = "ajouterBouteilleCellier";
	const BOUTEILLE_REDUIRE_QTE = "boireBouteilleCellier";
	const BOUTEILLE_SUPPRIMER = "effacerBouteilleCellier";
	const BOUTEILLE_DETAILS = "ficheDetailsBouteille";

	const CELLIERS_UTILISATEUR = "mesCelliers";
	const CELLIER_PAR_ID = "cellier";
	const CELLIER_AJOUTER = "ajouterCellier";
	const CELLIER_MODIFIER = "modifierCellier";
	const CELLIER_SUPPRIMER = "supprimerCellier";
	
	const UTILISATEUR_PAGE_INSCRIPTION = "inscription";
	const UTILISATEUR_INSCRIPTION = "inscrireUtilisateur";
	const UTILISATEUR_CONNEXION = "connexion";
	const UTILISATEUR_DECONNEXION = "deconnexion";


	/**
	 * Traite la requête
	 * @return void
	 */
	public function router()
	{    
		$requestType = $_GET['requete'];

		$accueilController = new AccueilController();
		$bouteilleController = new BouteilleController();
		$cellierController = new CellierController();
		$utilisateurController = new UtilisateurController();

		switch ($requestType) {
			// Bouteilles
			case self::BOUTEILLE_LISTE:
				$bouteilleController->listeBouteille($_SESSION['utilisateur']['id'], $_SESSION["cellierId"]);
				break;
			case self::BOUTEILLE_INFO_ID:
				$bouteilleController->informationBouteilleParId();
				break;
			case self::BOUTEILLE_AUTOCOMPLETE:
				$bouteilleController->autocompleteBouteille();
				break;
			case self::BOUTEILLE_AJOUTER:
				$bouteilleController->ajouterNouvelleBouteilleCellier();
				break;
			case self::BOUTEILLE_MODIFIER:
				$bouteilleController->modifierBouteilleCellier($_SESSION['utilisateur']['id'], $_SESSION["cellierId"], $_GET['bte']);
				break;
			case self::BOUTEILLE_AUGMENTER_QTE:
				$bouteilleController->ajouterBouteilleCellier();
				break;
			case self::BOUTEILLE_REDUIRE_QTE:
				$bouteilleController->boireBouteilleCellier();
				break;
			case self::BOUTEILLE_SUPPRIMER:
				$bouteilleController->effacerBouteilleCellier($_GET['bteCellier']);
				break;
			case self::BOUTEILLE_DETAILS:
				$bouteilleController->ficheDetailsBouteille($_SESSION['utilisateur']['id'], $_SESSION["cellierId"], $_GET['bte']);
				break;

			// Celliers
			case self::CELLIERS_UTILISATEUR:
				$cellierController->mesCelliers($_SESSION['utilisateur']['id']);
				break;
			case self::CELLIER_PAR_ID:
				$cellierController->cellier($_SESSION['utilisateur']['id']);
				break;
			case self::CELLIER_AJOUTER:
				$cellierController->ajouterCellier($_SESSION['utilisateur']['id']);
				break;
			case self::CELLIER_MODIFIER:
				$cellierController->modifierCellier($_SESSION['utilisateur']['id']);
				break;
			case self::CELLIER_SUPPRIMER:
				$cellierController->supprimerCellier($_SESSION['utilisateur']['id']);
				break;
			
			// Utilisateurs
			case self::UTILISATEUR_PAGE_INSCRIPTION:
				$utilisateurController->inscription();
			case self::UTILISATEUR_INSCRIPTION:
				$utilisateurController->inscrireUtilisateur();
				break;
			case self::UTILISATEUR_CONNEXION:
				$utilisateurController->connexion();
				break;
			case self::UTILISATEUR_DECONNEXION:
				$utilisateurController->deconnexion();
				break;

			// Accueil
			default:
				$accueilController->accueil();
				break;
		}
	}
}
