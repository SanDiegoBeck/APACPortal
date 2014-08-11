create temporary table `day` select * from wp_postmeta where meta_key = '_count-views_day-20140701';

update `day` inner join wp_postmeta on wp_postmeta.post_id = day.post_id and wp_postmeta.meta_key = '_count-views_all'
set wp_postmeta.meta_value = wp_postmeta.meta_value - day.meta_value;

CREATE TEMPORARY TABLE region_stats
SELECT region.site, region.country, COUNT(*) count FROM log INNER JOIN region ON LEFT(LPAD(BIN(log.ip),32,0),region.mask) = LEFT(LPAD(BIN(INET_ATON(region.ip)),32,0),region.mask)
WHERE `client` NOT LIKE 'gsa-%' AND MONTH(time) = 7
GROUP BY region.id;

SELECT country, SUM(count) FROM region_stats GROUP BY country;

SELECT COUNT(*) FROM log WHERE `client` NOT LIKE 'gsa-%' AND MONTH(time) = 7;

select
MAX(IF(meta_key = 'name_en', meta_value, '')) `English Name`,
MAX(IF(meta_key = 'name_cn', meta_value, '')) `Chinese Name`,
MAX(IF(meta_key = 'id', meta_value, '')) `TID/CID`,
MAX(IF(meta_key = 'email', meta_value, '')) `Email`,
MAX(IF(meta_key = 'location', meta_value, '')) `Location`,
MAX(IF(meta_key = 'organization', meta_value, '')) `Organization`,
MAX(IF(meta_key = 'department', meta_value, '')) `Department`,
MAX(IF(meta_key = 'direct_manager', meta_value, '')) `Direct Manager`,
MAX(IF(meta_key = 'hire_date', meta_value, '')) `Hire Date`,
MAX(IF(meta_key = 'reason', meta_value, '')) `Reason`,
MAX(IF(meta_key = 'expectation', meta_value, '')) `Expectation`
from wp_postmeta where post_id in (select ID from wp_posts where post_type = 'form_data') group by post_id;
