<?php

namespace Shooter\InterfaceBundle\Entity;

class Arduino
{
	private $arduinoServer =  '';

	public function __construct($arduinoServer)
	{
		$this->setArduinoServer($arduinoServer);
	}

	public function setArduinoServer($arduinoServer)
	{
		$this->arduinoServer = $arduinoServer;
	}

	public function getArduinoServer()
	{
		return $this->arduinoServer;
	}


	public function arduinoResquest($arduinoServer, $request)
	{
            $curl = curl_init($arduinoServer . $request);
            $curl_feedback = curl_exec($curl);
            
            return $curl_feedback;
            
//            $pid = pcntl_fork();
//            if($pid == -1)
//                die('Could not fork');
//
//            if ($pid) {
//                echo 'parent '.$pid;
//                //pcntl_wait($status);
//                return $pid;
//            } else {
//                // Sleep $i+1 (s). The child process can get this parameters($i).
//                //Curl is 9x time faster file_get_contents 
//                //ex : file_get_contents($arduinoServer . $request);
//                $curl = curl_init($arduinoServer . $request);
//                $curl_feedback = curl_exec($curl);
//                //echo $curl_feedback.'<br />';
//                //echo 'Child die : '.$pid;
//                
//                // The child process needed to end the loop.
//                exit();
//            }
//            
//            return $pid;
	}

	public function initInstruc($pumpID, $mode = 'output')
	{
		return 'arduino/mode/'.$pumpID.'/'.$mode ;
	}

	private function pumpInstruc($pumpID, $mode)
	{
		return 'arduino/digital/'.$pumpID.'/'.$mode;
	}

	public function pumpActivate($pumpID)
	{
		return $this->pumpInstruc($pumpID, 1);
	}

	public function pumpDeactivate($pumpID)
	{
		return $this->pumpInstruc($pumpID, 0);
	}
}
