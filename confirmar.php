<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-login.css">
    <title>Petville</title>
</head>
<body>
    
    <?php
    
    include 'UsuarioDAO.php';
    session_start();
    $usuario = new UsuarioDAO();

    if(empty($_SESSION['usuario'])){
        header('Location: index.php');
    }
    
    if(!empty($_GET['id_con'])){
    
    
    if(isset($_POST['sim'])){
        $usuario->excluir($_GET['id_con']);
        header('Location:perfil.php');
    }else if(isset($_POST['nao'])){
        header('Location:perfil.php');
    }
    }
    ?>
    
    <div class="main-login">
        <div class="right-login">
            <form method="post">
            <div class="card-login">
                <h1>TEM CERTEZA?</h1>
                <input type="submit" value="Excluir" class="btn-login" name="sim">
                <INPUT type="submit" value="Não" class="btn-login" name="nao"></INPUT>
            </div>
            </form>
        </div>
    </div>
</body>
</html>