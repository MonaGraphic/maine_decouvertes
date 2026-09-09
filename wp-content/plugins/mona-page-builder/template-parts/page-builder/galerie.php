<?php
declare(strict_types=1);

$images = get_sub_field( 'images' );

if ( empty( $images ) || ! is_array( $images ) ) {
	return;
}

$gallery_id = 'page-builder-gallery-' . wp_unique_id();
$gallery_items = [];

foreach ( $images as $image ) {
	$image_id = is_object( $image ) ? (int) $image->ID : (int) $image;

	if ( ! $image_id ) {
		continue;
	}

	$full = wp_get_attachment_image_src( $image_id, 'full' );

	if ( ! $full ) {
		continue;
	}

	$gallery_items[] = [
		'id'     => $image_id,
		'full'   => $full[0],
		'alt'    => get_post_meta( $image_id, '_wp_attachment_image_alt', true ),
		'caption'=> wp_get_attachment_caption( $image_id ),
	];
}

if ( empty( $gallery_items ) ) {
	return;
}
?>
<div
	class="page-builder__gallery"
	data-page-builder-gallery
	data-gallery-id="<?php echo esc_attr( $gallery_id ); ?>"
>
	<?php foreach ( $gallery_items as $index => $item ) : ?>
		<figure class="page-builder__gallery-item">
			<button
				type="button"
				class="page-builder__gallery-trigger"
				data-gallery-index="<?php echo esc_attr( $index ); ?>"
				aria-label="<?php echo esc_attr( sprintf( __( 'Ouvrir l’image %d en grand', 'mona-page-builder' ), $index + 1 ) ); ?>"
			>
				<span class="page-builder__gallery-media">
					<?php
					echo wp_get_attachment_image(
					$item['id'],
					'large',
					false,
					[
						'class'   => 'page-builder__gallery-image',
						'loading' => 'lazy',
					]
				);
				?>
				<span class="page-builder__gallery-overlay" aria-hidden="true"></span>
				</span>
			</button>

			<?php if ( $item['caption'] ) : ?>
				<figcaption class="page-builder__gallery-caption">
					<?php echo esc_html( $item['caption'] ); ?>
				</figcaption>
			<?php endif; ?>
		</figure>
	<?php endforeach; ?>

	<div
		class="page-builder__lightbox"
		data-page-builder-lightbox
		hidden
		aria-hidden="true"
	>
		<div class="page-builder__lightbox-dialog" role="dialog" aria-modal="true" aria-label="<?php echo esc_attr__( 'Galerie d’images', 'mona-page-builder' ); ?>">
			<button
				type="button"
				class="page-builder__lightbox-close"
				data-lightbox-close
				aria-label="<?php echo esc_attr__( 'Fermer la galerie', 'mona-page-builder' ); ?>"
			>
				<span aria-hidden="true">×</span>
			</button>

			<button
				type="button"
				class="page-builder__lightbox-prev"
				data-lightbox-prev
				aria-label="<?php echo esc_attr__( 'Image précédente', 'mona-page-builder' ); ?>"
			>
				<span aria-hidden="true">‹</span>
			</button>

			<figure class="page-builder__lightbox-figure">
				<img
					class="page-builder__lightbox-image"
					data-lightbox-image
					src=""
					alt=""
				>

				<figcaption
					class="page-builder__lightbox-caption"
					data-lightbox-caption
				></figcaption>
			</figure>

			<button
				type="button"
				class="page-builder__lightbox-next"
				data-lightbox-next
				aria-label="<?php echo esc_attr__( 'Image suivante', 'mona-page-builder' ); ?>"
			>
				<span aria-hidden="true">›</span>
			</button>
		</div>
	</div>

	<script type="application/json" data-page-builder-gallery-data>
		<?php echo wp_json_encode( $gallery_items, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ); ?>
	</script>
</div>
