<?php
// Action pour les utilisateurs connectés
add_action('wp_ajax_load_more_photos', 'load_more_photos');
// Action pour les utilisateurs non connectés
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');

function load_more_photos() {
    // Vérifie si le numéro de page est défini
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    
    // Récupérer les IDs des photos déjà chargées
    $loaded_photos = isset($_POST['loaded_photos']) ? array_map('intval', $_POST['loaded_photos']) : array();

    // Inclure l'ID de la bannière dans l'exclusion (si défini dans la session)
    if (isset($_SESSION['banner_post_id'])) {
        $loaded_photos[] = $_SESSION['banner_post_id'];
    }

    // Filtrer par catégorie et format (le cas échéant)
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';
    $format = isset($_POST['format']) ? sanitize_text_field($_POST['format']) : '';

    // Trier par date (ASC ou DESC)
    $order = isset($_POST['order']) ? sanitize_text_field($_POST['order']) : 'DESC';

    // Construire la requête taxonomique pour les filtres
    $tax_query = array('relation' => 'AND');

    if (!empty($category)) {
        $tax_query[] = array(
            'taxonomy' => 'categorie',
            'field'    => 'slug',
            'terms'    => $category,
        );
    }

    if (!empty($format)) {
        $tax_query[] = array(
            'taxonomy' => 'format',
            'field'    => 'slug',
            'terms'    => $format,
        );
    }

    // Arguments pour récupérer les photos
    $args = array(
        'post_type'      => 'photo',
        'posts_per_page' => 8,
        'paged'          => $paged,
        'post__not_in'   => $loaded_photos, // Exclure les photos déjà chargées
        'orderby'        => 'date', // Trier par date
        'order'          => $order, // Sens du tri (ASC ou DESC)
    );

    // Ajouter les filtres de taxonomie si des filtres sont appliqués
    if (count($tax_query) > 1) {
        $args['tax_query'] = $tax_query;
    }

    $photo_query = new WP_Query($args);

    if ($photo_query->have_posts()) {
        while ($photo_query->have_posts()) {
            $photo_query->the_post();

            if (has_post_thumbnail()) {
                // Inclure l'ID de chaque photo nouvellement chargée pour les exclusions futures
                echo '<div class="photo-item" data-id="' . get_the_ID() . '">';
                echo '<a href="' . esc_url(get_permalink()) . '">';
                the_post_thumbnail('medium_large', ['class' => 'random-photo']);
                echo '</a></div>';
            }
        }
    } else {
        echo '<p>Aucune photo supplémentaire à afficher.</p>';
    }

    wp_reset_postdata();
    wp_die(); // Fin de la requête AJAX
}
