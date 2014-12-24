<?php
$fields = json_decode(get_option('chop_request_fields'), JSON_OBJECT_AS_ARRAY);

$chop_request = null;

if(isset($_GET['request_key'])){
	$chop_request = get_posts(array('post_type'=>'chop_request', 'post_status'=>'private', 'meta_key'=>'request_hash', 'meta_value'=>$_GET['request_key']))[0];
	$application_id = $chop_request->ID;
}

if(isset($_POST['submit'])){
	try{
		
		$chop_request = null;
		// let's show post data rather than server data on failed submit
		
		foreach(json_decode(get_option('chop_request_fields'), JSON_OBJECT_AS_ARRAY) as $field => $label){
			if((!(is_array($fields[$field]) && $fields[$field]['type'] === 'checkbox')) && empty($_POST[$field])){
				throw new Exception('Please fill in "' . (is_array($label) ? $label['label'] : $label) . '"');
			}
		}
		
		foreach($_POST['documents']['name'] as $name){
			if(empty($name)){
				throw new Exception('Please fill in Name of Documents');
			}
		}
		
		// RFC 2822 user@example.com / User <user@example.com>
		$requestor_email = null;
		is_email(trim($_POST['requestor'])) && $requestor_email = trim($_POST['requestor']);
		preg_match('/\<(.*?)\>/', $_POST['requestor'], $matches);
		$matches && $requestor_email = $matches[1];
		unset($matches);
		
		if(empty($requestor_email)){
			throw new Exception('Not valid email format: ' . $_POST['requestor'].'. Please use Name &lt;suffix@fcagroup.com&gt;');
		}
		
		if(empty($_POST['is_on_exempt_list'])){
			
			if(empty($_POST['approver'])){
				throw new Exception('Please set approver.');
			}
			
			// RFC 2822 user@example.com / User <user@example.com>
			$approver_email = null;
			is_email(trim($_POST['approver'])) && $approver_email = trim($_POST['approver']);
			preg_match('/\<(.*?)\>/', $_POST['approver'], $matches);
			$matches && $approver_email = $matches[1];
			unset($matches);
			
			if(empty($approver_email)){
				throw new Exception('Not valid email format: ' . $_POST['approver'].'. Please use Name &lt;suffix@fcagroup.com&gt;');
			}
		}
		
		if(!isset($application_id)){
			
			$request_no = get_option('chop_request_last_no', 0) + 1;
			
			$application_id = wp_insert_post(array(
				'post_type'=>'chop_request',
				'post_title'=>'No.' . $request_no . ' ' . $_POST['requestor'] . ' - ' . $_POST['stamp_type'] . ' Request',
				'post_status'=>'private'
			));
			
			add_post_meta($application_id, 'request_no', $request_no);
			update_option('chop_request_last_no', $request_no);
		}
		
		update_post_meta($application_id, 'request_status', 'pending');
		
		update_post_meta($application_id, 'requestor_email', $requestor_email);
		
		if(empty($_POST['is_on_exempt_list'])){
			update_post_meta($application_id, 'approver', $_POST['approver']);
			update_post_meta($application_id, 'approver_email', $approver_email);
		}
		
		foreach($fields as $field => $label){
			if($field === 'documents'){
				$documents = array();
				for($i = 0; $i < count($_POST['documents']['name']); $i++){
					$documents[] = array('name'=>$_POST['documents']['name'][$i], 'pages'=>$_POST['documents']['pages'][$i]);
				}
				update_post_meta($application_id, $field, json_encode($documents, JSON_UNESCAPED_UNICODE));
			}else{
				update_post_meta($application_id, $field, $_POST[$field]);
			}
		}
		
		if(empty($_POST['is_on_exempt_list'])){
			
			// generate approval hash link
			$approve_hash = md5($application_id . $_POST['requestor'] . NONCE_SALT);
			update_post_meta($application_id, 'approve_hash', $approve_hash);

			// send an email to approver
			$message = 'Dear manager,' . "\n\n"
					. 'There\'s a company chop request pending your approval.' . "\n\n"
					. '	Request No.: ' . get_post_meta($application_id, 'request_no', true) . "\n"
					. '	Stamp Type: ' . $_POST['stamp_type'] . "\n"
					. '	Requestor: ' . $_POST['requestor'] . "\n"
					. '	Legal Entity: ' . $_POST['legal_entity'] . "\n"
					. '	Function / Department: ' . $_POST['department'] . "\n\n";
			
			foreach($documents as $document){
				$message .= ($document['name'] . ' (' . $document['pages'] . ')' . "\n");
			}
			
			$message .= "\n"
					. 'Please approve / reject in the following link: '
					. site_url() . '/chop-approve/?key=' . $approve_hash . "\n\n"
					. 'Please DO NOT REPLY this email. For technical support, please contact uice.lu@fcagroup.com ' . "\n"
					. 'Please DO NOT FORWARD this email to others, since it contains sensitive url link.';
			
			$result = mail($approver_email, 'Company Chop request pending your approval #' . $request_no, $message, 'From: APAConnect <apaconnect@fcagroup.com>');
			
			if($result === true){
				delete_post_meta($chop_request->ID, 'request_hash');
			}else{
				throw new Exception('Fail to send an email to: ' . $approver_email);
				// TODO what to do when request saved but email not sent?
			}
		}
		
		$success = 'Your request NO. is ' . get_post_meta($application_id, 'request_no', true) . '. We have sent an email to ' . $approver_email;
	
	}catch(Exception $e){
		$error = $e->getMessage();
	}
}

