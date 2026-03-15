<?php

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

class SacretThemeUpdater {
  private const REPOSITORY_URL = 'https://github.com/JonTryggvi/sacret/';
  private const THEME_FILE = '/functions.php';
  private const THEME_SLUG = 'sacret';

  public function __construct() {
    add_action('init', [$this, 'initializeUpdateChecker']);
  }

  public function initializeUpdateChecker(): void {
    if (!class_exists(PucFactory::class)) {
      return;
    }

    $updateChecker = PucFactory::buildUpdateChecker(
      self::REPOSITORY_URL,
      get_template_directory() . self::THEME_FILE,
      self::THEME_SLUG
    );

    $updateChecker->getVcsApi()->enableReleaseAssets('/\.zip($|[?&#])/i');

    $token = $this->getGithubToken();
    if ($token !== '') {
      $updateChecker->setAuthentication($token);
    }
  }

  private function getGithubToken(): string {
    $token = '';

    if (defined('SACRET_GITHUB_TOKEN') && is_string(SACRET_GITHUB_TOKEN)) {
      $token = SACRET_GITHUB_TOKEN;
    }

    $token = apply_filters('sacret_github_token', $token);

    return is_string($token) ? trim($token) : '';
  }
}
