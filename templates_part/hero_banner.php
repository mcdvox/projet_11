<?php
// Fonction pour afficher la bannière avec une photo aléatoire au format paysage
function display_random_paysage_banner() {
    // Définir les arguments de la requête pour obtenir une photo au format paysage
    $args_banner = array(
        'post_type' => 'photo',
        'posts_per_page' => 1,
        'orderby' => 'rand',
        'tax_query' => array(
            array(
                'taxonomy' => 'format',
                'field' => 'slug',
                'terms' => array('paysage'),
            ),
        ),
    );

    // Exécuter la requête
    $banner_query = new WP_Query($args_banner);

    if ($banner_query->have_posts()) {
        $banner_query->the_post();

        // Stocker l'ID de l'article dans la session
        $_SESSION['banner_post_id'] = get_the_ID();

        // Afficher l'image mise en avant avec le lien vers l'article
        if (has_post_thumbnail()) {
            // echo '<a href="' . esc_url(get_permalink()) . '">';
            the_post_thumbnail('full', array('class' => 'full-width'));
            echo '</a>';
        } else {
            echo '<p>Aucune photo disponible pour cette sélection.</p>';
        }

        wp_reset_postdata(); // Réinitialiser les données de la requête
    } else {
        echo '<p>Aucune photo trouvée.</p>';
    }
}

// Appeler la fonction pour afficher la bannière
display_random_paysage_banner();
?>