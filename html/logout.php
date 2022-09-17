<?php
// Inicia sessão
if (!isset($_SESSION)) session_start();
// Destroi a sessão
session_destroy();
// Redireciona a página inicial
header("Location: index.php"); exit;