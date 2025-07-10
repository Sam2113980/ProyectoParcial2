<?php
declare(strict_types=1);

namespace Clases;

// Clase abstracta que define la interfaz de los cálculos estadísticos
abstract class Estadistica {
    // Método para calcular la media aritmética
    abstract public function calcularMedia(array $valores): ?float;

    // Método para calcular la mediana
    abstract public function calcularMediana(array $valores): ?float;

    // Método para calcular la moda
    abstract public function calcularModa(array $valores): ?float;
}
