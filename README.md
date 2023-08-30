# getnet-php
Integração PHP com a Plataforma Digital da Getnet E-Commerce WEB via API

## Instalação
Em seu projeto PHP utilize o comando composer para instalar a integração. 

```bash
composer install vinyvic/getnet-api
```

## Configuração
A integração usa o DotEnv PHP library para carregar informações de autenticação, utilize o arquivo `.env.example` para criar um arquivo `.env` e configurar as variáveis da sua API.

| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `CLIENT_ID` | `string` | **Obrigatório**. O seu Client ID fornecido pela getnet |
| `CLIENT_SECRET` | `string` | **Obrigatório**. O seu Client Secret fornecido pela getnet |
| `SELLER_ID` | `string` | Código de identificação do e-commerce. |