<?php

$fields_plain_text = array('name_en'=>'English Name', 'name_cn'=>'Chinese Name', 'email'=>'Email', 'location'=>'Location', 'organization'=>'Organization', 'department'=>'Department', 'direct_manager'=>'Direct Manager', 'hire_date'=>'Hire Date (with Fiat Chrysler)');
$fields_multi_line = array('reason'=>'Tell us why you want to participate in the program, and what you hope to archive', 'expectation'=>'What do you expect from your Mentor');

$fields = array_merge($fields_plain_text, $fields_multi_line);



if(isset($_POST['submit'])){
	try{
		foreach($fields as $field => $label){
			if(empty($_POST[$field])){
				throw new Exception('Please fill in "' . $label . '"');
			}
		}
	}catch(Exception $e){
		$error = $e->getMessage();
	}
	
	$application_id = wp_insert_post(array(
		'post_type'=>'form_data',
		'post_title'=>$_POST['name_en'] . ' - Mentor Program Application'
	));
	
	foreach($fields as $field => $label){
		add_post_meta($application_id, $field, $_POST[$field]);
	}
	
	$success = 'Congratulations! Your application was accepted.';
	
}
the_post();
get_header();
?>
<style type="text/css">
.form-horizontal .control-label { width: 300px; }
.form-horizontal .controls { margin-left: 320px; }
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
				<?php foreach($fields_plain_text as $field => $label){ ?>
				<div class="control-group">
					<label class="control-label"><?=$label?></label>
					<div class="controls">
						<input type="text" name="<?=$field?>" value="<?=$_POST[$field]?>">
					</div>
				</div>
				<?php } ?>
				<?php foreach($fields_multi_line as $field => $label){ ?>
				<div class="control-group">
					<label class="control-label"><?=$label?></label>
					<div class="controls">
						<textarea name="<?=$field?>" class="span5" rows="6"><?=$_POST[$field]?></textarea>
					</div>
				</div>
				<?php } ?>
				<div class="form-actions">
					<button type="submit" name="submit" class="btn btn-primary">Apply</button>
					<button type="reset" class="btn">Reset</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php get_footer(); ?>
