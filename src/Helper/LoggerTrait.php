<?php
/**
 * Created by PhpStorm.
 * User: wilsonc
 * Date: 3/27/19
 * Time: 1:27 AM
 */

namespace App\Helper;

use Psr\Log\LoggerInterface;

trait LoggerTrait
{
  /**
   * @var LoggerInterface|null
   */
  private $logger;

  /**
   * @required
   */
  public function setLogger(LoggerInterface $logger) {
    $this->logger = $logger;
  }

  public function logInfo(string $message, array $context = []) {
    if ($this->logger) {
      $this->logger->info($message, $context);
    }
  }
}