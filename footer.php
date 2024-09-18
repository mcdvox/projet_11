        <!-- Footer -->
        <footer id="colophon" class="site-footer">
            <div class="footer-inner width-max">
                <nav class="footer-menu">
                    <?php
                    
                    // Menu de navigation
                    wp_nav_menu( array(
                        'theme_location' => 'secondary',
                        'menu_id'        => 'secondary-menu',
                        'menu_class'     => 'nav-menu'
                    )); ?>
                </nav>
            </div>

            <!-- Modale de contact -->
            <?php get_template_part("/templates_part/modale") ?>

            <!-- lightbox -->
            <?php get_template_part("/templates_part/lightbox") ?>
                        
        </footer>
        <?php wp_footer(); ?>
    </body>

</html>