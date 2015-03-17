<?php

$workhour_request = get_posts(array('post_type'=>'workhour_request', 'post_status'=>'private', 'meta_key'=>'approve_hash', 'meta_value'=>$_GET['key']))[0];

if(empty($workhour_request)){
	$error = 'Invalid approve key. The request has probably been removed';
}

if(isset($_POST['status'])){
	
	$status = $_POST['status'];
	
	$status_data = array('user_id'=>get_post_meta($workhour_request->ID, 'approver_id', true), 'name'=>$status, 'time'=>time(), 'comments'=>$_POST['comments']);
	add_post_meta($workhour_request->ID, 'statuses', json_encode());
	update_post_meta($workhour_request->ID, 'status', $status);
	
	if($status === 'rejected'){
		$request_hash = md5($workhour_request->ID . $_POST['requestor'] . NONCE_SALT);
		add_post_meta($workhour_request->ID, 'request_hash', $request_hash);
	}
	
	// send an email to requestor
	$message = 'Dear employee,' . "\n\n"
			. 'Your ' . get_post_meta($workhour_request->ID, 'type', true) . ' leave request was ' . $status . '.' . "\n\n"
			. '	Approver: ' . get_post_meta($workhour_request->ID, 'approver_name', true) . "\n\n";
	
	$documents = json_decode(get_post_meta($workhour_request->ID, 'documents', true));
	
	foreach($documents as $document){
		$message .= ($document->name . ' (' . $document->pages . ')' . "\n");
	}
	
	if($_POST['comments']){
		$message .= "\n"
				. 'Approval comments: '
				. $_POST['comments']
				. "\n";
	}

	if($status === 'rejected'){
		$message .= "\n"
				. 'Please revise your request in the following link: '
				. site_url() . '/chop-request-mail-approve/?request_key=' . $request_hash . "\n\n"
				. 'Please DO NOT REPLY this email. For technical support, please contact uice.lu@fcagroup.com ' . "\n"
				. 'Please DO NOT FORWARD this email to others, since it contains sensitive url link.';
	}
	
	$result = mail(get_post_meta($workhour_request->ID, 'requestor_email', true), 'leave request ' . $status, $message, 'From: APAConnect <apaconnect@fcagroup.com>');
	
	if($result === true){
		delete_post_meta($workhour_request->ID, 'approve_hash');
		$success = true;
	}else{
		throw new Exception('Fail to send an email to: ' . get_post_meta($workhour_request->ID, 'requestor_email', true));
		// TODO what to do when request saved but email not sent?
	}

}

get_header();
?>
<div class="box">
	<header>
		Leave / Overtime Approval
	</header>
	<div class="content">
		<?php if($error){ ?>
		<div class="alert alert-error"><?=$error?></div>
		<?php }elseif($success){ ?>
		<div class="alert alert-success">Request has been <?=$status?>.</div>
		<?php }else{ ?>
		<form method="post" class="form-horizontal">
			<div class="control-group">
				<label class="control-label">
					Comments
				</label>
				<div class="controls">
					<textarea name="comments" rows="8" style="width:500px" placeholder="Write your comments..."></textarea>
				</div>
			</div>
			<div class="form-actions">
				<button type="submit" name="status" value="approved" class="btn btn-primary">Approve</button>
				<button type="submit" name="status" value="rejected" class="btn btn-danger">Reject</button>
			</div>
		</form>
		<?php } ?>
	</div>
</div>
<?php get_footer(); ?>