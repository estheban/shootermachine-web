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
        $drinks = array();
        
        return array('pageTitle' => 'Super', 'drinks' => $drinks);
    }
    
    /**
     * @Route("/order/{id}", name="order")
     * @Template()
     */
    public function orderAction($id)
    {
        //die('order');
        $arduino = $this->initArduino();
        $drink = new Drink;
        
        $this->drinkToArduino($drink, $arduino);
        
        die('test order');
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
        
        die('test startup');
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
        //die('drinkToArduino');
        
// Logic
// Arduino -> Pump -> Breuvage 
// fn getTime
        
        
        $portions = array();
        $portions[] = new Portion(2,1.000);
        $portions[] = new Portion(3,1.000);
        $portions[] = new Portion(4,1.000);
        $portions[] = new Portion(5,1.000);
        $portions[] = new Portion(5,1.000);
        $portions[] = new Portion(6,1.000);
        $portions[] = new Portion(7,1.000);
        $portions[] = new Portion(8,1.000);
        $portions[] = new Portion(9,1.000);
        $portions[] = new Portion(10,1.000);
        $portions[] = new Portion(11,1.000);
        
        
        //DO IT

        //Sort ???

        //Start
        echo 'start';
        echo '<br />';
        foreach ($portions as $portion) {
            if($portion->needToStop()) {
                echo $arduino->arduinoResquest(
                        $arduino->getArduinoServer(), 
                        $arduino->pumpActivate($portion->pump_id));
                $portion->start();
            } 
        }
        
        echo '<br />';
        
        //End
        while(count($portions) >= 1) {
            echo 'number ' . count($portions);
            foreach ($portions as $key => $portion) {
                if($portion->needToStop()) {
                    echo $arduino->arduinoResquest(
                            $arduino->getArduinoServer(), 
                            $arduino->pumpDeactivate($portion->pump_id));
                    echo '<br />';
                    unset($portions[$key]);
                } 
            }
        }
        
        return true;
    }

}

class Portion
{
    public $pump_id;
    public $time; //in sec 4 decimal ex : 1.1111
    public $start = false;
    
    public function __construct($pump_id, $time)
    {
        $this->pump_id = $pump_id;
        $this->time = $time;
    }
    
    public function start()
    {
        $this->start = microtime(true);
    }
    
    public function needToStop()
    {
        $time = microtime(true);
        if($time >= $this->start + $this->time) {
            return true;
        } else {
            return false;
        }
    }

}