<?php
class EstadisticaBasica
{
    public function calcularMedia(array $datos): float
    {
        return array_sum($datos) / count($datos);
    }

    public function calcularMediana(array $datos): float
    {
        sort($datos);
        $n = count($datos);
        $medio = floor($n / 2);

        if ($n % 2 === 0) {
            return ($datos[$medio - 1] + $datos[$medio]) / 2;
        } else {
            return $datos[$medio];
        }
    }

    public function calcularModa(array $datos)
    {
        // Redondeamos o convertimos a string para contar correctamente
        $convertidos = array_map(function($v) {
            return (string)round($v, 2); // redondea a 2 decimales como texto
        }, $datos);

        $frecuencias = array_count_values($convertidos);

        if (empty($frecuencias)) {
            return 'N/A'; // evita llamar a max() en array vacío
        }

        $maxFrecuencia = max($frecuencias);

        if ($maxFrecuencia === 1) {
            return 'N/A'; // todos ocurren una sola vez
        }

        $moda = array_keys($frecuencias, $maxFrecuencia);

        // Devolvemos como números flotantes de nuevo
        return array_map('floatval', $moda);
    }
}
