<?php

namespace vinyvic\Getnet;

use JsonSerializable;

class Transaction implements JsonSerializable
{

    protected string $sellerId;
    protected int $amount;
    protected string $currency;

    public function __construct(string $sellerId, int $amount, string $currency = "BRL")
    {
        $this->sellerId = $sellerId;
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'seller_id' => $this->sellerId,
            'amount' => $this->amount,
            'currency' => $this->currency,
        ];
    }
}
