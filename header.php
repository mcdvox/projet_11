<!DOCTYPE html>
<!-- Détection automatique de la langue -->
<html <?php language_attributes(); ?>>
    <head>
        <!-- Encodage du site -->
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
    
        <!-- Déclaration du chargement des scripts et des styles WP via le Thème et Extensions -->
        <?php wp_head(); ?>
    </head>

    <!-- Déclaration du chargement des scripts et des styles WP via le Thème et Extensions (en bas de page)-->
    <body <?php body_class(); ?>>
    
    <?php wp_body_open(); ?>