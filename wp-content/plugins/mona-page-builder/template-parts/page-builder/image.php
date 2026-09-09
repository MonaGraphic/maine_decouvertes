<?php
declare(strict_types=1);

$image = get_sub_field( 'image' );
$legende = get_sub_field( 'legende' );

if ( ! $image ) {
	return;
}
?>
<figure class="page-builder__image">
	<?php
	echo wp_get_attachment_image(
		(int) $image,
		'full',
		false,
		[
			'class'   => 'page-builder__image-img',
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
