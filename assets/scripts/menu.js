// MENU BURGER
document.addEventListener('DOMContentLoaded', function() {
    const button = document.querySelector('.menu_burger');
    const menuNav = document.querySelector('#nav-burger');

    // Vérifier si les éléments existent
    if (!button || !menuNav) {
        console.error('Les éléments button ou menuNav sont introuvables dans le DOM.');
        return;
    }

    button.addEventListener('click', function() {
        menuNav.classList.toggle('show-nav');

        // Ajouter une condition pour changer la propriété display de menuNav
        if (menuNav.classList.contains('show-nav')) {
            menuNav.style.display = 'block'; // Afficher le menu burger
            button.classList.add('open'); // Ajouter la classe open au bouton burger
        } else {
            menuNav.style.display = 'none'; // Masquer le menu burger
            button.classList.remove('open'); // Supprimer la classe open du bouton burger
        }
    });
});
