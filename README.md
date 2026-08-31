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
- Provides the optional `marina_cf_cachetags` module. It sends cacheable
  responses' Drupal cache tags in the `x-amz-meta-cache-tag` header and
  invalidates those tags through the local CloudFront SigV4 sidecar.

### CloudFront cache tags

Enable the submodule with:

```sh
drush en marina_cf_cachetags
```

The module configures Purge's HTTP bundled purger to send a `POST` request to
`http://localhost:8083/prod/cache-invalidation/{project}/{environment}` with a JSON
body containing the comma-separated tags:

```json
{"tagsCsv":"tag:node:123"}
```

Purge processes invalidations at the end of the request with its late-runtime
processor. Override the `httppurgersettings.settings.marina_cf_cachetags`
configuration with the deployment's project and environment names.

## Patches

### Redis

This module handles patching of the [Redis](https://www.drupal.org/project/redis) module with a few key features

1. Adds support for RedisCluster client.
1. Uses the current [RedisCluster upstream patch](https://www.drupal.org/project/redis/issues/2900947).
1. Preserves the configured TLS context during RedisCluster node discovery.
