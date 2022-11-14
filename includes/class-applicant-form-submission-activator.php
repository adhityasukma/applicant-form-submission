<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      0.0.1
 *
 * @package    Applicant_Form_Submission
 * @subpackage Applicant_Form_Submission/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      0.0.1
 * @package    Applicant_Form_Submission
 * @subpackage Applicant_Form_Submission/includes
 * @author     Your Name <email@example.com>
 */
class Applicant_Form_Submission_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    0.0.1
	 */
	public static function activate() {
        self::create_tables();
	}
    /**
     * Create necessary tables
     *
     * @since 0.0.1
     *
     * @return void
     */
    public static function create_tables() {
        include_once ABSPATH . 'wp-admin/includes/upgrade.php';
        self::create_applicant_submissions_table();
    }
    /**
     * Create applicant_submissions table
     * @since 0.0.1
     * @return void
     */
    public static function create_applicant_submissions_table() {
        global $wpdb;

        $sql = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}applicant_submissions` (
                    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                    `first_name` varchar(255) NULL,
                    `last_name` varchar(255) DEFAULT NULL,
                    `present_address` text NULL,
                    `email_address` varchar(255) DEFAULT NULL,
                    `mobile_phone` varchar(255) DEFAULT NULL,
                    `post_name` varchar(255) DEFAULT NULL,
                    `cv` varchar(255) DEFAULT NULL,
                    `created_at` datetime DEFAULT NULL,
                    PRIMARY KEY (`id`)
               ) ENGINE=InnoDB {$wpdb->get_charset_collate()};";

        dbDelta( $sql );
    }
}
