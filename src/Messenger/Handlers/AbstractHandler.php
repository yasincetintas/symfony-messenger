<?php

namespace App\Messenger\Handlers;

use Doctrine\ORM\EntityManagerInterface;

class AbstractHandler
{

    /**
     * @var EntityManagerInterface
     */
    protected EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
}