# Use phusion/baseimage as base image. To make your builds reproducible, make
# sure you lock down to a specific version, not to `latest`!
# See https://github.com/phusion/baseimage-docker/blob/master/Changelog.md for
# a list of version numbers.
FROM phusion/baseimage:0.9.10

# disable ssh
RUN rm -rf /etc/service/sshd /etc/my_init.d/00_regen_ssh_host_keys.sh

# Set correct environment variables.
ENV HOME /opt/ctf

# create teamspeak user
RUN adduser --system --home /opt/ctf ctf
RUN mkdir -p /etc/service/ctf

# Use baseimage-docker's init system.
CMD ["/sbin/my_init"]

RUN apt-get update
RUN apt-get -y remove openssh-server
RUN apt-get -y dist-upgrade

#### Service specific config
RUN apt-get install -y apache2 php5 libapache2-mod-php5
RUN rm -rf /var/www/html
RUN a2enmod php5 rewrite
RUN apt-get install -y php5-gd

# mysql
RUN DEBIAN_FRONTEND=noninteractive apt-get -y install mysql-server pwgen
RUN rm -rf /var/lib/mysql/*
VOLUME ["/var/lib/mysql"]
RUN chown -R mysql:mysql /var/lib/mysql

ADD my.cnf /etc/mysql/my.cnf
ADD mysqld_charset.cnf /etc/mysql/conf.d/mysqld_charset.cnf
RUN mkdir -p /etc/service/mysql
ADD mysql.sh /etc/service/mysql/run

ADD apache2.conf /etc/apache2/apache2.conf
ADD apache.sh /etc/service/ctf/run

#if you need to change some apache2 config
ADD apache-site.conf /etc/apache2/sites-enabled/000-default.conf

ADD ./kochchef/ /var/www/challenge
ADD ./kochchef.sql /opt/ctf/init.sql

RUN chown -R www-data:www-data /var/www
RUN chmod -R 500 /var/www
RUN service apache2 restart


# Clean up APT when done.
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

EXPOSE 80
