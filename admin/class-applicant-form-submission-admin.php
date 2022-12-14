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
        wp_add_dashboard_widget('dashboard_widget', 'Applicant Form Submission by Adhitya', array($this, 'asf_dashboard_widget_view'));
    }

    /**
     * Display a new dashboard widget.
     * From function afs_dashboard_setup
     */
    public function asf_dashboard_widget_view()
    {
        $result = get_all_submission();
        include_once AFS_ADMIN_DIR . '/partials/applicant-form-submission-widget-dashboard.php';
    }

    /**
     * Add a new admin menu page.
     */
    public function afs_admin_page()
    {
        $parent_slug = "afs";
        $domain_slug = "afs";
        add_menu_page(__('Applicant Form Submission', $domain_slug), __('Applicant Form Submission', $domain_slug), 'manage_options', $parent_slug, array($this, 'afs_page'));
    }

    /**
     * Display a admin menu page.
     */
    public function afs_page()
    {
        include_once AFS_ADMIN_DIR . '/partials/applicant-form-submission-admin-display.php';
    }

    public function afs_redirect()
    {
        if (isset($_POST['afs-search'])) {
            $security = isset($_POST['token_security']) ? sanitize_text_field($_POST['token_security']) : '';
            $search = isset($_POST['s']) ? trim($_POST['s']) : '';
            $url = isset($_POST['_wp_http_referer']) ? $_POST['_wp_http_referer'] : '';
            if (wp_verify_nonce($security, 'afs_security_search_form')) {
                if ($url) {
                    delete_transient("afs_delete_submission");
                    $url = add_query_arg("s", $search, $url);
                    wp_redirect($url);
                }
            }
        }
        if (isset($_GET['action']) && isset($_GET['_afsnonce']) && isset($_GET['id'])) {
            if ($_GET['action'] === "delete") {
                global $wpdb;
                $security = $_GET['_afsnonce'];
                if (wp_verify_nonce($security, 'afs_security')) {
                    if ($_GET['id']) {
                        $id = $_GET['id'];
                        $wpdb->delete("{$wpdb->prefix}applicant_submissions", array('ID' => $id), array('%d'));
                        if (!$wpdb->show_errors()) {
                            set_transient("afs_delete_submission", "Data berhasil dihapus", 5);
                        } else {
                            set_transient("afs_delete_submission", "Data gagal dihapus", 5);
                        }

                        $url = admin_url("?page=afs");
                        wp_redirect($url);
                    }
                }
            }
        }
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
