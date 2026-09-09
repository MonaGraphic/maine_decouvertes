<?php
/**
 * Mona FAQ integration.
 */

declare(strict_types=1);

if ( ! function_exists( 'mona_page_builder_mona_faq_is_active' ) || ! mona_page_builder_mona_faq_is_active() ) {
	return;
}

$faqs = get_sub_field( 'faqs' );

if ( ! is_array( $faqs ) || empty( $faqs ) ) {
	return;
}

$faq_ids = [];

foreach ( $faqs as $faq ) {
	if ( is_object( $faq ) && isset( $faq->ID ) ) {
		$faq_ids[] = absint( $faq->ID );
	} elseif ( is_numeric( $faq ) ) {
		$faq_ids[] = absint( $faq );
	}
}

$faq_ids = array_values( array_filter( array_unique( $faq_ids ) ) );

if ( empty( $faq_ids ) ) {
	return;
}

$faq_posts = get_posts(
	[
		'post_type'      => 'faq',
		'post_status'    => 'publish',
		'post__in'       => $faq_ids,
		'orderby'        => 'post__in',
		'posts_per_page' => count( $faq_ids ),
		'no_found_rows'  => true,
	]
);

if ( empty( $faq_posts ) ) {
	return;
}

$accordion_id = 'page-builder-faq-' . wp_unique_id();
?>
<section class="page-builder__accordion">
	<div class="page-builder__accordion-list">
		<?php foreach ( $faq_posts as $index => $faq ) : ?>
			<?php
			$item_id = $accordion_id . '-item-' . $index;
			$answer_id = $accordion_id . '-answer-' . $index;
			$answer_content = apply_filters( 'the_content', $faq->post_content );
			?>
			<div class="page-builder__accordion-item">
				<h3 class="page-builder__accordion-question">
					<button
						type="button"
						class="page-builder__accordion-button"
						id="<?php echo esc_attr( $item_id ); ?>"
						aria-expanded="false"
						aria-controls="<?php echo esc_attr( $answer_id ); ?>"
					>
						<span class="page-builder__accordion-title">
							<?php echo esc_html( get_the_title( $faq ) ); ?>
						</span>
						<span class="page-builder__accordion-icon" aria-hidden="true">+</span>
					</button>
				</h3>

				<div
					class="page-builder__accordion-answer"
					id="<?php echo esc_attr( $answer_id ); ?>"
					role="region"
					aria-labelledby="<?php echo esc_attr( $item_id ); ?>"
					hidden
				>
					<?php echo wp_kses_post( $answer_content ); ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</section>
