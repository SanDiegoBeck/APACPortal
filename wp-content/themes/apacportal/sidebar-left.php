<div class="box">
	<header>APAC People Finder</header>
	<div class="content">
		<br>
		<form class="form-inline" action="/user/">
			<input type="search" name="s_user" placeholder="Search..." style="width: 140px">
			&nbsp;
			<button type="submit" style="font-size: 0.9em;">SEARCH</button>
		</form>
	</div>
</div>
<div class="box">
	<header>
		<span class="more-link"><a href="/category/events">More</a></span>
		Events
	</header>
	<div class="content">
		<?=apacportal_post_list('events', 10)?>
	</div>
</div>