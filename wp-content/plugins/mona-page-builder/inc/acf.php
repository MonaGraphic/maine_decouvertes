<?php
/**
 * ACF integration.
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Make the plugin's ACF JSON available to ACF Local JSON.
 */
add_filter(
	'acf/settings/load_json',
	static function ( array $paths ): array {
		$paths[] = MONA_PAGE_BUILDER_PATH . 'acf';
		return array_unique( $paths );
	}
);

/**
 * Check whether the Mona FAQ plugin is active and its FAQ post type is available.
 *
 * @return bool
 */
function mona_page_builder_mona_faq_is_active(): bool {
	return class_exists( 'Mona\\Faq\\Plugin' ) && post_type_exists( 'faq' );
}

/**
 * Register the Page Builder field group directly from the plugin JSON.
 *
 * This means a site does not need a copy of group-page-builder.json in the
 * theme's acf-json directory. The plugin owns the field group.
 */
add_action(
	'acf/init',
	static function (): void {
		if ( ! function_exists( 'acf_add_local_field_group' ) ) {
			return;
		}

		$file = MONA_PAGE_BUILDER_PATH . 'acf/group-page-builder.json';

		if ( ! file_exists( $file ) || ! is_readable( $file ) ) {
			return;
		}

		$json = file_get_contents( $file );

		if ( false === $json ) {
			return;
		}

		$field_group = json_decode( $json, true );

		if ( ! is_array( $field_group ) || empty( $field_group['key'] ) ) {
			return;
		}

		if ( ! mona_page_builder_mona_faq_is_active() && isset( $field_group['fields'][0]['layouts']['layout_faq_mona'] ) ) {
			unset( $field_group['fields'][0]['layouts']['layout_faq_mona'] );
		}

		// Mona Testimonials is an optional integration. The Flexible Content
		// layouts are keyed by their layout key, so the testimonial layout must
		// be added explicitly with its ACF layout key.
		if ( mona_page_builder_testimonials_active() ) {
			$testimonial_layout = require MONA_PAGE_BUILDER_PATH . 'inc/testimonial-layout.php';

			if ( is_array( $testimonial_layout ) && ! empty( $testimonial_layout['key'] ) ) {
				$field_group['fields'][0]['layouts'][ $testimonial_layout['key'] ] = $testimonial_layout;
			}
		}

		acf_add_local_field_group( $field_group );
	}
);

function mona_page_builder_testimonials_active(): bool {
	/*
	 * Mona Testimonials registers its CPT on init. The Page Builder field
	 * group is registered on acf/init, which can happen before init. We must
	 * therefore not use post_type_exists() here to detect the integration.
	 */
	return defined( 'MONA_TESTIMONIALS_VERSION' );
}
