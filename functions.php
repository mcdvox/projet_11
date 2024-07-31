<?php 

// Ajout du support pour les images à la une
add_theme_support( 'post-thumbnails' );

// Ajout du support pour les balises de titre
add_theme_support( 'title-tag' );

// Chargement de style.css du thème
function motaphoto_enqueue_styles() {
    wp_enqueue_style('motaphoto-style', get_stylesheet_directory_uri() . '/assets/css/style.css', array(), filemtime(get_stylesheet_directory() . '/assets/css/style.css')); 
}

add_action('wp_enqueue_scripts', 'motaphoto_enqueue_styles');

// Configuration initiale du thème
function theme_setup() {
    add_theme_support( 'custom-logo' );
    
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'motaphoto' ),
        'secondary' => __( 'Secondary Menu', 'motaphoto' ),
    ) );
}

add_action( 'after_setup_theme', 'theme_setup' );

// Chargement du script personnalisé pour le menu mobile
wp_enqueue_script( 'menu-scripts', get_stylesheet_directory_uri() . '/assets/scripts/menu.js', array('jquery'), filemtime(get_stylesheet_directory() . '/assets/scripts/menu.js'), true );