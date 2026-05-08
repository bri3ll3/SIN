<?php
include("db_game4.php");

$resultado = "";
$maquina = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $jugador = $_POST["jugador"];
    $eleccion = $_POST["eleccion"];

    $opciones = ["Piedra", "Papel", "Tijera"];
    $maquina = $opciones[array_rand($opciones)];

    // lógica del juego
    if ($eleccion == $maquina) {
        $resultado = "Empate";
    } 
    elseif (
        ($eleccion == "Piedra" && $maquina == "Tijera") ||
        ($eleccion == "Papel" && $maquina == "Piedra") ||
        ($eleccion == "Tijera" && $maquina == "Papel")
    ) {
        $resultado = "Ganaste";
    } 
    else {
        $resultado = "Perdiste";
    }

    // guardar en BD
    $sql = "INSERT INTO partidas 
            (jugador, eleccion_jugador, eleccion_maquina, resultado)
            VALUES 
            ('$jugador', '$eleccion', '$maquina', '$resultado')";

    $conn->query($sql);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Piedra Papel Tijera</title>

    <style>
        body {
            text-align: center;
            font-family: Arial;
            background-color: #f5f5f5;
            margin-top: 50px;
        }

        .game-box {
            background: white;
            width: 400px;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px gray;
        }

        button {
            padding: 10px 20px;
            margin: 10px;
            cursor: pointer;
        }
    </style>

</head>
<body>

<div class="game-box">

    <h1>Piedra Papel Tijera</h1>

    <form method="POST">

        <input type="text" name="jugador" placeholder="Tu nombre" required>
        <br><br>

        <button type="submit" name="eleccion" value="Piedra">
            Piedra
        </button>

        <button type="submit" name="eleccion" value="Papel">
            Papel
        </button>

        <button type="submit" name="eleccion" value="Tijera">
            Tijera
        </button>

    </form>

    <?php if($resultado != ""): ?>

        <h2>Máquina: <?php echo $maquina; ?></h2>
        <h2>Resultado: <?php echo $resultado; ?></h2>

    <?php endif; ?>

</div>

</body>
</html>