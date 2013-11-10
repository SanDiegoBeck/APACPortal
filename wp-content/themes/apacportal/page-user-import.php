<?php
get_header();
try{	
	$user_metas=array(
		'email'=>'E-mail',
		'first_name'=>'First Name',
		'last_name'=>'Last Name',
		'telephone'=>'Telephone Number',
		'cellphone'=>'Cellphone Number',
		'department'=>'Department Name',
		'company_name'=>"Company Name",
		'working_site_country'=>'Working Site Country'
	);

	$excel = PHPExcel_IOFactory::load($_FILES['contact-list']['tmp_name']);
	$sheet = $excel->getSheet();

	$highestColumn = PHPExcel_Cell::columnIndexFromString($sheet->getHighestColumn());
	$highestRow = $sheet->getHighestRow();

	$collection = array();

	$wpdb->query(
	"CREATE TABLE `_people` (
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`First Name` varchar(255) NULL,
		`Last name` varchar(255) NULL,
		`Telephone Number` varchar(255) NULL,
		`Cellphone Number` varchar(255) NULL,
		`E-mail` varchar(255) NULL,
		`Department Name` varchar(255) NULL,
		`Company Name` varchar(255) NULL,
		`Working Site Country` varchar(255) NULL,
		PRIMARY KEY (`id`)
	);");

	for($row = 2; $row <= $highestRow; $row++){

		$rowData=array();

		for($column = 0; $column<= $highestColumn; $column++){

			if(!in_array($sheet->getCellByColumnAndRow($column, 1)->getValue(),$user_metas)){
				continue;
			}
			
			if($sheet->getCellByColumnAndRow($column, 1)->getValue() == 'E-mail' && !is_email($sheet->getCellByColumnAndRow($column, $row)->getValue())){
				throw new Exception('Invaid E-mail found in your excel table at row: '.$row.'. Please edit the excel file, save it and refresh this page.');
			}

			$rowData[$sheet->getCellByColumnAndRow($column, 1)->getValue()]=$sheet->getCellByColumnAndRow($column, $row)->getValue();

		}

		$wpdb->insert('_people',$rowData);
	}

	$wpdb->query("DELETE FROM _people WHERE `First Name` = '' AND `Last Name` = '';");

	$wpdb->query("INSERT IGNORE INTO wp_users (user_login, user_nicename, user_email, display_name) SELECT `E-mail`,CONCAT(`First Name`, ' ', `Last Name`),`E-mail`,CONCAT(`First Name`, ' ', `Last Name`) FROM _people;");

	$wpdb->query(
"INSERT IGNORE INTO wp_usermeta (user_id,meta_key,meta_value)
SELECT wp_users.id,'nickname',wp_users.display_name
FROM wp_users;"
	);
	
	$wpdb->query("REPLACE INTO wp_usermeta (user_id,meta_key,meta_value)
	SELECT wp_users.id,'first_name',_people.`first name`
	FROM wp_users INNER JOIN _people on _people.`e-mail` = wp_users.user_email;");

	$wpdb->query("REPLACE INTO wp_usermeta (user_id,meta_key,meta_value)
	SELECT wp_users.id,'last_name',_people.`last name`
	FROM wp_users INNER JOIN _people on _people.`e-mail` = wp_users.user_email;");

	$wpdb->query("REPLACE INTO wp_usermeta (user_id,meta_key,meta_value)
	SELECT wp_users.id,'telephone',_people.`telephone number`
	FROM wp_users INNER JOIN _people ON _people.`e-mail` = wp_users.user_email;");

	$wpdb->query("REPLACE INTO wp_usermeta (user_id,meta_key,meta_value)
	SELECT wp_users.id,'cellphone',_people.`cellphone number`
	FROM wp_users INNER JOIN _people ON _people.`e-mail` = wp_users.user_email;");

	$wpdb->query("REPLACE INTO wp_usermeta (user_id,meta_key,meta_value)
	SELECT wp_users.id,'department',_people.`department name`
	FROM wp_users INNER JOIN _people ON _people.`e-mail` = wp_users.user_email;");

	$wpdb->query("REPLACE INTO wp_usermeta (user_id,meta_key,meta_value)
	SELECT wp_users.id,'company_name',_people.`company name`
	FROM wp_users INNER JOIN _people ON _people.`e-mail` = wp_users.user_email;");

	$wpdb->query("REPLACE INTO wp_usermeta (user_id,meta_key,meta_value)
	SELECT wp_users.id,'working_site_country',_people.`working site country`
	FROM wp_users INNER JOIN _people ON _people.`e-mail` = wp_users.user_email;");
?>
	<script type="text/javascript">window.location.href="<?=$_SERVER['HTTP_REFERER']?>";</script>
<?php
}catch(Exception $e){
?>
	<div class="alert alert-error"><?=$e->getMessage()?></div>
<?php
}
get_footer()?>
