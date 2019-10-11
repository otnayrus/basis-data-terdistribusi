# Update Packages
apt-get update

# Upgrade Packages
apt-get upgrade

# Add Percona Repo
wget https://repo.percona.com/apt/percona-release_latest.generic_all.deb
dpkg -i percona-release_latest.generic_all.deb
percona-release setup pxc57
apt-get update

# # Install PXC
# apt-get install percona-xtradb-cluster-5.7

# mysql -u admin -padmin -h 127.0.0.1 -P 6032