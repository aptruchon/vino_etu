/**
 * @file Script contenant les fonctions de base
 * @author Alana Fulvia Bezerra De Moraes, Alex Poulin Truchon, Claudia Lisboa, Pauline Huby
 * @version 0.2
 * @update 2023-02-05
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
import { ouvrirBoitesModalesMesCelliers, fermerBoitesModalesMesCelliers } from './pageMesCelliers.js'
import { openNav, closeNav } from './navigation.js'
import {
  oeilPassword,
  envoiDonneesInscription,
  checkRequiredInputContentLogin,
  envoiDonneesConnexion,
} from './inscription.js'
import { modifieVinCellier, checkRequiredInputContent } from './pageModifie.js'

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

  let inputsRequired = {
    nom: document.querySelector("[name='nom']"),
    quantite: document.querySelector("[name='quantite']"),
    pays: document.querySelector("[name='pays']"),
    types: document.querySelector("[name='types']"),
  }

  if (nomPage == 'ajouterNouvelleBouteilleCellier') {
    afficheResulatRechVin()
    preremplitFormAjout(bouteille)
    ajoutVinCellier(bouteille, inputsRequired)
    effaceInputsForm(inputsFormAjout)
    checkRequiredInputContent(inputsRequired)
  }

  /**
   * Fonctionnalités Page Mes Cellier
   */

  ouvrirBoitesModalesMesCelliers()
  fermerBoitesModalesMesCelliers()

  /**
   * Fonctionnalité Page Modifier
   */
  //pour ouvrir et fermer la boite modale supprimer
  ouvrirBoiteModaleSupprimer()
  fermerBoiteModaleSupprimer()


  if (nomPage == 'modifierBouteilleCellier&bte') {
    modifieVinCellier(bouteille, inputsRequired)
    checkRequiredInputContent(inputsRequired)
  }


  /**
   * Fonctionnalités pages Inscription / Connexion
   */

  if (nomPage == 'inscription' || nomPage == 'connexion') {
    oeilPassword()
    checkRequiredInputContentLogin()
  }

  if (nomPage == 'inscription' ) {
    envoiDonneesInscription()
  }

  if (nomPage == 'connexion') {
    envoiDonneesConnexion()
  }

  /**
   * Fonctionnalités Navigation
   */

  if (nomPage != 'inscription' && nomPage != 'connexion') {
    const elMobileNav = document.getElementById('mobile-nav')
    openNav(elMobileNav)
    closeNav(elMobileNav)
  }
  
});

