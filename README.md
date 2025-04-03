# Bay Platform Dependencies
Drupal configuration for Bay hosting platform integrations.

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
1. Adds NewRelic transactions for RedisCluster operations (please see docs in patches directory for how to reroll this patch)
