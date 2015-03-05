<?php

$uda_steps = json_decode(get_option('uda_steps'));
$uda_levels = json_decode(get_option('uda_levels'));
$countries = json_decode(get_option('countries'));

if(isset($_POST['department_name'])){
	
	$department = get_posts(array('s'=>$_POST['department_name'], 'post_type'=>'function'))[0];
	
	$uda_approvers = json_decode(get_post_meta($department->ID, 'uda_approvers', true));
	
	$authorized_levels = array();
	
	foreach($uda_levels as $level){
		foreach($level->authorizations as $authorization){
			if($authorization->name === $_POST['affair'] && $_POST['amount'] <= $authorization->amount){
				$authorized_levels[sanitize_title($level->name)] = $authorization;
			}
		}
	}
	
}

get_header(); ?>

<div class="site-content row-fluid">
	<div class="box">
		<header><?php the_title(); ?></header>
		<div class="content">
			<form class="form-horizontal row-fluid" method="post">
				<div class="span6">
					<div class="control-group">
						<label class="control-label">Country</label>
						<div class="controls">
							<select name="country">
								<?php foreach($countries as $country){ ?>
								<option value="<?=$country->name?>"<?php if($_POST['country'] === $country->name){ ?> selected="selected"<?php } ?>><?=$country->name?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Legal Entity</label>
						<div class="controls">
							<select name="legal_entity">
								<?php foreach($countries[0]->companies as $company){ ?>
								<option value="<?=$company->name?>"<?php if($_POST['legal_entity'] === $company->name){ ?> selected="selected"<?php } ?>><?=$company->name?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Department</label>
						<div class="controls">
							<input type="text" name="department_name" value="<?=$_POST['department_name']?>" autocomplete="off">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Affair</label>
						<div class="controls">
							<select name="affair">
								<?php foreach($uda_levels[0]->authorizations as $authorization){ ?>
								<option value="<?=$authorization->name?>"<?php if($_POST['affair'] === $authorization->name){ ?> selected="selected"<?php } ?>><?=$authorization->name?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Amount</label>
						<div class="controls">
							<input name="amount" type="number" value="<?=$_POST['amount']?>">
						</div>
					</div>
				</div>
				<div class="span6">
					<?php foreach($uda_steps as $uda_step){ ?>
					<h4><?=$uda_step->approvers?></h4>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th>Amount</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($authorized_levels as $level_name => $authorization){ ?>
							<?php foreach($uda_approvers->{$uda_step->name}->$level_name as $approver_id){ ?>
							<?php $approver = get_userdata($approver_id); ?>
							<tr>
								<td><?=$approver->display_name?></td>
								<td><?=$approver->user_email?></td>
								<td><?=(isset($authorization->currency) ? $authorization->currency : 'USD') . ' ' . number_format($authorization->amount, 2)?></td>
							</tr>
							<?php } ?>
							<?php } ?>
						</tbody>
					</table>
					<?php } ?>
				</div>
				<div class="form-actions" style="clear:both">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	
	var countries = <?=json_encode($countries)?>;
	
	jQuery(function($){
		$('[name="country"]').on('change', function(){
			var country_selected = $(this).val();
			
			var country;
			
			for(var i = 0; i < countries.length; i++){
				if(countries[i].name === country_selected){
					country = countries[i];
					break;
				}
			}
			
			$('[name="legal_entity"]').empty();
			
			for(var i = 0; i < country.companies.length; i++){
				$('[name="legal_entity"]').append($('<option/>', {value: country.companies[i].name, text: country.companies[i].name}));
			}
		});
		
		$('[name="department_name"]').typeahead({
			source: function(query, process){
				$.get('<?=site_url()?>/department?department_name=' + query, function(result){
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