window.addEventListener('load', function() {

    const nomPage = window.location.href.split('=')[1]

    /**
     * Affiche une fenetre de message pop-up de 1 seconde dans page cellier
     */
    if (nomPage == 'cellier') {
    const fenetreMessage = document.querySelector(
        '[data-js-fenetre-message]'
    )
        // console.log('estVisible', estVisible);
        if (estVisible == 1) {
            fenetreMessage.classList.add('show-window')
            setTimeout(() => {
            fenetreMessage.classList.remove('show-window')
            }, 2000)
        }
    }

})