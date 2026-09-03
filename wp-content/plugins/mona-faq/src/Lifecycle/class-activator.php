<?php
/**
 * Plugin activation.
 *
 * @package Mona\Faq
 */

declare(strict_types=1);

namespace Mona\Faq\Lifecycle;

use Mona\Faq\PostType\Faq as FaqPostType;

/**
 * Handles plugin activation.
 *
 * @package Mona\Faq
 */
final class Activator {

	/**
	 * Activate the plugin.
	 *
	 * @return void
	 */
	public static function activate(): void {
		$faq_post_type = new FaqPostType();
		$faq_post_type->register();

		if ( function_exists( 'flush_rewrite_rules' ) ) {
			flush_rewrite_rules();
		}
	}
}
