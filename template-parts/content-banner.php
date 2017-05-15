<div class="top-banner" style="background-image:url('<?php echo wp_get_attachment_image_src( get_post_thumbnail_id(), 'size-large' )[0];?>');">
	<div class="top-banner-inner">
		<?php if( evos_get_title() ) : ?>
			<h1 class="title"><?php echo evos_get_title();?></h1>
			<div class="separator"></div>
		<?php endif;?>
	</div>
</div>
