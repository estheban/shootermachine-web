<?php

namespace Shooter\InterfaceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Beverage
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Shooter\InterfaceBundle\Entity\BeverageRepository")
 */
class Beverage
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
     * @var string
     *
     * @ORM\Column(name="sku", type="string", length=255)
     */
    private $sku;

    /**
     * @var string
     *
     * @ORM\Column(name="time", type="decimal", precision=10, scale=4)
     */
    private $time;
    
    /**
     * @ORM\OneToOne(targetEntity="Pump", mappedBy="beverage")
     **/
    private $pump;

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
     * @return Beverage
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

    /**
     * Set sku
     *
     * @param string $sku
     * @return Beverage
     */
    public function setSku($sku)
    {
        $this->sku = $sku;

        return $this;
    }

    /**
     * Get sku
     *
     * @return string 
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * Set time
     *
     * @param string $time
     * @return Beverage
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return string 
     */
    public function getTime()
    {
        return $this->time;
    }
    
    /**
     * Set pump
     *
     * @param Pump $pump
     * @return Beverage
     */
    public function setPump($pump)
    {
        $this->pump = $pump;

        return $this;
    }

    /**
     * Get pump
     *
     * @return Pump 
     */
    public function getPump()
    {
        return $this->pump;
    }
}
