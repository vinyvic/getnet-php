<?php

namespace vinyvic\Getnet;

use JsonSerializable;

class SubMerchant implements JsonSerializable
{
    private string $identificationCode;
    private string $documentType;
    private string $documentNumber;
    private string $address;
    private string $city;
    private string $state;
    private string $postalCode;

    public function __construct(string $identificationCode, string $documentType, string $documentNumber, string $address, string $city, string $state, string $postalCode)
    {
        $this->identificationCode = $identificationCode;
        $this->documentType = $documentType;
        $this->documentNumber = $documentNumber;
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->postalCode = $postalCode;
    }

    public function jsonSerialize(): mixed
    {
        $data = [
            'identification_code' => $this->identificationCode,
            'document_type' => $this->documentType,
            'document_number' => $this->documentNumber,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'postal_code' => $this->postalCode
        ];

        return $data;
    }
}
