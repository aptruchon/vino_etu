/**
 *  Appuyer sur bouton '-' réduit la quantité d'un type de bouteille.
 */ 
 
function reduitQuantBouteille() {
  const BaseURL = window.location.href.split('?')[0]
  document.querySelectorAll('.btnBoire').forEach(function (element) {
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
            return response.json
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
}
  

  /**
   * Fonctionnalité page Cellier
   * Appuyer sur bouton '+' augmente la quantité d'un type de bouteille.
   */

  function augmenteQuantBouteille() {
    const BaseURL = window.location.href.split('?')[0]
    document.querySelectorAll('.btnAjouter').forEach(function (element) {
      // console.log(element)
      element.addEventListener('click', function (evt) {
        // Empêche la propagation de l'evt sur parent ou enfant
        evt.stopPropagation()
        let id = evt.target.dataset.id
        let requete = new Request(
          BaseURL + '?requete=ajouterBouteilleCellier',
          {
            method: 'POST',
            body: '{"id": ' + id + '}',
          }
        )

        fetch(requete)
          .then((response) => {
            if (response.status === 200) {
              return response.json
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
  }
  

/**
 * Actualise la quantité du dataset du vin
 * ainsi que la quantité affiché après le clic du bouton (-).
 *
 * @param divBouteille - div où se trouvent les infos du vin.
 */
function updateQuantiteApresBoire(divBouteille) {
  // Quantité qui est au dataset de la div.
  let quantiteAvantBoire = parseInt(divBouteille.dataset.quantite)
  // On calcule la nouvelle quantité.
  let quantiteApresBoire = quantiteAvantBoire == 0 ? 0 : quantiteAvantBoire - 1
  // On actualise le dataset.
  divBouteille.dataset.quantite = quantiteApresBoire
  // Et on actualise aussi l'élément <p> qui affiche la quantité.
  let elemQuantite = divBouteille.getElementsByClassName('quantite')[0]
  elemQuantite.innerText = quantiteApresBoire
}

/**
 * Actualise la quantité du dataset du vin
 * ainsi que la quantité affiché après le clic du bouton (+).
 *
 * @param divBouteille - div où se trouvent les infos du vin.
 */
function updateQuantiteApresAjouter(divBouteille) {
  // Quantité qui est au dataset de la div.
  let quantiteAvantAjouter = parseInt(divBouteille.dataset.quantite)
  // On calcule la nouvelle quantité.
  let quantiteApresAjouter = quantiteAvantAjouter + 1
  // On actualise le dataset.
  divBouteille.dataset.quantite = quantiteApresAjouter
  // Et on actualise aussi l'élément <p> qui affiche la quantité.
  let elemQuantite = divBouteille.getElementsByClassName('quantite')[0]
  elemQuantite.innerText = quantiteApresAjouter
}

export { reduitQuantBouteille, augmenteQuantBouteille }