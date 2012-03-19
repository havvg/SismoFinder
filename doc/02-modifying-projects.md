# Modifying projects

`SismoFinder` returns all projects accessible by there name for further modification.
The following example shows an easy way to modify found projects.

```php
<?php // ~/.sismo/config.php

$loader = new Symfony\Component\ClassLoader\UniversalClassLoader();
$loader->registerNamespaces(array(
    'SismoFinder' => '/Users/havvg/Web Development/SismoFinder/src',
));
$loader->register();

$finder = new SismoFinder\Finder();
$finder->addWorkspace('/Users/havvg/Web Development');

$projects = $finder->getProjects();

// Modify a single project
$projects['php-cctrl']->addNotifier(new Sismo\Notifier\GrowlNotifier(''));

return $projects;
```
