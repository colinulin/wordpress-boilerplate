<div class="middle clearfix">

	<?php // Set default post id. ?>
    <?php 
    $cu_post_id = get_the_ID();
    $term = $wp_query->get_queried_object();
    set_query_var( 'cu_post_id', $cu_post_id ); 
    ?>

    <?php // Display Search page ?>
    <?php if ( is_search() ) : ?>
        <?php get_template_part('partials/pages/page', 'search'); ?>
    <?php // Display 404 page ?>
    <?php elseif( is_404() ) : ?>
        <?php get_template_part('partials/pages/page', '404'); ?>
    <?php else: ?>

		<?php // Display Front Page ?>
        <?php if ( get_page_template_slug($cu_post_id) == 'front-page.php' ) : ?>
            <?php get_template_part('partials/pages/page', 'frontpage'); ?>

        <?php // Display Standard Content ?>
		<?php elseif ( have_posts() && !is_search() && $post->post_content != '' ) : the_post(); ?>
			<?php get_template_part('partials/blocks/block', 'standard_content'); ?>
		<?php endif; ?>

	<?php endif; ?>

</div>