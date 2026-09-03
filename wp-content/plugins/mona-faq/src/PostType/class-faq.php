<?php
/**
 * FAQ custom post type.
 *
 * @package Mona\Faq
 */

declare(strict_types=1);

namespace Mona\Faq\PostType;

/**
 * Registers the FAQ custom post type.
 *
 * @package Mona\Faq
 */
final class Faq {

	/**
	 * Register the FAQ custom post type.
	 *
	 * @return void
	 */
	public function register(): void {
		$labels = array(
			'name'               => _x( 'FAQ', 'Post Type General Name', 'mona-faq' ),
			'singular_name'      => _x( 'FAQ', 'Post Type Singular Name', 'mona-faq' ),
			'add_new'            => __( 'Ajouter une FAQ', 'mona-faq' ),
			'add_new_item'       => __( 'Ajouter une FAQ', 'mona-faq' ),
			'edit_item'          => __( 'Modifier la FAQ', 'mona-faq' ),
			'new_item'           => __( 'Nouvelle FAQ', 'mona-faq' ),
			'view_item'          => __( 'Voir la FAQ', 'mona-faq' ),
			'view_items'         => __( 'Voir les FAQ', 'mona-faq' ),
			'search_items'       => __( 'Rechercher une FAQ', 'mona-faq' ),
			'not_found'          => __( 'Aucune FAQ trouvée', 'mona-faq' ),
			'not_found_in_trash' => __( 'Aucune FAQ dans la corbeille', 'mona-faq' ),
			'all_items'          => __( 'Toutes les FAQ', 'mona-faq' ),
			'menu_name'          => __( 'FAQ', 'mona-faq' ),
		);

		$args = array(
			'labels'              => $labels,
			'description'         => __( 'FAQ de type bloc d’information.', 'mona-faq' ),
			'public'              => false,
			'publicly_queryable'  => false,
			'exclude_from_search' => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => false,
			'show_in_admin_bar'   => false,
			'show_in_rest'        => true,
			'rest_base'           => 'faqs',
			'menu_icon'           => 'dashicons-editor-help',
			'menu_position'       => 20,
			'supports'            => array( 'title', 'editor', 'page-attributes' ),
			'has_archive'         => false,
			'rewrite'             => false,
			'query_var'           => false,
			'capability_type'     => 'post',
			'show_in_graphql'     => false,
			'can_export'          => true,
		);

		register_post_type( 'faq', $args );
	}
}
