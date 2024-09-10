document.addEventListener('DOMContentLoaded', function () {
    const lightbox = document.querySelector('.lightbox');
    const lightboxContainer = document.querySelector('.lightbox__container');
    const lightboxClose = document.querySelector('.lightbox__close');
    const lightboxNext = document.querySelector('.lightbox__next');
    const lightboxPrev = document.querySelector('.lightbox__prev');
    let currentImage = null;
    let images = [];

    // Créer un élément pour afficher le titre
    const lightboxTitle = document.createElement('div');
    lightboxTitle.classList.add('lightbox__title');
    lightboxContainer.appendChild(lightboxTitle);

    // Lorsque l'on clique sur une miniature
    document.querySelectorAll('.lightbox-trigger').forEach(trigger => {
        trigger.addEventListener('click', function (e) {
            e.preventDefault();
            currentImage = this;
            images = Array.from(document.querySelectorAll('.lightbox-trigger'));
            displayImage(currentImage.getAttribute('data-image'), currentImage.getAttribute('data-title'));
            openLightbox();
        });
    });

    // Afficher l'image et son titre dans la lightbox
    function displayImage(url, title) {
        lightboxContainer.innerHTML = '<img src="' + url + '" alt="Photo en grand format">';
        lightboxContainer.appendChild(lightboxTitle); // Réajouter le titre dans le container
        lightboxTitle.textContent = title; // Mettre à jour le titre
    }

    // Ouvrir la lightbox
    function openLightbox() {
        lightbox.style.display = 'block';
    }

    // Fermer la lightbox
    lightboxClose.addEventListener('click', function () {
        lightbox.style.display = 'none';
    });

    // Naviguer à l'image suivante
    lightboxNext.addEventListener('click', function () {
        const currentIndex = images.indexOf(currentImage);
        const nextIndex = (currentIndex + 1) % images.length;
        currentImage = images[nextIndex];
        displayImage(currentImage.getAttribute('data-image'), currentImage.getAttribute('data-title'));
    });

    // Naviguer à l'image précédente
    lightboxPrev.addEventListener('click', function () {
        const currentIndex = images.indexOf(currentImage);
        const prevIndex = (currentIndex - 1 + images.length) % images.length;
        currentImage = images[prevIndex];
        displayImage(currentImage.getAttribute('data-image'), currentImage.getAttribute('data-title'));
    });
});
