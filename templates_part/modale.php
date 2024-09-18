<!-- Template Modale -->
<!-- Modale de contact -->
 <!-- Structure de la Modale -->
<div class="contact-modal" id="contact-modal" style="display: none;">
    <!-- Contenu de la Modale -->
    <div class="contact-modal-content">
        <!-- Intégration de l'image de contact -->
         <img src="<?php echo get_template_directory_uri(); ?>/assets/images/contact-header.png">
         <!-- Appel du formulaire CF7 -->
          <div class="cf7-container">
            <?php echo do_shortcode('[contact-form-7 id="c86662e" title="Formulaire de Contact"]'); ?>
        </div>
    </div>
</div>