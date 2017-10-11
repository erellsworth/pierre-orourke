<?php 
use Roots\Sage\Assets;
?>
<header class="banner">
  <div class="container">
    <nav class="nav-primary" role="navigation">
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu([
                'theme_location' => 'primary_navigation', 
                'menu_class' => 'nav nav-pills justify-content-center flex-column flex-sm-row',
                'walker' => new bootstrap_4_walker_nav_menu()]);
      endif;
      ?>
    </nav>
    <a class="brand" href="<?= esc_url(home_url('/')); ?>">
      <img src="<?= Assets\asset_path('images/logo.svg'); ?>" />
    </a>    
  </div>
</header>
