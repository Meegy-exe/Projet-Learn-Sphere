// MENU BURGER
// réadapté par rapport à celui du thème parent
// attend que la page charge
document.addEventListener('DOMContentLoaded', function () {

    // récupère btn & liens du menu
    let bouton = document.querySelector('.navbar-control-trigger');
    let menu = document.querySelector('.primary-menu');

    // crée une nouvelle div menu burger
    let customMenu = document.createElement('div');
    customMenu.id = 'ns-mobile-menu';

    // clone les liens dans la div
    customMenu.appendChild(menu.cloneNode(true));

    // insère menu dans la nav
    let headerContainer = document.querySelector('.theme-header-areas');
    headerContainer.appendChild(customMenu);

    // lors du clic souris passe la classe en active
    bouton.addEventListener('click', function () {
        customMenu.classList.toggle('active');
    });
});