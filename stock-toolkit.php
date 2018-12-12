<?php
/*
Plugin Name: Stock Toolkit
Plugin URI: http://humayunbd.com
Description: Theme shortcode and visual composer addons here.
Version: 1.2
Author: Humayun Ahemed
Author URI: http://humayunbd.com
*/

// Exit if accessed directly
    if ( ! defined( 'ABSPATH' ) ) {
        exit; 
    }

// Define
define('STOCK_ACC_URL', WP_PLUGIN_URL . '/' . plugin_basename( dirname( __FILE__ ) ) . '/');
define('STOCK_ACC_PATH', plugin_dir_path( __FILE__ ));

function stock_get_slide_list(){
    $args = wp_parse_args( array(
            'post_type' => 'slide',
            'numberposts' => '-1'
     ));

    $posts = get_posts( $args);

    $post_options = array(esc_html__('-- selest slide--', 'stock-toolkit')=>'');
    if( $posts ) {
        foreach ($posts as $post){
            $post_options[$post->post_title] = $post->ID;
        }
    }
    return  $post_options;
}
// stock page list
function stock_get_page_list(){
    $args = wp_parse_args( array(
            'post_type' => 'page',
            'numberposts' => '-1'
     ));

    $posts = get_posts( $args);

    $post_options = array(esc_html__('-- selest page--', 'stock-toolkit')=>'');
    if( $posts ) {
        foreach ($posts as $post){
            $post_options[$post->post_title] = $post->ID;
        }
    }
    return  $post_options;
}

//Registar Slide custom post
add_action( 'init', 'stock_theme_custom_post' );
function stock_theme_custom_post() {
    register_post_type( 'slide',
        array(
            'labels' => array(
                'name' => __( 'slides' ),
                'singular_name' => __( 'slide' )
            ),
            'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
            'public' => false,
            'show_ui' => true,

        )
    );
    //project Custom post regiser
    register_post_type( 'project',
        array(
            'labels' => array(
                'name' => __( 'projects' ),
                'singular_name' => __( 'project' )
            ),
            'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
            'public' => true,
        )
    );
}

function stock_project_custom_post_taxonomy() {
    register_taxonomy(
        'project_cat',  
        'project',                  
        array(
            'hierarchical'          => true,
            'label'                 => 'Project Category',  
            'query_var'             => true,
            'show_admin_column'     => true,
            'rewrite'               => array(
                'slug'              => 'project-category', 
                'with_front'    => true 
                )
            )
    );
}
add_action( 'init', 'stock_project_custom_post_taxonomy');

// Print Shortcode in Widget
add_filter('widget_text', 'do_shortcode');

// Loading VC addons
require_once( STOCK_ACC_PATH . 'vc-addons/vc-blocks-load.php');

// Slides Shortcodes
require_once( STOCK_ACC_PATH . 'theme-shortcode/slides-shortcode.php');
// logo carousel Shortcodes
require_once( STOCK_ACC_PATH . 'theme-shortcode/logo-shortcode.php');
// Stock vervice box shortcode
require_once( STOCK_ACC_PATH . 'theme-shortcode/service-shortcode.php');

// Stock vervice box shortcode
require_once( STOCK_ACC_PATH . 'theme-shortcode/cta-shortcode.php');

// Stock button shortcode
require_once( STOCK_ACC_PATH . 'theme-shortcode/button-shortcode.php');

// Stock stact shortcode
require_once( STOCK_ACC_PATH . 'theme-shortcode/stac-shortcode.php');
// Stock stact shortcode
require_once( STOCK_ACC_PATH . 'theme-shortcode/testimunial-shortcode.php');
// Stock stact shortcode
require_once( STOCK_ACC_PATH . 'theme-shortcode/map-shortcode.php');

// Stock stact shortcode
require_once( STOCK_ACC_PATH . 'theme-shortcode/image-galry.php');
// Stock stact shortcode
require_once( STOCK_ACC_PATH . 'theme-shortcode/promo-mox-shortcode.php');
// Stock project shortcode
require_once( STOCK_ACC_PATH . 'theme-shortcode/projec-shortcode.php');

// Shortcodes depended on Visual Composer
include_once(ABSPATH . 'wp-admin/includes/plugin.php');
if (is_plugin_active( 'js_composer/js_composer.php' )) {
	require_once( STOCK_ACC_PATH . 'theme-shortcode/slides-shortcode.php');
    require_once( STOCK_ACC_PATH . 'theme-shortcode/logo-shortcode.php');
    require_once( STOCK_ACC_PATH . 'theme-shortcode/service-shortcode.php');
    require_once( STOCK_ACC_PATH . 'theme-shortcode/cta-shortcode.php');

}

// Registering stock toolkit files
function stock_toolkit_files(){
	wp_enqueue_style('owl-carousel', plugin_dir_url( __FILE__ ) . 'assets/css/owl.carousel.css');
	wp_enqueue_style('stock-toolkit-css', plugin_dir_url( __FILE__ ) . 'assets/css/stock-toolkit.css');
    wp_enqueue_script('gmap3', plugin_dir_url( __FILE__ ) . 'assets/js/gmap3.min.js', array('jquery'), '7.2.0', true) ;
    wp_enqueue_script('isotope', plugin_dir_url( __FILE__ ) . 'assets/js/isotope.min.js', array('jquery'), '3.0.6', true) ;
	wp_enqueue_script('owl-carousel', plugin_dir_url( __FILE__ ) . 'assets/js/owl.carousel.min.js', array('jquery'), '2.3.4', true) ;
}
add_action('wp_enqueue_scripts', 'stock_toolkit_files');
