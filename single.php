<!-- ARTICLE DE BLOG -->
<!-- Intégration du Header du site -->
<?php get_header(); ?>

<?php
// Vérification de la liste des articles à afficher
while ( have_posts() ) :
    // Configuration des données du post actuel
    the_post();
    ?>
    <!-- Affichage du Titre de l'Article -->
    <h1><?php the_title(); ?></h1>
    <!-- Affichage du Contenu de l'Article -->
    <div><?php the_content(); ?></div>
<?php
// Fin de la Boucle
endwhile;
?>

<!-- Intégration du footer du site -->
<?php get_footer(); ?>