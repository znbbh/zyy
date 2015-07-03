<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
?>
<li itemprop="reviews" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

	<article id="comment-<?php comment_ID(); ?>">
		
		<header class="comment-meta comment-author vcard">
			<h6>
				<?php if ( $comment->comment_approved == '0' ) : ?>
				
				<?php _e( 'Your comment is awaiting approval', 'woocommerce' ); ?>
		
				<?php else : ?>
						<strong itemprop="author"><?php comment_author(); ?></strong> <?php
		
							if ( get_option( 'woocommerce_review_rating_verification_label' ) === 'yes' )
								if ( wc_customer_bought_product( $comment->comment_author_email, $comment->user_id, $comment->comment_post_ID ) )
									echo '<em class="verified">(' . __( 'verified owner', 'woocommerce' ) . ')</em> ';
		
						?>&ndash; <time itemprop="datePublished" datetime="<?php echo get_comment_date( 'c' ); ?>"><?php echo get_comment_date( __( get_option( 'date_format' ), 'woocommerce' ) ); ?></time>
		
				<?php endif; ?>
			</h6>
			<?php if ( $rating && get_option( 'woocommerce_enable_review_rating' ) == 'yes' ) : ?>
				
				<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating pull-right stars-<?php echo str_replace( '.', '', round( $rating, 1, PHP_ROUND_HALF_DOWN ) ); ?>" title="<?php echo sprintf( __( 'Rated %d out of 5', 'woocommerce' ), $rating ) ?>">
				</div>

			<?php endif; ?>
		</header>
		
		<div class="comment_container">
			<?php echo get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '60' ), '', get_comment_author() ); ?>
	
			<section class="comment-content">
				<div itemprop="description" class="description"><?php comment_text(); ?></div>
			</section>
		</div>
	</article>
