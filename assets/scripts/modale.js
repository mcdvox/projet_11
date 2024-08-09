// Sélection de la modale sur le lien contact 
var modal = document.getElementById("contact-modal");
var menuItem = document.getElementById("menu-item-48");

// Fonction d'ouverture la modale
function openModal() {
    modal.style.display = "block";
}

// Fonction de fermeture de la modale lors d'un clic externe
function closeModal(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Ajout d'un événement de clic pour l'ouverture de la modale
menuItem.addEventListener("click", openModal);

// Ajout d'un événement de clic à la fenêtre pour la fermeture de la modale
window.addEventListener("click", closeModal);