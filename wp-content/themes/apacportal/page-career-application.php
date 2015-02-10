<?php

if(isset($_POST['submit'])){
	
	try {
		unset($_POST['submit']);
		
		if(!($_FILES['resume']['name'])){
			throw new Exception('Please upload your resume.');
		}
		
		$resume_file = curl_file_create($_FILES['resume']['tmp_name'], $_FILES['resume']['type'], $_FILES['resume']['name']);
		$uploaded_resume = curl_call('https://fiat-chrysler.hiringboss.com/careersiteUploadDocument.do', array('resume' => $resume_file, 'documentType' => 'resume', 'fileName' => $_FILES['resume']['name']));
		
		$submission_data = $_POST;
		
		// TODO file upload failure
		$submission_data['candidateDocument'][] = array('documentId'=>$uploaded_resume->id, 'isPrimary'=>true);

		if(!empty($submission_data['candidate']['dateOfBirth'])){
			unset($submission_data['candidate']['dateOfBirth']);
		}else{
			$submission_data['candidate']['dateOfBirth'] = date('d-m-Y', strtotime($submission_data['candidate']['dateOfBirth']));
		}

		if(empty($submission_data['candidateEducation']['start_date'])){
			unset($submission_data['candidateEducation']['start_date']);
		}else{
			$submission_data['candidateEducation']['start_date'] = date('d-m-Y', strtotime($submission_data['candidateEducation']['start_date']));
		}

		if(empty($submission_data['candidateEducation']['graduation_date'])){
			unset($submission_data['candidateEducation']['graduation_date']);
		}else{
			$submission_data['candidateEducation']['graduation_date'] = date('d-m-Y', strtotime($submission_data['candidateEducation']['graduation_date']));
		}
		
		if(empty($submission_data['candidate']['personalCountry'])){
			unset($submission_data['candidate']['personalCountry']);
		}
		
		foreach($submission_data['additionalInformation'] as &$item){
			$item['positionSequence'] = intval($item['positionSequence']);
		}
		
		$candidate_json = json_encode($submission_data, JSON_UNESCAPED_UNICODE);
		
		$result = curl_call('https://fiat-chrysler.hiringboss.com/careersiteSubmitCandidate.do', array('candidateJson'=>$candidate_json));
		
		if($result->success === 'false'){ // Hiring Boss, seriously?
			throw new Exception($result->error->errorMessage);
		}else{
			$success = true;
		}

	} catch (Exception $e) {
		$error = $e->getMessage();
	}
	
}

$job = curl_call('https://fiat-chrysler.hiringboss.com/hb/positions/' . $_GET['job_id'] . '.do?lang=en');
$form = curl_call('http://indigo.hiringboss.com/careers/hb/positions/' . $_GET['job_id'] . '/form/EN', null, 'GET', null, array('sessionId: bGl6enkud2FuZ0BmY2Fncm91cC5jb207MnczZTRyNVQ7ZmNhO2h0dHBzOi8vZmlhdC1jaHJ5c2xlci5oaXJpbmdib3NzLmNvbQ=='));
$personal_countries = curl_call('https://fiat-chrysler.hiringboss.com/applicationFormPredefinedInfo.do?lan=&type=personalCountry')[0]->result;

