insert into `wp_quotescollection` (quote, author) select quote, author from _quote;
 
delete from wp_usermeta where user_id in (select id from wp_users where user_login = '');
delete from wp_users where user_login = '';
 
insert ignore into wp_users (user_email) select `e-mail` from _people;

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