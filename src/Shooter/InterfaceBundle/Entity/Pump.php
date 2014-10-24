<?php

namespace Shooter\InterfaceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pump
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Shooter\InterfaceBundle\Entity\PumpRepository")
 */
class Pump
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
     * @var integer
     *
     * @ORM\Column(name="pin", type="integer")
     */
    private $pin;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;
    
    /**
     * @ORM\OneToOne(targetEntity="Beverage")
     * @JoinColumn(name="beverage_id", referencedColumnName="id")
     **/
    private $beverage;
    
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
     * Set pin
     *
     * @param integer $pin
     * @return Pump
     */
    public function setPin($pin)
    {
        $this->pin = $pin;

        return $this;
    }

    /**
     * Get pin
     *
     * @return integer 
     */
    public function getPin()
    {
        return $this->pin;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return Pump
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }
    
    /**
     * Set beverage
     *
     * @param Beverage $beverage
     * @return Pump
     */
    public function setBeverage($beverage)
    {
        $this->beverage = $beverage;

        return $this;
    }

    /**
     * Get beverage
     *
     * @return Beverage 
     */
    public function getBeverage()
    {
        return $this->beverage;
    }
}
