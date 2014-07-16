<?php

add_action('init', function(){
	register_post_type('appointment');
});

$appointments = get_posts('post_type=appointment&posts_per_page=-1');
$reserved_times = $applied_employees = array();
foreach($appointments as $appointment){
	$reserved_times[] = get_post_meta($appointment->ID, 'time', true);
	$applied_employees[] = get_post_meta($appointment->ID, 'tid', true);
}

$valid_applicants_tid = array('t7037ul');

if(isset($_POST['submit'])){
	
	$fields = array('applicant'=>'Name', 'tid'=>'TID', 'email'=>'E-mail', 'phone'=>'Phone', 'department'=>'Department', 'time'=>'Time of Appointment');
	
	try{
		
		foreach($fields as $field => $label){
			if(empty($_POST[$field])){
				throw new Exception('Please fill in ' . $label . '.');
			}
		}
		
		if(!in_array($_POST['tid'], $valid_applicants_tid)){
			throw new Exception('Sorry, your TID is not in the applicant list this time.');
		}
		
		if(!is_email($_POST['email'])){
			throw new Exception('Invalid email.');
		}
		
		if(in_array($_POST['time'], $reserved_times)){
			throw new Exception($_POST['time'] . ' has been reserved meanwhile, please select another time.');
		}
		
		if(in_array($_POST['tid'],  $applied_employees)){
			throw new Exception('You have already made an appointment');
		}
		
		$post_id = wp_insert_post(array(
			'post_type'=>'appointment',
			'post_title'=>$_POST['time'] . ': ' . $_POST['applicant'],
			'post_status'=>'publish'
		));
		foreach($fields as $field => $label){
			add_post_meta($post_id, $field, $_POST[$field]);
		}
	}catch(Exception $e){
		$error = $e->getMessage();
	}
}

$date['start'] = '2014-7-16';
$date['end'] = '2014-8-15';

$slots = array('10:00', '13:00', '15:00');

for($time = strtotime($date['start']); $time<= strtotime($date['end']); $time += 86400){
	if(in_array(date('D', $time), array('Sun', 'Sat'))){
		continue;
	}
	foreach($slots as $slot){
		$appointment_time = date('Y-m-d', $time) . ' ' . $slot;
		if(in_array($appointment_time, $reserved_times)){
			continue;
		}
		$appointment_times[] = $appointment_time;
	}
}

get_header();
?>
<div class="site-content row-fluid" role="main">
	<div class="box">
		<header>Chrysler Computer Installation</header>
		<div class="content">
			<?php if($error){ ?>
			<div class="alert alert-error">
				<?=$error?>
			</div>
			<?php }elseif(isset($_POST['submit'])){ ?>
			<div class="alert alert-success">
				Your appointment was registed successfully. We are waiting for you at <?=$_POST['time']?>
			</div>
			<?php } ?>
			<form class="form-horizontal" method="post">
				<div class="control-group">
					<label class="control-label" for="inputName">Name</label>
					<div class="controls">
						<input type="text" id="inputName" placeholder="Your name..." name="applicant" value="<?=$_POST['applicant']?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputTID">TID</label>
					<div class="controls">
						<input type="text" id="inputTID" placeholder="Your Chrysler TID..." name="tid" value="<?=$_POST['tid']?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputEmail">Email</label>
					<div class="controls">
						<input type="text" id="inputEmail" placeholder="Your Chrysler Email address..." name="email" value="<?=$_POST['email']?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputPhone">Phone</label>
					<div class="controls">
						<input type="text" id="inputPhone" placeholder="Your phone number..." name="phone" value="<?=$_POST['phone']?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputDepart">Department</label>
					<div class="controls">
						<input type="text" id="inputDepart" placeholder="Your department..." name="department" value="<?=$_POST['department']?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputTime">Time of Appointment</label>
					<div class="controls">
						<?php if(isset($_POST['submit']) && !$error){ ?>
						<div class="uneditable-input"><?=$_POST['time']?></div>
						<?php }else{ ?>
						<select name="time">
							<?php foreach($appointment_times as $appointment_time){ ?>
							<option value="<?=$appointment_time?>"<?php if($appointment_time == $_POST['time']){ ?> selected="selected"<?php } ?>><?=$appointment_time?></option>
							<?php } ?>
						</select>
						<?php } ?>
					</div>
				</div>
				<?php if(!isset($_POST['submit']) || $error){ ?>
				<div class="form-actions"><button type="submit" name="submit" class="btn btn-primary">Make Appointment</button></div>
				<?php } ?>
			</form>
		</div>
	</div>
</div>
<?php get_footer(); ?>
