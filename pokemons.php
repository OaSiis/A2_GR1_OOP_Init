<?php

require __DIR__.'/_header.php';

if (empty($_SESSION['connected'])) {
    header('Location: login.php');
}

use Cartman\Init\Pokemon\Model\PokemonModel;

$pokemonRepository = $em->getRepository('Cartman\Init\Pokemon\Model\PokemonModel');

$pokemons = $pokemonRepository->findOneBy(array('user_id' => $_SESSION['id']));

$type= $pokemons->getType();

/** Take Type $pokemons */

if($type == PokemonModel::TYPE_PLANT)
{
    $types = "Plant";
}
elseif($type == PokemonModel::TYPE_FIRE)
{
    $types = "Fire";
}
elseif($type == PokemonModel::TYPE_WATER)
{
    $types = "Water";
}

$homeConnected = $_SESSION['connected'];

$homeSession = $_SESSION;

echo $twig->render('pokemon.html.twig', [
    'homeConnected' => $homeConnected,
    'homeSession' => $homeSession,
    'pokemons' => $pokemons,
    'type' => $types
]);