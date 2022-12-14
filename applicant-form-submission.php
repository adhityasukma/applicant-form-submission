<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             0.0.1
 * @package           Applicant_Form_Submission
 *
 * @wordpress-plugin
 * Plugin Name:       Applicant Form Submission by Adhitya
 * Plugin URI:        https://github.com/adhityasukma/applicant-form-submission
 * Description:       A form to collect Applicant information including a field to upload applicant CV and sending email notification.
 * Version:           0.0.1
 * Author:            Adhitya
 * Author URI:        https://adhityasukma.github.io/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       afs
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 0.0.1 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'AFS_VERSION', '0.0.1' );
define('AFS_FILE', __FILE__);
define('AFS_DIR', __DIR__);
define('AFS_ADMIN_DIR', plugin_dir_path(__FILE__) . '/admin');
define('AFS_PUBLIC_DIR', plugin_dir_path(__FILE__) . '/public');
define('AFS_INC_DIR', plugin_dir_path(__FILE__) . '/includes');
define('AFS_DIR_PATH', plugin_dir_path(__FILE__));
define('AFS_DIR_URL', plugin_dir_url(__FILE__));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-applicant-form-submission-activator.php
 */
function activate_applicant_form_submission() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-applicant-form-submission-activator.php';
	Applicant_Form_Submission_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-applicant-form-submission-deactivator.php
 */
function deactivate_applicant_form_submission() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-applicant-form-submission-deactivator.php';
	Applicant_Form_Submission_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_applicant_form_submission' );
register_deactivation_hook( __FILE__, 'deactivate_applicant_form_submission' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-applicant-form-submission.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    0.0.1
 */
function run_applicant_form_submission() {

	$plugin = new Applicant_Form_Submission();
	$plugin->run();

}
run_applicant_form_submission();
