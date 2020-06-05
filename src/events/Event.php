<?php

namespace Wallet\events;

interface Event
{
    public function getCallback(): string;
    public function getValue();
}
