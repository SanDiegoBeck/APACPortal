<?php
/**
 * the Hiring Boss ATS job list page
 */
if(empty($_GET['job_id'])){
	$data = array('subdomain'=>'fca');
	if(isset($_GET['job_search'])){
		$data['keyword'] = $_GET['job_search'];
	}
	$jobs = curl_call('https://fiat-chrysler.hiringboss.com/careersiteJobSearch.do', $data);
}
else{
	$data = array('position'=>$_GET['job_id']);
	$job = curl_call('https://fiat-chrysler.hiringboss.com/careersiteJobDetail.do', $data);
}
get_header();
?>

<div id="primary" class="content-area">
	<div id="content" class="site-content row-fluid clearfix" role="main">
		<div class="span3">
			<div class="box people-finder">
				<header>Search</header>
				<div class="content">
					<form class="form-inline">
						<button type="submit" class="btn pull-right"><span class="icon-search"></span></button>
						<div style="padding-right: 40px;">
							<input type="search" name="job_search" value="<?=$_GET['job_search']?>" placeholder="Search job by name..." style="width: 88%;">
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="span9 box">
			<?php if(isset($jobs)){ ?>
			<header class="archive-header">
				<h1 class="archive-title">Career Oppotunities</h1>
			</header>

			<div class="content">
				<?php foreach($jobs as $job){ ?>
				<article id="job-<?=$job->id?>">
					<h1 class="entry-title"><a href="<?=site_url()?>/career/?job_id=<?=$job->id?>"><?=$job->name?></a></h1>
					<dl class="dl-horizontal">
						<dt>
							<ul>
								<li><b>Businuss Unit: </b><?=$job->businessUnit?></li>
								<li><b>Location: </b><?=$job->locationName?></li>
								<li><b>Department: </b><?=$job->verticalName?></li>
								<li><b>Contract Type: </b><?=$job->contractType?></li>
								<li><b>Head Count: </b><?=$job->headCount?></li>
							</ul>
						</dt>
						<dd>
							<?=$job->publicDescription?>
						</dd>
					</dl>
				</article>
				<?php } ?>
				<?php if(count($jobs) === 0){ ?>
				No available positions.
				<?php } ?>
				<hr>
			</div>

			<?php }elseif(isset($job)){ ?>
			<div class="single-post">
				<article id="job-<?=$job->id?>" class="post">
					<header class="entry-header">
						<h1 class="entry-title"><?=$job->name?></h1>

						<div class="entry-meta">
							<ul>
								<li><b>Businuss Unit: </b><?=$job->businessUnit?></li>
								<li><b>Location: </b><?=$job->locationName?></li>
								<li><b>Department: </b><?=$job->verticalName?></li>
								<li><b>Contract Type: </b><?=$job->contractType?></li>
								<li><b>Head Count: </b><?=$job->headCount?></li>
							</ul>
						</div><!-- .entry-meta -->
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?=$job->fullDescription?>
					</div><!-- .entry-content -->

					<footer class="entry-meta">
						<a class="btn btn-primary disabled">Apply for this position</a>
					</footer><!-- .entry-meta -->

				</article>
			</div>
			<?php } ?>
		</div>
	</div>
</div>

<style type="text/css">
	.dl-horizontal dt {
		width:40%;
		text-align:left;
	}
	article {
		padding: 10px 30px;
	}
	.entry-title {
		font-size: 2em;
	}
	a.btn, a.btn:hover {
		color: #FFF;
	}
	.single-post .post {
		padding: 20px 0;
	}
	.single-post footer.entry-meta {
		padding-top: 10px;
	}
</style>

<?php get_footer(); ?>