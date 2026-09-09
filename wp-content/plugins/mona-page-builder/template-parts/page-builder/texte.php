<?php
declare(strict_types=1);

$texte = get_sub_field( 'texte' );

if ( ! $texte ) {
	return;
}
?>
<section class="page-builder__text">
	<?php echo wp_kses_post( $texte ); ?>
</section>
