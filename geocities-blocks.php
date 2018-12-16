<?php
/**
 * Plugin Name: GeoCities Blocks
 * Plugin URI: https://github.com/melchoyce/geocities-blocks
 * Description:
 * Version: 0.0.1
 * Author: TBD
 * Text Domain: geocities-blocks
 */

defined( 'ABSPATH' ) || die();

define( 'GEOCITIES_VERSION', '0.0.1' );
define( 'GEOCITIES_DEV_MODE', true );

/**
 * Load up the assets if Gutenberg is active.
 */
function geocities_initialize() {
	if ( function_exists( 'register_block_type' ) ) {
		add_action( 'init', 'geocities_register_block' );
	}
}
add_action( 'plugins_loaded', 'geocities_initialize' );

/**
 * Register blocks with their scripts.
 */
function geocities_register_block() {
	register_block_type( 'geocities/example', array(
		'editor_script' => 'geocities-example-block',
		'editor_style'  => 'geocities-example-block',
	) );
	
	// Register more blocks here.
}

/**
 * Register the scripts & styles needed.
 */
function geocities_gutenberg_scripts() {
	wp_register_script(
		'geocities-example-block',
		plugins_url( 'build/example-block.js', __FILE__ ),
		array( 'wp-element', 'wp-blocks', 'wp-components', 'wp-i18n' ),
		geocities_get_file_version( 'build/example-block.js' )
	);
	wp_register_style(
		'geocities-example-block',
		plugins_url( 'build/example-block.css', __FILE__ ),
		array(),
		geocities_get_file_version( 'build/example-block.css' )
	);
	
	// Register more block scripts & styles here.
}
add_action( 'enqueue_block_editor_assets', 'geocities_gutenberg_scripts' );

/**
 * Get the file modified time if we're using SCRIPT_DEBUG.
 *
 * @param string $file Local path to the file.
 */
function geocities_get_file_version( $file ) {
	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
		return filemtime( plugin_dir_path( __FILE__ ) . $file );
	}
	return GEOCITIES_VERSION;
}

/**
 * Add a new category for Geocities blocks.
 */
function geocities_register_block_category( $categories ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'geocities',
				'title' => __( 'GeoCities', 'geocities-blocks' ),
			),
		)
	);
}
add_filter( 'block_categories', 'geocities_register_block_category' );