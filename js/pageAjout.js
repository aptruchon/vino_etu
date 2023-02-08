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
            let bouteilleChoisi = response
            let inputsARemplir = [
              bouteille.nom,
              bouteille.pays,
              bouteille.format,
              bouteille.description,
              bouteille.prix,
            ]

            // Remplit les valeurs des inputs
            bouteille.nom.value = bouteilleChoisi.nom
            bouteille.pays.value = bouteilleChoisi.pays
            bouteille.format.value = bouteilleChoisi.format
            bouteille.description.value = bouteilleChoisi.description
            bouteille.prix.value = bouteilleChoisi.prix_saq

            // Selectionne l'option du select type de vin
            for (let i = 0, l = bouteille.types.options.length; i < l; i++) {
              if (
                bouteille.types.options[i].id == bouteilleChoisi.vino__type_id
              ) {
                console.log(bouteille.types.options[i])
                bouteille.types.options[i].disabled = false;
                bouteille.types.options[i].selected = true;
                bouteille.type = bouteille.types.options[i]
              } else {
                bouteille.types.options[i].selected = false;
                bouteille.types.options[i].disabled = true;
              }
            }
            
            // Empeche la modification des inputs et nettoie d'eventuelles classe de message d'erreur
            for (let i in inputsARemplir) {
              inputsARemplir[i].setAttribute('readonly', true)
              inputsARemplir[i].classList.add('readOnly')
              inputsARemplir[i].classList.remove('champ-obligatoire-input')
              inputsARemplir[i].nextElementSibling.innerHTML = ''
            }
            // Empeche la modification du select et nettoie d'eventuelles classe de message d'erreur
            bouteille.types.classList.remove('champ-obligatoire-input')
            bouteille.types.nextElementSibling.innerHTML = ''
            bouteille.types.classList.add('noEvent') 
          })
          .catch((error) => {
            console.error(error)
          })

          // Nettoie le champs de recherche
          liste.innerHTML = ''
          inputNomBouteille.value = ''
      }
    })
  }

  
  /**
   * Fait une requete à la DB pour ajouter une bouteille au cellier de l'usager.
   */
  function ajoutVinCellier(bouteille, inputsRequired) {
    let cellierId = document.querySelector("[name='cellierId']")
    let btnAjouter = document.querySelector("[name='ajouterBouteilleCellier']")
    const BaseURL = window.location.href.split('?')[0]
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

        // Assure que les messages d'erreur sont absents

        for (let i in inputsRequired) {
          if (inputsRequired[i].value == '') {
            inputsRequired[i].classList.remove('champ-obligatoire-input')
            inputsRequired[i].nextElementSibling.innerHTML = ''
          }
        }

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
              location.replace(
                BaseURL + '?requete=cellier&cellierId=' + cellierId.id
              )
            })
            .catch((error) => {
              console.error(error)

              // Temporaire
              location.replace(
                BaseURL + '?requete=cellier&cellierId=' + cellierId.id
              )
            })
        } else {
          // Injection des messages d'erreurs
          // Si un champs requis est vide, injection des messages d'erreurs
          for (let i in inputsRequired) {
            if (inputsRequired[i].value == '') {
              inputsRequired[i].classList.add('champ-obligatoire-input')
              inputsRequired[i].nextElementSibling.innerHTML =
                'Champs obligatoire'
            }
          }
        }
      })
    }
  }
  
  /**
   *  Efface les inputs, le style 'read only' et les messages d'erreur du form ajout au click du bouton efface
   * @param Object formInputs - les inputs du form
   * */  
  function effaceInputsForm(formInputs) {
    
    const elBtnRefresh = document.querySelector('[data-js-efface]');
    const elOptions = document.querySelectorAll('option')

    elBtnRefresh.addEventListener('click', () => {
      // Supprime evenutel id de bouteille creer avec la rechecher de la SAQ
      delete document.querySelector("[name='nom']").dataset.id

      for (let i in formInputs) {
        formInputs[i].value = '';
        formInputs[i].removeAttribute('readOnly');
        formInputs[i].classList.remove('readOnly');
        if (formInputs[i].classList.contains('champ-obligatoire-input')) {
          formInputs[i].classList.remove('champ-obligatoire-input')
          formInputs[i].nextElementSibling.innerHTML = ''
        }
          
        if (formInputs[i].name == 'types') {
          formInputs[i].classList.remove('noEvent');

          for (let i = 0; i < elOptions.length; i++) {
            elOptions[i].selected = false;
            elOptions[i].disabled = false;
          }
        }
      }
    })
  }

export {
  afficheResulatRechVin,
  preremplitFormAjout,
  ajoutVinCellier,
  effaceInputsForm,
}