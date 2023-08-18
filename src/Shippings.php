<?php

namespace vinyvic\Getnet;

use JsonSerializable;

class Shippings implements JsonSerializable
{
    private string $firstName;
    private string $name;
    private string $email;
    private string $phoneNumber;
    private float $shippingAmount;
    private Address $address;

    public function __construct(string $firstName, string $name, string $email, string $phoneNumber, float $shippingAmount, Address $address)
    {
        $this->firstName = $firstName;
        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->shippingAmount = $shippingAmount;
        $this->address = $address;
    }

    public function jsonSerialize(): mixed
    {
        $data = [
            'first_name' => $this->firstName,
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phoneNumber,
            'shipping_amount' => $this->shippingAmount,
            'address' => $this->address,
        ];

        return $data;
    }
}
