<?php

if(isset($_POST['email'])){
	
	// find the user
	
	// RFC 2822 user@example.com / User <user@example.com>
	preg_match('/\<(.*?)\>/', $_POST['email'], $matches);
	$email = $matches ? $matches[1] : $_POST['email'];
	unset($matches);
	
	$user = get_user_by('email', $email);

	if(!$user){
		throw new Exception('User not found for E-Mail address: ' . $email);
	}

	// generate a one time auth key for a user
	$key = md5($_POST['email'] . time() . NONCE_SALT);
	
	update_user_meta($user->ID, 'auth_key', $key);
	
	// send a email to this user
	$message = 'Hi ' . $user->first_name . ',' . "\n\n".
			'You\'re attempting to login into APAConnect portal using account: ' . $user->user_email . '. Click the link below to finish.' . "\n\n".
			site_url() . '/email-login?key=' . $key . '&forward=' . urlencode($_POST['redirectTo']) . "\n\n";

	mail($user->user_email, 'Sign in APAConnect portal!', $message, 'From: APAConnect <apaconnect@fcagroup.com>');
}

if(isset($_GET['key'])){
	
	$auth_key = $_GET['key'];
	
	// find the user
	$user = get_users(array('meta_key'=>'auth_key', 'meta_value'=>$auth_key))[0];
	
	if(!$user){
		throw new Exception('User not found for auth key: ' . $auth_key);
	}

	// login the user
	wp_set_auth_cookie($user->ID, true);
	
	// destroy the key
	delete_user_meta($user->ID, 'auth_key');
	
	header('Location: ' . urldecode($_GET['forward']));
	
}
