<?php

namespace Idearia;

use Idearia\Logger;
use Psr\Log\AbstractLogger;
use Psr\Log\LogLevel;

/**
 * Description of PS3Logger
 *
 * @author skynin
 */
class PS3Logger extends AbstractLogger {

  private static function contextToName($context, ?string $name = null) {
    if (empty($context)) return $name;

    $context = is_string($context) ? $context : serialize($context);

    return empty($name) ? $context : ($name . ' ' . $context);
  }

  public function log($level, $message, array $context = []): void
  {
    $name = null;
    switch ($level) {
      case LogLevel::EMERGENCY:
      case LogLevel::ALERT:
      case LogLevel::CRITICAL:
      case LogLevel::NOTICE:
        $name = $level;
    }

    switch ($level) {
      case LogLevel::EMERGENCY:
      case LogLevel::ALERT:
      case LogLevel::CRITICAL:
      case LogLevel::ERROR:
        Logger::error($message, self::contextToName($context, $name));
        break;
      case LogLevel::WARNING:
        Logger::warning($message, self::contextToName($context, $name));
        break;
      case LogLevel::NOTICE:
      case LogLevel::INFO:
        Logger::info($message, self::contextToName($context, $name));
        break;
      case LogLevel::DEBUG:
        Logger::debug($message, self::contextToName($context, $name));
        break;
      default :
        Logger::warning($message, self::contextToName($context, $name));
    }
  }
}
