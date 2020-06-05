<?php

namespace Wallet\events;

use Wallet\events\Event;
use Money\Money;

class Balance implements Event
{
    protected $callback;
    protected $value;

    public function __construct()
    {
        $this->value = 'balance';
        $this->callback = 'getBalance';
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
