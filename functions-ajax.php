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

    // Requête pour récupérer 8 autres articles de type 'photo' en excluant ceux déjà affichés
    $args = array(
        'post_type'      => 'photo',
        'posts_per_page' => 8,
        'paged'          => $paged,
        'post__not_in'   => $loaded_photos, // Exclure les photos déjà chargées
        'orderby'        => 'rand',
    );

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

?>
