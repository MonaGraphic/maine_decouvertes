<?php
declare(strict_types=1);

$lien = get_sub_field( 'lien' );

if ( empty( $lien['url'] ) ) {
	return;
}

$target = ! empty( $lien['target'] ) ? $lien['target'] : '_self';
$rel = '_blank' === $target ? 'noopener noreferrer' : '';
?>
<div class="page-builder__button">
	<a
		href="<?php echo esc_url( $lien['url'] ); ?>"
		target="<?php echo esc_attr( $target ); ?>"
		<?php if ( $rel ) : ?>
			rel="<?php echo esc_attr( $rel ); ?>"
		<?php endif; ?>
	>
		<?php echo esc_html( $lien['title'] ?? '' ); ?>
	</a>
</div>
