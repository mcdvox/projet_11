<!-- Content Page -->
 <!-- Début de l'article -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <!-- En-tête de l'article -->
    <header class="entry-header">
        <!-- Titre de l'article -->
        <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>
    
    <!-- Contenu de l'article -->
     <div class="entry-content">
        <!-- Affichage du contenu principal de l'article -->
        <?php the_content(); ?>
    </div>
</article>
<!-- Fin de l'article -->