---
layout: base
---
## Usage Examples

An example workspace at `/Users/havvg/Web Development/`.

### Modifying Projects

The projects `SismoFinder` retrieves are easily accessible for further modifications.
`SismoFinder` returns all projects accessible by their names for further modification.
The following example shows an easy way to modify found projects.

{% highlight php %}
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
{% endhighlight %}

### Multiple Branches

This example shows how to provide a set of branches within one `SismoFinder` configuration.
`SismoFinder` merges the provided array into the already found projects.

{% highlight php %}
<?php // /path/to/workspace/your-project/sismo.config.php.dist

$branches = array(
    'develop',
    'master',
);

$projects = array();
foreach ($branches as $eachBranch) {
    $project = new Sismo\Project('Your Project ('.$eachBranch.')', __DIR__);
    $project->setBranch($eachBranch);

    // further modifications

    $projects[] = $project;
}

return $project;
{% endhighlight %}
