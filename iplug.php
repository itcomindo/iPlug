<?php
/*
Plugin Name: Iplug
*/


$devDir = dirname(__FILE__);

// included css from plugin dir
function iplug_js_css() {
    wp_enqueue_style('dev-helper-css', plugins_url('css.css', __FILE__));
    wp_enqueue_script('dev-helper-js', plugins_url('js.js', __FILE__), array('jquery'), '1.0.0', true);
}
//add_action('wp_enqueue_scripts', 'dev_helper_css');
//add_action('admin_enqueue_scripts', 'dev_helper_css');

// page options
require_once $devDir . '/iplug-options.php';

// hide wordpress version
require_once $devDir . '/hide-wordpress-version.php';

// disable xmlrpc
require_once $devDir . '/disable-xmlrpc.php';
