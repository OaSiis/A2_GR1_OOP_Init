<?php

namespace Cartman\Init\Pokemon\Model;

/**
 * Class PokemonModel
 * @package Cartman\Init
 *
 * @Entity
 * @Table(name="pokemon")
 */
class PokemonModel implements PokemonInterface
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
     * @Column(name="name", type="string", length=60, unique=true)
     */
    private $name;

    /**
     * @var int
     *
     * @Column(name="hp", type="integer", length=100)
     */
    private $hp;

    /**
     * @var int
     *
     * @Column(name="user_id", type="integer")
     */
    private $user_id;

    /**
     * @var int
     *
     * @Column(name="type", type="smallint")
     */
    private $type;

    const TYPE_FIRE     = 0;
    const TYPE_WATER    = 1;
    const TYPE_PLANT    = 2;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     *
     * @return PokemonModel
     *
     * @throws \Exception
     */
    public function setName($name)
    {
        if(is_string($name))
            $this->name = $name;
        else
            throw new \Exception('Name must be a string');

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getHP()
    {
        return $this->hp;
    }

    /**
     * {@inheritdoc}
     *
     * @return PokemonModel
     *
     * @throws \Exception
     */
    public function setHP($hp)
    {
        if(is_int($hp)&& $hp > 0)
            $this->hp = $hp;
        else
            throw new \Exception('Id must be an integer and > 0');

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function addHP($hp)
    {
        if(is_int($hp)&& $hp > 0)
            $this->hp += $hp;
        else
            throw new \Exception('Id must be an integer and > 0');

        return $this->hp;
    }

    /**
     * [@inheritdoc}
     *
     * @throws \Exception
     */
    public function removeHP($hp)
    {
        if(is_int($hp)&& $hp > 0)
            $this->hp = ($this->hp <= $hp) ? 0 : $this->hp - $hp;
        else
            throw new \Exception('Id must be an integer');

        return $this->hp;
    }

    /**
     * @return int
    */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
    * @param int $user_id
    */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @inheritdoc
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     *
     * @return PokemonModel
     *
     * @throws \Exception
     */
    public function setType($type)
    {
        if(true=== in_array($type, [
                self::TYPE_FIRE,
                self::TYPE_WATER,
                self::TYPE_PLANT,
            ]))
                $this->type= $type;
        else
            throw new \Exception('Type => Bad');

        return $this;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setHP(100);
    }

    /**
     * @param $type
     * @param $type_atk
     * @return bool
     */
    public function isTypeWeak($type, $type_atk)
    {
        if($type === self::TYPE_FIRE){
            return (self::TYPE_WATER === $type_atk) ? true : false;
        }
        elseif($type === self::TYPE_WATER){
            return (self::TYPE_PLANT === $type_atk) ? true : false;
        }
        elseif($type === self::TYPE_PLANT){
            return (self::TYPE_FIRE === $type_atk) ? true : false;
        }
        else
            return false;

    }

    /**
     * @param $type
     * @param $type_atk
     * @return bool
     */
    public function isTypeStrong($type, $type_atk)
    {
        if($type === self::TYPE_FIRE){
            return (self::TYPE_PLANT === $type_atk) ? true : false;
        }
        elseif($type === self::TYPE_WATER){
            return (self::TYPE_FIRE === $type_atk) ? true : false;
        }
        elseif($type === self::TYPE_PLANT){
            return (self::TYPE_WATER === $type_atk) ? true : false;
        }
        else
            return false;

    }
}
