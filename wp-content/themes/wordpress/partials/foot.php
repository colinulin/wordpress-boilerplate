<div class="footer">
	<div class="footer-inner clearfix">
		<div class="footer-navigation">
			<?php cu_get_footer_navigation(); ?>
		</div>
		<div class="footer-logo">
			<a href="<?php echo home_url(); ?>">
                <img src="<?=get_field('logo', 'options')['url']?>" alt="<?php echo esc_attr(bloginfo('name')); ?>" />
            </a>
		</div>
		<div class="footer-copyright">
			&copy; <?=date('Y', time())?> Company Name Inc.
		</div>
	</div>
</div>