# Teste Técnico – Desenvolvedor PHP (Laravel)

## Objetivo

Avaliar conhecimentos em desenvolvimento backend com Laravel, bem como habilidades no frontend utilizando Blade, HTML, CSS e JavaScript.

---

## Requisitos Gerais

- Utilizar Laravel no backend
- Utilizar Blade como engine de templates
- Não é permitido o uso de frameworks frontend como React ou Vue
- É permitido o uso de Bootstrap ou Tailwind CSS

---

## Estrutura do Banco de Dados

Criar ou adaptar a tabela `users` com os seguintes campos:

- name
- email
- password
- access_expires_at
- is_admin

---

## Funcionalidades

### 1. Tela de Login

- Implementar autenticação de usuários
- Usuários com acesso expirado não devem conseguir acessar o sistema
- Exibir a mensagem: "Acesso expirado"

---

### 2. Página Inicial

Após o login:

- Usuários administradores devem ser redirecionados para a listagem de usuários
- Usuários comuns devem visualizar uma página simples contendo uma imagem local do projeto

---

### 3. Listagem de Usuários

- Acesso permitido apenas para administradores

#### Dados exibidos

- Nome
- Email
- Data de expiração do acesso
- Ações de editar e deletar

#### Funcionalidades

- Paginação
- Busca por nome ou email (parcial)

#### CRUD

- Criação de usuários (página ou modal)
- Edição de nome, senha e data de expiração (página ou modal)
- Exclusão com confirmação (modal)

---

### 4. Importação de Usuários via CSV

#### Estrutura do arquivo

- Nome
- Email
- Senha
- Data de expiração

#### Requisitos

- Processamento em background
- Permitir navegação durante a importação
- Enviar e-mail ao finalizar
- Pode utilizar Mailtrap para testes

---

## Funcionalidades Extras

### Regra de Admin

- Definir automaticamente como administrador usuários com email contendo `@fontecred.com.br`

---

### Rotina Automatizada

- Remover usuários com acesso expirado há mais de 6 meses

---

## Observações Finais

- Liberdade para definição de nomes de variáveis, métodos e colunas
- Seguir boas práticas de desenvolvimento e padrões do Laravel
- Organizar o projeto adequadamente (Controllers, Services, Requests, etc.)
- Validações, organização e experiência do usuário serão considerados diferenciais
