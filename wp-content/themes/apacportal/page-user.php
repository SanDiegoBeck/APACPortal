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
			<table class="box">
				<thead class="header">
					<th>Name<span class="icon icon-info-sign" title="Click Names For More Information"></span></th>
					<th>Telephone</th>
					<th>Email</th>
					<th>Company</th>
					<th>Department</th>
				</thead>
				<tbody class="content">
<? $i=0; ?>
<?foreach($users as $user){?>
					<? $i++ ?>
					<tr<?if($i % 2 == 0){?> class="odd"<?}?> title="Click For More Information">
						<td><a href="/user-detail?id=<?=$user->data->ID?>" target="_blank"><?=$user->data->meta['first_name'][0]?> <?=$user->data->meta['last_name'][0]?></td>
						<td><?=$user->data->meta['telephone'][0]?></td>
						<td><?=$user->data->user_email?></td>
						<td><?=$user->data->meta['company_name'][0]?></td>
						<td><?=$user->data->meta['department'][0]?></td>
					</tr>
<?}?>
				</tbody>
			</table>
		</div>
	</div><!-- #content -->
</div><!-- #primary -->
<?php get_footer(); ?>

