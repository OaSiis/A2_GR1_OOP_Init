<?php


namespace Cartman\Init;

/**
 * Class User
 * @package Cartman\Init
 *
 * @Entity
 * @Table(name="user")
 */
class User implements UserInterface
{
    /**
     * @var int
     *
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @Column(name="username", type="string", length=50, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @Column(name="password", type="string", length=50)
     */
    private $password;

    /**
     * @var int
     *
     * @Column(name="lastBattle", type="integer")
     */
    private $lastBattle = 0;

    /**
     * @var int
     *
     * @Column(name="lastRevive", type="integer")
     */
    private $lastRevive = 0;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }
    /**
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }
    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return int
     */
    public function getLastBattle()
    {
        return $this->lastBattle;
    }

    /**
     * @param int $lastBattle
     */
    public function setLastBattle($lastBattle)
    {
        $this->lastBattle = $lastBattle;
    }

    /**
     * @return int
     */
    public function getLastRevive()
    {
        return $this->lastRevive;
    }

    /**
     * @param int $lastRevive
     */
    public function setLastRevive($lastRevive)
    {
        $this->lastRevive = $lastRevive;
    }
}