# FleetMax

## Sobre o Projeto

FleetMax é uma plataforma web para gestão de frotas, focada em simplificar a administração de veículos, motoristas e rotas para empresas que dependem de transporte. O sistema centraliza informações logísticas, facilitando o cadastro, consulta e gerenciamento, com uma interface intuitiva e escalável para futuras melhorias.

---

## Tecnologias Utilizadas

* **Laravel** (PHP Framework)
* **Tailwind CSS** (Estilização via Vite)
* **MySQL** (Banco de Dados)
* **Redis** (Cache)
* **Docker** (Ambiente isolado e containerização)
* Servidor Web: NGINX

---

## Como Rodar o Projeto

### Opção 1: Rodar localmente (sem Docker)

1. Clone o repositório:

   ```bash
   git clone https://github.com/IcaroMoreira4/FleetMaax.git
   cd FleetMax
   ```

2. Instale dependências do Laravel:

   ```bash
   composer install
   ```

3. Configure o ambiente:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   Edite o arquivo `.env` para configurar a conexão com seu banco MySQL local.

4. Execute as migrações para criar as tabelas:

   ```bash
   php artisan migrate
   ```

5. Instale as dependências do Node.js:

   ```bash
   npm install
   ```

6. Abra dois terminais e execute:

   * Terminal 1 (servidor Laravel):

     ```bash
     php artisan serve
     ```
   * Terminal 2 (Vite para compilar CSS/JS):

     ```bash
     npm run dev
     ```

7. Acesse a aplicação em:

   ```
   http://127.0.0.1:8000
   ```

---

### Opção 2: Rodar com Docker (recomendado)

1. Instale Docker e Docker Compose.

2. Suba os containers:

   ```bash
   docker-compose up -d
   ```

3. Entre no container do backend para instalar dependências PHP e preparar o Laravel:

   ```bash
   docker exec -it backend bash
   ```

4. Dentro do container, execute os comandos para instalar as dependências, gerar a chave e migrar o banco:

   ```bash
   composer install
   php artisan key:generate
   php artisan migrate
   exit
   ```

5. Fora do container, na sua máquina, instale e compile os assets front-end:

   ```bash
   npm install
   npm run build
   npm run dev
   ```

6. A aplicação estará disponível em:

   ```
   http://localhost:8082
   ```

7. Para acessar o banco via phpMyAdmin:

   ```
   http://localhost:8085
   ```

---

## Comandos Úteis

* Para parar os containers:

  ```bash
  docker-compose down
  ```

* Para subir os containers novamente:

  ```bash
  docker-compose up -d
  ```

* Para limpar cache e imagens Docker:

  ```bash
  docker system prune -a
  ```

* **Dica:** Se preferir, pode usar o Docker Desktop para subir, parar e gerenciar containers via interface gráfica.

---

## Contribuindo

1. Faça um fork do projeto.
2. Crie uma branch para sua feature:

   ```bash
   git checkout -b minha-feature
   ```
3. Faça commit das suas alterações:

   ```bash
   git commit -m "Descrição da feature"
   ```
4. Envie para seu fork:

   ```bash
   git push origin minha-feature
   ```
5. Abra um Pull Request para avaliação.

