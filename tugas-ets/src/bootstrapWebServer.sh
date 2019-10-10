# Update Packages
apt-get update

# Upgrade Packages
apt-get upgrade

# Apache
apt-get install -y apache2

# Enable Apache Mods
a2enmod rewrite

#Add Ondrej PPA Repo
apt-add-repository ppa:ondrej/php
apt-get update

deb http://ppa.launchpad.net/ondrej/php/ubuntu bionic main
deb-src http://ppa.launchpad.net/ondrej/php/ubuntu bionic main

# Install PHP
apt-get install -y php7.3

# PHP Mods
apt-get install -y php7.3 libapache2-mod-php7.3 php7.3-cli php7.3-mysql php7.3-gd php7.3-imagick php7.3-recode php7.3-tidy php7.3-xmlrpc php7.3-common php7.3-curl php7.3-mbstring php7.3-xml php7.3-bcmath php7.3-bz2 php7.3-intl php7.3-json php7.3-readline php7.3-zip

# Restart Apache
systemctl restart apache2
