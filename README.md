# Teste Técnico – Desenvolvedor PHP (Laravel)

### Requisitos:
- Upload de arquivo CSV
- Processamento em background (Job)
- Permitir uso do sistema durante processamento
- Enviar email ao finalizar
- Se for Admin deve ir para listagem de usuários
- Se não for Admin, deve ir para home

---

## Regras Extras

### Admin automático
- Se email contém `@fontecred.com.br`:
  - `is_admin = true`
- Remover usuários com acesso expirado há mais de 6 meses
---

## Projeto

### Login
![Home](public/images/readme/login.png)
![Home](public/images/readme/acesso-expirado.png)

---

### Home
![Home](public/images/readme/home.png)

---

### Listagem de Usuários
![Home](public/images/readme/importacao.png)
![Home](public/images/readme/error.png)
![Home](public/images/readme/filter.png)
![Home](public/images/readme/listagem.png)

---

### Criar/Editar/Excluir Usuário
![Home](public/images/readme/edit%20or%20create.png)
![Home](public/images/readme/delete.png)
---

### Importação CSV
![Home](public/images/readme/job.png)