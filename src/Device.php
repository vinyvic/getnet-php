<?php

namespace vinyvic\Getnet;

use JsonSerializable;

class Device implements JsonSerializable
{

    private string $ipAddress;
    private string $deviceId;

    public function __construct(string $ipAddress, string $deviceId)
    {
        $this->ipAddress = $ipAddress;
        $this->deviceId = $deviceId;
    }

    public function jsonSerialize(): mixed
    {
        $data = [
            'ip_address' => $this->ipAddress,
            'device_id' => $this->deviceId
        ];

        return $data;
    }
}
