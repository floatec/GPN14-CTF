#!/bin/bash

if [ $UID -ne 0 ]; then
  echo "You need to run this script as root!" >&2
  exit 1
fi


echo "Adding sources..."

#Add old Ubuntu 12.04 sources
echo "deb http://de.archive.ubuntu.com/ubuntu precise main restricted universe multiverse
#deb-src http://de.archive.ubuntu.com/ubuntu precise main restricted universe multiverse

deb http://de.archive.ubuntu.com/ubuntu precise-updates main restricted universe multiverse
#deb-src http://de.archive.ubuntu.com/ubuntu precise-updates main restricted universe multiverse

deb http://de.archive.ubuntu.com/ubuntu precise-security main restricted universe multiverse
#deb-src http://de.archive.ubuntu.com/ubuntu precise-security main restricted universe multiverse

deb http://de.archive.ubuntu.com/ubuntu precise-backports main restricted universe multiverse
#deb-src http://de.archive.ubuntu.com/ubuntu precise-backports main restricted universe multiverse" >> /etc/apt/sources.list

echo "Updating..."
apt-get update

echo "Downgrading openssl"
apt-get install -y --force-yes openssl=1.0.1-4ubuntu3 libssl1.0.0=1.0.1-4ubuntu3

echo "Installing Apache2"
apt-get install -y apache2 php5

echo "Enabling SSL"
a2enmod ssl
a2ensite default-ssl
service apache2 reload

