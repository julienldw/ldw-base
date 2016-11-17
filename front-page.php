<?php get_header(); ?>
<div id="container">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
  <section id="content" role="main">

    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-lg-8 blog_main">
          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article" itemscope="itemscope" itemtype="http://schema.org/BlogPosting">
  					<header class="entry-header">
  						<?php if ( has_post_thumbnail() ) {
  							echo '<figure class="entry-thumbnail">';
  								$attr_th = array(
  									'title'    => get_the_title(),
  									'itemprop'    => 'image',
  									'alt'        => '');
  								the_post_thumbnail( 'full', $attr_th );
  							// récupération de l’url de la miniature
  							$src = wp_get_attachment_image_src(
  							get_post_thumbnail_id($post->ID), 'thumbnail', false);
  							echo '<meta itemprop="thumbnailUrl" content="'.$src[0].'">';
  							echo '</figure>';
  						} ?>
  					</header>

  					<div class="entry-content" itemprop="articleBody">
  						<?php the_content(); ?>
  					</div>

  				</article><!-- #post-## -->

        </div>
        <div class="col-xs-12 col-lg-4 blog_sidebar">
          <?php get_sidebar(); ?>
        </div>
      </div>
    </div>
  </section>
<?php endwhile; // end of the loop. ?>
</div>
<?php get_footer(); ?>
