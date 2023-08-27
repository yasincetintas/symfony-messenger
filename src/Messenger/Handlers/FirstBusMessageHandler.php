<?php

namespace App\Messenger\Handlers;

use App\Entity\Record;
use App\Messenger\Messages\FirstBusMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(bus: 'first.bus', fromTransport: 'async_bus')]
class FirstBusMessageHandler extends AbstractHandler
{
    public function __invoke(FirstBusMessage $message): bool
    {
        $record = new Record();
        $record->setValue($message->getValue());
        $record->setQueue($message->getQueue());
        $this->em->persist($record);
        $this->em->flush();

        return true;
    }
}