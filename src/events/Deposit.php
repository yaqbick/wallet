<?php

namespace Wallet\events;

use Wallet\events\Event;
use Money\Money;

class Deposit implements Event
{
    protected $callback;
    protected $value;

    public function __construct(Money $value)
    {
        $this->value = $value;
        $this->callback = 'deposit';
    }

    public function getValue(): Money
    {
        return $this->value;
    }

    public function getCallback(): string
    {
        return $this->callback;
    }
}
