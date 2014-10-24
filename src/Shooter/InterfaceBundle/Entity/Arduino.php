<?php

namespace Shooter\InterfaceBundle\Entity;

class arduino
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
// $curl = curl_init($arduinoServer . $request);
// echo curl_exec($curl);
		return file_get_contents($arduinoServer . $request);;
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
