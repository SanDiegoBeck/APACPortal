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
	WHERE  (wp_usermeta.meta_value LIKE '$search%' OR wp_users.user_email LIKE '$search%')
		AND wp_users.user_registered = 0
		AND wp_users.user_status >= 0
	GROUP BY wp_users.ID
	ORDER BY last_name.meta_value ASC
";

//$query="SELECT * FROM wp_usermeta INNER JOIN wp_users ON wp_users.ID = wp_usermeta.user_id WHERE wp_usermeta.meta_key = 'search_info' AND MATCH(wp_usermeta.meta_value) AGAINST('$search');";

$users = $wpdb->get_results($query);

array_walk($users, function(&$user){
	$user->meta=get_user_meta($user->ID);
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
						<td><a href="/user-detail/?id=<?=$user->ID?>" target="_blank"><?=$user->meta['first_name'][0]?> <?=$user->meta['last_name'][0]?></td>
						<td><?=$user->meta['telephone'][0]?></td>
						<td><?=$user->user_email?></td>
						<td><?=$user->meta['company_name'][0]?></td>
						<td><?=$user->meta['department'][0]?></td>
					</tr>
<?}?>
				</tbody>
			</table>
			<label><i>Please contact your department's secretary for updating your information.</i></label>
			<?if(current_user_can('edit_users')){?>
			<form class="form-inline pull-right" method="post" enctype="multipart/form-data" action="/user-import/">
				<input type="file" name="contact-list" />
				<button type="submit" class="btn">Upload</button>
			</form>
			<?}?>
		</div>
	</div><!-- #content -->
</div><!-- #primary -->
<?php get_footer(); ?>

