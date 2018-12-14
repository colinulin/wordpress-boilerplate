<div class="middle-inner clearfix">

    <div class="middle-content">

        <p>Search results for: <strong><?=get_search_query()?></strong></p>
    
        <?php if (have_posts()) : ?>
        
            <?php while ( have_posts() ) : the_post(); ?>

                <div class="search-result">
                    <h2><a class="search-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <a class="search-link" href="<?php the_permalink(); ?>"><?php echo site_url(); the_permalink(); ?></a>
                    <div class="search-preview"><?php the_excerpt(); ?></div>
                </div>

            <?php endwhile; ?>

            <?php cu_pagination(); ?>
            
        <?php else: ?>

            <h3>No results were found. Please try a different seach term!</h3>

        <?php endif; ?>
    
</div>