<?php
/**
 * Theme template fallback.
 *
 * Existing theme calls to get_template_part() continue to work unchanged.
 * A matching template in the active theme always takes precedence.
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action(
	'get_template_part',
	static function ( string $slug, ?string $name, ?array $args ): void {
		$prefix = 'template-parts/page-builder/';

		if ( ! str_starts_with( $slug, $prefix ) ) {
			return;
		}

		$relative = $slug . ( $name ? '-' . sanitize_file_name( $name ) : '' ) . '.php';

		// Theme override: WordPress will load it normally.
		if ( locate_template( $relative, false, false ) ) {
			return;
		}

		// Fallback to the plugin template.
		$plugin_template = MONA_PAGE_BUILDER_PATH . $relative;

		if ( ! file_exists( $plugin_template ) && $name ) {
			$plugin_template = MONA_PAGE_BUILDER_PATH . $slug . '.php';
		}

		if ( ! file_exists( $plugin_template ) ) {
			return;
		}

		if ( is_array( $args ) ) {
			extract( $args, EXTR_SKIP );
		}

		include $plugin_template;
	},
	5,
	3
);
