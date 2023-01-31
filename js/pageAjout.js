/**
 * Fonctionnalités page Ajout
 */

/**
 * Affichage de résultats d'une recherche d'un nom de bouteille.
 */

function afficheResulatRechVin() {
    let inputNomBouteille = document.querySelector("[name='nom_bouteille']")
    let liste = document.querySelector('.listeAutoComplete')
    const BaseURL = window.location.href.split('?')[0]

    if (inputNomBouteille) {
        inputNomBouteille.addEventListener('keyup', function (evt) {
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
    }
}
  

  /**
   * Preremplit le formulaire Ajout 
   */
  // Si élément de liste dans les résultats de recherche cliqué, complète le nom de la bouteille dans l'input du form.

  function preremplitFormAjout(bouteille) {
    const BaseURL = window.location.href.split('?')[0]
    let liste = document.querySelector('.listeAutoComplete')
    let inputNomBouteille = document.querySelector("[name='nom_bouteille']")

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
            // console.log(response)
            let bouteilleChoisi = response

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

            bouteille.types.classList.add('noEvent')

            for (let i = 0, l = bouteille.types.options.length; i < l; i++) {
              if (
                bouteille.types.options[i].id == bouteilleChoisi.vino__type_id
              ) {
                bouteille.types.options[i].removeAttribute('disabled')
                bouteille.types.options[i].setAttribute('selected', '')
                bouteille.type = bouteille.types.options[i]
              } else {
                bouteille.types.options[i].removeAttribute('selected')
                bouteille.types.options[i].setAttribute('disabled', true)
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
  }

  
  /**
   * Fait une requete à la DB pour ajouter une bouteille au cellier de l'usager.
   */
  function ajoutVinCellier(bouteille) {
    let btnAjouter = document.querySelector("[name='ajouterBouteilleCellier']");
    const BaseURL = window.location.href.split('?')[0];
    if (btnAjouter) {
      btnAjouter.addEventListener('click', function (evt) {

        for (let i = 0, l = bouteille.types.options.length; i < l; i++) {
          if (bouteille.types.options[i].id == bouteille.types.selectedIndex) {
            bouteille.type = bouteille.types.options[i]
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
        console.log(param)

        bouteille.nom.classList.remove('champ-obligatoire-input')
        bouteille.nom.nextElementSibling.innerHTML = ''

        bouteille.pays.classList.remove('champ-obligatoire-input')
        bouteille.pays.nextElementSibling.innerHTML = ''

        bouteille.quantite.classList.remove('champ-obligatoire-input')
        bouteille.quantite.nextElementSibling.innerHTML = ''

        bouteille.types.classList.remove('champ-obligatoire-input')
        bouteille.types.nextElementSibling.innerHTML = ''

        if (
          !(
            param.id_type == '' ||
            param.nom == '' ||
            param.pays == '' ||
            param.quantite == ''
          )
        ) {
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
        } else {
          // Injection des messages d'erreurs
          console.log('bon chemin')

          if (param.nom === '') {
            bouteille.nom.classList.add('champ-obligatoire-input')
            bouteille.nom.nextElementSibling.innerHTML = 'Champs obligatoire'
          }
          if (param.pays === '') {
            bouteille.pays.classList.add('champ-obligatoire-input')
            bouteille.pays.nextElementSibling.innerHTML = 'Champs obligatoire'
          }
          if (param.quantite === '') {
            bouteille.quantite.classList.add('champ-obligatoire-input')
            bouteille.quantite.nextElementSibling.innerHTML =
              'Champs obligatoire'
          }
          if (param.id_type === '') {
            bouteille.types.classList.add('champ-obligatoire-input')
            bouteille.types.nextElementSibling.innerHTML = 'Champs obligatoire'
          }
        }
      })
    }
  }
  
  /**
   *  Efface les inputs et le style 'read only' du form ajout au click du bouton efface
   * @param Object formInputs - les inputs du form
   * */  
  function effaceInputsForm(formInputs) {
    const elBtnRefresh = document.querySelector('[data-js-efface]');
    elBtnRefresh.addEventListener('click', () => {
      for (let i in formInputs) {
        formInputs[i].value = '';
        formInputs[i].setAttribute('readonly', false);
        formInputs[i].classList.remove('readOnly');
        if (formInputs[i].name == 'types') formInputs[i].classList.remove('noEvent')
      }
    })
  }

export {
  afficheResulatRechVin,
  preremplitFormAjout,
  ajoutVinCellier,
  effaceInputsForm,
}