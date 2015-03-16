<?php
$user_args=array();

$search=esc_sql($_GET['s_user']);

if(!$search){
	$search='FALSE';
}

$query="
	SELECT wp_users.* 
	FROM wp_users 
	INNER JOIN wp_usermeta ON (
		wp_users.ID = wp_usermeta.user_id 
		AND wp_usermeta.meta_key IN ('first_name','last_name','telephone','cellphone','department','company_name','working_site_country')
	)
	INNER JOIN wp_usermeta last_name ON wp_users.ID = last_name.user_id AND last_name.meta_key = 'last_name'
	WHERE wp_users.user_status >= 0 AND (wp_usermeta.meta_value LIKE '$search%' OR wp_users.user_email LIKE '$search%')
	GROUP BY wp_users.ID
	ORDER BY last_name.meta_value ASC
";

//$query="SELECT * FROM wp_usermeta INNER JOIN wp_users ON wp_users.ID = wp_usermeta.user_id WHERE wp_usermeta.meta_key = 'search_info' AND MATCH(wp_usermeta.meta_value) AGAINST('$search');";

$users = $wpdb->get_results($query);

array_walk($users, function(&$user){
	$user->meta=get_user_meta($user->ID);
});

if($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'){
	header('Content-Type: application/json');
	$results = array();
	foreach($users as $user){
		if(isset($_GET['as_object'])){
			$results[] = array(
				'id'=>$user->ID,
				'name'=>$user->display_name,
				'email'=>strtolower($user->user_email)
			);
		}else{
			$results[] = $user->display_name . ' <' . strtolower($user->user_email) . '>';
		}
	}
	echo json_encode($results);
}
else{
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
			<table class="box table table-bordered table-striped table-hover">
				<thead class="header">
					<th>Name<span class="icon icon-info-sign" title="Click Names For More Information"></span></th>
					<th>Telephone</th>
					<th>Email</th>
					<th>Company</th>
					<th>Department</th>
				</thead>
				<tbody>
<?php  $i=0; ?>
<?php foreach($users as $user){?>
					<?php  $i++ ?>
					<tr<?php if($i % 2 == 0){?> class="odd"<?php }?> title="Click For More Information">
						<td><a href="/user-detail/?id=<?=$user->ID?>" target="_blank"><?=$user->meta['first_name'][0]?> <?=$user->meta['last_name'][0]?></td>
						<td><?=$user->meta['telephone'][0]?></td>
						<td><?=$user->user_email?></td>
						<td><?=$user->meta['company_name'][0]?></td>
						<td><?=$user->meta['department'][0]?></td>
					</tr>
<?php }?>
				</tbody>
			</table>
			<label><i>Please contact your department's secretary for updating your information.</i></label>
			<?php if(current_user_can('edit_users')){?>
			<form class="form-inline pull-right" method="post" enctype="multipart/form-data" action="/user-import/">
				<input type="file" name="contact-list" />
				<button type="submit" class="btn">Upload</button>
			</form>
			<?php }?>
		</div>
	</div><!-- #content -->
</div><!-- #primary -->
<?php get_footer(); }?>

