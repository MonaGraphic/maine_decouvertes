<?php
declare(strict_types=1);

$texte    = get_sub_field( 'texte' );
$image    = get_sub_field( 'image' );
$position = get_sub_field( 'position_image' );
$legende  = get_sub_field( 'legende' );

$classes = 'page-builder__text-image';

if ( 'left' === $position ) {
	$classes .= ' page-builder__text-image--left';
}
?>
<section class="<?php echo esc_attr( $classes ); ?>">
	<div class="page-builder__text-image-content">
		<?php echo wp_kses_post( $texte ); ?>
	</div>

	<?php if ( $image ) : ?>
		<figure class="page-builder__text-image-media">
			<?php
			echo wp_get_attachment_image(
				(int) $image,
				'full',
				false,
				[
					'class'   => 'page-builder__text-image-image',
					'loading' => 'lazy',
				]
			);
			?>

			<?php if ( $legende ) : ?>
				<figcaption class="page-builder__image-caption">
					<?php echo esc_html( $legende ); ?>
				</figcaption>
			<?php endif; ?>
		</figure>
	<?php endif; ?>
</section>
