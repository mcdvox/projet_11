<!-- Single Photo -->
<?php
/**
 * The template for displaying all single posts of 'photo' post type
 * 
 * @link http://motaphoto.local
 * @package motaphoto
 * @subpackage motaphoto
 * @since motaphoto 1.0
 */

// Chargement de l'en-tête de la page
get_header();

echo '<main class="width-max">'; 

// Récupèration de l'identifiant de la photo à partir de l'URL
$slug = get_query_var('photo');

// Définition des critères de recherche pour obtenir le post correspondant au slug de la photo
$args = [
    'post_type' => 'photo',
    'name' => $slug,
    'posts_per_page' => 1
];

// Exécution de la requête personnalisée pour récupérer le post
$custom_query = new WP_Query($args);

// Vérification de l'existence de posts correspondant à la requête
if ($custom_query->have_posts()) :
    while ($custom_query->have_posts()) : $custom_query->the_post(); // Boucle sur les posts trouvés (un seul post attendu)

        // Récupèration des champs personnalisés et des termes de taxonomie pour la photo actuelle
        $reference = get_field('reference');
        $categories = wp_get_post_terms(get_the_ID(), 'categorie');
        $formats = wp_get_post_terms(get_the_ID(), 'format');
        $type = get_field('type');
        $annee = get_the_date('Y');
?>