get_header();
?>
<div class="box">
	<header>Job Application Form</header>
	<div class="content">
		<?php if($error){ ?>
		<div class="alert alert-error"><?=$error?></div>
		<?php } ?>
		<?php if($success){ ?>
		<div class="alert alert-success">Thank you for you application.</div>
		<?php } ?>
		
		<h1 class="entry-title"><?=$job->name?></h1>
		<ul>
			<li><b>Location: </b><?=$job->locationName?></li>
			<li><b>Department: </b><?=$job->verticalName?></li>
		</ul>
		<hr>
		
		<div class="well well-small">*All Information is Required</div>
		
		<form method="post" enctype="multipart/form-data" class="form-horizontal">
			<input type="hidden" name="jobId" value="<?=$_GET['job_id']?>">
			<input type="hidden" name="candidate[candidateSourceId]" value="32698">
			<h4>Personal</h4>
			<hr>
			
			<div class="control-group">
				<label class="control-label">
					Full Name
				</label>
				<div class="controls">
					<input type="text" name="candidate[familyName]" value="<?= $_POST['candidate']['familyName'] ?>" placeholder="Family Name" required>
					<input type="text" name="candidate[firstName]" value="<?= $_POST['candidate']['firstName'] ?>" placeholder="First Name" required>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">
					English Name
				</label>
				<div class="controls">
					<input type="text" name="candidate[nickname]" value="<?= $_POST['candidate']['nickname'] ?>" required>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">
					Date or Birth
				</label>
				<div class="controls">
					<input type="date" name="candidate[dateOfBirth]" value="<?= $_POST['candidate']['dateOfBirth'] ?>" class="date-picker" required>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">
					Gender
				</label>
				<div class="controls">
					<label class="radio">
						<input type="radio" name="candidate[male]" value="1"<?php if($_POST['candidate']['male'] === '1'){?> checked="checked"<?php } ?> required>
						Male
					</label>
					<label class="radio">
						<input type="radio" name="candidate[male]" value="0"<?php if($_POST['candidate']['male'] === '0'){?> checked="checked"<?php } ?>>
						Female
					</label>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">
					Current Location
				</label>
				<div class="controls">
					<select name="candidate[personalCountry]">
						<option value="">- please select -</option>
						<?php foreach($personal_countries as $personal_country){ ?>
						<option value="<?=$personal_country->value?>"<?php if($_POST['candidate']['personalCountry'] === $personal_country->value){ ?> selected<?php } ?>><?=$personal_country->name?></option>
						<?php } ?>
					</select>
						
					</select>
					<input type="text" name="candidate[personalCity]" value="<?= $_POST['candidate']['personalCity'] ?>" placeholder="City" required>
					<label class="checkbox-inline">
						<input type="checkbox" name="candidate[relocate]" value="1"<?php if($_POST['candidate']['relocate']){?> checked="checked"<?php } ?>>
						Willing for relocation	
					</label>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">
					Contact Number
				</label>
				<div class="controls">
					<input type="text" name="candidate[phone]" value="<?= $_POST['candidate']['phone'] ?>" placeholder="Mobile" required>
					<input type="text" name="candidate[home_phone]" value="<?= $_POST['candidate']['home_phone'] ?>" placeholder="Home (if any)">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">
					Email Address
				</label>
				<div class="controls">
					<input type="text" name="candidate[email]" value="<?= $_POST['candidate']['email'] ?>" required>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">
					Current Employer
				</label>
				<div class="controls">
					<input type="text" name="candidate[currentEmployer]" value="<?= $_POST['candidate']['currentEmployer'] ?>" required>
				</div>
			</div>
			
			<h4>Additional Information</h4>
			<hr>
			<?php foreach($form->elements[1]->children as $index => $field){ ?>
			<div class="control-group">
				<label class="control-label">
					<?=$field->labels[0]->text?>
				</label>
				<div class="controls">
					<input type="hidden" name="additionalInformation[<?=$index?>][templateId]" value="<?=$form->id?>">
					<input type="hidden" name="additionalInformation[<?=$index?>][fieldName]" value="<?=$field->name?>">
					<input type="hidden" name="additionalInformation[<?=$index?>][fieldType]" value="<?=$field->type?>">
					<input type="hidden" name="additionalInformation[<?=$index?>][positionSequence]" value="<?=$field->positionSequence?>">
					
					<?php if($field->type === 'DROPDOWN_LIST'){ ?>
					
					<select name="additionalInformation[<?=$index?>][fieldValue]">
						<?php foreach($field->children as $option){ ?>
						<option value="<?=$option->value?>"<?php if($_POST['additionalInformation'][$index]['fieldValue'] === $option->value){?> selected="selected"<?php } ?>><?=$option->labels[0]->text?></option>
						<?php } ?>
					</select>
					
					<?php }elseif($field->type === 'DATE'){ ?>
					
					<input type="date" name="additionalInformation[<?=$index?>][fieldValue]" value="<?=$_POST['additionalInformation'][$index]['fieldValue']?>">
					
					<?php }elseif($field->type === 'TEXTBOX'){ ?>
					
					<input type="text" name="additionalInformation[<?=$index?>][fieldValue]" value="<?=$_POST['additionalInformation'][$index]['fieldValue']?>">
					
					<?php }elseif($field->type === 'RADIOBUTTON'){ ?>
					
						<?php foreach($field->children as $choice){ ?>
						<label class="radio">
							<input type="radio" name="additionalInformation[<?=$index?>][fieldValue]" value="<?=$choice->value?>"<?php if($_POST['additionalInformation'][$index]['fieldValue'] === $choice->value){?> checked="checked"<?php } ?> required>
							<?=$choice->labels[0]->text?>
						</label>
						<?php } ?>
					
					<?php } ?>
				</div>
			</div>
			<?php } ?>
			
			<h4>Resume Upload</h4>
			<hr>
			
			<div class="control-group">
				<label class="control-label">
					Resume
				</label>
				<div class="controls">
					<input type="file" name="resume" required>
				</div>
			</div>
			
			<div class="form-actions">
				<button type="submit" name="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>
</div>
<?php get_footer(); ?>