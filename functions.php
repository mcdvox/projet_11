<?php

// Inclusion des fonctions AJAX
require get_template_directory() . '/functions-ajax.php';

// Démarrer la session si elle n'est pas déjà démarrée
if (!session_id()) {
    session_start();
}

// Ajout du support pour les images à la une
add_theme_support( 'post-thumbnails' );

// Ajout du support pour les balises de titre
add_theme_support( 'title-tag' );

// Décharger les polices Google Fonts
function remove_google_fonts() {
    wp_dequeue_style( 'Poppins' );
    wp_dequeue_style( 'SpaceMono' );
}

add_action('remove_google_fonts', 999);

// Chargement de style.css du thème
function motaphoto_enqueue_styles() {
    // Charger le style Select2 en premier pour que le style du thème le surcharge
    wp_enqueue_style('select2-css', get_template_directory_uri() . '/vendor/select2/dist/css/select2.min.css', array(), '4.0.13');

    // Charger le style du thème en dernier pour qu'il soit prioritaire
    wp_enqueue_style('motaphoto-style', get_stylesheet_directory_uri() . '/assets/css/style.css', array('select2-css'), filemtime(get_stylesheet_directory() . '/assets/css/style.css')); 
    
    // Chargement des scripts personnalisés
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script('modale-scripts', get_template_directory_uri() . '/assets/scripts/modale.js', array('jquery'), filemtime(get_stylesheet_directory() . '/assets/scripts/modale.js'), true );
    wp_enqueue_script( 'menu-scripts', get_stylesheet_directory_uri() . '/assets/scripts/menu.js', array('jquery'), filemtime(get_stylesheet_directory() . '/assets/scripts/menu.js'), true );

    // Chargement du script Select2
    wp_enqueue_script('select2-js', get_template_directory_uri() . '/vendor/select2/dist/js/select2.min.js', array('jquery'), '4.0.13', true);

    // Chargement du script AJAX pour Infinite Scroll
    wp_enqueue_script('scripts-ajax', get_stylesheet_directory_uri() . '/assets/scripts/scripts-ajax.js', array('jquery'), filemtime(get_stylesheet_directory() . '/assets/scripts/scripts-ajax.js'), true);

    // Initialisation de Select2
    wp_add_inline_script('select2-js', '
        jQuery(document).ready(function($) {
            $("#photo-categorie-select").select2();
            $("#photo-format-select").select2();
            $("#filter-section_date-sort").select2();
        });
    ');

    // Localisation de l'URL d'AJAX pour JavaScript
    wp_localize_script('scripts-ajax', 'ajax_params', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));
}

add_action('wp_enqueue_scripts', 'motaphoto_enqueue_styles');

// Configuration initiale du thème
function theme_setup() {
    add_theme_support( 'custom-logo' );
    
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'motaphoto' ),
        'secondary' => __( 'Secondary Menu', 'motaphoto' ),
        'burger' => __( 'Burger Menu', 'motaphoto' ),
    ) );
}

add_action( 'init', 'theme_setup' );

?>
