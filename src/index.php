<?php
// A lógica PHP vem no início do arquivo, antes do HTML.

// Defina aqui a senha correta.Senha Fixa
$senha_correta = 'Teste123';

// A variável $mensagem será usada para exibir uma confirmação ou uma mensagem de erro.
$mensagem = 'Php e nginx_CONTAINER DOCKER OPERACIONAL_TESTE_V1';
$cor_mensagem = 'blue'; // A cor padrão da mensagem será vermelha (para erros).

// Verificar se o método da requisição HTTP é POST (ou seja, se o formulário foi enviado).
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pega os dados enviados pelo formulário.
    $usuario = $_POST['usuario'];
    $senha_digitada = $_POST['senha'];

   
    // Compara a senha digitada pelo usuário com a senha correta definida no código.
    if ($senha_digitada === $senha_correta) {
        // Se a senha estiver correta,libera o acesso e define uma mensagem de sucesso e com a cor verde.
        $mensagem = "Login bem-sucedido! Bem-vindo(a), " . htmlspecialchars($usuario) . "!";
        $cor_mensagem = 'green';
    } else {
        // Se a senha estiver incorreta, define uma mensagem de erro e a cor vermelha.
        $mensagem = "Erro: Senha incorreta. Tente novamente.";
        $cor_mensagem = 'red';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Login</title>
</head>
<body>

    <h1>Login</h1>

    <?php if (!empty($mensagem)): ?>
        <p style="color: <?php echo $cor_mensagem; ?>;"><?php echo $mensagem; ?></p>
    <?php endif; ?>

    <form action="index.php" method="POST">
        <label for="usuario">Usuário:</label>
        <br>
        <input type="text" id="usuario" name="usuario" required>
        <br><br>

        <label for="senha">Senha:</label>
        <br>
        <input type="password" id="senha" name="senha" required>
        <br><br>

        <button type="submit">Entrar</button>
    </form>

</body>
</html>