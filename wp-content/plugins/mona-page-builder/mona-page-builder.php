<?php
/**
 * Plugin Name: Mona Page Builder
 * Description: Page Builder éditorial ACF Pro réutilisable pour les sites MonaGraphic.
 * Version: 2.1.26
 * Author: MonaGraphic
 * Text Domain: mona-page-builder
 * Requires at least: 6.5
 * Requires PHP: 8.1
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'MONA_PAGE_BUILDER_VERSION', '2.1.26' );
define( 'MONA_PAGE_BUILDER_PATH', plugin_dir_path( __FILE__ ) );
define( 'MONA_PAGE_BUILDER_URL', plugin_dir_url( __FILE__ ) );

require_once MONA_PAGE_BUILDER_PATH . 'inc/post-types.php';

require_once MONA_PAGE_BUILDER_PATH . 'inc/acf.php';
require_once MONA_PAGE_BUILDER_PATH . 'inc/wysiwyg.php';
require_once MONA_PAGE_BUILDER_PATH . 'inc/template-fallback.php';
require_once MONA_PAGE_BUILDER_PATH . 'inc/render.php';
require_once MONA_PAGE_BUILDER_PATH . 'inc/assets.php';

require_once MONA_PAGE_BUILDER_PATH . 'inc/admin.php';
