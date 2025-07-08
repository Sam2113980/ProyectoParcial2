<?php
declare(strict_types=1);

namespace Clases;

/**
 * Interfaz para resolver sistemas de ecuaciones
 */
interface OperacionSistemas {
    /**
     * Calcula la solución del sistema (x, y)
     * @return array ['x' => valor, 'y' => valor] o ['error' => mensaje]
     */
    public function calcular(): array;

    /**
     * Devuelve un string con el resultado ya formateado
     */
    public function imprimirResultado(): string;
}
