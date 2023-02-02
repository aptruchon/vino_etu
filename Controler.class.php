<?php
session_start();

/**
 * Class Controler
 * Gère les requêtes HTTP
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2019-01-21
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */

class Controler
{
	/**
	 * Traite la requête
	 * @return void
	 */
	public function gerer()
	{
		// ID utilisateur et ID de cellier en attendant de recevoir les vraies informations dynamiquement
		$userId = 2;

		switch ($_GET['requete']) {
			case 'listeBouteille':
				$this->listeBouteille($userId, $_SESSION["cellierId"]);
				break;
			case 'informationBouteilleParId':
				$this->informationBouteilleParId();
				break;
			case 'autocompleteBouteille':
				$this->autocompleteBouteille();
				break;
			case 'ajouterNouvelleBouteilleCellier':
				$this->ajouterNouvelleBouteilleCellier();
				break;
			case 'modifierBouteilleCellier':
				$this->modifierBouteilleCellier($userId, $_SESSION["cellierId"], $_GET['bte']);
				break;
			case 'ajouterBouteilleCellier':
				$this->ajouterBouteilleCellier();
				break;
			case 'boireBouteilleCellier':
				$this->boireBouteilleCellier();
				break;
			case 'effacerBouteilleCellier':
				$this->effacerBouteilleCellier($_GET['bteCellier']);
				break;
			case 'inscription':
				$this->inscription();
				break;
			case 'connexion':
				$this->connexion();
				break;
			case 'deconnexion':
				$this->deconnexion();
				break;
			case 'mesCelliers':
				$this->mesCelliers($userId, $_SESSION["cellierId"]);
				break;
			case 'cellier':
				$this->cellier($userId);
				break;
			case 'ajouterCellier':
				$this->mesCelliers($userId);
				break;
			case 'ficheDetailsBouteille':
				$this->ficheDetailsBouteille($userId, $_SESSION["cellierId"], $_GET['bte']);
				break;
			default:
				// $this->accueil();
				// $this->cellier($userId, $_SESSION["cellierId"]);
				$this->mesCelliers($userId);
				break;
		}
	}

	/**
	 * Affiche la vue de la page accueil
	 */
	private function accueil()
	{
		include("vues/entete.php");
		include("vues/accueil.php");
	}

	/**
	 * Affiche la vue de la page cellier
	 */
	private function cellier($userId)
	{
		$_SESSION["cellierId"] = $_GET["cellierId"];
		$bte = new Bouteille();
		$data = $bte->getListeBouteilleCellier($userId, $_SESSION["cellierId"]);
		include("vues/entete.php");
		include("vues/navigation.php");
		include("vues/cellier.php");
		include("vues/pied.php");
	}

	/**
	 * Affiche la vue de la page mesCelliers
	 */
	private function mesCelliers($userId)
	{
		$cellier = new Cellier();
		$body = $_POST;

		if(!empty($body)){
			$resultat = $cellier->ajouterCellier($userId, $body["nomCellier"]);
		}

		if($resultat === true) {
			$_SESSION["message"] = "Cellier ajoutée !";
			$_SESSION["estVisible"] = true;
		}

		$mesCelliers = $cellier->getCelliers($userId);

		json_encode($mesCelliers);
		include("vues/entete.php");
		include("vues/navigation.php");
		include("vues/mesCelliers.php");
		include("vues/pied.php");
	}

