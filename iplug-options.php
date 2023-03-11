<?php
defined('ABSPATH') || exit;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'iplug_options_page');
function iplug_options_page() {
    Container::make('theme_options', 'Iplug')
    ->add_fields([
        // checkbox remove emoji script option
        Field::make('checkbox', 'iplug_remove_emoji', 'Remove Emoji Script'),
        // checkbox remove generator meta tag option
        Field::make('checkbox', 'iplug_remove_generator', 'Remove Generator Meta Tag'),
        // checkbox remove wlwmanifest link option
        Field::make('checkbox', 'iplug_remove_wlwmanifest', 'Remove Wlwmanifest Link'),
        // checkbox remove rsd link option
        Field::make('checkbox', 'iplug_remove_rsd', 'Remove Rsd Link'),
        // checkbox remove shortlink option
        Field::make('checkbox', 'iplug_remove_shortlink', 'Remove Shortlink'),
        // checkbox remove xmlrpc option
        Field::make('checkbox', 'iplug_remove_xmlrpc', 'Remove Xmlrpc'),
        // checkbox remove wordpress version option
        Field::make('checkbox', 'iplug_remove_wp_version', 'Remove Wordpress Version'),
        // checkbox remove wordpress version option
        Field::make('checkbox', 'iplug_remove_thewp_version', 'Remove Wordpress Version'),


    ]);
}


// remove emoji
function iplug_remove_emoji() {
    $option = carbon_get_theme_option('iplug_remove_emoji');
    if ($option) {
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');
    }
}
add_action('wp', 'iplug_remove_emoji');

// remove generator meta tag
function iplug_remove_generator() {
    $option = carbon_get_theme_option('iplug_remove_generator');
    if ($option) {
        remove_action('wp_head', 'wp_generator');
    }
}
add_action('wp', 'iplug_remove_generator');



// remove wlwmanifest link

function iplug_remove_wlwmanifest() {
    $option = carbon_get_theme_option('iplug_remove_wlwmanifest');
    if ($option) {
        remove_action('wp_head', 'wlwmanifest_link');
    }
}
add_action('wp', 'iplug_remove_wlwmanifest');

// remove rsd link
function iplug_remove_rsd() {
    $option = carbon_get_theme_option('iplug_remove_rsd');
    if ($option) {
        remove_action('wp_head', 'rsd_link');
    }
}
add_action('wp', 'iplug_remove_rsd');


// remove shortlink
function iplug_remove_shortlink() {
    $option = carbon_get_theme_option('iplug_remove_shortlink');
    if ($option) {
        remove_action('wp_head', 'wp_shortlink_wp_head');
    }
}
add_action('wp', 'iplug_remove_shortlink');

// remove xmlrpc
function iplug_remove_xmlrpc() {
    $option = carbon_get_theme_option('iplug_remove_xmlrpc');
    if ($option) {
        add_filter('xmlrpc_enabled', '__return_false');
    }
}
add_action('wp', 'iplug_remove_xmlrpc');

// remove wordpress version
function iplug_remove_thewp_version() {
    $option = carbon_get_theme_option('iplug_remove_thewp_version');
    if ($option) {
        add_filter('the_generator', '__return_empty_string');
    }
}