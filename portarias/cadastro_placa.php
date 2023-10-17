<?php

    require_once('header.php');
    require_once('dados_banco.php');

    $aluno = $_POST['aluno'];
    $placa = $_POST['placa'];

    if(strlen($aluno) > 10 ){
        header("location: cadastro.php");
    }
    
        
    if (!isset($_SESSION["username"])) {
        header("location: cadastro.php");
        exit; 
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $aluno = $_POST['aluno'];
        $placa = $_POST['placa'];
    
        if (strlen($aluno) > 10) {
            header("location: cadastro.php");
            exit; 
        }
    
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            
            $stmt = $pdo->prepare("INSERT INTO veiculos (aluno, placa) VALUES (:aluno, :placa)");
            $stmt->bindParam(':aluno', $aluno);
            $stmt->bindParam(':placa', $placa);
            $stmt->execute();
    
            header("location: cadastro.php");
        } catch (PDOException $e) {
        
            echo "Erro: " . $e->getMessage();
        }
    }
?>
 
<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <title>Portaria Fatec</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>
            <?php echo $_SESSION["username"]; ?>
            <br>
        </h1>
    </div>
    <p>
    Aluno: <b>
        <?php echo $aluno; ?>
    </b>cadastrado com sucesso.
    <br><br>
        <a href="principal.php" class="btn btn-primary">Voltar</a>
    <br><br>
    </p>
</body>
</html>