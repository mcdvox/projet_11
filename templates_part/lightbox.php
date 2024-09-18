<div class="lightbox" style="display: none;">
    
    <!-- Fermeture de la lightbox -->
    <button class="lightbox__close" aria-label="Fermer la fenêtre">
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/close.png" alt="Fermeture de la Lightbox" />
    </button>
    
    <div class="lightbox__container">

        <!-- Bouton Précédente (à gauche) -->
        <button class="lightbox__prev" aria-label="Précédent">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/previous.png" alt="Précédent" />
        </button>
        
        <div class="lightbox__image-wrapper"></div>
        
        <!-- Bouton Suivante (à droite) -->
        <button class="lightbox__next" aria-label="Suivant">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/next.png" alt="Suivant" />
        </button>
    </div>
</div>
