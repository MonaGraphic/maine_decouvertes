<?php
/**
 * Front-end assets.
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action(
	'wp_enqueue_scripts',
	static function (): void {
		if ( ! is_singular() ) {
			return;
		}

		wp_enqueue_style(
			'mona-page-builder',
			MONA_PAGE_BUILDER_URL . 'assets/css/page-builder.css',
			[],
			filemtime( MONA_PAGE_BUILDER_PATH . 'assets/css/page-builder.css' )
		);

		wp_enqueue_script(
			'mona-page-builder',
			MONA_PAGE_BUILDER_URL . 'assets/js/page-builder.js',
			[],
			filemtime( MONA_PAGE_BUILDER_PATH . 'assets/js/page-builder.js' ),
			[
				'in_footer' => true,
				'strategy'  => 'defer',
			]
		);
	}
);