<!-- Section de l'article séléctionné -->
<section class="selected-photo"> 
    <div class="infos">
        <div class="description">

            <!-- Affiche le titre du post -->
            <h2><?php the_title(); ?></h2>

            <!-- Affiche la référence de la photo -->
            <p>Référence : <span id="reference"><?php echo esc_html($reference); ?></span></p>

            <!-- Affiche les catégories de la photo sous forme de liste séparée par des virgules -->
            <p>Catégorie : <?php echo implode(', ', wp_list_pluck($categories, 'name')); ?></p>

            <!-- Affiche les formats de la photo sous forme de liste séparée par des virgules -->
            <p>Format : <?php echo implode(', ', wp_list_pluck($formats, 'name')); ?></p>

            <!-- Affiche le type de la photo -->
            <p>Type : <?php echo esc_html($type); ?></p>

            <!-- Affiche l'année de publication de la photo -->
            <p>Année : <?php echo esc_html($annee); ?></p>
        </div>
        <div class="infos-photo">

            <!-- Affiche la miniature de la photo dans la taille 'medium_large' -->
            <?php the_post_thumbnail('medium_large'); ?>
        </div>
    </div>

    <!-- Section Contact -->
    <div class="contact">
        <div class="photo-contact">
            <p>Cette photo vous intéresse ?</p> 

            <!-- Bouton de contact pour l'utilisateur -->
            <button class="btn-contact" data-reference="<?php echo esc_attr($reference); ?>">Contact</button>
        </div>

        <div class="photo-navigation">
            <?php
            $previous_post = get_previous_post();
            $next_post = get_next_post();
    
            $prev_post_url = $previous_post ? get_permalink($previous_post) : get_permalink(get_posts(['post_type' => 'photo', 'posts_per_page' => 1, 'orderby' => 'date', 'order' => 'DESC'])[0]);
            $next_post_url = $next_post ? get_permalink($next_post) : get_permalink(get_posts(['post_type' => 'photo', 'posts_per_page' => 1, 'orderby' => 'date', 'order' => 'ASC'])[0]);
            ?>

            <div class="arrow">
                <div class="arrow-left">
                    <a href="<?php echo esc_url($prev_post_url); ?>" class="arrow arrow-prev">
                        &#8592;
                    </a>
                </div>

                <div class="arrow-right">
                    <a href="<?php echo esc_url($next_post_url); ?>" class="arrow arrow-next">
                        &#8594;
                    </a>
                </div>

                <div class="thumbnail-left">
                    <?php

                    // Récupération du dernier post (si pas déjà fait)
                    $last_post = get_posts(['post_type' => 'photo', 'posts_per_page' => 1, 'orderby' => 'date', 'order' => 'DESC'])[0];
        
                    // Si un post précédent existe, afficher sa miniature, sinon afficher la miniature du dernier post
                    if (!empty($previous_post)) {
                        $thumbnail_left = get_the_post_thumbnail($previous_post->ID, 'custom-thumbnail');
                    } else {
                        $thumbnail_left = get_the_post_thumbnail($last_post->ID, 'custom-thumbnail');
                    }
                    echo $thumbnail_left;
                    ?>
                </div>

                
                <div class="thumbnail-right">
                    <?php

                    // Récupération du premier post (si pas déjà fait)
                    $first_post = get_posts(['post_type' => 'photo', 'posts_per_page' => 1, 'orderby' => 'date', 'order' => 'ASC'])[0];

                    // Si un post suivant existe, afficher sa miniature, sinon afficher la miniature du premier post
                    if (!empty($next_post)) {
                        $thumbnail_right = get_the_post_thumbnail($next_post->ID, 'custom-thumbnail');
                    } else {
                        $thumbnail_right = get_the_post_thumbnail($first_post->ID, 'custom-thumbnail');
                    }
                    echo $thumbnail_right;
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section  vous aimerez aussi -->
<section class="others">
    <h3>Vous aimerez aussi</h3>
    <?php

    // Récupération de l'ID de la photo actuelle
    $current_photo_id = get_the_ID();

    // Récupération des catégories de la photo actuelle
    $categories = wp_get_post_terms($current_photo_id, 'categorie', array('fields' => 'ids'));

    // Définition des critères de recherche pour obtenir deux photos aléatoires de la même catégorie
    $args_random_photos = array(
        'post_type'         => 'photo',
        'posts_per_page'    => 2,
        'orderby'           => 'rand',
        'tax_query' => array(
            array(
                'taxonomy'  => 'categorie',
                'field'     => 'term_id',
                'terms'     => $categories,
            ),
        ),
        'post__not_in' => array($current_photo_id) // Exclusion de la photo actuelle
    );

    // Exécution de la requête personnalisée pour récupérer les photos
    $random_photos_query = new WP_Query($args_random_photos);

    // Vérification de l'existence de posts correspondant à la requête
    if ($random_photos_query->have_posts()) :
        echo '<div class="related-photos-container">';
        while ($random_photos_query->have_posts()) : $random_photos_query->the_post(); // Boucle sur les posts trouvés

            if (has_post_thumbnail()) {

                // Récupérer les métadonnées de la photo
                $photo_ref = get_post_meta(get_the_ID(), 'reference', true);
                $photo_category = wp_get_post_terms(get_the_ID(), 'categorie', array('fields' => 'names'));
                
                // Utiliser le premier terme si la photo a plusieurs catégories
                $category_name = !empty($photo_category) ? $photo_category[0] : 'Non catégorisé';

                // Afficher chaque photo chargée avec ses métadonnées dans une div
                echo '<div class="related-photo-item" data-id="' . get_the_ID() . '">';
                
                // Afficher la miniature de la photo
                the_post_thumbnail('medium_large', ['class' => 'random-photo']);
                
                // Ajouter l'overlay
                echo '<div class="overlay">';
                echo '<a href="' . get_permalink() . '" class="article-link"
                    data-image="' . get_the_post_thumbnail_url(get_the_ID(), 'full') . '"
                    data-ref="' . esc_attr($photo_ref) . '"
                    data-category="' . esc_attr($category_name) . '">';
                echo '<img src="' . get_template_directory_uri() . '/assets/images/eye_informations.png" class="eye-icon" alt="Informations">';
                echo '</a>';                

                // Ajouter le titre de la photo (en bas à gauche)
                echo '<div class="photo-title">' . get_the_title() . '</div>';

                // Ajouter la catégorie de la photo (en bas à droite)
                echo '<div class="photo-category">' . esc_attr($category_name) . '</div>';

                // Ajouter le titre de la photo (en bas à gauche)
                echo '<div class="photo-title">' . get_the_title() . '</div>';

                // Ajouter la catégorie de la photo (en bas à droite)
                echo '<div class="photo-category">' . esc_attr($category_name) . '</div>';

                // Ajouter l'icône de plein écran
                echo '<img src="' . get_template_directory_uri() . '/assets/images/full_screen.png" class="fullscreen-icon lightbox-trigger" alt="Plein écran" data-image="' . get_the_post_thumbnail_url(get_the_ID(), 'full') . '" data-ref="' . esc_attr($photo_ref) . '" data-category="' . esc_attr($category_name) . '">';

                echo '</div>'; // Fin de l'overlay
                echo '</div>'; // Fin de la div related-photo-item
            }
            
        endwhile;
        echo '</div>'; // Fin de la div related-photos-container
        wp_reset_postdata();
    else :
        echo '<p>Aucune autre photo disponible dans cette catégorie.</p>';
    endif;
    ?>
</section>


<?php
    endwhile;
    wp_reset_postdata();
endif;

echo "</main>"; 
get_footer();
?>