<?php
/**
 * Functions that don't require GravityView or Gravity Forms but are used in the plugin to extend PHP and WP functions
 * @since 1.12
 */

/**
 * Check whether a variable is not an empty string
 *
 * @see /templates/fields/product.php Used to check whether the product array is empty or not
 *
 * @since 1.12
 *
 * @param mixed $mixed Variable to check
 *
 * @return bool true: $mixed is *not* an empty string; false: $mixed *is* an empty string
 */
function gravityview_is_not_empty_string( $mixed = '' ) {
	return ( $mixed !== '' );
}

/**
 * Get `get_permalink()` without the home_url() prepended to it.
 *
 * get_permalink() does a lot of good stuff: it gets the correct permalink structure for custom post types, pages,
 * posts, etc. Instead of using `?p={id}`, `?page_id={id}`, or `?p={id}&post_type={post_type}`, by using
 * get_permalink(), we can use `?p=slug` or `?gravityview={slug}`
 *
 * We could do this in a cleaner fashion, but this prevents a lot of code duplication, checking for URL structure, etc.
 *
 * @param int|WP_Post $id        Optional. Post ID or post object. Default current post.
 *
 * @return array URL args, if exists. Empty array if not.
 */
function gravityview_get_permalink_query_args( $id = 0 ) {

	$parsed_permalink = parse_url( get_permalink( $id ) );

	$permalink_args =  isset( $parsed_permalink['query'] ) ? $parsed_permalink['query'] : false;

	if( empty( $permalink_args ) ) {
		return array();
	}

	parse_str( $permalink_args, $args );

	return $args;
}
/**
 * Get an image of our intrepid explorer friend
 * @return string HTML image tag with floaty's cute mug on it
 */
function gravityview_get_floaty() {

	if( is_rtl() ) {
		$style = 'margin:10px 10px 10px 0;';
		$class = 'alignright';
	} else {
		$style = 'margin:10px 10px 10px 0;';
		$class = 'alignleft';
	}

	return '<img src="'.plugins_url( 'assets/images/astronaut-200x263.png', GRAVITYVIEW_FILE ).'" class="'.$class.'" height="87" width="66" alt="The GravityView Astronaut Says:" style="'.$style.'" />';
}