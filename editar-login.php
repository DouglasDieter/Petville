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
            <h1>Edite suas informações pessoais aqui!</h1>
            <img src="img/personal goals checklist-rafiki.png" alt="" class="image">
        </div>
        <div class="right-login">
            <div class="card-login">
                <h1>ATUALIZAR</h1>
                <form method="post">
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
                    <input type="text" name="login" placeholder="Usuário" required>
                </div>
                <div class="textfield">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" placeholder="Senha" required>
                </div>
                    <input type="submit" value="ATUALIZAR" class="btn-login" name="botao">
                    <a href="pagina.php">Voltar</a>
                </form>
            </div>
        </div>
    </div>
   <?php
           include 'UsuarioDAO.php';
           session_start();
           
           if(empty($_SESSION['usuario'])){
        header('Location: index.php');
    }
           
           $usuario = new UsuarioDAO();
           if($_SERVER["REQUEST_METHOD"]=="POST"){
            $login = $_POST['login'];
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $resultado = $usuario->buscarIdPorLogin($_SESSION['usuario']);
            while($linha = $resultado->fetch_assoc()){
                $id_usuario = $linha['id_usuario'];
            }
            if(isset($_POST['botao']))
                $usuario->alterar($nome, $senha, $id_usuario, $email, $login);
            $_SESSION['usuario'] = $login;
           }
           
           session_status();
        ?>
</body>
</html>