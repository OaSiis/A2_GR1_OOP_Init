<?php

require __DIR__.'/_header.php';

if (empty($_SESSION['connected'])) {
    header('Location: login.php');
}

use Cartman\Init\Pokemon\Model\PokemonModel;

$pokemonRepository = $em->getRepository('Cartman\Init\Pokemon\Model\PokemonModel');

$pokemons = $pokemonRepository->findOneBy(array('user_id' => $_SESSION['id']));

if($pokemons !== null){
    header('location:pokemons.php');
}

$name = !empty($_POST['name']) ? $_POST['name'] : null;
$type = !empty($_POST['type']) ? $_POST['type'] : (\Cartman\Init\Pokemon\Model\PokemonModel::TYPE_FIRE);

/**
 * Create a new pokemon
 */
if (null !== $name){

    $pokemon= new PokemonModel();
    $pokemon
        ->setName($name)
        ->setType($type)
        ->setUserId($_SESSION['id'])
    ;

    $em->persist($pokemon);
    $em->flush();
    header('location:pokemons.php');
}
;

$homeConnected = $_SESSION['connected'];

$homeSession = $_SESSION;

echo $twig->render('new_pokemon.html.twig', [
    'homeConnected' => $homeConnected,
    'homeSession' => $homeSession,
    'pokemon' => $type,
]);
