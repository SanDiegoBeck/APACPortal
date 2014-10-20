<div class="misc-pub-section">
	<label>Request Status：</label>
	<span>
		<select name="request_status">
			<?php foreach(json_decode(get_option('chop_request_statuses'), JSON_OBJECT_AS_ARRAY) as $value => $label){ ?>
			<option<?=selected(get_post_meta($post->ID, 'request_status', true) === $value)?> value="<?=$value?>"><?=$label?></option>
			<?php } ?>
		</select>
	</span>
	<textarea name="request_status_change_comments" placeholder="Comments" style="margin-top:10px;width:100%"></textarea>
	<?php foreach(get_post_meta($post->ID, 'request_statuses') as $status){ ?>
	<?php $status = json_decode($status); ?>
	<hr>
	<div style="font-weight:bold">
		<?=date('Y-m-d', $status->time)?>
		<?=json_decode(get_option('chop_request_statuses'), JSON_OBJECT_AS_ARRAY)[$status->value]?>
		<?=$status->user?>
	</div>
	<div><?=$status->comments?></div>
	<?php } ?>
</div>