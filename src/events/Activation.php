<?php

namespace Wallet\events;

use Wallet\events\Event;
use Money\Money;

class Activation implements Event
{
    protected $callback;
    protected $value;

    public function __construct(string $value)
    {
        $this->value = $value;
        $this->callback = 'activate';
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
