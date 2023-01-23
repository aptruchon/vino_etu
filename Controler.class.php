<?php

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
		$cellierId = 1;

		switch ($_GET['requete']) {
			case 'listeBouteille':
				$this->listeBouteille($userId, $cellierId);
				break;
			case 'autocompleteBouteille':
				$this->autocompleteBouteille();
				break;
			case 'ajouterNouvelleBouteilleCellier':
				$this->ajouterNouvelleBouteilleCellier();
				break;
			case 'modifierBouteilleCellier':
				$this->modifierBouteilleCellier($userId, $cellierId, $_GET['bte']);
				break;
			case 'ajouterBouteilleCellier':
				$this->ajouterBouteilleCellier();
				break;
			case 'boireBouteilleCellier':
				$this->boireBouteilleCellier();
				break;
			case 'inscription':
				$this->inscription();
				break;
			case 'connexion':
				$this->connexion();
				break;
			case 'cellier':
				$this->cellier($userId, $cellierId);
				break;
			case 'ficheDetailsBouteille':
				$this->ficheDetailsBouteille($userId, $cellierId, $_GET['bte']);
				break;
			default:
				$this->accueil();
				break;
		}
	}

	private function accueil()
	{
		include("vues/entete.php");
		include("vues/accueil.php");
	}

	private function cellier($userId, $cellierId)
	{
		$bte = new Bouteille();
		$data = $bte->getListeBouteilleCellier($userId, $cellierId);
		include("vues/entete.php");
		include("vues/navigation.php");
		include("vues/cellier.php");
		include("vues/pied.php");
	}

	private function ficheDetailsBouteille($userId, $cellierId, $idBouteille)
	{
		$bte = new Bouteille();
		$data = $bte->getListeBouteilleCellier($userId, $cellierId, $idBouteille);

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
	private function ajouterNouvelleBouteilleCellier()
	{
		$body = json_decode(file_get_contents('php://input'));
		//var_dump($body);
		if (!empty($body)) {
			$bte = new Bouteille();
			//var_dump($_POST['data']);

			//var_dump($data);
			$ajouter = $bte->ajouterBouteilleCellier($body);
			echo json_encode($resultat);
		} else {
			include("vues/entete.php");
			include("vues/navigation.php");
			include("vues/ajouter.php");
			include("vues/pied.php");
		}
	}

	private function modifierBouteilleCellier($userId, $cellierId, $idBouteille)
	{
		$body = json_decode(file_get_contents('php://input'));

		var_dump($body);

		if (!empty($body)) {
			$bte = new Bouteille();
			//var_dump($_POST['data']);

			//var_dump($data);
			$modifier = $bte->modifierBouteilleCellier($body);
			echo json_encode($modifier);
		} else {
			$bte = new Bouteille();
			$data = $bte->getListeBouteilleCellier($userId, $cellierId, $idBouteille);

			include("vues/entete.php");
			include("vues/navigation.php");
			include("vues/modifier.php");
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
		//var_dump($resultat);
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
	 * Affiche la vue de la page connexion
	 */
	private function connexion()
	{

		include("vues/entete.php");
		include("vues/connexion.php");
		include("vues/pied.php");
	}
}
