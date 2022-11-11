<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      0.0.1
 *
 * @package    Applicant_Form_Submission
 * @subpackage Applicant_Form_Submission/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Applicant_Form_Submission
 * @subpackage Applicant_Form_Submission/admin
 * @author     Your Name <email@example.com>
 */
class Applicant_Form_Submission_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    0.0.1
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    0.0.1
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $plugin_name The name of this plugin.
     * @param string $version The version of this plugin.
     * @since    0.0.1
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Add a new dashboard widget.
     */
    public function afs_dashboard_setup()
    {
        wp_add_dashboard_widget('dashboard_widget', 'Applicant Form Submission by Adhitya', array($this,'asf_dashboard_widget_view'));
    }
    /**
     * Display a new dashboard widget.
     * From function afs_dashboard_setup
     */
    public function asf_dashboard_widget_view()
    {
       echo "afs_dashboard_setup";
    }
    /**
     * Add a new admin menu page.
     */
    public function afs_admin_page()
    {
        $parent_slug ="afs";
        $domain_slug ="afs";
        add_menu_page(__('Applicant Form Submission', $domain_slug), __('Applicant Form Submission', $domain_slug), 'manage_options', $parent_slug, array($this, 'afs_page'));
    }
    /**
     * Display a admin menu page.
     */
    public function afs_page(){
        include_once AFS_ADMIN_DIR . '/partials/applicant-form-submission-admin-display.php';
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    0.0.1
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Applicant_Form_Submission_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Applicant_Form_Submission_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/applicant-form-submission-admin.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    0.0.1
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Applicant_Form_Submission_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Applicant_Form_Submission_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/applicant-form-submission-admin.js', array('jquery'), $this->version, false);

    }

}
