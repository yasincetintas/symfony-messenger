<?php

namespace App\Messenger\Middlewares;

use App\Messenger\Messages\FirstBusMessage;
use App\Messenger\Stamps\ChangeBodyStamp;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Middleware\StackInterface;

class FirstBusMiddleware implements MiddlewareInterface
{
    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        if ($envelope->getMessage() instanceof FirstBusMessage){
            /** @var FirstBusMessage $message */
            $message = $envelope->getMessage();
            $midName = 'FirstBusMiddleware';
            $oldMessage = $message->getValue();
            $message->setValue($oldMessage." [[ middleware: {$midName} ]] ");
        }

//        $stamps = $envelope->all();
//        foreach ($stamps as $stamp){
//            if ($stamp[0] instanceof ChangeBodyStamp){
//                $message = $envelope->getMessage();
//                $oldMessage = $message->getValue();
//                $message->setValue($oldMessage." stamp data: ".$stamp[0]->getAddText());
//            }
//        }
        return $stack->next()->handle($envelope, $stack);
    }
}