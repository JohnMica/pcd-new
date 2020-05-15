> This theme is in active development, use `master` branch for the latest stable version.

# Starter theme for Grav CMS

PublicCodeDirectory theme for [Grav CMS](https://github.com/getgrav/grav) using modern tools and frameworks such as [Laravel Mix](https://github.com/JeffreyWay/laravel-mix), [Vuejs](https://github.com/vuejs/vue), [Bulma](https://github.com/jgthms/bulma).

## Features

- Laravel Mix
- Vuejs
- Bulma
- Buefy

## Installation / Usage

### Manual installation

```shell
# @ path/to/grav/installation
$ cd user/themes/
$ git clone https://github.com/JohnMica/public-code-directory.git
$ cd public-code-directory
$ yarn && yarn production
```

### Activate theme

After installation navigate to `user/config/system.yaml` and update the theme:

```yaml
pages:
  theme: public-code-directory
```

### Demo

Installing through bin/gpm will prompt you to install the demo content automatically.

However if you install the theme manually, copy the contents of `user/themes/public-code-directory/_demo/pages/` into your `user/pages/` folder for a quick demo content of your site.

### Laravel Mix

Laravel Mix is preconfigured when installing a fresh instance of this theme. However it might be a good idea to review the full documentation [on GitHub.](https://github.com/JeffreyWay/laravel-mix/tree/master/docs#readme)

```shell
# Compile assets without minification
$ yarn dev

# Watch working assets
$ yarn watch

# Minify and compile assets for production
$ yarn production
```

> Compiled assets goes into the `dist/` directory, these files are generated for you through Laravel Mix, you should **not** edit these files manually! Your working directory is `resources/`.

## Updating

## Contribute

If you're interested in contributing, please read the [contribution guidelines.](.github/CONTRIBUTING.md)

## Credits

- [Robbin Johansson](https://github.com/robbinfellow)
- [John Mica](https://JohnMica)
- [All Contributors](https://github.com/robbinfellow/public-code-directory-grav/graphs/contributors)

## License

PublicCodeDirectory grav theme is an open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
