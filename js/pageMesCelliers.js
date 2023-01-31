/**
   * Fonctionnalités Page Ajouter Cellier
   */

  /**
   * Ouvrir la boite modale ajouter cellier
   */
  function ouvrirBoiteModaleAjoutCelliers() {

    let btnAjoutCellier = document.querySelector('[name="btnAjoutCellier"]')
    let popupForm = document.getElementById('popupForm')
    let modalContainer = document.getElementById('modal-container')
    console.log(btnAjoutCellier)

    if (btnAjoutCellier) {
      btnAjoutCellier.addEventListener('click', function (evt) {
        popupForm.style.display = 'block'
        modalContainer.style.display = 'block'
      })
    }
  }
  

  /**
   * Fermer la boite modale ajouter cellier
   */

  function fermerBoiteModaleAjoutCelliers() {

    let modalContainer = document.getElementById('modal-container')
    let btnCloseModale = document.getElementById('closeForm')
    let btnCloseX = document.getElementById('closeFormX')
    let popupForm = document.getElementById('popupForm')

    if (btnCloseModale) {
        btnCloseModale.addEventListener('click', function (evt) {
        popupForm.style.display = 'none'
        modalContainer.style.display = 'none'
        })
    }
    if (btnCloseX) {
        btnCloseX.addEventListener('click', function (evt) {
        popupForm.style.display = 'none'
        modalContainer.style.display = 'none'
        })
    }
}

export { ouvrirBoiteModaleAjoutCelliers, fermerBoiteModaleAjoutCelliers }