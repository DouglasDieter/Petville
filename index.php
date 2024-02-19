<!DOCTYPE html>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-register.css">
    <title>Petville</title>
</head>
<body>
    <div class="main-login">
        <div class="left-login">
            <h1>Não deixe de se juntar a nós,
                <br>seu pet merece o melhor cuidado!</h1>
            <img src="img/cat-throwing-a-vase-animate.svg" alt="" class="image">
        </div>
        <div class="right-login">
            <form method="post">
            <div class="card-login">
                <h1>REGISTRE-SE</h1>
                <div class="textfield">
                    <label for="Nome">Nome</label>
                    <input type="text" name="nome" placeholder="Nome e sobrenome" required>
                </div>
                <div class="textfield">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" placeholder="E-mail" required>
                </div>
                <div class="textfield">
                    <label for="usuario">Usuário</label>
                    <input type="text" name="usuario" placeholder="Usuário" required>
                </div>
                <div class="textfield">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" placeholder="Senha" required>
                </div>
                    <input type="submit" value="CADASTRAR" class="btn-login">
                    <p>Já possui conta? <a href="login.php">Faça o login!</a></p>
            </div>
            </form>
        </div>
    </div>
    <?php
           include 'UsuarioDAO.php';
           session_start();
           $usuario = new UsuarioDAO();
           if($_SERVER["REQUEST_METHOD"]=="POST"){
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $login = $_POST['usuario'];
            $senha = $_POST['senha'];
            
            $usuario->incluir($nome, $email, $login, $senha);
           }
        ?>
</body>
</html>


