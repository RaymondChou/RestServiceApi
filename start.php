<?php
/**
 * Author: RaymondChou
 * Date: 12-10-6
 * File: start.php
 * Email: zhouyt.kai7@gmail.com
 */

//Turn off the profiler to prevent wrong output
Config::set('application.profiler', false);

Autoloader::directories(array(
    path('bundle').'rest_service_api/libraries',
));

require_once __DIR__.'/libraries/markdown.php';
require_once __DIR__.'/libraries/utility.php';


Autoloader::map(array(
    'Api_Controller' 		=> path('bundle').'rest_service_api/libraries/api_controller.php',
    'Api' 		            => path('bundle').'rest_service_api/libraries/api.php',
));