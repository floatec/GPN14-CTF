#!/bin/sh
# `/sbin/setuser memcache` runs the given command as the user `memcache`.
# If you omit that part, the command will be run as root.
cd /opt/ctf
exec /sbin/setuser ctf /usr/bin/env python ./service.py 2>&1
