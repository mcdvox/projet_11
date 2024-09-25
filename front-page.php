<!-- Front Page -->
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
                // Récupérer les termes de la taxonomie spécifiée
                $terms = get_terms($taxonomy);
            
                // Vérifiez si la récupération des termes est réussie
                if (!is_wp_error($terms) && !empty($terms)) {
                    echo '<div class="filter-item">';
                    echo '<select id="photo-' . esc_attr($taxonomy) . '-select">';
            
                    // Option par défaut
                    echo '<option value="" selected enabled>' . esc_html($label) . '</option>';
            
                    // Boucle sur les termes pour générer chaque option
                    foreach ($terms as $term) {
                        echo '<option value="' . esc_attr($term->slug) . '">' . esc_html($term->name) . '</option>';
                    }
            
                    echo '</select>';
                    echo '</div>';
                } else {
                    // Afficher un message d'erreur s'il n'y a pas de termes
                    echo '<p>' . esc_html__('Aucun terme trouvé pour la taxonomie ', 'motaphoto') . esc_html($taxonomy) . '</p>';
                }
            }
            

            // Appel des filtres pour les catégories et formats
            // Appel de la fonction pour générer un select pour la taxonomie "categorie"
            generate_taxonomy_select('categorie', 'Catégories');
            
            // Appel de la fonction pour générer un select pour la taxonomie "format"
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
    <div class="photo-button width-max">
        <button id="photo-btn" type="button" data-page="1">Charger plus</button>
    </div>
</main>

<?php get_footer(); ?>
