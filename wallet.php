<?php

require(__DIR__.'/vendor/autoload.php');
use Wallet\Wallet;
use Money\Money;
use Money\Currency;
use Wallet\events\Deposit;
use Wallet\events\Deactivation;
use Wallet\events\Activation;
use Wallet\events\Withdraw;
use Wallet\events\Balance;

$event1 = new Deposit(Money::EUR(10000));
$event2 = new Deactivation('credit card was stolen');
$event3 = new Activation('new credit card was registrated');
$event4 = new Deposit(Money::EUR(10000));
$event5 = new Withdraw(Money::EUR(5000));
$event6 = new Balance();


// $wallet = Wallet::fromEvents([$event1,$event2,$event3, $event4, $event5, $event6]);
// print_r($wallet->getBalance());
// $wallet = new Wallet(Money::EUR(10000));
// print_r($wallet->getBalance());
$operations = [];
unset($argv[0]);
$currency = new Currency($argv[1]);
unset($argv[1]);
$depositsCount = $argv[2];
unset($argv[2]);
validate($depositsCount);
if (count($argv)>=$depositsCount) {
    for ($i=0;$i<$depositsCount;$i++) {
        validate($argv[$i+3]);
        $deposit = new Deposit(new Money($argv[$i+3], $currency));
        $operations[]=$deposit;
    }
    if (count($argv)>=$depositsCount) {
        $withdraw = new Withdraw(new Money($argv[3+$depositsCount], $currency));
        $operations[]=$withdraw;
    }
} else {
    throw new Exception('Declared number of deposit operations does not agree with declared operations');
}

$wallet = Wallet::fromEvents($operations);
print_r($wallet->getBalance());


function validate($input)
{
    if (is_numeric($input) || $input >= 0) {
    } else {
        throw new Exception($input.'must be a positive number');
    }
}
