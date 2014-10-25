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
        $drinks = $this->getDrinks();
                
        return array('pageTitle' => 'Let\'s drink !', 'drinks' => $drinks);
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
        
        $this->indexAction();
        
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
    
    /**
     * @Route("/test")
     * @Template()
     */
    public function testAction()
    {
        echo 'Start'.'<br />';
        if (($pid = pcntl_fork()) == 0) {
            die('Child die : '.$pid.'<br />');
            // return file_get_contents($arduinoServer . $request);
        }
        
        echo 'Parent :'.$pid.'<br />';
        
        phpinfo();
        
        die('test startup'.'<br />');
        return array();
    }
    
    /**
     * @Route("/ssh")
     * @Template()
     */
    public function sshAction()
    {
        require __DIR__.'../Resources/phpseclib0.3.8/Net/SSH2.php';

        $ssh = new Net_SSH2('$this->arduinoServer');
        if (!$ssh->login('root', 'arduino')) {
            exit('Login Failed');
        }
        
        echo $ssh->exec('pwd');
        echo $ssh->exec('ls -la');
        
        die('test ssh'.'<br />');
        return array();
    }
   
    
    private function initArduino()
    {
        $arduino = new Arduino($this->arduinoServer);
        
        return $arduino;
    }

    
    private function getDrinks()
    {
        return array();
    }
    
    private function drinkToArduino(Drink $drink, Arduino $arduino)
    {
        //die('drinkToArduino');
        
// Logic
// Arduino -> Pump -> Breuvage 
// fn getTime
// 
        //Conversion portion to time
        
        $portions = array();
        $portions[] = new Portion(2,0.000);
        $portions[] = new Portion(3,0.000);
        $portions[] = new Portion(4,0.000);
        $portions[] = new Portion(5,0.000);
        $portions[] = new Portion(6,0.000);
        $portions[] = new Portion(7,0.000);
        $portions[] = new Portion(8,0.000);
        $portions[] = new Portion(9,0.000);
        $portions[] = new Portion(10,0.000);
        $portions[] = new Portion(11,0.000);

        foreach ($portions as $key => $portion) {
            $childs[] = $arduino->arduinoResquest(
                    $arduino->getArduinoServer(), 
                    $arduino->pumpActivate($portion->pump_id));
            $portion->start();
            //echo 'Pump Start :'.$portion->pump_id.'<br />';
            $i = true;
            while($i) {
                usleep(100000);
                if ($portion->needToStop()) {
                $childs[] = $arduino->arduinoResquest(
                        $arduino->getArduinoServer(), 
                        $arduino->pumpDeactivate($portion->pump_id));
                //echo 'Pump End :'.$portion->pump_id.'<br />';
                unset($portions[$key]);
                $i = false;
                }
            }
        }
        
    }

    public function pumpMultiTread() 
    {
        //DO IT
        $childs = array();

        //Sort ???

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