#!/bin/bash

if [[ ! -d "/var/lib/mysql/mysql" ]]; then
	echo "=> Uninitialized Mysql"
	echo "=> Running mysql_install_db"
	mysql_install_db 2>&1
	echo "=> Setting up db"
	/usr/bin/mysqld_safe > /dev/null 2>&1 &
	RET=1
	while [[ RET -ne 0 ]]; do
		echo "=> Waiting for confirmation of MySQL service startup"
		sleep 5
		mysql -uroot -e "status" > /dev/null 2>&1
		RET=$?
	done

        PASS=$(pwgen -s 16 1)
        mysqladmin -u root password "$PASS"
        echo "$PASS" > /root/mysqlpw
	mysql -uroot -p"$PASS" < /opt/ctf/init.sql

	mysqladmin -uroot -p"$PASS" shutdown
else
	echo "=> Using existing MySQL volume"
fi
echo "=> Starting mysql"
exec mysqld_safe
