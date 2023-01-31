/**
 * Fonctionnalité pour ouvrir la boite modale supprimer
 */
function ouvrirBoiteModaleSupprimer() {
    let popupForm = document.getElementById('popupForm');
    let btnSupprimerBouteille = document.querySelector('[name="btnSupprimer"]');
    let modalContainer = document.getElementById('modal-container');
    // console.log('btn supprimer',btnSupprimerBouteille);
    if (btnSupprimerBouteille) {
        btnSupprimerBouteille.addEventListener('click', function (evt) {
            popupForm.style.display = 'block'
            modalContainer.style.display = 'block'
        })
    }
}

/**
 * Fonctionnalité pour fermer la boite modale supprimer
 */
function fermerBoiteModaleSupprimer() {
    let modalContainer = document.getElementById('modal-container')
    let btnCloseModale = document.getElementById('closeForm')
    let btnCloseX = document.getElementById('closeFormX')
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

export { ouvrirBoiteModaleSupprimer, fermerBoiteModaleSupprimer }