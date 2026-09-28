<?php

declare(strict_types=1);

namespace Drupal\marina_test_mail\Commands;

use Drupal\Core\Language\LanguageManagerInterface;
use Drupal\Core\Mail\MailManagerInterface;
use Drush\Commands\DrushCommands;

/**
 * Drush commands for sending test email via Drupal mail system.
 */
final class MarinaTestMailCommands extends DrushCommands {

  /**
   * Constructs the command service.
   */
  public function __construct(
    private readonly MailManagerInterface $mailManager,
    private readonly LanguageManagerInterface $languageManager,
  ) {
    parent::__construct();
  }

  /**
   * Sends a test email via Drupal's configured mail backend.
   *
   * @command marina-test-mail:send
   * @aliases mtsm
   * @param string $recipient
   *   The recipient email address.
   * @option from
   *   Optional custom sender address.
   * @option reply-to
   *   Optional custom Reply-To address.
   * @usage drush marina-test-mail:send user@example.com
   * @usage drush marina-test-mail:send user@example.com --from=no-reply@example.com --reply-to=support@example.com
   */
  public function send(string $recipient, array $options = ['from' => NULL, 'reply-to' => NULL]): void {
    $from = $options['from'];
    $replyTo = $options['reply-to'];

    $this->assertEmail($recipient, 'recipient');

    if ($from !== NULL) {
      $this->assertEmail($from, 'from');
    }

    if ($replyTo !== NULL) {
      $this->assertEmail($replyTo, 'reply-to');
    }

    $params = [
      'timestamp' => (new \DateTimeImmutable())->format(DATE_ATOM),
      'hostname' => \gethostname() ?: \php_uname('n'),
      'reply_to' => $replyTo,
    ];

    $result = $this->mailManager->mail(
      'marina_test_mail',
      'smtp_test',
      $recipient,
      $this->languageManager->getDefaultLanguage()->getId(),
      $params,
      $from,
      TRUE,
    );

    if (!($result['result'] ?? FALSE)) {
      throw new \RuntimeException('Drupal mail manager failed to send the test email.');
    }

    $this->logger()->success(dt('Sent test email to @recipient.', ['@recipient' => $recipient]));
  }

  /**
   * Validates an email address option.
   */
  private function assertEmail(string $email, string $label): void {
    if (\filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
      throw new \InvalidArgumentException(sprintf('Invalid %s email address: %s', $label, $email));
    }
  }

}
