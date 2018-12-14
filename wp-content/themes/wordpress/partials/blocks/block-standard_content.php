<div class="middle-inner clearfix">

	<div class="middle-content block-standard_content">
		<?php
		$content_post = get_post($cu_post_id);
		$content = $content_post->post_content;
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content);
		echo $content;
		?>
	</div>

</div>