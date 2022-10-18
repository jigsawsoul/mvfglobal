<?php

/**
 * Plugin Name:     MVF Golbal
 * Description:     Fullstack developer tech test
 * Version:         1.0.0
 * Author:          Richard Howse
 * Author URI:      https://github.com/jigsawsoul
 * Github:          jigsawsoul/mvfgobal
 */

if (!defined('WPINC')) {
    die;
}

define('MVF_GLOBAL_VERSION', '1.1.4');
define('MVF_GLOBAL_PATH', plugin_dir_path(__FILE__));
define('MVF_GLOBAL_URL', plugin_dir_url(__FILE__));

if (!file_exists($composer = __DIR__ . '/vendor/autoload.php')) {
    wp_die('Error locating autoloader. Please run <code>composer install</code>.');
}

require $composer;

new \MVFGlobal\Bootstrap();
