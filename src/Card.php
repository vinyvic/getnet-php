<?php

namespace vinyvic\Getnet;

use JsonSerializable;

class Card implements JsonSerializable
{
    private string $numberToken;
    private string $cardholderName;
    private string $securityCode;
    private ?string $brand; // "Mastercard" "Visa" "Amex" "Elo" "Hipercard" - Preenchido automaticamente pela API caso não seja informado.
    private string $expirationMonth;
    private string $expirationYear;

    public function __construct(string $numberToken, string $cardholderName, string $securityCode, string $expirationMonth, string $expirationYear, ?string $brand = null)
    {
        $this->numberToken = $numberToken;
        $this->cardholderName = $cardholderName;
        $this->securityCode = $securityCode;
        $this->expirationMonth = $expirationMonth;
        $this->expirationYear = $expirationYear;
        $this->brand = $brand;
    }

    public function jsonSerialize(): mixed
    {
        // Required Fields
        $data = [
            'number_token' => $this->numberToken,
            'cardholder_name' => $this->cardholderName,
            'security_code' => $this->securityCode,
            'expiration_month' => $this->expirationMonth,
            'expiration_year' => $this->expirationYear,
        ];

        // Optional Fields
        if ($this->brand) {
            $data['brand'] = $this->brand;
        }

        return $data;
    }
}
