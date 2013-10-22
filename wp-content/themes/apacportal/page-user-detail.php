<?php
$user_args=array();

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
	'company_name'=>"Company Name",
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
			<?get_sidebar('left')?>
		</div>
		<div class="span9">
			<table class="box table-bordered">
				<thead class="header">
					<th width="180px">Item</th>
					<th>Value</th>
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
		</div>
	</div><!-- #content -->
</div><!-- #primary -->
<?wp_reset_query()?>
<?php get_footer(); ?>

