# Bay Platform Dependencies
Drupal configuration for Bay hosting platform integrations.

## Features
- Ensures dependencies required for the Bay hosting platform are installed.
- Allows configuring the default `Reply-To` email address via `SMTP_REPLYTO`
  environment variable.
- Adds validation to webform email handler form, restricting configuration 
  emails configured in SMTP_WHITELIST envvar.
