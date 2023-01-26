/**
 * @file Script contenant les fonctions de base
 * @author Jonathan Martel (jmartel@cmaisonneuve.qc.ca)
 * @version 0.1
 * @update 2019-01-21
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 *
 */

//const BaseURL = "https://jmartel.webdev.cmaisonneuve.qc.ca/n61/vino/";
//const BaseURL = document.baseURI;
const BaseURL = window.location.href.split('?')[0];
console.log(BaseURL);

window.addEventListener('load', function() {
  // console.log('load')

  /***
   * Ajout d'une classe sur le body des pages inscription et connexion pour que le background colore ne deborde pas du body en mobile.
   */
  const nomPage = window.location.href.split('=')[1];
  if (nomPage == 'inscription' || nomPage == 'connexion') {
    document.querySelector('body').classList.add('body-container')
  }


  /**
   * Fonctionnalité page Cellier
   * Appuyer sur bouton '-' réduit la quantité d'un type de bouteille.
   */

  document.querySelectorAll('.btnBoire').forEach(function (element) {
    // console.log(element)
    element.addEventListener('click', function (evt) {
      // Empêche la propagation de l'evt sur parent ou enfant
      evt.stopPropagation()
      let id = evt.target.dataset.id
      let requete = new Request(BaseURL + '?requete=boireBouteilleCellier', {
        method: 'POST',
        body: '{"id": ' + id + '}',
      })

      fetch(requete)
        .then((response) => {
          if (response.status === 200) {
            return response.json()
          } else {
            throw new Error('Erreur')
          }
        })
        .then((response) => {
          console.debug(response)

          if (response) {
            // Recupere la div bouteille ou se trouvent les infos du vin
            let div = evt.target.closest('.bouteille')
            updateQuantiteApresBoire(div)
          }
        })
        .catch((error) => {
          console.error(error)
        })
    })
  })

  /**
   * Fonctionnalité page Cellier
   * Appuyer sur bouton '+' augmente la quantité d'un type de bouteille.
   */

  document.querySelectorAll('.btnAjouter').forEach(function (element) {
    // console.log(element)
    element.addEventListener('click', function (evt) {
      // Empêche la propagation de l'evt sur parent ou enfant
      evt.stopPropagation()
      let id = evt.target.dataset.id
      let requete = new Request(BaseURL + '?requete=ajouterBouteilleCellier', {
        method: 'POST',
        body: '{"id": ' + id + '}',
      })

      fetch(requete)
        .then((response) => {
          if (response.status === 200) {
            return response.json()
          } else {
            throw new Error('Erreur')
          }
        })
        .then((response) => {
          console.debug(response)

          if (response) {
            // Recupère la div bouteille où se trouvent les infos du vin.
            let div = evt.target.closest('.bouteille')
            updateQuantiteApresAjouter(div)
          }
        })
        .catch((error) => {
          console.error(error)
        })
    })
  })

  /**
   * Fonctionnalité page Ajout
   * Affichage de résultats d'une recherche d'un nom de bouteille.
   */

  let inputNomBouteille = document.querySelector("[name='nom_bouteille']")
  // console.log(inputNomBouteille)
  let liste = document.querySelector('.listeAutoComplete')

  if (inputNomBouteille) {
    inputNomBouteille.addEventListener('keyup', function (evt) {
      // console.log(evt)
      let nom = inputNomBouteille.value
      liste.innerHTML = ''
      if (nom) {
        let requete = new Request(BaseURL + '?requete=autocompleteBouteille', {
          method: 'POST',
          body: '{"nom": "' + nom + '"}',
        })
        fetch(requete)
          .then((response) => {
            if (response.status === 200) {
              return response.json()
            } else {
              throw new Error('Erreur')
            }
          })
          .then((response) => {
            console.log(response)

            response.forEach(function (element) {
              liste.innerHTML +=
                "<li data-id='" + element.id + "'>" + element.nom + '</li>'
            })
          })
          .catch((error) => {
            console.error(error)
          })
      }
    })

    /**
     * Fonctionnalité page Ajout
     * Affichage de résultats d'une recherche d'un nom de bouteille.
     */

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
      typesPossibles: document.querySelectorAll("[name='type']"),
      type: {},
    }

    /**
     * Fonctionnalité page Ajout
     * Si élément de liste dans les résultats de recherche cliqué,
     * complète le nom de la bouteille dans l'input du form.
     */
    liste.addEventListener('click', function (evt) {
      if (evt.target.tagName == 'LI') {
        bouteille.nom.dataset.id = evt.target.dataset.id

        let requete = new Request(
          BaseURL +
            '?requete=informationBouteilleParId&id=' +
            bouteille.nom.dataset.id,
          { method: 'GET' }
        )
        fetch(requete)
          .then((response) => {
            if (response.status === 200) {
              return response.json()
            } else {
              throw new Error('Erreur')
            }
          })
          .then((response) => {
            console.log(response)
            bouteilleChoisi = response
            console.log(bouteille.typesPossibles)

            bouteille.nom.value = bouteilleChoisi.nom
            bouteille.pays.value = bouteilleChoisi.pays
            bouteille.format.value = bouteilleChoisi.format
            bouteille.description.value = bouteilleChoisi.description
            bouteille.prix.value = bouteilleChoisi.prix_saq
            bouteille.nom.setAttribute('readonly', true)
            bouteille.pays.setAttribute('readonly', true)
            bouteille.format.setAttribute('readonly', true)
            bouteille.description.setAttribute('readonly', true)
            bouteille.prix.setAttribute('readonly', true)

            bouteille.nom.classList.add('readOnly')
            bouteille.pays.classList.add('readOnly')
            bouteille.format.classList.add('readOnly')
            bouteille.description.classList.add('readOnly')
            bouteille.prix.classList.add('readOnly')

            for (let i = 0, l = bouteille.typesPossibles.length; i < l; i++) {
              if (
                bouteille.typesPossibles[i].id == bouteilleChoisi.vino__type_id
              ) {
                bouteille.typesPossibles[i].removeAttribute('disabled')
                bouteille.typesPossibles[i].setAttribute('selected', '')
                bouteille.type = bouteille.typesPossibles[i]
              } else {
                bouteille.typesPossibles[i].removeAttribute('selected')
                bouteille.typesPossibles[i].setAttribute('disabled', true)
              }
            }
          })
          .catch((error) => {
            console.error(error)
          })

        liste.innerHTML = ''
        inputNomBouteille.value = ''
      }
    })

    /**
     * Fonctionnalité page Ajout
     * Fait une requete à la DB pour ajouter une bouteille au cellier de l'usager.
     */

    let btnAjouter = document.querySelector("[name='ajouterBouteilleCellier']")
    if (btnAjouter) {
      btnAjouter.addEventListener('click', function (evt) {
        for (let i = 0, l = bouteille.typesPossibles.length; i < l; i++) {
          if (bouteille.typesPossibles[i].checked == true) {
            bouteille.type = bouteille.typesPossibles[i]
          }
        }

        var param = {
          id_bouteille: bouteille.nom.dataset.id,
          id_type: bouteille.type.id,
          nom: bouteille.nom.value,
          pays: bouteille.pays.value,
          description: bouteille.description.value,
          format: bouteille.format.value,
          garde_jusqua: bouteille.garde_jusqua.value,
          notes: bouteille.notes.value,
          prix: bouteille.prix.value,
          quantite: bouteille.quantite.value,
          millesime: bouteille.millesime.value,
        }
        console.log(JSON.stringify(param))

        let requete = new Request(
          BaseURL + '?requete=ajouterNouvelleBouteilleCellier',
          { method: 'POST', body: JSON.stringify(param) }
        )
        fetch(requete)
          .then((response) => {
            if (response.status === 200) {
              console.log(response)

              return response.json()
            } else {
              throw new Error('Erreur')
            }
          })
          .then((response) => {
            console.log(response)
            location.replace(BaseURL + '?requete=cellier')
          })
          .catch((error) => {
            console.error(error)

            // Temporaire
            location.replace(BaseURL + '?requete=cellier')
          })
      })
    }
  }

  /**
   * Fonctionnalité pour ouvrir la boite modale supprimer
   */
  let popupForm = document.getElementById('popupForm')
  let btnSupprimerBouteille = document.querySelector('[name="btnSupprimer"]')
  let modalContainer = document.getElementById('modal-container')
  console.log(btnSupprimerBouteille)
  if (btnSupprimerBouteille) {
    btnSupprimerBouteille.addEventListener('click', function (evt) {
      popupForm.style.display = 'block'
      modalContainer.style.display = 'block'
    })
  }

  /**
   * Fonctionnalité pour fermer la boite modale supprimer
   */

  let btnCloseModale = document.getElementById("closeForm");
  let btnCloseX = document.getElementById("closeFormX");
  if(btnCloseModale){
    btnCloseModale.addEventListener('click', function(evt){
      popupForm.style.display = "none";
      modalContainer.style.display = "none";
    })
  }
  if(btnCloseX){
    btnCloseX.addEventListener('click', function(evt){
      popupForm.style.display = "none";
      modalContainer.style.display = "none";
    })
  }
  
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

/**
 * Actualise la quantité du dataset du vin
 * ainsi que la quantité affiché après le clic du bouton (+).
 * 
 * @param divBouteille - div où se trouvent les infos du vin.
 */
function updateQuantiteApresAjouter(divBouteille) {
  // Quantité qui est au dataset de la div.
  let quantiteAvantAjouter = parseInt(divBouteille.dataset.quantite);
  // On calcule la nouvelle quantité.
  let quantiteApresAjouter = quantiteAvantAjouter + 1;
  // On actualise le dataset.
  divBouteille.dataset.quantite = quantiteApresAjouter;
  // Et on actualise aussi l'élément <p> qui affiche la quantité.
  let elemQuantite = divBouteille.getElementsByClassName('quantite')[0];
  elemQuantite.innerText = quantiteApresAjouter;
}



