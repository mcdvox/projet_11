// Script Select2
jQuery(document).ready(function($) {
    // Initialisation de Select2 pour les catégories, formats et tri
    $('#photo-categorie-select, #photo-format-select, #filter-section_date-sort').select2({
        placeholder: function() {
            return $(this).data('placeholder');
        },
        // Permet de rendre les placeholders réinitialisables
        allowClear: true,
        width: '100%'
    });

    // Gérer les changements des filtres
    $('#photo-categorie-select, #photo-format-select, #filter-section_date-sort').on('change', function() {
        updatePhotos();
    });

    // Gérer les clics sur le placeholder pour réinitialiser le filtre
    $('.select2-selection__placeholder').on('click', function() {
        var selectId = $(this).closest('.select2-container').prev('select').attr('id');
        // Réinitialiser le filtre
        $('#' + selectId).val(null).trigger('change');
    });

    // Fonction pour actualiser les photos via AJAX
    function updatePhotos() {
        var category = $('#photo-categorie-select').val();
        var format = $('#photo-format-select').val();
        var order = $('#filter-section_date-sort').val();

        // Requête AJAX pour actualiser les photos
        $.ajax({
            url: ajax_params.ajaxurl,
            type: 'POST',
            data: {
                action: 'load_more_photos',
                category: category,
                format: format,
                order: order,
                page: 1
            },
            beforeSend: function() {
                $('.photos-grid').html('<p>Chargement des photos...</p>');
            },
            success: function(response) {
                $('.photos-grid').html(response);
                
                    // Initialiser les déclencheurs de la lightbox
                    console.log('test')
                    initLightboxTriggers();
            },
            error: function() {
                $('.photos-grid').html('<p>Erreur lors du chargement des photos.</p>');
            }
        });
    }
});
