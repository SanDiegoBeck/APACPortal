insert into `wp_quotescollection` (quote, author) select quote, author from _quote;
 
insert ignore into wp_users (user_email) select `e-mail` from _people;

INSERT IGNORE INTO wp_usermeta (user_id,meta_key,meta_value)
SELECT wp_users.id,'nickname',wp_users.display_name
FROM wp_users;

replace into wp_usermeta (user_id,meta_key,meta_value)
select wp_users.id,'first_name',_people.`first name`
from wp_users inner join _people on _people.`e-mail` = wp_users.user_email;

replace into wp_usermeta (user_id,meta_key,meta_value)
select wp_users.id,'last_name',_people.`last name`
from wp_users inner join _people on _people.`e-mail` = wp_users.user_email;

replace into wp_usermeta (user_id,meta_key,meta_value)
select wp_users.id,'telephone',_people.`telephone number`
from wp_users inner join _people on _people.`e-mail` = wp_users.user_email;

replace into wp_usermeta (user_id,meta_key,meta_value)
select wp_users.id,'cellphone',_people.`cellphone number`
from wp_users inner join _people on _people.`e-mail` = wp_users.user_email;

replace into wp_usermeta (user_id,meta_key,meta_value)
select wp_users.id,'department',_people.`department name`
from wp_users inner join _people on _people.`e-mail` = wp_users.user_email;

replace into wp_usermeta (user_id,meta_key,meta_value)
select wp_users.id,'company_name',_people.`company name`
from wp_users inner join _people on _people.`e-mail` = wp_users.user_email;

replace into wp_usermeta (user_id,meta_key,meta_value)
select wp_users.id,'working_site_country',_people.`working site country`
from wp_users inner join _people on _people.`e-mail` = wp_users.user_email;

DELETE FROM wp_users WHERE user_pass = '';
DELETE FROM wp_usermeta WHERE user_id NOT IN (SELECT ID FROM wp_users);
