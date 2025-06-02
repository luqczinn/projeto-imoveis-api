# 🏘️ Laravel Imóveis API

API RESTful para gerenciamento de imóveis e seus proprietários.

---

## 🚀 Tecnologias

- Laravel 10.x
- PHP 8.1+
- Docker & Docker Compose
- MySQL
- Laravel Sanctum
- Enloquent ORM (para abstração do database)
- Pest (para testes)
- Mail (com filas)

---

## ⚙️ Requisitos

- Docker
- Docker Compose

---
## 📦 Instalação com Docker

1. Clone o projeto
```bash 
git clone https://github.com/luqczinn/projeto-imoveis-api.git
cd projeto-imoveis-api

```

### 🧱 Subindo a aplicação

```bash
# Subir os containers
docker-compose up -d

# Acessar o container da aplicação
docker exec -it laravel_app bash

# Instalar dependências
composer install

# Gerar chave da aplicação
php artisan key:generate

# Rodar migrações e seeders
php artisan migrate --seed
```
### ⚙️ Arquivo .env
Para configurar seu servidor de e-mails a ser utilizado, modifique o arquivo .env, alterando as seguintes propriedades:
```bash
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=seu@email.com
MAIL_PASSWORD=sua_senha_de_app
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=seu@email.com
MAIL_FROM_NAME="${APP_NAME}"
```

## 📬 Fila de envio de e-mails
O envio de e-mails ao cadastrar um imóvel é feito de forma assíncrona via Job.

Para processar as filas, execute dentro do container:

```bash
php artisan queue:work
```

## 🧪 Testes

Para rodar os testes:

```bash
php artisan test
```

## 🔐 Autenticação

Autenticação via token com Sanctum.

Endpoints úteis:

Cadastro:

Use uma requisição POST no seguinte link http://localhost/api/auth/register com um json seguindo o exemplo abaixo.

```bash
"name":"Lucas", 
"email":"lucas@example.com", 
"password":"12345678", 
"password_confirmation":"12345678"
```
Login:

Use uma requisição POST no seguinte link http://localhost/api/auth/login com um json seguindo o exemplo abaixo.
```bash
"email":"lucas@example.com", 
"password":"12345678"
```
### Obs: O token retornado deve ser usado no header para rotas protegidas (logout e os demais endpoints)
Utilize o atributo abaixo no JSON de body para acessar as devidas rotas:

```bash
"Authorization: Bearer SEU_TOKEN"
```

Logout:

Use uma requisição POST no seguinte link http://localhost/api/auth/logout com um json seguindo o exemplo abaixo.
```bash
"email":"lucas@example.com", 
"password":"12345678"
```
## 📚 Endpoints principais

### 📦 Imóveis

GET /api/properties – Listar imóveis

GET /api/properties?city=Belo%20Horizonte&price=1000 – Filtrar imóveis por cidade e/ou preço

POST /api/properties – Criar imóvel (dispara e-mail)

Exemplo:

```bash
{
  "title": "Apartamento no Centro",
  "city": "Belo Horizonte",
  "price": 300000,
  "owner_id": 1,
  "Authorization: Bearer SEU_TOKEN"
}
```

PUT /api/properties/{id} – Atualizar imóvel

Exemplo:

```bash
{
  "title": "Apartamento no Centro",
  "city": "Belo Horizonte",
  "price": 300000,
  "owner_id": 1,
  "Authorization: Bearer SEU_TOKEN"
}
```

DELETE /api/properties/{id} – Remover imóvel

### 👤 Proprietários

GET /api/owners – Listar proprietários

POST /api/owners – Criar proprietário

Exemplo:

```bash
{
  "name": "João Almeida",
  "email": "joao@email.com",
  "phone": "31999999999"
  "Authorization: Bearer SEU_TOKEN"
}
```
PUT /api/owners/{id} – Atualizar proprietário

Exemplo:

```bash
{
  "name": "João Almeida",
  "email": "joao@email.com",
  "phone": "31999999999"
  "Authorization: Bearer SEU_TOKEN"
}
```

DELETE /api/owners/{id} – Remover proprietário

## 📦 Utilização do pacote disponbilizado pelo Jason-Guru para fazer os repositories.

https://github.com/jason-guru/laravel-make-repository


### ✍️ Autor

Lucas Silva
