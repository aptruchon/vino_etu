<?php
/**
 * Gestion de l'accueil
 */
class AccueilController extends Controller
{
	/**
	 * Affiche la vue de la page accueil
	 */
	protected function accueil()
	{
		// Redirection si un utilisateur déjà connecté essaie de rendre sur la page connexion
		if(isset($_SESSION["utilisateur"])){
			Utilitaires::nouvelleRoute('index.php?requete=mesCelliers');
		} else {
			include("vues/entete.php");
			include("vues/accueil.php");
		}
	}
}
