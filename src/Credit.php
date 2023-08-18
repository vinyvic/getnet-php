<?php 

namespace vinyvic\Getnet;

use JsonSerializable;

class Credit implements JsonSerializable 
{
    private bool $delayed;
    private bool $preAuthorization;
    private bool $saveCardData;
    private string $transactionType;
    private int $numberInstallments;
    private ?string $softDescriptor;
    private ?int $dynamicMcc;
    private Card $card;
    private ?string $credentialsOnFileType;
    private ?string $transactionId;

    public function __construct(bool $delayed, bool $preAuthorization, bool $saveCardData, string $transactionType, int $numberInstallments, ?string $softDescriptor, ?int $dynamicMcc, Card $card, ?string $credentialsOnFileType = null, ?string $transactionId = null) {
        $this->delayed = $delayed;
        $this->preAuthorization = $preAuthorization;
        $this->saveCardData = $saveCardData;
        $this->transactionType = $transactionType;
        $this->numberInstallments = $numberInstallments;
        $this->softDescriptor = $softDescriptor;
        $this->dynamicMcc = $dynamicMcc;
        $this->card = $card;
        $this->credentialsOnFileType = $credentialsOnFileType;
        $this->transactionId = $transactionId;
    }

    public function jsonSerialize() : mixed {
        // Required Fields
        $data = [
            'delayed' => $this->delayed,
            'pre_authorization' => $this->preAuthorization,
            'save_card_data' => $this->saveCardData,
            'transaction_type' => $this->transactionType,
            'number_installments' => $this->numberInstallments,
            'card' => $this->card,
        ];

        // Optional fields
        if ($this->softDescriptor) {
            $data['soft_descriptor'] = $this->softDescriptor;
        }
        if ($this->dynamicMcc) {
            $data['dynamic_mcc'] = $this->dynamicMcc;
        }
        if ($this->credentialsOnFileType) {
            $data['credentials_on_file_type'] = $this->credentialsOnFileType;
        }
        if ($this->transactionId) {
            $data['transaction_id'] = $this->transactionId;
        }

        return $data;
    }
}