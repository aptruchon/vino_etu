<?php
/**
 * Gestion des utilisateurs
 */
class UtilisateurController extends Controller
{
	/**
	 * Affiche la vue de la page inscription
	 */
	protected function inscription()
	{
		include("vues/entete.php");
		include("vues/inscription.php");
		include("vues/pied.php");
	}

	/**
	 * Affiche la vue de la page connexion si $_POST est vide
	 * ou valide le courriel/mdp et laisse l'usager passer.
	 */
	protected function connexion()
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
	protected function inscrireUtilisateur()
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
