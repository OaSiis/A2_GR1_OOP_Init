<?php

session_start();

/** @var \Doctrine\ORM\EntityManager $em */
$em = require __DIR__.'/bootstrap.php';

/** TWIG */
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem([
    __DIR__.'/views',
]);


$twig = new Twig_Environment($loader,[
//'cache' => null,
]);


