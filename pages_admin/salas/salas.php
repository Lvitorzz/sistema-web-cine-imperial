<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Sala</title>
    <link rel="stylesheet" href="sala.css">
</head>

<body>
<a href="../admin/admin.html"><button>Voltar ao painel</button></a>
    <h2>Cadastrar Sala</h2>
    <form action="cadastroSala.php" method="post">
        <label for="numeroSala">Numero da Sala:</label>
        <input type="number" name="numeroSala" required>

        <label for="qtdPessoas">Qauantidade de pessoas:</label>
        <input type="number" name="qtdPessoas" required>

        <button type="submit">Cadastrar Sala</button>
    </form>

    <a href="salasCadastradas.php">
        <button>Ver salas cadastradas</button>
    </a>
</body>

</html>