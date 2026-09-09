<?php

declare(strict_types=1);


/**
 * Whether the current admin post type uses the Mona Page Builder.
 */
function mona_page_builder_is_supported_post_type(): bool {
	$post_type = get_current_screen()?->post_type ?? '';

	return in_array( $post_type, mona_page_builder_post_types(), true );
}
