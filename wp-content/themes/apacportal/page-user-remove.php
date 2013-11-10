<?php
$current_user_meta = get_user_meta($current_user->ID);
$target_user_meta = get_user_meta($_GET['ID']);

get_header();

if(
	current_user_can('remove_users') ||
	(current_user_can('edit_users_in_same_company') && $target_user_meta['company_name'] == $current_user_meta['company_name'])
){
	
	$wpdb->query("UPDATE wp_users SET user_status = -1 WHERE ID = ".intval($_GET['ID']));
?>
<div class="wrapper alert">Contact: "<?=implode($target_user_meta['first_name']).' '.implode($target_user_meta['last_name'])?>" Deleted</div>
<?php
}else{
?>
<div class="wrapper alert alert-danger">You're not allowed to remove contact: "<?=implode($target_user_meta['first_name']).' '.implode($target_user_meta['last_name'])?>"</div>
<?php
}

get_footer();
?>

