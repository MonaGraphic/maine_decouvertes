<?php
/**
 * Page Builder WYSIWYG configuration.
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register a dedicated ACF toolbar for the Page Builder.
 */
add_filter(
	'acf/fields/wysiwyg/toolbars',
	static function ( array $toolbars ): array {
		$toolbars['Page Builder'] = [
			1 => [
				'removeformat',
				'formatselect',
				'bold',
				'italic',
				'bullist',
				'numlist',
				'indent',
				'outdent',
				'blockquote',
				'link',
			],
		];

		return $toolbars;
	}
);

/**
 * Force the dedicated toolbar on every Page Builder WYSIWYG field.
 *
 * This is done by field key, because these fields live inside Flexible
 * Content and can be cloned/repeated by ACF.
 */
foreach (
	[
		'field_pb_texte',
		'field_pb_ti_texte',
		'field_pb_org_description',
		'field_pb_acc_contenu',
		'field_pb_ong_contenu',
	] as $field_key
) {
	add_filter(
		'acf/load_field/key=' . $field_key,
		static function ( array $field ): array {
			$field['toolbar']      = 'page_builder';
			$field['media_upload'] = 0;

			return $field;
		}
	);
}

/**
 * Restrict the format dropdown to the three formats requested for the
 * Page Builder. This filter is scoped by the editor's field key below
 * through the dedicated toolbar.
 */
add_filter(
	'tiny_mce_before_init',
	static function ( array $settings ): array {
		$settings['block_formats'] = 'Paragraphe=p;Titre 2=h2;Titre 3=h3';

		return $settings;
	}
);
