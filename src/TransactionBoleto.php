<?php

namespace vinyvic\Getnet;

/**
 * Registro para pagamento com boleto
 */
class TransactionBoleto extends Transaction
{
    private Order $order;
    private Boleto $boleto;
    private Customer $customer;

    public function __construct(string $sellerId, int $amount, string $currency, Order $order, Boleto $boleto, Customer $customer)
    {
        parent::__construct($sellerId, $amount, $currency);

        // Required fields
        $this->order = $order;
        $this->boleto = $boleto;
        $this->customer = $customer;
    }

    public function jsonSerialize(): mixed
    {
        return array_merge(parent::jsonSerialize(), [
            'order' => $this->order,
            'boleto' => $this->boleto,
            'customer' => $this->customer
        ]);
    }
}
