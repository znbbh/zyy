<?php

thb_portfolio_query();

$terms = get_terms("portfolio_categories");
$filter_active_class = 'active';
$filter_all_class = thb_portfolio_is_filtered() ? '' : $filter_active_class;

if( have_posts() && count($terms) > 0 ) : ?>

	<div class="thb-portfolio-filter">
		<ul class="filterlist">
			<li class="filter <?php echo $filter_all_class; ?>" data-filter="" data-href="<?php the_permalink(); ?>">
				<?php echo __('All', 'thb-portfolio'); ?>
			</li>
			<?php foreach( $terms as $term ) : ?>
				<?php
					$link = add_query_arg( 'filter', 'portfolio_categories:' . $term->term_id, get_permalink() );
					$term_class = in_array( $term->term_id, thb_portfolio_get_applied_filter_term_ids() ) ? $filter_active_class : '';
				?>
				<li class="filter <?php echo $term_class; ?>" data-filter="<?php echo $term->term_id; ?>" data-href="<?php echo $link; ?>">
					<?php echo $term->name; ?>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>

<?php endif; ?>