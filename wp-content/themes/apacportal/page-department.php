<?php

$departments = get_posts(array(
	'post_type'=>'department',
	'name'=>sanitize_title($_POST['department_name'])
));

$results = array_map(function($department){ return $department->post_title; }, $departments);

header('Content-Type: application/json');

if($results){
	echo json_encode($results);
}
