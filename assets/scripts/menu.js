// Script Menu Burger
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
            // Afficher le menu burger
            menuNav.style.display = 'block';
            // Ajouter la classe open au bouton burger
            button.classList.add('open');
            // Désactiver le scroll en ajoutant la classe 'no-scroll' au body
            document.body.classList.add('no-scroll');
        } else {
            // Masquer le menu burger
            menuNav.style.display = 'none';
            // Supprimer la classe open du bouton burger
            button.classList.remove('open');
            // Réactiver le scroll en supprimant la classe 'no-scroll' du body
            document.body.classList.remove('no-scroll');
        }
    });
});
