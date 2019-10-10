# Update Packages
apt-get update

# Upgrade Packages
apt-get upgrade

# Remove apparmor so PXC can work properly
apt-get remove -y apparmor

# Add Percona Repo
wget https://repo.percona.com/apt/percona-release_latest.generic_all.deb
dpkg -i percona-release_latest.generic_all.deb
percona-release setup pxc57

# Install PXC
apt-get update

# # === Manual Process till end===
# apt-get install -y percona-xtradb-cluster-57

# # Stop mysql
# service mysql stop

# # Add configuration variables
# cat >>/etc/mysql/my.cnf<<EOF
# [mysqld]
# wsrep_provider=/usr/lib/libgalera_smm.so
# wsrep_cluster_name=pxc-cluster
# wsrep_cluster_address=gcomm://192.168.16.64,192.168.16.65,192.168.16.66
# wsrep_node_name=pxc3
# wsrep_node_address=192.168.16.66
# wsrep_sst_method=xtrabackup-v2
# wsrep_sst_auth=sstuser:passw0rd
# pxc_strict_mode=ENFORCING
# binlog_format=ROW
# default_storage_engine=InnoDB
# innodb_autoinc_lock_mode=2
# EOF

# # Start Mysql-PXC
# /etc/init.d/mysql start

