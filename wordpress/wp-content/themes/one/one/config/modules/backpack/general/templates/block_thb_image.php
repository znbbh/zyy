<?php
	$config = array();
	$caption_visible = $title != '' || $content != '';
	$lightbox_enabled = function_exists( 'thb_is_lightbox_enabled' ) && thb_is_lightbox_enabled();

	if ( $open_lightbox == 1 && $lightbox_enabled ) {
		$config = array(
			'link' => true,
			'link_class'    => 'item-thumb',
			'overlay'       => true,
			'overlay_class' => 'thb-overlay'
		);
	}
?>

<?php if ( $caption_visible ) : ?>
	<div class="thb-section-block-header">
		<?php if ( $title != '' ) : ?>
			<h1 class="thb-section-block-title"><?php echo apply_filters( 'the_title', $title ); ?></h1>
		<?php endif; ?>
	</div>

	<?php if ( $content != '' ) : ?>
		<div class="thb-text">
			<?php echo apply_filters( 'the_content', $content ); ?>
		</div>
	<?php endif; ?>
<?php endif; ?>

<div class="thb-section-block-thb_image-image-holder <?php if ( $caption_visible ) : ?>w-text<?php endif; ?>">
	<?php thb_image( $image, 'full', $config ); ?>
</div>