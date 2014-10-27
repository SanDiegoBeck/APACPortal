<?php

$fields = json_decode(get_option('chop_request_fields'), JSON_OBJECT_AS_ARRAY);

if(isset($_POST['submit'])){
	try{
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
		
		if(empty($_POST['is_on_exempt_list']) && empty($_FILES['approval_file']['name'])){
			throw new Exception('Please upload approval file.');
		}
		
		if(empty($_POST['is_on_exempt_list'])){
			
			include_once ABSPATH . 'wp-admin/includes/media.php';
			include_once ABSPATH . 'wp-admin/includes/file.php';
			include_once ABSPATH . 'wp-admin/includes/image.php';

			$attachment_id = media_handle_upload('approval_file', 0);
			
			if(is_wp_error($attachment_id)){
				throw new Exception('Failed to upload approval file: ' . $attachment_id->get_error_message());
			}
			
		}
		
		$application_id = wp_insert_post(array(
			'post_type'=>'chop_request',
			'post_title'=>$_POST['requestor'] . ' - ' . $_POST['stamp_type'] . ' Request',
			'post_status'=>'private'
		));
		
		add_post_meta('request_status', 'pending');
		
		add_post_meta($application_id, 'approval_file_id', $attachment_id);
		
		foreach($fields as $field => $label){
			if($field === 'documents'){
				$documents = array();
				for($i = 0; $i < count($_POST['documents']['name']); $i++){
					$documents[] = array('name'=>$_POST['documents']['name'][$i], 'pages'=>$_POST['documents']['pages'][$i]);
				}
				add_post_meta($application_id, $field, json_encode($documents, JSON_UNESCAPED_UNICODE));
			}else{
				add_post_meta($application_id, $field, $_POST[$field]);
			}
		}
		
		$request_no = get_option('chop_request_last_no', 0) + 1;
		add_post_meta($application_id, 'request_no', $request_no);
		update_option('chop_request_last_no', $request_no);
		
		$success = 'Your request has been sent. Request NO. is ' . $request_no;
	
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
			<form class="form-horizontal" method="post" enctype="multipart/form-data">
				<div class="control-group-area">
					<?php foreach($fields as $field => $label){ ?>
					<div class="control-group">
						<label class="control-label"><?=is_array($label) ? $label['label'] : $label?></label>
						<div class="controls">
							<?php if(!is_array($label) || $label['type'] === 'text'){ ?>
								<?php if($field === 'documents'){ ?>
							<div class="documents">
								<?php foreach($_POST['documents']['name'] as $index => $name){ ?>
								<div class="document" style="margin-bottom:10px">
									<input type="text" name="documents[name][]" value="<?=$name?>">
									<div class="input-append">
										<input type="number" name="documents[pages][]" style="width:3em" value="<?=$_POST['documents']['pages'][$index]?>">
										<span class="add-on">Pages</span>
									</div>
									<button type="button" class="btn remove-document"<?php if($index === 0){ ?> style="display:none"<?php } ?>><i class="icon-minus"></i>
								</div>
								<?php } ?>
								<?php if(empty($_POST['documents'])){ ?>
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
								<?php }else{ ?>
							<input type="text" name="<?=$field?>" value="<?=$_POST[$field]?>">
								<?php } ?>
							<?php }elseif($label['type'] === 'select'){ ?>
							<select name="<?=$field?>">
								<?php foreach($label['options'] as $option){ ?>
								<option value="<?=$option?>"<?php if($_POST[$field] === $option){ ?> selected="selected"<?php } ?>><?=$option?></option>
								<?php } ?>
							</select>
							<?php }elseif($label['type'] === 'checkbox'){ ?>
							<label class="checkbox">
								<input type="checkbox" name="<?=$field?>"<?php if($_POST[$field]){ ?> checked="checked"<?php } ?>>
							</label>
							<?php }elseif($label['type'] === 'radio'){ ?>
								<?php foreach($label['options'] as $option_value => $option_label){ ?>
							<label class="radio">
								<input type="radio" name="<?=$field?>" value="<?=$option_label?>"<?php if($_POST[$field] === $option_label){ ?> checked="checked"<?php } ?>>
								<?=$option_label?>
							</label>
								<?php } ?>
							<?php } ?>
						</div>
					</div>
					<?php } ?>
					<div class="contro-group">
						<label class="control-label">Approval File Upload</label>
						<div class="controls">
							<input type="file" name="approval_file" />
						</div>
					</div>
				</div>
				<div class="form-actions">
					<button type="submit" name="submit" class="btn btn-primary">Submit</button>
					<button type="reset" class="btn">Reset</button>
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
});
</script>
<?php get_footer(); ?>
