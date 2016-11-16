<?php get_header(); ?>
<div id="container">
  <section id="content" role="main">
    <header>
      <div class="container">
        <?php
          if ( function_exists('yoast_breadcrumb') ) {
          yoast_breadcrumb('<p id="breadcrumbs">','</p>');
          }
        ?>
        <div>
          <h1 class="page-title"><?php ldw_archive_title(); ?></h1>
        </div>
      </div>
    </header>

    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-lg-8 blog_main">
        <?php get_template_part( 'loop', 'index' ); ?>
        </div>
        <div class="col-xs-12 col-lg-4 blog_sidebar">
          <?php get_sidebar(); ?>
        </div>
      </div>
    </div>
  </section>
</div>
<?php get_footer(); ?>
