<?php

function main()
{
    // while (true) {
    $menuPrincipal = readline("\n=== Menu Principal ===\n
1. Nouvelle Partie\n
2. Historique des Parties\n
3. Statistiques des Parties\n
4. Quitter le Jeu\n
Entrer votre choix (1-4): ");
    $expectedMenuOptions = ['1', '2', '3', '4'];

    // Vérification de la validité de l'entrée

    if (in_array($menuPrincipal, $expectedMenuOptions) === false) {
        echo (string)("Erreur : Tu dois mettre un chiffre entre 1 et 4.\n");
       
    }

    // une fonction = une fonctionnalité


    $menu = null;


    if ($menuPrincipal === '1') {
        require_once __DIR__ . '/function.php';
        $menu = nouvellePartie();
    }

    if ($menuPrincipal === '2') {
        require_once __DIR__ . '/historique.php';
        $menu = historiqueDesDonnees();
    }

    if ($menuPrincipal === '3') {
        require_once __DIR__ . '/stats.php';
        $menu = StatistiquesDesParties();
        
    }

    if ($menuPrincipal === '4') {
        return "Merci d'avoir joué ! À bientôt !";
    }

    if (is_array($menu) && isset($menu['retourMenu']) && $menu['retourMenu']) {
        main();
    }
}

require_once __DIR__ . '/function.php';

$menuAreValid = true;

if ($menuAreValid === false) {
    echo 'Les données sont invalides';
    return;
}



main();


