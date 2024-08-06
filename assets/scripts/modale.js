// Sélectionner la modale et le bouton de menu
var modal = document.getElementById("contact-modal");
var menuItem = document.getElementById("menu-item-48");

// Fonction pour ouvrir la modale
function openModal() {
    modal.style.display = "block";
}

// Fonction pour fermer la modale si le clic est en dehors de celle-ci
function closeModal(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Ajouter un événement de clic pour ouvrir la modale
menuItem.addEventListener("click", openModal);

// Ajouter un événement de clic à la fenêtre pour fermer la modale
window.addEventListener("click", closeModal);