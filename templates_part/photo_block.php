<!-- Template Block Photo -->
<?php

// Fonction pour afficher des photos aléatoires, avec la possibilité d'exclure une photo spécifique en fonction de son ID
function display_random_photos($exclude_id = 0) {

    // Préparation des arguments pour la requête WordPress (WP_Query)
    $args_random_photos = array(
        'post_type'      => 'photo',
        'posts_per_page' => 8,
        'orderby'        => 'rand',
        'post__not_in'   => array($exclude_id),
    );
    
    // Créer une nouvelle instance de WP_Query avec les arguments définis
    $random_photos_query = new WP_Query($args_random_photos);
    
    // Vérifier s'il y a des publications correspondant à la requête
    if ($random_photos_query->have_posts()) {

        // Boucle à travers les résultats de la requête
        while ($random_photos_query->have_posts()) {

            // Prépare chaque publication pour être utilisée
            $random_photos_query->the_post();
            
            // Vérifier si la publication a une image à la une (thumbnail)
            if (has_post_thumbnail()) {

                // Récupérer la métadonnée 'reference' associée à la photo (stockée dans la base de données)
                $photo_ref = get_post_meta(get_the_ID(), 'reference', true);

                // Récupérer les catégories (termes de taxonomie) associées à la photo
                $photo_category = wp_get_post_terms(get_the_ID(), 'categorie', array('fields' => 'names')); // Récupération de la catégorie
                
                // Si la photo appartient à plusieurs catégories, utiliser la première. Sinon, afficher 'Non catégorisé'
                $category_name = !empty($photo_category) ? $photo_category[0] : 'Non catégorisé';

                // Générer le HTML pour afficher l'image et ses informations
                echo '<div class="photo-item" data-id="' . get_the_ID() . '">';

                // Afficher l'image de la publication en taille moyenne (medium_large)
                the_post_thumbnail('medium_large', ['class' => 'random-photo']);

                // Création d'un overlay (surcouche) pour afficher les informations supplémentaires
                echo '<div class="overlay">';

                // Lien pour accéder à la page de la photo
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

                // Afficher une icône "plein écran" avec des attributs de données pour la lightbox
                echo '<img src="' . get_template_directory_uri() . '/assets/images/full_screen.png" class="fullscreen-icon lightbox-trigger" alt="Plein écran" data-image="' . get_the_post_thumbnail_url(get_the_ID(), 'full') . '" data-ref="' . esc_attr($photo_ref) . '" data-category="' . esc_attr($category_name) . '">';
                
                // Fermer la balise div de l'overlay
                echo '</div>';
                
                // Fermer la balise div de l'élément photo
                echo '</div>';
            }
        }

        // Réinitialiser les données de publication pour éviter les interférences avec d'autres requêtes sur la page
        wp_reset_postdata();
    } else {
        
        // Si aucune photo n'a été trouvée, afficher un message informatif
        echo '<p>Aucune photo trouvée.</p>';
    }
}

// Appel de la fonction pour afficher les photos aléatoires
// On passe l'ID d'un article à exclure, stocké dans la session utilisateur (session PHP)
display_random_photos(isset($_SESSION['banner_post_id']) ? $_SESSION['banner_post_id'] : 0);

?>
