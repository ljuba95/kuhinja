<?php

define('ROOT_TEMPLATE', ROOT_URI . 'view/');

define('CONTROLLER_NAMESPACE', 'controller\\');
define('MODEL_NAMESPACE', 'model\\');

define('DEFAULT_CONTROLLER', 'IndexController');
define('DEFAULT_ACTION', 'index');
define('DEFAULT_ROWNUMBER', 7);
define('LOGGING_ERROR', true);
define('LOGGING_ROOT', ROOT_URI . 'logs/');
define('LOGGING_ERROR_FILE', LOGGING_ROOT . 'error.log');
define('LOGGING_DBERROR_FILE', LOGGING_ROOT . 'db_error.log');
ini_set('post_max_size', '64M');
ini_set('upload_max_filesize', '64M');






