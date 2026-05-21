<?php

require_once "tris.php";

$t = [4, 5, 8, 0, 1, 1];
echo "avant de trier : ". implode(', ', $t)."\n"; 

echo "Tri à bulles\n";

echo implode(', ', triBulles($t)) . "\n";

echo "l'algorithme du tri à bulles a fait ".
        triBullesCompte($t).
        " comparaisons pour trier un tableau de ".
        count($t)." éléments.\n";

echo "\nAnalyse:\n";
$tailles = [100 , 500 , 1000 , 2000 , 5000 , 10000];

foreach ( $tailles as $n) {
    $tab = range ($n , 1); // [n, n -1, ... , 2, 1] = cas defavorable
    $nbComp = triBullesCompte ( $tab );
    $temps = triBullesChrono ( $tab );
    echo "n = $n : $nbComp comparaisons , $temps ms\n";
}