# Getnet-PHP 
Integração PHP com a Plataforma Digital da Getnet E-Commerce WEB via API

## Instalação
Para instalar a integração em seu projeto PHP, siga os passos abaixo:

1. Navegue até o diretório do seu projeto.
2. Execute o seguinte comando usando o Composer para instalar a integração:

```bash
composer install vinyvic/getnet-api
```

## Configuração
A integração utiliza a biblioteca DotEnv PHP para carregar informações de autenticação. Siga os passos abaixo para configurar as variáveis da API: 

1. Crie um arquivo `.env` com base no arquivo `.env.example`.
2. Preencha as seguintes variáveis no arquivo `.env`:

| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `CLIENT_ID` | `string` | **Obrigatório**. O seu Client ID fornecido pela getnet |
| `CLIENT_SECRET` | `string` | **Obrigatório**. O seu Client Secret fornecido pela getnet |
| `SELLER_ID` | `string` | Código de identificação do e-commerce. |
| `PIX_TIMEOUT` | `integer` | Tempo de expiração do QR Code PIX após a geração. |

Lembre-se de sempre manter suas informações de autenticação seguras e não compartilhá-las publicamente.