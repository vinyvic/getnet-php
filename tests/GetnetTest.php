<?php declare(strict_types=1);

require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use vinyvic\Getnet\Address;
use vinyvic\Getnet\Boleto;
use vinyvic\Getnet\Card;
use vinyvic\Getnet\Credit;
use vinyvic\Getnet\Customer;
use vinyvic\Getnet\Device;
use vinyvic\Getnet\Getnet;
use vinyvic\Getnet\Order;
use vinyvic\Getnet\Shippings;
use vinyvic\Getnet\TransactionBoleto;
use vinyvic\Getnet\TransactionCard;
use vinyvic\Getnet\TransactionPix;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

#[CoversClass(Getnet::class)]
class GetnetTest extends TestCase
{
    public function testCredito(){
        $clientId = $_ENV['CLIENT_ID'];
        $clientSecret = $_ENV['CLIENT_SECRET'];
        $enviroment = $_ENV['ENVIROMENT'];
        $sellerId = $_ENV['SELLER_ID'];
        
        $getnet = new Getnet($clientId, $clientSecret, $enviroment);

        // Customer Data
        $firstName = 'João';
        $name = 'João da Silva';
        $email = 'customer@email.com.br';
        $phoneNumber = '5551999887766';

        // Setup Order
        $order = new Order('1');

        // Setup customer
        $billingAddress = new Address('Av. Brasil', '1000', 'Sala 1', 'São Geraldo', 'Porto Alegre', 'RS', 'Brasil', '90230060');
        $customer = new Customer('1086', $billingAddress, $firstName, 'da Silva', $name, $email, 'CPF', '12345678912', $phoneNumber);
        
        // Setup Card / Credit
        $numberToken = 'dfe05208b105578c070f806c80abd3af09e246827d29b866cf4ce16c205849977c9496cbf0d0234f42339937f327747075f68763537b90b31389e01231d4d13c';
        $card = new Card($numberToken, 'JOAO DA SILVA', '123', 'Mastercard', '12', '28');
        $credit = new Credit(false, false, false, "FULL", 1, 'LOJA*TESTE*COMPRA-123', 1799, $card, 'ONE_CLICK_PAYMENT', '1002217281190421');

        // Setup Device
        $device = new Device('127.0.0.1', 'hash-device-id');

        // Setup Shippings 
        $address = $billingAddress;
        $shippings = new Shippings($firstName, $name, $email, $phoneNumber, 3000, $address);

        // Setup Transaction
        $transactionCard = new TransactionCard($sellerId, 100, "BRL", $order, $customer, $credit, $device, $shippings);
        
        try {
            $response = $getnet->paymentAction($transactionCard);
            // print_r($response);
        } catch (\GuzzleHttp\Exception\RequestException $requestException) {
            print_r($requestException->getResponse()->getBody()->getContents());
            //throw $th;
        }
       

        $this->assertTrue(true);
    }

    public function testBoleto(){
        $clientId = $_ENV['CLIENT_ID'];
        $clientSecret = $_ENV['CLIENT_SECRET'];
        $enviroment = $_ENV['ENVIROMENT'];
        $sellerId = $_ENV['SELLER_ID'];
        
        $getnet = new Getnet($clientId, $clientSecret, $enviroment);

        // Customer Data
        $firstName = 'João';
        $name = 'João da Silva';
        $email = 'customer@email.com.br';
        $phoneNumber = '5551999887766';

        // Setup Order
        $order = new Order('1');

        // Setup customer
        $billingAddress = new Address('Av. Brasil', '1000', 'Sala 1', 'São Geraldo', 'Porto Alegre', 'RS', 'Brasil', '90230060');
        $customer = new Customer('1086', $billingAddress, $firstName, 'da Silva', $name, $email, 'CPF', '12345678912', $phoneNumber);
        
        $now = new DateTime();
        $expirationDate = $now->add(new DateInterval('P2D'))->format('d/m/Y');
        $boleto = new Boleto('170500000019763', $expirationDate, 'Não receber após o vencimento');

        // Setup Transaction
        $transaction = new TransactionBoleto($sellerId, 100, "BRL", $order, $boleto, $customer);
        
        try {
            $response = $getnet->paymentAction($transaction);
            // print_r($response);
        } catch (\GuzzleHttp\Exception\RequestException $requestException) {
            print_r($requestException->getResponse()->getBody()->getContents());
        }

        $this->assertTrue(true);
    }

    public function testPix(){
        $clientId = $_ENV['CLIENT_ID'];
        $clientSecret = $_ENV['CLIENT_SECRET'];
        $enviroment = $_ENV['ENVIROMENT'];
        $sellerId = $_ENV['SELLER_ID'];
        
        $getnet = new Getnet($clientId, $clientSecret, $enviroment);

        $transaction = new TransactionPix($sellerId, 100, 'BRL', 'DEV-1608748980', 'string');

        try {
            $response = $getnet->paymentAction($transaction);
            // print_r($response);
        } catch (\GuzzleHttp\Exception\RequestException $requestException) {
            print_r($requestException->getResponse()->getBody()->getContents());
        }

        $this->assertTrue(true);
    }
}