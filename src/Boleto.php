<?php 

namespace vinyvic\Getnet;

use JsonSerializable;

class Boleto implements JsonSerializable 
{
    private string $documentNumber;
    private string $expirationDate;
    private string $instructions;
    private string $provider;
    
    public function __construct(string $documentNumber, string $expirationDate, string $instructions, string $provider = 'santander') {
        $this->documentNumber = $documentNumber;
        $this->expirationDate = $expirationDate;
        $this->instructions = $instructions;
        $this->provider = $provider;
    }

    public function jsonSerialize() : mixed {
        return [
            'document_number' => $this->documentNumber,
            'expiration_date' => $this->expirationDate,
            'instructions' => $this->instructions,
            'provider' => $this->provider,
        ];
    }
}