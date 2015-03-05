<table class="form-table">
	<tbody>
		<tr>
			<th>
				<label>Country</label>
			</th>
			<td>
				<select name="country">
					<?php foreach($countries as $country){ ?>
					<option value="<?=$country->name?>"><?=$country->name?></option>
					<?php } ?>
				</select>
			</td>
		</tr>
		<tr>
			<th>
				<label>Legal Entity</label>
			</th>
			<td>
				<select name="legal_entity">
					<?php foreach($countries[0]->companies as $company){ ?>
					<option value="<?=$company->name?>"><?=$company->name?></option>
					<?php } ?>
				</select>
			</td>
		</tr>
		<?php foreach($uda_levels as $level){ ?>
		<?php $level_name = sanitize_title($level->name); ?>
		<tr>
			<th>
				<label><?=$level->name?></label>
			</th>
			<td>
				<table class="authorization-table">
					<thead>
						<tr>
							<?php foreach($level->authorizations as $authorization){ ?>
							<th><?=$authorization->name?></th>
							<?php } ?>
						</tr>
					</thead>
					<tbody>
						<tr>
							<?php foreach($level->authorizations as $authorization){ ?>
							<td><?=(isset($authorization->currency) ? $authorization->currency : 'USD') . ' ' . number_format($authorization->amount, 2)?></td>
							<?php } ?>
						</tr>
					</tbody>
				</table>
				<?php foreach($uda_steps as $uda_step){ ?>
				<h4><?=$uda_step->approvers?></h4>
				<ul class="approvers <?=$uda_step->name?>">
					<?php foreach($uda_approvers->{$uda_step->name}->$level_name as $approver_id){ ?>
					<li>
						<?php $approver = get_userdata($approver_id); ?>
						<?php $approver->meta = get_user_meta($approver_id)?>
						<b><?=$approver->display_name?></b> &lt;<?=$approver->user_email?>&gt;
						<input type="hidden" name="<?=$level_name?>[<?=$uda_step->name?>][]" value="<?=$approver_id?>">
						<span class="remove dashicons dashicons-trash" target="<?=$approver_id?>"></span>
					</li>
					<?php } ?>
				</ul>
				<hr>
				<?php } ?>
				<div class="approver-add">
					<select name="approver_type">
						<?php foreach($uda_steps as $step){ ?>
						<option value="<?=$step->name?>"><?=$step->approvers?></option>
						<?php } ?>
					</select>
					<input type="text" class="user-finder code regular-text" placeholder="Search employee by name, email..." data-level="<?=$level_name?>">
				</div>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>

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
		
		$('.approvers').on('click', '.remove', function(){
			$(this).parent().remove();
		});
		
		var users = new Bloodhound({
			datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
			queryTokenizer: Bloodhound.tokenizers.whitespace,
			remote: '<?=site_url()?>/user?s_user=%QUERY&as_object'
		});

		users.initialize();

		$('.user-finder').typeahead(null, {
			displayKey: function(user){
				return user.name + ' <' + user.email + '>';
			},
			source: users.ttAdapter()
		}).on('typeahead:selected typeahead:autocompleted', function(event, user){
			
			if($('.approvers [value="' + user.id + '"]').length){
				return;
			}
			
			var levelName = $(this).data('level');
			var step = $(this).parents('.approver-add:first').find('[name="approver_type"]').val();
			$(this).parents('.approver-add:first')
				.siblings('.approvers.' + step)
				.append($('<li/>', {text: '<' + user.email + '>'})
				.prepend('<b>' + user.name + '</b>')
				.append('<input type="hidden" name="' + levelName + '[' + step + '][]" value="' + user.id + '"> <span class="remove dashicons dashicons-trash" target="' + user.id + '"></span>'));
		
			$(this).val('');
		}).on('blur', function(){
			$(this).val('');
		});
		
	});
</script>
<script type="text/javascript" src="<?=get_stylesheet_directory_uri()?>/js/typeahead.bundle.min.js"></script>

<style type="text/css">
	span.twitter-typeahead .tt-dropdown-menu {
	  position: absolute;
	  top: 100%;
	  left: 0;
	  z-index: 1000;
	  display: none;
	  float: left;
	  min-width: 160px;
	  padding: 5px 0;
	  margin: 2px 0 0;
	  list-style: none;
	  font-size: 14px;
	  text-align: left;
	  background-color: #ffffff;
	  border: 1px solid #cccccc;
	  border: 1px solid rgba(0, 0, 0, 0.15);
	  border-radius: 4px;
	  -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
	  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
	  background-clip: padding-box;
	}
	span.twitter-typeahead .tt-suggestion > p {
	  display: block;
	  padding: 3px 20px;
	  margin-bottom: 0px;
	  clear: both;
	  font-weight: normal;
	  line-height: 1.42857143;
	  color: #333333;
	  white-space: nowrap;
	}
	span.twitter-typeahead .tt-suggestion > p:hover,
	span.twitter-typeahead .tt-suggestion > p:focus {
	  color: #ffffff;
	  text-decoration: none;
	  outline: 0;
	  background-color: #428bca;
	}
	span.twitter-typeahead .tt-suggestion.tt-cursor {
	  color: #ffffff;
	  background-color: #428bca;
	}
	span.twitter-typeahead {
	  /*width: 100%;*/
	}
	.input-group span.twitter-typeahead {
	  display: block !important;
	}
	.input-group span.twitter-typeahead .tt-dropdown-menu {
	  top: 32px !important;
	}
	.input-group.input-group-lg span.twitter-typeahead .tt-dropdown-menu {
	  top: 44px !important;
	}
	.input-group.input-group-sm span.twitter-typeahead .tt-dropdown-menu {
	  top: 28px !important;
	}
	
	.authorization-table {
		border-collapse:collapse;  
		border-spacing:0; 
	}
	
	.authorization-table td, .authorization-table th {
		padding: 5px 10px;
		border: 1px #333 solid;
		border-right: 1px #333 solid;
	}
	.approver-add input.regular-text {
		width: 20em;
		height: 28px;
		border-radius: 5px;
		vertical-align: baseline !important;
	}
	.approvers .remove {
		font-size:16px;
		cursor:pointer;
	}
</style>
