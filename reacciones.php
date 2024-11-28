<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "colectivos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['reaccion']) && !empty($_POST['reaccion'])) {
        $reaccion = $_POST['reaccion'];

        $sql = "UPDATE contador_reacciones SET contador = contador + 1 WHERE nombre_reaccion = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $reaccion);
        $stmt->execute();

        $sql = "SELECT contador FROM contador_reacciones WHERE nombre_reaccion = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $reaccion);
        $stmt->execute();
        $stmt->bind_result($contador);
        $stmt->fetch();
        echo $contador;

        $stmt->close();
    } else {
        echo "Error: No se recibió una reacción válida en la solicitud POST.";
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['reaccion']) && !empty($_GET['reaccion'])) {
        $reaccion = $_GET['reaccion'];

        $sql = "SELECT contador FROM contador_reacciones WHERE nombre_reaccion = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $reaccion);
        $stmt->execute();
        $stmt->bind_result($contador);
        $stmt->fetch();
        echo $contador;

        $stmt->close();
    } else {
    }
}

$conn->close();
?>
