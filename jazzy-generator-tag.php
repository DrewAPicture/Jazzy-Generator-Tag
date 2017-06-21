<?php
/**
 * Plugin Name: Jazzy Generator Tag
 * Plugin URI: https://wordpress.org/plugins/jazzy-generator-tag/
 * Description: Supplements your WordPress site's generator tag with the jazz artist your current version of WordPress was named after.
 * Author: Drew Jaynes
 * Author URI: http://werdswords.com
 * License: GPLv2
 * Version: 4.8.0
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
		/* translators: WordPress version string, e.g. 'WordPress 4.5'. Gender of the artist is male. */
		'1.0' => __( '%s to the sounds of Miles Davis',     'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. 'WordPress 4.5'. Gender of the artist is male. */
		'1.2' => __( '%s to the sounds of Charles Mingus',  'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. 'WordPress 4.5'. Gender of the artist is male. */
		'1.5' => __( '%s to the sounds of Billy Strayhorn', 'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. 'WordPress 4.5'. Gender of the artist is male. */
		'2.0' => __( '%s to the sounds of Duke Ellington',   'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. 'WordPress 4.5'. Gender of the artist is female. */
		'2.1' => __( '%s to the sounds of Ella Fitzgerald',  'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. 'WordPress 4.5'. Gender of the artist is male. */
		'2.2' => __( '%s to the sounds of Stan Getz',        'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. 'WordPress 4.5'. Gender of the artist is male. */
		'2.3' => __( '%s to the sounds of Dexter Gordon',    'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. 'WordPress 4.5'. Gender of the artist is male. */
		'2.5' => __( '%s to the sounds of Michael Brecker',  'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. 'WordPress 4.5'. Gender of the artist is male. */
		'2.6' => __( '%s to the sounds of McCoy Tyner',      'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. 'WordPress 4.5'. Gender of the artist is male. */
		'2.7' => __( '%s to the sounds of John Coltrane',    'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. 'WordPress 4.5'. Gender of the artist is male. */
		'2.8' => __( '%s to the sounds of Chet Baker',       'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. 'WordPress 4.5'. Gender of the artist is female. */
		'2.9' => __( '%s to the sounds of Carmen McRae',     'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. 'WordPress 4.5'. Gender of the artist is male. */
		'3.0' => __( '%s to the sounds of Thelonious Monk',  'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. 'WordPress 4.5'. Gender of the artist is male. */
		'3.1' => __( '%s to the sounds of Django Reinhardt', 'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. 'WordPress 4.5'. Gender of the artist is male. */
		'3.2' => __( '%s to the sounds of George Gershwin',  'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. 'WordPress 4.5'. Gender of the artist is male. */
		'3.3' => __( '%s to the sounds of Sonny Stitt',      'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. 'WordPress 4.5'. Gender of the artist is male. */
		'3.4' => __( '%s to the sounds of Grant Green',      'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. 'WordPress 4.5'. Gender of the artist is male. */
		'3.5' => __( '%s to the sounds of Elvin Jones',      'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. 'WordPress 4.5'. Gender of the artist is male. */
		'3.6' => __( '%s to the sounds of Oscar Peterson',   'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. 'WordPress 4.5'. Gender of the artist is male. */
		'3.7' => __( '%s to the sounds of Count Basie',      'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. 'WordPress 4.5'. Gender of the artist is male. */
		'3.8' => __( '%s to the sounds of Charlie Parker',   'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. 'WordPress 4.5'. Gender of the artist is male. */
		'3.9' => __( '%s to the sounds of Jimmy Smith',      'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. 'WordPress 4.5'. Gender of the artist is male. */
		'4.0' => __( '%s to the sounds of Benny Goodman',    'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. 'WordPress 4.5'. Gender of the artist is female. */
		'4.1' => __( '%s to the sounds of Dinah Washington', 'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. 'WordPress 4.5'. Gender of the artist is male. */
		'4.2' => __( '%s to the sounds of Bud Powell',       'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. 'WordPress 4.5'. Gender of the artist is female. */
		'4.3' => __( '%s to the sounds of Billie Holiday',   'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. 'WordPress 4.5'. Gender of the artist is male. */
		'4.4' => __( '%s to the sounds of Clifford Brown',   'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. 'WordPress 4.5'. Gender of the artist is male. */
		'4.5' => __( '%s to the sounds of Coleman Hawkins',  'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. 'WordPress 4.6'. Gender of the artist is male */
		'4.6' => __( '%s to the sounds of Pepper Adams', 'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. 'WordPress 4.7'. Gender of the artist is female */
		'4.7' => __( '%s to the sounds of Sarah Vaughan', 'jazzy-generator-tag' ),

		/* translators: WordPress version string, e.g. 'WordPress 4.8'. Gender of the artist is male */
		'4.8' => __( '%s to the sounds of William John Bill Evans', 'jazzy-generator-tag' ),
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
		/* translators: WordPress version string, e.g. 'WordPress 4.5'. Gender is neutral. */
		$jazzer_string = __( '%s to the sounds of jazz', 'jazzy-generator-tag' );
	}

	$jazzer = sprintf( $jazzer_string, 'WordPress ' . $wp_version );

	return '<meta content="' . esc_attr( $jazzer ) . '" name="generator">';
}
add_filter( 'get_the_generator_xhtml', 'jgt_generator_as_jazzer', 10, 2 );
