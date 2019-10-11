INSERT INTO mysql_servers(hostgroup_id, hostname, port) VALUES (0,'192.168.16.64',3306);
INSERT INTO mysql_servers(hostgroup_id, hostname, port) VALUES (0,'192.168.16.65',3306);
INSERT INTO mysql_servers(hostgroup_id, hostname, port) VALUES (0,'192.168.16.66',3306);

UPDATE global_variables SET variable_value='proxysql' WHERE variable_name='mysql-monitor_username';
UPDATE global_variables SET variable_value='ProxySQLPa55' WHERE variable_name='mysql-monitor_password';

LOAD MYSQL USERS TO RUNTIME;
SAVE MYSQL USERS TO DISK;

LOAD MYSQL SERVERS TO RUNTIME;

INSERT INTO mysql_users (username,password) VALUES ('sbuser','sbpass');

LOAD MYSQL USERS TO RUNTIME;
SAVE MYSQL USERS TO DISK;

-- Add User ProxySql
-- CREATE USER 'sbuser'@'192.168.16.67' IDENTIFIED BY 'sbpass';
-- GRANT ALL ON *.* TO 'sbuser'@'192.168.16.67';