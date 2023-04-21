<?php
session_start();

/**
 * Class Controler
 * Gère les requêtes HTTP
 * 
 * @author Alana Fulvia Bezerra De Moraes, Alex Poulin Truchon, Claudia Lisboa, Pauline Huby
 * @version 2.0
 * @update 2023-02-05
 * 
 */

class Controller
{
	/**
	 * Traite la requête
	 * @return void
	 */
	public function gerer()
	{    
		switch ($_GET['requete']) {
			case 'listeBouteille':
				$this->listeBouteille($_SESSION['utilisateur']['id'], $_SESSION["cellierId"]);
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
				$this->modifierBouteilleCellier($_SESSION['utilisateur']['id'], $_SESSION["cellierId"], $_GET['bte']);
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
			case 'inscrireUtilisateur':
				$this->inscrireUtilisateur();
				break;
			case 'connexion':
				$this->connexion();
				break;
			case 'deconnexion':
				$this->deconnexion();
				break;
			case 'mesCelliers':
				$this->mesCelliers($_SESSION['utilisateur']['id']);
				break;
			case 'cellier':
				$this->cellier($_SESSION['utilisateur']['id']);
				break;
			case 'ajouterCellier':
				$this->mesCelliers($_SESSION['utilisateur']['id']);
				break;
			case 'modifierCellier':
				$this->modifierCellier($_SESSION['utilisateur']['id']);
				break;
			case 'supprimerCellier':
				$this->supprimerCellier($_SESSION['utilisateur']['id']);
				break;
			case 'ficheDetailsBouteille':
				$this->ficheDetailsBouteille($_SESSION['utilisateur']['id'], $_SESSION["cellierId"], $_GET['bte']);
				break;
			default:
				 $this->accueil();
			    // $this->cellier($_SESSION['utilisateur']['id'], $_SESSION["cellierId"]);
				// $this->mesCelliers($_SESSION['utilisateur']['id']);
				break;
		}
	}

	/**
	 * Affiche la vue de la page accueil
	 */
	private function accueil()
	{
		// Redirection si un utilisateur déjà connecté essaie de rendre sur la page connexion
		if(isset($_SESSION["utilisateur"])){
			Utilitaires::nouvelleRoute('index.php?requete=mesCelliers');
		} else {
			include("vues/entete.php");
			include("vues/accueil.php");
		}
	}

