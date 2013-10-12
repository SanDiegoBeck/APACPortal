<?php
$user_args=array();

if(isset($_GET['s_user'])){
	$user_args['meta_value']=$_GET['s_user'];
	$user_args['group']=true;
	$user_args['meta_compare']='LIKE';
}

$users=get_users($user_args);

array_walk($users, function(&$user){
	$user->meta=get_user_meta($user->id);
});

?>
<?php get_header(); ?>
<div id="primary" class="content-area">
	<div id="content" class="site-content row-fluid" role="main">
		<div class="span3">
			<?get_sidebar()?>
		</div>
		<div class="span9">
			<table class="box">
				<thead class="header">
					<th>Name</th>
					<th>Department</th>
					<th>Phone</th>
					<th>Email</th>
				</thead>
				<tbody class="content">
<?foreach($users as $user){?>
					<tr>
						<td><?=$user->data->meta['first_name'][0]?> <?=$user->data->meta['last_name'][0]?></td>
						<td><?=$user->data->meta['department'][0]?></td>
						<td><?=$user->data->meta['phone'][0]?></td>
						<td><?=$user->data->user_email?></td>
					</tr>
<?}?>
				</tbody>
			</table>
		</div>
	</div><!-- #content -->
</div><!-- #primary -->
<?wp_reset_query()?>
<?php get_footer(); ?>

