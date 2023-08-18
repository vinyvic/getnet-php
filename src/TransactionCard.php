<?php 

namespace vinyvic\Getnet;

class TransactionCard extends Transaction 
{
    private Order $order;
    private Customer $customer;
    private ?Device $device;
    private ?Shippings $shippings;
    private Credit $credit;

    public function __construct(string $sellerId, int $amount, string $currency, Order $order, Customer $customer, Credit $credit, ?Device $device = null, ?Shippings $shippings = null) {
        parent::__construct($sellerId, $amount, $currency);

        // Required fields
        $this->order = $order;
        $this->customer = $customer;
        $this->credit = $credit;
        $this->device = $device;
        $this->shippings = $shippings;
    }

    public function jsonSerialize() : mixed {
        // required Fields 
        $data = array_merge(parent::jsonSerialize(), [
            'order' => $this->order,
            'customer' => $this->customer,
            'credit' => $this->credit,
        ]);

        // Optional Fields
        if ($this->device) {
            $data['device'] = $this->device;
        }
        if ($this->shippings) {
            $data['shippings'] = [$this->shippings];
        }

        return $data;
    }
}