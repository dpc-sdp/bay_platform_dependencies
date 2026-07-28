# Bay Platform Dependencies

Drupal configuration for Bay hosting platform integrations.

## Development

Develop and validate this module on the host. It requires PHP 8.3, Composer,
and the PHP extensions declared in `composer.json`: `gd`, `igbinary`, `redis`,
`pdo_mysql`, `zip`, and `zlib`.

### Getting started

Install the module dependencies and the pinned development tools:

```sh
composer install --prefer-dist --no-progress --no-interaction
composer --working-dir=tools install --prefer-dist --no-progress --no-interaction
```

### Validating a build

Run the same Composer validation and dependency installation performed by CI:

```sh
composer validate
composer install --prefer-dist --no-progress --no-interaction
```

Run coding-standard checks with:

```sh
tools/vendor/bin/phpcs --standard=phpcs.xml.dist
```

## Features

- Ensures dependencies required for the Bay hosting platform are installed.
- Allows configuring the default `Reply-To` email address via `SMTP_REPLYTO`
  environment variable.
- Adds validation to webform email handler form, restricting configuration
  emails configured in SMTP_WHITELIST envvar.

## Patches

### Redis

This module handles patching of the [Redis](https://www.drupal.org/project/redis) module with a few key features

1. Adds support for RedisCluster client.
1. Uses the current [RedisCluster upstream patch](https://www.drupal.org/project/redis/issues/2900947).
1. Preserves the configured TLS context during RedisCluster node discovery.
