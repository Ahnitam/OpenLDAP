<?php
function login(string $usuario, string $senha){
    // Inicia sessão
    if (!isset($_SESSION)) session_start();
    // Carrega as configurações
    $config = include('configs/config.php');

    try {
        // Conecta ao servidor LDAP
        $ds=ldap_connect($config['LDAP_HOST'], $config['LDAP_PORT']);
        // Seta algumas opções do LDAP
        ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
        ldap_set_option($ds, LDAP_OPT_NETWORK_TIMEOUT, 10);
        // DN do usuário ao qual será feito do Login
        $dn="cn=".$usuario.",".$config['LDAP_USERS_DN'];
        // Verifica se as credenciais estão corretas
        // Caso não esteja certo irá retornar valor falso
        if (ldap_bind($ds, $dn, $senha)) {
            // Busca id do usúario
            $u_search=ldap_search($ds, $dn, "objectClass=posixAccount", ["entryUUID"]);
            // Pega as informações do usuário em forma de array 
            $user_info = ldap_get_entries($ds, $u_search);
            // Criptografa o id do usuário usando o padrão AES
            $encrypted = openssl_encrypt($user_info[0]["entryuuid"][0], $config['AES_CIPHER'], $config['AES_KEY']);
            // Passa para base64
            $encrypted_base64 = base64_encode($encrypted);
            // Passa para a sessão
            $_SESSION[$config['SESSION_TOKEN']] = $encrypted_base64;
            // Fecha conexão com LDAP
            ldap_close($ds);
            return true;
        } else {
            // Fecha conexão com LDAP
            ldap_close($ds);
            return false;
        }
    } catch (\Throwable $th) {
        //
    }
}

function loadUserInfo()
{
    // Inicia sessão
    if (!isset($_SESSION)) session_start();
    // Carrega as configurações
    $config = include('configs/config.php');

    $user["auth"] = false;
    $user["name"] = "";
    $user["group"] = "";
    try {
        // Verifica se tem usúario logado
        if (isset($_SESSION[$config['SESSION_TOKEN']])) {
            // Conecta ao servidor LDAP
            $ds=ldap_connect($config['LDAP_HOST'], $config['LDAP_PORT']);
            // Seta algumas opções do LDAP
            ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
            ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
            ldap_set_option($ds, LDAP_OPT_NETWORK_TIMEOUT, 10);
            // Identifica com o usuário administrador
            ldap_bind($ds, "CN=".$config['LDAP_ADMIN_USER'].",".$config['LDAP_BASE_DN'], $config['LDAP_ADMIN_PASS']);
            // Pesquisa as informações do usúario logado
            // Caso o usuario não exista mais no LDAP a sessão será destruida
            if ($u_search=ldap_search($ds, $config['LDAP_USERS_DN'], "(&(objectClass=posixAccount)(entryUUID=".openssl_decrypt(base64_decode($_SESSION[$config['SESSION_TOKEN']]), $config['AES_CIPHER'], $config['AES_KEY'])."))", ["givenName", "sn", "gidNumber"])) {
                // Pega as informações do usuário em forma de array 
                $user_info = ldap_get_entries($ds, $u_search);
                // Seta authenticação como verdadeira
                $user["auth"] = true;
                // Pega o nome do usúario
                $user["name"] = $user_info[0]["givenname"][0]." ".$user_info[0]["sn"][0];
                // Busca todos os grupos cadastrados no LDAP
                if($g_search=ldap_search($ds, $config['LDAP_GROUPS_DN'], "objectClass=posixGroup")){
                    // Pega as informações dos grupos em forma de array
                    $grupos_searched = ldap_get_entries($ds, $g_search);
                    // Percorre todos os grupos
                    for ($i=0; $i < $grupos_searched["count"]; $i++) { 
                        // Verifica se gid do grupo é igual ao gid do usuario
                        // Caso seja pega o nome do grupo e para o laço de repetição
                        if ($grupos_searched[$i]['gidnumber'][0] == $user_info[0]['gidnumber'][0]) {
                            $user["group"] = $grupos_searched[$i]['cn'][0];
                            break;
                        }
                    }
                }
            }else{
                // Destroi a sessão
                session_destroy();
            }
            // Fecha conexão com LDAP
            ldap_close($ds);
        }
    } catch (\Throwable $th) {
        //throw $th;
    }
    return $user;
}