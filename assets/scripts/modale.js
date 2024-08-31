document.addEventListener('DOMContentLoaded', function() {

    // Sélection de la modale
    const modal = document.getElementById("contact-modal");
    const menuItem = document.getElementById("menu-item-48");
    console.log(menuItem);
    const menuItem2 = document.getElementById("menu-item-185");

    // Sélection des éléments qui déclenchent l'ouverture de la modale
    var btns = document.querySelectorAll(".btn-contact");

    // Sélection de l'élément de fermeture (le 'X') de la modale
    var span = document.querySelector(".close");

    // Ajout d'un événement de clic pour l'ouverture de la modale
    menuItem.addEventListener("click", openModal);
    menuItem2.addEventListener("click", openModal);

    // Fonction d'ouverture de la modale avec pré-remplissage de la référence
    function openModal(event) {
        console.log("click");
        modal.style.display = "block";

        // Récupère la référence à partir du bouton cliqué
        var referenceValue = event.currentTarget.getAttribute("data-reference");

        // Remplit le champ ref-photo du formulaire CF7 avec la référence
        var refPhotoField = document.querySelector('input[name="ref-photo"]');
        // Vérifie si le champ est trouvé
        console.log(refPhotoField);
        if (refPhotoField) {
            refPhotoField.value = referenceValue;
            console.log("Reference photo: " + referenceValue); // Confirme que la valeur est bien définie
        } else {
            console.log("ref-photo non trouvée");
        }
    }

    // Fonction de fermeture de la modale lors d'un clic externe
    function closeModal(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Ajout des événements de clic pour l'ouverture de la modale
    btns.forEach(function(btn) {
        btn.addEventListener("click", openModal);
    });

    // Ajout d'un événement de clic à la fenêtre pour la fermeture de la modale
    window.addEventListener("click", closeModal);

    // Ajout de l'événement de clic pour fermer la modale via l'élément 'X'
    if (span) {
        span.addEventListener("click", function() {
            modal.style.display = "none";
        });
    }
});