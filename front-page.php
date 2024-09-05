<!-- Appel du fichier en-tête -->
<?php get_header(); ?>

<!-- Section pour l'en-tête de la page -->
<main>
    <!-- Section pour la bannière -->
    <section class="hero">
        <div class="hero-banner">
            <!-- Inclut le template partiel pour la bannière format paysage -->
            <?php get_template_part('/templates_part/hero_banner'); ?>
            <!-- Texte à centrer sur l'image -->
            <h1>Photographe Event</h1>
        </div>
    </section>

    <!-- Section filtres -->
    <section class="filter-section width-max">
        <!-- Filtrer par taxonomie et champs -->    
        <div class="photo-selection">
            <?php
            // Fonction pour générer un select pour les taxonomies
            function generate_taxonomy_select($taxonomy, $label) {
                $terms = get_terms($taxonomy); // Récupérer les termes
                echo '<select id="photo-' . esc_attr($taxonomy) . '-select">';
                echo '<option value="">' . esc_html($label) . '</option>';
                foreach ($terms as $term) {
                    echo '<option value="' . esc_attr($term->slug) . '">' . esc_html($term->name) . '</option>';
                }
                echo '</select>';
            }
            
            // Afficher les menus déroulants pour la catégorie et le format
            generate_taxonomy_select('categorie', 'Catégories');
            generate_taxonomy_select('format', 'Formats');
            ?>
        </div>  
    
        <!-- Trier par date -->
        <select id="filter-section_date-sort">
            <option value="">Trier par</option>
            <option value="DESC">À partir des plus récentes</option>
            <option value="ASC">À partir des plus anciennes</option>
        </select>
    </section>

    <!-- Section pour afficher les images de 8 articles aléatoires -->
    <section class="random-photos width-max">
        <div class="photos-grid">
            <!-- Inclut le template partiel pour les 8 images -->
            <?php get_template_part('/templates_part/photo_block'); ?>
        </div>
    </section>

    <!-- Charger Plus -->
     <div class="photo-button">
        <button id="photo-btn" type="button" data-page="1">Charger plus</button>
    </div>

</main>

<!-- Appel du pied-de-page -->
<?php get_footer(); ?>