<?php

$thb_format = '';
$thb_link_url = '';
$thb_quote_url = '';

if ( !isset( $thb_title ) ) {
	$thb_title = get_the_title();
}

if ( !isset( $thb_subtitle ) ) {
	$thb_subtitle = thb_get_page_subtitle();
}

if ( !isset( $show_featured_image ) ) {
	$show_featured_image = true;
}

if ( is_single() ) {
	$thb_format = thb_get_post_format();

	if ( thb_get_post_subtitle() != '' ) {
		$thb_subtitle = thb_get_post_subtitle();
	} else {
		$thb_subtitle = get_the_date();
	}

	if ( $thb_format === 'link' ) {
		if ( thb_get_post_subtitle() != '' ) {
			$thb_subtitle = thb_get_post_subtitle();
		} else {
			$thb_subtitle = thb_get_post_format_link_url();
		}
	}
	elseif( $thb_format === 'quote' ) {
		$thb_title = thb_get_post_format_quote_text();
		$thb_quote_url = thb_get_post_format_quote_url();

		if ( thb_get_post_subtitle() != '' ) {
			$thb_subtitle = thb_get_post_subtitle();
		} else {
			$thb_subtitle = thb_get_post_format_quote_author();
		}
	}
}

$show_page_header = (
	! thb_page_header_disabled()
	&& ! ( thb_slideshow_has_slides() && thb_is_page_header_layout_extended_with_title() )
);

?>

<header id="page-header" class="<?php if ( ! $show_page_header ) : ?>thb-page-header-disabled<?php endif; ?>">

	<?php if ( $show_featured_image && thb_is_page_header_layout_extended() ) : ?>
		<div class="thb-page-header-image-holder">
			<?php thb_get_template_part( 'partials/partial-page-featured-image', array( 'img_link' => false, 'img_overlay' => false, 'slideshow_class' => 'full_slideshow' ) ); ?>
		</div>
	<?php endif; ?>

	<div class="thb-page-header-wrapper <?php echo thb_one_get_pageheader_skin(); ?>">
		<div class="thb-page-header-wrapper-extra">

			<?php if ( $show_featured_image && thb_is_page_header_layout_b() ) : ?>
				<?php get_template_part( 'partials/partial-page-featured-image' ); ?>
			<?php endif; ?>

			<?php if ( $show_page_header ) : ?>
				<div class="thb-page-header-inner-wrapper">
					<?php if ( thb_is_subtitle_position_bottom() ) : ?>
						<h1 class="page-title" <?php thb_livestyle_element( 'page_header_title' ); ?>>
							<?php echo $thb_title; ?>
						</h1>
					<?php endif; ?>

					<?php if( !empty($thb_subtitle) ) : ?>
						<h2 class="page-subtitle" <?php thb_livestyle_element( 'page_header_subtitle' ); ?>>
							<?php if ( $thb_format === 'link' && thb_get_post_subtitle() == '' ) : ?>
								<a href="<?php echo $thb_subtitle; ?>" target="_blank"><?php echo $thb_subtitle; ?></a>
							<?php else : ?>
								<span><?php echo $thb_subtitle; ?></span>
							<?php endif; ?>
						</h2>
					<?php endif; ?>

					<?php if ( thb_is_subtitle_position_top() ) : ?>
						<h1 class="page-title" <?php thb_livestyle_element( 'page_header_title' ); ?>>
							<?php echo $thb_title; ?>
						</h1>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php if ( $show_featured_image && thb_is_page_header_layout_a() ) : ?>
				<?php get_template_part( 'partials/partial-page-featured-image' ); ?>
			<?php endif; ?>

		</div>
	</div>

</header>