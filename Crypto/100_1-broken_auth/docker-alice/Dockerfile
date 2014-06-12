# Use phusion/baseimage as base image. To make your builds reproducible, make
# sure you lock down to a specific version, not to `latest`!
# See https://github.com/phusion/baseimage-docker/blob/master/Changelog.md for
# a list of version numbers.
FROM phusion/baseimage:0.9.11

# disable ssh
RUN rm -rf /etc/service/sshd /etc/my_init.d/00_regen_ssh_host_keys.sh

# Set correct environment variables.
ENV HOME /opt/ctf

# create teamspeak user
RUN adduser --system --home /opt/ctf ctf

RUN apt-get update
RUN apt-get install -y gpg python python-pip
RUN pip install Crypto python-gnupg

# add teamspeak service
RUN mkdir -p /etc/service/ctf
ADD ctf.sh /etc/service/ctf/run
ADD ../ba_server.py /opt/ctf
ADD Alice-gpg /opt/ctf/

RUN chown -R ctf:nogroup /opt/ctf


# Clean up APT when done.
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Use baseimage-docker's init system.
CMD ["/sbin/my_init"]
EXPOSE 5668