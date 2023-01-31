/**
 * Ouvre la navigation
 * @param {string} elMobileNav 
 */
function openNav(elMobileNav) {
    const elMenuBtn = document.querySelector('[data-js-menu-btn]');
    elMenuBtn.addEventListener('click', () => {
        elMobileNav.classList.add('showMobileNav');
    })
}

/**
 * Ferme la navigation
 * @param {string} elMobileNav 
 */
function closeNav(elMobileNav) {
  const elMenuBtnClose = document.querySelector('[data-js-menu-btn-close]')
  elMenuBtnClose.addEventListener('click', () => {
    elMobileNav.classList.remove('showMobileNav')
  })
}

export { openNav, closeNav }