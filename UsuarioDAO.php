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
        
        $sql = "INSERT INTO `forum` (`idforum`, `titulo`, `texto`, `fkusuario`, `data`) VALUES (NULL, '$titulo', '$texto', '1', '2024-04-01 15:05:43.000000')";
        
        if($conecta->query($sql) === TRUE){
            echo "<script>alert('Fórum criado com sucesso!')</script>";
            die;
        }else{
            echo "<script>alert('Erro na criação do seu fórum')</script>";
        }
        
        $conexao->desconectar();
    }
    
}
