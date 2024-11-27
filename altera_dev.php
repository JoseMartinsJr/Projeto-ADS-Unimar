<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Alterar Funcionário</title>
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

        /* Campos de formulário */
        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 id="titulo">Alterar Funcionário</h1>
        <p id="subtitulo">Digite o ID do funcionário para buscar os dados</p>

        <form method="POST" action="">
            <input type="text" name="id" placeholder="ID do Funcionário" value="<?php echo isset($id) ? $id : ''; ?>" required>
            <button type="submit" class="btn">Buscar</button>
        </form>

        <?php
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

        // Se o formulário foi enviado com o ID, busca os dados do funcionário
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = $_POST['id'];

            // Busca os dados do funcionário pelo ID
            $sql = "SELECT id_dev, nome, sobrenome, email, setor, tecnologia, experiencia FROM dev WHERE id_dev = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $nome = $row['nome'];
                $sobrenome = $row['sobrenome'];
                $email = $row['email'];
                $setor = $row['setor'];
                $tecnologia = $row['tecnologia'];
                $experiencia = $row['experiencia'];
            } else {
                echo "<p class='message'>Funcionário com ID $id não encontrado.</p>";
            }

            $stmt->close();
        }

        // Se os dados foram preenchidos e o formulário for enviado novamente, realiza a atualização
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome'], $_POST['sobrenome'], $_POST['email'], $_POST['setor'], $_POST['tecnologia'], $_POST['experiencia'])) {
            $nome = $_POST['nome'];
            $sobrenome = $_POST['sobrenome'];
            $email = $_POST['email'];
            $setor = $_POST['setor'];
            $tecnologia = $_POST['tecnologia'];
            $experiencia = $_POST['experiencia'];

            // Prepara e executa a atualização
            $sql = "UPDATE dev SET nome = ?, sobrenome = ?, email = ?, setor = ?, tecnologia = ?, experiencia = ? WHERE id_dev = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssi", $nome, $sobrenome, $email, $setor, $tecnologia, $experiencia, $id);

            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    echo "<p class='message'>Funcionário com ID $id alterado com sucesso!</p>";
                } else {
                    echo "<p class='message'>Não houve alterações ou o ID não foi encontrado.</p>";
                }
            } else {
                echo "<p class='message'>Erro ao alterar funcionário: " . $stmt->error . "</p>";
            }

            $stmt->close();
        }

        // Fecha a conexão
        $conn->close();
        ?>

        <?php if (isset($nome) && isset($sobrenome)): ?>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="text" name="nome" placeholder="Nome" value="<?php echo $nome; ?>" required>
            <input type="text" name="sobrenome" placeholder="Sobrenome" value="<?php echo $sobrenome; ?>" required>
            <input type="email" name="email" placeholder="Email" value="<?php echo $email; ?>" required>
            <input type="text" name="setor" placeholder="Setor" value="<?php echo $setor; ?>" required>
            <input type="text" name="tecnologia" placeholder="Tecnologia" value="<?php echo $tecnologia; ?>" required>
            <input type="text" name="experiencia" placeholder="Experiência" value="<?php echo $experiencia; ?>" required>
            <button type="submit" class="btn">Alterar Dados</button>
        </form>
        <?php endif; ?>

        <a href="index.html" class="btn">Voltar</a>
    </div>

    <footer>
        <p>&copy; 2024 Sistema de Cadastro de Funcionários</p>
    </footer>
</body>

</html>
