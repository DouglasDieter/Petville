<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="perfil.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Petville</title>
</head>
<body>
    
    <?php
    include 'UsuarioDAO.php';
    session_start();
    if(empty($_SESSION['usuario'])){
        header('Location: index.php');
    }
    $usuario = new UsuarioDAO();
    $id_usu = $usuario->buscarIdPorLogin($_SESSION['usuario']);
    $id_usuario = 0;
    while($linha = $id_usu->fetch_assoc()){
        $id_usuario = $linha['id_usuario'];
        $_SESSION['usuario'] = $linha['login'];
    }
    $resultado = $usuario->buscarUsuario($id_usuario);
    $consultas = $usuario->buscarConsulta($id_usuario);
    if(isset($_POST['botao'])){
        header('Location: consulta-criar.php');
    }
    
    if(isset($_POST['desc'])){
        $usuario->deslogar();
    }
    
    ?>
    
    <header>
        <img src="img/logo.png" alt="logo" class="logo">
        <nav>
            <ul class="navlinks">
                <form method="post">
                <li><a><button name="desc" id="desc">Desconectar</button></a></li>
                <li><a href="pagina.php"></i>Voltar ao início</a></li>
                </form>
            </ul>
        </nav>
        <a href="#" class="cta"><button class="botao"><i class='bx bxs-user'></i>Meu perfil</button></a>
    </header>
    
    
    <div class="wrapper">
        
        <h2 id="titulo">Gerencie sua conta e suas consultas aqui!</h2>
        <?php while($linha = $resultado->fetch_assoc()): ?>
        <div class="container head">
            <div class="container top">
            <h2 id="t">Informações pessoais</h2><button class="add"><a href="editar-login.php"><img src="img/edit-alt-solid-48.png" alt="" class="add1"></a></button>
            </div>
            <h3>Nome: <?php echo $linha['nome'];?></h3>
            <br>
            <h3>Email: <?php echo $linha['email'];?></h3>
            <br>
            <h3>Login: <?php echo $linha['login'];?></h3>
        </div>
        <?php endwhile;?>
        
        <div class="container bottom">
            <div class="container top">
                <h2>Consultas marcadas</h2>
                <h2>Buscar consulta:<form> <input type="text" name="busca"> <input type="submit"></form></h2>
                <form method="post">
                <button class="add" name="botao"><a href="criar-consulta.html"><img src="img/calendar-plus-solid-48.png" alt="" class="add1"></a></button>
                </form>
            </div>
            <?php 
            if(!isset($_GET['busca'])){
            while($linha = $consultas->fetch_assoc()):
            
            echo "<div class='down'>
                <div class='left'>
                <h3>Dia da consulta: $linha[data_consulta]</h3>
                <br>
                <h3>Hora da consulta: $linha[hora_consulta]</h3>
                <br>
                <button class='add'><a href='confirmar.php?id_con=$linha[id_con]'><h3 class='bot'>Cancelar esta consulta</h3></a></button>
                <br><br> 
            </div>
            <div class='right'>
                <h3>O pet da consulta é um: $linha[animal]</h3>
                <br>
                <h3>Especialista selecionado: $linha[nomeveterinario]</h3>
                <br>
                <h3>Observações: $linha[obs]</h3>
            </div>
            </div>
            <br>
            <hr class='hr'>
            <br>";
            endwhile;}
            else{
                $pesquisa = $usuario->pesquisarConsulta($_GET['busca'], $id_usuario);
                while($linha = $pesquisa->fetch_assoc()):
                    
            echo "<div class='down'>
                <div class='left'>
                <h3>Dia da consulta: $linha[data_consulta]</h3>
                <br>
                <h3>Hora da consulta: $linha[hora_consulta]</h3>
                <br>
                <button class='add'><a href='confirmar.php?id_con=$linha[id_con]'><h3 class='bot'>Cancelar esta consulta</h3></a></button>
                <br><br> 
            </div>
            <div class='right'>
                <h3>O pet da consulta é um: $linha[animal]</h3>
                <br>
                <h3>Especialista selecionado: $linha[nomeveterinario]</h3>
                <br>
                <h3>Observações: $linha[obs]</h3>
            </div>
            </div>
            <br>
            <hr class='hr'>
            <br>";
                endwhile;
            }?>
        </div>
        
    </div>
</body>
</html>