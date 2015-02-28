<?php

namespace Shooter\InterfaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Shooter\InterfaceBundle\Entity\Arduino;
use Shooter\InterfaceBundle\Entity\Drink;
use Shooter\InterfaceBundle\Entity\BeverageDrinkRepository;

class DefaultController extends Controller
{
    private $arduinoServer = 'http://192.168.70.105/'; // 'http://arduino.local/'; latency on domaine name resolution

    /**
     * @Route("/", name="home")
     * @Template()
     */
    public function indexAction()
    {
        $drinks = $this->getDrinks();
        
        return array('pageTitle' => 'Let\'s drink !', 'drinks' => $drinks);
    }
    
    /**
     * @Route("/order/{id}", name="order")
     * @Template()
     */
    public function orderAction(Drink $drink)
    {
        $arduino = $this->initArduino();

        $this
            ->get('braincrafted_bootstrap.flash')
            ->success('=)');
        
        $this->drinkToArduino($drink, $arduino);
        
        //Redirect
        return $this->redirect($this->generateUrl('home'));
    }
    
    /**
     * @Route("/startup")
     * @Template()
     */
    public function startupAction()
    {
        $arduino = $this->initArduino();
        $childs = array();
        
        //getActivePumps
        for ($i = 2; $i <= 11; $i++) {
            $arduino->arduinoResquest($arduino->getArduinoServer(), $arduino->initInstruc($i));
            $childs[] = $arduino->arduinoResquest(
                            $arduino->getArduinoServer(), 
                            $arduino->pumpDeactivate($i));
        }
        
        usleep(10000000);
        die('Fn startup');
        return array();
    }

    private function initArduino()
    {
        $arduino = new Arduino($this->arduinoServer);
        
        return $arduino;
    }
    
    private function getDrinks()
    {
//        return $this
//                ->getDoctrine()
//                ->getRepository('ShooterInterfaceBundle:Drink')
//                ->findAll();
        
        return $this
            ->getDoctrine()
            ->getRepository('ShooterInterfaceBundle:Drink')
            ->createQueryBuilder('p')
            ->orderBy('p.name', 'ASC')
            ->getQuery()
            ->getResult();
    }
    
    private function portionToTime($portion)
    {
//        1sec = 25ml
//        2sec = 3/4oz
//        5sec = 2oz
                
        return $portion * 2.3;
    }
    
    private function drinkToArduino(Drink $drink, Arduino $arduino)
    {
        $BeverageDrinks = $drink->getBeverageDrinks();
        
        $portions = array();
        foreach ($BeverageDrinks as $BeverageDrink) {
            if($BeverageDrink->getBeverage()->getPump() != null) {
                    $portions[] = new Portion(
                        $BeverageDrink->getBeverage()->getPump()->getPin(),
                        $this->portionToTime($BeverageDrink->getQty())
                    );
            }
        }

        $childs = array();
        foreach ($portions as $key => $portion) {
            $childs[] = $arduino->arduinoResquest(
                    $arduino->getArduinoServer(), 
                    $arduino->pumpActivate($portion->pump_id));
            $portion->start();
            
            $i = true;
            while($i) {
                if ($portion->needToStop()) {
                    $childs[] = $arduino->arduinoResquest(
                            $arduino->getArduinoServer(), 
                            $arduino->pumpDeactivate($portion->pump_id));
                    unset($portions[$key]);
                    $i = false;
                }
                usleep(50000);
            }
        }
        
    }

    public function pumpMultiTread() 
    {
        //DO IT
        $childs = array();

        //Start
        echo 'start';
        echo '<br />';

        foreach ($portions as $portion) {
            $childs[] = $arduino->arduinoResquest(
                    $arduino->getArduinoServer(), 
                    $arduino->pumpActivate($portion->pump_id));
            $portion->start();
            echo 'Pump Start :'.$portion->pump_id.'<br />';
        }

        //var_dump($childs);
//        echo 'Wait process start'.'<br />';
//        while(count($childs) > 0) {
//            echo 'wait' . count($childs) . '<br />';
//            usleep(100000);
//            foreach($childs as $key => $pid) {
//                $res = pcntl_waitpid($pid, $status, WNOHANG);
//
//                // If the process has already exited
//                if($res == -1 || $res > 0) {
//                    unset($childs[$key]);
//                }
//            }
//        }
//        echo '<br />';

        //End
        while(count($portions) > 0) {
            echo 'number ' . count($portions).'<br />';
            usleep(100000);
            foreach ($portions as $key => $portion) {
                if($portion->needToStop()) {
                    $childs[] = $arduino->arduinoResquest(
                            $arduino->getArduinoServer(), 
                            $arduino->pumpDeactivate($portion->pump_id));
                    echo 'Pump End :'.$portion->pump_id.'<br />';
                    unset($portions[$key]);
                    //var_dump($portions);
                } 
            }
        }

        //var_dump($childs);
//        echo 'Wait process end'.'<br />';
//        while(count($childs) > 0) {
//            foreach($childs as $key => $pid) {
//                $res = pcntl_waitpid($pid, $status, WNOHANG);
//
//                // If the process has already exited
//                if($res == -1 || $res > 0)
//                    unset($childs[$key]);
//            }
//        }
//        echo '<br />';

        echo 'Master wait'.'<br />';
        usleep(10000000);
        die('The end');
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