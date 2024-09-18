// Fonction pour initialiser les événements sur les déclencheurs de la lightbox
function initLightboxTriggers() {
    console.log('Initialisation des événements sur les déclencheurs de la lightbox');

    // Sélectionne les éléments de la lightbox et de son conteneur
    const lightbox = document.querySelector('.lightbox');
    
    // Variable pour suivre l'image actuellement affichée
    let currentImage = null;

    // Liste des éléments déclencheurs
    let images = Array.from(document.querySelectorAll('.lightbox-trigger')); 

    // Attache un événement de clic sur chaque déclencheur
    images.forEach(trigger => {
        trigger.addEventListener('click', function (e) {

            // Empêche le comportement par défaut du lien
            e.preventDefault();

            // Définit l'image actuelle
            currentImage = trigger;

            // Affiche l'image, la référence et la catégorie correspondantes
            displayImage(trigger.dataset.image, trigger.dataset.ref, trigger.dataset.category);

            // Ouvre la lightbox
            openLightbox(); 
        });
    });

    // Fonction pour afficher l'image, la référence et la catégorie dans la lightbox
    function displayImage(url, reference, category) {

        // Injecte l'image dans le conteneur dédié
        document.querySelector('.lightbox__image-wrapper').innerHTML = `
            <img src="${url}" alt="Photo" class="lightbox__image" />
        `;

        // Injecte les informations de référence et catégorie dans le conteneur dédié
        let ref_element = document.createElement('div');
        ref_element.classList.add('lightbox__ref');
        ref_element.innerHTML = reference;

        let cat_element = document.createElement('div');
        cat_element.classList.add('lightbox__category');
        cat_element.innerHTML = category;

        let wrapper = document.querySelector('.lightbox__image-wrapper');
        wrapper.appendChild(ref_element);
        wrapper.appendChild(cat_element);
    }

    // Ouvre la lightbox en modifiant le style d'affichage
    function openLightbox() {
        lightbox.style.display = 'flex';
    }

    // Ferme la lightbox en modifiant le style d'affichage
    function closeLightbox() {
        lightbox.style.display = 'none';
    }

    // Attache un événement de clic au bouton de fermeture de la lightbox
    document.querySelector('.lightbox__close').addEventListener('click', closeLightbox);

    // Ferme la lightbox si on clique en dehors de l'image
    lightbox.addEventListener('click', function (e) {
        if (e.target === lightbox) {
            closeLightbox();
        }
    });

    // Ferme la lightbox en appuyant sur la touche "Échap"
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeLightbox();
    });

    // Navigation vers l'image suivante en cliquant sur "Suivant"
    document.querySelector('.lightbox__next').addEventListener('click', () => navigateLightbox('next'));

    // Navigation vers l'image précédente en cliquant sur "Précédent"
    document.querySelector('.lightbox__prev').addEventListener('click', () => navigateLightbox('prev'));

    // Fonction pour naviguer vers l'image suivante ou précédente
    function navigateLightbox(direction) {
        
        // Trouve l'index actuel de l'image affichée
        const currentIndex = images.indexOf(currentImage);

        // Calcule l'index de la nouvelle image à afficher selon la direction (next/prev)
        const newIndex = direction === 'next'
            ? (currentIndex + 1) % images.length
            : (currentIndex - 1 + images.length) % images.length;

        // Met à jour l'image actuelle
        currentImage = images[newIndex]; 

        // Affiche la nouvelle image avec ses informations
        displayImage(currentImage.dataset.image, currentImage.dataset.ref, currentImage.dataset.category);
    }
}

// Exécute le script une fois que le DOM est complètement chargé
document.addEventListener('DOMContentLoaded', function () {
    
    // Initialiser les déclencheurs de la lightbox
    initLightboxTriggers();
});
