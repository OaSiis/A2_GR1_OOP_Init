<?php

require __DIR__.'/_header.php';

/** Protection */
if (!empty($_SESSION['connected'])) {
    header('Location: new_pokemon.php');
}

use \Cartman\Init\User;

$error ='';
$username = !empty($_POST['username']) ? $_POST['username'] : null;
$password = !empty($_POST['password']) ? $_POST['password'] : null;

/**
 * Login
 */
if (null !== $username && null !== $password) {
    /** @var \Doctrine\ORM\EntityRepository $userRepository */
    $userRepository = $em->getRepository('Cartman\Init\User');
    /** @var User|null $user */
    $user = $userRepository->findOneBy([
        'username' => $username,
        'password' => $password,
    ]);
    if (null !== $user) {
        $_SESSION['id'] = $user->getId();
        $_SESSION['username'] = $user->getUsername();
        $_SESSION['connected'] = true;
        header('location: new_pokemon.php');
    }else{
        $error = true;
    }
}

echo $twig->render('login.html.twig', [
    'error' => $error,
]);
