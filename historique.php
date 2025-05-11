<?php
$retourMenu = 1;
$historique = historiqueDesDonnees();
ini_set('memory_limit', '256M');


function historiqueDesDonnees(): array
{

    if (!file_exists(__DIR__ . '/historique.csv')) {
        echo "Le fichier historique est vide ou n'existe pas.\n";
        return [];
    }

    $handle = fopen(__DIR__ . '/historique.csv', 'r');
    $historique = [];

    while (($row = fgetcsv($handle, 1000, ',', '"', '\\')) !== false) {
        if (count($row) >= 4) {
            $historique[] = [
                'date' => $row[0],
                'choixJoueur' => $row[1],
                'choixCPU' => $row[2],
                'resultat' => $row[3]
            ];
        } else {
            echo "Avertissement : ligne mal formatée, sautée.\n";
        }
    }



    fclose($handle);

    return $historique;
}


function afficherHistorique(array $historique): void
{
    // Si l'historique est vide, afficher un message
    if (empty($historique)) {
        echo "Aucun historique trouvé.\n";
        return;
    }

    // Afficher l'entête de l'historique
    echo "\n=== Historique des Parties ===\n";
    echo str_repeat("=", 40) . "\n"; // Ligne de séparation
    echo "| Date       | Choix Joueur | Choix Ordinateur | Résultat |\n";
    echo str_repeat("=", 40) . "\n"; // Ligne de séparation

    // Afficher chaque ligne de l'historique
    foreach ($historique as $entry) {
        echo "| " . str_pad($entry['date'], 10) . " | " .
            str_pad($entry['choixJoueur'], 12) . " | " .
            str_pad($entry['choixCPU'], 16) . " | " .
            str_pad($entry['resultat'], 8) . " |\n";
    }

    echo str_repeat("=", 40) . "\n"; // Ligne de séparation

}


function runSaisieHistorique()
{
    $saisieHistorique = readline("Souhaitez-vous :\n
    1. Retourner au menu Principal (1)\n");

    if (!ctype_digit($saisieHistorique)) {
        echo "Erreur : Tu dois entrer le chiffre 1 pour retourner vers le Menu principal.\n";
        return runSaisieHistorique();
    }
    $saisieHistorique = (int) $saisieHistorique;

    if ($saisieHistorique !== 1) {
        echo "Erreur : Tu dois entrer le chiffre 1 pour retourner vers le Menu principal.\n";
        return runSaisieHistorique();
        // recommence la boucle
    }
    return (int) $saisieHistorique;
}

// Appel de la fonction pour afficher l'historique
afficherHistorique($historique);



$saisieHistorique = runSaisieHistorique();

if ((int)$saisieHistorique == 1) {
    echo "Retour au menu principal.\n";
    main();
}
