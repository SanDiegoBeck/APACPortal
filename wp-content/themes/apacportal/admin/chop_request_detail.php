<table class="form-table">
	<tbody>
		<?php foreach(json_decode(get_option('chop_request_fields'), JSON_OBJECT_AS_ARRAY) as $name => $label){ ?>
		<tr>
			<th><label><?=is_array($label) ? $label['label'] : $label?>: </label></th>
			<?php if(is_array($label) && $label['type'] === 'checkbox'){ ?>
			<td><?=get_post_meta($post->ID, $name, true) ? $label['label_on'] : $label['label_off']?></td>
			<?php }elseif($name === 'documents'){ ?>
				<td>
				<?php foreach(json_decode(get_post_meta($post->ID, $name, true)) as $document){ ?>
					<?=$document->name?>
					(<?=$document->pages?> pages) &nbsp;&nbsp;
				<?php } ?>
				</td>
			<?php }else{ ?>
			<td><?=get_post_meta($post->ID, $name, true)?></td>
			<?php } ?>
		</tr>
		<?php } ?>
		<tr>
			<th>Request Date: </th>
			<td><?=get_post($post->ID)->post_date?></td>
		</tr>
		<?php if(!get_post_meta($post->ID, 'is_on_exempt_list', true)){ ?>
		<tr>
			<th><label>Approval File: </label></th>
			<td><a href="<?=wp_get_attachment_url(get_post_meta($post->ID, 'approval_file_id', true))?>" target="_blank"><?=get_the_title(get_post_meta($post->ID, 'approval_file_id', true))?></a></td>
		</tr>
		<?php } ?>
	</tbody>
</table>