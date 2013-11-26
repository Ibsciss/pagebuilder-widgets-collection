<?php
/**
 * Plugin Name: Page Builder widgets collection
 * Plugin URI: http://www.ibsciss.com/wordpress/pagebuilder-widgets-collection
 * Description: A widgets collection for the SiteOrigin's Page Builder
 * Version: 0.9
 * Author: Ibsciss
 * Author URI: http://www.ibsciss.com
 * License: MIT
 */

/*
 * Define plugin paths and urls.
 */
if(!defined('IBSCISS_PLUGIN_PATH_PBWC')) define('IBSCISS_PLUGIN_PATH_PBWC',  plugin_dir_path( __FILE__ ));
if(!defined('IBSCISS_PLUGIN_URL_PBWC')) define('IBSCISS_PLUGIN_URL_PBWC', plugins_url('/').'pagebuilder-widgets-collection/');
if(!defined('IBSCISS_PLUGIN_RESOURCES_PATH_PBWC')) define('IBSCISS_PLUGIN_RESOURCES_PATH_PBWC', IBSCISS_PLUGIN_PATH_PBWC.'Ibsciss/Wordpress/Resources');
if(!defined('IBSCISS_PLUGIN_RESOURCES_URL_PBWC')) define('IBSCISS_PLUGIN_RESOURCES_URL_PBWC', IBSCISS_PLUGIN_URL_PBWC.'Ibsciss/Wordpress/Resources');

function ibsciss_register_files($fileName){ require_once IBSCISS_PLUGIN_PATH_PBWC.'Ibsciss/Wordpress/'.$fileName.'.php'; }
function ibsciss_register_service($serviceName){ ibsciss_register_files('Services/'.$serviceName); }

/*
 * include necessary files
 */
ibsciss_register_service('Template');
ibsciss_register_service('Validate');
ibsciss_register_service('Input');
ibsciss_register_service('WidgetInput');
ibsciss_register_files('Widgets/Widget');

/*
 * register widgets
 */
\Ibsciss\Wordpress\Widgets\Widget::register('Heading');
\Ibsciss\Wordpress\Widgets\Widget::register('Separator');
\Ibsciss\Wordpress\Widgets\Widget::init();
