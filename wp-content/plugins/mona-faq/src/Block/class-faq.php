<?php
/**
 * FAQ Gutenberg block.
 *
 * @package Mona\Faq
 */

declare(strict_types=1);

namespace Mona\Faq\Block;

/**
 * Registers the FAQ Gutenberg block.
 *
 * @package Mona\Faq
 */
final class Faq {

	/**
	 * Register the FAQ block.
	 *
	 * @return void
	 */
	public function register(): void {
		register_block_type(
			dirname( __DIR__, 2 ) . '/blocks/faq'
		);
	}
}
