<?php
/**
 * Two Factor
 *
 * @package     Two_Factor
 * @author      Plugin Contributors
 * @copyright   2020 Plugin Contributors
 * @license     GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name: Two Factor (CUSTOMIZED, DO NOT UPDATE)
 * Plugin URI: https://wordpress.org/plugins/two-factor/
 * Description: DO NOT UPDATE, featuring internally generated QR codes and a frontend TOTP activation.
 * Author: Plugin Contributors
 * Version: 0.7.3.2
 * Author URI: https://github.com/wordpress/two-factor/graphs/contributors
 * Network: True
 * Text Domain: two-factor
 */

/**
 * Shortcut constant to the path of this file.
 */
define( 'TWO_FACTOR_DIR', plugin_dir_path( __FILE__ ) );

/**
 * Version of the plugin.
 */
define( 'TWO_FACTOR_VERSION', '0.7.3.2' );

/**
 * Set up the autoloader to handle classes in the includes directory.
 */
spl_autoload_register(function ($class) {
	$class = str_replace('\\', '/', $class);

	// First check that the class is one in our namespace
	if (strpos($class, 'TwoFactor/') !== 0) {
		return false;
	}

	// Then check if the corresponding file exists
	$class = str_replace('TwoFactor/', '', $class);
	$path = __DIR__ . '/includes/' . $class . '.php';

	// If the file exists, include it
	// Otherwise tell the autoloader we don't know about it
	if (file_exists($path)) {
		include $path;
		return true;
	} else {
		return false;
	}
});

/**
 * Include the base class here, so that other plugins can also extend it.
 */
require_once TWO_FACTOR_DIR . 'providers/class-two-factor-provider.php';

/**
 * Include the core that handles the common bits.
 */
require_once TWO_FACTOR_DIR . 'class-two-factor-core.php';

/**
 * A compatability layer for some of the most-used plugins out there.
 */
require_once TWO_FACTOR_DIR . 'class-two-factor-compat.php';

$two_factor_compat = new Two_Factor_Compat();

Two_Factor_Core::add_hooks( $two_factor_compat );
