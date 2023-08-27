<?php

namespace App\Messenger\Messages;

class SecondBusMessage
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $value;

    /**
     * @var string
     */
    private string $queue;

    public function __construct(
        $id,
        $value,
        $queue
    )
    {
        $this->id = $id;
        $this->value = $value;
        $this->queue = $queue;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param int $id
     * @return FirstBusMessage
     */
    public function setId(int $id): SecondBusMessage
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param string $value
     * @return FirstBusMessage
     */
    public function setValue(string $value): SecondBusMessage
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getQueue(): string
    {
        return $this->queue;
    }

    /**
     * @param string $queue
     * @return $this
     */
    public function setQueue(string $queue): SecondBusMessage
    {
        $this->queue = $queue;

        return $this;
    }
}