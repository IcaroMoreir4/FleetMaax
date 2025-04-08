# FleetMax  

Um projeto desenvolvido com Laravel, Node.js, Nginx, MySQL e Redis, utilizando Docker para facilitar a configuração e o deploy.  

## 📌 Tecnologias Utilizadas  

- **Laravel** v12.7.2
- **PHP** v8.2.27  
- **Nginx** v1.27.4-alpine  
- **MySQL** v8.0  
- **Redis** latest-alpine  
- **phpMyAdmin** v5.2.2  
- **Docker Compose** v3.8  

## 🚀 Como Rodar o Projeto  

### 🔧 Pré-requisitos  

Antes de começar, instale os seguintes programas na sua máquina:  

- [Docker](https://www.docker.com/)
- [Node.js](https://nodejs.org/) (Recomendado: LTS)

### ▶️ Rodando o Projeto  

1. **Configurar o ambiente**  
   - Copie e cole o arquivo `.env.example` e renomeie para `.env`.  
   - Copie e cole o seguinte código dentro do arquivo `.env`:  

   ```env

      DB_CONNECTION=mysql
      DB_HOST=mysql_fletmax
      DB_PORT=3306
      DB_DATABASE=fletmax
      DB_USERNAME=fletmax
      DB_PASSWORD=fletmax1234

      REDIS_HOST=redis_fletmax
      REDIS_PASSWORD=null
      REDIS_PORT=6379

   ```

2. **Subir os containers do projeto**  
   ```bash
   docker-compose up --build -d
   ```

3. **Acessar o container do back-end**  
   ```bash
   docker exec -it backend bash   
   ```

4. **Instalar as dependências do Laravel**  
   ```bash
   composer install
   ```

5. **Gerar a chave do projeto Laravel**  
   ```bash
   php artisan key:generate
   ```

6. **Criar as tabelas no banco de dados**  
   ```bash
   php artisan migrate
   ```

7. **Instalar as dependências do front-end**  
   ```bash
   npm install
   ```
8. **Instalar as dependências do front-end**  
   ```bash
   npm run build
   ```

9. **Compilar os assets do front-end**  
   ```bash
   npm run dev
   ```

### 🎯 Acesse o Projeto  

- **Front-end:** [http://localhost/](http://localhost/)  
- **phpMyAdmin:** [http://localhost:8083](http://localhost:8083)

## ➕ Comandos Úteis  

### 🔄 Limpar o cache e imagens do Docker

```bash
docker system prune -a
```
### Subir os containers 
```bash
docker-compose up -d
```
### Remover containers
```bash
docker-compose down
```