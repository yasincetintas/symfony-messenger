<?php

namespace App\Controller;

use App\Entity\Record;
use App\Messenger\Messages\FirstBusMessage;
use App\Messenger\Messages\RabbitMessage;
use App\Messenger\Messages\RedisMessage;
use App\Messenger\Messages\SecondBusMessage;
use App\Messenger\Stamps\ChangeBodyStamp;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\BusNameStamp;
use Symfony\Component\Messenger\Stamp\DelayStamp;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'record_index', methods: ['GET'])]
    public function index(): Response
    {
        $records = $this->entityManager->getRepository(Record::class)->findAll();

        return $this->render('record/index.html.twig', [
            'records' => $records,
        ]);
    }

    #[Route('/record/new', name: 'record_new', methods: ['POST'])]
    public function new(
        Request             $request,
        MessageBusInterface $firstBus,
        MessageBusInterface $secondBus
    ): Response
    {
        $value = $request->request->get('value');
        $queue = $request->request->get('queue');
        if (!is_null($value) && !is_null($queue)) {
            if (in_array($queue, ["first-bus", "second-bus"], true)) {
                $this->busMessenger(
                    $value,
                    $queue,
                    $firstBus,
                    $secondBus
                );
            } else {
                $this->transportMessenger(
                    $value,
                    $queue,
                    $firstBus
                );
            }
        }
        return $this->redirectToRoute('record_index');
    }

    private function busMessenger(
        string              $value,
        string              $queue,
        MessageBusInterface $firstBus,
        MessageBusInterface $secondBus
    ): void
    {
        if ($queue === "first-bus") {
            // Default Bus olan first.bus ile gönderim
            $message = new FirstBusMessage(2, $value, $queue);
            $firstBus->dispatch(new Envelope($message));
        }

        if ($queue === "second-bus") {
            //second . bus ile gönderim
            $message = new SecondBusMessage(1, $value, $queue);
            $secondBus->dispatch(new Envelope($message, [new BusNameStamp('second.bus')]));
        }
    }

    private function transportMessenger(
        string              $value,
        string              $queue,
        MessageBusInterface $messageBus
    ): void
    {
        $stamps = [];
        $message = new FirstBusMessage(1, $value, $queue);
        if ($queue === "rabbit") {
            $message = new RabbitMessage(1, $value, $queue);
//            $stamps[] = new DelayStamp(10000);
        }
        if ($queue === "redis") {
            $message = new RedisMessage(1, $value, $queue);
//            $stamps[] = new ChangeBodyStamp(" [[Redis için Stamp Eklendi]] ");
        }

        $messageBus->dispatch(
            new Envelope(
                $message,
                $stamps
            )
        );
    }
}