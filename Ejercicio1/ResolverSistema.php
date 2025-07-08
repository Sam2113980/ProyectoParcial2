<?php
declare(strict_types=1);

namespace Clases;

require_once "SistemaLineal.php";

/**
 * Implementación concreta que resuelve el sistema usando la regla de Cramer
 */
class ResolverSistema extends SistemaLineal
{
    /**
     * Realiza el cálculo de x e y con determinantes
     */
    public function calcular(): array
    {
        // Determinante principal
        $det = $this->a1 * $this->b2 - $this->a2 * $this->b1;

        // Si el determinante es cero, no hay solución única
        if (abs($det) < 1e-8) {
            return ["error" => "El sistema no tiene solución única"];
        }

        // Determinantes para x e y
        $detX = $this->c1 * $this->b2 - $this->c2 * $this->b1;
        $detY = $this->a1 * $this->c2 - $this->a2 * $this->c1;

        // Cálculo final
        return [
            'x' => round($detX / $det, 4),
            'y' => round($detY / $det, 4)
        ];
    }

    /**
     * Devuelve el resultado formateado como string
     */
    public function imprimirResultado(): string
    {
        $res = $this->calcular();

        if (isset($res['error'])) {
            return $res['error'];
        }

        return "x = {$res['x']}, y = {$res['y']}";
    }
}
