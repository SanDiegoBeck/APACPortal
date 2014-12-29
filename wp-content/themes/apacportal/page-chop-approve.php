<?php
$chop_request = get_posts(array('post_type'=>'chop_request', 'post_status'=>'private', 'meta_key'=>'approve_hash', 'meta_value'=>$_GET['key']))[0];

if(empty($chop_request)){
	$error = 'Invalid approve key. The request has probably been removed';
}

if(isset($_POST['status'])){
	
	$status = $_POST['status'];
	
	add_post_meta($chop_request->ID, 'request_statuses', json_encode(array('user'=>get_post_meta($chop_request->ID, 'approver', true), 'value'=>$status, 'time'=>time(), 'comments'=>$_POST['comments'])));
	update_post_meta($chop_request->ID, 'request_status', $status);
	
	if($status === 'rejected'){
		$request_hash = md5($chop_request->ID . $_POST['requestor'] . NONCE_SALT);
		add_post_meta($chop_request->ID, 'request_hash', $request_hash);
	}
	
	// send an email to requestor
	$message = 'Dear employee,' . "\n\n"
			. 'Your Chop Request was ' . $status . '.' . "\n\n"
			. '	Request No.: ' . get_post_meta($chop_request->ID, 'request_no', true) . "\n"
			. '	Stamp Type: ' . get_post_meta($chop_request->ID, 'stamp_type', true) . "\n"
			. '	Legal Entity: ' . get_post_meta($chop_request->ID, 'legal_entity', true) . "\n"
			. '	Function / Department: ' . get_post_meta($chop_request->ID, 'department', true) . "\n"
			. '	Approver: ' . get_post_meta($chop_request->ID, 'approver', true) . "\n\n";
	
	$documents = json_decode(get_post_meta($chop_request->ID, 'documents', true));
	
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
	
	$result = mail(get_post_meta($chop_request->ID, 'requestor_email', true), 'Company Chop request ' . $status . ' #' . get_post_meta($chop_request->ID, 'request_no', true), $message, 'From: APAConnect <apaconnect@fcagroup.com>');
	
	if($result === true){
		delete_post_meta($chop_request->ID, 'approve_hash');
		$success = true;
	}else{
		throw new Exception('Fail to send an email to: ' . get_post_meta($chop_request->ID, 'requestor_email', true));
		// TODO what to do when request saved but email not sent?
	}

}

get_header();
?>
<div class="box">
	<header>
		Stamp Chop Request Approval
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