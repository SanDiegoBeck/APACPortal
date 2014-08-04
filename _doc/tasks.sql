create temporary table `day` select * from wp_postmeta where meta_key = '_count-views_day-20140701';

update `day` inner join wp_postmeta on wp_postmeta.post_id = day.post_id and wp_postmeta.meta_key = '_count-views_all'
set wp_postmeta.meta_value = wp_postmeta.meta_value - day.meta_value;

CREATE TEMPORARY TABLE region_stats
SELECT region.site, region.country, COUNT(*) count FROM log INNER JOIN region ON LEFT(LPAD(BIN(log.ip),32,0),region.mask) = LEFT(LPAD(BIN(INET_ATON(region.ip)),32,0),region.mask)
WHERE `client` NOT LIKE 'gsa-%' AND MONTH(time) = 7
GROUP BY region.id;

SELECT country, SUM(count) FROM region_stats GROUP BY country;

SELECT COUNT(*) FROM log WHERE `client` NOT LIKE 'gsa-%' AND MONTH(time) = 7;
