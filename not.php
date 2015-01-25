<?php

require __DIR__.'/_header.php';

if (empty($_SESSION['connected'])) {
    header('Location: login.php');
}

/**
 * FAIL HP - REVIVE POKEMON
 */

$text='Your pokemon has 0 hp.';
$return='pokemons.php';
$to='pokemon';

$homeConnected = $_SESSION['connected'];

$homeSession = $_SESSION;

echo $twig->render('example.html.twig', [
    'homeConnected' => $homeConnected,
    'homeSession' => $homeSession,
    'text' => $text,
    'return' => $return,
    'to' => $to
]);