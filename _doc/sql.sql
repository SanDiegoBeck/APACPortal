insert ignore into wp_users (user_email) select email from _people;
 
insert into wp_usermeta (user_id,meta_key,meta_value)
select wp_users.id,'first_name',_people.first_name
from wp_users inner join _people on _people.email = wp_users.user_email;
 
insert into wp_usermeta (user_id,meta_key,meta_value)
select wp_users.id,'last_name',_people.last_name
from wp_users inner join _people on _people.email = wp_users.user_email;
 
insert into wp_usermeta (user_id,meta_key,meta_value)
select wp_users.id,'telephone',_people.telephone
from wp_users inner join _people on _people.email = wp_users.user_email;
 
insert into wp_usermeta (user_id,meta_key,meta_value)
select wp_users.id,'cellphone',_people.cellphone
from wp_users inner join _people on _people.email = wp_users.user_email;
 
insert into wp_usermeta (user_id,meta_key,meta_value)
select wp_users.id,'department',_people.department
from wp_users inner join _people on _people.email = wp_users.user_email;
 
insert into wp_usermeta (user_id,meta_key,meta_value)
select wp_users.id,'company_name',_people.company_name
from wp_users inner join _people on _people.email = wp_users.user_email;
 
insert into wp_usermeta (user_id,meta_key,meta_value)
select wp_users.id,'working_site_country',_people.working_site_country
from wp_users inner join _people on _people.email = wp_users.user_email;
