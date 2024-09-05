// Infinite scroll
jQuery(document).ready(function($) {
    $('#photo-btn').on('click', function() {
        var button = $(this);
        var page = button.data('page'); // Récupérer le numéro de page actuel

        // Créer un tableau des IDs des images déjà affichées
        var loadedPhotos = [];
        $('.photo-item').each(function() {
            loadedPhotos.push($(this).data('id')); // Récupérer l'ID de chaque image affichée
        });

        // Faire une requête AJAX
        $.ajax({
            url: ajaxurl, // URL d'AJAX (automatiquement fourni par WordPress)
            type: 'POST',
            data: {
                action: 'load_more_photos', // Action définie dans functions-ajax.php
                page: page,
                loaded_photos: loadedPhotos // Envoyer les IDs des photos déjà chargées
            },
            beforeSend: function() {
                button.text('Chargement...'); // Afficher un message de chargement
            },
            success: function(response) {
                if (response) {
                    $('.photos-grid').append(response); // Ajouter les nouvelles photos
                    button.data('page', page + 1); // Incrémenter le numéro de page
                    button.text('Charger plus');
                } else {
                    button.text('Aucune autre photo à afficher').prop('disabled', true); // Désactiver le bouton s'il n'y a plus de photos
                }
            }
        });
    });
});
