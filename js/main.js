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
import { openNav, closeNav } from './navigation.js'
import { oeilPassword } from './inscription.js'

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
    description: document.querySelector("[name='description']"),
    format: document.querySelector("[name='format']"),
    pays: document.querySelector("[name='pays']"),
    prix: document.querySelector("[name='prix']"),
    garde_jusqua: document.querySelector("[name='garde_jusqua']"),
    notes: document.querySelector("[name='notes']"),
    types: document.querySelector("[name='types']"),
    type: {},
  }

  let inputsFormAjout = [
    bouteille.nom,
    bouteille.millesime,
    bouteille.quantite,
    bouteille.description,
    bouteille.format,
    bouteille.pays,
    bouteille.prix,
    bouteille.garde_jusqua,
    bouteille.notes,
    bouteille.types,
  ]

  if (nomPage == 'ajouterNouvelleBouteilleCellier') {
    afficheResulatRechVin()
    preremplitFormAjout(bouteille)
    ajoutVinCellier(bouteille)
    effaceInputsForm(inputsFormAjout)
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

  ouvrirBoiteModaleAjoutCelliers()
  fermerBoiteModaleAjoutCelliers()

  /**
   * Fonctionnalité pour le password dans Inscription
   */
  oeilPassword()

  /**
   * Fonctionnalités Navigation
   */
  const elMobileNav = document.getElementById('mobile-nav');
  openNav(elMobileNav)
  closeNav(elMobileNav)




});

