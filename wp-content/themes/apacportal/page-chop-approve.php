<?php
$chop_request = get_posts(array('post_type'=>'chop_request', 'post_status'=>'private', 'meta_key'=>'approve_hash', 'meta_value'=>$_GET['key']))[0];

if(empty($chop_request)){
	$error = 'Invalid approve key. The request has probably been removed';
}

if(isset($_POST['status'])){
	
	add_post_meta($chop_request->ID, 'request_statuses', json_encode(array('user'=>get_post_meta($chop_request->ID, 'approver', true), 'value'=>$_POST['status'], 'time'=>time(), 'comments'=>$_POST['comments'])));
	update_post_meta($chop_request->ID, 'request_status', $_POST['status']);
	
	// TODO if rejected, generate a new hash key for employee to resubmit
	
	// send an email to approver
	$message = 'Dear employee,' . "\n\n"
			. 'Your Chop Request was ' . $_POST['status'] . '.' . "\n\n"
			. '	Request No.: ' . get_post_meta($chop_request->ID, 'request_no', true) . "\n"
			. '	Stamp Type: ' . get_post_meta($chop_request->ID, 'stamp_type', true) . "\n"
			. '	Legal Entity: ' . get_post_meta($chop_request->ID, 'legal_entity', true) . "\n"
			. '	Function / Department: ' . get_post_meta($chop_request->ID, 'department', true) . "\n"
			. '	Approver: ' . get_post_meta($chop_request->ID, 'approver', true) . "\n\n";
	
	$documents = json_decode(get_post_meta($chop_request->ID, 'documents', true));
	
	foreach($documents as $document){
		$message .= ($document->name . ' (' . $document->pages . ')' . "\n");
	}

	$result = mail(get_post_meta($chop_request->ID, 'requestor_email', true), 'Company Chop request approved #' . get_post_meta($chop_request->ID, 'request_no', true), $message, 'From: APAConnect <apaconnect@fcagroup.com>');
	
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
		<?php }else{ ?>
		<?php if($success){ ?>
		<div class="alert alert-success">Request has been <?=$_POST['status']?>.</div>
		<?php } ?>
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