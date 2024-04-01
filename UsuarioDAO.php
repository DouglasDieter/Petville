<?php
include 'ConexaoBD.php';
class UsuarioDAO {
    
    public function incluir($email,$login, $senha) {
        $conexao = new ConexaoBD();
        $conecta = $conexao->conectar(); 
        // Inserir registro
        $sql = "INSERT INTO `usuario` (`idusuario`, `email`, `login`, `senha`) VALUES (NULL, '$email', '$login', '$senha');";
        if ($conecta->query($sql) === TRUE) {
            echo "<script>"."alert('Conta criada com sucesso');"."</script>";
            die;
        } else {
            echo "Erro: " . $sql . "<br>" . $conecta->error."<br>";
        }
    }
    public function excluir($id) {
        $conexao = new ConexaoBD();
        $conecta = $conexao->conectar();
        $sql = "DELETE FROM consultas WHERE id_con=$id";
        if ($conecta->query($sql) === TRUE) {
            echo "<script>Registro apagado com sucesso</script>";
        } else {
            echo "Erro ao apagar o registro: " . $conecta->error."<br>";
        }
        $conexao->desconectar();
    }
    public function alterar($nome,$senha,$id_usuario,$email,$usuario) {
        $conexao = new ConexaoBD();
        $conecta = $conexao->conectar();
        /** @var type $email */
        $sql = "UPDATE usuario SET nome = '$nome', email = '$email', login = '$usuario', senha = '$senha' WHERE id_usuario = $id_usuario;";
        if ($conecta->query($sql) === TRUE) {
            echo "<script>alert('Registro atualizado com sucesso');</script>";
            header('Location:perfil.php');
        } else {
            echo "Erro na atualização do registro: " . $conecta->error."<br>";
        }
        $conexao->desconectar();
    }
    
    public function buscar() {
        $conexao = new ConexaoBD();
        $conecta = $conexao->conectar();
        
        $sql = "SELECT id_usuario, nome, email FROM usuario";
        $resultado = $conecta->query($sql);
        if ($resultado->num_rows > 0) {
        // saída dos dados
        while($linha = $resultado->fetch_assoc()) {
            echo "id: " . $linha["id_usuario"]. " - Name: " . $linha["nome"]. " " . $linha["email"]. "<br>";
        }
        } else {
            echo "0 results";
        }
        
        $conexao->desconectar();
    }
    
    
    public function buscarIdPorLogin($login){
        
        $conexao = new ConexaoBD();
        $conecta = $conexao->conectar();
        
        $sql = "SELECT id_usuario, login FROM usuario WHERE login like '%$login%'";
        $resultado = $conecta->query($sql);
        
        $conexao->desconectar();
        return $resultado;
        
        }
        
    
    public function logar($usuario,$senha) {
        $conexao = new ConexaoBD();
        $conecta = $conexao->conectar();
        
        $sql = "SELECT senha, login FROM usuario WHERE senha='$senha' and login='$usuario'";
        $resultado = $conecta->query($sql);
        if ($resultado->num_rows > 0) {
        // saída dos dados
        while($linha = $resultado->fetch_assoc()) {
            echo "<script>"."alert('Login efetuado com sucesso');"."</script>";
            header("location:main.php");
            die;
            //Colocar a ação que irá fazer ao logar. Exemplo: redirecionamento com header  
        }
        } else {
            echo "<script>alert('Usuário ou senha incorretos');</script>";
        }
        
        $conexao->desconectar();
    }
    
    public function deslogar(){
        session_destroy();
        header('Location: login.php');
    }
    
    public function adicionarForum($titulo, $texto){
        $conexao = new ConexaoBD();
        $conecta = $conexao->conectar();
        
        $sql = "INSERT INTO `forum` (`idforum`, `titulo`, `texto`, `fkusuario`, `data`) VALUES (NULL, '$titulo', '$texto', '1', now())";
        
        if($conecta->query($sql) === TRUE){
            echo "<script>alert('Fórum criado com sucesso!')</script>";
            file_put_contents("$titulo.php",'<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylemain.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Help.me</title>
</head>
<body>
  <nav class="navbar navbar-expand-lg barra">
    <div class="container-fluid">
      <a class="navbar titulo" href="main.php">Help.me</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="perfil.php">Acessar perfil</a>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button type="submit" class="btn btn-dark">Enviar</button>
        </form>
      </div>
    </div>
  </nav>
  <div class="hstack gap-3 perg">
    <div class="p-2">Como completo a pokedéx do Fire Red?</div>
    <div class="p-2 ms-auto">Respostas: 0</div>
    <div class="vr"></div>
    <div class="p-2">Criado por: Usuário</div>
  </div>
  <div class="hstack gap-3 perg">
    <div class="p-2">Como completo a pokedéx do Fire Red?</div>
    <div class="p-2 ms-auto">Respostas: 0</div>
    <div class="vr"></div>
    <div class="p-2">Criado por: Usuário</div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
');
            die;
        }else{
            echo "<script>alert('Erro na criação do seu fórum')</script>";
        }
        
        $conexao->desconectar();
    }
    
}
