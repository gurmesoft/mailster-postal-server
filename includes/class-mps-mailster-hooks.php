<?php
/**
 * This page contains Mailster hooks class.
 */


 /**
  * This class contains Mailster hooks
  */
class MPS_Mailster_Hooks {

	public function __construct() {
		add_filter( 'mailster_delivery_methods', array( $this, 'add_new_method' ) );
		add_action( 'mailster_deliverymethod_tab_postal', array( $this, 'method_tab' ) );

		if ( mailster_option( 'deliverymethod' ) == 'postal' ) {
			require_once MPS_PLUGIN_DIR_PATH . 'vendor/autoload.php';
			add_action( 'mailster_initsend', array( &$this, 'init_send' ) );
			add_action( 'mailster_presend', array( &$this, 'pre_send' ) );
			add_action( 'mailster_dosend', array( &$this, 'do_send' ) );
		}
	}

	/**
	 * Add Postal to delivery methods
	 *
	 * @param  array $delivery_methods
	 * @return array $delivery_methods
	 */
	public function add_new_method( $delivery_methods ) {
		$delivery_methods['postal'] = 'Postal';
		return $delivery_methods;
	}

	/**
	 * Postal method settings tab
	 *
	 * @return void
	 */
	public function method_tab() {
		include MPS_PLUGIN_DIR_PATH . '/views/tab.php';
	}

	public function init_send( $mail_object ) {
		$mail_object->dkim = false;
	}

	public function pre_send( $mail_object ) {

		$mail_object->pre_send();
		// @codingStandardsIgnoreStart
		$recipients     = array();
		$message_obj    = array();
		$data           = array(
			'mailster_id'   => mailster_option( 'ID' ),
			'campaign_id'   => (string) $mail_object->campaignID,  
			'index'         => (string) $mail_object->index,        
			'subscriber_id' => (string) $mail_object->subscriberID, 
		);
		// @codingStandardsIgnoreEnd
		$data = json_encode( $data );
		$data = base64_encode( $data );

		$message_obj['EventPayload'] = $data;

		foreach ( $mail_object->to as $i => $to ) {
			$recipients[] = array(
				'Email' => $mail_object->to[ $i ],
				'Name'  => $mail_object->to_name[ $i ],
			);
		}

		$message_obj['From'] = array(
			'Email' => $mail_object->from,
			'Name'  => $mail_object->from_name,
		);

		$message_obj['To']          = $recipients;
		$message_obj['Subject']     = $mail_object->subject;
		$message_obj['TextPart']    = $mail_object->mailer->AltBody;
		$message_obj['HTMLPart']    = $mail_object->mailer->Body;
		$message_obj['Headers']     = array( 'Reply-To' => $mail_object->reply_to );

		if ( $mail_object->headers ) {
			foreach ( $mail_object->headers as $key => $value ) {
				$message_obj['Headers'][ $key ] = $value;
			}
		}

		if ( ! empty( $mail_object->attachments ) || $mail_object->embed_images ) {

			$org_attachments                   = $mail_object->mailer->getAttachments();
			$message_obj['Attachments']        = array();
			$message_obj['InlinedAttachments'] = array();

			foreach ( $org_attachments as $attachment ) {

				$a = array(
					'ContentType'   => $attachment[6],
					'Filename'      => $attachment[1],
					'Base64Content' => base64_encode( file_get_contents( $attachment[0] ) ),
				);

				if ( 'inline' == $attachment[6] ) {
					$message_obj['HTMLPart']             = str_replace( '"cid:' . $attachment[7] . '"', '"cid:' . $attachment[1] . '"', $message_obj['HTMLPart'] );
					$message_obj['InlinedAttachments'][] = $a;
				} else {
					$message_obj['Attachments'][] = $a;
				}
			}
		}
	}

	public function do_send( $mail_object ) {

		ini_set( 'display_errors', 1 );
		ini_set( 'display_startup_errors', 1 );
		error_reporting( E_ALL );

		try{
				
		
		$domain     = mailster_option( 'postal_domain' );
		$api        = mailster_option( 'postal_api_key' );

		if ( ! $domain || ! $api ) {
			$mail_object->set_error( __( 'Postal settings are empty please check your api and domain', 'mailster-postal' ) );
			$mail_object->sent = false;
		} else {
			$client     = new \Postal\Client( $domain, $api );
			$message    = new \Postal\SendMessage( $client );

			// $message->from( $mail_object->from );
			$message->from( "dede@mail.com" );
			$message->subject( $mail_object->subject );
			$message->htmlBody( $mail_object->content );
			$message->plainBody( $mail_object->plaintext );

			foreach ( $mail_object->to as $address ) {
				$message->to( $address );
			}

			if ( is_array( $mail_object->cc ) && ! empty( $mail_object->cc ) ) {
				foreach ( $mail_object->cc as $address ) {
					$message->cc( $address );
				}
			}

			if ( is_array( $mail_object->bcc ) && ! empty( $mail_object->bcc ) ) {
				foreach ( $mail_object->bcc as $address ) {
					$message->bcc( $address );
				}
			}

			$result = $message->send();

			var_dump( $result );
			die;
		}
	}
		// try {
		// } catch ( Exception $e ) {
		// 	$mail_object->set_error( $e->getMessage() );
		// 	$mail_object->sent = false;
		// }

	}
}
