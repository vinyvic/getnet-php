<?php 

namespace vinyvic\Getnet;

use JsonSerializable;

class Address implements JsonSerializable 
{
    private string $street;
    private string $number;
    private string $complement;
    private string $district;
    private string $city;
    private string $state;
    private string $country;
    private string $postalCode;

    public function __construct(string $street, string $number, string $complement, string $district, string $city, 
        string $state, string $country, string $postalCode) {  
        $this->street = $street;
        $this->number = $number;
        $this->complement = $complement;
        $this->district = $district;
        $this->city = $city;
        $this->state = $state;
        $this->country = $country;
        $this->postalCode = $postalCode;
    }

    public function jsonSerialize() : mixed {   
        // Required Fields
        $data = [
            'street' => $this->street,
            'number' => $this->number,
            'complement' => $this->complement,
            'district' => $this->district,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'postal_code' => $this->postalCode
        ];

        return $data;
    }
}