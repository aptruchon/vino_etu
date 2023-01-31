/**
 * @file Script contenant les fonctions de base
 * @author Jonathan Martel (jmartel@cmaisonneuve.qc.ca)
 * @version 0.1
 * @update 2019-01-21
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 *
 */

import { reduitQuantBouteille, augmenteQuantBouteille } from './pageCellier.js'
import { ouvrirBoiteModaleSupprimer, fermerBoiteModaleSupprimer,} from './fenetreSupprimer.js';
import {
  afficheResulatRechVin,
  preremplitFormAjout,
  ajoutVinCellier,
  effaceInputsForm,
} from './pageAjout.js'
import { ouvrirBoiteModaleAjoutCelliers, fermerBoiteModaleAjoutCelliers } from './pageMesCelliers.js'

const BaseURL = window.location.href.split('?')[0];

window.addEventListener('load', function() {
  /***
   * Ajout d'une classe sur le body des pages inscription et connexion pour que le background colore ne deborde pas du body en mobile.
   */
  const nomPage = window.location.href.split('=')[1]
  if (nomPage == 'inscription' || nomPage == 'connexion') {
    document.querySelector('body').classList.add('body-container')
  }

  /**
   * Fonctionnalités page Cellier
   */

  reduitQuantBouteille()
  augmenteQuantBouteille()

  /**
   * Fonctionnalites Page Ajout
   * */

  let bouteille = {
    nom: document.querySelector("[name='nom']"),
    millesime: document.querySelector("[name='millesime']"),
    quantite: document.querySelector("[name='quantite']"),
    /* date_achat: document.querySelector("[name='date_achat']"), */
    description: document.querySelector("[name='description']"),
    format: document.querySelector("[name='format']"),
    pays: document.querySelector("[name='pays']"),
    prix: document.querySelector("[name='prix']"),
    garde_jusqua: document.querySelector("[name='garde_jusqua']"),
    notes: document.querySelector("[name='notes']"),
    // typesPossibles: document.querySelectorAll("[name='type']"),
    types: document.querySelector("[name='types']"),
    type: {},
  }

  if (nomPage == 'ajouterNouvelleBouteilleCellier') {
    afficheResulatRechVin()
    preremplitFormAjout(bouteille)
    ajoutVinCellier(bouteille)
    effaceInputsForm(bouteille)
  }

  /**
   * Fonctionnalité Page Modifier
   */
  //pour ouvrir et fermer la boite modale supprimer
  ouvrirBoiteModaleSupprimer()
  fermerBoiteModaleSupprimer()



  /**
   * Fonctionnalités Page Mes Cellier
   */

  ouvrirBoiteModaleAjoutCelliers(); 
  fermerBoiteModaleAjoutCelliers() 


});

/**
 * Actualise la quantité du dataset du vin
 * ainsi que la quantité affiché après le clic du bouton (-).
 * 
 * @param divBouteille - div où se trouvent les infos du vin.
 */
function updateQuantiteApresBoire(divBouteille) {
  // Quantité qui est au dataset de la div.
  let quantiteAvantBoire = parseInt(divBouteille.dataset.quantite);
  // On calcule la nouvelle quantité.
  let quantiteApresBoire = (quantiteAvantBoire == 0) ? 0 : (quantiteAvantBoire - 1);
  // On actualise le dataset.
  divBouteille.dataset.quantite = quantiteApresBoire;
  // Et on actualise aussi l'élément <p> qui affiche la quantité.
  let elemQuantite = divBouteille.getElementsByClassName('quantite')[0];
  elemQuantite.innerText = quantiteApresBoire;
}




