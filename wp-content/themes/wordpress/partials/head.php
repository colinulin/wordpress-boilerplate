<div class="header">
    
    <div class="header-inner clearfix">
        
        <div class="logo">
            <a href="<?php echo home_url(); ?>">
                <img src="<?=get_field('logo', 'options')['url']?>" alt="<?php echo esc_attr(bloginfo('name')); ?>" />
            </a>
        </div>

        <nav role="navigation">
            <div class="main-navigation">
                <?php cu_get_main_navigation(); ?>
            </div>
        </nav>
        
    </div>
        
</div>

<?php cu_get_secondary_navigation(); ?>
