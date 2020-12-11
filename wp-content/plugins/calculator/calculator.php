<?php
/*
Plugin Name: Calculator
Description: Calculator shortcode
Version: 1.0
*/

function handle_shortcode() {

	echo '<div id="mount"></div>';

}
add_shortcode('calculator', 'handle_shortcode');

function enqueue_scripts(){
	global $post;

	wp_enqueue_script('vue', 'https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js', [], '2.5.17');
	wp_enqueue_script('calculator', plugin_dir_url( __FILE__ ) . 'calculator.js', [], '1.0', true);

}