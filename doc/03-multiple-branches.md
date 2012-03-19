# Multiple Branches

This example shows how to provide a set of branches within one `SismoFinder` configuration.
`SismoFinder` merges the provided array into the already found projects.

```php
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
```
