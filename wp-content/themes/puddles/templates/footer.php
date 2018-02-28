<?php use Roots\Sage\Assets; ?>
<footer class="content-info">
  <div class="container">
    <?php dynamic_sidebar('sidebar-footer'); ?>
    <div class="text-center">
    	<a href="https://www.facebook.com/PierreORourkeAuthor/" target="_blank"><img src="<?= Assets\asset_path('images/facebook.png'); ?>" alt="Pierre O'Rourke on Facebook" /></a>
    	<a href="https://twitter.com/PierreORourke" target="_blank"><img src="<?= Assets\asset_path('images/twitter.png'); ?>" alt="Pierre O'Rourke on Twitter" /></a>
  		<p class="copyright_notice">Copyright <?php echo Date('Y'); ?> Pierre O'Rourke</p>
  	</div>
  </div>
</footer>