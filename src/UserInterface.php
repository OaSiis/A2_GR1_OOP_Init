<?php


namespace Cartman\Init;


interface UserInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getUsername();

    /**
     * @param string $username
     *
     * @return UserInterface
     */
    public function setUsername($username);

    /**
     * @return string
     */
    public function getPassword();

    /**
     * @param string $password
     *
     * @return UserInterface
     */
    public function setPassword($password);
} 