<?php
$user_args=array();

$current_user_meta = get_user_meta($current_user->ID);

if(isset($_GET['id'])){
	$user=get_userdata($_GET['id']);
	$user->meta=get_user_meta($_GET['id']);
}

$user_metas=array(
	'first_name'=>'First Name',
	'last_name'=>'Last Name',
	'telephone'=>'Telephone',
	'cellphone'=>'Cellphone',
	'department'=>'Department',
	'company_name'=>"Company",
	'working_site_country'=>'Working Site Country'
);

?>
<?php get_header(); ?>
<style tyle="text/css">
	tr.odd{
		background-color: #FAFAFA;
	}
</style>
<div id="primary" class="content-area">
	<div id="content" class="site-content row-fluid" role="main">
		<div class="span3">
			<?=do_shortcode('[sidebar id="left"]')?>
		</div>
		<div class="span9">
			<table class="box table table-bordered table-striped">
				<thead class="header">
					<th width="180px">&nbsp;</th>
					<th>&nbsp;</th>
				</thead>
				<tbody class="content">
					<tr>
						<td>First Name</td>
						<td><?=implode((array)$user->data->meta['first_name'])?></td>
					</tr>
					<tr>
						<td>Last Name</td>
						<td><?=implode((array)$user->data->meta['last_name'])?></td>
					</tr>
					<tr>
						<td>Telephone</td>
						<td><?=implode((array)$user->data->meta['telephone'])?></td>
					</tr>
					<tr>
						<td>Cellphone</td>
						<td><?=implode((array)$user->data->meta['cellphone'])?></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><?=$user->data->user_email?></td>
					</tr>
					<tr>
						<td>Department</td>
						<td><?=implode((array)$user->data->meta['department'])?></td>
					</tr>
					<tr>
						<td>Company Name</td>
						<td><?=implode((array)$user->data->meta['company_name'])?></td>
					</tr>
					<tr>
						<td>Working Site Country</td>
						<td><?=implode((array)$user->data->meta['working_site_country'])?></td>
					</tr>
				</tbody>
			</table>
			<label><i>Please contact your department's secretary for updating your information.</i></label>
			<?php if(
				current_user_can('remove_users') ||
				(current_user_can('edit_users_in_same_company') && $user->meta['company_name'] == $current_user_meta['company_name'])
			){?>
			<div class="pull-right">
				<a class="btn" href="/wp-admin/user-edit.php?user_id=<?=$user->data->ID?>" target="_blank">Edit "<?=$user->data->display_name?>"</a>
				<a id="remove-user" href="#remove-user-modal" class="btn btn-danger" data-toggle="modal">DELETE "<?=$user->data->display_name?>" PERMANENTLY</a>

				<div id="remove-user-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4>Confirm to Remove</h4>
					</div>
					<div class="modal-body">
						You're removing a user. This operation is unrecoverable. Are you sure?
					</div>
					<div class="modal-footer">
						<button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
						<a href="/user-remove/?ID=<?=$user->data->ID?>" class="btn btn-danger">DELETE "<?=$user->data->display_name?>" PERMANENTLY</a>
					</div>
				</div>	
			</div>
			<?php }?>
		</div>
	</div><!-- #content -->
</div><!-- #primary -->
<?php get_footer(); ?>

