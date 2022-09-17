<?php
$envs = parse_ini_file("config.env");
/* Configurações do LDAP */
$config['LDAP_HOST'] = isset($_ENV["LDAP_HOST"]) ? $_ENV["LDAP_HOST"] : $envs["LDAP_HOST"];
$config['LDAP_PORT'] = isset($_ENV["LDAP_PORT"]) ? $_ENV["LDAP_PORT"] : (isset($envs["LDAP_PORT"]) ? $envs["LDAP_PORT"] : 389);
$config['LDAP_ADMIN_USER'] = isset($_ENV["LDAP_ADMIN_USER"]) ? $_ENV["LDAP_ADMIN_USER"] : $envs["LDAP_ADMIN_USER"];
$config['LDAP_ADMIN_PASS'] = isset($_ENV["LDAP_ADMIN_PASS"]) ? $_ENV["LDAP_ADMIN_PASS"] : $envs["LDAP_ADMIN_PASS"];
$config['LDAP_BASE_DN'] = isset($_ENV["LDAP_BASE_DN"]) ? $_ENV["LDAP_BASE_DN"] : $envs["LDAP_BASE_DN"];
$config['LDAP_USERS_DN'] = isset($_ENV["LDAP_USERS_DN"]) ? $_ENV["LDAP_USERS_DN"] : $envs["LDAP_USERS_DN"];
$config['LDAP_GROUPS_DN'] = isset($_ENV["LDAP_GROUPS_DN"]) ? $_ENV["LDAP_GROUPS_DN"] : $envs["LDAP_GROUPS_DN"];

/* Configurações de Criptografia */
$config['AES_CIPHER'] = isset($_ENV["AES_CIPHER"]) ? $_ENV["AES_CIPHER"] : (isset($envs["AES_CIPHER"]) ? $envs["AES_CIPHER"] : "aes-128-ecb");
$config['AES_KEY'] = isset($_ENV["AES_KEY"]) ? $_ENV["AES_KEY"] : $envs["AES_KEY"];

/* Configurações Sessão */
$config["SESSION_TOKEN"] = isset($_ENV["SESSION_TOKEN"]) ? $_ENV["SESSION_TOKEN"] : (isset($envs["SESSION_TOKEN"]) ? $envs["SESSION_TOKEN"] : "TOKEN");

return $config;