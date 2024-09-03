<!-- Appel du fichier en-tête -->
<?php get_header(); ?>

<!-- Section pour l'en-tête de la page -->
<main class="width-max">
    <section class="hero">
        <div class="hero-banner">
            <!-- Texte à centrer sur l'image -->
             <h1>Photographe Event</h1>
             <!-- Inclut le template partiel pour la bannière format paysage-->
             <?php get_template_part('/templates_part/hero_banner'); ?>
        </div>
    </section>
</main>

<!-- Appel du pied-de-page -->
<?php get_footer(); ?>