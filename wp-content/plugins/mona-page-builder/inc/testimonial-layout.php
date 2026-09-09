<?php
/** Conditional Page Builder testimonial layout. */
declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return [
	'key' => 'layout_temoignage',
	'name' => 'temoignage',
	'label' => 'Témoignage',
	'display' => 'block',
	'sub_fields' => [
 	[
  	'key' => 'field_pb_testimonial_selection',
  	'label' => 'Témoignage',
  	'name' => 'testimonial',
  	'aria-label' => '',
  	'type' => 'post_object',
  	'instructions' => 'Sélectionnez un témoignage existant.',
  	'required' => 1,
  	'conditional_logic' => 0,
  	'wrapper' => [
   	'width' => '',
   	'class' => '',
   	'id' => ''
   ],
  	'post_type' => [
   	'testimonial',
   	'testimonials',
   	'temoignage',
   	'temoignages'
   ],
  	'taxonomy' => '',
  	'allow_null' => 0,
  	'multiple' => 0,
  	'return_format' => 'object',
  	'ui' => 1,
  	'ajax' => 1,
  	'placeholder' => 'Rechercher un témoignage…',
  	'allow_in_bindings' => 0
  ]
 ]
];
