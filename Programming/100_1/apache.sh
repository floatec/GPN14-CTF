#!/bin/bash
# `/sbin/setuser memcache` runs the given command as the user `memcache`.
# If you omit that part, the command will be run as root.
/etc/init.d/apache2 start
pid=`cat /var/run/apache2/apache2.pid`
while kill -0 $pid > /dev/null; do sleep 1; done
