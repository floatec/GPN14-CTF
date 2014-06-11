<?php

set_exception_handler('logger::exception_handler');
set_error_handler('logger::error_handler');

//set timezone
date_default_timezone_set('Europe/London');

//site address
define('DIR','http://localhost/kochchef');

//database details ONLY NEEDED IF USING A DATABASE
define('DB_TYPE','mysql');
define('DB_HOST','127.0.0.1');
define('DB_NAME','kochchef');
define('DB_USER','root');
define('DB_PASS','');
define('PREFIX','');

//set prefix for sessions
define('SESSION_PREFIX','GC_');

//optionall create a constant for the name of the site
define('SITETITLE','GulaschChef');

//set the default template
Session::set('template','default');
