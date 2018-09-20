<?php

/**
 * Plugin Name: ACF Shortcoder
 * Plugin URI: https://github.com/VictorHugoBatista/acf-shortcoder 
 * Description: Adiciona shortcode que implementa a função get_field do plugin ACF do wordpress (https://www.advancedcustomfields.com/).
 * Author: Victor Hugo Batista
 * Author URI: https://github.com/VictorHugoBatista 
 */

add_shortcode('get_field', function($atts) {
    $a = shortcode_atts([
	'field' => '',
	'origin' => '',
    ], $atts);
    if ('' === $a['field']) {
	return '';
    }
    return gf($a['field'], $a['origin']);
});

add_shortcode('loop_repeater', function($atts, $iteration) {
    $a = shortcode_atts([
	'field' => '',
	'origin' => '',
    ], $atts);
    if ('' === $a['field']) {
	return '';
    }
    if (have_rows($a['field'], $a['origin'])) {
	ob_start();
	while (have_rows($a['field'], $a['origin'])) {
	    the_row();
	    echo do_shortcode($iteration);
	}
	return ob_get_clean();
    }
});

add_shortcode('sub_field', function($atts) {
    $a = shortcode_atts([
	'field' => '',
    ], $atts);
    if ('' === $a['field']) {
	return '';
    }
    return get_sub_field($a['field']);
});

function gf($slug, $value = '') {
    if (function_exists('get_field')) {
	return get_field($slug, $value);
    }
}

