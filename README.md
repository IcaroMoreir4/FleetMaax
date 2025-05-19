# FleetMax

## Introdução

A gestão de frotas é essencial para empresas que dependem do transporte de mercadorias e serviços. O FleetMax surge como uma solução para centralizar e otimizar a administração de veículos, motoristas e rotas, garantindo eficiência e organização nas operações logísticas.

## Problemática

O gerenciamento manual de frotas pode levar a inconsistências nos dados, alocações inadequadas de veículos e dificuldades no planejamento de rotas. Sem um sistema centralizado, a consulta e a atualização de informações tornam-se morosas e propensas a erros, impactando a eficiência da operação e a tomada de decisões estratégicas.

## Solução

O FleetMax é uma plataforma web que simplifica a gestão de frotas, permitindo:

-   Cadastro e administração de motoristas, caminhões e rotas.
-   Associação de motoristas a veículos e rotas específicas.
-   Consulta e gerenciamento eficiente de informações logísticas.
-   Interface intuitiva para facilitar a adoção pelos usuários.

Embora a versão inicial não inclua monitoramento em tempo real ou integração com APIs externas, a plataforma foi projetada para ser escalável e adaptável a futuras necessidades.

## Stacks do Projeto

Para garantir um desenvolvimento eficiente e estruturado, as seguintes tecnologias foram escolhidas:

### **Gerenciamento de Atividades e Controle de Versão**

-   **Trello**: Aplicação do método Kanban para organização das tarefas.
-   **GitHub**: Controle de versão para colaboração entre desenvolvedores.

### **Front-end**

-   **HTML**: Estruturação das páginas da aplicação.
-   **Tailwind CSS**: Framework CSS para estilização rápida e responsiva.

### **Back-end**

-   **PHP**: Linguagem principal para o desenvolvimento do servidor.
-   **Laravel**: Framework para estruturação do back-end, suporte a ORM (Eloquent) e criação de APIs.

### **Banco de Dados**

-   **MySQL**: Armazenamento e gerenciamento dos dados do sistema.

### **Ferramentas de DevOps**

-   **Docker**: Para criação de ambientes isolados e consistentes.
-   **GitHub Actions**: Automação de testes e CI/CD.
-   **NGINX/Apache**: Servidor web para requisições da aplicação.
-   **Monitoramento e Logs** (Futuro): Grafana e Prometheus para análise de desempenho.

## Backlog do Projeto

O desenvolvimento do FleetMax está estruturado em épicos e tarefas organizadas por funcionalidades principais:

### **Épico 1: Cadastro de Usuários**

-   [ ] Criar tela de login com validação de credenciais.
-   [ ] Implementar autenticação com Laravel.
-   [ ] Criar recuperação de senha via e-mail.
-   [ ] Validação de CNPJ.

### **Épico 2: Cadastro e Gerenciamento de Frotas**

-   [ ] Criar banco de dados para caminhões.
-   [ ] Desenvolver formulário de cadastro.
-   [ ] Implementar edição e exclusão de caminhões.
-   [ ] Criar banco de dados para motoristas.
-   [ ] Criar interface de cadastro e gerenciamento de motoristas.
-   [ ] Implementar listagem e filtros de motoristas e caminhões.

### **Épico 3: Gestão de Rotas**

-   [ ] Criar banco de dados para rotas.
-   [ ] Desenvolver formulário de cadastro.
-   [ ] Implementar edição e exclusão de rotas.
-   [ ] Criar vínculo entre motoristas, caminhões e rotas.
-   [ ] Criar interface para listagem de rotas.
-   [ ] Implementar filtros de busca.

### **Épico 4: Relatórios e Monitoramento**

-   [ ] Criar geração de relatórios em PDF/Excel.
-   [ ] Desenvolver filtros personalizados para relatórios.
-   [ ] Criar dashboard com informações gerais do sistema.
-   [ ] Implementar alertas automáticos para eventos críticos.

Aqui está o README atualizado considerando o uso do Laravel com Tailwind via Vite:

---

## 🚀 Como Executar o Projeto

### 📥 1. Clone o repositório

```bash
git clone https://github.com/IcaroMoreira4/FleetMaax.git
```

### 📂 2. Acesse a pasta do projeto

```bash
cd FleetMax
```

### ⚙️ 3. Instale as dependências do Laravel

```bash
composer install
```

### 🛠 4. Configure o ambiente

```bash
cp .env.example .env
php artisan key:generate
```

Edite o arquivo `.env` para configurar a conexão com o banco de dados.

### 🗄️ 5. Configure o banco de dados e execute as migrações

```bash
php artisan migrate
```

### 📦 6. Instale as dependências do Node.js

```bash
npm install
```

### 🏗️ 7. Inicie o projeto

Abra **dois terminais** e execute os seguintes comandos:

**Terminal 1 (Servidor Laravel)**

```bash
php artisan serve
```

**Terminal 2 (Vite para compilar Tailwind e JS)**

```bash
npm run dev
```

### 🌐 8. Acesse a aplicação no navegador

[http://127.0.0.1:8000](http://127.0.0.1:8000)

---

Caso precise gerar os arquivos CSS e JS para produção, utilize:

```bash
npm run build
```

## Contribuição

Para contribuir com o projeto:

1. Faça um fork do repositório.
2. Crie uma branch para a funcionalidade desejada: `git checkout -b minha-feature`
3. Faça o commit das suas alterações: `git commit -m 'Adiciona nova funcionalidade'`
4. Envie suas alterações: `git push origin minha-feature`
5. Abra um Pull Request.
