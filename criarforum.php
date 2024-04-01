<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

    <div class="wrap">
        <div class="criar">
            <h1>Crie o seu Fórum!</h1>
            <form method="post">
            <label for="titulo">Título do seu fórum</label>
            <input type="text" name="titulo" id="titulo">
            <label for="texto">Explique brevemente sobre o que é o seu Fórum</label>
            <input type="text" name="texto" id="texto">
            <input type="submit" value="MARCAR">
            </form>
        </div>
    </div>
    <?php
    include 'UsuarioDAO.php';
    $usuario = new UsuarioDAO();
     
     
    if($_SERVER["REQUEST_METHOD"]=="POST"){
    $titulo = $_POST['titulo'];
    $texto = $_POST['texto'];
    
    $resultado = $usuario->adicionarForum($titulo, $texto);
    
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>