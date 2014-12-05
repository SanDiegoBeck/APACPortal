<?php

get_header();
?>
<div class="box">
	<header>
		Stamp Chop Request Approval
	</header>
	<div class="content">
		<div class="alert alert-success">Request has been approved.</div>
		<form action="post" class="form-horizontal">
			<div class="control-group">
				<label class="control-label">
					Comments
				</label>
				<div class="controls">
					<textarea name="comments" rows="8" style="width:500px" placeholder="Write your comments..."></textarea>
				</div>
			</div>
			<div class="form-actions">
				<button type="submit" name="status" value="approved" class="btn btn-primary">Approve</button>
				<button type="submit" name="status" value="rejected" class="btn btn-danger">Reject</button>
			</div>
		</form>
	</div>
</div>
<?php get_footer(); ?>