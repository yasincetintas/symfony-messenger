<?php

namespace App\Messenger\Stamps;

use Symfony\Component\Messenger\Stamp\StampInterface;

class ChangeBodyStamp implements StampInterface
{
    private string $addText;

    public function __construct($addText)
    {
        $this->addText = $addText;
    }

    /**
     * @return string
     */
    public function getAddText(): string
    {
        return $this->addText;
    }
}