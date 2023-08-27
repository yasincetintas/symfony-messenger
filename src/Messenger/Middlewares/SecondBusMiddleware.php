<?php

namespace App\Messenger\Middlewares;

use App\Messenger\Messages\SecondBusMessage;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Middleware\StackInterface;

class SecondBusMiddleware implements MiddlewareInterface
{
    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        if ($envelope->getMessage() instanceof SecondBusMessage) {
            /** @var SecondBusMessage $message */
            $message = $envelope->getMessage();
            $midName = 'SecondBusMiddleware';
            $oldMessage = $message->getValue();
            $message->setValue($oldMessage ." [[ middleware: {$midName} ]] ");
        }
        return $stack->next()->handle($envelope, $stack);
    }
}