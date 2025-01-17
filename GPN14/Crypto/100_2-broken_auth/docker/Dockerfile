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
RUN apt-get install -y python python-setuptools
RUN apt-get install -y gnupg python-crypto
RUN easy_install python-gnupg

RUN mkdir -p /etc/service/ctf-bernd
ADD alice.sh /etc/service/ctf/run
ADD bernd.sh /etc/service/ctf-bernd/run
ADD ba_server.py /opt/ctf/
COPY ./Alice-gpg/ /opt/ctf/Alice-gpg
COPY ./Bernd-gpg/ /opt/ctf/Bernd-gpg

RUN chown -R ctf:nogroup /opt/ctf


# Clean up APT when done.
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

EXPOSE 5668 5669
