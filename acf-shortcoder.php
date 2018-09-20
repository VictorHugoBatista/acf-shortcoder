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
    return secured_get_field($a['field'], $a['origin']);
});

add_shortcode('loop_repeater', function($atts, $iteration) {
    $a = shortcode_atts([
	    'field' => '',
	    'origin' => '',
    ], $atts);
    if ('' === $a['field']) {
	    return '';
    }
    if (secured_have_rows($a['field'], $a['origin'])) {
        ob_start();
        while (secured_have_rows($a['field'], $a['origin'])) {
            secured_the_row();
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
    return secured_get_sub_field($a['field']);
});

function secured_get_field($slug, $local = '') {
    return function_exists('get_field') ?
        get_field($slug, $local) : '';
}

function secured_get_sub_field($slug) {
    return function_exists('get_sub_field') ?
        get_sub_field($slug) : '';
}

function secured_have_rows($slug, $local = '') {
    return function_exists('have_rows') ?
        have_rows($slug, $local) : false;
}

function secured_the_row() {
    if (function_exists('the_row')) {
        the_row();
    }
}
