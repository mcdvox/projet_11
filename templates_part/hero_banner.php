<?php
// Photo aléatoire au format paysage
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

$banner_query = new WP_Query($args_banner);

if ($banner_query->have_posts()) {
    while ($banner_query->have_posts()) {
        $banner_query->the_post();
        
        if (has_post_thumbnail()) {
            the_post_thumbnail('full', array('class' => 'full-width width-max'));
        } else {
            echo '<p>Aucune image disponible pour cette sélection.</p>';
        }
    }
    wp_reset_postdata();
}
else {
    echo '<p>Aucune image trouvée.</p>';
}
?>
