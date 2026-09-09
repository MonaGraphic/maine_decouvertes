<?php
/**
 * Accordion Page Builder layout.
 */

declare(strict_types=1);

if ( ! have_rows( 'accordeon' ) ) {
	return;
}

$accordion_id = 'page-builder-faq-' . wp_unique_id();
?>
<section class="page-builder__accordion">
	<div class="page-builder__accordion-list">
		<?php $index = 0; ?>
		<?php while ( have_rows( 'accordeon' ) ) : the_row(); ?>
			<?php
			$titre = get_sub_field( 'titre' );
			$contenu = get_sub_field( 'contenu' );
			$item_id = $accordion_id . '-item-' . $index;
			$answer_id = $accordion_id . '-answer-' . $index;
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
							<?php echo esc_html( $titre ); ?>
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
					<?php echo wp_kses_post( $contenu ); ?>
				</div>
			</div>
			<?php $index++; ?>
		<?php endwhile; ?>
	</div>
</section>