	/**
	 * Affiche la vue de la page cellier
	 */
	private function cellier($userId)
	{
		// Redirection si un utilisateur non-connecté essaie d'aller sur une page qui requiert une authentification
		if(!isset($_SESSION["utilisateur"])){
			Utilitaires::nouvelleRoute('index.php?requete=connexion');
			die();
		}

		$_SESSION["cellierId"] = $_GET["cellierId"];

		$bte = new Bouteille();
		$data = $bte->getListeBouteilleCellier($userId, $_SESSION["cellierId"]);

		$cellier = new Cellier();
		$cellierParId = $cellier->getCellierParId($_SESSION["cellierId"]);
		$_SESSION["nomCellier"] = $cellierParId["nom"];

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
		// Redirection si un utilisateur non-connecté essaie d'aller sur une page qui requiert une authentification
		if(!isset($_SESSION["utilisateur"])){
			Utilitaires::nouvelleRoute('index.php?requete=connexion');
			die();
		}
		
		$cellier = new Cellier();
		$body = $_POST;

		if(!empty($body)){
			$resultatCelliers = $cellier->ajouterCellier($userId, $body["nomCellier"]);
			Utilitaires::nouvelleRoute('index.php?requete=mesCelliers');
			die();

		}

		if(isset($resultat) && $resultat === true) {
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

	private function modifierCellier($userId) {
		$cellier = new Cellier();

		$cellierParId = $cellier->getCellierParId($_POST["idCellier"]);

		if($cellierParId["vino__utilisateur_id"] !== $userId){
			Utilitaires::nouvelleRoute('index.php?requete=mesCelliers');
			die();
		}

		$cellier->modifierCellier($_POST);
		Utilitaires::nouvelleRoute('index.php?requete=mesCelliers');

	}

	private function supprimerCellier($userId) {
		$cellier = new Cellier();

		$cellierParId = $cellier->getCellierParId($_POST["idCellier"]);

		if($cellierParId["vino__utilisateur_id"] !== $userId){
			Utilitaires::nouvelleRoute('index.php?requete=mesCelliers');
			die();
		}

		$cellier->supprimerCellier($_POST);
		Utilitaires::nouvelleRoute('index.php?requete=mesCelliers');
	}

	/**
	 * Affiche la vue de la page Fiche d'un vin
	 */
	private function ficheDetailsBouteille($userId, $cellierId, $idBouteille, $showMessage=false)
	{
		// Redirection si un utilisateur non-connecté essaie d'aller sur une page qui requiert une authentification
		if(!isset($_SESSION["utilisateur"])){
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
	 * 
	 */
	private function listeBouteille($userId, $cellierId)
	{
		$bte = new Bouteille();
		$cellier = $bte->getListeBouteilleCellier($userId, $cellierId);

		echo json_encode($cellier);
	}

	/**
	 * 
	 */
	private function autocompleteBouteille()
	{
		$bte = new Bouteille();
		$body = json_decode(file_get_contents('php://input'));
		$listeBouteille = $bte->autocomplete($body->nom);

		echo json_encode($listeBouteille);
	}

	/**
	 * Modifie les informations d'un vin dans un cellier
	 */
	private function modifierBouteilleCellier($userId, $cellierId, $idBouteille)
	{
		// Redirection si un utilisateur non-connecté essaie d'aller sur une page qui requiert une authentification
		if(!isset($_SESSION["utilisateur"])){
			Utilitaires::nouvelleRoute('index.php?requete=connexion');
			die();
		}
		
		$type = new Type();
		$types = $type->getTypes();

		$body = json_decode(file_get_contents('php://input'), true);

		if (!empty($body)) {
			$bte = new Bouteille();
			$resultat = $bte->modifierBouteilleCellier($body);

			// Message pop-up confirmation modification faite
			$_SESSION["message"] = "Bouteille modifiée !";
			$_SESSION["estVisible"] = true;

			die();

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

	/**
	 * Supprime un vin d'un cellier
	 */
	private function effacerBouteilleCellier($idBouteilleCellier)
	{
		// Redirection si un utilisateur non-connecté essaie d'aller sur une page qui requiert une authentification
		if(!isset($_SESSION["utilisateur"])){
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

	/**
	 * 
	 */
	private function informationBouteilleParId()
	{
		$bte = new Bouteille();
		$id = $_GET["id"];
		$bouteille = $bte->getBouteilleParId($id);
		echo json_encode($bouteille);
	}

	/**
	 * Ajoute un nouveau vin dans un cellier
	 */
	private function ajouterNouvelleBouteilleCellier()
	{
		// Redirection si un utilisateur non-connecté essaie d'aller sur une page qui requiert une authentification
		if(!isset($_SESSION["utilisateur"])){
			Utilitaires::nouvelleRoute('index.php?requete=connexion');
			die();
		}
		
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
			die();
		} else {
			$dataTypes = $types;

			include("vues/entete.php");
			include("vues/navigation.php");
			include("vues/ajouter.php");
			include("vues/pied.php");
		}
	}

	/**
	 * Diminue la quantite de bouteilles d'un vin dans un cellier
	 */
	private function boireBouteilleCellier()
	{
		$body = json_decode(file_get_contents('php://input'));

		$bte = new Bouteille();
		$resultat = $bte->modifierQuantiteBouteilleCellier($body->id, -1);
		echo json_encode($resultat);
	}

	/**
	 * Augmente la quantite de bouteilles d'un vin dans un cellier
	 */
	private function ajouterBouteilleCellier()
	{
		$body = json_decode(file_get_contents('php://input'));

		$bte = new Bouteille();
		$resultat = $bte->modifierQuantiteBouteilleCellier($body->id, 1);

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
		// Redirection si un utilisateur déjà connecté essaie de rendre sur la page connexion
		if(isset($_SESSION["utilisateur"])){
			Utilitaires::nouvelleRoute('index.php?requete=mesCelliers');
		}

		$body = json_decode(file_get_contents('php://input'), true);

		if (empty($body)) {
		include("vues/entete.php");
		include("vues/connexion.php");
		include("vues/pied.php");
		} else {
			$courriel = $body['uti_courriel'];
			$mdp = $body['uti_mdp'];

			$uti = new Utilisateur();
			$resultat = $uti->getUtilisateurParCourriel($courriel);
			// var_dump($resultat);

			if (!$resultat || !password_verify($mdp, $resultat['mot_de_passe'])) {
				http_response_code(400);

			} else {
				http_response_code(200);

				// Sauvegarder l'état de connexion
				$_SESSION['utilisateur'] = $resultat;

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

		// Redirection si un utilisateur déjà connecté essaie de rendre sur la page inscription
		if(isset($_SESSION["utilisateur"])){
			Utilitaires::nouvelleRoute('index.php?requete=mesCelliers');
		}
    
    	$body = json_decode(file_get_contents('php://input'), true);

		if (!empty($body)) {

			$uti = new Utilisateur();
			$resultat = $uti->ajouterUtilisateur($body);
			
			if($resultat === false){
				http_response_code(400);

			} else {
				http_response_code(200);

				$courriel = $body['uti_courriel'];

				$uti = new Utilisateur();
				$resultat = $uti->getUtilisateurParCourriel($courriel);

				// Sauvegarder l'état de connexion
				$_SESSION['utilisateur'] = $resultat;
			}
		}
	}
}
