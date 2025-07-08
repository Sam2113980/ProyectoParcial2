<?php
declare(strict_types=1);

namespace Clases;

require_once "OperacionSistemas.php";
use Clases\OperacionSistemas;

/**
 * Clase abstracta que representa la estructura de un sistema 2x2
 */
abstract class SistemaLineal implements OperacionSistemas {
    // Coeficientes de la ecuación 1
    protected float $a1;
    protected float $b1;
    protected float $c1;

    // Coeficientes de la ecuación 2
    protected float $a2;
    protected float $b2;
    protected float $c2;

    /**
     * Constructor que recibe todos los coeficientes
     */
    public function __construct(
        float $a1, float $b1, float $c1,
        float $a2, float $b2, float $c2
    ) {
        $this->a1 = $a1;
        $this->b1 = $b1;
        $this->c1 = $c1;

        $this->a2 = $a2;
        $this->b2 = $b2;
        $this->c2 = $c2;
    }
}
