<?php
/**
 * Page Builder rendering helpers.
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function mona_page_builder_render(): void {
	$layout = get_row_layout();

	if ( ! is_string( $layout ) || '' === $layout ) {
		return;
	}

	$allowed_layouts = [
		'texte',
		'texte_image',
		'temoignage',
		'image',
		'video',
		'bouton',
		'galerie',
		'organigramme',
		'accordeon',
		'onglets',
		'faq',
	];

	if ( ! in_array( $layout, $allowed_layouts, true ) ) {
		return;
	}

	$template = mona_page_builder_template( $layout );

	if ( ! file_exists( $template ) ) {
		return;
	}

	include $template;
}

function mona_page_builder_template( string $layout ): string {
	$layout = sanitize_file_name( $layout );
	$relative = 'template-parts/page-builder/' . $layout . '.php';

	$theme_template = locate_template( $relative, false, false );

	if ( $theme_template ) {
		return $theme_template;
	}

	return MONA_PAGE_BUILDER_PATH . $relative;
}
