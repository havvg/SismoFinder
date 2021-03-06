# SismoFinder

[![Build Status](https://secure.travis-ci.org/havvg/SismoFinder.png)](http://travis-ci.org/havvg/SismoFinder)

`SismoFinder` is a simple wrapper around the configuration file of `Sismo`.
There are two major benefits when using SismoFinder as a replacement or addition to your Sismo configuration file.

The actual project's configuration for a Sismo project is saved within the project itself.
Thus there is no need to setup each new project within Sismo.

The configuration for Sismo is shared among the collaborators of the project.

## Installation

See [INSTALL.md](INSTALL.md) for instructions on how to install `SismoFinder`.

## Configuration

`SismoFinder` by default looks for two files `sismo.config.php` and if not found `sismo.config.php.dist`.

* Package the `sismo.config.php.dist` within your project.
* Add the `sismo.config.php` to your `.gitignore`.

### Example SismoFinder configuration file

This is a very basic example, how a distributed project configuration may look like,
see [Sismo README](https://github.com/fabpot/Sismo/blob/master/README.rst) for more details.

```php
<?php // /path/to/workspace/your-project/sismo.config.php.dist

return new Sismo\Project('Your Project (local)', __DIR__);
```

For more configuration examples take a look into the `doc` folder.

## Usage

An example workspace at `/Users/havvg/Web Development/`.
There is no need to include or require anything `Sismo` already provides, as the configuration is run inside of `Sismo`.
For example, the `UniversalClassLoader` is defined.

The projects `SismoFinder` retrieves are easily accessible for further modifications.

### Replacement

```php
<?php // ~/.sismo/config.php

$loader = new Symfony\Component\ClassLoader\UniversalClassLoader();
$loader->registerNamespaces(array(
    'SismoFinder' => '/Users/havvg/Web Development/SismoFinder/src',
));
$loader->register();

$finder = new SismoFinder\Finder();
$finder->addWorkspace('/Users/havvg/Web Development');

return $finder->getProjects();
```

### Addition

```php
<?php // ~/.sismo/config.php

$loader = new Symfony\Component\ClassLoader\UniversalClassLoader();
$loader->registerNamespaces(array(
    'SismoFinder' => '/Users/havvg/Web Development/SismoFinder/src',
));
$loader->register();

// create a Growl notifier (for OSX)
$notifier = new Sismo\Notifier\GrowlNotifier('');

$finder = new SismoFinder\Finder();
$finder->addWorkspace('/Users/havvg/Web Development');

$projects = $finder->getProjects();

// A project outside of all workspaces
$projects[] = new Sismo\Project('Project D (local)', '/Users/havvg/Project D/', $notifier);

return $projects;
```

For more usage examples, see the examples in the `doc` folder.
