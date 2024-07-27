<!-- PAGES -->
<?php
get_header();

// Itération au travers de tous les posts
while ( have_posts() ) :
	the_post();

	// Intégration du contenu de la page basé sur son format
	get_template_part( 'content-page' );

	// Si les commentaires sont ouverts ou s'il y a au moins un commentaire, chargez le template de commentaires
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
endwhile; // Fin de la boucle

// Intégration du footer du site
get_footer();