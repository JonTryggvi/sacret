<?php

$autoload = dirname(__DIR__, 2) . '/vendor/autoload.php';

if (file_exists($autoload)) {
  require_once $autoload;
}

require_once __DIR__ . '/actions_filters.php';
require_once __DIR__ . '/class-sacret-theme-updater.php';

new SacretThemeUpdater();
