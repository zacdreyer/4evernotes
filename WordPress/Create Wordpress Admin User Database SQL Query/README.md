## Create Wordpress Admin User Database SQL Query

A very handy tool to Generate SQL Queries to create a WordPress Administrator via the database / phpMyAdmin
https://blackgate.com.au/tools/wordpress-admin-user/

Copy and Paste SQL
```
INSERT INTO `wp_users` (`user_login`, `user_pass`, `user_nicename`, `user_email`, `user_status`)
VALUES ('myusername', MD5('mypassword'), 'My Name', 'my@email.com', '0');

INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`)
VALUES (NULL, (SELECT MAX(id) FROM wp_users),'wp_capabilities', 'a:1:{s:13:"administrator";s:1:"1";}');

INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) 
VALUES (NULL, (SELECT MAX(id) FROM wp_users), 'wp_user_level', '10');
```
