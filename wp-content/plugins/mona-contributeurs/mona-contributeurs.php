<?php

declare(strict_types=1);

/**
 * Plugin Name: Mona Contributeurs
 * Description: Gestion des contributeurs de Maine Découvertes.
 * Version: 1.0.0
 * Author: Mona Graphic
 * Text Domain: mona-contributeurs
 */

defined('ABSPATH') || exit;
require_once __DIR__ . '/src/acf.php';

/**
 * Enregistre le CPT Contributeur.
 */
function mona_contributeurs_register_post_type(): void
{
    $labels = [
        'name'                  => __('Contributeurs', 'mona-contributeurs'),
        'singular_name'         => __('Contributeur', 'mona-contributeurs'),
        'menu_name'             => __('Contributeurs', 'mona-contributeurs'),
        'name_admin_bar'        => __('Contributeur', 'mona-contributeurs'),
        'add_new'               => __('Ajouter', 'mona-contributeurs'),
        'add_new_item'          => __('Ajouter un contributeur', 'mona-contributeurs'),
        'new_item'              => __('Nouveau contributeur', 'mona-contributeurs'),
        'edit_item'             => __('Modifier le contributeur', 'mona-contributeurs'),
        'view_item'             => __('Voir le contributeur', 'mona-contributeurs'),
        'all_items'             => __('Tous les contributeurs', 'mona-contributeurs'),
        'search_items'          => __('Rechercher un contributeur', 'mona-contributeurs'),
        'not_found'             => __('Aucun contributeur trouvé.', 'mona-contributeurs'),
        'not_found_in_trash'    => __('Aucun contributeur dans la corbeille.', 'mona-contributeurs'),
    ];

    register_post_type(
        'contributeur',
        [
            'labels'             => $labels,
            'public'             => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'show_in_rest'       => true,
            'menu_position'      => 20,
            'menu_icon'          => 'dashicons-groups',
            'has_archive'        => true,
            'rewrite'            => [
                'slug' => 'contributeurs',
            ],
            'supports'           => [
                'title',
                'editor',
                'thumbnail',
                'excerpt',
                'revisions',
            ],
            'show_in_nav_menus'  => true,
            'publicly_queryable' => true,
        ]
    );
}

add_action(
    'init',
    'mona_contributeurs_register_post_type'
);

/**
 * Enregistre la taxonomie des activités.
 */
function mona_contributeurs_register_taxonomy(): void
{
    $labels = [
        'name'              => __('Activités', 'mona-contributeurs'),
        'singular_name'     => __('Activité', 'mona-contributeurs'),
        'search_items'      => __('Rechercher une activité', 'mona-contributeurs'),
        'all_items'         => __('Toutes les activités', 'mona-contributeurs'),
        'edit_item'         => __('Modifier l’activité', 'mona-contributeurs'),
        'add_new_item'      => __('Ajouter une activité', 'mona-contributeurs'),
        'menu_name'         => __('Activités', 'mona-contributeurs'),
    ];

    register_taxonomy(
        'activite_contributeur',
        ['contributeur'],
        [
            'labels'            => $labels,
            'public'            => true,
            'show_ui'           => true,
            'show_in_rest'      => true,
            'hierarchical'      => true,
            'rewrite'           => [
                'slug' => 'activites',
            ],
        ]
    );
}

add_action(
    'init',
    'mona_contributeurs_register_taxonomy'
);
