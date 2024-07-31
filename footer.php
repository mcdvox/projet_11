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
    
</footer><!-- #colophon -->
    
    <?php wp_footer(); ?>
    </body>

</html>