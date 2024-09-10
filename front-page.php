<!-- Appel du fichier en-tête -->
<?php get_header(); ?>

<main>
    <!-- Section pour la bannière -->
    <section class="hero">
        <div class="hero-banner width-max">
            <?php get_template_part('/templates_part/hero_banner'); ?>
            <h1>Photographe Event</h1>
        </div>
    </section>

    <!-- Section filtres -->
    <section class="filter-section width-max">
        <div class="photo-selection">
            <?php
            // Fonction pour générer un select avec des termes de taxonomie
            function generate_taxonomy_select($taxonomy, $label) {
                $terms = get_terms($taxonomy);
                echo '<div class="filter-item">';
                echo '<select id="photo-' . esc_attr($taxonomy) . '-select">';
                echo '<option value="" selected enabled>' . esc_html($label) . '</option>'; // Placeholder
                foreach ($terms as $term) {
                    echo '<option value="' . esc_attr($term->slug) . '">' . esc_html($term->name) . '</option>';
                }
                echo '</select>';
                echo '</div>';
            }

            // Appel des filtres pour les catégories et formats
            generate_taxonomy_select('categorie', 'Catégories');
            generate_taxonomy_select('format', 'Formats');
            ?>

            <!-- Filtre "Trier par" -->
            <div class="filter-item">
                <select id="filter-section_date-sort">
                    <option value="" selected enabled>Trier par</option>
                    <option value="DESC">À partir des plus récentes</option>
                    <option value="ASC">À partir des plus anciennes</option>
                </select>
            </div>
        </div>
    </section>

    <!-- Section des photos aléatoires -->
    <section class="random-photos width-max">
        <div class="photos-grid">
            <?php get_template_part('/templates_part/photo_block'); ?>
        </div>
    </section>

    <!-- Bouton "Charger plus" -->
    <div class="photo-button">
        <button id="photo-btn" type="button" data-page="1">Charger plus</button>
    </div>
</main>

<?php get_footer(); ?>
