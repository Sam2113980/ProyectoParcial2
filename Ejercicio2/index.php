<?php
// Incluimos la clase de estadísticas
require_once "EstadisticaBasica.php";

// Inicializamos variables para evitar warnings
$resultados = [];
$errores = [];

// Si se envía el formulario por POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Creamos una instancia de la clase EstadisticaBasica
    $estadistica = new EstadisticaBasica();

    // Recorremos los grupos recibidos
    foreach ($_POST['grupo'] as $indice => $valores) {
        // Limpiamos espacios y separamos por coma
        $valoresLimpios = array_filter(array_map('trim', explode(',', $valores)), 'is_numeric');

        if (count($valoresLimpios) === 0) {
            $errores[] = "El grupo " . ($indice + 1) . " no tiene valores numéricos válidos.";
            continue;
        }

        // Convertimos a flotantes
        $numeros = array_map('floatval', $valoresLimpios);

        // Calculamos media, mediana y moda
        $media = $estadistica->calcularMedia($numeros);
        $mediana = $estadistica->calcularMediana($numeros);
        $moda = $estadistica->calcularModa($numeros);

        // Guardamos resultados
        $resultados[] = [
            'grupo' => $indice + 1,
            'media' => $media,
            'mediana' => $mediana,
            'moda' => $moda
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estadística Básica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container py-4">
    <h1 class="mb-4">Cálculo de Estadísticas Básicas</h1>

    <!-- Formulario principal -->
    <form method="POST">
        <div class="mb-3">
            <label for="grupos" class="form-label">¿Cuántos grupos quieres ingresar?</label>
            <input type="number" class="form-control" id="grupos" name="num_grupos" min="1" max="10" value="<?= isset($_POST['num_grupos']) ? htmlspecialchars($_POST['num_grupos']) : '' ?>">
        </div>
        <button type="button" class="btn btn-secondary mb-3" onclick="generarCampos()">Generar Campos</button>

        <div id="camposGrupos">
            <?php
            // Si ya existen campos previos (tras enviar el formulario), los mostramos
            if (!empty($_POST['grupo'])) {
                foreach ($_POST['grupo'] as $i => $val) {
                    echo '<div class="mb-2">
                        <label class="form-label">Grupo ' . ($i + 1) . ' (separa números por coma):</label>
                        <input type="text" name="grupo[]" class="form-control" value="' . htmlspecialchars($val) . '">
                    </div>';
                }
            }
            ?>
        </div>

        <button type="submit" class="btn btn-success">Calcular</button>
        <button type="button" class="btn btn-danger" onclick="limpiarFormulario()">Limpiar</button>
    </form>

    <!-- Mostrar errores -->
    <?php if (!empty($errores)): ?>
        <div class="alert alert-danger mt-3">
            <ul>
                <?php foreach ($errores as $e): ?>
                    <li><?= htmlspecialchars($e) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Mostrar resultados -->
    <?php if (!empty($resultados)): ?>
        <h2 class="mt-4">Resultados</h2>
        <?php foreach ($resultados as $res): ?>
            <div class="alert alert-primary">
                <strong>Grupo <?= $res['grupo'] ?>:</strong><br>
                Media: <?= htmlspecialchars($res['media']) ?><br>
                Mediana: <?= htmlspecialchars($res['mediana']) ?><br>
                Moda: <?= is_array($res['moda']) ? implode(', ', $res['moda']) : $res['moda'] ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<script>
// Genera campos dinámicamente según el número de grupos ingresado
function generarCampos() {
    let numGrupos = document.getElementById('grupos').value;
    let contenedor = document.getElementById('camposGrupos');
    contenedor.innerHTML = '';

    for (let i = 1; i <= numGrupos; i++) {
        contenedor.innerHTML += `
        <div class="mb-2">
            <label class="form-label">Grupo ${i} (separa números por coma):</label>
            <input type="text" name="grupo[]" class="form-control">
        </div>`;
    }
}

// Limpia todo el formulario y recarga la página
function limpiarFormulario() {
    window.location.href = window.location.pathname;
}
</script>
</body>
</html>
