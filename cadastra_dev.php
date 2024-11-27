<?php
require("conecta.php");

// Recebe os dados do formulário
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$email = $_POST['email'];
$setor = $_POST['setor'];
$experiencia = $_POST['experiencia'];

// Verificar se o campo 'tecnologia' foi preenchido (se ao menos uma tecnologia foi selecionada)
if (isset($_POST['tecnologia']) && !empty($_POST['tecnologia'])) {
    // Transformar o array em uma string separada por vírgulas
    $tecnologia = implode(", ", $_POST['tecnologia']);
} else {
    // Caso não tenha tecnologia selecionada, atribui um valor padrão
    $tecnologia = 'Nenhuma tecnologia selecionada';
}

// Consulta SQL para inserir os dados no banco
$sql = "INSERT INTO dev (nome, sobrenome, email, setor, tecnologia, experiencia)
        VALUES ('$nome', '$sobrenome', '$email', '$setor', '$tecnologia', '$experiencia')";

// Executa a query
if ($conn->query($sql) === TRUE) {
    echo "<center><h1>Registro Inserido com Sucesso</h1>";
    echo "<a href='index.html'><input type='button' value='Voltar'></a></center>";
} else {
    echo "<h3>OCORREU UM ERRO: </h3>: " . $sql . "<br>" . $conn->error;
}
?>