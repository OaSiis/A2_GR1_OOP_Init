<?php

require __DIR__.'/_header.php';

if (empty($_SESSION['connected'])) {
    header('Location: login.php');
}

use Cartman\Init\Pokemon\Model\PokemonModel;
use Cartman\Init\User;

$pokemon = new PokemonModel();
$user = new User();

$currentTime = strtotime("now");

/** @var \Doctrine\ORM\EntityRepository $pokemonRepository */
$pokemonRepository = $em->getRepository('Cartman\Init\Pokemon\Model\PokemonModel');
/** @var \Doctrine\ORM\EntityRepository $userRepository */
$userRepository = $em->getRepository('Cartman\Init\User');


$pokemons = $pokemonRepository->findOneBy(array('user_id' => $_SESSION['id']));
$trainer = $userRepository->find($_SESSION['id']);

$hp = $pokemons->getHP();
/**
 * CurrentTime
 */
$lastRevive = $trainer->getLastRevive();
if($currentTime - $lastRevive < (3600*24))
{
    header("location: failHeal.php");
}else {

    /** Resuscitate */
    if ($hp > 0) {
        header("location: pokemons.php");
    } else {

        $pokemons->setHP(100);
        $trainer->setLastRevive($currentTime);
        $em->flush();
        header("location: pokemons.php");
    }
}