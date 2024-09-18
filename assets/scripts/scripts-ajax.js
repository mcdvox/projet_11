// Script Bouton Charger Plus
jQuery(document).ready(function($) {

    // Gestion des changements dans les selects de filtre et de tri
    $('#photo-categorie-select, #photo-format-select, #filter-section_date-sort').on('change', function() {

        // Réinitialiser les résultats lors du filtrage
        loadPhotos(true); 
    });
    
    // Gestion du bouton "Charger plus"
    $('#photo-btn').on('click', function() {

        // Appeler la fonction de chargement
        loadMorePhotos();
    });
    
    // Script pour charger plus de photos (défilement infini)
    function loadMorePhotos() {
        var button = $('#photo-btn');
        // Numéro de la page à charger
        var page = button.data('page'); 

        // Récupérer les valeurs des filtres
        var category = $('#photo-categorie-select').val();
        var format = $('#photo-format-select').val();
        var order = $('#filter-section_date-sort').val();

        // Créer un tableau des IDs des images déjà affichées
        var loadedPhotos = [];
        $('.photo-item').each(function() {

            // Récupérer l'ID de chaque image affichée
            loadedPhotos.push($(this).data('id')); 
        });

        // Requête AJAX
        $.ajax({

            // Utilisation de ajax_params.ajaxurl
            url: ajax_params.ajaxurl, 
            type: 'POST',
            data: {

                // Action définie dans functions-ajax.php
                action: 'load_more_photos', 
                page: page,

                // Filtre catégorie
                category: category,

                // Filtre format
                format: format,

                // Tri par date  
                order: order,

                // Envoyer les IDs des photos déjà chargées
                loaded_photos: loadedPhotos
            },
            beforeSend: function() {

                // Afficher un message de chargement
                button.text('Chargement...'); 
            },
            success: function(response) {
                if (response) {

                    // Ajouter les nouvelles photos
                    $('.photos-grid').append(response);

                    // Initialiser les déclencheurs de la lightbox
                    initLightboxTriggers();

                    // Incrémenter le numéro de page
                    button.data('page', page + 1);
                    button.text('Charger plus');
                    
                    // Déclencher manuellement l'événement ajaxComplete
                    document.dispatchEvent(new Event('ajaxComplete'));
                } else {

                    // Désactiver le bouton s'il n'y a plus de photos
                    button.text('Aucune autre photo à afficher').prop('disabled', true);
                }
            }
        });
    }
    
    // Script pour réinitialiser et filtrer les photos
    function loadPhotos(reset = false) {
        var button = $('#photo-btn');

        // Réinitialiser si nécessaire
        var page = reset ? 1 : $('#photo-btn').data('page');
        
        // Récupérer les valeurs des filtres
        var category = $('#photo-categorie-select').val();
        var format = $('#photo-format-select').val();
        var order = $('#filter-section_date-sort').val();

        // Si on réinitialise les résultats, on efface le contenu actuel
        if (reset) {

            // Réinitialiser le compteur de page
            $('#photo-btn').data('page', 1);

            // Réinitialiser le contenu si on filtre
            $('.photos-grid').html('');
        }

        // Créer un tableau des IDs des images déjà affichées
        var loadedPhotos = [];
        $('.photo-item').each(function() {

            // Récupérer l'ID de chaque image affichée
            loadedPhotos.push($(this).data('id'));
        });

        // Requête AJAX pour appliquer le filtre et le tri
        $.ajax({

            // Utilisation de ajax_params.ajaxurl
            url: ajax_params.ajaxurl, 
            type: 'POST',
            data: {

                // Action définie dans functions-ajax.php
                action: 'load_more_photos',
                page: page,

                // Filtre catégorie
                category: category,

                // Filtre format
                format: format,

                // Tri par date
                order: order,

                // Envoyer les IDs des photos déjà chargées
                loaded_photos: loadedPhotos
            },
            beforeSend: function() {

                // Afficher un message de chargement
                $('#photo-btn').text('Chargement...');
            },
            success: function(response) {
                if (response) {

                    // Réinitialiser et afficher les photos filtrées
                    $('.photos-grid').html(response);
                
                    // Réinitialiser les déclencheurs de la lightbox après filtrage
                    initLightboxTriggers();

                    // Déclencher manuellement l'événement ajaxComplete pour réinitialiser les événements lightbox
                    document.dispatchEvent(new Event('ajaxComplete'));

                    // Réinitialiser la page après le filtrage
                    button.data('page', 1);
                    button.text('Charger plus');
                } else {
                    $('#photo-btn').text('Aucune autre photo à afficher').prop('disabled', true);
                }
            }
        });
    }
});
