<?php

namespace Shooter\InterfaceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BeverageDrink
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Shooter\InterfaceBundle\Entity\BeverageDrinkRepository")
 */
class BeverageDrink
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
     * @ORM\Column(name="qty", type="decimal")
     */
    private $qty;
    
    /**
     * @ManyToOne(targetEntity="Beverage")
     * @JoinColumn(name="beverage_id", referencedColumnName="id")
     **/
    private $beverage;

    /**
     * @ManyToOne(targetEntity="Drink")
     * @JoinColumn(name="drink_id", referencedColumnName="id")
     **/
    private $drink;
    
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
     * Set qty
     *
     * @param string $qty
     * @return BeverageDrink
     */
    public function setQty($qty)
    {
        $this->qty = $qty;

        return $this;
    }

    /**
     * Get qty
     *
     * @return string 
     */
    public function getQty()
    {
        return $this->qty;
    }
    
    /**
     * Get beverage
     *
     * @return string 
     */
    public function getBeverage()
    {
        return $this->beverage;
    }
    
    /**
     * Set beverage
     *
     * @param Beverage $beverage
     * @return BeverageDrink
     */
    public function setBeverage($beverage)
    {
        $this->beverage = $beverage;

        return $this;
    }
    
    /**
     * Get drink
     *
     * @return string 
     */
    public function getDrink()
    {
        return $this->drink;
    }
    
    /**
     * Set drink
     *
     * @param Drink $drink
     * @return BeverageDrink
     */
    public function setDrink($drink)
    {
        $this->drink = $drink;

        return $this;
    }
}
