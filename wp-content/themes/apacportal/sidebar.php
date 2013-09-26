				<div class="box">
					<header>People Finder</header>
					<div class="content">
						<br>
						<form class="form-inline">
							<input type="search" placeholder="Search..." style="width: 150px">
							<button type="submit" style="font-size: 0.9em;">SEARCH</button>
						</form>
					</div>
				</div>
				<div class="box">
					<header>Events
						<span class="more-link"><a href="/category/events">More</a></span>
					</header>
					<div class="content">
						<ul>
							<?query_posts('category_name=events&posts_per_page=10')?>
							<?while(have_posts()):the_post();?>
							<li title="<?the_title()?>"><a href="<?the_permalink()?>" target="_blank"><?the_title()?></a></li>
							<?endwhile;?>
						</ul>
					</div>
				</div>
