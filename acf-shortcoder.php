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

function gf($slug, $value = '') {
    if (function_exists('get_field')) {
	return get_field($slug, $value);
    }
}

