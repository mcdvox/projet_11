<!-- ARTICLE DE BLOG -->
<?php
// Récupération de l’en-tête et du menu
get_header(); ?>

<!-- Zone principale de contenu -->
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

    <?php
	// Itération au travers de tous les posts
    while ( have_posts() ) :
        the_post();

		// Intégration du contenu de l'article basé sur son format
        get_template_part( 'content', get_post_format() );

		// Affichage de la navigation pour les articles précédents/suivants
        the_post_navigation();

        // Si les commentaires sont ouverts ou s'il y a au moins un commentaire, chargez le template de commentaires
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;

    endwhile; // Fin de la boucle
    ?>

    </main><!-- #main -->
</div><!-- #primary -->

<!-- Intégration du footer du site -->
<?php get_footer(); ?>