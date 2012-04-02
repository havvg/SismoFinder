---
layout: base
---
## Production usage

**Step 1** is to download `SismoFinder` itself.
The following commands will install SismoFinder under the `/path/to/place/SismoFinder/` directory.

{% highlight text %}
cd /path/to/place/
{% endhighlight %}

{% highlight text %}
git clone https://github.com/havvg/SismoFinder.git
{% endhighlight %}

**Step 2** is [configuring SismoFinder](configuration.html)

**Step 3** is [using SismoFinder](usage.html)

## Running tests

In order to be able to run the tests, you only have to grab the submodules of `SismoFinder`.

{% highlight text %}
cd /path/to/place/SismoFinder/
{% endhighlight %}

{% highlight text %}
git submodule update --init --recursive
{% endhighlight %}

Run the tests by issuing the `phpunit` command.
