<?php 
use Roots\Sage\Assets;
?>
<header class="banner">
  <div class="container">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-content" aria-controls="navbar-content" aria-expanded="true" aria-label="<?php esc_html_e( 'Toggle Navigation', 'theme-textdomain' ); ?>">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbar-content">
        <?php
        wp_nav_menu( array(
          'theme_location' => 'primary_navigation', // Defined when registering the menu
          'menu_id'        => 'primary-menu',
          'container'      => false,
          'depth'          => 2,
          'menu_class'     => 'navbar-nav ml-auto',
          'walker'         => new Bootstrap_NavWalker(), // This controls the display of the Bootstrap Navbar
          'fallback_cb'    => 'Bootstrap_NavWalker::fallback', // For menu fallback
        ) );
        ?>
      </div>
    </nav>    
    <a class="brand" href="<?= esc_url(home_url('/')); ?>">
      <img src="<?= Assets\asset_path('images/logo.svg'); ?>" />
    </a>    
  </div>
</header>
