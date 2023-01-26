window.addEventListener('load', function() {

    const nomPage = window.location.href.split('=')[1]

    /**
     * Affiche une fenetre de confirmation pop-up de 1 seconde dans page cellier
     */
    if (nomPage == 'cellier') {
    const fenetreConfirmation = document.querySelector(
        '[data-js-fenetre-confirmation]'
    )
        // console.log('estConfirme', estConfirme);
        if (estConfirme == 1) {
            fenetreConfirmation.classList.add('show-window')
            setTimeout(() => {
            fenetreConfirmation.classList.remove('show-window')
            }, 1200)
        }
    }

})