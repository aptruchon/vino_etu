/**
 * Rend visible le mot de passe tapé au click de l'icone oeil
*/  
function oeilPassword(){

    const iconEyeOpen = document.getElementById('icon-eye-open');
    const iconEyeClose = document.getElementById('icon-eye-close');
    const inputPassword = document.getElementById("uti_mdp");

    /* addEventListener for the close eye */
    iconEyeOpen.addEventListener('click', function(e){
        e.preventDefault;
        inputPassword.type = inputPassword.type == 'text' ? 'password' : 'text';
        if(inputPassword.type == 'text'){
            /* add and remove hidden class */
            iconEyeClose.classList.remove('eye-hidden');
            iconEyeOpen.classList.add('hidden');
            /* addEventListener for the open eye */
            iconEyeClose.addEventListener('click', function(e){
                inputPassword.type = inputPassword.type == 'text' ? 'password' : 'text';
                /* add and remove hidden class */
                iconEyeClose.classList.add('eye-hidden');
                iconEyeOpen.classList.remove('hidden');
            })
        }
    })

}

/**
 * Envoie requete inscription d'un utilisateur
 */

//index.php?requete=inscrireUtilisateur

function envoiDonneesInscription() {
  
    const elSubmitButton = document.querySelector('button')
    const elInputPrenom = document.getElementById('uti_prenom');
    const elInputNom = document.getElementById('uti_nom')
    const elInputCourriel = document.getElementById('uti_courriel')
    const elInputMdp = document.getElementById('uti_mdp');

    let formInputs = [
      elInputPrenom,
      elInputNom,
      elInputCourriel,
      elInputMdp,
    ]

    elSubmitButton.addEventListener('click', (evt) => {
      evt.preventDefault()

      // Valide le contenu des inputs
      let isFormReady = true

      for (let i in formInputs) {
        if (formInputs[i].value == '') {
          isFormReady = false
          formInputs[i].classList.add('champ-requis-input')
          formInputs[i].nextElementSibling.innerHTML = 'Champs requis.'
          formInputs[i].nextElementSibling.classList.add('show-message-input-requis')
        }
        if (formInputs[i].id == 'uti_courriel') {
          if (!controleCourriel(formInputs[i].value)) {
            isFormReady = false
            formInputs[i].nextElementSibling.innerHTML = 'Veuillez entrer un courriel valide.'
            formInputs[i].nextElementSibling.classList.add(
              'show-message-input-requis'
            )
          }
        }
        if (formInputs[i].id == 'uti_mdp') {
          if (!controleMdp(formInputs[i].value)) {
            isFormReady = false
            formInputs[i].nextElementSibling.innerHTML =
              'Veuillez entrer un mot de passe valide.'
            formInputs[i].nextElementSibling.classList.add(
              'show-message-input-requis'
            )
          }
        }
      }

      // Envoie requete
      let param = {
        uti_prenom: elInputPrenom.value,
        uti_nom: elInputNom.value,
        uti_courriel: elInputCourriel.value,
        uti_mdp: elInputMdp.value,
      }
      const BaseURL = window.location.href.split('?')[0]
      if (isFormReady) {
        let requete = new Request(
          BaseURL +
            '?requete=inscrireUtilisateur',
          { method: 'POST', body: JSON.stringify(param) }
        )
        fetch(requete).then((response) => {
            console.log(response);
            if (response.status == 200) {
                console.log('yes');
                location.replace(
                  BaseURL + '?requete=accueil' + cellierId.id
                )

            } else if (response.status == 400) {
                console.log('no')

            } else {
              throw new Error('Erreur')
            }
        })
      }
    })

    

}

function controleCourriel(courriel) {
  let regle = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
  return regle.test(courriel)
}

function controleMdp(mdp) {
    let regle = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
    return regle.test(mdp)
}

function checkRequiredInputContentLogin() {
  const inputs = document.querySelectorAll('input')
  let inputsRequired = [...inputs];
  for (let i in inputsRequired) {
    inputsRequired[i].addEventListener('change', () => {
      if (inputsRequired[i].value == '') {
        inputsRequired[i].classList.add('champ-requis-input')
        inputsRequired[i].nextElementSibling.innerHTML = 'Champs requis'
        inputsRequired[i].nextElementSibling.classList.add(
          'show-message-input-requis'
        )
      } else {
        inputsRequired[i].classList.remove('champ-requis-input')
        inputsRequired[i].nextElementSibling.classList.remove(
          'show-message-input-requis'
        )
      }
    })
  }
}

export { oeilPassword, envoiDonneesInscription, checkRequiredInputContentLogin } 