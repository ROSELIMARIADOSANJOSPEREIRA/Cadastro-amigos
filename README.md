# Sistema de Cadastro de Amigos (CRUD + Login)

Projeto desenvolvido para a atividade **Agenda 08 - Fichário** da disciplina
**Desenvolvimento de Sistemas II**, curso técnico em Desenvolvimento de
Sistemas (ETEC, modalidade EAD).

## Sobre o projeto

O sistema permite que um usuário faça login e gerencie sua própria lista de
amigos (cadastrar, listar, editar e excluir), com cada operação do **CRUD**
representada:

| Operação | Arquivo | O que faz |
|---|---|---|
| **C**reate | `cadastro.php` + `processa_cadastro.php` | Cadastra um novo amigo |
| **R**ead | `listar.php` | Lista os amigos já cadastrados |
| **U**pdate | `editar.php` + `processa_editar.php` | Edita os dados de um amigo |
| **D**elete | `excluir.php` | Remove um amigo da lista |

O acesso ao sistema é protegido por **login com sessão**: só quem estiver
autenticado consegue ver ou alterar a lista de amigos.

## Tecnologias utilizadas

- **HTML5** e **CSS3** para as telas
- **PHP** para toda a lógica do sistema (sessões, validações, CRUD)
- **MySQL** para armazenar usuários e amigos
- **mysqli** com *prepared statements* para acesso seguro ao banco
- **password_hash() / password_verify()** para proteger as senhas

## Estrutura de arquivos

```
cadastro-amigos/
├── database.sql          → cria o banco e as tabelas
├── gerar_hash.php         → gera o hash da senha do usuário de teste
├── conexao.php            → conexão única com o banco de dados
├── index.php              → tela de login
├── processa_login.php     → valida o login
├── logout.php             → encerra a sessão
├── verifica_login.php     → bloqueia acesso de quem não está logado
├── cadastro.php           → formulário para cadastrar amigo (CREATE)
├── processa_cadastro.php  → grava o novo amigo no banco (CREATE)
├── listar.php             → lista os amigos cadastrados (READ)
├── editar.php             → formulário de edição (UPDATE)
├── processa_editar.php    → grava a edição no banco (UPDATE)
├── excluir.php            → remove o amigo do banco (DELETE)
└── estilo.css             → visual do sistema
```

## Como rodar o projeto (XAMPP)

1. Copie a pasta `cadastro-amigos` para dentro de `htdocs`
2. Inicie o Apache e o MySQL no XAMPP
3. No phpMyAdmin, importe o arquivo `database.sql`
4. Acesse `http://localhost/cadastro-amigos/gerar_hash.php`, copie o hash
   gerado e atualize o `INSERT` do usuário de teste no banco
5. Acesse `http://localhost/cadastro-amigos/` e faça login com:
   - **E-mail:** gabi@escola.com
   - **Senha:** 123456

## Segurança aplicada

- Senhas nunca são salvas em texto puro (uso de `password_hash`)
- Todas as consultas usam *prepared statements* (proteção contra SQL Injection)
- Toda página interna verifica a sessão antes de exibir qualquer dado
- Cada usuário só enxerga e altera os próprios amigos cadastrados

---
Desenvolvido como atividade acadêmica, com apoio de IA (Claude/Anthropic)
para estruturação do código e da documentação.
