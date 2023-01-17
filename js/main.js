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
const BaseURL = document.baseURI;
console.log(BaseURL);
window.addEventListener('load', function() {
  console.log('load')

  /**
   * Fonctionnalité page Cellier
   * Appuyer sur bouton '-' réduit la quantité d'un type de bouteille.
   */

  document.querySelectorAll('.btnBoire').forEach(function (element) {
    console.log(element)
    element.addEventListener('click', function (evt) {
      // Empêche la propagation de l'evt sur parent ou enfant
      evt.stopPropagation()
      let id = evt.target.dataset.id
      let requete = new Request(
        BaseURL + 'index.php?requete=boireBouteilleCellier',
        { method: 'POST', body: '{"id": ' + id + '}' }
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
          console.debug(response)
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
    console.log(element)
    element.addEventListener('click', function (evt) {
      // Empêche la propagation de l'evt sur parent ou enfant
      evt.stopPropagation()
      let id = evt.target.dataset.id
      let requete = new Request(
        BaseURL + 'index.php?requete=ajouterBouteilleCellier',
        { method: 'POST', body: '{"id": ' + id + '}' }
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
          console.debug(response)
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
  console.log(inputNomBouteille)
  let liste = document.querySelector('.listeAutoComplete')

  if (inputNomBouteille) {
    inputNomBouteille.addEventListener('keyup', function (evt) {
      console.log(evt)
      let nom = inputNomBouteille.value
      liste.innerHTML = ''
      if (nom) {
        let requete = new Request(
          BaseURL + 'index.php?requete=autocompleteBouteille',
          { method: 'POST', body: '{"nom": "' + nom + '"}' }
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
      date_achat: document.querySelector("[name='date_achat']"),
      prix: document.querySelector("[name='prix']"),
      garde_jusqua: document.querySelector("[name='garde_jusqua']"),
      notes: document.querySelector("[name='notes']"),
    }

    /**
     * Fonctionnalité page Ajout
     * Si élément de liste dans les résultats de recherche cliqué,
     * complète le nom de la bouteille dans l'input du form.
     */

    liste.addEventListener('click', function (evt) {
      if (evt.target.tagName == 'LI') {
        bouteille.nom.dataset.id = evt.target.dataset.id
        bouteille.nom.value = evt.target.innerHTML

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
        var param = {
          id_bouteille: bouteille.nom.dataset.id,
          date_achat: bouteille.date_achat.value,
          garde_jusqua: bouteille.garde_jusqua.value,
          notes: bouteille.date_achat.value,
          prix: bouteille.prix.value,
          quantite: bouteille.quantite.value,
          millesime: bouteille.millesime.value,
        }
        let requete = new Request(
          BaseURL + 'index.php?requete=ajouterNouvelleBouteilleCellier',
          { method: 'POST', body: JSON.stringify(param) }
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
          })
          .catch((error) => {
            console.error(error)
          })
      })
    }
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
  elemQuantite.innerText = `Quantité : ${quantiteApresBoire}`;
}
