<!-- PAGES -->
<?php
get_header();

// Itération au travers de tous les posts
while ( have_posts() ) :
	the_post();

	// Intégration du contenu de la page basé sur son format
	get_template_part( 'content-page' );

endwhile; // Fin de la boucle

// Intégration du Footer du site
get_footer();