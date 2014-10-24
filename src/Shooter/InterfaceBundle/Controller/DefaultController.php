<?php

namespace Shooter\InterfaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Shooter\InterfaceBundle\Entity\Arduino;
use Shooter\InterfaceBundle\Entity\Drink;

class DefaultController extends Controller
{
    private $arduinoServer = 'http://192.168.70.105/'; // 'http://arduino.local/'; latency on domaine name resolution
    
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
    
    /**
     * @Route("/order/{id}", name="order")
     * @Template()
     */
    public function orderAction($id)
    {
        $arduino = $this->initArduino();
        $this->drinkToArduino($arduino);
        return array();
    }
    
    /**
     * @Route("/startup")
     * @Template()
     */
    public function startupAction()
    {
        $arduino = $this->initArduino();
        
        //getActivePumps
        for ($i = 2; $i <= 11; $i++) {
            $arduino->arduinoResquest($arduino->getArduinoServer(), $arduino->initInstruc($i));
        }
        
        return array();
    }
    
    private function initArduino()
    {
        $arduino = new Arduino($this->arduinoServer);
        
        return $arduino;
    }

    
    private function getDrinks()
    {
        
    }
    
    private function drinkToArduino(Drink $drink, Arduino $arduino)
    {

        
// Logic
// Arduino -> Pump -> Breuvage 
// fn getTime
        
        
    }
    

    
    
}
