<?php 

namespace vinyvic\Getnet;

use JsonSerializable;

class Order implements JsonSerializable 
{
    private string $orderId;
    private ?float $salesTax;
    private ?string $productType;

    public function __construct(string $orderId, ?float $salesTax = null, ?string $productType = null) {
        $this->orderId = $orderId;
        $this->salesTax = $salesTax;
        $this->productType = $productType;
    }

    public function jsonSerialize() : mixed {
        $order = [
            'order_id' => $this->orderId
        ];

        if ($this->salesTax){
            $order['sales_tax'] = $this->salesTax;
        }
        if ($this->productType){
            $order['product_type'] = $this->productType;
        }

        return $order;
    }
}