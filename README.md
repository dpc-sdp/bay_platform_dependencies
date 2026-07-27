# Bay Platform Dependencies
Drupal configuration for Bay hosting platform integrations.

## Development

All PHP tooling runs in the development container, so PHP, Composer, and
extensions are not installed on the host. The container provides PHP 8.3 with
the extensions required by `composer.json`, Composer, Drupal coding standards,
PHP_CodeSniffer, and Intelephense.

### VS Code

Install the [Dev Containers extension](https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.remote-containers),
open this repository, then run **Dev Containers: Reopen in Container**. The
container automatically installs the PHP IntelliSense and Xdebug extensions.

### Command line

Install the Dev Container CLI once (it requires Node.js, but does not install
PHP on the host):

```sh
npm install -g @devcontainers/cli
```

Start the container from the repository root:

```sh
devcontainer up --workspace-folder .
```

Common commands:

```sh
devcontainer exec --workspace-folder . composer validate
devcontainer exec --workspace-folder . composer install \
  --prefer-dist --no-progress
devcontainer exec --workspace-folder . tools/vendor/bin/phpcs \
  --standard=phpcs.xml.dist
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
1. Adds NewRelic transactions for RedisCluster operations (please see docs in
   patches directory for how to reroll this patch)
