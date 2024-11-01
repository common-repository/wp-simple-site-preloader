<?php
/*
Plugin Name: WP Simple Site Preloader
Plugin URI:  http://gouravrr.com/
Description: This plugin will add Customizable, simple, non-image and compatible to all browsers pre-loader to your site
Version:     2.0.0
Author:      Gourav RR
Author URI:  https://gouravrr.wordpress.com/

Copyright 2020 Gourav RR (email : gourav090990@gmail.com)
WP Simple Site Preloader is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
WP Simple Site Preloader is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with WP Simple Site Preloader. If not, see http://gouravrr.com/.
*/

/*Include WP Simple Site Preloader settings page*/
include __DIR__ . '/wpssl-options.php';

global $loader_state, $background_color, $outer_color, $middle_color, $inner_color;

$loader_state = esc_attr( get_option('wpssl_loader_state') );
$background_color = esc_attr( get_option('wpssl_background_color') );
$outer_color = esc_attr( get_option('wpssl_outer_color') );
$middle_color = esc_attr( get_option('wpssl_middle_color') );
$inner_color = esc_attr( get_option('wpssl_inner_color') );

/*Add loader image html & js in head*/
function wpssl_add_loader_img_html_js() {
    global $loader_state, $background_color, $outer_color, $middle_color, $inner_color;

    if($loader_state=='1') {
        echo '<div class="loader-wrapper"><div class="loader"></div></div>';
        echo '<script type="text/javascript">jQuery(document).ready(function($){$(window).load(function(){$("body").addClass("page-loaded");});});</script>';
        echo '<style type="text/css">';
        if(!empty($background_color)) {
            echo '.loader-wrapper{background: '.$background_color.';}';
        }
        if(!empty($outer_color)) {
            echo '.loader{border-top-color: '.$outer_color.';border-right-color: '.$outer_color.';}';
        }
        if(!empty($middle_color)) {
            echo '.loader:before{border-top-color: '.$middle_color.';border-right-color: '.$middle_color.';}';
        }
        if(!empty($inner_color)) {
            echo '.loader:after{border-top-color: '.$inner_color.';border-right-color: '.$inner_color.';}';
        }
        echo '</style>';
    } 
}
add_action( 'wp_head','wpssl_add_loader_img_html_js' );


/*Load frontend styles*/
function wpssl_add_frontend_scripts() {
    if ( ! wp_script_is( 'jquery', 'enqueued' )) {
        wp_enqueue_script( 'jquery' );
    }

    wp_register_style( 'wpssl-styles', plugin_dir_url( __FILE__ ) . 'wpssl-styles.css' );
    wp_enqueue_style( 'wpssl-styles' );
}
add_action( 'wp_enqueue_scripts', 'wpssl_add_frontend_scripts' );


/*Load admin js*/
function wpssl_load_admin_js() {
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wpssl-admin-js', plugin_dir_url( __FILE__ ) . 'wpssl-admin-js.js', array( 'wp-color-picker' ), '', true );
}
add_action( 'admin_enqueue_scripts', 'wpssl_load_admin_js' );