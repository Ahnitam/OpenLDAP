# LDAP usando PHP

### Atividade proposta na disciplina de Segurança de Redes no curso de Análise e Desenvolvimento de Sistemas

- 1. Faça um sistema que utilize os serviços de autenticação de usuários e grupos através do protocolo LDAP.
- 2. O Sistema deve ter uma área restrita ao grupo do gerentes;
- 3. O Sistema deve ter uma área restrita aos grupos de vendedores e de gerentes;
- 4. O Sistema deve ter uma área pública para qualquer usuário;
- 5. O Sistema deve ter uma tela de login contendo apenas usuário e senha;
- 6. O Sistema deve utilizar os protocolos Active Directory ou LDAP;
- 7. O Sistema deverá ser entregue dentro de um arquivo .zip contendo todos os códigos-fonte, instruções de utilização e também referências sobre códigos-fonte de terceiros;
- 8. O Sistema não poderá ter nenhuma outra base de armazenamento de dados;
- 9. O Sistema não poderá armazenar as senhas em nenhuma hipótese;
- 10. É permitido utilizar qualquer linguagem de programação;
- 11. É permitido utilizar qualquer biblioteca externa, desde que devidamente citada e com licenciamento aberto.

# Passos para execução:

### Configurar variáveis de ambiente ou configure no arquivo `html/configs/config.env`

| **Variável**          | **Descrição**                                | **Obrigatório?**   |
| --------------------- | -------------------------------------------- | ------------------ |
| LDAP_HOST | Host LDAP | **&#10003;** |
| LDAP_PORT | Porta LDAP (Padrão: 389) | **&#10007;** |
| LDAP_ADMIN_USER | Usúario administrador LDAP | **&#10003;** |
| LDAP_ADMIN_PASS | Senha administrador LDAP | **&#10003;** |
| LDAP_BASE_DN | DN BASE LDAP | **&#10003;** |
| LDAP_USERS_DN | DN dos Usuários | **&#10003;** |
| LDAP_USERS_DN | DN dos Grupos | **&#10003;** |
| AES_CIPHER | (Padrão: aes-128-ecb)| **&#10007;** |
| AES_KEY | Chave de criptografia | **&#10003;** |
| SESSION_TOKEN | (Padrão: TOKEN) | **&#10007;** |

### Rodar serviço do apache modo de desenvolvimento:

```bash
docker-compose up
```

### Acesse a aplicação em http://localhost:8000

# Referências:

- https://docs.docker.com/compose/

- https://www.php.net/manual/en/book.ldap.php

- https://github.com/anthony-b/simple-php-LDAP-Authentication