	/**
	 * Affiche la vue de la page fiche
	 */
	private function ficheDetailsBouteille($userId, $cellierId, $idBouteille, $showMessage=false)
	{
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


	private function listeBouteille($userId, $cellierId)
	{
		$bte = new Bouteille();
		$cellier = $bte->getListeBouteilleCellier($userId, $cellierId);

		echo json_encode($cellier);
	}


	private function autocompleteBouteille()
	{
		$bte = new Bouteille();
		//var_dump(file_get_contents('php://input'));
		$body = json_decode(file_get_contents('php://input'));
		//var_dump($body);
		$listeBouteille = $bte->autocomplete($body->nom);

		echo json_encode($listeBouteille);
	}

	/**
	 * Affiche la vue de la page modifier
	 */
	private function modifierBouteilleCellier($userId, $cellierId, $idBouteille)
	{
		$type = new Type();
		$types = $type->getTypes();

		$body = $_POST;

		// var_dump($body);

		if (!empty($body)) {
			$bte = new Bouteille();
			// var_dump($body);
			$modifier = $bte->modifierBouteilleCellier($body);
			
			$showMessage = false;
			if ($modifier) $showMessage = true;

			$this->ficheDetailsBouteille($userId, $cellierId, $idBouteille, $showMessage);
		} else {
			$dataTypesModifier = $types;

			$bte = new Bouteille();
			$dataModifie = $bte->getListeBouteilleCellier($userId, $cellierId, $idBouteille);

			include("vues/entete.php");
			include("vues/navigation.php");
			include("vues/modifier.php");
			include("vues/pied.php");
		}
	}

	private function effacerBouteilleCellier($idBouteilleCellier)
	{
		$bte = new Bouteille();

		$effacer = $bte->effacerBouteilleCellier($idBouteilleCellier);

		Utilitaires::nouvelleRoute('index.php?requete=cellier&cellierId='.$_SESSION["cellierId"].'');
	}

	private function informationBouteilleParId()
	{
		$bte = new Bouteille();
		$id = $_GET["id"];
		$bouteille = $bte->getBouteilleParId($id);
		echo json_encode($bouteille);
	}

	private function ajouterNouvelleBouteilleCellier()
	{
		$type = new Type();
		$types = $type->getTypes();

		$body = json_decode(file_get_contents('php://input'), true);
		if (!empty($body)) {
			$bte = new Bouteille();
			$resultat = $bte->ajouterBouteilleCellier($body);
			if($resultat === false){
				$_SESSION["message"] = "Bouteille déjà créée.";
				$_SESSION["estVisible"] = true;
			} else {
				$_SESSION["message"] = "Bouteille ajoutée !";
				$_SESSION["estVisible"] = true;
			}
			// var_dump($resultat, $_SESSION["message"]);
			die();
		} else {
			$dataTypes = $types;

			include("vues/entete.php");
			include("vues/navigation.php");
			include("vues/ajouter.php");
			include("vues/pied.php");
		}
	}


	private function boireBouteilleCellier()
	{
		$body = json_decode(file_get_contents('php://input'));

		$bte = new Bouteille();
		$resultat = $bte->modifierQuantiteBouteilleCellier($body->id, -1);
		echo json_encode($resultat);
	}

	private function ajouterBouteilleCellier()
	{
		$body = json_decode(file_get_contents('php://input'));

		$bte = new Bouteille();
		$resultat = $bte->modifierQuantiteBouteilleCellier($body->id, 1);
		// var_dump($resultat);
		echo json_encode($resultat);
	}

	/**
	 * Affiche la vue de la page inscription
	 */
	private function inscription()
	{
		include("vues/entete.php");
		include("vues/inscription.php");
		include("vues/pied.php");
	}

	/**
	 * Affiche la vue de la page connexion si $_POST est vide
	 * ou valide le courriel/mdp et laisse l'usager passer.
	 */
	private function connexion()
	{
		$body = $_POST;

		if (empty($body)) {
		include("vues/entete.php");
		include("vues/connexion.php");
		include("vues/pied.php");
		} else {
			$courriel = $_POST['uti_courriel'];
			$mdp = $_POST['uti_mdp'];

			$uti = new Utilisateur();
			$resultat = $uti->getUtilisateurParCourriel($courriel);
			// var_dump($resultat);

			if (!$resultat || !password_verify($mdp, $resultat['mot_de_passe'])) {
				$_SESSION["message"] = "Combinaison courriel/mot de passe erronée";

				// Si la connexion n'a pas bien marché on redirectione vers la page de connexion.
				Utilitaires::nouvelleRoute('index.php?requete=connexion');
			} else {
				// Sauvegarder l'état de connexion
				$_SESSION['utilisateur'] = $resultat;

				// Si la connexion a pas bien marché on redirectione vers la page d'accueil.
				Utilitaires::nouvelleRoute('index.php?requete=accueil');
			}
		}
	}

	/**
	 * Supprimer la connexion d'un utilisateur (en détruisant la variable de session associée)
	 */
	public function deconnexion()
	{
		unset($_SESSION['utilisateur']);
		Utilitaires::nouvelleRoute('index.php?requete=connexion');
	}

	/**
	 * Ajoute un nouveau utilisateur (rôle Utilisateur)
	 */
	private function inscrireUtilisateur()
	{
		$body = $_POST;

		if (!empty($body)) {
			// var_dump($body);

			$uti = new Utilisateur();
			$resultat = $uti->ajouterUtilisateur($body);
			// var_dump($resultat);

			if ($resultat === false) {
				$_SESSION["message"] = $uti->getErrorMessage();

				// Si l'inscription n'a pas bien marché on redirectione vers la page d'inscription.
				Utilitaires::nouvelleRoute('index.php?requete=inscription');
			} else {
				$_SESSION["message"] = "Utilisateur inscrit.e !";

				// Si l'inscription a bien marché on redirectione vers la page de connexion.
				Utilitaires::nouvelleRoute('index.php?requete=connexion');
			}
		}
	}
}
