<?php 

namespace vinyvic\Getnet;

use JsonSerializable;

class Card implements JsonSerializable 
{
    private string $numberToken;
    private string $cardholderName;
    private string $securityCode;
    private string $brand;
    private string $expirationMonth;
    private string $expirationYear;

    public function __construct(string $numberToken, string $cardholderName, string $securityCode, string $brand, string $expirationMonth, string $expirationYear) {
        $this->numberToken = $numberToken;
        $this->cardholderName = $cardholderName;
        $this->securityCode = $securityCode;
        $this->brand = $brand;
        $this->expirationMonth = $expirationMonth;
        $this->expirationYear = $expirationYear;
    }

    public function jsonSerialize() : mixed {
        $data = [
            'number_token' => $this->numberToken,
            'cardholder_name' => $this->cardholderName,
            'brand' => $this->brand,
            'security_code' => $this->securityCode,
            'expiration_month' => $this->expirationMonth,
            'expiration_year' => $this->expirationYear,
        ];

        return $data;
    }
}