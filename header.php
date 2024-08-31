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

<!-- Déclaration du chargement des scripts et des styles WP via le Thème et Extensions (en bas de page)-->
<?php wp_body_open(); ?>

<header>
	<div class="header-inner width-max">
		<!-- Logo -->
		<div class="site-logo">
			<?php if ( has_custom_logo() ) : ?>
			<?php the_custom_logo(); ?>
			<?php else : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
			<?php endif; ?>
		</div>
		
		<!-- Menu de navigation -->
		<nav class="site-navigation">
			<?php wp_nav_menu( array(
				'theme_location' => 'primary',
				'menu_id' => 'primary-menu',
				'menu_class' => 'nav-menu',
			)); ?>

			<!-- Menu burger -->
			 <button class="menu_burger">
				<span class="line"></span>
			</button> 
		
			<div id="nav-burger" class="nav_burger">
				<?php wp_nav_menu( array(
					'theme_location' => 'burger',
					'menu_id' => 'tertiary-menu',
					'container' => false,
					'menu_class' => 'nav-burger',
				)); ?>
			</div>
		</nav>
	</div>
</header>
