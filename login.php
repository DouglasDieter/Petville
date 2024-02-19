<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Petville</title>
</head>
<body>
    <div class="main-login">
        <div class="left-login">
            <h1>Marcar consultas para o 
                <br>seu pet nunca foi tão fácil!</h1>
            <img src="img/cat-and-dog-animate.svg" alt="" class="image">
        </div>
        <div class="right-login">
            <div class="card-login">
                <form method="post">
                <h1>LOGIN</h1>
                <div class="textfield">
                    <label for="usuario">Usuário</label>
                    <input type="text" name="usuario" placeholder="Usuário" required>
                </div>
                <div class="textfield">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" placeholder="Senha" required>
                </div>
                    <input type="submit" value="Entrar" class="btn-login">
                    <p>Não possui conta? <a href="index.php">Crie a sua já!</a></p>
                </form>
            </div>
        </div>
    </div>
   <?php
           include 'UsuarioDAO.php';
           session_start();
           $usuario = new UsuarioDAO();
           if($_SERVER["REQUEST_METHOD"]=="POST"){
            $login = $_POST['usuario'];
            $_SESSION['usuario'] = $login;
            $senha = $_POST['senha'];
            $usuario->logar($login, $senha);
           }
        ?>
</body>
</html>