the_post();
get_header();
?>
<style type="text/css">
.form-horizontal .control-label { width: 300px; }
.form-horizontal .controls { margin-left: 320px; }
.form-horizontal .control-group-area { min-height: 285px; }
.box .content { background: url(http://apaconnect.fiat.chrysler.com/wp-content/uploads/2014/05/forms.png) no-repeat #FFF 80% 10%; }
</style>
<div class="site-content row-fluid" role="main">
	<div class="box">
		<header><?php the_title(); ?></header>
		<div class="content">
			<?php if($error){ ?>
			<div class="alert alert-error"><?=$error?></div>
			<?php } ?>
			<?php if($success){ ?>
			<div class="alert alert-success"><?=$success?></div>
			<?php } ?>
			<form class="form-horizontal" method="post">
				<div class="control-group-area">
					<?php foreach($fields as $field => $label){ ?>
					<div class="control-group">
						<label class="control-label"><?=is_array($label) ? $label['label'] : $label?></label>
						<div class="controls">
							<?php if(!is_array($label) || $label['type'] === 'text'){ ?>
								<?php if($field === 'documents'){ ?>
							<div class="documents">
								<?php foreach($chop_request ? json_decode(get_post_meta($chop_request->ID, 'documents', true)) : $_POST['documents']['name'] as $index => $document){ ?>
								<div class="document" style="margin-bottom:10px">
									<input type="text" name="documents[name][]" value="<?=$chop_request ? $document->name : $document?>">
									<div class="input-append">
										<input type="number" name="documents[pages][]" style="width:3em" value="<?=$chop_request ? $document->pages : $_POST['documents']['pages'][$index]?>">
										<span class="add-on">Pages</span>
									</div>
									<button type="button" class="btn remove-document"<?php if($index === 0){ ?> style="display:none"<?php } ?>><i class="icon-minus"></i>
								</div>
								<?php } ?>
								<?php if($chop_request ? !json_decode(get_post_meta($chop_request->ID, 'documents', true)) : empty($_POST['documents'])){ ?>
								<div class="document" style="margin-bottom:10px">
									<input type="text" name="documents[name][]">
									<div class="input-append">
										<input type="number" name="documents[pages][]" style="width:3em">
										<span class="add-on">Pages</span>
									</div>
									<button type="button" class="btn remove-document" style="display:none"><i class="icon-minus"></i>
								</div>
								<?php } ?>
								<div>
									<button type="button" class="btn add-document"><i class="icon-plus"></i></button>
								</div>
							</div>
								<?php }elseif($field === 'requestor'){ ?>
							<input type="text" id="requestor" name="requestor" value="<?=$chop_request ? get_post_meta($chop_request->ID, 'requestor', true) : $_POST['requestor']?>" autocomplete="off" style="width:315px" placeholder="Name <prefix@fcagroup.com>" />
							<label class="label label-info" style="display:none;margin-top:5px">We will update you the status. Please select or type in an email yourself. Format is "Name &lt;email@fcagroup.com&gt;"</label>
								<?php }else{ ?>
							<input type="text" name="<?=$field?>" value="<?=$chop_request ? get_post_meta($chop_request->ID, $field, true) : $_POST[$field]?>">
								<?php } ?>
							<?php }elseif($label['type'] === 'select'){ ?>
							<select name="<?=$field?>">
								<?php foreach($label['options'] as $option){ ?>
								<option value="<?=$option?>"<?php if($chop_request ? get_post_meta($chop_request->ID, $field, true) === $option : $_POST[$field] === $option){ ?> selected="selected"<?php } ?>><?=$option?></option>
								<?php } ?>
							</select>
							<?php }elseif($label['type'] === 'checkbox'){ ?>
							<label class="checkbox">
								<input type="checkbox" name="<?=$field?>"<?php if($chop_request ? get_post_meta($chop_request->ID, $field, true) : $_POST[$field]){ ?> checked="checked"<?php } ?>>
							</label>
							<?php }elseif($label['type'] === 'radio'){ ?>
								<?php foreach($label['options'] as $option_value => $option_label){ ?>
							<label class="radio">
								<input type="radio" name="<?=$field?>" value="<?=$option_label?>"<?php if($chop_request ? get_post_meta($chop_request->ID, $field, true) === $option_label : $_POST[$field] === $option_label){ ?> checked="checked"<?php } ?>>
								<?=$option_label?>
							</label>
								<?php } ?>
							<?php } ?>
						</div>
					</div>
					<?php } ?>
					<div class="control-group approver-section">
						<label class="control-label">Approver</label>
						<div class="controls">
							<input type="text" id="approver" name="approver" value="<?=$chop_request ? get_post_meta($chop_request->ID, 'approver', true) : $_POST['approver']?>" autocomplete="off" style="width:315px" placeholder="Name <prefix@fcagroup.com>" />
							<label class="label label-info" style="display:none;margin-top:5px">We will send an email to the approver. Please select or type in an email yourself. Format is "Name &lt;email@fcagroup.com&gt;"</label>
						</div>
					</div>
				</div>
				<div class="form-actions submit-section">
					<?php if(empty($success)){ ?>
					<button type="submit" name="submit" class="btn btn-primary">Submit</button>
					<?php } ?>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
jQuery(function($){
	
	$('.add-document').on('click', function(){
		$('.document:last').clone().find('input').val('').end().find('.remove-document').show().end().insertAfter('.document:last');
	});
	
	$('.documents').on('click', '.remove-document', function(){
		$(this).closest('.document').remove();
	});
	
	$('[name="is_on_exempt_list"]').on('change', function(){
		if(!$(this).is(':checked')){
			$('.approver-section').show().prop('disabled', false);
		}else{
			$('.approver-section').hide().prop('disabled', true);
		}
	});
	
	$('#requestor, #approver').on('focus', function(){
		$(this).siblings('.label').fadeIn(300);
	}).on('blur', function(){
		$(this).siblings('.label').fadeOut(300);
	}).typeahead({
		source: function(query, process){
			$.get('/user?s_user=' + query, function(result){
				process(result);
			})
		},
		minLength: 2,
		highlighter: function(item){
			return item;
		}
	});
	
});
</script>
<?php get_footer(); ?>
