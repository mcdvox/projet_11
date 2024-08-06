</div><!-- #content -->

<footer id="colophon" class="site-footer">
    <nav class="footer-menu">
        <?php
        // Menu de navigation
        wp_nav_menu( array(
            'theme_location' => 'secondary',
            'menu_id'        => 'secondary-menu',
            'menu_class'     => 'nav-menu'
        ) );
        ?>
    </nav><!-- .footer-menu -->
    <?php
    get_template_part("/templates_part/modale")
    ?>
</footer><!-- #colophon -->
    
    <?php wp_footer(); ?>
    </body>

</html>