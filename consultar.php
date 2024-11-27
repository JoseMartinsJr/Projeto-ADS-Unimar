<?php
require("conecta.php"); // Inclui o arquivo de conexão com o banco de dados

// Consulta SQL para selecionar todos os registros da tabela 'dev'
$sql = "SELECT id_dev, nome, sobrenome, email, setor, tecnologia, experiencia FROM dev";
$result = $conn->query($sql);

echo "
<!DOCTYPE html>
<html lang='pt-BR'>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <title>Consultar Funcionários</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            flex-direction: column;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
            max-width: 900px;
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            word-wrap: break-word; /* Quebra palavras grandes */
        }

        table th {
            background-color: #007BFF;
            color: white;
        }

        .btn {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 15px 25px;
            font-size: 18px;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class='container'>
        <h1>Consultar Funcionários</h1>";

if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Sobrenome</th>
                <th>Email</th>
                <th>Setor</th>
                <th>Tecnologia</th>
                <th>Experiência</th>
            </tr>";
    
    // Laço para percorrer e exibir os dados
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id_dev"] . "</td>
                <td>" . $row["nome"] . "</td>
                <td>" . $row["sobrenome"] . "</td>
                <td>" . $row["email"] . "</td>
                <td>" . $row["setor"] . "</td>
                <td>" . $row["tecnologia"] . "</td>
                <td>" . $row["experiencia"] . "</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<p>Nenhum registro encontrado.</p>";
}

// Fecha a conexão com o banco de dados
$conn->close();

echo "
        <a href='index.html' class='btn'>Voltar</a>
    </div>
</body>
</html>";
?>
