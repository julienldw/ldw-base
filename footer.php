    </div>
  </div>

  <footer id="footer" class="site-footer" role="contentinfo">

    <div id="footer-top">
      <div class="container">
        <div class="row">
          <?php	dynamic_sidebar('footer-widgets') ?>
        </div>
      </div>
    </div>

    <div id="footer-middle">
      <div class="container">
        <div class="row">
            <div id="footer-menu" class="col-xs-12 col-md-6">
              <?php ldw_menu('secondary','list',null,'nav navbar-nav'); ?>
            </div>
            <div id="footer-social" class="col-xs-12 col-md-6">
              <?php ldw_social('Retrouvez-nous sur les réseaux sociaux'); ?>
            </div>
        </div>
      </div>
    </div>

    <div id="footer-bottom">
      <div class="container">
        <div class="row">
            <div id="footer-signature" class="col-xs-12 col-md-6" itemtype="http://schema.org/WPFooter" itemscope="itemscope" role="contentinfo">
              <?php echo get_theme_mod('signature'); ?>
            </div>
        </div>
      </div>
    </div>

  </footer>

  <?php wp_footer(); ?>
</body>
</html>
