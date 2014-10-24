<?php

namespace Shooter\InterfaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Shooter\InterfaceBundle\Entity\Arduino;

class DefaultController extends Controller
{
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
        $arduinoServer =  'http://192.168.70.105/'; // 'http://arduino.local/'; latency on domaine name resolution
        $arduino = new Arduino($arduinoServer);
        
        return $arduino;
    }

    
    private function getDrinks()
    {
        
    }
    
    private function drinkToArduino()
    {

        
// Logic
// Arduino -> Pump -> Breuvage 
// fn getTime
        
        
    }
    

    
    
}
