<?php

if(isset($_POST['submit'])){
	$data = $_POST;
	$result = curl_call('https://fiat-chrysler.hiringboss.com/careersiteSubmitCandidate.do', $data, 'POST', 'json');
}

get_header();
?>
<div class="box">
	<header>Job Application Form</header>
	<div class="content">
		<form method="post" class="form-horizontal">
			<input type="hidden" name="jobId" value="<?=$_GET['job_id']?>">
			<h4>Personal</h4>
			<hr>
			
			<div class="control-group">
				<label class="control-label">
					Full Name
				</label>
				<div class="controls">
					<input type="text" name="candidate[familyName]" value="<?= $_POST['candidate']['familyName'] ?>" placeholder="Family Name">
					<input type="text" name="candidate[firstName]" value="<?= $_POST['candidate']['firstName'] ?>" placeholder="First Name">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">
					English Name
				</label>
				<div class="controls">
					<input type="text" name="candidate[nickname]" value="<?= $_POST['candidate']['nickname'] ?>">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">
					Day or Birth
				</label>
				<div class="controls">
					<input type="text" name="candidate[dateOfBirth]" value="<?= $_POST['candidate']['dateOfBirth'] ?>" class="date-picker">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">
					Gender
				</label>
				<div class="controls">
					<label class="radio">
						<input type="radio" name="candidate[male]" value="1"<?php if($_POST['candidate']['male'] === '1'){?> ckecked="checked"<?php } ?>>
						Male
					</label>
					<label class="radio">
						<input type="radio" name="candidate[male]" value="0"<?php if($_POST['candidate']['male'] === '0'){?> ckecked="checked"<?php } ?>>
						Female
					</label>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">
					Marital Status
				</label>
				<div class="controls">
					<label class="radio">
						<input type="radio" name="candidate[personalStatements]" value="Married"<?php if($_POST['candidate']['personalStatements'] === 'Married'){?> ckecked="checked"<?php } ?>>
						Married
					</label>
					<label class="radio">
						<input type="radio" name="candidate[personalStatements]" value="Single"<?php if($_POST['candidate']['personalStatements'] === 'Single'){?> ckecked="checked"<?php } ?>>
						Single
					</label>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">
					Current Location
				</label>
				<div class="controls">
					<input type="text" name="candidate[personalCountry]" value="<?= $_POST['candidate']['personalCountry'] ?>" placeholder="Country">
					<input type="text" name="candidate[personalCity]" value="<?= $_POST['candidate']['personalCity'] ?>" placeholder="City">
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
					<input type="text" name="candidate[phone]" value="<?= $_POST['candidate']['phone'] ?>" placeholder="Mobile">
					<input type="text" name="candidate[home_phone]" value="<?= $_POST['candidate']['home_phone'] ?>" placeholder="Home (if any)">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">
					Email Address
				</label>
				<div class="controls">
					<input type="text" name="candidate[email]" value="<?= $_POST['candidate']['email'] ?>">
				</div>
			</div>
			
			<h4>Education</h4>
			<hr>
			
			<div class="control-group">
				<label class="control-label">
					Start & Graduation Date
				</label>
				<div class="controls">
					<input type="text" name="candidateEducation[start_date]" value="<?= $_POST['candidateEducation']['start_date'] ?>" placeholder="Start Date">
					<input type="text" name="candidateEducation[graduation_date]" value="<?= $_POST['candidateEducation']['graduation_date'] ?>" placeholder="Graduation Date">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">
					School
				</label>
				<div class="controls">
					<input type="text" name="candidateEducation[school_name]" value="<?= $_POST['candidateEducation']['school_name'] ?>" placeholder="School Name">
					<input type="text" name="candidateEducation[degree_name]" value="<?= $_POST['candidateEducation']['degree_name'] ?>" placeholder="Degree Name">
				</div>
			</div>
			
			<h4>Language</h4>
			<hr>
			
			<div class="control-group">
				<label class="control-label">
					Mandarin
				</label>
				<div class="controls">
					<input type="hidden" name="candidateLanguage[][languageCode]" value="cn">
					<label class="radio">
						<input type="radio" name="candidateLanguage[][level]" value="1"<?php if($_POST['candidateLanguage'][0]['level'] === '1'){?> ckecked="checked"<?php } ?>>
						Limited
					</label>
					<label class="radio">
						<input type="radio" name="candidateLanguage[][level]" value="2"<?php if($_POST['candidateLanguage'][1]['level'] === '2'){?> ckecked="checked"<?php } ?>>
						Fair
					</label>
					<label class="radio">
						<input type="radio" name="candidateLanguage[][level]" value="3"<?php if($_POST['candidateLanguage'][2]['level'] === '3'){?> ckecked="checked"<?php } ?>>
						Fluent
					</label>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">
					English
				</label>
				<div class="controls">
					<input type="hidden" name="candidateLanguage[][languageCode]" value="en">
					<label class="radio">
						<input type="radio" name="candidateLanguage[][level]" value="1"<?php if($_POST['candidateLanguage'][0]['level'] === '1'){?> ckecked="checked"<?php } ?>>
						Limited
					</label>
					<label class="radio">
						<input type="radio" name="candidateLanguage[][level]" value="2"<?php if($_POST['candidateLanguage'][1]['level'] === '2'){?> ckecked="checked"<?php } ?>>
						Fair
					</label>
					<label class="radio">
						<input type="radio" name="candidateLanguage[][level]" value="3"<?php if($_POST['candidateLanguage'][2]['level'] === '3'){?> ckecked="checked"<?php } ?>>
						Fluent
					</label>
				</div>
			</div>
			
			<h4>Working Background</h4>
			<hr>
			
			<div class="control-group">
				<label class="control-label">
					Current Position
				</label>
				<div class="controls">
					<input type="text" name="candidate[presentJob]" value="<?=$_POST['candidate']['presentJob']?>">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">
					Function
				</label>
				<div class="controls">
					<input type="text" name="candidate[currentFunction]" value="<?=$_POST['candidate']['currentFunction']?>"><!--TODO not found in API-->
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">
					Industry
				</label>
				<div class="controls">
					<input type="text" name="candidate[industry]" value="<?=$_POST['candidate']['industry']?>">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">
					Years of Working Experience
				</label>
				<div class="controls">
					<input type="number" name="candidate[yearOfExperience]" value="<?=$_POST['candidate']['yearOfExperience']?>">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">
					Currently employed by Fiat Chrysler Automobile
				</label>
				<div class="controls">
					<label class="checkbox">
						<input type="checkbox" name="" value="">
					</label>
				</div>
			</div>
			
			
			<div class="control-group">
				<label class="control-label">
					Previously employed by Fiat Chrysler Automobile
				</label>
				<div class="controls">
					<label class="checkbox">
						<input type="checkbox" name="" value="">
					</label>
				</div>
			</div>
			
			<div class="form-actions">
				<button type="submit" name="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>
</div>
<?php get_footer(); ?>