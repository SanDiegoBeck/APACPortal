<?php

$fields = array('requestor'=>'Requestor Name', 'legal_entity'=>'Legal Entity', 'department'=>'Function/Department', 'document_name'=>'Name of Documents', 'is_on_exempt_list'=>array('type'=>'checkbox', 'label'=>'Is the doc on the Exempt List'));

if(isset($_POST['submit'])){
	try{
		foreach($fields as $field => $label){
			if((!(is_array($fields[$field]) && $fields[$field]['type'] === 'checkbox')) && empty($_POST[$field])){
				throw new Exception('Please fill in "' . $label . '"');
			}
		}
	
		$application_id = wp_insert_post(array(
			'post_type'=>'company_stamp_request',
			'post_title'=>$_POST['requestor'] . ' - Company Stamp Request'
		));

		foreach($fields as $field => $label){
			add_post_meta($application_id, $field, $_POST[$field]);
		}

		$success = 'Your request has been sent.';
	
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
							<input type="text" name="<?=$field?>" value="<?=$_POST[$field]?>">
							<?php }elseif($label['type'] === 'checkbox'){ ?>
							<label class="checkbox">
								<input type="checkbox" name="<?=$field?>"<?php if($_POST[$field]){ ?> checked="checked"<?php } ?>>
							</label>
							<?php } ?>
						</div>
					</div>
					<?php } ?>	
				</div>
				<div class="form-actions">
					<button type="submit" name="submit" class="btn btn-primary">Submit</button>
					<button type="reset" class="btn">Reset</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php get_footer(); ?>
