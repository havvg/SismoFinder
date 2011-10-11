# Installation

## Production usage

Step 1 is to download `SismoFinder` itself.
The following commands will install SismoFinder under the `/path/to/place/SismoFinder/` directory.

```sh
cd /path/to/place/
git clone https://github.com/havvg/SismoFinder.git
```

After cloning SismoFinder, you can use it right away, see [README.md](README.md) on how to do this!

## Running tests

In order to be able to run the tests, you only have to grab the submodules of `SismoFinder`.

```sh
cd /path/to/place/SismoFinder/
git submodule update --init --recursive
```

Run the tests by issuing the `phpunit` command.
