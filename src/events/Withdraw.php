<?php

namespace Wallet\events;

use Wallet\events\Event;
use Money\Money;

class Withdraw implements Event
{
    protected $callback;
    protected $value;

    public function __construct(Money $value)
    {
        $this->value = $value;
        $this->callback = 'withdraw';
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
