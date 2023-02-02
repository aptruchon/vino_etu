/**
   * Fonctionnalités Page Ajouter Cellier
   */

  /**
   * Ouvrir la boite modale ajouter cellier
   */
  function ouvrirBoiteModaleAjoutCelliers() {

    let btnAjoutCellier = document.querySelector('[name="btnAjoutCellier"]')
    let btnModifierCellier = document.getElementById('btnModifierCellier')
    let btnSupprimerCellier = document.getElementById('btnSupprimerCellier')
    let popupFormAjouter = document.getElementById('popupFormAjouter')
    let popupFormModifier = document.getElementById('popupFormModifier')
    let modalContainer = document.getElementById('modal-container')
    let modalContainerModifier = document.getElementById('modal-container-modifier')
    let modalContainerSupprimer = document.getElementById('modal-container-supprimer')


    if (btnAjoutCellier) {
      btnAjoutCellier.addEventListener('click', function (evt) {
        evt.preventDefault();
        popupFormAjouter.style.display = 'block'
        modalContainer.style.display = 'block'
      })
    }

    if (btnModifierCellier) {
      btnModifierCellier.addEventListener('click', function (evt) {
        evt.preventDefault();
        popupFormModifier.style.display = 'block'
        modalContainerModifier.style.display = 'block'
      })
    }

    if (btnSupprimerCellier) {
      btnSupprimerCellier.addEventListener('click', function (evt) {
        evt.preventDefault();
        popupFormSupprimer.style.display = 'block'
        modalContainerSupprimer.style.display = 'block'
      })
    }

  }
  

  /**
   * Fermer la boite modale ajouter cellier
   */

  function fermerBoiteModaleAjoutCelliers() {

    let modalContainer = document.getElementById('modal-container')
    let modalContainerModifier = document.getElementById('modal-container-modifier')
    let modalContainerSupprimer = document.getElementById('modal-container-supprimer')
    let btnCloseModale = document.getElementById('closeForm')
    let btnCloseX = document.getElementById('closeFormX')
    let popupFormAjouter = document.getElementById('popupFormAjouter')
    let popupFormModifier = document.getElementById('popupFormModifier')


    if (btnCloseModale) {
        btnCloseModale.addEventListener('click', function (evt) {
          popupFormAjouter.style.display = 'none'
          modalContainer.style.display = 'none'
        })
    }
    if (btnCloseX) {
        btnCloseX.addEventListener('click', function (evt) {
          evt.preventDefault();
          popupFormAjouter.style.display = 'none'
          modalContainer.style.display = 'none'
          popupFormSupprimer.style.display = 'none'
          modalContainerSupprimer.style.display = 'none'
          popupFormModifier.style.display = 'none'
          modalContainerModifier.style.display = 'none'
        })
    }

  }

export { ouvrirBoiteModaleAjoutCelliers, fermerBoiteModaleAjoutCelliers }