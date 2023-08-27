<?php

namespace App\Messenger\Handlers;

use App\Entity\Record;
use App\Messenger\Messages\SecondBusMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(bus: 'second.bus', fromTransport: 'async_bus')]
class SecondBusMessageHandler extends AbstractHandler
{
    public function __invoke(SecondBusMessage $message): bool
    {
        $record = new Record();
        $record->setValue($message->getValue());
        $record->setQueue($message->getQueue());
        $this->em->persist($record);
        $this->em->flush();

        return true;
    }
}