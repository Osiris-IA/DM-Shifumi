<?php
require_once(__DIR__ . "/function.php");


function StatistiquesDesParties(string $resultat, string $mainJouee, string $temps): array
{

    $file = __DIR__ . '/stats.json';
    if (!file_exists($file)) {
        $stats = [
            'nbparties' => 0,
            'victoires' => 0,
            'defaites' => 0,
            'egalites' => 0,
            'mainsGagnantes' => '',
            'tauxVictoire' => 0,
            'tempsTotal' => 0,
            'mains' => [
                'Pierre' => ['jouees' => 0, 'victoires' => 0],
                'Papier' => ['jouees' => 0, 'victoires' => 0],
                'Ciseau' => ['jouees' => 0, 'victoires' => 0],
            ]
        ];
    } else {
        $fileContent = file_get_contents($file);
        $stats = json_decode($fileContent, true);
    }

    $stats['nbparties']++;
    $stats['tempsTotal'] += (int)$temps;

    // Mise à jour des résultats
    if ($resultat === 'victoire') {
        $stats['victoires']++;
    }
    if ($resultat === 'defaites') {
        $stats['defaites']++;
    }
    if ($resultat === 'egalites') {
        $stats['egalites']++;
    }

    // Mise à jour de la main jouée
    $resultat = strtolower($resultat); // Eviter les erreurs de casse
    if (isset($stats['mains'][$mainJouee])) {
        $stats['mains'][$mainJouee]['jouees']++;

        if ($resultat === 'victoire') {
            $stats['mains'][$mainJouee]['victoires']++;
        }
    }
        // Calcul du taux de victoire
    if ($stats['nbparties'] > 0) {
        $stats['tauxVictoire'] = round(($stats['victoires'] / $stats['nbparties']) * 100, 2);
    }

    // mainsGagnante
    $max = 0;
    $mainsGagnantes = '';
    foreach ($stats['mains'] as $main => $data) {
        if ($data['victoires'] > $max) {
            $max = $data['victoires'];
            $mainsGagnantes = $main;
        }
    }

    $stats['mainsGagnantes'] = $mainsGagnantes;
    // Enregistrer les statistiques dans le fichier

    file_put_contents($file, json_encode($stats, JSON_PRETTY_PRINT));

    return $stats;
}



function afficherStats(array $stats): void
{
    if (empty($stats)) {
        echo "Aucune statistique trouvée.\n";
        return;
    }

    echo "\n=== Statistiques des Parties === \n";
    echo str_repeat("=", 50) . "\n"; // Ligne de séparation
    echo "Nombre de Parties : " . $stats['nbparties'] . "\n";
    echo "Victoires : " . $stats['victoires'] . "\n";
    echo "Mains Gagnantes : " . $stats['mainsGagnantes'] . "\n";
    echo "Taux de Victoire : " . $stats['tauxVictoire'] . "%\n";
    echo "Temps Total : " . $stats['tempsTotal'] . "s\n";
    echo str_repeat("=", 50) . "\n"; // Ligne de séparation

    echo " -- Détail des Mains -- \n";
    foreach ($stats['mains'] as $mains => $data) {
    if (is_array($data)) {
        echo ucfirst($mains) . " : " . $data['jouees'] . "jouées, " . $data['victoires'] . " victoires\n";
    } else {
        echo ucfirst($mains) . " données non valides.\n";
    }
    echo str_repeat("=", 50) . "\n";

}

}


// Parties jouées (déjà présent)

// Victoires / Défaites / Égalités (déjà présent)

// Taux de victoire : (victoires / total) * 100

// Main la plus gagnante : en analysant l'historique

// Détail par main : victoire/tentatives pour pierre/papier/ciseau

// Temps de jeu total : tu dois stocker la durée de chaque partie dans stats.json
?>

<!-- {
    "victoires" : 0,
    "défaites": 0,
    "égalités" : 0,
    "total" : 0   
} -->

<!-- function 
StatistiquesDesParties(): array {
    $fileContent = file_get_contents(__DIR__ . '/file.json', 'r');
    $contentAsArray = json_decode($fileContent, true);

    return $contentAsArray;

    if (array_keys($contentAsArray) !== ['victoires', 'défaites', 'égalités','total']) {
        echo "Invalid input file format. \n";
        return [];
    }

    $victoires = $contentAsArray['victoires'];
    $défaites = $contentAsArray['défaites'];
    $égalités = $contentAsArray['égalités'];
    $total = $contentAsArray['total'];

    if(is_int($victoires) === false || 
    is_int($défaites) === false || 
    is_int($égalités) === false || 
    is_int($total) === false) {
        echo "You can only type integers. \n";
        return [];
    } -->
