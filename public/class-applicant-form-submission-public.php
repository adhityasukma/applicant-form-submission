<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      0.0.1
 *
 * @package    Applicant_Form_Submission
 * @subpackage Applicant_Form_Submission/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Applicant_Form_Submission
 * @subpackage Applicant_Form_Submission/public
 * @author     Your Name <email@example.com>
 */
class Applicant_Form_Submission_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    0.0.1
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    0.0.1
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    0.0.1
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}
    public function applicant_form_view($atts, $content = null){
        include_once AFS_PUBLIC_DIR . '/partials/applicant-form-submission-public-display.php';
    }
    /**
     * Method from ajax afs_submission_submit
     * @since  0.0.1
     */
    public function afs_submission_submit()
    {
       global $wpdb;

//        check_ajax_referer( 'afs_security', 'security' );
//        check_ajax_referer( 'afs-nonce-security', 'nonce' );
        $nonce = isset($_POST['token_security']) ? $_POST['token_security'] : '';
        $first_name = isset($_POST['afs-nama-depan']) ? sanitize_text_field($_POST['afs-nama-depan']) : '';
        $last_name = isset($_POST['afs-nama-belakang']) ? sanitize_text_field($_POST['afs-nama-belakang']) : '';
        $address = isset($_POST['afs-address']) ? sanitize_text_field($_POST['afs-address']) : '';
        $email_address = isset($_POST['afs-email-address']) ? sanitize_email($_POST['afs-email-address']) : '';
        $mobile_phone = isset($_POST['afs-mobile-phone']) ? sanitize_text_field($_POST['afs-mobile-phone']) : '';
        $post_name = isset($_POST['afs-post-name']) ? trim($_POST['afs-post-name']) : '';
        $cv = isset($_POST['cv']) ? trim($_POST['cv']) : '';

        if ( ! filter_var( $email_address, FILTER_VALIDATE_EMAIL ) ) {
            $msg = __('Insert your email please', 'afs');
            $json = array(
                'msg' => $msg,
                'success' => false
            );

            wp_send_json_error($json);
        }

        if (wp_verify_nonce($_POST['token_security'], 'afs_security_form')) {
            $date = date("Y-m-d h:i:s");
            $result = $wpdb->query(
                $wpdb->prepare(
                    "INSERT INTO {$wpdb->prefix}applicant_submissions
      ( first_name, last_name, present_address, email_address, mobile_phone, post_name, cv, created_at )
      VALUES ( %s, %s,%s,%s,%s,%s,%s,%s)",
                    $first_name,
                    $last_name,
                    $address,
                    $email_address,
                    $mobile_phone,
                    $post_name,
                    $cv,
                    $date
                )
            );
            if($result){
                $to = $email_address;
                $subject = 'Successfully submitting the application';
                $body = "Thank you for your submission form";
                $headers[] = 'Content-type: text/html; charset=utf-8';
                $headers[] = 'From:' . get_bloginfo('admin_email');
                wp_mail( $to, $subject, $body, $headers );

                $msg = __('Successfully submitting the application', 'afs');
                $json = array(
                    'msg' => $msg,
                    'success' => true
                );
                wp_send_json($json);
            }
        }else{
            $msg = __('Error - unable to verify nonce, please try again.', 'afs');
            $json = array(
                'msg' => $msg,
                'success' => false
            );

            wp_send_json_error($json);
        }


//        if ($url_merchant) {
//            update_option("mld_merchant_api_url", $url_merchant);
//            $result_json['success'] = true;
//            $result_json['msg'] = __('Successfully save settings', 'merchant-learndash');
//            wp_send_json($result_json);
//        } else {
//            $result_json['success'] = false;
//            $result_json['msg'] = __('Sorry there was an error save settings. Please try again later', 'merchant-learndash');
//            wp_send_json_error($result_json);
//        }

        wp_die();
    }
	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    0.0.1
	 */
	public function enqueue_styles() {

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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/applicant-form-submission-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    0.0.1
	 */
	public function enqueue_scripts() {

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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/applicant-form-submission-public.js', array( 'jquery' ), $this->version, false );
        $localize_data = apply_filters(
            'afs_helper_localize_script',
            [
                'ajaxurl' => admin_url('admin-ajax.php'),
                'security' => wp_create_nonce('afs_security'),
                'admin_post' => admin_url('admin-post.php'),
                'error_nonce' => __('Error - unable to verify nonce, please try againXX.', 'afs')
            ]
        );

        wp_localize_script($this->plugin_name, 'afs_helper', $localize_data);
	}

}
