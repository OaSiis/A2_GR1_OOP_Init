<?php

require __DIR__.'/_header.php';


/** Protection */
if (!empty($_SESSION['connected'])) {
    header('Location: new_pokemon.php');
}

use \Cartman\Init\User;

$trainerCreate= '';
$username = !empty($_POST['username']) ? $_POST['username'] : null;
$password = !empty($_POST['password']) ? $_POST['password'] : null;

/**
 * SignIn
 */
if (null !== $username && null !== $password){

    $user= new User();
    $user
        ->setUsername($username)
        ->setPassword($password)
    ;

    $trainerCreate = true;
    $em->persist($user);
    $em->flush();
}


echo $twig->render('sign.html.twig', [
    'trainerCreate' => $trainerCreate
]);
