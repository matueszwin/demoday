<?php
/**
 * Functions to extend the WP Rest API
 *
 * @package WordPress
 */

/**
 * Register custom fields for GET requests.
 *
 * Ref: https://developer.wordpress.org/reference/functions/register_rest_field/
 */
function product_api_response() {

	register_rest_field(
		array( 'product' ), // post types.
		'vue_meta', // name of the new key.
		array(
			'get_callback' => 'vue_get_post_acf',
			'update_callback' => null,
			'schema' => null,
		)
	);
}

/**
 * GET callback for the "vue_meta" field defined above.
 *
 * @param array $post_object Details of the current post.
 * @param string $field_name Field Name set in register_rest_field().
 * @param WP_REST_Request $request Current request.
 *
 * @return mixed
 */
function vue_get_post_acf( $post_object, $field_name, $request ) {

	// make additional fields available in the response using an associative array.
	$additional_post_data = array();
	$sizes_array = array();
	$term_links = array();

	$post_id = $post_object['id']; // get the post id.
	$sizes = $sizes = get_field('product_calculator', $post_id)['sizes'];

	foreach ( $sizes as $size) {
		$name = $size['name'];
		$multiplier = $size['multiplier'];

		array_push( $sizes_array, $name );
		array_push( $sizes_array, $multiplier );
	}

	// add categories, custom excerpt, featured image to the api response.

	$additional_post_data = array(
		'size' => $sizes_array,
		'quantiy' => $term_links,
	);

	// return data to the get_callback.
	// this data will be made available in the key "vue_meta".
	return $additional_post_data;
}
