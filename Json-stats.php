<?php
$retourMenu = 1;
$statistique = StatistiquesDesParties();
ini_set('memory_limit', '256M');




function StatistiquesDesParties(): array {
    $file = __DIR__ . '/stats.json';

    if (file_exists($file)) {
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

    file_put_contents($file, json_encode($file, JSON_PRETTY_PRINT));
    return $stats;
}

    $content = file_get_contents($file);
    $stats = json_decode($content, true);
    
    
    if ($stats === null) {
        echo "Erreur lors de la lecture du fichier de statistiques.\n";
        return[];
    }
    return $stats;
}


function afficherStatistiques(array $stats): void {
    if (empty($stats)) {
        echo "Aucune statistique disponible.\n";
        echo "Appuie sur Entrée pour retourner au menu principal...";
        fgets(STDIN);
        main();
        exit;
    }
    echo "\n===== STATISTIQUES DES PARTIES =====\n";

    echo "Nombre de parties jouées : " . $stats['nbparties'] . "\n";
    echo "Taux de victoire : " . $stats['tauxVictoire'] . "%\n";
    echo "Main la plus gagnante : " . $stats['mainsGagnantes'] . "\n";
    echo "Détail des taux de victoire par main : \n";
    foreach ($stats['mains'] as $main => $data) {
        if ($data['jouees'] > 0) {
            $tauxVictoire = round(($data['victoires'] / $data['jouees']) * 100, 2);
            echo "$main : $tauxVictoire%\n";
        }
    }
    echo "Temps total passé à jouer : " . $stats['tempsTotal'] . " secondes\n";
}


function runSaisies($choix): array {
    global $retourMenu;
    if ($choix == $retourMenu) {
        echo "Annuler et retourner au menu principal.\n";
        return ['retourMenu' => true];
    }
    return [];

}

?>
