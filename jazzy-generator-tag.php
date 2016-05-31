<?php
/**
 * Plugin Name: Jazzy Generator Tag
 * Plugin URI: https://wordpress.org/plugins/jazzy-generator-tag/
 * Description: Supplements your WordPress site's generator tag with the jazz artist your current version of WordPress was named after.
 * Author: Drew Jaynes
 * Author URI: http://werdswords.com
 * License: GPLv2
 * Version: 1.0.0
 * Text Domain: jazzy-generator-tag
 * Domain Path: /languages/
 */

/**
 * Converts WordPress versions to include jazz musicians in the generator tag.
 *
 * @since 1.0.0
 *
 * @param string $tag  The generator meta tag.
 * @param string $type The type of page to generate the tag for.
 * @return string The filtered generator meta tag.
 */
function jgt_generator_as_jazzer( $tag, $type ) {

	// Jazz musicians as correspond to their respective release versions.
	$jazzers = array(
		/* translators: WordPress version string, e.g. WordPress 4.5 */
		'1.0' => _x( '%s to the sounds of Miles Davis',      'gender: male',   'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. WordPress 4.5 */
		'1.2' => _x( '%s to the sounds of Charles Mingus',   'gender: male',   'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. WordPress 4.5 */
		'1.5' => _x( '%s to the sounds of Billy Strayhorn',  'gender: male',   'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. WordPress 4.5 */
		'2.0' => _x( '%s to the sounds of Duke Ellington',   'gender: male',   'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. WordPress 4.5 */
		'2.1' => _x( '%s to the sounds of Ella Fitzgerald',  'gender: female', 'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. WordPress 4.5 */
		'2.2' => _x( '%s to the sounds of Stan Getz',        'gender: male',   'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. WordPress 4.5 */
		'2.3' => _x( '%s to the sounds of Dexter Gordon',    'gender: male',   'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. WordPress 4.5 */
		'2.5' => _x( '%s to the sounds of Michael Brecker',  'gender: male',   'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. WordPress 4.5 */
		'2.6' => _x( '%s to the sounds of McCoy Tyner',      'gender: male',   'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. WordPress 4.5 */
		'2.7' => _x( '%s to the sounds of John Coltrane',    'gender: male',   'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. WordPress 4.5 */
		'2.8' => _x( '%s to the sounds of Chet Baker',       'gender: male',   'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. WordPress 4.5 */
		'2.9' => _x( '%s to the sounds of Carmen McRae',     'gender: female', 'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. WordPress 4.5 */
		'3.0' => _x( '%s to the sounds of Thelonious Monk',  'gender: male',   'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. WordPress 4.5 */
		'3.1' => _x( '%s to the sounds of Django Reinhardt', 'gender: male',   'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. WordPress 4.5 */
		'3.2' => _x( '%s to the sounds of George Gershwin',  'gender: male',   'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. WordPress 4.5 */
		'3.3' => _x( '%s to the sounds of Sonny Stitt',      'gender: male',   'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. WordPress 4.5 */
		'3.4' => _x( '%s to the sounds of Grant Green',      'gender: male',   'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. WordPress 4.5 */
		'3.5' => _x( '%s to the sounds of Elvin Jones',      'gender: male',   'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. WordPress 4.5 */
		'3.6' => _x( '%s to the sounds of Oscar Peterson',   'gender: male',   'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. WordPress 4.5 */
		'3.7' => _x( '%s to the sounds of Count Basie',      'gender: male',   'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. WordPress 4.5 */
		'3.8' => _x( '%s to the sounds of Charlie Parker',   'gender: male',   'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. WordPress 4.5 */
		'3.9' => _x( '%s to the sounds of Jimmy Smith',      'gender: male',   'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. WordPress 4.5 */
		'4.0' => _x( '%s to the sounds of Benny Goodman',    'gender: male',   'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. WordPress 4.5 */
		'4.1' => _x( '%s to the sounds of Dinah Washington', 'gender: female', 'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. WordPress 4.5 */
		'4.2' => _x( '%s to the sounds of Bud Powell',       'gender: male',   'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. WordPress 4.5 */
		'4.3' => _x( '%s to the sounds of Billie Holiday',   'gender: female', 'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. WordPress 4.5 */
		'4.4' => _x( '%s to the sounds of Clifford Brown',   'gender: male',   'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. WordPress 4.5 */
		'4.5' => _x( '%s to the sounds of Coleman Hawkins',  'gender: male',   'jazzy-generator-tag' ),
	);

	$wp_version = get_bloginfo( 'version' );

	// Grab the first three digits of the version string, e.g. '4.6'
	$wp_version_sub = substr( $wp_version, 0, 3 );

	/*
	 * Retrieve the jazzer string for the current version of WordPress,
	 * or use a generic string if no match was found.
	 */
	if ( array_key_exists( $wp_version_sub, $jazzers ) ) {
		$jazzer_string = $jazzers[ $wp_version_sub ];
	} else {
		/* translators: WordPress version string, e.g. WordPress 4.5 */
		$jazzer_string = __( '%s to the sounds of jazz', 'jazzy-generator-tag' );
	}

	$jazzer = sprintf( $jazzer_string, 'WordPress ' . $wp_version );

	return '<meta content="' . esc_attr( $jazzer ) . '" name="generator">';
}
add_filter( 'get_the_generator_xhtml', 'jgt_generator_as_jazzer', 10, 2 );
