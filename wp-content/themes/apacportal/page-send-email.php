<?php
set_time_limit(0);

$receivers = json_decode(get_option('mail_receivers'));
$receivers_extra = json_decode(get_option('mail_receivers_extra'));
$mail_title = get_option('mail_title');

$concurrency = 200;

$message = wpautop(get_option('mail_content'));

foreach(array_chunk($receivers, $concurrency) as $index => $receivers_current){
	
	if($index === 0){
		$receivers_current = array_merge($receivers_current, $receivers_extra);
	}
	
//	$receivers_current = array();
//	$receivers_current[] = 'uice.lu@fcagroup.com';
//	$receivers_current[] = 'losero.silvia@fcagroup.com';
	
	$bcc_string = "\r\n" . 'Bcc: ' . implode(', ', $receivers_current);
	echo 'Sending email to ' . implode(', ', $receivers_current) . "\n";
//	$result = mail('', $mail_title, $message, "Content-type: text/html;\r\nFrom: APAC BETR <apac.betr@fcagroup.com>" . $bcc_string);
	echo 'Result: '; var_export($result);
	echo "\n";
//	error_log('sent email to group ' . ($index + 1));
	sleep(3);
}


