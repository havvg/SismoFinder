# SismoFinder

``SismoFinder`` is a simple wrapper around the configuration file of ``Sismo``.
There are two major benefits when using SismoFinder as a replacement or addition to your Sismo configuration file.

The actual project's configuration for a Sismo project is saved within the project itself.
Thus there is no need to setup each new project within Sismo.

The configuration for Sismo is shared among the collaborators of the project.

## Installation

```sh
cd /Users/havvg/Web Development/ // or whatever your projects folder
git clone https://github.com/havvg/SismoFinder.git sismoFinder
cd sismoFinder
git submodule init
git submodule update --recursive
```

## Configuration

`SismoFinder` by default looks for two files `sismo.config.php` and if not found `sismo.config.php.dist`.

* Package the `sismo.config.php.dist` within your project.
* Add the `sismo.config.php` to your `.gitignore`.

## Usage

An example workspace at `/Users/havvg/Web Development/`.
There is no need to include or require anything `Sismo` already provides, as the configuration is run inside of `Sismo`.
For example, the `UniversalClassLoader` is defined.

### Replacement

```php
<?php // ~/.sismo/config.php

$loader = new Symfony\Component\ClassLoader\UniversalClassLoader();
$loader->registerNamespaces(array(
    'SismoFinder' => '/Users/havvg/Web Development/SismoFinder/src',
));
$loader->register();

$finder = new \SismoFinder\Finder();
$finder->addWorkspace('/Users/havvg/Web Development');

return $finder->getProjects();
```

### Addition

```php
<?php // ~/.sismo/config.php

// create a Growl notifier (for OSX)
$notifier = new Sismo\GrowlNotifier('');

// create a DBus notifier (for Linux)
$notifier = new Sismo\DBusNotifier();

$loader = new Symfony\Component\ClassLoader\UniversalClassLoader();
$loader->registerNamespaces(array(
    'SismoFinder' => '/Users/havvg/Web Development/SismoFinder/src',
));
$loader->register();

$finder = new \SismoFinder\Finder();
$finder->addWorkspace('/Users/havvg/Web Development');

$projects = $finder->getProjects();

// A project outside of all workspaces
$projects[] = new Sismo\Project('Project D (local)', '/Users/havvg/Project D/', $notifier);

return $projects;
```

## Example SismoFinder configuration file

This is a very basic example, how a distributed project configuration may look like.

```php
<?php // /path/to/workspace/your-project/sismo.config.php.dist

return new Sismo\Project('Your Project (local)', __DIR__);
```

For an example of a more elaborated custom configuration see below:

```php
<?php // /path/to/workspace/your-project/sismo.config.php

$notifier = new Sismo\DBusNotifier();
 
$graceName = 'grace';
 
$grace = new Sismo\Project($graceName);
$grace->setRepository('/home/cordoval/sites-2/'.$graceName);
$grace->setBranch('develop');
$grace->setCommand('/home/cordoval/sites-2/'.$graceName.'/sismo'); // custom command script
$grace->setSlug($graciaName);
$grace->setUrlPattern('http://localhost:8000/?p=.git;a=commitdiff;h=%commit%'); // for git instaweb
$grace->addNotifier($notifier);
 
return $grace;
```

Contributors:

- Toni Uebernickel
- Luis Cordova cordoval@gmail.com