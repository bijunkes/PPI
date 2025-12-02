<?php
    function calcularArray($numeros) {
        $soma = array_sum($numeros);
        
        $maior = max($numeros);
        
        $menor = min($numeros);
        
        return [
            'soma' => $soma,
            'maior' => $maior,
            'menor' => $menor
        ];
    }

    $numeros = [12, 5, 8, 20, 3, 15, 7];

    $resultados = calcularArray($numeros);

    echo "<h3>Resultados do Array:</h3>";
    echo "Soma de todos os números: " . $resultados['soma'] . "<br>";
    echo "Maior número: " . $resultados['maior'] . "<br>";
    echo "Menor número: " . $resultados['menor'] . "<br>";
?>
