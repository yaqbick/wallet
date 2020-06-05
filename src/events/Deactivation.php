<?php

namespace Wallet\events;

use Wallet\events\Event;
use Money\Money;

class Deactivation implements Event
{
    protected $callback;
    protected $value;

    public function __construct(string $value)
    {
        $this->value = $value;
        $this->callback = 'deactivate';
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getCallback(): string
    {
        return $this->callback;
    }
}
