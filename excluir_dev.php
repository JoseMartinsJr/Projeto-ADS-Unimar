<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Excluir Funcionário</title>
    <style>
        /* Reset de margens e padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Corpo da página */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
            flex-direction: column;
        }

        /* Container principal */
        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
            max-width: 600px;
            width: 100%;
            flex: 1;
        }

        /* Título e subtítulo */
        #titulo {
            font-size: 32px;
            color: #007BFF;
            margin-bottom: 20px;
        }

        #subtitulo {
            font-size: 18px;
            color: #555;
            margin-bottom: 20px;
        }

        /* Estilos dos botões */
        .btn {
            display: inline-block;
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 15px 25px;
            font-size: 18px;
            text-align: center;
            width: 100%;
            border-radius: 8px;
            cursor: pointer;
            margin-bottom: 20px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        /* Hover dos botões */
        .btn:hover {
            background-color: #0056b3;
        }

        /* Rodapé */
        footer {
            text-align: center;
            font-size: 14px;
            color: #777;
            margin-top: 30px;
            width: 100%;
        }

        /* Estilo para mensagens */
        .message {
            font-size: 16px;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 id="titulo">Excluir Funcionário</h1>
        <p id="subtitulo">Digite o ID do funcionário que deseja excluir</p>

        <form method="POST" action="">
            <input type="text" name="id" placeholder="ID do Funcionário" required
                style="width: 100%; padding: 10px; margin-bottom: 20px; border-radius: 8px; border: 1px solid #ccc;">
            <button type="submit" class="btn">Excluir</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];

            // Conexão com o banco de dados
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "projeto";

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Verifica a conexão
            if ($conn->connect_error) {
                die("<p class='message'>Erro na conexão com o banco de dados: " . $conn->connect_error . "</p>");
            }

            // Prepara e executa a exclusão
            $sql = "DELETE FROM dev WHERE id_dev = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    echo "<p class='message'>Funcionário com ID $id excluído com sucesso!</p>";
                } else {
                    echo "<p class='message'>Funcionário com ID $id não encontrado.</p>";
                }
            } else {
                echo "<p class='message'>Erro ao excluir funcionário: " . $stmt->error . "</p>";
            }

            // Fecha a conexão
            $stmt->close();
            $conn->close();

            echo "<a href='index.html' class='btn'>Voltar</a>";
        }
        ?>
    </div>

    <footer>
        <p>&copy; 2024 Sistema de Cadastro de Funcionários</p>
    </footer>
</body>

</html>
