<?php
declare(strict_types=1);

if ( ! function_exists( 'mona_page_builder_testimonials_active' ) || ! mona_page_builder_testimonials_active() ) {
	return;
}

$testimonial = get_sub_field( 'testimonial' );

if ( is_numeric( $testimonial ) ) {
	$testimonial = get_post( absint( $testimonial ) );
}

if ( ! $testimonial instanceof WP_Post || 'testimonial' !== $testimonial->post_type ) {
	return;
}

$testimonial_id = $testimonial->ID;

$auteur              = get_field( 'auteur', $testimonial_id );
$fonction_entreprise = get_field( 'fonction_entreprise', $testimonial_id );
$contenu             = get_field( 'contenu', $testimonial_id );
$photo               = get_field( 'photo', $testimonial_id );
$note                = get_field( 'note', $testimonial_id );

if ( ! is_string( $auteur ) ) {
	$auteur = '';
}

if ( ! is_string( $fonction_entreprise ) ) {
	$fonction_entreprise = '';
}

if ( ! is_string( $contenu ) ) {
	$contenu = '';
}

$photo_id = is_numeric( $photo ) ? absint( $photo ) : 0;
?>
<section class="page-builder__testimonial">
	<?php if ( $photo_id ) : ?>
		<div class="page-builder__testimonial-media">
			<?php
			echo wp_get_attachment_image(
				$photo_id,
				'full',
				false,
				[
					'class'   => 'page-builder__testimonial-image',
					'loading' => 'lazy',
				]
			);
			?>
		</div>
	<?php endif; ?>

	<div class="page-builder__testimonial-content">
		<?php if ( $contenu ) : ?>
			<blockquote>
				<?php echo esc_html( '" ' . $contenu . ' "' ); ?>
			</blockquote>
		<?php endif; ?>

		<?php if ( $auteur ) : ?>
			<cite>
				<?php echo esc_html( $auteur ); ?>
				<?php if ( $fonction_entreprise ) : ?>
					<span><?php echo esc_html( $fonction_entreprise ); ?></span>
				<?php endif; ?>
			</cite>
		<?php endif; ?>
	</div>
</section>
