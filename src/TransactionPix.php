<?php

namespace vinyvic\Getnet;

/**
 * Registro para pagamento com boleto
 */
class TransactionPix extends Transaction
{
    private ?string $orderId;
    private ?string $customerId;

    public function __construct(string $sellerId, int $amount, string $currency, ?string $orderId = null, ?string $customerId = null)
    {
        parent::__construct($sellerId, $amount, $currency);

        $this->orderId = $orderId;
        $this->customerId = $customerId;
    }

    public function jsonSerialize(): mixed
    {
        // Required fields
        $data = [
            'amount' => $this->amount,
            'currency' => $this->currency
        ];

        // Optional fields
        if ($this->orderId) {
            $data['order_id'] = $this->orderId;
        }
        if ($this->customerId) {
            $data['customer_id'] = $this->customerId;
        }

        return $data;
    }

    public function getSellerId(): string
    {
        return $this->sellerId;
    }
}
