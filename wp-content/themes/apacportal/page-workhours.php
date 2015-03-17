<?php

add_action('wp_enqueue_scripts', function(){
	wp_enqueue_style('fullcalendar');
	wp_enqueue_script('fullcalendar');
});

$my_workhours = get_posts(
	array(
		'type'=>'workhour_request', 'meta'=>array(array('key'=>'user_id', 'value'=>get_current_user_id()))
	)
);

if(get_current_user_id()){
	$manager_id = get_user_meta(get_current_user_id(), 'manager_id', true);
	$manager = get_userdata($manager_id);
}

if(isset($_POST['submit'])){
	$workhour_request = $_POST;
	
	$request_name = $workhour_request['type'] === 'overtime' ? 'OT Request' : 'Leave Request';
	
	$request_id = wp_insert_post(array(
		'post_type'=>'workhour_request',
		'post_title'=>$request_name,
		'post_status'=>'private'
	));
	
	add_post_meta($request_id, 'is_overtime', $workhour_request['is_overtime']);
	add_post_meta($request_id, 'type', $workhour_request['type']);
	add_post_meta($request_id, 'duration', isset($workhour_request['duration']) ? $workhour_request['duration'] : $workhour_request['days'] * 8);
	
	if(isset($workhour_request['days'])){
		add_post_meta($request_id, 'days', $workhour_request['days']);
	}
	
	add_post_meta($request_id, 'start_time', $workhour_request['start_time']);
	add_post_meta($request_id, 'reason', $workhour_request['reason']);
	
	$current_user = wp_get_current_user();

	add_post_meta($request_id, 'requestor_id', $current_user->ID);
	add_post_meta($request_id, 'requestor_name', $current_user->display_name);
	add_post_meta($request_id, 'requestor_email', $current_user->user_email);
	
	add_post_meta($request_id, 'approver_id', $manager->ID);
	add_post_meta($request_id, 'approver_name', $manager->display_name);
	add_post_meta($request_id, 'approver_email', $manager->user_email);
	add_post_meta($request_id, 'status', 'pending');
	
	$status = array(
		'name'=>'Request Submitted',
		'time'=>time(),
		'user_id'=>$current_user->ID,
		'user_name'=>$current_user->display_name,
		'user_email'=>$current_user->user_email,
		'comments'=>$workhour_request['comments']
	);
	add_post_meta($request_id, 'statuses', json_encode($status));
	
	// generate approval hash link
	$approve_hash = md5($request_id . '-' . $current_user->ID . NONCE_SALT);
	update_post_meta($request_id, 'approve_hash', $approve_hash);

	// send an email to approver
	$message = 'Dear manager,' . "\n\n"
			. 'There\'s a ' . $request_name . ' pending your approval.' . "\n\n"
			. '	Requestor: ' . $current_user->display_name . "\n"
			. '	Leave Type: ' . $workhour_request['type'] . "\n"
			. '	Duration: ' . $workhour_request['days'] . ' Days' . "\n";

	$message .= "\n"
			. 'Please approve / reject in the following link: '
			. site_url() . '/workhours-process/?key=' . $approve_hash . "\n\n"
			. 'Please DO NOT REPLY this email. For technical support, please contact uice.lu@fcagroup.com ' . "\n"
			. 'Please DO NOT FORWARD this email to others, since it contains sensitive url link.';

	$result = mail($manager->user_email, $request_name . ' pending your approval [' . $current_user->display_name . ']', $message, 'From: APAConnect <apaconnect@fcagroup.com>');

	if($result === true){
		delete_post_meta($chop_request->ID, 'request_hash');
	}else{
		throw new Exception('Fail to send an email to: ' . $manager->user_email);
		// TODO what to do when request saved but email not sent?
	}
	
}

