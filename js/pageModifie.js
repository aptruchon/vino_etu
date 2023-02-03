/**
 * Fonctionnalités page Modifie
 */

/**
 * Fait une requete à la DB pour modifier une bouteille au cellier de l'usager.
 */
function modifieVinCellier(bouteille, inputsRequired) {
  let btnModifier = document.querySelector("[name='modifierBouteilleCellier']")
  const BaseURL = window.location.href.split('?')[0]

  if (btnModifier) {
    btnModifier.addEventListener('click', function (evt) {
    evt.preventDefault()
    bouteille.type = bouteille.types.options.selectedIndex + 1;
    bouteille.id_bouteille_cellier = document.querySelector("[name='id_bouteille_cellier']");
    let cle_bouteille = document.querySelector("[name='id_cle']").value;
    
    var param = {
      id_bouteille: bouteille.id_bouteille_cellier.value,
      id_type: bouteille.type.toString(),
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

    // Assure que les messages d'erreur sont absents

    for (let i in inputsRequired) {
      if (inputsRequired[i].value == '') {
          inputsRequired[i].classList.remove('champ-obligatoire-input')
          inputsRequired[i].nextElementSibling.innerHTML = ''
      }
    }

    // Si champs requis complétés, fait la requete POST
    if (
    !(
        param.id_type == '' ||
        param.nom == '' ||
        param.pays == '' ||
        param.quantite == ''
    )
    ) {
    let requete = new Request(
      BaseURL + '?requete=modifierBouteilleCellier&bte=' + param.id_bouteille,
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
        // console.log(response)
        location.replace(
          BaseURL +
            '?requete=ficheDetailsBouteille&bte=' +
            cle_bouteille
        )
      })
        .catch((error) => {
        console.error(error)

        // Temporaire
        location.replace(
          BaseURL +
            '?requete=ficheDetailsBouteille&bte=' +
            cle_bouteille
        )
        })
    } else {
    // Si un champs requis est vide, injection des messages d'erreurs
        for (let i in inputsRequired) {
            if (inputsRequired[i].value == '') {
            inputsRequired[i].classList.add('champ-obligatoire-input');
            inputsRequired[i].nextElementSibling.innerHTML = 'Champs obligatoire';
            }
        }
    }
})
  }
}

function checkRequiredInputContent(inputsRequired) {
   for (let i in inputsRequired) {
    inputsRequired[i].addEventListener('change', () => {
      if (inputsRequired[i].value == '') {
        inputsRequired[i].classList.add('champ-obligatoire-input')
        inputsRequired[i].nextElementSibling.innerHTML = 'Champs obligatoire'
      } else {
        inputsRequired[i].classList.remove('champ-obligatoire-input')
        inputsRequired[i].nextElementSibling.innerHTML = ''
      }
    })
  }
}

export { modifieVinCellier, checkRequiredInputContent }