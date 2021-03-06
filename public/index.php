<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */

/*Do raportowania błędów*/
ini_set('display_errors', 1);
 
define('REQUEST_MICROTIME', microtime(true));
chdir(dirname(__DIR__));

// Setup autoloading
require 'init_autoloader.php';

// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();
