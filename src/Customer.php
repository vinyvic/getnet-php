<?php 

namespace vinyvic\Getnet;

use JsonSerializable;

class Customer implements JsonSerializable {
    private string $customerId;
    private Address $billingAddress;
    private ?string $firstName;
    private ?string $lastName;
    private ?string $name;
    private ?string $email;
    private ?string $documentType;
    private ?string $documentNumber;
    private ?string $phoneNumber;

    public function __construct(string $customerId, Address $billingAddress, ?string $firstName = null, ?string $lastName = null, ?string $name = null, ?string $email = null, ?string $documentType = null, ?string $documentNumber = null, ?string $phoneNumber = null) {
        $this->customerId = $customerId;
        $this->billingAddress = $billingAddress;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->name = $name;
        $this->email = $email;
        $this->documentType = $documentType;
        $this->documentNumber = $documentNumber;
        $this->phoneNumber = $phoneNumber;
    }

    public function jsonSerialize(): mixed {
        // Required fields
        $data = [
            'customer_id' => $this->customerId,
            'billing_address' => $this->billingAddress
        ];

        // Optional fields
        if ($this->firstName !== null){
            $data['first_name'] = $this->firstName;
        }
        if ($this->lastName !== null){
            $data['last_name'] = $this->lastName;
        }
        if ($this->name !== null){
            $data['name'] = $this->name;
        }
        if ($this->email !== null){
            $data['email'] = $this->email;
        }
        if ($this->documentType !== null){
            $data['document_type'] = $this->documentType;
        }
        if ($this->documentNumber !== null){
            $data['document_number'] = $this->documentNumber;
        }
        if ($this->phoneNumber !== null){
            $data['phone_number'] = $this->phoneNumber;
        }
        
        return $data;
    }
}