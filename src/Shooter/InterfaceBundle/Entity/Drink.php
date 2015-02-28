<?php

namespace Shooter\InterfaceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Drink
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Shooter\InterfaceBundle\Entity\DrinkRepository")
 */
class Drink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    
    /**
     * @ORM\OneToMany(targetEntity="BeverageDrink", mappedBy="drink")
     */
    private $beverageDrinks;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Drink
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    
    public function getBeverageDrinks()
    {
        return $this->beverageDrinks;
    }
}
