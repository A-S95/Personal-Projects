<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitização básica dos dados
    $nome = htmlspecialchars($_POST['Name'] ?? '');
    $email = filter_var($_POST['Email'] ?? '', FILTER_SANITIZE_EMAIL);
    $modelo = htmlspecialchars($_POST['Bikemodel'] ?? '');
    $registomota = strtoupper(trim($_POST['Bikeregist'] ?? ''));
    $mensagem = htmlspecialchars(str_replace(array("\r", "\n"), ' ', $_POST['Message'] ?? ''));

    // Validação da matrícula
    if (!preg_match('/^[A-Z0-9]{2}-[A-Z0-9]{2}-[A-Z0-9]{2}$/', $registomota)) {
        $_SESSION['form_msg'] = [
            'type' => 'error',
            'text' => "❌ Matrícula inválida. Use o formato XX-XX-XX (letras maiúsculas)."
        ];
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    // Salvar dados no arquivo (exemplo)
    $linha = "Nome: $nome | Email: $email | Modelo: $modelo | Matricula: $registomota | Mensagem: $mensagem\n";
    file_put_contents('formularios.txt', $linha, FILE_APPEND);


    // Redireciona para a página anterior
    header("Location: confirmacao.php");
    exit;
}
