<?php

$projectRoot = dirname(__DIR__);
require_once($projectRoot . '/vendor/autoload.php');

new \SimpleSAML\Error\ConfigurationError('Load to prevent class resolution issues with aspectMock');

// Enable AspectMock. This allows us to stub/double out static methods.
$kernel = \AspectMock\Kernel::getInstance();
$kernel->init([
    'debug' => true,
    // Any class that we want to stub/mock needs to be in included paths
    'includePaths' => [
        $projectRoot . '/vendor/simplesamlphp/simplesamlphp/',
    ],
]);
// AspectMock seems to have trouble with SSP's custom class loader. We must explicitly load them
// In addition you need to load a class hiearchy from parent down to child, otherwise it can get confused
$kernel->loadFile($projectRoot . '/vendor/simplesamlphp/simplesamlphp/lib/SimpleSAML/Auth/Source.php');
//$kernel->loadFile($projectRoot . '/vendor/simplesamlphp/simplesamlphp/lib/SimpleSAML/Session.php');

