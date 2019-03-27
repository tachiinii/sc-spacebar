<?php
/**
 * Created by PhpStorm.
 * User: wilsonc
 * Date: 3/27/19
 * Time: 1:06 AM
 */

namespace App\Service;


use App\Helper\LoggerTrait;
use Nexy\Slack\Client;

class SlackClient
{

  use LoggerTrait;
  private $slack;

  public function __construct(Client $slack) {
    $this->slack = $slack;
  }

  public function sendMessage(string $from, string $message) {

    $this->logInfo('Giving daps thru Slack, yo.', [
      'message' => $message,
    ]);

    $slackMessage = $this->slack->createMessage();

    $slackMessage
      ->from($from)
      ->withIcon(':ghost:')
      ->setText($message)
    ;

    $this->slack->sendMessage($slackMessage);
  }
}