get_header(); ?>
<div class="site-content box" role="main">
	<header><?php the_title(); ?></header>
	<div class="content">
		<div class="row-fluid">
			<div class="span9">
				<div id="calendar"></div>
			</div>
			<div class="span3">
				<?php if(!get_current_user_id()){ ?>
				<form id="email-login" class="form form-inline">
					<input type="text" placeholder="search your name, email" class="employee-name-email" style="width:200px">
					<button type="submit" class="btn">Login</button>
				</form>
				<?php } ?>
				
				<?php if(get_current_user_id()){ ?>
				<div class="text-right">
					<div class="btn-group">
						<button class="btn active">Me</button>
						<button class="btn" disabled="disabled" title="Coming Soon...">Team</button>
					</div>
					<div class="btn-group">
						<button class="btn active">Calendar</button>
						<button class="btn">List</button>
					</div>
				</div>
				<hr>
				<h4>Annual Leave</h4>
				<div class="progress progress-striped">
					<div class="bar" style="width: 40%;">1 / 10</div>
				 </div>
				<h4>Medical Leave</h4>
				<div class="progress progress-striped">
					<div class="bar" style="width: 40%;">3 / 15</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<div id="leave-application-modal" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3 class="title"><span class="type"></span>Application</h3>
	</div>
	<div class="modal-body">
		<form class="form-horizontal">
			<div class="control-group">
				<label class="control-label">Request Type</label>
				<div class="controls">
					<div class="btn-group" data-toggle="buttons-radio">
						<button type="button" name="is_overtime" value="0" class="btn leave">Leave</button>
						<button type="button" name="is_overtime" value="1" class="btn overtime">Overtime</button>
						<input type="hidden" name="is_overtime" value="0">
					</div>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Start From</label>
				<div class="controls one-day hide">
					<input type="datetime" name="start" step="1800" disabled="disabled">
				</div>
				<div class="controls multi-days hide">
					<input type="date" name="start" disabled="disabled">
				</div>
			</div>
			<div class="control-group duration">
				<label class="control-label">Duration</label>
				<div class="controls one-day hide">
					<label class="radio">
						<input type="radio" name="duration" value="8" disabled="disabled" checked="checked">
						All Day
					</label>
					<label class="radio">
						<input type="radio" name="duration" value="2" disabled="disabled">
						1/4 Day
					</label>
					<label class="radio">
						<input type="radio" name="duration" value="4" disabled="disabled">
						1/2 Day
					</label>
				</div>
				<div class="controls multi-days hide">
					<div class="input-append">
						<input type="number" name="days" disabled="disabled" style="width:4em">
						<span class="add-on">Days</span>
					</div>
				</div>
				<div class="controls overtime hide">
					<div class="input-append">
						<input type="number" name="duration" disabled="disabled" style="width:2em">
						<span class="add-on">Hours</span>
					</div>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Type</label>
				<div class="controls leave">
					<select name="type">
						<option value="annual">Annual</option>
						<option value="medical">Medical</option>
					</select>
				</div>
				<div class="controls overtime hide">
					<select name="type" disabled="disabled">
						<option value="workday">Workday</option>
						<option value="weekend">Weekend</option>
						<option value="holiday">Holiday</option>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Reason</label>
				<div class="controls">
					<textarea name="reason" rows="5"></textarea>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Approver</label>
				<div class="controls">
					<div class="uneditable-input"><?=$manager->display_name?></div>
				</div>
			</div>
			<input type="hidden" name="submit">
		</form>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn close-modal">Close</button>
		<button type="button" class="btn btn-primary submit">Submit</button>
	</div>
</div>
<script type="text/javascript">
jQuery(function($){
	
	$('#leave-application-modal').on('hidden', function(){
		$(this).remove();
	}).on('click', 'button.close-modal', function(){
		$(this).closest('.modal').modal('hide');
	}).on('click', 'button.submit', function(){
		var modal = $(this).closest('.modal');
		var data = modal.find('form').serialize();
		$.post('', data, function(){
			modal.modal('hide');
			// TODO success message
		});
	});
	
	$('button[name="is_overtime"]').on('click', function(){
		var isOvertime = ($(this).val() === '1');
		var modal = $(this).closest('.modal');
		
		var workhourType = isOvertime ? 'overtime' : 'leave';
		
		$('input[name="is_overtime"]').val($(this).val());
		
		var types = {
			'leave':['Annual', 'Medical'],
			'overtime':['Workday', 'Weekend', 'Holiday']
		};
		
		var typeSelect = modal.find('select[name="type"]').empty();
		
		for(var i = 0; i < types[workhourType].length; i++){
			typeSelect.append($('<option/>', {value: types[workhourType][i], text: types[workhourType][i]}));
		}
		
	});
	
	$('#calendar').fullCalendar({
		header: {
			right: 'today,prev,next, month,agendaWeek'
		},
		selectable: true,
		select: function(start, end, jsEvent, view){
			var days = moment.duration(end - start).days();
			
			var modal = $('#leave-application-modal').clone(true).appendTo('body');
				
			if(days > 1){
				modal.find('.multi-days').show()
					.find(':input[name="days"]').val(days)
				.end().find(':input').prop('disabled', false);
			}else{
				modal.find('.one-day').show()
					.find(':input').prop('disabled', false);
			}
			
			modal.find(':input[name="start"]').val(start.format());

			if(start.day() >= 1 && start.day() <= 5 && (view.name === 'month' || (start.hour() >= 9 && start.hour() <= 18))){
				modal.find('.btn.leave').button('toggle');
			}else{
				modal.find('.btn.overtime').button('toggle');
			}
			
			modal.modal('show');
		},
		weekNumbers: true,
		businessHours: {
			start: '09:00',
			end: '18:00',
			dow: [1, 2, 3, 4, 5]
		}
	});
	
	$('input.employee-name-email').typeahead({
		source: function(query, process){
			$.get('<?=site_url()?>/user?s_user=' + query, function(result){
				process(result);
			})
		},
		minLength: 2,
		highlighter: function(item){
			return item;
		}
	});
	
	$('#email-login').on('submit', function(){
		var email = $(this).find('input.employee-name-email').val();
		$.post('<?=site_url()?>/email-login/', {email: email, redirectTo: '<?=site_url() . $_SERVER["REQUEST_URI"]?>'}, function(){
			alert('Please check your mailbox.');
		});
		return false;
	});
});
</script>
<style type="text/css">
	.fc .fc-toolbar h2 {
		font-size: 24px;
		font-weight: lighter;
	}
</style>
<?php get_footer(); ?>