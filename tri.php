<?php 
// listing 1
function triBulles($tab){
    $n = count($tab);
    for($i=0; $i<$n-1; $i++){
        for($j=0; $j<$n-1-$i; $j++){
            if($tab[$j]>$tab[$j+1]){
                $temp = $tab[$j];
                $tab[$j] = $tab[$j+1];
                $tab[$j+1] = $temp;
            }
        }
    }
    return $tab;
}

// Test triBulles - listing 2
$tab = [5, 3, 8, 1, 4];
$trie = triBulles($tab);
echo implode(', ', $trie) . "\n"; // attendu : 1, 3, 4, 5, 8

// listing 3
function triBullesCompte($tab){
    $n = count($tab);
    $compteur = 0;
    for($i=0; $i<$n-1; $i++){
        for($j=0; $j<$n-1-$i; $j++){
            $compteur++;
            if($tab[$j]>$tab[$j+1]){
                $temp = $tab[$j];
                $tab[$j] = $tab[$j+1];
                $tab[$j+1] = $temp;
            }
        }
    }
    return $compteur;
}

// Test triBullesCompte
$tab = [5, 3, 8, 1, 4];
echo triBullesCompte($tab) . "\n"; // attendu : 10

// listing 4
function triBullesChrono($tab) {
    $debut = microtime(true);
    triBulles($tab);
    $fin = microtime(true);
    return round(($fin - $debut) * 1000, 2); // en ms
}

// Test triBullesChrono
$tab = [5, 3, 8, 1, 4];
echo triBullesChrono($tab) . "\n"; // attendu : un temps en ms, ex: 0.02


// listing    5   
$tailles = [100, 500, 1000, 2000, 5000, 10000];

foreach ($tailles as $n) {
    $tab    = range($n, 1); // [n, n-1, ..., 2, 1] = cas défavorable
    $nbComp = triBullesCompte($tab);
    $temps  = triBullesChrono($tab);
    echo "n = $n : $nbComp comparaisons, $temps ms\n";
}

//etape 4 ( tableau plus réponses au questions est dans le fichier tableau.txt)//
   // PARTIE TRI PAR SELECTION //

// listing 6 - tri par selection :
function triSelection(array $tab): array {
    $n = count($tab);

    for ($i = 0; $i < $n - 1; $i++) {
        $indiceMin = $i;

        for ($j = $i + 1; $j < $n; $j++) {
            if ($tab[$j] < $tab[$indiceMin]) {
                $indiceMin = $j;
            }
        }

        if ($indiceMin !== $i) {
            [$tab[$i], $tab[$indiceMin]] = [$tab[$indiceMin], $tab[$i]];
        }
    }

    return $tab;
}

// listing 7 test // 

$tab = [5, 3, 8, 1, 4];
$trie = triSelection($tab);
echo implode(', ', $trie); // Output : 1, 3, 4, 5, 8

// listing 8 //

<?php

function triInsertion(array $tab): array {
    $n = count($tab);

    for ($i = 1; $i < $n; $i++) {
        $cle = $tab[$i];
        $j = $i - 1;

        while ($j >= 0 && $tab[$j] > $cle) {
            $tab[$j + 1] = $tab[$j];
            $j--;
        }

        $tab[$j + 1] = $cle;
    }

    return $tab;
}

// Test // AKA LISTING 9
$tab = [5, 3, 8, 1, 4];
$trie = triInsertion($tab);
echo implode(', ', $trie); // Output : 1, 3, 4, 5, 8

// listing 10
<?php

function triFusion(array $tab): array {
    $n = count($tab);

    if ($n <= 1) return $tab;

    $milieu = (int)($n / 2);
    $gauche = triFusion(array_slice($tab, 0, $milieu));
    $droite = triFusion(array_slice($tab, $milieu));

    return fusionner($gauche, $droite);
}

function fusionner(array $gauche, array $droite): array {
    $resultat = [];
    $i = 0;
    $j = 0;

    while ($i < count($gauche) && $j < count($droite)) {
        if ($gauche[$i] <= $droite[$j]) {
            $resultat[] = $gauche[$i++];
        } else {
            $resultat[] = $droite[$j++];
        }
    }

    while ($i < count($gauche)) $resultat[] = $gauche[$i++];
    while ($j < count($droite)) $resultat[] = $droite[$j++];

    return $resultat;
}

// Test // listing 11
$tab = [5, 3, 8, 1, 4];
$trie = triFusion($tab);
echo implode(', ', $trie); // Output : 1, 3, 4, 5, 8