<?php
// laisser la possibilité aux joueur d'annuler la partie et de retourner au menu principal

$ciseau = 1;
$papier = 2;
$pierre = 3;
$retourMenu = 4;


function choixToString(int $choix): string
{
    return match ($choix) {
        1 => "Ciseau",
        2 => "Papier",
        3 => "Pierre",
        default => "Inconnu",
    };
}


function sauvegarderHistorique(string $date, string $choix, string $choixCPU, string $resultat): void
{
    
    $handle = fopen(__DIR__ . '/historique.csv', 'a');
    fputcsv($handle, [$date, $choix, $choixCPU, $resultat], ',', '"', "\\");
    fclose($handle);
}


function readChoix(): int
{
    $saisie = readline("Quel est votre choix ?\n");
    if (!ctype_digit($saisie) || (int) $saisie < 1 || (int) $saisie > 4) {
        echo "Erreur : Tu dois entrer un chiffre entre 1 et 4.\n";
        return readChoix();
    }
    return (int) $saisie;
}


function runChoix($choix)
{
    global $ciseau, $papier, $pierre, $retourMenu;

    if ($choix == $ciseau) {
        echo "Vous avez choisi ciseau.\n";
        return $choix;
    } elseif ($choix == $papier) {
        echo "Vous avez choisi papier.\n";
        return $choix;
    } elseif ($choix == $pierre) {
        echo "Vous avez choisi pierre.\n";
        return $choix;
    } elseif ($choix == $retourMenu) {
        echo "Annuler et retourner au menu principal.\n";
        return ['retourMenu' => true];
    }
}


function runChoixCPU()
{
    global $ciseau, $papier, $pierre;

    $choixCPU = (int) rand(1, 3);
    if ($choixCPU == $ciseau) {
        echo "L'ordinateur a choisi ciseau.\n";
        return $choixCPU;
    } elseif ($choixCPU == $papier) {
        echo "L'ordinateur a choisi papier.\n";
        return $choixCPU;
        
    } elseif ($choixCPU == $pierre) {
        echo "L'ordinateur a choisi pierre.\n";
    }
    return $choixCPU;
}


function runSaisie()
{
    $saisie = readline("Souhaitez-vous :\n
    1. Rejouer (1)\n
    2. Retourner au menu Principal (2)\n");

    if (!ctype_digit($saisie)) {
        echo "Erreur : Tu dois entrer un chiffre entre 1 et 2.\n";
        return runSaisie();
    }
    $saisie = (int) $saisie;

    if ($saisie !== 1 && $saisie !== 2) {
        echo "Erreur : Tu dois entrer un chiffre entre 1 et 2.\n";
        return runSaisie();
        // recommence la boucle
    }
    return (int) $saisie;
}



// $nouvellePartie = readline("=== Nouvelle Partie === Retourner au menu principal (4)\n");
function nouvellePartie(): array
{
    echo "=== Nouvelle Partie === \n";
    echo " Ciseau (1)\n";
    echo " Papier (2)\n";
    echo " Pierre (3)\n";
    echo " Retour au menu principal (4)\n";

    // laisser l'utilisateur choisir entre "pierre", "feuille" et "ciseau"
    while (true) {
        $debut = microtime(true);

        $choix = readChoix();

        $choixExecuted = runChoix($choix);
        if ($choixExecuted['retourMenu'] ?? false) {
            echo "Annuler et retourner au menu principal.\n";
            return $choixExecuted;
        }
        // une fois le choix fait, faire jouer le CPU

        $choixCPU = runChoixCPU();

        $resultat = afficherResultat($choix, $choixCPU);

        $date = date('Y-m-d');

        $choixStr = choixToString($choix);
        $choixCPUStr = choixToString($choixCPU);
        sauvegarderHistorique($date, $choixStr, $choixCPUStr, $resultat);

        $fin = microtime(true);
        $duree = round($fin - $debut);

       
        // une fois la partie terminée, laisser la possibilité à l'utilisateur
        // de retourner dans le menu principal
        // de lancer une nouvelle partie
        $saisie = runSaisie();

        if ((int)$saisie == 2) {
            echo "Retour au menu principal.\n";
            return ['retourMenu' => true];
        }
    }
}


// afficher le résultat de la partie
function afficherResultat($choix, $choixCPU): string
{
    if ($choix == $choixCPU) {
        echo "Égalité !\n";
        return "Egalité";
    } elseif (
        ($choix === 3 && $choixCPU === 1) ||
        ($choix === 1 && $choixCPU === 2) ||
        ($choix === 2 && $choixCPU === 3)
    ) {
        echo "Vous avez gagné !\n";
        return "Victoire";
    } else {
        echo "L'ordinateur a gagné !\n";
        return "Défaite";
    }
}
// sauvegarderStatistiques(
//     $nbparties = 0,
//     $victoires = 0,
//     $defaites = 0,
//     $egalites = 0,
//     $mainsGagnantes = '',
//     $tauxVictoire = 0,
//     $tempsTotal = 0,
//     $mains = 0
// );

// function sauvegarderStatistiques(string $nbparties, string $victoires, string $defaites, string $egalites, string $mainsGagnantes, string $tauxVictoire, string $tempsTotal, string $mains): void
// {
//     $file = __DIR__ . '/stats.json';
//     $data = [
//         'nbparties' => $nbparties,
//         'victoires' => $victoires,
//         'defaites' => $defaites,
//         'egalites' => $egalites,
//         'mainsGagnantes' => $mainsGagnantes,
//         'tauxVictoire' => $tauxVictoire,
//         'tempsTotal' => $tempsTotal,
//         'mains' => [
//             'Pierre' => ['jouees' => 0, 'victoires' => 0],
//             'Papier' => ['jouees' => 0, 'victoires' => 0],
//             'Ciseau' => ['jouees' => 0, 'victoires' => 0],
//         ]
//     ];

//     file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
// }
