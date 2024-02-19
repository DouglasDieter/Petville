<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estiloconsulta.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Veterinária</title>
</head>
<body>
    <?php
    
    include 'UsuarioDAO.php';
    session_start();
    if(empty($_SESSION['usuario'])){
      header('Location: index.php');
    }
    $usuario = new UsuarioDAO();
                    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
    $data = $_POST['dia'];
    $hora = $_POST['hora'];
    $tipo = $_POST['tipo'];
    $obs = $_POST['obs'];
    $vet = $_POST['vet'];
    $id_usu = $usuario->buscarIdPorLogin($_SESSION['usuario']);
    while($linha = $id_usu->fetch_assoc()){
        $id_usuario = $linha['id_usuario'];
    }
    
    $id_vete = $usuario->pegarIdVet($vet);
    while($linha = $id_vete->fetch_assoc()){
        $id_vet = $linha['id_vet'];
    }
    
    $resultado = $usuario->adicionarConsulta($data, $hora, $tipo, $obs, $id_usuario, $id_vet);
    }
   ?>
    <div class="main-login">
        <div class="left-login">
            <h1>Não se preocupe,
                <br>estamos aqui para ajudar!</h1>
            <img src="img/Veterinary-bro.png" alt="" class="image">
        </div>
        <div class="right-login">
            <form method="post">
            <div class="card-login">
                <h1>MARCAR CONSULTA</h1>
                <div class="textfield">
                    <label for="data">Dia</label>
                    <input type="date" name="dia">
                </div>
                <div class="textfield">
                    <label for="hora">Horário</label>
                    <input id="settime" type="time" step="1" name="hora"/>
            <script>document.getElementById("settime").value = "00:00:00";</script>
            <br>
                </div>
                <div class="textfield radio">
                    <label for="usuario">Seu pet é um</label>
                    <div class="top">
                    <div class="input-container">
                        <input type="radio" id="cachorro" name="tipo" value="Cachorro" required>
                        <div class="radio-tile">
                        <i class='bx bxs-dog' id="cao"></i>
                        <label for="cachorro">Cão</label>
                    </div>
                        </div>
                    <div class="input-container">
                        <input type="radio" id="gato" name="tipo" value="Gato" required>
                        <div class="radio-tile">
                        <i class='bx bxs-cat'></i>
                        <label for="gato">Gato</label>
                    </div>
                    </div>
                </div>
                </div>
                <div class="textfield">
                    <label for="vet">Veterinário de preferência</label>
                    <select name="vet">
                        <option value="" disabled slected>Selecione um veterinário</option>
                        <option value="lanna">Dra. Lanna Ramos</option>
                        <option value="luiza">Dra. Luiza Melo</option>
                        <option value="paulo">Dr. Paulo Andrade</option>
                        <option value="james">Dr. James Morozov</option>
                    </select>
                </div>
                <div class="textfield obs">
                    <label for="senha">Observações</label>
                    <textarea name="obs" id="text" cols="50" rows="5" required></textarea>
                    <br>
                </div>
                <input type="submit" value="MARCAR" class="btn-login">
                <a href="perfil.php">Cancelar</a>
            </div>
            </form>
        </div>
    </div>
</body>
</html>