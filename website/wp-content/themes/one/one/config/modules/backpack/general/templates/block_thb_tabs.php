<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

	<ul class="thb-tabs-nav">
		<?php $i=0; foreach( $tabs as $tab ) : ?>
			<li>
				<a href="#<?php echo thb_text_slugify($tab['title']); ?>-<?php echo $i; ?>">
					<?php thb_icon( $tab['icon'], $tab['color'] ); ?>
					<?php echo apply_filters( 'the_title', $tab['title'] ); ?>
				</a>
			</li>
		<?php $i++; endforeach; ?>
	</ul>

	<div class="thb-tabs-contents">
		<?php $i=0; foreach( $tabs as $tab ) : ?>
			<div class="thb-tab-content" id="<?php echo thb_text_slugify($tab['title']); ?>-<?php echo $i; ?>">
				<?php echo apply_filters( 'the_content', $tab['content']); ?>
			</div>
		<?php $i++; endforeach; ?>
	</div>

<?php endwhile; endif; ?>

<?php wp_reset_query(); ?>