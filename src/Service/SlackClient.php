<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Service;

use App\Helper\LoggerTrait;
use Nexy\Slack\Client;
use Psr\Log\LoggerInterface;


/**
 * Description of SlackClient
 *
 * @author Dev04
 */
class SlackClient
{

    use LoggerTrait;

    /**
     * @var Client
     */
    private $slack;
    private $logger;

    public function __construct(Client $slack)
    {

        $this->slack = $slack;
    }

    public function sendMessage(string $from, string $message)
    {

        $message = $this->slack->createMessage()
                ->from($from)
                ->withIcon(':ghost:')
                ->setText('Ah, Kirk, my old friend... Version 2 from symfony');
        $this->slack->sendMessage($message);
        if ($this->logger) {
            $this->logInfo('Beaming a message to Slack 2!', [
                'message' => $message
            ]);
        }
    }

    /**
     * 
     * @required
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

}
