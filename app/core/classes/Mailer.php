<?php
/**
 * Theme Admin Class.
 *
 * Manages Admin functions
 *
 * @package Classy
 */

namespace Classy;

/**
 * Class Admin
 */
class Mailer {

	/**
	 * Admin constructor.
	 */
	public function __construct() {
        add_action('phpmailer_init',   [$this, 'registerSMTP']);
        add_action('admin_post_nopriv_send_contact', [$this, 'sendContact']);
        add_action('admin_post_send_contact', [$this, 'sendContact']);
        add_action('wp_ajax_nopriv_send_contact', [$this, 'sendContact']);
        add_action('wp_ajax_send_contact', [$this, 'sendContact']);
        add_filter( 'wp_mail_from', function() {
            return 'info@frazersfinerfoods.com';
        } );
    }

    public function registerSMTP($phpmailer) {
        $phpmailer->From = "info@frazerfinerfoods.com";
        $phpmailer->FromName = preg_replace('/(\'|&#0*39;)/', '', get_bloginfo('name'));
		$environment = get_field('fff_environment', 'option');
		if($environment == 'staging')
		{
	        $phpmailer->isSMTP();
	        $phpmailer->Host = 'mailtrap.io';
	        $phpmailer->SMTPAuth = true;
	        $phpmailer->Port = 2525;
	        $phpmailer->Username = '8661db25c9b5dd';
	        $phpmailer->Password = 'dde285839762da';
		}
    }

    public function sendContact()
    {
		$siteName = preg_replace('/(\'|&#0*39;)/', '', get_bloginfo('name'));
        $to = get_field('fff_send_emails_to', 'option');
        // $to = 'jeffsee.55@gmail.com';
		$subject = 'Message from ' . $siteName;
		$message = $this->buildMessage('alert', $_POST);
        $headers = [
            'Content-Type: text/html; charset=UTF-8'
        ];
        wp_mail( $to, $subject, $message, $headers, $attachments = array() );

        $to = $_POST['email'];
        $subject = $siteName;
		$message = $this->buildMessage('notice', $_POST);
        $headers = [
            'Content-Type: text/html; charset=UTF-8'
        ];
        wp_mail( $to, $subject, $message, $headers, $attachments = array() );

        wp_send_json_success('Thank you');
    }

	public function buildMessage($type, $data)
	{
		ob_start();
		include CLASSY_THEME_PATH . 'views/mailer/contact-' . $type . '.php';
		return ob_get_clean();
	}
}
