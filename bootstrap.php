<?php

require __DIR__.'/vendor/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = [
    "src",
];
$isDevMode = true;

// the connection configuration
$dbParams = include __DIR__.'/config/config.php';


$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);

return EntityManager::create($dbParams, $config);