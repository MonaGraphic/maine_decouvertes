<?php
/**
 * Plugin Name:       Mona FAQ
 * Description:       Gestion et affichage des questions fréquentes.
 * Version:           0.1.0
 * Requires at least: 6.8
 * Requires PHP:      8.3
 * Author:            MonaGraphic
 * License:           GPL-2.0-or-later
 * Text Domain:       mona-faq
 * Domain Path:       /languages
 *
 * @package Mona\Faq
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'MONA_FAQ_VERSION' ) ) {
	define( 'MONA_FAQ_VERSION', '0.1.0' );
}

if ( ! defined( 'MONA_FAQ_FILE' ) ) {
	define( 'MONA_FAQ_FILE', __FILE__ );
}

if ( ! defined( 'MONA_FAQ_PATH' ) ) {
	define( 'MONA_FAQ_PATH', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'MONA_FAQ_URL' ) ) {
	define( 'MONA_FAQ_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'MONA_FAQ_TEXTDOMAIN' ) ) {
	define( 'MONA_FAQ_TEXTDOMAIN', 'mona-faq' );
}

require_once __DIR__ . '/vendor/autoload.php';

register_activation_hook(
	__FILE__,
	array( '\Mona\Faq\Lifecycle\Activator', 'activate' )
);

register_deactivation_hook(
	__FILE__,
	array( '\Mona\Faq\Lifecycle\Deactivator', 'deactivate' )
);

add_action(
	'plugins_loaded',
	array( '\Mona\Faq\Plugin', 'boot' )
);
