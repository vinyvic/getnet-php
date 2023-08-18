<?php 

namespace vinyvic\Getnet;

class Getnet
{
    private string $clientId;
    private string $clientSecret;
    private string $accessToken;
    private string $enviroment;
    private string $baseUrl;
    private string $debug;

    public function __construct(string $clientId, string $clientSecret, string $enviroment = 'SDB', $debug = false) {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->debug = $debug;
        $this->setEnviroment($enviroment);
        $this->authenticate();
    }

    private function setEnviroment(string $enviroment) : void {
        switch ($enviroment) {
            case 'SDB':
                $this->baseUrl = 'https://api-sandbox.getnet.com.br';
                break;
            case 'HML':
                $this->baseUrl = 'https://api-homologacao.getnet.com.br';
                break;
            case 'PRD':
                $this->baseUrl = 'https://api.getnet.com.br';
                break;
            default:
                throw new \InvalidArgumentException("O valor fornecido para 'enviroment' não é válido.");
        }

        $this->enviroment = $enviroment;
    }

    private function authenticate() {
        $client = new \GuzzleHttp\Client();

        $authString = base64_encode($this->clientId . ':' . $this->clientSecret);
        $response = $client->request('POST', $this->baseUrl . '/auth/oauth/v2/token', [
            'verify' => false,
            'debug' => $this->debug,
            'headers' => [
                'authorization' => "Basic $authString",
                'content-type' => 'application/x-www-form-urlencoded'
            ],
            'form_params' => [
                'scope' => 'oob',
                'grant_type' => 'client_credentials'
            ]
        ]);

        $response = json_decode($response->getBody());

        if ($response->access_token){
            $this->accessToken = $response->access_token;
        }
        else {
            throw new \Exception("Erro na geração do token de acesso");
        }
    }

    public function paymentAction(Transaction|TransactionCard|TransactionBoleto|TransactionPix $transaction) : string {
        $client = new \GuzzleHttp\Client();

        // Payment with Card
        if (is_a($transaction, 'vinyvic\Getnet\TransactionCard')){
            $response = $client->request('POST', $this->baseUrl . '/v1/payments/credit', [
                'verify' => false,
                'debug' => $this->debug,
                'headers' => [
                    'authorization' => "Bearer " . $this->accessToken,
                    'content-type' => 'application/json; charset=utf-8'
                ],
                'json' => $transaction->jsonSerialize()
            ]);
        }
        // Payment with Boleto
        elseif (is_a($transaction, 'vinyvic\Getnet\TransactionBoleto')){
            $response = $client->request('POST', $this->baseUrl. '/v1/payments/boleto', [
                'verify' => false,
                'debug' => $this->debug,
                'headers' => [
                    'authorization' => "Bearer ". $this->accessToken,
                    'content-type' => 'application/json; charset=utf-8'
                ],
                'json' => $transaction->jsonSerialize()
            ]);
        }
        // Payment with Pix
        elseif (is_a($transaction, 'vinyvic\Getnet\TransactionPix')){
            $response = $client->request('POST', $this->baseUrl. '/v1/payments/qrcode/pix', [
                'verify' => false,
                'debug' => $this->debug,
                'headers' => [
                    'authorization' => "Bearer ". $this->accessToken,
                    'content-type' => 'application/json; charset=utf-8',
                    'seller_id' => $transaction->getSellerId(),
                ],
                'json' => $transaction->jsonSerialize()
            ]);
        }
        else {
            throw new \InvalidArgumentException("O valor fornecido para 'transaction' não é válido.");
        }

        return $response->getBody()->getContents();
    }
}


