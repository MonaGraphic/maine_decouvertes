<?php
/**
 * Bloc Vidéo.
 */

$video = get_sub_field( 'video' );

if ( ! $video ) {
	return;
}
?>

<div class="page-builder__video">
	<div class="page-builder__video-embed">
		<?php echo $video; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</div>
</div>