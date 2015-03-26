<?php
// $webRoot = realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR;

define('USE_BOOT', false); // Set to true for windows

// -------------------------------------------------------------------
// You shouldn't need to change anything below this line.
// -------------------------------------------------------------------
if (! defined('APP_DATABASE')) {
    define('APP_DATABASE', 'elections');
}

// -------------------------------------------------------------------
// Changing anything below this line may well break things quite badly.
// -------------------------------------------------------------------
define('USE_LIBS', false);
if (USE_LIBS) {
    $pharFile = realpath(dirname(__FILE__) . '/api/elections.phar');
    $rootPath = 'phar://' . $pharFile . '/';

    define('API_PATH', $rootPath);

    require_once (API_PATH . 'libraries/palaso/Loader.php');

} else {
    $rootPath = realpath(dirname(__FILE__)) . '/';

    define('SRC_PATH', $rootPath);
    define('API_PATH', $rootPath . 'api/');

    require_once (SRC_PATH . 'vendor/autoload.php');

}

define('VERSION', '0.0.0 DEV');
define('BUILD_DATE', '8 October 2013');

?>
