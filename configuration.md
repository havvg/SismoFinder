---
layout: base
---
## Configuration

### Configuring the project

`SismoFinder` by default looks for two files `sismo.config.php` and if not found `sismo.config.php.dist`.

* Package the `sismo.config.php.dist` within your project.
* Add the `sismo.config.php` to your `.gitignore`.

#### Example SismoFinder configuration file

This is a very basic example, how a distributed project configuration may look like.

{% highlight php %}
<?php // /path/to/workspace/your-project/sismo.config.php.dist

return new Sismo\Project('Your Project (local)', __DIR__);
{% endhighlight %}

### Configuring Sismo with SismoFinder

There is no need to include or require anything `Sismo` already provides, as the configuration is run inside of `Sismo`.
For example, the `UniversalClassLoader` is defined.

#### Replacement

SismoFinder may be used as a complete replacement of a manually created Sismo configuration. You only need to:

{% highlight php %}
<?php // ~/.sismo/config.php

// 1. add your SismoFinder installation to the autoloader
$loader = new Symfony\Component\ClassLoader\UniversalClassLoader();
$loader->registerNamespaces(array(
    'SismoFinder' => '/Users/havvg/Web Development/SismoFinder/src',
));
$loader->register();

// 2. create a new SismoFinder
$finder = new SismoFinder\Finder();

// 3. add your workspace(s)
$finder->addWorkspace('/Users/havvg/Web Development');

// 4. return the projects found by SismoFinder
return $finder->getProjects();
{% endhighlight %}

#### Addition

Instead of replacing the Sismo configuration completely,
you may want to also include projects that are not in your default workspaces.

{% highlight php %}
<?php // ~/.sismo/config.php

// 1. add your SismoFinder installation to the autoloader
$loader = new Symfony\Component\ClassLoader\UniversalClassLoader();
$loader->registerNamespaces(array(
    'SismoFinder' => '/Users/havvg/Web Development/SismoFinder/src',
));
$loader->register();

// 2. create a new SismoFinder
$finder = new SismoFinder\Finder();

// 3. add your workspace(s)
$finder->addWorkspace('/Users/havvg/Web Development');

// 4. retrieve projects from your workspace(s)
$projects = $finder->getProjects();

// 5. add projects outside of all workspaces
$projects[] = new Sismo\Project('Project D (local)', '/Users/havvg/Project D/');

// 6. return all projects
return $projects;
{% endhighlight %}
