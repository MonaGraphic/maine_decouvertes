<?php

declare(strict_types=1);

defined('ABSPATH') || exit;

add_action(
    'acf/init',
    'mona_contributeurs_register_fields'
);

/**
 * Enregistre les champs ACF des contributeurs.
 */
function mona_contributeurs_register_fields(): void
{
    if (! function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group([
        'key' => 'group_mona_contributeur',
        'title' => 'Informations du contributeur',
        'fields' => [

            [
                'key' => 'field_contributor_excerpt',
                'label' => 'Accroche',
                'name' => 'contributor_excerpt',
                'type' => 'text',
            ],

            [
                'key' => 'field_contributor_address',
                'label' => 'Adresse',
                'name' => 'address',
                'type' => 'text',
            ],

            [
                'key' => 'field_contributor_postcode',
                'label' => 'Code postal',
                'name' => 'postcode',
                'type' => 'text',
            ],

            [
                'key' => 'field_contributor_city',
                'label' => 'Ville',
                'name' => 'city',
                'type' => 'text',
            ],

            [
                'key' => 'field_contributor_phone',
                'label' => 'Téléphone',
                'name' => 'phone',
                'type' => 'tel',
            ],

            [
                'key' => 'field_contributor_email',
                'label' => 'Email',
                'name' => 'email',
                'type' => 'email',
            ],

            [
                'key' => 'field_contributor_website',
                'label' => 'Site internet',
                'name' => 'website',
                'type' => 'url',
            ],

            [
                'key' => 'field_contributor_facebook',
                'label' => 'Facebook',
                'name' => 'facebook',
                'type' => 'url',
            ],

            [
                'key' => 'field_contributor_instagram',
                'label' => 'Instagram',
                'name' => 'instagram',
                'type' => 'url',
            ],

            [
                'key' => 'field_contributor_linkedin',
                'label' => 'LinkedIn',
                'name' => 'linkedin',
                'type' => 'url',
            ],
        ],

        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'contributeur',
                ],
            ],
        ],

        'position' => 'normal',
        'style' => 'default',
        'active' => true,
    ]);
}
