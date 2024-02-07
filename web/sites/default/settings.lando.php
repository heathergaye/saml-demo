<?php

$databases['default']['default'] = array (
  'database' => 'drupal10',
  'username' => 'drupal10',
  'password' => 'drupal10',
  'prefix' => '',
  'host' => 'database',
  'port' => '',
  'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
  'driver' => 'mysql',
);

$settings['file_private_path'] = '/app/site/private/default';
$settings['file_temporary_path'] = '/tmp';

$settings['hash_salt'] = hash('sha256', 'saml-demo');

$settings['twig_debug'] = TRUE;
$config['system.performance']['css']['preprocess'] = FALSE;
$config['system.performance']['js']['preprocess'] = FALSE;

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

// Symfony mailer MailHog settings override
$config['symfony_mailer.mailer_transport.smtp']['configuration']['user'] = 'mailhog';
$config['symfony_mailer.mailer_transport.smtp']['configuration']['pass'] = 'mailhog';
$config['symfony_mailer.mailer_transport.smtp']['configuration']['host'] = 'mailhog';
$config['symfony_mailer.mailer_transport.smtp']['configuration']['port'] = '1025';
$config['symfony_mailer.mailer_transport.smtp']['configuration']['encryption'] = '0';

$config['config_split.config_split.local_sync']['status'] = TRUE;
