<?php

	// Get some important variables
	require_once( '../config.php' );

	// Check Mailchimp
	if( !class_exists('Drewm_MailChimp') ) {
	    require_once( 'mailchimp.php' );
	}

	if( isset($_POST['subscribe']) ) {
		$Subscriber_Email = trim( $_POST['subscribe'] );

		if( filter_var( $Subscriber_Email, FILTER_VALIDATE_EMAIL ) ) {

			$MailChimp = new MailChimp($Mailchimp_API_Key);
			$Settings = $MailChimp->call('lists/subscribe', array(
				'id'                => trim($Mailchimp_List_ID),
				'email'             => array( 'email' => $Subscriber_Email ),
				// 'merge_vars'        => array('FNAME'=>'Davy', 'LNAME'=>'Jones'),
				'double_optin'      => $Mailchimp_Double_OptIn,
				'update_existing'   => true,
				'replace_interests' => false,
				'send_welcome'      => $Mailchimp_Welcome,
			));

		}
		else {
			throw new Exception("Request failed\n\n".json_encode($Settings));
			exit;
		}
	}

?>