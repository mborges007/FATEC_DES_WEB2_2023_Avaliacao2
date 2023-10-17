<?php
    require_once('header.php');
    require_once('dados_banco.php');
 
    //session_start();
 
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        header("location: registros.php");
        exit;
    }
 
    if (!isset($_SESSION['online']) || !$_SESSION['online']) {
        header("location: index.php");
        exit;
    }
 
    try {
        $dsn = "mysql:host=$servername;dbname=$dbname";
        $conn = new PDO($dsn, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $placa_id = $_POST['id'];
            $sql = "SELECT * FROM registro WHERE veiculos_id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $placa_id);
            $stmt->execute();
        }
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = NULL;
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
        <h2>
            <?php echo $_SESSION["username"]; ?>
            <br>
        </h2>
    </div>
    <p>
        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            while ($row = $stmt->fetch()) {
                echo "ID: " . $row['id'] . " | Data/Hora: " . $row['data_hora'] . "<br>";
            }
        }
        ?>
    </p>
    <a href="principal.php" class="btn btn-primary">Voltar</a>
    <br><br>
</body>
</html>