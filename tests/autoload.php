<?php

require_once __DIR__.'/../vendor/Symfony/Component/ClassLoader/UniversalClassLoader.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'SismoFinder' => __DIR__.'/../src',
    'Symfony' => __DIR__.'/../vendor',
    'Sismo' => __DIR__.'/../vendor/Sismo/src',
));
$loader->register();
