<?php


require __DIR__.'/_header.php';

if (empty($_SESSION['connected'])) {
    header('Location: login.php');
}

use Cartman\Init\Pokemon\Model\PokemonModel;
use Cartman\Init\User;

$pokemon = new PokemonModel();
$user = new User();

/** @var \Doctrine\ORM\EntityRepository $pokemonRepository */
$pokemonRepository = $em->getRepository('Cartman\Init\Pokemon\Model\PokemonModel');
/** @var \Doctrine\ORM\EntityRepository $userRepository */
$userRepository = $em->getRepository('Cartman\Init\User');

$pokemons = $pokemonRepository->findAll();
$userStriker = $userRepository->find($_SESSION['id']);

/** Take all pokemons (by ID) and mix */
$pokemon->getId($pokemons);
shuffle($pokemons);

/**
 * CurrentTime
 */
$lastBattle = $userStriker->getLastBattle();
$currentTime = strtotime("now");
if($currentTime - $lastBattle <= (3600*6))
{
    header("location: fail.php");
}

/**
 * Parameters
 */
$striker = $pokemonRepository->findOneBy(array('user_id' => $_SESSION['id']));
$goal    = array_pop($pokemons) ;


/** Protection Battle */
if($striker === null){
    header('location:new_pokemon.php');
}

/** Prevents a fight against the same pokemon */
if ($goal === $striker ){
    $goal = array_pop($pokemons);
}

$hp= $striker->getHP($striker);
/**Prevents a fight with a pokemon with 0 HP */
if( $hp === 0 ){
    header("location: not.php");
}

$hp2 = $goal->getHP($goal);
/**Prevents a fight with a pokemon with 0 HP */
if($hp2 === 0){
    header("location: pokemon_battle.php");
}

/**
 * logic
 */
        $attack = mt_rand(10, 20);

        $type = $striker->getType($striker);
        $type_atk = $goal->getType($goal);

        $weak = $pokemon->isTypeWeak($type, $type_atk);
        $strong = $pokemon->isTypeStrong($type, $type_atk);

        if ($strong === true) {
            $attack = $attack * 1.5;
        }
        if ($weak === true) {
            $attack = (int)ceil($attack / 2);
        }

        $goal->removeHP((int)$attack);

        $fight = $striker->getName().' attacks '.$goal->getName().' Attack n° '.(1).' | '.$attack.' HP removed  | '.$goal->getName().' have '.$goal->getHP().'HP left';

$userStriker->setLastBattle($currentTime);
$em->flush();

$homeConnected = $_SESSION['connected'];

$homeSession = $_SESSION;

echo $twig->render('battle.html.twig', [
    'homeConnected' => $homeConnected,
    'homeSession' => $homeSession,
    'striker' => $striker,
    'goal' => $goal,
    'fight' => $fight,
]);

