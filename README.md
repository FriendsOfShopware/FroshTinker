# FroshTinker

[![Join the chat at https://gitter.im/FriendsOfShopware/Lobby](https://badges.gitter.im/FriendsOfShopware/Lobby.svg)](https://gitter.im/FriendsOfShopware/Lobby)

Inspired by the `artisan tinker` command from laravel this plugin adds a similar command to Shopware. The `frosh:tinker`
command runs in a Shopware CLI environment (like any other command in Shopware) and lets you tinker with existing
objects and classes to your hearts content. Based on the amazing `psy/psysh` library this command provides an
interactive way to test a component or to just play with variables and see how things react to different actions. For
any instruction on how this works or how to operate it, head over to [https://psysh.org/](https://psysh.org/).

Additionally this plugin comes with a caster for Shopware's `ModelEntity` objects that the ORM provides. So if you ask
the ORM for an instance of an entity, that instance will be displayed in its array representation to let you inspect its
members values. You can also add your own casters by implementing the `CasterInterface` and adding it to the
DependencyInjection container with the tag `frosh_tinker.caster`. If you need more information on how casters work, take
a look at the [documentation of Symfony's VarDumper](https://symfony.com/doc/3.4/components/var_dumper/advanced.html#casters).
The only difference here is the `CasterInterface` that is provided by this plugin. While it would be sufficient to
provide a simple callable as a caster, the interface makes it easier to flexibly integrate multiple casters through the
DependencyInjection container.


## Requirements

- Shopware 5.5 or above (older versions might work, but were not tested)
- PHP 7.1 or above


## Installation via composer (recommended)

```
composer require frosh/tinker
bin/console sw:plugin:refresh
bin/console sw:plugin:install FroshTinker
bin/console sw:plugin:activate FroshTinker
bin/console sw:cache:clear
```


## Installation via .zip file

- Download latest release.
- Extract the zip file in `shopware_folder/custom/plugins/`.
- Install plugin via plugin manager in the backend.
- Clear the cache.


## Contributing

Feel free to fork and send pull requests!


## Licence

This project uses the [MIT License](LICENCE.md).
