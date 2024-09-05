<?php
function display_random_photos($exclude_id = 0) {
    // Requête pour récupérer 8 articles aléatoires de type 'photo', en excluant un article spécifique
    $args_random_photos = array(
        'post_type'      => 'photo',
        'posts_per_page' => 8,
        'orderby'        => 'rand',
        'post__not_in'   => array($exclude_id),
    );

    $random_photos_query = new WP_Query($args_random_photos);

    if ($random_photos_query->have_posts()) {
        while ($random_photos_query->have_posts()) {
            $random_photos_query->the_post();

            if (has_post_thumbnail()) {
                // Inclure l'ID de l'article dans un attribut data-id pour récupérer plus tard
                echo '<div class="photo-item" data-id="' . get_the_ID() . '">';
                echo '<a href="' . esc_url(get_permalink()) . '">';
                the_post_thumbnail('medium_large', ['class' => 'random-photo']);
                echo '</a></div>';
            }
        }
        wp_reset_postdata();
    } else {
        echo '<p>Aucune photo trouvée.</p>';
    }
}

// Récupérer l'ID de l'article de la bannière stocké dans la session et afficher les photos
display_random_photos(isset($_SESSION['banner_post_id']) ? $_SESSION['banner_post_id'] : 0);

?>