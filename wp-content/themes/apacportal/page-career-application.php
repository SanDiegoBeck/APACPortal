<?php

if(isset($_POST['submit'])){
	
	try {
		unset($_POST['submit']);
		
		if(!($_FILES['resume']['name'])){
			throw new Exception('Please upload your resume.');
		}
		
		$resume_file = curl_file_create($_FILES['resume']['tmp_name'], $_FILES['resume']['type'], $_FILES['resume']['name']);
		$uploaded_resume = curl_call('https://fiat-chrysler.hiringboss.com/careersiteUploadDocument.do', array('resume' => $resume_file, 'documentType' => 'resume', 'fileName' => $_FILES['resume']['name']));

		// TODO file upload failure
		$_POST['candidateDocument'][] = array('documentId'=>$uploaded_resume->id, 'isPrimary'=>true);

		if(empty($_POST['candidate']['dateOfBirth'])){
			unset($_POST['candidate']['dateOfBirth']);
		}else{
			$_POST['candidate']['dateOfBirth'] = date('d-m-Y', strtotime($_POST['candidate']['dateOfBirth']));
		}

		if(empty($_POST['candidateEducation']['start_date'])){
			unset($_POST['candidateEducation']['start_date']);
		}else{
			$_POST['candidateEducation']['start_date'] = date('d-m-Y', strtotime($_POST['candidateEducation']['start_date']));
		}

		if(empty($_POST['candidateEducation']['graduation_date'])){
			unset($_POST['candidateEducation']['graduation_date']);
		}else{
			$_POST['candidateEducation']['graduation_date'] = date('d-m-Y', strtotime($_POST['candidateEducation']['graduation_date']));
		}
		
		$_POST['candidate']['companyJson'] = json_encode(array('industry', $_POST['candidate']['industry'], 'function'=>$_POST['candidate']['currentFunction']));
		unset($_POST['candidate']['industry']); unset($_POST['candidate']['currentFunction']);

		if(empty($_POST['candidate']['personalCountry'])){
			unset($_POST['candidate']['personalCountry']);
		}
		
		$candidate_json = json_encode($_POST, JSON_UNESCAPED_UNICODE);
		
		$result = curl_call('https://fiat-chrysler.hiringboss.com/careersiteSubmitCandidate.do?', array('candidateJson'=>$candidate_json));
		
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
//$industries = curl_call('https://fiat-chrysler.hiringboss.com/applicationFormPredefinedInfo.do?lan=&type=industry')[0]->result;
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
			<input type="hidden" name="jobId" value="<?=$_GET['job_id']?>" required>
			<input type="hidden" name="candidate[candidateSourceId]" value="32698" required>
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
					Marital Status
				</label>
				<div class="controls">
					<label class="radio">
						<input type="radio" name="candidate[personalStatements]" value="Married"<?php if($_POST['candidate']['personalStatements'] === 'Married'){?> checked="checked"<?php } ?> required>
						Married
					</label>
					<label class="radio">
						<input type="radio" name="candidate[personalStatements]" value="Single"<?php if($_POST['candidate']['personalStatements'] === 'Single'){?> checked="checked"<?php } ?>>
						Single
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
			
			<h4>Education <small>Highest Degree</small></h4>
			<hr>
			
			<div class="control-group">
				<label class="control-label">
					Start & Graduation Date
				</label>
				<div class="controls">
					<input type="text" name="candidateEducation[start_date]" value="<?= $_POST['candidateEducation']['start_date'] ?>" placeholder="Start Date" required>
					<input type="text" name="candidateEducation[graduation_date]" value="<?= $_POST['candidateEducation']['graduation_date'] ?>" placeholder="Graduation Date" required>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">
					School
				</label>
				<div class="controls">
					<input type="text" name="candidateEducation[school_name]" value="<?= $_POST['candidateEducation']['school_name'] ?>" placeholder="School Name" required>
					<input type="text" name="candidateEducation[degree_name]" value="<?= $_POST['candidateEducation']['degree_name'] ?>" placeholder="Degree Name" required>
				</div>
			</div>
			
			<h4>Language</h4>
			<hr>
			
<!--			<div class="control-group">
				<label class="control-label">
					Mandarin
				</label>
				<div class="controls">
					<input type="hidden" name="candidateLanguage[cn][languageCode]" value="cn">
					<label class="radio">
						<input type="radio" name="candidateLanguage[cn][level]" value="1"<?php if($_POST['candidateLanguage']['cn']['level'] === '1'){?> checked="checked"<?php } ?>>
						Limited
					</label>
					<label class="radio">
						<input type="radio" name="candidateLanguage[cn][level]" value="2"<?php if($_POST['candidateLanguage']['cn']['level'] === '2'){?> checked="checked"<?php } ?>>
						Fair
					</label>
					<label class="radio">
						<input type="radio" name="candidateLanguage[cn][level]" value="3"<?php if($_POST['candidateLanguage']['cn']['level'] === '3'){?> checked="checked"<?php } ?>>
						Fluent
					</label>
				</div>
			</div>-->
			
			<div class="control-group">
				<label class="control-label">
					English
				</label>
				<div class="controls">
					<input type="hidden" name="candidateLanguage[languageCode]" value="en">
					<label class="radio">
						<input type="radio" name="candidateLanguage[level]" value="1"<?php if($_POST['candidateLanguage']['level'] === '1'){?> checked="checked"<?php } ?> required>
						Limited
					</label>
					<label class="radio">
						<input type="radio" name="candidateLanguage[level]" value="2"<?php if($_POST['candidateLanguage']['level'] === '2'){?> checked="checked"<?php } ?>>
						Fair
					</label>
					<label class="radio">
						<input type="radio" name="candidateLanguage[level]" value="3"<?php if($_POST['candidateLanguage']['level'] === '3'){?> checked="checked"<?php } ?>>
						Fluent
					</label>
				</div>
			</div>
			
			<h4>Working Background</h4>
			<hr>
			
			<div class="control-group">
				<label class="control-label">
					Current Employer
				</label>
				<div class="controls">
					<input type="text" name="candidate[currentEmployer]" value="<?=$_POST['candidate']['currentEmployer']?>">
				</div>
			</div>
			
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
					<input type="text" name="candidate[currentFunction]" value="<?=json_decode($_POST['companyJson'])->currentFunction?>"><!--TODO not found in API-->
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">
					Industry
				</label>
				<div class="controls">
					<label class="radio">
						<input type="radio" name="candidate[industry]" value="Automotive"<?php if(json_decode($_POST['companyJson'])->industry === 'Automotive'){?> checked="checked"<?php } ?> required>
						Automotive
					</label>
					<label class="radio">
						<input type="radio" name="candidate[industry]" value="Non-Automotive"<?php if(json_decode($_POST['companyJson'])->industry === 'Non-Automotive'){?> checked="checked"<?php } ?>>
						Non-Automotive
					</label>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">
					Years of Working Experience
				</label>
				<div class="controls">
					<input type="number" name="candidate[yearOfExperience]" value="<?=$_POST['candidate']['yearOfExperience']?>" required>
				</div>
			</div>
			
<!--			<div class="control-group">
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
			</div>-->
			
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