<?php
/**
 * FAQ block render template.
 *
 * @package Mona\Faq
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Block attributes.
 *
 * @var array{
 *     selectedFaqs?: list<array{id?: int|string}>
 * } $attributes
 */

$selected_faqs = $attributes['selectedFaqs'] ?? array();
$faq_ids       = array();

foreach ( $selected_faqs as $faq ) {
	$faq_id = isset( $faq['id'] ) ? absint( $faq['id'] ) : 0;

	if ( $faq_id > 0 ) {
		$faq_ids[] = $faq_id;
	}
}

if ( empty( $faq_ids ) ) {
	return;
}

$faq_ids = array_values( array_unique( $faq_ids ) );

$faqs = get_posts(
	array(
		'post_type'        => 'faq',
		'post_status'      => 'publish',
		'post__in'         => $faq_ids,
		'orderby'          => 'post__in',
		'posts_per_page'   => count( $faq_ids ),
		'no_found_rows'    => true,
		'suppress_filters' => false,
	)
);

if ( empty( $faqs ) ) {
	return;
}

$instance_id = wp_unique_id( 'faq-' );
?>

<div class="faq" data-faq-instance="<?php echo esc_attr( $instance_id ); ?>">
	<?php foreach ( $faqs as $faq ) : ?>

		<?php
		$faq_title      = get_the_title( $faq );
		$question_id    = $instance_id . '-' . (string) $faq->ID . '-question';
		$answer_id      = $instance_id . '-' . (string) $faq->ID . '-answer';
		$answer_content = apply_filters( 'the_content', $faq->post_content );

		if ( ! is_string( $answer_content ) ) {
			$answer_content = '';
		}
		?>

		<div class="faq__item">

			<h3 class="faq__question">
				<button
					type="button"
					class="faq__button"
					aria-expanded="false"
					aria-controls="<?php echo esc_attr( $answer_id ); ?>"
					id="<?php echo esc_attr( $question_id ); ?>"
				>
					<span class="faq__title">
						<?php echo esc_html( $faq_title ); ?>
					</span>

					<span class="faq__icon" aria-hidden="true">
						+
					</span>
				</button>
			</h3>

			<div
				class="faq__answer"
				id="<?php echo esc_attr( $answer_id ); ?>"
				role="region"
				aria-labelledby="<?php echo esc_attr( $question_id ); ?>"
				hidden
			>
				<?php echo wp_kses_post( $answer_content ); ?>
			</div>

		</div>

	<?php endforeach; ?>
</div>
