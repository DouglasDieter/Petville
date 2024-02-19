<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo-pagina.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Petville</title>
</head>
<body>
    <?php
    session_start();
    if(empty($_SESSION['usuario'])){
        header('Location: index.php');
    }
    
    ?>
    <header>
        <img src="img/logo.png" alt="logo" class="logo">
        <nav>
            <ul class="navlinks">
                <li><a href="#servicos"></i>Serviços</a></li>
                <li><a href="#veterinarios">Veterinários</a></li>
            </ul>
        </nav>
        <a href="perfil.php" class="cta"><button class="botao"><i class='bx bxs-user'></i>Meu perfil</button></a>
    </header>
    <div class="wrapper">
        <div class="container head">
            <div class="left head">
                <h2>Bem-vindo(a)!</h2>
                <br>
                <p>Seja muito bem vindo(a) à Petville, a melhor plataforma de veterinários do Brasil! Aqui você pode marcar consultas para o seu pet do conforto da sua casa!</p>
            </div>
            <div class="right head">
            </div>
        </div>
        <div class="container um" id="servicos">
            <h1>Serviços da Petville</h1>
            <br><br>
            <p>A veterinária Petville procura sempre o melhor para o seu companheiro! Oferecemos o melhor serviço sem que você precise sair de casa! Marque suas consultas do conforto de seu sofá e o veterinário chegará em sua residência no horário marcado!<br><br> <a href="perfil.php" id="linkcont">Marque já sua consulta!</a></p>
        </div>
        <div class="container dois" id="veterinarios">
            <a href="veterinaros.php"><h1 id="veterinarios"></h1>Conheça nossos veterinários</h1></a>
        </div>
    </div>
</body>
</html>