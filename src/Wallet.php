<?php
namespace Wallet;

use Money\Money;
use Money\Currency;
use Exception;

class Wallet
{
    protected $active;
    protected $balance;
    protected $events;
    public function __construct(Money $balance)
    {
        $this->activate('account created');

        $this->balance = $balance;
        $this->events = [];
    }

    public static function fromEvents(array $events): Wallet
    {
        $currency = Wallet::getEventsCurrency($events);
        $balance = new Money(0, $currency);
        $wallet = new Wallet($balance);
        foreach ($events as $event) {
            if (method_exists($wallet, $event->getCallback())) {
                call_user_func(array($wallet, $event->getCallback()), $event->getValue());
            }
        }
        return $wallet;
    }

    public static function getEventsCurrency(array $events):Currency
    {
        foreach ($events as $event) {
            if ($event->getValue() instanceof Money) {
                if (isset($previousEvent)) {
                    if ($previousEvent->getValue()->isSameCurrency($event->getValue())) {
                    } else {
                        throw new Exception('Events must operate on the same currency');
                    }
                }
                $previousEvent = $event;
            }
        }

        return $previousEvent->getValue()->getCurrency();
    }

    public function deposit(Money $moneyToDeposit): void
    {
        if ($this->active) {
            $this->balance= $this->getBalance()->add($moneyToDeposit);
        } else {
            throw new Exception('Operation failed. Account is inactive');
        }
    }

    public function withdraw(Money $moneyToWithdraw): void
    {
        if ($this->active) {
            $this->balance= $this->getBalance()->subtract($moneyToWithdraw);
        } else {
            throw new Exception('Operation failed. Account is inactive');
        }
    }

    public function deactivate(string $reason): void
    {
        $this->active = false;
    }

    public function activate(string $reason): void
    {
        $this->active = true;
    }

    public function getBalance(): Money
    {
        return $this->balance;
    }
    
    // ...
}
