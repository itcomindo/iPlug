<?php
defined('ABSPATH') || exit;

function iplugin_disable_xmlrpc($methods) {
    unset($methods['pingback.ping']);
    unset($methods['pingback.extensions.getPingbacks']);
    unset($methods['system.multicall']);
    unset($methods['system.listMethods']);
    unset($methods['system.getCapabilities']);
    return $methods;
}
add_filter('xmlrpc_methods', 'iplugin_disable_xmlrpc');

