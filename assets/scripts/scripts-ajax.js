jQuery(document).ready(function($) {
    // Gestion du bouton "Charger plus"
    $('#photo-btn').on('click', function() {
        loadMorePhotos(); // Appeler la fonction de chargement
    });

    // Gestion des changements dans les selects de filtre et de tri
    $('#photo-categorie-select, #photo-format-select, #filter-section_date-sort').on('change', function() {
        loadPhotos(true); // Réinitialiser les résultats lors du filtrage
    });

    /**
     * Fonction pour charger plus de photos (défilement infini)
     */
    function loadMorePhotos() {
        var button = $('#photo-btn');
        var page = button.data('page'); // Numéro de la page à charger

        // Récupérer les valeurs des filtres
        var category = $('#photo-categorie-select').val();
        var format = $('#photo-format-select').val();
        var order = $('#filter-section_date-sort').val();

        // Créer un tableau des IDs des images déjà affichées
        var loadedPhotos = [];
        $('.photo-item').each(function() {
            loadedPhotos.push($(this).data('id')); // Récupérer l'ID de chaque image affichée
        });

        // Faire une requête AJAX
        $.ajax({
            url: ajax_params.ajaxurl, // Utilisation de ajax_params.ajaxurl au lieu de ajaxurl
            type: 'POST',
            data: {
                action: 'load_more_photos', // Action définie dans functions-ajax.php
                page: page,
                category: category, // Filtre catégorie
                format: format,     // Filtre format
                order: order,       // Tri par date
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
    }

    /**
     * Fonction pour réinitialiser et filtrer les photos
     */
    function loadPhotos(reset = false) {
        var button = $('#photo-btn');
        var page = reset ? 1 : $('#photo-btn').data('page'); // Réinitialiser si nécessaire
        
        // Récupérer les valeurs des filtres
        var category = $('#photo-categorie-select').val();
        var format = $('#photo-format-select').val();
        var order = $('#filter-section_date-sort').val();

        // Si on réinitialise les résultats, on efface le contenu actuel
        if (reset) {
            $('.photos-grid').html(''); // Réinitialiser le contenu si on filtre
            $('#photo-btn').data('page', 1); // Réinitialiser le compteur de page
        }

        // Créer un tableau des IDs des images déjà affichées
        var loadedPhotos = [];
        $('.photo-item').each(function() {
            loadedPhotos.push($(this).data('id')); // Récupérer l'ID de chaque image affichée
        });

        // Faire une requête AJAX pour appliquer le filtre et le tri
        $.ajax({
            url: ajax_params.ajaxurl, // Utilisation correcte de ajax_params.ajaxurl
            type: 'POST',
            data: {
                action: 'load_more_photos', // Action définie dans functions-ajax.php
                page: page,
                category: category, // Filtre catégorie
                format: format,     // Filtre format
                order: order,       // Tri par date
                loaded_photos: loadedPhotos // Envoyer les IDs des photos déjà chargées
            },
            beforeSend: function() {
                $('#photo-btn').text('Chargement...'); // Afficher un message de chargement
            },
            success: function(response) {
                if (response) {
                    $('.photos-grid').append(response); // Ajouter les nouvelles photos
                    button.data('page', 1); // Incrémenter le numéro de page
                    button.text('Charger plus');
                } else {
                    $('#photo-btn').text('Aucune autre photo à afficher').prop('disabled', true);
                }
            }
        });
    }
});
