<?php
/**
 * Plugin deactivation.
 *
 * @package Mona\Faq
 */

declare(strict_types=1);

namespace Mona\Faq\Lifecycle;

/**
 * Handles plugin deactivation.
 *
 * @package Mona\Faq
 */
final class Deactivator {

	/**
	 * Deactivate the plugin.
	 *
	 * @return void
	 */
	public static function deactivate(): void {
		if ( function_exists( 'flush_rewrite_rules' ) ) {
			flush_rewrite_rules();
		}
	}
}
