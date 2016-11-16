<?php
$post_items_order = get_theme_mod('posts_item_order');
$post_items_order = explode(',',$post_items_order);


?>
<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
	<article id="post-0" class="post error404 not-found">
		<header class="entry-header">
			<h1 class="entry-title"><?php _e( 'Page introuvable', 'ldwbase' ); ?></h1>
		</header>
		<div class="entry-content">
			<p><?php _e( 'Désolé, la page que vous recherchez est introuvable. Essayez de lancer une recherche :', 'ldwbase' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</article><!-- #post-0 -->
<?php endif; ?>

<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article" itemscope="itemscope" itemtype="http://schema.org/Article">
            <?php
            foreach($post_items_order as $item){
                switch(trim($item)){
                    case 'img':
                        if ( has_post_thumbnail() ) {
                            echo '<figure class="entry-thumbnail">';
                                $attr_th = array(
                                    'title'    => get_the_title(),
                                    'itemprop'    => 'image',
                                    'alt'        => '');
                                echo '<a href="'.get_permalink().'" rel="nofollow">';
                                    the_post_thumbnail( 'large', $attr_th );
                                echo '</a>';
                            // récupération de l’url de la miniature
                            $src = wp_get_attachment_image_src(
                            get_post_thumbnail_id($post->ID), 'thumbnail', false);
                            echo '<meta itemprop="thumbnailUrl" content="'.$src[0].'">';
                            echo '</figure>';
                        }
                    break;
                    case 'title':
                    ?>
                    <header class="entry-header">
                        <h2 class="entry-title" itemprop="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    </header>
                    <?php
                    break;

                    case 'meta':
                    ?>
                    <div class="entry-meta"><?php echo ldw_entry_meta(); ?></div>
                    <?php
                    break;

                    case 'excerpt':
                    ?>
                    <div class="entry-content" itemprop="articleBody">
                        <?php the_excerpt(); ?>
                    </div>
                    <?php
                    break;

                    case 'more':
                    ?>
                    <div class="entry-more"><p><a href="<?php the_permalink(); ?>" rel="nofollow"><?php echo get_theme_mod('post_more'); ?></a></p></div>
                    <?php
                    break;
                }
            }
            ?>

		</article><!-- #post-## -->

<?php endwhile; // End the loop. Whew. ?>
