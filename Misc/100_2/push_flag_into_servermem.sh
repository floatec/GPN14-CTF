#!/bin/bash

while true; do
wget -O /dev/null --no-check-certificate "https://10.211.55.5/login.php" --post-data="username=admin&password=UFETEST"
sleep 1
done
