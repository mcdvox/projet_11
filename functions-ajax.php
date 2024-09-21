<?php

// Action pour les utilisateurs connectés
add_action('wp_ajax_load_more_photos', 'load_more_photos');

// Action pour les utilisateurs non connectés
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');

function load_more_photos() {
    
    // Vérifie si le numéro de page est défini dans la requête AJAX
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    
    // Récupérer les IDs des photos déjà chargées pour éviter de les afficher à nouveau
    $loaded_photos = isset($_POST['loaded_photos']) ? array_map('intval', $_POST['loaded_photos']) : array();

    // Filtrer par catégorie et format (si ces filtres sont envoyés via AJAX)
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';
    $format = isset($_POST['format']) ? sanitize_text_field($_POST['format']) : '';

    // Trier par date (soit ascendant ou descendant)
    $order = isset($_POST['order']) ? sanitize_text_field($_POST['order']) : 'DESC';

    // Construire la requête taxonomique pour les filtres de catégorie et de format
    $tax_query = array('relation' => 'AND');

    if (!empty($category)) {

        // Si une catégorie est sélectionnée, elle est ajoutée au tableau de la requête taxonomique
        $tax_query[] = array(
            'taxonomy' => 'categorie',
            'field'    => 'slug',
            'terms'    => $category,
        );
    }

    if (!empty($format)) {

    // Si un format est sélectionné, il est ajouté au tableau de la requête taxonomique
        $tax_query[] = array(
            'taxonomy' => 'format',
            'field'    => 'slug',
            'terms'    => $format,
        );
    }

    // Arguments pour la requête WordPress pour récupérer les photos
    $args = array(
        'post_type'      => 'photo',
        'posts_per_page' => 8,
        'paged'          => $paged,
        'post__not_in'   => $loaded_photos,
        'orderby'        => 'date',
        'order'          => $order,
    );

    // Ajouter la requête taxonomique aux arguments si des filtres sont sélectionnés
    if (count($tax_query) > 1) {
        $args['tax_query'] = $tax_query;
    }
    
    // Exécuter la requête WP_Query avec les arguments spécifiés
    $photo_query = new WP_Query($args);
    
    // Vérifier s'il y a des photos à afficher
    if ($photo_query->have_posts()) {

        // Boucle sur les résultats de la requête
        while ($photo_query->have_posts()) {
            $photo_query->the_post();

            if (has_post_thumbnail()) {

                // Récupérer les métadonnées de la photo
                $photo_ref = get_post_meta(get_the_ID(), 'reference', true);
                $photo_category = wp_get_post_terms(get_the_ID(), 'categorie', array('fields' => 'names'));
                
                // Utiliser le premier terme si la photo a plusieurs catégories
                $category_name = !empty($photo_category) ? $photo_category[0] : 'Non catégorisé';

                // Afficher chaque photo chargée avec ses métadonnées dans une div
                echo '<div class="photo-item" data-id="' . get_the_ID() . '">';
                
                // Afficher la miniature de la photo
                the_post_thumbnail('medium_large', ['class' => 'random-photo']);
                echo '<div class="overlay">';
                echo '<a href="' . get_permalink() . '" class="article-link"
                    data-image="' . get_the_post_thumbnail_url(get_the_ID(), 'full') . '"
                    data-ref="' . esc_attr($photo_ref) . '"
                    data-category="' . esc_attr($category_name) . '">';
                echo '<img src="' . get_template_directory_uri() . '/assets/images/eye_informations.png" class="eye-icon" alt="Informations">';
<<<<<<< HEAD
                echo '</a>';
=======
                echo '</a>';                
>>>>>>> b749615480c3a527804858d6037399200c7437b4

                // Ajouter le titre de la photo (en bas à gauche)
                echo '<div class="photo-title">' . get_the_title() . '</div>';

                // Ajouter la catégorie de la photo (en bas à droite)
                echo '<div class="photo-category">' . esc_attr($category_name) . '</div>';
<<<<<<< HEAD
                
=======

>>>>>>> b749615480c3a527804858d6037399200c7437b4
                echo '<img src="' . get_template_directory_uri() . '/assets/images/full_screen.png" class="fullscreen-icon lightbox-trigger" alt="Plein écran" data-image="' . get_the_post_thumbnail_url(get_the_ID(), 'full') . '" data-ref="' . esc_attr($photo_ref) . '" data-category="' . esc_attr($category_name) . '">';
                echo '</div>';
                echo '</div>';
            }
        }
    } else {

        // Si aucune photo supplémentaire n'est trouvée, afficher un message d'information
        echo '<p>Aucune photo supplémentaire à afficher.</p>';
    }
    
    // Réinitialiser les données de la requête globale WordPress pour éviter les conflits
    wp_reset_postdata();

    // Terminer la requête AJAX proprement
    wp_die();
}
?>
