<?php
declare(strict_types=1);

// Inclusión de clases necesarias
require_once "OperacionSistemas.php";
require_once "SistemaLineal.php";
require_once "ResolverSistema.php";

use Clases\ResolverSistema;

$resultado = null;

// Si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        // Captura y convierte los valores ingresados
        $a1 = (float) $_POST['a1'];
        $b1 = (float) $_POST['b1'];
        $c1 = (float) $_POST['c1'];

        $a2 = (float) $_POST['a2'];
        $b2 = (float) $_POST['b2'];
        $c2 = (float) $_POST['c2'];

        // Crear instancia del resolutor de sistemas
        $resolver = new ResolverSistema($a1, $b1, $c1, $a2, $b2, $c2);

        // Calcular solución
        $resultado = $resolver->calcular();
    } catch (Exception $e) {
        $resultado = ["error" => "Datos inválidos"];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Solución de Sistemas 2x2</title>
    <!-- Estilo Bootstrap moderno -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white">
<div class="container py-5">
    <h1 class="mb-4 text-center">Resolución de Sistemas de Ecuaciones Lineales 2x2</h1>

    <!-- Formulario de ingreso de coeficientes -->
    <form method="POST" id="formulario" class="needs-validation">
        <table class="table table-dark table-bordered table-striped text-center align-middle">
            <thead>
                <tr>
                    <th>Ecuación</th>
                    <th>Coef. X</th>
                    <th>Coef. Y</th>
                    <th>Resultado</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Ecuación 1</td>
                    <td><input name="a1" type="number" step="any" class="form-control bg-black text-white" required></td>
                    <td><input name="b1" type="number" step="any" class="form-control bg-black text-white" required></td>
                    <td><input name="c1" type="number" step="any" class="form-control bg-black text-white" required></td>
                </tr>
                <tr>
                    <td>Ecuación 2</td>
                    <td><input name="a2" type="number" step="any" class="form-control bg-black text-white" required></td>
                    <td><input name="b2" type="number" step="any" class="form-control bg-black text-white" required></td>
                    <td><input name="c2" type="number" step="any" class="form-control bg-black text-white" required></td>
                </tr>
            </tbody>
        </table>

        <div class="mb-3 text-center">
            <button type="submit" class="btn btn-success">Aceptar</button>
            <button type="reset" class="btn btn-danger" onclick="limpiarResultado()">Limpiar</button>
        </div>
    </form>

    <!-- Resultados -->
    <?php if (!is_null($resultado)): ?>
        <h4>Resultado</h4>
        <?php if (isset($resultado['error'])): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($resultado['error']) ?></div>
        <?php else: ?>
            <div class="alert alert-success">
                x = <?= round($resultado['x'], 4) ?> <br>
                y = <?= round($resultado['y'], 4) ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>

<script>
function limpiarResultado() {
    document.querySelectorAll('.alert').forEach(el => el.remove());
}
</script>
</body>
</html>
