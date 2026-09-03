<?php
/**
 * Plugin bootstrap.
 *
 * @package Mona\Faq
 */

declare(strict_types=1);

namespace Mona\Faq;

use Mona\Faq\Block\Faq as FaqBlock;
use Mona\Faq\PostType\Faq as FaqPostType;

/**
 * Main plugin class.
 *
 * @package Mona\Faq
 */
final class Plugin {

	/**
	 * FAQ post type instance.
	 *
	 * @var FaqPostType
	 */
	private FaqPostType $post_type;

	/**
	 * FAQ block instance.
	 *
	 * @var FaqBlock
	 */
	private FaqBlock $block;

	/**
	 * Plugin constructor.
	 */
	public function __construct() {
		$this->post_type = new FaqPostType();
		$this->block     = new FaqBlock();
	}

	/**
	 * Boot the plugin.
	 *
	 * @return void
	 */
	public static function boot(): void {
		$plugin = new self();
		$plugin->register();
	}

	/**
	 * Register the plugin components.
	 *
	 * @return void
	 */
	public function register(): void {
		$this->post_type->register();
		$this->block->register();

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
	}

	/**
	 * Enqueue FAQ assets.
	 *
	 * @return void
	 */
	public function enqueue_assets(): void {
		wp_enqueue_style(
			'mona-faq',
			MONA_FAQ_URL . 'assets/css/faq.css',
			array(),
			MONA_FAQ_VERSION
		);

		wp_enqueue_script(
			'mona-faq',
			MONA_FAQ_URL . 'assets/js/faq.js',
			array(),
			MONA_FAQ_VERSION,
			true
		);
	}
}
