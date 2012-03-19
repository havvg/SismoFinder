# Sismo Configuration

The `SismoFinder` configuration wraps `Sismo` configuration,
therefore you do not loose any feature provided by `Sismo`.

## Basic Example

This is a very basic example, how a distributed project configuration may look like.

```php
<?php // /path/to/workspace/your-project/sismo.config.php.dist

return new Sismo\Project('Your Project (local)', __DIR__);
```

## Advanced Example

For an example of a more elaborated custom configuration see below,
see [Sismo README](https://github.com/fabpot/Sismo/blob/master/README.rst) for more details.

```php
<?php // /path/to/workspace/your-project/sismo.config.php

$notifier = new Sismo\Notifier\DBusNotifier();

$graceName = 'grace';

$grace = new Sismo\Project($graceName);
$grace->setRepository('/home/cordoval/sites-2/'.$graceName);
$grace->setBranch('develop');
$grace->setCommand('/home/cordoval/sites-2/'.$graceName.'/sismo'); // custom command script
$grace->setSlug($graceName);
$grace->setUrlPattern('http://localhost:8000/?p=.git;a=commitdiff;h=%commit%'); // for git instaweb
$grace->addNotifier($notifier);

return $grace;
```
